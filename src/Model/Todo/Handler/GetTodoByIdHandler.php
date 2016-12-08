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

namespace Prooph\ProophessorDo\Model\Todo\Handler;

use Prooph\ProophessorDo\Model\Todo\Query\GetTodoById;
use Prooph\ProophessorDo\Projection\Todo\TodoFinder;
use React\Promise\Deferred;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
final class GetTodoByIdHandler
{
    private $todoFinder;

    public function __construct(TodoFinder $todoFinder)
    {
        $this->todoFinder = $todoFinder;
    }

    public function __invoke(GetTodoById $query, Deferred $deferred = null)
    {
        $todo = $this->todoFinder->findById($query->todoId());
        if (null === $deferred) {
            return $todo;
        }

        $deferred->resolve($todo);
    }
}
