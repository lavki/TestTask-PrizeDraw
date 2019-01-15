<?php

namespace Application\Entity;

/**
 * Class PrizeType
 * @package Application\Entity
 */
class PrizeType
{
    private $id;

    private $type;

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
     * @param int $type
     */
    public function setType( int $type )
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}