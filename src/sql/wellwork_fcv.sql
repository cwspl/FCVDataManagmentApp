DROP TABLE area;
DROP TABLE ucon;
DROP TABLE baki;
DROP TABLE jama;
DROP TABLE prfcv;
CREATE TABLE IF NOT EXISTS `area` (
  `id`			    int(5)  NOT NULL AUTO_INCREMENT,
  `name`        varchar(255) NOT NULL,
  `aname`       varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
CREATE TABLE IF NOT EXISTS `ucon` (
  `id`		       int(5)  NOT NULL AUTO_INCREMENT,
  `name`       varchar(255) NOT NULL,
  `aname`      varchar(255) NOT NULL,
  `aid`        varchar(255) NOT NULL,
  `mno`        varchar(255) NOT NULL,
  `ano`        varchar(255) NOT NULL,
  `timc`       varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
CREATE TABLE IF NOT EXISTS `baki` (
  `id`		      int(5)  NOT NULL AUTO_INCREMENT,
  `cid`       varchar(255) NOT NULL,
  `amt`       varchar(255) NOT NULL,
  `timr`      varchar(255) NOT NULL,
  `timc`      varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
CREATE TABLE IF NOT EXISTS `jama` (
  `id`			    int(5)  NOT NULL AUTO_INCREMENT,
  `cid`       varchar(255) NOT NULL,
  `amt`       varchar(255) NOT NULL,
  `timc`      varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
CREATE TABLE IF NOT EXISTS `prfcv` (
  `id`			    int(5)  NOT NULL AUTO_INCREMENT,
  `pid`       varchar(255) NOT NULL,
  `per`       varchar(255) NOT NULL,
  `cid`       varchar(255) NOT NULL,
  `aid`       varchar(255) NOT NULL,
  `yr`        varchar(255) NOT NULL,
  `dat`       varchar(255) NOT NULL,
  `timc`      varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
INSERT INTO `area` (`id`, `name`, `aname`) VALUES ('4', '??', 'eyey');
INSERT INTO `area` (`id`, `name`, `aname`) VALUES ('2', '???', 'papap');
INSERT INTO `area` (`id`, `name`, `aname`) VALUES ('3', '???', 'shashash');
INSERT INTO `area` (`id`, `name`, `aname`) VALUES ('5', '???', 'pakhakh');
INSERT INTO `area` (`id`, `name`, `aname`) VALUES ('6', 'fghgf', 'fghgf');
INSERT INTO `ucon` (`id`, `name`, `aname`, `mno`, `ano`, `timc`) VALUES ('8', 'sdfg', 'sdfg', '', '', '1466169525');
INSERT INTO `ucon` (`id`, `name`, `aname`, `mno`, `ano`, `timc`) VALUES ('7', 'પંચપપપ', 'panchapapap', '8998798787', '', '1466068404');
INSERT INTO `ucon` (`id`, `name`, `aname`, `mno`, `ano`, `timc`) VALUES ('9', '??????', 'panchapapap', '8998798787', '', '1466068404');
INSERT INTO `baki` (`id`, `cid`, `amt`, `timr`, `timc`) VALUES ('23', '7', '0', '1448908200', '1466142234');
INSERT INTO `baki` (`id`, `cid`, `amt`, `timr`, `timc`) VALUES ('22', '8', '170', '1454265000', '1466169572');
INSERT INTO `baki` (`id`, `cid`, `amt`, `timr`, `timc`) VALUES ('16', '7', '170', '1451586600', '1466068404');
INSERT INTO `baki` (`id`, `cid`, `amt`, `timr`, `timc`) VALUES ('21', '8', '680', '1451586600', '1466169525');
INSERT INTO `baki` (`id`, `cid`, `amt`, `timr`, `timc`) VALUES ('20', '7', '170', '1454265000', '1466163104');
INSERT INTO `jama` (`id`, `cid`, `amt`, `timc`) VALUES ('38', '8', '500', '1451586600');
INSERT INTO `jama` (`id`, `cid`, `amt`, `timc`) VALUES ('41', '7', '2040', '1477938600');
