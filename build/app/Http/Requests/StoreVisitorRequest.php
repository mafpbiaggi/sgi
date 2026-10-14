<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVisitorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'                         => ['required', 'string', 'max:50'],
            'age'                          => ['required', 'integer'],
            'phone'                        => ['required', 'string', 'max:15'],
            'email'                        => ['required', 'email', 'max:30'],
            'visit_date'                   => ['required', 'date_format:d/m/Y'],
            'attends_church'               => ['nullable', 'string', 'max:70'],
            'prayer_request'               => ['nullable', 'string', 'max:70'],
            'referral_source'              => ['required', 'string', 'max:1'],
            'referral_source_social_media' => ['nullable', 'string', 'max:50'],
            'referral_source_other'        => ['nullable', 'string', 'max:50'],
        ];
    }
}
