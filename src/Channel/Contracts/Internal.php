<?php
/** @noinspection PhpUnused */

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

/**
 * Data contract class for type Internal.
 */
class Internal extends Base_Data
{
    public const INTERNAL_SDK_VERSION = 'ai.internal.sdkVersion';
    public const AGENT_VERSION        = 'ai.internal.agentVersion';
    public const INTERNAL_NODE_NAME   = 'ai.internal.nodeName';

    protected static string $_name = 'ai.internal.name';

    /**
     * Gets the sdkVersion field 'SDK version'
     * @see https://github.com/Microsoft/ApplicationInsights-Home/blob/master/SDK-AUTHORING.md#sdk-version-specification
     */
    public function getSdkVersion(): ?string
    {
        if ($this->_data->hasKey(self::INTERNAL_SDK_VERSION)) {
            return $this->_data->get(self::INTERNAL_SDK_VERSION);
        }
        return null;
    }

    /**
     * Sets the sdkVersion field 'SDK version'.
     * @see https://github.com/Microsoft/ApplicationInsights-Home/blob/master/SDK-AUTHORING.md#sdk-version-specification
     */
    public function setSdkVersion(string $sdkVersion): void
    {
        $this->_data->put(self::INTERNAL_SDK_VERSION, $sdkVersion);
    }

    /**
     * Gets the agentVersion field.
     * Agent version.
     * Used to indicate the version of StatusMonitor installed on the computer if it is used for data collection.
     */
    public function getAgentVersion(): ?string
    {
        if ($this->_data->hasKey(self::AGENT_VERSION)) {
            return $this->_data->get(self::AGENT_VERSION);
        }
        return null;
    }

    /**
     * Sets the agentVersion field.
     * Agent version.
     * Used to indicate the version of StatusMonitor installed on the computer if it is used for data collection.
     */
    public function setAgentVersion(string $agentVersion): void
    {
        $this->_data->put(self::AGENT_VERSION, $agentVersion);
    }

    /**
     * Gets the nodeName field.
     * This is the node name used for billing purposes.
     * Use it to override the standard detection of nodes.
     */
    public function getNodeName(): ?string
    {
        if ($this->_data->hasKey(self::INTERNAL_NODE_NAME)) {
            return $this->_data->get(self::INTERNAL_NODE_NAME);
        }
        return null;
    }

    /**
     * Sets the nodeName field.
     * This is the node name used for billing purposes.
     * Use it to override the standard detection of nodes.
     */
    public function setNodeName(string $nodeName): void
    {
        $this->_data->put(self::INTERNAL_NODE_NAME, $nodeName);
    }
}
