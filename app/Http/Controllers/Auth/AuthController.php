<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\AuthCreateNewAccountRequest;
use App\Repository\ModelContracts\AuthContract;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Response;

class AuthController{

    public function createNewAccount(AuthCreateNewAccountRequest $request, AuthContract $authContract): Response|Application|ResponseFactory
    {
        $validatedRequest = $request->validated();
        $user = $authContract->createNewAccount(
            $validatedRequest['name'],
            $validatedRequest['email'],
            $validatedRequest['phone_number'],
            $validatedRequest['password'],
        );
        if (!$user){
            return response(['message'=>'No access'],403);
        }
        event(new Registered($user));

        return response([
            'message' => 'Account created.Please confirm email before login.'
        ],200);
    }

   public function verifyEmail(Request $request, AuthContract $authContract): Response|Application|ResponseFactory
   {
        $emailIsVerified = $authContract->verifyEmail($request->id);

        return response(['emailIsVerified' => $emailIsVerified],200);
   }

   public function emailVerification(Request $request, AuthContract $authContract): Response|Application|ResponseFactory
   {
       $authContract->emailVerification($request->id);

       return response(['message'=>'Verification email send.'],200);
   }

   public function login(Request $request,AuthContract $authContract){
        $user = $authContract->login($request['email'],$request['password']);
       if (!$user){
           return response(['message'=>'email or password does not matches'],403);
       }
        $token = $user->createToken('jwt')->plainTextToken;
       return response(['jwt'=>$token],200);
   }

   public function logout(Request $request,AuthContract $authContract){
        $user = $request->user();
        $logout = $authContract->logout($user);

        return response(['logout' => $logout],200);
   }
}