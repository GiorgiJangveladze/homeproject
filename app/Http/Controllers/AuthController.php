<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function logIn(LoginRequest $request)
    {
        if (! Auth::attempt($request->validated(), $request->input('remember'))) {
            return response(
                [
                    'success' => false,
                    'message' => 'auth failed'
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        $user = Auth::user();

        $user->tokens()->delete();

        return response([
            'user' => $user,
            'access_token' => $user->createToken('api-token')->plainTextToken,
        ], 200);
    }

    /**
     * User log out.
     *
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function logOut(Request $request)
    {
        Auth::user()->currentAccessToken()->delete();
        return response([
            'message' => 'log out success',
        ], 200);
    }
}
