<?php

namespace BinUtil;

use Laminas\Router\Http\Segment;
use Zend\Mvc\Console;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            Controller\BinUtilController::class => InvokableFactory::class,
        ],
    ],

        
    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'binutil' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/binutil[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\BinUtilController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'binutil/width' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/binutil/width',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\BinUtilController::class,
                        'action'     => 'width',
                    ],
                ],
            ],
        ],
    ],
    
    'view_manager' => [
        'template_path_stack' => [
            'binutil' => __DIR__ . '/../view',
        ],
    ],
];