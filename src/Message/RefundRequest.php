<?php

/**
 * Pingpp Refund Request.
 */
namespace Omnipay\Pingpp\Message;

/**
 * Pingpp Refund Request.
 *
 * @see     https://www.pingxx.com/api#创建-refund-对象
 * @package Omnipay\Pingpp\Message
 */
class RefundRequest extends AbstractRequest
{
    /**
     * @return mixed
     */
    public function getFundingSource()
    {
        return $this->getParameter('fundingSource');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setFundingSource($value)
    {
        return $this->setParameter('fundingSource', $value);
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('transactionReference', 'amount', 'description');

        $data = array();
        $data['amount'] = $this->getAmountInteger();
        $data['metadata'] = $this->getMetadata();
        $data['description'] = $this->getDescription();
        if ($this->getFundingSource()) {
            $data['funding_source'] = $this->getFundingSource();
        }

        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint.'/charges/'.$this->getTransactionReference().'/refunds';
    }
}
