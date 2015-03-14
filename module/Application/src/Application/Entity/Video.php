<?php
namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="video")
 */
class Video
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


}