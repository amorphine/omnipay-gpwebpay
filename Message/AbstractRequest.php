<?php

namespace Omnipay\GpWebpay\Message;

use Omnipay\GpWebpay\Sign\DataSigner;
use Omnipay\GpWebpay\Sign\DataVerifier;
use Omnipay\Common\Message\AbstractRequest as OmnipayAbstractRequest;

abstract class AbstractRequest extends OmnipayAbstractRequest
{
    /** @var DataVerifier */
    protected $dataVerifier;

    /** @var DataSigner */
    protected $dataSigner;

    /**
     * @return DataVerifier
     */
    public function getDataVerifier(): DataVerifier
    {
        return $this->dataVerifier;
    }

    /**
     * @param DataVerifier $dataVerifier
     */
    public function setDataVerifier(DataVerifier $dataVerifier): void
    {
        $this->dataVerifier = $dataVerifier;
    }

    /**
     * @return DataSigner
     */
    public function getDataSigner(): DataSigner
    {
        return $this->dataSigner;
    }

    /**
     * @param DataSigner $dataSigner
     */
    public function setDataSigner(DataSigner $dataSigner): void
    {
        $this->dataSigner = $dataSigner;
    }
}
