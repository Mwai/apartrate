<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public $loginAfterSignUp = true;

    public function register(RegistrationRequest $request)
    {
        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        

        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }
}
