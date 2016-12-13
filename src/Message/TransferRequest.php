<?php

/**
 * Pingpp Transfer Request.
 */
namespace Omnipay\Pingpp\Message;

/**
 * Pingpp Transfer Request.
 *
 * @package Omnipay\Pingpp\Message
 */
class TransferRequest extends AbstractRequest
{
    /**
     * @return mixed
     */
    public function getChannel()
    {
        return $this->getParameter('channel');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setChannel($value)
    {
        return $this->setParameter('channel', $value);
    }

    /**
     * @return mixed
     */
    public function getReceiver()
    {
        return $this->getParameter('receiver');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setReceiver($value)
    {
        return $this->setParameter('receiver', $value);
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->getParameter('type');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setType($value)
    {
        return $this->setParameter('type', $value);
    }


    /**
     * @link https://www.pingxx.com/api#企业付款-extra-参数说明
     * @return mixed
     */
    public function getChannelExtraFields()
    {
        return $this->getParameter('channelExtraFields');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setChannelExtraFields($value)
    {
        return $this->setParameter('channelExtraFields', $value);
    }

    /**
     * Get request data.
     *
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('transactionId', 'appId', 'channel', 'amount', 'currency', 'description', 'type');

        $data = array();

        $data['app'] = array('id' => $this->getAppId());
        $data['channel'] = $this->getChannel();
        $data['extra'] = $this->getChannelExtraFields();
        $data['order_no'] = $this->getTransactionId();
        $data['amount'] = $this->getAmountInteger();
        $data['currency'] = strtolower($this->getCurrency());
        $data['description'] = $this->getDescription();
        $data['type'] = $this->getType();
        $data['recipient'] = $this->getReceiver();

        if ($this->getMetadata()) {
            $data['metadata'] = $this->getMetadata();
        }

        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint.'/transfers';
    }
}
