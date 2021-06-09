<?php

use App\Http\Controllers\Api\ApiauthController;
use App\Http\Controllers\Api\ApiproductController;

use Facade\FlareClient\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Whoops\Run;

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

/*********************API*****************/
/***  Public Api ***/

Route::post('/register', [ApiauthController::class, 'register']);
Route::post('/login', [ApiauthController::class, 'login']);
Route::get('/products', [ApiproductController::class, 'index']);
Route::get('/products/{id}', [ApiproductController::class, 'show']);
Route::get('/products/search/{jenis}', [ApiproductController::class, 'search']);
/* End Public Api*/

/***  Protected routes dengan sanctum ***/

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/products', [ApiproductController::class, 'store']);
    Route::put('/products/{id}', [ApiproductController::class, 'update']);
    Route::delete('/products/{id}', [ApiproductController::class, 'destroy']);
    Route::post('/logout', [ApiauthController::class, 'logout']);
    Route::get('/getalluser', [ApiauthController::class, 'getalluser']);
    Route::get('/getalluser/{id}', [ApiauthController::class, 'getbyid']);
});

/* End Protected routes */





Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
