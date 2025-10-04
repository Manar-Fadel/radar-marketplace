<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset("assets/web/images/fav.svg") }}">
    <title>
        Weel Radar - Car Dealer
    </title>
    <meta name="description" content="Your trusted source for expert healthcare services and car information. Providing personalized care, advanced treatments, and reliable car dealing to help you achieve better health.">
    <link rel="stylesheet" href="{{ URL::asset("assets/web/css/plugins/plugins.css") }}">
    <link rel="stylesheet" href="{{ URL::asset("assets/web/css/plugins/magnifying-popup.css") }}">
    <link rel="stylesheet" href="{{ URL::asset("assets/web/css/vendor/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ URL::asset("assets/web/fonts/rt-icon.css") }}">
    <link rel="stylesheet" href="{{ URL::asset("assets/web/css/style.css") }}">
    <style>
        .active {
            color: var(--color-primary) !important;
        }
        .hidden{
            display: none !important;
        }
    </style>
</head>

<body @if(request()->route()->getName() == "login" || request()->route()->getName() == "register")
          class="account-page-body"
      @elseif(request()->route()->getName() == "my-orders")
          class="with-sidebar"
      @endif>
<div class="loader-wrapper">
    <div class="loader">
    </div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>

@yield("content")

<script src="{{ URL::asset("assets/web/js/plugins/jquery.js") }}"></script>
<script src="{{ URL::asset("assets/web/js/plugins/jquery-ui.js") }}"></script>
<script src="{{ URL::asset("assets/web/js/vendor/waw.js") }}"></script>
<script src="{{ URL::asset("assets/web/js/plugins/counter-up.js") }}"></script>
<script src="{{ URL::asset("assets/web/js/plugins/contact-form.js") }}"></script>
<script src="{{ URL::asset("assets/web/js/plugins/swiper.js") }}"></script>
<script src="{{ URL::asset("assets/web/js/plugins/metismenu.js") }}"></script>
<script src="{{ URL::asset("assets/web/js/vendor/jarallax.js") }}"></script>
<script src="{{ URL::asset("assets/web/js/plugins/smooth-scroll.js") }}"></script>
<script src="{{ URL::asset("assets/web/js/plugins/magnifying-popup.js") }}"></script>
<script src="{{ URL::asset("assets/web/js/vendor/bootstrap.min.js") }}"></script>
<script src="{{ URL::asset("assets/web/js/vendor/waypoint.js") }}"></script>
<!-- main js here -->
<script src="{{ URL::asset("assets/web/js/main.js") }}"></script>
@stack('scripts')
</body>

</html>
