<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function store(User $user, UserRequest $userRequest){

        $user = User::create([
            'name'=>$userRequest->name,
            'login'=>$userRequest->login,
            'email'=>$userRequest->email,
            'role_id'=>$userRequest->role_id = 1,
            'password'=>hash::make($userRequest->password),
        ]);

        return $user;
    }

    public function login(User $user, UserRequest $userRequest){

        if(!auth()->attempt(request(['login', 'password']))){
            return response()->json(['message'=>'authorization error']);
        }

        Auth::user()->api_token = Hash::make(Str::random(40));
        Auth::user()->save();

        return  response()->json(['message'=>Auth::user()->api_token]);
    }

    public function logout()
    {
        Auth::user()->logout();

        return response()->json([
            'message'=>'Success logout',
        ]);
    }

}
