<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topic
 *
 * @ORM\Table(name="topic")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TopicRepository")
 */
class Topic
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAdded", type="date")
     */
    private $dateAdded;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiryDate", type="date", nullable=true)
     */
    private $expiryDate;

    /**
     * @var string
     *
     * @ORM\Column(name="priority", type="string", length=255)
     */
    private $priority;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=5000)
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="addedTopic")
     * @ORM\JoinColumn(name="user_added", referencedColumnName="id")
     */
    private $userAdded;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="responsibleTopic")
     * @ORM\JoinColumn(name="user_responsible", referencedColumnName="id")
     */
    private $userResponsible;

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
     * Set name
     *
     * @param string $name
     *
     * @return Topic
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     *
     * @return Topic
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return \DateTime
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * Set expiryDate
     *
     * @param \DateTime $expiryDate
     *
     * @return Topic
     */
    public function setExpiryDate($expiryDate)
    {
        $this->expiryDate = $expiryDate;

        return $this;
    }

    /**
     * Get expiryDate
     *
     * @return \DateTime
     */
    public function getExpiryDate()
    {
        return $this->expiryDate;
    }

    /**
     * Set priority
     *
     * @param string $priority
     *
     * @return Topic
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Topic
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set userAdded
     *
     * @param \AppBundle\Entity\User $userAdded
     *
     * @return Topic
     */
    public function setUserAdded(\AppBundle\Entity\User $userAdded = null)
    {
        $this->userAdded = $userAdded;

        return $this;
    }

    /**
     * Get userAdded
     *
     * @return \AppBundle\Entity\User
     */
    public function getUserAdded()
    {
        return $this->userAdded;
    }

    /**
     * Set userResponsible
     *
     * @param \AppBundle\Entity\User $userResponsible
     *
     * @return Topic
     */
    public function setUserResponsible(\AppBundle\Entity\User $userResponsible = null)
    {
        $this->userResponsible = $userResponsible;

        return $this;
    }

    /**
     * Get userResponsible
     *
     * @return \AppBundle\Entity\User
     */
    public function getUserResponsible()
    {
        return $this->userResponsible;
    }
}
