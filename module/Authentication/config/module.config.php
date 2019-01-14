<?php

namespace Authentication;

use Zend\Authentication\AuthenticationService;
use Zend\Router\Http\Literal;

return [
    'router' => [
        'routes' => [
            'login' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/login',
                    'defaults' => [
                        'controller' => Controller\AuthenticationController::class,
                        'action'     => 'login',
                    ],
                ],
            ],
            'logout' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/logout',
                    'defaults' => [
                        'controller' => Controller\AuthenticationController::class,
                        'action'     => 'logout',
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'factories' => [
            Controller\AuthenticationController::class => Controller\Factory\AuthenticationControllerFactory::class,
        ],
    ],

    'service_manager' => [
        'factories' => [
            AuthenticationService::class         => Service\Factory\AuthenticationServiceFactory::class,
            Service\AuthenticationAdapter::class => Service\Factory\AuthenticationAdapterFactory::class,
            Service\AuthenticationManager::class => Service\Factory\AuthenticationManagerFactory::class,
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
