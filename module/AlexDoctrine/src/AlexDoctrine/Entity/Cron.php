<?php

namespace AlexDoctrine\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * CRON
 *
 * @ORM\Table(name="cron", options={"collate"="utf8_general_ci", "charset"="utf8", "engine"="InnoDB"})
 * @ORM\Entity(repositoryClass="AlexDoctrine\Entity\Repository\CronRepository")

 * @property int $id
 * @property string $name
 * @property string $status
 */

class Cron
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
     * @var integer
     *
     * @ORM\Column(name="Category", type="string", nullable=true)
     */
     private $category;

    /**
     * @var integer
     *
     * @ORM\Column(name="Status", type="string", nullable=true)
     */
    private $status;
 /**
     * @var string
     *
     * @ORM\Column(name="Error", type="string", length=100, nullable=true)
     */
    private $error;

     /**
     * Magic getter to expose protected properties.
     */


    public function getId ()
    {
         return $this->id;
    }
    public function setId ($value)
    {
         $this->id = $value;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus ($value)
    {
         $this->status = $value;
    }
    public function getError()
    {
        return $this->error;
    }
    public function setError($value)
    {
         $this->error = $value;
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