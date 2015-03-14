<?php
namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="video")
 */
class Video implements InputFilterAwareInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $title;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $videoFileName;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $vttFileName;

    /**
     * @ORM\OneToMany(targetEntity="VideoTag", mappedBy="video")
     * @var VideoTag
     **/
    private $videoTags;

    /**
     * @ORM\OneToMany(targetEntity="UserVideo", mappedBy="video")
     * @var VideoTag
     **/
    private $userVideos;

    protected $inputFilter;


    public function __construct() {
        $this->videoTags = new ArrayCollection();
        $this->userVideos = new ArrayCollection();
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $title
     * return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $fileName
     * @return $this
     */
    public function setVideoFileName($fileName)
    {
        $this->videoFileName = $fileName;
        return $this;
    }

    /**
     * @param string $vttFileName
     * @return $this;
     */
    public function setVttFileName($vttFileName)
    {
        $this->vttFileName = $vttFileName;
        return $this;
    }

    /**
     * @return string
     */
    public function getVttFileName()
    {
        return $this->vttFileName;
    }



    /**
     * @return string
     */
    public function getVideoFileName()
    {
        return $this->videoFileName;
    }

    /**
     * @param $videoTag
     */
    public function addVideoTag($videoTag)
    {
        $this->videoTags->add($videoTag);
    }

    /**
     * @param \Application\Entity\VideoTag $videoTags
     */
    public function setVideoTags($videoTags)
    {
        $this->videoTags = $videoTags;
    }

    /**
     * @return \Application\Entity\VideoTag
     */
    public function getVideoTags()
    {
        return $this->videoTags;
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();



            $inputFilter->add(array(
                'name'     => 'title',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    // Add content to these methods:
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }




}