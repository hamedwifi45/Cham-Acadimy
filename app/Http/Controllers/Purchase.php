<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;

class Purchase extends Controller
{
    public function creditCheckout(Request $request , Course $course)
    {
        $intent = auth()->user()->createSetupIntent();
       
        $userId = auth()->user()->id;

        $total = $course->price;
        auth()->user()->Courses->where('status' , 'pending')->delete();
        DB::table('purchases')->insert([
            'user_id' => $userId,
            'course_id' => $course->id,
            'price' => $total,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return view('credit.checkout', compact('total', 'intent' , 'course'));
    }

    public function purchase(Request $request)
    {
        $user          = $request->user();
        $paymentMethod = $request->input('payment_method');

        $userId = auth()->user()->id;
        // $books = User::find($userId)->booksInCart;
        
        $total = $user->Courses->where('status' , 'pending')->sum('price');
        // foreach($books as $book) {
        //     $total += $book->price * $book->pivot->number_of_copies;
        // }


        try {
            Stripe::setApiKey(config('cashier.secret'));

            $user->createOrGetStripeCustomer();

            $intent = PaymentIntent::create([
                'amount' => $total * 100,
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
        } catch (\Exception $exception) {
            return back()->with('error', 'حصل خطأ أثناء شراء المنتج، الرجاء التأكد منمعلومات البطاقة' . $exception->getMessage());
        }
        // $this->sendOrderConfirmationMail($books, auth()->user());

        $user->Courses->where('status' , 'pending')->update(['status' => 'completed']);

        // foreach($books as $book) {
        //     $bookPrice = $book->price;
        //     $purchaseTime = Carbon::now();
        //     $user->booksInCart()->updateExistingPivot($book->id, ['bought' => TRUE, 'price' => $bookPrice, 'created_at' => $purchaseTime]);
        //     $book->save();
        // }

        return redirect()->route('courses.mycourse')->with('message', 'تم شراء المنتج بنجاح');
    }

}
