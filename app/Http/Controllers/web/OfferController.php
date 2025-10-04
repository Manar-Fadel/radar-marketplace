<?php

namespace App\Http\Controllers\web;

use App\Managers\Constants;
use App\Managers\SettingsManager;
use App\Models\Order;

class OfferController
{
    /*
     * return all pending orders to dealer,
     */
   public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
    {
        if (auth()->user()->user_type != Constants::DEALER){
            return redirect()->back();
        }
        $local = app()->getLocale();
        $customer_care_mobile = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_MOBILE');
        $customer_care_email = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_EMAIL');
        $location = $local == 'ar' ? SettingsManager::getSettingsValueByKey('LOCATION_AR') : SettingsManager::getSettingsValueByKey('LOCATION_EN');

        $orders = Order::where('status', Constants::PENDING)
                        ->where('user_id', '!=', auth()->id())
                        ->orderBy('id', 'desc')
                        ->paginate(10);

        return view('web.dealer.others-orders', compact(
            'orders', 'customer_care_mobile', 'customer_care_email',
            'location', 'local'
        ));
    }


}
