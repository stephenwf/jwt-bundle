<?php

namespace Hygrid\JWTBundle;


use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer;
use Lcobucci\JWT\Signer\Key;

class WebTokenIssuer
{
    private $builder;
    private $signer;
    private $private_key;
    private $expiry;
    private $issuer;

    public function __construct(
        Configuration $configuration,
        Signer $signer,
        Key $private_key,
        string $issuer,
        int $expiry
    ) {
        $this->builder = $configuration->createBuilder();
        $this->signer = $signer;
        $this->private_key = $private_key;
        $this->expiry = $expiry;
        $this->issuer = $issuer;
    }

    public function getToken(array $payload)
    {
        $this->builder
            ->issuedBy($this->issuer)
            ->issuedAt(time())
            ->expiresAt(time() + $this->expiry);

        foreach ($payload as $name => $item) {
            $this->builder->with($name, $item);
        }
        
        $this->builder->sign($this->signer,  $this->private_key);

        return $this->builder->getToken();
    }

}