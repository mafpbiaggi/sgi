<?php

namespace App\Enums;

enum MaritalStatus: int
{
    case Single = 1;
    case Married = 2;
    case Separated = 3;
    case Widowed = 4;
    case Divorced = 5;
    case DomesticPartnership = 6;

    public function label(): string
    {
        return match ($this) {
            self::Single => 'Solteiro(a)',
            self::Married => 'Casado(a)',
            self::Separated => 'Separado(a)',
            self::Widowed => 'Viúvo(a)',
            self::Divorced => 'Divorciado(a)',
            self::DomesticPartnership => 'União Estável',
        };
    }
}
