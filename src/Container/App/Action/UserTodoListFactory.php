<?php
/*
 * This file is part of prooph/proophessor.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 9/6/15 - 7:07 PM
 */
namespace Prooph\ProophessorDo\Container\App\Action;

use Interop\Container\ContainerInterface;
use Prooph\ProophessorDo\App\Action\UserTodoList;
use Prooph\ServiceBus\QueryBus;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class UserTodoListFactory
 *
 * @package Prooph\ProophessorDo\Container\App\Action
 */
final class UserTodoListFactory
{
    /**
     * @param ContainerInterface $container
     * @return UserTodoList
     */
    public function __invoke(ContainerInterface $container)
    {
        return new UserTodoList(
            $container->get(TemplateRendererInterface::class),
            $container->get(QueryBus::class)
        );
    }
}
