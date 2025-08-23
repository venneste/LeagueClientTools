<?php

declare(strict_types=1);

namespace lct{

    use lct\lang\LanguageManager;

    require 'vendor/autoload.php';

    define("LCT_PATH", dirname(__FILE__));
    define("RESOURCES_PATH", LCT_PATH . DIRECTORY_SEPARATOR . "resources");

    LanguageManager::getInstance()->loadDefaultLanguages();

    $lct = new LeagueClientTools();
    $lct->debugConfigValues();

    $lct->multisearch();
}