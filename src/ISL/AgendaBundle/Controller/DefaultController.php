<?php

namespace ISL\AgendaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ISLAgendaBundle:Default:index.html.twig');
    }
}
