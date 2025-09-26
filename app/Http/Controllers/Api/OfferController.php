<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateOfferRequest;
use App\Http\Resources\OfferResource;
use App\Managers\Constants;
use App\Models\Offer;
use App\Models\OfferImage;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    public function store(CreateOfferRequest $request): JsonResponse
    {
        try {
            $order = Order::findOrFail($request->get('order_id'));
            if ($order->status !== Constants::PENDING) {
                return response()->json(['message' => 'لا يمكن إضافة عرض لطلب غير نشط'], 400);
            }

            $offer = Offer::create([
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'price' => $request->get('price'),
                'status' => Constants::PENDING,
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->storeAs('uploads/offers/' . date('Y-m'), time() . '.' . $image->getClientOriginalExtension(), 'public');
                    OfferImage::create([
                        'offer_id' => $offer->id,
                        'image_url' => $path,
                    ]);
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'تم إرسال العرض بنجاح',
                'data' => [
                    'offer' => new OfferResource($offer),
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
    public function cancel($offerId): JsonResponse
    {
        try {
            $offer = Offer::where('id', $offerId)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            if ($offer->status !== Constants::PENDING) {
                return response()->json(['message' => 'لا يمكن إلغاء هذا العرض'], 400);
            }

            $offer->update(['status' => Constants::CANCELLED]);

            return response()->json([
                'status' => true,
                'message' => 'تم إلغاء العرض بنجاح',
                'data' => [
                    'offer' => new OfferResource($offer),
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
}
