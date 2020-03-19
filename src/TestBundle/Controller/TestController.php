<?php

namespace TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TestController extends Controller
{
    /**
     * @Route("/Index")
     */
    public function IndexAction()
    {
        return $this->render('@Test/Test/index.html.twig', ["titre" =>"page index"]);
    }

}
