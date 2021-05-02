<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class LogoutService
{
  protected UserRepository $userRepository;

  public function __construct(UserRepository $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  public function handle(User $user): void
  {
    $this->userRepository->deleteTokensByName($user);
  }
}
