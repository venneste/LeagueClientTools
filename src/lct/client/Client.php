<?php

declare(strict_types=1);

namespace lct\client;

use lct\client\http\RequestMethod;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Path;

abstract class Client{

    protected ?ClientLockfile $lockfile;

    /**
     * @throws FileNotFoundException
     * @param string $clientPath
     */
    public function __construct(
        protected readonly string $clientPath
    ){
        $this->lockfile = ClientLockfile::parse($this->getLockfilePath());
    }

    public function request(RequestMethod $method, string $dest, array $params = []) : string{
        $ch = curl_init(Path::join($this->getURL(), $dest));

        curl_setopt_array($ch, $this->getCurlOptions());
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method->value);
        curl_setopt($ch, CURLOPT_POSTFIELDS, (string) json_encode($params));

        $result = curl_exec($ch);
        if(!is_string($result)){
            return "";
        }

        curl_close($ch);

        return $result;
    }

    /**
     * @return ClientLockfile|null
     */
    public function getLockfile() : ?ClientLockfile{
        return $this->lockfile;
    }

    protected function getLockfilePath() : string{
        return Path::join($this->clientPath, "lockfile");
    }
}