<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact extends BasicEntity
{
    /**
     * @Assert\NotBlank(message="Ce champ ne doit pas être vide.")
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "Le nom doit comporter au minimum {{ limit }} caractères.",
     * )
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $lastname;

    /**
     * @Assert\NotBlank(message="Ce champ ne doit pas être vide.")
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "Le prénom doit comporter au minimum {{ limit }} caractères.",
     * )
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $firstname;

    /**
     * @Assert\NotBlank(message="Ce champ ne doit pas être vide.")
     * @Assert\Length(
     *     min = 10,
     *     max = 10,
     *     exactMessage = "Le numéro de téléphone saisie est invalide.",
     * )
     *
     * @ORM\Column(type="string", length=10, nullable=false)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $compagny;

    /**
     * @Assert\Email(
     *     message = "Cet email '{{ value }}' n'est pas valide.",
     *     checkMX = true
     * )
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     * @return Contact
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     * @return Contact
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     * @return Contact
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompagny()
    {
        return $this->compagny;
    }

    /**
     * @param mixed $compagny
     * @return Contact
     */
    public function setCompagny($compagny)
    {
        $this->compagny = $compagny;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

}