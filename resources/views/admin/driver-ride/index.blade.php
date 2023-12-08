@extends('admin.layout.app')
@section('content')
{{-- modal popup --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color: red">Warring</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          x
        </button>
      </div>
      <form class="form-delete" action="" method="post">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          <p>Bạn có thực sự muốn xóa khách hàng này ??</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary btn-submit-del">Vâng</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- /modal popup --}}

{{-- toast --}}
<div class="toast bg-success align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="d-flex">
    <div class="toast-body">
      @if (session()->has('toast_msg'))
        {{session()->get('toast_msg')}}
      @endif
    </div>
    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close">x</button>
  </div>
</div>
{{-- /toast --}}
    <!-- Basic Bootstrap Table -->
<div class="card">
    <div class="card-header">
        <h5>Lịch sử cuốc xe</h5>
        <div class="form-search d-flex">
            <select id="smallSelect" class="form-select form-select-sm search-type">
              <option value="tên khách hàng">Tên khách hàng</option>
            </select>
            <input type="text" class="form-control form-control-sm search-input" placeholder="Tìm Kiếm">
            <button class="submit-search btn btn-primary btn-sm btn-search-customer">Xác nhận</button>
          </div>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>Mã cuốc xe</th>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Điểm đi</th>
            <th>Điểm đến</th>
            <th>Quảng đường</th>
            <th>Thời gian bắt đầu</th>
            <th>Thời gian kết thúc</th>
            <th>Trạng thái</th>
            <th>Tổng tiền</th>
            <th>Đánh giá</th>
            <th>Bình luận</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @include('admin.driver-ride.driver-ride-table')
        </tbody>
      </table>
    </div>
  </div>
  <!--/ Basic Bootstrap Table -->
@endsection