<?php

/**
 * Pingpp Abstract Request.
 */
namespace Omnipay\Pingpp\Message;
use Guzzle\Common\Event;
use Omnipay\Common\Message\RequestInterface;

/**
 * Pingpp AbstractRequest.
 *
 * This is the parent class for all Pingpp requests.
 *
 * @see    \Omnipay\Pingpp\Gateway
 * @link   https://www.pingxx.com/api
 * @method \Omnipay\Pingpp\Message\Response send()
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * Live or Test Endpoint URL.
     *
     * @var string URL
     */
    protected $endpoint = 'https://api.pingxx.com/v1';

    /**
     * Get the gateway API Key.
     *
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     * Set the gateway API Key.
     *
     * @param  $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * Get the RSA private key.
     *
     * @return mixed
     */
    public function getPrivateKey()
    {
        return $this->getParameter('privateKey');
    }

    /**
     * Set the RSA private key.
     *
     * @param  $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setPrivateKey($value)
    {
        return $this->setParameter('privateKey', $value);
    }

    /**
     * Get APP ID in Ping++.
     *
     * Prefixed by "app_".
     *
     * @return mixed
     */
    public function getAppId()
    {
        return $this->getParameter('appId');
    }

    /**
     * Set APP ID in Ping++.
     *
     * @param  $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setAppId($value)
    {
        return $this->setParameter('appId', $value);
    }

    /**
     * Get metadata.
     *
     * @return mixed
     */
    public function getMetadata()
    {
        return $this->getParameter('metadata');
    }

    /**
     * Set metadata.
     *
     * @param  $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setMetadata($value)
    {
        return $this->setParameter('metadata', $value);
    }

    /**
     * @return mixed
     */
    abstract public function getEndpoint();

    /**
     * Get HTTP Method.
     *
     * @return string
     */
    public function getHttpMethod()
    {
        return 'POST';
    }

    /**
     * Get HTTP headers.
     *
     * @return array
     */
    public function getHeaders()
    {
        return array(
            'Authorization' => 'Basic '.base64_encode($this->getApiKey().':'),
            'Content-Type' => 'application/json;charset=UTF-8',
        );
    }

    /**
     * Get send data.
     *
     * @param  mixed $data
     * @return Response
     * @throws \Exception
     */
    public function sendData($data)
    {
        $headers = $this->getHeaders();
        $privateKey = $this->getPrivateKey();
        if (in_array(strtolower($this->getHttpMethod()), ['post', 'put']) && !empty($privateKey)) {
            $requestSignature = null;
            $signResult = openssl_sign(json_encode($data), $requestSignature, $privateKey, 'sha256');
            if (!$signResult) {
                throw new \Exception('Signature generation failed');
            }

            if ($requestSignature) {
                $headers['Pingplusplus-Signature'] = base64_encode($requestSignature);
            }
        }

        $config = $this->httpClient->getConfig();
        $config->set('curl.options', $config->get('curl.options'));
        $this->httpClient->setConfig($config);

        // don't throw exceptions for 4xx errors
        $this->httpClient->getEventDispatcher()->addListener(
            'request.error',
            function (Event $event) {
                /**
                 * @var \Omnipay\Pingpp\Message\Response $response
                 */
                $response = $event['response'];
                if ($response->isClientError()) {
                    $event->stopPropagation();
                }
            }
        );

        /**
         * @var RequestInterface $httpRequest
         */
        $body = (strtolower($this->getHttpMethod()) == 'get') ? null : json_encode($data);
        $httpRequest = $this->httpClient->createRequest(
            $this->getHttpMethod(),
            $this->getEndpoint(),
            $headers,
            $body
        );

        /**
         * @var Response $httpResponse
         */
        $httpResponse = $httpRequest->send();
        
        $this->response = new Response($this, $httpResponse->json());

        return $this->response;
    }
}
