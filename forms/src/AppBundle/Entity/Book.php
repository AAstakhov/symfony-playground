<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BookRepository")
 *
 * @DoctrineAssert\UniqueEntity("isbn")
 */
class Book
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=1000)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="isbn", type="string", length=13, unique=true)
     *
     * @Assert\Isbn(type="isbn10")
     */
    private $isbn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published", type="datetime")
     */
    private $published;

    /**
     * @var UploadedFile
     *
     * @Assert\File(maxSize="6000000")
     */
    private $coverImageFile;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Author", inversedBy="books")
     */
    private $authors;

    /**
     * Book constructor
     */
    public function __construct()
    {
        $this->authors = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set isbn
     *
     * @param string $isbn
     *
     * @return Book
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn
     *
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set published
     *
     * @param \DateTime $published
     *
     * @return Book
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return \DateTime
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * @return ArrayCollection
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * @param ArrayCollection $authors
     *
     * @return $this
     */
    public function setAuthors($authors)
    {
        $this->authors = $authors;

        return $this;
    }

    /**
     * @param Author $author
     */
    public function addAuthor(Author $author)
    {
        $this->authors->add($author);
    }

    /**
     * @return UploadedFile
     */
    public function getCoverImageFile()
    {
        return $this->coverImageFile;
    }

    /**
     * @param UploadedFile $coverImageFile
     */
    public function setCoverImageFile(UploadedFile $coverImageFile)
    {
        $this->coverImageFile = $coverImageFile;
    }

    /**
     * @return bool
     *
     * @Assert\IsTrue(
     *     message="Book must have less that 2 authors",
     *     groups={"Special"}
     * )
     */
    public function hasLessThanTwoAuthors()
    {
        return count($this->authors) < 2;
    }

    /**
     * @param string $uploadDir
     */
    public function upload($uploadDir)
    {
        if (null === $this->getCoverImageFile()) {
            return;
        }

        $this->getCoverImageFile()->move($uploadDir, $this->getId());

        $this->coverImageFile = null;
    }
}
