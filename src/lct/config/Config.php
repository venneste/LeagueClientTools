<?php

declare(strict_types=1);

namespace lct\config;

abstract class Config{

    protected string $path;

    public function __construct(string $path){
        $this->path = $path;

        $this->loadData();
    }

    abstract public function loadData() : void;

    abstract public function saveData() : void;
}