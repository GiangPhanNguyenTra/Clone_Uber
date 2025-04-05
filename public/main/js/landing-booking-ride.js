import {
    initMap,
    getCustomerMarker,
    getReverseGeocode,
    enableCustomerMarkerAdjust,
} from "./map.js";

var loader = document.querySelector(".loader");
var confirmModel = document.querySelector(".confirm-model");
var notifierOverlay = document.querySelector(".notifier-overlay");
var notifierFixed = document.querySelector(".notifier-fixed");
var toast = document.querySelector(".toast");
var toastContent = document.querySelector(".toast_content");
var toastCloseBtn = document.querySelector(".toast span");
var currentLocationBtn = document.querySelector(".customer-location");
var confirmCurrentLocationBtn = document.querySelector(
    ".confirm-current-location"
);

var startLocationLat = document.querySelector(".start_location_lat");
var startLocationLng = document.querySelector(".start_location_lng");
var endLocationLat = document.querySelector(".end_location_lat");
var endLocationLng = document.querySelector(".end_location_lng");

const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

window.onload = () => {
    loader.classList.add("loader-hidden");

    const driverLocation = window.driverLocation
        ? {
              lat: window.driverLocation.lat,
              lng: window.driverLocation.lng,
          }
        : null;

    // Kiểm tra nếu có startLocationLat
    if (startLocationLat) {
        var startLocation = {
            lat: parseFloat(startLocationLat.value),
            lng: parseFloat(startLocationLng.value),
        };

        var endLocation = {
            lat: parseFloat(endLocationLat.value),
            lng: parseFloat(endLocationLng.value),
        };

        // Gọi initMap và truyền driverLocation nếu có
        initMap(startLocation, endLocation, true, driverLocation);
    } else {
        initMap(null, null, false, driverLocation);
    }
};

if (currentLocationBtn) {
    currentLocationBtn.onclick = async () => {
        const currentLocartionMarker = await getCustomerMarker();
        const currentLatLng = currentLocartionMarker.getLatLng(); // Leaflet style

        const currentLocation = {
            lat: currentLatLng.lat,
            lng: currentLatLng.lng,
        };

        enableCustomerMarkerAdjust();

        const currentLocationName = await getReverseGeocode(currentLocation);
        document.querySelector(".current-location").innerHTML =
            "Địa chỉ hiện tại: " + currentLocationName;
    };
}

if (confirmCurrentLocationBtn) {
    confirmCurrentLocationBtn.onclick = async () => {
        const currentLocartionMarker = await getCustomerMarker();
        const latlng = currentLocartionMarker.getLatLng();

        const data = {
            lat: latlng.lat,
            lng: latlng.lng,
        };

        const currentLocationName = await getReverseGeocode(data);
        data.name = currentLocationName;

        console.log(data);

        fetch("/driver/update-current-location", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify(data),
        })
            .then((response) => response.json())
            .then((data) => {
                toastContent.innerHTML = "Địa chỉ của bạn đã được cập nhật";
                toast.classList.add("toast-success");
                toastShow();
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    };

    notifierOverlay.onclick = () => {
        confirmModel.classList.remove("active");
        notifierOverlay.classList.remove("active");
        notifierFixed.classList.remove("active");
    };
}

function toastShow() {
    if (toastContent.innerHTML) {
        toast.classList.add("active");
    }

    setTimeout(() => {
        if (toast.classList.contains("active")) {
            toast.classList.remove("active");
        }
    }, 5000);
}

toastCloseBtn.onclick = () => {
    toast.classList.remove("active");
};
