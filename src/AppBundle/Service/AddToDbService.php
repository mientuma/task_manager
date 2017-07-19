<?php


namespace AppBundle\Service;


use Doctrine\ORM\EntityManager;

class AddToDbService
{
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function addToDatabase($object)
    {
        $this->em->persist($object);
        $this->em->flush();
    }

}