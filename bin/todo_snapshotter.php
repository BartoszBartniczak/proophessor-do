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

namespace Prooph\ProophessorDo;

use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;
use Prooph\EventSourcing\Snapshot\SnapshotStore;
use Prooph\EventStore\EventStore;
use Prooph\ProophessorDo\Model\Todo\TodoList;
use Prooph\Snapshotter\SnapshotReadModel;
use Prooph\Snapshotter\StreamSnapshotProjection;

chdir(dirname(__DIR__));

require_once 'vendor/autoload.php';

$container = require 'config/container.php';
/* @var EventStore $eventStore */

$eventStore = $container->get(EventStore::class);

$readModel = new SnapshotReadModel(
    $container->get(TodoList::class),
    new AggregateTranslator(),
    $container->get(SnapshotStore::class)
);

$projection = new StreamSnapshotProjection(
    $eventStore->createReadModelProjection(
        'todo_snapshotter',
        $readModel
    ),
    'event_stream'
);

$projection();
