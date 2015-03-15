<?php

namespace Site\MainBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class NewsRepository extends EntityRepository
{

//  Поиск всех новостей
    public function findAll(){
        return $this->findBy(array(), array('date' => 'ASC'));
    }

//  Поиск всех новостей + разбивание по типам
    public function findAllForType(){
        $news = $this->findAll();

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

        return $newsArray;
    }

//  Поиск по типу новости
    public function findType($type){

        $news = null;

        switch($type){
            case 'events': {
                $news = $this->findBy(array('type' => 0));
            }break;
            case 'interviews': {
                $news = $this->findBy(array('type' => 1));
            }break;
            case 'opinion': {
                $news = $this->findBy(array('type' => 2));
            }break;
            default: {
                $news = $this->findBy(array('type' => 0));
            }break;
        }

        return $news;

    }

//  Три последние новости
    public function findLast(){

        $em = $this->getEntityManager();

        $news = $em->createQuery('
        SELECT n FROM Site\MainBundle\Entity\News n
        ORDER BY n.date ASC
        ')
            ->setMaxResults(3)
            ->getResult();

        return $news;

    }

}
