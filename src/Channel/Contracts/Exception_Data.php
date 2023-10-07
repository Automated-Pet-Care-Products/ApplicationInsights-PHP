<?php
/** @noinspection PhpUnused */

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

/**
 * Data contract class for type Exception_Data.
 * An instance of Exception represents a handled or unhandled exception
 * that occurred during the execution of the monitored application.
 */
class Exception_Data extends Base_Data implements Data_Interface
{
    public const EXCEPTIONS     = 'exceptions';
    public const SEVERITY_LEVEL = 'severityLevel';
    public const PROBLEM_ID     = 'problemId';

    /**
     * Creates a new ExceptionData.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_envelopeTypeName = 'Microsoft.ApplicationInsights.Exception';
        $this->_dataTypeName     = 'ExceptionData';

        $this->setVer(2);

        $this->_data->put(self::EXCEPTIONS, []);
    }

    /**
     * Gets the exception field. Exception chain - list of inner exceptions.
     */
    public function getExceptions(): mixed
    {
        if ($this->_data->hasKey(self::EXCEPTIONS)) {
            return $this->_data->get(self::EXCEPTIONS);
        }
        return null;
    }

    /**
     * Sets the exception field. Exception chain - list of inner exceptions.
     */
    public function setExceptions(mixed $exceptions): void
    {
        $this->_data->put(self::EXCEPTIONS, $exceptions);
    }

    /**
     * Gets the severityLevel field.
     * Severity level.
     * Mostly used to indicate exception severity level when it is reported by a logging library.
     */
    public function getSeverityLevel(): ?string
    {
        if ($this->_data->hasKey(self::SEVERITY_LEVEL)) {
            return $this->_data->get(self::SEVERITY_LEVEL);
        }
        return null;
    }

    /**
     * Sets the severityLevel field.
     * Severity level.
     * Mostly used to indicate exception severity level when it is reported by a logging library.
     */
    public function setSeverityLevel(?string $severityLevel): void
    {
        $this->_data->put(self::SEVERITY_LEVEL, $severityLevel);
    }

    /**
     * Gets the problemId field.
     * Identifier of where the exception was thrown in code.
     * Used for exception grouping.
     * Typically, a combination of an exception type and a function from the call stack.
     */
    public function getProblemId(): mixed
    {
        if ($this->_data->hasKey(self::PROBLEM_ID)) {
            return $this->_data->get(self::PROBLEM_ID);
        }
        return null;
    }

    /**
     * Sets the problemId field.
     * Identifier of where the exception was thrown in code.
     * Used for exception grouping.
     * Typically, a combination of an exception type and a function from the call stack.
     */
    public function setProblemId(mixed $problemId): void
    {
        $this->_data->put(self::PROBLEM_ID, $problemId);
    }
}
