<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $input = $request->all();
        $url = app()->make('url')->to('/api/login');
        $options = [
            'form_params' => [
                'email'    => $input['email'],
                'password' => $input['password'],
            ],
        ];
        $result = fetchApiResult($url, 'POST', $options);
        if ($token = array_get($result, 'token')){
            $user = array_get($result, 'user');
            session(['api_token' => $token]);
            Auth::loginUsingId($user['id']);
            flash('Welcome Aboard!');
            return redirect()->back();
        }
        flash('Incorrect Username or password')->error();
        return redirect()->back();
    }
}
