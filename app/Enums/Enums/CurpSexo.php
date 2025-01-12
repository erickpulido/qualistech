<?php

namespace App\Enums\Enums;

enum CurpSexo: string
{
    case H = 'Masculino';
    case M = 'Femenino';

    public function label(): string
    {
        return match ($this) {
            CurpSexo::H => 'Masculino',
            CurpSexo::M => 'Femenino',
        };
    }
}
