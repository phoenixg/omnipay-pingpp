<?php
/**
 * Pingpp Reverse Transaction Request.
 */
namespace Omnipay\Pingpp\Message;

/**
 * Pingpp Reverse Transaction Request.
 */
class ReverseTransactionRequest extends AbstractRequest
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
        return $this->endpoint.'/charges/'.$this->getTransactionReference().'/reverse';
    }

}
