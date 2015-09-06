<?php
/*
 * This file is part of prooph/proophessor.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 9/6/15 - 1:22 PM
 */
namespace Prooph\Proophessor\App\Action;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateInterface;

/**
 * Class UserRegistration
 *
 * @package Prooph\Proophessor\App\Action
 */
final class UserRegistration
{
    /**
     * @var TemplateInterface
     */
    private $templates;

    /**
     * @param TemplateInterface $templates
     */
    public function __construct(TemplateInterface $templates)
    {
        $this->templates = $templates;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param callable $next
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        return new HtmlResponse(
            $this->templates->render('page::user-registration')
        );
    }
}
 