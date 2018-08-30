<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class CpanelController extends Controller
{
    public function listPops(Request $request)
    {
        if ($request->wantsJson()){
            return [
                'metadata' =>
                    [
                        'transformed' => 1,
                    ],
                'warnings' => NULL,
                'errors' => NULL,
                'messages' => NULL,
                'data' =>
                    [
                        0 =>
                            [
                                'email' => 'dropsuite1@demopersonal.com',
                                'suspended_incoming' => 0,
                                'login' => 'dropsuite1@demopersonal.com',
                                'suspended_login' => 0,
                            ],
                        1 =>
                            [
                                'suspended_login' => 0,
                                'login' => 'gamabunta@demopersonal.com',
                                'suspended_incoming' => 0,
                                'email' => 'gamabunta@demopersonal.com',
                            ],
                        2 =>
                            [
                                'suspended_login' => 0,
                                'login' => 'gamakichi@demopersonal.com',
                                'suspended_incoming' => 0,
                                'email' => 'gamakichi@demopersonal.com',
                            ],
                        3 =>
                            [
                                'email' => 'gamatatsu@demopersonal.com',
                                'suspended_incoming' => 0,
                                'login' => 'gamatatsu@demopersonal.com',
                                'suspended_login' => 0,
                            ],
                        4 =>
                            [
                                'login' => 'hinata@demopersonal.com',
                                'suspended_login' => 0,
                                'email' => 'hinata@demopersonal.com',
                                'suspended_incoming' => 0,
                            ],
                        5 =>
                            [
                                'email' => 'jiraiya@demopersonal.com',
                                'suspended_incoming' => 0,
                                'login' => 'jiraiya@demopersonal.com',
                                'suspended_login' => 0,
                            ],
                        6 =>
                            [
                                'suspended_incoming' => 0,
                                'email' => 'naruto@demopersonal.com',
                                'suspended_login' => 0,
                                'login' => 'naruto@demopersonal.com',
                            ],
                        7 =>
                            [
                                'suspended_login' => 0,
                                'login' => 'sakura@demopersonal.com',
                                'suspended_incoming' => 0,
                                'email' => 'sakura@demopersonal.com',
                            ],
                        8 =>
                            [
                                'email' => 'sasuke@demopersonal.com',
                                'suspended_incoming' => 0,
                                'login' => 'sasuke@demopersonal.com',
                                'suspended_login' => 0,
                            ]
                    ],
                'status' => 1,
            ];
        } else {
            return response()->json(['error' => 'Bad Request'], 400);
        }
    }

    public function addPop(Request $request)
    {
        if ($request->wantsJson()){
            if ($this->check(
                $request->query('email'),
                $request->query('password'),
                $request->query('domain')
            )) {
                return response()->json(['message' => 'Email created'], 201);
            } else {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } else {
            return response()->json(['error' => 'Bad Request'], 400);
        }
    }

    private function check($email, $password, $domain)
    {
        return
            ($email === 'master') &&
            ($password === 'masterPassw0rd??') &&
            ($domain === 'demopersonal.com') ? true : false;
    }
}
