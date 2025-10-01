<section class="rts-banner-area banner-slider-area4">
    <div class="swiper bannerSlider">
        <div class="swiper-wrapper">

            @foreach($slider_banners as $banner)
            <div class="swiper-slide">
                <div class="rts-banner-wrapper bg" style="background: url({{ URL::asset("storage/".$banner->slider_image_url) }}); background-size: cover !important;">
                    <div class="container">
                        <div class="banner-area-one bg_image" >
                            <div class="banner-content-area">
                                <div class="pre-title">
                                    <span>{{ $banner->price }} {{ __('web.SAR') }}</span>
                                </div>
                                <h1 class="title">
                                    {{ $local== 'ar' ? $banner->brand->brand_name_ar.'-'.$banner->carModel->model_name_ar : $banner->brand->brand_name_en.'-'.$banner->carModel->model_name_en }}
                                </h1>
                                <ul class="feature-area">
                                    @if(!is_null($banner->mileage))
                                    <li>
                                        <img src="{{ URL::asset("assets/web/images/portfolio/feature-icon/05.svg") }}" width="56" alt="">
                                        {{ $banner->mileage }} Miles
                                    </li>
                                    @endif


                                        @if(!is_null($banner->fuel_type))
                                    <li>
                                        <img src="{{ URL::asset("assets/web/images/portfolio/feature-icon/06.svg") }}" width="39" alt="">
                                        {{ $banner->fuel_type }}
                                    </li>
                                    @endif

                                    @if(!is_null($banner->transmission))
                                    <li>
                                        <img src="{{ URL::asset("assets/web/images/portfolio/feature-icon/07.svg") }}" width="36" alt="">
                                        {{ $banner->transmission }}
                                    </li>
                                    @endif
                                </ul>
                                <div class="button-area">
                                    <a href="{{ route('cars.view', ['id' => $banner->id]) }}" class="rts-btn btn-primary radius-big">
                                        المزيد
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div class="swiper-btn-area">
            <div class="swiper-btn swiper-button-prev">
                <img src="{{ URL::asset("assets/web/images/banner/arrow-left.svg") }}" alt="">
            </div>
            <div class="swiper-btn swiper-button-next">
                <img src="{{ URL::asset("assets/web/images/banner/arrow-right.svg") }}" alt="">
            </div>
        </div>
    </div>
</section>
