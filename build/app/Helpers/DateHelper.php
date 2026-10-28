<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;

class DateHelper
{
    public static function toDatabaseDate(?string $date = null): ?string
    {
        if (blank($date)) {
            return null;
        }
        
        return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
    }
}
