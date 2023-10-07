<?php

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

/**
 * Version property manager
 */
trait Version_Manager
{
    protected static string $_versionKey = 'ver';

    /**
     * Gets the ver field.
     */
    public function getVer(): string|int|null
    {
        if ($this->_data->hasKey(static::$_versionKey)) {
            return $this->_data->get(static::$_versionKey);
        }
        return null;
    }

    /**
     * Sets the ver field.
     */
    public function setVer(string|int $ver): void
    {
        $this->_data->put(static::$_versionKey, $ver);
    }
}
