<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class OrderController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $year = empty($request->get('year')) ? Carbon::now()->year : $request->get('year');
        $month = empty($request->get('month')) ? Carbon::now()->month : $request->get('month');
        $search_word = $request->get('search_word');
        $brand_id = $request->get('brand_id');

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
            $orders = Order::whereDate('created_at', '>=', $stat_start_date)
                ->whereDate('created_at', '<=', $stat_to_date);
        }else{
            $orders = Order::whereDate('created_at', '>=', $from_date)
                ->whereDate('created_at', '<=', $to_date);
        }

        $orders = $orders->when(! empty($search_word), function ($query) use ($search_word) {
                        return $query->where('order_number', 'like', '%'.$search_word.'%')
                                ->orWhere('description', 'like', '%'.$search_word.'%');
                    })->when(! empty($brand_id), function ($query) use ($brand_id) {
                        return $query->where('brand_id', $brand_id);
                    })
                    ->withTrashed()
                    ->orderBy('id', 'DESC')
                    ->get()
                    ->groupBy(function ($item) {
                        return $item->created_at->format('d-m-Y');
                    });

        $data = [];
        $orders->collect()->each(function ($item, $key) use (&$data) {
            $data[$key] = OrderResource::collection($item);
        });

        return Response::json([
            'status' => true,
            'data' => [
                'lists' => $data,
            ]
        ]);
    }

    public function show($id): JsonResponse
    {
        $order = Order::with('user', 'brand', 'offers')->findOrFail($id);
        return response()->json([
            'status' => true,
            'data' => [
                'order' => new OrderResource($order),
            ]
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:active,accepted,cancelled,completed',
        ]);

        $order->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'تم تحديث الطلب',
            'data' => [
                new OrderResource($order)
            ]
        ]);
    }

    public function destroy($id): JsonResponse
    {
        Order::findOrFail($id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم حذف الطلب'
        ]);
    }
}
