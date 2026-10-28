<?php

namespace App\Enums;

enum MemberEnum: string
{
    case Referral = '1';
    case Invitation = '2';
    case LivesNearBy = '3';
    case SocialMedia = '4';
    case Other = '5';

    public function label(): string
    {
        return match ($this) {
            self::Referral => 'Indicação',
            self::Invitation => 'Convite',
            self::LivesNearBy => 'Moro perto',
            self::SocialMedia => 'Redes sociais',
            self::Other => 'Outro',
        };
    }
}
