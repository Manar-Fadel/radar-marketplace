<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class NotificationController extends Controller
{
    public function index(): JsonResponse
    {
        $notifications = Notification::with('user')->paginate(20);
        return Response::json([
            'status' => true,
            'data' => [
                'lists' => NotificationResource::collection($notifications),
            ]
        ]);
    }

    public function show($id): JsonResponse
    {
        return response()->json(Notification::with('user')->findOrFail($id));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'message_ar' => 'required|string',
            'message_en' => 'required|string',
        ]);

        $notification = Notification::create($validated);

        return response()->json(['message' => 'تم إنشاء الإشعار بنجاح', 'notification' => $notification], 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $notification = Notification::findOrFail($id);

        $validated = $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'message_ar' => 'required|string',
            'message_en' => 'required|string',
        ]);

        $notification->update($validated);

        return response()->json(['message' => 'تم تحديث الإشعار', 'notification' => $notification]);
    }

    public function destroy($id): JsonResponse
    {
        Notification::findOrFail($id)->delete();
        return response()->json(['message' => 'تم حذف الإشعار']);
    }
}
