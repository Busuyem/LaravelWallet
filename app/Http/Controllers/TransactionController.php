<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;

class TransactionController extends Controller
{
    public function allTransactions()
    {
        try{
            $transactions = Transaction::all();
            return response()->json([
                'status_code' => 200,
                'message' => 'Success',
                'data' => new TransactionResource($transactions)
            ]);
        }catch(Throwable $e){
            return response()->json([
                'status_code' => 422,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function makeTransaction(TransactionRequest $request)
    {
        $validateTransactionData = $request->validated();

        try{
            $sendingWalletId = Wallet::where('id', request()->wallet_id)->first();
            $sendingWalletBallance = $sendingWalletId->balance;
            $sendingMinimumBalance = $sendingWalletId->minimum_blance;

            if($sendingWalletBallance <= $sendingMinimumBalance){
                return response()->json([
                    'message' => 'Ooops! You do not have enough money in your account. Kindly fund your account.'
                ]);

            }else{
                $receivingWalletId = Wallet::where('id', request()->receiver_id)->first();
                $receivingWalletBalance = $receivingWalletId->balance;
                $receivingWalletNewBalance = $receivingWalletId->increment('balance', request()->amount);
                //$receivingWalletNewBalance->update;
                $transactions = Transaction::create($validateTransactionData);

                return response()->json([
                    'status_code' => 200,
                    'message' => 'Transfer successful!',

                ]);
            }

        }catch(Throwable $e){
            return response()->json([
                'status_code' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
}
