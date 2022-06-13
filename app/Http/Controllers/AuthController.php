<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class AuthController extends Controller {

    use ApiResponse;

    public function getCurrentUser(Request $req)
    {
        return $this->sendResponse(auth()->user(), 'OK', 200);
    }

    public function getAnotherUser($id, Request $req)
    {
        $user = User::find($id);
        if(!$user)
            return $this->sendError('Not found', 404);
        return $this->sendResponse($user, 'OK', 200);
    }

    public function register(Request $req)
    {
        $validFields = $req->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);

        if(User::where('email', '=', $validFields['email'])->first())
            return $this->sendError('Conflict', 409, ['User with such email already exists']);

        $user = User::create($validFields);

        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            "user" => $user,
            "token" => $token,
        ];
        return $this->sendResponse($response, 'Created', 201);
    }

    public function login(Request $req) {
        $fields = $req->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', '=', $fields['email'])->first();
        if(!$user or !Hash::check($fields['password'], $user->password))
            return $this->sendError('Bad credentials', 400);
        $token = $user->createToken($user->email)->plainTextToken;
        $response = [
            "user" => $user,
            "token" => $token,
        ];
        return $this->sendResponse($response, 'OK', 200);
    }

    public function logout(Request $req) {
        auth()->user()->tokens()->delete();
        return $this->sendEmptyResponse('OK', 200);
    }

    public function edit(Request $req) {
        $user = auth()->user();
        if($user->name != $req->input('name') and $req->input('name') != null)
            $user->name = $req->input('name');
        if($user->email != $req->input('email') and $req->input('email') != null)
            $user->email = $req->input('email');
        if(!Hash::check($req->input('password'), $user->password) and $req->input('password') != null)
            $user->password = Hash::make($req->input('password'));
        $user->save();
        return $this->sendResponse($user, 'OK', 200);
    }

}
