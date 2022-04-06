<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Models\Wallet;
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

Route::prefix('users')->group(function(){
    Route::get('/', [UserController::class, 'allUsers']);
    Route::post('/', [UserController::class, 'createUser']);
    Route::get('/{user}', [UserController::class, 'getUserDetails']);

});

Route::prefix('wallets')->group(function(){
    Route::get('/', [WalletController::class, 'allWallet']);
    Route::post('/', [WalletController::class, 'createWallet']);
});
