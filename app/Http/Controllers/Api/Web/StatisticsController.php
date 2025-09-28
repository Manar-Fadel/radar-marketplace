<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Models\StatisticsCache;
use Illuminate\Http\JsonResponse;

class StatisticsController extends Controller
{
    public function index(): JsonResponse
    {
        $stats = StatisticsCache::query()->get();

        return response()->json([
            'stats' => true,
            'data' => [
                'statistics' => $stats
            ]
        ]);
    }
}
