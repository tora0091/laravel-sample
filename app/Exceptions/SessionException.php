<?php

namespace App\Exceptions;

use Exception;

class SessionException extends Exception
{
    public function __construct() {
        parent::__construct("Session Error!! Session data is already deleted.", 419);
    }
}
