<?php
namespace Application\Fixture;

use \Application\Entity\Video;
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
            $video->setTitle("Speakaboos Video {$i}");
            $video->setFileName('small');
            $manager->persist($video);
            echo ".";
        }

        $manager->flush();
    }

}