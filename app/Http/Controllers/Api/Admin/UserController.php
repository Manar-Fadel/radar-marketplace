<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(User::paginate(20));
    }

    public function show($id): JsonResponse
    {
        return response()->json(User::findOrFail($id));
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['is_verified_email'] = true;
        $data['is_verified_admin'] = true;
        $user = User::create($data);

        return response()->json([
            'status' => 'true',
            'message' => 'تمت إضافة المستخدم بنجاح',
            'data' => [
                'user' => new UserResource($user)
            ]],
            201
        );
    }

    public function update(UpdateUserRequest $request, $id): JsonResponse
    {
        $user = User::findOrFail($id);
        $user->update($request->validated());
        return response()->json([
            'status' => 'true',
            'message' => 'تم تحديث المستخدم',
            'data' => [
                'user' => new UserResource($user)
            ]
        ]);
    }

    public function destroy($id): JsonResponse
    {
        User::findOrFail($id)->delete();
        return response()->json([
            'status' => 'true',
            'message' => 'تم حذف المستخدم'
        ]);
    }
}
