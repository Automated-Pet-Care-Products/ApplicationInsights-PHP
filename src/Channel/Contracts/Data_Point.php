<?php
/** @noinspection PhpUnused */

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

/**
 * Data contract class for type Data_Point. Metric data single measurement.
 */
class Data_Point extends Base_Data
{
    public const DATA_KIND          = 'kind';
    public const DATA_VALUE         = 'value';
    public const COUNT              = 'count';
    public const MIN                = 'min';
    public const MAX                = 'max';
    public const STANDARD_DEVIATION = 'stdDev';

    /**
     * Creates a new DataPoint.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_data->put('name', null);
        $this->_data->put(self::DATA_KIND, Data_Point_Type::Measurement);
        $this->_data->put(self::DATA_VALUE, null);
    }

    /**
     * Gets the ns field. Namespace of the metric.
     */
    public function getNs(): ?string
    {
        if ($this->_data->hasKey('ns')) {
            return $this->_data->get('ns');
        }
        return null;
    }

    /**
     * Sets the ns field. Namespace of the metric.
     */
    public function setNs(string $ns): void
    {
        $this->_data->put('ns', $ns);
    }

    /**
     * Gets the kind field. Metric type. Single measurement or the aggregated value.
     */
    public function getKind(): ?int
    {
        if ($this->_data->hasKey(self::DATA_KIND)) {
            return $this->_data->get(self::DATA_KIND);
        }
        return null;
    }

    /**
     * Sets the kind field. Metric type. Single measurement or the aggregated value.
     */
    public function setKind(int $kind): void
    {
        $this->_data->put(self::DATA_KIND, $kind);
    }

    /**
     * Gets the value field. Single value for measurement. Sum of individual measurements for the aggregation.
     */
    public function getValue(): ?float
    {
        if ($this->_data->hasKey(self::DATA_VALUE)) {
            return $this->_data->get(self::DATA_VALUE);
        }
        return null;
    }

    /**
     * Sets the value field. Single value for measurement. Sum of individual measurements for the aggregation.
     */
    public function setValue(float $value): void
    {
        $this->_data->put(self::DATA_VALUE, $value);
    }

    /**
     * Gets the count field. Metric weight of the aggregated metric. Should not be set for a measurement.
     */
    public function getCount(): ?int
    {
        if ($this->_data->hasKey(self::COUNT)) {
            return $this->_data->get(self::COUNT);
        }
        return null;
    }

    /**
     * Sets the count field. Metric weight of the aggregated metric. Should not be set for a measurement.
     */
    public function setCount(int $count): void
    {
        $this->_data->put(self::COUNT, $count);
    }

    /**
     * Gets the min field. Minimum value of the aggregated metric. Should not be set for a measurement.
     */
    public function getMin(): ?float
    {
        if ($this->_data->hasKey(self::MIN)) {
            return $this->_data->get(self::MIN);
        }
        return null;
    }

    /**
     * Sets the min field. Minimum value of the aggregated metric. Should not be set for a measurement.
     */
    public function setMin(float $min): void
    {
        if ($min === 0.0) {
            $this->_data->put(self::MIN, null);
        } else {
            $this->_data->put(self::MIN, $min);
        }
    }

    /**
     * Gets the max field. Maximum value of the aggregated metric. Should not be set for a measurement.
     */
    public function getMax(): ?float
    {
        if ($this->_data->hasKey(self::MAX)) {
            return $this->_data->get(self::MAX);
        }
        return null;
    }

    /**
     * Sets the max field. Maximum value of the aggregated metric. Should not be set for a measurement.
     */
    public function setMax(float $max): void
    {
        $this->_data->put(self::MAX, $max);
    }

    /**
     * Gets the stdDev field. Standard deviation of the aggregated metric. Should not be set for a measurement.
     */
    public function getStdDev(): ?float
    {
        if ($this->_data->hasKey(self::STANDARD_DEVIATION)) {
            return $this->_data->get(self::STANDARD_DEVIATION);
        }
        return null;
    }

    /**
     * Sets the stdDev field. Standard deviation of the aggregated metric. Should not be set for a measurement.
     */
    public function setStdDev(float $stdDev): void
    {
        $this->_data->put(self::STANDARD_DEVIATION, $stdDev);
    }
}
