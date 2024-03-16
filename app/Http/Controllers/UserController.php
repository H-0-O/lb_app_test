<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get(Request $request , UserService $userService){
        $user = $userService->getUser($request->user()->id);

        return response()->json([
            'status' => true,
            'data' => [
                'user' => $user
            ]
        ]);
    }

    public function update(Request $request , UserService $userService){
        $inputs = $request->validate([
            'name' => 'required|string'
        ]);

        if($this->authorize('update' , $request->user()) ){
            $userService->updateUserInfo($request->user()->id , $inputs['name']);
            return response()->json([
                'status' => true
            ]);
        };

        return response()->json([
           'status' => false
        ]);
    }
}
