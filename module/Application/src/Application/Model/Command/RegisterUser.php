<?php
/*
 * This file is part of prooph/proophessor.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 5/2/15 - 6:01 PM
 */
namespace Application\Model\Command;

use Application\Model\User\EmailAddress;
use Application\Model\User\UserId;
use Prooph\Common\Messaging\Command;

/**
 * Class RegisterUser
 *
 * @package Application\Model\Command
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class RegisterUser extends Command
{
    /**
     * @param string $userId
     * @param string $name
     * @param string $email
     * @return RegisterUser
     */
    public static function withData($userId, $name, $email)
    {
        return new self(__CLASS__, [
            'user_id' => (string)$userId,
            'name' => (string)$name,
            'email' => (string)$email
        ]);
    }

    /**
     * @return UserId
     */
    public function userId()
    {
        return UserId::fromString($this->payload['user_id']);
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->payload['name'];
    }

    /**
     * @return EmailAddress
     */
    public function emailAddress()
    {
        return EmailAddress::fromString($this->payload['email']);
    }
} 