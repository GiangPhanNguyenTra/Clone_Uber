let map;
let customerMarker;
let destinationMarker;
let infowindow;

function initMap(
    startLocation = null,
    endLocation = null,
    readOnly = null,
    driverLocation = null
) {
    // Set initial coordinates for Ho Chi Minh City
    const hoChiMinhCoordinates = [10.7769, 106.7009];

    // Nếu có driverLocation, dùng tọa độ của driver, nếu không thì dùng mặc định
    const coordinates = driverLocation || startLocation || hoChiMinhCoordinates;

    // Create Leaflet map
    map = L.map("map", {
        center: coordinates,
        zoom: 18,
    });

    // Add OpenStreetMap tile layer
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution:
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);

    if (readOnly) {
        // Disable map interaction for read-only mode
        map.dragging.disable();
        map.touchZoom.disable();
        map.doubleClickZoom.disable();
        map.scrollWheelZoom.disable();
        map.boxZoom.disable();
        map.keyboard.disable();

        // Place the markers for start and end locations
        placeMarker(startLocation, true);
        placeMarker(endLocation);
    } else {
        // Handle getting the current customer location
        const getCurrentCustomerLocation =
            document.querySelector(".customer-location");
        getCurrentCustomerLocation.addEventListener("click", () => {
            // Try HTML5 geolocation to get the user's current position
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const pos = [
                            position.coords.latitude,
                            position.coords.longitude,
                        ];

                        map.setView(pos, 18);
                        placeMarker(pos, true);

                        // Get address from location (reverse geocode)
                        reverseGeocode(pos);

                        if (destinationMarker) {
                            let startLocation = customerMarker.getLatLng();
                            let endLocation = destinationMarker.getLatLng();

                            calculateDistanceTrip(startLocation, endLocation);
                        }
                    },
                    () => {
                        handleLocationError(true, map.getCenter());
                    }
                );
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, map.getCenter());
            }
        });

        // Autocomplete for destination input
        const destinationInput = document.querySelector(".destination-input");
        destinationInput.addEventListener("input", () => {
            searchPlace(destinationInput.value);
        });
    }
}

function mapClick() {
    map.on("click", (event) => {
        placeMarker(event.latlng);
        reverseGeocode(event.latlng);
    });
}

function placeMarker(location, customerMarkerEvent = false) {
    if (customerMarkerEvent) {
        if (customerMarker) {
            map.removeLayer(customerMarker);
        }
        customerMarker = L.marker(location).addTo(map);
    } else {
        if (destinationMarker) {
            map.removeLayer(destinationMarker);
        }
        // Create a new marker
        destinationMarker = L.marker(location, {
            icon: L.divIcon({
                className: "custom-marker",
                html: '<div style="background-color: #00FF00; width: 16px; height: 16px; border-radius: 50%; border: 2px solid black;"></div>',
                iconSize: [20, 20],
                iconAnchor: [10, 10],
            }),
        }).addTo(map);

        if (customerMarker) {
            let startLocation = customerMarker.getLatLng();
            let endLocation = destinationMarker.getLatLng();

            calculateDistanceTrip(startLocation, endLocation);
        }
    }
}

async function reverseGeocode(location) {
    const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${location[0]}&lon=${location[1]}`;
    const response = await fetch(url);
    const data = await response.json();
    if (data) {
        infowindow = data.display_name;
        console.log("Address: " + infowindow);
    } else {
        console.error("No results found");
    }
}

function handleLocationError(browserHasGeolocation, pos) {
    console.error(
        browserHasGeolocation
            ? "Error: The Geolocation service failed."
            : "Error: Your browser doesn't support geolocation."
    );
}

function calculateDistanceTrip(start, end) {
    const R = 6371; // Radius of the Earth in kilometers
    const lat1 = (start.lat * Math.PI) / 180;
    const lon1 = (start.lng * Math.PI) / 180;
    const lat2 = (end.lat * Math.PI) / 180;
    const lon2 = (end.lng * Math.PI) / 180;

    const dLat = lat2 - lat1;
    const dLon = lon2 - lon1;

    const a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(lat1) *
            Math.cos(lat2) *
            Math.sin(dLon / 2) *
            Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

    const distance = R * c;
    console.log("Distance: " + distance + " km");
    return distance;
}

async function searchPlace(locationName) {
    if (!customerMarker) {
        console.error("Không có vị trí hiện tại. Vui lòng đặt điểm đi trước.");
        return;
    }

    const customerLocation = customerMarker.getLatLng();
    const customerLat = customerLocation.lat;
    const customerLng = customerLocation.lng;

    const url = `https://photon.komoot.io/api/?q=${encodeURIComponent(
        locationName
    )}&limit=10`;

    try {
        const response = await fetch(url);
        if (!response.ok)
            throw new Error(`HTTP error! status: ${response.status}`);

        const data = await response.json();

        if (data.features && data.features.length > 0) {
            const sortedResults = data.features
                .map((feature) => {
                    const [lon, lat] = feature.geometry.coordinates;
                    const distance = calculateDistanceTrip(
                        { lat: customerLat, lng: customerLng },
                        { lat: lat, lng: lon }
                    );
                    return { ...feature, distance };
                })
                .sort((a, b) => a.distance - b.distance);

            const nearest = sortedResults[0];
            const [nearestLon, nearestLat] = nearest.geometry.coordinates;
            const nearestLocation = [nearestLat, nearestLon];

            map.setView(nearestLocation, 18);
            placeMarker(nearestLocation);
        } else {
            console.error("Không tìm thấy địa điểm nào.");
        }
    } catch (err) {
        console.error("Lỗi khi tìm kiếm địa điểm:", err);
    }
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

async function getReverseGeocode(location) {
    const apiKey = "138075682dd94e819ef8bcd93bbd1b8e";
    const url = `https://api.geoapify.com/v1/geocode/reverse?lat=${
        location.lat || location[0]
    }&lon=${location.lng || location[1]}&apiKey=${apiKey}`;

    try {
        const response = await fetch(url);
        const data = await response.json();

        // Kiểm tra kết quả và trả về tên địa điểm
        if (data && data.features && data.features.length > 0) {
            const name = data.features[0].properties.formatted;
            return name || "Không xác định";
        } else {
            console.error("Không có kết quả reverse geocode.");
            return "Không xác định";
        }
    } catch (error) {
        console.error("Lỗi reverse geocode:", error);
        return "Không xác định";
    }
}

function enableCustomerMarkerAdjust() {
    map.off("click");

    map.on("click", async (event) => {
        const latlng = event.latlng;
        placeMarker(latlng, true);

        const address = await getReverseGeocode(latlng);
        document.querySelector(".current-location").innerHTML =
            "Địa chỉ hiện tại: " + address;
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
    enableCustomerMarkerAdjust,
};
