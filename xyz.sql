-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 26, 2011 at 08:01 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `xyz`
--

-- --------------------------------------------------------

--
-- Table structure for table `xyz_orders`
--

CREATE TABLE IF NOT EXISTS `xyz_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(5) NOT NULL,
  `total_price` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `pincode` char(6) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `ref_key` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `xyz_orders`
--

INSERT INTO `xyz_orders` (`id`, `prod_id`, `user_id`, `price`, `quantity`, `total_price`, `status`, `name`, `address`, `city`, `state`, `pincode`, `phone`, `ref_key`, `created`, `modified`, `modified_by`) VALUES
(1, 4, 8, 10359, 3, 31077, 'processing', 'test08', 'test 08 add', 'test 08 city', 'Kerala', '123444', '2123444447', '359178', '2011-09-14 17:35:53', '2011-09-14 17:35:53', 8),
(2, 11, 8, 29990, 2, 59980, 'processing', 'test08', 'test 08 add', 'test 08 city', 'Kerala', '123444', '2123444447', '359178', '2011-09-14 17:36:30', '2011-09-14 17:36:30', 8),
(3, 5, 8, 4423, 2, 8846, 'processing', 'test08', 'test 08 add', 'test 08 city', 'Kerala', '123444', '2123444447', '359178', '2011-09-14 17:36:55', '2011-09-14 17:36:55', 8),
(4, 14, 8, 8999, 5, 44995, 'processing', 'test08', 'test 08 add', 'test 08 city', 'Kerala', '123444', '2123444447', '359178', '2011-09-14 17:37:22', '2011-09-14 17:37:22', 8),
(5, 19, 8, 1900, 2, 3800, 'processing', 'test08', 'test 08 add', 'test 08 city', 'Kerala', '123444', '2123444447', '359178', '2011-09-14 17:38:36', '2011-09-14 17:38:36', 8);

-- --------------------------------------------------------

--
-- Table structure for table `xyz_products`
--

CREATE TABLE IF NOT EXISTS `xyz_products` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(50) DEFAULT NULL,
  `model_name` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `description` longtext,
  `thumbnail` varchar(200) DEFAULT NULL,
  `full_image` varchar(2000) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `xyz_products`
--

INSERT INTO `xyz_products` (`prod_id`, `vendor_name`, `model_name`, `price`, `description`, `thumbnail`, `full_image`, `created`, `modified`) VALUES
(1, 'Samsung', 'Samsung Galaxy S I9000 (Metallic Black)', 19999, 'Android V2.2 (Froyo) OS\r\n4 Inch Super AMOLED Touchscreen\r\n5 MP Primary Camera\r\n0.3 MP Secondary Camera\r\nARM Cortex A8 1 GHz Processor\r\nHD Recording\r\nExpandable Storage Capacity Of 32 GB', 'samsung-galaxy-s-i9000-125x125-imadfq7akrv3ygth.jpeg', 'samsung-galaxy-s-i9000-275x275-imadfq7akrv3ygth.jpeg', '2011-09-09 23:06:54', '2011-09-09 23:06:54'),
(2, 'Samsung', 'Samsung Galaxy S 2 I9100 (Noble Black)', 29999, 'Android V2.3 (Gingerbread) OS\r\n4.27-inch Super AMOLED Plus Touchscreen\r\n8 MP Primary Camera\r\n2 MP Secondary Camera\r\nARM Cortex A9 1.2 GHz Dual Core Processor\r\nFull HD Recording(1080p)\r\nExpandable Storage Capacity Of 32 GB', 'samsung-galaxy-s2-i9100-125x125-imacyyh9tgvpnmha.jpeg', 'samsung-galaxy-s2-i9100-275x275-imacyyh9tgvpnmha.jpeg', '2011-09-09 23:11:27', '2011-09-09 23:11:27'),
(3, 'Samsung', 'Samsung Galaxy Ace S5830 (Black) ', 13900, 'Android V2.2 (Froyo) OS\r\n3.5-inch TFT Touchscreen\r\n5 MP Primary Camera\r\nARM 11 800 MHz Processor\r\nExpandable Storage Capacity Of 32 GB\r\nTouchWiz 3.0\r\nDocument Editor', 'samsung-galaxy-ace-s5830-125x125-imacygyzj46ckxuz.jpeg', 'samsung-galaxy-ace-s5830-275x275-imacygyzj46ckxuz.jpeg', '2011-09-09 23:13:53', '2011-09-09 23:13:53'),
(4, 'Samsung', 'Samsung Galaxy Fit S5670 (Metallic Black)', 10359, 'Android V2.2 (Froyo) OS\r\n3.31-inch TFT Touchscreen\r\n5 MP Primary Camera\r\n600 MHz Processor\r\nExpandable Storage Capacity Of 32 GB\r\nTouchWiz 3.0\r\nSocial Networking', 'samsung-galaxy-fit-s5670-125x125-imadfqa6unv4hs2v.jpeg', 'samsung-galaxy-fit-s5670-275x275-imadfqa6unv4hs2v.jpeg', '2011-09-09 23:16:32', '2011-09-09 23:16:32'),
(5, 'Nokia', 'Nokia C2-03 Touch and Type (Black)', 4423, 'Nokia Series 40 OS\r\n2.6 Inch TFT Touchscreen\r\n2 MP Primary Camera\r\nDual SIM (GSM + GSM)\r\nGPRS And EDGE Enabled\r\nFM Radio With Recording\r\nExpandable Storage Capacity Of 32 GB', 'nokia-c2-03-125x125-imadyyhfktvfcsdw.jpeg', 'nokia-c2-03-275x275-imadyyhfktvfcsdw.jpeg', '2011-09-09 23:18:17', '2011-09-09 23:18:17'),
(6, 'Nokia', 'Nokia C2-02 Touch and Type (White)', 3847, 'Nokia Series 40 OS\r\n 2.6 Inch TFT Touchscreen\r\n 2 MP Primary Camera\r\n GPRS And EDGE Enabled\r\n FM Radio With Recording\r\n Expandable Storage Capacity Of 32 GB', 'nokia-c2-02-125x125-imadyygghkhxe2dp.jpeg', 'nokia-c2-02-275x275-imadyygghkhxe2dp.jpeg', '2011-09-09 23:20:16', '2011-09-09 23:20:16'),
(7, 'BlackBerry', 'BlackBerry Curve 8520 (Black)', 8999, 'BlackBerry OS\r\n2 MP Primary Camera\r\n2.4 Inch LCD Display\r\n512 MHz Processor\r\nTouch Sensitive Optical Trackpad\r\nWi-Fi Enabled\r\nExpandable Storage Capacity Of 32 GB', 'blackberry-curve-8520-125x125-imacygyz8zn9sxgr.jpeg', 'blackberry-curve-8520-275x275-imacygyz8zn9sxgr.jpeg', '2011-09-09 23:23:51', '2011-09-09 23:23:51'),
(8, 'BlackBerry', 'BlackBerry Curve 8520 (Red)', 8999, 'BlackBerry OS\r\n2 MP Primary Camera\r\n2.4 Inch LCD Display\r\n512 MHz Processor\r\nTouch Sensitive Optical Trackpad\r\nWi-Fi Enabled\r\nExpandable Storage Capacity Of 32 GB', 'blackberry-8520-125x125-imadfjxbatubgjea.jpeg', 'blackberry-8520-275x275-imadfjxbatubgjea.jpeg', '2011-09-09 23:25:31', '2011-09-09 23:25:31'),
(9, 'Nokia', 'Nokia C1-02 (Black) ', 1699, 'Symbian Series 40 OS\r\n 1.8 Inch TFT Screen\r\n Alphanumeric Keypad\r\n GPRS Enabled\r\n FM Radio With Recording\r\n Expandable Storage Capacity Of 32 GB', 'nokia-c1-02-125x125-imadfvyz25hzhnu7.jpeg', 'nokia-c1-02-275x275-imadfvyz25hzhnu7.jpeg', '2011-09-14 13:49:41', '2011-09-14 13:49:41'),
(10, 'BlackBerry', 'BlackBerry Curve 3G 9300 (Grey) ', 13499, '    BlackBerry V5.0 OS\r\n    2.4 Inch LCD Screen\r\n    2 MP Camera\r\n    Wi-Fi Enabled\r\n    Pushmail Support\r\n    Social Networking Access\r\n    Expandable Storage Capacity Of 32 GB\r\n\r\n', 'blackberry-curve-3g-9300-125x125-imadf8hhkbq3qabf.jpeg', 'blackberry-curve-3g-9300-275x275-imadf8hhkbq3qabf.jpeg', '2011-09-14 17:06:28', '2011-09-14 17:06:28'),
(11, 'BlackBerry', 'BlackBerry Torch 9810 (Zinc Grey) ', 29990, '    BlackBerry 7 OS\r\n    3.2 Inch TFT LCD Capacitive Touchscreen\r\n    5 MP Primary Camera\r\n    HD Recording\r\n    QWERTY Keypad\r\n    Wi-Fi Enabled\r\n    Expandable Storage Capacity Of 32 GB\r\n\r\n', 'blackberry-torch-9810-125x125-imadfhrprwca5ge4.jpeg', 'blackberry-torch-9810-275x275-imadfhrprwca5ge4.jpeg', '2011-09-14 17:11:57', '2011-09-14 17:11:57'),
(12, 'BlackBerry', 'BlackBerry 9670 (Reliance)', 18414, '    BlackBerry OS\r\n    TFT LCD Screen\r\n    5 MP Primary Camera\r\n    Expandable Storage Capacity Of 32 GB\r\n    Built-in GPS Functionality\r\n    Wi-Fi Enabled\r\n\r\n', 'blackberry-style-9670-reliance-125x125-imacytf2wae9jk9q.jpeg', 'blackberry-style-9670-reliance-275x275-imacytf2wae9jk9q.jpeg', '2011-09-14 17:13:22', '2011-09-14 17:13:22'),
(13, 'BlackBerry', 'BlackBerry Curve 3G 9300 (Pink) ', 13499, '    BlackBerry V5.0 OS\r\n    2.4 Inch LCD Screen\r\n    2 MP Camera\r\n    Wi-Fi Enabled\r\n    Pushmail Support\r\n    Social Networking Access\r\n    Expandable Storage Capacity Of 32 GB\r\n\r\n', 'blackberry-curve-3g-9300-125x125-imadfykrdmnf4uds.jpeg', 'blackberry-curve-3g-9300-275x275-imadfykrdmnf4uds.jpeg', '2011-09-14 17:14:27', '2011-09-14 17:14:27'),
(14, 'BlackBerry', 'BlackBerry Curve 8520 (Purple) ', 8999, '    BlackBerry OS\r\n    2 MP Primary Camera\r\n    2.4 Inch LCD Display\r\n    512 MHz Processor\r\n    Touch Sensitive Optical Trackpad\r\n    Wi-Fi Enabled\r\n    Expandable Storage Capacity Of 32 GB\r\n\r\n', 'blackberry-8520-125x125-imadfw9cscq3z5at.jpeg', 'blackberry-8520-275x275-imadfw9cscq3z5at.jpeg', '2011-09-14 17:18:55', '2011-09-14 17:18:55'),
(15, 'Nokia', 'Nokia X1-01 (Dark Grey) ', 1826, '    Dual Standby SIM (GSM + GSM)\r\n    1.8 Inch TFT Screen\r\n    Alphanumeric Keypad\r\n    FM Radio\r\n    Expandable Storage Capacity Of 16 GB\r\n\r\n', 'nokia-x1-01-125x125-imaczp5puvcgrptp.jpeg', 'nokia-x1-01-275x275-imaczp5puvcgrptp.jpeg', '2011-09-14 17:24:38', '2011-09-14 17:24:38'),
(16, 'Nokia', 'Nokia X2-01 (Graphite) ', 3600, '    2.4 Inch TFT Screen\r\n    0.3 MP Primary Camera\r\n    QWERTY Keypad\r\n    FM Radio\r\n    GPRS And EDGE Enabled\r\n    Expandable Storage Capacity Of 8 GB\r\n\r\n', 'nokia-x2-01-125x125-imadf7y5aay4fkkq.jpeg', 'nokia-x2-01-275x275-imadf7y5aay4fkkq.jpeg', '2011-09-14 17:25:51', '2011-09-14 17:25:51'),
(17, 'Nokia', 'Nokia C1-01 (White) ', 2173, 'Key Features\r\n\r\n    Symbian Series 40 OS\r\n    1.8 Inch TFT Screen\r\n    Alphanumeric Keypad\r\n    GPRS Enabled\r\n    FM Radio With Recording\r\n    Expandable Storage Capacity Of 32 GB\r\n\r\n', 'nokia-c1-01-125x125-imadfw4rkfweuazu.jpeg', 'nokia-c1-01-275x275-imadfw4rkfweuazu.jpeg', '2011-09-14 17:27:08', '2011-09-14 17:27:08'),
(18, 'Samsung', 'Samsung Guru E1085T (Blue) ', 1040, '    2G Network Support\r\n    1.43-inch Screen\r\n    Alphanumeric Keypad\r\n    GPRS Enabled\r\n    FM Radio\r\n\r\n', 'samsung-guru-e1085t-125x125-imad22twv9p5zvrd.jpeg', 'samsung-guru-e1085t-275x275-imad22twv9p5zvrd.jpeg', '2011-09-14 17:31:25', '2011-09-14 17:31:25'),
(19, 'Samsung', 'Samsung Hero E2230 (Black) ', 1900, '    2G Network Support\r\n    1.77-inch TFT Screen\r\n    Alphanumeric Keypad\r\n    GPRS Enabled\r\n    FM Radio With Recording\r\n    Expandable Storage Capacity Of 8 GB\r\n    Document Viewer\r\n\r\n', 'samsung-hero-e2230-125x125-imadfjweb54hyqkz.jpeg', 'samsung-hero-e2230-275x275-imadfjweb54hyqkz.jpeg', '2011-09-14 17:32:30', '2011-09-14 17:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `xyz_users`
--

CREATE TABLE IF NOT EXISTS `xyz_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `security_question` varchar(50) NOT NULL,
  `answer` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(2000) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `pincode` char(6) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_id` (`email_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `xyz_users`
--

INSERT INTO `xyz_users` (`id`, `username`, `email_id`, `password`, `security_question`, `answer`, `name`, `address`, `city`, `state`, `pincode`, `phone`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 'test01', 'test01@gmail.com', '$1$g5/.pa1.$YJOyC9gdbCbK.0X004Vms.', 'whats ur name?', 'test', '', '', '', '', '', '', '2011-08-28 00:42:02', NULL, NULL, NULL),
(2, 'test02', 'test02@gmail.com', '$1$al2.bi2.$2PtzDxEO1s3npMHMKKaiF.', 'wats ur name', 'test02', '', '', '', '', '', '', '2011-08-28 10:28:19', 2, '0000-00-00 00:00:00', 2),
(3, 'test03', 'test03@gmail.com', '$1$yd3.Tj/.$HoV9rxrS7OnXDJD/HiZXh/', 'whats ur name?', 'test03', '', '', '', '', '', '', '2011-08-28 10:34:36', 3, '2011-08-28 10:34:36', 3),
(4, 'test04', 'test04@gmail.com', '%BC%F2%E24', 'wats ur name?', 'test04', '', '', '', '', '', '', '2011-08-28 11:42:06', 4, '2011-08-28 11:42:06', 4),
(5, 'test05', 'test05@gmail.com', '%BC%F2%E24', 'whats ur name?', 'test05', '04name', '04address', 'o4 city', 'Andaman and Nicobar Islands', '123444', '3333333333', '2011-08-28 19:00:24', 5, '2011-09-14 12:49:43', 5),
(6, 'test06', 'test06@gmail.com', '%BC%F2%E24', 'wats ur name?', 'test06', '', '', '', '', '', '', '2011-09-03 23:25:01', 6, '2011-09-03 23:25:01', 6),
(7, 'AdminLogin', 'admin123@xyz.com', '%A9%F3%FC%29%25%7C%D8%B7', 'what is the colour of cat?', 'violet', '', '', '', '', '', '', '2011-09-05 21:30:08', 7, '2011-09-05 21:30:08', 7),
(8, 'test08', 'test08@gmail.com', '%BC%F2%E24%7Bu', 'wat is your name?', 'test08', 'test08', 'test 08 add', 'test 08 city', 'Kerala', '123444', '2123444447', '2011-09-14 17:34:26', 8, '2011-09-14 17:35:32', 8);
