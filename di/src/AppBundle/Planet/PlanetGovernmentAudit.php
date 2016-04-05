<?php

namespace AppBundle\Planet;

class PlanetGovernmentAudit
{
    /**
     * @var PlanetGovernment
     */
    private $planetGovernment;

    /**
     * Constructor
     * @param PlanetGovernment $planetGovernment
     */
    public function __construct(PlanetGovernment $planetGovernment)
    {
        $this->planetGovernment = $planetGovernment;
    }

    /**
     * @return PlanetGovernment
     */
    public function getPlanetGovernment()
    {
        return $this->planetGovernment;
    }
}
