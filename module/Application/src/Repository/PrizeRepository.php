<?php

namespace Application\Repository;

use Zend\Db\Sql\Sql;
use Application\Entity\Prize;
use Zend\Hydrator\HydratorInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Adapter\Driver\ResultInterface;

/**
 * Class PrizeRepository
 * @package Application\Repository
 */
class PrizeRepository implements PrizeRepositoryInterface
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
     * @var Prize
     */
    private $prize;

    /**
     * PrizeRepository constructor.
     * @param AdapterInterface $adapter
     * @param HydratorInterface $hydrator
     * @param Prize $prize
     */
    public function __construct( AdapterInterface $adapter, HydratorInterface $hydrator, Prize $prize )
    {
        $this->db       = $adapter;
        $this->hydrator = $hydrator;
        $this->prize    = $prize;
    }

    /**
     * @return bool|object
     */
    public function getRandomPrize()
    {
        $sql       = new Sql($this->db);
        $select    = $sql->select('prize' )
            ->where(['id' => rand(1, 7)])
            ->limit(1 );
        $statement = $sql->prepareStatementForSqlObject($select);
        $result    = $statement->execute();

        if( !$result instanceof ResultInterface || !$result->isQueryResult() )
        {
            return false;
        }

        $resultSet = new HydratingResultSet($this->hydrator, $this->prize);
        $resultSet->initialize($result);

        return $resultSet->current();
    }
}