<?php

namespace App\Http\Controllers;

use App\Enums\RolePossition;
use App\Http\Resources\OptionResource;
use App\Http\Resources\RoleResource;

class OptionController extends Controller
{
    public function positions()
    {
        $positions = collect(RolePossition::cases())->map(function ($case) {
            return [
                'value' => $case->value
            ];
        });

        return response()->success(OptionResource::collection($positions), __('crud.read', ['resource' => 'Options']));
    }

    public function roles()
    {
        $positions = collect(RolePossition::cases())->map(function ($case) {
            return [
                'value' => $case->value
            ];
        });

        return response()->success(RoleResource::collection($positions), __('crud.read', ['resource' => 'Roles']));
    }
}
