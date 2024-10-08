<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RemitaPaymentController2 extends Controller
{
    public function showPaymentForm()
    {
        return view('payment.initiate');
    }

    public function initiatePayment(Request $request)
    {
        // Example amount input (replace with your actual input method)
        $totalAmount = $request->input('amount'); // Replace with your dynamic amount input logic
        $orderId = uniqid(); // Generate a unique order ID
//https://demo.remita.net/
        $url = 'https://login.remita.net/remita/exapp/api/v1/send/api/echannelsvc/merchant/api/paymentinit';
        $data = [              
            'serviceTypeId' => '518669126',
            'amount' => $totalAmount,
            'orderId' => $orderId,
            'payerName' => $request->input('payer_name'),
            'payerEmail' => $request->input('payer_email'),
            'payerPhone' => $request->input('payer_phone'),
            'description' => 'Payment of Fees'
        ];

        // Replace with your actual merchantId, apiKey, and other values
        $merchantId = 5177294551;
        $apiKey = 397541;

        // Calculate the hash value based on API requirements (SHA-512 encryption)
        $concatenatedString = $merchantId . $data['serviceTypeId'] . $data['orderId'] . $data['amount'] . $apiKey;
        $apiHash = hash('sha512', $concatenatedString);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'remitaConsumerKey=' . $merchantId . ',remitaConsumerToken=' . $apiHash,
        ])->post($url, $data);

        if ($response->failed()) {
            return 'Error: ' . $response->body();
        }

        $responseData = $response->json(); // Assuming Remita API returns JSON response
        $rrr = $responseData['RRR'] ?? null;

        return view('payment.pay-now', compact('rrr', 'totalAmount'));
    }
    
    
       // Method to display the form
    public function showForm()
    {
        return view('payment.check-rrr-status');
    }

    // Method to check RRR status
    public function checkrrrstatus(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'rrr' => 'required|string',
        ]);

        // Replace with your actual merchantId and apiKey
        $merchantId = 5177294551;
        $apiKey = '397541'; // Replace with your actual apiKey

        // Example RRR input (from the form)
        $rrr = $request->input('rrr'); 

        // Calculate the hash value based on API requirements (SHA-512 encryption)
        //rrr + apiKey + merchantId
        $concatenatedString = $rrr . $apiKey . $merchantId;
        $apiHash = hash('sha512', $concatenatedString);
//https://demo.remita.net
        // Construct the URL
        $url = 'https://login.remita.net/remita/exapp/api/v1/send/api/echannelsvc/' . $merchantId . '/' . $rrr . '/' . $apiHash . '/status.reg';

        // Make the HTTP GET request to check the RRR status
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'remitaConsumerKey=' . $merchantId . ',remitaConsumerToken=' . $apiHash,
        ])->get($url);

        // Check if the response failed
        if ($response->failed()) {
            return response()->json(['error' => 'Failed to check RRR status.'], 500);
        }

        // Decode the JSON response
        $responseData = $response->json();

        // Check for status codes '00' and '01' to denote successful transactions
        if (isset($responseData['status']) && in_array($responseData['status'], ['00', '01'])) {
            $status = 'Successful';
        } else {
            $status = 'Failed';
        }

        // Pass the status and other details to the view
        return view('payment.check-rrr-status', [
            'rrr' => $responseData['RRR'] ?? null,
            'amount' => $responseData['amount'] ?? null,
            'orderId' => $responseData['orderId'] ?? null,
            'message' => $responseData['message'] ?? null,
            'paymentDate' => $responseData['paymentDate'] ?? null,
            'transactionTime' => $responseData['transactiontime'] ?? null,
            'status' => $status,
        ]);
    }
    
    
    
}
