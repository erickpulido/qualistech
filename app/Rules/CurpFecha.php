<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class CurpFecha implements ValidationRule
{
    public $curp;

    public function __construct($curp)
    {
        $this->curp = $curp;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $fecha = Carbon::parse($value)->setTimezone('UTC')->format('ymd');
        $fechaCurp = Str::substr($this->curp, 4, 6);

        if ($fecha !== $fechaCurp) {
            $fail('La fecha de nacimiento no corresponde con el del CURP ingresado.');
        }
    }
}
