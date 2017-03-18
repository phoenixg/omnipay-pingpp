<?php

/**
 * Pingpp Cancel Transfer Request.
 */
namespace Omnipay\Pingpp\Message;

/**
 * Pingpp Cancel Transfer Request.
 *
 * @link    https://www.pingxx.com/api#更新-transfer对象
 * @package Omnipay\Pingpp\Message
 */
class CancelTransferRequest extends AbstractRequest
{
    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('transactionReference');

        $data = array();
        $data['id'] = $this->getTransactionReference();
        $data['status'] = 'canceled';

        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint.'/batch_transfers/'.$this->getTransactionReference();
    }

    public function getHttpMethod()
    {
        return 'PUT';
    }
}
