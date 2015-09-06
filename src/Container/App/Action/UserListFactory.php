<?php
/*
 * This file is part of prooph/proophessor.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 9/6/15 - 1:19 PM
 */
namespace Prooph\Proophessor\Container\App\Action;

use Interop\Container\ContainerInterface;
use Prooph\Proophessor\App\Action\UserList;
use Prooph\Proophessor\Projection\User\UserFinder;
use Zend\Expressive\Template\TemplateInterface;

/**
 * Class UserListFactory
 *
 * @package Prooph\Proophessor\Container\App\Action
 */
final class UserListFactory
{
    /**
     * @param ContainerInterface $container
     * @return UserList
     */
    public function __invoke(ContainerInterface $container)
    {
        return new UserList($container->get(TemplateInterface::class), $container->get(UserFinder::class));
    }
}
