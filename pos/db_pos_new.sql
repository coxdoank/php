-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.31 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.1.0.6205
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_pos
DROP DATABASE IF EXISTS `db_pos`;
CREATE DATABASE IF NOT EXISTS `db_pos` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_pos`;

-- Dumping structure for table db_pos.attendance
DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `ID_ATTN` int(11) NOT NULL,
  `CLOCK_IN_TIME` datetime DEFAULT NULL,
  `CLOCK_OUT_TIME` datetime DEFAULT NULL,
  `USER_ID` int(11) DEFAULT NULL,
  `SHIFT_ID` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_pos.drawer_balance
DROP TABLE IF EXISTS `drawer_balance`;
CREATE TABLE IF NOT EXISTS `drawer_balance` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CREATE_DATE` datetime DEFAULT NULL,
  `ACCOUNT_NAME` varchar(50) DEFAULT NULL,
  `CASH_BALANCE` double DEFAULT NULL,
  `TERMINAL` varchar(25) DEFAULT NULL,
  `ID_TRANSACTION` int(11) DEFAULT NULL,
  `NOTE` varchar(255) DEFAULT NULL,
  `UPDATE_BY` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4140 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_pos.employee
DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `EMPLOYEE_NAME` varchar(150) NOT NULL,
  `POSITION` varchar(50) DEFAULT NULL,
  `USER_ACCESS` varchar(50) NOT NULL,
  `PHONE_NO` varchar(50) NOT NULL,
  `EMAIL` varchar(150) NOT NULL,
  `PASSCODE` varchar(6) NOT NULL,
  `OUTLET` varchar(50) NOT NULL,
  `UNIQUE_ID` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_pos.outlet
DROP TABLE IF EXISTS `outlet`;
CREATE TABLE IF NOT EXISTS `outlet` (
  `UNIQUE_ID` varchar(10) NOT NULL,
  `OUTLET_NAME` varchar(50) NOT NULL,
  `PHONE_NO` varchar(50) NOT NULL,
  `ADDRESS` varchar(255) NOT NULL,
  `POSTAL_CODE` varchar(5) NOT NULL,
  `EMPLOYEE_NAME` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_pos.product_category
DROP TABLE IF EXISTS `product_category`;
CREATE TABLE IF NOT EXISTS `product_category` (
  `CATEGORY_NAME` varchar(100) NOT NULL,
  `VISIBLE` int(1) DEFAULT NULL,
  `SORT_ORDER` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_pos.product_item
DROP TABLE IF EXISTS `product_item`;
CREATE TABLE IF NOT EXISTS `product_item` (
  `PRODUCT_NAME` varchar(120) NOT NULL,
  `BUY_PRICE` double NOT NULL,
  `PRICE` double NOT NULL,
  `IMAGE` text,
  `VISIBLE` int(1) DEFAULT NULL,
  `SORT_ORDER` int(11) DEFAULT NULL,
  `CATEGORY_NAME` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_pos.restaurant
DROP TABLE IF EXISTS `restaurant`;
CREATE TABLE IF NOT EXISTS `restaurant` (
  `ID` int(11) NOT NULL,
  `UNIQUE_ID` int(11) DEFAULT NULL,
  `NAME` varchar(120) DEFAULT NULL,
  `ADDRESS_LINE1` varchar(60) DEFAULT NULL,
  `ADDRESS_LINE2` varchar(60) DEFAULT NULL,
  `ADDRESS_LINE3` varchar(60) DEFAULT NULL,
  `ZIP_CODE` varchar(10) DEFAULT NULL,
  `TELEPHONE` varchar(16) DEFAULT NULL,
  `CAPACITY` int(11) DEFAULT NULL,
  `TABLES` int(11) DEFAULT NULL,
  `CNAME` varchar(20) DEFAULT NULL,
  `CSYMBOL` varchar(10) DEFAULT NULL,
  `TICKET_FOOTER` varchar(60) DEFAULT NULL,
  `PRICE_INCLUDES_TAX` bit(1) DEFAULT NULL,
  `OPENING_BALANCE` double DEFAULT NULL,
  `LOGO` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_pos.terminal
DROP TABLE IF EXISTS `terminal`;
CREATE TABLE IF NOT EXISTS `terminal` (
  `ID_TERMINAL` int(5) NOT NULL AUTO_INCREMENT,
  `TERMINAL` varchar(25) DEFAULT NULL,
  `URL` varchar(25) DEFAULT NULL,
  `NO_TRANSACTION` int(11) DEFAULT NULL,
  `IP_TERMINAL` varchar(25) DEFAULT NULL,
  `FLAG` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`ID_TERMINAL`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_pos.th_ticket
DROP TABLE IF EXISTS `th_ticket`;
CREATE TABLE IF NOT EXISTS `th_ticket` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NO_TRANSACTION` int(11) DEFAULT NULL,
  `TERMINAL` varchar(25) DEFAULT NULL,
  `ID_USER` varchar(10) DEFAULT NULL,
  `CREATE_DATE` datetime DEFAULT NULL,
  `CLOSING_DATE` datetime DEFAULT NULL,
  `DELIVERY_DATE` datetime DEFAULT NULL,
  `TICKET_TYPE` varchar(30) DEFAULT NULL,
  `PAYMENT_TYPE` varchar(30) DEFAULT NULL,
  `AMOUNT` double DEFAULT NULL,
  `TENDER_AMOUNT` double DEFAULT NULL,
  `DUE_AMOUNT` double DEFAULT NULL,
  `NOTE` varchar(255) DEFAULT NULL,
  `STATUS` varchar(25) DEFAULT NULL,
  `ID_TRANSACTION` int(11) DEFAULT NULL,
  `SYNC` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=131089 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_pos.th_ticket_item
DROP TABLE IF EXISTS `th_ticket_item`;
CREATE TABLE IF NOT EXISTS `th_ticket_item` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TERMINAL` varchar(25) DEFAULT NULL,
  `ITEM_ID` int(11) DEFAULT NULL,
  `ITEM_COUNT` int(11) DEFAULT NULL,
  `ITEM_NAME` varchar(120) DEFAULT NULL,
  `CATEGORY_NAME` varchar(120) DEFAULT NULL,
  `ITEM_PRICE` double DEFAULT NULL,
  `DISCOUNT_RATE` double DEFAULT NULL,
  `SUB_TOTAL` double DEFAULT NULL,
  `DISCOUNT` double DEFAULT NULL,
  `TAX_AMOUNT` double DEFAULT NULL,
  `TOTAL_PRICE` double DEFAULT NULL,
  `NO_TRANSACTION` int(11) DEFAULT NULL,
  `SYNC` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=131137 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_pos.ticket
DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NO_TRANSACTION` int(11) DEFAULT NULL,
  `TERMINAL` varchar(25) DEFAULT NULL,
  `ID_USER` varchar(10) DEFAULT NULL,
  `CREATE_DATE` datetime DEFAULT NULL,
  `CLOSING_DATE` datetime DEFAULT NULL,
  `DELIVERY_DATE` datetime DEFAULT NULL,
  `TICKET_TYPE` varchar(30) DEFAULT NULL,
  `PAYMENT_TYPE` varchar(30) DEFAULT NULL,
  `AMOUNT` double DEFAULT NULL,
  `TENDER_AMOUNT` double DEFAULT NULL,
  `DUE_AMOUNT` double DEFAULT NULL,
  `NOTE` varchar(255) DEFAULT NULL,
  `STATUS` varchar(25) DEFAULT NULL,
  `ID_TRANSACTION` int(11) DEFAULT NULL,
  `SYNC` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=68327 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_pos.ticket_item
DROP TABLE IF EXISTS `ticket_item`;
CREATE TABLE IF NOT EXISTS `ticket_item` (
  `OUTLET_NAME` varchar(50) DEFAULT NULL,
  `ITEM_ID` int(11) DEFAULT NULL,
  `ITEM_COUNT` int(11) DEFAULT NULL,
  `ITEM_NAME` varchar(120) DEFAULT NULL,
  `CATEGORY_NAME` varchar(120) DEFAULT NULL,
  `ITEM_PRICE` double DEFAULT NULL,
  `DISCOUNT_RATE` double DEFAULT NULL,
  `SUB_TOTAL` double DEFAULT NULL,
  `DISCOUNT` double DEFAULT NULL,
  `TAX_AMOUNT` double DEFAULT NULL,
  `TOTAL_PRICE` double DEFAULT NULL,
  `NO_TRANSACTION` int(11) DEFAULT NULL,
  `SYNC` enum('Y','N') DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_pos.transaction
DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `UNIQUE_ID` varchar(10) DEFAULT NULL,
  `OUTLET_NAME` varchar(50) DEFAULT NULL,
  `EMPLOYEE_NAME` varchar(10) DEFAULT NULL,
  `NO_TRANSACTION` int(11) DEFAULT NULL,
  `CREATE_DATE` datetime DEFAULT NULL,
  `CLOSING_DATE` datetime DEFAULT NULL,
  `TICKET_TYPE` varchar(30) DEFAULT NULL,
  `PAYMENT_TYPE` varchar(30) DEFAULT NULL,
  `AMOUNT` double DEFAULT NULL,
  `TENDER_AMOUNT` double DEFAULT NULL,
  `DUE_AMOUNT` double DEFAULT NULL,
  `NOTE` varchar(255) DEFAULT NULL,
  `STATUS` varchar(25) DEFAULT NULL,
  KEY `Index 1` (`UNIQUE_ID`,`OUTLET_NAME`,`NO_TRANSACTION`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table db_pos.transaction_item
DROP TABLE IF EXISTS `transaction_item`;
CREATE TABLE IF NOT EXISTS `transaction_item` (
  `UNIQUE_ID` varchar(10) DEFAULT NULL,
  `OUTLET_NAME` varchar(50) DEFAULT NULL,
  `NO_TRANSACTION` int(11) DEFAULT NULL,
  `ITEM_NAME` varchar(120) DEFAULT NULL,
  `CATEGORY_NAME` varchar(120) DEFAULT NULL,
  `QTY` int(11) DEFAULT NULL,
  `PRICE` double DEFAULT NULL,
  `SUB_TOTAL` double DEFAULT NULL,
  `TOTAL_PRICE` double DEFAULT NULL,
  KEY `Index 1` (`UNIQUE_ID`,`NO_TRANSACTION`,`OUTLET_NAME`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table db_pos.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `UNIQUE_ID` varchar(10) NOT NULL,
  `FIRST_NAME` varchar(30) NOT NULL,
  `LAST_NAME` varchar(30) NOT NULL,
  `CONTACT_NO` varchar(20) NOT NULL,
  `EMAIL` varchar(150) NOT NULL,
  `PASSCODE` varchar(6) NOT NULL,
  `BUSINESS_NAME` varchar(100) NOT NULL,
  `BUSINESS_TYPE` varchar(50) NOT NULL,
  PRIMARY KEY (`UNIQUE_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_pos.user_menu
DROP TABLE IF EXISTS `user_menu`;
CREATE TABLE IF NOT EXISTS `user_menu` (
  `NAME` varchar(100) NOT NULL,
  PRIMARY KEY (`NAME`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_pos.user_permission
DROP TABLE IF EXISTS `user_permission`;
CREATE TABLE IF NOT EXISTS `user_permission` (
  `USER_TYPE_ID` int(5) NOT NULL,
  `USER_MENU_NAME` varchar(100) NOT NULL,
  PRIMARY KEY (`USER_TYPE_ID`,`USER_MENU_NAME`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table db_pos.user_type
DROP TABLE IF EXISTS `user_type`;
CREATE TABLE IF NOT EXISTS `user_type` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `USER_TYPE` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for view db_pos.vw_category_item
DROP VIEW IF EXISTS `vw_category_item`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `vw_category_item` 
) ENGINE=MyISAM;

-- Dumping structure for view db_pos.vw_ticket_trans
DROP VIEW IF EXISTS `vw_ticket_trans`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `vw_ticket_trans` (
	`TERMINAL` VARCHAR(25) NULL COLLATE 'latin1_swedish_ci',
	`ITEM_ID` INT(11) NULL,
	`ITEM_COUNT` INT(11) NULL,
	`ITEM_NAME` VARCHAR(120) NULL COLLATE 'latin1_swedish_ci',
	`CATEGORY_NAME` VARCHAR(120) NULL COLLATE 'latin1_swedish_ci',
	`ITEM_PRICE` DOUBLE NULL,
	`DISCOUNT_RATE` DOUBLE NULL,
	`SUB_TOTAL` DOUBLE NULL,
	`DISCOUNT` DOUBLE NULL,
	`TAX_AMOUNT` DOUBLE NULL,
	`TOTAL_PRICE` DOUBLE NULL,
	`NO_TRANSACTION` INT(11) NULL,
	`ID_USER` VARCHAR(10) NULL COLLATE 'latin1_swedish_ci',
	`CREATE_DATE` DATETIME NULL,
	`CLOSING_DATE` DATETIME NULL,
	`DELIVERY_DATE` DATETIME NULL,
	`TICKET_TYPE` VARCHAR(30) NULL COLLATE 'latin1_swedish_ci',
	`AMOUNT` DOUBLE NULL,
	`DUE_AMOUNT` DOUBLE NULL,
	`NOTE` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`STATUS` VARCHAR(25) NULL COLLATE 'latin1_swedish_ci',
	`ID_TRANSACTION` INT(11) NULL
) ENGINE=MyISAM;

-- Dumping structure for view db_pos.vw_category_item
DROP VIEW IF EXISTS `vw_category_item`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `vw_category_item`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_category_item` AS select `mit`.`ID_MENU_ITEM` AS `ID_MENU_ITEM`,`mit`.`MENU_NAME` AS `MENU_NAME`,`mit`.`BUY_PRICE` AS `BUY_PRICE`,`mit`.`PRICE` AS `PRICE`,`mit`.`DISCOUNT_RATE` AS `DISCOUNT_RATE`,`cat`.`CATEGORY_NAME` AS `CATEGORY_NAME` from (`menu_item` `mit` left join `menu_category` `cat` on((`mit`.`ID_CATEGORY` = `cat`.`ID_CATEGORY`)));

-- Dumping structure for view db_pos.vw_ticket_trans
DROP VIEW IF EXISTS `vw_ticket_trans`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `vw_ticket_trans`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_ticket_trans` AS select `ttm`.`TERMINAL` AS `TERMINAL`,`ttm`.`ITEM_ID` AS `ITEM_ID`,`ttm`.`ITEM_COUNT` AS `ITEM_COUNT`,`ttm`.`ITEM_NAME` AS `ITEM_NAME`,`ttm`.`CATEGORY_NAME` AS `CATEGORY_NAME`,`ttm`.`ITEM_PRICE` AS `ITEM_PRICE`,`ttm`.`DISCOUNT_RATE` AS `DISCOUNT_RATE`,`ttm`.`SUB_TOTAL` AS `SUB_TOTAL`,`ttm`.`DISCOUNT` AS `DISCOUNT`,`ttm`.`TAX_AMOUNT` AS `TAX_AMOUNT`,`ttm`.`TOTAL_PRICE` AS `TOTAL_PRICE`,`ttm`.`NO_TRANSACTION` AS `NO_TRANSACTION`,`tic`.`ID_USER` AS `ID_USER`,`tic`.`CREATE_DATE` AS `CREATE_DATE`,`tic`.`CLOSING_DATE` AS `CLOSING_DATE`,`tic`.`DELIVERY_DATE` AS `DELIVERY_DATE`,`tic`.`TICKET_TYPE` AS `TICKET_TYPE`,`tic`.`AMOUNT` AS `AMOUNT`,`tic`.`DUE_AMOUNT` AS `DUE_AMOUNT`,`tic`.`NOTE` AS `NOTE`,`tic`.`STATUS` AS `STATUS`,`tic`.`ID_TRANSACTION` AS `ID_TRANSACTION` from (`th_ticket_item` `ttm` left join `th_ticket` `tic` on(((`tic`.`NO_TRANSACTION` = `ttm`.`NO_TRANSACTION`) and (`tic`.`TERMINAL` = `ttm`.`TERMINAL`))));

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
