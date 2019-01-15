<?php

namespace Application\Service;

use Application\Repository\PrizeRepository;
use Application\Repository\PrizeTypeRepository;

/**
 * Class RafflePrize
 * @package Application\Service
 */
trait RafflePrize
{
    private $prize = [];

    /**
     * @var array
     */
    private $prizeTypes = [];

    /**
     * @var PrizeTypeRepository
     */
    private $prizeTypeRepository;

    /**
     * @var PrizeRepository
     */
    private $prizeRepository;

    /**
     * IndexController constructor.
     * @param PrizeRepository $prizeRepository
     * @param PrizeTypeRepository $prizeTypeRepository
     */
    public function __construct( PrizeRepository $prizeRepository, PrizeTypeRepository $prizeTypeRepository )
    {
        $this->prizeRepository     = $prizeRepository;
        $this->prizeTypeRepository = $prizeTypeRepository;
    }

    /**
     * Return one of 3 existing prizes (or money, or bunus, or item)
     * @return mixed
     */
    private function getRandomPrize()
    {
        $this->setPrizeTypes(); // set value into private $prizeTypes;

        $count       = count($this->prizeTypes); // max value of existing types of prizes
        $randomPrize = rand( 1, $count );        // random selection in a given range

        switch( $this->prizeTypes[$randomPrize] )
        {
            case 'Money' :
                $this->prize['Money'] = rand(1, 10000);
                break;

            case 'Bonus' :
                $this->prize['Bonus'] = rand(1, 10000);
                break;

            case 'Item'  :
                $prizeItem = $this->prizeRepository->getRandomPrize();
                $this->prize['Item'] = $prizeItem->getPrize();
                break;
        }

        return $this->prize;
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