<?php

declare(strict_types=1);

namespace lct\data\account;

use luverelle\pson\attributes\JsonProperty;

class AccountRegion{

    /**
     * @var string[]
     */
    #[JsonProperty("locales")]
    private array $locales;

    #[JsonProperty("id")]
    private string $id;

    #[JsonProperty("tag")]
    private string $tag;

    /**
     * @param string[] $locales
     * @param string   $id
     * @param string   $tag
     */
    public function __construct(array $locales, string $id, string $tag){
        $this->locales = $locales;
        $this->id = $id;
        $this->tag = $tag;
    }

    /**
     * @return string[]
     */
    public function getLocales() : array{
        return $this->locales;
    }

    public function getId() : string{
        return $this->id;
    }

    public function getTag() : string{
        return $this->tag;
    }
}