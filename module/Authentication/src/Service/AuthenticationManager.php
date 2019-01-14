<?php

namespace Authentication\Service;

use Zend\Authentication\Result;
use Zend\Session\SessionManager;
use Zend\Authentication\AuthenticationService;

/**
 * Class AuthenticationManager
 * @package Authentication\Service
 */
class AuthenticationManager
{
    /**
     * @var AuthenticationService
     */
    private $authenticationService;

    /**
     * @var SessionManager
     */
    private $sessionManager;

    /**
     * Contents of the 'access_filter' config key.
     * @var array
     */
    private $config;

    /**
     * AuthenticationManager constructor.
     * @param AuthenticationService $authService
     * @param SessionManager $sessionManager
     * @param array $config
     */
    public function __construct( AuthenticationService $authService, SessionManager $sessionManager, array $config )
    {
        $this->authenticationService = $authService;
        $this->sessionManager        = $sessionManager;
        $this->config                = $config;
    }

    /**
     * @param string $email
     * @param string $password
     * @param bool $remember
     * @return Result
     * @throws \Exception
     */
    public function login( string $email, string $password, bool $remember )
    {
        if( $this->authenticationService->getIdentity() != null )
        {
            throw new \Exception('Already logged in');
        }

        $authenticationAdapter = $this->authenticationService->getAdapter();
        $authenticationAdapter->setEmail($email);
        $authenticationAdapter->setPassword($password);

        $result = $this->authenticationService->authenticate( $authenticationAdapter->authenticate() );

        if( $result->getCode() == Result::SUCCESS && $remember )
        {
            $this->sessionManager->rememberMe(60*60*24*30);
        }

        return $result;
    }

    /**
     * @throws \Exception
     */
    public function logout()
    {
        if( $this->authenticationService->getIdentity() !== null )
        {
            $this->authenticationService->clearIdentity();
        }

        else
        {
            throw new \Exception('The user is not logged in');
        }
    }

    /**
     * @param string $controller
     * @param string $action
     * @return bool
     * @throws \Exception
     */
    public function filterAccess( string $controller, string $action )
    {
        // Determine mode - 'restrictive' (default) or 'permissive'. In restrictive
        // mode all controller actions must be explicitly listed under the 'access_filter'
        // config key, and access is denied to any not listed action for unauthorized users.
        // In permissive mode, if an action is not listed under the 'access_filter' key,
        // access to it is permitted to anyone (even for not logged in users.
        // Restrictive mode is more secure and recommended to use.
        $mode = isset($this->config['options']['mode']) ? $this->config['options']['mode'] : 'restrictive';
        if( $mode!= 'restrictive' && $mode != 'permissive' )
        {
            throw new \Exception('Invalid access filter mode (expected either restrictive or permissive mode' );
        }

        if( isset($this->config['controllers'][$controller]) )
        {
            $items = $this->config['controllers'][$controller];
            foreach( $items as $item )
            {
                $actionList = $item['actions'];
                $allow      = $item['allow'];

                if( is_array($actionList) && in_array($action, $actionList) || $actionList=='*' )
                {
                    if( $allow == '*' )
                    {
                        return true; // Anyone is allowed to see the page.
                    }

                    else if( $allow == '@' && $this->authenticationService->hasIdentity() )
                    {
                        return true; // Only authenticated user is allowed to see the page.
                    }

                    else
                    {
                        return false; // Access denied.
                    }
                }
            }
        }

        // In restrictive mode, we forbid access for unauthorized users to any
        // action not listed under 'access_filter' key (for security reasons).
        if( $mode == 'restrictive' && !$this->authenticationService->hasIdentity() )
        {
            return false;
        }

        return true; // Permit access to this page.
    }
}