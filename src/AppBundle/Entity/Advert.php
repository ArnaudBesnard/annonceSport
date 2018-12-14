<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Advert
 *
 * @ORM\Table(name="advert")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdvertRepository")
 */
class Advert
{
    public function __construct()
    {
        // Par défaut, la date de l'annonce est la date d'aujourd'hui
        $this->postedAt = new \Datetime();
    }
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Categories", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\Type("string")
     * @Assert\Length(
     *      min = 2,
     *      max = 25,
     *      minMessage = "Le titre doit contenir au minimum {{ limit }} caractères",
     *      maxMessage = "Le titre doit contenir au maximum {{ limit }} caractères"
     * )
     */
    private $title;
    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\Type("string")
     * @Assert\Length(
     *      min = 10,
     *      max = 500,
     *      minMessage = "Le descriptif de l'annonce doit contenir au minimum {{ limit }} caractères",
     *      maxMessage = "Le descriptif de l'annonce doit contenir au maximum {{ limit }} caractères"
     * )
     */
    private $content;
    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer")
     * @Assert\Type(
     *     type="numeric",
     *     message="la valeur du prix : {{ value }} n'est pas valide."
     * )
     * @Assert\Range(
     *      min = 0,
     *      minMessage = "La valeur du prix doit être supérieur ou égal à {{ limit }}",
     * )
     */
    private $price;
    /**
     * @var string
     *
     * @ORM\Column(name="department", type="string", length=255)
     */
    private $department;
    /**
     * @ORM\Column(name="city", type="string", length=255)
     * @Assert\Type("string")
     * @Assert\Length(
     *      min = 3,
     *      max = 35,
     *      minMessage = "La ville doit contenir au minimum {{ limit }} caractères",
     *      maxMessage = "La ville doit contenir au maximum {{ limit }} caractères"
     * )
    */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email(
     *     message = "l'adresse '{{ value }}' n'est pas une adresse email valide.",
     *     checkMX = true
     * )
     */
    private $email;
    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255, nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="le numero de téléphone : {{ value }} n'est pas valide."
     * )
     */
    private $tel;
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Image", cascade={"persist", "remove"})
     */
    private $image;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="postedAt", type="datetime")
     */
    private $postedAt;
    /**
     * @var bool
     *
     * @ORM\Column(name="published", type="boolean")
     */
    private $published = false;
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
     * @return Advert
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
    /**
     * Get title
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * Set content
     *
     * @param string $content
     *
     * @return Advert
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }
    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Advert
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
    /**
     * Get price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }
    /**
     * Set email
     *
     * @param string $email
     *
     * @return Advert
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * Set postedAt
     *
     * @param \DateTime $postedAt
     *
     * @return Advert
     */
    public function setPostedAt($postedAt)
    {
        $this->postedAt = $postedAt;
        return $this;
    }
    /**
     * Get postedAt
     *
     * @return \DateTime
     */
    public function getPostedAt()
    {
        return $this->postedAt;
    }
    /**
     * Set published
     *
     * @param boolean $published
     *
     * @return Advert
     */
    public function setPublished($published)
    {
        $this->published = $published;
        return $this;
    }
    /**
     * Get published
     *
     * @return bool
     */
    public function getPublished()
    {
        return $this->published;
    }
    /**
     * Set category
     *
     * @param string $category
     *
     * @return Advert
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }
    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * Set author
     *
     * @param string $author
     *
     * @return Advert
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }
    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }
    /**
     * Set department
     *
     * @param string $department
     *
     * @return Advert
     */
    public function setDepartment($department)
    {
        $this->department = $department;
        return $this;
    }
    /**
     * Get department
     *
     * @return string
     */
    public function getDepartment()
    {
        return $this->department;
    }
    /**
     * Set city
     *
     * @param string $city
     *
     * @return Advert
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }
    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }
    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Advert
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
        return $this;
    }
    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }
    /**
     * Set image
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return Advert
     */
    public function setImage(\AppBundle\Entity\Image $image = null)
    {
        $this->image = $image;
        return $this;
    }
    /**
     * Get image
     *
     * @return \AppBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }


}
