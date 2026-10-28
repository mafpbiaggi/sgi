<?php

namespace App\Models;

use App\Enums\Boolean;
use App\Enums\EducationalLevel;
use App\Enums\Gender;
use App\Enums\MaritalStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable([
    'name',
    'gender',
    'birth_date',
    'birthplace',
    'document_rg',
    'document_cpf',
    'marital_status',
    'marriage_date',
    'spouse_name',
    'father_name',
    'mother_name',
    'email',
    'phone',
    'secondary_phone',
    'mobile_phone',
    'street',
    'number',
    'complement',
    'neighborhood',
    'postal_code',
    'city',
    'state',
    'educational_level',
    'occupation',
    'is_under_discipline',
    'is_baptized',
    'baptism_date',
    'baptism_church',
    'baptism_pastor',
    'has_professed_faith',
    'profession_of_faith_date',
    'profession_of_faith_church',
    'profession_of_faith_pastor',
    'last_church',
])]

class Member extends Model
{
    protected $appends = [
        'gender_label',
        'marital_status_label',
        'educational_level_label',
        'is_under_discipline_label',
        'is_baptized_label',
        'has_professed_faith_label',
    ];

    public function admissions(): HasMany
    {
        return $this->hasMany(MemberAdmission::class);
    }

    public function currentAdmission(): HasOne
    {
        return $this->hasOne(MemberAdmission::class)->latestOfMany();
    }

    protected function casts(): array
    {
        $dateFormat = 'date:d/m/Y';

        return [
            'birth_date' => $dateFormat,
            'marriage_date' => $dateFormat,
            'baptism_date' => $dateFormat,
            'profession_of_faith_date' => $dateFormat,
            'gender' => Gender::class,
            'marital_status' => MaritalStatus::class,
            'educational_level' => EducationalLevel::class,
            'is_under_discipline' => Boolean::class,
            'is_baptized' => Boolean::class,
            'has_professed_faith' => Boolean::class,
        ];
    }

    protected function genderLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->gender?->label(),
        );
    }

    protected function maritalStatusLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->marital_status?->label(),
        );
    }

    protected function educationalLevelLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->educational_level?->label(),
        );
    }

    protected function isUnderDisciplineLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->is_under_discipline?->label(),
        );
    }

    protected function isBaptizedLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->is_baptized?->label(),
        );
    }

    protected function hasProfessedFaithLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->has_professed_faith?->label(),
        );
    }
}
