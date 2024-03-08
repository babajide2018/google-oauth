<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    //


    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
{
    try {
        // Retrieve user data from Google
        $user = Socialite::driver('google')->user();

        // Log the user data for debugging
        Log::info('Google User Data: ' . json_encode($user));

        // Get the user's email address
        $userEmail = $user->getEmail();

        // Check if OTP is expired or not present
        if (!$this->isOtpValid()) {
            // Generate new OTP
            $otp = $this->generateOTP();

            // Set OTP and expiration timestamp in the session
            Session::flash('otp', $otp);
            Session::flash('otp_expires_at', now()->addSeconds(30)); // 30 seconds expiration
        }

        // Flash the user's email to the session for display
        Session::flash('user_email', $userEmail);

        // Redirect back to the home page or any other route
        return redirect('/')->with('success', 'Authentication successful.');
    } catch (\Exception $e) {
        // Log the error for debugging
        Log::error('Error during Google authentication: ' . $e->getMessage());

        return redirect('/')->with('error', 'Error during Google authentication.');
    }
}

private function isOtpValid()
{
    $expiresAt = Session::get('otp_expires_at');

    // Check if OTP exists and has not expired
    return Session::has('otp') && $expiresAt && now()->lt($expiresAt);
}

private function generateOTP()
{
    // Implement your OTP generation logic here
    return mt_rand(100000, 999999);
}
}
