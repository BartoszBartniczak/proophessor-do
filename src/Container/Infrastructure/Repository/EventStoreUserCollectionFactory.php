<?php
/*
 * This file is part of prooph/proophessor.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 5/2/15 - 5:27 PM
 */
namespace Prooph\ProophessorDo\Container\Infrastructure\Repository;

use Interop\Container\ContainerInterface;
use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;
use Prooph\EventStore\Aggregate\AggregateType;
use Prooph\EventStore\Container\Aggregate\AbstractAggregateRepositoryFactory;
use Prooph\EventStore\EventStore;
use Prooph\ProophessorDo\Infrastructure\Repository\EventStoreUserCollection;
use Prooph\ProophessorDo\Model\User\User;

/**
 * Class EventStoreUserCollectionFactory
 *
 * @package Application\Infrastructure\Repository\Factory
 */
final class EventStoreUserCollectionFactory extends AbstractAggregateRepositoryFactory
{
    /**
     * Returns the container identifier
     *
     * @return string
     */
    public function containerId()
    {
        return 'user_collection';
    }
}
