<?php

declare(strict_types=1);

namespace ApplicationInsights\Tests\Channel\Contracts;

use ApplicationInsights\Channel\Contracts\Utils;
use PHPUnit\Framework\TestCase;

/**
 * Contains tests for Utils class
 */
class Utils_Test extends TestCase
{
    public function testConvertMillisecondsToTimeSpan()
    {
        $this->assertEquals('00:00:00.000', Utils::convertMillisecondsToTimeSpan(0));
        $this->assertEquals('00:00:00.001', Utils::convertMillisecondsToTimeSpan(1), 'milliseconds digit 1');
        $this->assertEquals('00:00:00.010', Utils::convertMillisecondsToTimeSpan(10), 'milliseconds digit 2');
        $this->assertEquals('00:00:00.100', Utils::convertMillisecondsToTimeSpan(100), 'milliseconds digit 3');
        $this->assertEquals('00:00:01.000', Utils::convertMillisecondsToTimeSpan(1000), 'seconds digit 1');
        $this->assertEquals('00:00:10.000', Utils::convertMillisecondsToTimeSpan(10 * 1000), 'seconds digit 2');
        $this->assertEquals('00:01:00.000', Utils::convertMillisecondsToTimeSpan(60 * 1000), 'minutes digit 1');
        $this->assertEquals('00:10:00.000', Utils::convertMillisecondsToTimeSpan(10 * 60 * 1000), 'minutes digit 2');
        $this->assertEquals('01:00:00.000', Utils::convertMillisecondsToTimeSpan(60 * 60 * 1000), 'hours digit 1');
        $this->assertEquals('10:00:00.000', Utils::convertMillisecondsToTimeSpan(10 * 60 * 60 * 1000), 'hours digit 2');
        $this->assertEquals(
            '00:00:00.000',
            Utils::convertMillisecondsToTimeSpan(24 * 60 * 60 * 1000),
            'hours overflow'
        );
        $this->assertEquals(
            '11:11:11.111',
            Utils::convertMillisecondsToTimeSpan(11 * 3600000 + 11 * 60000 + 11111),
            'all digits'
        );

        $this->assertEquals('00:00:00.000', Utils::convertMillisecondsToTimeSpan(0), 'invalid input');
        $this->assertEquals('00:00:00.000', Utils::convertMillisecondsToTimeSpan((int)"'"), 'invalid input');
        $this->assertEquals('00:00:00.000', Utils::convertMillisecondsToTimeSpan((int)null), 'invalid input');
        $this->assertEquals('00:00:00.000', Utils::convertMillisecondsToTimeSpan((int)[]), 'invalid input');
        $this->assertEquals('00:00:00.000', Utils::convertMillisecondsToTimeSpan(-1), 'invalid input');
    }
}
