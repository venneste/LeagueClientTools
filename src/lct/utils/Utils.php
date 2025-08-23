<?php

declare(strict_types=1);

namespace lct\utils;

use InvalidArgumentException;
use lct\data\lobby\player\LobbyPlayer;
use RuntimeException;

final class Utils{
    
    public static function decodeToken(string $encodedToken) : string{
        $parts = explode(".", $encodedToken);
        if(count($parts) < 2){
            throw new InvalidArgumentException("Invalid token format");
        }

        $payload = $parts[1];
        $padding = str_repeat("=", (4 - strlen($payload) % 4) % 4);

        return self::base64UrlDecode($payload . $padding);
    }
    
    public static function base64UrlDecode(string $data) : string{
        $ret = base64_decode(str_replace(["-", "_"], ["+", "/"], $data));
        if(!is_string($ret)){
            throw new RuntimeException("Failed to base64 url decode");
        }

        return $ret;
    }

    public static function openUrl(string $url) : void{
        exec("start " . $url);
    }

    /**
     * @param LobbyPlayer[] $players
     * @param string        $separator
     * @return string
     */
    public static function urlEncodeRiotIds(array $players, string $separator = ",") : string{
        return implode($separator, array_map(function(LobbyPlayer $player) : string{
            return urlencode($player->getRiotId());
        }, $players));
    }
}