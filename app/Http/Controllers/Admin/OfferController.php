<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OfferStatus;
use App\Http\Controllers\Controller;
use App\Managers\Constants;
use App\Managers\ExcelManager;
use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('cpanel.offer.index', [
            'years' => Constants::YEARS_LIST,
            'months' => Constants::MONTHS_LIST,
            'weeks' => Constants::WEEKS_LIST,
            'offer_statuses' => OfferStatus::cases(),
        ]);
    }
    public function export(Request $request): \Illuminate\Http\RedirectResponse
    {
        $year = ! empty($request->get('year')) ? $request->get('year') : Carbon::now()->year;
        $month = ! empty($request->get('month')) ? $request->get('month') : Carbon::now()->month;
        $search_word = $request->get('search_word', '');
        $offer_status = $request->get('offer_status', '');

        $to_date = Carbon::now();
        $from_date = Carbon::now()->subDays(7);

        if (! empty($request->get('week'))) {
            if ($request->get('week') == 'FIRST_WEEK') {
                $from_date = Carbon::parse($year.'-'.$month.'-'.'01');
                $to_date = Carbon::parse($year.'-'.$month.'-'.'07'.' 23:59:59');
            } elseif ($request->get('week') == 'SECOND_WEEK') {
                $from_date = Carbon::parse($year.'-'.$month.'-'.'07');
                $to_date = Carbon::parse($year.'-'.$month.'-'.'14'.' 23:59:59');

            } elseif ($request->get('week') == 'THIRD_WEEK') {
                $from_date = Carbon::parse($year.'-'.$month.'-'.'14');
                $to_date = Carbon::parse($year.'-'.$month.'-'.'24'.' 23:59:59');

            } elseif ($request->get('week') == 'FOURTH_WEEK') {
                $from_date = Carbon::parse($year.'-'.$month.'-'.'24');
                $to_date = Carbon::parse($from_date)->endOfMonth();
            }
        }else{
            $from_date = Carbon::parse($year.'-'.$month.'-'.'01');
            $to_date = Carbon::parse($from_date)->endOfMonth();
        }

        $offers = Offer::whereDate('created_at', '>=', $from_date)
            ->whereDate('created_at', '<=', $to_date)
            ->where('is_deleted', 0)
            ->when(! empty($search_word), function ($query) use ($search_word) {
                return $query->where('offer_number', 'like', '%'.$search_word.'%')
                    ->orWhere('description', 'like', '%'.$search_word.'%');
            })
            ->when(! empty($offer_status), function ($query) use ($offer_status) {
                return $query->where('status', $offer_status);
            })
            ->orderBy('id', 'DESC')
            ->get();

        if (count($offers) <= 0){
            return redirect()->back();
        }

        ExcelManager::exportOffers($offers);
        return redirect()->back();
    }


}
