<?php

namespace App\Http\Requests;

use App\Enums\Enums\CurpSexo as EnumsCurpSexo;
use App\Rules\CurpApellido1;
use App\Rules\CurpApellido2;
use App\Rules\CurpFecha;
use App\Rules\CurpNombres;
use App\Rules\CurpSexo;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CurpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'curp' => ['required','regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/'],
            'nombres' => ['required',new CurpNombres($this->curp)],
            'apellido1' => ['required',new CurpApellido1($this->curp)],
            'apellido2' => ['required',new CurpApellido2($this->curp)],
            'fechaNacimiento' => ['required',new CurpFecha($this->curp)],
            'sexo' => ['required',new CurpSexo($this->curp)],            
            'esMexicano' => ['required','in:true,false'],
        ];
    }

    public function messages(): array
    {
        return [
            'curp.required' => 'El CURP es obligatorio.',
            'curp.regex' => 'El CURP no es válido.',
            'nombres.required' => 'El nombre es obligatorio.',
            'apellido1.required' => 'El apellido 1 es obligatorio.',
            'apellido2.required' => 'El apellido 2 es obligatorio.',
            'fechaNacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'sexo.required' => 'El campo sexo es obligatorio.',
            'esMexicano.required' => 'Es mexicano es obligatorio.',
            'esMexicano.in' => 'Es mexicano no es válido.',
        ];
    }


    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            response()->json([
                'message' => "",
                'errors' => $errors
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
