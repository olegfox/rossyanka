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
        $repository_event = $this->getDoctrine()->getRepository('SiteMainBundle:Event');

        $page = $repository_page->findOneBySlug('glavnaia');
        $news = $repository_news->findAllForType();
        $newsSlider = $repository_news->findLast();
        $sliders = $repository_slider->findAll();
        $lastPastEvent = $repository_event->findLastPastEvent();
        $firstFutureEvent = $repository_event->findFirstFutureEvent();

        return $this->render('SiteMainBundle:Frontend/Main:index.html.twig', array(
            'news' => $news,
            'newsSlider' => $newsSlider,
            'page' => $page,
            'sliders' => $sliders,
            'lastPastEvent' => $lastPastEvent,
            'firstFutureEvent' => $firstFutureEvent
        ));
    }
}
