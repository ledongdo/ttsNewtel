<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function Login()
    {
        return view('login');
    }

    public function postLogin(LoginRequest $request)
    {
        $check = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($check)) {
            return response()->json([
                'success' => 'success',
            ], 200);
        } else {
            return response()->json([
                'error' => 'Tài khoản hoặc mật khẩu không chính xác',
            ], 422);
        }
    }
    
    /**
     * 
     */
    public function logout()
    {
        auth::logout();
        return redirect()->route('get-login');
    }

}
