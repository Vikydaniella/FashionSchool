<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Helpers\HttpStatus;;

class AuthController extends Controller
{
    /** Authenticate a user by email and password.
    * @param  Request  $request
    *@return \Illuminate\Http\JsonResponse
    */

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error'
            ], HttpStatus::UNPROCESSABLE_ENTITY); 
        }

        $user = Auth::user();
        return response()->json([
                'message' => 'User login Successfully',
                'data' => [
                    'user' => $user,
                    'token' => $token,
                    'type' => 'bearer',
                    'expiration_time' => now()->addSeconds(200)->format('Y-m-d H:i:s'),
                ], HttpStatus::SUCCESS_CREATED]);


    }

    /**Register a new user. 
    * @param  AuthRequest  $request
    *@return \Illuminate\Http\JsonResponse
    */
    public function register(RegisterRequest $request){

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User Created Successfully',
            'user' => [
                'user' => $user,
            ], HttpStatus::SUCCESS_CREATED]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'status code' => '200',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'status code' => '200',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

}
