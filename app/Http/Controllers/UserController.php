<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
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
}