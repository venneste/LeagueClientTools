<?php

declare(strict_types=1);

namespace lct\log;

enum LogLevel : string{

    case INFO = "INFO";
    case ERROR = "ERROR";
    case DEBUG = "DEBUG";

    public function getColor() : string{
        return match($this){
            self::INFO => "\e[96m",
            self::ERROR => "\e[91m",
            self::DEBUG => "\e[95m",
        };
    }
}