<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class TopicsController extends Controller
{
    /**
     * @Route("/topics", name="topics")
     * @Security("has_role('ROLE_USER')")
     */
    public function topicsAction()
    {
        return $this->render('topics/topics.html.twig');
    }

    /**
     * @Route("/topics/add", name="topicsAdd")
     * @Security("has_role('ROLE_USER')")
     */
    public function topicsAddAction()
    {
        return $this->render('topics/topicsAdd.html.twig');
    }
}