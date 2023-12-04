<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FormVehicleUpdateRequest;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function index() {
        $vehicle = Auth::guard('driver')->user()->vehicle;
        
        return view('main.auth-driver.vehicle', compact('vehicle'));
    }

    public function updateVehicle(FormVehicleUpdateRequest $request) {
        $request->validated();

        $vehicle = Auth::guard('driver')->user()->vehicle;

        if ($vehicle) {
            $vehicle = $vehicle->update([
                'license_plates' => $request->input('license_plates'),
                'brand' => $request->input('brand'),
                'color' => $request->input('color'),
                'model_code' => $request->input('model_code'),
                'driver_id' => Auth::guard('driver')->user()->id,
            ]);
        } else {
            $vehicle = Vehicle::create([
                'license_plates' => $request->input('license_plates'),
                'brand' => $request->input('brand'),
                'color' => $request->input('color'),
                'model_code' => $request->input('model_code'),
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

        if (Auth::guard('driver')->user()->drivingLicense == null) {
            array_push($notifications, [
                'title' => 'Thêm bằng lái xe',
                'content' => 'Vui lòng thêm bằng lái xe để bắt đầu công việc',
            ]);
        }

        if (!$vehicle) {
            array_push($notifications, [
                'title' => 'Thêm phương tiện',
                'content' => 'Vui lòng thêm phương tiện để bắt đầu công việc',
            ]);
        }

        session()->put('notifications', $notifications);
        
        $toast_msg = 'Phương tiện đã được cập nhật thành công';
        $toast_modify = 'toast-success';
        return redirect()->back()->with(compact('toast_msg', 'toast_modify'));
    }
}
