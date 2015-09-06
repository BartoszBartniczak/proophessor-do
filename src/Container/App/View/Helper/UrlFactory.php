<?php
/*
 * This file is part of prooph/proophessor.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 9/6/15 - 1:02 PM
 */
namespace Prooph\Proophessor\Container\App\View\Helper;

use Interop\Container\ContainerInterface;
use Prooph\Proophessor\App\View\Helper\Url;
use Zend\Expressive\Router\RouterInterface;

/**
 * Class UrlFactory
 *
 * @package Prooph\Proophessor\Container\App\View\Helper
 */
final class UrlFactory
{
    /**
     * @param ContainerInterface $container
     * @return Url
     */
    public function __invoke(ContainerInterface $container)
    {
        return new Url($container->get(RouterInterface::class));
    }
}
