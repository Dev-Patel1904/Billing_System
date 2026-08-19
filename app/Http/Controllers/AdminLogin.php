<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Type;

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

    //show setting page
    public function settings()
    {
        $types = Type::orderBy('name')->get();

        return view('admin.Setting', compact('types'));
    }

    // Change Password (PIN)
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'old_password' => [
                'required',
                'digits:6',
            ],
            'new_password' => [
                'required',
                'digits:6',
            ],
            'confirm_password' => [
                'required',
                'digits:6',
                'same:new_password',
            ],
        ], [
            'old_password.required' => 'જૂનો પાસવર્ડ દાખલ કરો.',
            'old_password.digits' => 'જૂનો પાસવર્ડ 6 અંકનો હોવો જોઈએ.',

            'new_password.required' => 'નવો પાસવર્ડ દાખલ કરો.',
            'new_password.digits' => 'નવો પાસવર્ડ 6 અંકનો હોવો જોઈએ.',

            'confirm_password.required' => 'પાસવર્ડ કન્ફર્મ કરો.',
            'confirm_password.digits' => 'કન્ફર્મ પાસવર્ડ 6 અંકનો હોવો જોઈએ.',
            'confirm_password.same' => 'નવો પાસવર્ડ અને કન્ફર્મ પાસવર્ડ મેળ ખાતા નથી.',
        ]);

        $admin = Admin::find(Session::get('admin_id'));

        if (!$admin) {
            return response()->json([
                'status' => false,
                'message' => 'લોગિન સેશન સમાપ્ત થયું છે, કૃપા કરીને ફરી લોગિન કરો.',
            ], 401);
        }

        if (!Hash::check($validated['old_password'], $admin->pin)) {
            return response()->json([
                'status' => false,
                'message' => 'જૂનો પાસવર્ડ ખોટો છે.',
            ], 401);
        }

        $admin->pin = Hash::make($validated['new_password']);
        $admin->save();

        return response()->json([
            'status' => true,
            'message' => 'પાસવર્ડ સફળતાપૂર્વક બદલાયો.',
        ]);
    }
}
