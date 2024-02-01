<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'employee'], function() {
    Route::get('/',[EmployeeController::class,'index']);
    Route::post('/',[EmployeeController::class,'store']);
    Route::get('/{id}',[EmployeeController::class,'show']);
    Route::put('/{id}',[EmployeeController::class,'update']);
    Route::delete('/{id}',[EmployeeController::class,'destroy']);

});