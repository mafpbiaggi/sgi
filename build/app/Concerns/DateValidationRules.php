<?php

namespace App\Concerns;

use Illuminate\Contracts\Validation\ValidationRule;

trait DateValidationRules
{
    /**
     * Get the validation rule used to validate field date.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function dateRules(): array
    {
        return ['required', 'date_format:d/m/Y'];
    }
}
