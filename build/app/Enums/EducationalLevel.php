<?php

namespace App\Enums;

enum EducationalLevel: int
{
    case IncompleteElementary = 1;
    case CompleteElementary = 2;
    case IncompleteHighSchool = 3;
    case CompleteHighSchool = 4;
    case IncompleteUndergraduate = 5;
    case CompleteUndergraduate = 6;
    case Postgraduate = 7;
    case MastersDegree = 8;
    case Doctorate = 9;
    case Postdoctoral = 10;

    public function label(): string
    {
        return match ($this) {
            self::IncompleteElementary => 'Ensino Fundamental Incompleto',
            self::CompleteElementary => 'Ensino Fundamental Completo',
            self::IncompleteHighSchool => 'Ensino Médio Incompleto',
            self::CompleteHighSchool => 'Ensino Médio Completo',
            self::IncompleteUndergraduate => 'Graduação Incompleta',
            self::CompleteUndergraduate => 'Graduação Completa',
            self::Postgraduate => 'Pós-Graduação',
            self::MastersDegree => 'Mestrado',
            self::Doctorate => 'Doutorado',
            self::Postdoctoral => 'Pós-Doutorado',
        };
    }
}
