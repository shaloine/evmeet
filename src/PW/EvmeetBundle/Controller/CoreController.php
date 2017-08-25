<?php

namespace PW\EvmeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use PW\EvmeetBundle\Entity\Article;
use PW\EvmeetBundle\Entity\Comment;
use PW\EvmeetBundle\Entity\User;
use PW\EvmeetBundle\Form\ArticleType;
use PW\EvmeetBundle\Form\CommentType;
use PW\EvmeetBundle\Form\UserType;

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

	public function detailAction($id, Request $request)
	{
		$comment = new Comment();
		$form   = $this->get('form.factory')->create(CommentType::class, $comment);

		$em = $this->getDoctrine()->getManager();

		if ($request->isMethod('POST')) {

			$form->handleRequest($request);

			if ($form->isValid()) {

				$comment->setUser( $this->getUser());
				$comment->setArticleID($id);

				$em->persist($comment);
				$em->flush();

				// to clear the form
				$comment = new Comment();
				$form   = $this->get('form.factory')->create(CommentType::class, $comment);

			}


		}

		$article = $em->getRepository('PWEvmeetBundle:Article')->find($id);
		$comments = $em->getRepository('PWEvmeetBundle:Comment')->findBY(array('articleID' => $id));


		if (null === $article) {
			return $this->redirectToRoute('pw_evmeet_liste');
		}

		return $this->render('PWEvmeetBundle:Core:detail.html.twig', array(
			'article' => $article,
			'form' => $form->createView(),
			'comments' => $comments
			));
	}

	public function profilAction(Request $request)
	{
		if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {

			$user = $this->getUser();
			
			if ($request->isMethod('POST')) {

				$form->handleRequest($request);

				if ($form->isValid()) {

				}
			}

			$em = $this->getDoctrine()->getManager();
			$articles = $em->getRepository('PWEvmeetBundle:Article')->findBY(array('user' => $this->getUser()));
			
			

			$form   = $this->get('form.factory')->create(UserType::class, $user);

			return $this->render('PWEvmeetBundle:Core:profil.html.twig', array(
				'articles' => $articles,
				'form' => $form->createView(),
				'user' => $user
				));

		}

		return $this->redirectToRoute('pw_evmeet_homepage');
	}

	public function deleteArticleAction($id)
	{
		if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {

			$em = $this->getDoctrine()->getManager();
			$article = $em->getRepository('PWEvmeetBundle:Article')->find($id);

			if ($this->getUser()->getId() == $article->getUser()->getId()){
				$em->remove($article);
				$em->flush();
			}
			
			return $this->redirectToRoute('pw_evmeet_profil');
		}

		return $this->redirectToRoute('pw_evmeet_homepage');
	}

}
