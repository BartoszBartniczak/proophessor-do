<?php

namespace Prooph\ProophessorDo\Container\App\Mail;

use Interop\Container\ContainerInterface;
use Prooph\ProophessorDo\App\Mail\SendTodoDeadlineExpiredMailSubscriber;
use Prooph\ProophessorDo\Projection\Todo\TodoFinder;
use Prooph\ProophessorDo\Projection\User\UserFinder;
use Zend\Mail\Transport\TransportInterface;


/**
 * Class SendTodoDeadlineExpiredMailSubscriberFactory
 *
 * @package Prooph\ProophessorDo\Container\Model\Todo
 * @author Michał Żukowski <michal@durooil.com>
 */
final class SendTodoDeadlineExpiredMailSubscriberFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new SendTodoDeadlineExpiredMailSubscriber(
            $container->get(UserFinder::class),
            $container->get(TodoFinder::class),
            $container->get(TransportInterface::class)
        );
    }
}
