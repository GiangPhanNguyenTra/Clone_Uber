import {
    initMap,
    searchPlace,
    calculateDistanceTrip,
    getCustomerMarker,
    getDestinationMarker,
    getReverseGeocode,
    mapClick
} from "./map.js";

var loader = document.querySelector(".loader");
var confirmModel = document.querySelector(".confirm-model");
var notifierOverlay = document.querySelector(".notifier-overlay");
var notifierFixed = document.querySelector('.notifier-fixed ');
var toast = document.querySelector('.toast');
var toastContent = document.querySelector('.toast_content');
var toastCloseBtn = document.querySelector('.toast span');
var currentLocationBtn = document.querySelector('.customer-location');
var confirmCurrentLocationBtn = document.querySelector('.confirm-current-location');

var startLocationLat = document.querySelector('.start_location_lat');
var startLocationLng = document.querySelector('.start_location_lng');
var endLocationLat = document.querySelector('.end_location_lat');
var endLocationLng = document.querySelector('.end_location_lng');

const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

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
        
        // initMap(startLocation, endLocation, true);
    } else {
        // initMap();
    }
};

if (currentLocationBtn) {
    currentLocationBtn.onclick =  async () => {
        var currentLocartionMarker = await getCustomerMarker();
        var currentLocartion = {
            lat: currentLocartionMarker.getPosition().lat(),
            lng: currentLocartionMarker.getPosition().lng()
        }
        var currentLocartionName = await getReverseGeocode(currentLocartion);
        document.querySelector('.current-location').innerHTML = "Địa chỉ hiện tại: " + currentLocartionName;
    }
}

if (confirmCurrentLocationBtn) {
    confirmCurrentLocationBtn.onclick = async () => {
        var currentLocartionMarker = await getCustomerMarker();
    
        var data = {
            lat: currentLocartionMarker.getPosition().lat(),
            lng: currentLocartionMarker.getPosition().lng()
        };
    
        var currentLocartionName = await getReverseGeocode(data);
    
        data.name = currentLocartionName;
    
        console.log(data);
    
        fetch('/driver/update-current-location', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify(data),
        })
        .then(response => response.json())
        .then(data => {
            toastContent.innerHTML = 'Địa chỉ của bạn đã được cập nhật';
            toast.classList.add('toast-success');
            toastShow();
        })
        .catch(error => {
            // Xử lý lỗi nếu có
            console.error('Error:', error);
        });
    }
    
    notifierOverlay.onclick = () => {
        confirmModel.classList.remove("active");
        notifierOverlay.classList.remove('active');
        notifierFixed.classList.remove('active');
    };
}

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