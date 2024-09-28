<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function my_register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "name" => "required",
            'email' => "required|email|unique:users,email",
            "password" => "required|confirmed",
        ]);
        if ($validation->fails()) {
            $data = [
                'data' => null,
                "errors" => $validation->errors(),
            ];
            return $this->apiResponse($data, "errors validation", 425);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $credentials = [
            'email' => $user->email,
            'password' => $user->password,
        ];
        $token = JWTAuth::attempt($credentials);
        if($token){
            $data = [
                'user' => new UserResource(Auth::user()),
                'token' => $token,
            ];
            return $this->apiResponse($data, "reqistration successful");
        }else{
            return $this->apiResponse(null, "Faild",404);
        }
    }

    public function my_login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => "required|email",
            "password" => "required",
        ]);
        if ($validation->fails()) {
            $data = [
                'data' => null,
                "errors" => $validation->errors(),
            ];
            return $this->apiResponse($data, "errors validation", 425);
        }
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if ($token = JWTAuth::attempt($credentials)) {
            $data = [
                'user' => new UserResource(Auth::user()),
                'token' => $token,
            ];
            return $this->apiResponse($data, "login successful", 200);
        }

        throw ValidationException::withMessages([
            'email' => ['credentials false'],
        ]);
    }


    function my_logout()
    {
        Auth::logout();
        return redirect('/show-my-login');
    }
}
