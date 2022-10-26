<?php

namespace Shop\Models\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use Shop\Models\User;
use Shop\Models\UserQuery;


/**
 * This class defines the structure of the 'user' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class UserTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Shop.Models.Map.UserTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'user';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Shop\\Models\\User';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Shop.Models.User';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the userId field
     */
    const COL_USERID = 'user.userId';

    /**
     * the column name for the username field
     */
    const COL_USERNAME = 'user.username';

    /**
     * the column name for the forename field
     */
    const COL_FORENAME = 'user.forename';

    /**
     * the column name for the surname field
     */
    const COL_SURNAME = 'user.surname';

    /**
     * the column name for the isBanned field
     */
    const COL_ISBANNED = 'user.isBanned';

    /**
     * the column name for the level field
     */
    const COL_LEVEL = 'user.level';

    /**
     * the column name for the password field
     */
    const COL_PASSWORD = 'user.password';

    /**
     * the column name for the twitterId field
     */
    const COL_TWITTERID = 'user.twitterId';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Userid', 'Username', 'Forename', 'Surname', 'Isbanned', 'Level', 'Password', 'Twitterid', ),
        self::TYPE_CAMELNAME     => array('userid', 'username', 'forename', 'surname', 'isbanned', 'level', 'password', 'twitterid', ),
        self::TYPE_COLNAME       => array(UserTableMap::COL_USERID, UserTableMap::COL_USERNAME, UserTableMap::COL_FORENAME, UserTableMap::COL_SURNAME, UserTableMap::COL_ISBANNED, UserTableMap::COL_LEVEL, UserTableMap::COL_PASSWORD, UserTableMap::COL_TWITTERID, ),
        self::TYPE_FIELDNAME     => array('userId', 'username', 'forename', 'surname', 'isBanned', 'level', 'password', 'twitterId', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Userid' => 0, 'Username' => 1, 'Forename' => 2, 'Surname' => 3, 'Isbanned' => 4, 'Level' => 5, 'Password' => 6, 'Twitterid' => 7, ),
        self::TYPE_CAMELNAME     => array('userid' => 0, 'username' => 1, 'forename' => 2, 'surname' => 3, 'isbanned' => 4, 'level' => 5, 'password' => 6, 'twitterid' => 7, ),
        self::TYPE_COLNAME       => array(UserTableMap::COL_USERID => 0, UserTableMap::COL_USERNAME => 1, UserTableMap::COL_FORENAME => 2, UserTableMap::COL_SURNAME => 3, UserTableMap::COL_ISBANNED => 4, UserTableMap::COL_LEVEL => 5, UserTableMap::COL_PASSWORD => 6, UserTableMap::COL_TWITTERID => 7, ),
        self::TYPE_FIELDNAME     => array('userId' => 0, 'username' => 1, 'forename' => 2, 'surname' => 3, 'isBanned' => 4, 'level' => 5, 'password' => 6, 'twitterId' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Userid' => 'USERID',
        'User.Userid' => 'USERID',
        'userid' => 'USERID',
        'user.userid' => 'USERID',
        'UserTableMap::COL_USERID' => 'USERID',
        'COL_USERID' => 'USERID',
        'userId' => 'USERID',
        'user.userId' => 'USERID',
        'Username' => 'USERNAME',
        'User.Username' => 'USERNAME',
        'username' => 'USERNAME',
        'user.username' => 'USERNAME',
        'UserTableMap::COL_USERNAME' => 'USERNAME',
        'COL_USERNAME' => 'USERNAME',
        'Forename' => 'FORENAME',
        'User.Forename' => 'FORENAME',
        'forename' => 'FORENAME',
        'user.forename' => 'FORENAME',
        'UserTableMap::COL_FORENAME' => 'FORENAME',
        'COL_FORENAME' => 'FORENAME',
        'Surname' => 'SURNAME',
        'User.Surname' => 'SURNAME',
        'surname' => 'SURNAME',
        'user.surname' => 'SURNAME',
        'UserTableMap::COL_SURNAME' => 'SURNAME',
        'COL_SURNAME' => 'SURNAME',
        'Isbanned' => 'ISBANNED',
        'User.Isbanned' => 'ISBANNED',
        'isbanned' => 'ISBANNED',
        'user.isbanned' => 'ISBANNED',
        'UserTableMap::COL_ISBANNED' => 'ISBANNED',
        'COL_ISBANNED' => 'ISBANNED',
        'isBanned' => 'ISBANNED',
        'user.isBanned' => 'ISBANNED',
        'Level' => 'LEVEL',
        'User.Level' => 'LEVEL',
        'level' => 'LEVEL',
        'user.level' => 'LEVEL',
        'UserTableMap::COL_LEVEL' => 'LEVEL',
        'COL_LEVEL' => 'LEVEL',
        'Password' => 'PASSWORD',
        'User.Password' => 'PASSWORD',
        'password' => 'PASSWORD',
        'user.password' => 'PASSWORD',
        'UserTableMap::COL_PASSWORD' => 'PASSWORD',
        'COL_PASSWORD' => 'PASSWORD',
        'Twitterid' => 'TWITTERID',
        'User.Twitterid' => 'TWITTERID',
        'twitterid' => 'TWITTERID',
        'user.twitterid' => 'TWITTERID',
        'UserTableMap::COL_TWITTERID' => 'TWITTERID',
        'COL_TWITTERID' => 'TWITTERID',
        'twitterId' => 'TWITTERID',
        'user.twitterId' => 'TWITTERID',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('user');
        $this->setPhpName('User');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Shop\\Models\\User');
        $this->setPackage('Shop.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('userId', 'Userid', 'INTEGER', true, null, null);
        $this->addColumn('username', 'Username', 'VARCHAR', true, 25, null);
        $this->addColumn('forename', 'Forename', 'VARCHAR', true, 25, null);
        $this->addColumn('surname', 'Surname', 'VARCHAR', true, 25, null);
        $this->addColumn('isBanned', 'Isbanned', 'BOOLEAN', true, 1, false);
        $this->addColumn('level', 'Level', 'INTEGER', true, null, null);
        $this->addColumn('password', 'Password', 'VARCHAR', true, 255, null);
        $this->addForeignKey('twitterId', 'Twitterid', 'INTEGER', 'twitter', 'twitterId', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Twitter', '\\Shop\\Models\\Twitter', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':twitterId',
    1 => ':twitterId',
  ),
), null, null, null, false);
        $this->addRelation('User', '\\Shop\\Models\\Purchase', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':userId',
    1 => ':userId',
  ),
), null, null, 'Users', false);
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Userid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Userid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Userid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Userid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Userid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Userid', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Userid', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? UserTableMap::CLASS_DEFAULT : UserTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (User object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = UserTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UserTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UserTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UserTableMap::OM_CLASS;
            /** @var User $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UserTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = UserTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UserTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var User $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UserTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string|null   $alias    optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(UserTableMap::COL_USERID);
            $criteria->addSelectColumn(UserTableMap::COL_USERNAME);
            $criteria->addSelectColumn(UserTableMap::COL_FORENAME);
            $criteria->addSelectColumn(UserTableMap::COL_SURNAME);
            $criteria->addSelectColumn(UserTableMap::COL_ISBANNED);
            $criteria->addSelectColumn(UserTableMap::COL_LEVEL);
            $criteria->addSelectColumn(UserTableMap::COL_PASSWORD);
            $criteria->addSelectColumn(UserTableMap::COL_TWITTERID);
        } else {
            $criteria->addSelectColumn($alias . '.userId');
            $criteria->addSelectColumn($alias . '.username');
            $criteria->addSelectColumn($alias . '.forename');
            $criteria->addSelectColumn($alias . '.surname');
            $criteria->addSelectColumn($alias . '.isBanned');
            $criteria->addSelectColumn($alias . '.level');
            $criteria->addSelectColumn($alias . '.password');
            $criteria->addSelectColumn($alias . '.twitterId');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria object containing the columns to remove.
     * @param string|null $alias    optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(UserTableMap::COL_USERID);
            $criteria->removeSelectColumn(UserTableMap::COL_USERNAME);
            $criteria->removeSelectColumn(UserTableMap::COL_FORENAME);
            $criteria->removeSelectColumn(UserTableMap::COL_SURNAME);
            $criteria->removeSelectColumn(UserTableMap::COL_ISBANNED);
            $criteria->removeSelectColumn(UserTableMap::COL_LEVEL);
            $criteria->removeSelectColumn(UserTableMap::COL_PASSWORD);
            $criteria->removeSelectColumn(UserTableMap::COL_TWITTERID);
        } else {
            $criteria->removeSelectColumn($alias . '.userId');
            $criteria->removeSelectColumn($alias . '.username');
            $criteria->removeSelectColumn($alias . '.forename');
            $criteria->removeSelectColumn($alias . '.surname');
            $criteria->removeSelectColumn($alias . '.isBanned');
            $criteria->removeSelectColumn($alias . '.level');
            $criteria->removeSelectColumn($alias . '.password');
            $criteria->removeSelectColumn($alias . '.twitterId');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(UserTableMap::DATABASE_NAME)->getTable(UserTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a User or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or User object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Shop\Models\User) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UserTableMap::DATABASE_NAME);
            $criteria->add(UserTableMap::COL_USERID, (array) $values, Criteria::IN);
        }

        $query = UserQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UserTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UserTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return UserQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a User or Criteria object.
     *
     * @param mixed               $criteria Criteria or User object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from User object
        }

        if ($criteria->containsKey(UserTableMap::COL_USERID) && $criteria->keyContainsValue(UserTableMap::COL_USERID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UserTableMap::COL_USERID.')');
        }


        // Set the correct dbName
        $query = UserQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
