<?php

namespace Application\Entity;

/**
 * Class Prize
 * @package Application\Prize
 */
class Prize
{
    private $id;

    private $prize;

    /**
     * @param int $id
     */
    public function setId( int $id )
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $prize
     */
    public function setPrize( string $prize )
    {
        $this->prize = $prize;
    }

    /**
     * @return string
     */
    public function getPrize(): string
    {
        return $this->prize;
    }
}