<?php
/** @noinspection PhpUnused */

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

use ApplicationInsights\Traits\HasPropertiesTrait;

/**
 * Data contract class for type User.
 */
class User extends Base_Data
{
    public const AUTH_USER_ID    = 'ai.user.authUserId';
    public const USER_ID         = 'ai.user.id';
    public const USER_ACCOUNT_ID = 'ai.user.accountId';

    protected static string $_name = 'ai.user.name';

    use HasPropertiesTrait;

    /**
     * Gets the accountId field.
     * In multi-tenant applications, this is the account ID or name which the user is acting with.
     * Examples may be subscription ID for Azure portal or blog name blogging platform.
     */
    public function getAccountId(): mixed
    {
        if ($this->_data->hasKey(self::USER_ACCOUNT_ID)) {
            return $this->_data->get(self::USER_ACCOUNT_ID);
        }
        return null;
    }

    /**
     * Sets the accountId field.
     * In multi-tenant applications, this is the account ID or name which the user is acting with.
     * Examples may be subscription ID for Azure portal or blog name blogging platform.
     */
    public function setAccountId(mixed $accountId): void
    {
        $this->_data->put(self::USER_ACCOUNT_ID, $accountId);
    }

    /**
     * Gets the id field.
     * Anonymous user id.
     * Represents the end user of the application.
     * When telemetry is sent from a service, the user context is about the user that initiated the operation in the service.
     */
    public function getId(): mixed
    {
        if ($this->_data->hasKey(self::USER_ID)) {
            return $this->_data->get(self::USER_ID);
        }
        return null;
    }

    /**
     * Sets the id field.
     * Anonymous user id.
     * Represents the end user of the application.
     * When telemetry is sent from a service, the user context is about the user that initiated the operation in the service.
     */
    public function setId($id): void
    {
        $this->_data->put(self::USER_ID, $id);
    }

    /**
     * Gets the authUserId field.
     * Authenticated user id.
     * The opposite of ai.user.id, this represents the user with a friendly name.
     * Since it's PII, it is not collected by default by most SDKs.
     */
    public function getAuthUserId(): mixed
    {
        return $this->_data->hasKey(self::AUTH_USER_ID) ? $this->_data[self::AUTH_USER_ID] : null;
    }

    /**
     * Sets the authUserId field.
     * Authenticated user id.
     * The opposite of ai.user.id, this represents the user with a friendly name.
     * Since it's PII, it is not collected by default by most SDKs.
     */
    public function setAuthUserId(mixed $authUserId): void
    {
        $this->_data->put(self::AUTH_USER_ID, $authUserId);
    }
}
