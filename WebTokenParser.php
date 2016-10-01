<?php

namespace Hygrid\JWTBundle;


use Exception;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Token;

class WebTokenParser
{
    private $parser;
    private $signer;
    private $public_key;

    public function __construct(
        Configuration $configuration,
        Signer $signer,
        Key $public_key
    ) {
        $this->parser = $configuration->getParser();
        $this->signer = $signer;
        $this->public_key = $public_key;
    }

    public function parse(string $hash) : Token
    {
        $token = $this->parser->parse($hash);
        if (!$token->verify($this->signer, $this->public_key)) {
            throw new Exception("Not verified.");
        }
        return $token;
    }


}