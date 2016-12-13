<?php
/**
 * Pingpp Fetch Transaction Request.
 */
namespace Omnipay\Pingpp\Message;

/**
 * Pingpp Fetch Transaction Request.
 *
 * @see https://www.pingxx.com/api#查询-charge-对象
 */
class FetchTransactionRequest extends AbstractRequest
{
    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('transactionReference');

        $data = array();

        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint.'/charges/'.$this->getTransactionReference();
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return 'GET';
    }
}
