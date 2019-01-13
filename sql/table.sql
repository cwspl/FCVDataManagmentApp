CREATE TABLE `area` (
  `id`			    int(5)  NOT NULL AUTO_INCREMENT,
  `name`        varchar(255) NOT NULL,
  `aname`       varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
CREATE TABLE `ucon` (
  `id`		       int(5)  NOT NULL AUTO_INCREMENT,
  `name`       varchar(255) NOT NULL,
  `aname`      varchar(255) NOT NULL,
  `aid`        varchar(255) NOT NULL,
  `mno`        varchar(255) NOT NULL,
  `ano`        varchar(255) NOT NULL,
  `timc`       varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
CREATE TABLE `baki` (
  `id`		      int(5)  NOT NULL AUTO_INCREMENT,
  `cid`       varchar(255) NOT NULL,
  `amt`       varchar(255) NOT NULL,
  `timr`      varchar(255) NOT NULL,
  `timc`      varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
CREATE TABLE `jama` (
  `id`			    int(5)  NOT NULL AUTO_INCREMENT,
  `cid`       varchar(255) NOT NULL,
  `amt`       varchar(255) NOT NULL,
  `timc`      varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
CREATE TABLE `prfcv` (
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
CREATE TABLE `dagt` (
  `id`		int(5)  NOT NULL AUTO_INCREMENT,
  `name`      varchar(255) NOT NULL,
  `psc`       varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
CREATE TABLE `arda` (
  `id`		  int(5)  NOT NULL AUTO_INCREMENT,
  `daid`      varchar(255) NOT NULL,
  `aid`       varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
CREATE TABLE `vklist` (
  `id`		  int(5)  NOT NULL AUTO_INCREMENT,
  `name`      varchar(255) NOT NULL,
  `aname`      varchar(255) NOT NULL,
  `mon`       varchar(255) NOT NULL,
  `timec`       varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
CREATE TABLE `vkacno` (
  `id`		  int(5)  NOT NULL AUTO_INCREMENT,
  `cid`       varchar(255) NOT NULL,
  `acno`      varchar(255) NOT NULL,
  `dat`      varchar(255) NOT NULL,
  `stt`       varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;