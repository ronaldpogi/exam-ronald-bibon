<?php

namespace App\Services;

use App\Events\UserRegistered;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        protected UserRepository $userRepo,
    ) {}

    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        $user = $this->userRepo->create($data);

        $user->roles()->attach($data['role_id']);

        // Example: business logic after creation
        // send welcome email, dispatch event, etc.
        // event(new UserRegistered($user));

        return $user;
    }
}
