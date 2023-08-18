<?php

namespace App\DataFixtures;

use App\Factory\ManufacturerFactory;
use App\Factory\VehicleModelFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $manufacturer = ManufacturerFactory::createOne(
            [
                'id' => 1,
                'brandName' => 'Mercedes',
            ]
        );
        $manager->flush();
        $vehicleModel = VehicleModelFactory::createOne(
            [
                'id' => 1,
                'modelName' => 'GLE 450',
                'manufacturer' => $manufacturer,
            ]
        );
    }
}
