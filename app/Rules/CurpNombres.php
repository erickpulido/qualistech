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
        $fixedValue = Str::of($value)->transliterate()
            ->trim()
            ->upper();
        $fixedName = preg_replace('/^(MARIA|MA|JOSE|J?\.?)\s/', '', $fixedValue);
        $name = Str::of($fixedName)->charAt(0);
        $curpName = Str::substr($this->curp, 3, 1);
        $firstInnerConsonant = Str::of(preg_replace('/[AEIOU]+/', '', $fixedName))->charAt(1);
        $curpFirstInnerConsonant = Str::substr($this->curp, 15, 1);

        if (($name !== $curpName) || ($firstInnerConsonant !== $curpFirstInnerConsonant)) {
            $fail('El nombre no corresponde con el del CURP ingresado.');
        }
    }
}
