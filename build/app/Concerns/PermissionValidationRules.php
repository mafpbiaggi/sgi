<?php

namespace App\Concerns;

use Illuminate\Contracts\Validation\ValidationRule;

trait PermissionValidationRules
{
    /**
     * Get the validation rules used to validate user roles.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function permissionRules(): array
    {
        return ['nullable', 'array'];
    }

    /**
     * Get the validation permissions used to validate role.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function assignPermissionRules(): array
    {
        return ['string', 'exists:permissions,name'];
    }
}
