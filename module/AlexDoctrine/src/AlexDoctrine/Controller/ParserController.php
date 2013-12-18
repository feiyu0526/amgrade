<?php

namespace AlexDoctrine\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Form\Annotation\AnnotationBuilder;

use AlexDoctrine\Entity\Cron;
use AlexDoctrine\Entity\Categories;

class ParserController extends AbstractActionController
{
 /**
     *  the main method which allow to see form and calls list under the form
     * @return view object with form and calls
     *
     */
    public function indexAction()
    {
        $formManager = $this->serviceLocator->get('FormElementManager');
        $form = $formManager->get('categoriesform');



        $request = $this->getRequest();
        if ($request->isPost()){

            $category = new Categories();
            $form->bind($category);
            $form->setData($request->getPost());
            if ($form->isValid()){
                //here i insert this new task to cron table
                $category = $form->getData()->getCategory();

                $cron = new Cron();
                $cron->setCategory($category);
                $this->emService->getEntityManager()->persist($cron);
                $this->emService->getEntityManager()->flush();
                $this->emService->getEntityManager()->clear();

                $this->flashMessenger()->addMessage('Task created','addTask');
				return $this->prg('AlexDoctrine-2');

            }
        }

        //get messages if we have
        $msgArr = $this->flashMessenger()->getMessages('addTask');
        if ( empty($msgArr) ) {
            $msg = '';
        } else {
            $msg = $msgArr[0];
        }

        //get all tasks to show them in table
        $tasksArr = $this->emService->getEntityManager()->getRepository('AlexDoctrine\Entity\Cron')->findAllToArray();

       return array(
            'form'=>$form,
            'messages' => $msg,
            'tasks'=>$tasksArr
        );
    }


    /**
     * set entity manager to val of this class
     * @param type $service
     */
    public function setEMService($service)
    {
		$this->emService = $service;
    }

}
