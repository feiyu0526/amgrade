<?php

namespace AlexDoctrine\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


use AlexDoctrine\Entity\Goods;

use Zend\Http\Client\Adapter\Curl;
use Zend\Http\Client as HttpClient;
use Zend\Console\Request as ConsoleRequest;

use Zend\Dom\Query;

class CronController extends AbstractActionController
{

    protected $emService;
    protected $maxPage = 2;
    private $message = '';

    /**
     *  the main method which allow to see form and customer list under the form
     * @return view object with form and customers
     *
     */
    public function indexAction()
    {
        $request = $this->getRequest();

        // Make sure that we are running in a console and the user has not tricked our
        // application into running this action from a public web server.
        if (!$request instanceof ConsoleRequest){
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $this->message = '';

        $cronInfoArr = $this->emService->getEntityManager()->getRepository('AlexDoctrine\Entity\Cron')->findBy(
            array('status' => NULL), array('id' => 'ASC'), 1, 0);

        if ( empty($cronInfoArr) ) {
            return "no tasks";
        }

        foreach ($cronInfoArr as $key => $oneCronTask)
        {
             // change status for that selected tasks to working
            $oneCronTask->setStatus('working');

            $category = $oneCronTask->getCategory();     //bike

            for($page = 1; $page <= $this->maxPage; $page++) {
                $isOkay = $this->getContent($category, $page);
                if ( $isOkay ) {
                    //everything is okay

                } else {
                    // was error and that error
                    //change status
                    $oneCronTask->setStatus('error');
                    $oneCronTask->setError($this->message);
                    //skipp this task and donot need to grab from next page if we have next page
                    break;
                }

            }
            //if status not error we need to change status
            if ( $oneCronTask->getStatus() == 'working' ) {
                $oneCronTask->setStatus('finish');
            }

            //execute sql
           $this->emService->getEntityManager()->flush();


        }
        return 'Done !';

    }

    private function getContent($category, $page)
    {
        $url = 'http://market.yandex.ua/search.xml?text='.$category.'&cvredirect=2&page='.$page;

        $client = new HttpClient();
        $client->setAdapter('Zend\Http\Client\Adapter\Curl');

        $response = $this->getResponse();
        //set content-type
       // $response->getHeaders()->addHeaderLine('content-type', 'text/html; charset=utf-8');

        $client->setUri($url);
        $result = $client->send();

        if ( $result->isSuccess() )
        {
            //success

            //content of the web
            $bodyHTML = $result->getBody();

            $dom = new Query($bodyHTML);
            $whatIneedBlock = $dom->execute('.b-offers__list>div');

            foreach($whatIneedBlock as $key=>$r)
            {
                 $good = new Goods();

                //this is big photo
                 $good->setImage($r->getElementsByTagName("img")->item(0)->getAttribute('src'));
                //this is link
                 $good->setLinkToOriginal($r->getElementsByTagName("a")->item(0)->getAttribute('href'));
                 //this is price
                 if ($r->firstChild->nextSibling->firstChild->firstChild->lastChild->nodeName == 'b') {
                     $price = $r->firstChild->nextSibling->firstChild->firstChild->lastChild->lastChild->previousSibling->nodeValue;
                 } else {
                    $price = $r->firstChild->nextSibling->firstChild->firstChild->lastChild->previousSibling->nodeValue;
                 }
                 $good->setPrice($price);
                 //this is currency
                 $good->setCurrency($r->firstChild->nextSibling->firstChild->firstChild->lastChild->nodeValue);
                 //this is description
                 $good->setDescription( ($r->lastChild->firstChild->nextSibling->nodeValue));
                 //this is title
                 $title = $r->lastChild->firstChild->firstChild->nodeValue;
                 $good->setTitle($title);
                 //mds title
                 $mdtitle = md5($title);
                 $good->setMdTitle($mdtitle);
                 //check if this good already exist
                 $ifExist = $this->emService->getEntityManager()->getRepository('AlexDoctrine\Entity\Goods')->findBy(
                     array('mdTitle' => $mdtitle));

                 // if doesnot exist we need to add it
                 if (  ! isset($ifExist[0]) ) {

                     $this->emService->getEntityManager()->persist($good);
                 }
                 unset($good);

            }

            return true;

        } else {
            //error need to stop parsing
            $this->message = $result->getStatusCode() . ': ' . $result->getReasonPhrase();
            return false;
        }

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
