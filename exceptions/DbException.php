<?php

namespace exceptions;

/**
 * Class DbException
 * @package exceptions
 */
class DbException extends \Exception
{
    public $message = 'Some errors with database';
}
