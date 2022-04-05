<?php


namespace Omnipay\Gpwebpay;

use Exception;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Gpwebpay\Message\GpWebpayHttpPurchaseRequest;
use Omnipay\Gpwebpay\Sign\DataSigner;
use Omnipay\Gpwebpay\Sign\DataVerifier;

/**
 * @method NotificationInterface acceptNotification(array $options = array())
 * @method RequestInterface authorize(array $options = array())
 * @method RequestInterface completeAuthorize(array $options = array())
 * @method RequestInterface capture(array $options = array())
 * @method RequestInterface refund(array $options = array())
 * @method RequestInterface fetchTransaction(array $options = [])
 * @method RequestInterface void(array $options = array())
 * @method RequestInterface createCard(array $options = array())
 * @method RequestInterface updateCard(array $options = array())
 * @method RequestInterface deleteCard(array $options = array())
 */
class GpWebpayHttpGateway extends AbstractGateway
{
    /**
     * @var DataVerifier
     */
    protected $dataVerifier;

    /**
     * @var DataSigner
     */
    protected $dataSigner;

    /**
     * @var string
     */
    private $name = 'GP Webpay HTTP gateway';

    /**
     * @inheritDoc
     */
    public function getName(): string
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

    public function getDefaultParameters(): array
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
    public function createRequest($class, array $parameters): GpWebpayHttpPurchaseRequest
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
     * @param array $options
     * @return GpWebpayHttpPurchaseRequest
     * @throws Exception
     */
    public function purchase(array $options): GpWebpayHttpPurchaseRequest
    {
        return $this->createRequest(GpWebpayHttpPurchaseRequest::class, $options);
    }

    public function completePurchase(array $options = []) {
        // TODO implement
    }
}
