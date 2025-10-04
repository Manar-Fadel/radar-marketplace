<header class="header-three header--sticky">
    <div class="header-top">
        <div class="container">
            <div class="header-top-inner d-flex align-items-center justify-content-between">
                <div class="left d-flex align-items-center">
                    <div class="map-area">
                        <i class="rt-icon-phone-flip"></i>
                        <a href="call-to:{{ $customer_care_mobile }}">{{ $customer_care_mobile }}</a>
                    </div>
                    <div class="map-area">
                        <i class="rt-icon-envelope"></i>
                        <a href="mail-to:{{ $customer_care_email }}">
                            {{ $customer_care_email }}
                        </a>
                    </div>
                    <div class="map-area">
                        <i class="rt-icon-marker"></i>
                        <a href="{{ route('home') }}">
                            {{ $location }}
                        </a>
                    </div>
                </div>
                <div class="right">
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="header-bottom">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-wrapper-1">
                        <div class="logo-area-start">
                            <a href="{{ route('home') }}" class="logo">
                                <img src="{{ URL::asset("assets/web/images/logo/logo.svg") }}" width="99" alt="logo_area">
                            </a>
                        </div>
                        <div class="header-right d-block">
                            @include('web.includes.menu')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
