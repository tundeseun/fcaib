<?php

namespace App\Services\Remita;

use DB;
use App\Services\Service;
use Illuminate\Http\Request;

class Remita extends Service {

    protected $accessToken           = null;
    protected $accessTokenExpiredAt  = null;
    protected $hasActiveAccessToken  = null;

    public function __construct()
    {

        $this->config = [
            'baseUrl'       => \config('remita.base_url'),
            'username'      => \config('remita.username'),
            'password'      => \config('remita.password'),
            'key'           => \config('remita.key'),
            'secret'        => \config('remita.secret'),
            'billerId'      => \config('remita.biller_id'),
            'merchantId'    => \config('remita.merchant_id'),
            'apiKey'        => \config('remita.api_key'),
        ];

        $this->authenticate();
    }

    protected function baseUri()
    {
        return config('remita.base_url');
    }

    private function authenticate()
    {
        $curl = curl_init();
		curl_setopt_array($curl, [
		    CURLOPT_URL => $this->config['baseUrl'] . '/uaasvc/uaa/token',
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_CUSTOMREQUEST=> "POST",
		    CURLOPT_POSTFIELDS => json_encode([
                'username'   => $this->config['username'],
                'password'   => $this->config['password'],
			]),
		    CURLOPT_HTTPHEADER => [
				"Accept: application/json",
		        "Content-Type: application/json",
		        "Authorization: Bearer ".$this->config['key']
		    ],
		]);


        $response = curl_exec($curl);

        $this->setAccessToken(json_decode($response));

        curl_close($curl);

    }

    public function setAccessToken($response)
    {
        $data               = $response->data[0];
        $this->accessToken  = $data->accessToken;
    }

    public function get_state($state, $type = 'TAX'){
        
        $curl = curl_init();
		curl_setopt_array($curl, array(
            CURLOPT_URL => $this->config['baseUrl'].'/schedulesvc/schedule-delivery/request/codes/'.$type,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$this->config['key']
            ),
		));

        $response = curl_exec($curl);
		curl_close($curl);
		$response = json_decode($response, true);
		return $response['responseData'];
    }



    public static function payTax($data)
    {
        $_this = new self;
        $curl = curl_init();
		curl_setopt_array($curl, [
		    CURLOPT_URL => $_this->config['baseUrl'] . '/schedulesvc/schedule-delivery/request/genrrr',
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_CUSTOMREQUEST=> "POST",
		    CURLOPT_POSTFIELDS => json_encode($data),
		    CURLOPT_HTTPHEADER => [
				"Accept: application/json",
		        "Content-Type: application/json",
		        "Authorization: Bearer ".$_this->config['key'],
                "API_TOKEN: ".$_this->accessToken,
                "publicKey: ".$_this->config['key'],
                "API_KEY: ".$_this->config['secret'],
                "REQUEST_ID: ".$data['requestId'],
		    ],
		]);


        $response = curl_exec($curl);

    }

    public static function checkStatus($transactionId)
    {
        $_this = new self;
        $data  = hash('sha512', $transactionId.$_this->config['secret']);
        $url   = 'https://demo.remita.net/payment/v1/payment/query/'.$transactionId;
        $curl = curl_init();
		curl_setopt_array($curl, [
		    CURLOPT_URL => $url,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_CUSTOMREQUEST=> "GET",
		    CURLOPT_HTTPHEADER => [
		        "Content-Type: application/json",
                "publicKey: ".$_this->config['key'],
                "TXN_HASH: ".$data,
		    ],
		]);


        $response = json_decode(curl_exec($curl));

        return $response->responseData;

    }

    public static function getBillerServices()
    {
        $_this = new self;
        $url   = $_this->config['baseUrl'].'/bgatesvc/v3/billpayment/biller/QATEST/products';
        //$url   = $_this->config['baseUrl'].'/bgatesvc/v3/billpayment/biller/'.$_this->config['billerId'].'/products';
        $curl = curl_init();
		curl_setopt_array($curl, [
		    CURLOPT_URL => $url,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_CUSTOMREQUEST=> "GET",
		    CURLOPT_HTTPHEADER => [
                "Accept: application/json",
		        "Content-Type: application/json",
		        "Authorization: Bearer ".$_this->accessToken,
                "publicKey:".$_this->config['key'],
		    ],
		]);

        $response = json_decode(curl_exec($curl));

        return $response;
    }

    public static function getBillers()
    {
        $_this = new self;
        $url   = $_this->config['baseUrl'].'/bgatesvc/v3/billpayment/billers';
        $curl = curl_init();
		curl_setopt_array($curl, [
		    CURLOPT_URL => $url,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_CUSTOMREQUEST=> "GET",
		    CURLOPT_HTTPHEADER => [
                "Accept: application/json",
		        "Content-Type: application/json",
		        "Authorization: Bearer ".$_this->accessToken
		    ],
		]);

        $response = json_decode(curl_exec($curl));

        return $response;
    }

    public static function getStaticBillerServices($id = null)
    {

        $services = [
            "518640044" => "STAFF QUARTER RENTAGE",
            "518640394" => "RENTAL OF ACADEMIC GOWN",
            "518669126" => "STUDENTS REGISTRATION FEE",
            "518669763" => "TRANSCRIPTS",
            "518668694" => "SHOP RENTAGE",
            "518680305" => "TENDER FEES",
            "518640217" => "STUDENTS ACCOMMODATION FEES",
            "351701308" => "FEDERAL COLLEGE OF AGRICULTURE MOORE PLANTATION  FEES",
            "9995176487" => "Hostel Maintenance Charges",
            "9995179616" => "Medical Screening",
            "9995173082" => "Acceptance Fees",
            "9995234884" => "Certificate",
            "9994806037" => "Application & Post UTME",
        ];

        return $id ? $services[$id] : $services;
    }

    public static function generateRRR($serviceTypeId, $amount, $name, $email, $phoneNumber){
        $_this = new self;
        $orderId = time();
        //apiHash is SHA-512 encryption of concatenating merchantId + serviceTypeId + orderId+ totalAmount + apiKey
        $apiHash = hash('sha512', $_this->config['merchantId'].$serviceTypeId.$orderId.$amount.$_this->config['apiKey']);
        $curl = curl_init();
		curl_setopt_array($curl, [
		    CURLOPT_URL => $_this->config['baseUrl'] . '/echannelsvc/merchant/api/paymentinit',
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_CUSTOMREQUEST=> "POST",
		    CURLOPT_POSTFIELDS => json_encode([
                "serviceTypeId" => $serviceTypeId,
                "orderId" => $orderId,
                "amount" => $amount,
                "payerPhone" => $phoneNumber,
                "payerName" => $name,
                "payerEmail" => $email,
                "description" => "Payment for ".$_this->getStaticBillerServices($serviceTypeId)
            ]),
		    CURLOPT_HTTPHEADER => [
		        "Accept: application/json",
                "Content-Type: application/json",
		        "Authorization: remitaConsumerKey={$_this->config['merchantId']},remitaConsumerToken={$apiHash}",
		    ],
		]);

        $response = curl_exec($curl);
        return $response;
    }
}