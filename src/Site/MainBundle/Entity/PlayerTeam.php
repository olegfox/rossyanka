<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Составы команд
 * Site\MainBundle\Entity\PlayerTeam
 *
 * @ORM\Table(name="player_team")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\PlayerTeamRepository")
 */
class PlayerTeam
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="playerTeam")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     **/
    private $event;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="boolean", nullable=false)
     */
    private $type = false;

    /**
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="playerTeam")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     **/
    private $player;

    /**
     * @var string
     *
     * @ORM\Column(name="time", type="string", length = 50, nullable=true)
     */
    private $time;

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
     * Set event
     *
     * @param \Site\MainBundle\Entity\Event $event
     * @return PlayerTeam
     */
    public function setEvent(\Site\MainBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \Site\MainBundle\Entity\Event 
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set player
     *
     * @param \Site\MainBundle\Entity\Player $player
     * @return PlayerTeam
     */
    public function setPlayer(\Site\MainBundle\Entity\Player $player = null)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get player
     *
     * @return \Site\MainBundle\Entity\Player 
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set type
     *
     * @param boolean $type
     * @return PlayerTeam
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return boolean 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set time
     *
     * @param string $time
     * @return PlayerTeam
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return string 
     */
    public function getTime()
    {
        return $this->time;
    }
}
