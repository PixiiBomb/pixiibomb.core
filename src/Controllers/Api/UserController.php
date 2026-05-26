<?php

namespace PixiiBomb\Core\Controllers\Api;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use PixiiBomb\Core\Schemas\UserSchema;

class UserController extends ApiController
{
    protected function model(): string
    {
        return User::class;
    }

    protected function schema(): string
    {
        return UserSchema::class;
    }

    public function create(Request $request): JsonResponse
    {
        $data = $this->validated($request, 'create');

        if (User::query()->where('email', $data['email'])->exists()) {
            throw ValidationException::withMessages([
                'email' => ['The email has already been taken.'],
            ]);
        }

        $data['password'] = Hash::make($data['password']);

        $user = User::query()->create($data);
        $token = $user->createToken('api')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::query()->where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user->tokens()->delete();

        $token = $user->createToken('api')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()?->currentAccessToken()?->delete();

        return response()->json([
            'ok' => true,
        ]);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'user' => $request->user(),
        ]);
    }

    public function patchAvatar(Request $request, int|string $id): JsonResponse
    {
        $user = User::query()->findOrFail($id);

        $data = $this->validated($request, 'avatar');

        $user->update([
            'avatar' => $data['avatar'],
        ]);

        return response()->json([
            'data' => $user->fresh(),
        ]);
    }
}
