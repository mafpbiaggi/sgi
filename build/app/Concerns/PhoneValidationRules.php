<?php

namespace App\Concerns;

use Illuminate\Contracts\Validation\ValidationRule;

trait PhoneValidationRules
{
    /**
     * Get the validation rule used to validate field names.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function phoneRules(): array
    {
        return ['required', 'string', 'max:15'];
    }

    /**
     * Get the validation rule used to validate field names.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function nullablePhoneRules(): array
    {
        return ['nullable', 'string', 'max:15'];
    }
}
