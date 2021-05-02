<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use App\Services\LogoutService;

class SessionController extends Controller
{
  protected LoginService $loginService;
  protected LogoutService $logoutService;

  public function __construct(
    LoginService $loginService,
    LogoutService $logoutService
  ) {
    $this->loginService = $loginService;
    $this->logoutService = $logoutService;
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
    $user = request()->user();

    $this->logoutService->handle($user);

    return response()->noContent();
  }
}
