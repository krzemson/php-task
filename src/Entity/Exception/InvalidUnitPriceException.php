<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 31.08.2018
 * Time: 20:46
 */

namespace Recruitment\Entity\Exception;

use Throwable;

class InvalidUnitPriceException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
