<?php

/**
 * Pingpp Response.
 */
namespace Omnipay\Pingpp\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Pingpp Response.
 *
 * This is the response class for all Pingpp requests.
 */
class Response extends AbstractResponse
{
    /**
     * Request id.
     *
     * @var string URL
     */
    protected $requestId = null;

    /**
     * Is the transaction successful?
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return !isset($this->data['error']);
    }

    /**
     * Get the transaction reference.
     *
     * @return string|null
     */
    public function getTransactionReference()
    {
        if (isset($this->data['object']) && 'charge' === $this->data['object']) {
            return $this->data['id'];
        }

        if (isset($this->data['object']) && 'red_envelope' === $this->data['object']) {
            return $this->data['id'];
        }

        if (isset($this->data['object']) && 'transfer' === $this->data['object']) {
            return $this->data['id'];
        }

        if (isset($this->data['error']) && isset($this->data['error']['charge'])) {
            return $this->data['error']['charge'];
        }

        return null;
    }

    /**
     * Get the event reference.
     *
     * @return string|null
     */
    public function getEventReference()
    {
        if (isset($this->data['object']) && $this->data['object'] == 'event') {
            return $this->data['id'];
        }

        return null;
    }

    /**
     * Get the error message from the response.
     *
     * Returns null if the request was successful.
     *
     * @return string|null
     */
    public function getMessage()
    {
        if (!$this->isSuccessful()) {
            return $this->data['error']['message'];
        }

        return null;
    }

    /**
     * Get the error code from the response.
     *
     * Returns null if the request was successful.
     *
     * @return string|null
     */
    public function getCode()
    {
        if (!$this->isSuccessful()) {
            return $this->data['error']['code'];
        }

        return null;
    }
}
