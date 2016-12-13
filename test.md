# Omnipay: Pingpp

**Pingpp driver for the Omnipay PHP payment processing library**

[![Build Status](https://travis-ci.org/thephpleague/omnipay-Pingpp.png?branch=master)](https://travis-ci.org/thephpleague/omnipay-Pingpp)
[![Latest Stable Version](https://poser.pugx.org/omnipay/Pingpp/version.png)](https://packagist.org/packages/omnipay/Pingpp)
[![Total Downloads](https://poser.pugx.org/omnipay/Pingpp/d/total.png)](https://packagist.org/packages/omnipay/Pingpp)

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements Pingpp support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "omnipay/Pingpp": "~2.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

The following gateways are provided by this package:

* [Pingpp](https://Pingpp.com/)

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

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

### Pingpp Connect

Pingpp connect applications can charge an additional fee on top of Pingpp's fees for charges they make on behalf of 
their users. To do this you need to specify an additional `transactionFee` parameter as part of an authorize or purchase
request.

When a charge is refunded the transaction fee is refunded with an amount proportional to the amount of the charge
refunded and by default this will come from your connected user's Pingpp account effectively leaving them out of pocket.
To refund from your (the applications) Pingpp account instead you can pass a ``refundApplicationFee`` parameter with a
boolean value of true as part of a refund request.

Note: making requests with Pingpp Connect specific parameters can only be made using the OAuth access token you received
as part of the authorization process. Read more on Pingpp Connect [here](https://Pingpp.com/docs/connect).

## Test Mode

Pingpp accounts have test-mode API keys as well as live-mode API keys. These keys can be active
at the same time. Data created with test-mode credentials will never hit the credit card networks
and will never cost anyone money.

Unlike some gateways, there is no test mode endpoint separate to the live mode endpoint, the
Pingpp API endpoint is the same for test and for live.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release announcements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/thephpleague/omnipay-Pingpp/issues),
or better yet, fork the library and submit a pull request.
