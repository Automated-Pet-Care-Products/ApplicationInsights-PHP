<?php

declare(strict_types=1);

namespace ApplicationInsights;

use ApplicationInsights\Channel\Contracts\Utils;
use DateTime;
use DateTimeInterface;
use Exception;

/**
 * The main object used for managing sessions for other telemetry items.
 */
class Current_Session
{
    public const APPLICATION_INSIGHTS_SESSION = 'ai_session';
    /**
     * The current session id.
     */
    public string $id;

    /**
     * When the session was created
     */
    public DateTimeInterface $sessionCreated;

    /**
     * When the session was last renewed
     */
    public DateTimeInterface $sessionLastRenewed;

    private array $cookies;

    /**
     * Initializes a new Current_Session.
     */
    public function __construct()
    {
        $this->cookies = &$_COOKIE;

        if (array_key_exists(self::APPLICATION_INSIGHTS_SESSION, $this->cookies)) {
            $parts = explode('|', $this->cookies[self::APPLICATION_INSIGHTS_SESSION]);
            $len = sizeof($parts);
            if ($len > 0) {
                $this->id = $parts[0];
            }

            if ($len > 1) {
                try {
                    $this->sessionCreated = DateTime::createFromFormat(Utils::T_DATETIME_FORMAT, $parts[1]);
                } catch (Exception) {
                    $this->sessionCreated = new DateTime();
                }
            }

            if ($len > 2) {
                try {
                    $this->sessionLastRenewed = DateTime::createFromFormat(Utils::T_DATETIME_FORMAT, $parts[2]);
                } catch (Exception) {
                    $this->sessionLastRenewed = new DateTime();
                }
            }
        }
    }

    public function getId(): ?string
    {
        return $this->id ?? ($this->cookies[static::APPLICATION_INSIGHTS_SESSION] ?? null);
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->sessionCreated ?? null;
    }

    public function getLastRenewedAt(): ?DateTimeInterface
    {
        return $this->sessionLastRenewed ?? null;
    }
}
