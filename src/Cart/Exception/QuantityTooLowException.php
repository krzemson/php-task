<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 02.09.2018
 * Time: 14:05
 */

namespace Recruitment\Cart\Exception;

use Throwable;

class QuantityTooLowException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
