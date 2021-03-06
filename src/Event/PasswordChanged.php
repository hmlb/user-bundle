<?php

declare (strict_types = 1);

namespace HMLB\UserBundle\Event;

use HMLB\DDD\Entity\Identity;

final class PasswordChanged extends UserEvent
{
    /**
     * @var Identity
     */
    private $userId;

    /**
     * @var string
     */
    private $oldPassword;

    /**
     * @var string
     */
    private $newPassword;

    public function __construct(Identity $userId, string $oldPassword, string $newPassword)
    {
        $this->userId = $userId;
        $this->oldPassword = $oldPassword;
        $this->newPassword = $newPassword;
    }

    /**
     * @return string
     */
    public function getOldPassword(): string
    {
        return $this->oldPassword;
    }

    /**
     * @return string
     */
    public function getNewPassword(): string
    {
        return $this->newPassword;
    }

    /**
     * @return Identity
     */
    public function getUserId(): Identity
    {
        return $this->userId;
    }
}
