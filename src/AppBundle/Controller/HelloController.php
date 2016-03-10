<?php
// src/AppBundle/Controller/HelloController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HelloController extends Controller
{
    public function indexAction($name)
    {
        /*return new Response('<html><body>Hello '.$name.'!</body></html>');*/
        return $this->render('hello/index.html.twig', array('name' => $name));
    }
}