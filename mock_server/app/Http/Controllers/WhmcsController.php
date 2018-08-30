<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class WhmcsController extends Controller
{
    public function auth(Request $request)
    {
        if ($this->check($request->header('user'), $request->header('password'))){
            if ($request->wantsJson()){
                return ['session' => '14532371-661c-4375-8db7-09d36b1e79c3'];
            } else {
                return response()->json(['error' => 'Bad Request'], 400);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function acceptOrder(Request $request)
    {
        if ($request->header('session') === '14532371-661c-4375-8db7-09d36b1e79c3'){
            if ($request->wantsJson()){
                if ($this->validateOrder($request)){
                    return response()->json(['message' => 'Order accepted'], 201);
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

    private function validateOrder(Request $request)
    {
        return ($request->get('orderid') === '123123123') ? true : false;
    }
}
