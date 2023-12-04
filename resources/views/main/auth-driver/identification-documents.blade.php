@extends('main.layouts.app')
@section('content')
<div class="content">
    <div class="content__thumbnail" style="background-color: #9ba685">
        <img src="https://chaai.qodeinteractive.com/wp-content/uploads/2021/08/landing-img15.jpg" alt="">
        <div class="content__thumbnail-text">
            <h3>Giấy tờ của tôi</h3>
        </div>
        <ul class="section-nav section-nav-account">
            <li class="btn btn-intro mt-0 active">Căn cước</li>
            <li class="btn btn-intro mt-0">Bằng Lái</li>
            <div class="line line-nav-account"></div>
        </ul>
    </div>

    <div class="content__main container content__main-container" style="justify-content: center;">
        <div class="section-content_text form-layout-account active">
            <form action="/driver/citizen-identify-card" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <h3>Số chứng minh</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <div class="form-gruop">
                            <input type="text" class="input" name="citizen_identify_card_id" placeholder="Số căn cước công dân" value="{{isset($citizenIdentifyCard) ? $citizenIdentifyCard->citizen_identify_card_id : old('citizen_identify_card_id')}}">
                            @if ($errors->first('citizen_identify_card_id'))
                                <span class="err-msg">{{$errors->first('citizen_identify_card_id')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <h3>Họ tên</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <div class="form-gruop">
                            <input type="text" class="input" name="full_name" placeholder="Họ tên" value="{{$driver->name ?? ''}}">
                            @if ($errors->first('full_name'))
                                <span class="err-msg">{{$errors->first('full_name')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <h3>Ngày sinh</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <div class="form-gruop">
                            <input type="date" class="input" name="date_of_birth" placeholder="Ngày sinh" value="{{isset($citizenIdentifyCard) ? $citizenIdentifyCard->date_of_birth : old('date_of_birth')}}">
                            @if ($errors->first('date_of_birth'))
                                <span class="err-msg">{{$errors->first('date_of_birth')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <h3>Giới tính</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <div class="form-gruop dp-flex">
                            <label class="form-gruop__lbl" for="male">Nam</label>
                            <input type="radio" name="gender" id="male" value="nam" {{(isset($citizenIdentifyCard->gender) && $citizenIdentifyCard->gender == 'nam') ? 'checked' : (old('gender') == 'nam' ? 'checked' : '')}}>
    
                            <label class="form-gruop__lbl" for="female">nữ</label>
                            <input type="radio" name="gender" id="female" value="nữ" {{(isset($citizenIdentifyCard->gender) && $citizenIdentifyCard->gender == 'nữ') ? 'checked' : (old('gender') == 'nữ' ? 'checked' : '')}}>
    
                            <label class="form-gruop__lbl" for="orther">Khác</label>
                            <input type="radio" name="gender" id="orther" value="khác" {{(isset($citizenIdentifyCard->gender) && $citizenIdentifyCard->gender == 'khác') ? 'checked' : (old('gender') == 'khác' ? 'checked' : '')}}>
                        </div>
                        @if ($errors->first('gender'))
                            <span class="err-msg">{{$errors->first('gender')}}</span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <h3>Quê quán</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-6 m-12 c-12">
                        <div class="form-gruop">
                            <select class="input input-select form-select form-select-sm mb-3" name="place_of_origin_city" id="city1" aria-label=".form-select-sm">
                                <option value="{{isset($placeOfOrigin) ? $placeOfOrigin[2] : old('place_of_origin_city')}}" selected>{{isset($placeOfOrigin) ? $placeOfOrigin[2] : old('place_of_origin_city')}}</option>           
                            </select>
                            @if ($errors->first('city'))
                                <span class="err-msg">{{$errors->first('city')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l-6 m-12 c-12">
                        <div class="form-gruop">
                            <select class="input input-select form-select form-select-sm mb-3" name="place_of_origin_district" id="district1" aria-label=".form-select-sm">
                                <option value="{{isset($placeOfOrigin) ? $placeOfOrigin[1] : old('place_of_origin_district')}}" selected>{{isset($placeOfOrigin) ? $placeOfOrigin[1] : old('place_of_origin_district')}}</option>
                            </select>
                            @if ($errors->first('district'))
                                <span class="err-msg">{{$errors->first('district')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <div class="form-gruop">
                            <select class="input input-select form-select form-select-sm" name="place_of_origin_ward" id="ward1" aria-label=".form-select-sm">
                                <option value="{{isset($placeOfOrigin) ? $placeOfOrigin[0] : old('place_of_origin_ward')}}" selected>{{isset($placeOfOrigin) ? $placeOfOrigin[0] : old('place_of_origin_ward')}}</option>
                            </select>
                            @if ($errors->first('ward'))
                                <span class="err-msg">{{$errors->first('ward')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <h3>Địa chỉ thường trú</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-6 m-12 c-12">
                        <div class="form-gruop">
                            <select class="input input-select form-select form-select-sm mb-3" name="place_of_residence_city" id="city2" aria-label=".form-select-sm">
                                <option value="{{isset($placeOfResidence) ? $placeOfResidence[3] : old('place_of_residence_city')}}" selected>{{isset($placeOfResidence) ? $placeOfResidence[3] : old('place_of_residence_city')}}</option>           
                            </select>
                            @if ($errors->first('city'))
                                <span class="err-msg">{{$errors->first('city')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l-6 m-12 c-12">
                        <div class="form-gruop">
                            <select class="input input-select form-select form-select-sm mb-3" name="place_of_residence_district" id="district2" aria-label=".form-select-sm">
                                <option value="{{isset($placeOfResidence) ? $placeOfResidence[2] : old('place_of_residence_district')}}" selected>{{isset($placeOfResidence) ? $placeOfResidence[2] : old('place_of_residence_district')}}</option>
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
                            <select class="input input-select form-select form-select-sm" name="place_of_residence_ward" id="ward2" aria-label=".form-select-sm">
                                <option value="{{isset($placeOfResidence) ? $placeOfResidence[1] : old('place_of_residence_ward')}}" selected>{{isset($placeOfResidence) ? $placeOfResidence[1] : old('place_of_residence_ward')}}</option>
                            </select>
                            @if ($errors->first('ward'))
                                <span class="err-msg">{{$errors->first('ward')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l-6 m-12 c-12">
                        <div class="form-gruop">
                            <input class="input" name="street_name" placeholder="Số nhà, tên đường..." value="{{isset($placeOfResidence) ? $placeOfResidence[0] : old('street_name')}}">
                            @if ($errors->first('street_name'))
                                <span class="err-msg">{{$errors->first('street_name')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <h3>Ngày Cấp</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <div class="form-gruop">
                            <input type="date" class="input" name="date_of_issue" placeholder="Ngày Cấp" value="{{isset($citizenIdentifyCard) ? $citizenIdentifyCard->date_of_issue : old('date_of_issue')}}">
                            @if ($errors->first('date_of_issue'))
                                <span class="err-msg">{{$errors->first('date_of_issue')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <h3>Ngày hết hạn</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <div class="form-gruop">
                            <input type="date" class="input" name="date_of_expiry" placeholder="Ngày hết hạn" value="{{isset($citizenIdentifyCard) ? $citizenIdentifyCard->date_of_expiry : old('date_of_expiry')}}">
                            @if ($errors->first('date_of_expiry'))
                                <span class="err-msg">{{$errors->first('date_of_expiry')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <h3>Nơi cấp</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <div class="form-gruop">
                            <input type="text" class="input" name="issued_by" placeholder="Nơi cấp" value="{{isset($citizenIdentifyCard) ? $citizenIdentifyCard->issued_by : old('issued_by')}}">
                            @if ($errors->first('issued_by'))
                                <span class="err-msg">{{$errors->first('issued_by')}}</span>
                            @endif
                        </div>
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
        <div class=" section-content_text form-layout-account">
            <form action="/driver/driving-license" method="post">
                @if (Auth::guard('driver')->user()->citizenIdentifyCard == null)
                    <div class="row">
                        <div class="col l-12 m-12 c-12">
                            <h3 style="color: red">*Vui lòng cập nhật căn cước công dân</h3>
                        </div>
                    </div>
                @endif
                @csrf
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <h3>Số giấy phép</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <div class="form-gruop">
                            <input type="text" class="input" name="driving_license_id" placeholder="Số giấy phép" value="{{isset($drivingLicense) ? $drivingLicense->driving_license_id : old('driving_license_id')}}">
                            @if ($errors->first('driving_license_id'))
                                <span class="err-msg">{{$errors->first('driving_license_id')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <h3>Họ tên</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <div class="form-gruop">
                            <input readonly="true" type="text" class="input" name="full_name_driving_license" placeholder="Họ tên" value="{{$driver->name ?? ''}}">
                            @if ($errors->first('full_name_driving_license'))
                                <span class="err-msg">{{$errors->first('full_name_driving_license')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <h3>Ngày sinh</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <div class="form-gruop">
                            <input readonly="true" type="date" class="input" name="date_of_birth" placeholder="Ngày sinh" value="{{isset($citizenIdentifyCard) ? $citizenIdentifyCard->date_of_birth : old('date_of_birth')}}">
                            @if ($errors->first('date_of_birth'))
                                <span class="err-msg">{{$errors->first('date_of_birth')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <h3>Nơi cư trú</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-6 m-12 c-12">
                        <div class="form-gruop">
                            <select disabled class="input input-select form-select form-select-sm mb-3" name="place_of_residence_city" id="city2" aria-label=".form-select-sm">
                                <option value="{{isset($placeOfResidence) ? $placeOfResidence[3] : old('place_of_residence_city')}}" selected>{{isset($placeOfResidence) ? $placeOfResidence[3] : old('place_of_residence_city')}}</option>           
                            </select>
                            @if ($errors->first('city'))
                                <span class="err-msg">{{$errors->first('city')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l-6 m-12 c-12">
                        <div class="form-gruop">
                            <select disabled class="input input-select form-select form-select-sm mb-3" name="place_of_residence_district" id="district2" aria-label=".form-select-sm">
                                <option value="{{isset($placeOfResidence) ? $placeOfResidence[2] : old('place_of_residence_district')}}" selected>{{isset($placeOfResidence) ? $placeOfResidence[2] : old('place_of_residence_district')}}</option>
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
                            <select disabled class="input input-select form-select form-select-sm" name="place_of_residence_ward" id="ward2" aria-label=".form-select-sm">
                                <option value="{{isset($placeOfResidence) ? $placeOfResidence[1] : old('place_of_residence_ward')}}" selected>{{isset($placeOfResidence) ? $placeOfResidence[1] : old('place_of_residence_ward')}}</option>
                            </select>
                            @if ($errors->first('ward'))
                                <span class="err-msg">{{$errors->first('ward')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col l-6 m-12 c-12">
                        <div class="form-gruop">
                            <input readonly="true" class="input" name="street_name" placeholder="Số nhà, tên đường..." value="{{isset($placeOfResidence) ? $placeOfResidence[0] : old('street_name')}}">
                            @if ($errors->first('street_name'))
                                <span class="err-msg">{{$errors->first('street_name')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <h3>Hạng</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <div class="form-gruop">
                            <input readonly="true" type="text" class="input" name="class_driving_license" placeholder="Hạng" value="A1">
                            @if ($errors->first('class_driving_license'))
                                <span class="err-msg">{{$errors->first('class_driving_license')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <h3>Ngày hết hạn</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <div class="form-gruop">
                            <input readonly="true" type="text" class="input" name="expires_driving_license" placeholder="Ngày hết hạn" value="Vô thời hạn">
                            @if ($errors->first('expires_driving_license'))
                                <span class="err-msg">{{$errors->first('expires_driving_license')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <h3>Ngày trúng tuyển</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <div class="form-gruop">
                            <input type="date" class="input" name="beginning_date_driving_license" placeholder="Ngày trúng tuyển" value="{{isset($drivingLicense) ? $drivingLicense->beginning_date : old('beginning_date_driving_license')}}">
                            @if ($errors->first('beginning_date_driving_license'))
                                <span class="err-msg">{{$errors->first('beginning_date_driving_license')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <h3>Ngày cấp</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <div class="form-gruop">
                            <input type="date" class="input" name="date_of_issue_dringving_license" placeholder="Ngày trúng tuyển" value="{{isset($drivingLicense) ? $drivingLicense->date_of_issue : old('date_of_issue_dringving_license')}}">
                            @if ($errors->first('date_of_issue_dringving_license'))
                                <span class="err-msg">{{$errors->first('date_of_issue_dringving_license')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <h3>Nơi cấp</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 m-12 c-12">
                        <div class="form-gruop">
                            <input type="text" class="input" name="issued_by_driving_license" placeholder="Nơi cấp" value="{{isset($drivingLicense) ? $drivingLicense->issued_by : old('issued_by_driving_license')}}">
                            @if ($errors->first('issued_by_driving_license'))
                                <span class="err-msg">{{$errors->first('issued_by_driving_license')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12">
                        <div class="form-gruop dp-flex">
                            <button type="submit" class="submit-btn">Xác Nhận</button>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection