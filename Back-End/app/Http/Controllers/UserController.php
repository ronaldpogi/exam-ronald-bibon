<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected $name = 'User';

    public function __construct(protected UserRepository $userRepository) {}

    public function index(): JsonResponse
    {
        $users = $this->userRepository->all();

        return response()->success(UserResource::collection($users), __('crud.read', ['resource' => $this->name + 's']));
    }

    public function store(UserRequest $request): JsonResponse
    {
        $user = $this->userRepository->create($request->validated());

        return response()->success(new UserResource($user), __('crud.create', ['resource' => $this->name]), 201);
    }

    public function show($id): JsonResponse
    {
        $user = $this->userRepository->find($id);

        return response()->success(new UserResource($user), __('crud.read', ['resource' => $this->name]));
    }

    public function update(UserRequest $request, $id): JsonResponse
    {
        $user = $this->userRepository->update($id, $request->validated());

        return response()->success(new UserResource($user), __('crud.update', ['resource' => $this->name]));
    }

    public function destroy($id): JsonResponse
    {
        $this->userRepository->delete($id);

        return response()->success([], __('crud.delete', ['resource' => $this->name]), 204);
    }
}
