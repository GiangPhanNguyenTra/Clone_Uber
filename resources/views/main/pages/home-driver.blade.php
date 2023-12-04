@extends('main.layouts.app')
@section('content')
<div class="content">
    <div class="intro container intro-container intro-container-driver wow fadeInUp row" data-wow-duration="1s" data-wow-delay="0.5s" data-wow-offset="10">
        <div class="col l-7 m-12 c-12" style="display: flex; align-items:center">
            <div class="intro__content" style="padding-left: none; padding-right: 50px; margin:50px 0">
                <h2 class="intro__content-title">
                    Lái xe khi bạn muốn, làm những gì bạn cần
                </h2>
                <p class="intro__content-text">
                    Kiếm tiền theo lịch trình của riêng bạn.
                </p>
                @if (!Auth::guard('driver')->check())
                    <button class="btn btn-second btn-intro"><a href="/driver/register">Bắt đầu ngay</a></button>
                @endif
            </div>
        </div>
        <div class="col l-5 m-12 c-12">
            <div class="intro__img">
                <img src="https://www.uber-assets.com/image/upload/f_auto,q_auto:eco,c_fill,w_558,h_558/v1674469324/assets/5c/bb99fd-ae8e-4193-87f7-936621d16835/original/ERND_Perf22Q2-MobLA_LS-P_DL-Lanita-Getting-Ready_16x9.jpg" alt="">
            </div>
        </div>
    </div>
    <div class="intro container intro-container wow fadeInUp row" data-wow-duration="1s" data-wow-delay="0.5s" data-wow-offset="10">
        <div class="col l-5 m-12 c-12" style="display: flex; align-items:center">
            <div class="intro__img">
                <img src="../main/asset/img/coLanding-section-04-d.jpg" alt="">
            </div>
        </div>
        <div class="col l-7 m-12 c-12" style="display: flex; align-items:center">
            <div class="intro__content">
                <h2 class="intro__content-title">
                    Một giải pháp thay thế cho công việc lái xe truyền thống
                </h2>
                <p class="intro__content-text" style="padding-left: none;">
                    Lái xe với Uber mang đến cơ hội kiếm tiền linh hoạt. Đó là một sự thay thế tuyệt vời cho công việc lái xe toàn thời gian, công việc lái xe bán thời gian hoặc các hợp đồng biểu diễn bán thời gian khác, công việc tạm thời hoặc việc làm theo thời vụ. Hoặc có thể bạn đã là tài xế đi chung xe và muốn bổ sung thu nhập bằng cách trở thành tài xế sử dụng nền tảng Uber.
                    Các tài xế sử dụng Uber đến từ mọi nền tảng và ngành nghề, họ tự đặt lịch trình để công việc phù hợp với cuộc sống của họ chứ không phải ngược lại.
                    Uber cung cấp giải pháp thay thế cho công việc lái xe bán thời gian truyền thống ở tất cả các thành phố lớn ở Hoa Kỳ, bao gồm Atlanta, Chicago, Houston, Los Angeles, Miami, Thành phố New York, San Francisco và Seattle—cộng với hàng trăm thành phố khác thuộc mọi quy mô trên khắp nước Mỹ. Quốc gia.
                </p>
            </div>
        </div>
    </div>
    <div class="intro container intro-container intro-container-driver-second wow fadeInUp row" data-wow-duration="1s" data-wow-delay="0.5s" data-wow-offset="10">
        <div class="col l-6 m-12 c-12" style="display: flex; align-items:center">
            <div class="intro__content" style=" margin:50px 0">
                <h2 class="intro__content-title">
                    Kiếm tiền mọi lúc, mọi nơi
                </h2>
                <p class="intro__content-text">
                    Cho dù thỉnh thoảng bạn chỉ muốn lái xe trong vài giờ hay bạn là người dùng thường xuyên hơn ứng dụng Tài xế của Uber, thì với Uber, bạn có thể điều chỉnh việc lái xe xung quanh những gì quan trọng nhất đối với mình. Lái xe bất cứ lúc nào và vào bất kỳ ngày nào trong tuần. Các tính năng trong ứng dụng Driver sẽ giúp bạn tìm người lái xe theo thời gian thực, nhờ đó, bạn có thể được thông báo về các cơ hội kiếm tiền ở gần.
                </p>
            </div>
        </div>
        <div class="col l-6 m-12 c-12">
            <div class="intro__img">
                <img src="../main/asset/img/smart-phone.png" alt="">
            </div>
        </div>
    </div>
</div>    
@endsection

