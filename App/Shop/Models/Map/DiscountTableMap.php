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
use Shop\Models\Discount;
use Shop\Models\DiscountQuery;


/**
 * This class defines the structure of the 'discount' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class DiscountTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Shop.Models.Map.DiscountTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'discount';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Shop\\Models\\Discount';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Shop.Models.Discount';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the discountId field
     */
    const COL_DISCOUNTID = 'discount.discountId';

    /**
     * the column name for the dateValid field
     */
    const COL_DATEVALID = 'discount.dateValid';

    /**
     * the column name for the code field
     */
    const COL_CODE = 'discount.code';

    /**
     * the column name for the percentage field
     */
    const COL_PERCENTAGE = 'discount.percentage';

    /**
     * the column name for the valid field
     */
    const COL_VALID = 'discount.valid';

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
        self::TYPE_PHPNAME       => array('Discountid', 'Datevalid', 'Code', 'Percentage', 'Valid', ),
        self::TYPE_CAMELNAME     => array('discountid', 'datevalid', 'code', 'percentage', 'valid', ),
        self::TYPE_COLNAME       => array(DiscountTableMap::COL_DISCOUNTID, DiscountTableMap::COL_DATEVALID, DiscountTableMap::COL_CODE, DiscountTableMap::COL_PERCENTAGE, DiscountTableMap::COL_VALID, ),
        self::TYPE_FIELDNAME     => array('discountId', 'dateValid', 'code', 'percentage', 'valid', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Discountid' => 0, 'Datevalid' => 1, 'Code' => 2, 'Percentage' => 3, 'Valid' => 4, ),
        self::TYPE_CAMELNAME     => array('discountid' => 0, 'datevalid' => 1, 'code' => 2, 'percentage' => 3, 'valid' => 4, ),
        self::TYPE_COLNAME       => array(DiscountTableMap::COL_DISCOUNTID => 0, DiscountTableMap::COL_DATEVALID => 1, DiscountTableMap::COL_CODE => 2, DiscountTableMap::COL_PERCENTAGE => 3, DiscountTableMap::COL_VALID => 4, ),
        self::TYPE_FIELDNAME     => array('discountId' => 0, 'dateValid' => 1, 'code' => 2, 'percentage' => 3, 'valid' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Discountid' => 'DISCOUNTID',
        'Discount.Discountid' => 'DISCOUNTID',
        'discountid' => 'DISCOUNTID',
        'discount.discountid' => 'DISCOUNTID',
        'DiscountTableMap::COL_DISCOUNTID' => 'DISCOUNTID',
        'COL_DISCOUNTID' => 'DISCOUNTID',
        'discountId' => 'DISCOUNTID',
        'discount.discountId' => 'DISCOUNTID',
        'Datevalid' => 'DATEVALID',
        'Discount.Datevalid' => 'DATEVALID',
        'datevalid' => 'DATEVALID',
        'discount.datevalid' => 'DATEVALID',
        'DiscountTableMap::COL_DATEVALID' => 'DATEVALID',
        'COL_DATEVALID' => 'DATEVALID',
        'dateValid' => 'DATEVALID',
        'discount.dateValid' => 'DATEVALID',
        'Code' => 'CODE',
        'Discount.Code' => 'CODE',
        'code' => 'CODE',
        'discount.code' => 'CODE',
        'DiscountTableMap::COL_CODE' => 'CODE',
        'COL_CODE' => 'CODE',
        'Percentage' => 'PERCENTAGE',
        'Discount.Percentage' => 'PERCENTAGE',
        'percentage' => 'PERCENTAGE',
        'discount.percentage' => 'PERCENTAGE',
        'DiscountTableMap::COL_PERCENTAGE' => 'PERCENTAGE',
        'COL_PERCENTAGE' => 'PERCENTAGE',
        'Valid' => 'VALID',
        'Discount.Valid' => 'VALID',
        'valid' => 'VALID',
        'discount.valid' => 'VALID',
        'DiscountTableMap::COL_VALID' => 'VALID',
        'COL_VALID' => 'VALID',
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
        $this->setName('discount');
        $this->setPhpName('Discount');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Shop\\Models\\Discount');
        $this->setPackage('Shop.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('discountId', 'Discountid', 'INTEGER', true, null, null);
        $this->addColumn('dateValid', 'Datevalid', 'DATE', true, null, null);
        $this->addColumn('code', 'Code', 'VARCHAR', true, 30, null);
        $this->addColumn('percentage', 'Percentage', 'DOUBLE', true, null, null);
        $this->addColumn('valid', 'Valid', 'BOOLEAN', true, 1, true);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Discount', '\\Shop\\Models\\Purchase', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':discountId',
    1 => ':discountId',
  ),
), null, null, 'Discounts', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Discountid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Discountid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Discountid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Discountid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Discountid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Discountid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Discountid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? DiscountTableMap::CLASS_DEFAULT : DiscountTableMap::OM_CLASS;
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
     * @return array           (Discount object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = DiscountTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DiscountTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DiscountTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DiscountTableMap::OM_CLASS;
            /** @var Discount $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DiscountTableMap::addInstanceToPool($obj, $key);
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
            $key = DiscountTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DiscountTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Discount $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DiscountTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(DiscountTableMap::COL_DISCOUNTID);
            $criteria->addSelectColumn(DiscountTableMap::COL_DATEVALID);
            $criteria->addSelectColumn(DiscountTableMap::COL_CODE);
            $criteria->addSelectColumn(DiscountTableMap::COL_PERCENTAGE);
            $criteria->addSelectColumn(DiscountTableMap::COL_VALID);
        } else {
            $criteria->addSelectColumn($alias . '.discountId');
            $criteria->addSelectColumn($alias . '.dateValid');
            $criteria->addSelectColumn($alias . '.code');
            $criteria->addSelectColumn($alias . '.percentage');
            $criteria->addSelectColumn($alias . '.valid');
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
            $criteria->removeSelectColumn(DiscountTableMap::COL_DISCOUNTID);
            $criteria->removeSelectColumn(DiscountTableMap::COL_DATEVALID);
            $criteria->removeSelectColumn(DiscountTableMap::COL_CODE);
            $criteria->removeSelectColumn(DiscountTableMap::COL_PERCENTAGE);
            $criteria->removeSelectColumn(DiscountTableMap::COL_VALID);
        } else {
            $criteria->removeSelectColumn($alias . '.discountId');
            $criteria->removeSelectColumn($alias . '.dateValid');
            $criteria->removeSelectColumn($alias . '.code');
            $criteria->removeSelectColumn($alias . '.percentage');
            $criteria->removeSelectColumn($alias . '.valid');
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
        return Propel::getServiceContainer()->getDatabaseMap(DiscountTableMap::DATABASE_NAME)->getTable(DiscountTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Discount or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Discount object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(DiscountTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Shop\Models\Discount) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DiscountTableMap::DATABASE_NAME);
            $criteria->add(DiscountTableMap::COL_DISCOUNTID, (array) $values, Criteria::IN);
        }

        $query = DiscountQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DiscountTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DiscountTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the discount table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return DiscountQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Discount or Criteria object.
     *
     * @param mixed               $criteria Criteria or Discount object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DiscountTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Discount object
        }

        if ($criteria->containsKey(DiscountTableMap::COL_DISCOUNTID) && $criteria->keyContainsValue(DiscountTableMap::COL_DISCOUNTID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DiscountTableMap::COL_DISCOUNTID.')');
        }


        // Set the correct dbName
        $query = DiscountQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
