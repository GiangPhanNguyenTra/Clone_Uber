<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FormDrivingLicenseUpdateRequest;
use App\Models\DrivingLicense;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DrivingLicenseController extends Controller
{
    public function updatedDrivingLicense(FormDrivingLicenseUpdateRequest $request) {
        $request->validated();

        $drivingLicense = Auth::guard('driver')->user()->drivingLicense;
        $citizenIdentifyCard = Auth::guard('driver')->user()->citizenIdentifyCard;
        $beginningDate = Carbon::Parse($request->input('beginning_date_driving_license'));
        $dateOfIssue = Carbon::Parse($request->input('date_of_issue_dringving_license'));

        if ($drivingLicense) {
            $drivingLicense = $drivingLicense->update([
                'driving_license_id' => $request->input('driving_license_id'),
                'full_name' => $citizenIdentifyCard->full_name,
                'date_of_birth' => $citizenIdentifyCard->date_of_birth,
                'address' => $citizenIdentifyCard->place_of_origin,
                'class' => 'A1',
                'expires' => 'Không giới hạn',
                'beginning_date' => $beginningDate,
                'date_of_issue' => $dateOfIssue,
                'issued_by' => $request->input('issued_by_driving_license'),
                'driver_id' => Auth::guard('driver')->user()->id,
            ]);
        } else {
            $drivingLicense = DrivingLicense::create([
                'driving_license_id' => $request->input('driving_license_id'),
                'full_name' => $citizenIdentifyCard->full_name,
                'date_of_birth' => $citizenIdentifyCard->date_of_birth,
                'address' => $citizenIdentifyCard->place_of_origin,
                'class' => 'A1',
                'expires' => 'Không giới hạn',
                'beginning_date' => $beginningDate,
                'date_of_issue' => $dateOfIssue,
                'issued_by' => $request->input('issued_by_driving_license'),
                'driver_id' => Auth::guard('driver')->user()->id,
            ]);
        }

        session()->forget('notifications');

        $notifications = [];

        if (Auth::guard('driver')->user()->citizenIdentifyCard == null) {
            array_push($notifications, [
                'title' => 'Thêm căn cước công dân',
                'content' => 'Vui lòng thêm căn cước công dân để bắt đầu công việc',
            ]);
        }

        if (!$drivingLicense) {
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
        
        $toast_msg = 'Bằng lái xe đã được cập nhật thành công';
        $toast_modify = 'toast-success';
        return redirect()->back()->with(compact('toast_msg', 'toast_modify'));
    }
}
