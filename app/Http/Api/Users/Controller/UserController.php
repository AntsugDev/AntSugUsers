<?php

namespace App\Http\Api\Users\Controller;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class UserController extends Controller
{

    public function login(Request $request): JsonResponse
    {

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('Laravel Password Grant Client',['*'],Carbon::now()->addHours(1));
            return response()->json($token);
        }else
            throw new UnauthorizedException();
    }

}
