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
                'data' => TransactionResource::collection($transactions)
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

            if($sendingWalletBallance < request()->amount){
                return response()->json([
                    'message' => 'Ooops! You do not have enough money in your account. Kindly fund your account.'
                ]);

            }else{
                $receivingWalletId = Wallet::where('id', request()->receiver_id)->first();
                $receivingWalletBalance = $receivingWalletId->balance;
                $receivingWalletNewBalance = $receivingWalletId->increment('balance', request()->amount);
                //$receivingWalletNewBalance->update;
                $validateTransactionData['status'] = true;
                $transactions = Transaction::create($validateTransactionData);

                return response()->json([
                    'status_code' => 200,
                    'message' => 'Transfer successful!',
                    'data' => new TransactionResource($transactions)
                ]);
            }

        }catch(Throwable $e){
            return response()->json([
                'status_code' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getTransactionDetails($transaction)
    {
        try{
            $transactionDetail = Transaction::findOrFail($transaction);
            return response()->json([
                'status_code' => 200,
                'message' => 'Success!',
                'data' => new TransactionResource($transactionDetail)
            ]);
        }catch(Throwable $e){
            return response()->json([
                'status_code' => 404,
                'message' => 'The record does not exist.'
            ]);
        }
    }
}
