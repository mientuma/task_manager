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
        $topics = $this->get('doctrine')->getManager()->getRepository('AppBundle:Topic')->findAllAccepted();
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
            $this->get('app.topic.service')->resolveTopic($topic);
        }

        return $this->render('topics/topicsAdd.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/topics/accept/hash={hash}", name="topicsHash")
     * @Security("has_role('ROLE_USER')")
     * @throws \Exception
     */
    public function topicsAcceptAction(Request $request)
    {
        $hash = $request->get('hash');
        $topic = $this->getDoctrine()->getRepository('AppBundle:Topic')->findOneByHash($hash);
        if($topic)
        {
            $this->get('app.topic.service')->setTopicAccepted($topic);
            $this->addFlash(
                'notice',
                'Zadanie zostało zaakceptowane!'
            );
            return $this->redirectToRoute('homepage');
        }
        else
        {
            throw new \Exception('Podałeś nieprawidłowy link');
        }
    }
}