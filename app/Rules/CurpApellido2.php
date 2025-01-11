<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class CurpApellido2 implements ValidationRule
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
        $apellido2 = Str::substr($value, 0, 1);
        $apellido2Curp = Str::substr($this->curp, 2, 1);
        
        if($apellido2 !== $apellido2Curp)
        {
            $fail("El apellido 2 no corresponde con el del CURP ingresado.");
        }
    }
}
