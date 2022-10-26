<?php

namespace Shop\Models\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Shop\Models\Discount as ChildDiscount;
use Shop\Models\DiscountQuery as ChildDiscountQuery;
use Shop\Models\Map\DiscountTableMap;

/**
 * Base class that represents a query for the 'discount' table.
 *
 *
 *
 * @method     ChildDiscountQuery orderByDiscountid($order = Criteria::ASC) Order by the discountId column
 * @method     ChildDiscountQuery orderByDatevalid($order = Criteria::ASC) Order by the dateValid column
 * @method     ChildDiscountQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method     ChildDiscountQuery orderByPercentage($order = Criteria::ASC) Order by the percentage column
 * @method     ChildDiscountQuery orderByValid($order = Criteria::ASC) Order by the valid column
 *
 * @method     ChildDiscountQuery groupByDiscountid() Group by the discountId column
 * @method     ChildDiscountQuery groupByDatevalid() Group by the dateValid column
 * @method     ChildDiscountQuery groupByCode() Group by the code column
 * @method     ChildDiscountQuery groupByPercentage() Group by the percentage column
 * @method     ChildDiscountQuery groupByValid() Group by the valid column
 *
 * @method     ChildDiscountQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDiscountQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDiscountQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDiscountQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDiscountQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDiscountQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDiscountQuery leftJoinDiscount($relationAlias = null) Adds a LEFT JOIN clause to the query using the Discount relation
 * @method     ChildDiscountQuery rightJoinDiscount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Discount relation
 * @method     ChildDiscountQuery innerJoinDiscount($relationAlias = null) Adds a INNER JOIN clause to the query using the Discount relation
 *
 * @method     ChildDiscountQuery joinWithDiscount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Discount relation
 *
 * @method     ChildDiscountQuery leftJoinWithDiscount() Adds a LEFT JOIN clause and with to the query using the Discount relation
 * @method     ChildDiscountQuery rightJoinWithDiscount() Adds a RIGHT JOIN clause and with to the query using the Discount relation
 * @method     ChildDiscountQuery innerJoinWithDiscount() Adds a INNER JOIN clause and with to the query using the Discount relation
 *
 * @method     \Shop\Models\PurchaseQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDiscount|null findOne(?ConnectionInterface $con = null) Return the first ChildDiscount matching the query
 * @method     ChildDiscount findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildDiscount matching the query, or a new ChildDiscount object populated from the query conditions when no match is found
 *
 * @method     ChildDiscount|null findOneByDiscountid(int $discountId) Return the first ChildDiscount filtered by the discountId column
 * @method     ChildDiscount|null findOneByDatevalid(string $dateValid) Return the first ChildDiscount filtered by the dateValid column
 * @method     ChildDiscount|null findOneByCode(string $code) Return the first ChildDiscount filtered by the code column
 * @method     ChildDiscount|null findOneByPercentage(double $percentage) Return the first ChildDiscount filtered by the percentage column
 * @method     ChildDiscount|null findOneByValid(boolean $valid) Return the first ChildDiscount filtered by the valid column *

 * @method     ChildDiscount requirePk($key, ?ConnectionInterface $con = null) Return the ChildDiscount by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDiscount requireOne(?ConnectionInterface $con = null) Return the first ChildDiscount matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDiscount requireOneByDiscountid(int $discountId) Return the first ChildDiscount filtered by the discountId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDiscount requireOneByDatevalid(string $dateValid) Return the first ChildDiscount filtered by the dateValid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDiscount requireOneByCode(string $code) Return the first ChildDiscount filtered by the code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDiscount requireOneByPercentage(double $percentage) Return the first ChildDiscount filtered by the percentage column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDiscount requireOneByValid(boolean $valid) Return the first ChildDiscount filtered by the valid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDiscount[]|ObjectCollection find(?ConnectionInterface $con = null) Return ChildDiscount objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildDiscount> find(?ConnectionInterface $con = null) Return ChildDiscount objects based on current ModelCriteria
 * @method     ChildDiscount[]|ObjectCollection findByDiscountid(int $discountId) Return ChildDiscount objects filtered by the discountId column
 * @psalm-method ObjectCollection&\Traversable<ChildDiscount> findByDiscountid(int $discountId) Return ChildDiscount objects filtered by the discountId column
 * @method     ChildDiscount[]|ObjectCollection findByDatevalid(string $dateValid) Return ChildDiscount objects filtered by the dateValid column
 * @psalm-method ObjectCollection&\Traversable<ChildDiscount> findByDatevalid(string $dateValid) Return ChildDiscount objects filtered by the dateValid column
 * @method     ChildDiscount[]|ObjectCollection findByCode(string $code) Return ChildDiscount objects filtered by the code column
 * @psalm-method ObjectCollection&\Traversable<ChildDiscount> findByCode(string $code) Return ChildDiscount objects filtered by the code column
 * @method     ChildDiscount[]|ObjectCollection findByPercentage(double $percentage) Return ChildDiscount objects filtered by the percentage column
 * @psalm-method ObjectCollection&\Traversable<ChildDiscount> findByPercentage(double $percentage) Return ChildDiscount objects filtered by the percentage column
 * @method     ChildDiscount[]|ObjectCollection findByValid(boolean $valid) Return ChildDiscount objects filtered by the valid column
 * @psalm-method ObjectCollection&\Traversable<ChildDiscount> findByValid(boolean $valid) Return ChildDiscount objects filtered by the valid column
 * @method     ChildDiscount[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildDiscount> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DiscountQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Shop\Models\Base\DiscountQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Shop\\Models\\Discount', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDiscountQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDiscountQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildDiscountQuery) {
            return $criteria;
        }
        $query = new ChildDiscountQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildDiscount|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DiscountTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DiscountTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDiscount A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT discountId, dateValid, code, percentage, valid FROM discount WHERE discountId = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildDiscount $obj */
            $obj = new ChildDiscount();
            $obj->hydrate($row);
            DiscountTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildDiscount|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildDiscountQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DiscountTableMap::COL_DISCOUNTID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDiscountQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DiscountTableMap::COL_DISCOUNTID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the discountId column
     *
     * Example usage:
     * <code>
     * $query->filterByDiscountid(1234); // WHERE discountId = 1234
     * $query->filterByDiscountid(array(12, 34)); // WHERE discountId IN (12, 34)
     * $query->filterByDiscountid(array('min' => 12)); // WHERE discountId > 12
     * </code>
     *
     * @param     mixed $discountid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDiscountQuery The current query, for fluid interface
     */
    public function filterByDiscountid($discountid = null, $comparison = null)
    {
        if (is_array($discountid)) {
            $useMinMax = false;
            if (isset($discountid['min'])) {
                $this->addUsingAlias(DiscountTableMap::COL_DISCOUNTID, $discountid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($discountid['max'])) {
                $this->addUsingAlias(DiscountTableMap::COL_DISCOUNTID, $discountid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DiscountTableMap::COL_DISCOUNTID, $discountid, $comparison);
    }

    /**
     * Filter the query on the dateValid column
     *
     * Example usage:
     * <code>
     * $query->filterByDatevalid('2011-03-14'); // WHERE dateValid = '2011-03-14'
     * $query->filterByDatevalid('now'); // WHERE dateValid = '2011-03-14'
     * $query->filterByDatevalid(array('max' => 'yesterday')); // WHERE dateValid > '2011-03-13'
     * </code>
     *
     * @param     mixed $datevalid The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDiscountQuery The current query, for fluid interface
     */
    public function filterByDatevalid($datevalid = null, $comparison = null)
    {
        if (is_array($datevalid)) {
            $useMinMax = false;
            if (isset($datevalid['min'])) {
                $this->addUsingAlias(DiscountTableMap::COL_DATEVALID, $datevalid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($datevalid['max'])) {
                $this->addUsingAlias(DiscountTableMap::COL_DATEVALID, $datevalid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DiscountTableMap::COL_DATEVALID, $datevalid, $comparison);
    }

    /**
     * Filter the query on the code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE code = 'fooValue'
     * $query->filterByCode('%fooValue%', Criteria::LIKE); // WHERE code LIKE '%fooValue%'
     * $query->filterByCode(['foo', 'bar']); // WHERE code IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $code The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDiscountQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DiscountTableMap::COL_CODE, $code, $comparison);
    }

    /**
     * Filter the query on the percentage column
     *
     * Example usage:
     * <code>
     * $query->filterByPercentage(1234); // WHERE percentage = 1234
     * $query->filterByPercentage(array(12, 34)); // WHERE percentage IN (12, 34)
     * $query->filterByPercentage(array('min' => 12)); // WHERE percentage > 12
     * </code>
     *
     * @param     mixed $percentage The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDiscountQuery The current query, for fluid interface
     */
    public function filterByPercentage($percentage = null, $comparison = null)
    {
        if (is_array($percentage)) {
            $useMinMax = false;
            if (isset($percentage['min'])) {
                $this->addUsingAlias(DiscountTableMap::COL_PERCENTAGE, $percentage['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($percentage['max'])) {
                $this->addUsingAlias(DiscountTableMap::COL_PERCENTAGE, $percentage['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DiscountTableMap::COL_PERCENTAGE, $percentage, $comparison);
    }

    /**
     * Filter the query on the valid column
     *
     * Example usage:
     * <code>
     * $query->filterByValid(true); // WHERE valid = true
     * $query->filterByValid('yes'); // WHERE valid = true
     * </code>
     *
     * @param     bool|string $valid The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDiscountQuery The current query, for fluid interface
     */
    public function filterByValid($valid = null, $comparison = null)
    {
        if (is_string($valid)) {
            $valid = in_array(strtolower($valid), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(DiscountTableMap::COL_VALID, $valid, $comparison);
    }

    /**
     * Filter the query by a related \Shop\Models\Purchase object
     *
     * @param \Shop\Models\Purchase|ObjectCollection $purchase the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDiscountQuery The current query, for fluid interface
     */
    public function filterByDiscount($purchase, $comparison = null)
    {
        if ($purchase instanceof \Shop\Models\Purchase) {
            return $this
                ->addUsingAlias(DiscountTableMap::COL_DISCOUNTID, $purchase->getDiscountid(), $comparison);
        } elseif ($purchase instanceof ObjectCollection) {
            return $this
                ->useDiscountQuery()
                ->filterByPrimaryKeys($purchase->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDiscount() only accepts arguments of type \Shop\Models\Purchase or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Discount relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDiscountQuery The current query, for fluid interface
     */
    public function joinDiscount($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Discount');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Discount');
        }

        return $this;
    }

    /**
     * Use the Discount relation Purchase object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Shop\Models\PurchaseQuery A secondary query class using the current class as primary query
     */
    public function useDiscountQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDiscount($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Discount', '\Shop\Models\PurchaseQuery');
    }

    /**
     * Use the Discount relation Purchase object
     *
     * @param callable(\Shop\Models\PurchaseQuery):\Shop\Models\PurchaseQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDiscountQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useDiscountQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the Discount relation to the Purchase table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Shop\Models\PurchaseQuery The inner query object of the EXISTS statement
     */
    public function useDiscountExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Discount', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the Discount relation to the Purchase table for a NOT EXISTS query.
     *
     * @see useDiscountExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Shop\Models\PurchaseQuery The inner query object of the NOT EXISTS statement
     */
    public function useDiscountNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Discount', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildDiscount $discount Object to remove from the list of results
     *
     * @return $this|ChildDiscountQuery The current query, for fluid interface
     */
    public function prune($discount = null)
    {
        if ($discount) {
            $this->addUsingAlias(DiscountTableMap::COL_DISCOUNTID, $discount->getDiscountid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the discount table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DiscountTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DiscountTableMap::clearInstancePool();
            DiscountTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DiscountTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DiscountTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DiscountTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DiscountTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
