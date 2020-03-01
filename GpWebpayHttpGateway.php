<?php


namespace Omnipay\GpWebpay;

use Exception;
use Omnipay\Common\AbstractGateway;
use Omnipay\GpWebpay\Message\GpWebpayHttpPurchaseRequest;
use Omnipay\GpWebpay\Sign\DataSigner;
use Omnipay\GpWebpay\Sign\DataVerifier;

/**
 * @method \Omnipay\Common\Message\NotificationInterface acceptNotification(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface authorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface capture(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface purchase(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface refund(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface fetchTransaction(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
 */
class GpWebpayHttpGateway extends AbstractGateway
{

    /** @var DataVerifier */
    protected $dataVerifier;

    /** @var DataSigner */
    protected $dataSigner;

    private $name = 'GP Webpay HTTP gateway';

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->name;
    }

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

    public function getDefaultParameters()
    {
        return [
            //'testMode'  => false,
        ];
    }

    /**
     * @inheritDoc
     * @param string $class
     * @param array $parameters
     * @return GpWebpayHttpPurchaseRequest
     * @throws Exception
     */
    public function createRequest($class, array $parameters)
    {
        if (!($this->dataSigner instanceof DataSigner)) {
            throw new Exception('Cannot create request, DataSigner is not set');
        }
        if (!($this->dataVerifier instanceof DataVerifier)) {
            throw new Exception('Cannot create request, DataVerifier is not set');
        }

        /** @var GpWebpayHttpPurchaseRequest $request */
        $request = parent::createRequest($class, $parameters);

        $request->setDataSigner($this->dataSigner);

        $request->setDataVerifier($this->dataVerifier);

        return $request;
    }

    /**
     * Prepare form data and sign it
     *
     * @param array $parameters
     * @return GpWebpayHttpPurchaseRequest
     * @throws Exception
     */
    public function purchase(array $parameters) {
        return $this->createRequest(GpWebpayHttpPurchaseRequest::class, $parameters);
    }

    public function completePurchase(array $parameters = []) {
        // TODO iomplement
    }
}
