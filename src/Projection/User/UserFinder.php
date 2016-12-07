<?php
/**
 * This file is part of prooph/proophessor-do.
 * (c) 2014-2016 prooph software GmbH <contact@prooph.de>
 * (c) 2015-2016 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Prooph\ProophessorDo\Projection\User;

use Prooph\ProophessorDo\Projection\Table;
use Doctrine\DBAL\Connection;

/**
 * Class UserFinder
 *
 * @package Prooph\ProophessorDo\Projection\User
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class UserFinder
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->connection->setFetchMode(\PDO::FETCH_OBJ);
    }

    /**
     * @return \stdClass[] containing userData
     */
    public function findAll()
    {
        return $this->connection->fetchAll(sprintf("SELECT * FROM %s", Table::USER));
    }

    /**
     * @param $userId
     * @return null|\stdClass containing userData
     */
    public function findById($userId)
    {
        $stmt = $this->connection->prepare(sprintf("SELECT * FROM %s WHERE id = :user_id", Table::USER));
        $stmt->bindValue('user_id', $userId);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * @param string $emailAddress User's email address
     * @return null|\stdClass containing userData
     */
    public function findOneByEmailAddress($emailAddress)
    {
        $stmt = $this->connection->prepare(sprintf('SELECT * FROM %s WHERE email = :email LIMIT 1', Table::USER));
        $stmt->bindValue('email', $emailAddress);
        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * @param $todoId
     * @return null|\stdClass containing userData
     */
    public function findUserOfTodo($todoId)
    {
        $stmt = $this->connection->prepare(sprintf(
            "SELECT u.* FROM %s as u JOIN %s as t ON u.id = t.assignee_id WHERE t.id = :todo_id",
            Table::USER,
            Table::TODO
        ));
        $stmt->bindValue('todo_id', $todoId);
        $stmt->execute();
        return $stmt->fetch();
    }
}
