<?php

namespace Application\Repository;

use Zend\Db\Sql\Sql;
use Application\Entity\PrizeType;
use Zend\Hydrator\HydratorInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Adapter\Driver\ResultInterface;

/**
 * Class PrizeTypeRepository
 * @package Application\Repository
 */
class PrizeTypeRepository implements PrizeTypeRepositoryInterface
{
    /**
     * @var AdapterInterface
     */
    private $db;

    /**
     * @var HydratorInterface
     */
    private $hydrator;

    /**
     * @var PrizeType
     */
    private $prizeType;

    /**
     * PrizeTypeRepository constructor.
     * @param AdapterInterface $adapter
     * @param HydratorInterface $hydrator
     * @param PrizeType $prizeType
     */
    public function __construct( AdapterInterface $adapter, HydratorInterface $hydrator, PrizeType $prizeType )
    {
        $this->db        = $adapter;
        $this->hydrator  = $hydrator;
        $this->prizeType = $prizeType;
    }

    public function readTypes()
    {
        $sql       = new Sql($this->db);
        $select    = $sql->select('prize_type' )->order('id' );
        $statement = $sql->prepareStatementForSqlObject($select);
        $result    = $statement->execute();

        if( !$result instanceof ResultInterface || !$result->isQueryResult() )
        {
            return false;
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->prizeType);
        $resultSet->initialize($result);

        return $resultSet;
    }
}