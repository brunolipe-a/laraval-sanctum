<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Services\LoginService;

class SessionController extends Controller
{
  protected LoginService $loginService;

  public function __construct(LoginService $loginService)
  {
    $this->loginService = $loginService;
  }

  public function login(LoginRequest $request)
  {
    $user = $this->loginService->handle($request->only(['email', 'password']));

    return [
      'token' => $user->createToken($request->device_name)->plainTextToken,
    ];
  }

  public function logout()
  {
    //
  }
}
