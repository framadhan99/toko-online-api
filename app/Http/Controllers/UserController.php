<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserLoginResource;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request) : UserResource
    {
        $data = $request->validated();

        if(User::where('email', $data['email'])->count()==1)
        {
            throw new HttpResponseException(response([
                "errors" => [
                    "email" =>[
                        "email already"
                    ]
                ]
           ], 400));
        }

        $user = new User($data);
        $user->password = Hash::make($data['password']);
        $user->save();

        return new UserResource($user);
    }


    public function login(UserLoginRequest $request) : UserLoginResource
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();
        if(!$user || !Hash::check($data['password'], $user->password)){
            throw new HttpResponseException(response([
                "errors"=>[
                    "message"=>[
                        "email or password wrong"
                    ]
                ]
            ], 401));
        }

        $user->token = Str::uuid()->toString();
        $user->save();

        return new UserLoginResource($user);
    }

    public function logout(Request $request) : JsonResponse
    {
        $user = Auth::user();
        $user->token = null;
        $user->save();

        return response()->json([
            'message'=>'berhasil logout'
        ])->setStatusCode(200);
    }
}