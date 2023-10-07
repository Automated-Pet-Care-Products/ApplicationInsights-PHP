<?php
/** @noinspection PhpUnused */

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

/**
 * Data contract class for type Request_Data.
 * An instance of Request represents completion of an external request to the application to do work
 * and contains a summary of that request execution and the results.
 */
class Request_Data extends Base_Data implements Data_Interface
{
    public const ID            = 'id';
    public const DURATION      = 'duration';
    public const RESPONSE_CODE = 'responseCode';
    public const SUCCESS       = 'success';
    public const SOURCE        = 'source';
    public const URL           = 'url';

    /**
     * Creates a new RequestData.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_envelopeTypeName = 'Microsoft.ApplicationInsights.Request';
        $this->_dataTypeName     = 'RequestData';
        $this->setVer(2);

        $this->_data->put(self::ID, null);
        $this->_data->put(self::DURATION, null);
        $this->_data->put(self::RESPONSE_CODE, null);
        $this->_data->put(self::SUCCESS, null);
    }

    /**
     * Gets the id field.
     * Identifier of a request call instance.
     * Used for correlation between request and other telemetry items.
     */
    public function getId(): ?int
    {
        if ($this->_data->hasKey(self::ID)) {
            return $this->_data->get(self::ID);
        }
        return null;
    }

    /**
     * Sets the id field.
     * Identifier of a request call instance.
     * Used for correlation between request and other telemetry items.
     */
    public function setId($id): void
    {
        $this->_data->put(self::ID, $id);
    }

    /**
     * Gets the source field.
     * Source of the request.
     * Examples are the instrumentation key of the caller or the ip address of the caller.
     */
    public function getSource(): ?string
    {
        if ($this->_data->hasKey(self::SOURCE)) {
            return $this->_data->get(self::SOURCE);
        }
        return null;
    }

    /**
     * Sets the source field.
     * Source of the request.
     * Examples are the instrumentation key of the caller or the ip address of the caller.
     */
    public function setSource(string $source): void
    {
        $this->_data->put(self::SOURCE, $source);
    }

    /**
     * Gets the duration field. Request duration in format: DD.HH:MM:SS.MMMMMM. Must be less than 1000 days.
     */
    public function getDuration(): ?string
    {
        if ($this->_data->hasKey(self::DURATION)) {
            return $this->_data->get(self::DURATION);
        }
        return null;
    }

    /**
     * Sets the duration field. Request duration in format: DD.HH:MM:SS.MMMMMM. Must be less than 1000 days.
     */
    public function setDuration(string $duration): void
    {
        $this->_data->put(self::DURATION, $duration);
    }

    /**
     * Gets the responseCode field. Result of a request execution. HTTP status code for HTTP requests.
     */
    public function getResponseCode(): ?int
    {
        if ($this->_data->hasKey(self::RESPONSE_CODE)) {
            return $this->_data->get(self::RESPONSE_CODE);
        }
        return null;
    }

    /**
     * Sets the responseCode field. Result of a request execution. HTTP status code for HTTP requests.
     */
    public function setResponseCode($responseCode): void
    {
        $this->_data->put(self::RESPONSE_CODE, $responseCode);
    }

    /**
     * Gets the success field. Indication of successful or unsuccessful call.
     */
    public function getSuccess(): bool
    {
        if ($this->_data->hasKey(self::SUCCESS)) {
            return (bool)$this->_data[self::SUCCESS];
        }
        return false;
    }

    /**
     * Sets the success field. Indication of successful or unsuccessful call.
     */
    public function setSuccess(bool $success): void
    {
        $this->_data->put(self::SUCCESS, $success);
    }

    /**
     * Gets the url field. Request URL with all query string parameters.
     */
    public function getUrl(): ?string
    {
        if ($this->_data->hasKey(self::URL)) {
            return $this->_data->get(self::URL);
        }
        return null;
    }

    /**
     * Sets the url field. Request URL with all query string parameters.
     */
    public function setUrl($url): void
    {
        $this->_data->put(self::URL, $url);
    }
}
