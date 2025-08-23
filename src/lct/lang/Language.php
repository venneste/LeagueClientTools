<?php

declare(strict_types=1);

namespace lct\lang;

use Symfony\Component\Filesystem\Path;

abstract class Language{

    /**
     * @var array<string, string>
     */
    protected array $translationKeys = [];

    public function __construct(){
        $this->translationKeys = array_map("stripcslashes", (array) parse_ini_file($this->getFilePath(), false, INI_SCANNER_RAW));
    }

    public function translate(TranslationKey $key, array $params) : string{
        if(!isset($this->translationKeys[$key->value])){
            return $key->value;
        }

        return str_replace($key->getParameters(), $params, $this->translationKeys[$key->value]);
    }

    protected function getFilePath() : string{
        return Path::join(RESOURCES_PATH, "lang/" . static::getCode() . ".ini");
    }

    abstract public static function getCode() : string;
}