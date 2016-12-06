<?php
/**
 * This file is part of prooph/proophessor-do.
 * (c) 2014-2016 prooph software GmbH <contact@prooph.de>
 * (c) 2015-2016 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Prooph\ProophessorDo\Container\Projection\Todo;

use Interop\Container\ContainerInterface;
use Prooph\ProophessorDo\Projection\Todo\TodoReminderFinder;

/**
 * Class TodoFinderFactory
 *
 * @package Prooph\ProophessorDo\Projection\Todo
 * @author Roman Sachse <r.sachse@ipark-media.de>
 */
final class TodoReminderFinderFactory
{
    /**
     * @param ContainerInterface $container
     * @return TodoReminderFinder
     */
    public function __invoke(ContainerInterface $container)
    {
        return new TodoReminderFinder($container->get('doctrine.connection.default'));
    }
}
