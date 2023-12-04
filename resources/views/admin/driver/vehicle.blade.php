@extends('admin.layout.app')
@section('content')
<div class="row">
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between mb-3">
                <h5 class="mb-0">Phương tiện</h5>
                <a  class="btn btn-primary" href="/admin/driver">Back</a>
            </div>
            <div class="card-body">
              <div class="mb-4">
                <label class="lb-title mb-2" for="basic-default-name">Biển số xe</label>
                <div class="col-sm-10">
                  <p class="info-col">{{$vehicle->license_plates}}</p>
                </div>
              </div>
              <div class="mb-4">
                <label class="lb-title mb-2" for="basic-default-name">Thương hiệu</label>
                <div class="col-sm-10">
                  <p class="info-col">{{$vehicle->brand}}</p>
                </div>
              </div>
              <div class="mb-4">
                <label class="lb-title mb-2" for="basic-default-name">Màu sắc</label>
                <div class="col-sm-10">
                  <p class="info-col">{{$vehicle->color}}</p>
                </div>
              </div>
              <div class="mb-4">
                <label class="lb-title mb-2" for="basic-default-name">Mã xe</label>
                <div class="col-sm-10">
                    <p class="info-col">{{$vehicle->model_code}}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection