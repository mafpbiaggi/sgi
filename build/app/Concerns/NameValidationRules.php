<?php

namespace App\Concerns;

use Illuminate\Contracts\Validation\ValidationRule;

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
}
