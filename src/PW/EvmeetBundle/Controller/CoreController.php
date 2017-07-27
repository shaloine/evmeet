<?php

namespace PW\EvmeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    public function indexAction()
    {
        return $this->render('PWEvmeetBundle:Core:index.html.twig');
    }
    public function listeAction()
    {
        return $this->render('PWEvmeetBundle:Core:liste.html.twig');
    }
    public function creationAction()
    {
        return $this->render('PWEvmeetBundle:Core:creation.html.twig');
    }
    public function detailAction($id)
    {
        return $this->render('PWEvmeetBundle:Core:detail.html.twig');
    }
    public function profilAction()
    {
        return $this->render('PWEvmeetBundle:Core:profil.html.twig');
    }

}
