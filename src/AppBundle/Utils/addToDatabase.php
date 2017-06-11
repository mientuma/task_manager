<?php

namespace AppBundle\Utils;


use Doctrine\ORM\EntityManager;

class addToDatabase
{
    private $entity;
    private $em;

    public function __construct(EntityManager $entityManager, $entity)
    {
        $this->em = $entityManager;
        $this->entity=$entity;
    }

    public function flush()
    {

    }

}