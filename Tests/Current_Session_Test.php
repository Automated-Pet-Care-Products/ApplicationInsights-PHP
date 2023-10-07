<?php

declare(strict_types=1);

namespace ApplicationInsights\Tests;

use ApplicationInsights\Channel\Contracts\Utils as Utilities;
use ApplicationInsights\Current_Session;
use DateInterval;
use DateTime;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;

/**
 * Contains tests for Current_Session class
 */
class Current_Session_Test extends TestCase
{
    private string            $sessionId;
    private DateTimeInterface $sessionCreatedTime;
    private DateTimeInterface $sessionLastRenewedTime;

    public function setUp(): void
    {
        $this->sessionId              = Utilities::returnGuid();
        $this->sessionCreatedTime     = new DateTime();
        $this->sessionLastRenewedTime = (new DateTime())->sub(new DateInterval('PT10000S'));
        Utils::setSessionCookie($this->sessionId, $this->sessionCreatedTime, $this->sessionLastRenewedTime);
    }

    public function testDateTime(): void
    {
        $dateTime = new DateTime();
        $ms       = (int)$dateTime->format(Utilities::T_DATETIME_FORMAT);

        $this->assertGreaterThan(0, $ms);
    }

    public function tearDown(): void
    {
        Utils::clearSessionCookie();
    }

    /**
     * Verifies the object is constructed properly.
     */
    public function testConstructor()
    {
        $currentSession = new Current_Session();
        $this->assertEquals($currentSession->getId(), $this->sessionId);

        $this->assertEquals(
            $currentSession->getCreatedAt()->format(Utilities::T_DATETIME_FORMAT),
            $this->sessionCreatedTime->format(Utilities::T_DATETIME_FORMAT)
        );

        $this->assertEquals(
            $currentSession->getLastRenewedAt()->format(Utilities::T_DATETIME_FORMAT),
            $this->sessionLastRenewedTime->format(Utilities::T_DATETIME_FORMAT)
        );
    }

    /**
     * Verifies the object is constructed properly.
     */
    public function testConstructorWithNoCookie()
    {
        Utils::clearSessionCookie();
        $currentSession = new Current_Session();

        $this->assertEquals(null, $currentSession->getId());
        $this->assertEquals(null, $currentSession->getCreatedAt());
        $this->assertEquals(null, $currentSession->getLastRenewedAt());
    }
}
