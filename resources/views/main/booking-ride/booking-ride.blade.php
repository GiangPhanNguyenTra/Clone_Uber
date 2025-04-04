@extends('main.layouts.app')
@section('content')
<style>
    #map {
        width: 100%;
        height: 400px;
    }
    .map-landing {
        width: 100%;
        height: 400px;
    }
    .map-landing > map{
        width: 100%;
        height: 100%;
    }
    .customer-location {
        margin-top: 0;
        margin-bottom: 30px;
    }
    .map-infomation {
        padding: 20px 20px;
        background: #e9e9e9;
        border-radius: 10px;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    }
    .map-infomation > p {
        margin-bottom: 10px;
        color: #6e7265;
        font-size: 20px
    }
    .map-infomation > h2 {
        margin-bottom: 10px
    }
    .destination-btn {
        margin-top: 10px;
        margin-bottom: 30px;
    }
    .loader-waiting-container {
        margin-top: 33px;
        display: flex;
        justify-content: center;
    }
    .loader-waiting-container .loader-waiting {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 3px solid transparent;
        border-top-color: black;
        animation: spin 1s ease infinite;
    }
</style>
<div class="content">
    <div class="content__thumbnail" style="background-color: #9ba685">
        <img src="../main/asset/img/pexels-joyston-judah-933054.jpg" alt="">
        <div class="content__thumbnail-text">
            <h3>Đặt xe</h3>
        </div>
    </div>
    <div class="content__main container content__main-container" style="justify-content: center;">
        <div class="row">
            <div class="map-landing col l-7 m-12 c-12">
            <div id="map" style="width: 100%; height: 400px;"></div>

            </div>
            @if (Auth::guard('customer')->user()->is_on_ride)
                <div class="map-infomation col l-5 m-12 c-12">
                    <h2>Thông tin về chuyến xe</h2>
                    <p>Điểm đi: {{$ride->start_location_name}}</p>
                    <p>Điểm đến: {{$ride->end_location_name}}</p>
                    <p class="distance">Quãng đường: {{$ride->distance}} Km</p>
                    <p class="price">Tổng tiền: {{$ride->price}} vnđ</p>
                    <p class="price">Trạng thái: {{$ride->status_description}}</p>
                    <input type="hidden" id="start_location_lat" value="{{$ride->start_location_lat}}">
                    <input type="hidden" id="start_location_lng" value="{{$ride->start_location_lng}}">
                    <input type="hidden" id="end_location_lat" value="{{$ride->end_location_lat}}">
                    <input type="hidden" id="end_location_lng" value="{{$ride->end_location_lng}}">
                    @if ($ride->driver_id == null)
                        <div class="loader-waiting-container">
                            <div class="loader-waiting"></div>
                        </div>
                    @else
                        <h2>Thông tin tài xế</h2>
                        <p>Họ tên: {{$driver->name}}</p>
                        <p>Số điện thoại: {{$driver->phone}}</p>
                        <p>Ảnh đại diện: </p>
                        <div class="img-user">
                            @if ($driver->avata !== null)
                                <img src="{{asset('upload/images/driver-avata/'.$driver->avata)}}" alt="">
                            @else
                                <img src="https://pbs.twimg.com/media/EbNX_erVcAUlwIx.jpg:large" alt="">
                            @endif
                        </div>
                        <h2>Thông phương tiện di chuyển</h2>
                        <p class="distance">Biển số xe: {{$vehicle->license_plates}}</p>
                        <p class="price">Thương hiệu: {{$vehicle->brand}}</p>
                        <p class="price">Màu sắc: {{$vehicle->color}}</p>
                        <p class="price">Tên xe: {{$vehicle->model_code}}</p>
                    @endif
                </div>
            @else 
                <div class="map-infomation col l-5 m-12 c-12">
                    <button class="customer-location btn btn-intro">Địa chỉ hiện tại của bạn</button>
                    <p>Chọn địa chỉ bạn muốn đến trên bản đồ hoặc nhập địa chỉ vào ô bên dưới:</p>
                    <div class="form-gruop">
                        <input class="destination-input input" name="password" placeholder="Vui lòng nhập điểm đến ...">
                    </div>
                    <button class="destination-btn btn btn-intro">Tìm kiếm</button>

                    <h2>Thông tin về chuyến xe</h2>
                    <p class="distance">Quãng đường: </p>
                    <p class="price">Tổng tiền: </p>

                    <button class="confirm-booking-btn btn btn-intro">Xác nhận đặt xe</button>
                </div>
            @endif
        </div>
    </div>
</div>
<script type="module" src="/main/js/handle-booking-ride.js" defer></script>
@endsection