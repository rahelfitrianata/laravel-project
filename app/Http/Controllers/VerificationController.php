<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function verifyCode(Request $request)
    {
        $user = Auth::user();

        if ($user->verification_code === $request->code) {
            $user->verification_code = null;
            $user->save();

            return redirect()->intended('dashboard');
        } else {
            return redirect()->back()->withErrors(['code' => 'Invalid verification code.']);
        }
    }
}
