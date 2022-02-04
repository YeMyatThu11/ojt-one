<?php

namespace App\Http\Controllers;

use App\Contracts\Services\UserServiceInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function profile(User $user)
    {
        return view('user.profile', compact('user'));
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
        ]);
        $this->userService->updateUserProfile($data, $user);
        return redirect()->route('user.profile', $user->id);
    }

    public function resetPWForm(User $user)
    {
        return view('user.resetpassword', compact('user'));
    }

    public function resetPW(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);
        $hash = Hash::make($request->password);
        $this->userService->resetPassword($hash, $user);
        return redirect()->route('user.profile', $user->id);
    }

    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);
        return back();

    }

    public function promote(User $user)
    {
        $this->userService->promoteUser($user);
        return back();
    }
}