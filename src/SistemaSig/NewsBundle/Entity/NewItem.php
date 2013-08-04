<?php
/**
 * Created by JetBrains PhpStorm.
 * User: darvein
 * Date: 8/3/13
 * Time: 18:11
 * To change this template use File | Settings | File Templates.
 */

namespace SistemaSig\NewsBundle\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\MinLength;
use Symfony\Component\Validator\Constraints\MaxLength;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="news")
 */
class NewItem
{
    const LAPAZ = 1;
    const ELALTO = 2;
    const COCHABAMBA = 3;
    const SANTA_CRUZ = 4;
    const BENI = 5;
    const COBIJA = 6;
    const SUCRE = 7;
    const TARIJA = 8;
    const POTOSI = 9;

    const PUBLISHED = 1;
    const DRAFT = 0;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @ORM\Column(type="string")
     */
    protected $body;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $summary;

    /**
     * @ORM\Column(type="string")
     */
    protected $city;

    /**
     * @ORM\Column(type="string")
     */
    protected $status;

    /**
     * @ORM\Column(type="datetime", name="published_date")
     */
    protected $publishedDate;

    /**
     * @ORM\Column(type="datetime", name="created_date")
     */
    protected $createdDate;

    /**
     * @ORM\Column(type="datetime", name="updated_date")
     */
    protected $updatedDate;

    function __construct()
    {
        $this->publishedDate = new \DateTime();
        $this->updatedDate = new \DateTime();
        $this->createdDate = new \DateTime();
    }


    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('title', new NotBlank(array(
                'message' => 'El titulo no puede estar vacio'
            )));
        $metadata->addPropertyConstraint('body', new NotBlank(array(
                'message' => 'El contenido no puede estar vacio'
            )));
    }

    public static function getEntityName()
    {
        return get_called_class();
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @param mixed $publishedDate
     */
    public function setPublishedDate($publishedDate)
    {
        $this->publishedDate = $publishedDate;
    }

    /**
     * @return mixed
     */
    public function getPublishedDate()
    {
        return $this->publishedDate;
    }


    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $createdDate
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    /**
     * @return mixed
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $summary
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $updatedDate
     */
    public function setUpdatedDate($updatedDate)
    {
        $this->updatedDate = $updatedDate;
    }

    /**
     * @return mixed
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }


}