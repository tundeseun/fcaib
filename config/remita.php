<?php

return [
    'base_url' => env('REMITA') === 'demo' 
        ? env('REMITA_DEMO_URL', 'remitademo.net/remita/exapp/api/v1/send/api') 
        : env('REMITA_LIVE_URL', 'remitademo.net/remita/exapp/api/v1/send/api'),
    'key' => env('REMITA_KEY', 'RkNBSUJBREFOfDUxNzcyOTQ1NTF8ZGMxNzFiYmUyZGZlMDRhNTRiODAwODRiNTg3YTVjOTBmYjQ3ZTUzZWViOThkOWJjZTkzM2VmMGRlOTlkNWRiZjZiN2EyYzA2NDg0ZWE5OTcyYmIyNWFjMjQ1ZmUyZWM1MzYxMzNiNzQzNDNiNmVmZDU5Yjg0NTM4ZjVhZDZkMTE='),
    'secret' => env('REMITA_SECRET', '23093b2bda801eece94fc6e8363c05fad90a4ba3e12045005141b0bab41704b3a148904529239afd1c9a3880d51b4018d13fd626b2cef77a6f858fe854834e54'),
    'username' => env('REMITA_USERNAME', 'UHSU6ZIMAVXNZHXW'),
    'password' => env('REMITA_PASSWORD', 'K8JE73OFE508GMOW9VWLX5SLH5QG1PF2'),
    'biller_id' => env('REMITA_BILLER_ID', '0215022001'),
    'merchant_id' => env('REMITA_MERCHANT_ID', '5177294551'),
    'api_key' => env('REMITA_API_KEY', '397541')
];
