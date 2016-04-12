<?php

namespace AppBundle\Planet;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class PlanetGovernmentAuditManager
{
    /**
     * @var PlanetGovernmentAudit
     */
    private $audit;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * Constructor.
     * @param PlanetGovernmentAudit $audit
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(PlanetGovernmentAudit $audit,
        EntityManagerInterface $entityManager)
    {
        $this->audit = $audit;
        $this->entityManager = $entityManager;
    }

    /**
     * @return PlanetGovernmentAudit
     */
    public function getAudit()
    {
        return $this->audit;
    }
}
