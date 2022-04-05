<?php


namespace Omnipay\Gpwebpay;

use Omnipay\Gpwebpay\Sign\DataSigner;
use Omnipay\Gpwebpay\Sign\DataVerifier;
use Omnipay\Gpwebpay\Sign\Signer;
use Omnipay\Omnipay;

/**
 * Class GpWebpayGatewayFactory
 * @package Omnipay\Gpwebpay
 */
class GpWebpayGatewayFactory
{
    /**
     * @param string $privateKey
     * @param string $publicKey
     * @param string $privateKeyPassword
     * @param bool $isSandbox
     * @return GpWebpayHttpGateway
     */
    public static function createHttpGatewayInstance(
        string $privateKey,
        string $publicKey,
        string $privateKeyPassword = '',
        bool $isSandbox = false
    ): GpWebpayHttpGateway
    {
        $signer = new Signer($privateKey, $privateKeyPassword);

        $dataSigner = new DataSigner($signer);

        $dataVerifier = new DataVerifier($publicKey);

        /** @var GpWebpayHttpGateway $gateway */
        $gateway = Omnipay::create('\\Omnipay\\GpWebpay\\GpWebpayHttpGateway');

        $gateway->setDataVerifier($dataVerifier);

        $gateway->setDataSigner($dataSigner);

        $gateway->initialize([
            'isSandbox'     => $isSandbox
        ]);

        return $gateway;
    }
}
