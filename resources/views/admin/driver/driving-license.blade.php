@extends('admin.layout.app')
@section('content')
<div class="row">
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between mb-3">
                <h5 class="mb-0">Bằng lái xe</h5>
                <a  class="btn btn-primary" href="/admin/driver">Back</a>
            </div>
            <div class="card-body">
              <div class="mb-4">
                <label class="lb-title mb-2" for="basic-default-name">ID</label>
                <div class="col-sm-10">
                  <p class="info-col">{{$drivingLicense->driving_license_id}}</p>
                </div>
              </div>
              <div class="mb-4">
                <label class="lb-title mb-2" for="basic-default-name">Họ tên</label>
                <div class="col-sm-10">
                  <p class="info-col">{{$drivingLicense->full_name}}</p>
                </div>
              </div>
              <div class="mb-4">
                <label class="lb-title mb-2" for="basic-default-name">Ngày sinh</label>
                <div class="col-sm-10">
                  <p class="info-col">{{$drivingLicense->date_of_birth}}</p>
                </div>
              </div>
              <div class="mb-4">
                <label class="lb-title mb-2" for="basic-default-name">Hạng</label>
                <div class="col-sm-10">
                    <p class="info-col">{{$drivingLicense->class}}</p>
                </div>
              </div>
              <div class="mb-4">
                <label class="lb-title mb-2" for="basic-default-name">Địa chỉ</label>
                <div class="col-sm-10">
                  <p class="info-col">{{$drivingLicense->address}}</p>
                </div>
              </div>
              <div class="mb-4">
                <label class="lb-title mb-2" for="basic-default-name">Ngày hết hạn</label>
                <div class="col-sm-10">
                  <p class="info-col">{{$drivingLicense->expires}}</p>
                </div>
              </div>
              <div class="mb-4">
                <label class="lb-title mb-2" for="basic-default-name">Ngày thi</label>
                <div class="col-sm-10">
                  <p class="info-col">{{$drivingLicense->beginning_date}}</p>
                </div>
              </div>
              <div class="mb-4">
                <label class="lb-title mb-2" for="basic-default-name">Ngày cấp</label>
                <div class="col-sm-10">
                  <p class="info-col">{{$drivingLicense->date_of_issue}}</p>
                </div>
              </div>
              <div class="mb-4">
                <label class="lb-title mb-2" for="basic-default-name">Nơi cấp</label>
                <div class="col-sm-10">
                  <p class="info-col">{{$drivingLicense->issued_by}}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection