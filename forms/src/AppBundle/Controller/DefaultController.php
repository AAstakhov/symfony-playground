<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Author;
use AppBundle\Entity\Book;
use AppBundle\Form\Type\AuthorType;
use AppBundle\Form\Type\BookType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Framework;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

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
     * @Framework\Method({"GET", "POST"})
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

            $this->addFlash('notice', $author->getId() ? 'Author is updated' : 'Author is created');

            return $this->redirectToRoute('show-result');
        }

        return $this->render('author.html.twig', [
            'form' => $form->createView(),
            'author' => $author,
        ]);
    }

    /**
     * @Framework\Route("/books/{id}", defaults={"id" = null}, name="edit-book")
     * @Framework\Method({"GET", "POST"})
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

        $uploadDir = $this->getParameter('kernel.root_dir') . '/../web/images/books';

        if($form->isSubmitted() && $form->isValid()) {
            $this->saveEntity($book);
            $book->upload($uploadDir);

            $this->addFlash('notice', $book->getId() ? 'Book is updated' : 'Book is created');

            return $this->redirectToRoute('show-result');
        }

        return $this->render('book.html.twig', [
            'form' => $form->createView(),
            'book' => $book,
            'image_dir' => '/images/books',
        ]);
    }

    /**
     * @Framework\Route("/confirmations/book/{id}", name="confirm-delete-book")
     *
     * @param Book $book
     *
     * @return Response
     */
    public function showDeleteBookAction(Book $book)
    {
        $deleteForm = $this->createDeleteForm($book);

        return $this->render('confirmation.html.twig',
            ['form' => $deleteForm->createView()]);
    }

    /**
     * @Framework\Route("/books/{id}", name="delete-book")
     * @Framework\Method("DELETE")
     *
     * @param Request $request
     * @param Book $book
     *
     * @return Response
     */
    public function deleteBookAction(Request $request, Book $book)
    {
        $deleteForm = $this->createDeleteForm($book);

        $deleteForm->handleRequest($request);

        if($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $this->deleteEntity($book);

            $this->addFlash('notice', 'Book is deleted');

            return $this->redirectToRoute('show-result');
        }

        throw new BadRequestHttpException();
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

    /**
     * @param $entity
     */
    protected function deleteEntity($entity)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();
    }

    /**
     * @param Book $book
     *
     * @return Form
     */
    protected function createDeleteForm(Book $book)
    {
        $deleteForm = $this->createFormBuilder(['id' => $book->getId()])
            ->setAction($this->generateUrl('delete-book', ['id' => $book->getId()]))
            ->setMethod('DELETE')
            //->add('id', HiddenType::class)
            ->add('delete', SubmitType::class)
            ->getForm();

        return $deleteForm;
    }
}
