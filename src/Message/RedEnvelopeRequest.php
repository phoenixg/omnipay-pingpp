<?php

/**
 * Pingpp Red Envelope Request.
 */
namespace Omnipay\Pingpp\Message;

use Omnipay\Pingpp\Common\Channels;

/**
 * Pingpp Red Envelope Request.
 *
 * @package Omnipay\Pingpp\Message
 */
class RedEnvelopeRequest extends AbstractRequest
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
    public function getSubject()
    {
        return $this->getParameter('subject');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setSubject($value)
    {
        return $this->setParameter('subject', $value);
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->getParameter('body');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setBody($value)
    {
        return $this->setParameter('body', $value);
    }

    /**
     * @return mixed
     */
    public function getSender()
    {
        return $this->getParameter('sender');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setSender($value)
    {
        return $this->setParameter('sender', $value);
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
     * Get request data.
     *
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate( 'appId', 'transactionId', 'channel', 'amount', 'currency', 'subject', 'body', 'sender', 'receiver' );

        $data = array();
        $data['app'] = array('id' => $this->getAppId());
        $data['order_no'] = $this->getTransactionId();
        $data['channel'] = $this->getChannel();
        $data['subject'] = $this->getSubject();
        $data['body'] = $this->getBody();
        if ($this->getDescription()) {
            $data['description'] = $this->getDescription();
        }
        $data['amount'] = $this->getAmountInteger();
        $data['currency'] = strtolower($this->getCurrency());
        $data['extra'] = array();
        $data['extra']['send_name'] = $this->getSender();
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
        return $this->endpoint.'/red_envelopes';
    }
}
