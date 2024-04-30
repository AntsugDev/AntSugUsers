<?php

use App\Http\Api\Google\Controller\AccessGoogleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('auth/google', [AccessGoogleController::class, 'index']);  // redirect to google login
//Route::get('callback/google', [AccessGoogleController::class, 'store']);

Route::get('/', function () {
    return view('welcome');
})->where('any', '.*');
