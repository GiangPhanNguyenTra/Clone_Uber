@extends('main.layouts.app')
@section('content')
<div class="content">
    <div class="content__thumbnail">
        <img src="../main/asset/img/Uber-banner-06.png" alt="">
        <div class="content__thumbnail-text">
            <h3>đăng kí</h3>
        </div>
    </div>

    <div class="content__main container content__main-container row">
        <div class="col l-3 m-12 c-12">
            <div class="content__main-r">
                <h2 class="cmr__heading">Đăng ký ngay<br>
                    để tận hưởng ưu đãi đặc biệt và tiện ích tối đa.</h2>
                <p class="cmr__desc">
                    Thông tin cá nhân của bạn sẽ được sử dụng để cải thiện trải nghiệm của bạn trên toàn bộ trang web, quản lý quyền truy cập vào tài khoản của bạn và đảm bảo tính an toàn. Chúng tôi cam kết bảo vệ thông tin cá nhân của bạn và sử dụng chúng chỉ cho mục đích được mô tả trong Chính sách Riêng tư của chúng tôi.
                </p>        
            </div>
        </div>
        <div class="col l-9 m-12 c-12 mt-90">
            <div class="content__main-l">
                <form action="/customer/register" method="post">
                    @csrf
                    <div class="row">
                        <div class="col l-12 m-12 c-12">
                            <div class="form-gruop">
                                <input type="text" class="input" name="name" placeholder="Họ và tên" value="{{old('name')}}">
                                @if ($errors->first('name'))
                                    <span class="err-msg">{{$errors->first('name')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col l-6 m-12 c-12">
                            <div class="form-gruop">
                                <input type="text" class="input" name="email" placeholder="Email..." value="{{old('email')}}">
                                @if ($errors->first('email'))
                                    <span class="err-msg">{{$errors->first('email')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col l-6 m-12 c-12">
                            <div class="form-gruop">
                                <input class="input" name="phone" placeholder="Số điện thoại..." value="{{old('phone')}}">
                                @if ($errors->first('phone'))
                                    <span class="err-msg">{{$errors->first('phone')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col l-6 m-12 c-12">
                            <div class="form-gruop">
                                <select class="input input-select form-select form-select-sm mb-3" name="city" id="city" aria-label=".form-select-sm">
                                    <option value="{{old('city') ? old('city') : ''}}" selected>{{old('city') ? old('city') : 'Tỉnh thành'}}</option>           
                                </select>
                                @if ($errors->first('city'))
                                    <span class="err-msg">{{$errors->first('city')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col l-6 m-12 c-12">
                            <div class="form-gruop">
                                <select class="input input-select form-select form-select-sm mb-3" name="district" id="district" aria-label=".form-select-sm">
                                    <option value="{{old('district') ? old('district') : ''}}" selected>{{old('district') ? old('district') : 'Quận/Huyện'}}</option>
                                </select>
                                @if ($errors->first('district'))
                                    <span class="err-msg">{{$errors->first('district')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col l-6 m-12 c-12">
                            <div class="form-gruop">
                                <select class="input input-select form-select form-select-sm" name="ward" id="ward" aria-label=".form-select-sm">
                                    <option value="{{old('ward') ? old('ward') : ''}}" selected>{{old('ward') ? old('ward') : 'Phường/Xã'}}</option>
                                </select>
                                @if ($errors->first('ward'))
                                    <span class="err-msg">{{$errors->first('ward')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col l-6 m-12 c-12">
                            <div class="form-gruop">
                                <input class="input" name="street_name" placeholder="Số nhà, tên đường..." value="{{old('street_name')}}">
                                @if ($errors->first('street_name'))
                                    <span class="err-msg">{{$errors->first('street_name')}}</span>
                                @endif
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class="col l-12 m-12 c-12">
                            <div class="form-gruop dp-flex">
                                <label class="form-gruop__lbl" for="male">Nam</label>
                                <input type="radio" name="gender" id="male" value="nam" {{old('gender') == 'nam' ? 'checked' : ''}}>

                                <label class="form-gruop__lbl" for="female">nữ</label>
                                <input type="radio" name="gender" id="female" value="nữ" {{old('gender') == 'nữ' ? 'checked' : ''}}>
                            </div>
                            @if ($errors->first('gender'))
                                <span class="err-msg">{{$errors->first('gender')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col l-12 m-12 c-12">
                            <div class="form-gruop">
                                <input type="password" class="input" name="password" placeholder="Mật khẩu...">
                                @if ($errors->first('password'))
                                    <span class="err-msg">{{$errors->first('password')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col l-12 m-12 c-12">
                            <div class="form-gruop">
                                <input type="password" class="input" name="password_confirmation" placeholder="Nhập lại mật khẩu...">
                                @if ($errors->first('password'))
                                    <span class="err-msg">{{$errors->first('password')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col l-12">
                            <div class="form-gruop dp-flex">
                                <button type="submit" class="submit-btn">Tạo tài khoản</button>
                                <p>Hoặc <a href="/customer/login">đăng nhập</a> nếu bạn đã có tài khoản</p>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection