<?php

namespace App\Models;

use App\Enums\ReferralSource;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'age',
    'phone',
    'email',
    'visit_date',
    'attends_church',
    'prayer_request',
    'referral_source',
    'referral_source_social_media',
    'referral_source_other',
])]

class Visitor extends Model
{
    protected $appends = ['referral_source_label'];
    
    protected function casts(): array
    {
        return [
            'visit_date' => 'date:d/m/Y',
            'age' => 'integer',
            'referral_source' => ReferralSource::class,
        ];
    }

    protected function referralSourceLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->referral_source?->label(),
        );
    }
}
