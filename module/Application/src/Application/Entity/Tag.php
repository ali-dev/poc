<?php
namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tag")
 */
class Tag
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
    protected $name;

    /**
     * @ ORM\OneToMany(targetEntity="videoTag", mappedBy="tag")
     *
     **/
    protected $videoTags;

    public function __construct() {
        $this->videoTags = new ArrayCollection();
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
     * @param string $name
     * return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
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

    /**
     * @param $videoTag
     */
    public function addVideoTag($videoTag)
    {
        $this->videoTags->add($videoTag);
    }
}