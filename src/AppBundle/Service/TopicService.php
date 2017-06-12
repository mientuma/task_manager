<?php


namespace AppBundle\Service;


use AppBundle\Entity\Topic;
use Doctrine\ORM\EntityManager;

class TopicService
{
    private $em;
    private $topic;

    public function __construct(EntityManager $entityManager, Topic $topic)
    {
        $this->em = $entityManager;
        $this->topic = $topic;
    }

    public function addToDataBase($topic)
    {
        $this->em->persist($topic);
        $this->em->flush();
    }

    public function checkUser($userAdded, $userResponsible, $topic)
    {
        if ($userAdded == $userResponsible)
        {
            $this->topic = $topic;
            $this->topic->setAccepted(true);
            $this->addToDataBase($this->topic);
        }

        else
        {
            $this->addToDataBase($topic);
        }
    }

    public function resolveTopic($topic)
    {
        $this->topic = $topic;
        $userAdded = $this->topic->getUserAdded();
        $userResponsible = $this->topic->getUserResponsible();
        $this->checkUser($userAdded, $userResponsible, $topic);
    }


}