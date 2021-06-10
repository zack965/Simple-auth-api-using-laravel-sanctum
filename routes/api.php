<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AccountController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/*
Route::middleware('auth:sanctum')->get('/user', function () {
    Route::get('AllProducts',[ProductController::class , 'All_Products']);
});
*/
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::get('AllProducts',[ProductController::class , 'All_Products']);
    Route::post('LogOut',[AccountController::class , 'LogOut']);
});
//Route::get('AllProducts',[ProductController::class , 'All_Products']);
Route::get('GetProduct/{id}',[ProductController::class , 'GetProduct']);
Route::post('CreateProduct',[ProductController::class , 'CreateProduct']);
Route::put('ModifyProduct/{id_pro}',[ProductController::class , 'ModifyProduct']);
Route::delete('DeleteProduct/{id_pro}',[ProductController::class , 'DeleteProduct']);
Route::get('Search/{name_pro}',[ProductController::class , 'Search']);


Route::post('register',[AccountController::class,'register']);
Route::post('login',[AccountController::class,'login']);
/*
links
http://127.0.0.1:8000/api/AllProducts
http://127.0.0.1:8000/api/DeleteProduct/1
http://127.0.0.1:8000/api/Search/pc
http://127.0.0.1:8000/api/register
http://127.0.0.1:8000/api/LogOut
http://127.0.0.1:8000/api/login




*/
