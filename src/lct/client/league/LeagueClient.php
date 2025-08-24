<?php

declare(strict_types=1);

namespace lct\client\league;

use lct\client\Client;
use lct\client\http\RequestMethod;
use lct\data\account\AccountInfo;
use lct\data\lobby\GameLobby;
use lct\data\lobby\player\LobbyPlayer;
use lct\utils\Utils;
use luverelle\pson\PSON;
use Symfony\Component\Filesystem\Path;

class LeagueClient extends Client{

    public function changeBackgroundSkin(int $skinId) : void{
        $this->request(RequestMethod::POST, "/lol-summoner/v1/current-summoner/summoner-profile", [
            "key" => "backgroundSkinId",
            "value" => $skinId
        ]);
    }

    public function changeRiotId(string $gameName, string $tag) : void{
        $this->request(RequestMethod::POST, "/lol-summoner/v1/save-alias", [
            "gameName" => $gameName,
            "tagLine" => $tag
        ]);
    }

    public function setStatus(string $message) : void{
        $this->request(RequestMethod::PUT, "/lol-chat/v1/me", [
            "statusMessage" => stripcslashes($message)
        ]);
    }

    public function setInvisibleBanner() : void{
        $this->request(RequestMethod::POST, "/lol-challenges/v1/update-player-preferences", [
            "bannerAccent" => "2"
        ]);
    }

    public function removeAllChallenges() : void{
        $this->request(RequestMethod::POST, "/lol-challenges/v1/update-player-preferences", [
            "challengeIds" => []
        ]);
    }

    public function getAccountInfo() : AccountInfo{
        $response = $this->request(RequestMethod::GET, "/lol-rso-auth/v1/authorization/userinfo");
        $token = Utils::decodeToken(json_decode($response, true)["userInfo"]);

        return PSON::fromJsonArrayAsClass((array) json_decode($token, true), AccountInfo::class);
    }

    /**
     * @return LobbyPlayer[]
     */
    public function getAccountsFromGameLobby() : array{
        $response = $this->request(RequestMethod::GET, "/lol-champ-select/v1/session");
        $lobby = PSON::fromJsonArrayAsClass((array) json_decode($response, true), GameLobby::class);

        return $lobby->getMyTeam();
    }

    public function getURL() : string{
        return Path::join($this->lockfile->getProtocol() . "://", "127.0.0.1:" . $this->lockfile->getPort());
    }
}