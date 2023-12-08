@extends('main.layouts.app')
@section('content')
<div class="content">
    <div class="content__thumbnail">
        <img src="/main/asset/img/Uber-banner-06.png" alt="">
        <div class="content__thumbnail-text">
            
        </div>
    </div>
    <div class="content__main container content__main-product-detail dp-block">
        <h1 class="cart-info-header" style="margin-top: 0px">Thông tin chi cuốc xe</h1>
        <table class="cart-info-table">
            <tbody>
                <tr>
                    <th>Mã cuốc xe: </th>
                    <td>{{$ride->ride_id}}</td>
                </tr>
                <tr>
                    <th>Khách hàng: </th>
                    <td>{{$customer->name}}</td>
                </tr>
                <tr>
                    <th>Số điện thoại: </th>
                    <td>{{$customer->phone}}</td>
                </tr>
                <tr>
                    <th>Điểm đi: </th>
                    <td>{{$ride->start_location_name}}</td>
                </tr>
                <tr>
                    <th>Điểm đến: </th>
                    <td>{{$ride->end_location_name}}</td>
                </tr>
                <tr>
                    <th>Quãng đường: </th>
                    <td>{{$ride->distance}} Km</td>
                </tr>
                <tr>
                    <th>Tổng tiền: </th>
                    <td>{{$ride->price}} VNĐ</td>
                </tr>
                <tr>
                    <th>Trạng thái: </th>
                    <td>{{$ride->status_description}}</td>
                </tr>
                <tr>
                    <th>Thời gian bắt đầu: </th>
                    <td>{{$ride->start_time}}</td>
                </tr>
                <tr>
                    <th>Thời gian kết thúc: </th>
                    <td>{{$ride->end_time ?? 'Đang cập nhật' }}</td>
                </tr>
                <tr>
                    <th>Đánh giá: </th>
                    <td>{{$ride->rating ?? 'Không có đánh giá'}}</td>
                </tr>
                <tr>
                    <th>Bình luận: </th>
                    <td>{{$ride->comment ?? 'Không có bình luận'}}</td>
                </tr>
            </tbody>
        </table>
        <a class="btn btn-intro 0" href="/driver/ride">Quay Lại</a>
    </div>
</div>
@endsection