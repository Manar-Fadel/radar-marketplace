<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $user = User::create([
                'full_name' => $request->input('full_name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'phone_number' => $request->input('phone_number'),
                'user_type' => $request->input('user_type'),
                'document_url' => $request->file('document_url') ?? null,
                'is_verified_email' => false,
                'is_verified_admin' => false,
                'is_trusted' => false,
            ]);

            event(new Registered($user));

            // هنا تبعت إيميل تفعيل
            return response()->json([
                'status' => true,
                'message' => 'تم التسجيل بنجاح. الرجاء التحقق من البريد الإلكتروني.',
                'data' => [
                    'user' => new UserResource($user)
                ],
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

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $user = User::where('email', $request->input('email'))->first();
            if (!$user || !Hash::check($request->input('password'), $user->password)) {
                throw new \Exception('بيانات الدخول غير صحيحة');
            }

            $token = $user->createToken('api_token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'تم الدخول بنجاح',
                'data' => [
                    'user' => new UserResource($user),
                    'token' => $token
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

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => false,
            'message' => 'تم تسجيل الخروج بنجاح'
        ]);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }

    public function verifyEmail(Request $request): JsonResponse
    {
        // هنا تتحقق من كود التفعيل المرسل بالإيميل
        return response()->json(['message' => 'تم تفعيل البريد الإلكتروني']);
    }
}
