<?php

/**
 * Pingpp Cancel Batch Transfer Request.
 */
namespace Omnipay\Pingpp\Message;

/**
 * Pingpp Cancel Batch Transfer Request.
 *
 * @link https://www.pingxx.com/api#更新批量企业付款（银行卡）-batch-transfer-对象
 * @package Omnipay\Pingpp\Message
 */
class CancelBatchTransferRequest extends AbstractRequest
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
        return 'POST';
    }
}
