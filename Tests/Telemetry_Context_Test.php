<?php

namespace ApplicationInsights\Tests;

use ApplicationInsights\Channel\Contracts\Application;
use ApplicationInsights\Channel\Contracts\Cloud;
use ApplicationInsights\Channel\Contracts\Device;
use ApplicationInsights\Channel\Contracts\Location;
use ApplicationInsights\Channel\Contracts\Operation;
use ApplicationInsights\Channel\Contracts\Session;
use ApplicationInsights\Channel\Contracts\User;
use ApplicationInsights\Current_Session;
use ApplicationInsights\Current_User;
use ApplicationInsights\Telemetry_Context;
use PHPUnit\Framework\TestCase;

/**
 * Contains tests for Telemetry_Context class
 */
class Telemetry_Context_Test extends TestCase
{
    public function testInstrumentationKey(): void
    {
        $telemetryContext   = new Telemetry_Context();
        $instrumentationKey = Utils::getTestInstrumentationKey();
        $telemetryContext->setInstrumentationKey($instrumentationKey);
        $this->assertEquals($instrumentationKey, $telemetryContext->getInstrumentationKey());
    }

    public function testDeviceContext(): void
    {
        $telemetryContext = new Telemetry_Context();
        $context          = $telemetryContext->getDeviceContext();
        $this->assertInstanceOf(Device::class, $context);
    }

    public function testCloudContext(): void
    {
        $telemetryContext = new Telemetry_Context();
        $context          = $telemetryContext->getCloudContext();
        $this->assertInstanceOf(Cloud::class, $context);
        $telemetryContext->setCloudContext(Utils::getSampleCloudContext());
        $context = $telemetryContext->getCloudContext();
        $this->assertEquals($context, Utils::getSampleCloudContext());
    }

    public function testApplicationContext(): void
    {
        $telemetryContext = new Telemetry_Context();
        $context          = $telemetryContext->getApplicationContext();
        $this->assertInstanceOf(Application::class, $context);
    }

    public function testUserContext(): void
    {
        $telemetryContext = new Telemetry_Context();
        $context          = $telemetryContext->getUserContext();
        $this->assertInstanceOf(User::class, $context);
    }

    public function testLocationContext(): void
    {
        $telemetryContext = new Telemetry_Context();
        $context          = $telemetryContext->getLocationContext();
        $this->assertInstanceOf(Location::class, $context);
    }

    public function testOperationContext(): void
    {
        $telemetryContext = new Telemetry_Context();
        $context          = $telemetryContext->getOperationContext();
        $this->assertInstanceOf(Operation::class, $context);
    }

    public function testSessionContext(): void
    {
        $telemetryContext = new Telemetry_Context();
        $context          = $telemetryContext->getSessionContext();

        $defaultSessionContext = new Session();
        $currentSession        = new Current_Session();
        $defaultSessionContext->setId($currentSession->getId());
        $this->assertEquals($context->getId(), $defaultSessionContext->getId());

        $telemetryContext->setSessionContext(Utils::getSampleSessionContext());
        $context = $telemetryContext->getSessionContext();
        $this->assertInstanceOf(Session::class, $context);
    }

    public function testProperties(): void
    {
        $telemetryContext = new Telemetry_Context();
        $properties       = $telemetryContext->getProperties();
        $this->assertEquals([], $properties->toArray());
        $telemetryContext->setProperties(Utils::getSampleCustomProperties());
        $properties = $telemetryContext->getProperties();
        $this->assertNotEmpty($properties);
    }
}
