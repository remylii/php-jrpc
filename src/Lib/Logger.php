<?php

namespace JRpc\Lib;

use Monolog\Logger as MonoLogger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\RotatingFileHandler;

class Logger
{
    private static $log;

    protected static function init(): void
    {
        if (!is_null(self::$log) && self::$log instanceof MonoLogger) {
            return;
        }

        self::$log = new MonoLogger("jrpc");
        // path
        $log_path = __DIR__ . "/../../logs/error.log";

        $handler = new StreamHandler($log_path, MonoLogger::DEBUG);
        self::$log->pushHandler($handler);
    }


    public static function emergency($message, $context = [])
    {
        self::init();
        return self::$log->emergency($message, $context);
    }

    public static function alert($message, $context = [])
    {
        self::init();
        return self::$log->alert($message, $context);
    }

    public static function critical($message, $context = [])
    {
        self::init();
        return self::$log->critical($message, $context);
    }

    public static function error($message, $context = [])
    {
        self::init();
        return self::$log->error($message, $context);
    }

    public static function warning($message, $context = [])
    {
        self::init();
        return self::$log->warning($message, $context);
    }

    public static function notice($message, $context = [])
    {
        self::init();
        return self::$log->notice($message, $context);
    }

    public static function info($message, $context = [])
    {
        self::init();
        return self::$log->info($message, $context);
    }

    public static function debug($message, $context = [])
    {
        self::init();
        return self::$log->debug($message, $context);
    }
}
