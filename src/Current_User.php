<?php

declare(strict_types=1);

namespace ApplicationInsights;

use ApplicationInsights\Channel\Contracts\User;
use ApplicationInsights\Channel\Contracts\Utils;

/**
 * The main object used for managing users for other telemetry items.
 */
class Current_User
{
    /**
     * The current user id.
     */
    public mixed $id;

    /**
     * Initializes a new Current_User.
     */
    public function __construct()
    {
        if (array_key_exists(User::USER_ID, $_COOKIE)) {
            $parts = explode('|', $_COOKIE[User::USER_ID] ?? '');
            if (sizeof($parts) > 0) {
                $this->id = $parts[0];
            }
        }

        if (is_null($this->id ?? null)) {
            $this->id               = Utils::returnGuid();
            $_COOKIE[User::USER_ID] = $this->id;
        }
    }

    public function getId(): mixed
    {
        return $this->id ?? null;
    }
}
