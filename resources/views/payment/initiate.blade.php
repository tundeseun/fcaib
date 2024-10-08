<!-- resources/views/payment/initiate.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Initiate Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h2>Initiate Payment</h2>
    <form method="POST" action="{{ route('initiate.payment') }}">
        @csrf
        <label for="amount">Amount:</label><br>
        <input type="text" id="amount" name="amount" value="1000"><br><br>

        <label for="payer_name">Payer Name:</label><br>
        <input type="text" id="payer_name" name="payer_name" value="John Doe"><br><br>

        <label for="payer_email">Payer Email:</label><br>
        <input type="email" id="payer_email" name="payer_email" value="doe@gmail.com"><br><br>

        <label for="payer_phone">Payer Phone:</label><br>
        <input type="text" id="payer_phone" name="payer_phone" value="09062067384"><br><br>

        <button type="submit">Initiate Payment</button>
    </form>
</body>
</html>
