<?php /** @noinspection PhpUnused */

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

/**
 * Data contract class for type Message_Data.
 * Instances of Message represent printf-like trace statements that are text-searched.
 * Log4Net, NLog, and other text-based log file entries are translated into instances of this type.
 * The message does not have measurements.
 */
class Message_Data extends Base_Data implements Data_Interface
{

    /**
     * Creates a new MessageData.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_envelopeTypeName = 'Microsoft.ApplicationInsights.Message';
        $this->_dataTypeName = 'MessageData';
        $this->_data->put('ver', 2);
        $this->_data->put('message', null);
    }

    /**
     * Gets the message field. Trace message
     */
    public function getMessage(): ?string
    {
        if ($this->_data->hasKey('message')) {
            return $this->_data->get('message');
        }
        return null;
    }

    /**
     * Sets the message field. Trace message
     */
    public function setMessage(?string $message): void
    {
        $this->_data->put('message', $message);
    }

    /**
     * Gets the severityLevel field. Trace severity level.
     */
    public function getSeverityLevel(): ?int
    {
        if ($this->_data->hasKey('severityLevel')) {
            return $this->_data->get('severityLevel');
        }
        return null;
    }

    /**
     * Sets the severityLevel field. Trace severity level.
     */
    public function setSeverityLevel(int $severityLevel): void
    {
        $this->_data->put('severityLevel', $severityLevel);
    }
}
