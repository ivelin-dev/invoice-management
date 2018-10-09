-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.36-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for invoice_management
CREATE DATABASE IF NOT EXISTS `invoice_management` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `invoice_management`;

-- Dumping structure for table invoice_management.invoices
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(50) NOT NULL,
  `customer_address` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `due_date` date NOT NULL,
  `note` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- Dumping data for table invoice_management.invoices: ~16 rows (approximately)
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` (`id`, `customer_name`, `customer_address`, `date`, `due_date`, `note`) VALUES
	(35, 'Mitchell L', '123 Pender', '2018-10-08', '2018-10-09', 'This is the first invoice'),
	(36, 'Ivelin I', '321 Harvard Street', '2018-10-07', '2018-10-17', 'This is an invoice with multiple payment methods'),
	(37, 'Homer Simpson', '222 Howard Street', '2018-09-05', '2019-02-14', 'This is an invoice with multiple products and paym');
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;

-- Dumping structure for table invoice_management.invoice_payments
CREATE TABLE IF NOT EXISTS `invoice_payments` (
  `invoice_id` int(11) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_amount` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table invoice_management.invoice_payments: ~2 rows (approximately)
/*!40000 ALTER TABLE `invoice_payments` DISABLE KEYS */;
INSERT INTO `invoice_payments` (`invoice_id`, `payment_method`, `payment_amount`) VALUES
	(35, 'Mastercard', 800),
	(36, 'Mastercard', 500),
	(36, 'Cash', 100),
	(37, 'Mastercard', 1000),
	(37, 'Visa', 100),
	(37, 'Cash', 300);
/*!40000 ALTER TABLE `invoice_payments` ENABLE KEYS */;

-- Dumping structure for table invoice_management.invoice_products
CREATE TABLE IF NOT EXISTS `invoice_products` (
  `invoice_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `quantity` tinyint(3) unsigned NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `tax` decimal(5,2) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table invoice_management.invoice_products: ~10 rows (approximately)
/*!40000 ALTER TABLE `invoice_products` DISABLE KEYS */;
INSERT INTO `invoice_products` (`invoice_id`, `name`, `quantity`, `price`, `tax`) VALUES
	(35, 'IQbuds Boost with Ear ID', 1, 649, 12.00),
	(35, 'EarCentric NANO800', 2, 878, 12.00),
	(36, 'Forsite Health Digital Hearing Aid', 4, 69, 12.00),
	(37, 'EarCentric NANO800', 1, 900, 12.00),
	(37, 'Forsite Health Digital Hearing Aid', 4, 80, 12.00),
	(37, 'IQbuds Boost with Ear ID', 3, 647, 12.00);
/*!40000 ALTER TABLE `invoice_products` ENABLE KEYS */;

-- Dumping structure for table invoice_management.payment_methods
CREATE TABLE IF NOT EXISTS `payment_methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table invoice_management.payment_methods: ~3 rows (approximately)
/*!40000 ALTER TABLE `payment_methods` DISABLE KEYS */;
INSERT INTO `payment_methods` (`id`, `name`) VALUES
	(1, 'Mastercard'),
	(2, 'Visa'),
	(3, 'Cash');
/*!40000 ALTER TABLE `payment_methods` ENABLE KEYS */;

-- Dumping structure for table invoice_management.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `tax_percent` decimal(5,2) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table invoice_management.products: ~2 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `name`, `price`, `tax_percent`) VALUES
	(1, 'IQbuds Boost with Ear ID', 649, 12.00),
	(2, 'EarCentric Hearing AID', 255, 12.00),
	(3, 'EarCentric NANO800', 878, 12.00),
	(4, 'RCA Symphonix Digital Hearing', 299, 12.00),
	(5, 'BHA-702S Hearing Amplifier', 99, 12.00),
	(6, 'Forsite Health Digital Hearing Aid', 69, 12.00);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
