<?php

namespace App\Concerns;

use App\Enums\Boolean;
use App\Enums\EducationalLevel;
use App\Enums\Gender;
use App\Enums\MaritalStatus;
use App\Enums\MembershipStatus;
use App\Enums\MembershipType;
use App\Enums\Month;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

trait MemberReportValidationRules
{
    /**
     * Get the validation rules used to validate user profiles.
     *
     * @return array<string, array<int, ValidationRule|array<mixed>|string>>
     */
    protected function memberReportRules(): array
    {
        return [
            'membership_status' => $this->memberMembershipStatusRule(),
            'membership_type' => $this->memberMembershipTypeRule(),
            'gender' => $this->memberGenderRule(),
            'marital_status' => $this->memberMaritalStatusRules(),
            'educational_level' => $this->memberEducationalLevelRules(),
            'is_under_discipline' => $this->memberIsUnderDisciplineRules(),
            'is_baptized' => $this->memberIsBaptizedRules(),
            'has_professed_faith' => $this->memberHasProfessedFaithRules(),
            'birth_month' => $this->memberBirthMonthRules(),
        ];
    }

    /**
     * Get the validation rule used to validate field membership_status.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberMembershipStatusRule(): array
    {
        return [
            'nullable',
            Rule::enum(MembershipStatus::class)
        ];
    }

    /**
     * Get the validation rule used to validate field membership_type.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberMembershipTypeRule(): array
    {
        return ['nullable', Rule::enum(MembershipType::class)];
    }

    /**
     * Get the validation rule used to validate field gender.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberGenderRule(): array
    {
        return ['nullable', Rule::enum(Gender::class)];
    }

    /**
     * Get the validation rule used to validate field marital_status.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberMaritalStatusRules(): array
    {
        return ['nullable', Rule::enum(MaritalStatus::class)];
    }

    /**
     * Get the validation rule used to validate field educational_level.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberEducationalLevelRules(): array
    {
        return ['nullable', Rule::enum(EducationalLevel::class)];
    }

    /**
     * Get the validation rule used to validate field is_under_discipline.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberIsUnderDisciplineRules(): array
    {
        return ['nullable', Rule::enum(Boolean::class)];
    }

    /**
     * Get the validation rule used to validate field is_baptized.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberIsBaptizedRules(): array
    {
        return ['nullable', Rule::enum(Boolean::class)];
    }


    /**
     * Get the validation rule used to validate field has_professed_faith.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberHasProfessedFaithRules(): array
    {
        return ['nullable', Rule::enum(Boolean::class)];
    }

    /**
     * Get the validation rule used to validate field birth_month.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberBirthMonthRules(): array
    {
        return ['nullable', Rule::enum(Month::class)];
    }
}
