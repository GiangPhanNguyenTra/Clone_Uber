<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ride;
use App\Enums\RideStatus;
use App\Enums\DriverStatus;
use App\Events\NewBookingRideEvent;
use App\Events\AcceptBookingRideEvent;
use App\Events\CompleteBookingRideEvent;
use App\Models\Driver;
use App\Models\Customer;
Use \Carbon\Carbon;

class BookingRideController extends Controller
{
    private $broadcast = false;

    public function indexBookingRide() {
        $customer = Auth::guard('customer')->user();
        $ride = $customer->rides()->whereIn('status_code', [0, 1])->first();
        if ($ride && $ride->driver_id) {
            $driver = Driver::find($ride->driver_id);
            $vehicle = $driver->vehicle;
            return view('main.booking-ride.booking-ride', compact('ride', 'driver', 'vehicle'));
        }

        return view('main.booking-ride.booking-ride', compact('ride'));
    }

    public function handleBookingRide(Request $request) {
        $customer = Auth::guard('customer')->user();

        if ($customer->is_on_ride) {
            $toast_msg = 'Bạn đang trong chuyến xe';
            $toast_modify = 'toast-error';
            return redirect()->back()->with(compact('toast_msg', 'toast_modify'));
        }

        $drivers = Driver::whereHas('citizenIdentifyCard')
                        ->whereHas('drivingLicense')
                        ->whereHas('vehicle')
                        ->whereNotNull('current_location_name')
                        ->where('status_code', false)
                        ->get();

        $startLocationLat = $request->input('start_location_lat');
        $startLocationLng = $request->input('start_location_lng');
        $minDistance = 0;
        $closestDriver = null;

        foreach($drivers as $driver) {
            $currentDistance = 6378 * acos((sin($startLocationLat) * sin($driver->current_location_lat)) + cos($startLocationLat) * cos($driver->current_location_lat) * cos($driver->current_location_lng - $startLocationLng));
            
            if ($minDistance == 0) {
                $minDistance = $currentDistance;
            } else {
                if ($currentDistance <= $minDistance) {
                    $minDistance = $currentDistance;
                    $closestDriver = $driver;
                }
            }
        }
        
        if ($closestDriver) {
            $ride = Ride::create([
                'start_location_name' => $request->input('start_location_name'),
                'start_location_lat' => $startLocationLat,
                'start_location_lng' => $startLocationLng,
                'end_location_name' => $request->input('end_location_name'),
                'end_location_lat' => $request->input('end_location_lat'),
                'end_location_lng' => $request->input('end_location_lng'),
                'distance' => $request->input('distance'),
                'price' => $request->input('distance') * 8.000,
                'status_code' => RideStatus::WAITING,
                'status_description' => RideStatus::getDescription(RideStatus::WAITING),
                'customer_id' => Auth::guard('customer')->user()->id,
                'start_time' => Carbon::now(),
            ]);
    
            $customer->update([
                'is_on_ride' => true,
            ]);

            event(new NewBookingRideEvent($closestDriver->id, $ride, $customer));
        } else {
            session()->flash('toast_msg', 'Không tìm được tài xế, vui lòng thử lại sau');
            session()->flash('toast_modify', 'toast-error');
            return redirect()->back();
        }

        session()->flash('toast_msg', 'Đặt xe thành công');
        session()->flash('toast_modify', 'toast-success');

        return view('main.booking-ride.booking-ride', compact('ride'));
    }

    public function indexLandingBookingRide() {
        $driver = Auth::guard('driver')->user();
        $citizenIdentifyCard = $driver->citizenIdentifyCard;
        $drivingLicense = $driver->drivingLicense;
        $vehicle = $driver->vehicle;

        if ($citizenIdentifyCard && $drivingLicense && $vehicle && $driver->status_code == DriverStatus::FREE) {
            return view('main.booking-ride.landing-booking-ride');
        } else if ($citizenIdentifyCard && $drivingLicense && $vehicle && $driver->status_code == DriverStatus::DOING) {
            $ride = Ride::where('status_code', 1)
                        ->where('driver_id', $driver->id)->first();
            $customer = Customer::find($ride->customer_id);

            return view('main.booking-ride.landing-booking-ride', compact('customer', 'ride'));
        }

        $toast_msg = 'Vui lòng cập nhật đầy đủ thông tin';
        $toast_modify = 'toast-error';
        return redirect()->back()->with(compact('toast_msg', 'toast_modify'));
    }

    public function updateCurrentLocationDriver(Request $request) {
        $driver = Auth::guard('driver')->user();
        $driver->update([
            'current_location_name' => $request->name,
            'current_location_lat' => $request->lat,
            'current_location_lng' => $request->lng
        ]);
        
        return response()->json([
            'message' => 'ok em ơi',
        ]);
    }

    public function acceptBookingRide($id) {
        $ride = Ride::find($id);

        if ($ride->driver_id == null) {
            $ride->update([
                'status_code' => RideStatus::IN_PROGRESS,
                'status_description' => RideStatus::getDescription(RideStatus::IN_PROGRESS),
                'driver_id' => Auth::guard('driver')->user()->id
            ]);
    
            $driver = Auth::guard('driver')->user();
            $driver->update([
                'status_code' => DriverStatus::DOING,
                'status_description' => DriverStatus::getDescription(DriverStatus::DOING)
            ]);
        }

        $customer = Customer::find($ride->customer_id);
        $driver = Auth::guard('driver')->user();
        $vehicle = $driver->vehicle;

        if ($this->broadcast == false) {
            event(new AcceptBookingRideEvent($customer->id, $ride, $driver, $vehicle));
            $this->broadcast = true;   
        }

        return view('main.booking-ride.landing-booking-ride', compact('ride', 'customer'));
    }

    public function completeBookingRide($id) {
        $ride = Ride::find($id);
        $ride->update([
            'status_code' => RideStatus::COMPLETED,
            'status_description' => RideStatus::getDescription(RideStatus::COMPLETED)
        ]);

        $driver = Driver::find($ride->driver_id);
        $driver->update([
            'status_code' => DriverStatus::FREE,
            'status_description' => DriverStatus::getDescription(DriverStatus::FREE)
        ]);

        $customer = Customer::find($ride->customer_id);
        $customer->update([
            'is_on_ride' => false,
        ]);

        event(new CompleteBookingRideEvent($customer->id, $ride, $driver));
        
        
    }
}
