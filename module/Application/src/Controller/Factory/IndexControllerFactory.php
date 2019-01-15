<?php

namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Application\Controller\IndexController;
use Application\Repository\PrizeRepository;
use Application\Repository\PrizeTypeRepository;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;

/**
 * Class IndexControllerFactory
 * @package Application\Controller\Factory
 */
class IndexControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return IndexController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $prizeRepository     = $container->get(PrizeRepository::class);
        $prizeTypeRepository = $container->get(PrizeTypeRepository::class);

        return new IndexController( $prizeRepository, $prizeTypeRepository );
    }
}