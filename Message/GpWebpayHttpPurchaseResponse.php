<?php


namespace Omnipay\GpWebpay\Message;


use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class GpWebpayHttpPurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    const REDIRECT_URL = 'https://3dsecure.gpwebpay.com/pgw/order.do';

    const TEST_REDIRECT_URL = 'https://test.3dsecure.gpwebpay.com/pgw/order.do';

    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        $request = $this->getRequest();

        if($request && method_exists($request, 'getTestMode')) {
            return $request->getTestMode() ? self::TEST_REDIRECT_URL : self::REDIRECT_URL;
        }

        return self::REDIRECT_URL;
    }

    public function getRedirectMethod()
    {
        return 'POST';
    }

    public function getRedirectData()
    {
        return $this->getData();
    }
}
