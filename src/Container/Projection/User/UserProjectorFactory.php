<?php
/**
 * This file is part of prooph/proophessor-do.
 * (c) 2014-2016 prooph software GmbH <contact@prooph.de>
 * (c) 2015-2016 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Prooph\ProophessorDo\Container\Projection\User;

use Interop\Container\ContainerInterface;
use Prooph\ProophessorDo\Projection\User\UserFinder;
use Prooph\ProophessorDo\Projection\User\UserProjector;

/**
 * Class UserProjectorFactory
 *
 * @package Prooph\ProophessorDo\Projection\User
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
        return new UserProjector(
            $container->get('doctrine.connection.default'),
            $container->get(UserFinder::class)
        );
    }
}
