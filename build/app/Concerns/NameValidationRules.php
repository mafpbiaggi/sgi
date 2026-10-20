<?php

namespace App\Concerns;

use Illuminate\Contracts\Validation\ValidationRule;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

trait NameValidationRules
{
    /**
     * Get the validation rule used to validate field names.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function nameRules(): array
    {
        return ['required', 'string', 'max:255'];
    }

    /**
     * Get the validation rule used to validate field names.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function uniqueNameRules(?int $objectId = null): array
    {
        return [
            'required',
            'string',
            'max:255',
            $objectId === null
                ? Rule::unique(Role::class)
                : Rule::unique(Role::class)->ignore($objectId),
        ];
    }
}
