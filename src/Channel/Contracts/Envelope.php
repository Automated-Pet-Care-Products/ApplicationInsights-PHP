<?php
/** @noinspection PhpUnused */

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

use DateTimeInterface;

/**
 * Data contract class for type Envelope. System variables for a telemetry item.
 */
class Envelope extends Base_Data
{
    /**
     * Creates a new Envelope.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_data->put('ver', 1);
        $this->_data->put('name', null);
        $this->_data->put('time', null);
        $this->_data->put('sampleRate', 100.0);
    }

    /**
     * Sets the time field.
     * Event date time when telemetry item was created.
     * This is the wall clock time on the client when the event was generated.
     * There is no guarantee that the client's time is accurate.
     * This field must be formatted in UTC ISO 8601 format, with a trailing 'Z' character,
     * as described publicly on https://en.wikipedia.org/wiki/ISO_8601#UTC. Note:
     * the number of decimal seconds digits provided is variable (and unspecified).
     * Consumers should handle this,
     * i.e., managed code consumers should not use format 'O' for parsing as it specifies a fixed length.
     * Example: 2009-06-15T13:45:30.0000000Z.
     */
    public function setTime(DateTimeInterface $time): void
    {
        $this->_data->put('time', $time->format(Utils::T_DATETIME_FORMAT));
    }

    /**
     * Gets the sampleRate field.
     * Sampling rate used in application.
     * This telemetry item represents 1 / sampleRate actual telemetry items.
     */
    public function getSampleRate(): ?float
    {
        if ($this->_data->hasKey('sampleRate')) {
            return (float)$this->_data['sampleRate'];
        }
        return null;
    }

    /**
     * Sets the sampleRate field.
     * Sampling rate used in application.
     * This telemetry item represents 1 / sampleRate actual telemetry items.
     */
    public function setSampleRate(float $sampleRate): void
    {
        $this->_data->put('sampleRate', $sampleRate);
    }

    /**
     * Gets the seq field. Sequence field is used to track the absolute order of uploaded events.
     */
    public function getSeq()
    {
        if ($this->_data->hasKey('seq')) {
            return $this->_data->get('seq');
        }
        return null;
    }

    /**
     * Sets the seq field. Sequence field is used to track the absolute order of uploaded events.
     */
    public function setSeq(mixed $seq): void
    {
        $this->_data->put('seq', $seq);
    }

    /**
     * Gets the iKey field.
     * The application's instrumentation key.
     * The key is typically represented as a GUID, but there are cases when it is not a guid.
     * No code should rely on iKey being a GUID.
     * Instrumentation key is case-insensitive.
     */
    public function getInstrumentationKey(): ?string
    {
        if ($this->_data->hasKey('iKey')) {
            return $this->_data->get('iKey');
        }
        return null;
    }

    /**
     * Sets the iKey field.
     * The application's instrumentation key.
     * The key is typically represented as a GUID, but there are cases when it is not a guid.
     * No code should rely on iKey being a GUID.
     * Instrumentation key is case-insensitive.
     */
    public function setInstrumentationKey($iKey): void
    {
        $this->_data->put('iKey', $iKey);
    }

    /**
     * Gets the tag field.
     * Key/value collection of context properties.
     * See ContextTagKeys for information on available properties.
     */
    public function getTags()
    {
        if ($this->_data->hasKey('tags')) {
            return $this->_data->get('tags');
        }
        return null;
    }

    /**
     * Sets the tag field.
     * Key/value collection of context properties.
     * See ContextTagKeys for information on available properties.
     */
    public function setTags($tags): void
    {
        $this->_data->put('tags', $tags);
    }

    /**
     * Gets the data field. Telemetry data item.
     */
    public function getData()
    {
        if ($this->_data->hasKey('data')) {
            return $this->_data->get('data');
        }
        return null;
    }

    /**
     * Sets the data field. Telemetry data item.
     */
    public function setData($data): void
    {
        $this->_data->put('data', $data);
    }
}
