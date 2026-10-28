<?php

namespace App\Enums;

enum AdmissionReason: int
{
    case Baptism = 1;
    case ProfessionOfFaith = 2;
    case BaptismAndProfessionOfFaith = 3;
    case Transfer = 4;
    case TransferWithGuardians = 5;
    case Restoration = 6;
    case ExOfficioJurisdiction = 7;
    case JurisdictionUponRequest = 8;
    case JurisdictionOverGuardians = 9;
    case PresbyteryAssignment = 10;

    public function label(): string
    {
        return match ($this) {
            self::Baptism => 'Batismo',
            self::ProfessionOfFaith => 'Profissão de Fé',
            self::BaptismAndProfessionOfFaith => 'Batismo e Profissão de Fé',
            self::Transfer => 'Transferência',
            self::TransferWithGuardians => 'Transferência de Responsáveis',
            self::Restoration => 'Restauração',
            self::ExOfficioJurisdiction => 'Jurisdição Ex-ofício',
            self::JurisdictionUponRequest => 'Jurisdição a Pedido',
            self::JurisdictionOverGuardians => 'Jurisdição sobre os Responsáveis',
            self::PresbyteryAssignment => 'Designiação do Presbitério',
        };
    }
}
