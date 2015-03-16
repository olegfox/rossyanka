<?php

namespace Site\MainBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class FrontendMenuBuilder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $request = $this->container->get('request');

        $routeName = $request->get('_route');

        $em = $this->container->get('doctrine.orm.entity_manager');

        $repository = $em->getRepository('SiteMainBundle:Page');

        $menus = $repository->findBy(array('parent' => null), array('position' => 'asc'));

        $menu = $factory->createItem('root');

        foreach ($menus as $m) {

            if ($m->getSlug() == 'glavnaia') {

//                $menu->addChild($m->getTitle(), array(
//                    'route' => 'frontend_homepage'
//                ));

//          Меню новостей
            } elseif ($m->getSlug() == 'novosti') {

                $newsMenu = $menu->addChild($m->getTitle(), array(
                    'route' => 'frontend_news_index',
                    'routeParameters' => array('type' => 'events')
                ));

//              Подменю
                $newsMenu->addChild('события', array(
                    'route' => 'frontend_news_index',
                    'routeParameters' => array('type' => 'events')
                ));
                $newsMenu->addChild('интервью', array(
                    'route' => 'frontend_news_index',
                    'routeParameters' => array('type' => 'interviews')
                ));
                $newsMenu->addChild('мнения', array(
                    'route' => 'frontend_news_index',
                    'routeParameters' => array('type' => 'opinion')
                ));
//          Меню турниров
            } elseif ($m->getSlug() == 'turniry') {

//              Если это турниры, то сразу попадаем на чемпионаты
                $eventMenu = $menu->addChild($m->getTitle(), array(
                    'route' => 'frontend_event_sub_index',
                    'routeParameters' => array('type' => $m->getChildren()[0]->getSlug(), 'subtype' => $m->getChildren()[0]->getChildren()[0]->getSlug())
                ));

//              Подменю турниров
                foreach ($m->getChildren() as $c) {
                    $subEventMenu = null;

                    if(count($c->getChildren()) > 0){
                        $subEventMenu = $eventMenu->addChild($c->getTitle(), array(
                            'route' => 'frontend_event_sub_index',
                            'routeParameters' => array('type' => $c->getSlug(), 'subtype' => $c->getChildren()[0]->getSlug())
                        ));
                    }else{
                        $subEventMenu = $eventMenu->addChild($c->getTitle(), array(
                            'route' => 'frontend_event_index',
                            'routeParameters' => array('type' => $c->getSlug())
                        ));
                    }


//                  ПодменюПодменю турниров
                    foreach ($c->getChildren() as $c2) {
                        $subEventMenu->addChild($c2->getTitle(), array(
                            'route' => 'frontend_event_sub_index',
                            'routeParameters' => array('type' => $c->getSlug(), 'subtype' => $c2->getSlug())
                        ));
                    }
                }

//          Меню текстовых страниц
            } else {

                $mainMenu = $menu->addChild($m->getTitle(), array(
                    'route' => 'frontend_page',
                    'routeParameters' => array('slug' => $m->getSlug())
                ));

//              Подменю
                foreach ($m->getChildren() as $c) {
                    $mainMenu->addChild($c->getTitle(), array(
                        'route' => 'frontend_page_child',
                        'routeParameters' => array('parent' => $c->getParent()->getSlug(), 'slug' => $c->getSlug())
                    ));
                }

            }

        }

        $menu->setCurrent($this->container->get('request')->getRequestUri());

        return $menu;
    }
}