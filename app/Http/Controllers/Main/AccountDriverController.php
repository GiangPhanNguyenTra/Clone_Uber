<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FormAccountDriverUpdateRequest;
use File;

class AccountDriverController extends Controller
{
    public function index() {
        $driver = Auth::guard('driver')->user();

        return view('main.auth-driver.account', compact('driver'));
    }

    public function updateAccount(FormAccountDriverUpdateRequest $request) {
        $request->validated();

        $driver = Auth::guard('driver')->user();

        // check file upload

        if ($request->hasFile('img-upload')) {
            $avata =  $request->file('img-upload')->getClientOriginalName();
        } else {
            if ($driver->avata) {
                $avata = $driver->avata;
            } else {
                $avata = null;
            }
        }
        
        $driver->update([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'gender' => $request->input('gender'),
            'avata' =>  $avata
        ]);

        // update lại hình trong local

        if ($request->hasFile('img-upload')) {
            $old_file = 'upload/images/driver-avata/'.$driver->avata;

            if (File::exists($old_file)) {
                File::delete($old_file);
            } 
            $request->file('img-upload')->move('upload/images/driver-avata', $request->file('img-upload')->getClientOriginalName());
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
        if (Auth::guard('driver')->attempt(['email' => Auth::guard('driver')->user()->email , 'password' => $request->input('old_password')])) {
            Auth::guard('driver')->user()->update([
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

    public function indexIdentificationDocuments() {
        $driver = Auth::guard('driver')->user();
        $citizenIdentifyCard = Auth::guard('driver')->user()->citizenIdentifyCard;
        $drivingLicense = Auth::guard('driver')->user()->drivingLicense;
        
        if ($citizenIdentifyCard) {
            $placeOfOrigin = explode(', ', $citizenIdentifyCard->place_of_origin, 3);
            $placeOfResidence = explode(', ', $citizenIdentifyCard->place_of_residence, 4);

            return view('main.auth-driver.identification-documents', compact('driver', 'placeOfOrigin', 'placeOfResidence', 'citizenIdentifyCard', 'drivingLicense'));
        }   

        return view('main.auth-driver.identification-documents', compact('driver', 'citizenIdentifyCard', 'drivingLicense'));
    }
}
