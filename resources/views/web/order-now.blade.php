@extends('web.layout.default')
@section('content')

<style>
    .contact-form{
        background: white;
    }
</style>

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
        <!-- header area start -->
        @include('web.includes.login-header')
        <!-- header area end -->

        <!-- Breadcrumb area start -->
        <!-- rts breadcrumb area start -->
        <!--div class="rts-category-area rts-breadcrumb-area portfolio-3 jarallax" style="margin-top: 0; height: 300px; padding: 3% 0;">
            <div class="container">
                <div class="breadcrumb-area-wrapper">
                    <h1 class="title">{{ __('web.Order Now') }}</h1>
                    <div class="nav-bread-crumb">
                        <a href="{{ route('home') }}">{{ __('web.Home') }}</a>
                        <a href="#" class="current">{{ __('web.Order Now') }}</a>
                    </div>
                </div>
            </div>
        </div-->
        <!-- rts breadcrumb area end -->
        <!-- Breadcrumb area end -->
        <!-- Contact Start -->
        <div id="app" class="rts-category-area rts-contact-page-form-area rts-section-gapNew rts-section-gap account" style="padding-top: 30px; margin-top: 0;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                        <div class="mian-wrapper-form contact-form">
                            <div class="title-mid-wrapper-home-two sal-animate" data-sal="slide-up" data-sal-delay="150" data-sal-duration="800">
                                <h3 class="title">
                                    {{ __('web.Order Now') }}
                                </h3>
                                @include('cpanel.includes.alerts')
                            </div>
                            <form id="contact-form" action="{{ route('order-now') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form__control">
                                    <span class="icon">
                                        <svg width="21" height="15" viewBox="0 0 21 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14.2309 4.67871H6.49742C6.32626 4.67871 6.1875 4.8373 6.1875 5.03291C6.1875 5.22852 6.32626 5.38711 6.49742 5.38711H14.2309C14.4021 5.38711 14.5408 5.22852 14.5408 5.03291C14.5408 4.8373 14.402 4.67871 14.2309 4.67871Z" fill="#555555"></path>
                                            <path d="M3.26685 6.2832H2.12145C1.95029 6.2832 1.81152 6.44179 1.81152 6.6374C1.81152 6.83301 1.95029 6.9916 2.12145 6.9916H3.26685C3.83285 6.9916 4.31014 7.4342 4.44766 8.03247H2.20083C2.02967 8.03247 1.89091 8.19105 1.89091 8.38666C1.89091 8.58227 2.02967 8.74086 2.20083 8.74086H4.79738C4.96854 8.74086 5.10731 8.58227 5.10731 8.38666C5.10735 7.22679 4.28171 6.2832 3.26685 6.2832Z" fill="#555555"></path>
                                            <path d="M17.4616 6.9916H18.607C18.7782 6.9916 18.9169 6.83301 18.9169 6.6374C18.9169 6.44179 18.7782 6.2832 18.607 6.2832H17.4616C16.4467 6.2832 15.6211 7.22679 15.6211 8.38666C15.6211 8.58227 15.7599 8.74086 15.931 8.74086H18.5276C18.6987 8.74086 18.8375 8.58227 18.8375 8.38666C18.8375 8.19105 18.6987 8.03247 18.5276 8.03247H16.2808C16.4183 7.4342 16.8956 6.9916 17.4616 6.9916Z" fill="#555555"></path>
                                            <path d="M19.5243 4.72735C19.0899 4.20848 18.5 3.92271 17.8631 3.92271C17.8352 3.92271 17.8075 3.92701 17.7806 3.93551L16.7846 4.24999L15.3173 1.02849C15.0546 0.451767 14.4032 0 13.8344 0H6.89271C6.32381 0 5.67243 0.451767 5.40974 1.02849L3.94247 4.24999L2.94645 3.93551C2.91959 3.92701 2.89182 3.92271 2.86393 3.92271C2.2271 3.92271 1.63712 4.20848 1.20273 4.72735C0.768343 5.24623 0.544536 5.93243 0.572677 6.66165L0.7976 11.7866C0.805865 11.9751 0.942025 12.1231 1.10715 12.1231H1.21046V13.6698C1.21046 13.8654 1.34923 14.0239 1.52039 14.0239H4.78125C4.95241 14.0239 5.09118 13.8654 5.09118 13.6698V13.1857C5.09118 12.9901 4.95241 12.8315 4.78125 12.8315C4.61009 12.8315 4.47133 12.9901 4.47133 13.1857V13.3156H1.83027V12.1231H18.8968V13.3156H16.2558V13.1857C16.2558 12.9901 16.117 12.8315 15.9459 12.8315C15.7747 12.8315 15.6359 12.9901 15.6359 13.1857V13.6698C15.6359 13.8654 15.7747 14.0239 15.9459 14.0239H19.2067C19.3779 14.0239 19.5167 13.8654 19.5167 13.6698V12.1231H19.62C19.7851 12.1231 19.9212 11.9751 19.9295 11.7866L20.1545 6.65957C20.1826 5.93243 19.9588 5.24623 19.5243 4.72735ZM19.5353 6.62618L19.3252 11.4146H1.40191L1.19187 6.62831C1.17133 6.09616 1.33422 5.595 1.65064 5.21714C1.95784 4.85019 2.37305 4.64334 2.8236 4.63172L4.01594 5.00821C4.01669 5.00844 4.01743 5.00868 4.01822 5.00892L5.17461 5.37402C5.33953 5.42611 5.51028 5.31551 5.55586 5.12694C5.60144 4.93841 5.50466 4.74332 5.33965 4.69123L4.55344 4.443L5.95959 1.35568C6.11662 1.01093 6.55266 0.708489 6.89275 0.708489H13.8344C14.1745 0.708489 14.6105 1.01093 14.7676 1.35568L16.1737 4.443L15.3875 4.69123C15.2225 4.74332 15.1257 4.93841 15.1713 5.12694C15.2169 5.31551 15.3876 5.42607 15.5525 5.37402L17.9036 4.63172C18.3541 4.64339 18.7693 4.85024 19.0765 5.21714C19.3929 5.595 19.5558 6.09616 19.5353 6.62618Z" fill="#555555"></path>
                                            <path d="M17.8636 3.21425H18.9433C19.1145 3.21425 19.2533 3.05567 19.2533 2.86006C19.2533 2.66445 19.1145 2.50586 18.9433 2.50586H17.8636C17.6925 2.50586 17.5537 2.66445 17.5537 2.86006C17.5537 3.05567 17.6925 3.21425 17.8636 3.21425Z" fill="#555555"></path>
                                            <path d="M1.78453 3.21425H2.86423C3.03539 3.21425 3.17416 3.05567 3.17416 2.86006C3.17416 2.66445 3.03539 2.50586 2.86423 2.50586H1.78453C1.61337 2.50586 1.47461 2.66445 1.47461 2.86006C1.47461 3.05567 1.61337 3.21425 1.78453 3.21425Z" fill="#555555"></path>
                                            <path d="M13.8011 9.05078H6.92614C6.75497 9.05078 6.61621 9.20937 6.61621 9.40498V10.3516C6.61621 10.5472 6.75497 10.7058 6.92614 10.7058C7.0973 10.7058 7.23606 10.5472 7.23606 10.3516V9.75918H13.4912V10.3516C13.4912 10.5472 13.63 10.7058 13.8011 10.7058C13.9723 10.7058 14.1111 10.5472 14.1111 10.3516V9.40498C14.1111 9.20937 13.9723 9.05078 13.8011 9.05078Z" fill="#555555"></path>
                                            <path d="M12.0824 7.27578C12.2536 7.27578 12.3923 7.11719 12.3923 6.92158C12.3923 6.72597 12.2536 6.56738 12.0824 6.56738H8.64489C8.47372 6.56738 8.33496 6.72597 8.33496 6.92158C8.33496 7.11719 8.47372 7.27578 8.64489 7.27578H12.0824Z" fill="#555555"></path>
                                        </svg>
                                    </span>
                                    <input type="text" class="input-form" name="search_word" id="search_word"
                                           v-model="search_word" :name="search_word" :id="search_word"
                                           @change="onBrandChange($event)"
                                           placeholder="{{ __('web.search by brand name') }}" required="">
                                </div>

                                <div  class="form__control" style="height: 200px;padding: 10px;overflow: hidden;border: 1px solid rgba(85, 85, 85, 0.15);border-radius:6px;overflow-y: scroll;">
                                    <div v-if="brands.length > 0" class="input row col-12">
                                        <span v-for="brand in brands" class="col-3" style="height: 60px; text-align: center; font-size: 12px;">
                                            <img :src="brand.logo_url" :alt="brand.name" width="40" height="40">
                                            <p>@{{ brand.name }}</p>
                                        </span>
                                    </div>
                                </div>

                                <div class="form__control">
                                    <span class="icon">
                                        <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.05371 5.68493C5.05371 5.33605 5.33654 5.05322 5.68542 5.05322H9.05454C9.40342 5.05322 9.68625 5.33605 9.68625 5.68493C9.68625 6.03381 9.40342 6.31664 9.05454 6.31664H5.68542C5.33654 6.31664 5.05371 6.03381 5.05371 5.68493Z" fill="#555555"></path>
                                            <path d="M5.05371 9.05334C5.05371 8.70447 5.33654 8.42163 5.68542 8.42163H12.4237C12.7725 8.42163 13.0554 8.70447 13.0554 9.05334C13.0554 9.40221 12.7725 9.68505 12.4237 9.68505H5.68542C5.33654 9.68505 5.05371 9.40221 5.05371 9.05334Z" fill="#555555"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.34169 -0.000244141H10.7674C11.9227 -0.000244141 12.8285 -0.000252525 13.5566 0.0592293C14.2979 0.119798 14.9103 0.24518 15.4646 0.527622C16.376 0.991946 17.1168 1.73285 17.5812 2.64414C17.8636 3.19848 17.989 3.8109 18.0496 4.55223C18.109 5.28025 18.109 6.18606 18.109 7.34143V8.36714V8.49087C18.1092 9.79523 18.1094 10.5909 17.9134 11.2593C17.4493 12.8421 16.2115 14.0799 14.6286 14.544C13.9603 14.74 13.1646 14.7398 11.8602 14.7397C11.8195 14.7397 11.7783 14.7397 11.7365 14.7397H11.2743L11.2235 14.7397C10.493 14.7444 9.78157 14.9725 9.18448 15.3932L9.14304 15.4227L6.94411 16.9934C5.67689 17.8985 4.01168 16.5913 4.59004 15.1454C4.66778 14.9511 4.52466 14.7397 4.31535 14.7397H3.80851C1.70512 14.7397 0 13.0346 0 10.9311V7.34144C0 6.18607 -8.38404e-06 5.28026 0.0594735 4.55223C0.120042 3.8109 0.245424 3.19848 0.527866 2.64414C0.99219 1.73285 1.73309 0.991946 2.64438 0.527622C3.19872 0.24518 3.81114 0.119798 4.55248 0.0592293C5.2805 -0.000252525 6.18632 -0.000244141 7.34169 -0.000244141ZM4.65535 1.31846C3.99216 1.37264 3.56451 1.47677 3.21797 1.65334C2.5444 1.99653 1.99678 2.54416 1.65358 3.21772C1.47701 3.56426 1.37288 3.99191 1.3187 4.65511C1.26391 5.32568 1.26342 6.17998 1.26342 7.36971V10.9311C1.26342 12.3368 2.40289 13.4762 3.80851 13.4762H4.31535C5.41848 13.4762 6.1728 14.5904 5.7631 15.6146C5.65336 15.889 5.96932 16.137 6.20976 15.9653L8.45667 14.3604C9.2645 13.7912 10.2271 13.4826 11.2154 13.4763L11.2743 13.4762H11.7365C13.2037 13.4762 13.8019 13.4698 14.2731 13.3316C15.443 12.9886 16.3579 12.0737 16.701 10.9038C16.8392 10.4325 16.8456 9.83431 16.8456 8.36714V7.36971C16.8456 6.17998 16.8451 5.32568 16.7904 4.65511C16.7361 3.99191 16.632 3.56426 16.4555 3.21772C16.1122 2.54416 15.5646 1.99653 14.8911 1.65334C14.5445 1.47677 14.1169 1.37264 13.4537 1.31846C12.7831 1.26367 11.9288 1.26318 10.7391 1.26318H7.36996C6.18023 1.26318 5.32593 1.26367 4.65535 1.31846Z" fill="#555555"></path>
                                        </svg>
                                    </span>
                                    <textarea name="description" id="description" cols="30" rows="10"
                                              placeholder="{{ __('web.Description e.g Toyota camry 2025, white color') }}" required=""></textarea>
                                </div>

                                <div class="form__control">
                                    <button type="submit" class="submit__btn">
                                        {{ __('web.Send') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-shape-area">
                <img src="{{ URL::asset("assets/web/images/category/shape/shape-01.svg") }}" alt="">
                <img src="{{ URL::asset("assets/web/images/category/shape/shape-02.svg") }}" alt="">
            </div>
        </div>
        <!-- Contact End -->
    </div>
</div>

<!-- rts footer area start -->
@include('web.includes.footer')
<!-- rts footer area end -->
<!-- header style two -->
@include('web.includes.header-two')
<!-- header style two End -->
@endsection

@push('scripts')
    <script src="https://unpkg.com/vue@3"></script>
    <script src="{{ asset("assets/web/vuejs/order-now.js") }}"></script>
@endpush
