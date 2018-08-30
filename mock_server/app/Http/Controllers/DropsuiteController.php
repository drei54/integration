<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class DropsuiteController extends Controller
{
    public function auth(Request $request)
    {
        if ($this->check($request->header('user'), $request->header('password'))){
            if ($request->wantsJson()){
                return ['token' => 'aad8ce79-10c7-4784-930b-67222e8f8449'];
            } else {
                return response()->json(['error' => 'Bad Request'], 400);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function addAccount(Request $request)
    {
        if ($request->header('token') === 'aad8ce79-10c7-4784-930b-67222e8f8449'){
            if ($request->wantsJson() && $request->isJson()){
                if ($this->validateAccount($request)){
                    return response()->json(['message' => 'Account created'], 201);
                } else {
                    return response()->json(['error' => 'Forbidden'], 403);
                }
            } else {
                return response()->json(['error' => 'Bad Request'], 400);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    private function check($user, $password)
    {
        return ($user === 'dropsuite') && ($password === 'DrOpsuiteR0cks!!') ? true : false;
    }

    private function validateAccount(Request $request)
    {
        return
            ($request->json('email') === 'master') &&
            ($request->json('password') === 'masterPassw0rd??') &&
            (in_array($request->json('shared_email'), $this->accounts())) &&
            ($request->json('type') === 'cpanel') &&
            ($request->json('domain') === 'demopersonal.com') ? true : false;
    }

    private function accounts()
    {
        return ['dropsuite1','gamabunta','gamakichi','gamatatsu','hinata','jiraiya','naruto','sakura','sasuke'];
    }
}
