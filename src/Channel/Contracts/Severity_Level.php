<?php

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

/**
 * Enum Severity_Level.
 */
abstract class Severity_Level
{
    public const Verbose     = 0;
    public const Information = 1;
    public const Warning     = 2;
    public const Error       = 3;
    public const Critical    = 4;
}
