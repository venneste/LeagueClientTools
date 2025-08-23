<?php

declare(strict_types=1);

namespace lct\config\multisearch\types;

use lct\config\multisearch\MultisearchMethod;
use lct\utils\Utils;

class PorofessorMethod extends MultisearchMethod{

    public function buildUrl(string $region, array $players) : string{
        return "https://porofessor.gg/pregame/" . $region . "/" . Utils::urlEncodeRiotIds($players) . "/soloqueue/season";
    }

    public function getName() : string{
        return "porofessor";
    }
}