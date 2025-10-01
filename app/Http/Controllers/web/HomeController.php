<?php

namespace App\Http\Controllers\web;

use App\Managers\SettingsManager;
use App\Models\Brand;
use App\Models\OurCar;

class HomeController
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $local = app()->getLocale();
        $customer_care_mobile = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_MOBILE');
        $customer_care_email = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_EMAIL');
        $location = $local == 'ar' ? SettingsManager::getSettingsValueByKey('LOCATION_AR') : SettingsManager::getSettingsValueByKey('LOCATION_EN');

        $slider_banners = OurCar::where('is_slider_banner', 1)->take(3)->get();
        $brands = Brand::where('is_main', 1)->take(10)->get();
        $best_cars = OurCar::where('is_best_car', 1)->take(10)->get();

        return view('web.index', compact( 'local',
            'customer_care_mobile',  'customer_care_email', 'location',
            'slider_banners', 'brands', 'best_cars'
        ));
    }

    public function contactUs(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $local = app()->getLocale();
        $customer_care_mobile = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_MOBILE');
        $customer_care_email = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_EMAIL');
        $location = $local == 'ar' ? SettingsManager::getSettingsValueByKey('LOCATION_AR') : SettingsManager::getSettingsValueByKey('LOCATION_EN');

        return view("web.contact-us",  compact( 'local', 'customer_care_mobile', 'customer_care_email', 'location'));
    }

    public function aboutUs(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $local = app()->getLocale();
        $customer_care_mobile = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_MOBILE');
        $customer_care_email = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_EMAIL');
        $location = $local == 'ar' ? SettingsManager::getSettingsValueByKey('LOCATION_AR') : SettingsManager::getSettingsValueByKey('LOCATION_EN');

        return view("web.about-us", compact( 'local', 'customer_care_mobile', 'customer_care_email', 'location'));
    }

}
