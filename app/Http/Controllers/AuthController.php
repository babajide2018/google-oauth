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

           // dd('hello');
            // Retrieve user data from Google
            $user = Socialite::driver('google')->user();

            // Log the user data for debugging
            \Log::info('Google User Data:', $user->toArray());

            // Generate OTP
            $otp = $this->generateOTP();

            // Flash the OTP to the session for one-time display
            \Session::flash('otp', $otp);

            // Redirect back to the home page or any other route
            return redirect('/')->with('success', 'Authentication successful.');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error during Google authentication: ' . $e->getMessage());

            return redirect('/')->with('error', 'Error during Google authentication.');
        }
    }

  
    private function generateOTP()
    {
        // Implement your OTP generation logic here
        // You can use a package like OTPHP for generating OTPs
        // Example: https://github.com/lelag/otphp
    }
}
