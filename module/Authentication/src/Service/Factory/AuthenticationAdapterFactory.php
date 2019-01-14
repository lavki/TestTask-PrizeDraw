<?php

namespace Authentication\Service\Factory;

use Zend\Db\Adapter\AdapterInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Authentication\Service\AuthenticationAdapter;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;

/**
 * Class AuthenticationAdapterFactory
 * @package Authentication\Service\Factory
 */
class AuthenticationAdapterFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return AuthenticationAdapter
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new AuthenticationAdapter( $container->get(AdapterInterface::class) );
    }
}
