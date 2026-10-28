<?php

namespace App\Enums;

enum MembershipStatus: int
{
    case Communicant = 1;
    case NonCommunicant = 2;

    public function label(): string
    {
        return match ($this) {
            self::Communicant => 'Comungante',
            self::NonCommunicant => 'Não comungante',
        };
    }
}
