<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
  public function __construct($message = null, $code = 0)
  {
    parent::__construct($message, $code);
  }
}
