<?php

namespace App\Http\Requests\Iam;

use Spatie\Permission\Models\Role;
use App\Concerns\NameValidationRules;
use App\Concerns\PermissionValidationRules;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;


class RoleUpdateRequest extends FormRequest
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
        $role = $this->route('role');

        return [
            'name' => $this->uniqueNameRules(Role::class, $role->id),
            'permissions' => $this->permissionRules(),
            'permissions.*' => $this->assignPermissionRules(),
        ];
    }
}
