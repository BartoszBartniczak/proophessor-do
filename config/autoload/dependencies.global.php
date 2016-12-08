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

use Prooph\EventSourcing\Container\Aggregate\AggregateRepositoryFactory;
use Zend\Expressive\Application;
use Zend\Expressive\Container\ApplicationFactory;
use Zend\Expressive\Helper;

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            // Fully\Qualified\InterfaceName::class => Fully\Qualified\ClassName::class,
            Helper\ServerUrlHelper::class => Helper\ServerUrlHelper::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            Application::class => ApplicationFactory::class,
            Helper\UrlHelper::class => Helper\UrlHelperFactory::class,
            'doctrine.connection.default' => \Prooph\ProophessorDo\Container\Infrastructure\DoctrineDbalConnectionFactory::class,
            \Zend\Mail\Transport\TransportInterface::class => \Prooph\ProophessorDo\Container\App\Mail\TransportFactory::class,
            // Action middleware
            \Prooph\ProophessorDo\App\Action\Home::class => \Prooph\ProophessorDo\Container\App\Action\HomeFactory::class,
            \Prooph\ProophessorDo\App\Action\UserList::class => \Prooph\ProophessorDo\Container\App\Action\UserListFactory::class,
            \Prooph\ProophessorDo\App\Action\UserRegistration::class => \Prooph\ProophessorDo\Container\App\Action\UserRegistrationFactory::class,
            \Prooph\ProophessorDo\App\Action\UserTodoList::class => \Prooph\ProophessorDo\Container\App\Action\UserTodoListFactory::class,
            \Prooph\ProophessorDo\App\Action\UserTodoForm::class => \Prooph\ProophessorDo\Container\App\Action\UserTodoFormFactory::class,
            // Model
            \Prooph\ProophessorDo\Model\User\Handler\RegisterUserHandler::class => \Prooph\ProophessorDo\Container\Model\User\RegisterUserHandlerFactory::class,
            \Prooph\ProophessorDo\Model\User\Service\ChecksUniqueUsersEmailAddress::class => \Prooph\ProophessorDo\Container\Model\User\ChecksUniqueUsersEmailAddressFactory::class,
            \Prooph\ProophessorDo\Model\User\UserCollection::class => [AggregateRepositoryFactory::class, 'user_collection'],
            \Prooph\ProophessorDo\Model\Todo\Handler\PostTodoHandler::class => \Prooph\ProophessorDo\Container\Model\Todo\PostTodoHandlerFactory::class,
            \Prooph\ProophessorDo\Model\Todo\Handler\MarkTodoAsDoneHandler::class => \Prooph\ProophessorDo\Container\Model\Todo\MarkTodoAsDoneHandlerFactory::class,
            \Prooph\ProophessorDo\Model\Todo\Handler\ReopenTodoHandler::class => \Prooph\ProophessorDo\Container\Model\Todo\ReopenTodoHandlerFactory::class,
            \Prooph\ProophessorDo\Model\Todo\Handler\AddDeadlineToTodoHandler::class => \Prooph\ProophessorDo\Container\Model\Todo\AddDeadlineToTodoHandlerFactory::class,
            \Prooph\ProophessorDo\Model\Todo\Handler\AddReminderToTodoHandler::class => \Prooph\ProophessorDo\Container\Model\Todo\AddReminderToTodoHandlerFactory::class,
            \Prooph\ProophessorDo\Model\Todo\Handler\MarkTodoAsExpiredHandler::class => \Prooph\ProophessorDo\Container\Model\Todo\MarkTodoAsExpiredHandlerFactory::class,
            \Prooph\ProophessorDo\Model\Todo\Handler\RemindTodoAssigneeHandler::class => \Prooph\ProophessorDo\Container\Model\Todo\RemindTodoAssigneeHandlerFactory::class,
            \Prooph\ProophessorDo\Model\Todo\TodoList::class => [AggregateRepositoryFactory::class, 'todo_list'],
            // Projections
            \Prooph\ProophessorDo\Projection\User\UserProjector::class => \Prooph\ProophessorDo\Container\Projection\User\UserProjectorFactory::class,
            \Prooph\ProophessorDo\Projection\User\UserFinder::class => \Prooph\ProophessorDo\Container\Projection\User\UserFinderFactory::class,
            \Prooph\ProophessorDo\Projection\Todo\TodoProjector::class => \Prooph\ProophessorDo\Container\Projection\Todo\TodoProjectorFactory::class,
            \Prooph\ProophessorDo\Projection\Todo\TodoFinder::class => \Prooph\ProophessorDo\Container\Projection\Todo\TodoFinderFactory::class,
            \Prooph\ProophessorDo\Projection\Todo\TodoReminderFinder::class => \Prooph\ProophessorDo\Container\Projection\Todo\TodoReminderFinderFactory::class,
            \Prooph\ProophessorDo\Projection\Todo\TodoReminderProjector::class => \Prooph\ProophessorDo\Container\Projection\Todo\TodoReminderProjectorFactory::class,
            // Subscriber
            \Prooph\ProophessorDo\ProcessManager\SendTodoReminderMailProcessManager::class => \Prooph\ProophessorDo\Container\ProcessManager\SendTodoReminderMailSubscriberFactory::class,
            \Prooph\ProophessorDo\ProcessManager\SendTodoDeadlineExpiredMailProcessManager::class => \Prooph\ProophessorDo\Container\ProcessManager\SendTodoDeadlineExpiredMailSubscriberFactory::class,
            // Query
            \Prooph\ProophessorDo\Model\User\Handler\GetAllUsersHandler::class => \Prooph\ProophessorDo\Container\Model\User\GetAllUsersHandlerFactory::class,
            \Prooph\ProophessorDo\Model\User\Handler\GetUserByIdHandler::class => \Prooph\ProophessorDo\Container\Model\User\GetUserByIdHandlerFactory::class,
            \Prooph\ProophessorDo\Model\Todo\Handler\GetTodoByIdHandler::class => \Prooph\ProophessorDo\Container\Model\Todo\GetTodosByAssigneeIdHandlerFactory::class,
            \Prooph\ProophessorDo\Model\Todo\Handler\GetTodosByAssigneeIdHandler::class => \Prooph\ProophessorDo\Container\Model\Todo\GetTodosByAssigneeIdHandlerFactory::class,
        ],
    ],
];
