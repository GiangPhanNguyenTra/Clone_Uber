var dailyEarningDate = document.querySelector('.daily_earning_date');
var authValue = document.querySelector('.auth');

dailyEarningDate.onchange = () => {
    var date = dailyEarningDate.value;
    var auth = authValue.value;
    fetch('/'+auth+'/ride/sort', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
            date: date,
            auth: auth
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (auth == 'driver') {
            renderSortRideOfDriver(data)
        } else {
            renderSortRideOfCustomer(data);
        }
        
    })
    .catch(error => {
        // Xử lý lỗi nếu có
        console.error('Error:', error);
    });
}

function renderSortRideOfCustomer(data) {
    // Lấy ra div cần inner HTML
    var sectionContent = document.querySelector('.section-content_text.form-layout-order.mt-0.active');

    // Xóa nội dung hiện tại của div
    sectionContent.innerHTML = '';

    // Kiểm tra nếu có dữ liệu
    if (data.sortRide.length !== 0) {
        // Tạo bảng
        var table = document.createElement('table');
        table.className = 'order-table';

        // Tạo thead
        var thead = document.createElement('thead');
        var headerRow = document.createElement('tr');
        headerRow.innerHTML = `
            <td class="order-id">Mã cuốc xe</td>
            <td class="order-reciver">Mã tài xế</td>
            <td class="order-money">Quãng đường</td>
            <td class="order-date">Tổng tiền</td>
            <td class="order-status">Trạng thái</td>
            <td class="order-detail"></td>
        `;
        thead.appendChild(headerRow);

        // Tạo tbody
        var tbody = document.createElement('tbody');
        data.sortRide.forEach(ride => {
            var row = document.createElement('tr');
            row.innerHTML = `
                <td class="order-id"><span>${ride.ride_id}</span></td>
                <td class="order-reciver">${ride.driver_id}</td>
                <td class="order-money">${ride.distance} Km</td>
                <td class="order-date">${ride.price} VNĐ</td>
                <td class="order-status" style="color: ${ride.status_code === 1 ? 'rgb(255, 0, 0)' : '#98a67c'}; font-weight:bold">${ride.status_description}</td>
                <td class="order-detail"><button class="btn btn-intro info mt-0"><a href="/customer/detail-ride/${ride.ride_id}">Chi tiết</a></button></td>
            `;
            tbody.appendChild(row);
        });

        // Thêm thead và tbody vào table
        table.appendChild(thead);
        table.appendChild(tbody);

        // Thêm table vào div
        sectionContent.appendChild(table);
    } else {
        // Nếu không có dữ liệu, hiển thị thông báo
        var noDataMessage = document.createElement('h3');
        noDataMessage.textContent = 'Không có dữ liệu';
        sectionContent.appendChild(noDataMessage);
    }
}

function renderSortRideOfDriver(data) {
    // Lấy ra div cần inner HTML
    var sectionContent = document.querySelector('.section-content_text.form-layout-order.mt-0.active');

    // Xóa nội dung hiện tại của div
    sectionContent.innerHTML = '';

    // Kiểm tra nếu có dữ liệu
    if (data.sortRide.length !== 0) {
        // Tạo bảng
        var table = document.createElement('table');
        table.className = 'order-table';

        // Tạo thead
        var thead = document.createElement('thead');
        var headerRow = document.createElement('tr');
        headerRow.innerHTML = `
            <td class="order-id">Mã cuốc xe</td>
            <td class="order-reciver">Mã khách hàng</td>
            <td class="order-money">Quãng đường</td>
            <td class="order-date">Tổng tiền</td>
            <td class="order-status">Trạng thái</td>
            <td class="order-detail"></td>
        `;
        thead.appendChild(headerRow);

        // Tạo tbody
        var tbody = document.createElement('tbody');
        data.sortRide.forEach(ride => {
            var row = document.createElement('tr');
            row.innerHTML = `
                <td class="order-id"><span>${ride.ride_id}</span></td>
                <td class="order-reciver">${ride.customer_id}</td>
                <td class="order-money">${ride.distance} Km</td>
                <td class="order-date">${ride.price} VNĐ</td>
                <td class="order-status" style="color: ${ride.status_code === 1 ? 'rgb(255, 0, 0)' : '#98a67c'}; font-weight:bold">${ride.status_description}</td>
                <td class="order-detail"><button class="btn btn-intro info mt-0"><a href="/driver/detail-ride/${ride.ride_id}">Chi tiết</a></button></td>
            `;
            tbody.appendChild(row);
        });

        // Thêm thead và tbody vào table
        table.appendChild(thead);
        table.appendChild(tbody);

        // Thêm table vào div
        sectionContent.appendChild(table);

        // Thêm phần còn lại của giao diện
        sectionContent.innerHTML += `
            <div style="margin-top:30px" class="daily_earning">
                <h3>Thu nhập ngày ${data.sortDailyEarning.date}</h3>
                <table class="cart-info-table">
                    <tbody>
                        <tr>
                            <th>Tổng cuốc xe: </th>
                            <td>${data.sortDailyEarning.total_rides}</td>
                        </tr>
                        <tr>
                            <th>Tổng tiền: </th>
                            <td>${data.sortDailyEarning.total_earnings} VNĐ</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        `;

    } else {
        // Nếu không có dữ liệu, hiển thị thông báo
        var noDataMessage = document.createElement('h3');
        noDataMessage.textContent = 'Không có dữ liệu';
        sectionContent.appendChild(noDataMessage);
    }
}