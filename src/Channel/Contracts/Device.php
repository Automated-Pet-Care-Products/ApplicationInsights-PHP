<?php
/** @noinspection PhpUnused */

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

/**
 * Data contract class for type Device.
 */
class Device extends Base_Data
{
    public const DEVICE_ID         = 'ai.device.id';
    public const DEVICE_LOCALE     = 'ai.device.locale';
    public const DEVICE_MODEL      = 'ai.device.model';
    public const DEVICE_OEM_NAME   = 'ai.device.oemName';
    public const DEVICE_TYPE       = 'ai.device.type';
    public const DEVICE_OS_VERSION = 'ai.device.osVersion';

    protected static string $_name = 'ai.device.name';

    /**
     * Gets the id field. Unique client device id. Computer name in most cases.
     */
    public function getId(): mixed
    {
        if ($this->_data->hasKey(self::DEVICE_ID)) {
            return $this->_data->get(self::DEVICE_ID);
        }
        return null;
    }

    /**
     * Sets the id field. Unique client device id. Computer name in most cases.
     */
    public function setId(mixed $id): void
    {
        $this->_data->put(self::DEVICE_ID, $id);
    }

    /**
     * Gets the locale field. Device locale using <language>-<REGION> pattern, following RFC 5646. Example 'en-US'.
     */
    public function getLocale(): ?string
    {
        if ($this->_data->hasKey(self::DEVICE_LOCALE)) {
            return $this->_data->get(self::DEVICE_LOCALE);
        }
        return null;
    }

    /**
     * Sets the locale field. Device locale using <language>-<REGION> pattern, following RFC 5646. Example 'en-US'.
     */
    public function setLocale(string $locale): void
    {
        $this->_data->put(self::DEVICE_LOCALE, $locale);
    }

    /**
     * Gets the model field.
     * Model of the device the end user of the application is using.
     * Used for client scenarios.
     * If this field is empty, then it is derived from the user agent.
     */
    public function getModel(): ?string
    {
        if ($this->_data->hasKey(self::DEVICE_MODEL)) {
            return $this->_data->get(self::DEVICE_MODEL);
        }
        return null;
    }

    /**
     * Sets the model field.
     * Model of the device the end user of the application is using.
     * Used for client scenarios.
     * If this field is empty, then it is derived from the user agent.
     */
    public function setModel(?string $model): void
    {
        $this->_data->put(self::DEVICE_MODEL, $model);
    }

    /**
     * Gets the oemName field. Client device OEM name taken from the browser.
     */
    public function getOemName()
    {
        if ($this->_data->hasKey(self::DEVICE_OEM_NAME)) {
            return $this->_data->get(self::DEVICE_OEM_NAME);
        }
        return null;
    }

    /**
     * Sets the oemName field. Client device OEM name taken from the browser.
     */
    public function setOemName(?string $oemName): void
    {
        $this->_data->put(self::DEVICE_OEM_NAME, $oemName);
    }

    /**
     * Gets the osVersion field.
     * Operating system name and version of the device the end user of the application is using.
     * If this field is empty, then it is derived from the user agent.
     * Example 'Windows 10 Pro 10.0.10586.0'
     */
    public function getOsVersion()
    {
        if ($this->_data->hasKey(self::DEVICE_OS_VERSION)) {
            return $this->_data->get(self::DEVICE_OS_VERSION);
        }
        return null;
    }

    /**
     * Sets the osVersion field.
     * Operating system name and version of the device the end user of the application is using.
     * If this field is empty, then it is derived from the user agent.
     * Example 'Windows 10 Pro 10.0.10586.0'
     */
    public function setOsVersion($osVersion): void
    {
        $this->_data->put(self::DEVICE_OS_VERSION, $osVersion);
    }

    /**
     * Gets the type field.
     * The type of the device the end user of the application is using.
     * Used primarily to distinguish JavaScript telemetry from server side telemetry.
     * Examples: 'PC', 'Phone', 'Browser'.
     * 'PC' is the default value.
     */
    public function getType()
    {
        if ($this->_data->hasKey(self::DEVICE_TYPE)) {
            return $this->_data->get(self::DEVICE_TYPE);
        }
        return null;
    }

    /**
     * Sets the type field.
     * The type of the device the end user of the application is using.
     * Used primarily to distinguish JavaScript telemetry from server side telemetry.
     * Examples: 'PC', 'Phone', 'Browser'.
     * 'PC' is the default value.
     */
    public function setType($type): void
    {
        $this->_data->put(self::DEVICE_TYPE, $type);
    }
}
