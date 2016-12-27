<?php

/**
 * Pingpp Gateway.
 */
namespace Omnipay\Pingpp;

use Omnipay\Common\AbstractGateway;

/**
 * Pingpp Gateway
 *
 * Alias:
 *
 * Pingpp (also known as Ping++, PingPlusPlus, Pingxx)
 * https://www.pingxx.com/
 *
 * Test modes:
 *
 * Pingpp accounts have test-mode and live-mode API keys separately, which has the exactly same API endpoint.
 * Test mode is distinguished from API key prefixed by "sk_test_", and "sk_live_" for live mode.
 * No real cost will be charged when using test API key.
 *
 * Authentication:
 *
 * Authentication is by means of a single secret API key set as
 * the apiKey parameter when creating the gateway object.
 *
 * Private Key:
 *
 * Private key is an optional parameter in order for Ping++ to determine if a request
 * is really from your server as a safety strategy, while private key is set,
 * an item called "Pingplusplus-Signature" would be appended to POST/PUT request headers.
 * It'd only take effect when you enable this option in Ping++ dashboard.
 * How to generate rsa public/private key pairs: https://help.pingxx.com/article/123161
 * How to configure your rsa public key on dashboard: https://help.pingxx.com/article/152108
 *
 * @package Omnipay\Pingpp
 * @link https://www.pingxx.com/api
 */
class Gateway extends AbstractGateway
{
    /**
     * Get the gateway name.
     *
     * @return string
     */
    public function getName()
    {
        return 'Pingpp';
    }

    /**
     * Get the gateway default parameters.
     *
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            'apiKey' => '',
            'privateKey' => '',
        );
    }

    /**
     * Get the gateway API key.
     *
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     * Set the gateway API key.
     *
     * @param $value
     * @return $this
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * Get the RSA private key
     *
     * @return mixed
     */
    public function getPrivateKey()
    {
        return $this->getParameter('privateKey');
    }

    /**
     * Set the RSA private key
     *
     * @param $value
     * @return $this
     */
    public function setPrivateKey($value)
    {
        return $this->setParameter('privateKey', $value);
    }

    /**
     * Purchase Request.
     *
     * To charge your payment channel, you create a new charge object. If your API key
     * is in test mode, the payment channel won't actually be charged, though
     * everything else will occur is if in live mode.
     *
     * Different payment channels require different channel extra fields,
     * which list can be found: https://www.pingxx.com/api?language=PHP#支付渠道-extra-参数说明
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest(\Omnipay\Pingpp\Message\PurchaseRequest::class, $parameters);
    }

    /**
     * Refund Request.
     *
     * When you create a new refund, you must specify a
     * charge to create it on.
     *
     * Creating a new refund will refund a charge that has
     * previously been paid but not yet fully refunded. Funds will
     * be refunded to the payment channel accounts that was originally
     * charged from. The fees you were originally charged will be refunded
     * depend upon your payment channel.
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function refund(array $parameters = array())
    {
        return $this->createRequest(\Omnipay\Pingpp\Message\RefundRequest::class, $parameters);
    }

    /**
     * Fetch Transaction Request.
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function fetchTransaction(array $parameters = array())
    {
        return $this->createRequest(\Omnipay\Pingpp\Message\FetchTransactionRequest::class, $parameters);
    }

    /**
     * Fetch Transaction List Request.
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function fetchTransactionList(array $parameters = array())
    {
        return $this->createRequest(\Omnipay\Pingpp\Message\FetchTransactionListRequest::class, $parameters);
    }

    /**
     * Fetch Refund Request.
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function fetchRefund(array $parameters = array())
    {
        return $this->createRequest(\Omnipay\Pingpp\Message\FetchRefundRequest::class, $parameters);
    }

    /**
     * Fetch Refund List Request.
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function fetchRefundList(array $parameters = array())
    {
        return $this->createRequest(\Omnipay\Pingpp\Message\FetchRefundListRequest::class, $parameters);
    }

    /**
     * Batch Refund Request.
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function batchRefund(array $parameters = array())
    {
        return $this->createRequest(\Omnipay\Pingpp\Message\BatchRefundRequest::class, $parameters);
    }

    /**
     * Fetch Batch Refund Request.
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function fetchBatchRefund(array $parameters = array())
    {
        return $this->createRequest(\Omnipay\Pingpp\Message\FetchBatchRefundRequest::class, $parameters);
    }

    /**
     * Fetch Batch Refund List Request.
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function fetchBatchRefundList(array $parameters = array())
    {
        return $this->createRequest(\Omnipay\Pingpp\Message\FetchBatchRefundListRequest::class, $parameters);
    }

    /**
     * Red Envelope Request.
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function redEnvelope(array $parameters = array())
    {
        return $this->createRequest(\Omnipay\Pingpp\Message\RedEnvelopeRequest::class, $parameters);
    }

    /**
     * Fetch Red Envelope Request.
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function fetchRedEnvelope(array $parameters = array())
    {
        return $this->createRequest(\Omnipay\Pingpp\Message\FetchRedEnvelopeRequest::class, $parameters);
    }

    /**
     * Fetch Red Envelope List Request.
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function fetchRedEnvelopeList(array $parameters = array())
    {
        return $this->createRequest(\Omnipay\Pingpp\Message\FetchRedEnvelopeListRequest::class, $parameters);
    }


    /**
     * Transfer Request.
     *
     * To make a transfer, you create a new transfer object. If your API key
     * is in test mode, the real transaction won't actually be transferrd.
     *
     * Different payment channels require different channel extra fields,
     * which list can be found: https://www.pingxx.com/api#企业付款-extra-参数说明
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function transfer(array $parameters = array())
    {
        return $this->createRequest(\Omnipay\Pingpp\Message\TransferRequest::class, $parameters);
    }

    /**
     * Fetch Transfer Request.
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function fetchTransfer(array $parameters = array())
    {
        return $this->createRequest(\Omnipay\Pingpp\Message\FetchTransferRequest::class, $parameters);
    }

    /**
     * Fetch Transfer List Request.
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function fetchTransferList(array $parameters = array())
    {
        return $this->createRequest(\Omnipay\Pingpp\Message\FetchTransferListRequest::class, $parameters);
    }

    /**
     * Cancel Transfer Request.
     *
     * Currently only "unionpay" channel is supported
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function cancelTransfer(array $parameters = array())
    {
        return $this->createRequest(\Omnipay\Pingpp\Message\CancelTransferRequest::class, $parameters);
    }


    /**
     * Batch Transfer Request.
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function batchTransfer(array $parameters = array())
    {
        return $this->createRequest(\Omnipay\Pingpp\Message\BatchTransferRequest::class, $parameters);
    }

    /**
     * Fetch Batch Transfer Request.
     *
     * @param array $parameters
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function fetchBatchTransfer(array $parameters = array())
    {
        return $this->createRequest(\Omnipay\Pingpp\Message\FetchBatchTransferRequest::class, $parameters);
    }

}
