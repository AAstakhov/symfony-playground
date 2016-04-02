<?php

namespace AppBundle\Factory;

use AppBundle\Model\Planet;
use AppBundle\Planet\PlanetGovernment;

class PlanetGovernmentFactory
{
    /**
     * @param string $name
     *
     * @return PlanetGovernment
     */
    public static function createPlanetGovernment($name)
    {
        $planet = new Planet($name);

        $government = new PlanetGovernment($planet);

        return $government;
    }
}