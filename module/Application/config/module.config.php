<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'raffle-prizes' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/raffle-prizes',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'rafflePrizes',
                    ],
                ],
            ],
        ],
    ],

    'console' => [
        'router' => [
            'routes' => [
                'send-money' => [
                    'options' => [
//                        'route'    => 'send [all|disabled|deleted]:mode money [--verbose|-v]',
                        'route'    => 'send money [all|disabled|deleted]:mode [--verbose|-v]',
                        'defaults' => [
                            'controller' => Controller\ConsoleController::class,
                            'action'     => 'send-money-to-user-bank-account',
                        ],
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'factories' => [
            Controller\IndexController::class   => Controller\Factory\IndexControllerFactory::class,
            Controller\ConsoleController::class => InvokableFactory::class,
        ],
    ],

    'service_manager' => [
        'factories' => [
            Repository\PrizeRepository::class     => Repository\Factory\PrizeRepositoryFactory::class,
            Repository\PrizeTypeRepository::class => Repository\Factory\PrizeTypeRepositoryFactory::class,
        ],
    ],

    'access_filter' => [
        'options' => [
            'mode' => 'restrictive'
        ],
        'controllers' => [
            Controller\IndexController::class => [
                ['actions' => ['index', 'rafflePrizes'],  'allow' => '@'], // Allow authorized users to visit this actions
            ],
        ]
    ],

    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies'   => ['ViewJsonStrategy'],
    ],
];
