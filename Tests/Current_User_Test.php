<?php

declare(strict_types=1);

namespace ApplicationInsights\Tests;

use ApplicationInsights\Channel\Contracts\Utils as Utilities;
use ApplicationInsights\Current_User;
use PHPUnit\Framework\TestCase;

/**
 * Contains tests for Current_User class
 */
class Current_User_Test extends TestCase
{
    private string $userId;

    public function setUp(): void
    {
        $this->userId = Utilities::returnGuid();
        Utils::setUserCookie($this->userId);
    }

    public function tearDown(): void
    {
        Utils::clearUserCookie();
    }

    /**
     * Verifies the object is constructed properly.
     */
    public function testConstructor(): void
    {
        $currentUser = new Current_User();

        $this->assertEquals($currentUser->id, $this->userId);
    }

    /**
     * Verifies the object is constructed properly.
     */
    public function testConstructorWithNoCookie(): void
    {
        Utils::clearUserCookie();
        $currentUser = new Current_User();

        $this->assertTrue($currentUser->id !== NULL && $currentUser->id !== $this->userId);
    }
}
