<?php

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

/**
 * Enum Data_Point_Type.
 */
abstract class Data_Point_Type
{
    public const Measurement = 0;
    public const Aggregation = 1;
}
