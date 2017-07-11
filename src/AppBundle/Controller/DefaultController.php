<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction()
    {
        $record = $this->getDoctrine()->getRepository('AppBundle:Topic')->findLastRecord();
        dump($record);
        return $this->render('default/index.html.twig');
    }
}
