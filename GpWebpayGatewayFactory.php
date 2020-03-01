<?php


namespace Omnipay\GpWebpay;

use Omnipay\GpWebpay\Sign\DataSigner;
use Omnipay\GpWebpay\Sign\DataVerifier;
use Omnipay\GpWebpay\Sign\Signer;
use Omnipay\Omnipay;

/**
 * Class GpWebpayGatewayFactory
 * @package Omnipay\GpWebpay
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
        bool $isSandbox = false)
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
