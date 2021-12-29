<?php

namespace App\Repository\ModelContracts;

use App\Models\User;

interface AuthContract{

    public function createNewAccount($name,$email,$phone,$password): User;

    public function verifyEmail($userId): bool;

    public function emailVerification($userId);

}