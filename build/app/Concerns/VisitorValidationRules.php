<?php

namespace App\Concerns;

use App\Concerns\DateValidationRules;
use App\Concerns\NameValidationRules;
use App\Concerns\PhoneValidationRules;
use App\Enums\ReferralSource;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

trait VisitorValidationRules
{
    use DateValidationRules;
    use NameValidationRules;
    use PhoneValidationRules;

    /**
     * Get the validation rules used to validate user profiles.
     *
     * @return array<string, array<int, ValidationRule|array<mixed>|string>>
     */
    protected function visitorRules(): array
    {
        return [
            'name' => $this->visitorNameRules(),
            'email' => $this->visitorEmailRules(),
            'age' => $this->visitorAgeRules(),
            'phone' => $this->visitorPhoneRules(),
            'visit_date' => $this->visitorVisitDateRules(),
            'attends_church' => $this->visitorAttendsChurchRules(),
            'prayer_request' => $this->visitorPrayerRequestRules(),
            'referral_source' => $this->visitorReferralSourceRules(),
            'referral_source_social_media' => $this->visitorReferralSourceSocialMediaRules(),
            'referral_source_other' => $this->visitorReferralSourceOtherRules(),
        ];
    }

    /**
     * Get the validation rule used to validate field names.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function visitorNameRules(): array
    {
        return $this->nameRules();
    }

    /**
     * Get the validation rule used to validate field email.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function visitorEmailRules(): array
    {
        return ['required','string', 'email', 'max:255'];
    }

    /**
     * Get the validation rule used to validate field age.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function visitorAgeRules(): array
    {
        return ['required', 'integer', 'min:1', 'max:150'];
    }

    /**
     * Get the validation rule used to validate field phone.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function visitorPhoneRules(): array
    {
        return $this->phoneRules();
    }

    /**
     * Get the validation rule used to validate field visit_date.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function visitorVisitDateRules(): array
    {
        return $this->dateRules();
    }

    /**
     * Get the validation rule used to validate field attends_church.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function visitorAttendsChurchRules(): array
    {
        return ['nullable', 'string', 'max:70'];
    }

    /**
     * Get the validation rule used to validate field prayer_request.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function visitorPrayerRequestRules(): array
    {
        return ['nullable', 'string', 'max:70'];
    }

    /**
     * Get the validation rule used to validate field referral_source.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function visitorReferralSourceRules(): array
    {
        return ['required', Rule::enum(ReferralSource::class)];
    }

    /**
     * Get the validation rule used to validate field referral_source_social_media.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function visitorReferralSourceSocialMediaRules(): array
    {
        return ['nullable', 'string', 'max:50'];
    }

    /**
     * Get the validation rule used to validate field referral_source.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function visitorReferralSourceOtherRules(): array
    {
        return ['nullable', 'string', 'max:50'];
    }
}
