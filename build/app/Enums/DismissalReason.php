<?php

namespace App\Enums;

enum DismissalReason: int
{
    case Transfer = 1;
    case Death = 2;
    case Exclusion = 3;
    case Ordination = 4;

    public function label(): string
    {
        return match ($this) {
            self::Transfer => 'Tranferência',
            self::Death => 'Falecimento',
            self::Exclusion => 'Exclusão',
            self::Ordination => 'Ordenação',
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
