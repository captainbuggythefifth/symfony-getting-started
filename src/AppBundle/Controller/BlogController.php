<?php
// src/AppBundle/Controller/HelloController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    public function indexAction($sBlogSlug = ""){
        if($sBlogSlug != ""){
            $this->showAction($sBlogSlug);
        }
        else{
            return $this->render('blog/index.html.twig', array('name' => $sBlogSlug));
        }
        /*return new Response('<html><body>Hello '.$name.'!</body></html>');*/

    }

    public function showAction($sBlogSlug){
        return $this->render('blog/index.html.twig', array('name' => $sBlogSlug));
    }
}