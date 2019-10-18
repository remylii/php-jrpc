<?php

namespace JRpc\Lib;

use Monolog\Logger as MonoLogger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\RotatingFileHandler;

class Logger
{
    private static $log;

    public static function write(string $message)
    {
        if (is_null(self::$log)) {
            self::$log = new MonoLogger("jrpc");
            // path
            $log_path = __DIR__ . "/../../logs/test.log";

            $handler = new StreamHandler($log_path, MonoLogger::DEBUG);
            self::$log->pushHandler($handler);
        }

        // writing
        return self::$log->debug($message);
    }
}

