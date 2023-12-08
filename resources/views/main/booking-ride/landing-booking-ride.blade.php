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
    <div class="content__thumbnail" style="background-color: black">
        <div class="content__thumbnail-text">
            <h3>Cuốc xe</h3>
        </div>
    </div>
    <div class="content__main container content__main-container" style="justify-content: center;">
        <div class="row">
            <div class="map-landing col l-7 m-12 c-12">
                <div id="map"></div>
            </div>
                <div class="map-infomation col l-5 m-12 c-12">
                    @if (Auth::guard('driver')->user()->status_code == 0)
                        <p>* Bạn chưa có cuốc xe nào</p>
                        <p style="margin-bottom: 20px">Vui lòng cập nhật địa chỉ hiện tại của bạn để được nhận cuộc xe, chúng tôi sẽ căn cứ vào địa chỉ này để thông báo khi có cuốc xe từ người dùng </p>
                        <button class="customer-location btn btn-intro">Địa chỉ hiện tại</button>
                        <p class="current-location">Địa chỉ hiện tại: {{Auth::guard('driver')->user()->current_location_name}}</p>
                        <button class="confirm-current-location btn btn-intro">xác nhận địa chỉ này</button>
                    @else
                        <h2>Thông tin khách hàng</h2>
                        <p>Họ Tên: {{$customer->name}}</p>
                        <p>Số điện thoại: {{$customer->phone}}</p>
                        <h2>Thông tin cuốc xe</h2>
                        <p>A điểm đón khách: {{$ride->start_location_name}}</p>
                        <p>B điểm đến: {{$ride->end_location_name}}</p>
                        <input type="hidden" value="{{$ride->start_location_lat}}" class="start_location_lat">
                        <input type="hidden" value="{{$ride->start_location_lng}}" class="start_location_lng">
                        <input type="hidden" value="{{$ride->end_location_lat}}" class="end_location_lat">
                        <input type="hidden" value="{{$ride->end_location_lng}}" class="end_location_lng">
                        <p>Quãng đường: {{$ride->distance}} km</p>
                        <p>Giá: {{$ride->price}} VNĐ</p>
                        <p>*Lưu ý chỉ nhấn nút khi đã hoàn thành cuốc xe</p>
                        <a class="btn btn-intro" href="/driver/complete/booking-ride/{{$ride->ride_id}}">Xác nhận hoàn thành</a>
                    @endif
                </div>
        </div>
    </div>
</div>
<script type="module" src="/main/js/landing-booking-ride.js" defer></script>
@endsection