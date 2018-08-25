<?php

namespace App\Exceptions;

use Exception;

class ValidationReCheckException extends Exception
{
    public function __construct() {
        parent::__construct("Validation Error!! validation re-check error.", 500);
    }
}
