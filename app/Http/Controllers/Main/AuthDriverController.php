<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FormRegisterDriverRequest;
use App\Models\Customer;
use App\Models\Driver;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use App\Http\Requests\FormLoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Mail\VerifyEmailChangePassword;
use App\Enums\DriverStatus;

class AuthDriverController extends Controller
{
    public function indexFormRegister() {
        return view('main.auth-driver.register');
    }

    public function handleRegisterRequest(FormRegisterDriverRequest $request) {
        $request->validated();

        $count = Customer::where('email', $request->email)->count();
        if ($count >= 1) {
            $toast_msg = 'Email đã được sử dụng để đăng kí dưới vai trò khách hàng!!';
            $toast_modify = 'toast-error';
            return back()->with(compact('toast_msg', 'toast_modify'))->withInput();
        }

        $driver = Driver::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'gender' => $request->input('gender'),
            'avata' => null,
            'status_code' => DriverStatus::FREE,
            'status_description' => DriverStatus::getDescription(DriverStatus::FREE),
            'password' => bcrypt($request->input('password')),
            'verify_token' => Str::random(16),
        ])->assignRole('driver');

        $data = 'Bạn đã đăng ký một tài khoản Uber, trước khi có thể sử dụng tài khoản của mình, bạn cần xác minh rằng đây là địa chỉ email của bạn bằng cách nhấp vào nút bên dưới:';
        Mail::to($driver)->send(new VerifyEmail($driver, $data));

        return redirect()->route('verify.index', ['id' => $driver->id]);
    }

    public function indexFormLogin() {
        return view('main.auth-driver.login');
    }

    public function handleLoginRequest(FormLoginRequest $request) {
        $request->validated();  

        $email = $request->input('email');
        $password = $request->input('password');
        $remenber = $request->input('remenber') ? true : false;

        if(Auth::guard('driver')->attempt(['email' => $email, 'password' => $password], $remenber)) {
            if (Auth::guard('driver')->user()->verify == false) {
                $user_id = Auth::guard('driver')->user()->id;
                Auth::guard('driver')->logout();
                
                return redirect()->back()->with(compact('user_id'));
            } else {
                $toast_msg = 'xin chào ' . Auth::guard('driver')->user()->name;
                $toast_modify = 'toast-success';
                $guard_name = Auth::guard('driver')->user()->getRoleNames()->first();
                session()->put('guard_name', $guard_name);

                $notifications = [];

                if (Auth::guard('driver')->user()->citizenIdentifyCard == null) {
                    array_push($notifications, [
                        'title' => 'Thêm căn cước công dân',
                        'content' => 'Vui lòng thêm căn cước công dân để bắt đầu công việc',
                    ]);
                }

                if (Auth::guard('driver')->user()->drivingLicense == null) {
                    array_push($notifications, [
                        'title' => 'Thêm bằng lái xe',
                        'content' => 'Vui lòng thêm bằng lái xe để bắt đầu công việc',
                    ]);
                } 

                if (Auth::guard('driver')->user()->vehicle == null) {
                    array_push($notifications, [
                        'title' => 'Thêm phương tiện',
                        'content' => 'Vui lòng thêm phương tiện để bắt đầu công việc',
                    ]);
                }

                session()->put('notifications', $notifications);

                return redirect('')->with(compact('toast_msg', 'toast_modify', 'guard_name'));
            }
        }

        $toast_msg = 'Tài khoản hoặc mật khẩu không đúng';
        $toast_modify = 'toast-error';
        return back()->with(compact('toast_msg', 'toast_modify'))->withInput();
    }

    public function handleLogout() {
        Auth::guard('driver')->logout();
        $toast_msg = 'Đăng xuất thành công';
        $toast_modify = 'toast-success';

        session()->forget('notifications');

        return redirect('')->with(compact('toast_msg', 'toast_modify'));
    }

    public function indexForgetPasswordForm() {
        return view('main.auth-driver.forget-password');
    }

    public function ValidateForgetPasswordForm(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email|max:255|regex:/(.*)@gmail\.com/i',
        ]);

        $user = Driver::where('email', $request->input('email'))->first();
        
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

        $user = Driver::where('id', $request->input('id'))->update([
            'password' => bcrypt($request->input('password')),
            'verify_token' => null
        ]);

        $toast_msg = 'Mật khẩu thay đổi thành công giờ bạn có thể đăng nhập lại';
        $toast_modify = 'toast-success';

        return redirect('/driver/login')->with(compact('toast_msg', 'toast_modify'));

    }
}
