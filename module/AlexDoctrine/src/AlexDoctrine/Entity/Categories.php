<?php

namespace AlexDoctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Element\Select;
use Zend\Form\Annotation;

/**
 * Categories
 *
 * @ORM\Table(name="categories", options={"collate"="utf8_general_ci", "charset"="utf8", "engine"="InnoDB"})
 * @ORM\Entity(repositoryClass="AlexDoctrine\Entity\Repository\CategoriesRepository")
 *
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Annotation\Name("Categories")
 *
 * @property int $id
 * @property string $category
 */
class Categories
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Annotation\Exclude()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Category", type="string", length=100, nullable=true)
     *
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Required({"required":"true" })
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Select Category:",
     *                      "value_options" : {"0":"Select a Class"}})
     * @Annotation\Attributes({"value":"0"})
     */
    private $category;


    /**
     * @Annotation\Type("Zend\Form\Element\Csrf")
     */
    public $security;


    /**
     * @Annotation\Type("Zend\Form\Element\Submit")
     * @Annotation\Attributes({"value":"Create task"})
     */
    public $submit;





//GETS AND SET

    public function getId()
    {
        return $this->id;
    }
    public function setId ($value)
    {
        $this->id = $value;
    }

    public function getCategory()
    {
        return $this->category;
    }
    public function setCategory($value)
    {
        $this->category = $value;
    }


}

