<?php /** @noinspection PhpUnused */

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

/**
 * Data contract class for type Dependency_Data.
 * An instance of Remote Dependency represents an interaction of the monitored component with a remote component/service like SQL or an HTTP endpoint.
 */
class Dependency_Data extends Base_Data implements Data_Interface
{
    public const DEPENDENCY_TYPE   = 'type';
    public const DEPENDENCY_TARGET = 'target';
    public const DEPENDENCY_DATA   = 'data';
    public const REQUEST_DURATION  = 'duration';
    public const RESPONSE_CODE     = 'resultCode';

    /**
     * Creates a new RemoteDependencyData.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_envelopeTypeName = 'Microsoft.ApplicationInsights.RemoteDependency';
        $this->_dataTypeName     = 'RemoteDependencyData';

        $this->_data->put('ver', 2);
        $this->_data->put('name', null);
        $this->_data->put(self::REQUEST_DURATION, null);
        $this->_data->put('success', true);
    }

    /**
     * Gets the id field.
     * Identifier of a dependency call instance.
     * Used for correlation with the request telemetry item corresponding to this dependency call.
     */
    public function getId(): mixed
    {
        if ($this->_data->hasKey('id')) {
            return $this->_data->get('id');
        }
        return null;
    }

    /**
     * Sets the id field.
     * Identifier of a dependency call instance.
     * Used for correlation with the request telemetry item corresponding to this dependency call.
     */
    public function setId(mixed $id): void
    {
        $this->_data->put('id', $id);
    }

    /**
     * Gets the resultCode field. Result code of a dependency call. Examples are SQL error code and HTTP status code.
     */
    public function getResultCode(): ?int
    {
        if ($this->_data->hasKey(self::RESPONSE_CODE)) {
            return $this->_data->get(self::RESPONSE_CODE);
        }
        return null;
    }

    /**
     * Sets the resultCode field. Result code of a dependency call. Examples are SQL error code and HTTP status code.
     */
    public function setResultCode(int $resultCode): void
    {
        $this->_data->put(self::RESPONSE_CODE, var_export($resultCode, true));
    }

    /**
     * Gets the duration field. Request duration in format: DD.HH:MM:SS.MMMMMM. Must be less than 1000 days.
     */
    public function getDuration(): ?string
    {
        if ($this->_data->hasKey(self::REQUEST_DURATION)) {
            return $this->_data->get(self::REQUEST_DURATION);
        }
        return null;
    }

    /**
     * Sets the duration field. Request duration in format: DD.HH:MM:SS.MMMMMM. Must be less than 1000 days.
     */
    public function setDuration(string $duration): void
    {
        $this->_data->put(self::REQUEST_DURATION, $duration);
    }

    /**
     * Gets the success field. Indication of successful or unsuccessful call.
     */
    public function getSuccess(): ?bool
    {
        if ($this->_data->hasKey('success')) {
            return $this->_data->get('success');
        }
        return null;
    }

    /**
     * Sets the success field. Indication of successful or unsuccessful call.
     */
    public function setSuccess(bool $success): void
    {
        $this->_data->put('success', $success);
    }

    /**
     * Gets the data field.
     * Command initiated by this dependency call.
     * Examples are SQL statement and HTTP URLs with all query parameters.
     */
    public function getData(): mixed
    {
        if ($this->_data->hasKey(self::DEPENDENCY_DATA)) {
            return $this->_data->get(self::DEPENDENCY_DATA);
        }
        return null;
    }

    /**
     * Sets the data field.
     * Command initiated by this dependency call.
     * Examples are SQL statement and HTTP URLs with all query parameters.
     */
    public function setData(mixed $data): void
    {
        $this->_data->put(self::DEPENDENCY_DATA, $data);
    }

    /**
     * Gets the target field. Target site of a dependency call. Examples are server name, host address.
     */
    public function getTarget(): ?string
    {
        if ($this->_data->hasKey(self::DEPENDENCY_TARGET)) {
            return $this->_data->get(self::DEPENDENCY_TARGET);
        }
        return null;
    }

    /**
     * Sets the target field. Target site of a dependency call. Examples are server name, host address.
     */
    public function setTarget(?string $target): void
    {
        $this->_data->put(self::DEPENDENCY_TARGET, $target);
    }

    /**
     * Gets the type field.
     * Dependency type name.
     * Very low cardinality value for logical grouping of dependencies and interpretation of other fields like commandName and resultCode.
     * Examples are SQL, Azure table, and HTTP.
     */
    public function getType()
    {
        if ($this->_data->hasKey(self::DEPENDENCY_TYPE)) {
            return $this->_data->get(self::DEPENDENCY_TYPE);
        }
        return null;
    }

    /**
     * Sets the type field.
     * Dependency type name.
     * Very low cardinality value for logical grouping of dependencies and interpretation of other fields like commandName and resultCode.
     * Examples are SQL, Azure table, and HTTP.
     */
    public function setType(?string $type): void
    {
        $this->_data->put(self::DEPENDENCY_TYPE, $type);
    }
}
