<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class CurpNombres implements ValidationRule
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
        $nombres = Str::substr($value, 0, 1);
        $nombresCurp = Str::substr($this->curp, 3, 1);
        
        if($nombres !== $nombresCurp)
        {
            $fail("El nombre no corresponde con el del CURP ingresado.");
        }
    }
}
