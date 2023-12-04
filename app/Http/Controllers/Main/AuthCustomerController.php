<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FormRegisterCustomerRequest;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use App\Http\Requests\FormLoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Mail\VerifyEmailChangePassword;

class AuthCustomerController extends Controller
{
    public function indexFormRegister() {
        return view('main.auth-customer.register');
    }

    public function handleRegisterRequest(FormRegisterCustomerRequest $request) {
        $request->validated();
    
        $customer = Customer::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('street_name').', '.$request->input('ward').', '.$request->input('district').', '.$request->input('city'),
            'gender' => $request->input('gender'),
            'avata' => null,
            'password' => bcrypt($request->input('password')),
            'verify_token' => Str::random(16),
        ])->assignRole('customer');

        $data = 'Bạn đã đăng ký một tài khoản Uber, trước khi có thể sử dụng tài khoản của mình, bạn cần xác minh rằng đây là địa chỉ email của bạn bằng cách nhấp vào nút bên dưới:';
        Mail::to($customer)->send(new VerifyEmail($customer, $data));

        return redirect()->route('verify.index', ['id' => $customer->id]);
    }

    public function indexFormLogin() {
        return view('main.auth-customer.login');
    }

    public function handleLoginRequest(FormLoginRequest $request) {
        $request->validated();  

        $email = $request->input('email');
        $password = $request->input('password');
        $remenber = $request->input('remenber') ? true : false;

        if(Auth::guard('customer')->attempt(['email' => $email, 'password' => $password], $remenber)) {
            if (Auth::guard('customer')->user()->verify == false) {
                $user_id = Auth::guard('customer')->user()->id;
                Auth::guard('customer')->logout();
                
                return redirect()->back()->with(compact('user_id'));
            } else {
                $toast_msg = 'xin chào ' . Auth::guard('customer')->user()->name;
                $toast_modify = 'toast-success';
                $guard_name = Auth::guard('customer')->user()->getRoleNames()->first();
                session()->put('guard_name', $guard_name);
                
                return redirect('')->with(compact('toast_msg', 'toast_modify', 'guard_name'));
            }
        }

        $toast_msg = 'Tài khoản hoặc mật khẩu không đúng';
        $toast_modify = 'toast-error';
        return back()->with(compact('toast_msg', 'toast_modify'))->withInput();
    }

    public function handleLogout() {
        Auth::guard('customer')->logout();
        $toast_msg = 'Đăng xuất thành công';
        $toast_modify = 'toast-success';
        
        return redirect('')->with(compact('toast_msg', 'toast_modify'));
    }

    public function indexForgetPasswordForm() {
        return view('main.auth-customer.forget-password');
    }

    public function ValidateForgetPasswordForm(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email|max:255|regex:/(.*)@gmail\.com/i',
        ]);

        $user = Customer::where('email', $request->input('email'))->first();
        
        if ($user) {
            $user->update([
                'verify_token' => Str::random(16),
            ]);

            Mail::to($user)->send(new VerifyEmailChangePassword($user));
            
            return redirect()->route('verify.index', ['id' => $user->id]);
        }
    }

    public function handleForgetPasswordForm(Request $request) {

        $validated = $request->validate([
            'password' => 'required|confirmed',
        ]);

        $user = Customer::where('id', $request->input('id'))->update([
            'password' => bcrypt($request->input('password')),
            'verify_token' => null
        ]);

        $toast_msg = 'Mật khẩu thay đổi thành công giờ bạn có thể đăng nhập lại';
        $toast_modify = 'toast-success';

        return redirect('/customer/login')->with(compact('toast_msg', 'toast_modify'));

    }
}
