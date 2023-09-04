<?php

use App\Http\Controllers\CuentaController;
use App\Http\Controllers\PedidoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//cuentas
Route::post('/cuentaCreate',[CuentaController::class,'store']);
Route::get('/cuentas',[CuentaController::class,'index']);
Route::put('/cuentaUpdate/{id}',[CuentaController::class,'update']);
Route::delete('/cuentaDelete/{id}',[CuentaController::class,'destroy']);

//pedidos 
Route::post('/pedidoCreate',[PedidoController::class,'store']);
Route::get('/pedidos',[PedidoController::class,'index']);
Route::put('/pedidoUpdate/{id}',[PedidoController::class,'update']);
Route::delete('/pedidoDelete/{id}',[PedidoController::class,'destroy']);

