<?php

namespace TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use TestBundle\Entity\Post;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use TestBundle\Form\ImageType;
class DefaultController extends Controller
{
    /**
     * @Route("/post")
     */
	public function createAction(Request $request){
		$post= new Post();
		    $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $post);

    // On ajoute les champs de l'entité que l'on veut à notre formulaire
    $formBuilder
      ->add('title', TextType::class)
      ->add('description', TextareaType::class)
      ->add('active', CheckboxType::class)
      ->add('image', ImageType::class)
      ->add('save', SubmitType::class)
    ;
    

    // À partir du formBuilder, on génère le formulaire
    $form = $formBuilder->getForm();
    

    if ($request->isMethod('POST')) {
    	$form->handleRequest($request);
    	/*$post->setTitle('quatrieme titre');
		$post->setDescription('lorem lorem lorem lorem');
		$post->setActive(1);*/
		$em=$this->getDoctrine()->getManager();
		$em->persist($post);
		$em->flush();
		return $this->redirectToRoute('show_post');
   	}

    return $this->render('@Test/base.html.twig', array(
      'form' => $form->createView(),
    ));




		
		//return new Response('create function ');



	}

    /**
     * @Route("/test", name="show_post")
     */
    public function indexAction()
    {
        $repositoryPost=$this->getDoctrine()->getRepository("TestBundle:Post");
        $posts=$repositoryPost->findAll();

       /* $repository=$this->getDoctrine()->getRepository("TestBundle:Post");
       	$query = $repository->createQueryBuilder("p")
				->where('p.active=:etat')
				->setParameter('etat', 1)
				->getQuery();
		$posts=$query->getResult();
        echo"<pre>", print_r($posts),"</pre>";*/
        //return new Response('show function ');
        return $this->render('@Test/Default/index.html.twig',['post'=>$posts]);
    }
}
