<?php
/*
 * This file is part of prooph/proophessor.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 5/2/15 - 11:44 PM
 */
namespace Prooph\Proophessor\Projection\User;

use Prooph\Proophessor\Model\Todo\Event\TodoWasMarkedAsDone;
use Prooph\Proophessor\Model\Todo\Event\TodoWasPosted;
use Prooph\Proophessor\Model\User\Event\UserWasRegistered;
use Prooph\Proophessor\Projection\Table;
use Doctrine\DBAL\Connection;

/**
 * Class UserProjector
 *
 * @package Prooph\Proophessor\Projection\User
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class UserProjector
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var UserFinder
     */
    private $userFinder;

    /**
     * @param Connection $connection
     * @param UserFinder $userFinder
     */
    public function __construct(Connection $connection, UserFinder $userFinder)
    {
        $this->connection = $connection;
        $this->userFinder = $userFinder;
    }

    /**
     * @param UserWasRegistered $event
     */
    public function onUserWasRegistered(UserWasRegistered $event)
    {
        $this->connection->insert(Table::USER, [
            'id' => $event->userId()->toString(),
            'name' => $event->name(),
            'email' => $event->emailAddress()->toString()
        ]);
    }

    /**
     * Increases the open_todos counter of the assignee by one
     *
     * @param TodoWasPosted $event
     */
    public function onTodoWasPosted(TodoWasPosted $event)
    {
        $stmt = $this->connection->prepare(sprintf('UPDATE %s SET open_todos = open_todos + 1 WHERE id = :assignee_id', Table::USER));

        $stmt->bindValue('assignee_id', $event->assigneeId()->toString());

        $stmt->execute();
    }

    public function onTodoWasMarkedAsDone(TodoWasMarkedAsDone $event)
    {
        $user = $this->userFinder->findUserOfTodo($event->todoId()->toString());

        if (! $user) {
            throw new \RuntimeException(
                sprintf(
                    "Data of the assigned user of the todo %s cannot be found",
                    $event->todoId()->toString()
                )
            );
        }

        $stmt = $this->connection->prepare(sprintf('UPDATE %s SET open_todos = open_todos - 1, done_todos = done_todos + 1 WHERE id = :assignee_id', Table::USER));

        $stmt->bindValue('assignee_id', $user->id);

        $stmt->execute();
    }
}
