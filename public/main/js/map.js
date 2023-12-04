let map;
let customerMarker;
let destinationMarker;
let geocoder;
let infowindow;
let directionsService;
let directionsRenderer;
let autocomplete;

function initMap(startLocation = null, endLocation = null, readOnly = null) {
    if (readOnly) {
        // Đặt tọa độ ban đầu cho thành phố Cần Thơ
        const canThoCoordinates = { lat: 10.0470933, lng: 105.7681161 };
        
        map = new google.maps.Map(document.getElementById("map"), {
            center: canThoCoordinates,
            zoom: 18,
            draggable: false,
            zoomControl: false,
            scrollwheel: false,
            disableDoubleClickZoom: true
        });

         // khởi tạo các đối tượng cần thiết
        geocoder = new google.maps.Geocoder();
        infowindow = new google.maps.InfoWindow();
        directionsService = new google.maps.DirectionsService();
        directionsRenderer = new google.maps.DirectionsRenderer();

        placeMarker(startLocation, true);
        placeMarker(endLocation);

    } else {
        // Đặt tọa độ ban đầu cho thành phố Cần Thơ
        const canThoCoordinates = { lat: 10.0470933, lng: 105.7681161 };

        map = new google.maps.Map(document.getElementById("map"), {
            center: canThoCoordinates,
            zoom: 18,
        });

        // khởi tạo các đối tượng cần thiết
        geocoder = new google.maps.Geocoder();
        infowindow = new google.maps.InfoWindow();
        directionsService = new google.maps.DirectionsService();
        directionsRenderer = new google.maps.DirectionsRenderer();

        // sự kiện lấy vị trí hiện tại của người dùng
        const getCurrentCustomerLocation = document.querySelector(".customer-location");
        getCurrentCustomerLocation.addEventListener("click", () => {
            // Thử lấy vị trí HTML5
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };

                        infowindow.setPosition(pos);
                        infowindow.setContent("Current Location");
                        infowindow.open(map);
                        map.setCenter(pos);
                        placeMarker(pos, true);

                        // Lấy địa chỉ từ vị trí
                        reverseGeocode(geocoder, pos, infowindow);

                        if (destinationMarker) {
                            let startLocation = customerMarker.getPosition();
                            let enLocation = destinationMarker.getPosition();

                            calculateAndDisplayRoute(startLocation, enLocation);
                        }
                    },
                    () => {
                        handleLocationError(true, infowindow, map.getCenter());
                    }
                );
            } else {
                // Trình duyệt không hỗ trợ Geolocation
                handleLocationError(false, infowindow, map.getCenter());
            }
        });

        // sự kiện khi người dùng nhấn vào nút tìm kiếm địa điểm sẽ suggestion những địa điểm
        const destinationInput = document.querySelector(".destination-input");
        autocomplete = new google.maps.places.Autocomplete(destinationInput);
        autocomplete.bindTo("bounds", map);
        autocomplete.addListener("place_changed", onPlaceChanged);
    }
}

function mapClick() {
    map.addListener("click", (event) => {
        placeMarker(event.latLng);
        reverseGeocode(geocoder, event.latLng, infowindow);
    });
}

function placeMarker(location, customerMarkerEvent = false) {
    if (customerMarkerEvent) {
        customerMarker = new google.maps.Marker({
            position: location,
            map: map,
        });
    } else {
        if (destinationMarker) {
            destinationMarker.setMap(null);
        }
        // Tạo marker mới
        destinationMarker = new google.maps.Marker({
            position: location,
            map: map,
            icon: {
                path: google.maps.SymbolPath.CIRCLE,
                fillColor: "#00FF00", // Màu sắc fill
                fillOpacity: 1, // Độ mờ của fill
                strokeColor: "#000000", // Màu sắc đường viền
                strokeWeight: 2, // Độ rộng của đường viền
                scale: 8, // Kích thước của destinationMarker
            },
        });

        if (customerMarker) {
            let startLocation = customerMarker.getPosition();
            let enLocation = destinationMarker.getPosition();

            calculateAndDisplayRoute(startLocation, enLocation);
        }
    }
}

function reverseGeocode(geocoder, location, infowindow) {
    geocoder.geocode({ location: location }, (results, status) => {
        if (status === "OK") {
            if (results[0]) {
                infowindow.setContent(results[0].formatted_address);
                infowindow.setPosition(location);
                infowindow.open(map);
            } else {
                console.error("No results found");
            }
        } else {
            console.error("Geocoder failed due to: " + status);
        }
    });
}

function handleLocationError(browserHasGeolocation, infowindow, pos) {
    infowindow.setPosition(pos);
    infowindow.setContent(
        browserHasGeolocation
            ? "Error: The Geolocation service failed."
            : "Error: Your browser doesn't support geolocation."
    );
    infowindow.open(map);
}

function calculateAndDisplayRoute(start, end) {
    const request = {
        origin: start,
        destination: end,
        travelMode: "DRIVING", // Bạn có thể thay đổi travelMode tùy thuộc vào yêu cầu của bạn
    };

    directionsService.route(request, (result, status) => {
        if (status === "OK") {
            // Hiển thị đường đi trên bản đồ
            directionsRenderer.setMap(map);
            directionsRenderer.setDirections(result);

            // Lấy thông tin về quãng đường
            const route = result.routes[0];
            // Lấy thông tin về khoảng cách
            const distance = route.legs.reduce((total, leg) => total + leg.distance.value, 0 );
            // Chuyển đổi khoảng cách từ mét sang kilômét
            const distanceInKm = distance / 1000;
            // Hiển thị khoảng cách
            console.log("Khoảng cách: " + distanceInKm + " km");
        } else {
            console.error("Directions request failed due to " + status);
        }
    });
}

function onPlaceChanged() {
    const place = autocomplete.getPlace();

    if (!place.geometry) {
        // Place details not found for the current input.
        return;
    }

    // Clear previous marker
    if (destinationMarker) {
        destinationMarker.setMap(null);
    }

    // Create a new marker for the selected place
    destinationMarker = new google.maps.Marker({
        position: place.geometry.location,
        map: map,
        icon: {
            path: google.maps.SymbolPath.CIRCLE,
            fillColor: "#00FF00",
            fillOpacity: 1,
            strokeColor: "#000000",
            strokeWeight: 2,
            scale: 8,
        },
    });

    // Pan to the selected place on the map
    map.panTo(place.geometry.location);

    // Display additional information in the infowindow (if needed)
    infowindow.setContent(
        `<strong>${place.name}</strong><br>${place.formatted_address}`
    );
    infowindow.open(map, destinationMarker);

    // Calculate and display the route
    if (customerMarker) {
        var startLocaltion = customerMarker.getPosition();
        calculateAndDisplayRoute(startLocaltion, place.geometry.location);
    }
}

function searchPlace(locationName) {
    // Tạo một đối tượng PlacesService
    const placesService = new google.maps.places.PlacesService(map);

    // Sử dụng PlacesService để tìm kiếm địa điểm
    placesService.textSearch({ query: locationName }, (results, status) => {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
            // Lấy địa điểm đầu tiên từ kết quả
            const place = results[0];

            // Hiển thị địa điểm trên bản đồ
            map.setCenter(place.geometry.location);

            placeMarker(place.geometry.location);

            // Hiển thị thông tin về địa điểm (tùy chọn)
            infowindow.setContent(
                `<strong>${place.name}</strong><br>${place.formatted_address}`
            );

            infowindow.open(map, destinationMarker);
        } else {
            console.error("Place search failed due to " + status);
        }
    });
}

function getCustomerMarker() {
    return new Promise((resolve) => {
        function checkCustomerMarker() {
            if (customerMarker) {
                resolve(customerMarker);
            } else {
                setTimeout(checkCustomerMarker, 100);
            }
        }
        checkCustomerMarker();
    });
}

function getDestinationMarker() {
    return new Promise((resolve) => {
        function checkDestinationMarker() {
            if (destinationMarker) {
                setTimeout(() => {
                    resolve(destinationMarker);
                }, 300);
            } else {
                setTimeout(checkDestinationMarker, 100);
            }
        }
        checkDestinationMarker();
    });
}

function calculateDistanceTrip(start, end) {
    const request = {
        origin: start,
        destination: end,
        travelMode: "DRIVING", // Bạn có thể thay đổi travelMode tùy thuộc vào yêu cầu của bạn
    };

    return new Promise((resolve, reject) => {
        directionsService.route(request, (result, status) => {
            if (status === "OK") {
                // Lấy thông tin về quãng đường
                const route = result.routes[0];
                // Lấy thông tin về khoảng cách
                const distance = route.legs.reduce((total, leg) => total + leg.distance.value, 0 );
                // Chuyển đổi khoảng cách từ mét sang kilômét
                const distanceInKm = distance / 1000;
                resolve(distanceInKm);
            }
        });
    });
}

function getReverseGeocode(location) {
    return new Promise((resolve, reject) => {
        geocoder.geocode({ location: location }, (results, status) => {
            if (status === "OK" && results[0]) {
                resolve(results[0].formatted_address);
            } else {
                reject("Reverse geocode failed");
            }
        });
    });
}

export {
    initMap,
    searchPlace,
    getCustomerMarker,
    getDestinationMarker,
    calculateDistanceTrip,
    getReverseGeocode,
    mapClick,
};
