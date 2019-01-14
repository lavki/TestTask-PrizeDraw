<?php

namespace Authentication\Service;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Db\Adapter\AdapterInterface as DbAdapter;
use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter;

/**
 * Class AuthenticationAdapter
 * @package Authentication\Service
 */
class AuthenticationAdapter implements AdapterInterface
{
    /**
     * @var DbAdapter
     */
    private $db;

    /**
     * @var
     */
    private $email;

    /**
     * @var
     */
    private $password;

    /**
     * AuthenticationAdapter constructor.
     * @param DbAdapter $db
     */
    public function __construct( DbAdapter $db )
    {
        $this->db = $db;
    }

    /**
     * @param string $email
     */
    public function setEmail( string $email )
    {
        $this->email = $email;
    }

    /**
     * @param string $password
     */
    public function setPassword( string $password )
    {
        $this->password = $password;
    }

    /**
     * @return CallbackCheckAdapter
     */
    public function authenticate()
    {
        $passwordValidation = function ( $hash, $password ) {
            return password_verify( $password, $hash );
        };

        $authenticate = new CallbackCheckAdapter(
            $this->db,
            'user',
            'email',
            'password',
            $passwordValidation

        );

        $authenticate->setIdentity( $this->email )
                     ->setCredential( $this->password );

        return $authenticate;
    }
}