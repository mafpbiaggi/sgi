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

    public static function options(): array
    {
        return array_map(
            fn(self $case) => ['value' => $case->value, 'label' => $case->label()],
            self::cases(),
        );
    }
}
