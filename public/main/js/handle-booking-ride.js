import {
    initMap,
    searchPlace,
    getCustomerMarker,
    getDestinationMarker,
    calculateDistanceTrip,
    getReverseGeocode,
    mapClick,
} from "./map.js";

var loader = document.querySelector(".loader");
var mapElement = document.getElementById("map");
var destinationInput = document.querySelector(".destination-input");
var destinationBtn = document.querySelector(".destination-btn");
var distanceElement = document.querySelector(".distance");
var priceElement = document.querySelector(".price");
var confirmBookingBtn = document.querySelector(".confirm-booking-btn");
var confirmModel = document.querySelector(".confirm-model");
var confirmModeContent = confirmModel.querySelector(".model-content");
var notifierOverlay = document.querySelector(".notifier-overlay");
var notifierFixed = document.querySelector(".notifier-fixed ");
var toast = document.querySelector(".toast");
var toastContent = document.querySelector(".toast_content");
var toastCloseBtn = document.querySelector(".toast span");
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

// for landing page after customer book ride
var startLocationLat = document.getElementById("start_location_lat");
var startLocationLng = document.getElementById("start_location_lng");
var endLocationLat = document.getElementById("end_location_lat");
var endLocationLng = document.getElementById("end_location_lng");

window.onload = () => {
    loader.classList.add("loader-hidden");
    if (startLocationLat) {
        var startLocation = {
            lat: parseFloat(startLocationLat.value),
            lng: parseFloat(startLocationLng.value),
        };

        var endLocation = {
            lat: parseFloat(endLocationLat.value),
            lng: parseFloat(endLocationLng.value),
        };

        initMap(startLocation, endLocation, true);
    } else {
        initMap();
        mapClick();
    }
};

if (!startLocationLat) {
    destinationBtn.onclick = async () => {
        // Lấy giá trị từ ô điểm đến
        var locationName = destinationInput.value;

        if (locationName) {
            await searchPlace(locationName); // <-- Sửa chỗ này
            if (await getCustomerMarker()) {
                var distanceValue = await getDistanceTrip();
                distanceElement.innerHTML =
                    "Quãng đường: " + distanceValue.toFixed(2) + " km";
                priceElement.innerHTML =
                    "Tổng tiền: " + (distanceValue * 8000).toFixed(0) + " VND";
            }
        } else {
            toastContent.innerHTML = "Vui lòng chọn địa điểm cần đến";
            toast.classList.add("toast-error");
            toastShow();
        }
    };

    destinationInput.onchange = async () => {
        if (getCustomerMarker()) {
            var distanceValue = await getDistanceTrip();
            distanceElement.innerHTML =
                "Quãng đường: " + distanceValue.toFixed(2) + " km";
            priceElement.innerHTML =
                "Tổng tiền: " + (distanceValue * 8000).toFixed(0) + " VND";
        }
    };

    confirmBookingBtn.onclick = async () => {
        var customerMarker = await getCustomerMarker();
        if (destinationInput.value || customerMarker) {
            var destinationMarker = await getDestinationMarker();

            var startLocation = await getReverseGeocode(
                customerMarker.getLatLng()
            );
            var endLocation = await getReverseGeocode(
                destinationMarker.getLatLng()
            );

            var distanceValue = await getDistanceTrip();
            const customerLatLng = customerMarker.getLatLng();
            const destinationLatLng = destinationMarker.getLatLng();

            const customerLat = customerLatLng.lat;
            const customerLng = customerLatLng.lng;
            const destinationLat = destinationLatLng.lat;
            const destinationLng = destinationLatLng.lng;

            const roundedDistance = distanceValue.toFixed(2);
            const price = (roundedDistance * 8000).toFixed(0);

            var html = `<form action="/customer/booking-ride" method="post">
                <input type="hidden" name="_token" value="${csrfToken}">
                <p>Điểm đi: ${startLocation}</p>
                <input type="hidden" name="start_location_name" value="${startLocation}">
                <input type="hidden" name="start_location_lat" value="${customerLat}">
                <input type="hidden" name="start_location_lng" value="${customerLng}">
                <p>Điểm đến: ${endLocation}</p>
                <input type="hidden" name="end_location_name" value="${endLocation}">
                <input type="hidden" name="end_location_lat" value="${destinationLat}">
                <input type="hidden" name="end_location_lng" value="${destinationLng}">
                <p>Quãng đường: ${roundedDistance} km</p>
                <input type="hidden" name="distance" value="${roundedDistance}">
                <p>Tổng tiền: ${price} vnd</p>
                <input type="hidden" name="price" value="${price}">
                <button style="margin-top: 20px" type="submit" class="submit-btn">Xác nhận</button>
            </form>`;

            confirmModeContent.innerHTML = html;
            notifierOverlay.classList.add("active");
            confirmModel.classList.add("active");
        } else {
            toastContent.innerHTML = "Vui lòng chọn địa điểm cần đến";
            toast.classList.add("toast-error");
            toastShow();
        }
    };
}

async function getDistanceTrip() {
    var customerMarker = await getCustomerMarker();
    var destinationMarker = await getDestinationMarker();

    if (!customerMarker || !destinationMarker) {
        return 0;
    }

    return await calculateDistanceTrip(
        customerMarker.getLatLng(),
        destinationMarker.getLatLng()
    );
}

notifierOverlay.onclick = () => {
    confirmModel.classList.remove("active");
    notifierOverlay.classList.remove("active");
    notifierFixed.classList.remove("active");
};

function toastShow() {
    if (toastContent.innerHTML) {
        toast.classList.add("active");
    }

    setTimeout(() => {
        if (toast.classList.contains("active")) {
            toast.classList.remove("active");
        } else {
            return;
        }
    }, 5000);
}

toastCloseBtn.onclick = () => {
    toast.classList.remove("active");
};
