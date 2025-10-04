<?php

namespace App\Http\Controllers\web;

use App\Managers\SettingsManager;
use App\Models\Order;

class OrderController
{
    public function orderNow():  \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $local = app()->getLocale();
        $customer_care_mobile = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_MOBILE');
        $customer_care_email = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_EMAIL');
        $location = $local == 'ar' ? SettingsManager::getSettingsValueByKey('LOCATION_AR') : SettingsManager::getSettingsValueByKey('LOCATION_EN');

        return view('web.order-now',  compact(
            'customer_care_mobile', 'customer_care_email',
            'location', 'local'
        ));
    }
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $local = app()->getLocale();
        $customer_care_mobile = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_MOBILE');
        $customer_care_email = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_EMAIL');
        $location = $local == 'ar' ? SettingsManager::getSettingsValueByKey('LOCATION_AR') : SettingsManager::getSettingsValueByKey('LOCATION_EN');

        $orders = Order::where('user_id', auth()->id())->orderBy('id', 'desc')->paginate(10);
        return view('web.my-orders', compact(
            'orders', 'customer_care_mobile', 'customer_care_email',
            'location', 'local'
        ));
    }

    public function view($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {

    }
}
