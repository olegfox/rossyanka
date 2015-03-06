<?php

namespace Site\MainBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class EventRepository extends EntityRepository
{
    public function findAll(){
        return $this->findBy(array(), array('datetime' => 'ASC'));
    }
}
