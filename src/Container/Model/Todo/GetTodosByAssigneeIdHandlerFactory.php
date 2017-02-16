<?php
/**
 * This file is part of prooph/proophessor-do.
 * (c) 2014-2017 prooph software GmbH <contact@prooph.de>
 * (c) 2015-2017 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Prooph\ProophessorDo\Container\Model\Todo;

use Prooph\ProophessorDo\Model\Todo\Handler\GetTodosByAssigneeIdHandler;
use Prooph\ProophessorDo\Projection\Todo\TodoFinder;
use Psr\Container\ContainerInterface;

class GetTodosByAssigneeIdHandlerFactory
{
    public function __invoke(ContainerInterface $container): GetTodosByAssigneeIdHandler
    {
        return new GetTodosByAssigneeIdHandler($container->get(TodoFinder::class));
    }
}
