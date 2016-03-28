<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Framework;
use Symfony\Component\HttpFoundation\Response;

class DecidedByVotersController extends Controller
{
    /**
     * @Framework\Route("/random-access", name="show_random_access_page")
     */
    public function showRandomAccessAction()
    {
        $this->denyAccessUnlessGranted('show-random-access-page');

        return new Response('Access allowed');
    }
}
