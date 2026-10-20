<?php

namespace App\Concerns;

use Illuminate\Contracts\Validation\ValidationRule;

trait RoleValidationRules
{
    /**
     * Get the validation rules used to validate user roles.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function roleRules(): array
    {
        return ['nullable', 'array'];
    }

    /**
     * Get the validation roles used to validate user.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function assignRoleRules(): array
    {
        return ['string', 'exists:roles,name'];
    }
}
