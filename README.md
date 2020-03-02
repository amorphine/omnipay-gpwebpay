# Omnipay: GP webpay

**GP webpay driver for the Omnipay PHP payment processing library**


[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP. This package implements PayPal support for Omnipay.

## Early Development
The driver now supports generating payment form only via API HTTP only. See https://www.gpwebpay.cz/Content/downloads/GP_webpay_HTTP_EN.pdf for details.
Example:

```
use Omnipay\GpWebpay\GpWebpayGatewayFactory;

// initialize gateway with sign keys, password and test mode flag
$gateway = GpWebpayGatewayFactory::createInstance(
    $publicKey,             // string with file content or 'file://' reference with absolute path
    $privateKey,            // string with file content or 'file://' reference with absolute path
    $privateKeyPassword,    // private key password
    false                   // test mode
);

// fill up form data
$purchaseRequest = $gateway->purchase([
    'merchantNumber' => '12345678',
    'operation' => 'CREATE_ORDER',
    'orderNumber' => '12345677',
    'amount' => '10',
    'depositFlag' => '1',
    'returnUrl' => 'http://localhost:8000/gateway-return.php',
]);

// you may also set form parameters via setters
// see \Omnipay\GpWebpay\Message\GpWebpayHttpPurchaseRequestParameters to get available parameters
$purchaseRequest->setDepositFlag('1');

// validate form data, create signature
$response = $purchaseRequest->send();

// get payment form data to redirect the user to gateway
$form = $response->getRedirectResponse()->getData();

// get production or test redirect url. Depends on the test flag passet on gateway initialization
$redirectUrl = $response->getRedirectUrl();
```

## Plans
+ Tests
+ Processing redirected user payload
+ WS API implementation
