<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="User")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Topic", mappedBy="userAdded")
     */
    private $addedTopic;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Topic", mappedBy="userResponsible")
     */
    private $responsibleTopic;

    public function __construct()
    {
        parent::__construct();
        $this->addedTopic = new ArrayCollection();
        $this->responsibleTopic = new ArrayCollection();
    }

    /**
     * Add addedTopic
     *
     * @param \AppBundle\Entity\Topic $addedTopic
     *
     * @return User
     */
    public function addAddedTopic(\AppBundle\Entity\Topic $addedTopic)
    {
        $this->addedTopic[] = $addedTopic;

        return $this;
    }

    /**
     * Remove addedTopic
     *
     * @param \AppBundle\Entity\Topic $addedTopic
     */
    public function removeAddedTopic(\AppBundle\Entity\Topic $addedTopic)
    {
        $this->addedTopic->removeElement($addedTopic);
    }

    /**
     * Get addedTopic
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAddedTopic()
    {
        return $this->addedTopic;
    }

    /**
     * Add responsibleTopic
     *
     * @param \AppBundle\Entity\Topic $responsibleTopic
     *
     * @return User
     */
    public function addResponsibleTopic(\AppBundle\Entity\Topic $responsibleTopic)
    {
        $this->responsibleTopic[] = $responsibleTopic;

        return $this;
    }

    /**
     * Remove responsibleTopic
     *
     * @param \AppBundle\Entity\Topic $responsibleTopic
     */
    public function removeResponsibleTopic(\AppBundle\Entity\Topic $responsibleTopic)
    {
        $this->responsibleTopic->removeElement($responsibleTopic);
    }

    /**
     * Get responsibleTopic
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResponsibleTopic()
    {
        return $this->responsibleTopic;
    }
}
