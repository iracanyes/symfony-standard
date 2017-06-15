<?php

namespace ISL\AgendaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Events
 *
 * @ORM\Table(name="events")
 * @ORM\Entity(repositoryClass="ISL\AgendaBundle\Repository\EventsRepository")
 */
class Events
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
     * @ORM\Column(name="nom", type="string", length=100)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut", type="datetime")
     */
    private $debut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="datetime")
     */
    private $fin;

    /**
     * @var object
     * 
     * @ORM\OneToOne(targetEntity="ISL\AgendaBundle\Entity\Image", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $image;
    
    /**
     * @var object
     * 
     * @ORM\ManyToOne(targetEntity="ISL\AgendaBundle\Entity\Categories", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;
    
    /**
     * @var ArrayCollection
     * 
     * @ORM\ManyToMany(targetEntity="ISL\AgendaBundle\Entity\User", cascade={"persist"})
     * @ORM\JoinTable(name="event_has_user")
     * 
     */
    private $user;
    
    /**
     * Get categories
     *
     * @return object
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set categories
     *
     * @param \ISL\AgendaBundle\Categories $category
     *
     * @return Events
     */
    public function setCategories(Categories $category)
    {
        $this->categories = $category;

        return $this;
    }
    
    /**
     * Get user
     *
     * @return ArrayCollection
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * Add user
     * 
     * @param \ISL\Exe2Bundle\Entity\User $user
     */
    public function addUser(User $user) {
        $this->user[] = $user;
    }
    
    /**
     * Remove user
     * 
     * @param \ISL\Exe2Bundle\Entity\User $user
     */
    public function removeUser(User $user) {
        $this->user->removeElement($user);
    }
    
    public function __construct() {
        $this->user = new ArrayCollection();
    }
    
    /**
     * Get image
     *
     * @return object
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set image
     *
     * @param \ISL\AgendaBundle\Image $image
     *
     * @return Events
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Events
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Events
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set debut
     *
     * @param \DateTime $debut
     *
     * @return Events
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut
     *
     * @return \DateTime
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin
     *
     * @param \DateTime $fin
     *
     * @return Events
     */
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime
     */
    public function getFin()
    {
        return $this->fin;
    }
}

