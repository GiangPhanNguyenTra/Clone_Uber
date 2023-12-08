<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;

class DriverController extends Controller
{
    public function indexDriver() {
        $drivers = Driver::all();

        return view('admin.driver.index', compact('drivers'));
    }

    public function indexCitizenIdentifyCard($id) {
        $driver = Driver::find($id);
        $citizenIdentifyCard = $driver->citizenIdentifyCard;

        if (!$citizenIdentifyCard) {
            $toast_msg = 'Tài khoản này chưa có thông tin căn cước công dân';
            $toast_modify = 'danger';

            return redirect()->back()->with(compact('toast_msg', 'toast_modify'));
        }

        return view('admin.driver.citizen-identify-card', compact('citizenIdentifyCard'));
    }

    public function indexDrivingLicense($id) {
        $driver = Driver::find($id);
        $drivingLicense = $driver->drivingLicense;

        if (!$drivingLicense) {
            $toast_msg = 'Tài khoản này chưa có thông tin bằng lái xe';
            $toast_modify = 'danger';

            return redirect()->back()->with(compact('toast_msg', 'toast_modify'));
        }

        return view('admin.driver.driving-license', compact('drivingLicense'));
    }

    public function handleSearchDriver($type, $content) {
        switch ($type) {
            case 'tên tài xế':
                $drivers = Driver::where('name', 'like', '%' . $content . '%')->get();
                break;
                
            default:
                # code...
                break;
        }
    
        return view('admin.driver.driver-table', compact('drivers'));
    }

    public function indexVehicle($id) {
        $driver = Driver::find($id);
        $vehicle = $driver->vehicle;

        if (!$vehicle) {
            $toast_msg = 'Tài khoản này chưa có thông tin về phương tiện';
            $toast_modify = 'danger';

            return redirect()->back()->with(compact('toast_msg', 'toast_modify'));
        }

        return view('admin.driver.vehicle', compact('vehicle'));
    }

    public function deleteDriver($id) {
        $driver = Driver::find($id);
        $citizenIdentifyCard = $driver->citizenIdentifyCard;
        $drivingLicense = $driver->drivingLicense;
        $vehicle = $driver->vehicle;

        if ($citizenIdentifyCard || $drivingLicense || $vehicle) {
            $toast_msg = 'Không thể xóa dữ liệu này vì đang được sử dụng bởi dữ liệu khác.';
            $toast_modify = 'danger';

            return redirect()->back()->with(compact('toast_msg', 'toast_modify'));
        }

        $driver->delete();
        $toast_msg = 'Xóa thành công';
        $toast_modify = 'success';

        return redirect()->back()->with(compact('toast_msg', 'toast_modify'));
    }

    public function indexRideOfDriver($id) {
        $driver = Driver::find($id);
        $rides = $driver->rides;
    
        return view('admin.driver-ride.index', compact('rides'));
    }
}
