<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NumeroDons
 *
 * @ORM\Table(name="numero_dons", uniqueConstraints={@ORM\UniqueConstraint(name="numero", columns={"numero"})})
 * @ORM\Entity
 */
class NumeroDons
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
     * @var int
     *
     * @ORM\Column(name="montant", type="integer", nullable=false)
     */
    private $montant;



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
     * Get the value of montant
     *
     * @return  int
     */ 
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set the value of montant
     *
     * @param  int  $montant
     *
     * @return  self
     */ 
    public function setMontant(int $montant)
    {
        $this->montant = $montant;

        return $this;
    }
}
