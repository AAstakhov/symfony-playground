<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TransChoiceController extends Controller
{
    /**
     * @Route("/{_locale}", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $counts = [0, 1, 2, 3, 4, 5, 6, 11, 12, 21, 22, 25, 100];

        return $this->render('default/index.html.twig', [
            'counts' => $counts,
            'user_name' => 'John Doe',
        ]);
    }
}
