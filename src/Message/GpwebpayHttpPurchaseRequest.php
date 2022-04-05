<?php


namespace Omnipay\Gpwebpay\Message;


use Omnipay\Common\Exception\InvalidRequestException;

class GpWebpayHttpPurchaseRequest extends AbstractRequest
{
    use GpWebpayHttpPurchaseRequestParameters;

    /**
     * @var array|string[]
     */
    private $mandatoryPurchaseFields = [
        'merchantNumber',
        'operation',
        'orderNumber',
        'amount',
        'depositFlag',
        'url',
    ];

    /**
     * @var array|string[]
     */
    private $signDataKeys = [
        'merchantNumber',
        'operation',
        'orderNumber',
        'amount',
        'currency',
        'depositFlag',
        'merOrderNum',
        'url',
        'description',
        'md',
        'userParam1',
        'vrCode',
        'fastPayId',
        'payMethod',
        'disablePayMethod',
        'payMethods',
        'email',
        'referenceNumber',
        'addInfo',
        'panPattern',
        'token',
        'fastToken',
    ];

    /**
     * @return array
     */
    public function getMandatoryPurchaseFields(): array
    {
        return $this->mandatoryPurchaseFields;
    }

    /**
     * @param array $mandatoryPurchaseFields
     */
    public function setMandatoryPurchaseFields(array $mandatoryPurchaseFields): void
    {
        $this->mandatoryPurchaseFields = $mandatoryPurchaseFields;
    }

    /**
     * @return array
     */
    public function getSignDataKeys(): array
    {
        return $this->signDataKeys;
    }

    /**
     * @param array $signDataKeys
     */
    public function setSignDataKeys(array $signDataKeys): void
    {
        $this->signDataKeys = $signDataKeys;
    }

    /**
     * @return array
     *
     * @throws InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate(...$this->mandatoryPurchaseFields);

        // sort fields.
        // Fields to be signed should be
        // - on the top of the array
        // - the same order that keys have been declared in signDataKeys array
        $sortedData = array_replace(array_fill_keys($this->signDataKeys, null), $this->getParameters());

        $sortedData = array_filter($sortedData, function($v) {
            return !is_null($v);
        });

        // get signature value
        $digest = $this->signData($sortedData);

        /* array recombination start */
        // 1. signature data,
        // 2. signature,
        // 3. rest parameters
        $signedData = [];

        $unsignedData = [];

        foreach ($sortedData as $key => $datum) {
            $keyUpperCase = strtoupper($key);

            if (in_array($key, $this->signDataKeys)) {
                $signedData[$keyUpperCase] = $datum;
            } else {
                $unsignedData[$keyUpperCase] = $datum;
            }
        }
        /* array recombination end */

        return array_merge($signedData, ['DIGEST' => $digest], $unsignedData);
    }

    /**
     * @inheritDoc
     * @return GpWebpayHttpPurchaseResponse
     * @throws InvalidRequestException
     */
    public function send(): GpWebpayHttpPurchaseResponse
    {
        return $this->response = $this->sendData($this->getData());
    }

    /**
     * @inheritDoc
     * @return GpWebpayHttpPurchaseResponse
     */
    public function sendData($data): GpWebpayHttpPurchaseResponse
    {
        return $this->response = new GpWebpayHttpPurchaseResponse($this, $data);
    }

    /**
     * @param $data
     * @return string
     */
    private function signData($data): string
    {
        return $this->getDataSigner()->sign($data, $this->signDataKeys);
    }
}
