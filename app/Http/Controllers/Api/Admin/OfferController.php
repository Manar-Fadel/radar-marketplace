<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class OfferController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $year = ! empty($request->get('year')) ? $request->get('year') : Carbon::now()->year;
        $month = ! empty($request->get('month')) ? $request->get('month') : Carbon::now()->month;
        $search_word = $request->get('search_word', '');
        $offer_status = $request->get('offer_status', '');

        $stat_start_date = $request->get('stat_start_date');
        $stat_to_date = $request->get('stat_to_date');

        if (empty($request->get('year')) && empty($request->get('month'))) {
            $to_date = Carbon::now();
            $from_date = Carbon::now()->subDays(7);
        }

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

        if (!is_null($stat_start_date) && !is_null($stat_to_date)) {
            $stat_start_date = Carbon::parse($stat_start_date)->startOfDay();
            $stat_to_date = Carbon::parse($stat_to_date)->startOfDay();
            $offers = Offer::where('created_at', '>=', $stat_start_date)
                ->where('created_at', '<=', $stat_to_date);
        }else{
            $offers = Offer::whereDate('created_at', '>=', $from_date)
                ->whereDate('created_at', '<=', $to_date);
        }


        $offers = $offers->when(! empty($search_word), function ($query) use ($search_word) {
                return $query->where('offer_number', 'like', '%'.$search_word.'%')
                    ->orWhere('description', 'like', '%'.$search_word.'%');
            })
            ->when(! empty($offer_status), function ($query) use ($offer_status) {
                return $query->where('status', $offer_status);
            })
            ->has('part')
            ->orderBy('id', 'DESC')
            ->get()
            ->groupBy(function ($item, $key) {
                return $item->created_at->format('d-m-Y');
            });

        $data = [];
        $offers->collect()->each(function ($items, $key) use (&$data) {
            $data[$key] = OfferResource::collection($items);
        });

        return Response::json([
            'status' => true,
            'lists' => $data,
        ]);
    }

    public function dealerOffers($id, Request $request): \Illuminate\Http\JsonResponse
    {
        $year = ! empty($request->get('year')) ? $request->get('year') : Carbon::now()->year;
        $month = ! empty($request->get('month')) ? $request->get('month') : Carbon::now()->month;
        $search_word = $request->get('search_word', '');
        $offer_status = $request->get('offer_status', '');

        $to_date = Carbon::now();
        $from_date = Carbon::now()->subDays(30);        // last 30day offers by default,

        if (! empty($request->get('year')) && ! empty($request->get('month'))) {
            $from_date = Carbon::parse($year.'-'.$month.'-01');
            $to_date = Carbon::parse($from_date)->endOfMonth();
        }

        $offers = Offer::where('user_id', $id)
            ->whereDate('created_at', '>=', $from_date)
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
            ->paginate(10);

        return Response::json([
            'status' => true,
            'data' => [
                "total" => $offers->total(),
                "per_page" => $offers->perPage(),
                "page" => $offers->currentPage(),
                "next_page_url" => $offers->nextPageUrl(),
                "prev_page_url" => $offers->previousPageUrl(),
                'offers' => OfferResource::collection($offers)
            ],
        ]);
    }

    public function show($id): JsonResponse
    {
        return response()->json(Offer::with('user', 'order')->findOrFail($id));
    }

    public function update(Request $request, $id): JsonResponse
    {
        $offer = Offer::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:active,cancelled,accepted,rejected',
        ]);

        $offer->update($validated);

        return response()->json(['message' => 'تم تحديث العرض', 'offer' => $offer]);
    }

    public function destroy($id): JsonResponse
    {
        Offer::findOrFail($id)->delete();
        return response()->json(['message' => 'تم حذف العرض']);
    }
}
