<?php

namespace Application\Service;

/**
 * Class ConvertManager
 * @package Application\Service
 */
trait ConvertManager
{
    /**
     * Cash prize can converted into loyalty points, taking into account the coefficient.
     * @param int $money
     * @param float $coefficient
     * @return float
     */
    public function convertMoneyToBonus( int $money, float $coefficient = 1 ): float
    {
        $bonus = $coefficient * $money;

        return $bonus;
    }
}