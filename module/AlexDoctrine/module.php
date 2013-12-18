<?php

namespace AlexDoctrine;

use DoctrineORMModule\Form\Annotation\AnnotationBuilder as DoctrineAnnotationBuilder;
use Zend\Validator\InArray;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;



class Module implements AutoloaderProviderInterface, ConfigProviderInterface, ConsoleUsageProviderInterface
{

    public function getConsoleBanner(Console $console)
    {
        return
            "==----------------------------------==\n" .
            "    AlexDoctrine module, Version 1.0    \n" .
            "==----------------------------------==\n";
    }

    public function getConsoleUsage(Console $console)
    {
        return array(
            'execute cron' => 'Get one task form DB and using this task start grabbing info from yandex market .',

        );
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getFormElementConfig()
    {
        return array(
            'factories' => array(

                'categoriesForm' => function($sm) {

                    $entityManager = $sm->getServiceLocator()->get('emService')->getEntityManager();
                    $builder = new DoctrineAnnotationBuilder($entityManager);
                    $form = $builder->createForm( 'AlexDoctrine\Entity\Categories' );

//                    add value to this select
                    $categoriesList = $entityManager->getRepository('AlexDoctrine\Entity\Categories')->findAllToArray();
                    $cateroryListForSelect =  $entityManager->getRepository('AlexDoctrine\Entity\Categories')->reBuildCategoriesArrForSelectElement($categoriesList);

                    $existOptions = $form->get('category')->getValueOptions();
                    $form->get('category')->setValueOptions(array_merge($existOptions,$cateroryListForSelect));

                    // get select input
                    $nameInput = $form->getInputFilter()->get('category');

                    // add validation
                    $inArrayValidator = new inArray();
                    $inArrayValidator ->setHaystack(array_keys($cateroryListForSelect));
                    $inArrayValidator ->setMessage('Please Select a category');

                    //attach validation
                    $nameInput->getValidatorChain()->attach($inArrayValidator);
                    $form->setHydrator(new DoctrineHydrator($entityManager,'AlexDoctrine\Entity\Categories', false));
                    return $form;

                },

            ),

        );
    }




}