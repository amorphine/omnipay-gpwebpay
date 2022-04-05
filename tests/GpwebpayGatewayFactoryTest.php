<?php

namespace Omnipay\Gpwebpay;

use Omnipay\Tests\TestCase;

class GpwebpayGatewayFactoryTest extends TestCase
{
    public function testCreateHttpGatewayInstance()
    {
        $privateKeyPath = __FILE__.DIRECTORY_SEPARATOR.'key.pem';

        $publicKeyPath = __FILE__.DIRECTORY_SEPARATOR.'public.pem';

        $instance = GpwebpayGatewayFactory::createHttpGatewayInstance(
            $privateKeyPath,
            $publicKeyPath,
            '',
            true
        );

        $this->assertInstanceOf(GpwebpayHttpGateway::class, $instance);
    }
}
