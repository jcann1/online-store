<?php

namespace Shop\Models\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Shop\Models\Discount as ChildDiscount;
use Shop\Models\DiscountQuery as ChildDiscountQuery;
use Shop\Models\Product as ChildProduct;
use Shop\Models\ProductPurchase as ChildProductPurchase;
use Shop\Models\ProductPurchaseQuery as ChildProductPurchaseQuery;
use Shop\Models\ProductQuery as ChildProductQuery;
use Shop\Models\Purchase as ChildPurchase;
use Shop\Models\PurchaseQuery as ChildPurchaseQuery;
use Shop\Models\User as ChildUser;
use Shop\Models\UserQuery as ChildUserQuery;
use Shop\Models\Map\ProductPurchaseTableMap;
use Shop\Models\Map\PurchaseTableMap;

/**
 * Base class that represents a row from the 'purchase' table.
 *
 *
 *
 * @package    propel.generator.Shop.Models.Base
 */
abstract class Purchase implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Shop\\Models\\Map\\PurchaseTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var bool
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var bool
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = [];

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = [];

    /**
     * The value for the purchaseid field.
     *
     * @var        int
     */
    protected $purchaseid;

    /**
     * The value for the userid field.
     *
     * @var        int|null
     */
    protected $userid;

    /**
     * The value for the totalprice field.
     *
     * @var        double
     */
    protected $totalprice;

    /**
     * The value for the totalafterdiscount field.
     *
     * Note: this column has a database default value of: 0.0
     * @var        double
     */
    protected $totalafterdiscount;

    /**
     * The value for the status field.
     *
     * Note: this column has a database default value of: 'Paid'
     * @var        string
     */
    protected $status;

    /**
     * The value for the discountid field.
     *
     * @var        int|null
     */
    protected $discountid;

    /**
     * @var        ChildDiscount
     */
    protected $aDiscount;

    /**
     * @var        ChildUser
     */
    protected $aUser;

    /**
     * @var        ObjectCollection|ChildProductPurchase[] Collection to store aggregation of ChildProductPurchase objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildProductPurchase> Collection to store aggregation of ChildProductPurchase objects.
     */
    protected $collProductPurchases;
    protected $collProductPurchasesPartial;

    /**
     * @var        ObjectCollection|ChildProduct[] Cross Collection to store aggregation of ChildProduct objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildProduct> Cross Collection to store aggregation of ChildProduct objects.
     */
    protected $collProducts;

    /**
     * @var bool
     */
    protected $collProductsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProduct[]
     * @phpstan-var ObjectCollection&\Traversable<ChildProduct>
     */
    protected $productsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProductPurchase[]
     * @phpstan-var ObjectCollection&\Traversable<ChildProductPurchase>
     */
    protected $productPurchasesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues(): void
    {
        $this->totalafterdiscount = 0.0;
        $this->status = 'Paid';
    }

    /**
     * Initializes internal state of Shop\Models\Base\Purchase object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return bool True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param string $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return bool True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return bool True, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param bool $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return bool The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  bool $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            unset($this->modifiedColumns[$col]);
        } else {
            $this->modifiedColumns = [];
        }
    }

    /**
     * Compares this with another <code>Purchase</code> instance.  If
     * <code>obj</code> is an instance of <code>Purchase</code>, delegates to
     * <code>equals(Purchase)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param mixed $obj The object to compare to.
     * @return bool Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return bool
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  \Propel\Runtime\Parser\AbstractParser|string $parser An AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  bool    $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param  string  $keyType                (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string  The exported data
     */
    public function exportTo($parser, bool $includeLazyLoadColumns = true, string $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [purchaseid] column value.
     *
     * @return int
     */
    public function getPurchaseid()
    {
        return $this->purchaseid;
    }

    /**
     * Get the [userid] column value.
     *
     * @return int|null
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Get the [totalprice] column value.
     *
     * @return double
     */
    public function getTotalprice()
    {
        return $this->totalprice;
    }

    /**
     * Get the [totalafterdiscount] column value.
     *
     * @return double
     */
    public function getTotalafterdiscount()
    {
        return $this->totalafterdiscount;
    }

    /**
     * Get the [status] column value.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [discountid] column value.
     *
     * @return int|null
     */
    public function getDiscountid()
    {
        return $this->discountid;
    }

    /**
     * Set the value of [purchaseid] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setPurchaseid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->purchaseid !== $v) {
            $this->purchaseid = $v;
            $this->modifiedColumns[PurchaseTableMap::COL_PURCHASEID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [userid] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setUserid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->userid !== $v) {
            $this->userid = $v;
            $this->modifiedColumns[PurchaseTableMap::COL_USERID] = true;
        }

        if ($this->aUser !== null && $this->aUser->getUserid() !== $v) {
            $this->aUser = null;
        }

        return $this;
    }

    /**
     * Set the value of [totalprice] column.
     *
     * @param double $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTotalprice($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->totalprice !== $v) {
            $this->totalprice = $v;
            $this->modifiedColumns[PurchaseTableMap::COL_TOTALPRICE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [totalafterdiscount] column.
     *
     * @param double $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setTotalafterdiscount($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->totalafterdiscount !== $v) {
            $this->totalafterdiscount = $v;
            $this->modifiedColumns[PurchaseTableMap::COL_TOTALAFTERDISCOUNT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [status] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[PurchaseTableMap::COL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [discountid] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setDiscountid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->discountid !== $v) {
            $this->discountid = $v;
            $this->modifiedColumns[PurchaseTableMap::COL_DISCOUNTID] = true;
        }

        if ($this->aDiscount !== null && $this->aDiscount->getDiscountid() !== $v) {
            $this->aDiscount = null;
        }

        return $this;
    }

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return bool Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues(): bool
    {
            if ($this->totalafterdiscount !== 0.0) {
                return false;
            }

            if ($this->status !== 'Paid') {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    }

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param bool    $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws \Propel\Runtime\Exception\PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate(array $row, int $startcol = 0, bool $rehydrate = false, string $indexType = TableMap::TYPE_NUM): int
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PurchaseTableMap::translateFieldName('Purchaseid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->purchaseid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PurchaseTableMap::translateFieldName('Userid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->userid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PurchaseTableMap::translateFieldName('Totalprice', TableMap::TYPE_PHPNAME, $indexType)];
            $this->totalprice = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PurchaseTableMap::translateFieldName('Totalafterdiscount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->totalafterdiscount = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PurchaseTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PurchaseTableMap::translateFieldName('Discountid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->discountid = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = PurchaseTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Shop\\Models\\Purchase'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function ensureConsistency(): void
    {
        if ($this->aUser !== null && $this->userid !== $this->aUser->getUserid()) {
            $this->aUser = null;
        }
        if ($this->aDiscount !== null && $this->discountid !== $this->aDiscount->getDiscountid()) {
            $this->aDiscount = null;
        }
    }

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      bool $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload(bool $deep = false, ?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PurchaseTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPurchaseQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aDiscount = null;
            $this->aUser = null;
            $this->collProductPurchases = null;

            $this->collProducts = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see Purchase::setDeleted()
     * @see Purchase::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PurchaseTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPurchaseQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    public function save(?ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PurchaseTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                PurchaseTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aDiscount !== null) {
                if ($this->aDiscount->isModified() || $this->aDiscount->isNew()) {
                    $affectedRows += $this->aDiscount->save($con);
                }
                $this->setDiscount($this->aDiscount);
            }

            if ($this->aUser !== null) {
                if ($this->aUser->isModified() || $this->aUser->isNew()) {
                    $affectedRows += $this->aUser->save($con);
                }
                $this->setUser($this->aUser);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->productsScheduledForDeletion !== null) {
                if (!$this->productsScheduledForDeletion->isEmpty()) {
                    $pks = [];
                    foreach ($this->productsScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[1] = $this->getPurchaseid();
                        $entryPk[0] = $entry->getProductid();
                        $pks[] = $entryPk;
                    }

                    \Shop\Models\ProductPurchaseQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->productsScheduledForDeletion = null;
                }

            }

            if ($this->collProducts) {
                foreach ($this->collProducts as $product) {
                    if (!$product->isDeleted() && ($product->isNew() || $product->isModified())) {
                        $product->save($con);
                    }
                }
            }


            if ($this->productPurchasesScheduledForDeletion !== null) {
                if (!$this->productPurchasesScheduledForDeletion->isEmpty()) {
                    \Shop\Models\ProductPurchaseQuery::create()
                        ->filterByPrimaryKeys($this->productPurchasesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productPurchasesScheduledForDeletion = null;
                }
            }

            if ($this->collProductPurchases !== null) {
                foreach ($this->collProductPurchases as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    }

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = [];
        $index = 0;

        $this->modifiedColumns[PurchaseTableMap::COL_PURCHASEID] = true;
        if (null !== $this->purchaseid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PurchaseTableMap::COL_PURCHASEID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PurchaseTableMap::COL_PURCHASEID)) {
            $modifiedColumns[':p' . $index++]  = 'purchaseId';
        }
        if ($this->isColumnModified(PurchaseTableMap::COL_USERID)) {
            $modifiedColumns[':p' . $index++]  = 'userId';
        }
        if ($this->isColumnModified(PurchaseTableMap::COL_TOTALPRICE)) {
            $modifiedColumns[':p' . $index++]  = 'totalPrice';
        }
        if ($this->isColumnModified(PurchaseTableMap::COL_TOTALAFTERDISCOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'totalAfterDiscount';
        }
        if ($this->isColumnModified(PurchaseTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(PurchaseTableMap::COL_DISCOUNTID)) {
            $modifiedColumns[':p' . $index++]  = 'discountId';
        }

        $sql = sprintf(
            'INSERT INTO purchase (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'purchaseId':
                        $stmt->bindValue($identifier, $this->purchaseid, PDO::PARAM_INT);
                        break;
                    case 'userId':
                        $stmt->bindValue($identifier, $this->userid, PDO::PARAM_INT);
                        break;
                    case 'totalPrice':
                        $stmt->bindValue($identifier, $this->totalprice, PDO::PARAM_STR);
                        break;
                    case 'totalAfterDiscount':
                        $stmt->bindValue($identifier, $this->totalafterdiscount, PDO::PARAM_STR);
                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);
                        break;
                    case 'discountId':
                        $stmt->bindValue($identifier, $this->discountid, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setPurchaseid($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return int Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con): int
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName(string $name, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PurchaseTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos Position in XML schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition(int $pos)
    {
        switch ($pos) {
            case 0:
                return $this->getPurchaseid();
                break;
            case 1:
                return $this->getUserid();
                break;
            case 2:
                return $this->getTotalprice();
                break;
            case 3:
                return $this->getTotalafterdiscount();
                break;
            case 4:
                return $this->getStatus();
                break;
            case 5:
                return $this->getDiscountid();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     bool $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     bool $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array|string An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_PHPNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = [], bool $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Purchase'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Purchase'][$this->hashCode()] = true;
        $keys = PurchaseTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getPurchaseid(),
            $keys[1] => $this->getUserid(),
            $keys[2] => $this->getTotalprice(),
            $keys[3] => $this->getTotalafterdiscount(),
            $keys[4] => $this->getStatus(),
            $keys[5] => $this->getDiscountid(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aDiscount) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'discount';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'discount';
                        break;
                    default:
                        $key = 'Discount';
                }

                $result[$key] = $this->aDiscount->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUser) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'user';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user';
                        break;
                    default:
                        $key = 'User';
                }

                $result[$key] = $this->aUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collProductPurchases) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productPurchases';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'product_purchases';
                        break;
                    default:
                        $key = 'ProductPurchases';
                }

                $result[$key] = $this->collProductPurchases->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this
     */
    public function setByName(string $name, $value, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PurchaseTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        $this->setByPosition($pos, $value);

        return $this;
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this
     */
    public function setByPosition(int $pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setPurchaseid($value);
                break;
            case 1:
                $this->setUserid($value);
                break;
            case 2:
                $this->setTotalprice($value);
                break;
            case 3:
                $this->setTotalafterdiscount($value);
                break;
            case 4:
                $this->setStatus($value);
                break;
            case 5:
                $this->setDiscountid($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return     $this
     */
    public function fromArray(array $arr, string $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = PurchaseTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setPurchaseid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setUserid($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setTotalprice($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setTotalafterdiscount($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setStatus($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setDiscountid($arr[$keys[5]]);
        }

        return $this;
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this The current object, for fluid interface
     */
    public function importFrom($parser, string $data, string $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria(): Criteria
    {
        $criteria = new Criteria(PurchaseTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PurchaseTableMap::COL_PURCHASEID)) {
            $criteria->add(PurchaseTableMap::COL_PURCHASEID, $this->purchaseid);
        }
        if ($this->isColumnModified(PurchaseTableMap::COL_USERID)) {
            $criteria->add(PurchaseTableMap::COL_USERID, $this->userid);
        }
        if ($this->isColumnModified(PurchaseTableMap::COL_TOTALPRICE)) {
            $criteria->add(PurchaseTableMap::COL_TOTALPRICE, $this->totalprice);
        }
        if ($this->isColumnModified(PurchaseTableMap::COL_TOTALAFTERDISCOUNT)) {
            $criteria->add(PurchaseTableMap::COL_TOTALAFTERDISCOUNT, $this->totalafterdiscount);
        }
        if ($this->isColumnModified(PurchaseTableMap::COL_STATUS)) {
            $criteria->add(PurchaseTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(PurchaseTableMap::COL_DISCOUNTID)) {
            $criteria->add(PurchaseTableMap::COL_DISCOUNTID, $this->discountid);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria(): Criteria
    {
        $criteria = ChildPurchaseQuery::create();
        $criteria->add(PurchaseTableMap::COL_PURCHASEID, $this->purchaseid);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int|string Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getPurchaseid();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getPurchaseid();
    }

    /**
     * Generic method to set the primary key (purchaseid column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key): void
    {
        $this->setPurchaseid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getPurchaseid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Shop\Models\Purchase (or compatible) type.
     * @param      bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setUserid($this->getUserid());
        $copyObj->setTotalprice($this->getTotalprice());
        $copyObj->setTotalafterdiscount($this->getTotalafterdiscount());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setDiscountid($this->getDiscountid());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getProductPurchases() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductPurchase($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setPurchaseid(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Shop\Models\Purchase Clone of current object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function copy(bool $deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildDiscount object.
     *
     * @param  ChildDiscount|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setDiscount(ChildDiscount $v = null)
    {
        if ($v === null) {
            $this->setDiscountid(NULL);
        } else {
            $this->setDiscountid($v->getDiscountid());
        }

        $this->aDiscount = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildDiscount object, it will not be re-added.
        if ($v !== null) {
            $v->addDiscount($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildDiscount object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildDiscount|null The associated ChildDiscount object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getDiscount(?ConnectionInterface $con = null)
    {
        if ($this->aDiscount === null && ($this->discountid != 0)) {
            $this->aDiscount = ChildDiscountQuery::create()->findPk($this->discountid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aDiscount->addDiscounts($this);
             */
        }

        return $this->aDiscount;
    }

    /**
     * Declares an association between this object and a ChildUser object.
     *
     * @param  ChildUser|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setUser(ChildUser $v = null)
    {
        if ($v === null) {
            $this->setUserid(NULL);
        } else {
            $this->setUserid($v->getUserid());
        }

        $this->aUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUser object, it will not be re-added.
        if ($v !== null) {
            $v->addUser($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUser object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUser|null The associated ChildUser object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getUser(?ConnectionInterface $con = null)
    {
        if ($this->aUser === null && ($this->userid != 0)) {
            $this->aUser = ChildUserQuery::create()->findPk($this->userid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUser->addUsers($this);
             */
        }

        return $this->aUser;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('ProductPurchase' === $relationName) {
            $this->initProductPurchases();
            return;
        }
    }

    /**
     * Clears out the collProductPurchases collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addProductPurchases()
     */
    public function clearProductPurchases()
    {
        $this->collProductPurchases = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collProductPurchases collection loaded partially.
     */
    public function resetPartialProductPurchases($v = true)
    {
        $this->collProductPurchasesPartial = $v;
    }

    /**
     * Initializes the collProductPurchases collection.
     *
     * By default this just sets the collProductPurchases collection to an empty array (like clearcollProductPurchases());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductPurchases($overrideExisting = true)
    {
        if (null !== $this->collProductPurchases && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductPurchaseTableMap::getTableMap()->getCollectionClassName();

        $this->collProductPurchases = new $collectionClassName;
        $this->collProductPurchases->setModel('\Shop\Models\ProductPurchase');
    }

    /**
     * Gets an array of ChildProductPurchase objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPurchase is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProductPurchase[] List of ChildProductPurchase objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProductPurchase> List of ChildProductPurchase objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getProductPurchases(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collProductPurchasesPartial && !$this->isNew();
        if (null === $this->collProductPurchases || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collProductPurchases) {
                    $this->initProductPurchases();
                } else {
                    $collectionClassName = ProductPurchaseTableMap::getTableMap()->getCollectionClassName();

                    $collProductPurchases = new $collectionClassName;
                    $collProductPurchases->setModel('\Shop\Models\ProductPurchase');

                    return $collProductPurchases;
                }
            } else {
                $collProductPurchases = ChildProductPurchaseQuery::create(null, $criteria)
                    ->filterByPurchase($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductPurchasesPartial && count($collProductPurchases)) {
                        $this->initProductPurchases(false);

                        foreach ($collProductPurchases as $obj) {
                            if (false == $this->collProductPurchases->contains($obj)) {
                                $this->collProductPurchases->append($obj);
                            }
                        }

                        $this->collProductPurchasesPartial = true;
                    }

                    return $collProductPurchases;
                }

                if ($partial && $this->collProductPurchases) {
                    foreach ($this->collProductPurchases as $obj) {
                        if ($obj->isNew()) {
                            $collProductPurchases[] = $obj;
                        }
                    }
                }

                $this->collProductPurchases = $collProductPurchases;
                $this->collProductPurchasesPartial = false;
            }
        }

        return $this->collProductPurchases;
    }

    /**
     * Sets a collection of ChildProductPurchase objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $productPurchases A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPurchase The current object (for fluent API support)
     */
    public function setProductPurchases(Collection $productPurchases, ?ConnectionInterface $con = null)
    {
        /** @var ChildProductPurchase[] $productPurchasesToDelete */
        $productPurchasesToDelete = $this->getProductPurchases(new Criteria(), $con)->diff($productPurchases);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->productPurchasesScheduledForDeletion = clone $productPurchasesToDelete;

        foreach ($productPurchasesToDelete as $productPurchaseRemoved) {
            $productPurchaseRemoved->setPurchase(null);
        }

        $this->collProductPurchases = null;
        foreach ($productPurchases as $productPurchase) {
            $this->addProductPurchase($productPurchase);
        }

        $this->collProductPurchases = $productPurchases;
        $this->collProductPurchasesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProductPurchase objects.
     *
     * @param      Criteria $criteria
     * @param      bool $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ProductPurchase objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countProductPurchases(?Criteria $criteria = null, $distinct = false, ?ConnectionInterface $con = null)
    {
        $partial = $this->collProductPurchasesPartial && !$this->isNew();
        if (null === $this->collProductPurchases || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductPurchases) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductPurchases());
            }

            $query = ChildProductPurchaseQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPurchase($this)
                ->count($con);
        }

        return count($this->collProductPurchases);
    }

    /**
     * Method called to associate a ChildProductPurchase object to this object
     * through the ChildProductPurchase foreign key attribute.
     *
     * @param  ChildProductPurchase $l ChildProductPurchase
     * @return $this The current object (for fluent API support)
     */
    public function addProductPurchase(ChildProductPurchase $l)
    {
        if ($this->collProductPurchases === null) {
            $this->initProductPurchases();
            $this->collProductPurchasesPartial = true;
        }

        if (!$this->collProductPurchases->contains($l)) {
            $this->doAddProductPurchase($l);

            if ($this->productPurchasesScheduledForDeletion and $this->productPurchasesScheduledForDeletion->contains($l)) {
                $this->productPurchasesScheduledForDeletion->remove($this->productPurchasesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProductPurchase $productPurchase The ChildProductPurchase object to add.
     */
    protected function doAddProductPurchase(ChildProductPurchase $productPurchase)
    {
        $this->collProductPurchases[]= $productPurchase;
        $productPurchase->setPurchase($this);
    }

    /**
     * @param  ChildProductPurchase $productPurchase The ChildProductPurchase object to remove.
     * @return $this|ChildPurchase The current object (for fluent API support)
     */
    public function removeProductPurchase(ChildProductPurchase $productPurchase)
    {
        if ($this->getProductPurchases()->contains($productPurchase)) {
            $pos = $this->collProductPurchases->search($productPurchase);
            $this->collProductPurchases->remove($pos);
            if (null === $this->productPurchasesScheduledForDeletion) {
                $this->productPurchasesScheduledForDeletion = clone $this->collProductPurchases;
                $this->productPurchasesScheduledForDeletion->clear();
            }
            $this->productPurchasesScheduledForDeletion[]= clone $productPurchase;
            $productPurchase->setPurchase(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Purchase is new, it will return
     * an empty collection; or if this Purchase has previously
     * been saved, it will retrieve related ProductPurchases from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Purchase.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProductPurchase[] List of ChildProductPurchase objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProductPurchase}> List of ChildProductPurchase objects
     */
    public function getProductPurchasesJoinProduct(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductPurchaseQuery::create(null, $criteria);
        $query->joinWith('Product', $joinBehavior);

        return $this->getProductPurchases($query, $con);
    }

    /**
     * Clears out the collProducts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProducts()
     */
    public function clearProducts()
    {
        $this->collProducts = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collProducts crossRef collection.
     *
     * By default this just sets the collProducts collection to an empty collection (like clearProducts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initProducts()
    {
        $collectionClassName = ProductPurchaseTableMap::getTableMap()->getCollectionClassName();

        $this->collProducts = new $collectionClassName;
        $this->collProductsPartial = true;
        $this->collProducts->setModel('\Shop\Models\Product');
    }

    /**
     * Checks if the collProducts collection is loaded.
     *
     * @return bool
     */
    public function isProductsLoaded(): bool
    {
        return null !== $this->collProducts;
    }

    /**
     * Gets a collection of ChildProduct objects related by a many-to-many relationship
     * to the current object by way of the product_purchase cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPurchase is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildProduct[] List of ChildProduct objects
     * @phpstan-return ObjectCollection&\Traversable<ChildProduct> List of ChildProduct objects
     */
    public function getProducts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collProductsPartial && !$this->isNew();
        if (null === $this->collProducts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collProducts) {
                    $this->initProducts();
                }
            } else {

                $query = ChildProductQuery::create(null, $criteria)
                    ->filterByPurchase($this);
                $collProducts = $query->find($con);
                if (null !== $criteria) {
                    return $collProducts;
                }

                if ($partial && $this->collProducts) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collProducts as $obj) {
                        if (!$collProducts->contains($obj)) {
                            $collProducts[] = $obj;
                        }
                    }
                }

                $this->collProducts = $collProducts;
                $this->collProductsPartial = false;
            }
        }

        return $this->collProducts;
    }

    /**
     * Sets a collection of Product objects related by a many-to-many relationship
     * to the current object by way of the product_purchase cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $products A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildPurchase The current object (for fluent API support)
     */
    public function setProducts(Collection $products, ?ConnectionInterface $con = null)
    {
        $this->clearProducts();
        $currentProducts = $this->getProducts();

        $productsScheduledForDeletion = $currentProducts->diff($products);

        foreach ($productsScheduledForDeletion as $toDelete) {
            $this->removeProduct($toDelete);
        }

        foreach ($products as $product) {
            if (!$currentProducts->contains($product)) {
                $this->doAddProduct($product);
            }
        }

        $this->collProductsPartial = false;
        $this->collProducts = $products;

        return $this;
    }

    /**
     * Gets the number of Product objects related by a many-to-many relationship
     * to the current object by way of the product_purchase cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      bool $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int The number of related Product objects
     */
    public function countProducts(?Criteria $criteria = null, $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collProductsPartial && !$this->isNew();
        if (null === $this->collProducts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProducts) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getProducts());
                }

                $query = ChildProductQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByPurchase($this)
                    ->count($con);
            }
        } else {
            return count($this->collProducts);
        }
    }

    /**
     * Associate a ChildProduct to this object
     * through the product_purchase cross reference table.
     *
     * @param ChildProduct $product
     * @return ChildPurchase The current object (for fluent API support)
     */
    public function addProduct(ChildProduct $product)
    {
        if ($this->collProducts === null) {
            $this->initProducts();
        }

        if (!$this->getProducts()->contains($product)) {
            // only add it if the **same** object is not already associated
            $this->collProducts->push($product);
            $this->doAddProduct($product);
        }

        return $this;
    }

    /**
     *
     * @param ChildProduct $product
     */
    protected function doAddProduct(ChildProduct $product)
    {
        $productPurchase = new ChildProductPurchase();

        $productPurchase->setProduct($product);

        $productPurchase->setPurchase($this);

        $this->addProductPurchase($productPurchase);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$product->isPurchasesLoaded()) {
            $product->initPurchases();
            $product->getPurchases()->push($this);
        } elseif (!$product->getPurchases()->contains($this)) {
            $product->getPurchases()->push($this);
        }

    }

    /**
     * Remove product of this object
     * through the product_purchase cross reference table.
     *
     * @param ChildProduct $product
     * @return ChildPurchase The current object (for fluent API support)
     */
    public function removeProduct(ChildProduct $product)
    {
        if ($this->getProducts()->contains($product)) {
            $productPurchase = new ChildProductPurchase();
            $productPurchase->setProduct($product);
            if ($product->isPurchasesLoaded()) {
                //remove the back reference if available
                $product->getPurchases()->removeObject($this);
            }

            $productPurchase->setPurchase($this);
            $this->removeProductPurchase(clone $productPurchase);
            $productPurchase->clear();

            $this->collProducts->remove($this->collProducts->search($product));

            if (null === $this->productsScheduledForDeletion) {
                $this->productsScheduledForDeletion = clone $this->collProducts;
                $this->productsScheduledForDeletion->clear();
            }

            $this->productsScheduledForDeletion->push($product);
        }


        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        if (null !== $this->aDiscount) {
            $this->aDiscount->removeDiscount($this);
        }
        if (null !== $this->aUser) {
            $this->aUser->removeUser($this);
        }
        $this->purchaseid = null;
        $this->userid = null;
        $this->totalprice = null;
        $this->totalafterdiscount = null;
        $this->status = null;
        $this->discountid = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);

        return $this;
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param bool $deep Whether to also clear the references on all referrer objects.
     * @return $this
     */
    public function clearAllReferences(bool $deep = false)
    {
        if ($deep) {
            if ($this->collProductPurchases) {
                foreach ($this->collProductPurchases as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProducts) {
                foreach ($this->collProducts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collProductPurchases = null;
        $this->collProducts = null;
        $this->aDiscount = null;
        $this->aUser = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PurchaseTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return bool
     */
    public function preSave(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     * @return void
     */
    public function postSave(ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return bool
     */
    public function preInsert(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     * @return void
     */
    public function postInsert(ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return bool
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     * @return void
     */
    public function postUpdate(ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return bool
     */
    public function preDelete(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     * @return void
     */
    public function postDelete(ConnectionInterface $con = null): void
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
