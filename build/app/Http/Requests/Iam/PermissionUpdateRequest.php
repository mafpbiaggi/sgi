<?php

namespace App\Http\Requests\Iam;

use Spatie\Permission\Models\Permission;
use App\Concerns\NameValidationRules;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PermissionUpdateRequest extends FormRequest
{
    use NameValidationRules;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $permission = $this->route('permission');

        return ['name' => $this->uniqueNameRules(Permission::class, $permission->id)];
    }
}
