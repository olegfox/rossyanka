<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Site\MainBundle\Entity\Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\EventRepository")
 */
class Event
{

    const NAME_CHAMPIONSHIP = 0;
    const NAME_CUP = 1;
    const NAME_EUROPA_LEAGUE = 2;
    const NAME_YOUTH_CHAMPIONSHIP = 3;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Тур
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $tour;

    /**
     * Название турнира
     * @ORM\Column(type="smallint", nullable=false)
     */
    private $name = 0;

    /**
     * Дата и время события
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $datetime;

    /**
     * Счет
     * @var string
     *
     * @ORM\Column(name="score", type="string", length=50, nullable=true)
     */
    private $score;

    /**
     * Количество голов
     * @var string
     *
     * @ORM\Column(name="number_goals", type="smallint", nullable=true)
     */
    private $numberGoals = 0;

    /**
     * Количество желтых карточек
     * @var string
     *
     * @ORM\Column(name="number_yellow_cards", type="smallint", nullable=true)
     */
    private $numberYellowCards = 0;

    /**
     * Стадион
     * @var string
     *
     * @ORM\Column(name="stadium", type="string", length=100, nullable=true)
     */
    private $stadium;

    /**
     * @ORM\OneToMany(targetEntity="EventTeam", mappedBy="event", cascade={"persist", "remove"})
     * @ORM\OrderBy({"position" = "ASC"})
     **/
    private $eventTeam;

    /**
     * @ORM\OneToMany(targetEntity="BenchCoach", mappedBy="event", cascade={"persist", "remove"})
     **/
    private $benchCoach;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param integer $name
     * @return Event
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return integer 
     */
    public function getName()
    {
        return $this->name;
    }

    public function getNameText()
    {
        switch($this->name){
            case 0: {
                return 'backend.event.name_choice.championship';
            }break;
            case 1: {
                return 'backend.event.name_choice.cup';
            }break;
            case 2: {
                return 'backend.event.name_choice.europa_league';
            }break;
            case 3: {
                return 'backend.event.name_choice.youth_championship';
            }break;
            default: {
                return 'backend.event.name_choice.championship';
            }break;
        }
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     * @return Event
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime 
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set score
     *
     * @param string $score
     * @return Event
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return string 
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set numberGoals
     *
     * @param integer $numberGoals
     * @return Event
     */
    public function setNumberGoals($numberGoals)
    {
        $this->numberGoals = $numberGoals;

        return $this;
    }

    /**
     * Get numberGoals
     *
     * @return integer 
     */
    public function getNumberGoals()
    {
        return $this->numberGoals;
    }

    /**
     * Set numberYellowCards
     *
     * @param integer $numberYellowCards
     * @return Event
     */
    public function setNumberYellowCards($numberYellowCards)
    {
        $this->numberYellowCards = $numberYellowCards;

        return $this;
    }

    /**
     * Get numberYellowCards
     *
     * @return integer 
     */
    public function getNumberYellowCards()
    {
        return $this->numberYellowCards;
    }

    /**
     * Set stadium
     *
     * @param string $stadium
     * @return Event
     */
    public function setStadium($stadium)
    {
        $this->stadium = $stadium;

        return $this;
    }

    /**
     * Get stadium
     *
     * @return string 
     */
    public function getStadium()
    {
        return $this->stadium;
    }

    /**
     * Set tour
     *
     * @param integer $tour
     * @return Event
     */
    public function setTour($tour)
    {
        $this->tour = $tour;

        return $this;
    }

    /**
     * Get tour
     *
     * @return integer 
     */
    public function getTour()
    {
        return $this->tour;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->eventTeam = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add eventTeam
     *
     * @param \Site\MainBundle\Entity\EventTeam $eventTeam
     * @return Event
     */
    public function addEventTeam(\Site\MainBundle\Entity\EventTeam $eventTeam)
    {
        $this->eventTeam[] = $eventTeam;

        return $this;
    }

    /**
     * Remove eventTeam
     *
     * @param \Site\MainBundle\Entity\EventTeam $eventTeam
     */
    public function removeEventTeam(\Site\MainBundle\Entity\EventTeam $eventTeam)
    {
        $this->eventTeam->removeElement($eventTeam);
    }

    /**
     * Get eventTeam
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEventTeam()
    {
        return $this->eventTeam;
    }

    public function getEventTeamString(){
        $string = "";
        for($i = 0; $i < count($this->getEventTeam()); $i++){
            $eventTeam = $this->getEventTeam()[$i];
            $string = $string . $eventTeam->getTeam()->getName();
            if($i != count($this->getEventTeam()) - 1){
                $string = $string . ' - ';
            }
        }
        return $string;
    }

    /**
     * Add benchCoach
     *
     * @param \Site\MainBundle\Entity\BenchCoach $benchCoach
     * @return Event
     */
    public function addBenchCoach(\Site\MainBundle\Entity\BenchCoach $benchCoach)
    {
        $this->benchCoach[] = $benchCoach;

        return $this;
    }

    /**
     * Remove benchCoach
     *
     * @param \Site\MainBundle\Entity\BenchCoach $benchCoach
     */
    public function removeBenchCoach(\Site\MainBundle\Entity\BenchCoach $benchCoach)
    {
        $this->benchCoach->removeElement($benchCoach);
    }

    /**
     * Get benchCoach
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBenchCoach()
    {
        return $this->benchCoach;
    }
}
