<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="video_tag")
 * @author Ali Abu El haj <ali.abulhaj@gmail.com>
 */
class VideoTag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Video", inversedBy="videoTags")
     * @ORM\JoinColumn(name="video_id", referencedColumnName="id")
     * @var Video
     **/
    protected $video;

    /**
     * @ORM\ManyToOne(targetEntity="Tag", inversedBy="videoTags")
     * @ORM\JoinColumn(name="tag_id", referencedColumnName="id")
     * @var Tag
     **/
    protected $tag;

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
     * @param Video $video
     * @return $this
     */
    public function setVideo(Video $video)
    {
        $this->video = $video;
        return $this;
    }

    /**
     * @return Video
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param Tag $tag
     * @return $this
     */
    public function setTag(Tag $tag)
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }


}