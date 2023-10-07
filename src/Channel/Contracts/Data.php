<?php
/** @noinspection PhpUnused */

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

/**
 * Data contract class for type Data. Data struct to contain both B and C sections.
 */
class Data extends Base_Data
{
    public const BASE_TYPE = 'baseType';
    public const BASE_DATA = 'baseData';

    /**
     * Gets the baseType field.
     * Name of item (B section) if any.
     * If telemetry data is derived straight from this, this should be null.
     */
    public function getBaseType()
    {
        if ($this->_data->hasKey(self::BASE_TYPE)) {
            return $this->_data->get(self::BASE_TYPE);
        }
        return null;
    }

    /**
     * Sets the baseType field.
     * Name of item (B section) if any.
     * If telemetry data is derived straight from this, this should be null.
     */
    public function setBaseType($baseType): void
    {
        $this->_data->put(self::BASE_TYPE, $baseType);
    }

    /**
     * Gets the baseData field. Container for data item (B section).
     */
    public function getBaseData(): mixed
    {
        if ($this->_data->hasKey(self::BASE_DATA)) {
            return $this->_data->get(self::BASE_DATA);
        }
        return null;
    }

    /**
     * Sets the baseData field. Container for data item (B section).
     */
    public function setBaseData(mixed $baseData): void
    {
        $this->_data->put(self::BASE_DATA, $baseData);
    }
}
