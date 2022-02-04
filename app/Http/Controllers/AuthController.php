<?php

namespace App\Http\Controllers;

use App\Contracts\Services\UserServiceInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
    private $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth()->user()->role == 1) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('posts.index');
            }
        }
        return redirect()->route("auth.loginForm")->withErrors(['Credentials are not correct']);
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);
        $data = $request->all();
        $user = $this->userService->createUser($data);
        Auth::login($user);
        return redirect()->route("posts.index");
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('auth.loginForm');
    }
}