<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AcceptOfferRequest;
use App\Http\Requests\Api\CreateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Managers\Constants;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(CreateOrderRequest $request): JsonResponse
    {
        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'brand_id' => $request->input('brand_id'),
                'description' => $request->input('description'),
                'status' => Constants::PENDING,
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->storeAs('uploads/orders/' . date('Y-m'), time() . '.' . $image->getClientOriginalExtension(), 'public');
                    OrderImage::create([
                        'order_id' => $order->id,
                        'image_url' => $path,
                    ]);
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'تم إنشاء الطلب بنجاح',
                'data' => [
                    'order' => new OrderResource($order),
                ]
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
                'data' => [
                    'trace' => $exception->getTraceAsString()
                ]
            ], 400);
        }
    }
    public function acceptOffer(AcceptOfferRequest $request, $orderId): JsonResponse
    {
        try {
            $order = Order::where('id', $orderId)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            if ($order->status !== Constants::PENDING) {
                throw new \Exception('لا يمكن قبول عرض لطلب غير نشط');
            }

            DB::transaction(function () use ($order, $request) {
                $offer = Offer::findOrFail($request->get('offer_id'));
                $order->update([
                    'accepted_offer_id' => $offer->id,
                    'accepted_dealer_id' => $offer->user_id,
                    'status' => Constants::ACCEPTED,
                ]);
                $offer->update(['status' => Constants::ACCEPTED]);
            });

            return response()->json([
                'status' => true,
                'message' => 'تم قبول العرض بنجاح',
                'data' => [
                    'order' => new OrderResource($order),
                ]
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
                'data' => [
                    'trace' => $exception->getTraceAsString()
                ]
            ], 400);
        }
    }
    public function cancel($orderId): JsonResponse
    {
        try {
            $order = Order::where('id', $orderId)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            if ($order->status !== Constants::PENDING) {
                return response()->json(['message' => 'لا يمكن إلغاء هذا الطلب'], 400);
            }

            $order->update(['status' => Constants::CANCELLED]);

            return response()->json([
                'status' => true,
                'message' => 'تم إلغاء الطلب بنجاح'
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
                'data' => [
                    'trace' => $exception->getTraceAsString()
                ]
            ], 400);
        }
    }
}
