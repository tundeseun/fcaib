<!-- resources/views/payment/pay-now.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Remita Regular Invoice Processing Sample</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .button {
            background-color: #1CA78B;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
        input {
            max-width: 30%;
        }
    </style>
</head>
<body>
    <div class="container mt-3">
        <h2>Remita Regular Invoice Processing Demo</h2>
        <p>Try out our Payment Gateway</p>
        <p>RRR:{{ $rrr }}</p>
        <form onsubmit="makePayment()" id="payment-form">
            <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control" id="rrr" placeholder="Enter RRR" name="rrr" value="{{ $rrr }}">
                <label for="rrr">Payment Reference (RRR)</label>
            </div>
            <button type="button" onclick="makePayment()" class="button">Pay Now</button>
        </form>
    </div>

    <script type="text/javascript" src="https://login.remita.net/payment/v1/remita-pay-inline.bundle.js"></script>
    <script>
        function makePayment() {
            var transactionId = 'txn_' + new Date().getTime() + '_' + Math.floor(Math.random() * 1000);
            var paymentEngine = RmPaymentEngine.init({
                key: "RkNBSUJBREFOfDUxNzcyOTQ1NTF8ZGMxNzFiYmUyZGZlMDRhNTRiODAwODRiNTg3YTVjOTBmYjQ3ZTUzZWViOThkOWJjZTkzM2VmMGRlOTlkNWRiZjZiN2EyYzA2NDg0ZWE5OTcyYmIyNWFjMjQ1ZmUyZWM1MzYxMzNiNzQzNDNiNmVmZDU5Yjg0NTM4ZjVhZDZkMTE=",
                processRrr: true,
                transactionId: transactionId, // Use the unique transactionId
                channel: "", // Specify the payment channels you want to enable
                extendedData: {
                    customFields: [
                        {
                            name: "rrr",
                            value: document.getElementById('rrr').value // Use the RRR value
                        }
                    ]
                },
                onSuccess: function (response) {
                    console.log('callback Successful Response', response);
                    // Handle success response
                },
                onError: function (response) {
                    console.log('callback Error Response', response);
                    // Handle error response
                },
                onClose: function () {
                    console.log("closed");
                }
            });
            paymentEngine.showPaymentWidget();
        }
    </script>
</body>
</html>
