<?php
/** @noinspection PhpUnused */

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

/**
 * Data contract class for type Cloud.
 */
class Cloud extends Base_Data
{
    public const CLOUD_ROLE_NAME     = 'ai.cloud.role';
    public const CLOUD_ROLE_INSTANCE = 'ai.cloud.roleInstance';

    protected static string $_name = 'ai.cloud.name';

    /**
     * Gets the role field. Name of the role the application is a part of. Maps directly to the role name in azure.
     */
    public function getRole(): ?string
    {
        if ($this->_data->hasKey(self::CLOUD_ROLE_NAME)) {
            return $this->_data->get(self::CLOUD_ROLE_NAME);
        }
        return null;
    }

    /**
     * Sets the role field. Name of the role the application is a part of. Maps directly to the role name in azure.
     */
    public function setRole(?string $role): void
    {
        $this->_data->put(self::CLOUD_ROLE_NAME, $role);
    }

    /**
     * Gets the roleInstance field.
     * Name of the instance where the application is running.
     * Computer name for on-premises, instance name for Azure.
     */
    public function getRoleInstance(): ?string
    {
        if ($this->_data->hasKey(self::CLOUD_ROLE_INSTANCE)) {
            return $this->_data->get(self::CLOUD_ROLE_INSTANCE);
        }
        return null;
    }

    /**
     * Sets the roleInstance field.
     * Name of the instance where the application is running.
     * Computer name for on-premises, instance name for Azure.
     */
    public function setRoleInstance(?string $roleInstance): void
    {
        $this->_data->put(self::CLOUD_ROLE_INSTANCE, $roleInstance);
    }
}
