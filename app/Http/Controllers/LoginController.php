<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\LoginService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function register(RegisterRequest $request, UserService $userService)
    {
        $inputs = $request->validated();
        try {
            $userService->createNewUser($inputs['email'] , $inputs['password'] , $inputs['name']);
            return response()->json([
                'status' => true
            ]);
        }catch (Exception $exception){
            return response()->json([
                'status' => false,
                'errors' => [
                    $exception->getMessage()
                ]
            ]);
        }
    }


    function login(LoginRequest $request , LoginService $loginService){
        $inputs = $request->validated();
        try {
            $token = $loginService->login($inputs['email'] , $inputs['password']);
            return response()->json([
                'status' => true,
                'data' => [
                    'token' => $token
                ]
            ]);
        } catch (Exception $exception){
           return response()->json([
              'status' => false,
              'errors' => [
                  $exception->getMessage()
              ]
           ]);
        }

    }
}
