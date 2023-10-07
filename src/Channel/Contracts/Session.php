<?php
/** @noinspection PhpUnused */

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

/**
 * Data contract class for type Session.
 */
class Session extends Base_Data
{
    public const SESSION_ID       = 'ai.session.id';
    public const IS_FIRST_SESSION = 'ai.session.isFirst';

    protected static string $_name = 'ai.session.name';

    /**
     * Gets the id field.
     * Session ID - the instance of the user's interaction with the application.
     * Information in the session context fields is always about the end user.
     * When telemetry is sent from a service,
     * the session context is about the user that initiated the operation in the service.
     */
    public function getId(): ?string
    {
        if ($this->_data->hasKey(self::SESSION_ID)) {
            return $this->_data->get(self::SESSION_ID);
        }
        return null;
    }

    /**
     * Sets the id field.
     * Session ID - the instance of the user's interaction with the application.
     * Information in the session context fields is always about the end user.
     * When telemetry is sent from a service,
     * the session context is about the user that initiated the operation in the service.
     */
    public function setId(?string $id): void
    {
        $this->_data->put(self::SESSION_ID, $id);
    }

    /**
     * Gets the isFirst field.
     * Boolean value indicating whether the session identified by ai.session.id is first for the user or not.
     */
    public function getIsFirst(): ?bool
    {
        if ($this->_data->hasKey(self::IS_FIRST_SESSION)) {
            return $this->_data->get(self::IS_FIRST_SESSION);
        }
        return null;
    }

    /**
     * Sets the isFirst field.
     * Boolean value indicating whether the session identified by ai.session.id is first for the user or not.
     */
    public function setIsFirst(bool $isFirst): void
    {
        $this->_data->put(self::IS_FIRST_SESSION, var_export($isFirst, true));
    }
}
