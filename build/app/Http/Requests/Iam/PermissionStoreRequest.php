<?php

namespace App\Http\Requests\Iam;

use Spatie\Permission\Models\Permission;
use App\Concerns\NameValidationRules;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PermissionStoreRequest extends FormRequest
{
    use NameValidationRules;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('permissions.store');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return ['name' => $this->uniqueNameRules(Permission::class)];
    }
}
