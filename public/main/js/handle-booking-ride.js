import {
    initMap,
    searchPlace,
    calculateDistanceTrip,
    getCustomerMarker,
    getDestinationMarker,
    getReverseGeocode,
    mapClick,
} from "./map.js";

var loader = document.querySelector(".loader");
var map = document.getElementById("map");
var destinationInput = document.querySelector(".destination-input");
var destinationBtn = document.querySelector(".destination-btn");
var distance = document.querySelector(".distance");
var price = document.querySelector(".price");
var confirmBookingBtn = document.querySelector(".confirm-booking-btn");
var confirmModel = document.querySelector(".confirm-model");
var confirmModeContent = confirmModel.querySelector(".model-content" );
var notifierOverlay = document.querySelector(".notifier-overlay");
var notifierFixed = document.querySelector('.notifier-fixed ');
var toast = document.querySelector('.toast');
var toastContent = document.querySelector('.toast_content');
var toastCloseBtn = document.querySelector('.toast span');
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

// for landing page after customer book ride
var startLocationLat = document.getElementById('start_location_lat');
var startLocationLng = document.getElementById('start_location_lng');
var endLocationLat = document.getElementById('end_location_lat');
var endLocationLng = document.getElementById('end_location_lng');

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
        }
        
        initMap(startLocation, endLocation, true);
    } else {
        initMap();
    }
};

if (!startLocationLat) {
    destinationBtn.onclick = async () => {
        // Lấy giá trị từ ô điểm đến
        var locationName = destinationInput.value;
        
        if (locationName) {
            searchPlace(locationName);
            if (getCustomerMarker()) {
                var distanceValue = await getDistanceTrip();
                distance.innerHTML = "Quãng đường: " + distanceValue + " km";
                price.innerHTML = "Tổng tiền: " + distanceValue * 8.000 + " VND";
            }
        } else {
            toastContent.innerHTML = 'Vui lòng chọn địa điểm cần đến';
            toast.classList.add('toast-error');
            toastShow();
        }
    };
    
    destinationInput.onchange = async () => {
        if (getCustomerMarker()) {
            var distanceValue = await getDistanceTrip();
            distance.innerHTML = "Quãng đường: " + distanceValue + " km";
            price.innerHTML = "Tổng tiền: " + distanceValue * 8.000 + " VND";
        }
    };
    
    confirmBookingBtn.onclick = async () => {
        var customerMarker = await getCustomerMarker();
        if (destinationInput.value || customerMarker) {
            var destinationMarker = await getDestinationMarker();
    
            var startLocation = await getReverseGeocode(customerMarker.getPosition());
            var endLocation = await getReverseGeocode(destinationMarker.getPosition());
            var distanceValue = await getDistanceTrip();
    
            var html = `<form action="/customer/booking-ride" method="post">
                <input type="hidden" name="_token" value="${csrfToken}">
                <p>Điểm đi: ${startLocation}</p>
                <input type="hidden" name="start_location_name" value="${startLocation}">
                <input type="hidden" name="start_location_lat" value="${customerMarker.getPosition().lat()}">
                <input type="hidden" name="start_location_lng" value="${customerMarker.getPosition().lng()}">
                <p>Điểm đến: ${endLocation}</p>
                <input type="hidden" name="end_location_name" value="${endLocation}">
                <input type="hidden" name="end_location_lat" value="${destinationMarker.getPosition().lat()}">
                <input type="hidden" name="end_location_lng" value="${destinationMarker.getPosition().lng()}">
                <p>Quãng đường: ${distanceValue} km</p>
                <input type="hidden" name="distance" value="${distanceValue}">
                <p>Tổng tiền: ${distanceValue * 8.000} vnd</p>
                <input type="hidden" name="price" value="${distanceValue * 8.000}">
                <button style="margin-top: 20px" type="submit" class="submit-btn">Xác nhận</button>
            </form>`;
            
            confirmModeContent.innerHTML = html;
            notifierOverlay.classList.add("active");
            confirmModel.classList.add("active");
        } else {
            toastContent.innerHTML = 'Vui lòng chọn địa điểm cần đến';
            toast.classList.add('toast-error');
            toastShow();
        }
    
        
    };
}

map.onclick = async () => {
    mapClick()
    if (getCustomerMarker()) {
        var distaneValue = await getDistanceTrip();
        distance.innerHTML = "Quãng đường: " + distaneValue + " km";
        price.innerHTML = "Tổng tiền: " + distaneValue * 8.000 + " VND";
    }
};

async function getDistanceTrip() {
    var customerMarker = await getCustomerMarker();
    var destinationMarker = await getDestinationMarker();

    return await calculateDistanceTrip(customerMarker.getPosition(), destinationMarker.getPosition());
}

notifierOverlay.onclick = () => {
    confirmModel.classList.remove("active");
    notifierOverlay.classList.remove('active');
    notifierFixed.classList.remove('active');
};

function toastShow() {
    if (toastContent.innerHTML) {
        toast.classList.add('active');
    }

    setTimeout(() => {
        if (toast.classList.contains('active')) {
            toast.classList.remove('active');
        } else {
            return;
        }
    }, 5000)
}

toastCloseBtn.onclick = () => {
    toast.classList.remove('active');
}