<?php

declare(strict_types=1);

namespace ApplicationInsights\Traits;

use Ds\Map;

trait HasPropertiesTrait
{
    private Map $_properties;

    public function getProperty(string $key): mixed
    {
        return $this->getProperties()->get($key);
    }

    public function getProperties(): Map
    {
        return $this->_properties ??= new Map();
    }

    public function setProperties(iterable $properties): void
    {
        $this->_properties = new Map($properties);
    }

    public function setProperty(string $property, mixed $value): void
    {
        $this->getProperties()->put($property, $value);
    }
}
