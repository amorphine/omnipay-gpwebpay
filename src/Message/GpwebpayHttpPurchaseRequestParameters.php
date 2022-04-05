<?php


namespace Omnipay\Gpwebpay\Message;

/**
 * Trait GpWebpayHttpPurchaseRequestParameters
 *
 * List of request parameters' getters and setters
 *
 * @package Omnipay\Gpwebpay\Message
 */
trait GpwebpayHttpPurchaseRequestParameters
{
    public function setMerchantNumber(string $merchantNumber)
    {
        $this->setParameter('merchantNumber', $merchantNumber);
    }

    public function getMerchantNumber()
    {
        return $this->getParameter('merchantNumber');
    }

    public function getOperation()
    {
        return $this->getParameter('operation');
    }

    public function setOperation(string $operation)
    {
        $this->setParameter('operation', $operation);
    }

    public function getOrderNumber()
    {
        return $this->getParameter('orderNumber');
    }

    public function setOrderNumber(string $orderNumber)
    {
        $this->setParameter('orderNumber', $orderNumber);
    }

    public function getDepositFlag()
    {
        return $this->getParameter('depositFlag');
    }

    public function setDepositFlag(string $value)
    {
        $this->setParameter('depositFlag', $value);
    }

    public function getMerchantOrderNumber()
    {
        return $this->getParameter('memOrderNum');
    }

    public function setMerchantOrderNumber(string $value)
    {
        $this->setParameter('memOrderNum', $value);
    }

    public function getMerchantData()
    {
        return $this->getParameter('md');
    }

    public function setMerchantData(string $value)
    {
        $this->setParameter('md', $value);
    }

    public function getUserParam1()
    {
        return $this->getParameter('userParam1');
    }

    public function setUserParam1(string $value)
    {
        $this->setParameter('userParam1', $value);
    }

    public function getVrCode()
    {
        return $this->getParameter('vrCode');
    }

    public function setVrCode(string $value)
    {
        $this->setParameter('vrCode', $value);
    }

    public function getFastPayId()
    {
        return $this->getParameter('fastPayId');
    }

    public function setFastPayId(string $value)
    {
        $this->setParameter('fastPayId', $value);
    }

    public function getDisablePayMethod()
    {
        return $this->getParameter('disablePayMethod');
    }

    public function setDisablePayMethod()
    {
        return $this->getParameter('disablePayMethod');
    }

    public function getPayMethods()
    {
        return $this->getParameter('payMethods');
    }

    public function setPayMethods(string $value)
    {
        $this->setParameter('payMethods', $value);
    }

    public function getEmail()
    {
        return $this->getParameter('email');
    }

    public function setEmail(string $value)
    {
        $this->setParameter('email', $value);
    }

    public function getReferenceNumber()
    {
        return $this->getParameter('referenceNumber');
    }

    public function setReferenceNumber(string $value)
    {
        $this->setParameter('referenceNumber', $value);
    }

    public function getAddInfo()
    {
        return $this->getParameter('addInfo');
    }

    public function setAddInfo(string $value)
    {
        $this->setParameter('addInfo', $value);
    }

    public function getPanPattern()
    {
        return $this->getParameter('panPattern');
    }

    public function setPanPattern(string $value)
    {
        $this->setParameter('panPattern', $value);
    }

    public function getFastToken()
    {
        return $this->getParameter('fastToken');
    }

    public function setFastToken(string $value)
    {
        $this->setParameter('fastToken', $value);
    }

    public function getLang()
    {
        return $this->getParameter('lang');
    }

    public function setLang(string $value)
    {
        $this->setParameter('lang', $value);
    }

}
