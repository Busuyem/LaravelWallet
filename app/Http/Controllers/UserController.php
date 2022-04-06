<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function allUsers()
    {
        try{
            $allUsers = User::all();

            return response()->json([
                'status_code' => 200,
                'message' => 'Success!',
                'data' => $allUsers
            ]);

        }catch(Throwable $e){
            return response()->json([
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
                'data'=> 'create user'
            ]);
        }catch(Throwable $e){
            return response()->json([
                'status_code'=> 402,
                'message' => 'User cannot be created'
            ]);
        }
    }
}
