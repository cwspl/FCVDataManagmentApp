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
