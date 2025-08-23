<?php

declare(strict_types=1);

namespace lct\data\account;

use luverelle\pson\attributes\JsonProperty;

class AccountInfo{

    #[JsonProperty("country")]
    private string $country;

    #[JsonProperty("sub")]
    private string $sub;

    #[JsonProperty("preferred_username")]
    private string $preferredName;

    #[JsonProperty("email_verified")]
    private bool $emailVerified;

    #[JsonProperty("phone_number_verified")]
    private bool $phoneVerified;

    #[JsonProperty("region")]
    private AccountRegion $region;

    #[JsonProperty("acct")]
    private AccountType $type;

    #[JsonProperty("age")]
    private int $age;

    public function __construct(
        string $country, string $sub, string $preferredName,
        bool $emailVerified, bool $phoneVerified,
        AccountRegion $region, AccountType $type, int $age
    ){
        $this->country = $country;
        $this->sub = $sub;
        $this->preferredName = $preferredName;
        $this->emailVerified = $emailVerified;
        $this->phoneVerified = $phoneVerified;
        $this->region = $region;
        $this->type = $type;
        $this->age = $age;
    }

    public function getCountry() : string{
        return $this->country;
    }

    public function getSub() : string{
        return $this->sub;
    }

    public function getPreferredName() : string{
        return $this->preferredName;
    }

    public function isEmailVerified() : bool{
        return $this->emailVerified;
    }

    public function isPhoneVerified() : bool{
        return $this->phoneVerified;
    }

    public function getRegion() : AccountRegion{
        return $this->region;
    }

    public function getType() : AccountType{
        return $this->type;
    }

    public function getAge() : int{
        return $this->age;
    }
}