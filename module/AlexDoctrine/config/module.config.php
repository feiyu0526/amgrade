<?php
namespace AlexDoctrine;

use AlexDoctrine\Controller\GoodsController;
use AlexDoctrine\Controller\ParserController;
use AlexDoctrine\Controller\CronController;
use AlexDoctrine\Controller\AjaxController;

return array(
    'controllers' => array(
        'factories' => array(
            'AlexDoctrine\Controller\Goods' => function($serviceLocator)
            {
                $ctr = new GoodsController();
                $ctr->setEMService(
                    $serviceLocator->getServiceLocator()->get('emservice')
                );
                return $ctr;
            },
            'AlexDoctrine\Controller\Parser' => function($serviceLocator)
            {
                $ctr = new ParserController();
                $ctr->setEMService(
                    $serviceLocator->getServiceLocator()->get('emservice')
                );
                return $ctr;
            },
            'AlexDoctrine\Controller\Cron' => function($serviceLocator)
            {
                $ctr = new CronController();
                $ctr->setEMService(
                    $serviceLocator->getServiceLocator()->get('emservice')
                );
                return $ctr;
            },
            'AlexDoctrine\Controller\Ajax' => function($serviceLocator)
            {
                $ctr = new AjaxController();
                $ctr->setEMService(
                    $serviceLocator->getServiceLocator()->get('emservice')
                );
                return $ctr;
            }
        ),
//        'invokables' => array(
//            'AlexDoctrine\Controller\Rss' => 'AlexDoctrine\Controller\RssController'
//        ),
    ),

    'router' => array(
        'routes' => array(
            'AlexDoctrine-1' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/goods[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'AlexDoctrine\Controller\Goods',
                        'action'     => 'index',
                    ),
                ),

            ),
            'AlexDoctrine-2' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/parser[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'AlexDoctrine\Controller\Parser',
                        'action'     => 'index',
                    ),
                ),
            ),
            'AlexDoctrine-3' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/cron[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'AlexDoctrine\Controller\Cron',
                        'action'     => 'index',
                    ),
                ),
            ),
            'AlexDoctrine-4' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/ajax[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'AlexDoctrine\Controller\Ajax',
                        'action'     => 'index',
                    ),
                ),
            ),

        ),
    ),

    'console' => array(
        'router' => array(
            'routes' => array(
                'cron' => array(
                    'options' => array(
                        'route'    => 'execute cron',
                        'defaults' => array(
                            'controller' => 'AlexDoctrine\Controller\Cron',
                            'action'     => 'index'
                        )
                    )
                )
            )
        )
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'alexdoctrine' => __DIR__ . '/../view',
        ),
    ),
        // Doctrine config
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'emservice' => function ($sl) {
                $entityManager = $sl->get('Doctrine\ORM\EntityManager');
                $myService = new Service\EMService();
                $myService->setEntityManager($entityManager);
                return $myService;
            },
        ),
    ),


);

