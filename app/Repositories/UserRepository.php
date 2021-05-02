<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
  /**
   * @return string
   *  Return the model
   */
  public function model()
  {
    return User::class;
  }

  public function firstByEmail(string $email)
  {
    return $this->model->where('email', $email)->first();
  }

  public function deleteTokensByName(User $user)
  {
    return $user
      ->tokens()
      ->where('name', $user->currentAccessToken()->name)
      ->delete();
  }
}
