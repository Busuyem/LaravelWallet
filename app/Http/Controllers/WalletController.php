<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function allWallet()
    {
        return response()->json([
            'msg'=> 'all wallet'
        ]);
    }
}
