<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;


class LoginService
{

    /**
     * @throws Exception
     */
    public function login(string $email, string $password): string
    {
        $user = User::where('email', $email)->first();
        $passCheck = Hash::check($password, (string) $user->password);
        if (!$user || !$passCheck) {
            throw new Exception("The email or password is incorrect");
        }

        $token = $user->createToken($email);
        return $token->plainTextToken;
    }
}
