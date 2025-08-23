<?php

declare(strict_types=1);

namespace lct\data\account;

use luverelle\pson\attributes\JsonProperty;

class AccountType{

    #[JsonProperty("type")]
    private int $type;

    #[JsonProperty("state")]
    private string $state;

    #[JsonProperty("adm")]
    private bool $adm;

    #[JsonProperty("game_name")]
    private string $gameName;

    #[JsonProperty("tag_line")]
    private string $tagLine;

    #[JsonProperty("created_at")]
    private int $createdAt;

    public function __construct(int $type, string $state, bool $adm, string $gameName, string $tagLine, int $createdAt){
        $this->type = $type;
        $this->state = $state;
        $this->adm = $adm;
        $this->gameName = $gameName;
        $this->tagLine = $tagLine;
        $this->createdAt = $createdAt;
    }

    public function getRiotId() : string{
        return $this->gameName . "#" . $this->tagLine;
    }

    public function getType() : int{
        return $this->type;
    }

    public function getState() : string{
        return $this->state;
    }

    public function isAdm() : bool{
        return $this->adm;
    }

    public function getGameName() : string{
        return $this->gameName;
    }

    public function getTagLine() : string{
        return $this->tagLine;
    }

    public function getCreatedAt() : int{
        return $this->createdAt;
    }
}