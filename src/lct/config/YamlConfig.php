<?php

declare(strict_types=1);

namespace lct\config;

use lct\config\multisearch\MultisearchMethod;

class YamlConfig extends Config{

    private string $language;

    private string $riotGamesPath;

    private MultisearchMethod $multisearchMethod;

    private bool $debug;

    public static function fixYAMLIndexes(string $str) : string{
        return preg_replace("#^( *)(y|Y|yes|Yes|YES|n|N|no|No|NO|true|True|TRUE|false|False|FALSE|on|On|ON|off|Off|OFF)( *)\:#m", "$1\"$2\"$3:", $str);
    }

    public function loadData() : void{
        $data = yaml_parse(self::fixYAMLIndexes((string) file_get_contents($this->path)));

        $this->language = $data["language"];
        $this->riotGamesPath = $data["riot-games-path"];
        $this->multisearchMethod = MultisearchMethod::parse($data["preferred-multisearch-site"]);
        $this->debug = $data["enable-debug"];
    }

    /**
     * @return string
     */
    public function getLanguage() : string{
        return $this->language;
    }

    /**
     * @return string
     */
    public function getRiotGamesPath() : string{
        return $this->riotGamesPath;
    }

    /**
     * @return MultisearchMethod
     */
    public function getMultisearchMethod() : MultisearchMethod{
        return $this->multisearchMethod;
    }

    /**
     * @return bool
     */
    public function isDebug() : bool{
        return $this->debug;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language) : void{
        $this->language = $language;
    }

    /**
     * @param string $riotGamesPath
     */
    public function setRiotGamesPath(string $riotGamesPath) : void{
        $this->riotGamesPath = $riotGamesPath;
    }

    /**
     * @param string $multisearchMethod
     */
    public function setMultisearchMethod(string $multisearchMethod) : void{
        $this->multisearchMethod = MultisearchMethod::parse($multisearchMethod);
    }

    /**
     * @param bool $debug
     */
    public function setDebug(bool $debug) : void{
        $this->debug = $debug;
    }

    public function saveData() : void{
        file_put_contents($this->path, yaml_emit([
            "language" => $this->language,
            "riot-games-path" => $this->riotGamesPath,
            "preferred-multisearch-site" => $this->multisearchMethod,
            "enable-debug" => $this->debug,
        ], YAML_UTF8_ENCODING));
    }
}