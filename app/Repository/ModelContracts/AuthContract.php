<?php

namespace App\Repository\ModelContracts;

use App\Models\User;

interface AuthContract{

    public function createNewAccount(String $name,String $email,String $phone,String $password): User;

    public function verifyEmail(int $userId): bool;

    public function emailVerification(int $userId);

    public function login(String $email,String $password);

    public function logout(User $user): bool;

}