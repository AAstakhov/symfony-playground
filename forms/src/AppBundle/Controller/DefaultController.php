<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Author;
use AppBundle\Entity\Book;
use AppBundle\Form\Type\AuthorType;
use AppBundle\Form\Type\BookType;
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
        $repository = $this->getDoctrine()->getRepository('AppBundle:Book');
        $books = $repository->findAll();

        return $this->render('books.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * @Framework\Route("/authors/{id}", defaults={"id" = null}, name="edit-author")
     *
     * @param Request $request
     * @param Author $author
     *
     * @return Response
     */
    public function editOrCreateAuthorAction(Request $request, Author $author = null)
    {
        $this->checkIfEntityExists($request, $author);

        if(null === $author) {
            $author = new Author();
        }

        $form = $this->createForm(AuthorType::class, $author);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->saveEntity($author);

            $this->addFlash('notice', 'Author is created');

            return $this->redirectToRoute('show-result');
        }

        return $this->render('author.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Framework\Route("/books/{id}", defaults={"id" = null}, name="edit-book")
     *
     * @param Request $request
     * @param Book $book
     *
     * @return Response
     */
    public function editOrCreateBookAction(Request $request, Book $book = null)
    {
        $this->checkIfEntityExists($request, $book);

        if(null === $book) {
            $book = new Book();
        }

        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->saveEntity($book);

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

    /**
     * @param Request $request
     * @param $entity
     */
    protected function checkIfEntityExists(Request $request, $entity)
    {
        if (null !== $request->get('id') && null === $entity) {
            throw $this->createNotFoundException();
        }
    }

    /**
     * @param $entity
     */
    protected function saveEntity($entity)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
    }
}
