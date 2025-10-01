@extends('web.layout.default')
@section('content')

<div class="search-input-area">
    <div class="container">
        <div class="search-input-inner">
            <div class="input-div">
                <input class="search-input autocomplete" type="text" placeholder="Search by keyword or #">
                <button><i class="far fa-search"></i></button>
            </div>
        </div>
    </div>
    <div id="close" class="search-close-icon"><i class="far fa-times"></i></div>
</div>
<div id="anywhere-home">
</div>
<!-- progress area start -->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;">
        </path>
    </svg>
</div>
<!-- progress area end -->
<div class="rts-wrapper">
    <div class="rts-wrapper-inner">

        <!-- header area start -->
        @include('web.includes.login-header')
        <!-- header area end -->

        <!-- Breadcrumb area start -->
        <!-- rts breadcrumb area start -->
        <div class="rts-breadcrumb-area service jarallax">
            <div class="container">
                <div class="breadcrumb-area-wrapper">
                    <h1 class="title">{{ __('web.About') }}</h1>
                    <div class="nav-bread-crumb">
                        <a href="{{ route('home') }}">{{ __('web.Home') }}</a>
                        <a href="#" class="current">{{ __('web.About') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- rts breadcrumb area end -->
        <!-- Breadcrumb area end -->
        <!-- About Area Start -->
        <section class="rts-about-area inner two rts-section-gapTop">
            <div class="container">
                <div class="section-inner">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="about-image-area-two">
                                <div class="left wow scaleIn" data-wow-delay=".5s" data-wow-duration="1s">
                                    <img src="{{ URL::asset("assets/web/images/about/12.webp") }}" width="339" alt="">
                                </div>
                                <div class="right wow scaleIn" data-wow-delay=".5s" data-wow-duration="1s">
                                    <img src="{{ URL::asset("assets/web/images/about/13.webp") }}" width="280" alt="">
                                    <div class="counter-area">
                                        <h2 class="title"><span class="counter">1000</span><span>+</span></h2>
                                        <p class="desc">{{ __('web.Car Sold Already') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="about-content-area">
                                <div class="section-title-area">
                                    <p class="sub-title wow fadeInUp" data-wow-delay=".1s" data-wow-duration="1s">
                                        {{ __('web.About Us') }}
                                    </p>
                                    <h2 class="section-title wow move-right">
                                        {{ __('Driven by Excellence: Your Trusted Partner for Premium') }}
                                        <span>{{ __('web.Vehicles') }}</span>
                                    </h2>
                                </div>
                                <p class="desc wow fadeInUp" data-wow-delay=".4s" data-wow-duration="1s">
                                    {{ __('web.Welcome to Autovault where innovation drives every journey.') }}
                                    {{ __('web.Discover a range of designed to elevate your driving experience.') }}
                                </p>
                                <a href="call-to:{{ $customer_care_mobile }}" class="rts-btn call-btn wow fadeInUp" data-wow-delay=".6s" data-wow-duration="1s">
                                        <span>
                                            <i class="fa-regular fa-phone"></i>
                                        </span>
                                    <div class="content">
                                        <h6>{{ __('web.Call Us Now') }}</h6>
                                        <p>{{ $customer_care_mobile }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-shape-area">
                <img src="{{ URL::asset("assets/web/images/category/shape/shape-01.svg") }}" alt="">
                <img src="{{ URL::asset("assets/web/images/category/shape/shape-02.svg") }}" alt="">
            </div>
        </section>
        <!-- About Area End -->
        <!-- Counter Area Start -->
        <section class="rts-counter-area-two">
            <div class="container">
                <div class="counter-inner">
                    <div class="inner wow zoomIn" data-wow-delay=".2s" data-wow-duration="1s">
                        <div class="icon">
                            <img src="{{ URL::asset("assets/web/images/counter/icon-01.svg") }}" width="74" alt="">
                        </div>
                        <div class="text">
                            <h3 class="title"><span class="counter">320</span><span>M</span></h3>
                            <p class="desc">{{ __('web.Cars For Sale') }}</p>
                        </div>
                    </div>
                    <div class="inner wow zoomIn" data-wow-delay=".4s" data-wow-duration="1s">
                        <div class="icon">
                            <img src="{{ URL::asset("assets/web/images/counter/icon-02.svg") }}" alt="">
                        </div>
                        <div class="text">
                            <h3 class="title"><span class="counter">5500</span><span>+</span></h3>
                            <p class="desc">{{ __('web.Dealer Review') }}</p>
                        </div>
                    </div>
                    <div class="inner wow zoomIn" data-wow-delay=".6s" data-wow-duration="1s">
                        <div class="icon">
                            <img src="{{ URL::asset("assets/web/images/counter/icon-03.svg") }}" alt="">
                        </div>
                        <div class="text">
                            <h3 class="title"><span class="counter">300</span><span>M</span></h3>
                            <p class="desc">{{ __('web.Verified User') }}</p>
                        </div>
                    </div>
                    <div class="inner wow zoomIn" data-wow-delay=".8s" data-wow-duration="1s">
                        <div class="icon">
                            <img src="{{ URL::asset("assets/web/images/counter/icon-04.svg") }}" alt="">
                        </div>
                        <div class="text">
                            <h3 class="title"><span class="counter">10</span><span>M</span></h3>
                            <p class="desc">
                                {{ __('web.Visitor Per Day') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Counter Area End -->

        @include('web.includes.red-contact-banner')

    </div>
</div>

<!-- rts footer area start -->
@include('web.includes.footer')
<!-- rts footer area end -->

<!-- header style two -->
<div id="side-bar" class="side-bar header-two">
    <button class="close-icon-menu">X</button>
    <!-- mobile menu area start -->
    <div class="mobile-menu-main">
        <nav class="nav-main mainmenu-nav mt--30">
            <ul class="mainmenu metismenu" id="mobile-menu-active">
                <li class="has-droupdown">
                    <a href="#" class="main">Home</a>
                    <ul class="submenu mm-collapse">
                        <li><a class="mobile-menu-link" href="index.html">Dealer One</a></li>
                        <li><a class="mobile-menu-link" href="index-two.html">Dealer Two</a></li>
                        <li><a class="mobile-menu-link" href="index-three.html">Dealer Three</a></li>
                        <li><a class="mobile-menu-link" href="index-four.html">Shop Demo</a></li>
                        <li><a class="mobile-menu-link" href="index-five.html">Wash Demo</a></li>
                        <li><a class="mobile-menu-link" href="index-six.html">Repair Demo</a></li>
                        <li><a class="mobile-menu-link" href="index-seven.html">Dealer Slider</a></li>
                        <li><a class="mobile-menu-link" href="index-eight.html">Dealer Video</a></li>
                    </ul>
                </li>
                <li><a href="about.html" class="main">About</a></li>
                <li class="has-droupdown">
                    <a href="#" class="main">Listing</a>
                    <ul class="submenu mm-collapse">
                        <li><a class="mobile-menu-link" href="portfolio.html">Car One</a></li>
                        <li><a class="mobile-menu-link" href="portfolio-two.html">Car Two</a></li>
                        <li><a class="mobile-menu-link" href="portfolio-three.html">Car Three</a></li>
                        <li><a class="mobile-menu-link" href="portfolio-details.html">Car Single</a></li>
                        <li><a class="mobile-menu-link" href="portfolio-details-2.html">Car Single Two</a></li>
                    </ul>
                </li>
                <li class="has-droupdown">
                    <a href="#" class="main">Pages</a>
                    <ul class="submenu mm-collapse">
                        <li><a href="service.html">Service</a></li>
                        <li><a href="pricing.html">Pricing</a></li>
                        <li><a href="faq.html">FAQ</a></li>
                        <li><a href="sold-car.html">Sold Car</a></li>
                        <li><a href="calculator.html">Calculator</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="blog-2.html">Blog Two</a></li>
                        <li><a href="blog-details.html">Blog Single</a></li>
                        <li><a href="team.html">Team</a></li>
                    </ul>
                </li>
                <li class="has-droupdown">
                    <a href="#" class="main">Shop</a>
                    <ul class="submenu mm-collapse">
                        <li><a class="mobile-menu-link" href="shop.html">Shop</a></li>
                        <li><a class="mobile-menu-link" href="shop-2.html">Shop Two</a></li>
                        <li><a class="mobile-menu-link" href="shop-3.html">Shop Three</a></li>
                        <li><a class="mobile-menu-link" href="shop-details.html">Shop Single</a></li>
                    </ul>
                </li>
                <li><a href="contact.html" class="main">Contact</a></li>
            </ul>
        </nav>

        <div class="rts-social-style-one pl--20 mt--50">
            <ul>
                <li>
                    <a href="#">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- mobile menu area end -->
</div>

@endsection
