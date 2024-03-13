<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            /** @var User $user */
            $user = Auth::user();
            $token = $user->createToken(
                'auth',
                expiresAt: Carbon::now()->addMinutes(30)
            );
            $resource = new UserResource($user);
            return $resource->additional([
                'token' => $token->plainTextToken,
            ]);
        }
        abort(Response::HTTP_FORBIDDEN, 'Invalid credentials');
    }
}
