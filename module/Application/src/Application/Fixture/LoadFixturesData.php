<?php
namespace Application\Fixture;

use Application\Entity\Tag;
use \Application\Entity\Video;
use Application\Entity\VideoTag;
use \Doctrine\Common\Persistence\ObjectManager;
use \Doctrine\Common\DataFixtures\FixtureInterface;

/**
 * Load Data fixtures for all entities
 *
 * @package Application\Fixture
 * @author Ali ABu El Haj <ali.abulhaj@gmail.com>
 */
class LoadFixturesData implements FixtureInterface
{
    /**
     * load fixtures
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i < 100; $i++) {
            $video = new Video();
            $video->setTitle("Speakaboos Video {$i}")
                  ->setVideoFileName('small')
                  ->setVttFileName('vtt-test.vtt');

            $manager->persist($video);
        }
        echo "Saving Videos \n";
        $manager->flush();
        for($i = 1; $i < 10; $i++) {
            $tag = new Tag();
            $tag->setName("Tag {$i}");

            $manager->persist($tag);

        }
        echo "Saving Tags \n";
        $manager->flush();

        $videosRepository = $manager->getRepository('\Application\Entity\Video');
        foreach($videosRepository->findAll() as $video) {
            $videoTag = new VideoTag();
            $videoTag->setVideo($video);
            $videoTag->setTag($tag);
            $manager->persist($videoTag);
        }
        echo "Saving VideoTags \n";
        $manager->flush();

    }

}