<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrincipleEntityRepository")
 * @ORM\Table(name="principles")
 * This entity class corresponds to a row in the database.
 */
class PrincipleEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @var integer $id
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * 
     * @var string $title
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @var string $description
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @var string $keywords
     */
    private $keywords;

    /**
     * @ORM\Column(type="text")
     * 
     * @var string $explanation
     */
    private $explanation;

    /**
     * Outputs the ID of this entity, corresponding to a database auto incremented primary key.
     *
     * @return integer $id
     */
    public function getId() 
    {
        return $this->id;
    }

    /**
     * Outputs the title of this entity, corresponding to a database column.
     *
     * @return string $title
     */
    public function getTitle() 
    {
        return $this->title;
    }

    /**
     * Outputs the title of this entity, corresponding to a database column.
     *
     * @return string $title
     */
    public function getDescription() 
    {
        return $this->description;
    }

    /**
     * Outputs the title of this entity, corresponding to a database column.
     *
     * @return string $title
     */
    public function getKeywords() 
    {
        return $this->keywords;
    }

    /**
     * Outputs the title of this entity, corresponding to a database column.
     *
     * @return string $title
     */
    public function getExplanation() 
    {
        return $this->explanation;
    }

    /**
     * Sets the ID of this entity, corresponding to a database auto incremented primary key.
     *
     * @param integer $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * Sets the title of this entity, corresponding to a database column.
     *
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Sets the description of this entity, corresponding to a database column.
     *
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Sets the keywords of this entity, corresponding to a database column.
     *
     * @param string $keywords
     */
    public function setKeywords(string $keywords)
    {
        $this->keywords = $keywords;
    }

    /**
     * Sets the explanantion of this entity, corresponding to a database column.
     *
     * @param string $explanation
     */
    public function setExplanation(string $explanation)
    {
        $this->explanation = $explanation;
    }


}
