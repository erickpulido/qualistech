<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[
    OA\Info(version: '1.0.0', description: 'petshop api', title: 'Qualistech-api Documentation'),
    OA\Server(url: 'http://qualistech.local', description: 'local server'),
]
abstract class Controller
{
    //
}
