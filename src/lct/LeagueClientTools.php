<?php

declare(strict_types=1);

namespace lct;

use lct\client\league\LeagueClient;
use lct\config\YamlConfig;
use lct\lang\LanguageManager;
use lct\lang\TranslationKey as TK;
use lct\log\Logger;
use Symfony\Component\Filesystem\Path;
use Throwable;

final class LeagueClientTools{

    private YamlConfig $config;
    private Logger $logger;

    private LeagueClient $client;

    public function __construct(){
        $this->config = new YamlConfig(Path::join(RESOURCES_PATH, "config.yml"));
        $this->logger = new Logger(LanguageManager::getInstance()->getLanguage($this->config->getLanguage()));
        $this->client = new LeagueClient(Path::join($this->config->getRiotGamesPath(), "League of Legends"));

        $this->logger->setDebug($this->config->isDebug());
    }

    public function debugConfigValues() : void{
        $this->logger->debug(TK::DEBUG_CFG_LANG);
        $this->logger->debug(TK::DEBUG_CFG_RIOT_GAMES_PATH, [$this->config->getRiotGamesPath()]);
        $this->logger->debug(TK::DEBUG_CFG_PREF_MULTISEARCH, [$this->config->getMultisearchMethod()->getName()]);
    }

    public function multisearch() : void{
        try{
            $region = $this->client->getAccountInfo()->getRegion()->getTag();
            $riotIds = $this->client->getAccountsFromGameLobby();

            $this->config->getMultisearchMethod()->search($region, $riotIds);

            $this->logger->info(TK::MULTISEARCH_SUCCESS, [implode("\n", $riotIds)]);
        }catch(Throwable $exception){
            $this->logger->error(TK::MULTISEARCH_ERROR);
            $this->logger->debug("Stack trace:" . PHP_EOL . $exception->getTraceAsString());
        }
    }

    /**
     * @return Logger
     */
    public function getLogger() : Logger{
        return $this->logger;
    }

    /**
     * @return YamlConfig
     */
    public function getConfig() : YamlConfig{
        return $this->config;
    }

    /**
     * @return LeagueClient
     */
    public function getClient() : LeagueClient{
        return $this->client;
    }
}