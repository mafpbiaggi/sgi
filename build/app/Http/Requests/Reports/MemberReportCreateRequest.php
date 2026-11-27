<?php

namespace App\Http\Requests\Reports;

use App\Concerns\MemberReportValidationRules;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class MemberReportCreateRequest extends FormRequest
{
    use MemberReportValidationRules;
    
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('members_report.generate');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->memberReportRules();
    }
}
