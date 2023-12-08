<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ride;
use Illuminate\Support\Facades\Auth;
use App\Models\DailyEarning;
use \Carbon\Carbon;

class RideController extends Controller
{
    public function indexRidesDriver() {
        $driver = Auth::guard('driver')->user();
        $rides = $driver->rides()->whereDate('start_time', Carbon::today())->get();
        $todayDailyEarning = $driver->dailyEarnings()->whereDate('date', Carbon::today())->first();
        $auth = Auth::guard('driver')->user()->getRoleNames()->first();

        return view('main.ride.ride-driver', compact('rides', 'todayDailyEarning', 'auth'));
    }

    public function indexDetailRideDriver($id) {
        $ride = Ride::find($id);
        if (!$ride) {
            $toast_msg = 'Có lỗi xảy ra vui lòng thử lại sau';
            $toast_modify = 'toast-error';
            return redirect()->back()->with(compact('toast_msg', 'toast_modify'));
        }

        $customer = $ride->customer; 

        return view('main.ride.detail-ride-driver', compact('ride', 'customer'));
    }

    public function indexDetailRideCustomer($id) {
        $ride = Ride::find($id);
        if (!$ride) {
            $toast_msg = 'Có lỗi xảy ra vui lòng thử lại sau';
            $toast_modify = 'toast-error';
            return redirect()->back()->with(compact('toast_msg', 'toast_modify'));
        }

        $driver = $ride->driver; 

        return view('main.ride.detail-ride-customer', compact('ride', 'driver'));
    }

    public function sortRideByDay(Request $request) {
        if ($request->auth == 'driver') {
            $driver = Auth::guard('driver')->user();
            $sortRide = $driver->rides()->whereDate('start_time', $request->date)->get();
            $sortDailyEarning = $driver->dailyEarnings()->whereDate('date', $request->date)->first();

            return response()->json([
                'date' => $request->date,
                'sortRide' => $sortRide,
                'sortDailyEarning' => $sortDailyEarning
            ]);
        } else {
            $customer = Auth::guard('customer')->user();
            $sortRide = $customer->rides()->whereDate('start_time', $request->date)->get();

            return response()->json([
                'date' => $request->date,
                'sortRide' => $sortRide,
            ]);
        }
    }

    public function indexRidesCustomer(){
        $customer = Auth::guard('customer')->user();
        $rides = $customer->rides()->whereDate('start_time', Carbon::today())->get();
        $auth = Auth::guard('customer')->user()->getRoleNames()->first();

        return view('main.ride.ride-customer', compact('rides', 'auth'));
    }
}
