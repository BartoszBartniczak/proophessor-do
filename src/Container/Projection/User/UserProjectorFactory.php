<?php
/*
 * This file is part of prooph/proophessor.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 5/2/15 - 11:50 PM
 */
namespace Prooph\Proophessor\Container\Projection\User;

use Interop\Container\ContainerInterface;
use Prooph\Proophessor\Projection\User\UserProjector;

/**
 * Class UserProjectorFactory
 *
 * @package Prooph\Proophessor\Projection\User
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class UserProjectorFactory
{
    /**
     * @param ContainerInterface $container
     * @return UserProjector
     */
    public function __invoke(ContainerInterface $container)
    {
        return new UserProjector($container->get('doctrine.connection.default'));
    }
}
