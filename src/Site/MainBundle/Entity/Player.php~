<?php

namespace Site\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Site\MainBundle\Entity\Player
 *
 * @ORM\Table(name="player")
 * @ORM\Entity(repositoryClass="Site\MainBundle\Entity\Repository\PlayerRepository")
 */
class Player
{

    const STATUS_MAIN = 0;
    const STATUS_DOP = 1;
    const STATUS_YORTH = 2;
    const STATUS_ARCHIVE = 3;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Имя игрока
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=50, nullable=false)
     */
    private $firstname;

    /**
     * Фамилия игрока
     * @var string
     *
     * @ORM\Column(name="secondname", type="string", length=50, nullable=true)
     */
    private $secondname;

    /**
     * Отчество игрока
     * @var string
     *
     * @ORM\Column(name="patronymic", type="string", length=50, nullable=true)
     */
    private $patronymic;

    /**
     * Место рождения
     * @var string
     *
     * @ORM\Column(name="birth_place", type="string", length=100, nullable=true)
     */
    private $birthPlace;

    /**
     * Гражданство
     * @var string
     *
     * @ORM\Column(name="nationality", type="string", length=50, nullable=true)
     */
    private $nationality;

    /**
     * Амплуа
     * @var string
     *
     * @ORM\Column(name="amplua", type="string", length=50, nullable=true)
     */
    private $amplua;

    /**
     * Рост
     * @var string
     *
     * @ORM\Column(name="height", type="string", length=50, nullable=true)
     */
    private $height;

    /**
     * Вес
     * @var string
     *
     * @ORM\Column(name="weight", type="string", length=50, nullable=true)
     */
    private $weight;

    /**
     * Первый тренер
     * @var string
     *
     * @ORM\Column(name="firstCoach", type="string", length=50, nullable=true)
     */
    private $firstCoach;

    /**
     * Достижения
     * @var string
     *
     * @ORM\Column(name="progress", type="text", nullable=true)
     */
    private $progress;

    /**
     * Звания
     * @var string
     *
     * @ORM\Column(name="title", type="text", nullable=true)
     */
    private $title;

    /**
     * Предыдущие команды
     * @var string
     *
     * @ORM\Column(name="previous_team", type="text", nullable=true)
     */
    private $previousTeams;

    /**
     * Любимое место
     * @var string
     *
     * @ORM\Column(name="favorite_place", type="text", nullable=true)
     */
    private $favoritePlace;

    /**
     * Любимое блюдо
     * @var string
     *
     * @ORM\Column(name="favorite_dish", type="text", nullable=true)
     */
    private $favoriteDish;

    /**
     * Любимая музыка
     * @var string
     *
     * @ORM\Column(name="favorite_music", type="text", nullable=true)
     */
    private $favoriteMusic;

    /**
     * Любимая книга
     * @var string
     *
     * @ORM\Column(name="favorite_book", type="text", nullable=true)
     */
    private $favoriteBook;

    /**
     * Если бы не футбол, то что?
     * @var string
     *
     * @ORM\Column(name="any_sport", type="text", nullable=true)
     */
    private $anySport;

    /**
     * Чем занимаетесь в свободное время
     * @var string
     *
     * @ORM\Column(name="hobby", type="text", nullable=true)
     */
    private $hobby;

    /**
     * Любимая фраза
     * @var string
     *
     * @ORM\Column(name="favorite_phrase", type="text", nullable=true)
     */
    private $favoritePhrase;

    /**
     * Фото игрока
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img;

    /**
     * @Assert\File()
     */
    private $file;

    /**
     * Дата рождения
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    private $birthday;

    /**
     * Статус игрока
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $status = 0;

    /**
     * @ORM\ManyToMany(targetEntity="Team", inversedBy="players")
     * @ORM\JoinTable(name="players_teams")
     **/
    private $teams;

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
        return 'uploads/player';
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
     * Constructor
     */
    public function __construct()
    {
        $this->teams = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set firstname
     *
     * @param string $firstname
     * @return Player
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set secondname
     *
     * @param string $secondname
     * @return Player
     */
    public function setSecondname($secondname)
    {
        $this->secondname = $secondname;

        return $this;
    }

    /**
     * Get secondname
     *
     * @return string 
     */
    public function getSecondname()
    {
        return $this->secondname;
    }

    /**
     * Set img
     *
     * @param string $img
     * @return Player
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
     * Set birthday
     *
     * @param \DateTime $birthday
     * @return Player
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime 
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Player
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function getStatusText()
    {
        switch($this->status){
            case 0: {
                return 'backend.player.status_choice.main';
            }break;
            case 1: {
                return 'backend.player.status_choice.yorth';
            }break;
            case 2: {
                return 'backend.player.status_choice.dop';
            }break;
            case 3: {
                return 'backend.player.status_choice.archive';
            }break;
            default: {
                return 'backend.player.status_choice.main';
            }break;
        }
    }

    /**
     * Add teams
     *
     * @param \Site\MainBundle\Entity\Team $teams
     * @return Player
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

    public function __toString(){
        return $this->getFirstname() . ' ' . $this->getSecondname();
    }

    /**
     * Set birthPlace
     *
     * @param string $birthPlace
     * @return Player
     */
    public function setBirthPlace($birthPlace)
    {
        $this->birthPlace = $birthPlace;

        return $this;
    }

    /**
     * Get birthPlace
     *
     * @return string 
     */
    public function getBirthPlace()
    {
        return $this->birthPlace;
    }

    /**
     * Set nationality
     *
     * @param string $nationality
     * @return Player
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return string 
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set amplua
     *
     * @param string $amplua
     * @return Player
     */
    public function setAmplua($amplua)
    {
        $this->amplua = $amplua;

        return $this;
    }

    /**
     * Get amplua
     *
     * @return string 
     */
    public function getAmplua()
    {
        return $this->amplua;
    }

    /**
     * Set height
     *
     * @param string $height
     * @return Player
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return string 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set weight
     *
     * @param string $weight
     * @return Player
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return string 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set firstCoach
     *
     * @param string $firstCoach
     * @return Player
     */
    public function setFirstCoach($firstCoach)
    {
        $this->firstCoach = $firstCoach;

        return $this;
    }

    /**
     * Get firstCoach
     *
     * @return string 
     */
    public function getFirstCoach()
    {
        return $this->firstCoach;
    }

    /**
     * Set progress
     *
     * @param string $progress
     * @return Player
     */
    public function setProgress($progress)
    {
        $this->progress = $progress;

        return $this;
    }

    /**
     * Get progress
     *
     * @return string 
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Player
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set previousTeams
     *
     * @param string $previousTeams
     * @return Player
     */
    public function setPreviousTeams($previousTeams)
    {
        $this->previousTeams = $previousTeams;

        return $this;
    }

    /**
     * Get previousTeams
     *
     * @return string 
     */
    public function getPreviousTeams()
    {
        return $this->previousTeams;
    }

    /**
     * Set favoritePlace
     *
     * @param string $favoritePlace
     * @return Player
     */
    public function setFavoritePlace($favoritePlace)
    {
        $this->favoritePlace = $favoritePlace;

        return $this;
    }

    /**
     * Get favoritePlace
     *
     * @return string 
     */
    public function getFavoritePlace()
    {
        return $this->favoritePlace;
    }

    /**
     * Set favoriteDish
     *
     * @param string $favoriteDish
     * @return Player
     */
    public function setFavoriteDish($favoriteDish)
    {
        $this->favoriteDish = $favoriteDish;

        return $this;
    }

    /**
     * Get favoriteDish
     *
     * @return string 
     */
    public function getFavoriteDish()
    {
        return $this->favoriteDish;
    }

    /**
     * Set favoriteMusic
     *
     * @param string $favoriteMusic
     * @return Player
     */
    public function setFavoriteMusic($favoriteMusic)
    {
        $this->favoriteMusic = $favoriteMusic;

        return $this;
    }

    /**
     * Get favoriteMusic
     *
     * @return string 
     */
    public function getFavoriteMusic()
    {
        return $this->favoriteMusic;
    }

    /**
     * Set favoriteBook
     *
     * @param string $favoriteBook
     * @return Player
     */
    public function setFavoriteBook($favoriteBook)
    {
        $this->favoriteBook = $favoriteBook;

        return $this;
    }

    /**
     * Get favoriteBook
     *
     * @return string 
     */
    public function getFavoriteBook()
    {
        return $this->favoriteBook;
    }

    /**
     * Set anySport
     *
     * @param string $anySport
     * @return Player
     */
    public function setAnySport($anySport)
    {
        $this->anySport = $anySport;

        return $this;
    }

    /**
     * Get anySport
     *
     * @return string 
     */
    public function getAnySport()
    {
        return $this->anySport;
    }

    /**
     * Set hobby
     *
     * @param string $hobby
     * @return Player
     */
    public function setHobby($hobby)
    {
        $this->hobby = $hobby;

        return $this;
    }

    /**
     * Get hobby
     *
     * @return string 
     */
    public function getHobby()
    {
        return $this->hobby;
    }

    /**
     * Set favoritePhrase
     *
     * @param string $favoritePhrase
     * @return Player
     */
    public function setFavoritePhrase($favoritePhrase)
    {
        $this->favoritePhrase = $favoritePhrase;

        return $this;
    }

    /**
     * Get favoritePhrase
     *
     * @return string 
     */
    public function getFavoritePhrase()
    {
        return $this->favoritePhrase;
    }

    /**
     * Set patronymic
     *
     * @param string $patronymic
     * @return Player
     */
    public function setPatronymic($patronymic)
    {
        $this->patronymic = $patronymic;

        return $this;
    }

    /**
     * Get patronymic
     *
     * @return string 
     */
    public function getPatronymic()
    {
        return $this->patronymic;
    }
}
