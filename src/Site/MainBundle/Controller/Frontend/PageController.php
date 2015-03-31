<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Site\MainBundle\Entity\Player;

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

        if($slug == 'osnovnoi-sostav' || $slug == 'dubliruiushchii-sostav'){
            $repository_team = $this->getDoctrine()->getRepository('SiteMainBundle:Team');

            $team = $repository_team->findOneByName('Россиянка');

            if($team){

                $players = array();

                if($slug == 'osnovnoi-sostav'){
                    foreach($team->getPlayers() as $player){
                        if($player->getStatus() == Player::STATUS_MAIN){
                            $players[] = $player;
                        }
                    }
                }else{
                    foreach($team->getPlayers() as $player){
                        if($player->getStatus() == Player::STATUS_DOP){
                            $players[] = $player;
                        }
                    }
                }

                $params = array_merge($params, array(
                    'players' => $players
                ));

            }

        }elseif($slug == "rukovodstvo"){
            $repository_director = $this->getDoctrine()->getRepository('SiteMainBundle:Director');

            $directors = $repository_director->findAllArray();

            $params = array_merge($params, array(
                'directors' => $directors
            ));
        }

        return $this->render('SiteMainBundle:Frontend/Page:index.html.twig', $params);
    }
}
