<?php

namespace Application\Repository\Factory;

use Application\Entity\Prize;
use Zend\Hydrator\ReflectionHydrator;
use Zend\Db\Adapter\AdapterInterface;
use Interop\Container\ContainerInterface;
use Application\Repository\PrizeRepository;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;

/**
 * Class PrizeRepositoryFactory
 * @package Application\Repository\Factory
 */
class PrizeRepositoryFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return PrizeRepository
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $adapter    = $container->get(AdapterInterface::class);
        $reflection = new ReflectionHydrator();
        $prize      = new Prize();

        return new PrizeRepository( $adapter, $reflection, $prize );
    }
}