<?php

namespace App\Http\Controllers;

use App\Models\Course;           
use App\Models\Purchase;         
use Illuminate\Http\Request;     
use Illuminate\Support\Facades\DB;    // للتعامل مع قاعدة البيانات
use Illuminate\Support\Facades\Log;   // لتسجيل السجلات (Logging)

// استيراد الـ classes من Stripe
use Stripe\Webhook;              // للتعامل مع أحداث الـ Webhook من Stripe
use Stripe\Stripe;               // الفئة الرئيسية لـ Stripe API

class WebhookController extends Controller
{
    /**
     * الدالة الرئيسية التي تستقبل أحداث Stripe
     * 
     * @param Request $request - طلب الـ HTTP الوارد من Stripe
     * @return \Illuminate\Http\Response
     */
    public function handleStripe(Request $request)
    {
        // قراءة البيانات الخام (raw payload) المرسلة من Stripe
        // @ قبل file_get_contents تمنع عرض الأخطاء في حالة فشل القراءة
        $payload = @file_get_contents('php://input');
        
        // الحصول على رأس التوقيع (Signature) من الطلب
        // هذا التوقيع يستخدم للتحقق من أن الطلب أصلي من Stripe وليس مزيف
        $sig_header = $request->header('Stripe-Signature');
        
        // الحصول على الـ secret key الخاص بـ Webhook من ملف البيئة (.env)
        // هذا المفتاح ضروري للتحقق من صحة التوقيع
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        // محاولة التحقق من صحة الـ Webhook والبناء
        try {
            // بناء كائن الحدث (Event) من البيانات الواردة
            // هذه الدالة تتحقق من:
            // 1. صحة التوقيع الرقمي
            // 2. أن الطلب أصلي من Stripe
            // 3. أن البيانات لم يتم تعديلها
            $event = Webhook::constructEvent(
                $payload,        // البيانات الخام
                $sig_header,     // رأس التوقيع
                $endpoint_secret // مفتاح التحقق
            );
        } 
        // في حالة وجود بيانات غير صالحة (payload غير صحيح)
        catch (\UnexpectedValueException $e) {
            // تسجيل خطأ في ملف السجلات
            Log::error('Webhook Error: Invalid payload', ['error' => $e->getMessage()]);
            // إرجاع استجابة خطأ 400 (طلب غير صحيح)
            return response('', 400);
        } 
        // في حالة فشل التحقق من التوقيع (توقيع غير صالح)
        catch (\Stripe\Exception\SignatureVerificationException $e) {
            // تسجيل خطأ في ملف السجلات
            Log::error('Webhook Error: Invalid signature', ['error' => $e->getMessage()]);
            // إرجاع استجابة خطأ 400
            return response('', 400);
        }

        // معالجة أنواع الأحداث المختلفة التي ترسلها Stripe
        // switch statement للتعامل مع كل نوع حدث بشكل منفصل
        switch ($event->type) {
            // عندما ينجح الدفع بنجاح
            case 'payment_intent.succeeded':
                // استدعاء دالة معالجة الدفع الناجح
                // $event->data->object يحتوي على بيانات الـ PaymentIntent
                $this->handlePaymentSucceeded($event->data->object);
                break;
            
            // عندما يفشل الدفع
            case 'payment_intent.payment_failed':
                // استدعاء دالة معالجة الدفع الفاشل
                $this->handlePaymentFailed($event->data->object);
                break;
            
            // عندما يتم إلغاء الدفع
            case 'payment_intent.canceled':
                // استدعاء دالة معالجة الدفع الملغى
                $this->handlePaymentCanceled($event->data->object);
                break;
            
            // لأي نوع حدث آخر غير معالج
            default:
                // تسجيل معلومة في السجلات بأن هذا النوع من الأحداث لم يتم معالجته
                Log::info('Unhandled event type: ' . $event->type);
        }

        // إرجاع استجابة نجاح 200 للإشارة إلى أن الـ Webhook تم استقباله ومعالجته
        // هذا مهم لأن Stripe تنتظر استجابة 200 لتعتبر الـ Webhook ناجحاً
        return response('Webhook received', 200);
    }

    /**
     * دالة خاصة لمعالجة حدث نجاح الدفع
     * 
     * @param object $paymentIntent - كائن الـ PaymentIntent من Stripe
     */
    private function handlePaymentSucceeded($paymentIntent)
    {
        // تسجيل معلومة في السجلات بأن الدفع نجح
        // يتم تسجيل معرف الـ payment_intent للمتابعة
        Log::info('Payment succeeded', ['payment_intent_id' => $paymentIntent->id]);

        // البحث في قاعدة البيانات عن عملية الشراء المرتبطة بهذا الـ payment_intent_id
        // نبحث باستخدام المعرف الذي تم تخزينه عند إنشاء عملية الدفع
        $purchase = Purchase::where('payment_intent_id', $paymentIntent->id)->first();

        // التحقق من وجود عملية شراء وليست مكتملة بالفعل
        // هذا الشرط يمنع تحديث الدورة مرتين إذا تم استقبال الـ Webhook أكثر من مرة
        if ($purchase && $purchase->status !== 'completed') {
            // بدء معاملة قاعدة بيانات (Database Transaction)
            // هذا يضمن أن جميع العمليات تتم بنجاح أو يتم التراجع عنها جميعاً
            DB::transaction(function () use ($purchase) {
                // تحديث حالة عملية الشراء إلى "مكتملة"
                // وتسجيل وقت الدفع الفعلي
                $purchase->update([
                    'status' => 'completed',    // تغيير الحالة إلى مكتملة
                    'paid_at' => now()          // تسجيل وقت الدفع الحالي
                ]);

                // تسجيل معلومة في السجلات بنجاح إكمال عملية الشراء
                // يتم تسجيل معلومات مفيدة للمتابعة والتحليل
                Log::info('Purchase completed successfully', [
                    'purchase_id' => $purchase->id,        // معرف عملية الشراء
                    'user_id' => $purchase->user_id,       // معرف المستخدم
                    'course_id' => $purchase->course_id    // معرف الدورة
                ]);
            });
        }
    }

    /**
     * دالة خاصة لمعالجة حدث فشل الدفع
     * 
     * @param object $paymentIntent - كائن الـ PaymentIntent من Stripe
     */
    private function handlePaymentFailed($paymentIntent)
    {
        // تسجيل تحذير في السجلات بأن الدفع فشل
        Log::warning('Payment failed', ['payment_intent_id' => $paymentIntent->id]);

        // البحث عن عملية الشراء المرتبطة بهذا الـ payment_intent_id
        $purchase = Purchase::where('payment_intent_id', $paymentIntent->id)->first();

        // إذا وجدت عملية شراء
        if ($purchase) {
            // تحديث حالة عملية الشراء إلى "فاشلة"
            $purchase->update(['status' => 'failed']);
            
            // تسجيل تحذير في السجلات بوضع علامة على عملية الشراء كفاشلة
            Log::warning('Purchase marked as failed', ['purchase_id' => $purchase->id]);
        }
    }

    /**
     * دالة خاصة لمعالجة حدث إلغاء الدفع
     * 
     * @param object $paymentIntent - كائن الـ PaymentIntent من Stripe
     */
    private function handlePaymentCanceled($paymentIntent)
    {
        // تسجيل معلومة في السجلات بأن الدفع تم إلغاؤه
        Log::info('Payment canceled', ['payment_intent_id' => $paymentIntent->id]);

        // البحث عن عملية الشراء المرتبطة بهذا الـ payment_intent_id
        $purchase = Purchase::where('payment_intent_id', $paymentIntent->id)->first();

        // إذا وجدت عملية شراء
        if ($purchase) {
            // تحديث حالة عملية الشراء إلى "فاشلة"
            $purchase->update(['status' => 'failed']);
            
            // تسجيل معلومة في السجلات بوضع علامة على عملية الشراء كملغاة
            Log::info('Purchase marked as canceled', ['purchase_id' => $purchase->id]);
        }
    }
}