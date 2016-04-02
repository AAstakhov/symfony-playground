<?php

namespace AppBundle\Planet;

use AppBundle\Model\Planet;

class PlanetGovernment
{
    /**
     * @var Planet
     */
    private $planet;

    /**
     * Constructor
     * @param Planet $planet
     */
    public function __construct(Planet $planet)
    {
        $this->planet = $planet;
    }

    public function getPlanet()
    {
        return $this->planet;
    }
}