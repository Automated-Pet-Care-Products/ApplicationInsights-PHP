<?php
/** @noinspection PhpUnused */

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

/**
 * Data contract class for type Location.
 */
class Location extends Base_Data
{
    public const LOCATION_IP_ADDRESS = 'ai.location.ip';

    protected static string $_name = 'ai.location.name';

    /**
     * Gets the ip field. The IP address of the client device. IPv4 and IPv6 are supported. Information in the location context fields is always about the end user. When telemetry is sent from a service, the location context is about the user that initiated the operation in the service.
     */
    public function getIp(): ?string
    {
        if ($this->_data->hasKey(self::LOCATION_IP_ADDRESS)) {
            return $this->_data->get(self::LOCATION_IP_ADDRESS);
        }
        return null;
    }

    /**
     * Sets the ip field. The IP address of the client device. IPv4 and IPv6 are supported. Information in the location context fields is always about the end user. When telemetry is sent from a service, the location context is about the user that initiated the operation in the service.
     */
    public function setIp(?string $ip): void
    {
        $this->_data->put(self::LOCATION_IP_ADDRESS, $ip);
    }
}
