<div class="rts-footer-area footer-bg-1" id="rts-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-wrapper-style-between">
                    <div class="single-wized">
                        <h6 class="title">Corporate </h6>
                        <div class="body">
                            <ul class="nav-bottom">
                                <li>
                                    <a href="{{ route('home') }}">
                                        {{ __('web.Home') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('most-sold') }}">
                                        {{ __("web.Most Sold") }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('about-us') }}">
                                        {{ __("web.About Us") }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('contact-us') }}">
                                        {{ __("web.Contact") }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="single-wized">
                        <h6 class="title">
                            {{ __('web.Contact Us') }}
                        </h6>
                        <div class="body">
                            <p class="phone d-flex align-items-center">
                                <i class="rt-icon-phone-flip"></i>
                                <a href="call-to:{{ $customer_care_mobile }}">
                                    {{ $customer_care_mobile }}
                                </a>
                            </p>
                            <p class="email d-flex align-items-center">
                                <i class="rt-icon-envelope"></i>
                                <a href="mail-to:{{ $customer_care_email }}">
                                    {{ $customer_care_email }}
                                </a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-area-inner d-flex align-items-center justify-content-between">
                        <p>{{ __('web.Copyright') }} ©
                            <script>
                                document.write(
                                    new Date().getFullYear()
                                )
                            </script>
                            {{ __('web.All Rights Reserved by') }} Autovalut 
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
