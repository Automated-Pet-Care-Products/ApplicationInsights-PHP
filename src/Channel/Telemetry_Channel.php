<?php
/** @noinspection PhpUnused */

declare(strict_types=1);

namespace ApplicationInsights\Channel;

use ApplicationInsights\Channel\Contracts\Data_Interface;
use ApplicationInsights\Channel\Contracts\Utils;
use ApplicationInsights\Telemetry_Context;
use DateTimeInterface;
use Ds\Collection;
use Ds\Queue;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;

/**
 * Responsible for managing a queue of telemetry items to send and sending them.
 */
class Telemetry_Channel
{
    public const STR_TRACK_URL = 'https://dc.services.visualstudio.com/v2/track';

    /**
     * The queue of already serialized JSON objects to send.
     */
    protected Collection $_queue;

    /**
     * If true, then the data will be gzipped before sending to application insights.
     */
    protected bool $_sendGzipped;

    protected UriFactoryInterface     $uriFactory;
    protected StreamFactoryInterface  $streamFactory;
    protected RequestFactoryInterface $requestFactory;

    public function __construct(
        protected ?ClientInterface $_client = null,
        protected string $_endpointUrl = self::STR_TRACK_URL
    ) {
        $this->_sendGzipped = false;
    }

    /**
     * Returns the current URL this TelemetrySender will send to.
     */
    public function getEndpointUrl(): string
    {
        return $this->_endpointUrl;
    }

    /**
     * Sets the current URL this TelemetrySender will send to.
     */
    public function setEndpointUrl(string $endpointUrl): void
    {
        $this->_endpointUrl = $endpointUrl;
    }

    /**
     * Returns the current queue.
     */
    public function getQueue(): Queue
    {
        return $this->_queue ??= new Queue();
    }

    /**
     * Sets the current queue.
     */
    public function flush(): void
    {
        $this->getQueue()->clear();
    }

    public function getClient(): ClientInterface
    {
        return $this->_client;
    }

    public function setClient(ClientInterface $client): void
    {
        $this->_client = $client;
    }

    public function getSerializedQueue(): string
    {
        return json_encode(Utils::removeEmptyValues(Utils::getUnderlyingData($this->getQueue()->toArray())));
    }

    public function getSendGzipped(): bool
    {
        return $this->_sendGzipped;
    }

    public function setSendGzipped(bool $sendGzipped): void
    {
        $this->_sendGzipped = $sendGzipped;
    }

    public function addToQueue(
        Data_Interface $data,
        Telemetry_Context $telemetryContext,
        ?DateTimeInterface $startTime = null
    ): void {
        $envelope = new Contracts\Envelope();

        // Main envelope properties
        $envelope->setName($data->getEnvelopeTypeName());
        $startTime ??= $data->getTime();

        $envelope->setTime($startTime);

        // The instrumentation key to use
        $envelope->setInstrumentationKey($telemetryContext->getInstrumentationKey());

        // Copy all context into the Tags array
        $envelope->setTags(
            array_merge(
                $telemetryContext->getApplicationContext()->jsonSerialize(),
                $telemetryContext->getDeviceContext()->jsonSerialize(),
                $telemetryContext->getCloudContext()->jsonSerialize(),
                $telemetryContext->getLocationContext()->jsonSerialize(),
                $telemetryContext->getOperationContext()->jsonSerialize(),
                $telemetryContext->getSessionContext()->jsonSerialize(),
                $telemetryContext->getUserContext()->jsonSerialize(),
                $telemetryContext->getInternalContext()->jsonSerialize()
            )
        );

        // Merge properties from global context to local context
        $contextProperties = $telemetryContext->getProperties();
        if (method_exists($data, 'getProperties') && count($contextProperties) > 0) {
            $dataProperties = $data->getProperties();
            if (is_iterable($dataProperties)) {
                $dataProperties = iterator_to_array($dataProperties);
            } elseif ($dataProperties == null) {
                $dataProperties = [];
            }
            foreach ($contextProperties as $key => $value) {
                if (!array_key_exists($key, $dataProperties)) {
                    $dataProperties[$key] = $value;
                }
            }
            $data->setProperties($dataProperties);
        }

        // Embed the main data object
        $envelope->setData(new Contracts\Data());
        $envelope->getData()->setBaseType($data->getDataTypeName());
        $envelope->getData()->setBaseData($data);

        $this->getQueue()->push($envelope);
    }

    public function getRequest(): RequestInterface
    {
        $serializedTelemetryItem = $this->getSerializedQueue();
        $currentEncoding = mb_detect_encoding($serializedTelemetryItem);
        $body            = mb_convert_encoding($serializedTelemetryItem, 'utf8', $currentEncoding);

        if ($this->getSendGzipped()) {
            $body = gzencode($serializedTelemetryItem);
        }

        $uri     = $this->getUriFactory()->createUri($this->getEndpointUrl());
        $request = $this->getRequestFactory()->createRequest('post', $uri);

        $request->withHeader('Accept', 'application/json');
        $request->withHeader('Content-Type', 'application/json; charset=utf-8');
        $this->getSendGzipped() && $request->withHeader('Content-Encoding', 'gzip');

        $request->withBody($this->getStreamFactory()->createStream($body));

        return $request;
    }

    public function getRequestFactory(): RequestFactoryInterface
    {
        return $this->requestFactory;
    }

    public function setRequestFactory(RequestFactoryInterface $requestFactory): void
    {
        $this->requestFactory = $requestFactory;
    }

    public function getStreamFactory(): StreamFactoryInterface
    {
        return $this->streamFactory;
    }

    public function setStreamFactory(StreamFactoryInterface $streamFactory): void
    {
        $this->streamFactory = $streamFactory;
    }

    public function getUriFactory(): UriFactoryInterface
    {
        return $this->uriFactory;
    }

    public function setUriFactory(UriFactoryInterface $uriFactory): void
    {
        $this->uriFactory = $uriFactory;
    }

    public function getEndpointUri(): UriInterface
    {
        return $this->getUriFactory()->createUri($this->getEndpointUrl());
    }
}
