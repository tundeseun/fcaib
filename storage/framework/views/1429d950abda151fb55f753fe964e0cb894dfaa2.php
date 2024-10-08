<?php $__env->startSection('title'); ?>
    Payment Details
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>

<style>
    .payment-container {
        margin-top: 30px;
    }
    .card-header {
        background-color: #001f3f; /* Navy blue */
        color: white;
        font-size: 1.25rem;
        text-align: center;
    }
    .card-body {
        padding: 20px;
        font-size: 1rem;
    }
    .payment-info p {
        font-size: 1.1rem;
        font-weight: bold;
        color: #001f3f;
    }
    .payment-info span {
        font-size: 1.2rem;
        font-weight: bold;
    }
    .payment-button {
        background-color: #001f3f; /* Navy blue */
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 1.1rem;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .payment-button:hover {
        background-color: #001a35; /* Darker navy blue */
    }
    .payment-instructions {
        font-size: 0.9rem;
        color: #555;
        margin-top: 10px;
    }
</style>

<div class="container payment-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Payment Details</div>
                <div class="card-body">
                    <div class="payment-info">
                        <p>RRR: <span><?php echo e($RRR); ?></span></p>
                        <p>Amount Payable: <span>&#8358;<?php echo e(number_format($amount, 2)); ?></span></p>
                    </div>

                    <div class="payment-instructions">
                        <p>Please follow the instructions below to complete your payment:</p>
                        <ul>
                            <li>Click the "Pay Now" button to proceed with your payment.</li>
                            <li>You will be redirected to a secure payment page.</li>
                            <li>Ensure that you complete the payment process to avoid transaction issues.</li>
                        </ul>
                    </div>
                    
                    <form id="payment-form">
                        <input type="hidden" id="rrr" name="rrr" value="<?php echo e($RRR); ?>">
                        <button type="button" onclick="makePayment()" class="payment-button">Pay Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<script type="text/javascript" src="https://login.remita.net/payment/v1/remita-pay-inline.bundle.js"></script>


<script>
    function getUrlParameter(name) {
        name = name.replace(/[\[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(window.location.href);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }

    function makePayment() {
        var transactionId = 'txn_' + new Date().getTime() + '_' + Math.floor(Math.random() * 1000);
        var paymentEngine = RmPaymentEngine.init({
            key: "RkNBSUJBREFOfDUxNzcyOTQ1NTF8ZGMxNzFiYmUyZGZlMDRhNTRiODAwODRiNTg3YTVjOTBmYjQ3ZTUzZWViOThkOWJjZTkzM2VmMGRlOTlkNWRiZjZiN2EyYzA2NDg0ZWE5OTcyYmIyNWFjMjQ1ZmUyZWM1MzYxMzNiNzQzNDNiNmVmZDU5Yjg0NTM4ZjVhZDZkMTE=",
            processRrr: true,
            transactionId: transactionId,
            channel: "",
            extendedData: {
                customFields: [
                    {
                        name: "rrr",
                        value: document.getElementById('rrr').value
                    }
                ]
            },
            onSuccess: function (response) {
                console.log('callback Successful Response', response);

                var user_id = getUrlParameter('user_id');
                var fees_type_id = getUrlParameter('fees_type_id');
                var data = {
                    amount: response.amount,
                    payment_date: new Date().toISOString().slice(0, 19).replace('T', ' '),
                    payment_mode: "REMITA", // Fixed value for payment mode
                    created_at: new Date().toISOString().slice(0, 19).replace('T', ' '),
                    updated_at: new Date().toISOString().slice(0, 19).replace('T', ' '),
                    student_id: user_id,
                    fees_type_id: fees_type_id,
                    payment_reference: response.paymentReference,
                    transaction_id: response.transactionId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                };

                console.log('Sending data to server:', data);

                $.ajax({
                    url: '/save-response/' + user_id + '/' + fees_type_id,
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        console.log('Response saved successfully', response);
                        window.location.href = '/payment-success/' + response.payment_id;
                    },
                    error: function(xhr, status, error) {
                        console.log('Error saving response', xhr.responseText);
                    }
                });
            },
            onError: function (response) {
                console.log('callback Error Response', response);
            },
            onClose: function () {
                console.log("closed");
            }
        });
        paymentEngine.showPaymentWidget();
    }
</script>






<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/fcaibedu/public_html/portal/resources/views/payment/payment-details.blade.php ENDPATH**/ ?>