<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction($parent, $slug)
    {
        $repository = $this->getDoctrine()->getRepository('SiteMainBundle:Page');

        $page = $repository->findOneBySlug($slug);

        if(!$page){
            throw $this->createNotFoundException($this->get('translator')->trans('backend.page.not_found'));
        }

        $params = array(
            'page' => $page
        );

        if($slug == 'osnovnoi-sostav'){
            $repository_team = $this->getDoctrine()->getRepository('SiteMainBundle:Team');
            $team = $repository_team->findOneByName('Россиянка');

            if($team){
                $params = array_merge($params, array(
                    'team' => $team
                ));
            }
        }

        return $this->render('SiteMainBundle:Frontend/Page:index.html.twig', $params);
    }
}
