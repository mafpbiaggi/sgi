<?php

namespace App\Concerns;

use App\Concerns\DateValidationRules;
use App\Concerns\NameValidationRules;
use App\Concerns\PhoneValidationRules;
use App\Enums\EducationalLevel;
use App\Enums\Gender;
use App\Enums\MaritalStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

trait MemberValidationRules
{
    use DateValidationRules;
    use NameValidationRules;
    use PhoneValidationRules;

    /**
     * Get the validation rules used to validate user profiles.
     *
     * @return array<string, array<int, ValidationRule|array<mixed>|string>>
     */
    protected function memberRules(): array
    {
        return [
            'name' => $this->memberNameRules(),
            'gender' => $this->memberGenderRule(),
            'birth_date' => $this->memberBirthDateRules(),
            'birthplace' => $this->memberBirthplaceRules(),
            'document_rg' => $this->memberDocumentRgRules(),
            'document_cpf' => $this->memberDocumentCpfRules(),
            'marital_status' => $this->memberMaritalStatusRules(),
            'marriage_date' => $this->memberDateRules(),
            'spouse_name' => $this->memberSpouseNameRules(),
            'father_name' => $this->memberParentNameRules(),
            'mother_name' => $this->memberParentNameRules(),
            'email' => $this->memberEmailRules(),
            'phone' => $this->memberPhoneRules(),
            'secondary_phone' => $this->memberPhoneRules(),
            'mobile_phone' => $this->memberPhoneRules(),
            'street' => $this->memberAddressStreetRules(),
            'number' => $this->memberAddressNumberRules(),
            'complement' => $this->memberAddressComplementRules(),
            'neighborhood' => $this->memberAddressNeighborhoodRules(),
            'postal_code' => $this->memberAddressPostalCodeRules(),
            'city' => $this->memberAddressCityRules(),
            'state' => $this->memberAddressStateRules(),
            'educational_level' => $this->memberEducationalLevelRules(),
            'occupation' => $this->memberOccupationRules(),
            'is_under_discipline' => $this->memberIsUnderDisciplineRules(),
            'is_baptized' => $this->memberIsBaptizedRules(),
            'baptism_date' => $this->memberDateRules(),
            'baptism_church' => $this->memberBaptismChurchRules(),
            'baptism_pastor' => $this->memberBaptismPastorRules(),
            'has_professed_faith' => $this->memberHasProfessedFaithRules(),
            'profession_of_faith_date' => $this->memberDateRules(),
            'profession_of_faith_church' => $this->memberProfessionOfFaithChurchRules(),
            'profession_of_faith_pastor' => $this->memberProfessionOfFaithPastorRules(),
            'last_church' => $this->memberLastChurchRules(),
            'admission' => ['required', 'array'],
            'admission.membership_type' => ['required', 'integer'],
            'admission.membership_status' => ['required', 'integer'],
            'admission.admission_order' => ['required', 'string', 'max:255'],
            'admission.admission_date' => ['required', 'date_format:d/m/Y'],
            'admission.admission_reason' => ['required', 'integer'],
            'admission.admission_minute' => ['required', 'integer'],
            'admission.dismissal_date' => ['nullable', 'date_format:d/m/Y'],
            'admission.dismissal_reason' => ['nullable', 'integer'],
            'admission.dismissal_minute' => ['nullable', 'integer'],
        ];
    }

    /**
     * Get the validation rule used to validate field names.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberNameRules(): array
    {
        return $this->nameRules();
    }

    /**
     * Get the validation rule used to validate field gender.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberGenderRule(): array
    {
        return ['required', Rule::enum(Gender::class)];
    }

    /**
     * Get the validation rule used to validate field birth_date.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberBirthDateRules(): array
    {
        return $this->dateRules();
    }

    /**
     * Get the validation rule used to validate fields birthplace.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberBirthplaceRules(): array
    {
        return ['required', 'string', 'max:255'];
    }

    /**
     * Get the validation rule used to validate field document_rg.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberDocumentRgRules(): array
    {
        return ['nullable', 'string', 'max:12'];
    }

    /**
     * Get the validation rule used to validate field document_cpf.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberDocumentCpfRules(): array
    {
        return ['nullable', 'string', 'max:14'];
    }

    /**
     * Get the validation rule used to validate field marital_status.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberMaritalStatusRules(): array
    {
        return ['required', Rule::enum(MaritalStatus::class)];
    }

    /**
     * Get the validation rule used to validate father_name and mother_name fields.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberParentNameRules(): array
    {
        return ['nullable', 'string', 'max:255'];
    }

    /**
     * Get the validation rule used to validate field spouse_name.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberSpouseNameRules(): array
    {
        return ['nullable', 'string', 'max:255'];
    }

    /**
     * Get the validation rule used to validate field email.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberEmailRules(): array
    {
        return ['nullable', 'string', 'email', 'max:255'];
    }

    /**
     * Get the validation rule used to validate field phone.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberPhoneRules(): array
    {
        return $this->nullablePhoneRules();
    }

    /**
     * Get the validation rule used to validate field street.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberAddressStreetRules(): array
    {
        return ['required', 'string', 'max:255'];
    }

    /**
     * Get the validation rule used to validate field number.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberAddressNumberRules(): array
    {
        return ['required', 'string', 'max:6'];
    }

    /**
     * Get the validation rule used to validate field complement.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberAddressComplementRules(): array
    {
        return ['nullable', 'string', 'max:255'];
    }

    /**
     * Get the validation rule used to validate field neighborhood.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberAddressNeighborhoodRules(): array
    {
        return ['required', 'string', 'max:255'];
    }

    /**
     * Get the validation rule used to validate field postal_code.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberAddressPostalCodeRules(): array
    {
        return ['required', 'string', 'max:9'];
    }

    /**
     * Get the validation rule used to validate field city.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberAddressCityRules(): array
    {
        return ['required', 'string', 'max:255'];
    }

    /**
     * Get the validation rule used to validate field state.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberAddressStateRules(): array
    {
        return ['required', 'string', 'max:2'];
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
     * Get the validation rule used to validate field occupation.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberOccupationRules(): array
    {
        return ['nullable', 'string', 'max:255'];
    }

    /**
     * Get the validation rule used to validate field is_under_discipline.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberIsUnderDisciplineRules(): array
    {
        return ['required', 'boolean'];
    }

    /**
     * Get the validation rule used to validate field is_baptized.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberIsBaptizedRules(): array
    {
        return ['required', 'boolean'];
    }

    /**
     * Get the validation rule used to validate field baptism_church.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberBaptismChurchRules(): array
    {
        return ['nullable', 'string', 'max:255'];
    }

    /**
     * Get the validation rule used to validate field baptism_pastor.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberBaptismPastorRules(): array
    {
        return ['nullable', 'string', 'max:255'];
    }

    /**
     * Get the validation rule used to validate field has_professed_faith.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberHasProfessedFaithRules(): array
    {
        return ['required', 'boolean'];
    }

    /**
     * Get the validation rule used to validate field profession_of_faith_church.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberProfessionOfFaithChurchRules(): array
    {
        return ['nullable', 'string', 'max:255'];
    }

    /**
     * Get the validation rule used to validate field profession_of_faith_pastor.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberProfessionOfFaithPastorRules(): array
    {
        return ['nullable', 'string', 'max:255'];
    }

    /**
     * Get the validation rule used to validate field last_church.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberLastChurchRules(): array
    {
        return ['nullable', 'string', 'max:255'];
    }

    /**
     * Get the validation rule used to validate date fields.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function memberDateRules(): array
    {
        return $this->nullableDateRules();
    }
}
