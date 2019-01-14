<?php

namespace Authentication\Service\Factory;

use Zend\Session\SessionManager;
use Zend\Authentication\Storage\Session;
use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;
use Authentication\Service\AuthenticationAdapter;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;

/**
 * Class AuthenticationServiceFactory
 * @package Authentication\Service\Factory
 */
class AuthenticationServiceFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return AuthenticationService
     */
    public function __invoke( ContainerInterface $container, $requestedName, array $options = null )
    {
        $sessionManager        = $container->get( SessionManager::class );
        $authenticationStorage = new Session('Zend_Auth', 'session', $sessionManager );
        $authenticationAdapter = $container->get( AuthenticationAdapter::class );

        return new AuthenticationService( $authenticationStorage, $authenticationAdapter );
    }
}