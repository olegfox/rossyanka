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
            'page' => $page,
            'children' => $page->getChildren()
        );

        if(!is_null($parent)){
            $parent = $repository->findOneBySlug($parent);

            if(!$parent){
                throw $this->createNotFoundException($this->get('translator')->trans('backend.page.not_found'));
            }

            $params['children'] = $parent->getChildren();
        }

        return $this->render('SiteMainBundle:Frontend/Page:index.html.twig', $params);
    }
}
