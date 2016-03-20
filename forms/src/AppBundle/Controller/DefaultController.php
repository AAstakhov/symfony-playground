<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Author;
use AppBundle\Entity\Book;
use AppBundle\Form\AuthorType;
use AppBundle\Form\BookType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Framework;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Framework\Route("/", name="homepage")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }

    /**
     * @Framework\Route("/authors", name="new-author")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function newAuthorAction(Request $request)
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($author);
            $em->flush();

            $this->addFlash('notice', 'Author is created');

            return $this->redirectToRoute('show-result');
        }

        return $this->render('author.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Framework\Route("/books", name="new-book")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function newBookAction(Request $request)
    {
        $book = new Book();

        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            $this->addFlash('notice', 'Book is created');

            return $this->redirectToRoute('show-result');
        }

        return $this->render('book.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Framework\Route("/result", name="show-result")
     */
    public function showResultAction()
    {
        return $this->render('result.html.twig');
    }
}
