
[![Build Status](https://travis-ci.org/thephpleague/omnipay-Pingpp.png?branch=master)](https://travis-ci.org/thephpleague/omnipay-Pingpp)
[![Latest Stable Version](https://poser.pugx.org/omnipay/Pingpp/version.png)](https://packagist.org/packages/omnipay/Pingpp)
[![Total Downloads](https://poser.pugx.org/omnipay/Pingpp/d/total.png)](https://packagist.org/packages/omnipay/Pingpp)

### Pingpp.js

The Pingpp integration is fairly straight forward. Essentially you just pass
a `token` field through to Pingpp instead of the regular credit card data.

Start by following the standard Pingpp JS guide here:
[https://pingxx.com/docs/tutorials/forms](https://Pingpp.com/docs/tutorials/forms)

After that you will have a `PingppToken` field which will be submitted to your server.
Simply pass this through to the gateway as `token`, instead of the usual `card` array:

```php
$token = $_POST['PingppToken'];
$response = $gateway->purchase(['amount' => '10.00', 'currency' => 'USD', 'token' => $token])->send();
```

## Test Mode

Pingpp accounts have test-mode API keys as well as live-mode API keys. These keys can be active
at the same time. Data created with test-mode credentials will never hit the credit card networks
and will never cost anyone money.

Unlike some gateways, there is no test mode endpoint separate to the live mode endpoint, the
Pingpp API endpoint is the same for test and for live.

