<?php

use App\Http\Controllers\api\v1\Curp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(Curp::class)->group(function (){
    Route::get('/curp-validate', 'validate');
});
