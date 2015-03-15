<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Site\MainBundle\Entity\Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\TeamRepository")
 */
class Team
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Название команды
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * Герб команды
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img;

    /**
     * @ORM\ManyToMany(targetEntity="Event", inversedBy="teams")
     **/
    private $event;

    /**
     * @Assert\File()
     */
    private $file;

    /**
     * @ORM\ManyToMany(targetEntity="Player", inversedBy="teams")
     **/
    private $players;

    public function getAbsolutePath()
    {
        return null === $this->img
            ? null
            : $this->getUploadRootDir().'/'.$this->img;
    }

    public function getWebPath()
    {
        return null === $this->img
            ? null
            : $this->getUploadDir().'/'.$this->img;
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../../'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/team';
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;

        $this->upload();
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        if (isset($this->img)) {
            if(file_exists($this->getUploadDir().'/'.$this->img)){
                unlink($this->getUploadDir().'/'.$this->img);
            }
            $this->img = null;
        }

        $this->img = $this->getFile()->getClientOriginalName();

        $this->getFile()->move(
            $this->getUploadDir(),
            $this->img
        );

        $this->file = null;
    }

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
     * @param string $name
     * @return Team
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set img
     *
     * @param string $img
     * @return Team
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string 
     */
    public function getImg()
    {
        return $this->img;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->players = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add players
     *
     * @param \Site\MainBundle\Entity\Player $players
     * @return Team
     */
    public function addPlayer(\Site\MainBundle\Entity\Player $players)
    {
        $this->players[] = $players;

        return $this;
    }

    /**
     * Remove players
     *
     * @param \Site\MainBundle\Entity\Player $players
     */
    public function removePlayer(\Site\MainBundle\Entity\Player $players)
    {
        $this->players->removeElement($players);
    }

    /**
     * Get players
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlayers()
    {
        return $this->players;
    }

    public function __toString(){
        return $this->name;
    }

    /**
     * Add event
     *
     * @param \Site\MainBundle\Entity\Event $event
     * @return Team
     */
    public function addEvent(\Site\MainBundle\Entity\Event $event)
    {
        $this->event[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param \Site\MainBundle\Entity\Event $event
     */
    public function removeEvent(\Site\MainBundle\Entity\Event $event)
    {
        $this->event->removeElement($event);
    }

    /**
     * Get event
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvent()
    {
        return $this->event;
    }
}