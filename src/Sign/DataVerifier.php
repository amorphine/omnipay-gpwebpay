<?php

namespace Omnipay\Gpwebpay\Sign;

class DataVerifier
{
    private string $publicKey;

    function __construct(string $publicKey)
    {
        $this->publicKey = $publicKey;
    }

    /**
     * Check signature
     *
     * @param string $text - data to verify
     * @param string $signature - base64 encoded signature
     * @return bool
     */
    function verify(string $text, string $signature): bool
    {
        $publicKeyId = openssl_get_publickey($this->publicKey);

        $signature = base64_decode($signature);

        $res = openssl_verify($text, $signature, $publicKeyId);

        openssl_free_key($publicKeyId);

        return $res === 1;
    }
}
