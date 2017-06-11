<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Topic;
use AppBundle\Form\TopicType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class TopicsController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/topics", name="topics")
     * @Security("has_role('ROLE_USER')")
     */
    public function topicsAction()
    {
        $topics = $this->get('doctrine')->getManager()->getRepository('AppBundle:Topic')->findAll();
        return $this->render('topics/topics.html.twig', array(
            'topics' => $topics
        ));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/topics/topic/{id}", name="topicsShow")
     * @Security("has_role('ROLE_USER')")
     */
    public function topicsShowAction($id)
    {
        $topic = $this->get('doctrine')->getManager()->getRepository('AppBundle:Topic')->find($id);
        return $this->render('topics/topicsShow.html.twig', array(
            'topic' => $topic
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/topics/add", name="topicsAdd")
     * @Security("has_role('ROLE_USER')")
     */
    public function topicsAddAction(Request $request)
    {
        $topic = new Topic();
        $form = $this->createForm(TopicType::class, $topic, [
            'user' => $this->getUser()
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $topic = $form->getData();
            $em = $this->get('doctrine')->getManager();
            $em->persist($topic);
            $em->flush();
        }

        return $this->render('topics/topicsAdd.html.twig', array(
            'form' => $form->createView()
        ));
    }
}