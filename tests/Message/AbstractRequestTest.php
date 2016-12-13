<?php

namespace Omnipay\Pingpp\Message;

use Mockery;
use Omnipay\Tests\TestCase;

class AbstractRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = Mockery::mock(\Omnipay\Pingpp\Message\AbstractRequest::class)->makePartial();
        $this->request->initialize();
    }

    public function testApiKey()
    {
        $this->assertSame($this->request, $this->request->setApiKey(PINGPP_SK_TEST_KEY));
        $this->assertSame(PINGPP_SK_TEST_KEY, $this->request->getApiKey());
    }

    public function testPrivateKey()
    {
        $this->assertSame($this->request, $this->request->setPrivateKey(file_get_contents(PINGPP_RSA_PRIVATE_KEY)));
        $this->assertSame(file_get_contents(PINGPP_RSA_PRIVATE_KEY), $this->request->getPrivateKey());
    }

    public function testAppId()
    {
        $this->assertSame($this->request, $this->request->setAppId(PINGPP_APP_ID));
        $this->assertSame(PINGPP_APP_ID, $this->request->getAppId());
    }

    public function testMetadata()
    {
        $this->assertSame($this->request, $this->request->setMetadata(array('foo' => 'bar')));
        $this->assertSame(array('foo' => 'bar'), $this->request->getMetadata());
    }
}
