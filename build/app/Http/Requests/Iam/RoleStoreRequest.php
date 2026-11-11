<?php

namespace App\Http\Requests\Iam;

use Spatie\Permission\Models\Role;
use App\Concerns\NameValidationRules;
use App\Concerns\PermissionValidationRules;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RoleStoreRequest extends FormRequest
{
    use NameValidationRules;
    use PermissionValidationRules;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('roles.store');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => $this->uniqueNameRules(Role::class),
            'permissions' => $this->permissionRules(),
            'permissions.*' => $this->assignPermissionRules(),
        ];
    }
}
