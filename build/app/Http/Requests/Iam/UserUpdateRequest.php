<?php

namespace App\Http\Requests\Iam;

use App\Concerns\NameValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Concerns\PasswordValidationRules;
use App\Concerns\RoleValidationRules;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    use NameValidationRules;
    use ProfileValidationRules;
    use PasswordValidationRules;
    use RoleValidationRules;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        $user = $this->route('user');
        
        return [
            'name' => $this->nameRules(),
            'email' => $this->emailRules($user->id),
            'password' => $this->updatePasswordRules(),
            'roles' => $this->roleRules(),
            'roles.*' => $this->assignRoleRules(),
        ];
    }
}
