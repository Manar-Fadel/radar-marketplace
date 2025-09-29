<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FeeStatus;
use App\Enums\OrderStatus;
use App\Enums\ReviewStatus;
use App\Http\Controllers\Controller;
use App\Models\Settings\SystemLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $currentMonthText = Carbon::now()->format('M');

        return view('cpanel.dashboard', [
            'part_statuses' => OrderStatus::cases(),
            'review_statuses' => ReviewStatus::cases(),
            'fee_statuses' => FeeStatus::cases(),
            'currentMonth' => $currentMonthText,
            'years' => [2021, 2022, 2023, 2024, 2025, 2026],
            'months' => ['01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April', '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August', '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'],
            'weeks' => ['FIRST_WEEK' => 'First week', 'SECOND_WEEK' => 'Second Week', 'THIRD_WEEK' => 'Third Week', 'FOURTH_WEEK' => 'Fourth Week'],
        ]);
    }

    public function logs(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('cpanel.logs.index', [
            'years' => [2021, 2022, 2023, 2024, 2025, 2026],
            'months' => ['01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April', '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August', '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'],
            'weeks' => ['FIRST_WEEK' => 'First week', 'SECOND_WEEK' => 'Second Week', 'THIRD_WEEK' => 'Third Week', 'FOURTH_WEEK' => 'Fourth Week']
        ]);
    }
}
