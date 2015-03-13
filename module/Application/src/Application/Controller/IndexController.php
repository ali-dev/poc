<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use \Application\Entity\Video;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {

        $objectManager = $this
            ->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');
        var_dump($objectManager); exit;
        $video = new Video();
        $video->setTitle("Speakaboos Video");
        $video->setFileName('small');

        $this->entity()->persist($video);
//        $this->entity()->flush();
        exit;
//        exit;
        return new ViewModel();
    }
}
