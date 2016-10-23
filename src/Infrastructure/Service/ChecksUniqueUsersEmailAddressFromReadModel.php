<?php

namespace Prooph\ProophessorDo\Infrastructure\Service;

use Prooph\ProophessorDo\Model\User\EmailAddress;
use Prooph\ProophessorDo\Model\User\Service\ChecksUniqueUsersEmailAddress;
use Prooph\ProophessorDo\Model\User\UserId;
use Prooph\ProophessorDo\Projection\User\UserFinder;

/**
 * Class ChecksUniqueUsersEmailAddressFromReadModel
 *
 * @package Prooph\ProophessorDo\Infrastructure\Service
 * @author Lucas Courot <lucas@courot.com>
 */
final class ChecksUniqueUsersEmailAddressFromReadModel implements ChecksUniqueUsersEmailAddress
{
    /**
     * @var UserFinder
     */
    private $userFinder;

    /**
     * @param UserFinder $userFinder
     */
    public function __construct(UserFinder $userFinder)
    {
        $this->userFinder = $userFinder;
    }

    /**
     * @param EmailAddress $emailAddress
     * @return null|UserId
     */
    public function __invoke(EmailAddress $emailAddress)
    {
        if ($user = $this->userFinder->findOneByEmailAddress($emailAddress->toString())) {
            return UserId::fromString($user->id);
        }
    }
}
