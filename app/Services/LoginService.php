<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginService
{
  protected UserRepository $userRepository;

  public function __construct(UserRepository $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  public function handle(array $session): User
  {
    $user = $this->userRepository->firstByEmail($session['email']);

    if (Auth::attempt($session)) {
      return $user;
    }

    throw ValidationException::withMessages([
      'email' => [__('auth.failed')],
    ]);
  }
}
