@extends('web.layout.default')
@section('content')

@include('web.includes.search')
@include('web.includes.progress')

<div class="rts-wrapper">
    <div class="rts-wrapper-inner">
        <!-- header area start -->
        <!-- header area start -->

        <!-- header area end -->
        @include('web.includes.header')
        <!-- header area end -->

        <!-- Banner area start -->
        @include('web.includes.slider')
        <!-- Banner area end -->

        <!-- Category Area Start -->
        @include('web.includes.brands')
        <!-- Category Area End -->

        <!-- Portfolio Area Start -->
        @include('web.includes.best-cars')
        <!-- Portfolio Area End -->

        <!-- About Area Start -->
        @include('web.includes.about-us')
        <!-- About Area End -->

        @include('web.includes.red-contact-banner')


    </div>
</div>

<!-- rts footer area start -->
@include('web.includes.footer')
<!-- rts footer area end -->

<!-- header style two -->
@include('web.includes.header-two')
<!-- header style two End -->

@endsection
