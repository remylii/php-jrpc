<?php
namespace JRpc\Exception;

use JRpc\Lib\Logger;

class BaseException extends \Exception
{
    public function __construct(string $msg = '', int $code = 0, $previous = null)
    {
        \JRpc\Lib\Logger::error($msg);
        parent::__construct($msg, $code, $previous);
    }
}
