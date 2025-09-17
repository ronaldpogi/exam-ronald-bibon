<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
        public function toArray(Request $request): array
        {
            return [
                'id'    => $this->id,
                'name'  => ucfirst($this->name),
                'username' => $this->username,
                'roles'    => $this->roles->pluck('name'),
                'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d'),
                'created_at' => Carbon::parse($this->created_at)->format('Y-m-d')
            ];
        }
}
