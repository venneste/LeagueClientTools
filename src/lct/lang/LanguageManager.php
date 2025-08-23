<?php

declare(strict_types=1);

namespace lct\lang;

use lct\lang\types\English;
use lct\lang\types\Russian;

final class LanguageManager{

    private static ?self $instance = null;

    /**
     * Language code (string) => {@link Language}
     * @var array<string, Language>
     */
    private array $loadedLanguages = [];

    private Language $fallbackLanguage;

    public static function getInstance() : LanguageManager{
        return self::$instance ??= new self();
    }

    private function __construct(){
        $this->fallbackLanguage = new English();
    }

    public function loadLanguage(Language $language, bool $force = false) : void{
        $code = $language::getCode();
        if(isset($this->loadedLanguages[$code]) && !$force){
            throw new LoadLanguageException("Language " . $code . " already loaded");
        }

        $this->loadedLanguages[$code] = $language;
    }

    public function loadDefaultLanguages() : void{
        $this->loadLanguage(new Russian());
        $this->loadLanguage(new English());
    }

    public function getLanguage(string $code) : Language{
        return $this->loadedLanguages[$code] ?? $this->fallbackLanguage;
    }
}