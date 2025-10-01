<section class="rts-category-area rts-section-gap">
    <div class="container">
        <div class="section-title-area">
            <p class="sub-title wow fadeInUp" data-wow-delay=".1s" data-wow-duration=".8s">
                {{ __('web.Car Brands') }}
            </p>
            <h2 class="section-title wow move-right">
                {{ __('web.Browse By') }}
                <span>{{ __('web.Car') }}</span>
                {{ __('web.brand') }}
            </h2>
        </div>
        <div class="section-inner wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
            <div class="swiper category-slider">
                <div class="swiper-wrapper">
                    @foreach($brands as $brand)
                        <div class="swiper-slide">
                            <div class="category-wrapper">
                                <div class="icon">
                                    <img src="{{ $brand->logo_url }}" alt="{{ $brand->brand_name_en }}">
                                </div>
                                <h6 class="title">
                                    <a href="{{ route('cars.brands', ['brand_id' => $brand->id]) }}">
                                        {{ $brand->name }}
                                    </a>
                                </h6>
                                <p class="desc">{{ $brand->cars_count }}+ {{ __('web.Car') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <div class="bg-shape-area">
        <img src="{{ URL::asset("assets/web/images/category/shape/shape-01.svg") }}" alt="">
        <img src="{{ URL::asset("assets/web/images/category/shape/shape-02.svg") }}" alt="">
    </div>
</section>
