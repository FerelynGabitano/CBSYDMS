<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Your Account Credentials</title>
</head>
<body>
    <h2>Hello {{ $email }},</h2>
    <p>Your account credentials for Batang Surigaonon Youth have been created/updated:</p>

    <ul>
        <li><strong>Login Email:</strong> {{ $credential_email }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
        <li><strong>Role:</strong> {{ $role_name }}</li>
    </ul>

    <p>You can now log in here: <a href="{{ url('/login') }}">{{ url('/login') }}</a></p>

    <br>
    <p>Best regards,<br><strong>Batang Surigaonon Youth Admin</strong></p>
</body>
</html>
