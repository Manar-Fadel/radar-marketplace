<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Offer;
use Illuminate\Http\JsonResponse;

class StatisticsController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'total_users' => User::count(),
            'dealers' => User::where('user_type', 'dealer')->count(),
            'bank_delegates' => User::where('user_type', 'bank_delegate')->count(),
            'total_orders' => Order::count(),
            'active_orders' => Order::where('status', 'active')->count(),
            'accepted_orders' => Order::where('status', 'accepted')->count(),
            'total_offers' => Offer::count(),
            'active_offers' => Offer::where('status', 'active')->count(),
        ]);
    }
}
