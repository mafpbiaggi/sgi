<?php

namespace App\Models;

use App\Enums\Boolean;
use App\Enums\EducationalLevel;
use App\Enums\Gender;
use App\Enums\MaritalStatus;
use App\Enums\MembershipStatus;
use App\Enums\MembershipType;
use Illuminate\Database\Eloquent\Model;

class MemberReport extends Model
{
    protected function casts(): array
    {
        return [
            'membership_status' => MembershipStatus::class,
            'membership_type' => MembershipType::class,
            'gender' => Gender::class,
            'marital_status' => MaritalStatus::class,
            'educational_level' => EducationalLevel::class,
            'is_under_discipline' => Boolean::class,
            'is_baptized' => Boolean::class,
            'has_professed_faith' => Boolean::class,
        ];
    }
}
