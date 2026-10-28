<?php

namespace App\Enums;

enum Boolean: int
{
    case False = 0;
    case True = 1;

    public function label(): string
    {
        return match ($this) {
            self::False => 'Não',
            self::True => 'Sim',
        };
    }
}
