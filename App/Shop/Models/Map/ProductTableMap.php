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
use Shop\Models\Product;
use Shop\Models\ProductQuery;


/**
 * This class defines the structure of the 'product' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ProductTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Shop.Models.Map.ProductTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'product';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Shop\\Models\\Product';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Shop.Models.Product';

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
     * the column name for the productId field
     */
    const COL_PRODUCTID = 'product.productId';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'product.name';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'product.description';

    /**
     * the column name for the category field
     */
    const COL_CATEGORY = 'product.category';

    /**
     * the column name for the quantity field
     */
    const COL_QUANTITY = 'product.quantity';

    /**
     * the column name for the price field
     */
    const COL_PRICE = 'product.price';

    /**
     * the column name for the imageUrl field
     */
    const COL_IMAGEURL = 'product.imageUrl';

    /**
     * the column name for the isDeleted field
     */
    const COL_ISDELETED = 'product.isDeleted';

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
        self::TYPE_PHPNAME       => array('Productid', 'Name', 'Description', 'Category', 'Quantity', 'Price', 'Imageurl', 'Isdeleted', ),
        self::TYPE_CAMELNAME     => array('productid', 'name', 'description', 'category', 'quantity', 'price', 'imageurl', 'isdeleted', ),
        self::TYPE_COLNAME       => array(ProductTableMap::COL_PRODUCTID, ProductTableMap::COL_NAME, ProductTableMap::COL_DESCRIPTION, ProductTableMap::COL_CATEGORY, ProductTableMap::COL_QUANTITY, ProductTableMap::COL_PRICE, ProductTableMap::COL_IMAGEURL, ProductTableMap::COL_ISDELETED, ),
        self::TYPE_FIELDNAME     => array('productId', 'name', 'description', 'category', 'quantity', 'price', 'imageUrl', 'isDeleted', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Productid' => 0, 'Name' => 1, 'Description' => 2, 'Category' => 3, 'Quantity' => 4, 'Price' => 5, 'Imageurl' => 6, 'Isdeleted' => 7, ),
        self::TYPE_CAMELNAME     => array('productid' => 0, 'name' => 1, 'description' => 2, 'category' => 3, 'quantity' => 4, 'price' => 5, 'imageurl' => 6, 'isdeleted' => 7, ),
        self::TYPE_COLNAME       => array(ProductTableMap::COL_PRODUCTID => 0, ProductTableMap::COL_NAME => 1, ProductTableMap::COL_DESCRIPTION => 2, ProductTableMap::COL_CATEGORY => 3, ProductTableMap::COL_QUANTITY => 4, ProductTableMap::COL_PRICE => 5, ProductTableMap::COL_IMAGEURL => 6, ProductTableMap::COL_ISDELETED => 7, ),
        self::TYPE_FIELDNAME     => array('productId' => 0, 'name' => 1, 'description' => 2, 'category' => 3, 'quantity' => 4, 'price' => 5, 'imageUrl' => 6, 'isDeleted' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Productid' => 'PRODUCTID',
        'Product.Productid' => 'PRODUCTID',
        'productid' => 'PRODUCTID',
        'product.productid' => 'PRODUCTID',
        'ProductTableMap::COL_PRODUCTID' => 'PRODUCTID',
        'COL_PRODUCTID' => 'PRODUCTID',
        'productId' => 'PRODUCTID',
        'product.productId' => 'PRODUCTID',
        'Name' => 'NAME',
        'Product.Name' => 'NAME',
        'name' => 'NAME',
        'product.name' => 'NAME',
        'ProductTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'Description' => 'DESCRIPTION',
        'Product.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'product.description' => 'DESCRIPTION',
        'ProductTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'Category' => 'CATEGORY',
        'Product.Category' => 'CATEGORY',
        'category' => 'CATEGORY',
        'product.category' => 'CATEGORY',
        'ProductTableMap::COL_CATEGORY' => 'CATEGORY',
        'COL_CATEGORY' => 'CATEGORY',
        'Quantity' => 'QUANTITY',
        'Product.Quantity' => 'QUANTITY',
        'quantity' => 'QUANTITY',
        'product.quantity' => 'QUANTITY',
        'ProductTableMap::COL_QUANTITY' => 'QUANTITY',
        'COL_QUANTITY' => 'QUANTITY',
        'Price' => 'PRICE',
        'Product.Price' => 'PRICE',
        'price' => 'PRICE',
        'product.price' => 'PRICE',
        'ProductTableMap::COL_PRICE' => 'PRICE',
        'COL_PRICE' => 'PRICE',
        'Imageurl' => 'IMAGEURL',
        'Product.Imageurl' => 'IMAGEURL',
        'imageurl' => 'IMAGEURL',
        'product.imageurl' => 'IMAGEURL',
        'ProductTableMap::COL_IMAGEURL' => 'IMAGEURL',
        'COL_IMAGEURL' => 'IMAGEURL',
        'imageUrl' => 'IMAGEURL',
        'product.imageUrl' => 'IMAGEURL',
        'Isdeleted' => 'ISDELETED',
        'Product.Isdeleted' => 'ISDELETED',
        'isdeleted' => 'ISDELETED',
        'product.isdeleted' => 'ISDELETED',
        'ProductTableMap::COL_ISDELETED' => 'ISDELETED',
        'COL_ISDELETED' => 'ISDELETED',
        'isDeleted' => 'ISDELETED',
        'product.isDeleted' => 'ISDELETED',
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
        $this->setName('product');
        $this->setPhpName('Product');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Shop\\Models\\Product');
        $this->setPackage('Shop.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('productId', 'Productid', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 50, null);
        $this->addColumn('description', 'Description', 'VARCHAR', true, 100, null);
        $this->addColumn('category', 'Category', 'VARCHAR', true, 50, null);
        $this->addColumn('quantity', 'Quantity', 'INTEGER', true, null, 0);
        $this->addColumn('price', 'Price', 'DOUBLE', true, null, null);
        $this->addColumn('imageUrl', 'Imageurl', 'VARCHAR', true, 255, 'product/default/default_product.png');
        $this->addColumn('isDeleted', 'Isdeleted', 'BOOLEAN', true, 1, false);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('ProductPurchase', '\\Shop\\Models\\ProductPurchase', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':productId',
    1 => ':productId',
  ),
), null, null, 'ProductPurchases', false);
        $this->addRelation('Purchase', '\\Shop\\Models\\Purchase', RelationMap::MANY_TO_MANY, array(), null, null, 'Purchases');
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Productid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Productid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Productid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Productid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Productid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Productid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Productid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ProductTableMap::CLASS_DEFAULT : ProductTableMap::OM_CLASS;
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
     * @return array           (Product object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ProductTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ProductTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ProductTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ProductTableMap::OM_CLASS;
            /** @var Product $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ProductTableMap::addInstanceToPool($obj, $key);
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
            $key = ProductTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ProductTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Product $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ProductTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ProductTableMap::COL_PRODUCTID);
            $criteria->addSelectColumn(ProductTableMap::COL_NAME);
            $criteria->addSelectColumn(ProductTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(ProductTableMap::COL_CATEGORY);
            $criteria->addSelectColumn(ProductTableMap::COL_QUANTITY);
            $criteria->addSelectColumn(ProductTableMap::COL_PRICE);
            $criteria->addSelectColumn(ProductTableMap::COL_IMAGEURL);
            $criteria->addSelectColumn(ProductTableMap::COL_ISDELETED);
        } else {
            $criteria->addSelectColumn($alias . '.productId');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.category');
            $criteria->addSelectColumn($alias . '.quantity');
            $criteria->addSelectColumn($alias . '.price');
            $criteria->addSelectColumn($alias . '.imageUrl');
            $criteria->addSelectColumn($alias . '.isDeleted');
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
            $criteria->removeSelectColumn(ProductTableMap::COL_PRODUCTID);
            $criteria->removeSelectColumn(ProductTableMap::COL_NAME);
            $criteria->removeSelectColumn(ProductTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(ProductTableMap::COL_CATEGORY);
            $criteria->removeSelectColumn(ProductTableMap::COL_QUANTITY);
            $criteria->removeSelectColumn(ProductTableMap::COL_PRICE);
            $criteria->removeSelectColumn(ProductTableMap::COL_IMAGEURL);
            $criteria->removeSelectColumn(ProductTableMap::COL_ISDELETED);
        } else {
            $criteria->removeSelectColumn($alias . '.productId');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.category');
            $criteria->removeSelectColumn($alias . '.quantity');
            $criteria->removeSelectColumn($alias . '.price');
            $criteria->removeSelectColumn($alias . '.imageUrl');
            $criteria->removeSelectColumn($alias . '.isDeleted');
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
        return Propel::getServiceContainer()->getDatabaseMap(ProductTableMap::DATABASE_NAME)->getTable(ProductTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Product or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Product object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Shop\Models\Product) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ProductTableMap::DATABASE_NAME);
            $criteria->add(ProductTableMap::COL_PRODUCTID, (array) $values, Criteria::IN);
        }

        $query = ProductQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ProductTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ProductTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the product table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ProductQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Product or Criteria object.
     *
     * @param mixed               $criteria Criteria or Product object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Product object
        }

        if ($criteria->containsKey(ProductTableMap::COL_PRODUCTID) && $criteria->keyContainsValue(ProductTableMap::COL_PRODUCTID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ProductTableMap::COL_PRODUCTID.')');
        }


        // Set the correct dbName
        $query = ProductQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
