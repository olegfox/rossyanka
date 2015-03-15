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
        $news = $repository_news->findAllForType();
        $newsSlider = $repository_news->findLast();
        $sliders = $repository_slider->findAll();

        return $this->render('SiteMainBundle:Frontend/Main:index.html.twig', array(
            'news' => $news,
            'newsSlider' => $newsSlider,
            'page' => $page,
            'sliders' => $sliders
        ));
    }
}
