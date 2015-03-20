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
                case 'novosti': {
                    $repository_news = $this->getDoctrine()->getRepository('SiteMainBundle:News');
                    $news = $repository_news->findByEventType($type);
                    $params = array_merge($params, array(
                        'news' => $news
                    ));
                }break;
                case 'kaliendar-ighr': {

                }break;
                case 'riezul-taty-matchiei': {

                }break;
                case 'turnirnaia-tablitsa': {
                    $repository_team = $this->getDoctrine()->getRepository('SiteMainBundle:Team');
                    $teams = $repository_team->findByEventType($type);
                    $params = array_merge($params, array(
                        'teams' => $teams
                    ));
                }break;
            }
        }

        return $this->render('SiteMainBundle:Frontend/Event:index.html.twig', $params);
    }
}
