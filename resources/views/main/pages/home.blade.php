@extends('main.layouts.app')
@section('content')
<div class="content">
    <div class="main__background">
        <video autoplay loop muted>
            <source src="/main/asset/vid/uber-background.mp4" type="video/mp4">
        </video>

        {{-- img responsive --}}
        <img src="../main/asset/img/Banner-Ride-sharing-Apps.png" alt="">

        <div class="main__background-text ">
            <div class="main__background-title">
                Tính chất độc đáo <br> Trong từng chuyến đi
            </div>
            <div class="main__background-content">
                Uber mang đến trải nghiệm di chuyển thuận tiện, thoải mái, và an toàn cho những người yêu cầu dịch vụ vận chuyển. Từ những tài xế chuyên nghiệp đến hệ thống đặt xe tiện lợi, chúng tôi cam kết cung cấp dịch vụ vận chuyển đẳng cấp nhất. Hãy trải nghiệm ngay để khám phá sự thuận tiện và linh hoạt trong mọi hành trình của bạn.
            </div>
        </div>
    </div>
    <div class="intro container intro-container wow fadeInUp row" data-wow-duration="1s" data-wow-delay="0.5s" data-wow-offset="10">
        <div class="col l-5 m-12 c-12">
            <div class="intro__img">
                <img src="/main/asset/img/ride-with-uber.jpg" alt="">
            </div>
        </div>
        <div class="col l-7 m-12 c-12">
            <div class="intro__content">
                <h2 class="intro__content-title">
                    Uber khẳng định đẳng cấp di chuyển
                </h2>
                <p class="intro__content-text">
                    Với chất lượng dịch vụ tối ưu, đội ngũ tài xế chuyên nghiệp và đa dạng loại xe, chúng tôi chọn lọc từng đối tác đáng tin cậy để mang đến trải nghiệm di chuyển đỉnh cao. Được phục vụ từ các khu vực trung tâm đến ngoại ô, từ dịch vụ xe tiêu chuẩn đến dòng xe sang trọng, mỗi chuyến đi của bạn trở nên đặc biệt với chúng tôi. Chúng tôi cam kết hợp tác cùng các đối tác để xây dựng hình ảnh thương hiệu dịch vụ vận chuyển Việt Nam, đồng thời đề cao giá trị của dịch vụ đặt xe Việt Nam trên thị trường quốc tế, với trọng tâm là sự thoải mái và an toàn cho hành trình của mọi người.
                </p>
                <button class="btn btn-intro"><a href="">Xem Thêm</a></button>
            </div>
        </div>
    </div>
    <div class="main__slider">
        <div class="main__slider-heading">
            <h3>Dịch Vụ Đặt Xe Của Chúng Tôi</h3>
            <div class="main__slider-nav">
                <svg class="nav-prev" x="0px" y="0px" width="24.83px" height="18.58px" viewBox="3.33 2.67 24.83 18.58" enable-background="new 3.33 2.67 24.83 18.58" xml:space="preserve">
                    <line fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" x1="27.25" y1="12" x2="4.25" y2="12"/>
                    <polyline fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" points="12.75,20.5 4.25,12 12.75,3.5 "/>
                </svg>
                <svg class="nav-next" x="0px" y="0px" width="24.83px" height="18.58px" viewBox="3.33 2.67 24.83 18.58" enable-background="new 3.33 2.67 24.83 18.58" xml:space="preserve">
                    <line fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" x1="4.25" y1="12" x2="27.25" y2="12"/>
                    <polyline fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" points="18.75,3.5   27.25,12 18.75,20.5 "/>
                </svg>
            </div>
        </div>
        <div class="main__slider-wrapper">
            <div class="card-item">
                <img src="main/asset/img/card-item-img/ride-card-item-img-1.jpg" alt="">
                <div class="card-item-content">
                    <h3>Trải Nghiệm Đặt Xe Thuận Tiện</h3>
                    <p>Khám phá sự thuận tiện và an toàn với ứng dụng đặt xe của chúng tôi</p>
                    <a href="/booking" class="button">Đặt Ngay</a>
                </div>
            </div>
            <div class="card-item">
                <img src="main/asset/img/card-item-img/ride-card-item-img-2.jpg" alt="">
                <div class="card-item-content">
                    <h3>Chuyến Đi An Toàn</h3>
                    <p>Đặt xe với đội tài xế chuyên nghiệp và xe đảm bảo an toàn, chất lượng.</p>
                    <a href="/booking" class="button">Đặt Ngay</a>
                </div>
            </div>
            <div class="card-item">
                <img src="main/asset/img/card-item-img/ride-card-item-img-3.jpg" alt="">
                <div class="card-item-content">
                    <h3>Khám Phá Địa Điểm Mới</h3>
                    <p>Đặt xe và khám phá những địa điểm mới, thoải mái và tiện lợi.</p>
                    <a href="/booking" class="button">Đặt Ngay</a>
                </div>
            </div>
            <div class="card-item">
                <img src="main/asset/img/card-item-img/ride-card-item-img-4.jpg" alt="">
                <div class="card-item-content">
                    <h3>Dịch Vụ 24/7</h3>
                    <p>Đặt xe mọi lúc, mọi nơi với dịch vụ hỗ trợ 24/7.</p>
                    <a href="/booking" class="button">Đặt Ngay</a>
                </div>
            </div>
            <div class="card-item">
                <img src="main/asset/img/card-item-img/ride-card-item-img-5.jpg" alt="">
                <div class="card-item-content">
                    <h3>Dịch Vụ Đội Xe Đa Dạng</h3>
                    <p>Chọn lựa từ đội xe đa dạng, phục vụ mọi nhu cầu di chuyển của bạn.</p>
                    <a href="/booking" class="button">Đặt Ngay</a>
                </div>
            </div>
        </div>
    </div>
    <div class="main__offers container offer-container row">
        <div class="col l-7 m-12 c-12">
            <div class="main__offers-list wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s" data-wow-offset="10">
                <div class="main__offers-list__header">
                    <h2>Ưu đãi hấp dẫn</h2>
                </div>
                <ul class="lst-product-offers">
                    <li>
                        <div class="lst-product-offers__heading">
                            <h6 class="lst-product-offers__heading__name">Ưu Đãi Cho Người Dùng Mới</h6>
                            <div class="lst-product-offers__heading__line"></div>
                            <h6 class="lst-product-offers__heading__price">₫19.85</h6>
                        </div>
                        <p class="lst-product-offers__desc">Giảm giá đặc biệt cho người dùng mới khi họ thực hiện chuyến đi đầu tiên.</p>
                    </li>
                    <li>
                        <div class="lst-product-offers__heading">
                            <h6 class="lst-product-offers__heading__name">Chương Trình Thưởng Điểm</h6>
                            <div class="lst-product-offers__heading__line"></div>
                            <h6 class="lst-product-offers__heading__price">₫19.00</h6>
                        </div>
                        <p class="lst-product-offers__desc">Hệ thống tích điểm khi sử dụng dịch vụ, sau mỗi chuyến đi.</p>
                    </li>
                    <li>
                        <div class="lst-product-offers__heading">
                            <h6 class="lst-product-offers__heading__name">Ưu Đãi Phối Hợp với Đối Tác</h6>
                            <div class="lst-product-offers__heading__line"></div>
                            <h6 class="lst-product-offers__heading__price">₫39.39</h6>
                        </div>
                        <p class="lst-product-offers__desc">Hợp tác với các đối tác kinh doanh để mang lại ưu đãi đặc biệt cho người dùng.</p>
                    </li>
                    <li>
                        <div class="lst-product-offers__heading">
                            <h6 class="lst-product-offers__heading__name">Ưu Đãi Mùa Lễ và Sự Kiện</h6>
                            <div class="lst-product-offers__heading__line"></div>
                            <h6 class="lst-product-offers__heading__price">$42.09</h6>
                        </div>
                        <p class="lst-product-offers__desc">iảm giá và ưu đãi cho người dùng Uber trong các dịp lễ, sự kiện đặc biệt.</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col l-5 m-12 c-12">
            <div class="main__offers-img wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s" data-wow-offset="10">
                <img src="main/asset/img/u4b-square.jpg" alt="">
            </div>
        </div>
    </div>
    <div class="main__more-info container more-info-container">
        <h3 class="main__more-info__heading">
            Câu chuyện thành công <br> Tạo ra một siêu ứng dụng
        </h3>
        <div class="main__more-info__wrapper wow fadeInUp row" data-wow-duration="1s" data-wow-delay="0.5s" data-wow-offset="10">
            <div class="col l-3 m-6 c-0">
                <div class="main__more-info__img">
                    <img src="main/asset/img/coLanding-section-05-d.png" alt="">
                </div>
            </div>
            <div class="col l-4 m-6 c-12">
                <div class="main__more-info__img">
                    <img src="main/asset/img/coLanding-section-04-d.jpg" alt="">
                </div>
            </div>
            <div class="col l-5 m-12 c-12">
                <ul class="main__more-info__lst">
                    <li>
                        <h4 class="main__more-info__lst__title">
                            Khởi Đầu
                        </h4>
                        <div class="main__more-info__lst-desc">
                            Uber bắt đầu với một ý tưởng đơn giản - tạo ra một nền tảng đặt xe tiện lợi và an toàn.
                        </div>
                    </li>
                    <li>
                        <h4 class="main__more-info__lst__title">
                            Sự Khác Biệt
                        </h4>
                        <div class="main__more-info__lst-desc">
                            Uber không chỉ đơn thuần là một ứng dụng đặt xe, mà là một trải nghiệm di chuyển toàn diện. 
                        </div>
                    </li>
                    <li>
                        <h4 class="main__more-info__lst__title">
                            An Toàn Là Quan Trọng Nhất
                        </h4>
                        <div class="main__more-info__lst-desc">
                            Uber luôn đặt an toàn làm ưu tiên hàng đầu. Tất cả các tài xế đều được kiểm tra kỹ lưỡng và chúng tôi tự hào về việc cung cấp cho người dùng một phương tiện an toàn và tin cậy để di chuyển.
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main__feedback container feedback-container">
        <div class="double-sign">”</div>
        <div class="feedback__slider-wrapper">
            <div class="feedback__item">
                <h4 class="">Uber đã đáp ứng mọi kỳ vọng của tôi. Dịch vụ đặt xe nhanh chóng, an toàn và tiện lợi. Tôi sẽ tiếp tục sử dụng nó trong tương lai.</h4>
                <h6>Sandra Patel</h6>
            </div>
            <div class="feedback__item">
                <h4 class="">Uber đã tạo ra một trải nghiệm đặt xe không giống ai. Ứng dụng di động mạnh mẽ, đội tài xế chuyên nghiệp, và sự linh hoạt với nhiều lựa chọn xe đã làm cho mọi chuyến đi của tôi trở nên tuyệt vời.</h4>
                <h6>Phan Tấn Duy</h6>
            </div>
            <div class="feedback__item">
                <h4 class="">Tôi đã cần sự hỗ trợ và dịch vụ chăm sóc khách hàng của Uber đã làm tôi cảm thấy được quan tâm và giải quyết vấn đề của mình ngay lập tức.</h4>
                <h6>Sandra Patel</h6>
            </div>
        </div>

        <svg class="feedback__slider-prev" x="0px" y="0px" width="33.6px" height="65.79px" viewBox="0 0 33.6 65.79" enable-background="new 0 0 33.6 65.79" xml:space="preserve">
            <polyline fill="none" stroke="#23261d" stroke-width="1.2" stroke-miterlimit="10" points="33.28,0.41 0.75,32.94 33.22,65.41 "></polyline>
        </svg>
        <svg class="feedback__slider-next" x="0px" y="0px" width="33.67px" height="65.82px" viewBox="0 0 33.67 65.82" enable-background="new 0 0 33.67 65.82" xml:space="preserve">
            <polyline fill="none" stroke="#23261d" stroke-width="1.2" stroke-miterlimit="10" points="0.39,0.39 32.91,32.91 0.44,65.39 "></polyline>
        </svg>
    </div>
    <div class="main__img-container">
        <div class="col l-5 m-0 c-0">
            <div class="img-wrapper img-wrapper__left wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s" data-wow-offset="10">
                <img src="main/asset/img/Taxify-app.png" alt="">
            </div>
        </div>
        <div class="col l-7 m-12 c-12">
            <div class="img-wrapper wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s" data-wow-offset="10">
                <img src="main/asset/img/The-advantages-of-using-ride-hailing-as-a-mode-of-transportation.jpg" alt="">
            </div>
        </div>
    </div>
</div>    
@endsection

