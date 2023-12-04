<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    public function indexLoginForm() {
        return view('admin.auth-admin.login');
    }

    public function handleLogin(Request $request) {

        $validated = $request->validate([
            'username' => 'required | not_regex:/@gmail\.com$/',
            'password' => 'required'
        ]);

        $credentials = [
            'username' =>  $request->input('username'),
            'password' => $request->input('password'),
        ];
        
        $remember = $request->input('remember-me') ? true : false;

        // Auth::attempt luôn yêu cầu một password hash
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            if (Auth::guard('admin')->user()->verify == false) {
                $toast_msg = 'Đăng nhập không thành công, vui lòng liên hệ với quản trị viên';
                $toast_modify = 'danger';
                Auth::guard('admin')->logout();

                return redirect()->back()->with(compact('toast_msg', 'toast_modify'));
            }
            return redirect('/admin')->with('toast_msg', 'Welcome !!');
        }

        $toast_msg = 'Đăng nhập không thành công, vui lòng liên hệ với quản trị viên';
        $toast_modify = 'danger';

        return redirect()->back()->with(compact('toast_msg', 'toast_modify'));
    }

    public function handleLogout() {
        Auth::guard('admin')->logout();

        $toast_msg = 'Đăng xuất thành công';
        $toast_modify = 'success';

        return redirect('/admin/login')->with(compact('toast_msg', 'toast_modify'));
    }
    
}
