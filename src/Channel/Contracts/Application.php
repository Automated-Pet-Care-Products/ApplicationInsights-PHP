<?php

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

/**
 * Data contract class for type Application.
 */
class Application extends Base_Data
{
    protected static string $_name       = 'ai.application.name';
    protected static string $_versionKey = 'ai.application.ver';
}
