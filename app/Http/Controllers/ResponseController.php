<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SmFeesPayment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ResponseController extends Controller
{
    public function store(Request $request, $user_id, $fees_type_id)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'payment_reference' => 'required|string',
            'transaction_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            Log::error('Validation error:', $validator->errors()->toArray());
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            // Log the incoming request data for debugging
            Log::info('Incoming payment data:', $request->all());

            // Create a new response record
            $response = SmFeesPayment::create([
                'amount' => $request->input('amount'),
                'payment_mode' => "REMITA",
                'payment_reference' => $request->input('payment_reference'),
                'transaction_id' => $request->input('transaction_id'),
                'payment_date' => now(),
                'student_id' => $user_id,
                'fees_type_id' => $fees_type_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json(['success' => 'Response saved successfully', 'payment_id' => $response->id]);
        } catch (\Exception $e) {
            Log::error('Error saving payment data: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function paymentSuccess($payment_id)
    {
        $payment = SmFeesPayment::findOrFail($payment_id);
        return view('payment.success', compact('payment'));
    }
}
