<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <p>Hello,</p>
    <p>Click the link below to verify your email address:</p>
    <a href="{{ url('/email/verify/' . $email) }}">Verify Email</a>
</body>
</html>
