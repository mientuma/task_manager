<?php


namespace AppBundle\Service;


use AppBundle\Entity\Topic;
use Doctrine\ORM\EntityManager;

class TopicService
{
    private $em;
    private $topic;
    private $mailer;
    private $token;

    public function __construct(EntityManager $entityManager, Topic $topic, \Swift_Mailer $mailer)
    {
        $this->em = $entityManager;
        $this->topic = $topic;
        $this->mailer = $mailer;
        $this->token = md5(uniqid(rand(), true));
    }

    public function addToDataBase($topic)
    {
        $this->em->persist($topic);
        $this->em->flush();
    }

    public function checkUser($topic)
    {
        $this->topic = $topic;
        $userAdded = $this->topic->getUserAdded();
        $userResponsible = $this->topic->getUserResponsible();

        if ($userAdded === $userResponsible)
        {
            $this->topic->setAccepted(true);
        }

        else
        {
            $this->addToDataBase($this->topic);
            $topic = $this->em->getRepository('AppBundle:Topic')->findLastRecord();
            $this->topic = $topic;
            $topicId = $this->topic->getId();
            $message = \Swift_Message::newInstance()
                ->setSubject("Użytkownik ".$userAdded." przypisał Ci nowe zadanie numer #".$topicId)
                ->setFrom('hpnorek@gmail.com')
                ->setTo('mientuma@gmail.com')
                ->setBody($this->token);
            $this->mailer->send($message);
        }
    }

    public function resolveTopic($topic)
    {
        $this->topic = $topic;
        $userAdded = $this->topic->getUserAdded();
        $userResponsible = $this->topic->getUserResponsible();
        $this->checkUser($topic);
    }


}