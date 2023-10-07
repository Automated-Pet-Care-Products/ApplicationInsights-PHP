<?php
/** @noinspection PhpUnused */

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

/**
 * Data contract class for type Operation.
 */
class Operation extends Base_Data
{
    public const OPERATION_ID                 = 'ai.operation.id';
    public const OPERATION_PARENT_ID          = 'ai.operation.parentId';
    public const SYNTHETIC_OPERATION_SOURCE   = 'ai.operation.syntheticSource';
    public const OPERATION_CORRELATION_VECTOR = 'ai.operation.correlationVector';

    protected static string $_name = 'ai.operation.name';

    /**
     * Gets the id field.
     * A unique identifier for the operation instance.
     * The operation ID is created by either a request or a page view.
     * All other telemetries set this to the value for the containing request or page view.
     * Operation.id is used to find all the telemetry items for a specific operation instance.
     */
    public function getId(): ?string
    {
        if ($this->_data->hasKey(self::OPERATION_ID)) {
            return $this->_data->get(self::OPERATION_ID);
        }
        return null;
    }

    /**
     * Sets the id field.
     * A unique identifier for the operation instance.
     * The operation ID is created by either a request or a page view.
     * All other telemetry sets this to the value for the containing request or page view.
     * Operation.id is used to find all the telemetry items for a specific operation instance.
     */
    public function setId(string $id): void
    {
        $this->_data->put(self::OPERATION_ID, $id);
    }

    /**
     * Gets the parentId field. The unique identifier of the telemetry item's immediate parent.
     */
    public function getParentId(): ?string
    {
        if ($this->_data->hasKey(self::OPERATION_PARENT_ID)) {
            return $this->_data->get(self::OPERATION_PARENT_ID);
        }
        return null;
    }

    /**
     * Sets the parentId field. The unique identifier of the telemetry item's immediate parent.
     */
    public function setParentId(string $parentId): void
    {
        $this->_data->put(self::OPERATION_PARENT_ID, $parentId);
    }

    /**
     * Gets the syntheticSource field.
     * Name of a synthetic source.
     * Some telemetry from the application may represent synthetic traffic.
     * It may be a web crawler indexing the website,
     * site availability tests, or traces from diagnostic libraries like Application Insights SDK itself.
     */
    public function getSyntheticSource(): ?string
    {
        if ($this->_data->hasKey(self::SYNTHETIC_OPERATION_SOURCE)) {
            return $this->_data->get(self::SYNTHETIC_OPERATION_SOURCE);
        }
        return null;
    }

    /**
     * Sets the syntheticSource field.
     * Name of the synthetic source.
     * Some telemetry from the application may represent synthetic traffic.
     * It may be a web crawler indexing the website,
     * site availability tests, or traces from diagnostic libraries like Application Insights SDK itself.
     */
    public function setSyntheticSource(string $syntheticSource): void
    {
        $this->_data->put(self::SYNTHETIC_OPERATION_SOURCE, $syntheticSource);
    }

    /**
     * Gets the correlationVector field.
     * The correlation vector is a lightweight vector clock
     * that can be used to identify and order related events across clients and services.
     */
    public function getCorrelationVector(): mixed
    {
        if ($this->_data->hasKey(self::OPERATION_CORRELATION_VECTOR)) {
            return $this->_data->get(self::OPERATION_CORRELATION_VECTOR);
        }
        return null;
    }

    /**
     * Sets the correlationVector field.
     * The correlation vector is a lightweight vector clock
     * that can be used to identify and order related events across clients and services.
     */
    public function setCorrelationVector(mixed $correlationVector): void
    {
        $this->_data->put(self::OPERATION_CORRELATION_VECTOR, $correlationVector);
    }
}
