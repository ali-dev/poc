<?php
namespace Application\Controller;

use Application\Form\EditVideo;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use \Application\Entity\Video;
use \Doctrine\Orm\EntityManager;

/**
 * Video Controller - List, view, edit and vtt actions
 *
 * @package \Application\Controller
 */
class VideoController extends AbstractActionController
{

    /**
     * List videos action
     *
     * @return array
     */
    public function listAction()
    {
        $videosRepository = $this->getEntityManager()->getRepository('\Application\Entity\Video');

        return [
            'videos' => $videosRepository->findAll()
        ];

    }

    /**
     * View video Action
     *
     * @return array
     */
    public function viewAction()
    {
        $videoId = (int) $this->params()->fromRoute('id', 0);

        return [
            'video' => $this->getEntityManager()->find('\Application\Entity\Video', $videoId)
        ];
    }


    /**
     * Edit Video Action
     *
     * @return array|\Zend\Http\Response
     */
    public function editAction()
    {
        $videoId = (int) $this->params()->fromRoute('id', 0);
        $entityManager = $this->getEntityManager();
        /** @var Video $video */
        $video = $entityManager->find('\Application\Entity\Video', $videoId);
        $form = new EditVideo($video);

        $request = $this->getRequest();
        if ($request->isPost()) {

            $form->setInputFilter($video->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $form->persistData();
                $entityManager->persist($video);
                $entityManager->flush();
                return $this->redirect()->toRoute('video-list');
            }
        }
        return array(
            'form' => $form,
            'video' => $video,
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
     * Solr Search - search videos by title
     */
    public function searchAction()
    {
        $searchTerm = $this->params()->fromPost('term');
        /** @var \Solarium\Client $client */
        $client = $this->serviceLocator->get('Solarium\Client');

        // get a select query instance
        $query = $client->createSelect();
        $query->setQuery($searchTerm);
        $query->setRows(1000);
        // this executes the query and returns the result
        $resultSet = $client->select($query);
        ;



        return ['resultSet' => $resultSet];

    }

    public function exportToSolrAction()
    {
        /** @var \Solarium\Client $client */
        $client = $this->serviceLocator->get('Solarium\Client');

        $update = $client->createUpdate();

        $videosRepository = $this->getEntityManager()->getRepository('\Application\Entity\Video');
        $docs = [];
        foreach($videosRepository->findAll() as $video) {
            // create Solr documents
            // create a new document for the data
            $doc = $update->createDocument();

            $doc->id = $video->getId();
            $doc->title = $video->getTitle();

            $docs[] = $doc;

        }
        $update->addDocuments($docs);

        $update->addCommit();

        // this executes the query and returns the result
        $result = $client->update($update);
        echo '<b>Update query executed</b><br/>';
        echo 'Query status: ' . $result->getStatus(). '<br/>';
        echo 'Query time: ' . $result->getQueryTime();
        exit;
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
