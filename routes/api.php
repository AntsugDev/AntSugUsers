<?php

use App\Http\Api\Google\Controller\AccessGoogleController;
use App\Http\Api\Pagination\Controller\PaginationController;
use App\Http\Api\Passport\Controller\RootController;
use App\Http\Api\Users\Controller\UserController;
use App\Http\Api\WhoAmI\Controller\WhoAmIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::prefix(config('utils.prefix'))->group(function (){

    Route::middleware('data_request')->group(function(){

        Route::get('root',[RootController::class,'index']);
        Route::post('login',[UserController::class,'login']);
//        Route::resource('google',AccessGoogleController::class)->only(['store']);
        Route::get('google',[AccessGoogleController::class,'store']);


        Route::middleware('auth:api')->group(function (){
            Route::get('who_am_i', [WhoAmIController::class, 'who_am_i']);
            Route::resource('pagination',PaginationController::class)->only(['index']);
        });
    });


});

