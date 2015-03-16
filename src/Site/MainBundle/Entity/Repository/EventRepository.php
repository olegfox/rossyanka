<?php

namespace Site\MainBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Site\MainBundle\Entity\Event;

class EventRepository extends EntityRepository
{
    public function findAll(){
        return $this->findBy(array(), array('datetime' => 'ASC'));
    }

//  Поиск событий по типу
    public function findByType($type){

        switch($type){
            case 'chiempionat': {
                $typeNumber = Event::NAME_CHAMPIONSHIP;
            }break;
            case 'kubok': {
                $typeNumber = Event::NAME_CUP;
            }break;
            case 'ligha-ievropy': {
                $typeNumber = Event::NAME_EUROPA_LEAGUE;
            }break;
            case 'molodiozhnoie-piervienstvo': {
                $typeNumber = Event::NAME_YOUTH_CHAMPIONSHIP;
            }break;
            default: {
                $typeNumber = Event::NAME_CHAMPIONSHIP;
            }break;
        }

        $events = $this->findByName($typeNumber);

        return $events;
    }
}
