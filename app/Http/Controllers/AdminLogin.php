<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminLogin extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'mobile' => [
                'required',
                'digits:10',
                'regex:/^[6-9][0-9]{9}$/',
            ],
            'pin' => [
                'required',
                'digits:6',
            ],
        ], [
            'mobile.required' => 'મોબાઇલ નંબર દાખલ કરો.',
            'mobile.digits' => 'મોબાઇલ નંબર 10 અંકનો હોવો જોઈએ.',
            'mobile.regex' => 'માન્ય ભારતીય મોબાઇલ નંબર દાખલ કરો.',
            'pin.required' => 'PIN દાખલ કરો.',
            'pin.digits' => 'PIN 6 અંકનો હોવો જોઈએ.',
        ]);

        $admin = Admin::where('mobile', $validated['mobile'])->first();

        if (!$admin) {
            return response()->json([
                'status' => false,
                'message' => 'મોબાઇલ નંબર અથવા PIN ખોટો છે.'
            ], 401);
        }

        if (!Hash::check($validated['pin'], $admin->pin)) {
            return response()->json([
                'status' => false,
                'message' => 'મોબાઇલ નંબર અથવા PIN ખોટો છે.'
            ], 401);
        }

        Session::put('admin_id', $admin->id);
        Session::put('admin_mobile', $admin->mobile);

        return response()->json([
            'status' => true,
            'message' => 'લોગિન સફળ થયું.',
            'redirect' => route('dashboard')
        ]);
    }

    public function logout(Request $request)
    {
        Session::forget('admin_id');
        Session::forget('admin_mobile');

        return redirect()->route('admin.login');
    }
}
