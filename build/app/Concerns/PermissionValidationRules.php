<?php

namespace App\Concerns;

use Spatie\Permission\Models\Permission;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;


trait PermissionValidationRules
{
    /**
     * Get the validation roles used to validate permission.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function nameRules(?int $permissionId = null): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                $permissionId === null
                    ? Rule::unique(Permission::class)
                    : Rule::unique(Permission::class)->ignore($permissionId),
            ],
        ];
    }
}
