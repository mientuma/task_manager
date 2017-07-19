<?php


namespace AppBundle\Service;


use AppBundle\Entity\Topic;
use Doctrine\ORM\EntityManager;

class TopicService
{
    private $em;
    private $atdb;
    private $topic;
    private $mailer;
    private $token;

    public function __construct(EntityManager $entityManager, Topic $topic, \Swift_Mailer $mailer, AddToDbService $atdb)
    {
        $this->atdb = $atdb;
        $this->em = $entityManager;
        $this->topic = $topic;
        $this->mailer = $mailer;
        $this->token = md5(uniqid(rand(), true));
    }

    public function setTopicAccepted($topic)
    {
        $this->topic = $topic;
        $this->topic->setAccepted(true);
        $this->atdb->addToDatabase($this->topic);
    }

    public function resolveTopic($topic)
    {
        $this->topic = $topic;
        $userAdded = $this->topic->getUserAdded();
        $userResponsible = $this->topic->getUserResponsible();

        if ($userAdded === $userResponsible)
        {
            $this->setTopicAccepted($topic);
        }

        else
        {
            $this->topic->setHash($this->token);
            $this->atdb->addToDatabase($this->topic);
            $topic = $this->em->getRepository('AppBundle:Topic')->find($this->topic);
            $this->topic = $topic;
            $topicId = $this->topic->getId();
            $message = \Swift_Message::newInstance()
                ->setSubject("Użytkownik ".$userAdded." przypisał Ci nowe zadanie numer #".$topicId)
                ->setFrom('hpnorek@gmail.com')
                ->setTo('mientuma@gmail.com')
                ->setBody("http://localhost:8000/topics/accept/hash=".$this->token);
            $this->mailer->send($message);
        }
    }


}