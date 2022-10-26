<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMaps(array (
  'default' => 
  array (
    0 => '\\Shop\\Models\\Map\\DiscountTableMap',
    1 => '\\Shop\\Models\\Map\\ProductPurchaseTableMap',
    2 => '\\Shop\\Models\\Map\\ProductTableMap',
    3 => '\\Shop\\Models\\Map\\PurchaseTableMap',
    4 => '\\Shop\\Models\\Map\\TwitterTableMap',
    5 => '\\Shop\\Models\\Map\\UserTableMap',
  ),
));
