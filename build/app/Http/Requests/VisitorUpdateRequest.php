<?php

namespace App\Http\Requests;

use App\Concerns\VisitorValidationRules;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class VisitorUpdateRequest extends FormRequest
{
    use VisitorValidationRules;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $visitor = $this->route('visitor');

        return $this->visitorRules($visitor->id);
    }
}
