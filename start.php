<?php

declare(strict_types=1);

namespace lct{

    use lct\lang\LanguageManager;
    use lct\lang\TranslationKey;

    require 'vendor/autoload.php';

    define("LCT_PATH", dirname(__FILE__));
    define("RESOURCES_PATH", LCT_PATH . DIRECTORY_SEPARATOR . "resources");

    LanguageManager::getInstance()->loadDefaultLanguages();

    $lct = new LeagueClientTools();
    $lct->debugConfigValues();

    if($lct->getClient()->getLockfile() !== null){
        $lct->getLogger()->info(TranslationKey::LCU_DETECTED);
    }else{
        $lct->getLogger()->error(TranslationKey::LCU_NOT_FOUND);
        return;
    }

    $lct->multisearch();
}