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

				$levelControl = $this->container->get('pw_evmeet.levelControl');

				if ($levelControl->isLevelCorrect($article)){

					if ($form->isValid()) {

						$article->setUser( $this->getUser());

						$em = $this->getDoctrine()->getManager();
						$em->persist($article);
						$em->flush();

						$request->getSession()->getFlashBag()->add('notice', 'Annonce enregistrée');

					}

				}
				else {
					$request->getSession()->getFlashBag()->add('notice', 'Le niveau min ne peut être supérieur au niveau max');
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
		$repository = $this->getDoctrine()
      	->getManager()
      	->getRepository('PWEvmeetBundle:Article')
    	;

    	$article = $repository->find($id);

    	if (null === $article) {
      	return $this->redirectToRoute('pw_evmeet_liste');
    	}

		return $this->render('PWEvmeetBundle:Core:detail.html.twig', array(
      	'article' => $article
      	));
	}
	public function profilAction()
	{
		return $this->render('PWEvmeetBundle:Core:profil.html.twig');
	}

}
