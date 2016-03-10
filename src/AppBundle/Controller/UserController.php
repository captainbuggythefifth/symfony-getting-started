<?php
// src/AppBundle/Controller/HelloController.php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function indexAction($sUserName = ""){
        if($sUserName != ""){
            $this->showAction($sUserName);
        }
        else{
            return $this->render('user/index.html.twig', array('name' => $sUserName));
        }
        /*return new Response('<html><body>Hello '.$name.'!</body></html>');*/

    }

    public function showAction($sUserName){
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'Select u from AppBundle:User u where u.username = :username'
        )->setParameter('username', $sUserName);
        $oUser = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        $repository = $this->getDoctrine()->getRepository('AppBundle:User');
        /*$oUser = $repository->findBy(array('username' => $sUserName));*/
        return $this->render('user/index.html.twig', array('aUser' => json_decode(json_encode($oUser[0]), true)));
    }

    public function createAction(){
        return $this->render('user/create.html.twig');
    }

    public function loginAction($sUserName, $sPassword){

    }

    public function storeAction(Request $request){

        $oUser = new User();
        $oUser->setName($request->request->get('name'));
        $oUser->setEmail($request->request->get('email'));
        $oUser->setUsername($request->request->get('username'));
        $oUser->setPassword($request->request->get('password'));


        $validator = $this->get('validator');
        $errors = $validator->validate($oUser);

        if (count($errors) > 0) {
            return $this->render('user/create.html.twig', array(
                'errors' => $errors
            ));
        }

        $em = $this->getDoctrine()->getManager();

        $em->persist($oUser);
        $em->flush();

        return $this->redirect('/user/show/' . $request->request->get('username'));

    }

    public function deleteAction($sUserName){
        $repository = $this->getDoctrine()->getRepository('AppBundle:User');
        $oUser = $repository->findBy(array('username' => $sUserName));

        $em = $this->getDoctrine()->getManager();

        $em->remove($oUser[0]);
        $em->flush();
    }



}