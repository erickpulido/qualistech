<?php

namespace App\Rules;

use App\Enums\Enums\CurpSexo as EnumsCurpSexo;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class CurpSexo implements ValidationRule
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
        $sexo = EnumsCurpSexo::tryFrom($value);
        $sexoCurp = Str::substr($this->curp, 10, 1);

        if(is_null($sexo))
        {
            dump("entra aqui");
            $fail("El género seleccionado no es válido.");
        }
        else
        {
            if($sexo->name !== $sexoCurp)
            {
                dump("entra aquisss");
                $fail("El género no corresponde con el del CURP ingresado.");
            }
        }        
    }
}
