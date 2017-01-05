<?php

namespace Omnipay\Pingpp\Message;

use Omnipay\Tests\TestCase;

class FetchEventRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new FetchEventRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setEventReference('evt_lqVSy5gbL0A68pS8YKvJzdWZ');
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.pingxx.com/v1/events/evt_lqVSy5gbL0A68pS8YKvJzdWZ', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
         $this->setMockHttpResponse('FetchEventSuccess.txt');
         $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getMessage());
    }
}
