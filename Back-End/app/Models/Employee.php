<?php

namespace App\Models;

use App\Enums\RolePossition;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'position',
    ];

    protected function casts(): array
    {
        return [
            'position' => RolePossition::class,
        ];
    }
}
