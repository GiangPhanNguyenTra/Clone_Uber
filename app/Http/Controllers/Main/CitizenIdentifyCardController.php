<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FormCitizenIdentifyCardUpdateRequest;
use Carbon\Carbon;
use App\Models\CitizenIdentifyCard;
use Illuminate\Support\Facades\Auth;

class CitizenIdentifyCardController extends Controller
{
    public function updatedCitizenIdentifyCard(FormCitizenIdentifyCardUpdateRequest $request) {
        $request->validated();
        
        $citizenIdentifyCard = Auth::guard('driver')->user()->citizenIdentifyCard;

        $dateOfBirth = Carbon::parse($request->input('date_of_birth'));
        $dateOfExpiry = Carbon::parse($request->input('date_of_expiry'));
        $dateOfIssue = Carbon::parse($request->input('date_of_issue'));
        $dateNow = Carbon::now();

        if ($dateNow->diffInYears($dateOfBirth) >= 18 && $dateOfExpiry->gt($dateOfIssue)) {
            
            if ($citizenIdentifyCard) {
                $citizenIdentifyCard =  $citizenIdentifyCard->update([
                    'citizen_identify_card_id' => $request->input('citizen_identify_card_id'),
                    'full_name' => $request->input('full_name'),
                    'date_of_birth' => $dateOfBirth,
                    'gender' => $request->input('gender'),
                    'place_of_origin' => $request->input('place_of_origin_ward') . ', ' . $request->input('place_of_origin_district') . ', ' . $request->input('place_of_origin_city'),
                    'place_of_residence' => $request->input('street_name') . ', ' . $request->input('place_of_residence_ward') . ', ' . $request->input('place_of_residence_district') . ', ' . $request->input('place_of_residence_city'),
                    'date_of_expiry' => $dateOfExpiry,
                    'date_of_issue' => $dateOfIssue,
                    'issued_by' => $request->input('issued_by'),
                    'driver_id' => Auth::guard('driver')->user()->id,
                ]);
            } else {
                $citizenIdentifyCard = CitizenIdentifyCard::create([
                    'citizen_identify_card_id' => $request->input('citizen_identify_card_id'),
                    'full_name' => $request->input('full_name'),
                    'date_of_birth' => $dateOfBirth,
                    'gender' => $request->input('gender'),
                    'place_of_origin' => $request->input('place_of_origin_ward') . ', ' . $request->input('place_of_origin_district') . ', ' . $request->input('place_of_origin_city'),
                    'place_of_residence' => $request->input('street_name') . ', ' . $request->input('place_of_residence_ward') . ', ' . $request->input('place_of_residence_district') . ', ' . $request->input('place_of_residence_city'),
                    'date_of_expiry' => $dateOfExpiry,
                    'date_of_issue' => $dateOfIssue,
                    'issued_by' => $request->input('issued_by'),
                    'driver_id' => Auth::guard('driver')->user()->id,
                ]);
            }

            session()->forget('notifications');

            $notifications = [];

            if (!$citizenIdentifyCard) {
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

            $toast_msg = 'Căn cước côn dân đã được cập nhật thành công';
            $toast_modify = 'toast-success';
            return redirect()->back()->with(compact('toast_msg', 'toast_modify'));
        }

        $toast_msg = 'Ngày sinh không hợp lệ';
        $toast_modify = 'toast-error';
        return back()->with(compact('toast_msg', 'toast_modify'))->withInput();
    }
}
