<?php

namespace App\Repository\ModelServices;

use App\Models\User;
use App\Repository\ModelContracts\AuthContract;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthContract
{
    public function createNewAccount($name,$email,$phone,$password): User
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'phone_number' => $phone,
            'password' => Hash::make($password),
        ]);
    }

    public function verifyEmail($userId): bool
    {
        return User::findOrFail($userId)->markEmailAsVerified();
    }

    public function emailVerification($userId)
    {
        return User::findOrFail($userId)->sendEmailVerificationNotification();
    }

    public function login($email,$password)
    {
        $user = User::query()->where('email','=',$email)->first();
        if (!$user){ return false;}
        if (!Hash::check($password,$user->password)){return false;}

        return $user;
    }

    public function logout(User $user): bool{
        return $user->tokens()->delete();
    }
}