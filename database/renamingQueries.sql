-- Account Number Table Renaming --

ALTER TABLE `acno` RENAME TO `account_numbers`;
ALTER TABLE `account_numbers` CHANGE `id` `account_number_id` INT(255) NOT NULL AUTO_INCREMENT;
ALTER TABLE `account_numbers` CHANGE `cid` `customer_id` INT(255) NOT NULL; 
ALTER TABLE `account_numbers` CHANGE `acno` `account_number` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;

-- Customer Table Renaming --

ALTER TABLE `ucon` RENAME TO `customers`;
ALTER TABLE `customers` CHANGE `id` `customer_id` INT(255) NOT NULL AUTO_INCREMENT;
ALTER TABLE `customers` CHANGE `name` `customer_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;
ALTER TABLE `customers` CHANGE `aname` `customer_name_english` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;
ALTER TABLE `customers` CHANGE `aid` `area_id` INT(255) NOT NULL; 
ALTER TABLE `customers` CHANGE `mno` `mobile_number` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;
ALTER TABLE `customers` CHANGE `ano` `account_number` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;
ALTER TABLE `customers` CHANGE `timc` `created_time_stamp` INT(255) NOT NULL; 

-- Moving Account Numbers from customers table to account number Table  --

INSERT INTO `account_numbers` ( `customer_id`, `account_number`)
SELECT  `customer_id`, `account_number`
FROM    `customers`
WHERE   trim(`account_number`) <> '';

ALTER TABLE `customers` DROP `account_number`;

-- Area Table Renaming --

ALTER TABLE `area` RENAME TO `areas`;
ALTER TABLE `area` CHANGE `id` `area_id` INT(255) NOT NULL;
ALTER TABLE `area` CHANGE `name` `area_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;
ALTER TABLE `area` CHANGE `aname` `area_name_english` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;

-- subscription Table Renaming --

ALTER TABLE `baki` RENAME TO `subscription_charge`;
ALTER TABLE `subscription_charge` CHANGE `id` `charge_id` INT(255) NOT NULL AUTO_INCREMENT;
ALTER TABLE `subscription_charge` CHANGE `cid` `customer_id` INT(255) NOT NULL;
ALTER TABLE `subscription_charge` CHANGE `amt` `charge_amount` INT(255) NOT NULL; 
ALTER TABLE `subscription_charge` CHANGE `timr` `charge_time_stamp` INT(255) NOT NULL; 
ALTER TABLE `subscription_charge` CHANGE `timc` `created_time_stamp` INT(255) NOT NULL; 

-- Paid Table Renaming --

ALTER TABLE `jama` RENAME TO `paid`;
ALTER TABLE `paid` CHANGE `id` `paid_id` INT(255) NOT NULL AUTO_INCREMENT;
ALTER TABLE `paid` CHANGE `cid` `customer_id` INT(255) NOT NULL;
ALTER TABLE `paid` CHANGE `amt` `paid_amount` INT(255) NOT NULL; 
ALTER TABLE `paid` CHANGE `timr` `paid_time_stamp` INT(255) NOT NULL; 

-- Drop Unuse Table --

DROP TABLE IF EXISTS `arda`;
DROP TABLE IF EXISTS `dagt`;
DROP TABLE IF EXISTS `prfcv`;