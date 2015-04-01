<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventController extends Controller
{
    public function indexAction($type, $subtype)
    {
        $repository_page = $this->getDoctrine()->getRepository('SiteMainBundle:Page');

        $page = $repository_page->findOneBySlug($type);

        if(!$page){
            throw $this->createNotFoundException($this->get('translator')->trans('backend.page.not_found'));
        }

        $params = array(
            'page' => $page
        );

        if($subtype){
            switch($subtype){
//              Страничка с новостями событий
                case 'novosti': {
                    $repository_news = $this->getDoctrine()->getRepository('SiteMainBundle:News');
                    $news = $repository_news->findByEventType($type);
                    $params = array_merge($params, array(
                        'news' => $news
                    ));
                }break;
//              Страничка с календарем игр для событий
                case 'kaliendar-ighr': {
                    $repository_event = $this->getDoctrine()->getRepository('SiteMainBundle:Event');
                    $events = $repository_event->findByType($type);
                    $params = array_merge($params, array(
                        'events' => $events
                    ));
                }break;
//              Страничка с результатом матчей для событий
                case 'riezul-taty-matchiei': {
                    $repository_event = $this->getDoctrine()->getRepository('SiteMainBundle:Event');
                    $resultEvents = $repository_event->findByTypeResult($type);
                    $params = array_merge($params, array(
                        'resultEvents' => $resultEvents
                    ));
                }break;
//              Страничка с турнирной таблицей для событий
                case 'turnirnaia-tablitsa': {
                    if($type == 'kubok'){
                        $repository_event = $this->getDoctrine()->getRepository('SiteMainBundle:Event');
                        $cuboc = $repository_event->getCuboc();
                        $params = array_merge($params, array(
                            'cub' => $cuboc
                        ));
                    }else{
                        $repository_team = $this->getDoctrine()->getRepository('SiteMainBundle:Team');
                        $teams = $repository_team->findByEventType($type);
                        $params = array_merge($params, array(
                            'teams' => $teams
                        ));
                    }
                }break;
            }
        }

        return $this->render('SiteMainBundle:Frontend/Event:index.html.twig', $params);
    }

    public function gameAction($id){
        $repository = $this->getDoctrine()->getRepository('SiteMainBundle:Event');

        $event = $repository->find($id);

        if(!$event){
            throw $this->createNotFoundException($this->get('translator')->trans('backend.event.not_found'));
        }

        $params = array(
            'event' => $event
        );
        return $this->render('SiteMainBundle:Frontend/Event:game.html.twig', $params);
    }
}
