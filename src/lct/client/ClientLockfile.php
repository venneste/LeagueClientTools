<?php

declare(strict_types=1);

namespace lct\client;

readonly class ClientLockfile{

    /**
     * @param string $path
     * @return ClientLockfile|null
     */
    public static function parse(string $path) : ?ClientLockfile{
        if(!is_file($path) || !file_exists($path)){
            return null;
        }

        $data = explode(":", (string) file_get_contents($path));

        return new self(
            processName: $data[0],
            pid: (int) $data[1],
            port: (int) $data[2],
            password: $data[3],
            protocol: $data[4],
        );
    }

    public function __construct(
        protected string $processName,
        protected int $pid,
        protected int $port,
        protected string $password,
        protected string $protocol
    ){}

    /**
     * @return int
     */
    public function getPort() : int{
        return $this->port;
    }

    /**
     * @return string
     */
    public function getPassword() : string{
        return $this->password;
    }

    /**
     * @return string
     */
    public function getProtocol() : string{
        return $this->protocol;
    }
}