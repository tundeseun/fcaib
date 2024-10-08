<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SmFeesPayment;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function saveResponse($user_id, Request $request)
    {
        try {
            $payment = SmFeesPayment::create([
                'amount' => $request->amount,
                'payment_date' => now(),
                'payment_mode' => $request->payment_mode,
                'created_at' => now(),
                'updated_at' => now(),
                'student_id' => $user_id,
                //'fee_type_id' => $request->fee_type_id,
                'payment_reference' => $request->payment_reference,
                'transaction_id' => $request->transaction_id,
            ]);

            return response()->json(['success' => true, 'payment_id' => $payment->id]);
        } catch (\Exception $e) {
            Log::error('Payment save error: ' . $e->getMessage());
            return response()->json(['success' => false]);
        }
    }

    public function showSuccessPage($paymentId)
    {
        // Retrieve payment information based on the payment ID
        $payment = SmFeesPayment::findOrFail($paymentId);
        return view('payment.success', compact('payment'));
    }
}
