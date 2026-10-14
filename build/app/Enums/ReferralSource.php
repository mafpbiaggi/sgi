<?php

namespace App\Enums;

enum ReferralSource: string
{
    case referral = '1';
    case invitation = '2';
    case livesNearBy = '3';
    case socialMedia = '4';
    case other = '5';

    public function label(): string
    {
        return match ($this) {
            self::referral => 'Indicação',
            self::invitation => 'Convite',
            self::livesNearBy => 'Moro perto',
            self::socialMedia => 'Redes sociais',
            self::other => 'Outro',
        };
    }
}
