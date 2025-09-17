<?php

namespace App\Policies;

use App\Enums\RolePossition;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Log;

class EmployeePolicy
{

    public function scope(User $user, $query)
    {
        if ($user->roles()->where('name', RolePossition::WEB_DEVELOPER->value)->exists()) {
            return $query->where('position', RolePossition::WEB_DEVELOPER->value);
        }

        if ($user->roles()->where('name', RolePossition::WEB_DESIGNER->value)->exists()) {
            return $query->where('position', RolePossition::WEB_DESIGNER->value);
        }

        // Manager sees all
        return $query;
    }

    public function index(User $user): bool
    {
        // Manager, Developer, and Designer are allowed to list employees
        return $user->roles()->whereIn('name', [
            RolePossition::MANAGER->value,
            RolePossition::WEB_DEVELOPER->value,
            RolePossition::WEB_DESIGNER->value,
        ])->exists();
    }

    public function store(User $user, Employee $employee): bool
    {
        $roleToAssign = $employee->position->value;

        // Manager can create Developer or Designer
        if ($user->roles()->where('name', RolePossition::MANAGER->value)->exists()) {
            return in_array($roleToAssign, [
                RolePossition::WEB_DEVELOPER->value,
                RolePossition::WEB_DESIGNER->value,
                RolePossition::MANAGER->value,
            ]);
        }

        // Developer can only create Developer
        if ($user->roles()->where('name', RolePossition::WEB_DEVELOPER->value)->exists()) {
            return $roleToAssign === RolePossition::WEB_DEVELOPER->value;
        }

        // Designer can only create Designer
        if ($user->roles()->where('name', RolePossition::WEB_DESIGNER->value)->exists()) {
            return $roleToAssign === RolePossition::WEB_DESIGNER->value;
        }

        return false; // Everyone else blocked
    }

    public function show(User $user, Employee $employee): bool
    {
        return $this->checkSamePosition($user, $employee);
    }

    public function update(User $user, Employee $employee): bool
    {
        return $this->checkSamePosition($user, $employee);
    }

    public function destroy(User $user, Employee $employee): bool
    {
        return $this->checkSamePosition($user, $employee);
    }

    private function checkSamePosition(User $user, Employee $employee): bool
    {
         $roleToAssign = $employee->position->value;

        if ($user->roles()->where('name', RolePossition::MANAGER->value)->exists()) {
            return in_array($roleToAssign, [
                RolePossition::WEB_DEVELOPER->value,
                RolePossition::WEB_DESIGNER->value,
                RolePossition::MANAGER->value,
            ]);
        }

        // Web Developer role → can only work on employees with position Web Developer
        if ($user->roles()->where('name', RolePossition::WEB_DEVELOPER->value)->exists()) {
            return $roleToAssign === RolePossition::WEB_DEVELOPER->value;
        }

        // Web Designer role → can only work on employees with position Web Designer
        if ($user->roles()->where('name', RolePossition::WEB_DESIGNER->value)->exists()) {
            return $roleToAssign === RolePossition::WEB_DESIGNER->value;
        }

        // Others → forbidden
        return false;
    }
}
