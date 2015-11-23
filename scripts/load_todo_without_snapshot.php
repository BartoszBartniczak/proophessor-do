<?php
/*
 * This file is part of prooph/proophessor.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 10/26/15 - 8:31 PM
 */
/**
 * Pass a todo id to the script to get the time in milliseconds of how long the event store needs to load the todo
 * without using a snapshot adapter.
 */
namespace {
    use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;
    use Prooph\EventStore\Aggregate\AggregateType;
    use Prooph\EventStore\EventStore;
    use Prooph\ProophessorDo\Infrastructure\Repository\EventStoreTodoList;
    use Prooph\ProophessorDo\Model\Todo\Todo;
    use Prooph\ProophessorDo\Model\Todo\TodoId;
    use Symfony\Component\Stopwatch\Stopwatch;

    chdir(dirname(__DIR__));

    // Setup autoloading
    require 'vendor/autoload.php';

    $container = require 'config/services.php';

    array_shift($argv);

    if (empty($argv)) {
        echo "\033[1;31mMissing todo id parameter!\033[0m\n";
        exit(1);
    }

    $todoId = $argv[0];

    try {
        $todoId = TodoId::fromString($todoId);
    } catch (\Exception $ex) {
        echo "\033[1;31mInvalid todo id given!\033[0m\n";
        exit(1);
    }

    //Set up todo repository by hand to make sure that no snapshot store is used
    $eventStore = $container->get(EventStore::class);

    $todoList = new EventStoreTodoList(
        $eventStore,
        AggregateType::fromAggregateRootClass(Todo::class),
        new AggregateTranslator()
    );

    $stopWatch = new Stopwatch();

    $stopWatch->start('load_todo');

    $todo = $todoList->get($todoId);

    if (null === $todo) {
        echo "\033[1;31mTodo could not be found!\033[0m\n";
        exit(1);
    }

    $loadTodoEvent = $stopWatch->stop('load_todo');

    echo "Todo was loaded in \033[1m".$loadTodoEvent->getDuration()."\033[0m ms\n";
}
