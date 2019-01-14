<?php

namespace Authentication\Service\Factory;

use Zend\Session\SessionManager;
use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Authentication\Service\AuthenticationManager;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;

/**
 * Class AuthenticationManagerFactory
 * @package Authentication\Service\Factory
 */
class AuthenticationManagerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return AuthenticationManager
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $authenticationService = $container->get( AuthenticationService::class );
        $sessionManager        = $container->get( SessionManager::class );
        $config                = $container->get( 'Config' );

        if( isset($config['access_filter']) )
        {
            $config = $config['access_filter'];
        }

        else
        {
            $config = [];
        }

        return new AuthenticationManager( $authenticationService, $sessionManager, $config );
    }
}