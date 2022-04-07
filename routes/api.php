<?php

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TransactionController;

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
    Route::get('/counts', [UserController::class, 'dataCount']);
    Route::get('/{user}', [UserController::class, 'getUserDetails']);
});

Route::prefix('wallets')->group(function(){
    Route::get('/', [WalletController::class, 'allWallet']);
    Route::post('/', [WalletController::class, 'createWallet']);
    Route::get('/{wallet}', [WalletController::class, 'getWalletDetails']);
});

Route::prefix('transactions')->group(function(){
    Route::get('/', [TransactionController::class, 'allTransactions']);
    Route::post('/', [TransactionController::class, 'makeTransaction']);
    Route::get('/{transaction}', [TransactionController::class, 'getTransactionDetails']);
});

Route::prefix('import')->group(function(){
    //Route::get('/', [TransactionController::class, 'allTransactions']);
    Route::post('/', [ImportController::class, 'importData']);
});
