<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventController extends Controller
{
    public function indexAction($type, $subtype)
    {
        $repository_team = $this->getDoctrine()->getRepository('SiteMainBundle:Team');
        $repository_page = $this->getDoctrine()->getRepository('SiteMainBundle:Page');

        $page = $repository_page->findOneBySlug($type);
        if($subtype){
            $page = $repository_page->findOneBySlug($subtype);
        }

        if(!$page){
            throw $this->createNotFoundException($this->get('translator')->trans('backend.page.not_found'));
        }

        $params = array(
            'page' => $page
        );

        if($subtype == 'turnirnaia-tablitsa'){
            $teams = $repository_team->findByEventType($type);
            $params = array_merge($params, array(
                'teams' => $teams
            ));
        }

        return $this->render('SiteMainBundle:Frontend/Event:index.html.twig', $params);
    }
}
