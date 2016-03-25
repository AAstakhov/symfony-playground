<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration as Framework;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessControlController extends Controller
{
    /**
     * @Framework\Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }

    /**
     * @Framework\Route("/admin", name="admin")
     */
    public function adminAction(Request $request)
    {
        return new Response('<html><body>Admin section</body></html>');
    }

    /**
     * @Framework\Route("/member", name="member")
     */
    public function memberAction(Request $request)
    {
        return new Response('<html><body>Member section</body></html>');
    }
}
