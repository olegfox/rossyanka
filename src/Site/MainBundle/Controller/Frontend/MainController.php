<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $repository_news = $this->getDoctrine()->getRepository('SiteMainBundle:News');
        $repository_page = $this->getDoctrine()->getRepository('SiteMainBundle:Page');
        $repository_slider = $this->getDoctrine()->getRepository('SiteMainBundle:Slider');

        $page = $repository_page->findOneBySlug('glavnaia');
        $news = $repository_news->findAll();

        $newsArray = array('events' => array(), 'interviews' => array(), 'opinion' => array());

        foreach($news as $n){
            if($n->getType() == 0){
                $newsArray['events'][] = $n;
            }elseif($n->getType() == 1){
                $newsArray['interviews'][] = $n;
            }elseif($n->getType() == 2){
                $newsArray['opinion'][] = $n;
            }
        }

        $sliders = $repository_slider->findAll();

        return $this->render('SiteMainBundle:Frontend/Main:index.html.twig', array(
            'news' => $newsArray,
            'page' => $page,
            'sliders' => $sliders
        ));
    }
}
