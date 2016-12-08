<?php
/**
 * This file is part of prooph/proophessor-do.
 * (c) 2014-2016 prooph software GmbH <contact@prooph.de>
 * (c) 2015-2016 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Prooph\ProophessorDo\Model\User;

use Prooph\ProophessorDo\Model\Entity;
use Prooph\ProophessorDo\Model\Todo\Todo;
use Prooph\ProophessorDo\Model\Todo\TodoId;
use Assert\Assertion;
use Prooph\EventSourcing\AggregateRoot;
use Prooph\ProophessorDo\Model\User\Event\UserWasRegistered;
use Prooph\ProophessorDo\Model\User\Event\UserWasRegisteredAgain;

/**
 * Class User
 *
 * A user manages Todos on his or her TodoList. Each user is identified by her user id, has a name and an email address.
 *
 * @package Prooph\ProophessorDo\Model\User
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class User extends AggregateRoot implements Entity
{
    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var EmailAddress
     */
    private $emailAddress;

    /**
     * @param UserId $userId
     * @param string $name
     * @param EmailAddress $emailAddress
     * @return User
     */
    public static function registerWithData(
        UserId $userId,
        $name,
        EmailAddress $emailAddress
    ) {
        $self = new self();

        $self->assertName($name);

        $self->recordThat(UserWasRegistered::withData($userId, $name, $emailAddress));

        return $self;
    }

    /**
     * @param string $name
     * @return User
     */
    public function registerAgain($name)
    {
        $this->assertName($name);

        $this->recordThat(UserWasRegisteredAgain::withData($this->userId, $name, $this->emailAddress));

        return $this;
    }

    /**
     * @return UserId
     */
    public function userId()
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return EmailAddress
     */
    public function emailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param string $text
     * @param TodoId $todoId
     * @return Todo
     */
    public function postTodo($text, TodoId $todoId)
    {
        return Todo::post($text, $this->userId(), $todoId);
    }

    /**
     * @return string representation of the unique identifier of the aggregate root
     */
    protected function aggregateId()
    {
        return $this->userId->toString();
    }

    /**
     * @param UserWasRegistered $event
     */
    protected function whenUserWasRegistered(UserWasRegistered $event)
    {
        $this->userId = $event->userId();
        $this->name = $event->name();
        $this->emailAddress = $event->emailAddress();
    }

    /**
     * @param UserWasRegisteredAgain $event
     */
    protected function whenUserWasRegisteredAgain(UserWasRegisteredAgain $event)
    {
    }

    /**
     * @param string $name
     * @throws Exception\InvalidName
     */
    private function assertName($name)
    {
        try {
            Assertion::string($name);
            Assertion::notEmpty($name);
        } catch (\Exception $e) {
            throw Exception\InvalidName::reason($e->getMessage());
        }
    }

    public function sameIdentityAs(Entity $other)
    {
        return get_class($this) === get_class($other) && $this->userId->sameValueAs($other->userId);
    }
}
