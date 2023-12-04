<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Driver;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;

class VerifyAccountController extends Controller
{
    public function indexVerifyAccount($id) {
        return view('main.auth-customer.verify-index', compact('id'));
    }

    public function handleVerifyAccount($id, $token) {
        $user = Customer::find($id);
        $url = '/customer/login';

        if (!$user instanceof Customer) {
            $user = Driver::find($id);
            $url = '/driver/login';
        }

        if ($user->verify == false ) {
            if ($user->verify_token === $token) {
                $user->update([
                    'verify' => true,
                    'verify_token ' => null
                ]);
            }

            $toast_msg = 'tài khoản đã xác thực thành công giờ bạn có thể đăng nhập lại';
            $toast_modify = 'toast-success';

            return redirect($url)->with(compact('toast_msg', 'toast_modify'));
    
        } else {
            return view('error-page');
        }
    }

    public function handleReVerifyAccount($id) {
        $user = Customer::find($id);

        if (!$user instanceof Customer) {
            $user = Driver::find($id);
        }

        $user->update([
            'verify_token' =>  Str::random(16),
        ]);

        $data = 'Bạn đã yêu cầu gửi lại link mail xác thực, đây là link xác thực của bạn, hãy nhấn nút bên dưới để tiếp tục sử dụng các dịch vụ của chúng tôi.';

        Mail::to($user)->send(new VerifyEmail($user, $data));

        return redirect()->route('verify.index', ['id' => $user->id]);
    }

    public function handleVerifyForgetPasswordRequest($id, $token) {
        $user = Customer::find($id);

        if (!$user instanceof Customer) {
            $user = Driver::find($id);

            if ($user->verify_token === $token) {
                $user->update([
                    'verify_token ' => null
                ]);
                return $this->indexDriverForgetPasswordForm($user);
            }
        
            return view('error-page');
        }
        
        if ($user->verify_token === $token) {
            $user->update([
                'verify_token ' => null
            ]);
            return $this->indexCustomerForgetPasswordForm($user);
        }
        return view('error-page');
    }

    public function indexCustomerForgetPasswordForm($user) {
        return view('main.auth-customer.change-password', compact('user'));
    }

    public function indexDriverForgetPasswordForm($user) {
        return view('main.auth-driver.change-password', compact('user'));
    }
}
