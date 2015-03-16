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
     * @ORM\ManyToMany(targetEntity="Team", inversedBy="events")
     * @ORM\JoinTable(name="events_teams")
     **/
    private $teams;

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
     * Constructor
     */
    public function __construct()
    {
        $this->teams = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add teams
     *
     * @param \Site\MainBundle\Entity\Team $teams
     * @return Event
     */
    public function addTeam(\Site\MainBundle\Entity\Team $teams)
    {
        $this->teams[] = $teams;

        return $this;
    }

    /**
     * Remove teams
     *
     * @param \Site\MainBundle\Entity\Team $teams
     */
    public function removeTeam(\Site\MainBundle\Entity\Team $teams)
    {
        $this->teams->removeElement($teams);
    }

    /**
     * Get teams
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeams()
    {
        return $this->teams;
    }
}
