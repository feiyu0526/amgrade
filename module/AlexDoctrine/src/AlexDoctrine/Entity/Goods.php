<?php

namespace AlexDoctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GOODS
 *
 * @ORM\Table(name="goods", options={"collate"="utf8_general_ci", "charset"="utf8", "engine"="InnoDB"})
 * @ORM\Entity(repositoryClass="AlexDoctrine\Entity\Repository\GoodsRepository")
 * @property int $id
 * @property string $image
 * @property string $title
 * @property string $mdTitle
 * @property string $price
 * @property string $currency
 * @property string $linkToOriginal
 * @property string $description
 */
class Goods
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="Image", type="string", length=100, nullable=false)
     */
    private $image;

      /**
     * @var string
     *
     * @ORM\Column(name="Title",unique=true, type="string", length=200, nullable=false)
     */
    private $title;

       /**
     * @var string
     *
     * @ORM\Column(name="MdTitle",unique=true, type="string", length=32, nullable=false)
     */
    private $mdTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="Price", type="string", length=200, nullable=false)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="Currency", type="string", length=200, nullable=false)
     */
    private $currency;
    /**
     * @var string
     *
     * @ORM\Column(name="LinkToOriginal", type="string", length=200, nullable=false)
     */
    private $linkToOriginal;
    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=200, nullable=false)
     */
    private $description;


//GETS AND SET

    public function getId()
    {
        return $this->id;
    }
    public function setId ($value)
    {
        $this->id = $value;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function setImage ($value)
    {
        $this->image = $value;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle ($value)
    {
        $this->title = $value;
    }
    public function getMdtitle()
    {
        return $this->mdTitle;
    }
    public function setMdtitle ($value)
    {
        $this->mdTitle = $value;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function setPrice ($value)
    {
        $this->price = $value;
    }
    public function getCurrency()
    {
        return $this->currency;
    }
    public function setCurrency ($value)
    {
        $this->currency = $value;
    }
    public function getLinkToOriginal()
    {
        return $this->linkToOriginal;
    }
    public function setLinkToOriginal ($value)
    {
        $this->linkToOriginal = $value;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription ($value)
    {
        $this->description = $value;
    }

}

