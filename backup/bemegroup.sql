-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 24, 2018 at 05:14 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bemegroup`
--

-- --------------------------------------------------------

--
-- Table structure for table `barcode`
--

CREATE TABLE IF NOT EXISTS `barcode` (
  `barcode_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_year` varchar(100) NOT NULL,
  `item_month` varchar(10) NOT NULL,
  `item_incre` int(50) NOT NULL,
  PRIMARY KEY (`barcode_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `barcode`
--

INSERT INTO `barcode` (`barcode_id`, `item_year`, `item_month`, `item_incre`) VALUES
(1, 'PD2018', '-03-', 1),
(2, 'PD2018', '-03-', 2),
(3, 'PD2018', '-03-', 3),
(4, 'PD2018', '-03-', 4),
(5, 'PD2018', '-03-', 5),
(6, 'PD2018', '-03-', 6),
(7, 'PD2018', '-03-', 7),
(8, 'PD2018', '-03-', 8),
(9, 'PD2018', '-03-', 9),
(10, 'PD2018', '-03-', 10),
(11, 'PD2018', '-03-', 11);

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
  `branch_id` int(11) NOT NULL AUTO_INCREMENT,
  `ebay_name` varchar(50) NOT NULL,
  `ebay_mail` varchar(100) NOT NULL,
  `auctiva_name` varchar(50) NOT NULL,
  `auctiva_mail` varchar(100) NOT NULL,
  `paypal_mail` varchar(100) NOT NULL,
  `ebay_address` varchar(100) NOT NULL,
  `skin` varchar(15) NOT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `ebay_name`, `ebay_mail`, `auctiva_name`, `auctiva_mail`, `paypal_mail`, `ebay_address`, `skin`) VALUES
(1, 'bemegroup', 'bemegroupint@gmail.com', 'check321', 'check321@gmail.com', 'bemegroupint321@gmail.com', 'USA', 'red'),
(2, 'mayagroupint', 'mayagroupint@gmail.com', 'checkusa@gmail.com', 'checkusd001', 'mayagroupint123@gmail.com', 'Bangladesh', 'yellow');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(30) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'AMETHYST'),
(2, 'AQUAMARINE'),
(3, 'CITRINE'),
(4, 'DIOPSIDE'),
(5, 'EMERALD'),
(6, 'GARNET'),
(7, 'OPAL'),
(8, 'PARIDOT'),
(9, 'RHODOITE GARNET'),
(10, 'RUBLITE'),
(11, 'RUBY'),
(12, 'SAPPHIRE'),
(13, 'TOPAZ'),
(14, 'TOURMALINE'),
(15, 'ZIRCON');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE IF NOT EXISTS `currency` (
  `curr_id` int(11) NOT NULL AUTO_INCREMENT,
  `curr_usd` decimal(10,2) NOT NULL,
  PRIMARY KEY (`curr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`curr_id`, `curr_usd`) VALUES
(2, '77.00');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_name` varchar(100) NOT NULL,
  `cust_ebay_name` varchar(100) NOT NULL,
  `cust_paypal_name` varchar(100) NOT NULL,
  `cust_contact` varchar(100) NOT NULL,
  `shipping_address` varchar(100) NOT NULL,
  `shipping_country` varchar(100) NOT NULL,
  `cust_pic` varchar(300) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `cust_remarks` varchar(50) NOT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_name`, `cust_ebay_name`, `cust_paypal_name`, `cust_contact`, `shipping_address`, `shipping_country`, `cust_pic`, `branch_id`, `date`, `cust_remarks`) VALUES
(1, 'Shane Hatlee ', 'white_fire2006 ', 'Shane.Hatlee@yahoo.com', 'NY', 'Shane Hatlee\r\n4968 Rt. 7\r\nHoosick Falls, NY 12090\r\nUnited States', 'USA', 'default.gif', 1, '2018-02-17 01:21:03', ''),
(2, 'Gary Riggle ', 'rigglin4681 ', 'RIGGLE4681@msn.com', 'NY', 'gary riggle\r\n3802 w nob hill blvd\r\nyakima, WA 98902-4739\r\nUnited States', 'USA', 'default.gif', 1, '2018-02-18 17:31:21', ''),
(3, 'Jitka ChaloupkovÃ¡ ', 'vega_ga ', 'Jitka.ebay@seznam.cz', 'NY', 'ChaloupkovÃ¡ Jitka\r\nJanÅ¯v DÅ¯l 3\r\nOseÄnÃ¡,\r\n46352\r\nCzech Republic', 'Czech Republic', 'default.gif', 1, '2018-02-18 17:37:43', ''),
(4, 'STEPHANIE DO ', 'diep9step ', 'stephaniedo98@aol.com', 'NY', 'STEPHANIE DO\r\n4556 S MANHATTAN AVE\r\nSTE B\r\nTAMPA, FL 33611\r\nUnited States', 'USA', 'default.gif', 1, '2018-02-18 17:39:58', ''),
(5, 'Manuel Troncoso Paredes', 'cachito01 ', 'manuel.troncoso7@yahoo.com.mx', 'NY', 'Manuel Troncoso Paredes. 8 th st Lindenhurst, NY 11757 United States', 'USA', 'default.gif', 1, '2018-02-21 08:54:48', ''),
(6, 'Alfred Wasilewski', 'filip81pl', 'alfredinnypl@gmail.com', 'NY', 'Alfred Wasilewski\r\n529 s. 8 th st\r\nLindenhurst, NY 11757\r\nUnited States', 'USA', 'default.gif', 1, '2018-02-21 09:57:50', ''),
(7, 'Sara Dahl', '891234', 'sara8982@hotmail.com', 'NY', 'Sara Dahl\r\n16175 231 Ave NW\r\nBig Lake, MN 55309\r\nUnited States', 'USA', 'default.gif', 1, '2018-02-21 10:00:39', ''),
(8, 'susanafay', 'pals_friend', 'susanafay@comcast.net', 'NY', 'Susan A Fay\r\n113 Blackstone\r\nMendon, MA 01756\r\nUnited States', 'USA', 'default.gif', 1, '2018-02-21 10:03:39', ''),
(9, 'Lok Mei Heung', 'easyleopard', 'lokmeiheung@gmail.com', 'NY', 'David Cat Kwong\r\n9455 NE Alderwood Rd\r\nc/o HKW-DRYL\r\nPortland, OR 97220-1696\r\nUnited States', 'USA', 'default.gif', 1, '2018-02-21 10:06:01', ''),
(10, 'Wayne Cram', 'waynztoolz', 'wm.cram@gmail.com', 'NY', 'Wayne Cram\r\n8566 lake Murray blvd\r\nSan Diego, CA 92119\r\nUnited States', 'USA', 'default.gif', 1, '2018-03-08 02:24:32', ''),
(11, 'Elena Jimenez Valls', 'leni44elena', '92sarita92@gmail.com', 'NY', 'Elena Jimenez Valls\r\nC/San Carlos de Nicaragua nÂº1 6E\r\nAlbacete\r\n02005 Albacete, Castilla-La Mancha', 'Spain', 'default.gif', 1, '2018-03-08 02:27:37', ''),
(12, 'Laurent Willocq', 'ziblocq', 'laurent.willocq@gmail.com', 'NY', 'Laurent Willocq\r\nrue de la malcense\r\n36\r\n7700 Dottignies\r\nBelgium', 'Belgium', 'default.gif', 1, '2018-03-08 02:29:18', ''),
(13, 'yanti', 'mrsmarse-sddahbhvd', 'mrsmn_ma@yahoo.com', 'NY', 'marsemin marsemin\r\nperumahan mitra raya blok i no.56\r\nbatam, KEPRI \r\n29461\r\nIndonesia', 'Indonesia', 'default.gif', 1, '2018-03-20 00:42:48', '');

-- --------------------------------------------------------

--
-- Table structure for table `handler`
--

CREATE TABLE IF NOT EXISTS `handler` (
  `hand_id` int(11) NOT NULL AUTO_INCREMENT,
  `hand_first` varchar(50) NOT NULL,
  `hand_last` varchar(30) NOT NULL,
  `hand_mi` varchar(30) NOT NULL,
  `hand_address` varchar(100) NOT NULL,
  `hand_contact` varchar(30) NOT NULL,
  `hand_pic` varchar(300) NOT NULL,
  `bday` date NOT NULL,
  `nickname` varchar(30) NOT NULL,
  `house_status` varchar(30) NOT NULL,
  `years` varchar(20) NOT NULL,
  `rent` varchar(10) NOT NULL,
  `occupation` varchar(30) NOT NULL,
  `salary` varchar(30) NOT NULL,
  `emp_address` varchar(100) NOT NULL,
  `spouse` varchar(30) NOT NULL,
  `spouse_no` varchar(30) NOT NULL,
  `spouse_emp` varchar(50) NOT NULL,
  `spouse_details` varchar(100) NOT NULL,
  `spouse_income` decimal(10,2) NOT NULL,
  `comaker` varchar(30) NOT NULL,
  `comaker_details` varchar(100) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `hand_status` varchar(10) NOT NULL,
  `ci_remarks` varchar(1000) NOT NULL,
  `ci_name` varchar(50) NOT NULL,
  `ci_date` date NOT NULL,
  `photo` int(11) NOT NULL,
  `nid` int(11) NOT NULL,
  `cert` int(11) NOT NULL,
  `other_document` int(11) NOT NULL,
  `income` int(11) NOT NULL,
  PRIMARY KEY (`hand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `handler`
--

INSERT INTO `handler` (`hand_id`, `hand_first`, `hand_last`, `hand_mi`, `hand_address`, `hand_contact`, `hand_pic`, `bday`, `nickname`, `house_status`, `years`, `rent`, `occupation`, `salary`, `emp_address`, `spouse`, `spouse_no`, `spouse_emp`, `spouse_details`, `spouse_income`, `comaker`, `comaker_details`, `branch_id`, `hand_status`, `ci_remarks`, `ci_name`, `ci_date`, `photo`, `nid`, `cert`, `other_document`, `income`) VALUES
(1, 'MD.', 'Pasha', 'Kamal', '54/A Sonaton', '01919806114', '162903930355.jpg', '2018-03-10', 'santo', 'rent', '1', '54/A Sonat', 'Service', '15000', '54/A Sonaton ', 'Hini', '01919806114', '54/A Sonaton', '54/A Sonaton ', '15000.00', 'ahad', '54/A Sonaton', 1, 'Approved', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(2, 'ABDULLAH', 'Ahad', 'Al', '54/A Sonaton', '01919806114', 'ahad_main.jpg', '2018-03-19', 'Sohel', 'rent', '2', '', '', '', '', '', '', '', '', '0.00', '', '', 1, 'pending', '', '', '0000-00-00', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `history_log`
--

CREATE TABLE IF NOT EXISTS `history_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `history_log`
--

INSERT INTO `history_log` (`log_id`, `user_id`, `action`, `date`) VALUES
(7, 1, 'added 5 of GARNET', '2018-03-24 21:15:11'),
(8, 1, 'added 5 of AMETHYST', '2018-03-24 21:15:24'),
(9, 1, 'added 5 of EMERALD', '2018-03-24 21:15:58'),
(10, 1, 'added 5 of SAPPHIRE', '2018-03-24 21:16:13'),
(11, 1, 'added 5 of RUBY', '2018-03-24 21:16:31');

-- --------------------------------------------------------

--
-- Table structure for table `invoicecode`
--

CREATE TABLE IF NOT EXISTS `invoicecode` (
  `invcode_id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_year` varchar(100) NOT NULL,
  `inv_month` varchar(10) NOT NULL,
  `inv_day` varchar(10) NOT NULL,
  `inv_incre` int(50) NOT NULL,
  PRIMARY KEY (`invcode_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `invoicecode`
--

INSERT INTO `invoicecode` (`invcode_id`, `inv_year`, `inv_month`, `inv_day`, `inv_incre`) VALUES
(5, 'INV2018', '-03-', '24-', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inv_details`
--

CREATE TABLE IF NOT EXISTS `inv_details` (
  `invdet_id` int(11) NOT NULL AUTO_INCREMENT,
  `invcode` varchar(50) NOT NULL,
  `hand_id` int(11) NOT NULL,
  `total_order` int(11) NOT NULL,
  `inv_Hcost` decimal(10,2) NOT NULL,
  `inv_Tship_cost` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`invdet_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `inv_details`
--

INSERT INTO `inv_details` (`invdet_id`, `invcode`, `hand_id`, `total_order`, `inv_Hcost`, `inv_Tship_cost`, `date`, `branch_id`) VALUES
(5, 'INV2018-03-24-1', 1, 3, '100.00', '243.00', '2018-03-24 22:02:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ordercode`
--

CREATE TABLE IF NOT EXISTS `ordercode` (
  `ordercode_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_year` varchar(100) NOT NULL,
  `order_month` varchar(10) NOT NULL,
  `order_incre` int(50) NOT NULL,
  PRIMARY KEY (`ordercode_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `ordercode`
--

INSERT INTO `ordercode` (`ordercode_id`, `order_year`, `order_month`, `order_incre`) VALUES
(15, 'OR2018', '-03-', 1),
(16, 'OR2018', '-03-', 2),
(17, 'OR2018', '-03-', 3);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `payment_paid` decimal(10,2) NOT NULL,
  `payment_fund` decimal(10,2) NOT NULL,
  `trans_id` varchar(30) NOT NULL,
  `trans_date` datetime NOT NULL,
  `fund_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `item_qty` int(11) NOT NULL,
  `or_no` varchar(50) NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `cust_id`, `sales_id`, `payment_paid`, `payment_fund`, `trans_id`, `trans_date`, `fund_date`, `user_id`, `branch_id`, `date`, `item_qty`, `or_no`) VALUES
(15, 13, 15, '41.00', '0.00', '90U59843TW714514L', '2018-02-25 13:21:48', '0000-00-00', 1, 1, '2018-03-24 21:53:03', 2, 'OR2018-03-1'),
(16, 10, 16, '51.00', '49.52', '90U59843TW714514L', '2018-02-25 13:21:48', '0000-00-00', 1, 1, '2018-03-24 21:56:20', 2, 'OR2018-03-2'),
(17, 10, 17, '25.00', '0.00', '90U59843TW714514L', '2018-02-27 13:21:48', '0000-00-00', 1, 1, '2018-03-24 21:57:02', 1, 'OR2018-03-3');

-- --------------------------------------------------------

--
-- Table structure for table `prod_scheduled`
--

CREATE TABLE IF NOT EXISTS `prod_scheduled` (
  `sch_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_tname` varchar(300) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `prod_size` varchar(50) NOT NULL,
  `prod_weight` varchar(10) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `prod_color` varchar(30) NOT NULL,
  `prod_shape` varchar(10) NOT NULL,
  `prod_clarity` varchar(10) NOT NULL,
  `prod_luster` varchar(10) NOT NULL,
  `prod_hardness` varchar(10) NOT NULL,
  `prod_region` varchar(20) NOT NULL,
  `prod_treat` varchar(20) NOT NULL,
  `prod_price` decimal(10,2) NOT NULL,
  `prod_pic` varchar(300) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `ebay_sold_id` varchar(30) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `serial` varchar(50) NOT NULL,
  PRIMARY KEY (`sch_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `prod_scheduled`
--

INSERT INTO `prod_scheduled` (`sch_id`, `prod_tname`, `cat_id`, `prod_size`, `prod_weight`, `item_qty`, `prod_color`, `prod_shape`, `prod_clarity`, `prod_luster`, `prod_hardness`, `prod_region`, `prod_treat`, `prod_price`, `prod_pic`, `sales_id`, `ebay_sold_id`, `branch_id`, `supplier_id`, `serial`) VALUES
(6, '10 PIECES LOT AAA QUALITY NATURAL GARNET 7X9 MM OVAL FACETED CUT LOOSE GEMSTONE', 6, '5.0X3.0X2.0', '10', 10, 'Top Red', 'Oval', 'VVS-VS', 'Enchanting', '7-7.5', 'African', 'Unheated / Heated', '10.00', '162903930341.jpg', 0, '162917288640', 1, 3, 'PD2018-03-1'),
(7, '0.83 CT UNIQUE COLLECTION ! STUNNING FIRE NATURAL COLOMBIAN EMERALD', 5, '5.0X3.0X2.0', '10', 1, 'Lime Green', 'Oval', 'VVS-VS', 'Enchanting', '7-7.5', 'Colombian', 'Colorless Oil', '20.00', '162903930342.jpg', 0, '162917288654', 1, 3, 'PD2018-03-2'),
(8, '3X3MM TO 8X8MM NATURAL PURPLE AMETHYST SQUARE CUT FACETED LOOSE GEMSTONE', 1, '11.0 X 5.9 X 4.0', '10', 10, 'Sky Blue', 'Square', 'VVS-VS', 'Enchanting', '7-7.5', 'Ceylon', 'Unheated / Heated', '10.00', '162903930343.jpg', 0, '0', 1, 3, 'PD2018-03-3'),
(9, '10.00Ct.Precious Gem&Good Quality Natural HUGE Top Red Pink Ruby Mozambique', 11, '5.0X3.0X2.0', '10', 1, 'Win Blood Red', 'Oval', 'VVS-VS', 'Enchanting', '9', 'African', 'Unheated / Heated', '20.00', '162903930354.jpg', 0, '162917288654', 1, 1, 'PD2018-03-4'),
(10, '9.15CT.11.0X11.0X7.9 MM KASHMIR! UNHEATED WHITE SAPPHIRE LOOSE GEM MADAGASCA', 12, '3.6 X 6.0', '10', 1, 'Sky Blue', 'Princess', 'VVS-VS', 'Enchanting', '9', 'Ceylon', 'Unheated / Heated', '20.00', '22.jpg', 0, '162917288656', 1, 2, 'PD2018-03-5'),
(11, '0.57 ct Natural AFRICA BLUE Sapphire OVAL 1 Piece Loose Stone', 12, '5.0X3.0X2.0', '10', 1, 'Sky Blue', 'Oval', 'VVS-VS', 'Enchanting', '9', 'Ceylon', 'Unheated / Heated', '20.00', '162914221512.jpg', 0, '0', 1, 3, 'PD2018-03-6'),
(12, '0.76CTS Mind blowing-100% natural Unheated White sapphire-loose gemstone', 12, '3.5 X 2.8', '10', 1, 'Sky Blue', 'Round', 'VVS-VS', 'Enchanting', '7-7.5', 'Ceylon', 'Unheated / Heated', '20.00', '162903930356.jpg', 0, '162917288652', 1, 4, 'PD2018-03-7'),
(13, '10.0 CT UNIQUE COLLECTION ! STUNNING FIRE NATURAL COLOMBIAN EMERALD', 5, '5.0X3.0X2.0', '10', 1, 'Lime Green', 'Oval', 'VVS-VS', 'Enchanting', '7-7.5', 'Ceylom', 'Colorless Oil', '20.00', '162903793895.jpg', 0, '0', 1, 2, 'PD2018-03-8'),
(14, '8.75 CT UNIQUE COLLECTION ! STUNNING FIRE NATURAL COLOMBIAN EMERALD', 5, '11.0X5.9X4.0', '8.75', 1, 'Lime Green', 'Round', 'VVS-VS', 'Enchanting', '7-7.5', 'Colombian', 'Colorless Oil', '20.00', '162903891621.jpg', 0, '0', 1, 2, 'PD2018-03-9'),
(15, '5 PIECES LOT AAA QUALITY NATURAL GARNET 7X9 MM OVAL FACETED CUT LOOSE GEMSTONE', 6, '11.0X5.9X4.0', '2.33', 5, 'Win Red', 'Round', 'VVS-VS', 'Enchanting', '7-7.5', 'African', 'Unheated / Heated', '10.00', '162903935217.jpg', 0, '0', 1, 2, 'PD2018-03-10'),
(16, '7.75Ct.Precious Gem&Good Quality Natural HUGE Top Red Pink Ruby Mozambique', 11, '5.0X3.0X2.0', '10', 1, 'Win Blood Red', 'Round', 'VVS-VS', 'Enchanting', '7-7.5', 'Ceylon', 'Unheated / Heated', '10.00', '162903935215.jpg', 0, '0', 1, 4, 'PD2018-03-11');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `sales_id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sales_price` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `ship_fee` decimal(10,2) NOT NULL,
  `ship_file` varchar(300) NOT NULL,
  `ship_cost` decimal(10,2) NOT NULL,
  `invcode` varchar(50) NOT NULL,
  `date_added` datetime NOT NULL,
  `branch_id` int(11) NOT NULL,
  `total_paid` decimal(10,2) NOT NULL,
  PRIMARY KEY (`sales_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `cust_id`, `user_id`, `sales_price`, `discount`, `ship_fee`, `ship_file`, `ship_cost`, `invcode`, `date_added`, `branch_id`, `total_paid`) VALUES
(15, 13, 1, '30.00', '0.00', '11.00', '332.jpg', '98.00', 'INV2018-03-24-1', '2018-03-24 21:53:03', 1, '41.00'),
(16, 10, 1, '40.00', '0.00', '11.00', '332.jpg', '95.00', 'INV2018-03-24-1', '2018-03-24 21:56:20', 1, '51.00'),
(17, 10, 1, '18.00', '2.00', '7.00', '335.jpg', '50.00', 'INV2018-03-24-1', '2018-03-24 21:57:02', 1, '25.00');

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

CREATE TABLE IF NOT EXISTS `sales_details` (
  `sales_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `invcode` varchar(50) NOT NULL,
  `sch_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`sales_details_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `sales_details`
--

INSERT INTO `sales_details` (`sales_details_id`, `sales_id`, `payment_id`, `invcode`, `sch_id`, `price`, `branch_id`) VALUES
(22, 15, 15, 'INV2018-03-24-1', 6, '10.00', 1),
(23, 15, 15, 'INV2018-03-24-1', 7, '20.00', 1),
(24, 16, 16, 'INV2018-03-24-1', 10, '20.00', 1),
(25, 16, 16, 'INV2018-03-24-1', 12, '20.00', 1),
(26, 17, 17, 'INV2018-03-24-1', 9, '20.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stockin`
--

CREATE TABLE IF NOT EXISTS `stockin` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `reorder` int(11) NOT NULL,
  `pre_reorder` int(11) NOT NULL,
  `prod_status` int(11) NOT NULL,
  `sold_status` int(11) NOT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `stockin`
--

INSERT INTO `stockin` (`prod_id`, `cat_id`, `prod_qty`, `branch_id`, `reorder`, `pre_reorder`, `prod_status`, `sold_status`) VALUES
(9, 6, 5, 1, 5, 0, 2, 1),
(10, 1, 5, 1, 5, 0, 1, 0),
(11, 5, 5, 1, 5, 0, 3, 1),
(12, 12, 5, 1, 5, 0, 3, 1),
(13, 11, 5, 1, 5, 0, 2, 1),
(14, 8, 0, 1, 2, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stockin_details`
--

CREATE TABLE IF NOT EXISTS `stockin_details` (
  `stockin_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `qty` int(6) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL,
  `branch_id` int(11) NOT NULL,
  `serial` varchar(50) NOT NULL,
  PRIMARY KEY (`stockin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `stockin_details`
--

INSERT INTO `stockin_details` (`stockin_id`, `cat_id`, `supplier_id`, `qty`, `weight`, `price`, `date`, `branch_id`, `serial`) VALUES
(10, 6, 4, 5, '10.00', '10.00', '2018-03-24 21:15:11', 1, '11'),
(11, 1, 5, 5, '10.00', '10.00', '2018-03-24 21:15:24', 1, '12'),
(12, 5, 2, 5, '10.00', '100.00', '2018-03-24 21:15:58', 1, '13'),
(13, 12, 3, 5, '10.00', '100.00', '2018-03-24 21:16:13', 1, '14'),
(14, 11, 2, 5, '10.00', '100.00', '2018-03-24 21:16:31', 1, '15');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_address` varchar(300) NOT NULL,
  `supplier_contact` varchar(50) NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_contact`) VALUES
(1, 'Jkj & Sons Jewellers', ' D- 231, Amarpali Marg, Vaishali Nagar, Jaipur - 302021, Near Kotak Mahindra Bank ', '+9829065229'),
(2, 'Birdhichand Ghanshyamdas Jewellers', ' 9, Lakshmii Complex, M I Road, Jaipur - 302001 ', '+9821265922'),
(3, 'Tanishq', ' Kashi Bhawan, M I Road, Jaipur - 302001, Near Panch Battii', '+919829011014'),
(4, ' Kanak Jewellers', ' 304-305, Lane No-1, Raja Park, Jaipur - 302004, Behind Hotel Ramada ', '+199001618000'),
(5, ' Shoppers Stop', 'World Trade Park, 2nd Floor, Street Number-1, Jawahar Lal Nehru Marg, Malviya Nagar, Jaipur - 302017, South Block ', '+18002096648');

-- --------------------------------------------------------

--
-- Table structure for table `temp_trans`
--

CREATE TABLE IF NOT EXISTS `temp_trans` (
  `temp_trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `sch_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`temp_trans_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `temp_trans`
--


-- --------------------------------------------------------

--
-- Table structure for table `term`
--

CREATE TABLE IF NOT EXISTS `term` (
  `term_id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_id` int(11) DEFAULT NULL,
  `payable_for` varchar(10) NOT NULL,
  `term` varchar(11) NOT NULL,
  `due` decimal(10,2) NOT NULL,
  `payment_start` date NOT NULL,
  `down` decimal(10,2) NOT NULL,
  `due_date` date NOT NULL,
  `interest` decimal(10,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`term_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `term`
--


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `name`, `status`, `branch_id`) VALUES
(1, 'admin', 'a1Bz20ydqelm8m1wql21232f297a57a5a743894a0e4a801fc3', 'Mohammad Uzzal Mollah', 'active', 1),
(4, 'user01', 'a1Bz20ydqelm8m1wqlb75705d7e35e7014521a46b532236ec3', 'MD. Nazmul Haque', 'active', 2),
(5, 'user02', 'a1Bz20ydqelm8m1wql8bd108c8a01a892d129c52484ef97a0d', 'Abdullah Al Ahad', 'active', 3),
(6, 'administrator', 'a1Bz20ydqelm8m1wql200ceb26807d6bf99fd6f4f0d1ca54d4', 'Rajib Rakhmit', 'active', 0),
(7, 'user03', 'a1Bz20ydqelm8m1wqla7d39043afa25be5cc235d943b64917a', 'Amit Mod', 'active', 4),
(8, 'admin456', 'a1Bz20ydqelm8m1wql1a145a23d6e47aadfe2063f1f951e691', 'Murad', 'active', 2);
