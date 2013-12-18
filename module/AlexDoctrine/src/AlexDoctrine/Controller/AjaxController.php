<?php

namespace AlexDoctrine\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use AlexDoctrine\Entity\Cron;

use Zend\Json\Json;

class AjaxController extends AbstractActionController
{

    /**
     *  the main method which allow to change task status
     * @return object with response field and error
     *
     */
    public function updateCronStatusAction()
    {

           // first check if it is ajax
        if (!$this->getRequest()->isXmlHttpRequest()) {
                return array();
        }

        $response = $this->getResponse();

        $id = (int) $this->getRequest()->getPost('id');

        if ( ! $id )
        {
            $response->setContent(Json::encode(array('response' => '','error'=>'not valid id')));
        }

        $entityManager = $this->emService->getEntityManager();
        //get call using id
        $task= $entityManager->find('AlexDoctrine\Entity\Cron', $id);
        if ( ! $task ) {
            $response->setContent(Json::encode(array('response' => '','error'=>'coudnot find task with id = '.$id)));
            return $response;
        }
        $task->setStatus(NULL);

        $entityManager->flush();
        $response->setContent(Json::encode(array('response' => true,'error'=>'')));
        return $response;

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
