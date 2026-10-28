<?php

namespace App\Enums;

enum MembershipType: int
{
    case Active = 1;
    case SeparatedRol = 2;
    case Dismissed = 3;

    public function label(): string
    {
        return match ($this) {
            self::Active => 'Ativo',
            self::SeparatedRol => 'Rol separado',
            self::Dismissed => 'Demitido',
        };
    }
}
