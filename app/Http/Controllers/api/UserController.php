<?php

namespace App\Http\Controllers\api;

use App\Contracts\Services\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($request->get('s')) {
            return $this->searchUsers($request->get('s'));
        }
        $users = $this->userService->getAllUsers();
        return UserResource::collection($users);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $data = $request->json()->all();
        $rules = [
            'name' => 'required|string',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            $result = $this->userService->updateUserProfile($data, $user);
            return response()->json(['messsage' => 'user updated successfully', 'data' => $result], 200);
        } else {
            return response()->json([
                'messages' => 'fail to update user',
                'errors' => $validator->errors(),
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);
        return response()->json(['messages' => 'user deleted successfully'], 200);
    }
}