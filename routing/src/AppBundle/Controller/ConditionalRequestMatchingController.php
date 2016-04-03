<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ConditionalRequestMatchingController extends Controller
{
    /**
     * @Route(
     *     "/", name="homepage_for_firefox_users",
     *     condition="request.headers.get('User-Agent') matches '/firefox/i'"
     * )
     *
     */
    public function firefoxAction()
    {
        $userAgent = 'Firefox';
        return $this->render('default/index.html.twig', [
            'user_agent' => $userAgent
        ]);
    }

    /**
     * @Route(
     *     "/", name="homepage_for_chrome_users",
     *     condition="request.headers.get('User-Agent') matches '/chrome/i'"
     * )
     *
     */
    public function chromeAction()
    {
        $userAgent = 'Chrome';
        return $this->render('default/index.html.twig', [
            'user_agent' => $userAgent
        ]);
    }

    /**
     * @Route(
     *     "/", name="homepage",
     * )
     * @param Request $request
     *
     * @return Response
     */
    public function otherUserAgentAction(Request $request)
    {
        $userAgent = $request->headers->get('User-Agent');
        return $this->render('default/index.html.twig', [
            'user_agent' => $userAgent
        ]);
    }


}
