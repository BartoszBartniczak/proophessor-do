<?php
/*
 * This file is part of prooph/proophessor.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 9/6/15 - 7:52 PM
 */
namespace Prooph\ProophessorDo\Container\App\Action;

use Interop\Container\ContainerInterface;
use Prooph\ProophessorDo\App\Action\UserTodoForm;
use Prooph\ServiceBus\QueryBus;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class UserTodoFormFactory
 *
 * @package Prooph\ProophessorDo\Container\App\Action
 */
final class UserTodoFormFactory
{
    /**
     * @param ContainerInterface $container
     * @return UserTodoForm
     */
    public function __invoke(ContainerInterface $container)
    {
        return new UserTodoForm($container->get(TemplateRendererInterface::class), $container->get(QueryBus::class));
    }
}
