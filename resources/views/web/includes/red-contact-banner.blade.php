<div class="rts-cta-area">
    <div class="container">
        <div class="cta-inner">
            <h2 class="title">
                {{ __('web.If you have any questions Please Call.') }}
            </h2>
            <div class="contact">
                <a href="call-to:{{ $customer_care_mobile }}">
                    <img src="{{ URL::asset("assets/web/images/cta/call.svg") }}" alt="">
                    {{ $customer_care_mobile }}
                </a>
            </div>
            <img class="shape one" src="{{ URL::asset("assets/web/images/cta/round.svg") }}" alt="">
            <img class="shape two" src="{{ URL::asset("assets/web/images/cta/line.svg") }}" alt="">
        </div>
    </div>
</div>
