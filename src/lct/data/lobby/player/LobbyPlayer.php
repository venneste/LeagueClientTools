<?php

declare(strict_types=1);

namespace lct\data\lobby\player;

use luverelle\pson\attributes\JsonProperty;

class LobbyPlayer{

    #[JsonProperty("gameName")]
    private string $gameName;

    #[JsonProperty("tagLine")]
    private string $tagLine;

    #[JsonProperty("assignedPosition")]
    private string $position;

    public function __construct(string $gameName, string $tagLine, string $position){
        $this->gameName = $gameName;
        $this->tagLine = $tagLine;
        $this->position = $position;
    }

    public function getRiotId() : string{
        return $this->gameName . "#" . $this->tagLine;
    }

    public function getPosition() : string{
        return $this->position;
    }

    public function __toString() : string{
        return $this->position . " - " . $this->getRiotId();
    }
}