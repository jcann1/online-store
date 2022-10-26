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
use Shop\Models\Purchase;
use Shop\Models\PurchaseQuery;


/**
 * This class defines the structure of the 'purchase' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PurchaseTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Shop.Models.Map.PurchaseTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'purchase';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Shop\\Models\\Purchase';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Shop.Models.Purchase';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the purchaseId field
     */
    const COL_PURCHASEID = 'purchase.purchaseId';

    /**
     * the column name for the userId field
     */
    const COL_USERID = 'purchase.userId';

    /**
     * the column name for the totalPrice field
     */
    const COL_TOTALPRICE = 'purchase.totalPrice';

    /**
     * the column name for the totalAfterDiscount field
     */
    const COL_TOTALAFTERDISCOUNT = 'purchase.totalAfterDiscount';

    /**
     * the column name for the status field
     */
    const COL_STATUS = 'purchase.status';

    /**
     * the column name for the discountId field
     */
    const COL_DISCOUNTID = 'purchase.discountId';

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
        self::TYPE_PHPNAME       => array('Purchaseid', 'Userid', 'Totalprice', 'Totalafterdiscount', 'Status', 'Discountid', ),
        self::TYPE_CAMELNAME     => array('purchaseid', 'userid', 'totalprice', 'totalafterdiscount', 'status', 'discountid', ),
        self::TYPE_COLNAME       => array(PurchaseTableMap::COL_PURCHASEID, PurchaseTableMap::COL_USERID, PurchaseTableMap::COL_TOTALPRICE, PurchaseTableMap::COL_TOTALAFTERDISCOUNT, PurchaseTableMap::COL_STATUS, PurchaseTableMap::COL_DISCOUNTID, ),
        self::TYPE_FIELDNAME     => array('purchaseId', 'userId', 'totalPrice', 'totalAfterDiscount', 'status', 'discountId', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Purchaseid' => 0, 'Userid' => 1, 'Totalprice' => 2, 'Totalafterdiscount' => 3, 'Status' => 4, 'Discountid' => 5, ),
        self::TYPE_CAMELNAME     => array('purchaseid' => 0, 'userid' => 1, 'totalprice' => 2, 'totalafterdiscount' => 3, 'status' => 4, 'discountid' => 5, ),
        self::TYPE_COLNAME       => array(PurchaseTableMap::COL_PURCHASEID => 0, PurchaseTableMap::COL_USERID => 1, PurchaseTableMap::COL_TOTALPRICE => 2, PurchaseTableMap::COL_TOTALAFTERDISCOUNT => 3, PurchaseTableMap::COL_STATUS => 4, PurchaseTableMap::COL_DISCOUNTID => 5, ),
        self::TYPE_FIELDNAME     => array('purchaseId' => 0, 'userId' => 1, 'totalPrice' => 2, 'totalAfterDiscount' => 3, 'status' => 4, 'discountId' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Purchaseid' => 'PURCHASEID',
        'Purchase.Purchaseid' => 'PURCHASEID',
        'purchaseid' => 'PURCHASEID',
        'purchase.purchaseid' => 'PURCHASEID',
        'PurchaseTableMap::COL_PURCHASEID' => 'PURCHASEID',
        'COL_PURCHASEID' => 'PURCHASEID',
        'purchaseId' => 'PURCHASEID',
        'purchase.purchaseId' => 'PURCHASEID',
        'Userid' => 'USERID',
        'Purchase.Userid' => 'USERID',
        'userid' => 'USERID',
        'purchase.userid' => 'USERID',
        'PurchaseTableMap::COL_USERID' => 'USERID',
        'COL_USERID' => 'USERID',
        'userId' => 'USERID',
        'purchase.userId' => 'USERID',
        'Totalprice' => 'TOTALPRICE',
        'Purchase.Totalprice' => 'TOTALPRICE',
        'totalprice' => 'TOTALPRICE',
        'purchase.totalprice' => 'TOTALPRICE',
        'PurchaseTableMap::COL_TOTALPRICE' => 'TOTALPRICE',
        'COL_TOTALPRICE' => 'TOTALPRICE',
        'totalPrice' => 'TOTALPRICE',
        'purchase.totalPrice' => 'TOTALPRICE',
        'Totalafterdiscount' => 'TOTALAFTERDISCOUNT',
        'Purchase.Totalafterdiscount' => 'TOTALAFTERDISCOUNT',
        'totalafterdiscount' => 'TOTALAFTERDISCOUNT',
        'purchase.totalafterdiscount' => 'TOTALAFTERDISCOUNT',
        'PurchaseTableMap::COL_TOTALAFTERDISCOUNT' => 'TOTALAFTERDISCOUNT',
        'COL_TOTALAFTERDISCOUNT' => 'TOTALAFTERDISCOUNT',
        'totalAfterDiscount' => 'TOTALAFTERDISCOUNT',
        'purchase.totalAfterDiscount' => 'TOTALAFTERDISCOUNT',
        'Status' => 'STATUS',
        'Purchase.Status' => 'STATUS',
        'status' => 'STATUS',
        'purchase.status' => 'STATUS',
        'PurchaseTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'Discountid' => 'DISCOUNTID',
        'Purchase.Discountid' => 'DISCOUNTID',
        'discountid' => 'DISCOUNTID',
        'purchase.discountid' => 'DISCOUNTID',
        'PurchaseTableMap::COL_DISCOUNTID' => 'DISCOUNTID',
        'COL_DISCOUNTID' => 'DISCOUNTID',
        'discountId' => 'DISCOUNTID',
        'purchase.discountId' => 'DISCOUNTID',
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
        $this->setName('purchase');
        $this->setPhpName('Purchase');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Shop\\Models\\Purchase');
        $this->setPackage('Shop.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('purchaseId', 'Purchaseid', 'INTEGER', true, null, null);
        $this->addForeignKey('userId', 'Userid', 'INTEGER', 'user', 'userId', false, null, null);
        $this->addColumn('totalPrice', 'Totalprice', 'DOUBLE', true, null, null);
        $this->addColumn('totalAfterDiscount', 'Totalafterdiscount', 'DOUBLE', true, null, 0);
        $this->addColumn('status', 'Status', 'VARCHAR', true, 30, 'Paid');
        $this->addForeignKey('discountId', 'Discountid', 'INTEGER', 'discount', 'discountId', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Discount', '\\Shop\\Models\\Discount', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':discountId',
    1 => ':discountId',
  ),
), null, null, null, false);
        $this->addRelation('User', '\\Shop\\Models\\User', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':userId',
    1 => ':userId',
  ),
), null, null, null, false);
        $this->addRelation('ProductPurchase', '\\Shop\\Models\\ProductPurchase', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':purchaseId',
    1 => ':purchaseId',
  ),
), null, null, 'ProductPurchases', false);
        $this->addRelation('Product', '\\Shop\\Models\\Product', RelationMap::MANY_TO_MANY, array(), null, null, 'Products');
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Purchaseid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Purchaseid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Purchaseid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Purchaseid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Purchaseid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Purchaseid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Purchaseid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? PurchaseTableMap::CLASS_DEFAULT : PurchaseTableMap::OM_CLASS;
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
     * @return array           (Purchase object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = PurchaseTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PurchaseTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PurchaseTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PurchaseTableMap::OM_CLASS;
            /** @var Purchase $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PurchaseTableMap::addInstanceToPool($obj, $key);
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
            $key = PurchaseTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PurchaseTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Purchase $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PurchaseTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PurchaseTableMap::COL_PURCHASEID);
            $criteria->addSelectColumn(PurchaseTableMap::COL_USERID);
            $criteria->addSelectColumn(PurchaseTableMap::COL_TOTALPRICE);
            $criteria->addSelectColumn(PurchaseTableMap::COL_TOTALAFTERDISCOUNT);
            $criteria->addSelectColumn(PurchaseTableMap::COL_STATUS);
            $criteria->addSelectColumn(PurchaseTableMap::COL_DISCOUNTID);
        } else {
            $criteria->addSelectColumn($alias . '.purchaseId');
            $criteria->addSelectColumn($alias . '.userId');
            $criteria->addSelectColumn($alias . '.totalPrice');
            $criteria->addSelectColumn($alias . '.totalAfterDiscount');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.discountId');
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
            $criteria->removeSelectColumn(PurchaseTableMap::COL_PURCHASEID);
            $criteria->removeSelectColumn(PurchaseTableMap::COL_USERID);
            $criteria->removeSelectColumn(PurchaseTableMap::COL_TOTALPRICE);
            $criteria->removeSelectColumn(PurchaseTableMap::COL_TOTALAFTERDISCOUNT);
            $criteria->removeSelectColumn(PurchaseTableMap::COL_STATUS);
            $criteria->removeSelectColumn(PurchaseTableMap::COL_DISCOUNTID);
        } else {
            $criteria->removeSelectColumn($alias . '.purchaseId');
            $criteria->removeSelectColumn($alias . '.userId');
            $criteria->removeSelectColumn($alias . '.totalPrice');
            $criteria->removeSelectColumn($alias . '.totalAfterDiscount');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.discountId');
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
        return Propel::getServiceContainer()->getDatabaseMap(PurchaseTableMap::DATABASE_NAME)->getTable(PurchaseTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Purchase or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Purchase object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PurchaseTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Shop\Models\Purchase) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PurchaseTableMap::DATABASE_NAME);
            $criteria->add(PurchaseTableMap::COL_PURCHASEID, (array) $values, Criteria::IN);
        }

        $query = PurchaseQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PurchaseTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PurchaseTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the purchase table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return PurchaseQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Purchase or Criteria object.
     *
     * @param mixed               $criteria Criteria or Purchase object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PurchaseTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Purchase object
        }

        if ($criteria->containsKey(PurchaseTableMap::COL_PURCHASEID) && $criteria->keyContainsValue(PurchaseTableMap::COL_PURCHASEID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PurchaseTableMap::COL_PURCHASEID.')');
        }


        // Set the correct dbName
        $query = PurchaseQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
