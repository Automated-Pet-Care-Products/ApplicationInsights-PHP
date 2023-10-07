<?php

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

use DateTimeInterface;
use JsonSerializable;

/**
 * Interface class for XXXXX_Data.
 */
interface Data_Interface extends JsonSerializable
{
    public function getEnvelopeTypeName(): ?string;

    public function getDataTypeName(): ?string;

    public function setTime(DateTimeInterface $time): void;

    public function getTime(): DateTimeInterface;

    public function getProperties(): iterable;

    public function setProperties(iterable $properties): void;

    public function getMeasurements(): ?array;

    public function setMeasurements(iterable $measurements): void;

    public function getName(): ?string;

    public function setName(?string $name): void;

    public function setVer(string|int $ver): void;

    public function getVer(): string|int|null;
}
