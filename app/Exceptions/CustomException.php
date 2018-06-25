<?php
/**
 * Created by PhpStorm.
 * User: canhps
 * Date: 16/05/2018
 * Time: 12:10
 */

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    public function __construct()
    {
        parent::__construct();
    }
}