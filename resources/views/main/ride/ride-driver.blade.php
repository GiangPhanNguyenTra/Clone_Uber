@extends('main.layouts.app')
@section('content')
<div class="content">
    <div class="content__thumbnail">
        <img src="/main/asset/img/Uber-banner-06.png" alt="">
        <div class="content__thumbnail-text">
            <h3></h3>
        </div>
        <div class="daily_earning_date-container">
            <input class="daily_earning_date" type="date" value="{{$todayDailyEarning->date ?? now()->toDateString()}}">
            <input type="hidden" class="auth" value="{{$auth}}">
        </div>
    </div>
    <div class="content__main container content__main-container" style="justify-content: center;">
        <div class="section-content_text form-layout-order mt-0 active">
            @if ($rides->count() !== 0)
                <table class="order-table">

                    <thead>
                        <tr>
                            <td class="order-id">Mã cuốc xe</td>
                            <td class="order-reciver">Mã khách hàng: </td>
                            <td class="order-money">Quãng đường</td>
                            <td class="order-date">Tổng tiền</td>
                            <td class="order-status">Trạng thái</td>
                            <td class="order-detail"></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rides as $ride)
                            <tr>
                                <td class="order-id">
                                    <span>{{$ride->ride_id}}</span>
                                </td>
                                <td class="order-reciver">{{$ride->customer->id}}</td>
                                <td class="order-money">{{$ride->distance}} Km</td>
                                <td class="order-date">{{$ride->price}} VNĐ</td>
                                @if ($ride->status_code === 1)
                                    <td class="order-status" style="color: rgb(255, 0, 0); font-weight:bold">{{$ride->status_description}}</td>
                                @elseif ($ride->status_code === 2)
                                    <td class="order-status" style="color: #98a67c; font-weight:bold">{{$ride->status_description}}</td>
                                @endif
                                <td class="order-detail">
                                    <button class="btn btn-intro info mt-0"><a href="/driver/detail-ride/{{$ride->ride_id}}">Chi tiết</a></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="margin-top:30px" class="daily_earning">
                    <h3>Thu nhập ngày: {{$todayDailyEarning->date}}</h3>
                    <table class="cart-info-table">
                        <tbody>
                            <tr>
                                <th>Tổng cuốc xe: </th>
                                <td>{{$todayDailyEarning->total_rides}}</td>
                            </tr>
                            <tr>
                                <th>Tổng tiền: </th>
                                <td>{{$todayDailyEarning->total_earnings}} NVĐ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <h3>Không có dữ liệu</h3>
            @endif
        </div>
    </div>
</div>
<script src="/main/js/sort-daily-earning.js"></script>
@endsection