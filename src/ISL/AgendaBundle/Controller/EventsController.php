<?php

/* 
 * Content: Controller Events
 */

namespace ISL\AgendaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class EventsController extends Controller
{
    public function addRelationAction() {
        
        //Création de la relation ManyToMany
        $em = $this->getDoctrine()->getManager();
        
        $listEvents = $this->getRepository('ISLAgendaBundle:Events')->findAll();
        
        $listUser = $this->getRepository('ISLAgendaBundle:User')->findAll();
        
        foreach($listEvents as $event){
            foreach($listUser as $user){
                $event->addUser($user);
            }
        }
        
        $em->flush();
        
        return $this->redirectToRoute('isl_agenda_home', array());
    }
    
    //Méthode add
    public function addEventsAction(Events $events, Image $image, Categories $category, User $user)
    {
        $em= $this->getDoctrine()->getManager();
        
       
        $event->setCategories($category);
        
        $event->setImage($image);
        
        $event->addUser($user);
        
         //Ajout des nouveaux entités à Doctrine
        $em->persist($events);
        $em->persist($categories);
        $em->persist($Image);
        $em->persist($user);
        
        //Mise à jour DB 
        $em->flush();
        
        return $this->redirectToRoute('isl_agenda_home', array());
    } 
    
    public function updateEventsAction($id, Request $request)
    {
        $event = $this-> getDoctrine()
                ->getManager()
                ->getRepository('ISLAgendaBundle:Events')
                ->find($id);
        //News
        $event->setNom($request->request->get('events_nom'));
        $event->setDescription($request->request->get('events_description'));
        $event->setDebut($request->request->get('events_debut'));
        $event->setFin($request->request->get('events_fin'));
        //News catégorie
        $event->getCategories()->setNom($request->request->get('categorie_nom'));
         $event->getCategories()->setDescription($request->request->get('categorie_description'));
        $event->getImage()->setTitle($request->request->get('image_title')); 
        $event->getImage()->setUrl($request->request->get('image_url'));
        $event->getImage()->setAlt($request->request->get('image_alt'));
        
        $event->getUser()->setUsername($request->request->get('user_username'));
        $event->getImage()->setProfilePicture($request->request->get('user_profile_picture'));
        
        $em->flush();
        
        return $this->redirectToRoute('isl_agenda_home', array());
    }    

    public function deleteEventsAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $event= $em->getRepository('ISLAgendaBundle:Events')
                ->find($id);
        
        if(!$event){
            throw new NotFoundHttpException('Aucune événement enregister à cette id '.$id.' en Db!!');
        }
        // Suppréssion de l'entité en DB
        $em->remove($event);
        
        //Mise à jour DB
        $em->flush();
        
        return $this->redirectToRoute('isl_agenda_home', array());
    }        
    
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $listEvents = $em->getRepository('ISLAgendaBundle:Events')->findAll();
        
        if(!$listEvents){
            throw new NotFoundHttpException('Aucune events enregister en Db!!');
        }
        return $this->render(
                "ISL/AgendaBundle/Events/home.html.twig",
                array('listEvents'=>$listEvents)
                );
    }  
    
    public function eventsDetailAction($id) {
        $em = $this->getDoctrine()->getManager();
        
        $events=$em->getRepository('ISLAgendaBundle:Events')->find($id);
        
        if(!$events){
            throw new NotFoundHttpException('Aucune événement enregister à cette id '.$id.' en Db!!');
        }
        return $this->render(
                'ISL/AgendaBundle/Events/view.html.twig',
                array('event'=>$events)
                );
    }
    
           
    
    
}
