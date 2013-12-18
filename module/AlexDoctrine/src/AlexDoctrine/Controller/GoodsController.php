<?php

namespace AlexDoctrine\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class GoodsController extends AbstractActionController
{

    protected $emService;


 /**
     *  the main method which allow to see form and calls list under the form
     * @return view object with form and calls
     *
     */
    public function indexAction()
    {

        $goodsArr = $this->emService->getEntityManager()->getRepository('AlexDoctrine\Entity\Goods')->findAllToArray();

        return new ViewModel(array(
            'allGoods' => $goodsArr
           )
        );

    }

    /**
     * set entity manager to this class var
     * @param type $service
     */
    public function setEMService($service)
    {
		$this->emService = $service;
    }


}
