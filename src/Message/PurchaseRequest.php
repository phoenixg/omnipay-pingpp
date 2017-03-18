<?php

/**
 * Pingpp Purchase Request.
 */
namespace Omnipay\Pingpp\Message;

use Omnipay\Pingpp\Common\Channels;

/**
 * Pingpp Purchase Request.
 *
 * @package Omnipay\Pingpp\Message
 */
class PurchaseRequest extends AbstractRequest
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
     * @return mixed
     */
    public function getTimeExpire()
    {
        return $this->getParameter('time_expire');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setTimeExpire($value)
    {
        return $this->setParameter('time_expire', $value);
    }

    /**
     * @param $channel
     * @return array
     */
    private function _getChannelExtraUrls($channel)
    {
        $extraUrl = [];

        switch($channel) {
        case Channels::ALIPAY_WAP:
            $extraUrl['success_url'] = $this->getReturnUrl();
            if ($this->getCancelUrl()) {
                $extraUrl['cancel_url'] = $this->getCancelUrl();
            }
            break;
        case Channels::ALIPAY_PC_DIRECT:
            $extraUrl['success_url'] = $this->getReturnUrl();
            break;
        case Channels::BFB_WAP:
            $extraUrl['result_url'] = $this->getReturnUrl();
            break;
        case Channels::UPACP_WAP:
            $extraUrl['result_url'] = $this->getReturnUrl();
            break;
        case Channels::UPACP_PC:
            $extraUrl['result_url'] = $this->getReturnUrl();
            break;
        case Channels::WX_WAP:
            $extraUrl['result_url'] = $this->getReturnUrl();
            break;
        case Channels::YEEPAY_WAP:
            $extraUrl['result_url'] = $this->getReturnUrl();
            break;
        case Channels::JDPAY_WAP:
            $extraUrl['success_url'] = $this->getReturnUrl();
            break;
        case Channels::FQLPAY_WAP:
            if ($this->getReturnUrl()) {
                $extraUrl['return_url'] = $this->getReturnUrl();
            }
            break;
        case Channels::QGBC_WAP:
            if ($this->getReturnUrl()) {
                $extraUrl['return_url'] = $this->getReturnUrl();
            }
            break;
        case Channels::CMB_WALLET:
            $extraUrl['result_url'] = $this->getReturnUrl();
            break;
        default:
            break;
        }

        return $extraUrl;
    }

    /**
     * Get request data.
     *
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('transactionId', 'appId', 'channel', 'amount', 'clientIp', 'currency', 'subject', 'body');

        $data = array();
        $channel = $this->getChannel();
        $channelExtraUrls = $this->_getChannelExtraUrls($channel);
        $channelExtraFields = $this->getChannelExtraFields();
        $data['extra'] = array_merge($channelExtraFields, $channelExtraUrls);

        $data['order_no'] = $this->getTransactionId();
        $data['app'] = array('id' => $this->getAppId());
        $data['channel'] = $channel;
        $data['amount'] = $this->getAmountInteger();
        $data['client_ip'] = $this->getClientIp();
        $data['currency'] = strtolower($this->getCurrency());
        $data['subject'] = $this->getSubject();
        $data['body'] = $this->getBody();
        $data['time_expire'] = $this->getTimeExpire();
        $data['metadata'] = $this->getMetadata();
        if ($this->getDescription()) {
            $data['description'] = $this->getDescription();
        }

        return $data;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint.'/charges';
    }
}
