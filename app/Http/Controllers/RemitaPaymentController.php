<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RemitaPaymentController extends Controller
{
    public function generateRrr(Request $request)
    {
        // Example amount input (replace with your actual input method)
        $totalAmount = $request->input('amount'); // Replace with your dynamic amount input logic
        $feesAssignedId = $request->input('fees_assigned_id');
        //  $remita_service_id = $request->input('remita_service_id');
         $remita_service_id = $request->input('remita_service_id');
          $payername = $request->input('payername');
           $payeremail = $request->input('payeremail');
            $decription = $request->input('description');
        $orderId = uniqid(); // Generate a unique order ID

        // Your logic to generate RRR from Remita API
        $url = 'https://login.remita.net/remita/exapp/api/v1/send/api/echannelsvc/merchant/api/paymentinit';
        $data = [
            'serviceTypeId' => $remita_service_id,
            'amount' => $totalAmount,
            'orderId' => $orderId,
            'payerName' => $payername,
            'payerEmail' => $payeremail,
            // 'payerPhone' => '09062067384',
            'description' => $decription
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
            return response()->json(['error' => 'Failed to generate RRR.']);
        }

        //$responseData = $response->json(); // Assuming Remita API returns JSON response
        ////RR = $responseData['RRR']; // Extract RRR from Remita API response
        
              
                     // Strip 'jsonp(' prefix and trailing ')'
                    $jsonStr = substr($response->body(), 6, -1);
                 
                    // Remove JSONP padding to get the JSON string
                    $jsonString = trim($jsonStr, '()');

                    // Decode the JSON string to an associative array
                    $responseArray = json_decode($jsonString, true);

                    // Initialize RRR variable
                    $rrr = 'Not available';

                    // Check if the response was decoded successfully
                    if ($responseArray !== null && isset($responseArray['RRR'])) {
                        // Extract the RRR value
                        $rrr = $responseArray['RRR'];
                    }
                    

        return response()->json(['RRR' => $rrr, 'amount' => $totalAmount]);
    }

    public function paymentDetails(Request $request)
    {
        $RRR = $request->query('RRR');
        $amount = $request->query('amount');

        return view('payment.payment-details', compact('RRR', 'amount'));
    }
}
