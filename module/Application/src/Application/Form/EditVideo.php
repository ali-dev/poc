<?php
/**
 * EditVideo Form
 * @package Application\Form
 * @author Ali Abu El Haj <aaelhaj@nerdery.com>
 */
namespace Application\Form;

use Zend\Form\Form;
use \Application\Entity\Video;
/**
 * EditVideo Form
 * @package Application\Form
 */
class EditVideo extends Form
{
    /**
     * @var Video
     */
    protected $video;

    /**
     * constructor
     */
    public function __construct($video)
    {
        $this->video = $video;
        parent::__construct('editVideo');
        $this->setAttributes(
            array(
                'method' => 'post',
                'class'  => 'form-horizontal',
            )
        );
        $this->add(array(
            'name' => 'title',
            'attributes' => array(
                'type'  => 'text',
                'value' => $this->getVideo()->getTitle(),
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Title',
                'class' => 'col-sm-2 control-label'
            ),
        ));
        $this->add(array(
            'name' => 'videoFileName',
            'attributes' => array(
                'type'  => 'text',
                'value' => $this->getVideo()->getVideoFileName(),
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Video Filename',
            ),
        ));

        $this->add(array(
            'name' => 'vttFileName',
            'attributes' => array(
                'type'  => 'text',
                'value' => $this->getVideo()->getVttFileName(),
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'WebVTT Filename',
            ),
        ));


        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'class' => 'btn',
                'type'  => 'submit',
                'value' => 'Submit',
                'id' => 'submitbutton',
            ),
        ));
    }

    /**
     * @param Video $video
     */
    public function setVideo($video)
    {
        $this->video = $video;
    }

    /**
     * @return Video
     * @throws \Exception
     */
    public function getVideo()
    {
        if ($this->video === null) {
            throw new \Exception('Invalid Video');
        }
        return $this->video;
    }


    /**
     * Persist data to the video entity
     */
    public function persistData()
    {
         return $this->getVideo()
            ->setTitle($this->get('title')->getValue())
            ->setVideoFileName($this->get('videoFileName')->getValue())
            ->setVttFileName($this->get('vttFileName')->getValue()) ;
    }
}