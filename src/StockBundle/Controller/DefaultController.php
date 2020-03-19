<?php

namespace StockBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Stock/Default/index.html.twig');
    }
    public function showAction($id)
    {
    	return new Response('salam show'.$id);
    }
}
