<?php

declare(strict_types=1);

namespace lct\config\multisearch;

use InvalidArgumentException;
use lct\config\multisearch\types\OpggMethod;
use lct\config\multisearch\types\PorofessorMethod;
use lct\data\lobby\player\LobbyPlayer;
use lct\utils\Utils;

abstract class MultisearchMethod{

    public static function parse(string $method) : static{
        return match($method){
            "porofessor" => new PorofessorMethod(),
            "opgg" => new OpggMethod(),
            default => throw new InvalidArgumentException("Multisearch method ". $method ." does not exist"),
        };
    }

    /**
     * @param LobbyPlayer[] $players
     */
    public function search(string $region, array $players) : void{
        Utils::openUrl($this->buildUrl($region, $players));
    }

    /**
     * @param string        $region
     * @param LobbyPlayer[] $players
     * @return string
     */
    abstract public function buildUrl(string $region, array $players) : string;

    abstract public function getName() : string;
}