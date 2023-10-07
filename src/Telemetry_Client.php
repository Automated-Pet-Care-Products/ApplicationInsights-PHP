<?php

declare(strict_types=1);

namespace ApplicationInsights;

use ApplicationInsights\Channel\Contracts\Data_Point_Type;
use ApplicationInsights\Channel\Contracts\Request_Data;
use ApplicationInsights\Channel\Contracts\Utils;
use ApplicationInsights\Channel\Telemetry_Channel;
use DateTime;
use DateTimeInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/**
 * The main object used for interacting with the Application Insights service.
 */
class Telemetry_Client
{
    /**
     * Initializes a new Telemetry_Client.
     */
    public function __construct(
        private ?Telemetry_Context $_context = null,
        private ?Channel\Telemetry_Channel $_channel = null
    ) {
    }

    /**
     * Returns the Telemetry_Context this Telemetry_Client is using.
     */
    public function getContext(): Telemetry_Context
    {
        return $this->_context ??= new Telemetry_Context();
    }

    /**
     * Sends a Page_View_Data to the Application Insights service.
     * @param string $name The friendly name of the page view.
     * @param string $url The url of the page view.
     * @param int $duration duration The duration in milliseconds of the page view.
     * @param array|null $properties An array of name-to-value pairs. Use the name as the index and any string as the value.
     * @param array|null $measurements An array of name to double pairs. Use the name as the index and any double as the value.
     */
    public function trackPageView(
        string $name,
        string $url,
        int $duration = 0,
        ?array $properties = null,
        ?array $measurements = null
    ): void {
        $data = new Channel\Contracts\Page_View_Data();
        $data->setName($name);
        $data->setUrl($url);
        $data->setDuration(Channel\Contracts\Utils::convertMillisecondsToTimeSpan($duration));
        if ($properties != null) {
            $data->setProperties($properties);
        }
        if ($measurements != null) {
            $data->setMeasurements($measurements);
        }

        $this->_channel->addToQueue($data, $this->_context);
    }

    /**
     * Sends a Metric_Data to the Application Insights service.
     * @param string $name Name of the metric.
     * @param double $value Value of the metric.
     * @param int $type The type of value being sent. Found: \ApplicationInsights\Channel\Contracts\Data_Point_Type::Value
     * @param int $count The number of samples.
     * @param float $min The minimum of the samples.
     * @param float $max The maximum of the samples.
     * @param float $stdDev The standard deviation of the samples.
     * @param array $properties An array of name-to-value pairs. Use the name as the index and any string as the value.
     */
    public function trackMetric(
        string $name,
        float $value,
        int $type = Data_Point_Type::Aggregation,
        int $count = 0,
        float $min = 0,
        float $max = 0,
        float $stdDev = 0,
        array $properties = []
    ): void {
        $dataPoint = new Channel\Contracts\Data_Point();
        $dataPoint->setName($name);
        $dataPoint->setValue($value);
        $dataPoint->setKind($type);
        $dataPoint->setCount($count);
        $dataPoint->setMin($min);
        $dataPoint->setMax($max);
        $dataPoint->setStdDev($stdDev);

        $data = new Channel\Contracts\Metric_Data();
        $data->setMetrics([$dataPoint]);
        if ($properties != null) {
            $data->setProperties($properties);
        }

        $this->_channel->addToQueue($data, $this->_context);
    }

    /**
     * Sends an Event_Data to the Application Insights service.
     * @param array|null $properties An array of name-to-value pairs. Use the name as the index and any string as the value.
     * @param array|null $measurements An array of name to double pairs. Use the name as the index and any double as the value.
     */
    public function trackEvent(string $name, array $properties = null, array $measurements = null): void
    {
        $data = new Channel\Contracts\Event_Data();
        $data->setName($name);
        if ($properties != null) {
            $data->setProperties($properties);
        }
        if ($measurements != null) {
            $data->setMeasurements($measurements);
        }

        $this->_channel->addToQueue($data, $this->_context);
    }

    /**
     * Sends a Message_Data to the Application Insights service.
     * @param string $message The trace message.
     * @param int|null $severityLevel The severity level of the message. Found: \ApplicationInsights\Channel\Contracts\Message_Severity_Level::Value
     * @param array|null $properties An array of name-to-value pairs. Use the name as the index and any string as the value.
     */
    public function trackMessage(string $message, int $severityLevel = null, array $properties = null): void
    {
        $data = new Channel\Contracts\Message_Data();
        $data->setMessage($message);
        $data->setSeverityLevel($severityLevel);

        if ($properties != null) {
            $data->setProperties($properties);
        }

        $this->_channel->addToQueue($data, $this->_context);
    }

    public function trackRequest(
        string $name,
        string $url,
        DateTimeInterface $startTime,
        int $durationInMilliseconds = 0,
        int $httpResponseCode = 200,
        bool $isSuccessful = true,
        ?array $properties = null,
        ?array $measurements = null
    ): void {
        $this->endRequest(
            $this->beginRequest($name, $url, $startTime),
            $durationInMilliseconds,
            $httpResponseCode,
            $isSuccessful,
            $properties,
            $measurements
        );
    }

    public function endRequest(
        Channel\Contracts\Request_Data $request,
        int $durationInMilliseconds = 0,
        int $httpResponseCode = 200,
        bool $isSuccessful = true,
        ?array $properties = null,
        ?array $measurements = null
    ): void {
        $request->setResponseCode($httpResponseCode);
        $request->setSuccess($isSuccessful);
        $request->setDuration(Channel\Contracts\Utils::convertMillisecondsToTimeSpan($durationInMilliseconds));

        if ($properties) {
            $request->setProperties($properties);
        }

        if ($measurements) {
            $request->setMeasurements($measurements);
        }

        $this->_channel->addToQueue($request, $this->_context);
    }

    public function beginRequest(string $name, string $url, ?DateTimeInterface $startTime = null): Request_Data
    {
        $data = new Channel\Contracts\Request_Data();
        $guid = Utils::returnGuid();
        $data->setId($guid);
        $data->setName($name);
        $data->setUrl($url);
        $data->setTime($startTime ?? new DateTime());

        return $data;
    }

    /**
     * Sends an Exception_Data to the Application Insights service.
     */
    public function trackException(Throwable $ex, array $properties = null, array $measurements = null): void
    {
        $details = new Channel\Contracts\Exception_Details();
        $details->setId(1);
        $details->setOuterId(0);
        $details->setTypeName(get_class($ex));
        $details->setMessage($ex->getMessage() . ' in ' . $ex->getFile() . ' on line ' . $ex->getLine());
        $details->setHasFullStack(true);

        $stackFrames = [];

        // The First stack frame is in the root exception
        $frameCounter = 0;
        foreach ($ex->getTrace() as $currentFrame) {
            $stackFrame = new Channel\Contracts\Stack_Frame();
            if (array_key_exists('class', $currentFrame)) {
                $stackFrame->setAssembly($currentFrame['class']);
            }
            if (array_key_exists('file', $currentFrame)) {
                $stackFrame->setFileName($currentFrame['file']);
            }
            if (array_key_exists('line', $currentFrame)) {
                $stackFrame->setLine($currentFrame['line']);
            }
            if (array_key_exists('function', $currentFrame)) {
                $stackFrame->setMethod($currentFrame['function']);
            }

            // Make it a string to force serialization of zero
            $stackFrame->setLevel('' . $frameCounter);

            array_unshift($stackFrames, $stackFrame);
            $frameCounter++;
        }

        $details->setParsedStack($stackFrames);

        $data = new Channel\Contracts\Exception_Data();
        $data->setExceptions([$details]);

        if ($properties != null) {
            $data->setProperties($properties);
        }

        if ($measurements != null) {
            $data->setMeasurements($measurements);
        }

        $this->_channel->addToQueue($data, $this->_context);
    }

    /**
     * Sends a Dependency_Data to the Application Insights service.
     * @param string $name Name of the dependency.
     * @param string $type The Dependency type of value being sent.
     * @param string|null $commandName Command/Method of the dependency.
     * @param DateTimeInterface|null $startTime The timestamp at which the request started.
     * @param int $durationInMilliseconds The duration, in milliseconds, of the request.
     * @param bool $isSuccessful Whether the request was successful.
     * @param int|null $resultCode The result code of the request.
     * @param array|null $properties An array of name-to-value pairs. Use the name as the index and any string as the value.
     */
    public function trackDependency(
        string $name,
        string $type = '',
        string $commandName = null,
        DateTimeInterface $startTime = null,
        int $durationInMilliseconds = 0,
        bool $isSuccessful = true,
        int $resultCode = null,
        array $properties = null
    ): void {
        $data = new Channel\Contracts\Dependency_Data();
        $data->setName($name);
        $data->setType($type);
        $data->setData($commandName);
        $data->setDuration(Channel\Contracts\Utils::convertMillisecondsToTimeSpan($durationInMilliseconds));
        $data->setSuccess($isSuccessful);
        $data->setResultCode($resultCode);

        if ($properties != null) {
            $data->setProperties($properties);
        }

        $this->_channel->addToQueue($data, $this->_context, $startTime);
    }

    /**
     * Flushes the underlying Telemetry_Channel queue.
     * @throws ClientExceptionInterface
     */
    public function flush(): ResponseInterface
    {
        $channel = $this->getChannel();
        $request = $channel->getRequest();

        $channel->flush();
        return $this->getChannel()->getClient()->sendRequest($request);
    }

    /**
     * Returns the Telemetry_Channel this Telemetry_Client is using.
     */
    public function getChannel(): Telemetry_Channel
    {
        return $this->_channel ??= new Telemetry_Channel();
    }
}
