<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FormAccountCustomerUpdateRequest;
use File;

class AccountCustomerController extends Controller
{
    public function index() {
        $customer = Auth::guard('customer')->user();
        $address = explode(', ', $customer->address, 4);

        return view('main.auth-customer.account', compact('customer', 'address'));
    }

    public function updateAccount(FormAccountCustomerUpdateRequest $request) {
        $request->validated();

        $customer = Auth::guard('customer')->user();

        // check file upload

        if ($request->hasFile('img-upload')) {
            $avata =  $request->file('img-upload')->getClientOriginalName();
        } else {
            if ($customer->avata) {
                $avata = $customer->avata;
            } else {
                $avata = null;
            }
        }
        
        $customer->update([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('street_name').', '.$request->input('ward').', '.$request->input('district').', '.$request->input('city'),
            'gender' => $request->input('gender'),
            'avata' =>  $avata
        ]);

        // update lại hình trong local

        if ($request->hasFile('img-upload')) {
            $old_file = 'upload/images/customer-avata/'.$customer->avata;

            if (File::exists($old_file)) {
                File::delete($old_file);
            } 
            $request->file('img-upload')->move('upload/images/customer-avata', $request->file('img-upload')->getClientOriginalName());
        }

        $toast_msg = 'tài khoản đã được cập nhật';
        $toast_modify = 'toast-success';
        return redirect()->back()->with(compact('toast_msg', 'toast_modify'));
    }

    public function changePassword(Request $request) {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        // khi sử dụng attemp thì lúc nào cũng phải mặc định có 2 tham số là email và password
        if (Auth::guard('customer')->attempt(['email' => Auth::guard('customer')->user()->email , 'password' => $request->input('old_password')])) {
            Auth::guard('customer')->user()->update([
                'password' => bcrypt($request->input('password')),
            ]);

            $toast_msg = 'mật khẩu đã được cập nhật';
            $toast_modify = 'toast-success';
            return redirect()->back()->with(compact('toast_msg', 'toast_modify'));
        } else {
            $toast_msg = 'mật khẩu không chính xác vui lòng thử lại sau';
            $toast_modify = 'toast-error';
            return redirect()->back()->with(compact('toast_msg', 'toast_modify'));
        }
    }
}
