<?php

namespace App\Http\Controllers;

use App\Contracts\Services\UserServiceInterface;
use App\Mail\ResetPasswordMail;
use App\Mail\VerifyEmail;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Mail;
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
        if (Auth::check()) {
            return $this->rediectBasedOnRole();
        }
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
            return $this->rediectBasedOnRole();
        }
        return redirect()->route("auth.loginForm")->withErrors(['Credentials are not correct']);
    }

    public function registerForm()
    {
        if (Auth::check()) {
            return $this->rediectBasedOnRole();
        }
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
        $token = Str::random(64);
        DB::table('verify_users')->insert([
            'user_id' => $user->id,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);
        Mail::to($user->email)->send(new VerifyEmail($token, $user));
        return redirect()->route("auth.wait-verification");
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);
        Mail::to($request->email)->send(new ResetPasswordMail($token));
        return back()->with('status', 'We have e-mailed your password reset link!');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        $data = [
            'email' => $request->email,
            'token' => $request->token,
        ];
        $updatePassword = $this->selectFromTable('password_resets', $data);
        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }
        $this->userService->updateUserPassword($request->email, $request->password);
        $this->deleteColFromTable('password_resets', $data);
        return redirect()->route('auth.login')->with('status', 'Your password has been changed!');
    }

    public function verifyMail($token, $userId)
    {
        $data = [
            'user_id' => $userId,
            'token' => $token,
        ];
        $verification = $this->selectFromTable('verify_users', $data);
        if (!$verification) {
            dd('aa');
            return redirect()->route("auth.wait-verification");
        }
        $this->userService->userVerified($userId);
        $this->deleteColFromTable('verify_users', $data);
        return redirect()->route('posts.index');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('auth.loginForm');
    }

    public function waitVerificationForm()
    {
        if (Auth()->user() ? (Auth()->user()->verified == 1) : false) {
            return redirect()->route('posts.index');
        }
        return view('auth.waitVerification');

    }

    public function forgotPasswordForm()
    {
        return view('auth.passwords.email');
    }

    public function resetPasswordForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    private function rediectBasedOnRole()
    {
        if (Auth()->user()->role == 1) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('posts.index');
        }
    }

    private function selectFromTable($tableName, $data)
    {
        return DB::table($tableName)->where($data)->first();
    }

    private function deleteColFromTable($tableName, $data)
    {
        return DB::table($tableName)->where($data)->delete();
    }

}