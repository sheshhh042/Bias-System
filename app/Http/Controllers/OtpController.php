<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OtpController extends Controller
{
    public function showOtpForm()
    {
        return view('auth.otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'No user found with this email.']);
        }

        if ($user->otp === $request->otp && Carbon::now()->lessThanOrEqualTo($user->otp_expires_at)) {
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();

            Auth::login($user);

            return redirect()->route('dashboard')->with('success', 'OTP verified successfully.');
        }

        return redirect()->back()->withErrors(['otp' => 'Invalid or expired OTP.']);
    }
}