<?php

namespace App\Http\Resources;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'position' => $this->position,
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d'),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d')
        ];
    }
}
