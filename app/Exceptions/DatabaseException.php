<?php

namespace App\Exceptions;

use Exception;

class DatabaseException extends Exception
{
    public function __construct() {
        parent::__construct("Database Error!!", 500);
    }
}
