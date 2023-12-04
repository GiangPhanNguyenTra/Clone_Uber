<?php

use Illuminate\Support\Facades\Route;

// admin
use App\Http\Controllers\Admin\AuthAdminController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DriverController;

//main-page
use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Main\AuthCustomerController;
use App\Http\Controllers\Main\AccountCustomerController;
use App\Http\Controllers\Main\VerifyAccountController;
use App\Http\Controllers\Main\AuthDriverController;
use App\Http\Controllers\Main\AccountDriverController;
use App\Http\Controllers\Main\CitizenIdentifyCardController;
use App\Http\Controllers\Main\DrivingLicenseController;
use App\Http\Controllers\Main\VehicleController;
use App\Http\Controllers\Main\BookingRideController;

use App\Events\NewBookingRideEvent;
use App\Events\AcceptBookingRideEvent;
use App\Events\CompleteBookingRideEvent;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home
Route::get('', [HomeController::class, 'index']);
// Home driver
Route::get('/home/driver', [HomeController::class, 'indexDriverPage']);

Route::middleware(['guest:customer,driver,admin'])->group(function() {
    // auth-customer
    Route::get('/customer/register', [AuthCustomerController::class, 'indexFormRegister']);
    Route::post('/customer/register', [AuthCustomerController::class, 'handleRegisterRequest']);
    Route::get('/customer/login', [AuthCustomerController::class, 'indexFormLogin']);
    Route::post('/customer/login', [AuthCustomerController::class, 'handleLoginRequest']);
    Route::get('/customer/logout', [AuthCustomerController::class, 'handleLogout']);

    Route::get('/customer/forget-password', [AuthCustomerController::class, 'indexForgetPasswordForm']);
    Route::post('/customer/forget-password', [AuthCustomerController::class, 'ValidateForgetPasswordForm']);
    Route::post('/customer/forget-password/handle', [AuthCustomerController::class, 'handleForgetPasswordForm']);


    // auth-driver
    Route::get('/driver/register', [AuthDriverController::class, 'indexFormRegister']);
    Route::post('/driver/register', [AuthDriverController::class, 'handleRegisterRequest']);
    Route::get('/driver/login', [AuthDriverController::class, 'indexFormLogin']);
    Route::post('/driver/login', [AuthDriverController::class, 'handleLoginRequest']);

    Route::get('/driver/forget-password', [AuthDriverController::class, 'indexForgetPasswordForm']);
    Route::post('/driver/forget-password', [AuthDriverController::class, 'ValidateForgetPasswordForm']);
    Route::post('/driver/forget-password/handle', [AuthDriverController::class, 'handleForgetPasswordForm']);


    // index verify
    Route::get('/verify/{id}', [VerifyAccountController::class, 'indexVerifyAccount'])->name('verify.index');
    Route::get('/verify/{id}/{token}', [VerifyAccountController::class, 'handleVerifyAccount'])->name('verify.account');
    Route::get('/re-verify/{id}', [VerifyAccountController::class, 'handleReVerifyAccount']);
    Route::get('/verify/{id}/{token}/password', [VerifyAccountController::class, 'handleVerifyForgetPasswordRequest'])->name('verify.forget-password');


    // admin
    Route::get('/admin/login', [AuthAdminController::class, 'indexLoginForm']);
    Route::post('/admin/login', [AuthAdminController::class, 'handleLogin']);
});

Route::middleware(['auth:customer', 'role:customer,customer'])->group(function() {
    Route::get('/customer/account', [AccountCustomerController::class, 'index']);
    Route::post('/customer/account', [AccountCustomerController::class, 'updateAccount']);
    Route::post('/customer/account/change-password', [AccountCustomerController::class, 'changePassword']);

    // booking ride
    Route::get('/customer/booking-ride', [BookingRideController::class, 'indexBookingRide']);
    Route::post('/customer/booking-ride', [BookingRideController::class, 'handleBookingRide']);
    
    Route::get('/customer/logout', [AuthCustomerController::class, 'handleLogout']);
});

Route::middleware(['auth:driver', 'role:driver,driver'])->group(function() {
    Route::get('/driver/account', [AccountDriverController::class, 'index']);
    Route::post('/driver/account', [AccountDriverController::class, 'updateAccount']);
    Route::post('/driver/account/change-password', [AccountDriverController::class, 'changePassword']);
    Route::get('/driver/identification-documents', [AccountDriverController::class, 'indexIdentificationDocuments']);

    Route::post('/driver/citizen-identify-card', [CitizenIdentifyCardController::class, 'updatedCitizenIdentifyCard']);
    Route::post('/driver/driving-license', [DrivingLicenseController::class, 'updatedDrivingLicense']);

    // landing booking ride from customer
    Route::get('/driver/landing-booking-ride', [BookingRideController::class, 'indexLandingBookingRide']);
    Route::post('/driver/update-current-location', [BookingRideController::class, 'updateCurrentLocationDriver']);

    // accept booking ride
    Route::get('/driver/accept/booking-ride/{id}', [BookingRideController::class, 'acceptBookingRide']);

    // complete booking ride
    Route::get('/driver/complete/booking-ride/{id}', [BookingRideController::class, 'completeBookingRide']);

    Route::get('/driver/vehicle', [VehicleController::class, 'index']);
    Route::post('/driver/vehicle', [VehicleController::class, 'updateVehicle']);

    Route::get('/driver/logout', [AuthDriverController::class, 'handleLogout']);

    Route::get('/event', function() {
        event(new CompleteBookingRideEvent(3, 1, 1));
        dd('ok');
    });
});

Route::middleware(['auth:admin'])->group(function() {
    Route::get('/admin', [HomeAdminController::class, 'index']);

    // manage customer
    Route::get('/admin/customer', [CustomerController::class, 'indexCustomer']);
    Route::get('/admin/customer/search/{type}/{content}', [CustomerController::class, 'handleSearchCustomer']);

    // manage driver
    Route::get('/admin/driver', [DriverController::class, 'indexDriver']);
    Route::get('/admin/driver/search/{type}/{content}', [DriverController::class, 'handleSearchDriver']);
    Route::get('/admin/driver/{id}/citizen-identifycard', [DriverController::class, 'indexCitizenIdentifyCard']);
    Route::get('/admin/driver/{id}/driving-license', [DriverController::class, 'indexDrivingLicense']);
    Route::get('/admin/driver/{id}/vehicle', [DriverController::class, 'indexVehicle']);

    // manage ride
    Route::get('/admin/ride', [RideController::class, 'indexRide']);

    Route::get('/admin/logout', [AuthAdminController::class, 'handleLogout']);
});