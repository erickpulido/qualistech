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
        $fixedValue = Str::of($value)->transliterate()->upper();
        $initialLetter = $fixedValue->charAt(0);
        $lastname = $initialLetter;
        $curpLastname = Str::substr($this->curp, 2, 1);
        $firstInnerConsonant = Str::of(preg_replace('/[AEIOU]+/', '', $fixedValue->value()))->charAt(1);
        $curpFirstInnerConsonant = Str::substr($this->curp, 14, 1);

        if (($lastname !== $curpLastname) || ($firstInnerConsonant !== $curpFirstInnerConsonant)) {
            $fail('El apellido 2 no corresponde con el del CURP ingresado.');
        }
    }
}
