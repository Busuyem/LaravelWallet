<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use Throwable;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Requests\WalletRequest;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\WalletResource;

class WalletController extends Controller
{
    public function allWallet()
    {
        try{
            $allWallets = Wallet::with('transactions')->get();
            return response()->json([
                'status_code' => 200,
                'message'=> 'Success',
                'data' => WalletResource::collection($allWallets)
            ]);
        }catch(Throwable $e){
            return response()->json([
                'status_code' => 422,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function createWallet(WalletRequest $request)
    {
        $validateWalletData = $request->validated();

        try{
            $createWalletData = Wallet::create($validateWalletData);
            return response()->json([
                'status_code' => 201,
                'message' => 'Wallet created successfully',
                'data' => new WalletResource($createWalletData)
            ]);

        }catch(Throwable $e){
            return response()->json([
                'status_code' => 422,
                'message'=> $e->getMessage()
            ]);
        }
    }

    public function getWalletDetails($wallet)
    {
        try{
            $walletDetails = Wallet::findOrFail($wallet);
            return response()->json([
                'status_code' => 200,
                'message' => 'Success!',
                'owner' => $walletDetails->user->first_name,
                'data' => new WalletResource($walletDetails),
                'transactions' => TransactionResource::collection($walletDetails->transactions)
            ]);

        }catch(Throwable $e){
            return response()->json([
                'message'=>404,
                'message' => $e->getMessage()
            ]);
        }
    }

}
