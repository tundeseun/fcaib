<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RRR Status Check</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">RRR Status Check</h1>
        <form action="{{ route('check-rrr-status') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="rrr">Enter RRR:</label>
                <input type="text" class="form-control" id="rrr" name="rrr" required>
            </div>
            <button type="submit" class="btn btn-primary">Check Status</button>
        </form>
        
        @if(isset($status))
            <div class="alert alert-{{ $status == 'Successful' ? 'success' : 'danger' }} mt-4">
                <strong>Status:</strong> {{ $status }}
            </div>
            <ul class="list-group mt-3">
                <li class="list-group-item"><strong>RRR:</strong> {{ $rrr }}</li>
                <li class="list-group-item"><strong>Amount:</strong> {{ $amount }}</li>
                <li class="list-group-item"><strong>Order ID:</strong> {{ $orderId }}</li>
                <li class="list-group-item"><strong>Message:</strong> {{ $message }}</li>
                <li class="list-group-item"><strong>Payment Date:</strong> {{ $paymentDate }}</li>
                <li class="list-group-item"><strong>Transaction Time:</strong> {{ $transactionTime }}</li>
            </ul>
        @else
            <div class="alert alert-warning mt-4">
                <strong>No status available. Please try again.</strong>
            </div>
        @endif
    </div>
</body>
</html>
