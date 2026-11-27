<?php

namespace App\Models;

use App\Enums\AdmissionReason;
use App\Enums\DismissalReason;
use App\Enums\MembershipStatus;
use App\Enums\MembershipType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'membership_type',
    'membership_status',
    'admission_order',
    'admission_date',
    'admission_reason',
    'admission_minute',
    'dismissal_date',
    'dismissal_reason',
    'dismissal_minute',
])]

class MemberAdmission extends Model
{
    protected $appends = [
        'membership_status_label',
        'membership_type_label',
        'admission_reason_label',
        'dismissal_reason_label',
        'user_name',
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        $dateFormat = "date:d/m/Y";
        
        return [
            'membership_status' => MembershipStatus::class,
            'membership_type' => MembershipType::class,
            'admission_date' => $dateFormat,
            'admission_minute' => 'integer',
            'admission_reason' => AdmissionReason::class,
            'dismissal_date' => $dateFormat,
            'dismissal_minute' => 'integer',
            'dismissal_reason' => DismissalReason::class,
            'created_at' => $dateFormat,
        ];
    }

    protected function membershipStatusLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->membership_status?->label(),
        );
    }

    protected function membershipTypeLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->membership_type?->label(),
        );
    }

    protected function admissionReasonLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->admission_reason?->label(),
        );
    }

    protected function dismissalReasonLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->dismissal_reason?->label(),
        );
    }

    protected function getUserNameAttribute(): ?string
    {
        return $this->user?->name;
    }
}
