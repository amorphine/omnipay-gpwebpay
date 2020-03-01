<?php

namespace Omnipay\GpWebpay\Sign;

class DataSigner
{
    /** @var Preparer */
    private $preparer;

    /** @var Signer */
    private $signer;

    function __construct(Signer $signer)
    {
        $this->preparer = new Preparer();
        $this->signer = $signer;
    }

    /**
     * @param array $data
     * @param array $arrayKeys
     * @return string Base64 encoded
     */
    public function sign(array $data, array $arrayKeys)
    {
        $strToSign = $this->preparer->getStringToSign($data, $arrayKeys);
        return $this->signer->sign($strToSign);
    }
}
