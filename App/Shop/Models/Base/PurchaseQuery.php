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
use Shop\Models\Purchase as ChildPurchase;
use Shop\Models\PurchaseQuery as ChildPurchaseQuery;
use Shop\Models\Map\PurchaseTableMap;

/**
 * Base class that represents a query for the 'purchase' table.
 *
 *
 *
 * @method     ChildPurchaseQuery orderByPurchaseid($order = Criteria::ASC) Order by the purchaseId column
 * @method     ChildPurchaseQuery orderByUserid($order = Criteria::ASC) Order by the userId column
 * @method     ChildPurchaseQuery orderByTotalprice($order = Criteria::ASC) Order by the totalPrice column
 * @method     ChildPurchaseQuery orderByTotalafterdiscount($order = Criteria::ASC) Order by the totalAfterDiscount column
 * @method     ChildPurchaseQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildPurchaseQuery orderByDiscountid($order = Criteria::ASC) Order by the discountId column
 *
 * @method     ChildPurchaseQuery groupByPurchaseid() Group by the purchaseId column
 * @method     ChildPurchaseQuery groupByUserid() Group by the userId column
 * @method     ChildPurchaseQuery groupByTotalprice() Group by the totalPrice column
 * @method     ChildPurchaseQuery groupByTotalafterdiscount() Group by the totalAfterDiscount column
 * @method     ChildPurchaseQuery groupByStatus() Group by the status column
 * @method     ChildPurchaseQuery groupByDiscountid() Group by the discountId column
 *
 * @method     ChildPurchaseQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPurchaseQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPurchaseQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPurchaseQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPurchaseQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPurchaseQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPurchaseQuery leftJoinDiscount($relationAlias = null) Adds a LEFT JOIN clause to the query using the Discount relation
 * @method     ChildPurchaseQuery rightJoinDiscount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Discount relation
 * @method     ChildPurchaseQuery innerJoinDiscount($relationAlias = null) Adds a INNER JOIN clause to the query using the Discount relation
 *
 * @method     ChildPurchaseQuery joinWithDiscount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Discount relation
 *
 * @method     ChildPurchaseQuery leftJoinWithDiscount() Adds a LEFT JOIN clause and with to the query using the Discount relation
 * @method     ChildPurchaseQuery rightJoinWithDiscount() Adds a RIGHT JOIN clause and with to the query using the Discount relation
 * @method     ChildPurchaseQuery innerJoinWithDiscount() Adds a INNER JOIN clause and with to the query using the Discount relation
 *
 * @method     ChildPurchaseQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildPurchaseQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildPurchaseQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildPurchaseQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildPurchaseQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildPurchaseQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildPurchaseQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     ChildPurchaseQuery leftJoinProductPurchase($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductPurchase relation
 * @method     ChildPurchaseQuery rightJoinProductPurchase($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductPurchase relation
 * @method     ChildPurchaseQuery innerJoinProductPurchase($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductPurchase relation
 *
 * @method     ChildPurchaseQuery joinWithProductPurchase($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductPurchase relation
 *
 * @method     ChildPurchaseQuery leftJoinWithProductPurchase() Adds a LEFT JOIN clause and with to the query using the ProductPurchase relation
 * @method     ChildPurchaseQuery rightJoinWithProductPurchase() Adds a RIGHT JOIN clause and with to the query using the ProductPurchase relation
 * @method     ChildPurchaseQuery innerJoinWithProductPurchase() Adds a INNER JOIN clause and with to the query using the ProductPurchase relation
 *
 * @method     \Shop\Models\DiscountQuery|\Shop\Models\UserQuery|\Shop\Models\ProductPurchaseQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPurchase|null findOne(?ConnectionInterface $con = null) Return the first ChildPurchase matching the query
 * @method     ChildPurchase findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildPurchase matching the query, or a new ChildPurchase object populated from the query conditions when no match is found
 *
 * @method     ChildPurchase|null findOneByPurchaseid(int $purchaseId) Return the first ChildPurchase filtered by the purchaseId column
 * @method     ChildPurchase|null findOneByUserid(int $userId) Return the first ChildPurchase filtered by the userId column
 * @method     ChildPurchase|null findOneByTotalprice(double $totalPrice) Return the first ChildPurchase filtered by the totalPrice column
 * @method     ChildPurchase|null findOneByTotalafterdiscount(double $totalAfterDiscount) Return the first ChildPurchase filtered by the totalAfterDiscount column
 * @method     ChildPurchase|null findOneByStatus(string $status) Return the first ChildPurchase filtered by the status column
 * @method     ChildPurchase|null findOneByDiscountid(int $discountId) Return the first ChildPurchase filtered by the discountId column *

 * @method     ChildPurchase requirePk($key, ?ConnectionInterface $con = null) Return the ChildPurchase by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchase requireOne(?ConnectionInterface $con = null) Return the first ChildPurchase matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPurchase requireOneByPurchaseid(int $purchaseId) Return the first ChildPurchase filtered by the purchaseId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchase requireOneByUserid(int $userId) Return the first ChildPurchase filtered by the userId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchase requireOneByTotalprice(double $totalPrice) Return the first ChildPurchase filtered by the totalPrice column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchase requireOneByTotalafterdiscount(double $totalAfterDiscount) Return the first ChildPurchase filtered by the totalAfterDiscount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchase requireOneByStatus(string $status) Return the first ChildPurchase filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchase requireOneByDiscountid(int $discountId) Return the first ChildPurchase filtered by the discountId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPurchase[]|ObjectCollection find(?ConnectionInterface $con = null) Return ChildPurchase objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildPurchase> find(?ConnectionInterface $con = null) Return ChildPurchase objects based on current ModelCriteria
 * @method     ChildPurchase[]|ObjectCollection findByPurchaseid(int $purchaseId) Return ChildPurchase objects filtered by the purchaseId column
 * @psalm-method ObjectCollection&\Traversable<ChildPurchase> findByPurchaseid(int $purchaseId) Return ChildPurchase objects filtered by the purchaseId column
 * @method     ChildPurchase[]|ObjectCollection findByUserid(int $userId) Return ChildPurchase objects filtered by the userId column
 * @psalm-method ObjectCollection&\Traversable<ChildPurchase> findByUserid(int $userId) Return ChildPurchase objects filtered by the userId column
 * @method     ChildPurchase[]|ObjectCollection findByTotalprice(double $totalPrice) Return ChildPurchase objects filtered by the totalPrice column
 * @psalm-method ObjectCollection&\Traversable<ChildPurchase> findByTotalprice(double $totalPrice) Return ChildPurchase objects filtered by the totalPrice column
 * @method     ChildPurchase[]|ObjectCollection findByTotalafterdiscount(double $totalAfterDiscount) Return ChildPurchase objects filtered by the totalAfterDiscount column
 * @psalm-method ObjectCollection&\Traversable<ChildPurchase> findByTotalafterdiscount(double $totalAfterDiscount) Return ChildPurchase objects filtered by the totalAfterDiscount column
 * @method     ChildPurchase[]|ObjectCollection findByStatus(string $status) Return ChildPurchase objects filtered by the status column
 * @psalm-method ObjectCollection&\Traversable<ChildPurchase> findByStatus(string $status) Return ChildPurchase objects filtered by the status column
 * @method     ChildPurchase[]|ObjectCollection findByDiscountid(int $discountId) Return ChildPurchase objects filtered by the discountId column
 * @psalm-method ObjectCollection&\Traversable<ChildPurchase> findByDiscountid(int $discountId) Return ChildPurchase objects filtered by the discountId column
 * @method     ChildPurchase[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildPurchase> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PurchaseQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Shop\Models\Base\PurchaseQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Shop\\Models\\Purchase', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPurchaseQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPurchaseQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildPurchaseQuery) {
            return $criteria;
        }
        $query = new ChildPurchaseQuery();
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
     * @return ChildPurchase|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PurchaseTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PurchaseTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPurchase A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT purchaseId, userId, totalPrice, totalAfterDiscount, status, discountId FROM purchase WHERE purchaseId = :p0';
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
            /** @var ChildPurchase $obj */
            $obj = new ChildPurchase();
            $obj->hydrate($row);
            PurchaseTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPurchase|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPurchaseQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PurchaseTableMap::COL_PURCHASEID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPurchaseQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PurchaseTableMap::COL_PURCHASEID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the purchaseId column
     *
     * Example usage:
     * <code>
     * $query->filterByPurchaseid(1234); // WHERE purchaseId = 1234
     * $query->filterByPurchaseid(array(12, 34)); // WHERE purchaseId IN (12, 34)
     * $query->filterByPurchaseid(array('min' => 12)); // WHERE purchaseId > 12
     * </code>
     *
     * @param     mixed $purchaseid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPurchaseQuery The current query, for fluid interface
     */
    public function filterByPurchaseid($purchaseid = null, $comparison = null)
    {
        if (is_array($purchaseid)) {
            $useMinMax = false;
            if (isset($purchaseid['min'])) {
                $this->addUsingAlias(PurchaseTableMap::COL_PURCHASEID, $purchaseid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($purchaseid['max'])) {
                $this->addUsingAlias(PurchaseTableMap::COL_PURCHASEID, $purchaseid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseTableMap::COL_PURCHASEID, $purchaseid, $comparison);
    }

    /**
     * Filter the query on the userId column
     *
     * Example usage:
     * <code>
     * $query->filterByUserid(1234); // WHERE userId = 1234
     * $query->filterByUserid(array(12, 34)); // WHERE userId IN (12, 34)
     * $query->filterByUserid(array('min' => 12)); // WHERE userId > 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $userid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPurchaseQuery The current query, for fluid interface
     */
    public function filterByUserid($userid = null, $comparison = null)
    {
        if (is_array($userid)) {
            $useMinMax = false;
            if (isset($userid['min'])) {
                $this->addUsingAlias(PurchaseTableMap::COL_USERID, $userid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userid['max'])) {
                $this->addUsingAlias(PurchaseTableMap::COL_USERID, $userid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseTableMap::COL_USERID, $userid, $comparison);
    }

    /**
     * Filter the query on the totalPrice column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalprice(1234); // WHERE totalPrice = 1234
     * $query->filterByTotalprice(array(12, 34)); // WHERE totalPrice IN (12, 34)
     * $query->filterByTotalprice(array('min' => 12)); // WHERE totalPrice > 12
     * </code>
     *
     * @param     mixed $totalprice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPurchaseQuery The current query, for fluid interface
     */
    public function filterByTotalprice($totalprice = null, $comparison = null)
    {
        if (is_array($totalprice)) {
            $useMinMax = false;
            if (isset($totalprice['min'])) {
                $this->addUsingAlias(PurchaseTableMap::COL_TOTALPRICE, $totalprice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalprice['max'])) {
                $this->addUsingAlias(PurchaseTableMap::COL_TOTALPRICE, $totalprice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseTableMap::COL_TOTALPRICE, $totalprice, $comparison);
    }

    /**
     * Filter the query on the totalAfterDiscount column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalafterdiscount(1234); // WHERE totalAfterDiscount = 1234
     * $query->filterByTotalafterdiscount(array(12, 34)); // WHERE totalAfterDiscount IN (12, 34)
     * $query->filterByTotalafterdiscount(array('min' => 12)); // WHERE totalAfterDiscount > 12
     * </code>
     *
     * @param     mixed $totalafterdiscount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPurchaseQuery The current query, for fluid interface
     */
    public function filterByTotalafterdiscount($totalafterdiscount = null, $comparison = null)
    {
        if (is_array($totalafterdiscount)) {
            $useMinMax = false;
            if (isset($totalafterdiscount['min'])) {
                $this->addUsingAlias(PurchaseTableMap::COL_TOTALAFTERDISCOUNT, $totalafterdiscount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalafterdiscount['max'])) {
                $this->addUsingAlias(PurchaseTableMap::COL_TOTALAFTERDISCOUNT, $totalafterdiscount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseTableMap::COL_TOTALAFTERDISCOUNT, $totalafterdiscount, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE status LIKE '%fooValue%'
     * $query->filterByStatus(['foo', 'bar']); // WHERE status IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $status The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPurchaseQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseTableMap::COL_STATUS, $status, $comparison);
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
     * @see       filterByDiscount()
     *
     * @param     mixed $discountid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPurchaseQuery The current query, for fluid interface
     */
    public function filterByDiscountid($discountid = null, $comparison = null)
    {
        if (is_array($discountid)) {
            $useMinMax = false;
            if (isset($discountid['min'])) {
                $this->addUsingAlias(PurchaseTableMap::COL_DISCOUNTID, $discountid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($discountid['max'])) {
                $this->addUsingAlias(PurchaseTableMap::COL_DISCOUNTID, $discountid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseTableMap::COL_DISCOUNTID, $discountid, $comparison);
    }

    /**
     * Filter the query by a related \Shop\Models\Discount object
     *
     * @param \Shop\Models\Discount|ObjectCollection $discount The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPurchaseQuery The current query, for fluid interface
     */
    public function filterByDiscount($discount, $comparison = null)
    {
        if ($discount instanceof \Shop\Models\Discount) {
            return $this
                ->addUsingAlias(PurchaseTableMap::COL_DISCOUNTID, $discount->getDiscountid(), $comparison);
        } elseif ($discount instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PurchaseTableMap::COL_DISCOUNTID, $discount->toKeyValue('PrimaryKey', 'Discountid'), $comparison);
        } else {
            throw new PropelException('filterByDiscount() only accepts arguments of type \Shop\Models\Discount or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Discount relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPurchaseQuery The current query, for fluid interface
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
     * Use the Discount relation Discount object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Shop\Models\DiscountQuery A secondary query class using the current class as primary query
     */
    public function useDiscountQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDiscount($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Discount', '\Shop\Models\DiscountQuery');
    }

    /**
     * Use the Discount relation Discount object
     *
     * @param callable(\Shop\Models\DiscountQuery):\Shop\Models\DiscountQuery $callable A function working on the related query
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
     * Use the relation to Discount table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Shop\Models\DiscountQuery The inner query object of the EXISTS statement
     */
    public function useDiscountExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Discount', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Discount table for a NOT EXISTS query.
     *
     * @see useDiscountExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Shop\Models\DiscountQuery The inner query object of the NOT EXISTS statement
     */
    public function useDiscountNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Discount', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Shop\Models\User object
     *
     * @param \Shop\Models\User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPurchaseQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \Shop\Models\User) {
            return $this
                ->addUsingAlias(PurchaseTableMap::COL_USERID, $user->getUserid(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PurchaseTableMap::COL_USERID, $user->toKeyValue('PrimaryKey', 'Userid'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \Shop\Models\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPurchaseQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Shop\Models\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\Shop\Models\UserQuery');
    }

    /**
     * Use the User relation User object
     *
     * @param callable(\Shop\Models\UserQuery):\Shop\Models\UserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to User table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Shop\Models\UserQuery The inner query object of the EXISTS statement
     */
    public function useUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('User', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to User table for a NOT EXISTS query.
     *
     * @see useUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Shop\Models\UserQuery The inner query object of the NOT EXISTS statement
     */
    public function useUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('User', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Shop\Models\ProductPurchase object
     *
     * @param \Shop\Models\ProductPurchase|ObjectCollection $productPurchase the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPurchaseQuery The current query, for fluid interface
     */
    public function filterByProductPurchase($productPurchase, $comparison = null)
    {
        if ($productPurchase instanceof \Shop\Models\ProductPurchase) {
            return $this
                ->addUsingAlias(PurchaseTableMap::COL_PURCHASEID, $productPurchase->getPurchaseid(), $comparison);
        } elseif ($productPurchase instanceof ObjectCollection) {
            return $this
                ->useProductPurchaseQuery()
                ->filterByPrimaryKeys($productPurchase->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductPurchase() only accepts arguments of type \Shop\Models\ProductPurchase or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductPurchase relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPurchaseQuery The current query, for fluid interface
     */
    public function joinProductPurchase($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductPurchase');

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
            $this->addJoinObject($join, 'ProductPurchase');
        }

        return $this;
    }

    /**
     * Use the ProductPurchase relation ProductPurchase object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Shop\Models\ProductPurchaseQuery A secondary query class using the current class as primary query
     */
    public function useProductPurchaseQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductPurchase($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductPurchase', '\Shop\Models\ProductPurchaseQuery');
    }

    /**
     * Use the ProductPurchase relation ProductPurchase object
     *
     * @param callable(\Shop\Models\ProductPurchaseQuery):\Shop\Models\ProductPurchaseQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductPurchaseQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductPurchaseQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ProductPurchase table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Shop\Models\ProductPurchaseQuery The inner query object of the EXISTS statement
     */
    public function useProductPurchaseExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ProductPurchase', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ProductPurchase table for a NOT EXISTS query.
     *
     * @see useProductPurchaseExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Shop\Models\ProductPurchaseQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductPurchaseNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ProductPurchase', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related Product object
     * using the product_purchase table as cross reference
     *
     * @param Product $product the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPurchaseQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useProductPurchaseQuery()
            ->filterByProduct($product, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPurchase $purchase Object to remove from the list of results
     *
     * @return $this|ChildPurchaseQuery The current query, for fluid interface
     */
    public function prune($purchase = null)
    {
        if ($purchase) {
            $this->addUsingAlias(PurchaseTableMap::COL_PURCHASEID, $purchase->getPurchaseid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the purchase table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PurchaseTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PurchaseTableMap::clearInstancePool();
            PurchaseTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PurchaseTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PurchaseTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PurchaseTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PurchaseTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
