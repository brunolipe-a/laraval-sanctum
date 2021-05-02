<?php

namespace App\Exceptions;

use Exception;

class AppException extends Exception
{
  protected string $status;

  public function __construct(
    string $message,
    string $status = 'error',
    int $statusCode = 400
  ) {
    $this->message = $message;
    $this->status = $status;
    $this->statusCode = $statusCode;
  }

  public function getStatus()
  {
    return $this->status;
  }

  public function getStatusCode()
  {
    return $this->statusCode;
  }
}
