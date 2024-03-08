@if (Session::has('otp'))
<p>OTP: {{ Session::get('otp') }}</p>
@endif




@if (session('success'))
<p style="color: green;">{{ session('success') }}</p>
@if (Session::has('user_email'))
<p>Email: {{ Session::get('user_email') }}</p>
@endif
@if (session('error'))
<p style="color: red;">{{ session('error') }}</p>
@endif

@endif