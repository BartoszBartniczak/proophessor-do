<?php
/**
 * This file is part of prooph/proophessor-do.
 * (c) 2014-2016 prooph software GmbH <contact@prooph.de>
 * (c) 2015-2016 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Prooph\ProophessorDo\Container\Model\Todo;

use Interop\Container\ContainerInterface;
use Prooph\ProophessorDo\Model\Todo\Handler\ReopenTodoHandler;
use Prooph\ProophessorDo\Model\Todo\TodoList;

/**
 * Class ReopenTodoFactory
 *
 * @package Application\Infrastructure\HandlerFactory
 * @author  Bas Kamer <bas@bushbaby.nl>
 */
final class ReopenTodoHandlerFactory
{
    /**
     * @param ContainerInterface $container
     * @return ReopenTodoHandlerFactory
     */
    public function __invoke(ContainerInterface $container)
    {
        return new ReopenTodoHandler(
            $container->get(TodoList::class)
        );
    }
}
