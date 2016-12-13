<?php

namespace Omnipay\Pingpp;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase(array('amount' => '10.00'));

        $this->assertInstanceOf(\Omnipay\Pingpp\Message\PurchaseRequest::class, $request);
        $this->assertSame('10.00', $request->getAmount());
    }

    public function testRefund()
    {
        $request = $this->gateway->refund(array('amount' => '10.00'));

        $this->assertInstanceOf(\Omnipay\Pingpp\Message\RefundRequest::class, $request);
        $this->assertSame('10.00', $request->getAmount());
    }

    public function testFetchTransaction()
    {
        $request = $this->gateway->fetchTransaction(array());

        $this->assertInstanceOf(\Omnipay\Pingpp\Message\FetchTransactionRequest::class, $request);
    }
}
