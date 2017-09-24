<?php

namespace PW\EvmeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use PW\EvmeetBundle\Entity\Article;
use PW\EvmeetBundle\Entity\Comment;
use PW\EvmeetBundle\Entity\User;
use PW\EvmeetBundle\Entity\Filter;
use PW\EvmeetBundle\Entity\RegistredUser;
use PW\EvmeetBundle\Form\ArticleType;
use PW\EvmeetBundle\Form\CommentType;
use PW\EvmeetBundle\Form\UserType;
use PW\EvmeetBundle\Form\FilterType;

use \DateTime;
use DateTimeZone;

class CoreController extends Controller
{
	public function indexAction()
	{
		return $this->render('PWEvmeetBundle:Core:index.html.twig');
	}

	public function listeAction(Request $request)
	{
		
		$filter = new Filter();
		$form   = $this->get('form.factory')->create(FilterType::class, $filter);

		$em = $this->getDoctrine()->getManager();

		if ($request->isMethod('POST')) {

			$form->handleRequest($request);

			if ($form->isValid()) {

				$articles = $em->getRepository('PWEvmeetBundle:Article')->complexFind($filter);

			}
		}
		else {

			$articles = $em->getRepository('PWEvmeetBundle:Article')->classicFind();

		}
		
		return $this->render('PWEvmeetBundle:Core:liste.html.twig', array(
			'form' => $form->createView(),
			'articles' => $articles,
		));

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

		$user = $this->getUser();	
		$article = $em->getRepository('PWEvmeetBundle:Article')->find($id);
		$comments = $em->getRepository('PWEvmeetBundle:Comment')->findBY(array('articleID' => $id));

		if (null === $article) {
			return $this->redirectToRoute('pw_evmeet_liste');
		}

		return $this->render('PWEvmeetBundle:Core:detail.html.twig', array(
			'article' => $article,
			'form' => $form->createView(),
			'comments' => $comments,
			'user' => $user
		));
	}

	public function profilAction(Request $request)
	{
		if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {

			$em = $this->getDoctrine()->getManager();

			$flush = false;

			$AlphaUsername = $this->getUser()->getUsername();
			$AlphaEmail = $this->getUser()->getEmail();

			$user= $this->getUser();
			
			$form   = $this->get('form.factory')->create(UserType::class, $user);
			
			if ($request->isMethod('POST')) {

				$form->handleRequest($request);

				if ($form->isValid()) {

					$userExist = $em->getRepository('PWEvmeetBundle:User')->findOneByUsername($user->getUsername());
					$emailExist = $em->getRepository('PWEvmeetBundle:User')->findOneByEmail($user->getEmail());

					if(is_null($userExist)){
						$flush = true;
						$request->getSession()->getFlashBag()->add('notice', "Nom d'utilisateur modifié");

					} else if ($userExist && $user->getUsername() != $AlphaUsername){

						$user->setUsername($AlphaUsername);
						$request->getSession()->getFlashBag()->add('notice', 'Ce nom est déjà pris');

					} 
					if(is_null($emailExist)){
						$flush = true;
						$request->getSession()->getFlashBag()->add('notice', "Email modifié");

					} else if ($emailExist && $user->getEmail() != $AlphaEmail){
						$user->setEmail($AlphaEmail);
						$request->getSession()->getFlashBag()->add('notice', 'Cet Email existe déjà');
					} 

					if ($flush){
						$em->persist($user);
						$em->flush();
					}

				}
			}
			
			$articles = $em->getRepository('PWEvmeetBundle:Article')->userCurrent($this->getUser());
			$inscriptions = $em->getRepository('PWEvmeetBundle:Article')->inscriptionCurrent($this->getUser());

			return $this->render('PWEvmeetBundle:Core:profil.html.twig', array(
				'articles' => $articles,
				'inscriptions' => $inscriptions,
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
			$listComments = $em->getRepository('PWEvmeetBundle:Comment')->findBy(array('articleID' => $id));
			$listRegistredUser = $em->getRepository('PWEvmeetBundle:RegistredUser')->findBy(array('articleId' => $id));

			if ($this->getUser()->getId() == $article->getUser()->getId()){
				$em->remove($article);
				foreach ($listComments as $comment) {
					$em->remove($comment);
				}
				foreach ($listRegistredUser as $registredUser) {
					$em->remove($registredUser);
				}
				$em->flush();
			}
			
			return $this->redirectToRoute('pw_evmeet_profil');
		}

		return $this->redirectToRoute('pw_evmeet_homepage');
	}

	public function inscriptionArticleAction($id)
	{
		if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {

			$em = $this->getDoctrine()->getManager();
			$article = $em->getRepository('PWEvmeetBundle:Article')->find($id);
			
			if ($article->getNbPlace() > 0){

				$article->addRegistredUser($this->getUser());
				$article->setNbPlace($article->getNbPlace() - 1);
				$em->flush();

				return $this->redirectToRoute('pw_evmeet_detail',  array('id' => $id));

			} else {
				
				return $this->redirectToRoute('pw_evmeet_liste');
			}
			
		}

		return $this->redirectToRoute('pw_evmeet_homepage');
	}
	public function desinscriptionArticleAction($id)
	{
		if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {

			$em = $this->getDoctrine()->getManager();
			$article = $em->getRepository('PWEvmeetBundle:Article')->find($id);

			$article->setNbPlace($article->getNbPlace() + 1);
			$article->removeRegistredUser($this->getUser());

			$em->flush();

			return $this->redirectToRoute('pw_evmeet_detail',  array('id' => $id));

		}

		return $this->redirectToRoute('pw_evmeet_homepage');
	}
	public function pastArticleAction()
	{
		if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {

			$em = $this->getDoctrine()->getManager();
			$articles = $em->getRepository('PWEvmeetBundle:Article')->userPast($this->getUser());

			return $this->render('PWEvmeetBundle:Core:pastArticle.html.twig', array(
				'articles' => $articles
			));

		}

		return $this->redirectToRoute('pw_evmeet_homepage');
	}
	public function pastInscriptionAction()
	{
		if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {

			$em = $this->getDoctrine()->getManager();
			$articles = $em->getRepository('PWEvmeetBundle:Article')->inscriptionPast($this->getUser());

			return $this->render('PWEvmeetBundle:Core:pastInscription.html.twig', array(
				'articles' => $articles
			));

		}

		return $this->redirectToRoute('pw_evmeet_homepage');
	}

}
