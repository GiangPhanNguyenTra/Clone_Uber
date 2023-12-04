@extends('admin.layout.app')
@section('content')
<div class="row">
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between mb-3">
                <h5 class="mb-0">Căn cước công dân</h5>
                <a  class="btn btn-primary" href="/admin/driver">Back</a>
            </div>
            <div class="card-body">
              <div class="mb-4">
                <label class="lb-title mb-2" for="basic-default-name">Mã căn cước</label>
                <div class="col-sm-10">
                  <p class="info-col">{{$citizenIdentifyCard->citizen_identify_card_id}}</p>
                </div>
              </div>
              <div class="mb-4">
                <label class="lb-title mb-2" for="basic-default-name">Họ tên</label>
                <div class="col-sm-10">
                  <p class="info-col">{{$citizenIdentifyCard->full_name}}</p>
                </div>
              </div>
              <div class="mb-4">
                <label class="lb-title mb-2" for="basic-default-name">Ngày sinh</label>
                <div class="col-sm-10">
                  <p class="info-col">{{$citizenIdentifyCard->date_of_birth}}</p>
                </div>
              </div>
              <div class="mb-4">
                <label class="lb-title mb-2" for="basic-default-name">Giới tính</label>
                <div class="col-sm-10">
                    <p class="info-col">{{$citizenIdentifyCard->gender}} g</p>
                </div>
              </div>
              <div class="mb-4">
                <label class="lb-title mb-2" for="basic-default-name">Quê quán</label>
                <div class="col-sm-10">
                  <p class="info-col">{{$citizenIdentifyCard->place_of_origin}}</p>
                </div>
              </div>
              <div class="mb-4">
                <label class="lb-title mb-2" for="basic-default-name">Địa chỉ thường trú</label>
                <div class="col-sm-10">
                  <p class="info-col">{{$citizenIdentifyCard->place_of_residence}}</p>
                </div>
              </div>
              <div class="mb-4">
                <label class="lb-title mb-2" for="basic-default-name">Ngày hết hạn</label>
                <div class="col-sm-10">
                  <p class="info-col">{{$citizenIdentifyCard->date_of_expiry}}</p>
                </div>
              </div>
              <div class="mb-4">
                <label class="lb-title mb-2" for="basic-default-name">Ngày cấp</label>
                <div class="col-sm-10">
                  <p class="info-col">{{$citizenIdentifyCard->date_of_issue}}</p>
                </div>
              </div>
              <div class="mb-4">
                <label class="lb-title mb-2" for="basic-default-name">Nơi cấp</label>
                <div class="col-sm-10">
                  <p class="info-col">{{$citizenIdentifyCard->issued_by}}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection