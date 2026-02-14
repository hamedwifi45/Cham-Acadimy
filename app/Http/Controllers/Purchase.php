<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\Checkout\Session;




class Purchase extends Controller
{

    public function creditCheckout(Request $request , Course $course)
    {
        $intent = auth()->user()->createSetupIntent();
       
        $userId = auth()->user()->id;

        $total = $course->price;
        // حذف المشتريات المعلقة السابقة
        DB::table('purchases')
            ->where('user_id', $userId)
            ->where('status', 'pending')
            ->delete();
        
        // إدخال عملية شراء جديدة
        DB::table('purchases')->insert([
            'user_id' => $userId,
            'course_id' => $course->id,
            'amount' => $total,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
       
        return view('credit.checkout', compact('total', 'intent' , 'course'));
    }

    public function purchase(Request $request)
    {
    $user = $request->user();
    $paymentMethod = $request->input('payment_method');

    // احصل على إجمالي المبلغ من قاعدة البيانات بدلاً من العلاقة
    $pendingPurchase = DB::table('purchases')
        ->where('user_id', $user->id)
        ->where('status', 'pending')
        ->first();

    if (!$pendingPurchase) {
        return back()->with('error', 'لم يتم العثور على عملية شراء معلقة');
    }

    $total = $pendingPurchase->amount;
    $courseId = $pendingPurchase->course_id;

    try {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $user->createOrGetStripeCustomer();

        $intent = PaymentIntent::create([
            'amount' => $total * 100, // تحويل إلى سنتات
            'currency' => 'usd',
            'customer' => $user->stripe_id,
            'payment_method' => $paymentMethod,
            'off_session' => true,
            
            'confirm' => true,
            'automatic_payment_methods' => [
                'enabled' => true,
                'allow_redirects' => 'never',
            ],
        ]);

        // التحقق من نجاح الدفع
        if ($intent->status === 'succeeded') {
            // تحديث حالة الشراء في قاعدة البيانات
            DB::table('purchases')
                ->where('user_id', $user->id)
                ->where('course_id', $courseId)
                ->where('status', 'pending')
                ->update([
                    'status' => 'completed',
                    'paid_at' => now(),
                    'payment_intent_id' => $intent->id,
                    'updated_at' => now()
                ]);

            return redirect()->route('courses.mycourse')
                ->with('message', 'تم شراء الدورة بنجاح');
        } else {
            // الدفع لم ينجح
            return back()->with('error', 'فشل عملية الدفع. الرجاء المحاولة مرة أخرى.');
        }

    } catch (\Stripe\Exception\CardException $e) {
        return back()->with('error', 'خطأ في البطاقة: ' . $e->getError()->message);
    } catch (\Stripe\Exception\RateLimitException $e) {
        return back()->with('error', 'تم تجاوز حد المعدل. الرجاء المحاولة لاحقاً.');
    } catch (\Stripe\Exception\InvalidRequestException $e) {
        return back()->with('error', 'طلب غير صالح: ' . $e->getMessage());
    } catch (\Stripe\Exception\AuthenticationException $e) {
        return back()->with('error', 'خطأ في المصادقة مع Stripe.');
    } catch (\Stripe\Exception\ApiConnectionException $e) {
        return back()->with('error', 'فشل الاتصال بـ Stripe. الرجاء المحاولة لاحقاً.');
    } catch (\Stripe\Exception\ApiErrorException $e) {
        return back()->with('error', 'خطأ من API: ' . $e->getMessage());
    } catch (\Exception $e) {
        return back()->with('error', 'حصل خطأ أثناء معالجة الدفع: ' . $e->getMessage());
    }
}

}
