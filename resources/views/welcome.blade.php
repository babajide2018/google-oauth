<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google OTP Test</title>
</head>

    
<body>
@if (Session::has('otp'))
    <p>OTP: {{ Session::get('otp') }}</p>
@endif

@if (session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<a href="{{ url('/auth/google') }}">Sign In with Google</a>
</body>
</html>