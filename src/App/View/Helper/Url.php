<?php
/*
 * This file is part of prooph/proophessor.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 9/6/15 - 12:59 PM
 */
namespace Prooph\Proophessor\App\View\Helper;

use Zend\Expressive\Router\RouterInterface;

/**
 * Class Url
 *
 * @package Prooph\Proophessor\App\View\Helper
 */
final class Url
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @param string $routeName
     * @param array $options
     * @return string
     */
    public function __invoke($routeName, $options = [])
    {
        return $this->router->generateUri($routeName, $options);
    }
}
