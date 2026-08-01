<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class ForgotPassController extends Controller
{
    // Show forgot password page
    public function showForgotPasswordForm()
    {
        return view('product.Forgot_password');
    }

    // Step 1: Validate mobile from admins table + generate OTP
    public function sendOtp(Request $request)
    {
        $validated = $request->validate([
            'mobile' => ['required', 'digits:10'],
        ], [
            'mobile.required' => 'મોબાઇલ નંબર દાખલ કરો.',
            'mobile.digits'   => 'માન્ય 10 અંકનો મોબાઇલ નંબર દાખલ કરો.',
        ]);

        $admin = Admin::where('mobile', $validated['mobile'])->first();

        if (!$admin) {
            return response()->json([
                'status'  => false,
                'message' => 'આ મોબાઇલ નંબર સાથે કોઈ એકાઉન્ટ મળ્યું નથી.',
            ], 404);
        }

        if (!$admin->email) {
            return response()->json([
                'status'  => false,
                'message' => 'આ એકાઉન્ટ પર ઇમેઇલ સેટ નથી. કૃપા કરીને એડમિનનો સંપર્ક કરો.',
            ], 422);
        }

        $otp = rand(1000, 9999);

        $admin->update([
            'otp'            => $otp,
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        Mail::to($admin->email)->send(new OtpMail($otp));

        session([
            'reset_mobile'   => $admin->mobile,
            'reset_admin_id' => $admin->id,
            'otp_verified'   => false,
        ]);

        return response()->json([
            'status'   => true,
            'message'  => 'OTP તમારા રજિસ્ટર્ડ ઇમેઇલ પર મોકલવામાં આવ્યો છે.',
            'redirect' => route('reset.password.form'),
        ]);
    }

    // Resend OTP
    public function resendOtp(Request $request)
    {
        if (!session()->has('reset_admin_id')) {
            return response()->json([
                'status'  => false,
                'message' => 'સેશન સમાપ્ત થઈ ગયું છે, ફરીથી પ્રયાસ કરો.',
            ], 440);
        }

        $admin = Admin::find(session('reset_admin_id'));

        if (!$admin) {
            return response()->json([
                'status'  => false,
                'message' => 'એકાઉન્ટ મળ્યું નથી.',
            ], 404);
        }

        if (!$admin->email) {
            return response()->json([
                'status'  => false,
                'message' => 'આ એકાઉન્ટ પર ઇમેઇલ સેટ નથી. કૃપા કરીને એડમિનનો સંપર્ક કરો.',
            ], 422);
        }

        $otp = rand(1000, 9999);

        $admin->update([
            'otp'            => $otp,
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        session(['otp_verified' => false]);

        Mail::to($admin->email)->send(new OtpMail($otp));

        return response()->json([
            'status'  => true,
            'message' => 'OTP ફરીથી તમારા ઇમેઇલ પર મોકલવામાં આવ્યો છે.',
        ]);
    }

    // Show reset password page (Step 2)
    public function showResetPasswordForm()
    {
        if (!session()->has('reset_mobile')) {
            return redirect()->route('forgot.password.form');
        }

        $mobile       = session('reset_mobile');
        $maskedMobile = substr($mobile, 0, 2) . str_repeat('X', 5) . substr($mobile, -3);

        return view('product.Reset_password', compact('maskedMobile'));
    }

    // Step 2a: Verify OTP only (before showing PIN fields)
    public function verifyOtp(Request $request)
    {
        if (!session()->has('reset_admin_id')) {
            return response()->json([
                'status'  => false,
                'message' => 'સેશન સમાપ્ત થઈ ગયું છે, ફરીથી પ્રયાસ કરો.',
            ], 440);
        }

        $validated = $request->validate([
            'otp' => ['required', 'digits:4'],
        ], [
            'otp.required' => 'OTP દાખલ કરો.',
            'otp.digits'   => 'OTP 4 અંકનો હોવો જોઈએ.',
        ]);

        $admin = Admin::find(session('reset_admin_id'));

        if (!$admin) {
            return response()->json([
                'status'  => false,
                'message' => 'એકાઉન્ટ મળ્યું નથી.',
            ], 404);
        }

        if (!$admin->otp || !$admin->otp_expires_at || now()->greaterThan($admin->otp_expires_at)) {
            return response()->json([
                'status'  => false,
                'message' => 'OTP સમય સમાપ્ત થઈ ગયો છે, ફરીથી મોકલો.',
            ], 422);
        }

        if ((string) $admin->otp !== $validated['otp']) {
            return response()->json([
                'status'  => false,
                'message' => 'ખોટો OTP દાખલ કરવામાં આવ્યો છે.',
            ], 422);
        }

        session(['otp_verified' => true]);

        return response()->json([
            'status'  => true,
            'message' => 'OTP સફળતાપૂર્વક ચકાસાયો.',
        ]);
    }

    // Step 3: Set new PIN (only allowed after OTP is verified)
    public function resetPassword(Request $request)
    {
        if (!session()->has('reset_admin_id')) {
            return response()->json([
                'status'  => false,
                'message' => 'સેશન સમાપ્ત થઈ ગયું છે, ફરીથી પ્રયાસ કરો.',
            ], 440);
        }

        if (!session('otp_verified')) {
            return response()->json([
                'status'  => false,
                'message' => 'કૃપા કરીને પહેલા OTP ચકાસો.',
            ], 422);
        }

        $validated = $request->validate([
            'new_pin'     => ['required', 'digits:6'],
            'confirm_pin' => ['required', 'digits:6', 'same:new_pin'],
        ], [
            'new_pin.required'     => 'નવો PIN દાખલ કરો.',
            'new_pin.digits'       => 'PIN 6 અંકનો હોવો જોઈએ.',
            'confirm_pin.required' => 'PIN ફરીથી દાખલ કરો.',
            'confirm_pin.same'     => 'બંને PIN સરખા હોવા જોઈએ.',
        ]);

        $admin = Admin::find(session('reset_admin_id'));

        if (!$admin) {
            return response()->json([
                'status'  => false,
                'message' => 'એકાઉન્ટ મળ્યું નથી.',
            ], 404);
        }

        $admin->update([
            'pin'            => Hash::make($validated['new_pin']),
            'otp'            => null,
            'otp_expires_at' => null,
        ]);

        session()->forget(['reset_mobile', 'reset_admin_id', 'otp_verified']);

        return response()->json([
            'status'   => true,
            'message'  => 'તમારો PIN સફળતાપૂર્વક બદલાઈ ગયો છે.',
            'redirect' => route('admin.login'),
        ]);
    }
}
