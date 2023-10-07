<?php

declare(strict_types=1);

namespace ApplicationInsights\Tests;

use ApplicationInsights\Channel\Contracts\Application;
use ApplicationInsights\Channel\Contracts\Cloud;
use ApplicationInsights\Channel\Contracts\Device;
use ApplicationInsights\Channel\Contracts\Location;
use ApplicationInsights\Channel\Contracts\Operation;
use ApplicationInsights\Channel\Contracts\Session;
use ApplicationInsights\Channel\Contracts\User;
use ApplicationInsights\Current_Session;
use DateTimeInterface;
use Exception;

/**
 * Contains utilities for tests
 */
class Utils
{
    protected static Cloud $sampleCloud;

    /**
     * A single place for managing the instrumentation key used in the tests.
     * @return string (Guid)
     */
    public static function getTestInstrumentationKey(): string
    {
        return '11111111-1111-1111-1111-111111111111';
    }

    /**
     * Controls whether the tests should send data to the server.
     */
    public static function sendDataToServer(): bool
    {
        return false;
    }

    /**
     * Gets a sample ApplicationInsights\Channel\Contracts\Device
     */
    public static function getSampleDeviceContext(): Device
    {
        $context = new Device();
        $context->setId('my_device_id');
        $context->setLocale('EN');
        $context->setModel('my_device_model');
        $context->setOemName('my_device_oem_name');
        $context->setOsVersion('Windows 8');
        $context->setType('PC');
        return $context;
    }

    /**
     * Gets a sample ApplicationInsights\Channel\Contracts\Cloud
     */
    public static function getSampleCloudContext(): Cloud
    {
        if (isset(static::$sampleCloud)) {
            return static::$sampleCloud;
        }

        $context = new Cloud();
        $context->setRole('my_role_name');
        $context->setRoleInstance('my_role_instance');
        return static::$sampleCloud = $context;
    }

    /**
     * Gets a sample ApplicationInsights\Channel\Contracts\Application
     */
    public static function getSampleApplicationContext(): Application
    {
        $context = new Application();
        $context->setVer('1.0.0.0');
        return $context;
    }

    /**
     * Gets a sample ApplicationInsights\Channel\Contracts\User
     */
    public static function getSampleUserContext(): User
    {
        $context = new User();
        $context->setId('my_user_id');
        $context->setAccountId('my_account_id');
        return $context;
    }

    /**
     * Gets a sample ApplicationInsights\Channel\Contracts\Location
     */
    public static function getSampleLocationContext(): Location
    {
        $context = new Location();
        $context->setIp('127.0.0.0');
        return $context;
    }

    /**
     * Gets a sample ApplicationInsights\Channel\Contracts\Operation
     */
    public static function getSampleOperationContext(): Operation
    {
        $context = new Operation();
        $context->setId('my_operation_id');
        $context->setName('my_operation_name');
        $context->setParentId('my_operation_parent_id');
        return $context;
    }

    /**
     * Gets a sample ApplicationInsights\Channel\Contracts\Session
     */
    public static function getSampleSessionContext(): Session
    {
        $context = new Session();
        $context->setId('my_session_id');
        $context->setIsFirst(false);
        return $context;
    }

    /**
     * Gets a sample custom property array.
     */
    public static function getSampleCustomProperties(): array
    {
        return ['MyCustomProperty' => 42, 'MyCustomProperty2' => 'test'];
    }

    /**
     * Used for testing exception related code
     * @throws Exception
     */
    public static function throwNestedException($depth = 0): void
    {
        if ($depth <= 0) {
            throw new Exception('testException');
        }

        Utils::throwNestedException($depth - 1);
    }

    /**
     * Used for testing error related code
     */
    public static function throwError(): void
    {
        eval('sdklafjha; asdlkja; asdaksd; al;');
    }

    /**
     * Creates user cookie for testing.
     */
    public static function setUserCookie($userId = null): void
    {
        $_COOKIE[User::USER_ID] =
            $userId == null ? \src\Channel\Contracts\Utils::returnGuid() : $userId;
    }

    /**
     * Clears the user cookie.
     */
    public static function clearUserCookie(): void
    {
        $_COOKIE[User::USER_ID] = null;
    }

    /**
     * Creates session cookie for testing.
     */
    public static function setSessionCookie(
        ?string $sessionId = null,
        DateTimeInterface $sessionCreatedDate = null,
        DateTimeInterface $lastRenewedDate = null
    ): void {
        $aiSessionId = implode('|', [
            $sessionId ?? \ApplicationInsights\Channel\Contracts\Utils::returnGuid(),
            $sessionCreatedDate->format(\ApplicationInsights\Channel\Contracts\Utils::T_DATETIME_FORMAT),
            $lastRenewedDate->format(\ApplicationInsights\Channel\Contracts\Utils::T_DATETIME_FORMAT)
        ]);

        setcookie(Current_Session::APPLICATION_INSIGHTS_SESSION, $aiSessionId);
        $_COOKIE[Current_Session::APPLICATION_INSIGHTS_SESSION] = $aiSessionId;
    }

    /**
     * Clears the user cookie.
     */
    public static function clearSessionCookie(): void
    {
        setcookie(Current_Session::APPLICATION_INSIGHTS_SESSION, '', expires_or_options: time());
        $_COOKIE = [];
    }
}
