<?php

namespace App\Http\Requests;

use App\Concerns\VisitorValidationRules;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class VisitorStoreRequest extends FormRequest
{
    use VisitorValidationRules;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->visitorRules();
    }
}
