<?php

namespace Croppa\Service;

class LoggerService
{

    public static function log(string $message, string $type = 'info')
    {
        $formattedMessage = sprintf("[%s]\t[%s]\t%s", date('Y-m-d H:i:s'), strtoupper($type), $message);
        file_put_contents(__DIR__ . "/../../logs/app.log", $formattedMessage.PHP_EOL, FILE_APPEND);
    }
}