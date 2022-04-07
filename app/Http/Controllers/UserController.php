<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\WalletResource;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function allUsers()
    {
        try{
            $allUsers = User::with('wallets')->get();

            return response()->json([
                'status_code' => 200,
                'message' => 'Success!',
                'data' => UserResource::collection($allUsers)
            ]);

        }catch(Throwable $e){
            return response()->json([
                'status_code' =>422,
                'message'=> $e->getMessage()
            ]);
        }
    }

    public function createUser(UserRequest $request)
    {
        $validateUserData = $request->validated();

        $validateUserData['password'] = Hash::make($request->password);

        try{
            $createUserData = User::create($validateUserData);
            return response()->json([
                'status_code' => 201,
                'message' => 'Success!',
                'data'=> new UserResource($createUserData)
            ]);
        }catch(Throwable $e){
            return response()->json([
                'status_code'=> 422,
                'message' => 'User cannot be created'
            ]);
        }
    }

    public function getUserDetails($user)
    {
        try{
            $findUserDetails = User::findOrFail($user);
            return response()->json([
                'status'=>200,
                'message'=> 'Success!',
                'data' => new UserResource($findUserDetails),
                'wallet'=> WalletResource::collection($findUserDetails->wallets),
                // 'transactions' => []
            ]);

        }catch(Throwable $e){
            return response()->json([
                'status_code' => 404,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function dataCount()
    {
        $totalUsers = count(User::all());
        $totalWallets = count(Wallet::all());
        $totalTransactions = count(Transaction::all());
        $totalMinimumBalance = array_sum(Wallet::all()->pluck('minimum_balance')->toArray());
        $totalBalance = array_sum(Wallet::all()->pluck('balance')->toArray());
        $totalWalletBalance = $totalMinimumBalance + $totalBalance;

        return response()->json([
            'status_code'=> 200,
            'message' => 'Success!',
            'totalUsers' => $totalUsers,
            'totalWallets' => $totalWallets,
            'totalTransactions' => $totalTransactions,
            'totalWalletsBalance' => $totalWalletBalance
        ]);
    }
}
