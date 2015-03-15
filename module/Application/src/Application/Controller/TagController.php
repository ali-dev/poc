<?php
namespace Application\Controller;

use Application\Form\EditTag;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use \Application\Entity\Tag;
use \Doctrine\Orm\EntityManager;

/**
 * Tags Controller - List, edit actions
 *
 * @package \Application\Controller
 */
class TagController extends AbstractActionController
{
    /**
     * List tags action
     *
     * @return array
     */
    public function listAction()
    {
        $tagsRepository = $this->getEntityManager()->getRepository('\Application\Entity\Tag');
        return [
            'tags' => $tagsRepository->findAll()
        ];

    }


    /**
     * Edit Tag
     *
     * @return array|\Zend\Http\Response
     */
    public function editAction()
    {
        $tagId = (int) $this->params()->fromRoute('id', 0);
        $entityManager = $this->getEntityManager();
        /** @var Tag $tag */
        $tag = $entityManager->find('\Application\Entity\Tag', $tagId);
        $form = new EditTag(array('tag' => $tag));

        $request = $this->getRequest();
        if ($request->isPost() && $form->isValid($request->getPost()->toArray())) {
            $form->persistData();
            $entityManager->persist($tag);
            $entityManager->flush();
            return $this->redirect()->toRoute('tag-list');
        }
        return array(
            'form' => $form,
            'tag' => $tag,
        );
    }

    /**
     * VttAction - retrieves VTT file for a video
     *
     * @return \Zend\Stdlib\ResponseInterface
     */
    public function vttAction()
    {
        $videoId = (int) $this->params()->fromRoute('id', 0);
        $video = $this->getEntityManager()->find('\Application\Entity\Video', $videoId);
        $fileName = $video->getVttFileName();
        $fileContents = file_get_contents(ROOT_PATH."/data/files/{$fileName}");

        $response = $this->getResponse();
        $response->setContent($fileContents);
        $headers = $response->getHeaders();
        $headers->clearHeaders()
            ->addHeaderLine('Content-Type', 'text/vtt')
            ->addHeaderLine('Content-Disposition', 'attachment; filename="' . $fileName . '"')
            ->addHeaderLine('Content-Length', strlen($fileContents));


        return $this->response;
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
