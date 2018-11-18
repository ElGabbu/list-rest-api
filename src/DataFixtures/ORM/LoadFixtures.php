<?php
declare(strict_types=1);

namespace ListRestAPI\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use ListRestAPI\DataFixtures\ORM\Loader\CustomNativeLoader;

class LoadFixtures extends Fixture
{
    private const FIXTURE_FILES = [
        __DIR__ . '/Fixtures/surveys_fixtures.yaml',
        __DIR__ . '/Fixtures/partner_fixtures.yaml',
    ];

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $loader = new CustomNativeLoader();
        $objects = $loader->loadFiles(self::FIXTURE_FILES)->getObjects();

        foreach ($objects as $object) {
            $manager->persist($object);
        }

        $manager->flush();
    }
}
