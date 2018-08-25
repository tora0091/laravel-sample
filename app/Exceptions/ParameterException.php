<?php

namespace App\Exceptions;

use Exception;

class ParameterException extends Exception
{
    public function __construct() {
        parent::__construct("Parameter Not Found.", 419);
    }
}
