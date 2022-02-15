<?php

namespace App\Http\Controllers\api;

use App\Contracts\Services\UserServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    private $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'messages' => 'validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }
        $data = $request->all();
        $user = $this->userService->createUser($data);
        Auth::login($user);
        $accessToken = $user->createToken('authToken')->accessToken;
        return response(['user' => $user, 'token' => $accessToken]);
    }
}