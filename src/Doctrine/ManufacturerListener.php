<?php

namespace App\Doctrine;

use App\Entity\Manufacturer;

class ManufacturerListener
{
    public function postLoad(Manufacturer $manufacturer): void
    {
        $manufacturer->setTempData('FOO!!');
    }
}
