<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use \App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User\UserResource;
use App\Exceptions\InvalidAuthenticationException;

class LoginController extends Controller
{
    //
    public function __invoke(LoginRequest $request) {
        $input = $request->validated();

        if (!Auth::attempt($input)) {
            throw new InvalidAuthenticationException('Authentication error');
        }

        $request->session()->regenerate();

        return new UserResource(auth()->user());
    }
}
