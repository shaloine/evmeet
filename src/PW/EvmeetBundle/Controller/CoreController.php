<?php

namespace PW\EvmeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use PW\EvmeetBundle\Entity\Article;
use PW\EvmeetBundle\Entity\User;
use PW\EvmeetBundle\Form\ArticleType;

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
    public function creationAction(Request $request)
    {

        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            
            $article = new Article();
            $form   = $this->get('form.factory')->create(ArticleType::class, $article);

            if ($request->isMethod('POST')) {

            	$form->handleRequest($request);




            	}

            }

            return $this->render('PWEvmeetBundle:Core:creation.html.twig', array(
                'form' => $form->createView(),
            ));
        }
        
        return $this->redirectToRoute('pw_evmeet_homepage');
        
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
