<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function verify($token){
        $user = User::where('remember_token', base64_decode($token))->first();
//        dd($user);die;
        $user->email_verified_at = Carbon::now();
        $user->save();

        return redirect()->action([StoreController::class, 'index']);
    }
}
