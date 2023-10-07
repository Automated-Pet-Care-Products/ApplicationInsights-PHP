<?php

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

use DateTimeInterface;
use JsonSerializable;

/**
 * Contains utilities for contract classes
 */
class Utils
{
    public const T_DATETIME_FORMAT = DateTimeInterface::RFC3339_EXTENDED;

    /**
     * Removes NULL and empty collections
     */
    public static function removeEmptyValues(iterable $sourceArray): iterable
    {
        foreach ($sourceArray as $key => $value) {
            if ((is_array($value) && sizeof($value) === 0) || is_null($value)) {
                unset($sourceArray[$key]);
            }
        }

        return $sourceArray;
    }

    /**
     * Serialization helper.
     */
    public static function getUnderlyingData(iterable $dataItems): iterable
    {
        foreach ($dataItems as $key => $dataItem) {
            if ($dataItem instanceof JsonSerializable) {
                $dataItems[$key] = Utils::getUnderlyingData($dataItem->jsonSerialize());
            } elseif (is_iterable($dataItem)) {
                $dataItems[$key] = Utils::getUnderlyingData($dataItem);
            } else {
                $dataItems[$key] = $dataItem;
            }
        }

        return $dataItems;
    }

    /**
     * Converts milliseconds to a timespan string as accepted by the backend
     */
    public static function convertMillisecondsToTimeSpan(int $milliseconds): string
    {
        if ($milliseconds == null || $milliseconds < 0 || !is_numeric($milliseconds)) {
            $milliseconds = 0;
        }

        $ms = $milliseconds % 1000;
        $sec = floor($milliseconds / 1000) % 60;
        $min = floor($milliseconds / (1000 * 60)) % 60;
        $hour = floor($milliseconds / (1000 * 60 * 60)) % 24;

        $ms   = strlen((string)$ms) == 1 ? '00' . $ms : (strlen((string)$ms) === 2 ? '0' . $ms : $ms);
        $sec  = strlen((string)$sec) < 2 ? '0' . $sec : $sec;
        $min  = strlen((string)$min) < 2 ? '0' . $min : $min;
        $hour = strlen((string)$hour) < 2 ? '0' . $hour : $hour;

        return $hour . ':' . $min . ':' . $sec . '.' . $ms;
    }

    /**
     * Returns a Guid on all flavors of PHP. Copied from the PHP manual: http://php.net/manual/en/function.com-create-guid.php
     */
    public static function returnGuid(): string
    {
        if (extension_loaded('com')) {
            /** @noinspection PhpComposerExtensionStubsInspection */
            return trim(com_create_guid(), '{}');
        }

        return sprintf(
            '%04X%04X-%04X-%04X-%04X-%04X%04X%04X',
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(16384, 20479),
            mt_rand(32768, 49151),
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(0, 65535)
        );
    }
}
