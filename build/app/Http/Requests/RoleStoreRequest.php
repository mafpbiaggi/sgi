<?php

namespace App\Http\Requests;

use App\Concerns\NameValidationRules;
use App\Concerns\PermissionValidationRules;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RoleStoreRequest extends FormRequest
{
    use NameValidationRules;
    use PermissionValidationRules;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => $this->uniqueNameRules(),
            'permissions' => $this->permissionRules(),
            'permissions.*' => $this->assignPermissionRules(),
        ];
    }
}
