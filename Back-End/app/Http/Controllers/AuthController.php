<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(
        protected UserRepository $repository,
        protected UserService $service
    ) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->service->register($request->validated());

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->success([
            'user'  => new UserResource($user),
            'token' => $token,
        ], __('auth.register_success'), 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (! Auth::attempt($request->only('username', 'password'))) {
            return response()->error(__('auth.invalid_credentials'), 401);
        }

        $user = Auth::user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->success([
            'user'  => new UserResource($user),
            'token' => $token,
        ], __('auth.logged_in_success'));
    }

    public function logout(): JsonResponse
    {
        Auth::user()->tokens()->delete();

        return response()->success(null, __('auth.logged_out_success'));
    }

    public function me(): JsonResponse
    {
        return response()->success(new UserResource(Auth::user()), __('auth.logged_in_info'));
    }
}
