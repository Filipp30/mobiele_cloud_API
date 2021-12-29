<?php

namespace App\Http\Controllers\Auth;
use App\Http\Requests\AuthCreateNewAccountRequest;
use App\Repository\ModelContracts\AuthContract;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class AuthController{

    public function createNewAccount(AuthCreateNewAccountRequest $request, AuthContract $authContract){
        $validatedRequest = $request->validated();
        $user = $authContract->createNewAccount(
            $validatedRequest['name'],
            $validatedRequest['email'],
            $validatedRequest['phone_number'],
            $validatedRequest['password'],
        );
        if ($user){event(new Registered($user));}

        return response([
            'createdUser' => $user
        ],200);
    }

   public function verifyEmail(Request $request, AuthContract $authContract){
        $emailIsVerified = $authContract->verifyEmail($request->id);

        return response([
            'emailIsVerified' => $emailIsVerified
        ],200);
   }

   public function emailVerification(Request $request, AuthContract $authContract){
        $authContract->emailVerification($request->id);

       return response([
           'message'=>'Verification email send.',
       ],201);
   }
}