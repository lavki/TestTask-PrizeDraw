<?php

namespace Application\Service;

use Application\Repository\PrizeTypeRepository;

/**
 * Class RafflePrize
 * @package Application\Service
 */
trait RafflePrize
{
    /**
     * @var array
     */
    private $prizeTypes = [];

    /**
     * @var PrizeTypeRepository
     */
    private $prizeTypeRepository;

    /**
     * Return one of 3 existing prizes (or money, or bunus, or item)
     * @return mixed
     */
    private function getRandomPrize()
    {
        $this->setPrizeTypes(); // set value into private $prizeTypes;

        $count       = count($this->prizeTypes); // max value of existing types of prizes
        $randomPrize = rand( 1, $count );        // random selection in a given range

        return $this->prizeTypes[$randomPrize];
    }

    /**
     * fill the class property (prize types)
     */
    private function setPrizeTypes()
    {
        $prizeTypes = $this->prizeTypeRepository->readTypes();

        foreach( $prizeTypes as $prizeType )
        {
            $this->prizeTypes[$prizeType->getId()] = $prizeType->getType();
        }
    }
}