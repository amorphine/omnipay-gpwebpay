<?php

namespace Omnipay\Gpwebpay\Sign;

class DataSigner
{
    private Preparer $preparer;

    private Signer $signer;

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
    public function sign(array $data, array $arrayKeys): string
    {
        $strToSign = $this->preparer->getStringToSign($data, $arrayKeys);

        return $this->signer->sign($strToSign);
    }
}
