<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $status = Auth::attempt(['name'=>$username,'password'=>$password]);
        if($status)
        {
            $user = Auth::user();
            $urlRedirect = "/home";
            if($user->is_admin==1)
            {
                $urlRedirect="/admin";
            }
            return Redirect($urlRedirect);
        }
        return back()->with('msg','Tài khoản hoặc mật khẩu sai');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return view('auth.login');
    }
}
