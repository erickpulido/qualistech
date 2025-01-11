<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;
use App\Http\Requests\CurpRequest;

class Curp extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/curp-validate",
     *      tags={"CURP"},
     *      summary="Valida datos del CURP",
     *      description="Retorna errores en la captura o vacío en caso de éxito.",
     *      @OA\Parameter(
     *          name="curp",
     *          description="CURP",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="nombres",
     *          description="",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="apellido1",
     *          description="",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="apellido2",
     *          description="",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *          )
     *      ),
     *       @OA\Parameter(
     *          name="fechaNacimiento",
     *          description="",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *              format="date-time",
     *              example = "2017-07-21T17:32:28Z"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="sexo",
     *          description="",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *              enum={"Masculino","Femenino"}
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="esMexicano",
     *          description="",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="boolean"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="OK"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     */
    public function validate(CurpRequest $curpRequest){
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
