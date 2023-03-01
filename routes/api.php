<?php

use App\Http\Controllers\V1\AlumnoAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1')->group(function(){
    //Todo lo que haya en este grupo se accedera escribiendo /api/v1/....lo que sea
    Route::post('login', [AuthController::class, 'authenticate']);
    
    //Registro de usuario
    Route::post('register', [AuthController::class, 'register']);

    Route::group(['middleware'=> ['jwt.verify']], function(){
        //Todo lo que haya en este grupo se refiere a autentication de usuario

        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('getUser', [AuthController::class, 'getUser']);
        Route::get('alumnos', [AlumnoAPIController::class, 'index']);
        Route::get('alumnos/{id}', [AlumnoAPIController::class, 'show']);
        Route::post('alumnos', [AlumnoAPIController::class, 'store']);
        Route::put('alumnos/{id}', [AlumnoAPIController::class, 'update']);
    });
});
