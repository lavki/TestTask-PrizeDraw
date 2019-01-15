<?php

namespace Authentication\Entity;

/**
 * Class User
 * @package Authentication\Entity
 */
class User
{
    private $id;

    private $email;

    private $password;

    /**
     * @param int $id
     */
    public function setId( int $id )
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $email
     */
    public function setEmail( string $email )
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $password
     */
    public function setPassword( string $password )
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}