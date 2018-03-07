<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserEntityRepository")
 * @ORM\Table(name="users")
 * This entity class corresponds to a row in the database table.
 */
class UserEntity implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     * 
     * @var integer $id
     */
    private $id;
    
    /**
     * @ORM\Column(name="username", type="string", length=64, unique=true)
     * 
     * @var string $username
     */
    private $username;

    /**
     * A plain text password, this will not be saved in the database.
     * It will be encoded with an encryption algorithim to get the password.
     *
     * @var string $plainPassword
     */
    private $plainPassword;

    /**
     * @ORM\Column(name="password", type="string", length=64)
     * 
     * @var string $plainPassword
     */
    private $password;

    /**
     * @ORM\Column(name="email", type="string", length=64, unique=true)
     * 
     * @var string $email
     */
    private $email;

    /**
     * @ORM\Column(name="roles", type="string", length=255)
     *
     * @var string $roles
     */
    private $roles;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     * 
     * @var boolean $isActive
     */
    private $isActive;

    public function __construct()
    {
        $this->isActive = true;

        $this->roles = json_encode(['ROLE_USER']);
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }

    /**
     * Outputs the username of this entity, corresponding to a database column.
     *
     * @return string $username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Outputs the email address of this entity, corresponding to a database column.
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * Outputs the password of this entity, corresponding to a database column.
     *
     * @return string $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Outputs the roles of this entity, corresponding to a database column.
     *
     * @return array $roles
     */
    public function getRoles()
    {
        return json_decode($this->roles);
    }

    public function eraseCredentials()
    {
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setPlainPassword(string $password)
    {
        $this->plainPassword = $password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Sets the roles of this entity, corresponding to a database column.
     *
     * @param array $roles
     */
    public function setRoles(array $roles)
    {
        $this->getRoles()[] = $roles;

        $this->roles = json_encode($roles);
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }
}
