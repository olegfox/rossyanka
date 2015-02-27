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
            }else{
                $menu->addChild($m->getTitle(), array(
                    'route' => 'frontend_page',
                    'routeParameters' => array('slug' => $m->getSlug())
                ));
            }
        }

        $menu->setCurrent($this->container->get('request')->getRequestUri());

        return $menu;
    }

    public function subMenu(FactoryInterface $factory, array $options)
    {
        $request = $this->container->get('request');

        $routeName = $request->get('_route');

        $menu = $factory->createItem('root');

        foreach ($options['children'] as $m) {
            $menu->addChild($m->getTitle(), array(
                'route' => 'frontend_page_child',
                'routeParameters' => array('parent' => $m->getParent()->getSlug(), 'slug' => $m->getSlug())
            ));
        }

        $menu->setCurrent($this->container->get('request')->getRequestUri());

        return $menu;
    }
}