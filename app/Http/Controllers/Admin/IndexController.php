<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Managers\Constants;
use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Offer;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $dealers_count = User::where('user_type', Constants::DEALER)->count();
        $bank_delegates_count = User::where('user_type', Constants::BANK_DELEGATE)->count();
        $pending_orders_count = Order::where('status', Constants::PENDING)->count();
        $accepted_orders_count = Order::where('status', Constants::ACCEPTED)->count();
        $pending_offers_count = Offer::where('status', Constants::PENDING)->count();
        $accepted_offers_count = Offer::where('status', Constants::ACCEPTED)->count();
        $brands_count = Brand::count();
        $models_count = CarModel::count();

        return view('cpanel.dashboard', [
            'dealers_count' => $dealers_count,
            'bank_delegates_count' => $bank_delegates_count,
            'pending_orders_count' => $pending_orders_count,
            'accepted_orders_count' => $accepted_orders_count,
            'pending_offers_count' => $pending_offers_count,
            'accepted_offers_count' => $accepted_offers_count,
            'brands_count' => $brands_count,
            'models_count' => $models_count,
        ]);
    }

    public function logs(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('cpanel.logs.index', [
            'years' => Constants::YEARS_LIST,
            'months' => Constants::MONTHS_LIST,
            'weeks' => Constants::WEEKS_LIST
            ]);
    }
}
