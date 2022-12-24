<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NumeroZipcode
 *
 * @ORM\Table(name="numero_zipcode", uniqueConstraints={@ORM\UniqueConstraint(name="numero", columns={"numero"})})
 * @ORM\Entity
 */
class NumeroZipcode
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment"="Primary Key"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=15, nullable=false)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="string", length=5, nullable=false)
     */
    private $zipcode;



    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of numero
     *
     * @return  string
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @param  string  $numero
     *
     * @return  self
     */ 
    public function setNumero(string $numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of zipcode
     *
     * @return  string
     */ 
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set the value of zipcode
     *
     * @param  string  $zipcode
     *
     * @return  self
     */ 
    public function setZipcode(string $zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }
}
