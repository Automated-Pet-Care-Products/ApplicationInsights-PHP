<?php

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

use ApplicationInsights\Traits\HasPropertiesTrait;
use DateTime;
use DateTimeInterface;
use Ds\Map;

/**
 * Data contract class for type Event_Data.
 */
abstract class Base_Data implements Data_Interface
{
    use Version_Manager;
    use HasPropertiesTrait;

    public const MEASUREMENTS = 'measurements';
    protected static string $_name = 'name';

    /**
     * Override for the time of the event
     */
    protected DateTimeInterface $_time;

    /**
     * Data array that will store all the values.
     */
    protected Map $_data;

    /**
     * Needed to properly construct the JSON envelope.
     */
    protected string $_envelopeTypeName;

    /**
     * Needed to properly construct the JSON envelope.
     */
    protected string $_dataTypeName;

    public function __construct()
    {
        $this->_time = new DateTime();
        $this->_data = new Map();
    }

    /**
     * Gets the envelopeTypeName field.
     */
    public function getEnvelopeTypeName(): string
    {
        return $this->_envelopeTypeName;
    }

    /**
     * Gets the dataTypeName field.
     */
    public function getDataTypeName(): string
    {
        return $this->_dataTypeName;
    }

    /**
     * Gets the time of the event.
     */
    public function getTime(): DateTimeInterface
    {
        return $this->_time;
    }

    /**
     * Sets the time of the event.
     */
    public function setTime(DateTimeInterface $time): void
    {
        $this->_time = $time;
    }

    /**
     * Gets the measurement field. Collection of custom measurements.
     */
    public function getMeasurements(): ?array
    {
        if ($this->_data->hasKey(self::MEASUREMENTS)) {
            return $this->_data->get(self::MEASUREMENTS);
        }
        return null;
    }

    /**
     * Sets the measurement field. Collection of custom measurements.
     */
    public function setMeasurements(iterable $measurements): void
    {
        $this->_data->put(self::MEASUREMENTS, $measurements);
    }

    /**
     * Gets the name field. Event name. Keep it low cardinality to allow proper grouping and useful metrics.
     */
    public function getName(): ?string
    {
        if ($this->_data->hasKey(static::$_name)) {
            return $this->_data->get(static::$_name);
        }
        return null;
    }

    /**
     * Sets the name field. Event name. Keep it low cardinality to allow proper grouping and useful metrics.
     */
    public function setName(?string $name): void
    {
        $this->_data->put(static::$_name, $name);
    }

    public function jsonSerialize(): array
    {
        $values     = Utils::removeEmptyValues($this->_data);
        $properties = $this->getProperties();

        if (!$properties->isEmpty()) {
            $values['properties'] = $properties->jsonSerialize();
        }

        return iterator_to_array($values);
    }
}
