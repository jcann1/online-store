
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `userId` INTEGER NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(25) NOT NULL,
    `forename` VARCHAR(25) NOT NULL,
    `surname` VARCHAR(25) NOT NULL,
    `isBanned` TINYINT(1) DEFAULT 0 NOT NULL,
    `level` INTEGER NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `twitterId` INTEGER,
    PRIMARY KEY (`userId`),
    INDEX `user_fi_d3cecc` (`twitterId`),
    CONSTRAINT `user_fk_d3cecc`
        FOREIGN KEY (`twitterId`)
        REFERENCES `twitter` (`twitterId`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- twitter
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `twitter`;

CREATE TABLE `twitter`
(
    `twitterId` INTEGER NOT NULL AUTO_INCREMENT,
    `twitterApiId` INTEGER NOT NULL,
    `name` VARCHAR(128) NOT NULL,
    PRIMARY KEY (`twitterId`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- product
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product`
(
    `productId` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `description` VARCHAR(100) NOT NULL,
    `category` VARCHAR(50) NOT NULL,
    `quantity` INTEGER DEFAULT 0 NOT NULL,
    `price` DOUBLE NOT NULL,
    `imageUrl` VARCHAR(255) DEFAULT 'product/default/default_product.png' NOT NULL,
    `isDeleted` TINYINT(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`productId`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- discount
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `discount`;

CREATE TABLE `discount`
(
    `discountId` INTEGER NOT NULL AUTO_INCREMENT,
    `dateValid` DATE NOT NULL,
    `code` VARCHAR(30) NOT NULL,
    `percentage` DOUBLE NOT NULL,
    `valid` TINYINT(1) DEFAULT 1 NOT NULL,
    PRIMARY KEY (`discountId`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- purchase
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `purchase`;

CREATE TABLE `purchase`
(
    `purchaseId` INTEGER NOT NULL AUTO_INCREMENT,
    `userId` INTEGER,
    `totalPrice` DOUBLE NOT NULL,
    `totalAfterDiscount` DOUBLE DEFAULT 0 NOT NULL,
    `status` VARCHAR(30) DEFAULT 'Paid' NOT NULL,
    `discountId` INTEGER,
    PRIMARY KEY (`purchaseId`),
    INDEX `purchase_fi_aa8e1a` (`discountId`),
    INDEX `purchase_fi_7cabf3` (`userId`),
    CONSTRAINT `purchase_fk_aa8e1a`
        FOREIGN KEY (`discountId`)
        REFERENCES `discount` (`discountId`),
    CONSTRAINT `purchase_fk_7cabf3`
        FOREIGN KEY (`userId`)
        REFERENCES `user` (`userId`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- product_purchase
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `product_purchase`;

CREATE TABLE `product_purchase`
(
    `productId` INTEGER NOT NULL,
    `purchaseId` INTEGER NOT NULL,
    `quantity` INTEGER DEFAULT 1,
    PRIMARY KEY (`productId`,`purchaseId`),
    INDEX `product_purchase_fi_250afd` (`purchaseId`),
    CONSTRAINT `product_purchase_fk_e6d626`
        FOREIGN KEY (`productId`)
        REFERENCES `product` (`productId`),
    CONSTRAINT `product_purchase_fk_250afd`
        FOREIGN KEY (`purchaseId`)
        REFERENCES `purchase` (`purchaseId`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
