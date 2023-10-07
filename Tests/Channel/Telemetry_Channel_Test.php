<?php

declare(strict_types=1);

namespace ApplicationInsights\Tests\Channel;

use ApplicationInsights\Channel\Telemetry_Channel;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;

/**
 * Contains tests for TelemetrySender class
 */
class Telemetry_Channel_Test extends TestCase
{
    private ClientInterface $http;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        $this->http = $this->createStub(ClientInterface::class);
    }

    public function testConstructor()
    {
        $telemetryChannel = new Telemetry_Channel($this->http);
        $this->assertEquals(
            'https://dc.services.visualstudio.com/v2/track',
            $telemetryChannel->getEndpointUrl(),
            'Default Endpoint URL is incorrect.'
        );
        $this->assertEquals([], $telemetryChannel->getQueue()->toArray(), 'Queue should be empty by default.');
    }

    public function testEndpointUrl()
    {
        $telemetryChannel = new Telemetry_Channel($this->http);
        $telemetryChannel->setEndpointUrl('https://foo.com');
        $this->assertEquals('https://foo.com', $telemetryChannel->getEndpointUrl());
    }

    public function testQueue()
    {
        $telemetryChannel = new Telemetry_Channel($this->http);
        $telemetryChannel->getQueue()->push(42, 42, 42);
        $this->assertEquals([42, 42, 42], $telemetryChannel->getQueue()->toArray());
        $telemetryChannel->flush();
        $this->assertEquals([], $telemetryChannel->getQueue()->toArray());
    }
}
