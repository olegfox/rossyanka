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
     * Состав команд
     * @ORM\OneToMany(targetEntity="PlayerTeam", mappedBy="event", cascade={"persist", "remove"})
     **/
    private $playerTeam;

    /**
     * Запасные
     * @ORM\OneToMany(targetEntity="BenchPlayerTeam", mappedBy="event", cascade={"persist", "remove"})
     **/
    private $benchPlayerTeam;

    /**
     * Замены в игре
     * @ORM\OneToMany(targetEntity="ReplacementEvent", mappedBy="event", cascade={"persist", "remove"})
     **/
    private $replacementEvent;

    /**
     * Накзания в игре
     * @ORM\OneToMany(targetEntity="PunishmentEvent", mappedBy="event", cascade={"persist", "remove"})
     **/
    private $punishmentEvent;

    /**
     * Голы в игре
     * @ORM\OneToMany(targetEntity="GoalEvent", mappedBy="event", cascade={"persist", "remove"})
     **/
    private $goalEvent;

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

    /**
     * Add playerTeam
     *
     * @param \Site\MainBundle\Entity\PlayerTeam $playerTeam
     * @return Event
     */
    public function addPlayerTeam(\Site\MainBundle\Entity\PlayerTeam $playerTeam)
    {
        $this->playerTeam[] = $playerTeam;

        return $this;
    }

    /**
     * Remove playerTeam
     *
     * @param \Site\MainBundle\Entity\PlayerTeam $playerTeam
     */
    public function removePlayerTeam(\Site\MainBundle\Entity\PlayerTeam $playerTeam)
    {
        $this->playerTeam->removeElement($playerTeam);
    }

    /**
     * Get playerTeam
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlayerTeam()
    {
        return $this->playerTeam;
    }

    /**
     * Add replacementEvent
     *
     * @param \Site\MainBundle\Entity\ReplacementEvent $replacementEvent
     * @return Event
     */
    public function addReplacementEvent(\Site\MainBundle\Entity\ReplacementEvent $replacementEvent)
    {
        $this->replacementEvent[] = $replacementEvent;

        return $this;
    }

    /**
     * Remove replacementEvent
     *
     * @param \Site\MainBundle\Entity\ReplacementEvent $replacementEvent
     */
    public function removeReplacementEvent(\Site\MainBundle\Entity\ReplacementEvent $replacementEvent)
    {
        $this->replacementEvent->removeElement($replacementEvent);
    }

    /**
     * Get replacementEvent
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReplacementEvent()
    {
        return $this->replacementEvent;
    }

    /**
     * Add punishmentEvent
     *
     * @param \Site\MainBundle\Entity\PunishmentEvent $punishmentEvent
     * @return Event
     */
    public function addPunishmentEvent(\Site\MainBundle\Entity\PunishmentEvent $punishmentEvent)
    {
        $this->punishmentEvent[] = $punishmentEvent;

        return $this;
    }

    /**
     * Remove punishmentEvent
     *
     * @param \Site\MainBundle\Entity\PunishmentEvent $punishmentEvent
     */
    public function removePunishmentEvent(\Site\MainBundle\Entity\PunishmentEvent $punishmentEvent)
    {
        $this->punishmentEvent->removeElement($punishmentEvent);
    }

    /**
     * Get punishmentEvent
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPunishmentEvent()
    {
        return $this->punishmentEvent;
    }

    /**
     * Add goalEvent
     *
     * @param \Site\MainBundle\Entity\GoalEvent $goalEvent
     * @return Event
     */
    public function addGoalEvent(\Site\MainBundle\Entity\GoalEvent $goalEvent)
    {
        $this->goalEvent[] = $goalEvent;

        return $this;
    }

    /**
     * Remove goalEvent
     *
     * @param \Site\MainBundle\Entity\GoalEvent $goalEvent
     */
    public function removeGoalEvent(\Site\MainBundle\Entity\GoalEvent $goalEvent)
    {
        $this->goalEvent->removeElement($goalEvent);
    }

    /**
     * Get goalEvent
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGoalEvent()
    {
        return $this->goalEvent;
    }

    /**
     * Add benchPlayerTeam
     *
     * @param \Site\MainBundle\Entity\BenchPlayerTeam $benchPlayerTeam
     * @return Event
     */
    public function addBenchPlayerTeam(\Site\MainBundle\Entity\BenchPlayerTeam $benchPlayerTeam)
    {
        $this->benchPlayerTeam[] = $benchPlayerTeam;

        return $this;
    }

    /**
     * Remove benchPlayerTeam
     *
     * @param \Site\MainBundle\Entity\BenchPlayerTeam $benchPlayerTeam
     */
    public function removeBenchPlayerTeam(\Site\MainBundle\Entity\BenchPlayerTeam $benchPlayerTeam)
    {
        $this->benchPlayerTeam->removeElement($benchPlayerTeam);
    }

    /**
     * Get benchPlayerTeam
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBenchPlayerTeam()
    {
        return $this->benchPlayerTeam;
    }

    /**
     * Получение массива наказаний игроков для вывода в шаблоне
     */
    public function getPunishmentEventArray(){
        $punishments = array(
            'left' => array(),
            'right' => array()
        );

        foreach($this->punishmentEvent as $punishment){
            if($punishment->getType() == false){
                $punishments['left'][] = $punishment;
            }else{
                $punishments['right'][] = $punishment;
            }
        }

        $countString = count($punishments['left']) > count($punishments['right']) ? count($punishments['left']) : count($punishments['right']);
        $result = array();

        for($i = 0; $i < $countString; $i++){
            if(isset($punishments['left'][$i])){
                $result[$i]['left'] = $punishments['left'][$i];
            }
            if(isset($punishments['right'][$i])){
                $result[$i]['right'] = $punishments['right'][$i];
            }
        }

        return $result;
    }

    /**
     * Получение массива замен для вывода в шаблоне
     */
    public function getReplacementEventArray(){
        $replacements = array(
            'left' => array(),
            'right' => array()
        );

        foreach($this->replacementEvent as $replacement){
            if($replacement->getType() == false){
                $replacements['left'][] = $replacement;
            }else{
                $replacements['right'][] = $replacement;
            }
        }

        $countString = count($replacements['left']) > count($replacements['right']) ? count($replacements['left']) : count($replacements['right']);
        $result = array();

        for($i = 0; $i < $countString; $i++){
            if(isset($replacements['left'][$i])){
                $result[$i]['left'] = $replacements['left'][$i];
            }
            if(isset($replacements['right'][$i])){
                $result[$i]['right'] = $replacements['right'][$i];
            }
        }

        return $result;
    }

    /**
     * Получение массива состава команд для вывода в шаблоне
     */
    public function getPlayerTeamArray(){
        $playerTeams = array(
            'left' => array(),
            'right' => array()
        );

        foreach($this->playerTeam as $playerTeam){
            if($playerTeam->getType() == false){
                $playerTeams['left'][] = $playerTeam;
            }else{
                $playerTeams['right'][] = $playerTeam;
            }
        }

        $countString = count($playerTeams['left']) > count($playerTeams['right']) ? count($playerTeams['left']) : count($playerTeams['right']);
        $result = array();

        for($i = 0; $i < $countString; $i++){
            if(isset($playerTeams['left'][$i])){
                $result[$i]['left'] = $playerTeams['left'][$i];
            }
            if(isset($playerTeams['right'][$i])){
                $result[$i]['right'] = $playerTeams['right'][$i];
            }
        }

        return $result;
    }

    /**
     * Получение массива запасных для вывода в шаблоне
     */
    public function getBenchPlayerTeamArray(){
        $benchPlayerTeams = array(
            'left' => array(),
            'right' => array()
        );

        foreach($this->benchPlayerTeam as $benchPlayerTeam){
            if($benchPlayerTeam->getType() == false){
                $benchPlayerTeams['left'][] = $benchPlayerTeam;
            }else{
                $benchPlayerTeams['right'][] = $benchPlayerTeam;
            }
        }

        $countString = count($benchPlayerTeams['left']) > count($benchPlayerTeams['right']) ? count($benchPlayerTeams['left']) : count($benchPlayerTeams['right']);
        $result = array();

        for($i = 0; $i < $countString; $i++){
            if(isset($benchPlayerTeams['left'][$i])){
                $result[$i]['left'] = $benchPlayerTeams['left'][$i];
            }
            if(isset($benchPlayerTeams['right'][$i])){
                $result[$i]['right'] = $benchPlayerTeams['right'][$i];
            }
        }

        return $result;
    }

    /**
     * Получение массива тренеров для вывода в шаблоне
     */
    public function getBenchCoachArray(){
        $benchCoachs = array(
            'left' => array(),
            'right' => array()
        );

        foreach($this->benchCoach as $benchCoach){
            if($benchCoach->getType() == false){
                $benchCoachs['left'][] = $benchCoach;
            }else{
                $benchCoachs['right'][] = $benchCoach;
            }
        }

        $countString = count($benchCoachs['left']) > count($benchCoachs['right']) ? count($benchCoachs['left']) : count($benchCoachs['right']);
        $result = array();

        for($i = 0; $i < $countString; $i++){
            if(isset($benchCoachs['left'][$i])){
                $result[$i]['left'] = $benchCoachs['left'][$i];
            }
            if(isset($benchCoachs['right'][$i])){
                $result[$i]['right'] = $benchCoachs['right'][$i];
            }
        }

        return $result;
    }
}
