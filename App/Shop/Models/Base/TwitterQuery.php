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
use Shop\Models\Twitter as ChildTwitter;
use Shop\Models\TwitterQuery as ChildTwitterQuery;
use Shop\Models\Map\TwitterTableMap;

/**
 * Base class that represents a query for the 'twitter' table.
 *
 *
 *
 * @method     ChildTwitterQuery orderByTwitterid($order = Criteria::ASC) Order by the twitterId column
 * @method     ChildTwitterQuery orderByTwitterapiid($order = Criteria::ASC) Order by the twitterApiId column
 * @method     ChildTwitterQuery orderByName($order = Criteria::ASC) Order by the name column
 *
 * @method     ChildTwitterQuery groupByTwitterid() Group by the twitterId column
 * @method     ChildTwitterQuery groupByTwitterapiid() Group by the twitterApiId column
 * @method     ChildTwitterQuery groupByName() Group by the name column
 *
 * @method     ChildTwitterQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTwitterQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTwitterQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTwitterQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTwitterQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTwitterQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTwitterQuery leftJoinTwitter($relationAlias = null) Adds a LEFT JOIN clause to the query using the Twitter relation
 * @method     ChildTwitterQuery rightJoinTwitter($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Twitter relation
 * @method     ChildTwitterQuery innerJoinTwitter($relationAlias = null) Adds a INNER JOIN clause to the query using the Twitter relation
 *
 * @method     ChildTwitterQuery joinWithTwitter($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Twitter relation
 *
 * @method     ChildTwitterQuery leftJoinWithTwitter() Adds a LEFT JOIN clause and with to the query using the Twitter relation
 * @method     ChildTwitterQuery rightJoinWithTwitter() Adds a RIGHT JOIN clause and with to the query using the Twitter relation
 * @method     ChildTwitterQuery innerJoinWithTwitter() Adds a INNER JOIN clause and with to the query using the Twitter relation
 *
 * @method     \Shop\Models\UserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTwitter|null findOne(?ConnectionInterface $con = null) Return the first ChildTwitter matching the query
 * @method     ChildTwitter findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildTwitter matching the query, or a new ChildTwitter object populated from the query conditions when no match is found
 *
 * @method     ChildTwitter|null findOneByTwitterid(int $twitterId) Return the first ChildTwitter filtered by the twitterId column
 * @method     ChildTwitter|null findOneByTwitterapiid(string $twitterApiId) Return the first ChildTwitter filtered by the twitterApiId column
 * @method     ChildTwitter|null findOneByName(string $name) Return the first ChildTwitter filtered by the name column *

 * @method     ChildTwitter requirePk($key, ?ConnectionInterface $con = null) Return the ChildTwitter by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTwitter requireOne(?ConnectionInterface $con = null) Return the first ChildTwitter matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTwitter requireOneByTwitterid(int $twitterId) Return the first ChildTwitter filtered by the twitterId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTwitter requireOneByTwitterapiid(string $twitterApiId) Return the first ChildTwitter filtered by the twitterApiId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTwitter requireOneByName(string $name) Return the first ChildTwitter filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTwitter[]|ObjectCollection find(?ConnectionInterface $con = null) Return ChildTwitter objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildTwitter> find(?ConnectionInterface $con = null) Return ChildTwitter objects based on current ModelCriteria
 * @method     ChildTwitter[]|ObjectCollection findByTwitterid(int $twitterId) Return ChildTwitter objects filtered by the twitterId column
 * @psalm-method ObjectCollection&\Traversable<ChildTwitter> findByTwitterid(int $twitterId) Return ChildTwitter objects filtered by the twitterId column
 * @method     ChildTwitter[]|ObjectCollection findByTwitterapiid(string $twitterApiId) Return ChildTwitter objects filtered by the twitterApiId column
 * @psalm-method ObjectCollection&\Traversable<ChildTwitter> findByTwitterapiid(string $twitterApiId) Return ChildTwitter objects filtered by the twitterApiId column
 * @method     ChildTwitter[]|ObjectCollection findByName(string $name) Return ChildTwitter objects filtered by the name column
 * @psalm-method ObjectCollection&\Traversable<ChildTwitter> findByName(string $name) Return ChildTwitter objects filtered by the name column
 * @method     ChildTwitter[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildTwitter> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TwitterQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Shop\Models\Base\TwitterQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Shop\\Models\\Twitter', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTwitterQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTwitterQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildTwitterQuery) {
            return $criteria;
        }
        $query = new ChildTwitterQuery();
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
     * @return ChildTwitter|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TwitterTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TwitterTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildTwitter A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT twitterId, twitterApiId, name FROM twitter WHERE twitterId = :p0';
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
            /** @var ChildTwitter $obj */
            $obj = new ChildTwitter();
            $obj->hydrate($row);
            TwitterTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildTwitter|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildTwitterQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TwitterTableMap::COL_TWITTERID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTwitterQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TwitterTableMap::COL_TWITTERID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the twitterId column
     *
     * Example usage:
     * <code>
     * $query->filterByTwitterid(1234); // WHERE twitterId = 1234
     * $query->filterByTwitterid(array(12, 34)); // WHERE twitterId IN (12, 34)
     * $query->filterByTwitterid(array('min' => 12)); // WHERE twitterId > 12
     * </code>
     *
     * @param     mixed $twitterid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTwitterQuery The current query, for fluid interface
     */
    public function filterByTwitterid($twitterid = null, $comparison = null)
    {
        if (is_array($twitterid)) {
            $useMinMax = false;
            if (isset($twitterid['min'])) {
                $this->addUsingAlias(TwitterTableMap::COL_TWITTERID, $twitterid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($twitterid['max'])) {
                $this->addUsingAlias(TwitterTableMap::COL_TWITTERID, $twitterid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TwitterTableMap::COL_TWITTERID, $twitterid, $comparison);
    }

    /**
     * Filter the query on the twitterApiId column
     *
     * Example usage:
     * <code>
     * $query->filterByTwitterapiid('fooValue');   // WHERE twitterApiId = 'fooValue'
     * $query->filterByTwitterapiid('%fooValue%', Criteria::LIKE); // WHERE twitterApiId LIKE '%fooValue%'
     * $query->filterByTwitterapiid(['foo', 'bar']); // WHERE twitterApiId IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $twitterapiid The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTwitterQuery The current query, for fluid interface
     */
    public function filterByTwitterapiid($twitterapiid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($twitterapiid)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TwitterTableMap::COL_TWITTERAPIID, $twitterapiid, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * $query->filterByName(['foo', 'bar']); // WHERE name IN ('foo', 'bar')
     * </code>
     *
     * @param     string|string[] $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTwitterQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TwitterTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query by a related \Shop\Models\User object
     *
     * @param \Shop\Models\User|ObjectCollection $user the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTwitterQuery The current query, for fluid interface
     */
    public function filterByTwitter($user, $comparison = null)
    {
        if ($user instanceof \Shop\Models\User) {
            return $this
                ->addUsingAlias(TwitterTableMap::COL_TWITTERID, $user->getTwitterid(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            return $this
                ->useTwitterQuery()
                ->filterByPrimaryKeys($user->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTwitter() only accepts arguments of type \Shop\Models\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Twitter relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTwitterQuery The current query, for fluid interface
     */
    public function joinTwitter($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Twitter');

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
            $this->addJoinObject($join, 'Twitter');
        }

        return $this;
    }

    /**
     * Use the Twitter relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Shop\Models\UserQuery A secondary query class using the current class as primary query
     */
    public function useTwitterQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTwitter($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Twitter', '\Shop\Models\UserQuery');
    }

    /**
     * Use the Twitter relation User object
     *
     * @param callable(\Shop\Models\UserQuery):\Shop\Models\UserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTwitterQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useTwitterQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the Twitter relation to the User table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \Shop\Models\UserQuery The inner query object of the EXISTS statement
     */
    public function useTwitterExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Twitter', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the Twitter relation to the User table for a NOT EXISTS query.
     *
     * @see useTwitterExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Shop\Models\UserQuery The inner query object of the NOT EXISTS statement
     */
    public function useTwitterNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Twitter', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildTwitter $twitter Object to remove from the list of results
     *
     * @return $this|ChildTwitterQuery The current query, for fluid interface
     */
    public function prune($twitter = null)
    {
        if ($twitter) {
            $this->addUsingAlias(TwitterTableMap::COL_TWITTERID, $twitter->getTwitterid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the twitter table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TwitterTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TwitterTableMap::clearInstancePool();
            TwitterTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TwitterTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TwitterTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TwitterTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TwitterTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
