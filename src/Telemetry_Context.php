<?php

declare(strict_types=1);

namespace ApplicationInsights;

use ApplicationInsights\Channel\Contracts\Application;
use ApplicationInsights\Channel\Contracts\Cloud;
use ApplicationInsights\Channel\Contracts\Device;
use ApplicationInsights\Channel\Contracts\Internal;
use ApplicationInsights\Channel\Contracts\Location;
use ApplicationInsights\Channel\Contracts\Operation;
use ApplicationInsights\Channel\Contracts\Session;
use ApplicationInsights\Channel\Contracts\User;
use ApplicationInsights\Channel\Contracts\Utils;
use ApplicationInsights\Traits\HasPropertiesTrait;

/**
 * Responsible for managing the context to send along with telemetry items.
 */
class Telemetry_Context
{
    private string      $_instrumentationKey;
    private Device      $_deviceContext;
    private Cloud       $_cloudContext;
    private Application $_applicationContext;
    private User        $_userContext;
    private Location    $_locationContext;
    private Operation   $_operationContext;
    private Session     $_sessionContext;
    private Internal    $_internalContext;

    use HasPropertiesTrait;

    /**
     * Initializes a new TelemetryContext.
     */
    public function __construct()
    {
        $this->_deviceContext    = new Channel\Contracts\Device();
        $this->_cloudContext     = new Channel\Contracts\Cloud();
        $this->_applicationContext = new Channel\Contracts\Application();
        $this->_userContext      = new Channel\Contracts\User();
        $this->_locationContext  = new Channel\Contracts\Location();
        $this->_operationContext = new Channel\Contracts\Operation();
        $this->_sessionContext   = new Channel\Contracts\Session();
        $this->_internalContext  = new Channel\Contracts\Internal();

        // Initialize user id
        $currentUser = new Current_User();
        $this->_userContext->setId($currentUser->getId());

        // Initialize session id
        $currentSession = new Current_Session();
        $this->_sessionContext->setId($currentSession->getId());

        // Initialize the operation id
        $operationId = Utils::returnGuid();
        $this->_operationContext->setId($operationId);

        // Initialize client ip
        if (array_key_exists('REMOTE_ADDR', $_SERVER) && sizeof(explode('.', $_SERVER['REMOTE_ADDR'])) >= 4) {
            $this->_locationContext->setIp($_SERVER['REMOTE_ADDR']);
        }

        $this->_internalContext->setSdkVersion('php:0.5.0');
    }

    /**
     * The instrumentation key for your Application Insights application.
     * @return string (Guid)
     */
    public function getInstrumentationKey(): string
    {
        return $this->_instrumentationKey;
    }

    /**
     * Sets the instrumentation key on the context. This is the key for your application in Application Insights.
     * @param string $instrumentationKey (Guid)
     */
    public function setInstrumentationKey(string $instrumentationKey): void
    {
        $this->_instrumentationKey = $instrumentationKey;
    }

    /**
     * The device context object. Allows you to set properties that will be attached to telemetry about the device.
     */
    public function getDeviceContext(): Device
    {
        return $this->_deviceContext;
    }

    /**
     * Sets a device context object. Allows you to set properties that will be attached to telemetry about the device.
     */
    public function setDeviceContext(Channel\Contracts\Device $deviceContext): void
    {
        $this->_deviceContext = $deviceContext;
    }

    /**
     * The cloud context object.
     * Allows you to set properties that will be attached to telemetry about the cloud placement of an application.
     */
    public function getCloudContext(): Cloud
    {
        return $this->_cloudContext;
    }

    /**
     * Sets a cloud context object.
     * Allows you to set properties that will be attached to telemetry about the cloud placement of an application.
     */
    public function setCloudContext(Channel\Contracts\Cloud $cloudContext): void
    {
        $this->_cloudContext = $cloudContext;
    }

    /**
     * The application context object. Allows you to set properties that will be attached to telemetry about the application.
     */
    public function getApplicationContext(): Application
    {
        return $this->_applicationContext;
    }

    /**
     * Sets the application context object.
     * Allows you to set properties that will be attached to telemetry about the application.
     */
    public function setApplicationContext(Channel\Contracts\Application $applicationContext): void
    {
        $this->_applicationContext = $applicationContext;
    }

    /**
     * The user context object. Allows you to set properties that will be attached to telemetry about the user.
     */
    public function getUserContext(): User
    {
        return $this->_userContext;
    }

    /**
     * Set user context object. Allows you to set properties that will be attached to telemetry about the user.
     */
    public function setUserContext(Channel\Contracts\User $userContext): void
    {
        $this->_userContext = $userContext;
    }

    /**
     * The location context object. Allows you to set properties that will be attached to telemetry about the location.
     */
    public function getLocationContext(): Location
    {
        return $this->_locationContext;
    }

    /**
     * Set location context object. Allows you to set properties that will be attached to telemetry about the location.
     */
    public function setLocationContext(Channel\Contracts\Location $locationContext): void
    {
        $this->_locationContext = $locationContext;
    }

    /**
     * The operation context an object.
     * Allows you to set properties that will be attached to telemetry about the operation.
     */
    public function getOperationContext(): Operation
    {
        return $this->_operationContext;
    }

    /**
     * Set operation context object. Allows you to set properties that will be attached to telemetry about the operation.
     */
    public function setOperationContext(Channel\Contracts\Operation $operationContext): void
    {
        $this->_operationContext = $operationContext;
    }

    /**
     * The session context object. Allows you to set properties that will be attached to telemetry about the session.
     */
    public function getSessionContext(): Session
    {
        return $this->_sessionContext;
    }

    /**
     * Set session context object. Allows you to set properties that will be attached to telemetry about the session.
     */
    public function setSessionContext(Channel\Contracts\Session $sessionContext): void
    {
        $this->_sessionContext = $sessionContext;
    }

    /**
     * The session context object. Allows you to set internal details for troubleshooting.
     */
    public function getInternalContext(): Internal
    {
        return $this->_internalContext;
    }
}
