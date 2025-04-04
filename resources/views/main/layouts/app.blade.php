<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

    
    <link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=EB+Garamond' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Cormorant+Garamond' rel='stylesheet'>
    <link rel="stylesheet" href="/main/fontawesome-free-6.2.0-web/css/all.min.css">
    <link rel="icon" href="/main/asset/img/uber-logo.jpg" type="image/x-icon">
    <link
        rel="stylesheet"
        type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"
    />
    <link rel="stylesheet" href="/main/css/grid.css">
    <link rel="stylesheet" href="/main/css/home.css">
    <link rel="stylesheet" href="/main/css/register.css">
    <link rel="stylesheet" href="/main/css/product-detail.css">
    <link rel="stylesheet" href="/main/css/animate.css">
    <link rel="stylesheet" href="/main/css/cart-detail.css">
    <link rel="stylesheet" href="/main/css/account.css">
    <link rel="stylesheet" href="/main/css/order.css">
    <link rel="stylesheet" href="/main/css/products.css">
    <link rel="stylesheet" href="/main/css/responsive.css">
    <link rel="stylesheet" href="/main/css/home-driver.css">
    <link rel="stylesheet" href="/main/css/notification.css">
    <link rel="stylesheet" href="/main/css/rating.css">
    <title>Uber</title>
</head>
<body>
    <div class="main">
        @if (Auth::guard('driver')->check())
            <input type="hidden" id="driver-id" value="{{Auth::guard('driver')->user()->id}}">
        @endif

        @if (Auth::guard('customer')->check())
            <input type="hidden" id="customer-id" value="{{Auth::guard('customer')->user()->id}}">
        @endif
        {{-- model --}}
        @include('main.layouts.confirm-order-model')
        @include('main.layouts.cancel-order-model')

        <div class="loader"></div>
        <div class="toast @if(session()->has('toast_modify')) {{session()->get('toast_modify')}} @endif">
            <div class="toast_content">@if(session()->has('toast_msg')) {{session()->get('toast_msg')}} @endif</div>
            <span><i class="fa-solid fa-xmark"></i></span>
        </div>
      
        
        <!-- cart -->
        @include('main.layouts.notify-fixed')

        @include('main.layouts.scrolltop')
        
        {{-- header --}}
        @include('main.layouts.header')
        {{-- end header --}}
        @yield('content')
        {{-- footer --}}
        @include('main.layouts.footer')
        {{-- end footer --}}
    </div>

    <!-- slick-slider -->
    <script
      type="text/javascript"
      src="https://code.jquery.com/jquery-1.11.0.min.js"
    ></script>
    <script
      type="text/javascript"
      src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"
    ></script>
    <script
      type="text/javascript"
      src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"
    ></script>
    <script src="/main/js/slick.js"></script>
    <script src="/main/js/app.js"></script>
    <script src="/main/js/wow.min.js"></script>
    <script src="/main/js/responesive.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="/main/js/pusher.js"></script>
    <script type="module" src="/main/js/map.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEKkyLvRK9fjtH4FZPt2GzdDk-XobmDno&libraries=places" defer></script>
    <script>
      new WOW().init();
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
      var cities = document.querySelectorAll('[id^="city"]');
      var districts = document.querySelectorAll('[id^="district"]');
      var wards = document.querySelectorAll('[id^="ward"]');
    
      var Parameter = {
        url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
        method: "GET",
        responseType: "application/json",
      };
    
      var promise = axios(Parameter);
      promise.then(function (result) {
        for (var i = 0; i < cities.length; i++) {
          renderCity(result.data, cities[i], districts[i], wards[i]);
        }
      });
    
      function renderCity(data, citis, districts, wards) {
        for (const x of data) {
          citis.options[citis.options.length] = new Option(x.Name, x.Name);
        }
    
        citis.onchange = function () {
          districts.length = 1;
          wards.length = 1;
          if (this.value !== "") {
            const result = data.filter((n) => n.Name === this.value);
    
            for (const k of result[0].Districts) {
              districts.options[districts.options.length] = new Option(k.Name, k.Name);
            }
          }
        };
    
        districts.onchange = function () {
          wards.length = 1;
          const dataCity = data.filter((n) => n.Name === citis.value);
          if (this.value !== "") {
            const dataWards = dataCity[0].Districts.filter((n) => n.Name === this.value)[0].Wards;
    
            for (const w of dataWards) {
              wards.options[wards.options.length] = new Option(w.Name, w.Name);
            }
          }
        };
      }
    </script>
</body>
</html>