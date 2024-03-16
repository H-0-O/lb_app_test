<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Redis;

class UserService
{

    public function createNewUser(string $email, string $password, string $name)
    {
        User::create([
            'email' => $email,
            'password' => $password,
            'name' => $name
        ]);
    }


    public function updateUserInfo($userID, string $name)
    {
        $user = User::find($userID);
        $user->name = $name;
        $user->save();
    }

    public function getUser($userID){
        $user = $this->getFromCash($userID);
        if(!$user){
           $user = $this->getUserFromDB($userID);
           $this->setUserToCash($user);
        }

        return $user;
    }


    private function getFromCash($userID){
        return [
            'id' => $userID,
            'email' => Redis::get("user:$userID:email"),
            'name' => Redis::get("user:$userID:name")
        ];

    }

    private function getUserFromDB($userID){
        return User::find($userID);
    }

    private function setUserToCash(User $user){
        Redis::set("user:{$user->id}:email" , $user->email);
        Redis::set("user:{$user->id}:name" , $user->name);
    }
}
