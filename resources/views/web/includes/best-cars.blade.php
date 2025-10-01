<section class="rts-portfolio-area rts-section-gap">
    <div class="section-title-area2">
        <p class="sub-title wow fadeInUp" data-wow-delay=".1s" data-wow-duration=".8s">Select Car</p>
        <h2 class="section-title wow move-right">
            {{ __('web.Our Amazing') }}
            <span>
                {{ __('web.Car') }}
            </span>
        </h2>
    </div>
    <div class="section-inner mt--80 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
        <div class=" tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="new-cars" role="tabpanel" aria-labelledby="new-cars-tab">
                <div class="slider-area">
                    <div class="swiper projectSlider">
                        <div class="swiper-wrapper">

                            @foreach($best_cars as $best_car)
                            <div class="swiper-slide">
                                <div class="project-wrapper">
                                    <div class="image-area">
                                        <a href="{{ route('cars.view', ['id' => $best_car->id]) }}">
                                            <img src="{{ URL::asset("storage/". $best_car->main_image_url) }}" alt="{{ $best_car->description }}">
                                        </a>
                                    </div>
                                    <span class="price">
                                        {{ $best_car->price }} {{ __('web.SAR') }}
                                    </span>
                                    <div class="content-area">
                                        <h5 class="title">
                                            <a href="{{ route('cars.view', ['id' => $best_car->id]) }}">
                                                {{ $best_car->description }}
                                            </a>
                                        </h5>
                                        <ul class="feature-area">
                                            <li>
                                                <img src="{{ URL::asset("assets/web/images/portfolio/feature-icon/01.svg") }}" alt="">
                                                {{ $best_car->mileage }}  {{ __('web.Miles') }}
                                            </li>
                                            <li>
                                                <img src="{{ URL::asset("assets/web/images/portfolio/feature-icon/02.svg") }}" alt="">
                                                {{ $best_car->fuel_type }}
                                            </li>
                                            <li>
                                                <img src="{{ URL::asset("assets/web/images/portfolio/feature-icon/03.svg") }}" alt="">
                                                {{ $best_car->transmission }}
                                            </li>
                                        </ul>
                                        <a href="{{ route('cars.view', ['id' => $best_car->id]) }}" class="rts-btn btn-primary radius-big">
                                            {{ __('web.View Details') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                        <div class="swiper-pagination-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
