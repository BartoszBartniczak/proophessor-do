<?php

return [
    'dependencies' => [
        'factories' => [
            'Zend\Expressive\FinalHandler' =>
                Zend\Expressive\Container\TemplatedErrorHandlerFactory::class,

            Zend\Expressive\Template\TemplateRendererInterface::class =>
                Zend\Expressive\ZendView\ZendViewRendererFactory::class,

            Zend\View\HelperPluginManager::class =>
                Zend\Expressive\ZendView\HelperPluginManagerFactory::class,
            //Custom view plugins
            \Prooph\ProophessorDo\App\View\Helper\RiotTag::class
                => \Zend\ServiceManager\Factory\InvokableFactory::class,
        ],
    ],

    'templates' => [
        'layout' => 'app::layout',
        'map' => [
            'error/error'    => 'templates/error/error.phtml',
            'error/404'      => 'templates/error/404.phtml',
            //html templates
            'app::layout' => 'templates/layout/layout.phtml',
            'page::home' => 'templates/action/home.phtml',
            'page::user-list' => 'templates/action/user-list.phtml',
            'page::user-registration' => 'templates/action/user-registration-form.phtml',
            'page::user-todo-list' => 'templates/action/user-todo-list.phtml',
            'page::user-todo-form' => 'templates/action/user-todo-form.phtml',
            //riot tags
            'riot::user-form' => 'templates/riot/user-form.phtml',
            'riot::user-todo-form' => 'templates/riot/user-todo-form.phtml',
            'riot::user-todo-list' => 'templates/riot/user-todo-list.phtml',
            'riot::user-todo' => 'templates/riot/user-todo.phtml',
        ],
        'paths' => [
            'app'    => ['templates/app'],
            'layout' => ['templates/layout'],
            'error'  => ['templates/error'],
        ],
    ],
    'view_helpers' => [
        // zend-servicemanager-style configuration for adding view helpers:
        // - 'aliases'
        // - 'invokables'
        // - 'factories'
        // - 'abstract_factories'
        // - etc.
        'invokables' => [
            'riotTag' => \Prooph\ProophessorDo\App\View\Helper\RiotTag::class,
        ]
    ],
];
