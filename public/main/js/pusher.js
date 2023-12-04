var driverId = document.getElementById("driver-id");
var customerId = document.getElementById('customer-id');
var confirmModel = document.querySelector(".confirm-model");
var confirmModeContent = confirmModel.querySelector(".model-content");
var notifierOverlay = document.querySelector(".notifier-overlay");
var notifierFixed = document.querySelector(".notifier-fixed ");
var noticesCount = document.querySelectorAll('.cart-count');
var loaderWaitingContainer = document.querySelector(".loader-waiting-container");

// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

// khởi tạo pusher
var pusher = new Pusher("ec75a361ce3c349e5a19", {
    cluster: "ap1",
});

if (driverId) {
    // khởi tạo kênh
    var channel = pusher.subscribe("booking-ride-channel." + driverId.value);

    // lắng nghe sự kiện
    channel.bind("new-booking-ride", function (data) {

        const driverId = data.driverId;
        const ride = data.ride;
        const customer = data.customer;

        // Now you can use these variables in your HTML or wherever needed
        console.log(driverId);
        console.log(ride);
        console.log(customer);

        confirmModel.classList.add("active");

        var html = `<form action="/customer/booking-ride" method="post">
                    <p>Tên khách hàng: ${customer.name}</p>
                    <p>Số điện thoại: ${customer.phone}</p>
                    <p>Điểm đón: ${ride.start_location_name}</p>
                    <p>Điểm đến: ${ride.end_location_name}</p>
                    <p>Quãng đường: ${ride.distance} km</p>
                    <p>Tổng tiền: ${ride.price} vnd</p>
                    <p>*Vui lòng gọi điện khách hàng để xác nhận cuốc xe trước khi bắt đầu đến điểm đón khách</p>
                    <a style="margin-top: 20px" href="/driver/accept/booking-ride/${ride.ride_id}" class="submit-btn">Xác nhận</a>`;
        
        var htmlNoti = `<div class="notification -info">
                            <h3 class="notification-header">Bạn có cuốc xe mới !!!</h3>
                            <p class="notification-header">
                                Ấn vào phía dưới để xác nhận cuộc xe
                            </p>
                            <a style="margin-top: 20px" href="/driver/accept/booking-ride/${ride.ride_id}">Xác nhận</a>
                        </div>`;

        notifierFixed.innerHTML = htmlNoti;
        localStorage.setItem('booking-notice', '/driver/accept/booking-ride/'+driverId);
        defaultCheckNotification();
        confirmModeContent.innerHTML = html;
        notifierOverlay.classList.add("active");
    });
}

if (customerId) {
    // khởi tạo kênh
    var channel = pusher.subscribe("booking-ride-channel." + customerId.value);

    // lắng nghe sự kiện
    channel.bind("accept-booking-ride", function (data) {
        const customerId = data.customerId;
        const ride = data.ride;
        const driver = data.driver;
        const vehicle = data.vehicle;
        
        if (loaderWaitingContainer) {
            loaderWaitingContainer.style.display = 'none';

            var mapInfomation = document.querySelector('.map-infomation');
            var html = `<h2>Thông tin về chuyến xe</h2>
                        <p>Điểm đi: ${ride.start_location_name}</p>
                        <p>Điểm đến: ${ride.end_location_name}</p>
                        <p class="distance">Quãng đường: ${ride.distance} Km</p>
                        <p class="price">Tổng tiền: ${ride.price} vnđ</p>
                        <p class="price">Trạng thái: ${ride.status_description}</p>
                        <h2>Thông tin tài xế</h2>
                        <p>Họ tên: ${driver.name}</p>
                        <p>Số điện thoại: ${driver.phone}</p>
                        <p>Ảnh đại diện: </p>
                        <div class="img-user">
                        <div class="img-user">
                            <img src="${driver.avata !== null ? `http://localhost:8000/upload/images/driver-avata/${driver.avata}` : 'https://pbs.twimg.com/media/EbNX_erVcAUlwIx.jpg:large'}" alt="">
                        </div>
                        <h2>Thông phương tiện di chuyển</h2>
                        <p class="distance">Biển số xe: ${vehicle.license_plates}</p>
                        <p class="price">Thương hiệu: ${vehicle.brand}</p>
                        <p class="price">Màu sắc: ${vehicle.color}</p>
                        <p class="price">Tên xe: ${vehicle.model_code}</p>`;
            
            mapInfomation.innerHTML = html;
            mapInfomation.style.height = 'auto';
            confirmModeContent.innerHTML = `<p>Chuyến đi của bạn đã được tài xế chấp thuận</p>
                                            <a style="margin-top: 20px" href="/customer/booking-ride">Xem chi tiết</a>`;
            notifierOverlay.classList.add("active");
            confirmModel.classList.add("active");
        }
    });

    // thông báo khi cuốc xe hoàn thành cho tài xế
    channel.bind("complete-booking-ride", function (data) {
        alert('ok');
    });
}

notifierOverlay.onclick = () => {
    confirmModel.classList.remove("active");
    notifierOverlay.classList.remove("active");
    notifierFixed.classList.remove("active");
};

function defaultCheckNotification() {
    console.log(notifierFixed.children.length);
    noticesCount.forEach((item) => {item.innerHTML= '(' + notifierFixed.children.length + ')'});
}
