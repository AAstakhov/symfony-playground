<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $earthGovernment = $this->get('app.planet.earth_government');
        $marsGovernment = $this->get('app.planet.mars_government');
        $uranusGovernment = $this->get('app.planet.uranus_government');

        $governmentAudit = $this->get('app.planet.government_audit');

        return $this->render('default/index.html.twig', [
            'governments' => [$earthGovernment, $marsGovernment, $uranusGovernment],
            'government_audit' => $governmentAudit,
        ]);
    }
}
