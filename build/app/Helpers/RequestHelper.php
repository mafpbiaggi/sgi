<?php

namespace App\Helpers;

class RequestHelper
{
    public static function sanitize(?array $data = null): ?array
    {
        $fields = [
            'membership_status',
            'membership_type',
            'is_under_discipline',
            'is_baptized',
            'has_professed_faith',
            'gender',
            'educational_level',
            'birth_month',
            'birth_date',
            'marital_status',
            'marriage_date',
            'baptism_date',
            'profession_of_faith_date',
            'admission_reason',
            'admission_date',
            'admission_date',
            'dismissal_reason',
            'dismissal_date',
            'dismissal_minute',
        ];

        $filtered = array_diff_key($data, array_flip($fields));

        foreach ($filtered as $key => $value) {
            if ($key === 'email') {
                $data[$key] = trim(mb_strtolower($value, 'UTF-8'));
                continue;
            }

            $data[$key] = trim(mb_strtoupper($value, 'UTF-8'));
        }

        return $data;
    }
}
