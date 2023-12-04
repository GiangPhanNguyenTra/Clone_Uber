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
}
