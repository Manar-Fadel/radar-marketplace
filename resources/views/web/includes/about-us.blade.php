<section class="rts-about-area rts-section-gapBottom">
    <div class="container">
        <div class="section-inner">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="about-image-area">
                        <div class="image-main">
                            <img class="wow scaleIn" data-wow-delay=".5s" data-wow-duration="1.5s"
                                 src="{{ URL::asset("assets/web/images/about/03.webp") }}" width="371" alt="">
                            <div class="counter-area">
                                <div class="inner wow zoomIn" data-wow-delay=".9s" data-wow-duration="1s">
                                    <h2 class="title"><span class="counter">1000</span><span>+</span></h2>
                                    <p class="desc">
                                        {{ __('web.Car Sold Already') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <img src="{{ URL::asset("assets/web/images/about/01.webp") }}" alt="" width="223" class="floating-img-01 wow scaleIn" data-wow-delay=".5s" data-wow-duration="1.5s">
                        <img src="{{ URL::asset("assets/web/images/about/02.webp") }}" alt="" width="266" class="floating-img-02 wow scaleIn" data-wow-delay=".5s" data-wow-duration="1.5s">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="about-content-area">
                        <div class="section-title-area">
                            <p class="sub-title wow fadeInUp" data-wow-delay=".1s" data-wow-duration=".8s">
                                {{ __('web.About Us') }}
                            </p>
                            <h2 class="section-title wow move-right">
                                {{ __('web.Driven by Excellence: Your Trusted Partner for Premium') }}
                                <span>{{ __('web.Vehicles') }}</span>
                            </h2>
                        </div>
                        <p class="desc">
                            {{ __('web.Welcome to Autovault where innovation drives every journey.') }}
                            {{ __('web.Discover a range of designed to elevate your driving experience.') }}
                        </p>
                        <a href="{{ route('about-us') }}" class="rts-btn btn-primary radius-big">
                            {{ __('web.Learn More') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
