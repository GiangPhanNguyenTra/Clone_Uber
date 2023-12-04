@extends('main.layouts.app')
@section('content')
<div class="content">
    <div class="content__thumbnail" style="background-color: #9ba685">
        <img src="https://chaai.qodeinteractive.com/wp-content/uploads/2021/08/landing-img15.jpg" alt="">
        <div class="content__thumbnail-text">
            <h3>Phương tiện</h3>
        </div>
    </div>

    <div class="content__main container content__main-container" style="justify-content: center;">
        <div class="section-content_text form-layout-account active">
            <form action="/driver/vehicle" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <div class="form-gruop">
                            <input type="text" class="input" name="license_plates" placeholder="Biển số xe" value="{{isset($vehicle) ? $vehicle->license_plates : old('license_plates')}}">
                            @if ($errors->first('license_plates'))
                                <span class="err-msg">{{$errors->first('license_plates')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
        
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <div class="form-gruop">
                            <input type="text" class="input" name="brand" placeholder="Thương hiệu" value="{{isset($vehicle) ? $vehicle->brand : old('brand')}}">
                            @if ($errors->first('brand'))
                                <span class="err-msg">{{$errors->first('brand')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <div class="form-gruop">
                            <input type="text" class="input" name="color" placeholder="Màu sắc" value="{{isset($vehicle) ? $vehicle->color : old('color')}}">
                            @if ($errors->first('color'))
                                <span class="err-msg">{{$errors->first('color')}}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <div class="form-gruop">
                            <input type="text" class="input" name="model_code" placeholder="Mã xe" value="{{isset($vehicle) ? $vehicle->model_code : old('model_code')}}">
                            @if ($errors->first('model_code'))
                                <span class="err-msg">{{$errors->first('model_code')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <p>Ví dụ: wave 110, vison 125,...</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <div class="form-gruop dp-flex">
                            <button type="submit" class="submit-btn">Cập nhật</button>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection