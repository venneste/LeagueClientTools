<?php

declare(strict_types=1);

namespace lct\data\lobby;

use lct\data\lobby\player\LobbyPlayer;
use luverelle\pson\attributes\JsonProperty;

class GameLobby{

    #[JsonProperty("gameId")]
    private int $gameId;

    /**
     * @var LobbyPlayer[]
     */
    #[JsonProperty("myTeam", arrayValueClass: LobbyPlayer::class)]
    private array $myTeam;

    /**
     * @param int           $gameId
     * @param LobbyPlayer[] $myTeam
     */
    public function __construct(int $gameId, array $myTeam){
        $this->gameId = $gameId;
        $this->myTeam = $myTeam;
    }

    /**
     * @return LobbyPlayer[]
     */
    public function getMyTeam() : array{
        return $this->myTeam;
    }

    public function getGameId() : int{
        return $this->gameId;
    }
}