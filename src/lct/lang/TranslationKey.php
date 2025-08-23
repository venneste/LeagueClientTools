<?php

declare(strict_types=1);

namespace lct\lang;

enum TranslationKey : string{

    /* ------------------ INFO TRANSLATIONS ---------------- */

    case LCU_DETECTED = "league_client.detected";
    case LCU_NOT_FOUND = "league_client.not_found";
    case MULTISEARCH_ERROR = "multisearch.error";
    case MULTISEARCH_SUCCESS = "multisearch.success";



    /* ------------------ DEBUG TRANSLATIONS ---------------- */

    case DEBUG_CFG_LANG = "debug.config.lang";
    case DEBUG_CFG_RIOT_GAMES_PATH = "debug.config.riot_games_path";
    case DEBUG_CFG_PREF_MULTISEARCH = "debug.config.preferred_multisearch";
    case DEBUG_LCU_DETECT = "debug.league_client.detect";

    /**
     * @return string[]
     */
    public function getParameters() : array{
        return match($this){
            self::DEBUG_CFG_RIOT_GAMES_PATH => ["{path}"],
            self::DEBUG_CFG_PREF_MULTISEARCH => ["{site}"],
            self::MULTISEARCH_SUCCESS => ["{riotIds}"],

            default => [],
        };
    }
}