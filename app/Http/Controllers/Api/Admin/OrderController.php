<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChangeOrderStatusRequest;
use App\Http\Resources\OfferResource;
use App\Http\Resources\OrderImageResource;
use App\Http\Resources\OrderResource;
use App\Managers\Constants;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function userOrders($id, Request $request): \Illuminate\Http\JsonResponse
    {

        $search_word = $request->get('search_word');
        $brand_id = $request->get('brand_id');

        $models = Order::where('user_id', $id)
                        ->when(! empty($search_word), function ($query) use ($search_word) {
                            return $query->where('order_number', 'like', '%'.$search_word.'%')
                                ->orWhere('description', 'like', '%'.$search_word.'%');
                        })->when(! empty($brand_id), function ($query) use ($brand_id) {
                            return $query->where('brand_id', $brand_id);
                        })
                    ->withTrashed()
                    ->orderBy('id', 'DESC')
                    ->paginate(10);

        return Response::json([
            'status' => true,
            'data' => [
                "total" => $models->total(),
                "per_page" => $models->perPage(),
                "next_page_url" => $models->nextPageUrl(),
                "prev_page_url" => $models->previousPageUrl(),
                'orders' => OrderResource::collection($models)
            ],
        ]);
    }
    public function offers($id): \Illuminate\Http\JsonResponse
    {
        $offers = Offer::where('order_id', $id)->orderBy('id', 'DESC')->get();

        return Response::json([
            'status' => true,
            'offers' => OfferResource::collection($offers),
        ]);
    }
    public function changeStatus($id, ChangeOrderStatusRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            DB::beginTransaction();

            $model = Order::find($id);
            if (!$model instanceof Order) {
                return Response::json([
                    'status' => false,
                    'message' => 'Order not found',
                ]);
            }

            if (in_array($request->get('status'), [Constants::ACCEPTED])) {
                $offer = Offer::find($request->get('offer_id'));
                if (!$offer instanceof Offer) {
                    return Response::json([
                        'status' => false,
                        'message' => 'Offer not found',
                    ]);
                }
                $offer->status = $request->get('status');
                if ($offer->save()) {
                    $model->confirmed_offer_id = $offer->id;
                    $model->confirmed_dealer_id = $offer->user_id;
                    $model->status = $request->get('status');
                    $model->save();
                }
            }

            $model->status = $request->get('status');
            if ($model->save()) {
                return Response::json([
                    'status' => true,
                    'message' => 'Order updated successfully',
                    'order' => new OrderResource($model),
                ]);
            }

        } catch (\Throwable $e) {
            DB::rollBack();
        }
        return Response::json([
            'status' => false,
            'message' => 'Error in saving order',
        ]);
    }
    public function delete($id): \Illuminate\Http\JsonResponse
    {
        try {
            DB::beginTransaction();

            $model = Order::find($id);
            if ($model instanceof Order) {

                foreach ($model->offers as $offer) {
                    $offer->images()->delete();
                    $offer->delete();
                }

                $model->images()->delete();
                $model->delete();
                DB::commit();

                return Response::json([
                    'status' => true,
                    'message' => 'Order deleted successfully',
                ]);
            }

        } catch (\Throwable $e) {
            DB::rollBack();
        }

        return Response::json([
            'status' => false,
            'message' => 'Error in deleting Order',
        ]);
    }
    public function deleteImage($id): \Illuminate\Http\JsonResponse
    {
        $image = OrderImage::find($id);
        if (!$image instanceof OrderImage && !$image->order instanceof Order) {
            return Response::json([
                'status' => false,
                'message' => 'error in deleting order image',
            ]);
        }

        $image->delete();
        $model = $image->order;
        return Response::json([
            'status' => true,
            'message' => 'Order Image deleted successfully',
            'images' => OrderImageResource::collection($model)
        ]);

    }
    public function orderImages($id): \Illuminate\Http\JsonResponse
    {
        $model = Order::find($id);
        if (!$model instanceof Order) {
            return Response::json([
                'status' => false,
                'message' => 'Order not found',
            ]);
        }
        $images = OrderImage::where('order_id', $id)->orderBy('id', 'DESC')->get();

        return Response::json([
            'status' => true,
            'data' => [
                'images' => OrderImageResource::collection($images),
            ],
        ]);
    }
}
