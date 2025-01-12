<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class CurpApellido1 implements ValidationRule
{
    public $curp;

    protected $vowels = 'AEIOU';

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
        $firstInnerVowel = $fixedValue->charAt(strcspn($fixedValue->value(), $this->vowels));
        $lastname = $initialLetter.$firstInnerVowel;
        $curpLastname = Str::substr($this->curp, 0, 2);
        $firstInnerConsonant = Str::of(preg_replace('/[AEIOU]+/', '', $fixedValue->value()))->charAt(1);
        $curpFirstInnerConsonant = Str::substr($this->curp, 13, 1);

        if (($lastname !== $curpLastname) || ($firstInnerConsonant !== $curpFirstInnerConsonant)) {
            $fail('El apellido 1 no corresponde con el del CURP ingresado.');
        }
    }
}
