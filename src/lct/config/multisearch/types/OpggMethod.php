<?php

declare(strict_types=1);

namespace lct\config\multisearch\types;

use lct\config\multisearch\MultisearchMethod;
use lct\utils\Utils;

class OpggMethod extends MultisearchMethod{

    public function buildUrl(string $region, array $players) : string{
        return "https://op.gg/lol/multisearch/" . $region . "?summoners=" . Utils::urlEncodeRiotIds($players);
    }

    public function getName() : string{
        return "OPgg";
    }
}