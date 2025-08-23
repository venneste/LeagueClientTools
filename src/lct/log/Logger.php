<?php

declare(strict_types=1);

namespace lct\log;

use ErrorException;
use JetBrains\PhpStorm\NoReturn;
use lct\lang\TranslationKey;
use lct\LeagueClientTools;
use Throwable;

final class Logger{

    public const string TEXT_COLOR = "\e[39m";

    public function __construct(
        private readonly LeagueClientTools $loader,
        private bool $debug = true
    ){
        set_exception_handler($this->handleExceptions(...));
        set_error_handler($this->handleErrors(...));
    }

    private function log(LogLevel $level, TranslationKey|string $message, array $params) : void{
        $msg = $message instanceof TranslationKey ? $this->loader->getLanguage()->translate($message, $params) : $message;

        echo $level->getColor() . "[" . $level->value . "] " . self::TEXT_COLOR . $msg . PHP_EOL;
    }

    #[NoReturn]
    private function handleExceptions(Throwable $exception) : void{
        $this->error($exception->getMessage());
        $this->debug("Stack trace:" . PHP_EOL . $exception->getTraceAsString());

        exit(1);
    }

    /**
     * @throws ErrorException
     */
    private function handleErrors(int $severity, string $message, string $file, int $line) : void{
        if((error_reporting() & $severity) !== 0){
            throw new ErrorException($message, 0, $severity, $file, $line);
        }
    }

    public function info(TranslationKey|string $message, array $params = []) : void{
        $this->log(LogLevel::INFO, $message, $params);
    }

    public function error(TranslationKey|string $message, array $params = []) : void{
        $this->log(LogLevel::ERROR, $message, $params);
    }

    public function debug(TranslationKey|string $message, array $params = []) : void{
        if($this->debug){
            $this->log(LogLevel::DEBUG, $message, $params);
        }
    }

    public function setDebug(bool $debug) : void{
        $this->debug = $debug;
    }
}