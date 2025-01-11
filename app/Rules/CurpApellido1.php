<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class CurpApellido1 implements ValidationRule
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
        $apellido1 = Str::substr($value, 0, 2);
        $apellido1Curp = Str::substr($this->curp, 0, 2);
        
        if($apellido1 !== $apellido1Curp)
        {
            $fail("El apellido 1 no corresponde con el del CURP ingresado.");
        }
    }
}
