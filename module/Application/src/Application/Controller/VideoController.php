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
use \Doctrine\Orm\EntityManager;

class VideoController extends AbstractActionController
{


    public function listAction()
    {
        $videosRepository = $this->getEntityManager()->getRepository('\Application\Entity\Video');

        return [
            'videos' => $videosRepository->findAll()
        ];

    }

    public function viewAction()
    {
        $videoId = (int) $this->params()->fromRoute('id', 0);

        return [
            'video' => $this->getEntityManager()->find('\Application\Entity\Video', $videoId)
        ];
    }

    /**
     * Get the entity Manager
     *
     * @return EntityManager
     */
    private function getEntityManager()
    {
        return $this
            ->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');
    }
}
