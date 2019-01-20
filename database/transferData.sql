INSERT INTO `account_numbers` ( `customer_id`, `account_number`, `account_created_at`,`account_updated_at`)
SELECT  `cid`, `acno`, UNIX_TIMESTAMP(), UNIX_TIMESTAMP()
FROM    `acno`;

INSERT INTO `areas` ( `area_id`, `area_name`, `area_name_english`, `area_created_at`, `area_updated_at`)
SELECT  `id`, `name`, `aname`, UNIX_TIMESTAMP(), UNIX_TIMESTAMP()
FROM    `area`;

INSERT INTO `paid` ( `paid_id`, `customer_id`, `paid_amount`, `paid_at`,`paid_created_at`,`paid_updated_at`)
SELECT  `id`, `cid`, `amt`, `timc`, UNIX_TIMESTAMP(), UNIX_TIMESTAMP()
FROM    `jama`; 

INSERT INTO `subscribtion_charge` ( `charge_id`, `customer_id`, `charge_amount`, `charge_started_at`, `charge_created_at`, `charge_updated_at`)
SELECT  `id`, `cid`, `amt`, `timr`, `timc`, UNIX_TIMESTAMP()
FROM    `baki`;

INSERT INTO `customers` ( `customer_id`, `area_id`, `customer_name`, `customer_name_english`, `customer_mobile_number`, `customer_created_at`, `customer_updated_at`)
SELECT  `id`,`aid`, `name`, `aname`, `mno`, `timc`, UNIX_TIMESTAMP()
FROM    `ucon`;

INSERT INTO `account_numbers` ( `customer_id`, `account_number`)
SELECT  `id`, `ano`
FROM    `ucon`
WHERE   trim(`ano`) <> '';

INSERT INTO `agent_areas` ( `agent_id`, `area_id`)
SELECT (SELECT `agent_id` FROM `city_agents` WHERE `agent_name` = 'FCV' LIMIT 1), `area_id`
FROM `areas`;

INSERT INTO `areas` (`area_name`, `area_name_english`) VALUES ('વસ્તી ખંડલી', 'Vasti Khandali');

INSERT INTO `customers` (`customer_name`, `customer_name_english`, `area_id`, `customer_mobile_number`, `customer_created_at`)
SELECT   `name`, `aname`, (SELECT `area_id` FROM `areas` WHERE `area_name_english` = 'Vasti Khandali' LIMIT 1), `mon`, `timec`
FROM    `vklist`;

INSERT INTO `agent_areas` ( `agent_id`, `area_id`)
SELECT (SELECT `agent_id` FROM `city_agents` WHERE `agent_name` = 'Vasti Khandali' LIMIT 1), (SELECT `area_id` FROM `areas` WHERE `area_name_english` = 'Vasti Khandali' LIMIT 1)
FROM `areas`;

INSERT INTO `account_numbers` ( `customer_id`, `account_number`, `account_status`, `account_expired_at`, `account_created_at`, `account_updated_at`)
SELECT `customers`.`customer_id`, `vkacno`.`acno`, `vkacno`.`stt`, IF(`vkacno`.`dat`!='',UNIX_TIMESTAMP(DATE_FORMAT(`vkacno`.`dat`,'%Y/%m/%d')), NULL), UNIX_TIMESTAMP(), UNIX_TIMESTAMP()
FROM `vkacno` 
INNER JOIN `vklist` ON `vkacno`.`cid` = `vklist`.`id` 
INNER JOIN `customers` ON `customers`.`customer_mobile_number` = `vklist`.`mon` 
AND `customers`.`customer_name_english` = `vklist`.`aname`

UPDATE `areas` SET `area_name` = CONVERT(CAST(CONVERT(`area_name` USING latin1) AS BINARY) USING utf8);
UPDATE `customers` SET `customer_name` = CONVERT(CAST(CONVERT(`customer_name` USING latin1) AS BINARY) USING utf8);

DROP TABLE IF EXISTS `acno`;
DROP TABLE IF EXISTS `area`;
DROP TABLE IF EXISTS `jama`;
DROP TABLE IF EXISTS `baki`;
DROP TABLE IF EXISTS `ucon`;
DROP TABLE IF EXISTS `prfcv`;
DROP TABLE IF EXISTS `dagt`;
DROP TABLE IF EXISTS `arda`;
DROP TABLE IF EXISTS `vklist`;
DROP TABLE IF EXISTS `vkacno`;