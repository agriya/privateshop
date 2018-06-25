-- phpMyAdmin SQL Dump
-- version 2.11.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 22, 2011 at 12:46 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `privateshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
CREATE TABLE IF NOT EXISTS `attachments` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `class` varchar(100) collate utf8_unicode_ci default NULL,
  `foreign_id` bigint(20) unsigned NOT NULL,
  `filename` varchar(255) collate utf8_unicode_ci default NULL,
  `dir` varchar(100) collate utf8_unicode_ci default NULL,
  `mimetype` varchar(100) collate utf8_unicode_ci default NULL,
  `filesize` bigint(20) default NULL,
  `height` bigint(20) default NULL,
  `width` bigint(20) default NULL,
  `thumb` tinyint(1) default NULL,
  `description` text collate utf8_unicode_ci,
  PRIMARY KEY  (`id`),
  KEY `foreign_id` (`foreign_id`),
  KEY `class` (`class`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Attachment Details';

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `created`, `modified`, `class`, `foreign_id`, `filename`, `dir`, `mimetype`, `filesize`, `height`, `width`, `thumb`, `description`) VALUES
(1, '2009-05-11 20:15:24', '2009-05-11 20:15:24', 'UserAvatar', 0, 'default_avatar.jpg', 'UserAvatar/0', 'image/jpeg', 1087, 50, 50, NULL, ''),
(2, '2009-05-11 20:16:34', '2009-05-11 20:16:34', 'Product', 0, 'default_product.png', 'Product/0', 'image/png', 40493, 360, 360, NULL, ''),
(3, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 'Product', 1, '3d Lenscape.jpg', 'Product/1', 'image/jpeg', 116389, 898, 1024, NULL, '3d Lenscape'),
(4, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 'Product', 2, 'Adidas Mens Zeitfrei FitFOAM.jpg', 'Product/2', 'image/jpeg', 20603, 500, 500, NULL, 'Adidas Mens Zeitfrei FitFOAM'),
(5, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 'Product', 3, 'Air conditionar 5star.jpg', 'Product/3', 'image/jpeg', 50864, 900, 900, NULL, 'Air conditionar 5star'),
(6, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 'Product', 4, 'Apple Music Products.jpg', 'Product/4', 'image/jpeg', 96234, 428, 585, NULL, 'Apple Music Products'),
(7, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 'Product', 5, 'Audo Sound System.jpg', 'Product/5', 'image/jpeg', 31796, 389, 510, NULL, 'Audo Sound System'),
(8, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 'Product', 6, 'Automatic Washer.jpg', 'Product/6', 'image/jpeg', 27092, 360, 360, NULL, 'Automatic Washer'),
(9, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 'Product', 7, 'Basketball Foldable Shopping Bag.jpg', 'Product/7', 'image/jpeg', 37932, 500, 500, NULL, 'Basketball Foldable Shopping Bag'),
(10, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 'Product', 8, 'Beatiful guitar with offer.jpg', 'Product/8', 'image/jpeg', 28290, 300, 650, NULL, 'Beatiful guitar with offer'),
(11, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 'Product', 9, 'Beats By Reaudio.jpg', 'Product/9', 'image/jpeg', 56201, 487, 488, NULL, 'Beats By Reaudio'),
(12, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 'Product', 10, 'Beetle car.jpg', 'Product/10', 'image/jpeg', 152355, 618, 791, NULL, 'Beetle car'),
(13, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 'Product', 11, 'Belly Buddy Exerciser.jpg', 'Product/11', 'image/jpeg', 29648, 361, 418, NULL, 'Belly Buddy Exerciser'),
(14, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 'Product', 12, 'BtyProduct.jpg', 'Product/12', 'image/jpeg', 23563, 300, 300, NULL, 'BtyProduct'),
(15, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 'Product', 13, 'Cinemascope LCD Tv.jpg', 'Product/13', 'image/jpeg', 85171, 373, 400, NULL, 'Cinemascope LCD Tv'),
(16, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 'Product', 14, 'Colorful Thread.jpg', 'Product/14', 'image/jpeg', 98523, 400, 400, NULL, 'Colorful Thread'),
(17, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 'Product', 15, 'Compaq Presario Desktop.jpg', 'Product/15', 'image/jpeg', 216364, 846, 1024, NULL, 'Compaq Presario Desktop'),
(18, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 'Product', 16, 'Dell XPS M1330 Product Red.jpg', 'Product/16', 'image/jpeg', 33504, 389, 600, NULL, 'Dell XPS M1330 Product Red'),
(19, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 'Product', 17, 'Everywhere Fram.jpg', 'Product/17', 'image/jpeg', 40766, 460, 360, NULL, 'Everywhere Fram'),
(20, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 'Product', 18, 'Fancy Butterfly Bag.JPG', 'Product/18', 'image/jpeg', 57838, 660, 660, NULL, 'Fancy Butterfly Bag.JPG'),
(21, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 'Product', 19, 'Flip obronze wind chime white.jpg', 'Product/19', 'image/jpeg', 34781, 500, 500, NULL, 'Flip obronze wind chime white'),
(22, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 'Product', 20, 'Folding Shopping Basket.jpg', 'Product/20', 'image/jpeg', 29040, 575, 505, NULL, 'Folding Shopping Basket'),
(23, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 'Product', 21, 'Hd Duplicator.jpg', 'Product/21', 'image/jpeg', 28234, 250, 249, NULL, 'Hd Duplicator'),
(24, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 'Product', 22, 'HP Desktop PC.jpg', 'Product/22', 'image/jpeg', 28878, 400, 400, NULL, 'HP Desktop PC'),
(25, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 'Product', 23, 'I Love Shopping T-Shirt.jpg', 'Product/23', 'image/jpeg', 23256, 400, 400, NULL, 'I Love Shopping T-Shirt'),
(26, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 'Product', 24, 'Iphone 4.jpg', 'Product/24', 'image/jpeg', 37671, 305, 335, NULL, 'Iphone 4'),
(27, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 'Product', 25, 'Karen Prodcuts.jpg', 'Product/25', 'image/jpeg', 73861, 400, 600, NULL, 'Karen Prodcuts'),
(28, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 'Product', 26, 'Lioele Products.jpg', 'Product/26', 'image/jpeg', 96182, 477, 640, NULL, 'Lioele Products'),
(29, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 'Product', 27, 'Lupe Fiasco Whiete.jpg', 'Product/27', 'image/jpeg', 54850, 415, 630, NULL, 'Lupe Fiasco Whiete'),
(30, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 'Product', 28, 'Lupe Fiasco.jpg', 'Product/28', 'image/jpeg', 35671, 331, 500, NULL, 'Lupe Fiasco'),
(31, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 'Product', 29, 'Mauel Dairy Products.JPG', 'Product/29', 'image/jpeg', 103434, 523, 770, NULL, 'Mauel Dairy Products.JPG'),
(32, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 'Product', 30, 'Mens Two-Fold with Double ID Flap.jpg', 'Product/30', 'image/jpeg', 10762, 360, 360, NULL, 'Men''s Two-Fold with Double ID Flap'),
(33, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 'Product', 31, 'Mini Leather Jewelry Case.jpg', 'Product/31', 'image/jpeg', 12168, 360, 360, NULL, 'Mini Leather Jewelry Case'),
(34, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 'Product', 32, 'Noisettes Products.jpg', 'Product/32', 'image/jpeg', 84223, 400, 600, NULL, 'Noisettes Products'),
(35, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 'Product', 33, 'Palm Chair.jpg', 'Product/33', 'image/jpeg', 24054, 490, 418, NULL, 'Palm Chair'),
(36, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 'Product', 34, 'Panda Guitar.jpg', 'Product/34', 'image/jpeg', 23302, 369, 262, NULL, 'Panda Guitar'),
(37, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 'Product', 35, 'Sassy Shopping Bags.jpg', 'Product/35', 'image/jpeg', 20431, 360, 460, NULL, 'Sassy Shopping Bags'),
(38, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 'Product', 36, 'Sony Handycam.jpg', 'Product/36', 'image/jpeg', 21812, 404, 606, NULL, 'Sony Handycam'),
(39, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 'Product', 37, 'Stress Free Searting.jpg', 'Product/37', 'image/jpeg', 33408, 1000, 900, NULL, 'Stress Free Searting'),
(40, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 'Product', 38, 'Stress Free Seating model 4010.jpg', 'Product/38', 'image/jpeg', 36380, 685, 685, NULL, 'Stress Free Seating model #4010'),
(41, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 'Product', 39, 'Sweetheart Box.jpg', 'Product/39', 'image/jpeg', 9976, 360, 360, NULL, 'Sweetheart Box'),
(42, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 'Product', 40, 'Touchmart PC.jpg', 'Product/40', 'image/jpeg', 14742, 328, 350, NULL, 'Touchmart PC'),
(43, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 'Product', 41, 'UPS Series.jpg', 'Product/41', 'image/jpeg', 22652, 406, 681, NULL, 'UPS Series'),
(44, '2011-09-23 06:49:38', '2011-09-23 06:49:38', 'Product', 42, 'USB Mini Fridge.jpg', 'Product/42', 'image/jpeg', 17361, 450, 470, NULL, 'USB Mini Fridge'),
(45, '2011-09-23 06:49:38', '2011-09-23 06:49:38', 'Product', 43, 'Washing machine drum.jpg', 'Product/43', 'image/jpeg', 35310, 500, 440, NULL, 'Washing machine drum'),
(46, '2011-09-23 06:49:38', '2011-09-23 06:49:38', 'Product', 44, 'Zynga Poker Chips.jpg', 'Product/44', 'image/jpeg', 24439, 379, 400, NULL, 'Zynga Poker Chips');

-- --------------------------------------------------------

--
-- Table structure for table `banned_ips`
--

DROP TABLE IF EXISTS `banned_ips`;
CREATE TABLE IF NOT EXISTS `banned_ips` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `address` varchar(255) collate utf8_unicode_ci NOT NULL,
  `range` varchar(255) collate utf8_unicode_ci NOT NULL,
  `referer_url` varchar(255) collate utf8_unicode_ci NOT NULL,
  `reason` varchar(255) collate utf8_unicode_ci NOT NULL,
  `redirect` varchar(255) collate utf8_unicode_ci NOT NULL,
  `thetime` int(15) NOT NULL,
  `timespan` int(15) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `address` (`address`),
  KEY `range` (`range`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Banned IPs Details';

--
-- Dumping data for table `banned_ips`
--


-- --------------------------------------------------------

--
-- Table structure for table `cake_sessions`
--

DROP TABLE IF EXISTS `cake_sessions`;
CREATE TABLE IF NOT EXISTS `cake_sessions` (
  `id` varchar(255) collate utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL default '0',
  `data` longtext collate utf8_unicode_ci,
  `expires` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Cake Session Details';

--
-- Dumping data for table `cake_sessions`
--


-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `session_id` varchar(255) collate utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `credits` int(10) default NULL,
  `is_send_as_gift` tinyint(1) NOT NULL default '0',
  `gift_friend_email` varchar(255) collate utf8_unicode_ci NOT NULL,
  `gift_wrap_note` text collate utf8_unicode_ci,
  `user_address_id` bigint(20) default '0',
  `is_gift_wrap` tinyint(1) NOT NULL default '0',
  `price` double(10,2) NOT NULL,
  `shipping_price` double(10,2) NOT NULL,
  `total_price` double(10,2) NOT NULL,
  `is_available` tinyint(1) NOT NULL default '1',
  `product_attribute_id` int(11) default '0',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  KEY `session_id` (`session_id`),
  KEY `user_address_id` (`user_address_id`),
  KEY `product_attribute_id` (`product_attribute_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `carts`
--


-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `parent_id` int(10) NOT NULL DEFAULT '0',
  `lft` int(10) default NULL,
  `rght` int(10) default NULL,
  `name` varchar(255) collate utf8_unicode_ci default '',
  `slug` varchar(255) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `country_id` bigint(20) unsigned NOT NULL,
  `state_id` bigint(20) default '0',
  `language_id` bigint(20) default NULL,
  `name` varchar(45) collate utf8_unicode_ci NOT NULL,
  `slug` varchar(45) collate utf8_unicode_ci NOT NULL,
  `latitude` float default NULL,
  `longitude` float default NULL,
  `dma_id` int(11) default NULL,
  `county` varchar(25) collate utf8_unicode_ci default NULL,
  `code` varchar(4) collate utf8_unicode_ci default NULL,
  `is_approved` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `country_id` (`country_id`),
  KEY `state_id` (`state_id`),
  KEY `slug` (`slug`),
  KEY `dma_id` (`dma_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `created`, `modified`, `country_id`, `state_id`, `language_id`, `name`, `slug`, `latitude`, `longitude`, `dma_id`, `county`, `code`, `is_approved`) VALUES
(42464, '2010-04-16 07:46:56', '2010-07-21 07:34:36', 253, 17, NULL, 'San Diego', 'san-diego', NULL, NULL, NULL, '', '', 1),
(42549, '2010-07-21 07:33:53', '2010-07-21 07:33:53', 253, 51, NULL, 'Red Oak', 'red-oak', NULL, NULL, NULL, NULL, '', 1),
(42548, '2010-07-21 07:33:20', '2010-07-21 07:33:20', 253, 43, NULL, 'Austin', 'austin', NULL, NULL, NULL, NULL, '', 1),
(42547, '2010-07-21 07:32:20', '2010-07-21 07:32:20', 253, 24, NULL, 'Edge Hill', 'edge-hill', NULL, NULL, NULL, NULL, '', 1),
(42546, '2010-07-21 07:31:45', '2010-07-21 07:31:45', 253, 24, NULL, 'Adel', 'adel', NULL, NULL, NULL, NULL, '', 1),
(42545, '2010-07-21 07:31:22', '2010-07-21 07:31:22', 253, 16, NULL, 'Heber Springs', 'heber-springs', NULL, NULL, NULL, NULL, '', 1),
(42544, '2010-07-21 07:30:55', '2010-07-21 07:30:55', 253, 16, NULL, 'Berryville', 'berryville', NULL, NULL, NULL, NULL, '', 1),
(42543, '2010-07-21 07:30:23', '2010-07-21 07:30:23', 253, 15, NULL, 'Bisbee', 'bisbee', NULL, NULL, NULL, NULL, '', 1),
(42542, '2010-07-21 07:29:48', '2010-07-21 07:29:48', 253, 15, NULL, 'Bullhead City', 'bullhead-city', NULL, NULL, NULL, NULL, '', 1),
(42541, '2010-07-21 07:29:06', '2010-07-21 07:29:06', 253, 15, NULL, 'Coolidge', 'coolidge', NULL, NULL, NULL, NULL, '', 1),
(42550, '2010-07-30 15:04:29', '2010-07-30 15:04:29', 0, 0, NULL, 'Madras', 'madras', NULL, NULL, NULL, NULL, NULL, 0),
(42551, '2010-07-30 15:20:31', '2010-07-30 15:20:31', 0, 0, NULL, 'chennai', 'chennai', NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `continents`
--

DROP TABLE IF EXISTS `continents`;
CREATE TABLE IF NOT EXISTS `continents` (
  `id` int(11) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `code` varchar(10) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `continents`
--

INSERT INTO `continents` (`id`, `created`, `modified`, `name`, `code`) VALUES
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'North America', 'NA'),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Europe', 'EU'),
(5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Asia', 'AS'),
(6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'South America', 'SA'),
(7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Africa', 'AF'),
(8, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Oceania', 'OC');

-- --------------------------------------------------------

--
-- Table structure for table `continents_countries`
--

DROP TABLE IF EXISTS `continents_countries`;
CREATE TABLE IF NOT EXISTS `continents_countries` (
  `id` bigint(20) NOT NULL auto_increment,
  `country_id` int(11) NOT NULL,
  `continent_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `continent_id` (`continent_id`),
  KEY `country_id` (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `continents_countries`
--

INSERT INTO `continents_countries` (`id`, `country_id`, `continent_id`) VALUES
(1, 1, 3),
(2, 2, 2),
(3, 3, 5),
(4, 4, 6),
(5, 5, 2),
(6, 6, 5),
(7, 7, 1),
(8, 8, 5),
(9, 9, 1),
(10, 10, 4),
(11, 11, 3),
(12, 12, 1),
(13, 14, 6),
(14, 15, 2),
(15, 16, 3),
(16, 17, 1),
(17, 18, 3),
(18, 20, 3),
(19, 21, 1),
(20, 23, 2),
(21, 24, 2),
(22, 25, 1),
(23, 26, 5),
(24, 27, 1),
(25, 28, 3),
(26, 29, 4),
(27, 30, 2),
(28, 31, 5),
(29, 32, 3),
(30, 33, 4),
(31, 34, 3),
(32, 35, 3),
(33, 36, 2),
(34, 37, 5),
(35, 38, 5),
(36, 39, 3),
(37, 40, 5),
(38, 41, 1),
(39, 42, 5),
(40, 43, 1),
(41, 44, 5),
(42, 45, 5),
(43, 46, 4),
(44, 47, 3),
(45, 48, 3),
(46, 50, 3),
(47, 51, 4),
(48, 52, 5),
(49, 53, 5),
(50, 54, 5),
(51, 55, 6),
(52, 57, 1),
(53, 58, 5),
(54, 59, 2),
(55, 60, 1),
(56, 61, 2),
(57, 62, 2),
(58, 63, 2),
(59, 64, 5),
(60, 65, 1),
(61, 66, 1),
(62, 67, 4),
(63, 68, 5),
(64, 69, 1),
(65, 70, 5),
(66, 71, 5),
(67, 72, 2),
(68, 73, 5),
(69, 75, 4),
(70, 76, 2),
(71, 77, 6),
(72, 78, 2),
(73, 79, 2),
(74, 81, 4),
(75, 82, 6),
(76, 83, 5),
(77, 84, 5),
(78, 85, 5),
(79, 87, 3),
(80, 88, 2),
(81, 89, 5),
(82, 90, 2),
(83, 92, 2),
(84, 93, 1),
(85, 94, 1),
(86, 95, 1),
(87, 96, 6),
(88, 97, 1),
(89, 99, 5),
(90, 100, 5),
(91, 101, 4),
(92, 102, 1),
(93, 103, 3),
(94, 104, 1),
(95, 105, 3),
(96, 107, 2),
(97, 108, 2),
(98, 109, 3),
(99, 110, 3),
(100, 111, 3),
(101, 112, 3),
(102, 113, 2),
(103, 114, 3),
(104, 115, 2),
(105, 116, 1),
(106, 118, 3),
(107, 122, 3),
(108, 124, 3),
(109, 125, 5),
(110, 127, 6),
(111, 128, 3),
(112, 129, 3),
(113, 130, 3),
(114, 131, 2),
(115, 132, 3),
(116, 133, 5),
(117, 134, 5),
(118, 135, 5),
(119, 136, 2),
(120, 137, 2),
(121, 138, 2),
(122, 139, 3),
(123, 140, 2),
(124, 141, 5),
(125, 142, 5),
(126, 143, 3),
(127, 144, 3),
(128, 145, 5),
(129, 146, 2),
(130, 148, 6),
(131, 149, 1),
(132, 150, 5),
(133, 151, 5),
(134, 152, 5),
(135, 153, 1),
(136, 154, 6),
(137, 157, 2),
(138, 158, 2),
(139, 159, 3),
(140, 161, 1),
(141, 162, 5),
(142, 163, 5),
(143, 165, 3),
(144, 166, 5),
(145, 167, 6),
(146, 169, 3),
(147, 170, 2),
(148, 171, 1),
(149, 172, 6),
(150, 173, 6),
(151, 174, 1),
(152, 175, 5),
(153, 176, 5),
(154, 178, 6),
(155, 179, 3),
(156, 180, 6),
(157, 181, 2),
(158, 182, 3),
(159, 183, 3),
(160, 184, 6),
(161, 185, 3),
(162, 187, 1),
(163, 188, 6),
(164, 190, 4),
(165, 191, 4),
(166, 192, 3),
(167, 193, 6),
(168, 194, 2),
(169, 195, 2),
(170, 196, 1),
(171, 197, 3),
(172, 198, 5),
(173, 199, 2),
(174, 200, 2),
(175, 201, 5),
(176, 202, 5),
(177, 203, 1),
(178, 204, 1),
(179, 205, 1),
(180, 206, 1),
(181, 207, 6),
(182, 208, 2),
(183, 209, 5),
(184, 210, 3),
(185, 211, 5),
(186, 214, 5),
(187, 215, 5),
(188, 216, 3),
(189, 217, 2),
(190, 218, 2),
(191, 219, 6),
(192, 220, 5),
(193, 221, 5),
(194, 222, 2),
(195, 223, 3),
(196, 224, 2),
(197, 226, 3),
(198, 227, 5),
(199, 228, 4),
(200, 229, 2),
(201, 230, 5),
(202, 231, 2),
(203, 232, 2),
(204, 233, 3),
(205, 234, 3),
(206, 235, 3),
(207, 236, 5),
(208, 237, 3),
(209, 238, 6),
(210, 239, 5),
(211, 240, 6),
(212, 241, 6),
(213, 242, 1),
(214, 244, 5),
(215, 245, 3),
(216, 246, 3),
(217, 247, 1),
(218, 248, 6),
(219, 249, 5),
(220, 250, 2),
(221, 251, 3),
(222, 252, 2),
(223, 253, 1),
(224, 254, 6),
(225, 255, 4),
(226, 256, 3),
(227, 257, 6),
(228, 258, 2),
(229, 259, 4),
(230, 260, 3),
(231, 263, 1),
(232, 264, 1),
(233, 266, 6),
(234, 268, 5),
(235, 271, 3),
(236, 274, 5),
(237, 275, 5);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(50) collate utf8_unicode_ci NOT NULL,
  `fips104` varchar(2) collate utf8_unicode_ci NOT NULL,
  `iso2` varchar(2) collate utf8_unicode_ci NOT NULL,
  `iso3` varchar(3) collate utf8_unicode_ci NOT NULL,
  `ison` varchar(4) collate utf8_unicode_ci NOT NULL,
  `internet` varchar(2) collate utf8_unicode_ci NOT NULL,
  `capital` varchar(25) collate utf8_unicode_ci default NULL,
  `map_reference` varchar(50) collate utf8_unicode_ci default NULL,
  `nationality_singular` varchar(35) collate utf8_unicode_ci default NULL,
  `nationality_plural` varchar(35) collate utf8_unicode_ci default NULL,
  `currency` varchar(30) collate utf8_unicode_ci default NULL,
  `currency_code` varchar(3) collate utf8_unicode_ci default NULL,
  `population` bigint(20) default NULL,
  `title` varchar(50) collate utf8_unicode_ci default NULL,
  `comment` text collate utf8_unicode_ci,
  `slug` varchar(50) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=276 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `fips104`, `iso2`, `iso3`, `ison`, `internet`, `capital`, `map_reference`, `nationality_singular`, `nationality_plural`, `currency`, `currency_code`, `population`, `title`, `comment`, `slug`) VALUES
(1, 'Afghanistan (افغانستان)', 'AF', 'AF', 'AFG', '4', 'AF', 'Kabul ', 'Asia ', 'Afghan', 'Afghans', 'Afghani ', 'AFA', 26813057, 'Afghanistan', '', 'afghanistan'),
(2, 'Albania (Shqipëria)', 'AL', 'AL', 'ALB', '8', 'AL', 'Tirana ', 'Europe ', 'Albanian', 'Albanians', 'Lek ', 'ALL', 3510484, 'Albania', '', 'albania-shqip-ria'),
(3, 'Algeria (الجزائر)', 'AG', 'DZ', 'DZA', '12', 'DZ', 'Algiers ', 'Africa ', 'Algerian', 'Algerians', 'Algerian Dinar ', 'DZD', 31736053, 'Algeria', '', 'algeria'),
(4, 'American Samoa', 'AQ', 'AS', 'ASM', '16', 'AS', 'Pago Pago ', 'Oceania ', 'American Samoan', 'American Samoans', 'US Dollar', 'USD', 67084, 'American Samoa', '', 'american-samoa'),
(5, 'Andorra', 'AN', 'AD', 'AND', '20', 'AD', 'Andorra la Vella ', 'Europe ', 'Andorran', 'Andorrans', 'Euro', 'EUR', 67627, 'Andorra', '', 'andorra'),
(6, 'Angola', 'AO', 'AO', 'AGO', '24', 'AO', 'Luanda ', 'Africa ', 'Angolan', 'Angolans', 'Kwanza ', 'AOA', 10366031, 'Angola', '', 'angola'),
(7, 'Anguilla', 'AV', 'AI', 'AIA', '660', 'AI', 'The Valley ', 'Central America and the Caribbean ', 'Anguillan', 'Anguillans', 'East Caribbean Dollar ', 'XCD', 12132, 'Anguilla', '', 'anguilla'),
(8, 'Antarctica', 'AY', 'AQ', 'ATA', '10', 'AQ', '', 'Antarctic Region ', '', '', '', '', 0, 'Antarctica', 'ISO defines as the territory south of 60 degrees south latitude', 'antarctica'),
(9, 'Antigua and Barbuda', 'AC', 'AG', 'ATG', '28', 'AG', 'Saint John''s ', 'Central America and the Caribbean ', 'Antiguan and Barbudan', 'Antiguans and Barbudans', 'East Caribbean Dollar ', 'XCD', 66970, 'Antigua and Barbuda', '', 'antigua-and-barbuda'),
(10, 'Argentina', 'AR', 'AR', 'ARG', '32', 'AR', 'Buenos Aires ', 'South America ', 'Argentine', 'Argentines', 'Argentine Peso ', 'ARS', 37384816, 'Argentina', '', 'argentina'),
(11, 'Armenia (Հայաստան)', 'AM', 'AM', 'ARM', '51', 'AM', 'Yerevan ', 'Commonwealth of Independent States ', 'Armenian', 'Armenians', 'Armenian Dram ', 'AMD', 3336100, 'Armenia', '', 'armenia'),
(12, 'Aruba', 'AA', 'AW', 'ABW', '533', 'AW', 'Oranjestad ', 'Central America and the Caribbean ', 'Aruban', 'Arubans', 'Aruban Guilder', 'AWG', 70007, 'Aruba', '', 'aruba'),
(13, 'Ashmore and Cartier', 'AT', '--', '-- ', '--', '--', '', 'Southeast Asia ', '', '', '', '', 0, 'Ashmore and Cartier', 'ISO includes with Australia', 'ashmore-and-cartier'),
(14, 'Australia', 'AS', 'AU', 'AUS', '36', 'AU', 'Canberra ', 'Oceania ', 'Australian', 'Australians', 'Australian dollar ', 'AUD', 19357594, 'Australia', 'ISO includes Ashmore and Cartier Islands,Coral Sea Islands', 'australia'),
(15, 'Austria (Österreich)', 'AU', 'AT', 'AUT', '40', 'AT', 'Vienna ', 'Europe ', 'Austrian', 'Austrians', 'Euro', 'EUR', 8150835, 'Austria', '', 'austria-sterreich'),
(16, 'Azerbaijan (Azərbaycan)', 'AJ', 'AZ', 'AZE', '31', 'AZ', 'Baku (Baki) ', 'Commonwealth of Independent States ', 'Azerbaijani', 'Azerbaijanis', 'Azerbaijani Manat ', 'AZM', 7771092, 'Azerbaijan', '', 'azerbaijan-az-rbaycan'),
(17, 'Bahamas', 'BF', 'BS', 'BHS', '44', 'BS', 'Nassau ', 'Central America and the Caribbean ', 'Bahamian', 'Bahamians', 'Bahamian Dollar ', 'BSD', 297852, 'The Bahamas', '', 'bahamas'),
(18, 'Bahrain (البحرين)', 'BA', 'BH', 'BHR', '48', 'BH', 'Manama ', 'Middle East ', 'Bahraini', 'Bahrainis', 'Bahraini Dinar ', 'BHD', 645361, 'Bahrain', '', 'bahrain'),
(19, 'Baker Island', 'FQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', '', '', 0, 'Baker Island', 'ISO includes with the US Minor Outlying Islands', 'baker-island'),
(20, 'Bangladesh (বাংলাদেশ)', 'BG', 'BD', 'BGD', '50', 'BD', 'Dhaka ', 'Asia ', 'Bangladeshi', 'Bangladeshis', 'Taka ', 'BDT', 131269860, 'Bangladesh', '', 'bangladesh'),
(21, 'Barbados', 'BB', 'BB', 'BRB', '52', 'BB', 'Bridgetown ', 'Central America and the Caribbean ', 'Barbadian', 'Barbadians', 'Barbados Dollar', 'BBD', 275330, 'Barbados', '', 'barbados'),
(22, 'Bassas da India', 'BS', '--', '-- ', '--', '--', '', 'Africa ', '', '', '', '', 0, 'Bassas da India', 'ISO includes with the Miscellaneous (French) Indian Ocean Islands', 'bassas-da-india'),
(23, 'Belarus (Белару́сь)', 'BO', 'BY', 'BLR', '112', 'BY', 'Minsk ', 'Commonwealth of Independent States ', 'Belarusian', 'Belarusians', 'Belarussian Ruble', 'BYR', 10350194, 'Belarus', '', 'belarus'),
(24, 'Belgium (België)', 'BE', 'BE', 'BEL', '56', 'BE', 'Brussels ', 'Europe ', 'Belgian', 'Belgians', 'Euro', 'EUR', 10258762, 'Belgium', '', 'belgium-belgi'),
(25, 'Belize', 'BH', 'BZ', 'BLZ', '84', 'BZ', 'Belmopan ', 'Central America and the Caribbean ', 'Belizean', 'Belizeans', 'Belize Dollar', 'BZD', 256062, 'Belize', '', 'belize'),
(26, 'Benin (Bénin)', 'BN', 'BJ', 'BEN', '204', 'BJ', 'Porto-Novo  ', 'Africa ', 'Beninese', 'Beninese', 'CFA Franc BCEAO', 'XOF', 6590782, 'Benin', '', 'benin-b-nin'),
(27, 'Bermuda', 'BD', 'BM', 'BMU', '60', 'BM', 'Hamilton ', 'North America ', 'Bermudian', 'Bermudians', 'Bermudian Dollar ', 'BMD', 63503, 'Bermuda', '', 'bermuda'),
(28, 'Bhutan (', 'BT', 'BT', 'BTN', '64', 'BT', 'Thimphu ', 'Asia ', 'Bhutanese', 'Bhutanese', 'Ngultrum', 'BTN', 2049412, 'Bhutan', '', 'bhutan'),
(29, 'Bolivia', 'BL', 'BO', 'BOL', '68', 'BO', 'La Paz /Sucre ', 'South America ', 'Bolivian', 'Bolivians', 'Boliviano ', 'BOB', 8300463, 'Bolivia', '', 'bolivia'),
(30, 'Bosnia and Herzegovina (Bosna i Hercegovina)', 'BK', 'BA', 'BIH', '70', 'BA', 'Sarajevo ', 'Bosnia and Herzegovina, Europe ', 'Bosnian and Herzegovinian', 'Bosnians and Herzegovinians', 'Convertible Marka', 'BAM', 3922205, 'Bosnia and Herzegovina', '', 'bosnia-and-herzegovina-bosna-i-hercegovina'),
(31, 'Botswana', 'BC', 'BW', 'BWA', '72', 'BW', 'Gaborone ', 'Africa ', 'Motswana', 'Batswana', 'Pula ', 'BWP', 1586119, 'Botswana', '', 'botswana'),
(32, 'Bouvet Island', 'BV', 'BV', 'BVT', '74', 'BV', '', 'Antarctic Region ', '', '', 'Norwegian Krone ', 'NOK', 0, 'Bouvet Island', '', 'bouvet-island'),
(33, 'Brazil (Brasil)', 'BR', 'BR', 'BRA', '76', 'BR', 'Brasilia ', 'South America ', 'Brazilian', 'Brazilians', 'Brazilian Real ', 'BRL', 174468575, 'Brazil', '', 'brazil-brasil'),
(34, 'British Indian Ocean Territory', 'IO', 'IO', 'IOT', '86', 'IO', '', 'World ', '', '', 'US Dollar', 'USD', 0, 'The British Indian Ocean Territory', '', 'british-indian-ocean-territory'),
(35, 'Brunei (Brunei Darussalam)', 'BX', 'BN', 'BRN', '96', 'BN', '', '', '', '', 'Brunei Dollar', 'BND', 372361, 'Brunei', '', 'brunei-brunei-darussalam'),
(36, 'Bulgaria (България)', 'BU', 'BG', 'BGR', '100', 'BG', 'Sofia ', 'Europe ', 'Bulgarian', 'Bulgarians', 'Lev ', 'BGN', 7707495, 'Bulgaria', '', 'bulgaria'),
(37, 'Burkina Faso', 'UV', 'BF', 'BFA', '854', 'BF', 'Ouagadougou ', 'Africa ', 'Burkinabe', 'Burkinabe', 'CFA Franc BCEAO', 'XOF', 12272289, 'Burkina Faso', '', 'burkina-faso'),
(38, 'Burundi (Uburundi)', 'BY', 'BI', 'BDI', '108', 'BI', 'Bujumbura ', 'Africa ', 'Burundi', 'Burundians', 'Burundi Franc ', 'BIF', 6223897, 'Burundi', '', 'burundi-uburundi'),
(39, 'Cambodia (Kampuchea)', 'CB', 'KH', 'KHM', '116', 'KH', 'Phnom Penh ', 'Southeast Asia ', 'Cambodian', 'Cambodians', 'Riel ', 'KHR', 12491501, 'Cambodia', '', 'cambodia-kampuchea'),
(40, 'Cameroon (Cameroun)', 'CM', 'CM', 'CMR', '120', 'CM', 'Yaounde ', 'Africa ', 'Cameroonian', 'Cameroonians', 'CFA Franc BEAC', 'XAF', 15803220, 'Cameroon', '', 'cameroon-cameroun'),
(41, 'Canada', 'CA', 'CA', 'CAN', '124', 'CA', 'Ottawa ', 'North America ', 'Canadian', 'Canadians', 'Canadian Dollar ', 'CAD', 31592805, 'Canada', '', 'canada'),
(42, 'Cape Verde (Cabo Verde)', 'CV', 'CV', 'CPV', '132', 'CV', 'Praia ', 'World ', 'Cape Verdean', 'Cape Verdeans', 'Cape Verdean Escudo ', 'CVE', 405163, 'Cape Verde', '', 'cape-verde-cabo-verde'),
(43, 'Cayman Islands', 'CJ', 'KY', 'CYM', '136', 'KY', 'George Town ', 'Central America and the Caribbean ', 'Caymanian', 'Caymanians', 'Cayman Islands Dollar', 'KYD', 35527, 'The Cayman Islands', '', 'cayman-islands'),
(44, 'Central African Republic (République Centrafricai', 'CT', 'CF', 'CAF', '140', 'CF', 'Bangui ', 'Africa ', 'Central African', 'Central Africans', 'CFA Franc BEAC', 'XAF', 3576884, 'The Central African Republic', '', 'central-african-republic-r-publique-centrafricain'),
(45, 'Chad (Tchad)', 'CD', 'TD', 'TCD', '148', 'TD', 'N''Djamena ', 'Africa ', 'Chadian', 'Chadians', 'CFA Franc BEAC', 'XAF', 8707078, 'Chad', '', 'chad-tchad'),
(46, 'Chile', 'CI', 'CL', 'CHL', '152', 'CL', 'Santiago ', 'South America ', 'Chilean', 'Chileans', 'Chilean Peso ', 'CLP', 15328467, 'Chile', '', 'chile'),
(47, 'China (中国)', 'CH', 'CN', 'CHN', '156', 'CN', 'Beijing ', 'Asia ', 'Chinese', 'Chinese', 'Yuan Renminbi', 'CNY', 1273111290, 'China', 'see also Taiwan', 'china'),
(48, 'Christmas Island', 'KT', 'CX', 'CXR', '162', 'CX', 'The Settlement ', 'Southeast Asia ', 'Christmas Island', 'Christmas Islanders', 'Australian Dollar ', 'AUD', 2771, 'Christmas Island', '', 'christmas-island'),
(49, 'Clipperton Island', 'IP', '--', '-- ', '--', '--', '', 'World ', '', '', '', '', 0, 'Clipperton Island', 'ISO includes with French Polynesia', 'clipperton-island'),
(50, 'Cocos Islands', 'CK', 'CC', 'CCK', '166', 'CC', 'West Island ', 'Southeast Asia ', 'Cocos Islander', 'Cocos Islanders', 'Australian Dollar ', 'AUD', 633, 'The Cocos Islands', '', 'cocos-islands'),
(51, 'Colombia', 'CO', 'CO', 'COL', '170', 'CO', 'Bogota ', 'South America, Central America and the Caribbean ', 'Colombian', 'Colombians', 'Colombian Peso ', 'COP', 40349388, 'Colombia', '', 'colombia'),
(52, 'Comoros (Comores)', 'CN', 'KM', 'COM', '174', 'KM', 'Moroni ', 'Africa ', 'Comoran', 'Comorans', 'Comoro Franc', 'KMF', 596202, 'Comoros', '', 'comoros-comores'),
(53, 'Congo', 'CF', 'CG', 'COG', '178', 'CG', 'Brazzaville ', 'Africa ', 'Congolese', 'Congolese', 'CFA Franc BEAC', 'XAF', 2894336, 'Republic of the Congo', '', 'congo-1'),
(54, 'Congo, Democratic Republic of the', 'CG', 'CD', 'COD', '180', 'CD', 'Kinshasa ', 'Africa ', 'Congolese', 'Congolese', 'Franc Congolais', 'CDF', 53624718, 'Democratic Republic of the Congo', 'formerly Zaire', 'congo-democratic-republic-of-the'),
(55, 'Cook Islands', 'CW', 'CK', 'COK', '184', 'CK', 'Avarua ', 'Oceania ', 'Cook Islander', 'Cook Islanders', 'New Zealand Dollar ', 'NZD', 20611, 'The Cook Islands', '', 'cook-islands'),
(56, 'Coral Sea Islands', 'CR', '--', '-- ', '--', '--', '', 'Oceania ', '', '', '', '', 0, 'The Coral Sea Islands', 'ISO includes with Australia', 'coral-sea-islands'),
(57, 'Costa Rica', 'CS', 'CR', 'CRI', '188', 'CR', 'San Jose ', 'Central America and the Caribbean ', 'Costa Rican', 'Costa Ricans', 'Costa Rican Colon', 'CRC', 3773057, 'Costa Rica', '', 'costa-rica'),
(58, 'Côte d&#39;Ivoire', 'IV', 'CI', 'CIV', '384', 'CI', 'Yamoussoukro', 'Africa ', 'Ivorian', 'Ivorians', 'CFA Franc BCEAO', 'XOF', 16393221, 'Cote d''Ivoire', '', 'c-te-d-39-ivoire'),
(59, 'Croatia (Hrvatska)', 'HR', 'HR', 'HRV', '191', 'HR', 'Zagreb ', 'Europe ', 'Croatian', 'Croats', 'Kuna', 'HRK', 4334142, 'Croatia', '', 'croatia-hrvatska'),
(60, 'Cuba', 'CU', 'CU', 'CUB', '192', 'CU', 'Havana ', 'Central America and the Caribbean ', 'Cuban', 'Cubans', 'Cuban Peso', 'CUP', 11184023, 'Cuba', '', 'cuba'),
(61, 'Cyprus (Κυπρος)', 'CY', 'CY', 'CYP', '196', 'CY', 'Nicosia ', 'Middle East ', 'Cypriot', 'Cypriots', 'Cyprus Pound', 'CYP', 762887, 'Cyprus', '', 'cyprus'),
(62, 'Czech Republic (Česko)', 'EZ', 'CZ', 'CZE', '203', 'CZ', 'Prague ', 'Europe ', 'Czech', 'Czechs', 'Czech Koruna', 'CZK', 10264212, 'The Czech Republic', '', 'czech-republic-esko'),
(63, 'Denmark (Danmark)', 'DA', 'DK', 'DNK', '208', 'DK', 'Copenhagen ', 'Europe ', 'Danish', 'Danes', 'Danish Krone', 'DKK', 5352815, 'Denmark', '', 'denmark-danmark'),
(64, 'Djibouti', 'DJ', 'DJ', 'DJI', '262', 'DJ', 'Djibouti ', 'Africa ', 'Djiboutian', 'Djiboutians', 'Djibouti Franc', 'DJF', 460700, 'Djibouti', '', 'djibouti'),
(65, 'Dominica', 'DO', 'DM', 'DMA', '212', 'DM', 'Roseau ', 'Central America and the Caribbean ', 'Dominican', 'Dominicans', 'East Caribbean Dollar', 'XCD', 70786, 'Dominica', '', 'dominica'),
(66, 'Dominican Republic', 'DR', 'DO', 'DOM', '214', 'DO', 'Santo Domingo ', 'Central America and the Caribbean ', 'Dominican', 'Dominicans', 'Dominican Peso', 'DOP', 8581477, 'The Dominican Republic', '', 'dominican-republic'),
(67, 'Ecuador', 'EC', 'EC', 'ECU', '218', 'EC', 'Quito ', 'South America ', 'Ecuadorian', 'Ecuadorians', 'US Dollar', 'USD', 13183978, 'Ecuador', '', 'ecuador'),
(68, 'Egypt (مصر)', 'EG', 'EG', 'EGY', '818', 'EG', 'Cairo ', 'Africa ', 'Egyptian', 'Egyptians', 'Egyptian Pound ', 'EGP', 69536644, 'Egypt', '', 'egypt'),
(69, 'El Salvador', 'ES', 'SV', 'SLV', '222', 'SV', 'San Salvador ', 'Central America and the Caribbean ', 'Salvadoran', 'Salvadorans', 'El Salvador Colon', 'SVC', 6237662, 'El Salvador', '', 'el-salvador'),
(70, 'Equatorial Guinea (Guinea Ecuatorial)', 'EK', 'GQ', 'GNQ', '226', 'GQ', 'Malabo ', 'Africa ', 'Equatorial Guinean', 'Equatorial Guineans', 'CFA Franc BEAC', 'XAF', 486060, 'Equatorial Guinea', '', 'equatorial-guinea-guinea-ecuatorial'),
(71, 'Eritrea (Ertra)', 'ER', 'ER', 'ERI', '232', 'ER', 'Asmara ', 'Africa ', 'Eritrean', 'Eritreans', 'Nakfa', 'ERN', 4298269, 'Eritrea', '', 'eritrea-ertra'),
(72, 'Estonia (Eesti)', 'EN', 'EE', 'EST', '233', 'EE', 'Tallinn ', 'Europe ', 'Estonian', 'Estonians', 'Kroon', 'EEK', 1423316, 'Estonia', '', 'estonia-eesti'),
(73, 'Ethiopia (Ityop&#39;iya)', 'ET', 'ET', 'ETH', '231', 'ET', 'Addis Ababa ', 'Africa ', 'Ethiopian', 'Ethiopians', 'Ethiopian Birr', 'ETB', 65891874, 'Ethiopia', '', 'ethiopia-ityop-39-iya'),
(74, 'Europa Island', 'EU', '--', '-- ', '--', '--', '', 'Africa ', '', '', '', '', 0, 'Europa Island', 'ISO includes with the Miscellaneous (French) Indian Ocean Islands', 'europa-island'),
(75, 'Falkland Islands', 'FK', 'FK', 'FLK', '238', 'FK', 'Stanley', 'South America', 'Falkland Island', 'Falkland Islanders', 'Falkland Islands Pound', 'FKP', 2895, 'The Falkland Islands ', '', 'falkland-islands'),
(76, 'Faroe Islands', 'FO', 'FO', 'FRO', '234', 'FO', 'Torshavn ', 'Europe ', 'Faroese', 'Faroese', 'Danish Krone ', 'DKK', 45661, 'The Faroe Islands', '', 'faroe-islands'),
(77, 'Fiji', 'FJ', 'FJ', 'FJI', '242', 'FJ', 'Suva ', 'Oceania ', 'Fijian', 'Fijians', 'Fijian Dollar ', 'FJD', 844330, 'Fiji', '', 'fiji'),
(78, 'Finland (Suomi)', 'FI', 'FI', 'FIN', '246', 'FI', 'Helsinki ', 'Europe ', 'Finnish', 'Finns', 'Euro', 'EUR', 5175783, 'Finland', '', 'finland-suomi'),
(79, 'France', 'FR', 'FR', 'FRA', '250', 'FR', 'Paris ', 'Europe ', 'Frenchman', 'Frenchmen', 'Euro', 'EUR', 59551227, 'France', '', 'france'),
(80, 'France, Metropolitan', '--', '--', '-- ', '--', 'FX', '', '', '', '', 'Euro', 'EUR', 0, 'Metropolitan France', 'ISO limits to the European part of France, excluding French Guiana, French Polynesia, French Southern and Antarctic Lands, Guadeloupe, Martinique, Mayotte, New Caledonia, Reunion, Saint Pierre and Miquelon, Wallis and Futuna', 'france-metropolitan'),
(81, 'French Guiana', 'FG', 'GF', 'GUF', '254', 'GF', 'Cayenne ', 'South America ', 'French Guianese', 'French Guianese', 'Euro', 'EUR', 177562, 'French Guiana', '', 'french-guiana'),
(82, 'French Polynesia', 'FP', 'PF', 'PYF', '258', 'PF', 'Papeete ', 'Oceania ', 'French Polynesian', 'French Polynesians', 'CFP Franc', 'XPF', 253506, 'French Polynesia', 'ISO includes Clipperton Island', 'french-polynesia'),
(83, 'French Southern Territories', 'FS', 'TF', 'ATF', '260', 'TF', '', 'Antarctic Region ', '', '', 'Euro', 'EUR', 0, 'The French Southern and Antarctic Lands', 'FIPS 10-4 does not include the French-claimed portion of Antarctica (Terre Adelie)', 'french-southern-territories'),
(84, 'Gabon', 'GB', 'GA', 'GAB', '266', 'GA', 'Libreville ', 'Africa ', 'Gabonese', 'Gabonese', 'CFA Franc BEAC', 'XAF', 1221175, 'Gabon', '', 'gabon'),
(85, 'Gambia', 'GA', 'GM', 'GMB', '270', 'GM', 'Banjul ', 'Africa ', 'Gambian', 'Gambians', 'Dalasi', 'GMD', 1411205, 'The Gambia', '', 'gambia'),
(86, 'Gaza Strip', 'GZ', '--', '-- ', '--', '--', '', 'Middle East ', '', '', 'New Israeli Shekel ', 'ILS', 1178119, 'The Gaza Strip', '', 'gaza-strip'),
(87, 'Georgia (საქა', 'GG', 'GE', 'GEO', '268', 'GE', 'T''bilisi ', 'Commonwealth of Independent States ', 'Georgian', 'Georgians', 'Lari', 'GEL', 4989285, 'Georgia', '', 'georgia'),
(88, 'Germany (Deutschland)', 'GM', 'DE', 'DEU', '276', 'DE', 'Berlin ', 'Europe ', 'German', 'Germans', 'Euro', 'EUR', 83029536, 'Deutschland', '', 'germany-deutschland'),
(89, 'Ghana', 'GH', 'GH', 'GHA', '288', 'GH', 'Accra ', 'Africa ', 'Ghanaian', 'Ghanaians', 'Cedi', 'GHC', 19894014, 'Ghana', '', 'ghana'),
(90, 'Gibraltar', 'GI', 'GI', 'GIB', '292', 'GI', 'Gibraltar ', 'Europe ', 'Gibraltar', 'Gibraltarians', 'Gibraltar Pound', 'GIP', 27649, 'Gibraltar', '', 'gibraltar'),
(91, 'Glorioso Islands', 'GO', '--', '-- ', '--', '--', '', 'Africa ', '', '', '', '', 0, 'The Glorioso Islands', 'ISO includes with the Miscellaneous (French) Indian Ocean Islands', 'glorioso-islands'),
(92, 'Greece (Ελλάς)', 'GR', 'GR', 'GRC', '300', 'GR', 'Athens ', 'Europe ', 'Greek', 'Greeks', 'Euro', 'EUR', 10623835, 'Greece', '', 'greece'),
(93, 'Greenland', 'GL', 'GL', 'GRL', '304', 'GL', 'Nuuk ', 'Arctic Region ', 'Greenlandic', 'Greenlanders', 'Danish Krone', 'DKK', 56352, 'Greenland', '', 'greenland'),
(94, 'Grenada', 'GJ', 'GD', 'GRD', '308', 'GD', 'Saint George''s ', 'Central America and the Caribbean ', 'Grenadian', 'Grenadians', 'East Caribbean Dollar', 'XCD', 89227, 'Grenada', '', 'grenada'),
(95, 'Guadeloupe', 'GP', 'GP', 'GLP', '312', 'GP', 'Basse-Terre ', 'Central America and the Caribbean ', 'Guadeloupe', 'Guadeloupians', 'Euro', 'EUR', 431170, 'Guadeloupe', '', 'guadeloupe'),
(96, 'Guam', 'GQ', 'GU', 'GUM', '316', 'GU', 'Hagatna', 'Oceania ', 'Guamanian', 'Guamanians', 'US Dollar', 'USD', 157557, 'Guam', '', 'guam'),
(97, 'Guatemala', 'GT', 'GT', 'GTM', '320', 'GT', 'Guatemala ', 'Central America and the Caribbean ', 'Guatemalan', 'Guatemalans', 'Quetzal', 'GTQ', 12974361, 'Guatemala', '', 'guatemala'),
(98, 'Guernsey', 'GK', '--', '-- ', '--', 'GG', 'Saint Peter Port ', 'Europe ', 'Channel Islander', 'Channel Islanders', 'Pound Sterling', 'GBP', 64342, 'Guernsey', 'ISO includes with the United Kingdom', 'guernsey'),
(99, 'Guinea (Guinée)', 'GV', 'GN', 'GIN', '324', 'GN', 'Conakry ', 'Africa ', 'Guinean', 'Guineans', 'Guinean Franc ', 'GNF', 7613870, 'Guinea', '', 'guinea-guin-e'),
(100, 'Guinea-Bissau (Guiné-Bissau)', 'PU', 'GW', 'GNB', '624', 'GW', 'Bissau ', 'Africa ', 'Guinean', 'Guineans', 'CFA Franc BCEAO', 'XOF', 1315822, 'Guinea-Bissau', '', 'guinea-bissau-guin-bissau'),
(101, 'Guyana', 'GY', 'GY', 'GUY', '328', 'GY', 'Georgetown ', 'South America ', 'Guyanese', 'Guyanese', 'Guyana Dollar', 'GYD', 697181, 'Guyana', '', 'guyana'),
(102, 'Haiti (Haïti)', 'HA', 'HT', 'HTI', '332', 'HT', 'Port-au-Prince ', 'Central America and the Caribbean ', 'Haitian', 'Haitians', 'Gourde', 'HTG', 6964549, 'Haiti', '', 'haiti-ha-ti'),
(103, 'Heard Island and McDonald Islands', 'HM', 'HM', 'HMD', '334', 'HM', '', 'Antarctic Region ', '', '', 'Australian Dollar', 'AUD', 0, 'The Heard Island and McDonald Islands', '', 'heard-island-and-mcdonald-islands'),
(104, 'Honduras', 'HO', 'HN', 'HND', '340', 'HN', 'Tegucigalpa ', 'Central America and the Caribbean ', 'Honduran', 'Hondurans', 'Lempira', 'HNL', 6406052, 'Honduras', '', 'honduras'),
(105, 'Hong Kong', 'HK', 'HK', 'HKG', '344', 'HK', '', 'Southeast Asia ', '', '', 'Hong Kong Dollar ', 'HKD', 0, 'Xianggang ', '', 'hong-kong'),
(106, 'Howland Island', 'HQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', '', '', 7210505, 'Howland Island', 'ISO includes with the US Minor Outlying Islands', 'howland-island'),
(107, 'Hungary (Magyarország)', 'HU', 'HU', 'HUN', '348', 'HU', 'Budapest ', 'Europe ', 'Hungarian', 'Hungarians', 'Forint', 'HUF', 10106017, 'Hungary', '', 'hungary-magyarorsz-g'),
(108, 'Iceland (Ísland)', 'IC', 'IS', 'ISL', '352', 'IS', 'Reykjavik ', 'Arctic Region ', 'Icelandic', 'Icelanders', 'Iceland Krona', 'ISK', 277906, 'Iceland', '', 'iceland-sland'),
(109, 'India', 'IN', 'IN', 'IND', '356', 'IN', 'New Delhi ', 'Asia ', 'Indian', 'Indians', 'Indian Rupee ', 'INR', 1029991145, 'India', '', 'india'),
(110, 'Indonesia', 'ID', 'ID', 'IDN', '360', 'ID', 'Jakarta ', 'Southeast Asia ', 'Indonesian', 'Indonesians', 'Rupiah', 'IDR', 228437870, 'Indonesia', '', 'indonesia'),
(111, 'Iran (ایران)', 'IR', 'IR', 'IRN', '364', 'IR', 'Tehran ', 'Middle East ', 'Iranian', 'Iranians', 'Iranian Rial', 'IRR', 66128965, 'Iran', '', 'iran'),
(112, 'Iraq (العراق)', 'IZ', 'IQ', 'IRQ', '368', 'IQ', 'Baghdad ', 'Middle East ', 'Iraqi', 'Iraqis', 'Iraqi Dinar', 'IQD', 23331985, 'Iraq', '', 'iraq'),
(113, 'Ireland', 'EI', 'IE', 'IRL', '372', 'IE', 'Dublin ', 'Europe ', 'Irish', 'Irishmen', 'Euro', 'EUR', 3840838, 'Ireland', '', 'ireland'),
(114, 'Israel (ישראל)', 'IS', 'IL', 'ISR', '376', 'IL', 'Jerusalem', 'Middle East ', 'Israeli', 'Israelis', 'New Israeli Sheqel', 'ILS', 5938093, 'Israel', '', 'israel'),
(115, 'Italy (Italia)', 'IT', 'IT', 'ITA', '380', 'IT', 'Rome ', 'Europe ', 'Italian', 'Italians', 'Euro', 'EUR', 57679825, 'Italia ', '', 'italy-italia'),
(116, 'Jamaica', 'JM', 'JM', 'JAM', '388', 'JM', 'Kingston ', 'Central America and the Caribbean ', 'Jamaican', 'Jamaicans', 'Jamaican dollar ', 'JMD', 2665636, 'Jamaica', '', 'jamaica'),
(117, 'Jan Mayen', 'JN', '--', '-- ', '--', '--', '', 'Arctic Region ', '', '', 'Norway Kroner', 'NOK', 0, 'Jan Mayen', 'ISO includes with Svalbard', 'jan-mayen'),
(118, 'Japan (日本)', 'JA', 'JP', 'JPN', '392', 'JP', 'Tokyo ', 'Asia ', 'Japanese', 'Japanese', 'Yen ', 'JPY', 126771662, 'Japan', '', 'japan'),
(119, 'Jarvis Island', 'DQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', '', '', 0, 'Jarvis Island', 'ISO includes with the US Minor Outlying Islands', 'jarvis-island'),
(120, 'Jersey', 'JE', '--', '-- ', '--', 'JE', 'Saint Helier ', 'Europe ', 'Channel Islander', 'Channel Islanders', 'Pound Sterling', 'GBP', 89361, 'Jersey', 'ISO includes with the United Kingdom', 'jersey'),
(121, 'Johnston Atoll', 'JQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', '', '', 0, 'Johnston Atoll', 'ISO includes with the US Minor Outlying Islands', 'johnston-atoll'),
(122, 'Jordan (الاردن)', 'JO', 'JO', 'JOR', '400', 'JO', 'Amman ', 'Middle East ', 'Jordanian', 'Jordanians', 'Jordanian Dinar', 'JOD', 5153378, 'Jordan', '', 'jordan'),
(123, 'Juan de Nova Island', 'JU', '--', '-- ', '--', '--', '', 'Africa ', '', '', '', '', 0, 'Juan de Nova Island', 'ISO includes with the Miscellaneous (French) Indian Ocean Islands', 'juan-de-nova-island'),
(124, 'Kazakhstan (Қазақстан)', 'KZ', 'KZ', 'KAZ', '398', 'KZ', 'Astana ', 'Commonwealth of Independent States ', 'Kazakhstani', 'Kazakhstanis', 'Tenge', 'KZT', 16731303, 'Kazakhstan', '', 'kazakhstan'),
(125, 'Kenya', 'KE', 'KE', 'KEN', '404', 'KE', 'Nairobi ', 'Africa ', 'Kenyan', 'Kenyans', 'Kenyan shilling ', 'KES', 30765916, 'Kenya', '', 'kenya'),
(126, 'Kingman Reef', 'KQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', '', '', 0, 'Kingman Reef', 'ISO includes with the US Minor Outlying Islands', 'kingman-reef'),
(127, 'Kiribati', 'KR', 'KI', 'KIR', '296', 'KI', 'Tarawa ', 'Oceania ', 'I-Kiribati', 'I-Kiribati', 'Australian dollar ', 'AUD', 94149, 'Kiribati', '', 'kiribati'),
(128, 'Kuwait (الكويت)', 'KU', 'KW', 'KWT', '414', 'KW', 'Kuwait ', 'Middle East ', 'Kuwaiti', 'Kuwaitis', 'Kuwaiti Dinar', 'KWD', 2041961, 'Al Kuwayt', '', 'kuwait'),
(129, 'Kyrgyzstan (Кыргызстан)', 'KG', 'KG', 'KGZ', '417', 'KG', 'Bishkek ', 'Commonwealth of Independent States ', 'Kyrgyzstani', 'Kyrgyzstanis', 'Som', 'KGS', 4753003, 'Kyrgyzstan', '', 'kyrgyzstan'),
(130, 'Laos (ນລາວ)', 'LA', 'LA', 'LAO', '418', 'LA', 'Vientiane ', 'Southeast Asia ', 'Lao', 'Laos', 'Kip', 'LAK', 5635967, 'Laos', '', 'laos'),
(131, 'Latvia (Latvija)', 'LG', 'LV', 'LVA', '428', 'LV', 'Riga ', 'Europe ', 'Latvian', 'Latvians', 'Latvian Lats', 'LVL', 2385231, 'Latvia', '', 'latvia-latvija'),
(132, 'Lebanon (لبنان)', 'LE', 'LB', 'LBN', '422', 'LB', 'Beirut ', 'Middle East ', 'Lebanese', 'Lebanese', 'Lebanese Pound', 'LBP', 3627774, 'Lebanon', '', 'lebanon'),
(133, 'Lesotho', 'LT', 'LS', 'LSO', '426', 'LS', 'Maseru ', 'Africa ', 'Basotho', 'Mosotho', 'Loti', 'LSL', 2177062, 'Lesotho', '', 'lesotho'),
(134, 'Liberia', 'LI', 'LR', 'LBR', '430', 'LR', 'Monrovia ', 'Africa ', 'Liberian', 'Liberians', 'Liberian Dollar', 'LRD', 3225837, 'Liberia', '', 'liberia'),
(135, 'Libya (ليبيا)', 'LY', 'LY', 'LBY', '434', 'LY', 'Tripoli ', 'Africa ', 'Libyan', 'Libyans', 'Libyan Dinar', 'LYD', 5240599, 'Libya', '', 'libya'),
(136, 'Liechtenstein', 'LS', 'LI', 'LIE', '438', 'LI', 'Vaduz ', 'Europe ', 'Liechtenstein', 'Liechtensteiners', 'Swiss Franc', 'CHF', 32528, 'Liechtenstein', '', 'liechtenstein'),
(137, 'Lithuania (Lietuva)', 'LH', 'LT', 'LTU', '440', 'LT', 'Vilnius ', 'Europe ', 'Lithuanian', 'Lithuanians', 'Lithuanian Litas', 'LTL', 3610535, 'Lithuania', '', 'lithuania-lietuva'),
(138, 'Luxembourg (Lëtzebuerg)', 'LU', 'LU', 'LUX', '442', 'LU', 'Luxembourg ', 'Europe ', 'Luxembourg', 'Luxembourgers', 'Euro', 'EUR', 442972, 'Luxembourg', '', 'luxembourg-l-tzebuerg'),
(139, 'Macao', 'MC', 'MO', 'MAC', '446', 'MO', '', 'Southeast Asia ', 'Chinese', 'Chinese', 'Pataca', 'MOP', 453733, 'Macao', '', 'macao'),
(140, 'Macedonia (Македонија)', 'MK', 'MK', 'MKD', '807', 'MK', 'Skopje ', 'Europe ', 'Macedonian', 'Macedonians', 'Denar', 'MKD', 2046209, 'Makedonija', '', 'macedonia'),
(141, 'Madagascar (Madagasikara)', 'MA', 'MG', 'MDG', '450', 'MG', 'Antananarivo ', 'Africa ', 'Malagasy', 'Malagasy', 'Malagasy Franc', 'MGF', 15982563, 'Madagascar', '', 'madagascar-madagasikara'),
(142, 'Malawi', 'MI', 'MW', 'MWI', '454', 'MW', 'Lilongwe ', 'Africa ', 'Malawian', 'Malawians', 'Kwacha', 'MWK', 10548250, 'Malawi', '', 'malawi'),
(143, 'Malaysia', 'MY', 'MY', 'MYS', '458', 'MY', 'Kuala Lumpur ', 'Southeast Asia ', 'Malaysian', 'Malaysians', 'Malaysian Ringgit', 'MYR', 22229040, 'Malaysia', '', 'malaysia'),
(144, 'Maldives (ގުޖޭއްރާ ޔާއްރިހޫމްޖ)', 'MV', 'MV', 'MDV', '462', 'MV', 'Male ', 'Asia ', 'Maldivian', 'Maldivians', 'Rufiyaa', 'MVR', 310764, 'Maldives', '', 'maldives'),
(145, 'Mali', 'ML', 'ML', 'MLI', '466', 'ML', 'Bamako ', 'Africa ', 'Malian', 'Malians', 'CFA Franc BCEAO', 'XOF', 11008518, 'Mali', '', 'mali'),
(146, 'Malta', 'MT', 'MT', 'MLT', '470', 'MT', 'Valletta ', 'Europe ', 'Maltese', 'Maltese', 'Maltese Lira', 'MTL', 394583, 'Malta', '', 'malta'),
(147, 'Man, Isle of', 'IM', '--', '-- ', '--', 'IM', 'Douglas ', 'Europe ', 'Manxman', 'Manxmen', 'Pound Sterling', 'GBP', 73489, 'The Isle of Man', 'ISO includes with the United Kingdom', 'man-isle-of'),
(148, 'Marshall Islands', 'RM', 'MH', 'MHL', '584', 'MH', 'Majuro ', 'Oceania ', 'Marshallese', 'Marshallese', 'US Dollar', 'USD', 70822, 'The Marshall Islands', '', 'marshall-islands'),
(149, 'Martinique', 'MB', 'MQ', 'MTQ', '474', 'MQ', 'Fort-de-France ', 'Central America and the Caribbean ', 'Martiniquais', 'Martiniquais', 'Euro', 'EUR', 418454, 'Martinique', '', 'martinique'),
(150, 'Mauritania (موريتانيا)', 'MR', 'MR', 'MRT', '478', 'MR', 'Nouakchott ', 'Africa ', 'Mauritanian', 'Mauritanians', 'Ouguiya', 'MRO', 2747312, 'Mauritania', '', 'mauritania'),
(151, 'Mauritius', 'MP', 'MU', 'MUS', '480', 'MU', 'Port Louis ', 'World ', 'Mauritian', 'Mauritians', 'Mauritius Rupee', 'MUR', 1189825, 'Mauritius', '', 'mauritius'),
(152, 'Mayotte', 'MF', 'YT', 'MYT', '175', 'YT', 'Mamoutzou ', 'Africa ', 'Mahorais', 'Mahorais', 'Euro', 'EUR', 163366, 'Mayotte', '', 'mayotte'),
(153, 'Mexico (México)', 'MX', 'MX', 'MEX', '484', 'MX', 'Mexico ', 'North America ', 'Mexican', 'Mexicans', 'Mexican Peso', 'MXN', 101879171, 'Mexico', '', 'mexico-m-xico'),
(154, 'Micronesia', 'FM', 'FM', 'FSM', '583', 'FM', 'Palikir ', 'Oceania ', 'Micronesian', 'Micronesians', 'US Dollar', 'USD', 134597, 'The Federated States of Micronesia', '', 'micronesia'),
(155, 'Midway Islands', 'MQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', 'United States Dollars', 'USD', 0, 'The Midway Islands', 'ISO includes with the US Minor Outlying Islands', 'midway-islands'),
(156, 'Miscellaneous (French)', '--', '--', '-- ', '--', '--', '', '', '', '', '', '', 0, 'Miscellaneous (French)', 'ISO includes Bassas da India, Europa Island, Glorioso Islands, Juan de Nova Island, Tromelin Island', 'miscellaneous-french'),
(157, 'Moldova', 'MD', 'MD', 'MDA', '498', 'MD', 'Chisinau ', 'Commonwealth of Independent States ', 'Moldovan', 'Moldovans', 'Moldovan Leu', 'MDL', 4431570, 'Moldova', '', 'moldova'),
(158, 'Monaco', 'MN', 'MC', 'MCO', '492', 'MC', 'Monaco ', 'Europe ', 'Monegasque', 'Monegasques', 'Euro', 'EUR', 31842, 'Monaco', '', 'monaco'),
(159, 'Mongolia (Монгол Улс)', 'MG', 'MN', 'MNG', '496', 'MN', 'Ulaanbaatar ', 'Asia ', 'Mongolian', 'Mongolians', 'Tugrik', 'MNT', 2654999, 'Mongolia', '', 'mongolia'),
(160, 'Montenegro', '--', '--', '-- ', '--', '--', '', '', '', '', '', '', 0, 'Montenegro', 'now included as region within Yugoslavia', 'montenegro'),
(161, 'Montserrat', 'MH', 'MS', 'MSR', '500', 'MS', 'Plymouth', 'Central America and the Caribbean ', 'Montserratian', 'Montserratians', 'East Caribbean Dollar', 'XCD', 7574, 'Montserrat', '', 'montserrat'),
(162, 'Morocco (المغرب)', 'MO', 'MA', 'MAR', '504', 'MA', 'Rabat ', 'Africa ', 'Moroccan', 'Moroccans', 'Moroccan Dirham', 'MAD', 30645305, 'Morocco', '', 'morocco'),
(163, 'Mozambique (Moçambique)', 'MZ', 'MZ', 'MOZ', '508', 'MZ', 'Maputo ', 'Africa ', 'Mozambican', 'Mozambicans', 'Metical', 'MZM', 19371057, 'Mozambique', '', 'mozambique-mo-ambique'),
(164, 'Myanmar', '--', '--', '-- ', '--', '--', '', '', '', '', 'Kyat', 'MMK', 0, 'Myanmar', 'see Burma', 'myanmar-1'),
(165, 'Myanmar (Burma)', 'BM', 'MM', 'MMR', '104', 'MM', 'Rangoon ', 'Southeast Asia ', 'Burmese', 'Burmese', 'kyat ', 'MMK', 41994678, 'Burma', 'ISO uses the name Myanmar', 'myanmar-burma'),
(166, 'Namibia', 'WA', 'NA', 'NAM', '516', 'NA', 'Windhoek ', 'Africa ', 'Namibian', 'Namibians', 'Namibian Dollar ', 'NAD', 1797677, 'Namibia', '', 'namibia'),
(167, 'Nauru (Naoero)', 'NR', 'NR', 'NRU', '520', 'NR', '', 'Oceania ', 'Nauruan', 'Nauruans', 'Australian Dollar', 'AUD', 12088, 'Nauru', '', 'nauru-naoero'),
(168, 'Navassa Island', 'BQ', '--', '-- ', '--', '--', '', 'Central America and the Caribbean ', '', '', '', '', 0, 'Navassa Island', '', 'navassa-island'),
(169, 'Nepal (नेपाल)', 'NP', 'NP', 'NPL', '524', 'NP', 'Kathmandu ', 'Asia ', 'Nepalese', 'Nepalese', 'Nepalese Rupee', 'NPR', 25284463, 'Nepal', '', 'nepal'),
(170, 'Netherlands (Nederland)', 'NL', 'NL', 'NLD', '528', 'NL', 'Amsterdam ', 'Europe ', 'Dutchman', 'Dutchmen', 'Euro', 'EUR', 15981472, 'The Netherlands', '', 'netherlands-nederland'),
(171, 'Netherlands Antilles', 'NT', 'AN', 'ANT', '530', 'AN', 'Willemstad ', 'Central America and the Caribbean ', 'Dutch Antillean', 'Dutch Antilleans', 'Netherlands Antillean guilder ', 'ANG', 212226, 'The Netherlands Antilles', '', 'netherlands-antilles'),
(172, 'New Caledonia', 'NC', 'NC', 'NCL', '540', 'NC', 'Noumea ', 'Oceania ', 'New Caledonian', 'New Caledonians', 'CFP Franc', 'XPF', 204863, 'New Caledonia', '', 'new-caledonia'),
(173, 'New Zealand', 'NZ', 'NZ', 'NZL', '554', 'NZ', 'Wellington ', 'Oceania ', 'New Zealand', 'New Zealanders', 'New Zealand Dollar', 'NZD', 3864129, 'New Zealand', '', 'new-zealand'),
(174, 'Nicaragua', 'NU', 'NI', 'NIC', '558', 'NI', 'Managua ', 'Central America and the Caribbean ', 'Nicaraguan', 'Nicaraguans', 'Cordoba Oro', 'NIO', 4918393, 'Nicaragua', '', 'nicaragua'),
(175, 'Niger', 'NG', 'NE', 'NER', '562', 'NE', 'Niamey ', 'Africa ', 'Nigerien', 'Nigeriens', 'CFA Franc BCEAO', 'XOF', 10355156, 'Niger', '', 'niger'),
(176, 'Nigeria', 'NI', 'NG', 'NGA', '566', 'NG', 'Abuja', 'Africa ', 'Nigerian', 'Nigerians', 'Naira', 'NGN', 126635626, 'Nigeria', '', 'nigeria'),
(177, 'Niue', 'NE', 'NU', 'NIU', '570', 'NU', 'Alofi ', 'Oceania ', 'Niuean', 'Niueans', 'New Zealand Dollar', 'NZD', 2124, 'Niue', '', 'niue'),
(178, 'Norfolk Island', 'NF', 'NF', 'NFK', '574', 'NF', 'Kingston ', 'Oceania ', 'Norfolk Islander', 'Norfolk Islanders', 'Australian Dollar', 'AUD', 1879, 'Norfolk Island', '', 'norfolk-island'),
(179, 'North Korea (조', 'KN', 'KP', 'PRK', '408', 'KP', 'P''yongyang ', 'Asia ', 'Korean', 'Koreans', 'North Korean Won', 'KPW', 21968228, 'North Korea', '', 'north-korea'),
(180, 'Northern Mariana Islands', 'CQ', 'MP', 'MNP', '580', 'MP', 'Saipan ', 'Oceania ', '', '', 'US Dollar', 'USD', 74612, 'The Northern Mariana Islands', '', 'northern-mariana-islands'),
(181, 'Norway (Norge)', 'NO', 'NO', 'NOR', '578', 'NO', 'Oslo ', 'Europe ', 'Norwegian', 'Norwegians', 'Norwegian Krone', 'NOK', 4503440, 'Norway', '', 'norway-norge'),
(182, 'Oman (عمان)', 'MU', 'OM', 'OMN', '512', 'OM', 'Muscat ', 'Middle East ', 'Omani', 'Omanis', 'Rial Omani', 'OMR', 2622198, 'Oman', '', 'oman'),
(183, 'Pakistan (پاکستان)', 'PK', 'PK', 'PAK', '586', 'PK', 'Islamabad ', 'Asia ', 'Pakistani', 'Pakistanis', 'Pakistan Rupee', 'PKR', 144616639, 'Pakistan', '', 'pakistan'),
(184, 'Palau (Belau)', 'PS', 'PW', 'PLW', '585', 'PW', 'Koror ', 'Oceania ', 'Palauan', 'Palauans', 'US Dollar', 'USD', 19092, 'Palau', '', 'palau-belau'),
(185, 'Palestinian Territories', '--', 'PS', 'PSE', '275', 'PS', '', '', '', '', '', '', 0, 'Palestine', 'NULL', 'palestinian-territories'),
(186, 'Palmyra Atoll', 'LQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', '', '', 0, 'Palmyra Atoll', 'ISO includes with the US Minor Outlying Islands', 'palmyra-atoll'),
(187, 'Panama (Panamá)', 'PM', 'PA', 'PAN', '591', 'PA', 'Panama ', 'Central America and the Caribbean ', 'Panamanian', 'Panamanians', 'balboa ', 'PAB', 2845647, 'Panama', '', 'panama-panam'),
(188, 'Papua New Guinea', 'PP', 'PG', 'PNG', '598', 'PG', 'Port Moresby ', 'Oceania ', 'Papua New Guinean', 'Papua New Guineans', 'Kina', 'PGK', 5049055, 'Papua New Guinea', '', 'papua-new-guinea'),
(189, 'Paracel Islands', 'PF', '--', '-- ', '--', '--', '', 'Southeast Asia ', '', '', '', '', 0, 'The Paracel Islands', '', 'paracel-islands'),
(190, 'Paraguay', 'PA', 'PY', 'PRY', '600', 'PY', 'Asuncion ', 'South America ', 'Paraguayan', 'Paraguayans', 'Guarani', 'PYG', 5734139, 'Paraguay', '', 'paraguay'),
(191, 'Peru (Perú)', 'PE', 'PE', 'PER', '604', 'PE', 'Lima ', 'South America ', 'Peruvian', 'Peruvians', 'Nuevo Sol', 'PEN', 27483864, 'Peru', '', 'peru-per'),
(192, 'Philippines (Pilipinas)', 'RP', 'PH', 'PHL', '608', 'PH', 'Manila ', 'Southeast Asia ', 'Philippine', 'Filipinos', 'Philippine Peso', 'PHP', 82841518, 'The Philippines', '', 'philippines-pilipinas'),
(193, 'Pitcairn', 'PC', 'PN', 'PCN', '612', 'PN', 'Adamstown ', 'Oceania ', 'Pitcairn Islander', 'Pitcairn Islanders', 'New Zealand Dollar', 'NZD', 47, 'The Pitcairn Islands', '', 'pitcairn'),
(194, 'Poland (Polska)', 'PL', 'PL', 'POL', '616', 'PL', 'Warsaw ', 'Europe ', 'Polish', 'Poles', 'Zloty', 'PLN', 38633912, 'Poland', '', 'poland-polska'),
(195, 'Portugal', 'PO', 'PT', 'PRT', '620', 'PT', 'Lisbon ', 'Europe ', 'Portuguese', 'Portuguese', 'Euro', 'EUR', 10066253, 'Portugal', '', 'portugal'),
(196, 'Puerto Rico', 'RQ', 'PR', 'PRI', '630', 'PR', 'San Juan ', 'Central America and the Caribbean ', 'Puerto Rican', 'Puerto Ricans', 'US Dollar', 'USD', 3937316, 'Puerto Rico', '', 'puerto-rico'),
(197, 'Qatar (قطر)', 'QA', 'QA', 'QAT', '634', 'QA', 'Doha ', 'Middle East ', 'Qatari', 'Qataris', 'Qatari Rial', 'QAR', 769152, 'Qatar', '', 'qatar'),
(198, 'Reunion', 'RE', 'RE', 'REU', '638', 'RE', 'Saint-Denis', 'World', 'Reunionese', 'Reunionese', 'Euro', 'EUR', 732570, 'Réunion', '', 'reunion'),
(199, 'Romania (România)', 'RO', 'RO', 'ROU', '642', 'RO', 'Bucharest ', 'Europe ', 'Romanian', 'Romanians', 'Leu', 'ROL', 22364022, 'Romania', '', 'romania-rom-nia'),
(200, 'Russia (', 'RS', 'RU', 'RUS', '643', 'RU', 'Moscow ', 'Asia ', 'Russian', 'Russians', 'Russian Ruble', 'RUB', 145470197, 'Russia', '', 'russia'),
(201, 'Rwanda', 'RW', 'RW', 'RWA', '646', 'RW', 'Kigali ', 'Africa ', 'Rwandan', 'Rwandans', 'Rwanda Franc', 'RWF', 7312756, 'Rwanda', '', 'rwanda'),
(202, 'Saint Helena', 'SH', 'SH', 'SHN', '654', 'SH', 'Jamestown ', 'Africa ', 'Saint Helenian', 'Saint Helenians', 'Saint Helenian Pound ', 'SHP', 7266, 'Saint Helena', '', 'saint-helena'),
(203, 'Saint Kitts and Nevis', 'SC', 'KN', 'KNA', '659', 'KN', 'Basseterre ', 'Central America and the Caribbean ', 'Kittitian and Nevisian', 'Kittitians and Nevisians', 'East Caribbean Dollar ', 'XCD', 38756, 'Saint Kitts and Nevis', '', 'saint-kitts-and-nevis'),
(204, 'Saint Lucia', 'ST', 'LC', 'LCA', '662', 'LC', 'Castries ', 'Central America and the Caribbean ', 'Saint Lucian', 'Saint Lucians', 'East Caribbean Dollar ', 'XCD', 158178, 'Saint Lucia', '', 'saint-lucia'),
(205, 'Saint Pierre and Miquelon', 'SB', 'PM', 'SPM', '666', 'PM', 'Saint-Pierre ', 'North America ', 'Frenchman', 'Frenchmen', 'Euro', 'EUR', 6928, 'Saint Pierre and Miquelon', '', 'saint-pierre-and-miquelon'),
(206, 'Saint Vincent and the Grenadines', 'VC', 'VC', 'VCT', '670', 'VC', 'Kingstown ', 'Central America and the Caribbean ', 'Saint Vincentian', 'Saint Vincentians', 'East Caribbean Dollar ', 'XCD', 115942, 'Saint Vincent and the Grenadines', '', 'saint-vincent-and-the-grenadines'),
(207, 'Samoa', 'WS', 'WS', 'WSM', '882', 'WS', 'Apia ', 'Oceania ', 'Samoan', 'Samoans', 'Tala', 'WST', 179058, 'Samoa', 'NULL', 'samoa'),
(208, 'San Marino', 'SM', 'SM', 'SMR', '674', 'SM', 'San Marino ', 'Europe ', 'Sammarinese', 'Sammarinese', 'Euro', 'EUR', 27336, 'San Marino', '', 'san-marino'),
(209, 'São Tomé and Príncipe', 'TP', 'ST', 'STP', '678', 'ST', 'Sao Tome', 'Africa', 'Sao Tomean', 'Sao Tomeans', 'Dobra', 'STD', 165034, 'São Tomé and Príncipe', '', 's-o-tom-and-pr-ncipe'),
(210, 'Saudi Arabia (المملكة العربية الس', 'SA', 'SA', 'SAU', '682', 'SA', 'Riyadh ', 'Middle East ', 'Saudi Arabian ', 'Saudis', 'Saudi Riyal', 'SAR', 22757092, 'Saudi Arabia', '', 'saudi-arabia'),
(211, 'Senegal (Sénégal)', 'SG', 'SN', 'SEN', '686', 'SN', 'Dakar ', 'Africa ', 'Senegalese', 'Senegalese', 'CFA Franc BCEAO', 'XOF', 10284929, 'Senegal', '', 'senegal-s-n-gal'),
(212, 'Serbia', '--', '--', '-- ', '--', '--', '', '', '', '', '', '', 0, 'Serbia', 'now included as region within Yugoslavia', 'serbia'),
(213, 'Serbia and Montenegro', '--', '--', '-- ', '--', '--', '', '', '', '', '', '', 0, 'Serbia and Montenegro', 'See Yugoslavia', 'serbia-and-montenegro'),
(214, 'Seychelles', 'SE', 'SC', 'SYC', '690', 'SC', 'Victoria ', 'Africa ', 'Seychellois', 'Seychellois', 'Seychelles Rupee', 'SCR', 79715, 'Seychelles', '', 'seychelles'),
(215, 'Sierra Leone', 'SL', 'SL', 'SLE', '694', 'SL', 'Freetown ', 'Africa ', 'Sierra Leonean', 'Sierra Leoneans', 'Leone', 'SLL', 5426618, 'Sierra Leone', '', 'sierra-leone'),
(216, 'Singapore (Singapura)', 'SN', 'SG', 'SGP', '702', 'SG', 'Singapore ', 'Southeast Asia ', 'Singaporeian', 'Singaporeans', 'Singapore Dollar', 'SGD', 4300419, 'Singapore', '', 'singapore-singapura'),
(217, 'Slovakia (Slovensko)', 'LO', 'SK', 'SVK', '703', 'SK', 'Bratislava ', 'Europe ', 'Slovakian', 'Slovaks', 'Slovak Koruna', 'SKK', 5414937, 'Slovakia', '', 'slovakia-slovensko'),
(218, 'Slovenia (Slovenija)', 'SI', 'SI', 'SVN', '705', 'SI', 'Ljubljana ', 'Europe ', 'Slovenian', 'Slovenes', 'Euro', 'EUR', 1930132, 'Slovenia', '', 'slovenia-slovenija'),
(219, 'Solomon Islands', 'BP', 'SB', 'SLB', '90', 'SB', 'Honiara ', 'Oceania ', 'Solomon Islander', 'Solomon Islanders', 'Solomon Islands Dollar', 'SBD', 480442, 'The Solomon Islands', '', 'solomon-islands'),
(220, 'Somalia (Soomaaliya)', 'SO', 'SO', 'SOM', '706', 'SO', 'Mogadishu ', 'Africa ', 'Somali', 'Somalis', 'Somali Shilling', 'SOS', 7488773, 'Somalia', '', 'somalia-soomaaliya'),
(221, 'South Africa', 'SF', 'ZA', 'ZAF', '710', 'ZA', 'Pretoria', 'Africa ', 'South African', 'South Africans', 'Rand', 'ZAR', 43586097, 'South Africa', '', 'south-africa'),
(222, 'South Georgia and the South Sandwich Islands', 'SX', 'GS', 'SGS', '239', 'GS', '', 'Antarctic Region ', '', '', 'Pound Sterling', 'GBP', 0, 'The South Georgia and the South Sandwich Islands', '', 'south-georgia-and-the-south-sandwich-islands'),
(223, 'South Korea (한국)', 'KS', 'KR', 'KOR', '410', 'KR', 'Seoul ', 'Asia ', 'Korean', 'Koreans', 'Won', 'KRW', 47904370, 'South Korea', '', 'south-korea'),
(224, 'Spain (España)', 'SP', 'ES', 'ESP', '724', 'ES', 'Madrid ', 'Europe ', 'Spanish', 'Spaniards', 'Euro', 'EUR', 40037995, 'Spain', '', 'spain-espa-a'),
(225, 'Spratly Islands', 'PG', '--', '-- ', '--', '--', '', 'Southeast Asia ', '', '', '', '', 0, 'The Spratly Islands', '', 'spratly-islands'),
(226, 'Sri Lanka', 'CE', 'LK', 'LKA', '144', 'LK', 'Colombo', 'Asia ', 'Sri Lankan', 'Sri Lankans', 'Sri Lanka Rupee', 'LKR', 19408635, 'Sri Lanka', '', 'sri-lanka'),
(227, 'Sudan (السودان)', 'SU', 'SD', 'SDN', '736', 'SD', 'Khartoum ', 'Africa ', 'Sudanese', 'Sudanese', 'Sudanese Dinar', 'SDD', 36080373, 'Sudan', '', 'sudan'),
(228, 'Suriname', 'NS', 'SR', 'SUR', '740', 'SR', 'Paramaribo ', 'South America ', 'Surinamese', 'Surinamers', 'Suriname Guilder', 'SRG', 433998, 'Suriname', '', 'suriname'),
(229, 'Svalbard and Jan Mayen', 'SV', 'SJ', 'SJM', '744', 'SJ', 'Longyearbyen ', 'Arctic Region ', '', '', 'Norwegian Krone', 'NOK', 2332, 'Svalbard', 'ISO includes Jan Mayen', 'svalbard-and-jan-mayen'),
(230, 'Swaziland', 'WZ', 'SZ', 'SWZ', '748', 'SZ', 'Mbabane ', 'Africa ', 'Swazi', 'Swazis', 'Lilangeni', 'SZL', 1104343, 'Swaziland', '', 'swaziland'),
(231, 'Sweden (Sverige)', 'SW', 'SE', 'SWE', '752', 'SE', 'Stockholm ', 'Europe ', 'Swedish', 'Swedes', 'Swedish Krona', 'SEK', 8875053, 'Sweden', '', 'sweden-sverige'),
(232, 'Switzerland (Schweiz)', 'SZ', 'CH', 'CHE', '756', 'CH', 'Bern ', 'Europe ', 'Swiss', 'Swiss', 'Swiss Franc', 'CHF', 7283274, 'Switzerland', '', 'switzerland-schweiz'),
(233, 'Syria (سوريا)', 'SY', 'SY', 'SYR', '760', 'SY', 'Damascus ', 'Middle East ', 'Syrian', 'Syrians', 'Syrian Pound', 'SYP', 16728808, 'Syria', '', 'syria'),
(234, 'Taiwan (台灣)', 'TW', 'TW', 'TWN', '158', 'TW', 'Taipei ', 'Southeast Asia ', 'Taiwanese', 'Taiwanese', 'New Taiwan Dollar', 'TWD', 22370461, 'Taiwan', '', 'taiwan'),
(235, 'Tajikistan (Тоҷикистон)', 'TI', 'TJ', 'TJK', '762', 'TJ', 'Dushanbe ', 'Commonwealth of Independent States ', 'Tajikistani', 'Tajikistanis', 'Somoni', 'TJS', 6578681, 'Tajikistan', '', 'tajikistan'),
(236, 'Tanzania', 'TZ', 'TZ', 'TZA', '834', 'TZ', 'Dar es Salaam', 'Africa ', 'Tanzanian', 'Tanzanians', 'Tanzanian Shilling', 'TZS', 36232074, 'Tanzania', '', 'tanzania'),
(237, 'Thailand (ราชอาณาจักรไท', 'TH', 'TH', 'THA', '764', 'TH', 'Bangkok ', 'Southeast Asia ', 'Thai', 'Thai', 'Baht', 'THB', 61797751, 'Thailand', '', 'thailand'),
(238, 'Timor-Leste', 'TT', 'TL', 'TLS', '626', 'TP', '', '', '', '', 'Timor Escudo', 'TPE', 1040880, 'East Timor', 'NULL', 'timor-leste'),
(239, 'Togo', 'TO', 'TG', 'TGO', '768', 'TG', 'Lome ', 'Africa ', 'Togolese', 'Togolese', 'CFA Franc BCEAO', 'XOF', 5153088, 'Togo', '', 'togo'),
(240, 'Tokelau', 'TL', 'TK', 'TKL', '772', 'TK', '', 'Oceania ', 'Tokelauan', 'Tokelauans', 'New Zealand Dollar', 'NZD', 1445, 'Tokelau', '', 'tokelau'),
(241, 'Tonga', 'TN', 'TO', 'TON', '776', 'TO', 'Nuku''alofa ', 'Oceania ', 'Tongan', 'Tongans', 'Pa''anga', 'TOP', 104227, 'Tonga', '', 'tonga'),
(242, 'Trinidad and Tobago', 'TD', 'TT', 'TTO', '780', 'TT', 'Port-of-Spain ', 'Central America and the Caribbean ', 'Trinidadian and Tobagonian', 'Trinidadians and Tobagonians', 'Trinidad and Tobago Dollar', 'TTD', 1169682, 'Trinidad and Tobago', '', 'trinidad-and-tobago'),
(243, 'Tromelin Island', 'TE', '--', '-- ', '--', '--', '', 'Africa ', '', '', '', '', 0, 'Tromelin Island', 'ISO includes with the Miscellaneous (French) Indian Ocean Islands', 'tromelin-island'),
(244, 'Tunisia (تونس)', 'TS', 'TN', 'TUN', '788', 'TN', 'Tunis ', 'Africa ', 'Tunisian', 'Tunisians', 'Tunisian Dinar', 'TND', 9705102, 'Tunisia', '', 'tunisia'),
(245, 'Turkey (Türkiye)', 'TU', 'TR', 'TUR', '792', 'TR', 'Ankara ', 'Middle East ', 'Turkish', 'Turks', 'Turkish Lira', 'TRL', 66493970, 'Turkey', '', 'turkey-t-rkiye'),
(246, 'Turkmenistan (Türkmenistan)', 'TX', 'TM', 'TKM', '795', 'TM', 'Ashgabat ', 'Commonwealth of Independent States ', 'Turkmen', 'Turkmens', 'Manat', 'TMM', 4603244, 'Turkmenistan', '', 'turkmenistan-t-rkmenistan'),
(247, 'Turks and Caicos Islands', 'TK', 'TC', 'TCA', '796', 'TC', 'Cockburn Town ', 'Central America and the Caribbean ', '', '', 'US Dollar', 'USD', 18122, 'The Turks and Caicos Islands', '', 'turks-and-caicos-islands'),
(248, 'Tuvalu', 'TV', 'TV', 'TUV', '798', 'TV', 'Funafuti ', 'Oceania ', 'Tuvaluan', 'Tuvaluans', 'Australian Dollar', 'AUD', 10991, 'Tuvalu', '', 'tuvalu'),
(249, 'Uganda', 'UG', 'UG', 'UGA', '800', 'UG', 'Kampala ', 'Africa ', 'Ugandan', 'Ugandans', 'Uganda Shilling', 'UGX', 23985712, 'Uganda', '', 'uganda'),
(250, 'Ukraine (Україна)', 'UP', 'UA', 'UKR', '804', 'UA', 'Kiev ', 'Commonwealth of Independent States ', 'Ukrainian', 'Ukrainians', 'Hryvnia', 'UAH', 48760474, 'The Ukraine', '', 'ukraine'),
(251, 'United Arab Emirates (الإمارات العرب', 'AE', 'AE', 'ARE', '784', 'AE', 'Abu Dhabi ', 'Middle East ', 'Emirati', 'Emiratis', 'UAE Dirham', 'AED', 2407460, 'The United Arab Emirates', '', 'united-arab-emirates'),
(252, 'United Kingdom', 'UK', 'GB', 'GBR', '826', 'UK', 'London ', 'Europe ', 'British', 'Britons', 'Pound Sterling', 'GBP', 59647790, 'The United Kingdom', 'ISO includes Guernsey, Isle of Man, Jersey', 'united-kingdom'),
(253, 'United States', 'US', 'US', 'USA', '840', 'US', 'Washington, DC ', 'North America ', 'American', 'Americans', 'US Dollar', 'USD', 278058881, 'The United States', '', 'united-states'),
(254, 'United States minor outlying islands', '--', 'UM', 'UMI', '581', 'UM', '', '', '', '', 'US Dollar', 'USD', 0, 'The United States Minor Outlying Islands', 'ISO includes Baker Island, Howland Island, Jarvis Island, Johnston Atoll, Kingman Reef, Midway Islands, Palmyra Atoll, Wake Island', 'united-states-minor-outlying-islands'),
(255, 'Uruguay', 'UY', 'UY', 'URY', '858', 'UY', 'Montevideo ', 'South America ', 'Uruguayan', 'Uruguayans', 'Peso Uruguayo', 'UYU', 3360105, 'Uruguay', '', 'uruguay'),
(256, 'Uzbekistan (O&#39;zbekiston)', 'UZ', 'UZ', 'UZB', '860', 'UZ', 'Tashkent', 'Commonwealth of Independent States ', 'Uzbekistani', 'Uzbekistanis', 'Uzbekistan Sum', 'UZS', 25155064, 'Uzbekistan', '', 'uzbekistan-o-39-zbekiston'),
(257, 'Vanuatu', 'NH', 'VU', 'VUT', '548', 'VU', 'Port-Vila ', 'Oceania ', 'Ni-Vanuatu', 'Ni-Vanuatu', 'Vatu', 'VUV', 192910, 'Vanuatu', '', 'vanuatu'),
(258, 'Vatican City (Citt', 'VT', 'VA', 'VAT', '336', 'VA', 'Vatican City ', 'Europe ', '', '', 'Euro', 'EUR', 890, 'The Vatican City', '', 'vatican-city-citt-del-vaticano'),
(259, 'Venezuela', 'VE', 'VE', 'VEN', '862', 'VE', 'Caracas ', 'South America, Central America and the Caribbean ', 'Venezuelan', 'Venezuelans', 'Bolivar', 'VEB', 23916810, 'Venezuela', '', 'venezuela'),
(260, 'Vietnam (Việt Nam)', 'VM', 'VN', 'VNM', '704', 'VN', 'Hanoi ', 'Southeast Asia ', 'Vietnamese', 'Vietnamese', 'Dong', 'VND', 79939014, 'Vietnam', '', 'vietnam-vi-t-nam'),
(261, 'Virgin Islands (UK)', '--', '--', '-- ', '--', '--', '', '', '', '', 'US Dollar', 'USD', 0, 'Virgin Islands (UK)', 'see British Virgin Islands', 'virgin-islands-uk'),
(262, 'Virgin Islands (US)', '--', '--', '-- ', '--', '--', '', '', '', '', 'US Dollar', 'USD', 0, 'Virgin Islands (US)', 'see Virgin Islands', 'virgin-islands-us'),
(263, 'Virgin Islands, British', 'VI', 'VG', 'VGB', '92', 'VG', 'Road Town ', 'Central America and the Caribbean ', 'British Virgin Islander', 'British Virgin Islanders', 'US Dollar', 'USD', 20812, 'The British Virgin Islands', '', 'virgin-islands-british'),
(264, 'Virgin Islands, U.S.', 'VQ', 'VI', 'VIR', '850', 'VI', 'Charlotte Amalie ', 'Central America and the Caribbean ', 'Virgin Islander', 'Virgin Islanders', 'US Dollar', 'USD', 122211, 'The Virgin Islands', '', 'virgin-islands-u-s'),
(265, 'Wake Island', 'WQ', '--', '-- ', '--', '--', '', 'Oceania ', '', '', 'US Dollar', 'USD', 0, 'Wake Island', 'ISO includes with the US Minor Outlying Islands', 'wake-island'),
(266, 'Wallis and Futuna', 'WF', 'WF', 'WLF', '876', 'WF', 'Mata-Utu', 'Oceania ', 'Wallis and Futuna Islander', 'Wallis and Futuna Islanders', 'CFP Franc', 'XPF', 15435, 'Wallis and Futuna', '', 'wallis-and-futuna'),
(267, 'West Bank', 'WE', '--', '-- ', '--', '--', '', 'Middle East ', '', '', 'New Israeli Shekel ', 'ILS', 2090713, 'The West Bank', '', 'west-bank'),
(268, 'Western Sahara (الصحراء الغربية)', 'WI', 'EH', 'ESH', '732', 'EH', '', 'Africa ', 'Sahrawian', 'Sahrawis', 'Moroccan Dirham', 'MAD', 250559, 'Western Sahara', '', 'western-sahara'),
(269, 'Western Samoa', '--', '--', '-- ', '--', '--', '', '', '', '', 'Tala', 'WST', 0, 'Western Samoa', 'see Samoa', 'western-samoa'),
(270, 'World', '--', '--', '-- ', '--', '--', '', 'World, Time Zones ', '', '', '', '', 1862433264, 'The World', 'NULL', 'world'),
(271, 'Yemen (اليمن)', 'YM', 'YE', 'YEM', '887', 'YE', 'Sanaa ', 'Middle East ', 'Yemeni', 'Yemenis', 'Yemeni Rial', 'YER', 18078035, 'Yemen', '', 'yemen'),
(272, 'Yugoslavia', 'YI', 'YU', 'YUG', '891', 'YU', 'Belgrade ', 'Europe ', 'Serbian', 'Serbs', 'Yugoslavian Dinar ', 'YUM', 10677290, 'Yugoslavia', 'NULL', 'yugoslavia'),
(273, 'Zaire', '--', '--', '-- ', '--', '--', '', '', '', '', '', '', 0, 'Zaire', 'see Democratic Republic of the Congo', 'zaire'),
(274, 'Zambia', 'ZA', 'ZM', 'ZWB', '894', 'ZM', 'Lusaka ', 'Africa ', 'Zambian', 'Zambians', 'Kwacha', 'ZMK', 9770199, 'Zambia', '', 'zambia'),
(275, 'Zimbabwe', 'ZI', 'ZW', 'ZWE', '716', 'ZW', 'Harare ', 'Africa ', 'Zimbabwean', 'Zimbabweans', 'Zimbabwe Dollar', 'ZWD', 11365366, 'Zimbabwe', '', 'zimbabwe');


-- --------------------------------------------------------

--
-- Table structure for table `countries_unions`
--

DROP TABLE IF EXISTS `countries_unions`;
CREATE TABLE IF NOT EXISTS `countries_unions` (
  `id` int(11) NOT NULL auto_increment,
  `country_id` int(11) NOT NULL,
  `union_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `union_id` (`union_id`),
  KEY `country_id` (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `countries_unions`
--

INSERT INTO `countries_unions` (`id`, `country_id`, `union_id`) VALUES
(1, 15, 1),
(2, 24, 1),
(3, 36, 1),
(4, 61, 1),
(5, 63, 1),
(6, 72, 1),
(7, 78, 1),
(8, 79, 1),
(9, 92, 1),
(10, 107, 1),
(11, 113, 1),
(12, 131, 1),
(13, 137, 1),
(14, 138, 1),
(15, 146, 1),
(16, 194, 1),
(17, 195, 1),
(18, 199, 1),
(19, 217, 1),
(20, 218, 1),
(21, 224, 1),
(22, 231, 1),
(23, 14, 2),
(24, 35, 2),
(25, 39, 2),
(26, 47, 2),
(27, 109, 2),
(28, 110, 2),
(29, 118, 2),
(30, 130, 2),
(31, 143, 2),
(32, 164, 2),
(33, 173, 2),
(34, 216, 2),
(35, 223, 2),
(36, 237, 2),
(37, 260, 2);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `from` varchar(500) collate utf8_unicode_ci default NULL,
  `reply_to` varchar(500) collate utf8_unicode_ci default NULL,
  `name` varchar(150) collate utf8_unicode_ci default NULL,
  `description` text collate utf8_unicode_ci,
  `subject` varchar(255) collate utf8_unicode_ci default NULL,
  `email_content` text collate utf8_unicode_ci,
  `email_variables` varchar(1000) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Site Email Templates';

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `created`, `modified`, `from`, `reply_to`, `name`, `description`, `subject`, `email_content`, `email_variables`) VALUES
(1, '2009-02-20 10:24:49', '2012-02-28 02:01:48', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Forgot Password', 'we will send this mail, when user submit the forgot password form.', 'Forgot password', 'Hi ##USERNAME##,\n\nA password reset request has been made for your user account at ##SITE_NAME##.\n\nIf you made this request, please click on the following link:\n##RESET_URL##\n\nIf you did not request this action and feel this is in error, please contact us at ##CONTACT_MAIL##.\n\nThanks,\n##SITE_NAME##\n##SITE_URL##\n', 'USERNAME,RESET_URL,SITE_NAME'),
(2, '2009-02-20 10:15:57', '2011-06-11 09:36:01', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Activation Request', 'we will send this mail, when user registering an account he/she will get an activation request.', 'Please activate your ##SITE_NAME## account', 'Hi ##USERNAME##,\n\nYour account has been created. Please visit the following URL to activate your account.\n##ACTIVATION_URL##\n\nThanks,\n##SITE_NAME##\n##SITE_LINK##\n', 'SITE_NAME,USERNAME,ACTIVATION_URL'),
(3, '2009-02-20 10:15:19', '2012-05-12 05:00:06', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'New User Join', 'we will send this mail to admin, when a new user registered in the site. For this you have to enable "admin mail after register" in the settings page.', 'New user joined in ##SITE_NAME## account', 'Hi, \n\nA new user named "##USERNAME##" has joined in ##SITE_NAME## account.\n\nUsername: ##USERNAME##\nEmail: ##USEREMAIL##\nSignup IP: ##SIGNUPIP##\n\n\nThanks,\n##SITE_NAME##\n##SITE_URL##', 'SITE_NAME,USERNAME'),
(4, '2009-03-02 00:00:00', '2011-06-03 13:22:27', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Admin User Add', 'we will send this mail to user, when a admin add a new user.', 'Welcome to ##SITE_NAME##', 'Hi ##USERNAME##,\n\n##SITE_NAME## team added you as a user in ##SITE_NAME##.\n\nYour account details.\n##LOGINLABEL##:##USEDTOLOGIN##\nPassword:##PASSWORD##\n\nThanks,\n##SITE_NAME##\n##SITE_URL##', 'SITE_NAME,USERNAME,PASSWORD, LOGINLABEL, USEDTOLOGIN'),
(5, '2009-05-22 16:51:14', '2011-06-11 09:36:56', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Welcome Email', 'we will send this mail, when user register in this site and get activate.', 'Welcome to ##SITE_NAME##', 'Hi ##USERNAME##,\r\n\r\nWe wish to say a quick hello and thanks for registering at ##SITE_NAME##.\r\n\r\nIf you did not request this account and feel this is an error, please contact us at ##CONTACT_MAIL##\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##\r\n', 'SITE_NAME,\r\nUSERNAME,\r\nSUPPORT_EMAIL'),
(6, '2009-05-22 16:45:38', '2011-06-03 13:23:07', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Admin User Active ', 'We will send this mail to user, when user active by administator.', 'Your ##SITE_NAME## account has been activated', 'Hi ##USERNAME##,\n\nYour account has been activated.\n\nThanks,\n##SITE_NAME##\n##SITE_LINK##\n', 'SITE_NAME,USERNAME'),
(7, '2009-05-22 16:48:38', '2011-06-03 13:23:21', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Admin User Deactivate', 'We will send this mail to user, when user deactive by administator.', 'Your ##SITE_NAME## account has been deactivated', 'Hi ##USERNAME##,\n\nYour ##SITE_NAME## account has been deactivated.\n\nThanks,\n##SITE_NAME##\n##SITE_LINK##\n', 'SITE_NAME,USERNAME'),
(8, '2009-05-22 16:50:25', '2011-06-03 13:23:43', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Admin User Delete', 'We will send this mail to user, when user delete by administrator.', 'Your ##SITE_NAME## account has been removed', 'Hi ##USERNAME##,\n\nYour ##SITE_NAME## account has been removed.\n\nThanks,\n##SITE_NAME##\n##SITE_LINK##\n', 'SITE_NAME,USERNAME'),
(9, '2009-07-07 15:47:09', '2011-06-03 13:24:02', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Admin Change Password', 'we will send this mail to user, when admin change user''s password.', 'Password changed', 'Hi ##USERNAME##,\n\nAdmin reset your password for your ##SITE_NAME## account.\n\nYour new password:\n##PASSWORD##\n\nThanks,\n##SITE_NAME##\n##SITE_LINK##\n', 'SITE_NAME,PASSWORD,USERNAME'),
(10, '2009-10-14 18:31:14', '2011-06-03 13:24:31', '##FIRST_NAME####LAST_NAME## <##FROM_EMAIL##>', '##FROM_EMAIL##', 'Contact Us ', 'We will send this mail to admin, when user submit any contact form.', '[##SITE_NAME##] ##SUBJECT##', '##MESSAGE##\n\n----------------------------------------------------\nTelephone  : ##TELEPHONE##\nIP         : ##IP##, ##SITE_ADDR##\nWhois      : http://whois.sc/##IP##\nURL        : ##FROM_URL##\n----------------------------------------------------', 'FROM_URL, IP, TELEPHONE, MESSAGE, SITE_NAME, SUBJECT,\r\nFROM_EMAIL,\r\nLAST_NAME, FIRST_NAME'),
(11, '2009-10-14 19:20:59', '2011-06-03 13:24:58', '"##SITE_NAME## (auto response)" <##FROM_EMAIL##>', '##REPLY_TO_EMAIL##', 'Contact Us Auto Reply', 'we will send this mail to user, when user submit the contact us form.', '[##SITE_NAME##] RE: ##SUBJECT##', 'Hi ##FIRST_NAME####LAST_NAME##,\n\nThanks for contacting us. We''ll get back to you shortly.\n\nPlease do not reply to this automated response. If you have not contacted us and if you feel this is an error, please contact us through our site\n##CONTACT_URL##\n\nThanks,\n##SITE_NAME##\n##SITE_URL##\n\n------\nOn ##POST_DATE## you wrote from ##IP## -----\n\n##MESSAGE##\n', 'MESSAGE,\r\nPOST_DATE, SITE_NAME, CONTACT_URL, FIRST_NAME, LAST_NAME,\r\nSUBJECT,\r\nSITE_URL'),
(12, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '##FROM_EMAIL##', '', 'Order status', 'Internal message sent when user order has been shipped/refunded. ', 'Your order has been ##STATUS##', 'Your order has been ##STATUS##\r\n\r\nYour order no is: ###ORDER##.\r\n\r\nRemarks:##REMARKS##\r\n\r\n', 'USERNAME,STATUS,ORDER'),
(13, '0000-00-00 00:00:00', '2012-05-25 14:09:36', '##FROM_EMAIL##', '', 'New order notification', 'Internal mail sent to the user when he makes a new order.', 'You have placed new order', 'You have placed new order in ##SITE_NAME##\n\n\n----------------------------------\nInformation about your order\n----------------------------------\n\nOrder No: ###ORDER_NO##\n\n\nPurchased Items\n\n##ITEMS##\n', 'SITE_NAME,USERNAME,ORDER,ITEMS'),
(14, '0000-00-00 00:00:00', '2010-06-29 11:20:50', '##FROM_EMAIL##', '', 'Order Alert Mail', 'This is an external alert mail sent to the user when they receive any message into their internal messages related to orders.', '##SITE_NAME## - ##SUBJECT##', 'Hi ##TO_USER##, \r\n\r\n##MESSAGE##\r\n\r\nTo view the full message and attachments (if any) click on the following\r\nlink:##VIEW_LINK## \r\n\r\nThis is an automatically generated message by ##SITE_NAME##\r\n\r\nReplies are not monitored or answered.\r\n\r\nThanks,\r\n##SITE_NAME##\r\n##SITE_URL##', 'TO_USER,SITE_NAME,FROM_USER,SUBJECT,MESSAGE,VIEW_LINK,SITE_URL,REFER_LINK'),
(16, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '##FROM_EMAIL##', '##REPLY_TO_EMAIL##', 'Buyers list for a product', 'When product get closed, seller will get buys list who are downloaded that product', 'List of buyers for "##PRODUCT_NAME##" product', '<style type="text/css">\r\n<!--\r\n.style1 {\r\n	color: #00b5c8\r\n}\r\n-->\r\n</style>\r\n<div style="padding: 10px; width: 720px; margin: auto;">\r\n<table width="720px" cellspacing="0" cellpadding="0">\r\n  <tbody><tr>\r\n    <td align="center">\r\n      <p style="text-align: center; font-size: 11px; color: rgb(146, 146, 146); margin: 3px;">\r\n        Be sure to add\r\n        <a href="mailto:##FROM_EMAIL##" style="color: #00b5c8;" title="Add ##FROM_EMAIL## to your whitelist" target="_blank">##FROM_EMAIL##</a>\r\n        to your address book or safe sender list so our emails get to your inbox.      </p>\r\n    </td>\r\n  </tr>\r\n</tbody></table>\r\n<div style="color:#999; font-family:Arial, Helvetica, sans-serif; font-size:12px; width:600px; margin:0px auto; border:5px solid #bfe27d; padding:20px; background: ebfdff;">\r\n<div style="background:#FFF; padding:10px;">\r\n  <table width="100%" style="background-color: rgb(255, 255, 255);">\r\n<tr>\r\n      <td align="center">\r\n        <div style="padding: 12px; margin: 0pt 30px; border-bottom: 1px solid rgb(214, 214, 214);">\r\n          <a href="##SITE_LINK##" style="color: rgb(255, 255, 255);" title="##SITE_NAME##" target="_blank"><img alt="[Image: ##SITE_NAME##]" src="##SITE_LOGO##"></a>\r\n        </div>\r\n      </td>\r\n    </tr>\r\n    <tr>	\r\n</table>\r\n<p>Hello <strong style="color:#00b5c8;">##USERNAME##</strong>,</p>\r\n\r\n<p>Buyers list for <a href=''##PRODUCT_URL##'' title=''##PRODUCT_NAME##'' style="color:#00b5c8">##PRODUCT_NAME##</a></p>\r\n\r\n<div>\r\n         ##TABLE##\r\n<div>\r\n	<div style="margin:0px 0px;padding:20px 10px; text-align:center;">\r\n			<h6 style="color:#00b5c8; font-family:Helvetica,Arial,sans-serif; font-size:22px; font-weight:700; line-height:26px; margin:0 0 5px; text-align:center;">Thanks</h6>\r\n		<p style="color:#545454;font-family:Helvetica,Arial,sans-serif;font-size:16px;line-height:20px;margin:0;text-align:center;font-weight:bold;">##SITE_NAME## - ##SITE_LINK##</p>\r\n\r\n	</div>\r\n</div>\r\n\r\n</div>\r\n</div><div style="margin:0; text-align:center; border-top:2px solid #d9d9d9; background:#e6e6e6; padding:13px 0;">\r\n      <p style="margin:0; font-weight:bold; color:#000;">Need help? Have feedback? Feel free to <a href="##CONTACT_URL##" title="Contact ##SITE_NAME##" target="_blank" class="style1">Contact Us</a> </p>            \r\n    </div>\r\n  </div>\r\n</div>\r\n<p style="text-align:center; font:11px Arial, Helvetica, sans-serif; color:#929292; margin:20px 0;">Delivered by <a href="##SITE_LINK##" style="color: #00b5c8;" title="##SITE_NAME##" target="_blank">##SITE_NAME##</a></p>\r\n</div>', 'FROM_EMAIL,REPLY_TO_EMAIL,SITE_NAME,SITE_LINK,TABLE,USERNAME,PRODUCT,PRODUCT_NAME'),
(17, '0000-00-00 00:00:00', '2012-05-12 09:24:11', '##FROM_EMAIL##', '', 'Send to friend for download alert', 'we will send this mail, when someone order a downloadable product for his friend', 'Friend sent a gift...', 'Hi,\n\nYour friend ##USERNAME## has sent gift for you from ##SITE_NAME##\n\n##MESSAGE##\n\n##URL##\n\nThanks,\n##SITE_NAME##\n##SITE_URL##\n', NULL),
(18, '0000-00-00 00:00:00', '2012-05-29 06:06:43', '##FROM_EMAIL##', '', 'Canceled and Refunded', 'Internal message sent when user order has been shipped/refunded. ', 'Your order has been ##STATUS##', 'Your order has been ##STATUS##\n\nYour order no is: ###ORDER##.\n\n\n', 'USERNAME,STATUS,ORDER');



-- --------------------------------------------------------

--
-- Table structure for table `grouped_countries`
--

DROP TABLE IF EXISTS `grouped_countries`;
CREATE TABLE IF NOT EXISTS `grouped_countries` (
  `id` int(11) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `related_class` varchar(255) collate utf8_unicode_ci default NULL,
  `related_condition` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `grouped_countries`
--

INSERT INTO `grouped_countries` (`id`, `created`, `modified`, `name`, `related_class`, `related_condition`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Afghanistan (افغانستان)', NULL, NULL),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Albania (Shqipëria)', NULL, NULL),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Algeria (الجزائر)', NULL, NULL),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'American Samoa', NULL, NULL),
(5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Andorra', NULL, NULL),
(6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Angola', NULL, NULL),
(7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Anguilla', NULL, NULL),
(8, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Antarctica', NULL, NULL),
(9, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Antigua and Barbuda', NULL, NULL),
(10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Argentina', NULL, NULL),
(11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Armenia (Հայաստան)', NULL, NULL),
(12, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Aruba', NULL, NULL),
(13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Ashmore and Cartier', NULL, NULL),
(14, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Australia', NULL, NULL),
(15, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Austria (Österreich)', NULL, NULL),
(16, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Azerbaijan (Azərbaycan)', NULL, NULL),
(17, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Bahamas', NULL, NULL),
(18, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Bahrain (البحرين)', NULL, NULL),
(19, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Baker Island', NULL, NULL),
(20, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Bangladesh (বাংলাদেশ)', NULL, NULL),
(21, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Barbados', NULL, NULL),
(22, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Bassas da India', NULL, NULL),
(23, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Belarus (Белару́сь)', NULL, NULL),
(24, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Belgium (België)', NULL, NULL),
(25, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Belize', NULL, NULL),
(26, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Benin (Bénin)', NULL, NULL),
(27, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Bermuda', NULL, NULL),
(28, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Bhutan (འབྲུག་ཡུལ)', NULL, NULL),
(29, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Bolivia', NULL, NULL),
(30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Bosnia and Herzegovina (Bosna i Hercegovina)', NULL, NULL),
(31, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Botswana', NULL, NULL),
(32, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Bouvet Island', NULL, NULL),
(33, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Brazil (Brasil)', NULL, NULL),
(34, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'British Indian Ocean Territory', NULL, NULL),
(35, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Brunei (Brunei Darussalam)', NULL, NULL),
(36, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Bulgaria (България)', NULL, NULL),
(37, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Burkina Faso', NULL, NULL),
(38, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Burundi (Uburundi)', NULL, NULL),
(39, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cambodia (Kampuchea)', NULL, NULL),
(40, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cameroon (Cameroun)', NULL, NULL),
(41, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Canada', NULL, NULL),
(42, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cape Verde (Cabo Verde)', NULL, NULL),
(43, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cayman Islands', NULL, NULL),
(44, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Central African Republic (République Centrafricain', NULL, NULL),
(45, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Chad (Tchad)', NULL, NULL),
(46, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Chile', NULL, NULL),
(47, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'China (中国)', NULL, NULL),
(48, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Christmas Island', NULL, NULL),
(49, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Clipperton Island', NULL, NULL),
(50, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cocos Islands', NULL, NULL),
(51, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Colombia', NULL, NULL),
(52, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Comoros (Comores)', NULL, NULL),
(53, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Congo', NULL, NULL),
(54, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Congo, Democratic Republic of the', NULL, NULL),
(55, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cook Islands', NULL, NULL),
(56, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Coral Sea Islands', NULL, NULL),
(57, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Costa Rica', NULL, NULL),
(58, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Côte d''Ivoire', NULL, NULL),
(59, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Croatia (Hrvatska)', NULL, NULL),
(60, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cuba', NULL, NULL),
(61, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cyprus (Κυπρος)', NULL, NULL),
(62, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Czech Republic (Česko)', NULL, NULL),
(63, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Denmark (Danmark)', NULL, NULL),
(64, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Djibouti', NULL, NULL),
(65, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Dominica', NULL, NULL),
(66, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Dominican Republic', NULL, NULL),
(67, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Ecuador', NULL, NULL),
(68, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Egypt (مصر)', NULL, NULL),
(69, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'El Salvador', NULL, NULL),
(70, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Equatorial Guinea (Guinea Ecuatorial)', NULL, NULL),
(71, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Eritrea (Ertra)', NULL, NULL),
(72, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Estonia (Eesti)', NULL, NULL),
(73, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Ethiopia (Ityop&#39;iya)', NULL, NULL),
(74, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Europa Island', NULL, NULL),
(75, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Falkland Islands', NULL, NULL),
(76, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Faroe Islands', NULL, NULL),
(77, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Fiji', NULL, NULL),
(78, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Finland (Suomi)', NULL, NULL),
(79, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'France', NULL, NULL),
(80, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'France, Metropolitan', NULL, NULL),
(81, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'French Guiana', NULL, NULL),
(82, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'French Polynesia', NULL, NULL),
(83, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'French Southern Territories', NULL, NULL),
(84, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Gabon', NULL, NULL),
(85, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Gambia', NULL, NULL),
(86, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Gaza Strip', NULL, NULL),
(87, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Georgia (საქართველო)', NULL, NULL),
(88, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Germany (Deutschland)', NULL, NULL),
(89, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Ghana', NULL, NULL),
(90, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Gibraltar', NULL, NULL),
(91, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Glorioso Islands', NULL, NULL),
(92, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Greece (Ελλάς)', NULL, NULL),
(93, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Greenland', NULL, NULL),
(94, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Grenada', NULL, NULL),
(95, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Guadeloupe', NULL, NULL),
(96, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Guam', NULL, NULL),
(97, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Guatemala', NULL, NULL),
(98, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Guernsey', NULL, NULL),
(99, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Guinea (Guinée)', NULL, NULL),
(100, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Guinea-Bissau (Guiné-Bissau)', NULL, NULL),
(101, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Guyana', NULL, NULL),
(102, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Haiti (Haïti)', NULL, NULL),
(103, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Heard Island and McDonald Islands', NULL, NULL),
(104, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Honduras', NULL, NULL),
(105, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hong Kong', NULL, NULL),
(106, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Howland Island', NULL, NULL),
(107, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hungary (Magyarország)', NULL, NULL),
(108, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Iceland (Ísland)', NULL, NULL),
(109, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'India', NULL, NULL),
(110, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Indonesia', NULL, NULL),
(111, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Iran (ایران)', NULL, NULL),
(112, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Iraq (العراق)', NULL, NULL),
(113, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Ireland', NULL, NULL),
(114, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Israel (ישראל)', NULL, NULL),
(115, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Italy (Italia)', NULL, NULL),
(116, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Jamaica', NULL, NULL),
(117, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Jan Mayen', NULL, NULL),
(118, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Japan (日本)', NULL, NULL),
(119, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Jarvis Island', NULL, NULL),
(120, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Jersey', NULL, NULL),
(121, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Johnston Atoll', NULL, NULL),
(122, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Jordan (الاردن)', NULL, NULL),
(123, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Juan de Nova Island', NULL, NULL),
(124, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kazakhstan (Қазақстан)', NULL, NULL),
(125, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kenya', NULL, NULL),
(126, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kingman Reef', NULL, NULL),
(127, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kiribati', NULL, NULL),
(128, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kuwait (الكويت)', NULL, NULL),
(129, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kyrgyzstan (Кыргызстан)', NULL, NULL),
(130, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Laos (ນລາວ)', NULL, NULL),
(131, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Latvia (Latvija)', NULL, NULL),
(132, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Lebanon (لبنان)', NULL, NULL),
(133, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Lesotho', NULL, NULL),
(134, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Liberia', NULL, NULL),
(135, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Libya (ليبيا)', NULL, NULL),
(136, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Liechtenstein', NULL, NULL),
(137, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Lithuania (Lietuva)', NULL, NULL),
(138, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Luxembourg (Lëtzebuerg)', NULL, NULL),
(139, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Macao', NULL, NULL),
(140, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Macedonia (Македонија)', NULL, NULL),
(141, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Madagascar (Madagasikara)', NULL, NULL),
(142, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Malawi', NULL, NULL),
(143, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Malaysia', NULL, NULL),
(144, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Maldives (ގުޖޭއްރާ ޔާއްރިހޫމްޖ)', NULL, NULL),
(145, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mali', NULL, NULL),
(146, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Malta', NULL, NULL),
(147, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Man, Isle of', NULL, NULL),
(148, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Marshall Islands', NULL, NULL),
(149, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Martinique', NULL, NULL),
(150, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mauritania (موريتانيا)', NULL, NULL),
(151, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mauritius', NULL, NULL),
(152, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mayotte', NULL, NULL),
(153, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mexico (México)', NULL, NULL),
(154, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Micronesia', NULL, NULL),
(155, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Midway Islands', NULL, NULL),
(156, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Miscellaneous (French)', NULL, NULL),
(157, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Moldova', NULL, NULL),
(158, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Monaco', NULL, NULL),
(159, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mongolia (Монгол Улс)', NULL, NULL),
(160, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Montenegro', NULL, NULL),
(161, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Montserrat', NULL, NULL),
(162, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Morocco (المغرب)', NULL, NULL),
(163, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mozambique (Moçambique)', NULL, NULL),
(164, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Myanmar', NULL, NULL),
(165, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Myanmar (Burma)', NULL, NULL),
(166, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Namibia', NULL, NULL),
(167, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Nauru (Naoero)', NULL, NULL),
(168, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Navassa Island', NULL, NULL),
(169, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Nepal (नेपाल)', NULL, NULL),
(170, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Netherlands (Nederland)', NULL, NULL),
(171, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Netherlands Antilles', NULL, NULL),
(172, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'New Caledonia', NULL, NULL),
(173, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'New Zealand', NULL, NULL),
(174, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Nicaragua', NULL, NULL),
(175, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Niger', NULL, NULL),
(176, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Nigeria', NULL, NULL),
(177, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Niue', NULL, NULL),
(178, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Norfolk Island', NULL, NULL),
(179, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'North Korea (조선)', NULL, NULL),
(180, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Northern Mariana Islands', NULL, NULL),
(181, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Norway (Norge)', NULL, NULL),
(182, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Oman (عمان)', NULL, NULL),
(183, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Pakistan (پاکستان)', NULL, NULL),
(184, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Palau (Belau)', NULL, NULL),
(185, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Palestinian Territories', NULL, NULL),
(186, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Palmyra Atoll', NULL, NULL),
(187, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Panama (Panamá)', NULL, NULL),
(188, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Papua New Guinea', NULL, NULL),
(189, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Paracel Islands', NULL, NULL),
(190, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Paraguay', NULL, NULL),
(191, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Peru (Perú)', NULL, NULL),
(192, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Philippines (Pilipinas)', NULL, NULL),
(193, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Pitcairn', NULL, NULL),
(194, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Poland (Polska)', NULL, NULL),
(195, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Portugal', NULL, NULL),
(196, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Puerto Rico', NULL, NULL),
(197, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Qatar (قطر)', NULL, NULL),
(198, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Reunion', NULL, NULL),
(199, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Romania (România)', NULL, NULL),
(200, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Russia (Россия)', NULL, NULL),
(201, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Rwanda', NULL, NULL),
(202, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Saint Helena', NULL, NULL),
(203, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Saint Kitts and Nevis', NULL, NULL),
(204, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Saint Lucia', NULL, NULL),
(205, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Saint Pierre and Miquelon', NULL, NULL),
(206, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Saint Vincent and the Grenadines', NULL, NULL),
(207, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Samoa', NULL, NULL),
(208, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'San Marino', NULL, NULL),
(209, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'São Tomé and Príncipe', NULL, NULL),
(210, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Saudi Arabia (المملكة العربية السعودية)', NULL, NULL),
(211, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Senegal (Sénégal)', NULL, NULL),
(212, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Serbia', NULL, NULL),
(213, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Serbia and Montenegro', NULL, NULL),
(214, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Seychelles', NULL, NULL),
(215, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Sierra Leone', NULL, NULL),
(216, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Singapore (Singapura)', NULL, NULL),
(217, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Slovakia (Slovensko)', NULL, NULL),
(218, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Slovenia (Slovenija)', NULL, NULL),
(219, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Solomon Islands', NULL, NULL),
(220, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Somalia (Soomaaliya)', NULL, NULL),
(221, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'South Africa', NULL, NULL),
(222, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'South Georgia and the South Sandwich Islands', NULL, NULL),
(223, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'South Korea (한국)', NULL, NULL),
(224, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Spain (España)', NULL, NULL),
(225, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Spratly Islands', NULL, NULL),
(226, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Sri Lanka', NULL, NULL),
(227, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Sudan (السودان)', NULL, NULL),
(228, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Suriname', NULL, NULL),
(229, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Svalbard and Jan Mayen', NULL, NULL),
(230, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Swaziland', NULL, NULL),
(231, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Sweden (Sverige)', NULL, NULL),
(232, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Switzerland (Schweiz)', NULL, NULL),
(233, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Syria (سوريا)', NULL, NULL),
(234, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Taiwan (台灣)', NULL, NULL),
(235, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tajikistan (Тоҷикистон)', NULL, NULL),
(236, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tanzania', NULL, NULL),
(237, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Thailand (ราชอาณาจักรไทย)', NULL, NULL),
(238, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Timor-Leste', NULL, NULL),
(239, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Togo', NULL, NULL),
(240, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tokelau', NULL, NULL),
(241, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tonga', NULL, NULL),
(242, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Trinidad and Tobago', NULL, NULL),
(243, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tromelin Island', NULL, NULL),
(244, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tunisia (تونس)', NULL, NULL),
(245, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Turkey (Türkiye)', NULL, NULL),
(246, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Turkmenistan (Türkmenistan)', NULL, NULL),
(247, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Turks and Caicos Islands', NULL, NULL),
(248, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tuvalu', NULL, NULL),
(249, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Uganda', NULL, NULL),
(250, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Ukraine (Україна)', NULL, NULL),
(251, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'United Arab Emirates (الإمارات العربيّة المتّحدة)', NULL, NULL),
(252, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'United Kingdom', NULL, NULL),
(253, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'United States', NULL, NULL),
(254, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'United States minor outlying islands', NULL, NULL),
(255, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Uruguay', NULL, NULL),
(256, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Uzbekistan (O&#39;zbekiston)', NULL, NULL),
(257, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Vanuatu', NULL, NULL),
(258, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Vatican City (Città del Vaticano)', NULL, NULL),
(259, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Venezuela', NULL, NULL),
(260, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Vietnam (Việt Nam)', NULL, NULL),
(261, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Virgin Islands (UK)', NULL, NULL),
(262, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Virgin Islands (US)', NULL, NULL),
(263, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Virgin Islands, British', NULL, NULL),
(264, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Virgin Islands, U.S.', NULL, NULL),
(265, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Wake Island', NULL, NULL),
(266, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Wallis and Futuna', NULL, NULL),
(267, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'West Bank', NULL, NULL),
(268, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Western Sahara (الصحراء الغربية)', NULL, NULL),
(269, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Western Samoa', NULL, NULL),
(270, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'World', NULL, NULL),
(271, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Yemen (اليمن)', NULL, NULL),
(272, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Yugoslavia', NULL, NULL),
(273, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Zaire', NULL, NULL),
(274, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Zambia', NULL, NULL),
(275, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Zimbabwe', NULL, NULL),
(-1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'European Union', 'Union', '1'),
(-2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'ASEAN+', 'Union', '2'),
(-3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'North America', 'Continent', '3'),
(-4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Europe', 'Continent', '4'),
(-5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Asia', 'Continent', '5'),
(-6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'South America', 'Continent', '6'),
(-7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Africa', 'Continent', '7'),
(-8, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Oceania', 'Continent', '8'),
(-9, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Worldwide', 'Worldwide', '');

-- --------------------------------------------------------

--
-- Table structure for table `ips`
--

DROP TABLE IF EXISTS `ips`;
CREATE TABLE IF NOT EXISTS `ips` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `ip` varchar(255) collate utf8_unicode_ci default NULL,
  `host` varchar(255) collate utf8_unicode_ci NOT NULL,
  `city_id` bigint(20) NOT NULL,
  `state_id` bigint(20) default '0',
  `country_id` bigint(20) NOT NULL,
  `timezone_id` bigint(20) NOT NULL,
  `latitude` float(10,6) NOT NULL,
  `longitude` float(10,6) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `city_id` (`city_id`),
  KEY `state_id` (`state_id`),
  KEY `country_id` (`country_id`),
  KEY `timezone_id` (`timezone_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='Ips Details';

--
-- Dumping data for table `ips`
--


-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

DROP TABLE IF EXISTS `labels`;
CREATE TABLE IF NOT EXISTS `labels` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `slug` varchar(265) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Messages labels name';

--
-- Dumping data for table `labels`
--


-- --------------------------------------------------------

--
-- Table structure for table `labels_messages`
--

DROP TABLE IF EXISTS `labels_messages`;
CREATE TABLE IF NOT EXISTS `labels_messages` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `label_id` bigint(20) default NULL,
  `message_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `label_id` (`label_id`),
  KEY `message_id` (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Map table for labels and messages';

--
-- Dumping data for table `labels_messages`
--


-- --------------------------------------------------------

--
-- Table structure for table `labels_users`
--

DROP TABLE IF EXISTS `labels_users`;
CREATE TABLE IF NOT EXISTS `labels_users` (
  `id` bigint(20) NOT NULL auto_increment,
  `label_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `label_id` (`label_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Map table for labels and users';

--
-- Dumping data for table `labels_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `iso2` varchar(5) collate utf8_unicode_ci default NULL,
  `iso3` varchar(5) collate utf8_unicode_ci default NULL,
  `is_active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Language List ';

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `created`, `modified`, `name`, `iso2`, `iso3`, `is_active`) VALUES
(1, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Abkhazian', 'ab', 'abk', 1),
(2, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Afar', 'aa', 'aar', 1),
(3, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Afrikaans', 'af', 'afr', 1),
(4, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Akan', 'ak', 'aka', 1),
(5, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Albanian', 'sq', 'sqi', 1),
(6, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Amharic', 'am', 'amh', 1),
(7, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Arabic', 'ar', 'ara', 1),
(8, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Aragonese', 'an', 'arg', 1),
(9, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Armenian', 'hy', 'hye', 1),
(10, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Assamese', 'as', 'asm', 1),
(11, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Avaric', 'av', 'ava', 1),
(12, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Avestan', 'ae', 'ave', 1),
(13, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Aymara', 'ay', 'aym', 1),
(14, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Azerbaijani', 'az', 'aze', 1),
(15, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Bambara', 'bm', 'bam', 1),
(16, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Bashkir', 'ba', 'bak', 1),
(17, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Basque', 'eu', 'eus', 1),
(18, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Belarusian', 'be', 'bel', 1),
(19, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Bengali', 'bn', 'ben', 1),
(20, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Bihari', 'bh', 'bih', 1),
(21, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Bislama', 'bi', 'bis', 1),
(22, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Bosnian', 'bs', 'bos', 1),
(23, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Breton', 'br', 'bre', 1),
(24, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Bulgarian', 'bg', 'bul', 1),
(25, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Burmese', 'my', 'mya', 1),
(26, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Catalan', 'ca', 'cat', 1),
(27, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Chamorro', 'ch', 'cha', 1),
(28, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Chechen', 'ce', 'che', 1),
(29, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Chichewa', 'ny', 'nya', 1),
(30, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Chinese', 'zh', 'zho', 1),
(31, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Church Slavic', 'cu', 'chu', 1),
(32, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Chuvash', 'cv', 'chv', 1),
(33, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Cornish', 'kw', 'cor', 1),
(34, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Corsican', 'co', 'cos', 1),
(35, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Cree', 'cr', 'cre', 1),
(36, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Croatian', 'hr', 'hrv', 1),
(37, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Czech', 'cs', 'ces', 1),
(38, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Danish', 'da', 'dan', 1),
(39, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Divehi', 'dv', 'div', 1),
(40, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Dutch', 'nl', 'nld', 1),
(41, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Dzongkha', 'dz', 'dzo', 1),
(42, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'English', 'en', 'eng', 1),
(43, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Esperanto', 'eo', 'epo', 1),
(44, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Estonian', 'et', 'est', 1),
(45, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Ewe', 'ee', 'ewe', 1),
(46, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Faroese', 'fo', 'fao', 1),
(47, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Fijian', 'fj', 'fij', 1),
(48, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Finnish', 'fi', 'fin', 1),
(49, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'French', 'fr', 'fra', 1),
(50, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Fulah', 'ff', 'ful', 1),
(51, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Galician', 'gl', 'glg', 1),
(52, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Ganda', 'lg', 'lug', 1),
(53, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Georgian', 'ka', 'kat', 1),
(54, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'German', 'de', 'deu', 1),
(55, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Greek', 'el', 'ell', 1),
(56, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Guaraní', 'gn', 'grn', 1),
(57, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Gujarati', 'gu', 'guj', 1),
(58, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Haitian', 'ht', 'hat', 1),
(59, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Hausa', 'ha', 'hau', 1),
(60, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Hebrew', 'he', 'heb', 1),
(61, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Herero', 'hz', 'her', 1),
(62, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Hindi', 'hi', 'hin', 1),
(63, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Hiri Motu', 'ho', 'hmo', 1),
(64, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Hungarian', 'hu', 'hun', 1),
(65, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Icelandic', 'is', 'isl', 1),
(66, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Ido', 'io', 'ido', 1),
(67, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Igbo', 'ig', 'ibo', 1),
(68, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Indonesian', 'id', 'ind', 1),
(69, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Interlingua (International Auxiliary Language Association)', 'ia', 'ina', 1),
(70, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Interlingue', 'ie', 'ile', 1),
(71, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Inuktitut', 'iu', 'iku', 1),
(72, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Inupiaq', 'ik', 'ipk', 1),
(73, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Irish', 'ga', 'gle', 1),
(74, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Italian', 'it', 'ita', 1),
(75, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Japanese', 'ja', 'jpn', 1),
(76, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Javanese', 'jv', 'jav', 1),
(77, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kalaallisut', 'kl', 'kal', 1),
(78, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kannada', 'kn', 'kan', 1),
(79, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kanuri', 'kr', 'kau', 1),
(80, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kashmiri', 'ks', 'kas', 1),
(81, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kazakh', 'kk', 'kaz', 1),
(82, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Khmer', 'km', 'khm', 1),
(83, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kikuyu', 'ki', 'kik', 1),
(84, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kinyarwanda', 'rw', 'kin', 1),
(85, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kirghiz', 'ky', 'kir', 1),
(86, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kirundi', 'rn', 'run', 1),
(87, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Komi', 'kv', 'kom', 1),
(88, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kongo', 'kg', 'kon', 1),
(89, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Korean', 'ko', 'kor', 1),
(90, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kurdish', 'ku', 'kur', 1),
(91, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Kwanyama', 'kj', 'kua', 1),
(92, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Lao', 'lo', 'lao', 1),
(93, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Latin', 'la', 'lat', 1),
(94, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Latvian', 'lv', 'lav', 1),
(95, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Limburgish', 'li', 'lim', 1),
(96, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Lingala', 'ln', 'lin', 1),
(97, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Lithuanian', 'lt', 'lit', 1),
(98, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Luba-Katanga', 'lu', 'lub', 1),
(99, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Luxembourgish', 'lb', 'ltz', 1),
(100, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Macedonian', 'mk', 'mkd', 1),
(101, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Malagasy', 'mg', 'mlg', 1),
(102, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Malay', 'ms', 'msa', 1),
(103, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Malayalam', 'ml', 'mal', 1),
(104, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Maltese', 'mt', 'mlt', 1),
(105, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Manx', 'gv', 'glv', 1),
(106, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Māori', 'mi', 'mri', 1),
(107, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Marathi', 'mr', 'mar', 1),
(108, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Marshallese', 'mh', 'mah', 1),
(109, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Mongolian', 'mn', 'mon', 1),
(110, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Nauru', 'na', 'nau', 1),
(111, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Navajo', 'nv', 'nav', 1),
(112, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Ndonga', 'ng', 'ndo', 1),
(113, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Nepali', 'ne', 'nep', 1),
(114, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'North Ndebele', 'nd', 'nde', 1),
(115, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Northern Sami', 'se', 'sme', 1),
(116, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Norwegian', 'no', 'nor', 1),
(117, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Norwegian Bokmål', 'nb', 'nob', 1),
(118, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Norwegian Nynorsk', 'nn', 'nno', 1),
(119, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Occitan', 'oc', 'oci', 1),
(120, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Ojibwa', 'oj', 'oji', 1),
(121, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Oriya', 'or', 'ori', 1),
(122, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Oromo', 'om', 'orm', 1),
(123, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Ossetian', 'os', 'oss', 1),
(124, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Pāli', 'pi', 'pli', 1),
(125, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Panjabi', 'pa', 'pan', 1),
(126, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Pashto', 'ps', 'pus', 1),
(127, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Persian', 'fa', 'fas', 1),
(128, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Polish', 'pl', 'pol', 1),
(129, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Portuguese', 'pt', 'por', 1),
(130, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Quechua', 'qu', 'que', 1),
(131, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Raeto-Romance', 'rm', 'roh', 1),
(132, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Romanian', 'ro', 'ron', 1),
(133, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Russian', 'ru', 'rus', 1),
(134, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Samoan', 'sm', 'smo', 1),
(135, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Sango', 'sg', 'sag', 1),
(136, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Sanskrit', 'sa', 'san', 1),
(137, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Sardinian', 'sc', 'srd', 1),
(138, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Scottish Gaelic', 'gd', 'gla', 1),
(139, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Serbian', 'sr', 'srp', 1),
(140, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Shona', 'sn', 'sna', 1),
(141, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Sichuan Yi', 'ii', 'iii', 1),
(142, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Sindhi', 'sd', 'snd', 1),
(143, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Sinhala', 'si', 'sin', 1),
(144, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Slovak', 'sk', 'slk', 1),
(145, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Slovenian', 'sl', 'slv', 1),
(146, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Somali', 'so', 'som', 1),
(147, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'South Ndebele', 'nr', 'nbl', 1),
(148, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Southern Sotho', 'st', 'sot', 1),
(149, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Spanish', 'es', 'spa', 1),
(150, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Sundanese', 'su', 'sun', 1),
(151, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Swahili', 'sw', 'swa', 1),
(152, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Swati', 'ss', 'ssw', 1),
(153, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Swedish', 'sv', 'swe', 1),
(154, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tagalog', 'tl', 'tgl', 1),
(155, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tahitian', 'ty', 'tah', 1),
(156, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tajik', 'tg', 'tgk', 1),
(157, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tamil', 'ta', 'tam', 1),
(158, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tatar', 'tt', 'tat', 1),
(159, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Telugu', 'te', 'tel', 1),
(160, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Thai', 'th', 'tha', 1),
(161, '2009-07-01 13:52:24', '2009-07-01 13:52:24', 'Tibetan', 'bo', 'bod', 1),
(162, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tigrinya', 'ti', 'tir', 1),
(163, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tonga', 'to', 'ton', 1),
(164, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Traditional Chinese', 'zh-TW', 'zh-TW', 1),
(165, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tsonga', 'ts', 'tso', 1),
(166, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Tswana', 'tn', 'tsn', 1),
(167, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Turkish', 'tr', 'tur', 1),
(168, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Turkmen', 'tk', 'tuk', 1),
(169, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Twi', 'tw', 'twi', 1),
(170, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Uighur', 'ug', 'uig', 1),
(171, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Ukrainian', 'uk', 'ukr', 1),
(172, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Urdu', 'ur', 'urd', 1),
(173, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Uzbek', 'uz', 'uzb', 1),
(174, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Venda', 've', 'ven', 1),
(175, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Vietnamese', 'vi', 'vie', 1),
(176, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Volapük', 'vo', 'vol', 1),
(177, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Walloon', 'wa', 'wln', 1),
(178, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Welsh', 'cy', 'cym', 1),
(179, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Western Frisian', 'fy', 'fry', 1),
(180, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Wolof', 'wo', 'wol', 1),
(181, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Xhosa', 'xh', 'xho', 1),
(182, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Yiddish', 'yi', 'yid', 1),
(183, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Yoruba', 'yo', 'yor', 1),
(184, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Zhuang', 'za', 'zha', 1),
(185, '2009-07-01 13:52:25', '2009-07-01 13:52:25', 'Zulu', 'zu', 'zul', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `user_id` bigint(20) default NULL,
  `other_user_id` bigint(20) default NULL,
  `parent_message_id` bigint(20) default NULL,
  `message_content_id` bigint(20) NOT NULL,
  `message_folder_id` bigint(20) NOT NULL,
  `is_sender` tinyint(1) NOT NULL,
  `is_starred` tinyint(1) default NULL,
  `is_read` tinyint(1) default '0',
  `is_deleted` tinyint(1) default '0',
  `is_archived` tinyint(1) NOT NULL default '0',
  `is_communication` tinyint(1) NOT NULL,
  `hash` text collate utf8_unicode_ci,
  `size` bigint(20) NOT NULL,
  `product_id` bigint(20) unsigned default '0',
  `order_id` bigint(20) default '0',
  `is_review` tinyint(1) unsigned default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `other_user_id` (`other_user_id`),
  KEY `parent_message_id` (`parent_message_id`),
  KEY `message_content_id` (`message_content_id`),
  KEY `message_folder_id` (`message_folder_id`),
  KEY `product_id` (`product_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User messages';

--
-- Dumping data for table `messages`
--


-- --------------------------------------------------------

--
-- Table structure for table `message_contents`
--

DROP TABLE IF EXISTS `message_contents`;
CREATE TABLE IF NOT EXISTS `message_contents` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `subject` text collate utf8_unicode_ci,
  `message` text collate utf8_unicode_ci,
  `admin_suspend` tinyint(1) NOT NULL default '0',
  `is_system_flagged` tinyint(1) NOT NULL default '0',
  `detected_suspicious_words` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User messages content';

--
-- Dumping data for table `message_contents`
--


-- --------------------------------------------------------

--
-- Table structure for table `message_filters`
--

DROP TABLE IF EXISTS `message_filters`;
CREATE TABLE IF NOT EXISTS `message_filters` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `user_id` bigint(20) default NULL,
  `from_user_id` bigint(20) default '0',
  `to_user_id` bigint(20) default NULL,
  `subject` varchar(255) collate utf8_unicode_ci default NULL,
  `has_words` varchar(255) collate utf8_unicode_ci default NULL,
  `does_not_has_words` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `to_user_id` (`to_user_id`),
  KEY `subject` (`subject`),
  KEY `from_user_id` (`from_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Message Filter Details';

--
-- Dumping data for table `message_filters`
--


-- --------------------------------------------------------

--
-- Table structure for table `message_folders`
--

DROP TABLE IF EXISTS `message_folders`;
CREATE TABLE IF NOT EXISTS `message_folders` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Messages folder';

--
-- Dumping data for table `message_folders`
--


-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `owner_user_id` bigint(20) NOT NULL,
  `payment_gateway_id` bigint(20) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `order_status_id` int(11) NOT NULL,
  `top_code` varchar(10) collate utf8_unicode_ci NOT NULL,
  `bottom_code` varchar(10) collate utf8_unicode_ci NOT NULL,
  `full_name` varchar(250) collate utf8_unicode_ci NOT NULL,
  `address` text collate utf8_unicode_ci NOT NULL,
  `city_id` bigint(20) default '0',
  `state_id` bigint(20) default '0',
  `country_id` bigint(20) default '0',
  `zipcode` varchar(25) collate utf8_unicode_ci NOT NULL,
  `phone` varchar(25) collate utf8_unicode_ci NOT NULL,
  `is_shipped_order` tinyint(1) NOT NULL default '0',
  `shipping_remarks` text collate utf8_unicode_ci NOT NULL,
  `paid_date` datetime NOT NULL,
  `canceled_date` datetime NOT NULL,
  `shipped_date` datetime NOT NULL,
  `order_item_count` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `payment_gateway_id` (`payment_gateway_id`),
  KEY `order_status_id` (`order_status_id`),
  KEY `owner_user_id` (`owner_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--


-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `is_send_as_gift` tinyint(1) NOT NULL default '0',
  `gift_friend_email` varchar(255) collate utf8_unicode_ci NOT NULL,
  `gift_wrap_note` text collate utf8_unicode_ci,
  `gift_wrap_fee` double(10,2) default '0.00',
  `is_gift_wrap` tinyint(1) NOT NULL default '0',
  `price` double(10,2) NOT NULL,
  `credits` int(10) default NULL,
  `credit_expiry_date` datetime NOT NULL,
  `shipping_price` double(10,2) NOT NULL,
  `total_price` double(10,2) NOT NULL,
  `commission_amount` double(10,2) NOT NULL,
  `is_downloaded` tinyint(1) NOT NULL default '0',
  `product_download_count` bigint(20) NOT NULL,
  `product_attribute_id` int(11) default '0',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  KEY `order_id` (`order_id`),
  KEY `product_attribute_id` (`product_attribute_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_items`
--


-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

DROP TABLE IF EXISTS `order_statuses`;
CREATE TABLE IF NOT EXISTS `order_statuses` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `order_count` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `created`, `modified`, `name`, `order_count`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Payment Pending', 0),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'In Process', 0),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Expired', 0),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Canceled And Refunded', 0),
(5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Shipped', 0),
(6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Completed', 0);


-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `parent_id` bigint(20) unsigned default NULL,
  `title` varchar(255) collate utf8_unicode_ci default NULL,
  `content` text collate utf8_unicode_ci,
  `template` varchar(255) collate utf8_unicode_ci default NULL,
  `draft` tinyint(1) NOT NULL default '0',
  `lft` bigint(20) default NULL,
  `rght` bigint(20) default NULL,
  `level` int(3) NOT NULL default '0',
  `description_meta_tag` text collate utf8_unicode_ci,
  `url` text collate utf8_unicode_ci,
  `slug` varchar(255) collate utf8_unicode_ci default NULL,
  `is_default` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `title` (`title`),
  KEY `parent_id` (`parent_id`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Page Details';

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `created`, `modified`, `parent_id`, `title`, `content`, `template`, `draft`, `lft`, `rght`, `level`, `description_meta_tag`, `url`, `slug`, `is_default`) VALUES
(1, '2009-07-11 11:16:29', '2009-07-21 15:52:58', NULL, 'home', 'Lorem Ipsum is a dummy text that is mainly used by the printing and design industry. It is intended to show how the type will look before the end product is available.\r\n\r\nLorem Ipsum has been the industry''s standard dummy text ever since the 1500:s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nLorem Ipsum dummy texts was available for many years on adhesive sheets in different sizes and typefaces from a company called Letraset.\r\n\r\nWhen computers came along, Aldus included lorem ipsum in its PageMaker publishing software, and you now see it wherever designers, content designers, art directors, user interface developers and web designer are at work.\r\n\r\nThey use it daily when using programs such as Adobe Photoshop, Paint Shop Pro, Dreamweaver, FrontPage, PageMaker, FrameMaker, Illustrator, Flash, Indesign etc.', 'home.ctp', 0, NULL, NULL, 0, NULL, NULL, 'home', 1),
(2, '2009-07-11 11:16:54', '2009-07-21 15:53:27', NULL, 'About', 'Lorem Ipsum is a dummy text that is mainly used by the printing and design industry. It is intended to show how the type will look before the end product is available.\r\n\r\nLorem Ipsum has been the industry''s standard dummy text ever since the 1500:s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nLorem Ipsum dummy texts was available for many years on adhesive sheets in different sizes and typefaces from a company called Letraset.\r\n\r\nWhen computers came along, Aldus included lorem ipsum in its PageMaker publishing software, and you now see it wherever designers, content designers, art directors, user interface developers and web designer are at work.\r\n\r\nThey use it daily when using programs such as Adobe Photoshop, Paint Shop Pro, Dreamweaver, FrontPage, PageMaker, FrameMaker, Illustrator, Flash, Indesign etc.', 'about.ctp', 0, NULL, NULL, 0, NULL, NULL, 'about', 0),
(3, '2009-07-11 11:17:27', '2009-07-21 15:54:02', NULL, 'Contact Us', 'Lorem Ipsum is a dummy text that is mainly used by the printing and design industry. It is intended to show how the type will look before the end product is available.\r\n\r\nLorem Ipsum has been the industry''s standard dummy text ever since the 1500:s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nLorem Ipsum dummy texts was available for many years on adhesive sheets in different sizes and typefaces from a company called Letraset.\r\n\r\nWhen computers came along, Aldus included lorem ipsum in its PageMaker publishing software, and you now see it wherever designers, content designers, art directors, user interface developers and web designer are at work.\r\n\r\nThey use it daily when using programs such as Adobe Photoshop, Paint Shop Pro, Dreamweaver, FrontPage, PageMaker, FrameMaker, Illustrator, Flash, Indesign etc.', '', 0, NULL, NULL, 0, NULL, NULL, 'contact-us', 0),
(6, '2009-07-17 07:55:38', '2009-07-21 15:54:33', NULL, 'FAQ', 'Lorem Ipsum is a dummy text that is mainly used by the printing and design industry. It is intended to show how the type will look before the end product is available.\r\n\r\nLorem Ipsum has been the industry''s standard dummy text ever since the 1500:s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nLorem Ipsum dummy texts was available for many years on adhesive sheets in different sizes and typefaces from a company called Letraset.\r\n\r\nWhen computers came along, Aldus included lorem ipsum in its PageMaker publishing software, and you now see it wherever designers, content designers, art directors, user interface developers and web designer are at work.\r\n\r\nThey use it daily when using programs such as Adobe Photoshop, Paint Shop Pro, Dreamweaver, FrontPage, PageMaker, FrameMaker, Illustrator, Flash, Indesign etc.', '', 0, NULL, NULL, 0, NULL, NULL, 'faq', 0),
(7, '2009-07-21 15:56:45', '2009-07-21 15:56:45', NULL, 'Terms and Conditions', 'Lorem Ipsum is a dummy text that is mainly used by the printing and design industry. It is intended to show how the type will look before the end product is available.\r\n\r\nLorem Ipsum has been the industry''s standard dummy text ever since the 1500:s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nLorem Ipsum dummy texts was available for many years on adhesive sheets in different sizes and typefaces from a company called Letraset.\r\n\r\nWhen computers came along, Aldus included lorem ipsum in its PageMaker publishing software, and you now see it wherever designers, content designers, art directors, user interface developers and web designer are at work.\r\n\r\nThey use it daily when using programs such as Adobe Photoshop, Paint Shop Pro, Dreamweaver, FrontPage, PageMaker, FrameMaker, Illustrator, Flash, Indesign etc.', '', 0, NULL, NULL, 0, NULL, NULL, 'term-and-conditions', 0),
(4, '2009-07-21 15:56:45', '2009-07-21 15:56:45', NULL, 'Term and Policies', 'Lorem Ipsum is a dummy text that is mainly used by the printing and design industry. It is intended to show how the type will look before the end product is available.\r\n\r\nLorem Ipsum has been the industry''s standard dummy text ever since the 1500:s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nLorem Ipsum dummy texts was available for many years on adhesive sheets in different sizes and typefaces from a company called Letraset.\r\n\r\nWhen computers came along, Aldus included lorem ipsum in its PageMaker publishing software, and you now see it wherever designers, content designers, art directors, user interface developers and web designer are at work.\r\n\r\nThey use it daily when using programs such as Adobe Photoshop, Paint Shop Pro, Dreamweaver, FrontPage, PageMaker, FrameMaker, Illustrator, Flash, Indesign etc.', '', 0, NULL, NULL, 0, NULL, NULL, 'term-and-policies', 0),
(10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'Privacy Policy', 'Lorem Ipsum is a dummy text that is mainly used by the printing and design industry. It is intended to show how the type will look before the end product is available.\r\n\r\nLorem Ipsum has been the industry''s standard dummy text ever since the 1500:s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nLorem Ipsum dummy texts was available for many years on adhesive sheets in different sizes and typefaces from a company called Letraset.\r\n\r\nWhen computers came along, Aldus included lorem ipsum in its PageMaker publishing software, and you now see it wherever designers, content designers, art directors, user interface developers and web designer are at work.\r\n\r\nThey use it daily when using programs such as Adobe Photoshop, Paint Shop Pro, Dreamweaver, FrontPage, PageMaker, FrameMaker, Illustrator, Flash, Indesign etc.', NULL, 0, NULL, NULL, 0, NULL, NULL, 'privacy_policy', 1),
(11, '2012-01-06 10:35:34', '2012-01-06 10:35:34', NULL, 'Tell me more', '<p>Coming Soon</p>', NULL, 0, NULL, NULL, 0, NULL, NULL, 'tell-me-more', 0);


-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

DROP TABLE IF EXISTS `payment_gateways`;
CREATE TABLE IF NOT EXISTS `payment_gateways` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `display_name` varchar(255) collate utf8_unicode_ci default NULL,
  `description` text collate utf8_unicode_ci,
  `gateway_fees` double(10,2) default NULL,
  `transaction_count` bigint(20) unsigned default '0',
  `payment_gateway_setting_count` bigint(20) unsigned default '0',
  `is_test_mode` tinyint(1) NOT NULL default '0',
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `created`, `modified`, `name`, `display_name`, `description`, `gateway_fees`, `transaction_count`, `payment_gateway_setting_count`, `is_test_mode`, `is_active`) VALUES
(1, '2010-05-10 10:43:02', '2010-07-22 13:56:49', 'PayPal', 'PayPal', 'PayPal is an electronic money service which allows you to make payment to anyone online. ', 0.00, NULL, 1, 1, 1),
(2, '2010-05-10 10:43:02', '2010-05-10 10:43:02', 'Wallet', 'Wallet', 'Wallet option', NULL, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateway_settings`
--

DROP TABLE IF EXISTS `payment_gateway_settings`;
CREATE TABLE IF NOT EXISTS `payment_gateway_settings` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `payment_gateway_id` bigint(20) unsigned NOT NULL,
  `key` varchar(256) collate utf8_unicode_ci default NULL,
  `type` varchar(8) collate utf8_unicode_ci default NULL,
  `options` text collate utf8_unicode_ci,
  `test_mode_value` text collate utf8_unicode_ci,
  `live_mode_value` text collate utf8_unicode_ci,
  `description` text collate utf8_unicode_ci,
  PRIMARY KEY  (`id`),
  KEY `payment_gateway_id` (`payment_gateway_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment_gateway_settings`
--

INSERT INTO `payment_gateway_settings` (`id`, `created`, `modified`, `payment_gateway_id`, `key`, `type`, `options`, `test_mode_value`, `live_mode_value`, `description`) VALUES
(1, '2010-05-10 11:01:23', '2010-05-14 13:05:28', 1, 'payee_account', 'text', '', 'fivult_1286256894_biz@gmail.com', 'fivult_1286256894_biz@gmail.com', 'PayPal merchant account email'),
(11, '2010-07-16 16:29:35', '2010-07-16 16:29:38', 1, 'receiver_emails', 'text', '', 'group._1275387295_biz@agriya.in', 'group._1275387295_biz@agriya.in', 'Comma separated for setting multiple receiver emails.'),
(12, '2010-07-15 12:15:27', '2010-07-15 12:15:27', 1, 'masspay_API_UserName', 'text', '', 'group._1275387295_biz_api1.agriya.in', 'group._1275387295_biz_api1.agriya.in', ''),
(13, '2010-07-15 12:15:27', '2010-07-15 12:15:27', 1, 'masspay_API_Password', 'text', '', '1275387304', '1275387304', ''),
(14, '2010-07-15 12:20:23', '2010-07-15 12:20:23', 1, 'masspay_API_Signature', 'text', '', 'A2D-o.ABr1BhSY94P3USn3LNzZHIA.j34dhfDHi77OE5YiM93TixlOZK', 'A2D-o.ABr1BhSY94P3USn3LNzZHIA.j34dhfDHi77OE5YiM93TixlOZK', ''),
(15, '2010-07-15 12:21:33', '2010-07-15 12:21:33', 1, 'is_enable_for_purchase', 'checkbox', '', '1', '1', 'Enable/Disable the current payment option for purchase.'),
(16, '2010-07-15 12:21:33', '2010-07-15 12:21:33', 2, 'is_enable_for_purchase', 'checkbox', '', '1', '1', 'Enable/Disable the current payment option for purchase.'),
(23, '2010-07-15 12:21:33', '2010-07-15 12:21:33', 1, 'is_enable_for_add_to_wallet', 'checkbox', '', '1', '1', 'Enable/Disable the current payment option for wallet add.');

-- --------------------------------------------------------

--
-- Table structure for table `paypal_transaction_logs`
--

DROP TABLE IF EXISTS `paypal_transaction_logs`;
CREATE TABLE IF NOT EXISTS `paypal_transaction_logs` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `date_added` datetime NOT NULL default '0000-00-00 00:00:00',
  `user_id` bigint(20) default '0',
  `transaction_id` bigint(20) default '0',
  `ip_id` varchar(15) collate utf8_unicode_ci default NULL,
  `currency_type` varchar(50) collate utf8_unicode_ci default NULL,
  `txn_id` varchar(50) collate utf8_unicode_ci default NULL,
  `payer_email` varchar(150) collate utf8_unicode_ci default NULL,
  `payment_date` varchar(30) collate utf8_unicode_ci default NULL,
  `email` varchar(150) collate utf8_unicode_ci default NULL,
  `to_digicurrency` varchar(50) collate utf8_unicode_ci default NULL,
  `to_account_no` varchar(100) collate utf8_unicode_ci default NULL,
  `to_account_name` varchar(150) collate utf8_unicode_ci default NULL,
  `fees_paid_by` varchar(50) collate utf8_unicode_ci default NULL,
  `mc_gross` double(50,5) default NULL,
  `mc_fee` double(50,5) default NULL,
  `mc_currency` varchar(12) collate utf8_unicode_ci default NULL,
  `payment_status` varchar(20) collate utf8_unicode_ci default NULL,
  `pending_reason` varchar(20) collate utf8_unicode_ci default NULL,
  `receiver_email` varchar(100) collate utf8_unicode_ci default NULL,
  `paypal_response` varchar(20) collate utf8_unicode_ci default NULL,
  `error_no` tinyint(4) default '0',
  `error_message` text collate utf8_unicode_ci,
  `memo` text collate utf8_unicode_ci,
  `paypal_post_vars` text collate utf8_unicode_ci,
  `is_mass_pay` tinyint(1) default '0',
  `mass_pay_status` varchar(20) collate utf8_unicode_ci default NULL,
  `masspay_response` text collate utf8_unicode_ci,
  `user_cash_withdrawal_id` bigint(20) default '0',
  PRIMARY KEY  (`id`),
  KEY `txn_id` (`txn_id`),
  KEY `user_id` (`user_id`),
  KEY `transaction_id` (`transaction_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `paypal_transaction_logs`
--


-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_status_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `original_price` double(10,2) NOT NULL,
  `discounted_price` double(10,2) DEFAULT '0.00',
  `quantity` bigint(20) NOT NULL DEFAULT '0',
  `maximum_quantity_to_send_as_gift` int(11) DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `credits` int(10) DEFAULT NULL,
  `credit_expiry_date` datetime NOT NULL,
  `is_credit_product` tinyint(1) NOT NULL,
  `maximum_quantity_to_buy_as_own` int(11) DEFAULT '0',
  `discount_percentage` int(11) unsigned DEFAULT NULL,
  `discount_amount` double(10,2) DEFAULT '0.00',
  `bonus_amount` double(10,2) NOT NULL,
  `commission_percentage` double(10,2) NOT NULL,
  `total_commission_amount` double(10,2) NOT NULL,
  `savings` double(10,2) DEFAULT '0.00',
  `is_requires_shipping` tinyint(1) NOT NULL,
  `is_having_file_to_download` tinyint(1) NOT NULL DEFAULT '0',
  `sold_quantity` int(11) NOT NULL,
  `video_url` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `product_shipment_cost_count` bigint(20) NOT NULL,
  `product_view_count` bigint(20) unsigned NOT NULL,
  `product_download_count` bigint(20) NOT NULL,
  `order_item_count` bigint(20) NOT NULL,
  `sales_cleared_count` bigint(20) NOT NULL,
  `sales_cleared_amount` double(10,2) NOT NULL,
  `sales_pending_count` bigint(20) NOT NULL,
  `sales_pending_amount` double(10,2) NOT NULL,
  `sales_lost_count` bigint(20) NOT NULL,
  `sales_lost_amount` double(10,2) NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `ip_id` bigint(20) DEFAULT '0',
  `is_system_flagged` tinyint(1) NOT NULL,
  `admin_suspend` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_product_variant_enabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`),
  KEY `user_id` (`user_id`),
  KEY `product_status_id` (`product_status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=68 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `created`, `modified`, `user_id`, `title`, `slug`, `product_status_id`, `category_id`, `description`, `original_price`, `discounted_price`, `quantity`, `maximum_quantity_to_send_as_gift`, `start_date`, `end_date`, `credits`, `credit_expiry_date`, `is_credit_product`, `maximum_quantity_to_buy_as_own`, `discount_percentage`, `discount_amount`, `bonus_amount`, `commission_percentage`, `total_commission_amount`, `savings`, `is_requires_shipping`, `is_having_file_to_download`, `sold_quantity`, `video_url`, `product_shipment_cost_count`, `product_view_count`, `product_download_count`, `order_item_count`, `sales_cleared_count`, `sales_cleared_amount`, `sales_pending_count`, `sales_pending_amount`, `sales_lost_count`, `sales_lost_amount`, `meta_keywords`, `meta_description`, `ip_id`, `is_system_flagged`, `admin_suspend`, `is_active`, `is_product_variant_enabled`) VALUES
(59, '2012-02-29 06:52:29', '2012-02-29 09:20:45', 1, 'sweatshirt', 'sweatshirt', 3, 15, 'long-sleeved athletic shirt of heavier material, with or without hood', 500.00, 500.00, 4000, NULL, '2012-03-29 06:50:00', '2012-05-29 06:50:00', NULL, '0000-00-00 00:00:00', 0, 0, NULL, NULL, 0.00, 0.00, 0.00, NULL, 1, 0, 0, '', 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, '', '', 2, 0, 0, 1, 1),
(63, '2012-03-01 03:13:19', '2012-03-01 03:13:19', 1, 'Bridal saree', 'bridal-saree', 4, 10, 'Bridal saree', 5000.00, 3750.00, 2000, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2012-02-29 00:00:00', 0, 0, 25, 1250.00, 0.00, 0.00, 0.00, 1250.00, 1, 0, 0, '', 1, 12, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, '', '', 2, 0, 0, 1, 1),
(64, '2012-03-01 03:18:58', '2012-03-01 04:31:54', 1, 'EMB saree', 'emb-saree', 3, 10, 'EMB saree', 10000.00, 9000.00, 2000, NULL, '2012-03-01 13:00:00', '2012-03-01 13:02:00', NULL, '0000-00-00 00:00:00', 0, 0, 10, 1000.00, 0.00, 0.00, 0.00, 1000.00, 1, 0, 0, '', 1, 14, 0, 1, 0, 0.00, 0, 0.00, 0, 0.00, '', '', 2, 0, 0, 1, 1),
(2, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 1, 'Adidas Mens Zeitfrei FitFOAM', 'adidas-mens-zeitfrei-fitfoam', 3, 26, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 50.00, 0.00, 19, NULL, '2011-09-01 00:00:00', '2012-11-21 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, '', 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(3, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 1, 'Air conditionar 5star', 'air-conditionar-5star', 2, 27, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.', 30.00, 0.00, 12, NULL, '2012-04-21 00:00:00', '2012-10-11 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 0, 0, '', 3, 0, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(4, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 1, 'Apple Music Products', 'apple-music-products', 3, 28, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 50.00, 37.50, 12, NULL, '2011-10-11 00:00:00', '2012-10-11 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 25, 0.25, 0.00, 0.00, 0.00, 12.50, 0, 0, 0, '', 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(5, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 1, 'Audo Sound System', 'audo-sound-system', 3, 16, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 250.00, 0.00, 12, NULL, '2011-10-11 00:00:00', '2012-11-21 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, '', 0, 2, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(6, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 1, 'Automatic Washer', 'automatic-washer', 3, 30, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 30.00, 0.00, 19, NULL, '2011-09-01 00:00:00', '2012-09-01 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, '', 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(7, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 1, 'Basketball Foldable Shopping Bag', 'basketball-foldable-shopping-bag', 2, 31, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 400.00, 0.00, 20, NULL, '2012-04-21 00:00:00', '2012-09-01 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, '', 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(8, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 1, 'Beatiful guitar with offer', 'beatiful-guitar-with-offer', 3, 10, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 100.00, 95.00, 18, NULL, '2011-09-11 00:00:00', '2012-11-21 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 5, 0.05, 0.00, 0.00, 0.00, 5.00, 1, 0, 0, '', 3, 3, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(9, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 1, 'Beats By Reaudio', 'beats-by-reaudio', 3, 11, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 40.00, 0.00, 20, NULL, '2011-09-11 00:00:00', '2012-12-31 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 0, 0, '', 3, 13, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(10, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 1, 'Beetle car', 'beetle-car', 3, 21, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 200.00, 0.00, 14, NULL, '2011-10-11 00:00:00', '2012-12-31 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, '', 0, 3, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(11, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 1, 'Belly Buddy Exerciser', 'belly-buddy-exerciser', 1, 22, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 10.00, 0.00, 17, NULL, '2012-01-21 00:00:00', '2012-09-01 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, '', 0, 4, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(12, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 1, 'BtyProduct', 'btyproduct', 3, 12, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 80.00, 56.00, 18, NULL, '2011-10-11 00:00:00', '2012-12-31 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 30, 0.30, 0.00, 0.00, 0.00, 24.00, 0, 0, 0, '', 0, 7, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(13, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 1, 'Cinemascope LCD Tv', 'cinemascope-lcd-tv', 5, 23, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.', 450.00, 0.00, 15, NULL, '2011-09-11 00:00:00', '2012-09-01 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 0, 0, '', 3, 6, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(14, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 1, 'Colorful Thread', 'colorful-thread', 3, 24, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 30.00, 0.00, 16, NULL, '2011-10-11 00:00:00', '2012-12-31 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, '', 0, 2, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(15, '2011-09-23 06:49:36', '2012-03-01 04:32:05', 1, 'Compaq Presario Desktop', 'compaq-presario-desktop', 3, 25, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 250.00, 0.00, 15, NULL, '2012-01-21 00:00:00', '2012-09-01 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 0, 0, '', 3, 8, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(16, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 1, 'Dell XPS M1330 Product Red', 'dell-xps-m1330-product-red', 3, 18, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.', 50.00, 45.00, 14, NULL, '2011-09-01 00:00:00', '2012-09-01 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 10, 0.10, 0.00, 0.00, 0.00, 5.00, 0, 0, 0, '', 0, 3, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(17, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 1, 'Everywhere Fram', 'everywhere-fram', 5, 32, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 50.00, 0.00, 12, NULL, '2011-10-11 00:00:00', '2012-11-21 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 0, 0, '', 3, 10, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(18, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 1, 'Fancy Butterfly Bag', 'fancy-butterfly-bag', 3, 33, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.', 70.00, 0.00, 16, NULL, '2011-10-11 00:00:00', '2012-10-11 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, '', 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(19, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 1, 'Flip obronze wind chime white', 'flip-obronze-wind-chime-white', 1, 34, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.', 30.00, 0.00, 10, NULL, '2012-01-21 00:00:00', '2012-12-31 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 0, 0, '', 3, 11, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(20, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 1, 'Folding Shopping Basket', 'folding-shopping-basket', 3, 35, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.', 30.00, 27.00, 12, NULL, '2011-09-01 00:00:00', '2012-11-21 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 10, 0.10, 0.00, 0.00, 0.00, 3.00, 0, 0, 0, '', 0, 2, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(21, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 1, 'Hd Duplicator', 'hd-duplicator', 3, 36, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.', 500.00, 0.00, 12, NULL, '2011-09-01 00:00:00', '2012-12-31 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 0, 0, '', 3, 2, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(22, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 1, 'HP Desktop PC', 'hp-desktop-pc', 3, 37, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 400.00, 0.00, 17, NULL, '2011-09-01 00:00:00', '2012-09-01 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, '', 0, 1, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(23, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 1, 'I Love Shopping T-Shirt', 'i-love-shopping-t-shirt', 5, 39, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 60.00, 0.00, 17, NULL, '2011-09-01 00:00:00', '2012-12-31 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, '', 0, 15, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(24, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 1, 'Iphone 4', 'iphone-4', 3, 40, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 250.00, 212.50, 18, NULL, '2011-09-11 00:00:00', '2012-10-11 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 15, 0.15, 0.00, 0.00, 0.00, 37.50, 1, 0, 0, '', 3, 1, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(25, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 1, 'Karen Prodcuts', 'karen-prodcuts', 3, 41, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 350.00, 0.00, 20, NULL, '2011-10-11 00:00:00', '2012-12-31 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, '', 0, 3, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(26, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 1, 'Lioele Products', 'lioele-products', 1, 42, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 150.00, 0.00, 12, NULL, '2012-01-21 00:00:00', '2012-09-01 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 0, 0, '', 3, 18, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(27, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 1, 'Lupe Fiasco Whiete', 'lupe-fiasco-whiete', 3, 44, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 50.00, 0.00, 14, NULL, '2011-10-11 00:00:00', '2012-09-01 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 0, 0, '', 3, 19, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(28, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 1, 'Lupe Fiasco', 'lupe-fiasco', 3, 45, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.', 300.00, 240.00, 10, NULL, '2011-09-11 00:00:00', '2012-09-01 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 20, 0.20, 0.00, 0.00, 0.00, 60.00, 0, 0, 0, '', 0, 20, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(29, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 1, 'Mauel Dairy Products', 'mauel-dairy-products', 3, 46, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 60.00, 0.00, 19, NULL, '2011-09-01 00:00:00', '2012-10-11 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 0, 0, '', 3, 1, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(30, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 1, 'Men''s Two-Fold with Double ID Flap', 'men-s-two-fold-with-double-id-flap', 3, 47, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 450.00, 0.00, 17, NULL, '2011-10-11 00:00:00', '2012-12-31 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, '', 0, 21, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(55, '2012-02-29 06:43:03', '2012-02-29 09:59:18', 1, 'Long-sleeved T-shirt', 'long-sleeved-t-shirt', 3, 15, 'a t-shirt with long sleeves that extend to cover the arms.', 600.00, 564.00, 200, NULL, '2012-05-29 06:41:00', '2012-10-29 06:41:00', NULL, '0000-00-00 00:00:00', 0, 0, 6, 36.00, 0.00, 0.00, 0.00, 36.00, 1, 0, 1, '', 1, 14, 0, 2, 0, 0.00, 1, 600.00, 0, 0.00, '', '', 1, 0, 0, 1, 1),
(56, '2012-02-29 06:44:50', '2012-02-29 06:44:50', 1, 'Ringer T-shirt ', 'ringer-t-shirt', 3, 15, 'tee with a separate piece of fabric sewn on as the collar and sleeve hems', 300.00, 285.00, 10000, NULL, '2012-02-29 18:43:00', '2012-03-29 06:43:00', NULL, '0000-00-00 00:00:00', 0, 0, 5, 15.00, 0.00, 0.00, 0.00, 15.00, 1, 0, 0, '', 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, 'tee ', '', 1, 0, 0, 1, 1),
(57, '2012-02-29 06:46:40', '2012-02-29 09:58:52', 1, 'Rugby shirt ', 'rugby-shirt', 3, 15, 'a long-sleeved polo shirt, traditionally of rugged', 700.00, 630.00, 280, NULL, '2012-03-29 06:45:00', '2012-04-29 06:45:00', NULL, '0000-00-00 00:00:00', 0, 0, 10, 70.00, 0.00, 0.00, 0.00, 70.00, 1, 0, 0, '', 1, 2, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, '', '', 1, 0, 0, 1, 1),
(58, '2012-02-29 06:50:20', '2012-02-29 09:44:40', 1, 'Henley shirt', 'henley-shirt', 3, 15, 'a collarless polo shirt', 800.00, 800.00, 6000, NULL, '2012-03-29 06:47:00', '2012-04-29 06:47:00', NULL, '0000-00-00 00:00:00', 0, 0, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 1, 0, 1, '', 1, 3, 0, 1, 0, 0.00, 1, 800.00, 0, 0.00, '', '', 2, 0, 0, 1, 1),
(32, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 1, 'Noisettes Products', 'noisettes-products', 3, 26, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.', 40.00, 34.00, 12, NULL, '2011-10-11 00:00:00', '2012-12-31 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 15, 0.15, 0.00, 0.00, 0.00, 6.00, 0, 0, 0, '', 0, 5, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(33, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 1, 'Palm Chair', 'palm-chair', 3, 40, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 350.00, 0.00, 20, NULL, '2011-10-11 00:00:00', '2012-09-01 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, '', 0, 1, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(34, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 1, 'Panda Guitar', 'panda-guitar', 3, 41, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 20.00, 0.00, 20, NULL, '2011-09-11 00:00:00', '2012-10-11 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 0, 0, '', 3, 25, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(35, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 1, 'Sassy Shopping Bags', 'sassy-shopping-bags', 3, 42, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 250.00, 0.00, 20, NULL, '2011-09-01 00:00:00', '2012-11-21 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, '', 0, 1, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(36, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 1, 'Sony Handycam', 'sony-handycam', 3, 44, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.', 60.00, 54.00, 19, NULL, '2011-09-11 00:00:00', '2012-09-01 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 10, 0.10, 0.00, 0.00, 0.00, 6.00, 0, 0, 0, '', 0, 1, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(37, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 1, 'Stress Free Searting', 'stress-free-searting', 3, 45, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.', 50.00, 0.00, 13, NULL, '2011-10-11 00:00:00', '2012-09-01 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 0, 0, '', 3, 1, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(38, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 1, 'Stress Free Seating model #4010', 'stress-free-seating-model-4010', 3, 46, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.', 200.00, 0.00, 11, NULL, '2011-09-11 00:00:00', '2012-09-01 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, '', 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(39, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 1, 'Sweetheart Box', 'sweetheart-box', 3, 47, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.', 10.00, 0.00, 10, NULL, '2011-09-11 00:00:00', '2012-10-11 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 0, 0, '', 3, 27, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(40, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 1, 'Touchmart PC', 'touchmart-pc', 3, 16, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.', 200.00, 160.00, 19, NULL, '2011-09-11 00:00:00', '2012-11-21 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 20, 0.20, 0.00, 0.00, 0.00, 40.00, 1, 0, 0, '', 3, 1, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(41, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 1, 'UPS Series', 'ups-series', 3, 30, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.', 30.00, 0.00, 14, NULL, '2011-09-01 00:00:00', '2012-12-31 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 0, 0, '', 3, 29, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(42, '2011-09-23 06:49:38', '2011-09-23 06:49:38', 1, 'USB Mini Fridge', 'usb-mini-fridge', 3, 31, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 80.00, 0.00, 16, NULL, '2011-09-11 00:00:00', '2012-12-31 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 1, 0, 0, '', 3, 1, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 1, 0),
(50, '2012-02-29 06:29:14', '2012-02-29 06:29:14', 1, 'Camp shirt ', 'camp-shirt', 3, 15, 'a loose, straight-cut, short sleeved shirt  ', 599.00, 509.15, 495, NULL, '2012-02-29 10:24:00', '2012-03-13 06:24:00', NULL, '0000-00-00 00:00:00', 0, 0, 15, 89.85, 0.00, 0.00, 0.00, 89.85, 1, 0, 0, '', 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, '', '', 1, 0, 0, 1, 1),
(61, '2012-02-29 07:45:36', '2012-02-29 09:32:47', 1, 'Diaper shirt', 'diaper-shirt', 3, 15, 'hirt for infants which includes a long back that is wrapped between the legs and buttoned to the front of the shirt', 450.00, 450.00, 400, NULL, '2012-03-01 08:42:00', '2012-06-29 07:42:00', NULL, '0000-00-00 00:00:00', 0, 0, NULL, NULL, 0.00, 0.00, 0.00, NULL, 1, 0, 1, '', 1, 20, 0, 3, 0, 0.00, 1, 450.00, 1, 450.00, '', '', 1, 0, 0, 1, 1),
(60, '2012-02-29 07:40:59', '2012-02-29 09:44:15', 1, 'Casual Shirt', 'casual-shirt', 3, 15, 'Casual Shirt', 1500.00, 750.00, 8000, NULL, '2012-03-29 07:39:00', '2012-04-29 07:39:00', NULL, '0000-00-00 00:00:00', 0, 0, 50, 750.00, 0.00, 0.00, 0.00, 750.00, 1, 0, 0, '', 1, 12, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, '', '', 1, 0, 0, 1, 1),
(52, '2012-02-29 06:34:42', '2012-02-29 06:34:42', 1, 'guayabera ', 'guayabera', 3, 15, 'an embroidered dress shirt with four pockets.', 800.00, 640.00, 1600, NULL, '2012-03-29 06:33:00', '2012-04-29 06:33:00', NULL, '0000-00-00 00:00:00', 0, 0, 20, 160.00, 0.00, 0.00, 0.00, 160.00, 1, 0, 0, '', 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, '', '', 1, 0, 0, 1, 1),
(53, '2012-02-29 06:37:19', '2012-02-29 06:37:19', 1, 'Poet shirt', 'poet-shirt', 3, 15, 'a loose-fitting shirt or blouse with full bishop sleeves', 400.00, 380.00, 3200, NULL, '2012-02-29 14:35:00', '2012-08-29 06:35:00', NULL, '0000-00-00 00:00:00', 0, 0, 5, 20.00, 0.00, 0.00, 0.00, 20.00, 1, 0, 0, '', 0, 3, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, '', '', 1, 0, 0, 1, 1),
(54, '2012-02-29 06:40:26', '2012-02-29 09:59:39', 1, 'T-shirt ', 't-shirt', 3, 15, 'a casual shirt without a collar or buttons', 1000.00, 500.00, 1500, NULL, '2012-02-29 18:38:00', '2012-03-29 06:38:00', NULL, '0000-00-00 00:00:00', 0, 0, 50, 500.00, 0.00, 0.00, 0.00, 500.00, 1, 0, 1, '', 1, 2, 0, 1, 0, 0.00, 1, 1000.00, 0, 0.00, '', '', 1, 0, 0, 1, 1),
(44, '2011-09-23 06:49:38', '2011-09-23 06:49:38', 1, 'Zynga Poker Chips', 'zynga-poker-chips', 3, 23, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.', 350.00, 262.50, 10, NULL, '2011-10-11 00:00:00', '2012-11-21 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, 25, 0.25, 0.00, 0.00, 0.00, 87.50, 1, 0, 0, '', 3, 32, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, NULL, NULL, 1, 0, 0, 0, 0),
(62, '2012-02-29 07:48:45', '2012-02-29 09:43:53', 1, 'tube top', 'tube-top', 3, 15, 'shoulderless, sleeveless "tube" that wraps the torso not reaching higher than the armpit', 450.00, 396.00, 800, 10, '2012-02-29 20:59:00', '2012-03-29 07:47:00', NULL, '0000-00-00 00:00:00', 0, 0, 12, 54.00, 0.00, 0.00, 0.00, 54.00, 1, 0, 1, '', 1, 14, 0, 1, 0, 0.00, 1, 450.00, 0, 0.00, '', '', 1, 0, 0, 1, 1),
(48, '2012-02-29 06:11:12', '2012-02-29 06:11:12', 1, 'Woven Shirt', 'woven-shirt', 3, 15, 'Men''s Woven Shirt', 500.00, 400.00, 1000, 1, '2012-03-11 06:07:00', '2012-03-29 06:07:00', NULL, '0000-00-00 00:00:00', 0, 0, 20, 100.00, 0.00, 0.00, 0.00, 100.00, 1, 0, 0, '', 0, 2, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, 'Men''s Woven Shirts', 'Men''s Woven Shirts', 2, 0, 0, 1, 1),
(65, '2012-03-02 00:58:38', '2012-03-02 01:21:02', 1, 'sakthui sadjsadghkashs', 'sakthui-sadjsadghkashs', 3, 12, 'sakthui sadjsadghkashs', 896.00, 896.00, 1, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, NULL, NULL, 0.00, 0.00, 0.00, NULL, 0, 1, 0, '', 0, 19, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, '', '', 1, 0, 0, 1, 1),
(66, '2012-03-02 01:59:23', '2012-03-02 01:59:23', 1, 'super download checking', 'super-download-checking', 3, 15, 'testing', 12.50, 12.50, 23, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, NULL, NULL, 0.00, 0.00, 0.00, NULL, 0, 1, 1, 'www.youtube.com/watch?v=62S4ChIbz0c', 0, 4, 0, 1, 1, 2.50, 0, 0.00, 0, 0.00, 'test', '', 2, 0, 0, 1, 1);
INSERT INTO `products` (`id`, `created`, `modified`, `user_id`, `title`, `slug`, `product_status_id`, `category_id`, `description`, `original_price`, `discounted_price`, `quantity`, `maximum_quantity_to_send_as_gift`, `start_date`, `end_date`, `credits`, `credit_expiry_date`, `is_credit_product`, `maximum_quantity_to_buy_as_own`, `discount_percentage`, `discount_amount`, `bonus_amount`, `commission_percentage`, `total_commission_amount`, `savings`, `is_requires_shipping`, `is_having_file_to_download`, `sold_quantity`, `video_url`, `product_shipment_cost_count`, `product_view_count`, `product_download_count`, `order_item_count`, `sales_cleared_count`, `sales_cleared_amount`, `sales_pending_count`, `sales_pending_amount`, `sales_lost_count`, `sales_lost_amount`, `meta_keywords`, `meta_description`, `ip_id`, `is_system_flagged`, `admin_suspend`, `is_active`, `is_product_variant_enabled`) VALUES
(67, '2012-03-02 02:28:28', '2012-03-02 02:28:28', 1, 'my shipping product ', 'my-shipping-product', 3, 21, 'my shipping product ', 5.00, 5.00, 7, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', 0, 0, NULL, NULL, 0.00, 0.00, 0.00, NULL, 1, 0, 1, '', 1, 21, 0, 1, 0, 0.00, 1, 5.00, 0, 0.00, '', '', 1, 0, 0, 1, 0);


-- --------------------------------------------------------

--
-- Table structure for table `product_downloads`
--

DROP TABLE IF EXISTS `product_downloads`;
CREATE TABLE IF NOT EXISTS `product_downloads` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) default NULL,
  `ip_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  KEY `ip_id` (`ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Product Download Details';

--
-- Dumping data for table `product_downloads`
--


-- --------------------------------------------------------

--
-- Table structure for table `product_shipment_costs`
--

DROP TABLE IF EXISTS `product_shipment_costs`;
CREATE TABLE IF NOT EXISTS `product_shipment_costs` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `grouped_country_id` bigint(20) NOT NULL,
  `shipment_cost` double(10,2) NOT NULL,
  `additional_quantity_shipment_cost` double(10,2) default NULL,
  PRIMARY KEY  (`id`),
  KEY `grouped_country_id` (`grouped_country_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_shipment_costs`
--

INSERT INTO `product_shipment_costs` (`id`, `created`, `modified`, `product_id`, `grouped_country_id`, `shipment_cost`, `additional_quantity_shipment_cost`) VALUES
(1, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 1, -1, 7.00, 4.50),
(2, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 1, 220, 22.00, 8.50),
(3, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 1, -8, 15.00, 0.50),
(4, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 3, -1, 19.00, 4.50),
(5, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 3, -2, 24.00, 2.50),
(6, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 3, -8, 9.00, 3.50),
(7, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 8, -7, 19.00, 1.50),
(8, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 8, -2, 9.00, 1.50),
(9, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 8, -2, 21.00, 7.50),
(10, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 9, 54, 9.00, 5.50),
(11, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 9, -5, 9.00, 9.50),
(12, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 9, -1, 17.00, 8.50),
(13, '2011-09-23 06:49:35', '2011-09-23 06:49:35', 13, 80, 17.00, 0.50),
(14, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 13, -4, 11.00, 5.50),
(15, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 13, -7, 17.00, 0.50),
(16, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 15, -2, 19.00, 0.50),
(17, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 15, -1, 7.00, 7.50),
(18, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 15, -7, 21.00, 7.50),
(19, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 17, -2, 13.00, 0.50),
(20, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 17, -2, 13.00, 2.50),
(21, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 17, -3, 21.00, 0.50),
(22, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 19, -3, 7.00, 8.50),
(23, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 19, -5, 9.00, 1.50),
(24, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 19, -2, 21.00, 0.50),
(25, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 21, -4, 24.00, 3.50),
(26, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 21, 241, 19.00, 5.50),
(27, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 21, -7, 21.00, 8.50),
(28, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 24, -7, 17.00, 5.50),
(29, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 24, -4, 9.00, 8.50),
(30, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 24, -2, 15.00, 7.50),
(31, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 26, -3, 22.00, 1.50),
(32, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 26, -4, 13.00, 0.50),
(33, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 26, -2, 7.00, 3.50),
(34, '2011-09-23 06:49:36', '2011-09-23 06:49:36', 27, -2, 24.00, 5.50),
(35, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 27, -8, 11.00, 8.50),
(36, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 27, -5, 15.00, 7.50),
(37, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 29, -4, 13.00, 4.50),
(38, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 29, 92, 22.00, 4.50),
(39, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 29, -6, 15.00, 0.50),
(40, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 34, -7, 11.00, 0.50),
(41, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 34, -8, 21.00, 0.50),
(42, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 34, -8, 9.00, 4.50),
(43, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 37, -3, 7.00, 5.50),
(44, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 37, -5, 22.00, 9.50),
(45, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 37, -3, 13.00, 8.50),
(46, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 39, -7, 24.00, 6.50),
(47, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 39, -8, 24.00, 6.50),
(48, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 39, -7, 21.00, 8.50),
(49, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 40, 219, 13.00, 0.50),
(50, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 40, -2, 15.00, 4.50),
(51, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 40, 161, 22.00, 7.50),
(52, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 41, 12, 15.00, 6.50),
(53, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 41, -8, 13.00, 8.50),
(54, '2011-09-23 06:49:37', '2011-09-23 06:49:37', 41, -8, 24.00, 6.50),
(55, '2011-09-23 06:49:38', '2011-09-23 06:49:38', 42, -4, 21.00, 6.50),
(56, '2011-09-23 06:49:38', '2011-09-23 06:49:38', 42, -7, 11.00, 6.50),
(57, '2011-09-23 06:49:38', '2011-09-23 06:49:38', 42, -7, 17.00, 0.50),
(58, '2011-09-23 06:49:38', '2011-09-23 06:49:38', 43, 180, 19.00, 6.50),
(59, '2011-09-23 06:49:38', '2011-09-23 06:49:38', 43, -2, 15.00, 4.50),
(60, '2011-09-23 06:49:38', '2011-09-23 06:49:38', 43, 222, 17.00, 6.50),
(61, '2011-09-23 06:49:38', '2011-09-23 06:49:38', 44, -5, 17.00, 7.50),
(62, '2011-09-23 06:49:38', '2011-09-23 06:49:38', 44, -6, 17.00, 5.50),
(63, '2011-09-23 06:49:38', '2011-09-23 06:49:38', 44, -5, 7.00, 5.50);

-- --------------------------------------------------------

--
-- Table structure for table `product_statuses`
--

DROP TABLE IF EXISTS `product_statuses`;
CREATE TABLE IF NOT EXISTS `product_statuses` (
  `id` int(4) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `product_count` bigint(20) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_statuses`
--

INSERT INTO `product_statuses` (`id`, `created`, `modified`, `name`, `product_count`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Draft', 3),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Upcoming', 3),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Open', 35),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Closed', 0),
(5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Canceled', 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_views`
--

DROP TABLE IF EXISTS `product_views`;
CREATE TABLE IF NOT EXISTS `product_views` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) default NULL,
  `ip_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  KEY `ip_id` (`ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Product View Details';

--
-- Dumping data for table `product_views`
--


-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL auto_increment,
  `setting_category_id` int(11) NOT NULL,
  `setting_category_parent_id` bigint(20) default '0',
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `value` text collate utf8_unicode_ci,
  `description` text collate utf8_unicode_ci,
  `type` varchar(8) collate utf8_unicode_ci default NULL,
  `options` text collate utf8_unicode_ci,
  `label` varchar(255) collate utf8_unicode_ci default NULL,
  `order` int(11) NOT NULL,
  `fieldset` varchar(255) collate utf8_unicode_ci NOT NULL,
  `fieldset_order` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `setting_category_id` (`setting_category_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Site Setting Details';

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_category_id`, `setting_category_parent_id`, `name`, `value`, `description`, `type`, `options`, `label`, `order`, `fieldset`, `fieldset_order`) VALUES
(1, 17, 1, 'site.name', 'privateshop', 'This name will used in all pages and emails.', 'text', NULL, 'Name', 1, '', 0),
(2, 0, 0, 'site.version', 'v1.0b1', 'It specifies the version of the site.', 'text', NULL, 'Site Version', 2, '', 0),
(10, 25, 2, 'site.tracking_script', ' <script type="text/javascript"> var _gaq = _gaq || []; _gaq.push([''_setAccount'', ''UA-21769470-1'']); _gaq.push([''_setDomainName'', ''.dev.agriya.com'']); _gaq.push([''_trackPageview'']); (function() { var ga = document.createElement(''script''); ga.type = ''text/javascript''; ga.async = true; ga.src = (''https:'' == document.location.protocol ? ''https://ssl'' : ''http://www'') + ''.google-analytics.com/ga.js''; var s = document.getElementsByTagName(''script'')[0]; s.parentNode.insertBefore(ga, s); })(); </script>', 'This is the site tracker script, used for track and analyze data about how people are getting to your website. e.g., Google Analytics. http://www.google.com/analytics/', 'textarea', NULL, 'Site Tracker Code', 1, '', 0),
(56, 35, 6, 'site.date.format', '%b %d, %Y', 'This is the date format which is displayed in our site.', 'text', NULL, 'Date Format', 1, '', 0),
(57, 35, 6, 'site.datetime.format', '%b %d, %Y %I:%M %p', 'This is the date-time format which is displayed in our site.', 'text', NULL, 'Date-Time Format', 2, '', 0),
(58, 35, 6, 'site.time.format', '%I:%M %p', 'This is the time format which is displayed in our site.', 'text', NULL, 'Time Format', 3, '', 0),
(59, 35, 6, 'site.date.tooltip', '%b %d, %Y %I:%M %p', 'You can make changes in date format tooltip of the site.', 'text', NULL, 'Date Format Tooltip', 4, '', 0),
(60, 35, 6, 'site.time.tooltip', '%B %d, %Y (%A) %Z', 'This is the time tooltip format which is displayed in our site.', 'text', NULL, 'Time Tooltip Format', 5, '', 0),
(61, 35, 6, 'site.datetime.tooltip', '%B %d, %Y %I:%M:%S %p (%A) %Z', 'This is the date tooltip format which is displayed in our site.', 'text', NULL, 'Date Tooltip Format ', 6, '', 0),
(71, 21, 5, 'site.maintenance_mode', '0', 'On enabling this feature, only administrator can access the site (e.g., http://yourdomain.com/admin). Users will see a temporary page until you return to turn this off. (Turn this on, whenever you need to perform maintenance in the site.)', 'checkbox', NULL, 'Enable Maintenance Mode', 1, '', 0),
(72, 33, 6, 'site.language', 'en', 'The selected language will be used as default language all over the site (also for emails)', 'select', NULL, 'Site language ', 1, '', 0),
(73, 25, 2, 'site.robots', '', 'Content for robots.txt; (search engine) robots specific instructions. Refer,http://www.robotstxt.org/ for syntax and usage.', 'textarea', NULL, 'robots.txt', 2, '', 0),
(159, 35, 6, 'site.datetimehighlight.tooltip', '%B %d, %Y %I:%M:%S %p (%A) %Z', 'You can change your datetime highlight tooltip of your site using this value.', 'text', NULL, 'Date Time Highlight Tooltip', 7, '', 0),
(179, 34, 6, 'site.currency', '$', 'The selected symbol will be used as default currency symbol all over the site (also for emails)', 'text', NULL, 'Currency Symbol', 1, '', 0),
(252, 34, 6, 'site.currency_code', 'USD', 'The selected currency code willbe used as paypal currency code.', 'select', 'AUD,BRL,CAD,CZK,DKK,EUR,HKD,HUF,ILS,JPY,MXN,NOK,NZD,PHP,PLN,GBP,SGD,SEK,CHF,TWD,THB,TRY,USD', 'Paypal Currency Code', 2, '', 0),
(256, 37, 3, 'user.is_allow_user_to_switch_language', '1', 'On enabling this feature, user can switch the language.', 'checkbox', '', 'Enable User to Switch Language', 7, '', 0),
(3, 22, 2, 'meta.keywords', 'agriya, shopping cart, utiquely, opencart, prestashop, oscommerce', 'These are the keywords used for improving search engine results of our site. (Comma separated for multiple keywords).', 'text', NULL, 'Keywords', 1, '', 0),
(4, 22, 2, 'meta.description', 'Utiquely helps you to purchase different types of products.', 'This is the short description of your site, used by search engines on search result pages to display preview snippets for a given page.', 'textarea', NULL, 'Description', 2, '', 0),
(9, 36, 3, 'user.using_to_login', 'username', 'Users will be able to login with chosen login handle (username or email address) along with their password.', 'select', 'username, email', 'Login Handle', 1, 'Normal', 0),
(41, 37, 3, 'user.is_admin_activate_after_register', '0', 'On enabling this feature, admin need to approve each user after registration (User cannot login until admin approves)', 'checkbox', NULL, 'Enable Administrator Approval After Registration', 1, 'Normal', 0),
(42, 37, 3, 'user.is_email_verification_for_register', '1', 'On enabling this feature, user need to verify their email address provided during registration. (User cannot login until email address is verified)', 'checkbox', NULL, 'Enable Email Verification After Registration', 2, 'Normal', 0),
(43, 37, 3, 'user.is_auto_login_after_register', '1', 'On enabling this feature, users will be automatically logged-in after registration. (Only when "Email Verification" & "Admin Approval" is disabled)', 'checkbox', NULL, 'Enable Auto Login After Registration', 3, 'Normal', 0),
(44, 37, 3, 'user.is_admin_mail_after_register', '1', 'On enabling this feature, notification mail will be sent to administrator on each registration.', 'checkbox', NULL, 'Enable Notify Administrator on Each Registration', 4, '', 0),
(45, 37, 3, 'user.is_welcome_mail_after_register', '1', 'On enabling this feature, users will receive a welcome mail after registration. ', 'checkbox', NULL, 'Enable Sending Welcome Mail After Registration', 5, '', 0),
(47, 37, 3, 'user.is_logout_after_change_password', '1', 'On enabling this feature, user will be auto logged out after change the password.', 'checkbox', NULL, 'Enable Logout After Password Change', 6, 'Normal', 0),
(53, 36, 3, 'user.is_enable_openid', '1', 'On enabling this feature, users can authenticate their privateShop account using OpenID.', 'checkbox', NULL, 'Enable OpenID', 3, 'OpenID (Yahoo/Gmail/OpenID', 1),
(250, 36, 3, 'twitter.is_enabled_twitter_connect', '1', 'On enabling this feature, users can authenticate their privateShop account using Twitter.', 'checkbox', NULL, 'Enable Twitter', 5, 'Twitter', 3),
(214, 36, 3, 'facebook.is_enabled_facebook_connect', '1', 'On enabling this feature, users can authenticate their privateShop account using Facebook.', 'checkbox', NULL, 'Enable Facebook', 4, 'Facebook', 2),
(25, 7, 0, 'thumb_size.micro_thumb.width', '18', '', 'text', NULL, 'Micro thumb', 0, '', 0),
(26, 7, 0, 'thumb_size.micro_thumb.height', '18', '', 'text', NULL, '', 0, '', 0),
(27, 7, 0, 'thumb_size.small_thumb.width', '31', '', 'text', NULL, 'Small thumb', 0, '', 0),
(28, 7, 0, 'thumb_size.small_thumb.height', '31', '', 'text', NULL, '', 0, '', 0),
(29, 7, 0, 'thumb_size.medium_thumb.width', '120', '', 'text', NULL, 'Medium thumb', 0, '', 0),
(30, 7, 0, 'thumb_size.medium_thumb.height', '90', '', 'text', NULL, '', 0, '', 0),
(31, 7, 0, 'thumb_size.normal_thumb.width', '75', '', 'text', NULL, 'Normal thumb', 0, '', 0),
(32, 7, 0, 'thumb_size.normal_thumb.height', '93', '', 'text', NULL, '', 0, '', 0),
(33, 7, 0, 'thumb_size.big_thumb.width', '464', '', 'text', NULL, 'Big thumb', 0, '', 0),
(34, 7, 0, 'thumb_size.big_thumb.height', '626', '', 'text', NULL, '', 0, '', 0),
(35, 7, 0, 'thumb_size.small_big_thumb.width', '150', '', 'text', NULL, 'Small big thumb', 0, '', 0),
(36, 7, 0, 'thumb_size.small_big_thumb.height', '150', '', 'text', NULL, '', 0, '', 0),
(37, 7, 0, 'thumb_size.medium_big_thumb.width', '240', '', 'text', NULL, 'Medium big thumb', 0, '', 0),
(38, 7, 0, 'thumb_size.medium_big_thumb.height', '330', '', 'text', NULL, '', 0, '', 0),
(39, 7, 0, 'thumb_size.very_big_thumb.width', '525', '', 'text', NULL, 'Very big thumb', 0, '', 0),
(40, 7, 0, 'thumb_size.very_big_thumb.height', '362', '', 'text', NULL, '', 0, '', 0),
(164, 7, 0, 'thumb_size.large_thumb.width', '960', NULL, 'text', 'text', NULL, 0, '', 0),
(165, 7, 0, 'thumb_size.large_thumb.height', '400', NULL, 'text', 'text', NULL, 0, '', 0),
(181, 7, 0, 'thumb_size.normal_big_thumb.width', '475', '', 'text', NULL, 'Normal big thumb', 0, '', 0),
(182, 7, 0, 'thumb_size.normal_big_thumb.height', '300', NULL, 'text', NULL, 'Normal big thumb', 0, '', 0),
(191, 7, 0, 'thumb_size.large_big_thumb.width', '960', NULL, 'text', NULL, 'Large big thumb', 0, '', 0),
(192, 7, 0, 'thumb_size.large_big_thumb.height', '550', NULL, 'text', NULL, 'Large big thumb', 0, '', 0),
(313, 7, 0, 'thumb_size.user_view_thumb.width', '175', '', 'text', NULL, 'Small big thumb', 0, '', 0),
(314, 7, 0, 'thumb_size.user_view_thumb.height', '200', '', 'text', NULL, '', 0, '', 0),
(316, 7, 0, 'thumb_size.normal_medium_thumb.width', '90', '', 'text', NULL, 'Normal medium thumb', 0, '', 0),
(317, 7, 0, 'thumb_size.normal_medium_thumb.height', '70', '', 'text', NULL, '', 0, '', 0),
(208, 38, 4, 'facebook.fb_access_token', 'AAADhDKUSZBZCMBAPblsUFOOLLgmEyqAQ8rZCWuyZBzZCAlunAEizAfsKCFfivReEGPAmzp0PePsZCzLiyJvdvRWRxxeAISfpKqECophPQSqwZDZD', 'This will be automatically updated when on clicking "Update Facebook Credentials" link. (Required for posting in Facebook)', 'text', NULL, 'Access Token', 5, 'Auto Update Fields', 2),
(209, 38, 4, 'facebook.fb_user_id', '100000235263789', 'This will be automatically updated when on clicking "Update Facebook Credentials" link. (Required for posting in Facebook)', 'text', '', 'User ID ', 6, 'Facebook API Details', 1),
(210, 38, 4, 'facebook.app_id', '247444425341939', 'This is the application ID used in Facebook plugins such as like box, login and post.', 'text', NULL, 'Application ID', 1, 'Facebook API Details', 1),
(212, 38, 4, 'facebook.fb_secrect_key', 'b5ea8a53d904e29280adeed5d79cbae0', 'This is the Facebook secret key used for authentication and other Facebook related plugins support.', 'text', NULL, 'Secret Key', 4, 'Facebook API Details', 1),
(213, 38, 4, 'facebook.fb_api_key', '247444425341939', 'This is the Facebook app key used for authentication and other Facebook related plugins support', 'text', NULL, 'Application Key', 3, 'Facebook API Details', 1),
(305, 38, 4, 'facebook.page_id', '203372209756520', 'This is the Facebook page ID, if specified, any deal when gets opened will be posted in this page wall, instead of the configured account.', 'text', NULL, 'Page ID', 2, 'Auto Update Fields', 2),
(183, 20, 13, 'messages.content_length', '50', 'This is the maximum number of content length has to display in the message list for user side.', 'text', NULL, 'Maximum Number of Content Length', 1, '', 0),
(184, 20, 13, 'messages.page_size', '50', 'This is the maximum number of messages per page.', 'text', NULL, 'Maximum Number of Messages Per Page', 2, '', 0),
(186, 20, 13, 'messages.is_send_email_on_new_message', '1', 'On enabling this feature, user can receive external e-mail notification for new message.', 'checkbox', NULL, 'Enable Send External E-mail for New Message', 3, '', 0),
(187, 20, 13, 'messages.allowed_message_size', '2', 'This is the maximum number of message size per user.', 'text', NULL, 'Maximum Number of Message Size', 4, '', 0),
(188, 20, 13, 'messages.allowed_message_size_unit', 'MB', 'This is the message size unit per user.', 'select', 'MB, KB, GB, B', 'Message Size Unit', 5, '', 0),
(189, 20, 13, 'messages.is_allow_send_messsage', '1', 'On enabling this feature, send message will be enabled.', 'checkbox', NULL, 'Enable Send Message', 6, '', 0),
(193, 32, 14, 'suspicious_detector.suspiciouswords', 'stupid\nfool\n\\w+([-+.]\\w+)*@\\w+([-.]\\w+)*\\.\\w+([-.]\\w+)*([,;]\\s*\\w+([-+.]\\w+)*@\\w+([-.]\\w+)*\\.\\w+([-.]\\w+)*)*\n^0[234679]{1}[\\s]{0,1}[\\-]{0,1}[\\s]{0,1}[1-9]{1}[0-9]{6}$\n', 'The suspicious words given will be matched with user given message and will be auto flagged if such words are found.\r\n(Note: Suspicious detection will be checked during description creation and in contacting other users.Detection words should be newline separated.)', 'textarea', NULL, 'Suspicious words', 1, '', 0),
(248, 32, 14, 'suspicious_detector.is_enabled', '1', 'You can enable or disable the Suspicious word detector feature.', 'checkbox', NULL, 'Enable Suspicious word detector', 2, '', 0),
(229, 39, 4, 'twitter.site_user_access_token', '75254727-3JQx2MPWtYfovfGoLLXCruXMyFQCt0A36AJntMNYM', 'This will be automatically updated when on clicking "Update Twitter Credentials" link. (Required for posting in Twitter)', 'text', NULL, 'Access token', 4, 'Auto update fields', 2),
(226, 39, 4, 'twitter.consumer_key', 'oqs9Lp1Fv488ygmBQKRQvQ', 'This is the consumer key used for authentication and posting on Twitter.', 'text', NULL, 'Consumer key', 1, 'Twitter API Details', 1),
(227, 39, 4, 'twitter.consumer_secret', 'GTWGpcCFjE7eDFC8i4UBSQX1caQ32jbtUPcmhx5qrvM', 'This is the consumer secret key used for authentication and posting on Twitter.', 'text', NULL, 'Consumer Secret Key', 2, 'Twitter API Details', 1),
(228, 39, 4, 'twitter.site_user_access_key', 'CPncLXcZWT6tWJ1ZXBxaIDCM2QDrRxNNXqmszsnVE', 'This will be automatically updated when on clicking "Update Twitter Credentials" link. (Required for posting in Twitter)', 'text', NULL, 'Access key', 3, 'Auto update fields', 2),
(224, 39, 4, 'twitter.username', 'Private_Shop', 'This is the Twitter username of the account has been created.', 'text', NULL, 'Twitter User Name', 5, 'Auto update fields', 2),
(5, 19, 1, 'EmailTemplate.admin_email', 'privateShop <productdemo.admin+contact+privateshop@gmail.com>', 'This is the email address to which you will receive the mail from contact form.', 'text', NULL, 'Contact Email', 4, '', 0),
(180, 19, 1, 'EmailTemplate.from_email', 'privateShop <productdemo.admin+noreply+privateshop@gmail.com>', 'This is the email address that will appear in the "From" field of all emails sent from the site.', 'text', NULL, 'From Email', 1, '', 0),
(266, 19, 1, 'EmailTemplate.reply_to_email', 'privateShop <productdemo.admin+noreply+privateshop@gmail.com>', '"Reply-To" email header for all emails. Leave it empty to receive replies as usual (to "From" email address).', 'text', '', 'Reply To Email', 2, '', 0),
(267, 19, 1, 'EmailTemplate.no_reply_email', 'privateShop <productdemo.admin+noreply+privateshop@gmail.com>', 'You can change this email address so that ''No Reply'' email will be changed in all email communication.', 'text', NULL, 'No Reply Email', 3, '', 0),
(337, 0, 0, 'barcode.symbology', 'qr', 'This is the barcode symbology which used in voucher.', 'select', 'select', 'Barcode Symbology', 1, '', 0),
(338, 40, 11, 'barcode.is_barcode_enabled', '1', 'On enabling this feature, barcode will be used in invoice page.', 'checkbox', NULL, 'Enable Barcode in Invoice Page', 1, '', 0),
(339, 41, 11, 'barcode.width', '150', 'This is the barcode width which used in invoice page.', 'text', NULL, 'Barcode Width', 2, '', 0),
(340, 41, 11, 'barcode.height', '150', 'This is the barcode height which used in invoice page.', 'text', NULL, 'Barcode Height', 3, '', 0),
(310, 21, 5, 'site.is_ssl_enabled', '0', 'On enabling this feature, user''s login, registration and purchases will be managed in a more secured way. (Requires purchase of an SSL certificate if this option is in disabled state)', 'checkbox', NULL, 'Enable SSL (Secure Socket Layer)', 2, '', 0),
(341, 38, 4, 'product.post_product_on_facebook', '1', 'On enabling this feature, Post Newly Open Product in Site''s Facebook Wall', 'checkbox', NULL, 'Post New Product on Facebook Wall', 8, '', 0),
(342, 0, 0, 'social_networking.post_product_on_user_facebook', '0', 'Automatically post newly added products in users Facebook wall.', 'checkbox', NULL, 'Auto post on User  Facebook', 9, '', 0),
(346, 0, 0, 'social_networking.post_product_on_user_twitter', '0', 'Automatically post newly added products in users Twitter wall.', 'checkbox', NULL, 'Auto post on User Twitter', 8, '', 0),
(345, 39, 4, 'product.post_product_on_twitter', '1', 'On enabling this feature, Post All the Open Product in Site''s Twitter Account.', 'checkbox', NULL, 'Post New Product on Twitter', 7, '', 0),
(347, 27, 26, 'invite.is_referral_system_enabled', '1', NULL, 'checkbox', NULL, 'Referral system enabled', 1, '', 0),
(348, 31, 26, 'invite.referral_amount', '5', 'This will be the amount earned by referral user.', 'text', NULL, 'Referral Amount', 1, '', 0),
(349, 31, 26, 'invite.referral_cookie_expire_time', '48', 'This will be the maximum time after which the referral register cookie will be expired or unusable.', 'text', '', 'Referral Register Cookie Expire Time', 2, '', 0),
(350, 31, 26, 'invite.referral_purchase_time', '24', 'This will be the maximum time after which the referral purchase cookie will be expired or unusable.', 'text', '', 'Referral Purchase Cookie Expire Time', 3, '', 0),
(351, 45, 12, 'wallet.min_wallet_amount', '1000', 'This is the minimum amount a user can add to his wallet.', 'text', '', 'Minimum Wallet Funding Limit', 1, 'Wallet', 2),
(352, 45, 12, 'wallet.max_wallet_amount', '20000', 'This is the maximum amount a user can add to his wallet. (If left empty, then, no maximum amount restrictions)', 'text', NULL, 'Maximum Wallet Funding Limit', 2, 'Wallet', 2),
(353, 46, 12, 'user.is_user_can_withdraw_amount', '1', 'On enabling this feature the users can place a request to withdraw their wallet amount through their registered PayPal account. (Requires administrator approval for each request).', 'checkbox', NULL, 'Enable Cash Withdrawal', 1, 'Withdraw', 3),
(354, 46, 12, 'user.minimum_withdraw_amount', '2', 'This is the minimum amount a merchant can withdraw from their wallet.', 'text', NULL, 'Minimum Wallet Withdrawal Amount', 2, 'Withdraw', 3),
(355, 46, 12, 'user.maximum_withdraw_amount', '1000', 'This is the maximum amount a user can withdraw from their wallet.', 'text', NULL, 'Maximum Wallet Withdrawal Amount', 3, 'Withdraw', 3),
(356, 42, 11, 'order.auto_complete_threshold_limit', '1', 'This is the number of days to change the order status from "Shipped" to "Completed" automatically.', 'text', '', 'Number of Days Order Auto Complete', 1, '', 0),
(357, 43, 11, 'buy_as_gift.gift_wrap_fee_for_one_item', '5', 'This is the gift wrap fee for one item.', 'text', NULL, 'Gift wrap fee for one item', 1, '', 0),
(358, 43, 11, 'buy_as_gift.gift_wrap_fee_for_additional_item', '5', 'This is the gift wrap fee for additional item.', 'text', NULL, 'Gift wrap fee for additional item', 2, '', 0),
(359, 48, 28, 'seller.is_auto_approve_new_product', '0', 'While enable user''s added product will be approved automatically', 'checkbox', NULL, 'Auto approve new product', 1, '', 0),
(360, 48, 28, 'seller.commission_percentage', '10', 'This percentage will be considered for all the product, admin can override this settings in each product', 'text', '', 'Site Product Default Percentage', 2, '', 0),
(361, 48, 28, 'seller.bonus_amount', '0', 'Default bonus amount will be considered for all the product, admin can override this settings in each product', 'text', '', 'Default bonus amount for all products', 3, '', 0),
(368, 18, 1, 'site.theme', 'white', 'This is the theme that will appear in the user end.', 'select', 'black, white', 'Site Theme', 1, 'Normal', 0),
(369, 36, 3, 'site.force_login', '1', 'On enabling this feature, system will force users to login before entering into the site.', 'checkbox', NULL, 'Enable Site as PrivateShop', 2, '', 3),
(370, 18, 1, 'site.enable_landing_page', '1', 'On enabling this feature, user can view this page when he/she is in home, eg. http://www.example.com/.', 'checkbox', NULL, 'Enable New Landing Page', 3, '', 3),
(371, 38, 4, 'facebook.site_facebook_url', 'https://www.facebook.com/pages/PrivateShop/203372209756520', 'This is the site Facebook URL used displayed in the footer.', 'text', NULL, 'Facebook Account URL', 7, 'Facebook API Details', 1),
(372, 39, 4, 'twitter.site_twitter_url', 'http://twitter.com/Private_Shop', 'This is the site Twitter URL used displayed in the footer.', NULL, '', 'Twitter Account URL', 6, '', 0),
(373, 40, 11, 'attribute.is_enabled_attribute', '1', 'On enabling this feature, product have dynamic variant options.', 'checkbox', NULL, 'Enable Product Variant', 2, 'Attribute', 1),
(374, 44, 8, 'cdn.images', NULL, 'This is base URL (without trailing slash) for CDN images. (e.g., http://images.yourdomain.com)', NULL, NULL, 'CDN Image URL', 1, '', 0),
(375, 44, 8, 'cdn.css', '', 'This is base URL (including trailing slash) for CDN CSS. (e.g., http://css.yourdomain.com/)', NULL, NULL, 'CDN CSS URL', 2, '', 0),
(376, 44, 8, 'cdn.js', NULL, 'This is base URL (including trailing slash) for CDN JavaScript. (e.g., http://js.yourdomain.com/)', NULL, NULL, 'CDN JS URL', 3, '', 0),
(377, 34, 6, 'site.currency_symbol_place', 'left', 'The selected position will be used as default currency symbol position all over the site (also for emails).', 'select', 'left,right', 'Currency Symbol Position', 3, 'Site Info', 0),
(378, 21, 5, 'site.look_up_url', 'http://whois.sc/', 'URL prefix for whois lookup service. Will be used in whois links found in ##USER_LOGIN## pages to resolve users'' IP to where they are from&mdash;often down to the city or neighborhood or country. This is a security feature.', 'text', 'text', 'Whois Lookup URL', 3, '', 0),
(379, 38, 4, 'facebook.new_product_message', '##PRODUCT_NAME## ##PRODUCT_LINK##', 'This is the format used when posting on Facebook when product get opened. ##PROJECT_NAME##, ##PROJECT_LINK##., will be automatically replaced when posting on Facebook. ', 'textarea', NULL, 'Facebook Post Format', 9, '', 0),
(380, 39, 4, 'twitter.new_product_message', '###SLUGED_SITE_NAME## ##URL## ##PRODUCT_NAME##', 'This is the format used when posting on Twitter when product get opened. ##PRODUCT_NAME##, ##SLUGED_SITE_NAME##., will be automatically replaced when posting on Twitter.', 'textarea', NULL, 'Twitter Post Format', 8, '', 0);


-- --------------------------------------------------------


--
-- Table structure for table `setting_categories`
--

DROP TABLE IF EXISTS `setting_categories`;
CREATE TABLE IF NOT EXISTS `setting_categories` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `parent_id` bigint(20) default '0',
  `name` varchar(200) collate utf8_unicode_ci default NULL,
  `description` text collate utf8_unicode_ci,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Site Setting Category Details';

--
-- Dumping data for table `setting_categories`
--

INSERT INTO `setting_categories` (`id`, `created`, `modified`, `parent_id`, `name`, `description`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'System', 'Manage site name, site theme, enable landing page, contact email, from email and reply to email.'),
(26, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Referrals', 'Manage referral and various settings such as referral system enabled, register cookie expire time, purchase cookie expire time, referral amount. \r\n'),
(5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Developments', 'Manage Maintenance mode, Whois Lookup URL and other development related settings.'),
(13, '2010-10-05 18:48:24', '2010-10-05 18:48:27', 0, 'Messages', 'Allowed message size, allowed message size unit, content length, and page size.'),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'SEO', 'Manage content, meta data and other information relevant to browsers or search engines.'),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Third Party API', 'Manage third party settings such as Facebook and Twitter.'),
(6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Regional, Currency & Language', 'Manage site default language, currency and date-time format.'),
(8, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'CDN', 'Manage CDN server settings which is used to store the Images, CSS and JavaScript. So all the above will be loaded from CDN server to your site.'),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Account', 'Manage different type of login option such as User Force Login, Facebook and Twitter.'),
(10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Module Manager', 'Manage variant and user can withdraw wallet amount.'),
(11, '2010-05-03 17:28:44', '2010-05-03 17:28:44', 0, 'Product', 'Manage product configure settings, barcode and buy as gift.'),
(12, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Payment', 'Manage payment related settings such as wallet and cash withdrawal, manage different types payment gateway settings of the site. [Wallet, PayPal]. ##PAYMENT_SETTINGS_URL##'),
(14, '2010-10-07 19:04:29', '2010-10-07 19:04:30', 0, 'Suspicious Words Detector', 'Manage Suspicious word detector feature, Auto suspend product on system flag, Auto suspend message on system flag.'),
(7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Images', '<p>Here you can update the dimension (Width x Height) of the images.</p>\r\n'),
(28, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Seller', 'Seller Module related settings.'),
(9, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4, 'Facebook', '<p>Here you can update face-book related settings. </p>\r\n<p>Facebook Application keys:</p>\r\n<p>Create Facebook Application by login to site <a href="http://www.facebook.com/developers/" target="_blank">http://www.facebook.com/developers/</a>.</p>'),
(16, '2010-12-06 15:44:48', '2010-12-06 15:44:51', 1, 'EmailTemplate', '<p> Here you can update the Email Template </p>'),
(15, '2010-10-07 19:04:29', '2010-10-07 19:04:30', 4, 'Twitter', '<p>You can change the twitter ''oAuth'' related settings here. oAuth is used to post a message in twitter when a new project is added.</p><p> Refer, <a href="http://apiwiki.twitter.com/FAQ#WhenwillTwittersupportOAuth" target="_blank">http://apiwiki.twitter.com/FAQ#WhenwillTwittersupportOAuth</a> and <a href="http://apiwiki.twitter.com/FAQ#HowdoIget%E2%80%9CfromMyApp%E2%80%9DappendedtoupdatessentfrommyAPIapplication" target="_blank" >http://apiwiki.twitter.com/FAQ#HowdoIget%E2%80%9CfromMyApp%E2%80%9DappendedtoupdatessentfrommyAPIapplication</a>.</p>\r\n<p>We need to create a new application in twitter with this url <a href="http://twitter.com/apps/new" target="_blank">http://twitter.com/apps/new</a>.</p>\r\n<p>To get Twitter widget code refer <a href="http://twitter.com/goodies/widgets" target="_blank">http://twitter.com/goodies/widgets</a>.</p>\r\n<p>Twitter callback url http://sitename/users/oauth_callback (note : use site url here).</p>'),
(23, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, 'User', '<p>Here you can update user related settings.</p>'),
(41, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 11, 'Barcode', '<p>Here you can update the dimensions of barcode in invoice page.</p>\r\n'),
(42, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 11, 'Order', '<p>Here you can update the order related settings</p>'),
(43, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 11, 'Buy as Gift', 'You can update gift related settings here'),
(17, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'Site Information', 'Here you can modify site related settings such as site name.'),
(19, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'E-mails', 'Here you can modify email related settings such as contact email, from email and reply-to email.'),
(18, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'Configuration', NULL),
(27, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 26, 'Configuration', 'Here you can modify referral related settings such as enabling referrals, referral expiry time and other referral basic settings. '),
(31, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 26, 'Refer and Get Amount ', 'Here you can modify referral amount, cookie expire time for register and purchase.'),
(20, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 13, 'Configuration', 'Here you modify message settings such as message size, allowed message size unit, content length and other message related settings.'),
(21, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 5, 'Server', 'Here you can change server settings such as enabling maintenance mode settings.'),
(22, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 'Metadata', 'Here you can set metadata settings such as meta keyword and description.'),
(25, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 'SEO', 'Here you can set SEO settings such as inserting tracker code and robots.'),
(32, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 14, 'Configuration', '<p>Here you can update the Suspicious Words Detector related settings.</p>\r\n <p>Here you can place various words, which accepts regular expressions also, to match with your terms and policies.  </p>\r\n<h4>Common Regular expressions</h4>\r\n<dl class="list clearfix">\r\n	<dt>Email</dt>\r\n<dd>\\w+([-+.]\\w+)*@\\w+([-.]\\w+)*\\.\\w+([-.]\\w+)*([,;]\\s*\\w+([-+.]\\w+)*@\\w+([-.]\\w+)*\\.\\w+([-.]\\w+)*)*</dd>\r\n	<dt>Phone Number</dt>\r\n<dd>\r\n^0[234679]{1}[\\s]{0,1}[\\-]{0,1}[\\s]{0,1}[1-9]{1}[0-9]{6}$</dt>\r\n	<dt>URL</dt>\r\n<dd>((https?|ftp|gopher|telnet|file|notes|ms-help):((//)|(\\\\\\\\))+[\\w\\d:#@%/;$()~_?\\+-=\\\\\\.&]*)</dd>\r\n\r\n</dl>'),
(33, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 6, 'Regional & Language', 'Here you can change regional setting such as site language.'),
(34, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 6, 'Currency Settings', 'Here you can modify site currency settings such as currency position and default currency.'),
(35, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 6, 'Date and Time', 'Here you can modify date time settings such as date time format.'),
(36, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, 'Logins', 'Here you can modify user login settings such as enabling 3rd party logins and other login options. '),
(37, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, 'Account Settings', 'Here you can modify account settings such as admin approval, email verification and other site account settings.'),
(38, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4, 'Facebook', 'Facebook is used for login and posting message using its account details. For doing above, our site must be configured with existing Facebook account.\r\n<a href="http://dev1products.dev.agriya.com/doku.php?id=facebook-setup" target="_blank">http://dev1products.dev.agriya.com/doku.php?id=facebook-setup</a> '),
(39, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4, 'Twitter', 'Twitter is used for login and posting message using its account details. For doing above, our site must be configured with existing Twitter account. <a href="http://dev1products.dev.agriya.com/doku.php?id=twitter-setup" target="_blank">http://dev1products.dev.agriya.com/doku.php?id=twitter-setup</a> '),
(40, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 11, 'Configuration', 'Here you modify product settings such as enable barcode in invoice page, enable or disable variant module.'),
(44, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, 'Configuration', NULL),
(45, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 12, 'Wallet', 'Here you can modify wallet related setting such as maximum and minimum funding limit settings.'),
(46, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 12, 'Cash Withdraw', 'Here you can modify cash withdraw settings for a user such as enabling withdrawal and setting withdraw limit '),
(47, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10, 'Configuration', NULL),
(48, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 28, 'Configuration', NULL);


-- --------------------------------------------------------

--
-- Table structure for table `spam_filters`
--

DROP TABLE IF EXISTS `spam_filters`;
CREATE TABLE IF NOT EXISTS `spam_filters` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `other_user_id` bigint(20) NOT NULL,
  `content` text collate utf8_unicode_ci,
  `subject` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `other_user_id` (`other_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `spam_filters`
--


-- --------------------------------------------------------

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `id` bigint(20) NOT NULL auto_increment,
  `country_id` bigint(20) NOT NULL,
  `name` varchar(45) collate utf8_unicode_ci NOT NULL,
  `code` varchar(8) collate utf8_unicode_ci NOT NULL,
  `adm1code` char(4) collate utf8_unicode_ci NOT NULL,
  `is_approved` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `country_id` (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `name`, `code`, `adm1code`, `is_approved`) VALUES
(1, 253, 'British Columbia', 'BC', '', 1),
(2, 253, 'Manitoba', 'MB', '', 1),
(3, 253, 'New Brunswick', 'NB', '', 1),
(4, 43, 'Newfoundland and Labrador', 'NL', '', 1),
(5, 253, 'Northwest Territories', 'NT', '', 1),
(6, 253, 'Nunavut', 'NU', '', 1),
(7, 253, 'Ontario', 'ON', '', 1),
(8, 253, 'Prince Edward Island', 'PE', '', 1),
(9, 253, 'Quebec', 'QC', '', 1),
(10, 253, 'Saskatchewan', 'SK', '', 1),
(11, 253, 'Yukon', 'YT', '', 1),
(12, 253, 'Alabama', 'AL', '', 0),
(13, 253, 'Alaska', 'AK', '', 1),
(14, 253, 'American Samoa', 'AS', '', 1),
(15, 253, 'Arizona', 'AZ', '', 1),
(16, 253, 'Arkansas', 'AR', '', 1),
(17, 253, 'California', 'CA', '', 1),
(18, 253, 'Colorado', 'CO', '', 1),
(19, 253, 'Connecticut', 'CT', '', 1),
(20, 253, 'Delaware', 'DE', '', 1),
(21, 253, 'District of Columbia', 'DC', '', 1),
(22, 253, 'Federated States of Micronesia', 'FM', '', 1),
(23, 253, 'Florida', 'FL', '', 1),
(24, 253, 'Georgia', 'GA', '', 1),
(25, 253, 'Guam', 'GU', '', 1),
(26, 253, 'Hawaii', 'HI', '', 1),
(27, 253, 'Illinois', 'IL', '', 1),
(28, 253, 'Indiana', 'IN', '', 1),
(29, 253, 'Iowa', 'IA', '', 1),
(30, 253, 'Kansas', 'KS', '', 1),
(31, 253, 'Kentucky', 'KY', '', 1),
(32, 253, 'Louisiana', 'LA', '', 1),
(33, 253, 'Maine', 'ME', '', 1),
(34, 253, 'Marshall Islands', 'MH', '', 1),
(35, 253, 'Maryland', 'MD', '', 1),
(36, 253, 'Massachusetts', 'MA', '', 1),
(37, 253, 'Michigan', 'MI', '', 1),
(38, 253, 'Minnesota', 'MN', '', 1),
(39, 253, 'Mississippi', 'MS', '', 1),
(40, 253, 'Missouri', 'MO', '', 1),
(41, 253, 'Montana', 'MT', '', 1),
(42, 253, 'Nebraska', 'NE', '', 1),
(43, 253, 'Nevada', 'NV', '', 1),
(44, 253, 'New Hampshire', 'NH', '', 1),
(45, 253, 'New Jersey', 'NJ', '', 1),
(46, 253, 'New Mexico', 'NM', '', 1),
(47, 253, 'New York', 'NY', '', 1),
(48, 253, 'North Carolina', 'NC', '', 1),
(49, 253, 'North Dakota', 'ND', '', 1),
(50, 253, 'Northern Mariana Islands', 'MP', '', 1),
(51, 253, 'Oklahoma', 'OK', '', 1),
(52, 253, 'Oregon', 'OR', '', 1),
(53, 253, 'Palau', 'PW', '', 1),
(54, 253, 'Pennsylvania', 'PA', '', 1),
(55, 253, 'Puerto Rico', 'PR', '', 1),
(56, 253, 'Rhode Island', 'RI', '', 1),
(57, 253, 'South Carolina', 'SC', '', 1),
(58, 253, 'South Dakota', 'SD', '', 1),
(59, 253, 'Texas', 'TX', '', 1),
(60, 253, 'Utah', 'UT', '', 1),
(61, 253, 'Vermont', 'VT', '', 1),
(62, 253, 'Virgin Islands', 'VI', '', 1),
(63, 253, 'Virginia', 'VA', '', 1),
(64, 253, 'Washington', 'WA', '', 1),
(65, 253, 'West Virginia', 'WV', '', 1),
(66, 253, 'Wisconsin', 'WI', '', 1),
(67, 253, 'Wyoming', 'WY', '', 1),
(68, 253, 'Armed Forces Americas', 'AA', '', 1),
(69, 253, 'Armed Forces', 'AE', '', 1),
(70, 253, 'Armed Forces Pacific', 'AP', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `foreign_id` bigint(20) NOT NULL,
  `class` varchar(255) collate utf8_unicode_ci NOT NULL,
  `transaction_type_id` bigint(20) default NULL,
  `amount` double(10,2) NOT NULL,
  `payment_gateway_id` bigint(20) default NULL,
  `gateway_fees` double(10,2) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `transaction_type_id` (`transaction_type_id`),
  KEY `payment_gateway_id` (`payment_gateway_id`),
  KEY `class` (`class`),
  KEY `foreign_id` (`foreign_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transactions`
--


-- --------------------------------------------------------

--
-- Table structure for table `transaction_types`
--

DROP TABLE IF EXISTS `transaction_types`;
CREATE TABLE IF NOT EXISTS `transaction_types` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `is_credit` tinyint(1) default '0',
  `message` text collate utf8_unicode_ci,
  `transaction_variables` text collate utf8_unicode_ci,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transaction_types`
--

INSERT INTO `transaction_types` (`id`, `created`, `modified`, `name`, `is_credit`, `message`, `transaction_variables`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Order purchased', 0, '##USER## placed the order, order###ORDER_NO## - ##AMOUNT##', 'ORDER_NO, USER, AMOUNT'),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Refunded', 1, 'Amount ##AMOUNT## refunded for canceled order###ORDER_NO##', 'ORDER_NO, AMOUNT'),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Referral amount received', 1, 'Amount ##AMOUNT## received for refer ##USER##', 'USER, AMOUNT'),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Amount added to wallet ', 1, 'Amount added to wallet ', NULL),
(5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'user cash withdrawal request', 0, 'Cash withdrawal request made by ##USER##', 'USER'),
(6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Withdrawal request approved for user by admin', 0, 'Withdrawal request approved for ##USER## ', 'USER'),
(7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Admin approved withdrawal request', 0, 'Admin approved the ##USER## withdrawal request', 'USER'),
(8, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Admin rejected withdrawal request', 0, '##USER## has rejected the withdrawal request', 'USER'),
(9, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Failed withdrawal request', 0, 'Withdrawal request for ##USER## has been failed', 'USER'),
(10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Amount refunded for rejected withdrawal request', 1, 'Amount refunded to ##USER## for rejected withdrawal request', 'USER'),
(11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Paid cash withdraw request amount to user', 0, 'Cash withdraw request made by user, ##USER## has been accepted.', 'USER'),
(12, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Failed withdrawal request and refunded to user', 1, 'Withdrawal request failed from paypal for user ##USER##', 'USER');

-- --------------------------------------------------------



--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
CREATE TABLE IF NOT EXISTS `translations` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `language_id` bigint(20) NOT NULL,
  `key` text collate utf8_unicode_ci NOT NULL,
  `lang_text` text collate utf8_unicode_ci NOT NULL,
  `is_translated` tinyint(1) NOT NULL,
  `is_google_translate` tinyint(1) NOT NULL,
  `is_verified` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `translations`
--

INSERT INTO `translations` (`id`, `created`, `modified`, `language_id`, `key`, `lang_text`, `is_translated`, `is_google_translate`, `is_verified`) VALUES
(1, '2012-02-21 20:14:25', '2012-02-21 20:14:25', 42, ' - A waiting for approval ', ' - A waiting for approval ', 0, 0, 0),
(2, '2012-02-21 20:14:25', '2012-02-21 20:14:25', 42, ' - Active ', ' - Active ', 0, 0, 0),
(3, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, ' - Added in this month', ' - Added in this month', 0, 0, 0),
(4, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, ' - Added in this week', ' - Added in this week', 0, 0, 0),
(5, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, ' - Added today', ' - Added today', 0, 0, 0),
(6, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, ' - Admin ', ' - Admin ', 0, 0, 0),
(7, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, ' - Amount Earned in this month', ' - Amount Earned in this month', 0, 0, 0),
(8, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, ' - Amount Earned in this week', ' - Amount Earned in this week', 0, 0, 0),
(9, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, ' - Amount Earned today', ' - Amount Earned today', 0, 0, 0),
(10, '2012-02-21 20:14:18', '2012-02-21 20:14:18', 42, ' - Approved', ' - Approved', 0, 0, 0),
(11, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, ' - Canceled ', ' - Canceled ', 0, 0, 0),
(12, '2012-02-21 20:14:25', '2012-02-21 20:14:25', 42, ' - Closed ', ' - Closed ', 0, 0, 0),
(13, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, ' - Completed ', ' - Completed ', 0, 0, 0),
(14, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, ' - Downloadable', ' - Downloadable', 0, 0, 0),
(15, '2012-02-21 20:14:25', '2012-02-21 20:14:25', 42, ' - Draft ', ' - Draft ', 0, 0, 0),
(16, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, ' - Expired ', ' - Expired ', 0, 0, 0),
(17, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, ' - Flagged ', ' - Flagged ', 0, 0, 0),
(18, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, ' - In Process ', ' - In Process ', 0, 0, 0),
(19, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, ' - in this month', ' - in this month', 0, 0, 0),
(20, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, ' - in this week', ' - in this week', 0, 0, 0),
(21, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, ' - Inactive', ' - Inactive', 0, 0, 0),
(22, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, ' - Login through Facebook ', ' - Login through Facebook ', 0, 0, 0),
(23, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, ' - Login through Gmail ', ' - Login through Gmail ', 0, 0, 0),
(24, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, ' - Login through OpenID ', ' - Login through OpenID ', 0, 0, 0),
(25, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, ' - Login through Twitter ', ' - Login through Twitter ', 0, 0, 0),
(26, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, ' - Login through Yahoo ', ' - Login through Yahoo ', 0, 0, 0),
(27, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, ' - Normal Users ', ' - Normal Users ', 0, 0, 0),
(28, '2012-02-21 20:14:25', '2012-02-21 20:14:25', 42, ' - Open ', ' - Open ', 0, 0, 0),
(29, '2012-02-21 20:14:25', '2012-02-21 20:14:25', 42, ' - Open for voting ', ' - Open for voting ', 0, 0, 0),
(30, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, ' - Paid To Seller ', ' - Paid To Seller ', 0, 0, 0),
(31, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, ' - Payment Pending ', ' - Payment Pending ', 0, 0, 0),
(32, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, ' - Product - %s', ' - Product - %s', 0, 0, 0),
(33, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, ' - Product Status - ', ' - Product Status - ', 0, 0, 0),
(34, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, ' - Registered in this month', ' - Registered in this month', 0, 0, 0),
(35, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, ' - Registered in this week', ' - Registered in this week', 0, 0, 0),
(36, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, ' - Registered through Facebook ', ' - Registered through Facebook ', 0, 0, 0),
(37, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, ' - Registered through Gmail ', ' - Registered through Gmail ', 0, 0, 0),
(38, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, ' - Registered through OpenID ', ' - Registered through OpenID ', 0, 0, 0),
(39, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, ' - Registered through Twitter ', ' - Registered through Twitter ', 0, 0, 0),
(40, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, ' - Registered through Yahoo ', ' - Registered through Yahoo ', 0, 0, 0),
(41, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, ' - Registered today', ' - Registered today', 0, 0, 0),
(42, '2012-02-21 20:14:25', '2012-02-21 20:14:25', 42, ' - Rejected ', ' - Rejected ', 0, 0, 0),
(43, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, ' - Requested in this month', ' - Requested in this month', 0, 0, 0),
(44, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, ' - Requested in this week', ' - Requested in this week', 0, 0, 0),
(45, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, ' - Requested today', ' - Requested today', 0, 0, 0),
(46, '2012-02-21 20:14:18', '2012-02-21 20:14:18', 42, ' - Search - %s', ' - Search - %s', 0, 0, 0),
(47, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, ' - Shipped ', ' - Shipped ', 0, 0, 0),
(48, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, ' - Shipping', ' - Shipping', 0, 0, 0),
(49, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, ' - Site ', ' - Site ', 0, 0, 0),
(50, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, ' - Suspend ', ' - Suspend ', 0, 0, 0),
(51, '2012-02-21 20:14:25', '2012-02-21 20:14:25', 42, ' - today', ' - today', 0, 0, 0),
(52, '2012-02-21 20:14:18', '2012-02-21 20:14:18', 42, ' - Unapproved', ' - Unapproved', 0, 0, 0),
(53, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, ' - Unverified ', ' - Unverified ', 0, 0, 0),
(54, '2012-02-21 20:14:25', '2012-02-21 20:14:25', 42, ' - Upcoming ', ' - Upcoming ', 0, 0, 0),
(55, '2012-02-21 20:14:25', '2012-02-21 20:14:25', 42, ' - User suspended ', ' - User suspended ', 0, 0, 0),
(56, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, ' - Verified ', ' - Verified ', 0, 0, 0),
(57, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, ' %s Withdrawal Requests', ' %s Withdrawal Requests', 0, 0, 0),
(58, '2012-02-21 20:14:18', '2012-02-21 20:14:18', 42, ' City could not be added. Please, try again.', ' City could not be added. Please, try again.', 0, 0, 0),
(59, '2012-02-21 20:14:18', '2012-02-21 20:14:18', 42, ' City has been added', ' City has been added', 0, 0, 0),
(60, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, ' Label could not be added. Please, try again', ' Label could not be added. Please, try again', 0, 0, 0),
(61, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, ' Label has been added', ' Label has been added', 0, 0, 0),
(62, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, ' Label should not be empty', ' Label should not be empty', 0, 0, 0),
(63, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, ' Labels already exist.', ' Labels already exist.', 0, 0, 0),
(64, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, ' Labels could not be updated. Please, try again.', ' Labels could not be updated. Please, try again.', 0, 0, 0),
(65, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, ' Labels User could not be updated. Please, try again.', ' Labels User could not be updated. Please, try again.', 0, 0, 0),
(66, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, ' Labels User has been updated', ' Labels User has been updated', 0, 0, 0),
(67, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, ' Masspay not completed', ' Masspay not completed', 0, 0, 0),
(68, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, ' Messages', ' Messages', 0, 0, 0),
(69, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, ' on ', ' on ', 0, 0, 0),
(70, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, ' or ', ' or ', 0, 0, 0),
(71, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, ' Settings', ' Settings', 0, 0, 0),
(72, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, ' to get your personal referral link.', ' to get your personal referral link.', 0, 0, 0),
(73, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, '-', '-', 0, 0, 0),
(74, '2012-02-21 20:14:38', '2012-02-21 20:14:38', 42, '- An IP address always contains 4 parts with numbers no higher than 254 separated by a dot!', '- An IP address always contains 4 parts with numbers no higher than 254 separated by a dot!', 0, 0, 0),
(75, '2012-02-21 20:14:38', '2012-02-21 20:14:38', 42, '- Banning by internet hostname might work unexpectedly and resulting in banning multiple people from the same ISP!', '- Banning by internet hostname might work unexpectedly and resulting in banning multiple people from the same ISP!', 0, 0, 0),
(76, '2012-02-21 20:14:38', '2012-02-21 20:14:38', 42, '- Banning hosts in the 10.x.x.x / 169.254.x.x / 172.16.x.x or 192.168.x.x range probably won''t work.', '- Banning hosts in the 10.x.x.x / 169.254.x.x / 172.16.x.x or 192.168.x.x range probably won''t work.', 0, 0, 0),
(77, '2012-02-21 20:14:38', '2012-02-21 20:14:38', 42, '- If a ban does not seem to work try to find out if the person you''re trying to ban doesn''t use <a href=\\"http://en.wikipedia.org/wiki/DHCP\\" target=\\"_blank\\" title=\\"DHCP\\">DHCP.</a>', '- If a ban does not seem to work try to find out if the person you''re trying to ban doesn''t use <a href=\\"http://en.wikipedia.org/wiki/DHCP\\" target=\\"_blank\\" title=\\"DHCP\\">DHCP.</a>', 0, 0, 0),
(78, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, '- IP Range: Put the starting IP address in the left and the ending IP address in the right field.', '- IP Range: Put the starting IP address in the left and the ending IP address in the right field.', 0, 0, 0),
(79, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, '- Referer block: To block google.com put google.com in the first field. To block google altogether.', '- Referer block: To block google.com put google.com in the first field. To block google altogether.', 0, 0, 0),
(80, '2012-02-21 20:14:38', '2012-02-21 20:14:38', 42, '- Setting a ban on a range of IP addresses might work unexpected and can result in false positives!', '- Setting a ban on a range of IP addresses might work unexpected and can result in false positives!', 0, 0, 0),
(81, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, '- Single IP/Hostname: Fill in either a hostname or IP address in the first field.', '- Single IP/Hostname: Fill in either a hostname or IP address in the first field.', 0, 0, 0),
(82, '2012-02-21 20:14:38', '2012-02-21 20:14:38', 42, '- Wildcards on IP addresses are allowed. Block 84.234.*.* to block the whole 84.234.x.x range!', '- Wildcards on IP addresses are allowed. Block 84.234.*.* to block the whole 84.234.x.x range!', 0, 0, 0),
(83, '2012-02-21 20:14:39', '2012-02-21 20:14:39', 42, '-- More actions --', '-- More actions --', 0, 0, 0),
(84, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, '---- More actions ----', '---- More actions ----', 0, 0, 0),
(85, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, '----Apply label----', '----Apply label----', 0, 0, 0),
(86, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, '----Remove label----', '----Remove label----', 0, 0, 0),
(87, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, '(', '(', 0, 0, 0),
(88, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, '(eg. \\"displayname &lt;email address>\\")', '(eg. \\"displayname &lt;email address>\\")', 0, 0, 0),
(89, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, '(IP address, domain or hostname)', '(IP address, domain or hostname)', 0, 0, 0),
(90, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, '(optional, shown to victim)', '(optional, shown to victim)', 0, 0, 0),
(91, '2012-02-21 20:14:38', '2012-02-21 20:14:38', 42, '(optional)', '(optional)', 0, 0, 0),
(92, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, ')', ')', 0, 0, 0),
(93, '2012-02-21 20:14:40', '2012-02-21 20:14:40', 42, '[Image: %s]', '[Image: %s]', 0, 0, 0),
(94, '2012-02-21 20:14:42', '2012-02-21 20:14:42', 42, '[Image: CAPTCHA image. You will need to recognize the text in it; audible CAPTCHA available too.]', '[Image: CAPTCHA image. You will need to recognize the text in it; audible CAPTCHA available too.]', 0, 0, 0),
(95, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, '[Image: Site Background]', '[Image: Site Background]', 0, 0, 0),
(96, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, '\\" in ', '\\" in ', 0, 0, 0),
(97, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, '\\"%s\\" Labels User could not be added. Please, try again.', '\\"%s\\" Labels User could not be added. Please, try again.', 0, 0, 0),
(98, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, '\\"%s\\" Labels User has been added', '\\"%s\\" Labels User has been added', 0, 0, 0),
(99, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, '\\"%s\\" Translation could not be updated. Please, try again.', '\\"%s\\" Translation could not be updated. Please, try again.', 0, 0, 0),
(100, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, '\\"%s\\" Translation has been updated', '\\"%s\\" Translation has been updated', 0, 0, 0),
(101, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, '#', '#', 0, 0, 0),
(102, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, '% of your', '% of your', 0, 0, 0),
(103, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, '%s for one item. %s for each additional item.', '%s for one item. %s for each additional item.', 0, 0, 0),
(104, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, '+1 votes', '+1 votes', 0, 0, 0),
(105, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, '+2 votes', '+2 votes', 0, 0, 0),
(106, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, '+3 votes', '+3 votes', 0, 0, 0),
(107, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, '+4 votes', '+4 votes', 0, 0, 0),
(108, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, '+5 votes', '+5 votes', 0, 0, 0),
(109, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, '<span>Update Facebook Credentials</span>', '<span>Update Facebook Credentials</span>', 0, 0, 0),
(110, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, '<span>Update Twitter Credentials</span>', '<span>Update Twitter Credentials</span>', 0, 0, 0),
(111, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, '18 - 34 Yrs', '18 - 34 Yrs', 0, 0, 0),
(112, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, '35 - 44 Yrs', '35 - 44 Yrs', 0, 0, 0),
(113, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, '45 - 54 Yrs', '45 - 54 Yrs', 0, 0, 0),
(114, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, '55+ Yrs', '55+ Yrs', 0, 0, 0),
(115, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'A Mail for activating your account has been sent.', 'A Mail for activating your account has been sent.', 0, 0, 0),
(116, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'About', 'About', 0, 0, 0),
(117, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'About me', 'About me', 0, 0, 0),
(118, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Account', 'Account', 0, 0, 0),
(119, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Account Balance', 'Account Balance', 0, 0, 0),
(120, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Account Summary', 'Account Summary', 0, 0, 0),
(121, '2012-02-21 20:14:38', '2012-02-21 20:14:38', 42, 'Action', 'Action', 0, 0, 0),
(122, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Action to Be Taken', 'Action to Be Taken', 0, 0, 0),
(123, '2012-02-21 20:14:35', '2012-02-21 20:14:35', 42, 'Actions', 'Actions', 0, 0, 0),
(124, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'Activate your account', 'Activate your account', 0, 0, 0),
(125, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'Activation mail has been resent.', 'Activation mail has been resent.', 0, 0, 0),
(126, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Active', 'Active', 0, 0, 0),
(127, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Active Products', 'Active Products', 0, 0, 0),
(128, '2012-02-21 20:14:33', '2012-02-21 20:14:33', 42, 'Active Users', 'Active Users', 0, 0, 0),
(129, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Active Users: %s', 'Active Users: %s', 0, 0, 0),
(130, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'Active: ', 'Active: ', 0, 0, 0),
(131, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'Active?', 'Active?', 0, 0, 0),
(132, '2012-02-21 20:14:33', '2012-02-21 20:14:33', 42, 'Add', 'Add', 0, 0, 0),
(133, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Add Amount to Wallet', 'Add Amount to Wallet', 0, 0, 0),
(134, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Add amount to wallet in', 'Add amount to wallet in', 0, 0, 0),
(135, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Add Attribute', 'Add Attribute', 0, 0, 0),
(136, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Add Attribute Group', 'Add Attribute Group', 0, 0, 0),
(137, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Add Attribute Group Type', 'Add Attribute Group Type', 0, 0, 0),
(138, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Add Banned IP', 'Add Banned IP', 0, 0, 0),
(139, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Add Cart', 'Add Cart', 0, 0, 0),
(140, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Add Category', 'Add Category', 0, 0, 0),
(141, '2012-02-21 20:14:18', '2012-02-21 20:14:18', 42, 'Add City', 'Add City', 0, 0, 0),
(142, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Add Country', 'Add Country', 0, 0, 0),
(143, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Add Fund Withdraw', 'Add Fund Withdraw', 0, 0, 0),
(144, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, 'Add Group', 'Add Group', 0, 0, 0),
(145, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Add Label', 'Add Label', 0, 0, 0),
(146, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Add Labels User', 'Add Labels User', 0, 0, 0),
(147, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Add Language', 'Add Language', 0, 0, 0),
(148, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, 'Add more', 'Add more', 0, 0, 0),
(149, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'Add more attachment', 'Add more attachment', 0, 0, 0),
(150, '2012-02-21 20:14:42', '2012-02-21 20:14:42', 42, 'Add New City', 'Add New City', 0, 0, 0),
(151, '2012-02-21 20:14:43', '2012-02-21 20:14:43', 42, 'Add New Country', 'Add New Country', 0, 0, 0),
(152, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Add New Language Variable', 'Add New Language Variable', 0, 0, 0),
(153, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'Add New Openid', 'Add New Openid', 0, 0, 0),
(154, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Add new shipping address', 'Add new shipping address', 0, 0, 0),
(155, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Add New State', 'Add New State', 0, 0, 0),
(156, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Add New Text', 'Add New Text', 0, 0, 0),
(157, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Add New Translation', 'Add New Translation', 0, 0, 0),
(158, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Add New User/Admin', 'Add New User/Admin', 0, 0, 0),
(159, '2012-02-21 20:14:22', '2012-02-21 20:14:22', 42, 'Add Page', 'Add Page', 0, 0, 0),
(160, '2012-02-21 20:14:25', '2012-02-21 20:14:25', 42, 'Add Product', 'Add Product', 0, 0, 0),
(161, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Add Product Attribute', 'Add Product Attribute', 0, 0, 0),
(162, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Add Product Voting', 'Add Product Voting', 0, 0, 0),
(163, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Add Shipping Address', 'Add Shipping Address', 0, 0, 0),
(164, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Add star', 'Add star', 0, 0, 0),
(165, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'Add State', 'Add State', 0, 0, 0),
(166, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Add to cart', 'Add to cart', 0, 0, 0),
(167, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Add to wallet', 'Add to wallet', 0, 0, 0),
(168, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Add Translation', 'Add Translation', 0, 0, 0),
(169, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Add User', 'Add User', 0, 0, 0),
(170, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Add User Address', 'Add User Address', 0, 0, 0),
(171, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Add User Openid', 'Add User Openid', 0, 0, 0),
(172, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Added On', 'Added On', 0, 0, 0),
(173, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Address', 'Address', 0, 0, 0),
(174, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Address could not be added. Please, try again.', 'Address could not be added. Please, try again.', 0, 0, 0),
(175, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Address has been added', 'Address has been added', 0, 0, 0),
(176, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Address has been updated', 'Address has been updated', 0, 0, 0),
(177, '2012-02-21 20:14:23', '2012-02-21 20:14:23', 42, 'Address you have entered is already exist. Please, try again.', 'Address you have entered is already exist. Please, try again.', 0, 0, 0),
(178, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Address: ', 'Address: ', 0, 0, 0),
(179, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, 'Address/Range', 'Address/Range', 0, 0, 0),
(180, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Admin', 'Admin', 0, 0, 0),
(181, '2012-02-21 20:14:46', '2012-02-21 20:14:46', 42, 'Admin - %s', 'Admin - %s', 0, 0, 0),
(182, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Admin : %s', 'Admin : %s', 0, 0, 0),
(183, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, 'Admin Add Attribute', 'Admin Add Attribute', 0, 0, 0),
(184, '2012-02-21 20:14:34', '2012-02-21 20:14:34', 42, 'Admin Add Attribute Group Type', 'Admin Add Attribute Group Type', 0, 0, 0),
(185, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'Admin Add Product Attribute', 'Admin Add Product Attribute', 0, 0, 0),
(186, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, 'Admin Edit Attribute', 'Admin Edit Attribute', 0, 0, 0),
(187, '2012-02-21 20:14:36', '2012-02-21 20:14:36', 42, 'Admin Edit Attribute Group', 'Admin Edit Attribute Group', 0, 0, 0),
(188, '2012-02-21 20:14:35', '2012-02-21 20:14:35', 42, 'Admin Edit Attribute Group Type', 'Admin Edit Attribute Group Type', 0, 0, 0),
(189, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'Admin Edit Product Attribute', 'Admin Edit Product Attribute', 0, 0, 0),
(190, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'Admin Suspended', 'Admin Suspended', 0, 0, 0),
(191, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Affiliate Cash Withdrawal Id', 'Affiliate Cash Withdrawal Id', 0, 0, 0),
(192, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Age', 'Age', 0, 0, 0),
(193, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Agriya Blog', 'Agriya Blog', 0, 0, 0),
(194, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'All', 'All', 0, 0, 0),
(195, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'All Mail', 'All Mail', 0, 0, 0),
(196, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'All mails', 'All mails', 0, 0, 0),
(197, '2012-02-21 20:14:46', '2012-02-21 20:14:46', 42, 'All rights reserved', 'All rights reserved', 0, 0, 0),
(198, '2012-02-21 20:14:32', '2012-02-21 20:14:32', 42, 'All Users', 'All Users', 0, 0, 0),
(199, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'All, ', 'All, ', 0, 0, 0),
(200, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'All: %s', 'All: %s', 0, 0, 0),
(201, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Allow Handle Aspect', 'Allow Handle Aspect', 0, 0, 0),
(202, '2012-02-21 20:14:50', '2012-02-21 20:14:50', 42, 'Amount', 'Amount', 0, 0, 0),
(203, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Amount (', 'Amount (', 0, 0, 0),
(204, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Amount cannot able to added in wallet. Please, try again.', 'Amount cannot able to added in wallet. Please, try again.', 0, 0, 0),
(205, '2012-02-21 20:14:33', '2012-02-21 20:14:33', 42, 'Amount should be greater than minimum amount', 'Amount should be greater than minimum amount', 0, 0, 0),
(206, '2012-02-21 20:14:33', '2012-02-21 20:14:33', 42, 'Amount should be numeric', 'Amount should be numeric', 0, 0, 0),
(207, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'An email has been sent with a link where you can change your password', 'An email has been sent with a link where you can change your password', 0, 0, 0),
(208, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Any Time Product', 'Any Time Product', 0, 0, 0),
(209, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'API Instructions', 'API Instructions', 0, 0, 0),
(210, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Application Info', 'Application Info', 0, 0, 0),
(211, '2012-02-21 20:14:32', '2012-02-21 20:14:32', 42, 'Approve', 'Approve', 0, 0, 0),
(212, '2012-02-21 20:14:33', '2012-02-21 20:14:33', 42, 'Approve (Pay to user)', 'Approve (Pay to user)', 0, 0, 0),
(213, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Approved', 'Approved', 0, 0, 0),
(214, '2012-02-21 20:14:42', '2012-02-21 20:14:42', 42, 'Approved Records: : %s', 'Approved Records: : %s', 0, 0, 0),
(215, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Approved Records: %s', 'Approved Records: %s', 0, 0, 0),
(216, '2012-02-21 20:14:41', '2012-02-21 20:14:41', 42, 'Approved?', 'Approved?', 0, 0, 0),
(217, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'Archive', 'Archive', 0, 0, 0),
(218, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Are you sure you have enterted the right e-mail address? Try again:', 'Are you sure you have enterted the right e-mail address? Try again:', 0, 0, 0),
(219, '2012-02-21 20:14:14', '2012-02-21 20:14:14', 42, 'Are you sure you want to', 'Are you sure you want to', 0, 0, 0),
(220, '2012-02-21 20:14:14', '2012-02-21 20:14:14', 42, 'Are you sure you want to do this action?', 'Are you sure you want to do this action?', 0, 0, 0),
(221, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Attach a file for your buyers to download', 'Attach a file for your buyers to download', 0, 0, 0),
(222, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Attach a new OpenID', 'Attach a new OpenID', 0, 0, 0),
(223, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'attachments', 'attachments', 0, 0, 0),
(224, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Attribute', 'Attribute', 0, 0, 0),
(225, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'attribute and group couldn''t be added', 'attribute and group couldn''t be added', 0, 0, 0),
(226, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'attribute could not be added. Please, try again.', 'attribute could not be added. Please, try again.', 0, 0, 0),
(227, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'attribute could not be updated. Please, try again.', 'attribute could not be updated. Please, try again.', 0, 0, 0),
(228, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Attribute deleted', 'Attribute deleted', 0, 0, 0),
(229, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Attribute Group', 'Attribute Group', 0, 0, 0),
(230, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'attribute group could not be added. Please, try again.', 'attribute group could not be added. Please, try again.', 0, 0, 0),
(231, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'attribute group could not be updated. Please, try again.', 'attribute group could not be updated. Please, try again.', 0, 0, 0),
(232, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Attribute group deleted', 'Attribute group deleted', 0, 0, 0),
(233, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'attribute group has been added', 'attribute group has been added', 0, 0, 0),
(234, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'attribute group has been updated', 'attribute group has been updated', 0, 0, 0),
(235, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Attribute Group Type', 'Attribute Group Type', 0, 0, 0),
(236, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'attribute group type could not be added. Please, try again.', 'attribute group type could not be added. Please, try again.', 0, 0, 0),
(237, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'attribute group type could not be updated. Please, try again.', 'attribute group type could not be updated. Please, try again.', 0, 0, 0),
(238, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Attribute group type deleted', 'Attribute group type deleted', 0, 0, 0),
(239, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'attribute group type has been added', 'attribute group type has been added', 0, 0, 0),
(240, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'attribute group type has been updated', 'attribute group type has been updated', 0, 0, 0),
(241, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, 'Attribute Group Type Value', 'Attribute Group Type Value', 0, 0, 0),
(242, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Attribute group type was not deleted', 'Attribute group type was not deleted', 0, 0, 0),
(243, '2012-02-21 20:14:33', '2012-02-21 20:14:33', 42, 'Attribute Group Types', 'Attribute Group Types', 0, 0, 0),
(244, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Attribute group was not deleted', 'Attribute group was not deleted', 0, 0, 0),
(245, '2012-02-21 20:14:36', '2012-02-21 20:14:36', 42, 'Attribute Groups', 'Attribute Groups', 0, 0, 0),
(246, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'attribute has been added', 'attribute has been added', 0, 0, 0),
(247, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'attribute has been updated', 'attribute has been updated', 0, 0, 0),
(248, '2012-02-21 20:14:15', '2012-02-21 20:14:15', 42, 'Attribute module is currently disabled. You can enable it from setting.', 'Attribute module is currently disabled. You can enable it from setting.', 0, 0, 0),
(249, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Attribute was not deleted', 'Attribute was not deleted', 0, 0, 0),
(250, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'attributeGroups', 'attributeGroups', 0, 0, 0),
(251, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'attributeGroupTypes', 'attributeGroupTypes', 0, 0, 0),
(252, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'attributes', 'attributes', 0, 0, 0),
(253, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'Authenticated failed or you may not have profile in your OpenID account', 'Authenticated failed or you may not have profile in your OpenID account', 0, 0, 0),
(254, '2012-02-21 20:14:15', '2012-02-21 20:14:15', 42, 'Authorisation Required', 'Authorisation Required', 0, 0, 0),
(255, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Authorization', 'Authorization', 0, 0, 0),
(256, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Authorization Auth Amount', 'Authorization Auth Amount', 0, 0, 0),
(257, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Authorization Auth Exp', 'Authorization Auth Exp', 0, 0, 0),
(258, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Authorization Auth Id', 'Authorization Auth Id', 0, 0, 0),
(259, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Authorization Auth Status', 'Authorization Auth Status', 0, 0, 0),
(260, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Authorization Data', 'Authorization Data', 0, 0, 0),
(261, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Authorization Parent Txn Id', 'Authorization Parent Txn Id', 0, 0, 0),
(262, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Authorization Payment Gross', 'Authorization Payment Gross', 0, 0, 0),
(263, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Authorization Pending Reason', 'Authorization Pending Reason', 0, 0, 0),
(264, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Authorization Remaining Settle', 'Authorization Remaining Settle', 0, 0, 0),
(265, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Authorization Transaction Entity', 'Authorization Transaction Entity', 0, 0, 0),
(266, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Auto Approved', 'Auto Approved', 0, 0, 0),
(267, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'Auto detected', 'Auto detected', 0, 0, 0),
(268, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Available', 'Available', 0, 0, 0),
(269, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Available Balance', 'Available Balance', 0, 0, 0),
(270, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Available Translations', 'Available Translations', 0, 0, 0),
(271, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Available Variables: ##SITE_NAME##, ##SITE_URL##, ##ABOUT_US_URL##, ##CONTACT_US_URL##, ##FAQ_URL##', 'Available Variables: ##SITE_NAME##, ##SITE_URL##, ##ABOUT_US_URL##, ##CONTACT_US_URL##, ##FAQ_URL##', 0, 0, 0),
(272, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Available Variables: ##SITE_NAME##, ##SITE_URL##, ##ABOUT_US_URL##, ##CONTACT_US_URL##, ##FAQ_URL##, ##SITE_CONTACT_PHONE##, ##SITE_CONTACT_EMAIL##', 'Available Variables: ##SITE_NAME##, ##SITE_URL##, ##ABOUT_US_URL##, ##CONTACT_US_URL##, ##FAQ_URL##, ##SITE_CONTACT_PHONE##, ##SITE_CONTACT_EMAIL##', 0, 0, 0),
(273, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Average Votes', 'Average Votes', 0, 0, 0),
(274, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'Awesome!', 'Awesome!', 0, 0, 0),
(275, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Back to', 'Back to', 0, 0, 0),
(276, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Back to Label', 'Back to Label', 0, 0, 0),
(277, '2012-02-21 20:14:46', '2012-02-21 20:14:46', 42, 'Back to Settings', 'Back to Settings', 0, 0, 0),
(278, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Back to Starred', 'Back to Starred', 0, 0, 0),
(279, '2012-02-21 20:14:40', '2012-02-21 20:14:40', 42, 'Back to top', 'Back to top', 0, 0, 0),
(280, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Background Image', 'Background Image', 0, 0, 0),
(281, '2012-02-21 20:14:46', '2012-02-21 20:14:46', 42, 'Balance: ', 'Balance: ', 0, 0, 0),
(282, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, 'Ban Details', 'Ban Details', 0, 0, 0),
(283, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Ban Login IP', 'Ban Login IP', 0, 0, 0),
(284, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Ban Signup IP', 'Ban Signup IP', 0, 0, 0),
(285, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, 'Ban Type', 'Ban Type', 0, 0, 0),
(286, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Banned IP could not be added. Please, try again', 'Banned IP could not be added. Please, try again', 0, 0, 0),
(287, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Banned IP deleted', 'Banned IP deleted', 0, 0, 0),
(288, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Banned IP has been added', 'Banned IP has been added', 0, 0, 0),
(289, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Banned IPs', 'Banned IPs', 0, 0, 0),
(290, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Become a Member', 'Become a Member', 0, 0, 0),
(291, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Body', 'Body', 0, 0, 0),
(292, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'Bonus Amount', 'Bonus Amount', 0, 0, 0),
(293, '2012-02-21 20:14:32', '2012-02-21 20:14:32', 42, 'Bottom code', 'Bottom code', 0, 0, 0),
(294, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Branding Requirements', 'Branding Requirements', 0, 0, 0),
(295, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Business', 'Business', 0, 0, 0),
(296, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'But hey, that is no problem, enter your e-mail address below to get a new download link ', 'But hey, that is no problem, enter your e-mail address below to get a new download link ', 0, 0, 0),
(297, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Buyer', 'Buyer', 0, 0, 0),
(298, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Buyer - ', 'Buyer - ', 0, 0, 0),
(299, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Cache Settings Check', 'Cache Settings Check', 0, 0, 0),
(300, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Cake is able to connect to the database.', 'Cake is able to connect to the database.', 0, 0, 0),
(301, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Cake is NOT able to connect to the database.', 'Cake is NOT able to connect to the database.', 0, 0, 0),
(302, '2012-02-21 20:14:38', '2012-02-21 20:14:38', 42, 'Cancel', 'Cancel', 0, 0, 0),
(303, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Canceled', 'Canceled', 0, 0, 0),
(304, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Canceled and Refunded', 'Canceled and Refunded', 0, 0, 0),
(305, '2012-02-21 20:14:50', '2012-02-21 20:14:50', 42, 'Canceled Date', 'Canceled Date', 0, 0, 0),
(306, '2012-02-21 20:14:43', '2012-02-21 20:14:43', 42, 'Capital', 'Capital', 0, 0, 0),
(307, '2012-02-21 20:14:43', '2012-02-21 20:14:43', 42, 'CAPTCHA image', 'CAPTCHA image', 0, 0, 0),
(308, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Caption', 'Caption', 0, 0, 0),
(309, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Capture', 'Capture', 0, 0, 0),
(310, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Capture Ack', 'Capture Ack', 0, 0, 0),
(311, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Capture Amt', 'Capture Amt', 0, 0, 0),
(312, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Capture Authorizationid', 'Capture Authorizationid', 0, 0, 0),
(313, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Capture Build', 'Capture Build', 0, 0, 0),
(314, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Capture Correlationid', 'Capture Correlationid', 0, 0, 0),
(315, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Capture Currencycode', 'Capture Currencycode', 0, 0, 0),
(316, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Capture Data', 'Capture Data', 0, 0, 0),
(317, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Capture Expectedecheckcleardate', 'Capture Expectedecheckcleardate', 0, 0, 0),
(318, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Capture Feeamt', 'Capture Feeamt', 0, 0, 0),
(319, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Capture Ordertime', 'Capture Ordertime', 0, 0, 0),
(320, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Capture Parenttransactionid', 'Capture Parenttransactionid', 0, 0, 0),
(321, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Capture Paymentstatus', 'Capture Paymentstatus', 0, 0, 0),
(322, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Capture Paymenttype', 'Capture Paymenttype', 0, 0, 0),
(323, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Capture Pendingreason', 'Capture Pendingreason', 0, 0, 0),
(324, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Capture Protectioneligibility', 'Capture Protectioneligibility', 0, 0, 0),
(325, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Capture Reasoncode', 'Capture Reasoncode', 0, 0, 0),
(326, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Capture Shippingmethod', 'Capture Shippingmethod', 0, 0, 0),
(327, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Capture Taxamt', 'Capture Taxamt', 0, 0, 0),
(328, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Capture Timestamp', 'Capture Timestamp', 0, 0, 0),
(329, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Capture Transactionid', 'Capture Transactionid', 0, 0, 0),
(330, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Capture Transactiontype', 'Capture Transactiontype', 0, 0, 0),
(331, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Capture Version', 'Capture Version', 0, 0, 0),
(332, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'Careers', 'Careers', 0, 0, 0),
(333, '2012-02-21 20:14:23', '2012-02-21 20:14:23', 42, 'Cart', 'Cart', 0, 0, 0),
(334, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Cart could not be added. Please, try again.', 'Cart could not be added. Please, try again.', 0, 0, 0),
(335, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Cart(s) updated. But please change your shipping address to proceed checkout. Please try again.', 'Cart(s) updated. But please change your shipping address to proceed checkout. Please try again.', 0, 0, 0),
(336, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'carts', 'carts', 0, 0, 0),
(337, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Categories', 'Categories', 0, 0, 0),
(338, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Category', 'Category', 0, 0, 0),
(339, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Category could not be added. Please, try again.', 'Category could not be added. Please, try again.', 0, 0, 0),
(340, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Category could not be updated. Please, try again.', 'Category could not be updated. Please, try again.', 0, 0, 0),
(341, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Category has been added', 'Category has been added', 0, 0, 0),
(342, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Category has been updated', 'Category has been updated', 0, 0, 0),
(343, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'CDN', 'CDN', 0, 0, 0),
(344, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Change', 'Change', 0, 0, 0),
(345, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'Change Password', 'Change Password', 0, 0, 0),
(346, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Charity Cash Withdrawal Id', 'Charity Cash Withdrawal Id', 0, 0, 0),
(347, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Check out %ss for coolest stuff. ', 'Check out %ss daily deal for coolest stuff in your city. ', 0, 0, 0),
(348, '2012-02-21 20:14:32', '2012-02-21 20:14:32', 42, 'Checked', 'Checked', 0, 0, 0),
(349, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Checked banned IPs has been deleted', 'Checked banned IPs has been deleted', 0, 0, 0),
(350, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Checked countries has been deleted', 'Checked countries has been deleted', 0, 0, 0),
(351, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'Checked messages has been deleted', 'Checked messages has been deleted', 0, 0, 0),
(352, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'Checked messages has been Flagged', 'Checked messages has been Flagged', 0, 0, 0),
(353, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'Checked messages has been Suspended', 'Checked messages has been Suspended', 0, 0, 0),
(354, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'Checked messages has been Unflagged', 'Checked messages has been Unflagged', 0, 0, 0),
(355, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'Checked messages has been Unsuspended', 'Checked messages has been Unsuspended', 0, 0, 0),
(356, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Checked orders are not shipped orders. Please select any other records.', 'Checked orders are not shipped orders. Please select any other records.', 0, 0, 0),
(357, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Checked orders has been marked as completed', 'Checked orders has been marked as completed', 0, 0, 0),
(358, '2012-02-21 20:14:23', '2012-02-21 20:14:23', 42, 'Checked product(s) removed from cart successfully', 'Checked product(s) removed from cart successfully', 0, 0, 0),
(359, '2012-02-21 20:14:15', '2012-02-21 20:14:15', 42, 'Checked records are not shipped orders. Please select any other records.', 'Checked records are not shipped orders. Please select any other records.', 0, 0, 0),
(360, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Checked records has been approved', 'Checked records has been approved', 0, 0, 0),
(361, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Checked records has been Canceled', 'Checked records has been Canceled', 0, 0, 0),
(362, '2012-02-21 20:14:15', '2012-02-21 20:14:15', 42, 'Checked records has been changed to flagged', 'Checked records has been changed to flagged', 0, 0, 0),
(363, '2012-02-21 20:14:15', '2012-02-21 20:14:15', 42, 'Checked records has been changed to Unflagged', 'Checked records has been changed to Unflagged', 0, 0, 0),
(364, '2012-02-21 20:14:15', '2012-02-21 20:14:15', 42, 'Checked records has been changed to Unsuspended', 'Checked records has been changed to Unsuspended', 0, 0, 0),
(365, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Checked records has been deleted', 'Checked records has been deleted', 0, 0, 0),
(366, '2012-02-21 20:14:15', '2012-02-21 20:14:15', 42, 'Checked records has been disabled', 'Checked records has been disabled', 0, 0, 0),
(367, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Checked records has been disapproved', 'Checked records has been disapproved', 0, 0, 0),
(368, '2012-02-21 20:14:15', '2012-02-21 20:14:15', 42, 'Checked records has been enabled', 'Checked records has been enabled', 0, 0, 0),
(369, '2012-02-21 20:14:15', '2012-02-21 20:14:15', 42, 'Checked records has been moved to ', 'Checked records has been moved to ', 0, 0, 0),
(370, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Checked records has been Opened', 'Checked records has been Opened', 0, 0, 0),
(371, '2012-02-21 20:14:15', '2012-02-21 20:14:15', 42, 'Checked records has been Suspended', 'Checked records has been Suspended', 0, 0, 0),
(372, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Checked requests have been moved to pending status', 'Checked requests have been moved to pending status', 0, 0, 0),
(373, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Checked requests have been moved to rejected status, Refunded  Money to Wallet', 'Checked requests have been moved to rejected status, Refunded  Money to Wallet', 0, 0, 0),
(374, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'Checked states has been activated', 'Checked states has been activated', 0, 0, 0),
(375, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'Checked states has been deleted', 'Checked states has been deleted', 0, 0, 0),
(376, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'Checked states has been inactivated', 'Checked states has been inactivated', 0, 0, 0),
(377, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'Checked user OpenIDs has been deleted', 'Checked user OpenIDs has been deleted', 0, 0, 0),
(378, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Checked users has been activated', 'Checked users has been activated', 0, 0, 0),
(379, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Checked users has been deleted', 'Checked users has been deleted', 0, 0, 0),
(380, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Checked users has been inactivated', 'Checked users has been inactivated', 0, 0, 0),
(381, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Checkout process not completed. Please try again.', 'Checkout process not completed. Please try again.', 0, 0, 0),
(382, '2012-02-21 20:14:18', '2012-02-21 20:14:18', 42, 'Cities', 'Cities', 0, 0, 0),
(383, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'City', 'City', 0, 0, 0),
(384, '2012-02-21 20:14:18', '2012-02-21 20:14:18', 42, 'City could not be updated. Please, try again.', 'City could not be updated. Please, try again.', 0, 0, 0),
(385, '2012-02-21 20:14:18', '2012-02-21 20:14:18', 42, 'City deleted', 'City deleted', 0, 0, 0),
(386, '2012-02-21 20:14:18', '2012-02-21 20:14:18', 42, 'City has been updated', 'City has been updated', 0, 0, 0),
(387, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Clear flag', 'Clear flag', 0, 0, 0),
(388, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Cleared', 'Cleared', 0, 0, 0),
(389, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Click Here', 'Click Here', 0, 0, 0),
(390, '2012-02-21 20:14:43', '2012-02-21 20:14:43', 42, 'Click to play', 'Click to play', 0, 0, 0),
(391, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Closed', 'Closed', 0, 0, 0),
(392, '2012-02-21 20:14:41', '2012-02-21 20:14:41', 42, 'Code', 'Code', 0, 0, 0),
(393, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, 'Color', 'Color', 0, 0, 0),
(394, '2012-02-21 20:14:43', '2012-02-21 20:14:43', 42, 'Comment', 'Comment', 0, 0, 0),
(395, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'Commission (%)', 'Commission (%)', 0, 0, 0),
(396, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'Commission from Seller', 'Commission from Seller', 0, 0, 0),
(397, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Commission Settings', 'Commission Settings', 0, 0, 0),
(398, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'Completed', 'Completed', 0, 0, 0),
(399, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'Compose', 'Compose', 0, 0, 0),
(400, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Compose message', 'Compose message', 0, 0, 0),
(401, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Configurations', 'Configurations', 0, 0, 0),
(402, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Confirm Order', 'Confirm Order', 0, 0, 0),
(403, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Confirm Password', 'Confirm Password', 0, 0, 0),
(404, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Connect Now', 'Connect Now', 0, 0, 0),
(405, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'Connect with us', 'Connect with us', 0, 0, 0),
(406, '2012-02-21 20:14:42', '2012-02-21 20:14:42', 42, 'Contact', 'Contact', 0, 0, 0),
(407, '2012-02-21 20:14:18', '2012-02-21 20:14:18', 42, 'Contact Us', 'Contact Us', 0, 0, 0),
(408, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Content', 'Content', 0, 0, 0),
(409, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Continue Editing', 'Continue Editing', 0, 0, 0),
(410, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Continue Shopping', 'Continue Shopping', 0, 0, 0),
(411, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'Converted Currency', 'Converted Currency', 0, 0, 0),
(412, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Cost', 'Cost', 0, 0, 0),
(413, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Count', 'Count', 0, 0, 0),
(414, '2012-02-21 20:14:18', '2012-02-21 20:14:18', 42, 'Countries', 'Countries', 0, 0, 0),
(415, '2012-02-21 20:14:41', '2012-02-21 20:14:41', 42, 'Country', 'Country', 0, 0, 0),
(416, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Country could not be added. Please, try again', 'Country could not be added. Please, try again', 0, 0, 0),
(417, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Country could not be updated. Please, try again.', 'Country could not be updated. Please, try again.', 0, 0, 0),
(418, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Country deleted', 'Country deleted', 0, 0, 0);
INSERT INTO `translations` (`id`, `created`, `modified`, `language_id`, `key`, `lang_text`, `is_translated`, `is_google_translate`, `is_verified`) VALUES
(419, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Country has been added', 'Country has been added', 0, 0, 0),
(420, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Country has been updated', 'Country has been updated', 0, 0, 0),
(421, '2012-02-21 20:14:41', '2012-02-21 20:14:41', 42, 'County', 'County', 0, 0, 0),
(422, '2012-02-21 20:14:32', '2012-02-21 20:14:32', 42, 'Coupon code', 'Coupon code', 0, 0, 0),
(423, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Create Label', 'Create Label', 0, 0, 0),
(424, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Create masspay API from paypal profile. Refer', 'Create masspay API from paypal profile. Refer', 0, 0, 0),
(425, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'Create new label', 'Create new label', 0, 0, 0),
(426, '2012-02-21 20:14:36', '2012-02-21 20:14:36', 42, 'Created', 'Created', 0, 0, 0),
(427, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Created on', 'Created on', 0, 0, 0),
(428, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Credentials', 'Credentials', 0, 0, 0),
(429, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Credit', 'Credit', 0, 0, 0),
(430, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Credit expiry date should be greater than end date', 'Credit expiry date should be greater than end date', 0, 0, 0),
(431, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Credits', 'Credits', 0, 0, 0),
(432, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'CSSlize', 'CSSlize', 0, 0, 0),
(433, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'CSV', 'CSV', 0, 0, 0),
(434, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Currencies', 'Currencies', 0, 0, 0),
(435, '2012-02-21 20:14:43', '2012-02-21 20:14:43', 42, 'Currency', 'Currency', 0, 0, 0),
(436, '2012-02-21 20:14:43', '2012-02-21 20:14:43', 42, 'Currency Code', 'Currency Code', 0, 0, 0),
(437, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Currency Type', 'Currency Type', 0, 0, 0),
(438, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Current time: ', 'Current time: ', 0, 0, 0),
(439, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, 'Current User Information', 'Current User Information', 0, 0, 0),
(440, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Custom', 'Custom', 0, 0, 0),
(441, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'Customer Service', 'Customer Service', 0, 0, 0),
(442, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Customise Force Login', 'Customise Force Login', 0, 0, 0),
(443, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Customise Landing Page', 'Customise Landing Page', 0, 0, 0),
(444, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Customize Force Login ', 'Customize Force Login ', 0, 0, 0),
(445, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Customize Landing Page', 'Customize Landing Page', 0, 0, 0),
(446, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'Dashboard', 'Dashboard', 0, 0, 0),
(447, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Database Check', 'Database Check', 0, 0, 0),
(448, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'Date', 'Date', 0, 0, 0),
(449, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Date Added', 'Date Added', 0, 0, 0),
(450, '2012-02-21 20:14:38', '2012-02-21 20:14:38', 42, 'Date Set', 'Date Set', 0, 0, 0),
(451, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Day(s)', 'Day(s)', 0, 0, 0),
(452, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Deal User', 'Deal User', 0, 0, 0),
(453, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Debit', 'Debit', 0, 0, 0),
(454, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Debug & Error Log', 'Debug & Error Log', 0, 0, 0),
(455, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Debug setting does not allow access to this url.', 'Debug setting does not allow access to this url.', 0, 0, 0),
(456, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Default English variable is missing', 'Default English variable is missing', 0, 0, 0),
(457, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'Delete', 'Delete', 0, 0, 0),
(458, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Delete Translation', 'Delete Translation', 0, 0, 0),
(459, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Delete?', 'Delete?', 0, 0, 0),
(460, '2012-02-21 20:14:40', '2012-02-21 20:14:40', 42, 'Demographics', 'Demographics', 0, 0, 0),
(461, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Description', 'Description', 0, 0, 0),
(462, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Developments', 'Developments', 0, 0, 0),
(463, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Diagnostics', 'Diagnostics', 0, 0, 0),
(464, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Diagnostics are for developer purpose only.', 'Diagnostics are for developer purpose only.', 0, 0, 0),
(465, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Disappear product from user side', 'Disappear product from user side', 0, 0, 0),
(466, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Disapprove', 'Disapprove', 0, 0, 0),
(467, '2012-02-21 20:14:42', '2012-02-21 20:14:42', 42, 'Disapproved', 'Disapproved', 0, 0, 0),
(468, '2012-02-21 20:14:42', '2012-02-21 20:14:42', 42, 'Disapproved Records: : %s', 'Disapproved Records: : %s', 0, 0, 0),
(469, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Disapproved Records: %s', 'Disapproved Records: %s', 0, 0, 0),
(470, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'Discard', 'Discard', 0, 0, 0),
(471, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Discount', 'Discount', 0, 0, 0),
(472, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Discount (%)', 'Discount (%)', 0, 0, 0),
(473, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Discount Amount', 'Discount Amount', 0, 0, 0),
(474, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Discount amouont should be less than original amount.', 'Discount amouont should be less than original amount.', 0, 0, 0),
(475, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Discount Percentage', 'Discount Percentage', 0, 0, 0),
(476, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Discounted Price', 'Discounted Price', 0, 0, 0),
(477, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Discounted Price for User', 'Discounted Price for User', 0, 0, 0),
(478, '2012-02-21 20:14:36', '2012-02-21 20:14:36', 42, 'Display Name', 'Display Name', 0, 0, 0),
(479, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Display name is the name displayed in the payment options for user.', 'Display name is the name displayed in the payment options for user.', 0, 0, 0),
(480, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'display_name', 'display_name', 0, 0, 0),
(481, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Dispprove', 'Dispprove', 0, 0, 0),
(482, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'DOB', 'DOB', 0, 0, 0),
(483, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Download', 'Download', 0, 0, 0),
(484, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'download failure. Please try once again.', 'download failure. Please try once again.', 0, 0, 0),
(485, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Downloadable', 'Downloadable', 0, 0, 0),
(486, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'Downloaded Time', 'Downloaded Time', 0, 0, 0),
(487, '2012-02-21 20:14:40', '2012-02-21 20:14:40', 42, 'Downloads', 'Downloads', 0, 0, 0),
(488, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Draft', 'Draft', 0, 0, 0),
(489, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Drafts', 'Drafts', 0, 0, 0),
(490, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'E-mail address:', 'E-mail address:', 0, 0, 0),
(491, '2012-02-21 20:14:35', '2012-02-21 20:14:35', 42, 'Edit', 'Edit', 0, 0, 0),
(492, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Edit Attribute', 'Edit Attribute', 0, 0, 0),
(493, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Edit Attribute Group', 'Edit Attribute Group', 0, 0, 0),
(494, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Edit Attribute Group Type', 'Edit Attribute Group Type', 0, 0, 0),
(495, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Edit Category', 'Edit Category', 0, 0, 0),
(496, '2012-02-21 20:14:18', '2012-02-21 20:14:18', 42, 'Edit City', 'Edit City', 0, 0, 0),
(497, '2012-02-21 20:14:42', '2012-02-21 20:14:42', 42, 'Edit City - ', 'Edit City - ', 0, 0, 0),
(498, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Edit Country', 'Edit Country', 0, 0, 0),
(499, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Edit Email Template', 'Edit Email Template', 0, 0, 0),
(500, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'Edit Label', 'Edit Label', 0, 0, 0),
(501, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Edit Labels User', 'Edit Labels User', 0, 0, 0),
(502, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Edit Language', 'Edit Language', 0, 0, 0),
(503, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'Edit Message', 'Edit Message', 0, 0, 0),
(504, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'Edit Order Status', 'Edit Order Status', 0, 0, 0),
(505, '2012-02-21 20:14:23', '2012-02-21 20:14:23', 42, 'Edit Page', 'Edit Page', 0, 0, 0),
(506, '2012-02-21 20:14:23', '2012-02-21 20:14:23', 42, 'Edit Payment Gateway', 'Edit Payment Gateway', 0, 0, 0),
(507, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Edit PayPal account', 'Edit PayPal account', 0, 0, 0),
(508, '2012-02-21 20:14:25', '2012-02-21 20:14:25', 42, 'Edit Product', 'Edit Product', 0, 0, 0),
(509, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Edit Product Attribute', 'Edit Product Attribute', 0, 0, 0),
(510, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Edit Product Status', 'Edit Product Status', 0, 0, 0),
(511, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'Edit Profile', 'Edit Profile', 0, 0, 0),
(512, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Edit Profile - %s', 'Edit Profile - %s', 0, 0, 0),
(513, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Edit Shipping Address', 'Edit Shipping Address', 0, 0, 0),
(514, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'Edit State', 'Edit State', 0, 0, 0),
(515, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'Edit Transaction Type', 'Edit Transaction Type', 0, 0, 0),
(516, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Edit Translation', 'Edit Translation', 0, 0, 0),
(517, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Edit Translations', 'Edit Translations', 0, 0, 0),
(518, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Edit User Address', 'Edit User Address', 0, 0, 0),
(519, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Edit Withdraw Fund Request', 'Edit Withdraw Fund Request', 0, 0, 0),
(520, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Email', 'Email', 0, 0, 0),
(521, '2012-02-21 20:14:32', '2012-02-21 20:14:32', 42, 'Email address is already exist', 'Email address is already exist', 0, 0, 0),
(522, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Email Confirmed', 'Email Confirmed', 0, 0, 0),
(523, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Email sent successfully', 'Email sent successfully', 0, 0, 0),
(524, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Email sent successfully. Some emails are not sent', 'Email sent successfully. Some emails are not sent', 0, 0, 0),
(525, '2012-02-21 20:14:46', '2012-02-21 20:14:46', 42, 'Email settings', 'Email settings', 0, 0, 0),
(526, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Email Template could not be updated. Please, try again.', 'Email Template could not be updated. Please, try again.', 0, 0, 0),
(527, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Email Template has been updated', 'Email Template has been updated', 0, 0, 0),
(528, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Email Templates', 'Email Templates', 0, 0, 0),
(529, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Enable for Add to Wallet', 'Enable for Add to Wallet', 0, 0, 0),
(530, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Enable for Mass Pay', 'Enable for Mass Pay', 0, 0, 0),
(531, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Enable for Purchase', 'Enable for Purchase', 0, 0, 0),
(532, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Enable for Wallet', 'Enable for Wallet', 0, 0, 0),
(533, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'End', 'End', 0, 0, 0),
(534, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'End date should be greater than start date', 'End date should be greater than start date', 0, 0, 0),
(535, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'End on: ', 'End on: ', 0, 0, 0),
(536, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'ending on', 'ending on', 0, 0, 0),
(537, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Ending Soon', 'Ending Soon', 0, 0, 0),
(538, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'English', 'English', 0, 0, 0),
(539, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Enter a new password', 'Enter a new password', 0, 0, 0),
(540, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Enter number higher than 0', 'Enter number higher than 0', 0, 0, 0),
(541, '2012-02-21 20:14:33', '2012-02-21 20:14:33', 42, 'Enter valid OpenID', 'Enter valid OpenID', 0, 0, 0),
(542, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'Enter verified PayPal email and the name associated with it', 'Enter verified PayPal email and the name associated with it', 0, 0, 0),
(543, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Enter your Email, and we will send you instructions for resetting your password.', 'Enter your Email, and we will send you instructions for resetting your password.', 0, 0, 0),
(544, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Error Message', 'Error Message', 0, 0, 0),
(545, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Error No', 'Error No', 0, 0, 0),
(546, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Expired', 'Expired', 0, 0, 0),
(547, '2012-02-21 20:14:38', '2012-02-21 20:14:38', 42, 'Expiry Date', 'Expiry Date', 0, 0, 0),
(548, '2012-02-21 20:14:32', '2012-02-21 20:14:32', 42, 'Export', 'Export', 0, 0, 0),
(549, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Facebook', 'Facebook', 0, 0, 0),
(550, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'Facebook credentials could not be updated. Please, try again.', 'Facebook credentials could not be updated. Please, try again.', 0, 0, 0),
(551, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'Facebook credentials updated', 'Facebook credentials updated', 0, 0, 0),
(552, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Facebook Users', 'Facebook Users', 0, 0, 0),
(553, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Facebook Users: %s', 'Facebook Users: %s', 0, 0, 0),
(554, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Failed', 'Failed', 0, 0, 0),
(555, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'FAQ', 'FAQ', 0, 0, 0),
(556, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Fees', 'Fees', 0, 0, 0),
(557, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Fees Paid By', 'Fees Paid By', 0, 0, 0),
(558, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Female', 'Female', 0, 0, 0),
(559, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'File Download', 'File Download', 0, 0, 0),
(560, '2012-02-21 20:14:43', '2012-02-21 20:14:43', 42, 'Filter', 'Filter', 0, 0, 0),
(561, '2012-02-21 20:14:43', '2012-02-21 20:14:43', 42, 'Fips104', 'Fips104', 0, 0, 0),
(562, '2012-02-21 20:14:42', '2012-02-21 20:14:42', 42, 'First Name', 'First Name', 0, 0, 0),
(563, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Flag', 'Flag', 0, 0, 0),
(564, '2012-02-21 20:14:18', '2012-02-21 20:14:18', 42, 'Flagged', 'Flagged', 0, 0, 0),
(565, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'Follow Us', 'Follow Us', 0, 0, 0),
(566, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Force login background image uploaded.', 'Force login background image uploaded.', 0, 0, 0),
(567, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'Forgot Password', 'Forgot Password', 0, 0, 0),
(568, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Forgot your password?', 'Forgot your password?', 0, 0, 0),
(569, '2012-02-21 20:14:50', '2012-02-21 20:14:50', 42, 'Friend Email', 'Friend Email', 0, 0, 0),
(570, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'From', 'From', 0, 0, 0),
(571, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'From date should greater than To date. Please, try again.', 'From date should greater than To date. Please, try again.', 0, 0, 0),
(572, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'From date should less than To date. Please, try again.', 'From date should less than To date. Please, try again.', 0, 0, 0),
(573, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Full Name', 'Full Name', 0, 0, 0),
(574, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Fwd:', 'Fwd:', 0, 0, 0),
(575, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Gateway Fees', 'Gateway Fees', 0, 0, 0),
(576, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Gender', 'Gender', 0, 0, 0),
(577, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'General', 'General', 0, 0, 0),
(578, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'General Email Notification Settings', 'General Email Notification Settings', 0, 0, 0),
(579, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'General Settings', 'General Settings', 0, 0, 0),
(580, '2012-02-21 20:14:22', '2012-02-21 20:14:22', 42, 'Generate Address Label', 'Generate Address Label', 0, 0, 0),
(581, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Get %s in %s Bucks when someone you invite gets their first %s. There is no limit on how much you can earn!', 'Get %s in %s Bucks when someone you invite gets their first %s. There is no limit on how much you can earn!', 0, 0, 0),
(582, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Gift', 'Gift', 0, 0, 0),
(583, '2012-02-21 20:14:50', '2012-02-21 20:14:50', 42, 'Gift Note', 'Gift Note', 0, 0, 0),
(584, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Gift Wrap', 'Gift Wrap', 0, 0, 0),
(585, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Gift Wrap Fee', 'Gift Wrap Fee', 0, 0, 0),
(586, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Gift Wrap Fee:', 'Gift Wrap Fee:', 0, 0, 0),
(587, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Gift Wrap Note', 'Gift Wrap Note', 0, 0, 0),
(588, '2012-02-21 20:14:50', '2012-02-21 20:14:50', 42, 'Gift Wrap?', 'Gift Wrap?', 0, 0, 0),
(589, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Give numeric format', 'Give numeric format', 0, 0, 0),
(590, '2012-02-21 20:14:33', '2012-02-21 20:14:33', 42, 'Given amount is greater than wallet amount', 'Given amount is greater than wallet amount', 0, 0, 0),
(591, '2012-02-21 20:14:33', '2012-02-21 20:14:33', 42, 'Given amount should lies from  %s%s to %s%s', 'Given amount should lies from  %s%s to %s%s', 0, 0, 0),
(592, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Gmail', 'Gmail', 0, 0, 0),
(593, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Gmail Users', 'Gmail Users', 0, 0, 0),
(594, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Gmail Users: %s', 'Gmail Users: %s', 0, 0, 0),
(595, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Google Translate: It will automatically translate site labels into selected language with Google', 'Google Translate: It will automatically translate site labels into selected language with Google', 0, 0, 0),
(596, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Grand Total', 'Grand Total', 0, 0, 0),
(597, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Grand total:', 'Grand total:', 0, 0, 0),
(598, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, 'Group Type', 'Group Type', 0, 0, 0),
(599, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'Guest', 'Guest', 0, 0, 0),
(600, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'has been listed.', 'has been listed.', 0, 0, 0),
(601, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'has been listed. But unable to post it on facebook.', 'has been listed. But unable to post it on facebook.', 0, 0, 0),
(602, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Here you can update and modify affiliate types', 'Here you can update and modify affiliate types', 0, 0, 0),
(603, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Here you can update Facebook credentials . Click ''Update Facebook Credentials'' link below and Follow the steps. Please make sure that you have updated the API Key and Secret before you click this link.', 'Here you can update Facebook credentials . Click ''Update Facebook Credentials'' link below and Follow the steps. Please make sure that you have updated the API Key and Secret before you click this link.', 0, 0, 0),
(604, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Here you can update Facebook credentials . Click this link and Follow the steps. Please make sure that you have updated the API Key and Secret before you click this link.', 'Here you can update Facebook credentials . Click this link and Follow the steps. Please make sure that you have updated the API Key and Secret before you click this link.', 0, 0, 0),
(605, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Here you can update Foursquare credentials . Click  ''Update Foursquare Credentials'' link below and Follow the steps. Please make sure that you have updated the API Key and Secret before you click this link.', 'Here you can update Foursquare credentials . Click  ''Update Foursquare Credentials'' link below and Follow the steps. Please make sure that you have updated the API Key and Secret before you click this link.', 0, 0, 0),
(606, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Here you can update Twitter credentials like Access key and Accss Token. Click ''Update Twitter Credentials'' link below and Follow the steps. Please make sure that you have updated the Consumer Key and  Consumer secret before you click this link.', 'Here you can update Twitter credentials like Access key and Accss Token. Click ''Update Twitter Credentials'' link below and Follow the steps. Please make sure that you have updated the Consumer Key and  Consumer secret before you click this link.', 0, 0, 0),
(607, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Here you can update Twitter credentials like Access key and Accss Token. Click this link and Follow the steps. Please make sure that you have updated the Consumer Key and  Consumer secret before you click this link.', 'Here you can update Twitter credentials like Access key and Accss Token. Click this link and Follow the steps. Please make sure that you have updated the Consumer Key and  Consumer secret before you click this link.', 0, 0, 0),
(608, '2012-02-21 20:14:46', '2012-02-21 20:14:46', 42, 'Hi, ', 'Hi, ', 0, 0, 0),
(609, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'Hide search options', 'Hide search options', 0, 0, 0),
(610, '2012-02-21 20:14:38', '2012-02-21 20:14:38', 42, 'Hints and tips:', 'Hints and tips:', 0, 0, 0),
(611, '2012-02-21 20:14:23', '2012-02-21 20:14:23', 42, 'Home', 'Home', 0, 0, 0),
(612, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'How do I participate?', 'How do I participate?', 0, 0, 0),
(613, '2012-02-21 20:14:38', '2012-02-21 20:14:38', 42, 'How long', 'How long', 0, 0, 0),
(614, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'hrs', 'hrs', 0, 0, 0),
(615, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'I have read, understood & agree to the %s', 'I have read, understood & agree to the %s', 0, 0, 0),
(616, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'I think you should shop in ', 'I think you should shop in ', 0, 0, 0),
(617, '2012-02-21 20:14:36', '2012-02-21 20:14:36', 42, 'Id', 'Id', 0, 0, 0),
(618, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'If someone joins %s within %s hours after clicking your link, we will notify you within %s hours of their first purchase and automatically add %s %s Bucks to your account. You can refer as many people as you like. Check your balance by clicking Menu > My Transactions.', 'If someone joins %s within %s hours after clicking your link, we will notify you within %s hours of their first purchase and automatically add %s %s Bucks to your account. You can refer as many people as you like. Check your balance by clicking Menu > My Transactions.', 0, 0, 0),
(619, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'If you change the variant group or uncheck the product variant, then existing variant combination for the product will be deleted.', 'If you change the variant group or uncheck the product variant, then existing variant combination for the product will be deleted.', 0, 0, 0),
(620, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'If you translated with Google Translate, it may not be perfect translation and it may have mistakes. So you need to manually check all translated texts. The translation stats will give summary of verified/unverified translated text.', 'If you translated with Google Translate, it may not be perfect translation and it may have mistakes. So you need to manually check all translated texts. The translation stats will give summary of verified/unverified translated text.', 0, 0, 0),
(621, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'If your browser doesn''t redirect you please %s to continue.', 'If your browser doesn''t redirect you please %s to continue.', 0, 0, 0),
(622, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Image', 'Image', 0, 0, 0),
(623, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Image not uploaded. Please try again ', 'Image not uploaded. Please try again ', 0, 0, 0),
(624, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'In Process', 'In Process', 0, 0, 0),
(625, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Inactive', 'Inactive', 0, 0, 0),
(626, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Inactive Products', 'Inactive Products', 0, 0, 0),
(627, '2012-02-21 20:14:32', '2012-02-21 20:14:32', 42, 'Inactive Users', 'Inactive Users', 0, 0, 0),
(628, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Inactive Users: %s', 'Inactive Users: %s', 0, 0, 0),
(629, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'Inactive: ', 'Inactive: ', 0, 0, 0),
(630, '2012-02-21 20:14:46', '2012-02-21 20:14:46', 42, 'Inbox', 'Inbox', 0, 0, 0),
(631, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Install', 'Install', 0, 0, 0),
(632, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Instant access to todays top designer labels, at up to 60% off retail.', 'Instant access to todays top designer labels, at up to 60% off retail.', 0, 0, 0),
(633, '2012-02-21 20:14:43', '2012-02-21 20:14:43', 42, 'Internet', 'Internet', 0, 0, 0),
(634, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'Invalid activation request', 'Invalid activation request', 0, 0, 0),
(635, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'Invalid activation request, please register again', 'Invalid activation request, please register again', 0, 0, 0),
(636, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Invalid attribute', 'Invalid attribute', 0, 0, 0),
(637, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Invalid attribute group', 'Invalid attribute group', 0, 0, 0),
(638, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Invalid attribute group type', 'Invalid attribute group type', 0, 0, 0),
(639, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'Invalid change password request', 'Invalid change password request', 0, 0, 0),
(640, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Invalid Facebook Connection.', 'Invalid Facebook Connection.', 0, 0, 0),
(641, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'Invalid invoice', 'Invalid invoice', 0, 0, 0),
(642, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'Invalid OpenID', 'Invalid OpenID', 0, 0, 0),
(643, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'Invalid OpenID entered. Please enter valid OpenID', 'Invalid OpenID entered. Please enter valid OpenID', 0, 0, 0),
(644, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'Invalid order status', 'Invalid order status', 0, 0, 0),
(645, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Invalid product attribute', 'Invalid product attribute', 0, 0, 0),
(646, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Invalid product download', 'Invalid product download', 0, 0, 0),
(647, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Invalid product status', 'Invalid product status', 0, 0, 0),
(648, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Invalid product view', 'Invalid product view', 0, 0, 0),
(649, '2012-02-21 20:14:14', '2012-02-21 20:14:14', 42, 'Invalid request', 'Invalid request', 0, 0, 0),
(650, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'Invalid resend activation request, please register again', 'Invalid resend activation request, please register again', 0, 0, 0),
(651, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Invalid user address', 'Invalid user address', 0, 0, 0),
(652, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'Invoice - #', 'Invoice - #', 0, 0, 0),
(653, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Invoice Details', 'Invoice Details', 0, 0, 0),
(654, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Ip', 'Ip', 0, 0, 0),
(655, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'IP Range', 'IP Range', 0, 0, 0),
(656, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Is Authorization', 'Is Authorization', 0, 0, 0),
(657, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'Is Increase', 'Is Increase', 0, 0, 0),
(658, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Is Mass Pay', 'Is Mass Pay', 0, 0, 0),
(659, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Is Product Variant?', 'Is Product Variant?', 0, 0, 0),
(660, '2012-02-21 20:14:43', '2012-02-21 20:14:43', 42, 'Iso2', 'Iso2', 0, 0, 0),
(661, '2012-02-21 20:14:43', '2012-02-21 20:14:43', 42, 'Iso3', 'Iso3', 0, 0, 0),
(662, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Ison', 'Ison', 0, 0, 0),
(663, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'It is seems that you have used this download link already. Our download links only work one time for safety reasons.', 'It is seems that you have used this download link already. Our download links only work one time for safety reasons.', 0, 0, 0),
(664, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Item total:', 'Item total:', 0, 0, 0),
(665, '2012-02-21 20:14:46', '2012-02-21 20:14:46', 42, 'Join Us', 'Join Us', 0, 0, 0),
(666, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Key', 'Key', 0, 0, 0),
(667, '2012-02-21 20:14:42', '2012-02-21 20:14:42', 42, 'Keyword', 'Keyword', 0, 0, 0),
(668, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Label deleted', 'Label deleted', 0, 0, 0),
(669, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Labels', 'Labels', 0, 0, 0),
(670, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Labels already exist.', 'Labels already exist.', 0, 0, 0),
(671, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Labels User deleted', 'Labels User deleted', 0, 0, 0),
(672, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Labels Users', 'Labels Users', 0, 0, 0),
(673, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Landing Page photos has been updated', 'Landing Page photos has been updated', 0, 0, 0),
(674, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Language', 'Language', 0, 0, 0),
(675, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Language  could not be updated. Please, try again.', 'Language  could not be updated. Please, try again.', 0, 0, 0),
(676, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Language  has been updated', 'Language  has been updated', 0, 0, 0),
(677, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Language could not be added. Please, try again.', 'Language could not be added. Please, try again.', 0, 0, 0),
(678, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Language has been added', 'Language has been added', 0, 0, 0),
(679, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Language has neen deleted', 'Language has neen deleted', 0, 0, 0),
(680, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Language variables could not be added', 'Language variables could not be added', 0, 0, 0),
(681, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Language variables has been added', 'Language variables has been added', 0, 0, 0),
(682, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Languages', 'Languages', 0, 0, 0),
(683, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Last 3 months', 'Last 3 months', 0, 0, 0),
(684, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Last 3 years', 'Last 3 years', 0, 0, 0),
(685, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Last 4 weeks', 'Last 4 weeks', 0, 0, 0),
(686, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Last 7 days', 'Last 7 days', 0, 0, 0),
(687, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Last login: ', 'Last login: ', 0, 0, 0),
(688, '2012-02-21 20:14:42', '2012-02-21 20:14:42', 42, 'Last Name', 'Last Name', 0, 0, 0),
(689, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Latest', 'Latest', 0, 0, 0),
(690, '2012-02-21 20:14:41', '2012-02-21 20:14:41', 42, 'Latitude', 'Latitude', 0, 0, 0),
(691, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'Leave blank for no limit.', 'Leave blank for no limit.', 0, 0, 0),
(692, '2012-02-21 20:14:38', '2012-02-21 20:14:38', 42, 'Leave field empty when using permanent. Fill in a number higher than 0 when using another option!', 'Leave field empty when using permanent. Fill in a number higher than 0 when using another option!', 0, 0, 0),
(693, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'listed a new product \\"', 'listed a new product \\"', 0, 0, 0),
(694, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Live Mode', 'Live Mode', 0, 0, 0),
(695, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Live Mode?', 'Live Mode?', 0, 0, 0),
(696, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'Login', 'Login', 0, 0, 0),
(697, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Login count', 'Login count', 0, 0, 0),
(698, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Login IP', 'Login IP', 0, 0, 0),
(699, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Login Time', 'Login Time', 0, 0, 0),
(700, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Login via OpenID', 'Login via OpenID', 0, 0, 0),
(701, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Logins', 'Logins', 0, 0, 0),
(702, '2012-02-21 20:14:46', '2012-02-21 20:14:46', 42, 'Logout', 'Logout', 0, 0, 0),
(703, '2012-02-21 20:14:41', '2012-02-21 20:14:41', 42, 'Longitude', 'Longitude', 0, 0, 0),
(704, '2012-02-21 20:14:18', '2012-02-21 20:14:18', 42, 'Lost', 'Lost', 0, 0, 0),
(705, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Luxury brands. Hand-selected styles. Members-only prices.', 'Luxury brands. Hand-selected styles. Members-only prices.', 0, 0, 0),
(706, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Mail', 'Mail', 0, 0, 0),
(707, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Mail could not be sent. Please, try again', 'Mail could not be sent. Please, try again', 0, 0, 0),
(708, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Mail it', 'Mail it', 0, 0, 0),
(709, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Make New Translation', 'Make New Translation', 0, 0, 0),
(710, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Male', 'Male', 0, 0, 0),
(711, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Manage', 'Manage', 0, 0, 0),
(712, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'Manage Email Settings', 'Manage Email Settings', 0, 0, 0),
(713, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'Manage labels', 'Manage labels', 0, 0, 0),
(714, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'Manage Orders', 'Manage Orders', 0, 0, 0),
(715, '2012-02-21 20:14:23', '2012-02-21 20:14:23', 42, 'Manage Static Pages', 'Manage Static Pages', 0, 0, 0),
(716, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Manage your OpenIDs', 'Manage your OpenIDs', 0, 0, 0),
(717, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Manual Translate: It will only populate site labels for selected new language. You need to manually enter all the equivalent translated label', 'Manual Translate: It will only populate site labels for selected new language. You need to manually enter all the equivalent translated label', 0, 0, 0),
(718, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Manually trigger cron to update cart status', 'Manually trigger cron to update cart status', 0, 0, 0),
(719, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Manually trigger cron to update daily status', 'Manually trigger cron to update daily status', 0, 0, 0),
(720, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Map Reference', 'Map Reference', 0, 0, 0),
(721, '2012-02-21 20:14:43', '2012-02-21 20:14:43', 42, 'Map Rreference', 'Map Rreference', 0, 0, 0),
(722, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Mark as read', 'Mark as read', 0, 0, 0),
(723, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Mark as unread', 'Mark as unread', 0, 0, 0),
(724, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Mass Pay', 'Mass Pay', 0, 0, 0),
(725, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Mass Pay Status', 'Mass Pay Status', 0, 0, 0),
(726, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Mass Payment Details', 'Mass Payment Details', 0, 0, 0),
(727, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Mass payment request is submitted in Paypal. User will be paid once process completed.', 'Mass payment request is submitted in Paypal. User will be paid once process completed.', 0, 0, 0),
(728, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Mass Paypal Transaction Logs', 'Mass Paypal Transaction Logs', 0, 0, 0),
(729, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Masspay Response', 'Masspay Response', 0, 0, 0),
(730, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Masspay used to send money to user.', 'Masspay used to send money to user.', 0, 0, 0),
(731, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Master', 'Master', 0, 0, 0),
(732, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'Maximum quantity can buy product as gift', 'Maximum quantity can buy product as gift', 0, 0, 0),
(733, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'Maximum quantity can buy product as own', 'Maximum quantity can buy product as own', 0, 0, 0),
(734, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Mc Currency', 'Mc Currency', 0, 0, 0),
(735, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Mc Fee', 'Mc Fee', 0, 0, 0),
(736, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Mc Gross', 'Mc Gross', 0, 0, 0),
(737, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'me', 'me', 0, 0, 0),
(738, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Me   : ', 'Me   : ', 0, 0, 0),
(739, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Member Sign In', 'Member Sign In', 0, 0, 0),
(740, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Member Since', 'Member Since', 0, 0, 0),
(741, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Membership is free, get inspired today!', 'Membership is free, get inspired today!', 0, 0, 0),
(742, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Memo', 'Memo', 0, 0, 0),
(743, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Message', 'Message', 0, 0, 0),
(744, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Message deleted', 'Message deleted', 0, 0, 0),
(745, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'Message has been flagged', 'Message has been flagged', 0, 0, 0),
(746, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Message has been saved successfully', 'Message has been saved successfully', 0, 0, 0),
(747, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Message has been sent successfully', 'Message has been sent successfully', 0, 0, 0),
(748, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'Message has been suspend', 'Message has been suspend', 0, 0, 0),
(749, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'Message has been Unflagged', 'Message has been Unflagged', 0, 0, 0),
(750, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'Message has been unsuspend', 'Message has been unsuspend', 0, 0, 0),
(751, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'message limit', 'message limit', 0, 0, 0),
(752, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Message Page Size', 'Message Page Size', 0, 0, 0),
(753, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Message saved successfully', 'Message saved successfully', 0, 0, 0),
(754, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Message send is temporarily stopped. Please try again later.', 'Message send is temporarily stopped. Please try again later.', 0, 0, 0),
(755, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Message Settings', 'Message Settings', 0, 0, 0),
(756, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Message Settings could not be updated', 'Message Settings could not be updated', 0, 0, 0),
(757, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Message Settings has been updated', 'Message Settings has been updated', 0, 0, 0),
(758, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Message Signature', 'Message Signature', 0, 0, 0),
(759, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Messages', 'Messages', 0, 0, 0),
(760, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Messages - %s', 'Messages - %s', 0, 0, 0),
(761, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Messages - All', 'Messages - All', 0, 0, 0),
(762, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Messages - Compose', 'Messages - Compose', 0, 0, 0),
(763, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Messages - Drafts', 'Messages - Drafts', 0, 0, 0),
(764, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Messages - Inbox', 'Messages - Inbox', 0, 0, 0),
(765, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Messages - Sent Mail', 'Messages - Sent Mail', 0, 0, 0),
(766, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Messages - Spam', 'Messages - Spam', 0, 0, 0),
(767, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Messages - Starred', 'Messages - Starred', 0, 0, 0),
(768, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Messages - Trash', 'Messages - Trash', 0, 0, 0),
(769, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'messages available', 'messages available', 0, 0, 0),
(770, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Meta', 'Meta', 0, 0, 0),
(771, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Middle Name', 'Middle Name', 0, 0, 0),
(772, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Minimum withdraw amount: %s <br/> Maximum withdraw amount: %s', 'Minimum withdraw amount: %s <br/> Maximum withdraw amount: %s', 0, 0, 0),
(773, '2012-02-21 20:14:36', '2012-02-21 20:14:36', 42, 'Modified', 'Modified', 0, 0, 0),
(774, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Module Manager', 'Module Manager', 0, 0, 0),
(775, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Move to open', 'Move to open', 0, 0, 0),
(776, '2012-02-21 20:14:32', '2012-02-21 20:14:32', 42, 'Must be a valid character', 'Must be a valid character', 0, 0, 0),
(777, '2012-02-21 20:14:33', '2012-02-21 20:14:33', 42, 'Must be a valid date', 'Must be a valid date', 0, 0, 0),
(778, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Must be a valid email', 'Must be a valid email', 0, 0, 0),
(779, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Must be a valid URL', 'Must be a valid URL', 0, 0, 0),
(780, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Must be a valid URL, starting with http://', 'Must be a valid URL, starting with http://', 0, 0, 0),
(781, '2012-02-21 20:14:32', '2012-02-21 20:14:32', 42, 'Must be at least 6 characters', 'Must be at least 6 characters', 0, 0, 0),
(782, '2012-02-21 20:14:32', '2012-02-21 20:14:32', 42, 'Must be between of 0 to 100', 'Must be between of 0 to 100', 0, 0, 0),
(783, '2012-02-21 20:14:32', '2012-02-21 20:14:32', 42, 'Must be between of 4 to 30 characters', 'Must be between of 4 to 30 characters', 0, 0, 0),
(784, '2012-02-21 20:14:33', '2012-02-21 20:14:33', 42, 'Must be greater than zero', 'Must be greater than zero', 0, 0, 0),
(785, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Must be in numeric', 'Must be in numeric', 0, 0, 0),
(786, '2012-02-21 20:14:32', '2012-02-21 20:14:32', 42, 'Must be start with an alphabets', 'Must be start with an alphabets', 0, 0, 0),
(787, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Must start with an alphabet. <br/> Must be minimum of 3 characters and <br/> Maximum of 20 characters <br/> No special characters and spaces allowed', 'Must start with an alphabet. <br/> Must be minimum of 3 characters and <br/> Maximum of 20 characters <br/> No special characters and spaces allowed', 0, 0, 0),
(788, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'My', 'My', 0, 0, 0),
(789, '2012-02-21 20:14:46', '2012-02-21 20:14:46', 42, 'My Account', 'My Account', 0, 0, 0),
(790, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'My Purchases', 'My Purchases', 0, 0, 0),
(791, '2012-02-21 20:14:46', '2012-02-21 20:14:46', 42, 'My Shipping Address', 'My Shipping Address', 0, 0, 0),
(792, '2012-02-21 20:14:46', '2012-02-21 20:14:46', 42, 'My Stuff', 'My Stuff', 0, 0, 0),
(793, '2012-02-21 20:14:46', '2012-02-21 20:14:46', 42, 'My Transactions', 'My Transactions', 0, 0, 0),
(794, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'N/A', 'N/A', 0, 0, 0),
(795, '2012-02-21 20:14:36', '2012-02-21 20:14:36', 42, 'Name', 'Name', 0, 0, 0),
(796, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Name: ', 'Name: ', 0, 0, 0),
(797, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Nationality', 'Nationality', 0, 0, 0),
(798, '2012-02-21 20:14:43', '2012-02-21 20:14:43', 42, 'Nationality Plural', 'Nationality Plural', 0, 0, 0),
(799, '2012-02-21 20:14:43', '2012-02-21 20:14:43', 42, 'Nationality Singular', 'Nationality Singular', 0, 0, 0),
(800, '2012-02-21 20:14:39', '2012-02-21 20:14:39', 42, 'Never', 'Never', 0, 0, 0),
(801, '2012-02-21 20:14:32', '2012-02-21 20:14:32', 42, 'New and confirm password field must match, please try again', 'New and confirm password field must match, please try again', 0, 0, 0),
(802, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'New User', 'New User', 0, 0, 0),
(803, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'Next', 'Next', 0, 0, 0),
(804, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'No', 'No', 0, 0, 0),
(805, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'No address available', 'No address available', 0, 0, 0),
(806, '2012-02-21 20:14:35', '2012-02-21 20:14:35', 42, 'No Attribute Group Types available', 'No Attribute Group Types available', 0, 0, 0),
(807, '2012-02-21 20:14:36', '2012-02-21 20:14:36', 42, 'No Attribute Groups available', 'No Attribute Groups available', 0, 0, 0),
(808, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, 'No Attributes available', 'No Attributes available', 0, 0, 0),
(809, '2012-02-21 20:14:39', '2012-02-21 20:14:39', 42, 'No Banned IPs available', 'No Banned IPs available', 0, 0, 0),
(810, '2012-02-21 20:14:40', '2012-02-21 20:14:40', 42, 'No Carts available', 'No Carts available', 0, 0, 0),
(811, '2012-02-21 20:14:42', '2012-02-21 20:14:42', 42, 'No cities available', 'No cities available', 0, 0, 0),
(812, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'No countries available', 'No countries available', 0, 0, 0),
(813, '2012-02-21 20:14:14', '2012-02-21 20:14:14', 42, 'No Date Set', 'No Date Set', 0, 0, 0),
(814, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'No e-mail templates added yet.', 'No e-mail templates added yet.', 0, 0, 0),
(815, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'No email send', 'No email send', 0, 0, 0),
(816, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'No labels added yet.', 'No labels added yet.', 0, 0, 0),
(817, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'No Labels available', 'No Labels available', 0, 0, 0),
(818, '2012-02-21 20:14:46', '2012-02-21 20:14:46', 42, 'No Languages available', 'No Languages available', 0, 0, 0),
(819, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'No longer available', 'No longer available', 0, 0, 0),
(820, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'No messages available', 'No messages available', 0, 0, 0),
(821, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'No messages matched your search.', 'No messages matched your search.', 0, 0, 0),
(822, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'No OpenIDs available', 'No OpenIDs available', 0, 0, 0),
(823, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'No Order Status available', 'No Order Status available', 0, 0, 0),
(824, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'No orders available', 'No orders available', 0, 0, 0),
(825, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'No Pages available', 'No Pages available', 0, 0, 0),
(826, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'No Payment Gateways available', 'No Payment Gateways available', 0, 0, 0),
(827, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'No PayPal Connection Available.', 'No PayPal Connection Available.', 0, 0, 0),
(828, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'No Paypal Transaction Logs available', 'No Paypal Transaction Logs available', 0, 0, 0),
(829, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'No Product Attributes available', 'No Product Attributes available', 0, 0, 0),
(830, '2012-02-21 20:14:50', '2012-02-21 20:14:50', 42, 'No Product Downloads available', 'No Product Downloads available', 0, 0, 0),
(831, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'No Product Status available', 'No Product Status available', 0, 0, 0),
(832, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'No Product Views available', 'No Product Views available', 0, 0, 0),
(833, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'No products available', 'No products available', 0, 0, 0),
(834, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'No settings available', 'No settings available', 0, 0, 0),
(835, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'No Shipping', 'No Shipping', 0, 0, 0),
(836, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'No shipping addresss available', 'No shipping addresss available', 0, 0, 0);
INSERT INTO `translations` (`id`, `created`, `modified`, `language_id`, `key`, `lang_text`, `is_translated`, `is_google_translate`, `is_verified`) VALUES
(837, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'No states available', 'No states available', 0, 0, 0),
(838, '2012-02-21 20:14:14', '2012-02-21 20:14:14', 42, 'No Time Set', 'No Time Set', 0, 0, 0),
(839, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'No Transaction Types available', 'No Transaction Types available', 0, 0, 0),
(840, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'No Transactions available', 'No Transactions available', 0, 0, 0),
(841, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'No Translations available', 'No Translations available', 0, 0, 0),
(842, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'No translations available for the selected language.', 'No translations available for the selected language.', 0, 0, 0),
(843, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'No User Logins available', 'No User Logins available', 0, 0, 0),
(844, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'No User Openids available', 'No User Openids available', 0, 0, 0),
(845, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'No User Views available', 'No User Views available', 0, 0, 0),
(846, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'No users available', 'No users available', 0, 0, 0),
(847, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'No withdraw fund requests available', 'No withdraw fund requests available', 0, 0, 0),
(848, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Non Auto Approved', 'Non Auto Approved', 0, 0, 0),
(849, '2012-02-21 20:14:39', '2012-02-21 20:14:39', 42, 'None', 'None', 0, 0, 0),
(850, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'None, ', 'None, ', 0, 0, 0),
(851, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Normal', 'Normal', 0, 0, 0),
(852, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Normal Paypal Transaction Logs', 'Normal Paypal Transaction Logs', 0, 0, 0),
(853, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Not Allow Beyond Original', 'Not Allow Beyond Original', 0, 0, 0),
(854, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Not Mentioned', 'Not Mentioned', 0, 0, 0),
(855, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Not Verified', 'Not Verified', 0, 0, 0),
(856, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'Notspam', 'Notspam', 0, 0, 0),
(857, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'of', 'of', 0, 0, 0),
(858, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Old password', 'Old password', 0, 0, 0),
(859, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'On activating this, users can pay from the site using PayPal payment option.', 'On activating this, users can pay from the site using PayPal payment option.', 0, 0, 0),
(860, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'On activating this, users can pay from the site using site wallet payment option.', 'On activating this, users can pay from the site using site wallet payment option.', 0, 0, 0),
(861, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'On enabling this, admin can use this gateway to transfer amount to multiple users.', 'On enabling this, admin can use this gateway to transfer amount to multiple users.', 0, 0, 0),
(862, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'On enabling this, live account will used instead of sandbox payment details. (Enable this, When site is in production stage', 'On enabling this, live account will used instead of sandbox payment details. (Enable this, When site is in production stage', 0, 0, 0),
(863, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Online users', 'Online users', 0, 0, 0),
(864, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Oops', 'Oops', 0, 0, 0),
(865, '2012-02-21 20:14:23', '2012-02-21 20:14:23', 42, 'Oops, problems in registration, please try again or later.', 'Oops, problems in registration, please try again or later.', 0, 0, 0),
(866, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Oops, products no longer available', 'Oops, products no longer available', 0, 0, 0),
(867, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Oops, you have choosen more qunatity', 'Oops, you have choosen more qunatity', 0, 0, 0),
(868, '2012-02-21 20:14:15', '2012-02-21 20:14:15', 42, 'open', 'open', 0, 0, 0),
(869, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'OpenID', 'OpenID', 0, 0, 0),
(870, '2012-02-21 20:14:33', '2012-02-21 20:14:33', 42, 'OpenID already exist', 'OpenID already exist', 0, 0, 0),
(871, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'OpenID Users', 'OpenID Users', 0, 0, 0),
(872, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'OpenID Users: %s', 'OpenID Users: %s', 0, 0, 0),
(873, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'OR', 'OR', 0, 0, 0),
(874, '2012-02-21 20:14:36', '2012-02-21 20:14:36', 42, 'Order', 'Order', 0, 0, 0),
(875, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Order #', 'Order #', 0, 0, 0),
(876, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Order Cancel', 'Order Cancel', 0, 0, 0),
(877, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Order canceled successfully.', 'Order canceled successfully.', 0, 0, 0),
(878, '2012-02-21 20:14:15', '2012-02-21 20:14:15', 42, 'Order completed successfully', 'Order completed successfully', 0, 0, 0),
(879, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'Order deleted', 'Order deleted', 0, 0, 0),
(880, '2012-02-21 20:14:50', '2012-02-21 20:14:50', 42, 'Order details - #', 'Order details - #', 0, 0, 0),
(881, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Order id', 'Order id', 0, 0, 0),
(882, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'Order invoice', 'Order invoice', 0, 0, 0),
(883, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Order Status', 'Order Status', 0, 0, 0),
(884, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'Order status changed into shipped', 'Order status changed into shipped', 0, 0, 0),
(885, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'Order status could not be updated. Please, try again.', 'Order status could not be updated. Please, try again.', 0, 0, 0),
(886, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'Order status has been updated', 'Order status has been updated', 0, 0, 0),
(887, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'Order Statuses', 'Order Statuses', 0, 0, 0),
(888, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Order#', 'Order#', 0, 0, 0),
(889, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Ordered Date', 'Ordered Date', 0, 0, 0),
(890, '2012-02-21 20:14:50', '2012-02-21 20:14:50', 42, 'Ordered tems', 'Ordered tems', 0, 0, 0),
(891, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'Orders', 'Orders', 0, 0, 0),
(892, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Orders Placed', 'Orders Placed', 0, 0, 0),
(893, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'Orginal Amount', 'Orginal Amount', 0, 0, 0),
(894, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'Original Price', 'Original Price', 0, 0, 0),
(895, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Other', 'Other', 0, 0, 0),
(896, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Other Info', 'Other Info', 0, 0, 0),
(897, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Others', 'Others', 0, 0, 0),
(898, '2012-02-21 20:14:40', '2012-02-21 20:14:40', 42, 'Overview', 'Overview', 0, 0, 0),
(899, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'Page', 'Page', 0, 0, 0),
(900, '2012-02-21 20:14:22', '2012-02-21 20:14:22', 42, 'Page could not be added. Please, try again.', 'Page could not be added. Please, try again.', 0, 0, 0),
(901, '2012-02-21 20:14:23', '2012-02-21 20:14:23', 42, 'Page could not be Updated. Please, try again.', 'Page could not be Updated. Please, try again.', 0, 0, 0),
(902, '2012-02-21 20:14:23', '2012-02-21 20:14:23', 42, 'Page Deleted Successfully', 'Page Deleted Successfully', 0, 0, 0),
(903, '2012-02-21 20:14:22', '2012-02-21 20:14:22', 42, 'Page has been created', 'Page has been created', 0, 0, 0),
(904, '2012-02-21 20:14:23', '2012-02-21 20:14:23', 42, 'Page has been Updated', 'Page has been Updated', 0, 0, 0),
(905, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Page title', 'Page title', 0, 0, 0),
(906, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Paid Date', 'Paid Date', 0, 0, 0),
(907, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Password', 'Password', 0, 0, 0),
(908, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'Password could not be changed', 'Password could not be changed', 0, 0, 0),
(909, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'Password has been changed successfully', 'Password has been changed successfully', 0, 0, 0),
(910, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Pay Now', 'Pay Now', 0, 0, 0),
(911, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'Pay via Paypal', 'Pay via Paypal', 0, 0, 0),
(912, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Pay With Connected PayPal', 'Pay With Connected PayPal', 0, 0, 0),
(913, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Pay With PayPal', 'Pay With PayPal', 0, 0, 0),
(914, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Payee Details', 'Payee Details', 0, 0, 0),
(915, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Payer Email', 'Payer Email', 0, 0, 0),
(916, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Payment', 'Payment', 0, 0, 0),
(917, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Payment Date', 'Payment Date', 0, 0, 0),
(918, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Payment Gateway', 'Payment Gateway', 0, 0, 0),
(919, '2012-02-21 20:14:23', '2012-02-21 20:14:23', 42, 'Payment Gateway could not be updated. Please, try again.', 'Payment Gateway could not be updated. Please, try again.', 0, 0, 0),
(920, '2012-02-21 20:14:23', '2012-02-21 20:14:23', 42, 'Payment Gateway has been updated', 'Payment Gateway has been updated', 0, 0, 0),
(921, '2012-02-21 20:14:23', '2012-02-21 20:14:23', 42, 'Payment Gateways', 'Payment Gateways', 0, 0, 0),
(922, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Payment Made', 'Payment Made', 0, 0, 0),
(923, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Payment Method', 'Payment Method', 0, 0, 0),
(924, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Payment Pending', 'Payment Pending', 0, 0, 0),
(925, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Payment Processing', 'Payment Processing', 0, 0, 0),
(926, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Payment Status', 'Payment Status', 0, 0, 0),
(927, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Payments', 'Payments', 0, 0, 0),
(928, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'PayPal account should not be empty.', 'PayPal account should not be empty.', 0, 0, 0),
(929, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Paypal Post Vars', 'Paypal Post Vars', 0, 0, 0),
(930, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Paypal Response', 'Paypal Response', 0, 0, 0),
(931, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Paypal Transaction Log', 'Paypal Transaction Log', 0, 0, 0),
(932, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Paypal Transaction Logs', 'Paypal Transaction Logs', 0, 0, 0),
(933, '2012-02-21 20:14:33', '2012-02-21 20:14:33', 42, 'Pending', 'Pending', 0, 0, 0),
(934, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Pending Reason', 'Pending Reason', 0, 0, 0),
(935, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Percentage', 'Percentage', 0, 0, 0),
(936, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Permanent', 'Permanent', 0, 0, 0),
(937, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Personal Info', 'Personal Info', 0, 0, 0),
(938, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Phone', 'Phone', 0, 0, 0),
(939, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Phone: ', 'Phone: ', 0, 0, 0),
(940, '2012-02-21 20:14:40', '2012-02-21 20:14:40', 42, 'Photo caption allows only 255 characters.', 'Photo caption allows only 255 characters.', 0, 0, 0),
(941, '2012-02-21 20:14:40', '2012-02-21 20:14:40', 42, 'Photos', 'Photos', 0, 0, 0),
(942, '2012-02-21 20:14:18', '2012-02-21 20:14:18', 42, 'Pipeline', 'Pipeline', 0, 0, 0),
(943, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Please change your shipping address so you can checkout.', 'Please change your shipping address so you can checkout.', 0, 0, 0),
(944, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'Please enter a new label name:', 'Please enter a new label name:', 0, 0, 0),
(945, '2012-02-21 20:14:23', '2012-02-21 20:14:23', 42, 'Please enter shipping address for this order. Please, try again.', 'Please enter shipping address for this order. Please, try again.', 0, 0, 0),
(946, '2012-02-21 20:14:25', '2012-02-21 20:14:25', 42, 'Please enter shipping details.', 'Please enter shipping details.', 0, 0, 0),
(947, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Please enter valid captcha', 'Please enter valid captcha', 0, 0, 0),
(948, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'Please enter valid email id.', 'Please enter valid email id.', 0, 0, 0),
(949, '2012-02-21 20:14:33', '2012-02-21 20:14:33', 42, 'Please Select', 'Please Select', 0, 0, 0),
(950, '2012-02-21 20:14:23', '2012-02-21 20:14:23', 42, 'Please select atlest one product to remove', 'Please select atlest one product to remove', 0, 0, 0),
(951, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Please select correct address value', 'Please select correct address value', 0, 0, 0),
(952, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Please specify atleast one recipient', 'Please specify atleast one recipient', 0, 0, 0),
(953, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Plural', 'Plural', 0, 0, 0),
(954, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'PNG images crushed successfully', 'PNG images crushed successfully', 0, 0, 0),
(955, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'Policies', 'Policies', 0, 0, 0),
(956, '2012-02-21 20:14:43', '2012-02-21 20:14:43', 42, 'Population', 'Population', 0, 0, 0),
(957, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, 'Possibilities:', 'Possibilities:', 0, 0, 0),
(958, '2012-02-21 20:14:46', '2012-02-21 20:14:46', 42, 'Powered by Privateshop', 'Powered by Privateshop', 0, 0, 0),
(959, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'Prev', 'Prev', 0, 0, 0),
(960, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Preview', 'Preview', 0, 0, 0),
(961, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Price', 'Price', 0, 0, 0),
(962, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Primary', 'Primary', 0, 0, 0),
(963, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Primary?', 'Primary?', 0, 0, 0),
(964, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Print', 'Print', 0, 0, 0),
(965, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'Privacy', 'Privacy', 0, 0, 0),
(966, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'Problem in Facebook connect. Please try again', 'Problem in Facebook connect. Please try again', 0, 0, 0),
(967, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Problem in saving message', 'Problem in saving message', 0, 0, 0),
(968, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Problem in sending mail to the appropriate user', 'Problem in sending mail to the appropriate user', 0, 0, 0),
(969, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Problem in sending message.', 'Problem in sending message.', 0, 0, 0),
(970, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'Problem in Twitter connect. Please try again', 'Problem in Twitter connect. Please try again', 0, 0, 0),
(971, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Proceed to checkout', 'Proceed to checkout', 0, 0, 0),
(972, '2012-02-21 20:14:25', '2012-02-21 20:14:25', 42, 'Product', 'Product', 0, 0, 0),
(973, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Product Attribute', 'Product Attribute', 0, 0, 0),
(974, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'product attribute could not be added. Please, try again.', 'product attribute could not be added. Please, try again.', 0, 0, 0),
(975, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'product attribute could not be updated. Please, try again.', 'product attribute could not be updated. Please, try again.', 0, 0, 0),
(976, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Product attribute deleted', 'Product attribute deleted', 0, 0, 0),
(977, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'product attribute has been added', 'product attribute has been added', 0, 0, 0),
(978, '2012-02-21 20:14:25', '2012-02-21 20:14:25', 42, 'product attribute has been added.', 'product attribute has been added.', 0, 0, 0),
(979, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'product attribute has been updated', 'product attribute has been updated', 0, 0, 0),
(980, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Product attribute was not deleted', 'Product attribute was not deleted', 0, 0, 0),
(981, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'Product Attributes', 'Product Attributes', 0, 0, 0),
(982, '2012-02-21 20:14:40', '2012-02-21 20:14:40', 42, 'Product by Downloads', 'Product by Downloads', 0, 0, 0),
(983, '2012-02-21 20:14:40', '2012-02-21 20:14:40', 42, 'Product by Statuses', 'Product by Statuses', 0, 0, 0),
(984, '2012-02-21 20:14:40', '2012-02-21 20:14:40', 42, 'Product by Views', 'Product by Views', 0, 0, 0),
(985, '2012-02-21 20:14:25', '2012-02-21 20:14:25', 42, 'Product could not be added. Please, try again.', 'Product could not be added. Please, try again.', 0, 0, 0),
(986, '2012-02-21 20:14:25', '2012-02-21 20:14:25', 42, 'Product could not be updated. Please, try again.', 'Product could not be updated. Please, try again.', 0, 0, 0),
(987, '2012-02-21 20:14:50', '2012-02-21 20:14:50', 42, 'Product Count', 'Product Count', 0, 0, 0),
(988, '2012-02-21 20:14:25', '2012-02-21 20:14:25', 42, 'Product deleted', 'Product deleted', 0, 0, 0),
(989, '2012-02-21 20:14:18', '2012-02-21 20:14:18', 42, 'Product Download', 'Product Download', 0, 0, 0),
(990, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Product download deleted', 'Product download deleted', 0, 0, 0),
(991, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Product download was not deleted', 'Product download was not deleted', 0, 0, 0),
(992, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Product Downloads', 'Product Downloads', 0, 0, 0),
(993, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'Product file download', 'Product file download', 0, 0, 0),
(994, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Product Filter', 'Product Filter', 0, 0, 0),
(995, '2012-02-21 20:14:25', '2012-02-21 20:14:25', 42, 'Product has been added', 'Product has been added', 0, 0, 0),
(996, '2012-02-21 20:14:25', '2012-02-21 20:14:25', 42, 'Product has been updated', 'Product has been updated', 0, 0, 0),
(997, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Product Manual', 'Product Manual', 0, 0, 0),
(998, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Product Options', 'Product Options', 0, 0, 0),
(999, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Product purchase in', 'Product purchase in', 0, 0, 0),
(1000, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Product Status', 'Product Status', 0, 0, 0),
(1001, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'product status could not be updated. Please, try again.', 'product status could not be updated. Please, try again.', 0, 0, 0),
(1002, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'product status has been updated', 'product status has been updated', 0, 0, 0),
(1003, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Product status updated successfully', 'Product status updated successfully', 0, 0, 0),
(1004, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Product Statuses', 'Product Statuses', 0, 0, 0),
(1005, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Product Support', 'Product Support', 0, 0, 0),
(1006, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'Product Type', 'Product Type', 0, 0, 0),
(1007, '2012-02-21 20:14:18', '2012-02-21 20:14:18', 42, 'Product View', 'Product View', 0, 0, 0),
(1008, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Product view deleted', 'Product view deleted', 0, 0, 0),
(1009, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Product view was not deleted', 'Product view was not deleted', 0, 0, 0),
(1010, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Product Views', 'Product Views', 0, 0, 0),
(1011, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Product Voting deleted', 'Product Voting deleted', 0, 0, 0),
(1012, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Product Votings', 'Product Votings', 0, 0, 0),
(1013, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Product(s) quantity not updated. Please try again.', 'Product(s) quantity not updated. Please try again.', 0, 0, 0),
(1014, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Product(s) quantity updated successfully', 'Product(s) quantity updated successfully', 0, 0, 0),
(1015, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'productAttributes', 'productAttributes', 0, 0, 0),
(1016, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Products', 'Products', 0, 0, 0),
(1017, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Products added into cart successfully', 'Products added into cart successfully', 0, 0, 0),
(1018, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Purchases', 'Purchases', 0, 0, 0),
(1019, '2012-02-21 20:14:32', '2012-02-21 20:14:32', 42, 'Quantity', 'Quantity', 0, 0, 0),
(1020, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Quantity is more than maximum quantity purchase as gift', 'Quantity is more than maximum quantity purchase as gift', 0, 0, 0),
(1021, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Quantity is more than maximum quantity purchase as own', 'Quantity is more than maximum quantity purchase as own', 0, 0, 0),
(1022, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Quantity Sold', 'Quantity Sold', 0, 0, 0),
(1023, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'Rate', 'Rate', 0, 0, 0),
(1024, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Re:', 'Re:', 0, 0, 0),
(1025, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'Read', 'Read', 0, 0, 0),
(1026, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'Read, ', 'Read, ', 0, 0, 0),
(1027, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, 'Reason', 'Reason', 0, 0, 0),
(1028, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Receiver Email', 'Receiver Email', 0, 0, 0),
(1029, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Recently no users online', 'Recently no users online', 0, 0, 0),
(1030, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Recently no users registered', 'Recently no users registered', 0, 0, 0),
(1031, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Recently registered users', 'Recently registered users', 0, 0, 0),
(1032, '2012-02-21 20:14:15', '2012-02-21 20:14:15', 42, 'Record set it as not primary', 'Record set it as not primary', 0, 0, 0),
(1033, '2012-02-21 20:14:15', '2012-02-21 20:14:15', 42, 'Record set it as primary', 'Record set it as primary', 0, 0, 0),
(1034, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'records out of', 'records out of', 0, 0, 0),
(1035, '2012-02-21 20:14:38', '2012-02-21 20:14:38', 42, 'Redirect', 'Redirect', 0, 0, 0),
(1036, '2012-02-21 20:14:38', '2012-02-21 20:14:38', 42, 'Redirect to', 'Redirect to', 0, 0, 0),
(1037, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Redirecting you to authorize %s', 'Redirecting you to authorize %s', 0, 0, 0),
(1038, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Refer Friends and Get %s %s Bucks! ', 'Refer Friends and Get %s %s Bucks! ', 0, 0, 0),
(1039, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Referer block', 'Referer block', 0, 0, 0),
(1040, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Referral FAQ', 'Referral FAQ', 0, 0, 0),
(1041, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Referrals', 'Referrals', 0, 0, 0),
(1042, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Referred Users', 'Referred Users', 0, 0, 0),
(1043, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Referrer username does not exist.', 'Referrer username does not exist.', 0, 0, 0),
(1044, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Refresh', 'Refresh', 0, 0, 0),
(1045, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Regional', 'Regional', 0, 0, 0),
(1046, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Regional, Currency & Language', 'Regional, Currency & Language', 0, 0, 0),
(1047, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Register', 'Register', 0, 0, 0),
(1048, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Registered On', 'Registered On', 0, 0, 0),
(1049, '2012-02-21 20:14:40', '2012-02-21 20:14:40', 42, 'Registration', 'Registration', 0, 0, 0),
(1050, '2012-02-21 20:14:33', '2012-02-21 20:14:33', 42, 'Rejected', 'Rejected', 0, 0, 0),
(1051, '2012-02-21 20:14:43', '2012-02-21 20:14:43', 42, 'Reload CAPTCHA', 'Reload CAPTCHA', 0, 0, 0),
(1052, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Remark', 'Remark', 0, 0, 0),
(1053, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Remember me', 'Remember me', 0, 0, 0),
(1054, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Remember me on this computer.', 'Remember me on this computer.', 0, 0, 0),
(1055, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Remove', 'Remove', 0, 0, 0),
(1056, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'Remove attachment', 'Remove attachment', 0, 0, 0),
(1057, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Remove star', 'Remove star', 0, 0, 0),
(1058, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Removed from cart successfully', 'Removed from cart successfully', 0, 0, 0),
(1059, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'Rename', 'Rename', 0, 0, 0),
(1060, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Rename config/database.php.default to config/database.php', 'Rename config/database.php.default to config/database.php', 0, 0, 0),
(1061, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, 'Reorder', 'Reorder', 0, 0, 0),
(1062, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Requested On', 'Requested On', 0, 0, 0),
(1063, '2012-02-21 20:14:23', '2012-02-21 20:14:23', 42, 'Required', 'Required', 0, 0, 0),
(1064, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Resend Activation', 'Resend Activation', 0, 0, 0),
(1065, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'Reset Password', 'Reset Password', 0, 0, 0),
(1066, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Reset your password', 'Reset your password', 0, 0, 0),
(1067, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Sales', 'Sales', 0, 0, 0),
(1068, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, 'Save', 'Save', 0, 0, 0),
(1069, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Save as Draft', 'Save as Draft', 0, 0, 0),
(1070, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Savings for User', 'Savings for User', 0, 0, 0),
(1071, '2012-02-21 20:14:42', '2012-02-21 20:14:42', 42, 'Search', 'Search', 0, 0, 0),
(1072, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Search Results', 'Search Results', 0, 0, 0),
(1073, '2012-02-21 20:14:43', '2012-02-21 20:14:43', 42, 'Security Code', 'Security Code', 0, 0, 0),
(1074, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'See All', 'See All', 0, 0, 0),
(1075, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Select', 'Select', 0, 0, 0),
(1076, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Select a region or country', 'Select a region or country', 0, 0, 0),
(1077, '2012-02-21 20:14:14', '2012-02-21 20:14:14', 42, 'Select date', 'Select date', 0, 0, 0),
(1078, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, 'Select method', 'Select method', 0, 0, 0),
(1079, '2012-02-21 20:14:40', '2012-02-21 20:14:40', 42, 'Select Range', 'Select Range', 0, 0, 0),
(1080, '2012-02-21 20:14:39', '2012-02-21 20:14:39', 42, 'Select:', 'Select:', 0, 0, 0),
(1081, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Seller', 'Seller', 0, 0, 0),
(1082, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Seller - ', 'Seller - ', 0, 0, 0),
(1083, '2012-02-21 20:14:43', '2012-02-21 20:14:43', 42, 'Send', 'Send', 0, 0, 0),
(1084, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Send Email to users', 'Send Email to users', 0, 0, 0),
(1085, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Send notification when you purchased the new item', 'Send notification when you purchased the new item', 0, 0, 0),
(1086, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Send notification when your order has been refunded', 'Send notification when your order has been refunded', 0, 0, 0),
(1087, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Send notification when your order has been shipped ', 'Send notification when your order has been shipped ', 0, 0, 0),
(1088, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Sent Mail', 'Sent Mail', 0, 0, 0),
(1089, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'SEO', 'SEO', 0, 0, 0),
(1090, '2012-02-21 20:14:50', '2012-02-21 20:14:50', 42, 'Set completed', 'Set completed', 0, 0, 0),
(1091, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Set primary', 'Set primary', 0, 0, 0),
(1092, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Setting Category', 'Setting Category', 0, 0, 0),
(1093, '2012-02-21 20:14:20', '2012-02-21 20:14:20', 42, 'Settings', 'Settings', 0, 0, 0),
(1094, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'Settings updated successfully.', 'Settings updated successfully.', 0, 0, 0),
(1095, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Setup Your Account', 'Setup Your Account', 0, 0, 0),
(1096, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Share it on Facebook', 'Share it on Facebook', 0, 0, 0),
(1097, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Share this', 'Share this', 0, 0, 0),
(1098, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Share your personalized referral link using the tools to your left. When someone clicks that link, we will know you sent them.', 'Share your personalized referral link using the tools to your left. When someone clicks that link, we will know you sent them.', 0, 0, 0),
(1099, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Share your unique referral link', 'Share your unique referral link', 0, 0, 0),
(1100, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Ship To', 'Ship To', 0, 0, 0),
(1101, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Ship to multiple addresses', 'Ship to multiple addresses', 0, 0, 0),
(1102, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Ship to one address', 'Ship to one address', 0, 0, 0),
(1103, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Shipp to', 'Shipp to', 0, 0, 0),
(1104, '2012-02-21 20:14:22', '2012-02-21 20:14:22', 42, 'Shipped', 'Shipped', 0, 0, 0),
(1105, '2012-02-21 20:14:50', '2012-02-21 20:14:50', 42, 'Shipped Date', 'Shipped Date', 0, 0, 0),
(1106, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Shipping', 'Shipping', 0, 0, 0),
(1107, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Shipping Address', 'Shipping Address', 0, 0, 0),
(1108, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Shipping Addresses', 'Shipping Addresses', 0, 0, 0),
(1109, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Shipping Details', 'Shipping Details', 0, 0, 0),
(1110, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Shipping fee:', 'Shipping fee:', 0, 0, 0),
(1111, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Shipping Price', 'Shipping Price', 0, 0, 0),
(1112, '2012-02-21 20:14:50', '2012-02-21 20:14:50', 42, 'Shipping Remarks', 'Shipping Remarks', 0, 0, 0),
(1113, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Shipping Status', 'Shipping Status', 0, 0, 0),
(1114, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Should be a number', 'Should be a number', 0, 0, 0),
(1115, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Should be greater than 0', 'Should be greater than 0', 0, 0, 0),
(1116, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Should be greater than 0 and less than 100', 'Should be greater than 0 and less than 100', 0, 0, 0),
(1117, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Should be less than available quantity', 'Should be less than available quantity', 0, 0, 0),
(1118, '2012-02-21 20:14:33', '2012-02-21 20:14:33', 42, 'Should be numeric', 'Should be numeric', 0, 0, 0),
(1119, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Show conversations per page', 'Show conversations per page', 0, 0, 0),
(1120, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'Show search options', 'Show search options', 0, 0, 0),
(1121, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'showing ', 'showing ', 0, 0, 0),
(1122, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Sign In', 'Sign In', 0, 0, 0),
(1123, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'Sign In using: ', 'Sign In using: ', 0, 0, 0),
(1124, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'Sign in with Facebook', 'Sign in with Facebook', 0, 0, 0),
(1125, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'Sign in with Gmail', 'Sign in with Gmail', 0, 0, 0),
(1126, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Sign in with Open ID', 'Sign in with Open ID', 0, 0, 0),
(1127, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'Sign in with OpenID', 'Sign in with OpenID', 0, 0, 0),
(1128, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'Sign in with Twitter', 'Sign in with Twitter', 0, 0, 0),
(1129, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'Sign in with Yahoo', 'Sign in with Yahoo', 0, 0, 0),
(1130, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Sign Up / Sign In', 'Sign Up / Sign In', 0, 0, 0),
(1131, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Sign up using: ', 'Sign up using: ', 0, 0, 0),
(1132, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Sign up with Facebook', 'Sign up with Facebook', 0, 0, 0),
(1133, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Sign up with Gmail', 'Sign up with Gmail', 0, 0, 0),
(1134, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Sign up with Open ID', 'Sign up with Open ID', 0, 0, 0),
(1135, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Sign up with Twitter', 'Sign up with Twitter', 0, 0, 0),
(1136, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Sign up with Yahoo', 'Sign up with Yahoo', 0, 0, 0),
(1137, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Signup', 'Signup', 0, 0, 0),
(1138, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Signup IP', 'Signup IP', 0, 0, 0),
(1139, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Single IP or hostname', 'Single IP or hostname', 0, 0, 0),
(1140, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Singular', 'Singular', 0, 0, 0),
(1141, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'Site Background', 'Site Background', 0, 0, 0),
(1142, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Site Users', 'Site Users', 0, 0, 0),
(1143, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Site Users: %s', 'Site Users: %s', 0, 0, 0),
(1144, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Snapshot', 'Snapshot', 0, 0, 0),
(1145, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Sold Out', 'Sold Out', 0, 0, 0),
(1146, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'soldout-block', 'soldout-block', 0, 0, 0),
(1147, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Some of the products in your cart aren''t available and does not ship to your shipping address. Please remove these products from your cart so you can checkout.', 'Some of the products in your cart aren''t available and does not ship to your shipping address. Please remove these products from your cart so you can checkout.', 0, 0, 0),
(1148, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Some of the products in your cart aren''t available. Please remove these products from your cart so you can checkout.', 'Some of the products in your cart aren''t available. Please remove these products from your cart so you can checkout.', 0, 0, 0),
(1149, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'something went wrong.', 'something went wrong.', 0, 0, 0),
(1150, '2012-02-21 20:14:15', '2012-02-21 20:14:15', 42, 'Sorry, login failed.  Either your %s or password are incorrect or admin deactivated your account.', 'Sorry, login failed.  Either your %s or password are incorrect or admin deactivated your account.', 0, 0, 0),
(1151, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'Sorry, login failed.  Your %s or password are incorrect', 'Sorry, login failed.  Your %s or password are incorrect', 0, 0, 0),
(1152, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'Sorry, login failed.  Your account has been blocked', 'Sorry, login failed.  Your account has been blocked', 0, 0, 0),
(1153, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'Sorry, you registered through OpenID account. So you should have atleast one OpenID account for login', 'Sorry, you registered through OpenID account. So you should have atleast one OpenID account for login', 0, 0, 0),
(1154, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'Sorry. You Cannot Update the Settings in Demo Mode', 'Sorry. You Cannot Update the Settings in Demo Mode', 0, 0, 0),
(1155, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Sort by:', 'Sort by:', 0, 0, 0),
(1156, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Source Code Analysis', 'Source Code Analysis', 0, 0, 0),
(1157, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'Spam', 'Spam', 0, 0, 0),
(1158, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Specify shipment details', 'Specify shipment details', 0, 0, 0),
(1159, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Star', 'Star', 0, 0, 0),
(1160, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'Starred', 'Starred', 0, 0, 0),
(1161, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'Starred, ', 'Starred, ', 0, 0, 0),
(1162, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Start', 'Start', 0, 0, 0),
(1163, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Start date should be greater than current time', 'Start date should be greater than current time', 0, 0, 0),
(1164, '2012-02-21 20:14:41', '2012-02-21 20:14:41', 42, 'State', 'State', 0, 0, 0),
(1165, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'State could not be added. Please, try again.', 'State could not be added. Please, try again.', 0, 0, 0),
(1166, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'State could not be updated. Please, try again.', 'State could not be updated. Please, try again.', 0, 0, 0),
(1167, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'State deleted', 'State deleted', 0, 0, 0),
(1168, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'State has been added', 'State has been added', 0, 0, 0),
(1169, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'State has been updated', 'State has been updated', 0, 0, 0),
(1170, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'States', 'States', 0, 0, 0),
(1171, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Static pages', 'Static pages', 0, 0, 0),
(1172, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Stats', 'Stats', 0, 0, 0),
(1173, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'Status', 'Status', 0, 0, 0),
(1174, '2012-02-21 20:14:19', '2012-02-21 20:14:19', 42, 'Status updated successfully', 'Status updated successfully', 0, 0, 0),
(1175, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Status: ', 'Status: ', 0, 0, 0),
(1176, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'Subject', 'Subject', 0, 0, 0),
(1177, '2012-02-21 20:14:40', '2012-02-21 20:14:40', 42, 'submenu-list-block', 'submenu-list-block', 0, 0, 0),
(1178, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Submit', 'Submit', 0, 0, 0),
(1179, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Success', 'Success', 0, 0, 0),
(1180, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Supporters', 'Supporters', 0, 0, 0),
(1181, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Suspend', 'Suspend', 0, 0, 0),
(1182, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'Suspend Message', 'Suspend Message', 0, 0, 0),
(1183, '2012-02-21 20:14:18', '2012-02-21 20:14:18', 42, 'Suspended', 'Suspended', 0, 0, 0),
(1184, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'Suspended messages', 'Suspended messages', 0, 0, 0),
(1185, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'Suspended messages:', 'Suspended messages:', 0, 0, 0),
(1186, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'System', 'System', 0, 0, 0),
(1187, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'System Flagged', 'System Flagged', 0, 0, 0),
(1188, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'System flagged  messages', 'System flagged  messages', 0, 0, 0),
(1189, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'System flagged  messages:', 'System flagged  messages:', 0, 0, 0),
(1190, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Tell me more', 'Tell me more', 0, 0, 0),
(1191, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Terms & Policies', 'Terms & Policies', 0, 0, 0),
(1192, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'Terms of Service', 'Terms of Service', 0, 0, 0),
(1193, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Terms of Use', 'Terms of Use', 0, 0, 0),
(1194, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Test Mode', 'Test Mode', 0, 0, 0),
(1195, '2012-02-21 20:14:42', '2012-02-21 20:14:42', 42, 'Thank you, we received your message and will get back to you as soon as possible.', 'Thank you, we received your message and will get back to you as soon as possible.', 0, 0, 0),
(1196, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Thanks', 'Thanks', 0, 0, 0),
(1197, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'The %s is being used for caching. To change the config edit APP/config/core.php ', 'The %s is being used for caching. To change the config edit APP/config/core.php ', 0, 0, 0),
(1198, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'The file uploaded is too big, only files less than %s permitted', 'The file uploaded is too big, only files less than %s permitted', 0, 0, 0),
(1199, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'The following OpenIDs are currently attached to your %s account. You can use any of them to sign in.', 'The following OpenIDs are currently attached to your %s account. You can use any of them to sign in.', 0, 0, 0),
(1200, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'The requested amount will be deducted from your wallet and the amount will be blocked until it get approved or rejected by the administrator. Once its approved, the requested amount will be sent to your paypal account. In case of failure, the amount will be refunded to your wallet.', 'The requested amount will be deducted from your wallet and the amount will be blocked until it get approved or rejected by the administrator. Once its approved, the requested amount will be sent to your paypal account. In case of failure, the amount will be refunded to your wallet.', 0, 0, 0),
(1201, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'The submitted file extension is not permitted, only jpg,jpeg,gif,png permitted.', 'The submitted file extension is not permitted, only jpg,jpeg,gif,png permitted.', 0, 0, 0),
(1202, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'There is no user registered with the email %s or admin deactivated your account. If you spelled the address incorrectly or entered the wrong address, please try again.', 'There is no user registered with the email %s or admin deactivated your account. If you spelled the address incorrectly or entered the wrong address, please try again.', 0, 0, 0),
(1203, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Third Party API', 'Third Party API', 0, 0, 0),
(1204, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'This download is expired', 'This download is expired', 0, 0, 0),
(1205, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'This is how your customers distinguish variations of your product. This product''s variants have multiple options that distinguish them. Example: Size AND Color', 'This is how your customers distinguish variations of your product. This product''s variants have multiple options that distinguish them. Example: Size AND Color', 0, 0, 0),
(1206, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'This is the commission that seller  will pay for the whole product in percentage.', 'This is the commission that seller  will pay for the whole product in percentage.', 0, 0, 0),
(1207, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'This is the flat fee that the seller will pay for the whole product.', 'This is the flat fee that the seller will pay for the whole product.', 0, 0, 0),
(1208, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'This Month', 'This Month', 0, 0, 0),
(1209, '2012-02-21 20:14:50', '2012-02-21 20:14:50', 42, 'This order doesn''t have any shipping', 'This order doesn''t have any shipping', 0, 0, 0),
(1210, '2012-02-21 20:14:50', '2012-02-21 20:14:50', 42, 'This order was already shipped', 'This order was already shipped', 0, 0, 0),
(1211, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'This product does not ship for your shipping address', 'This product does not ship for your shipping address', 0, 0, 0),
(1212, '2012-02-21 20:14:23', '2012-02-21 20:14:23', 42, 'This product does not ship to this address.', 'This product does not ship to this address.', 0, 0, 0),
(1213, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'This Week', 'This Week', 0, 0, 0),
(1214, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'This will be a gift', 'This will be a gift', 0, 0, 0),
(1215, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'This will take you to the paypal.com', 'This will take you to the paypal.com', 0, 0, 0),
(1216, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'This will work only after logged in.', 'This will work only after logged in.', 0, 0, 0),
(1217, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Time', 'Time', 0, 0, 0),
(1218, '2012-02-21 20:14:41', '2012-02-21 20:14:41', 42, 'Timezone', 'Timezone', 0, 0, 0),
(1219, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Timings', 'Timings', 0, 0, 0),
(1220, '2012-02-21 20:14:40', '2012-02-21 20:14:40', 42, 'Title', 'Title', 0, 0, 0),
(1221, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'To', 'To', 0, 0, 0),
(1222, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'To Account Name', 'To Account Name', 0, 0, 0),
(1223, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'To Account No', 'To Account No', 0, 0, 0),
(1224, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'To Digicurrency', 'To Digicurrency', 0, 0, 0),
(1225, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'To Language', 'To Language', 0, 0, 0),
(1226, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'To make new translation default translated language English should be available.', 'To make new translation default translated language English should be available.', 0, 0, 0),
(1227, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'to me', 'to me', 0, 0, 0),
(1228, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'To: ', 'To: ', 0, 0, 0),
(1229, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Today', 'Today', 0, 0, 0),
(1230, '2012-02-21 20:14:46', '2012-02-21 20:14:46', 42, 'Tools', 'Tools', 0, 0, 0),
(1231, '2012-02-21 20:14:32', '2012-02-21 20:14:32', 42, 'Top code', 'Top code', 0, 0, 0),
(1232, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Total', 'Total', 0, 0, 0),
(1233, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'Total Commission Amount = Bonus Amount + (Total Purchased Amount * Commission Percentage/100)', 'Total Commission Amount = Bonus Amount + (Total Purchased Amount * Commission Percentage/100)', 0, 0, 0),
(1234, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'Total messages', 'Total messages', 0, 0, 0),
(1235, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'Total messages:', 'Total messages:', 0, 0, 0),
(1236, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Total Orders', 'Total Orders', 0, 0, 0),
(1237, '2012-02-21 20:14:50', '2012-02-21 20:14:50', 42, 'Total Price', 'Total Price', 0, 0, 0),
(1238, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'Total Records: ', 'Total Records: ', 0, 0, 0),
(1239, '2012-02-21 20:14:42', '2012-02-21 20:14:42', 42, 'Total Records: : %s', 'Total Records: : %s', 0, 0, 0),
(1240, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Total Records: %s', 'Total Records: %s', 0, 0, 0),
(1241, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Total Users', 'Total Users', 0, 0, 0),
(1242, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Total Users: %s', 'Total Users: %s', 0, 0, 0),
(1243, '2012-02-21 20:14:45', '2012-02-21 20:14:45', 42, 'total, starting on record', 'total, starting on record', 0, 0, 0),
(1244, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Transaction', 'Transaction', 0, 0, 0),
(1245, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Transaction deleted', 'Transaction deleted', 0, 0, 0),
(1246, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Transaction ID', 'Transaction ID', 0, 0, 0),
(1247, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'Transaction Type could not be updated. Please, try again.', 'Transaction Type could not be updated. Please, try again.', 0, 0, 0),
(1248, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'Transaction Type has been updated', 'Transaction Type has been updated', 0, 0, 0),
(1249, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'Transaction Types', 'Transaction Types', 0, 0, 0),
(1250, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'Transactions', 'Transactions', 0, 0, 0),
(1251, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Translate Text', 'Translate Text', 0, 0, 0),
(1252, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Translation', 'Translation', 0, 0, 0),
(1253, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Translation could not be updated. Please, try again.', 'Translation could not be updated. Please, try again.', 0, 0, 0),
(1254, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Translation deleted', 'Translation deleted', 0, 0, 0),
(1255, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Translation deleted successfully', 'Translation deleted successfully', 0, 0, 0);
INSERT INTO `translations` (`id`, `created`, `modified`, `language_id`, `key`, `lang_text`, `is_translated`, `is_google_translate`, `is_verified`) VALUES
(1256, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Translation has been added', 'Translation has been added', 0, 0, 0),
(1257, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Translation Stats', 'Translation Stats', 0, 0, 0),
(1258, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Translation updated successfully', 'Translation updated successfully', 0, 0, 0),
(1259, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Translations', 'Translations', 0, 0, 0),
(1260, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Translations add', 'Translations add', 0, 0, 0),
(1261, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Trash', 'Trash', 0, 0, 0),
(1262, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'Try some time later as mail could not be dispatched due to some error in the server', 'Try some time later as mail could not be dispatched due to some error in the server', 0, 0, 0),
(1263, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Tweet it', 'Tweet it', 0, 0, 0),
(1264, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Tweet!', 'Tweet!', 0, 0, 0),
(1265, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Twitter', 'Twitter', 0, 0, 0),
(1266, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Twitter Users', 'Twitter Users', 0, 0, 0),
(1267, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Twitter Users: %s', 'Twitter Users: %s', 0, 0, 0),
(1268, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Txn Id', 'Txn Id', 0, 0, 0),
(1269, '2012-02-21 20:14:32', '2012-02-21 20:14:32', 42, 'Unapprove', 'Unapprove', 0, 0, 0),
(1270, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Unapproved', 'Unapproved', 0, 0, 0),
(1271, '2012-02-21 20:14:32', '2012-02-21 20:14:32', 42, 'Unchecked', 'Unchecked', 0, 0, 0),
(1272, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'Unflagged', 'Unflagged', 0, 0, 0),
(1273, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'Unread', 'Unread', 0, 0, 0),
(1274, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'Unread, ', 'Unread, ', 0, 0, 0),
(1275, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Unshipped', 'Unshipped', 0, 0, 0),
(1276, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Unstarred', 'Unstarred', 0, 0, 0),
(1277, '2012-02-21 20:14:31', '2012-02-21 20:14:31', 42, 'Unsuspend', 'Unsuspend', 0, 0, 0),
(1278, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'Unsuspend Message', 'Unsuspend Message', 0, 0, 0),
(1279, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Unverified', 'Unverified', 0, 0, 0),
(1280, '2012-02-21 20:14:15', '2012-02-21 20:14:15', 42, 'upcoming', 'upcoming', 0, 0, 0),
(1281, '2012-02-21 20:14:34', '2012-02-21 20:14:34', 42, 'Update', 'Update', 0, 0, 0),
(1282, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Update as Draft', 'Update as Draft', 0, 0, 0),
(1283, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Update cart', 'Update cart', 0, 0, 0),
(1284, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'Update Facebook', 'Update Facebook', 0, 0, 0),
(1285, '2012-02-21 20:14:26', '2012-02-21 20:14:26', 42, 'Update Twitter', 'Update Twitter', 0, 0, 0),
(1286, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Upload', 'Upload', 0, 0, 0),
(1287, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Upload a file to sell', 'Upload a file to sell', 0, 0, 0),
(1288, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Upload Photo', 'Upload Photo', 0, 0, 0),
(1289, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Upload Product File', 'Upload Product File', 0, 0, 0),
(1290, '2012-02-21 20:14:40', '2012-02-21 20:14:40', 42, 'URL', 'URL', 0, 0, 0),
(1291, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'User', 'User', 0, 0, 0),
(1292, '2012-02-21 20:14:40', '2012-02-21 20:14:40', 42, 'User Activities', 'User Activities', 0, 0, 0),
(1293, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'User Address', 'User Address', 0, 0, 0),
(1294, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'User address deleted', 'User address deleted', 0, 0, 0),
(1295, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'User cannot be found in server or admin deactivated your account, please register again', 'User cannot be found in server or admin deactivated your account, please register again', 0, 0, 0),
(1296, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'User Cash Withdrawal Id', 'User Cash Withdrawal Id', 0, 0, 0),
(1297, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'User could not be added. Please, try again.', 'User could not be added. Please, try again.', 0, 0, 0),
(1298, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'User email', 'User email', 0, 0, 0),
(1299, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'User has been added', 'User has been added', 0, 0, 0),
(1300, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'User has been deleted', 'User has been deleted', 0, 0, 0),
(1301, '2012-02-21 20:14:40', '2012-02-21 20:14:40', 42, 'User Login', 'User Login', 0, 0, 0),
(1302, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'User Login deleted', 'User Login deleted', 0, 0, 0),
(1303, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'User Logins', 'User Logins', 0, 0, 0),
(1304, '2012-02-21 20:14:40', '2012-02-21 20:14:40', 42, 'User Messages', 'User Messages', 0, 0, 0),
(1305, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'User Notification has been updated', 'User Notification has been updated', 0, 0, 0),
(1306, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'User Openid could not be added. Please, try again.', 'User Openid could not be added. Please, try again.', 0, 0, 0),
(1307, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'User Openid deleted', 'User Openid deleted', 0, 0, 0),
(1308, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'User Openid has been added', 'User Openid has been added', 0, 0, 0),
(1309, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'User Openids', 'User Openids', 0, 0, 0),
(1310, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'User Profile could not be updated. Please, try again.', 'User Profile could not be updated. Please, try again.', 0, 0, 0),
(1311, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'User Profile has been updated', 'User Profile has been updated', 0, 0, 0),
(1312, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'User Registration', 'User Registration', 0, 0, 0),
(1313, '2012-02-21 20:14:18', '2012-02-21 20:14:18', 42, 'User View', 'User View', 0, 0, 0),
(1314, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'User View deleted', 'User View deleted', 0, 0, 0),
(1315, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'User Views', 'User Views', 0, 0, 0),
(1316, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Username', 'Username', 0, 0, 0),
(1317, '2012-02-21 20:14:32', '2012-02-21 20:14:32', 42, 'Username is already exist', 'Username is already exist', 0, 0, 0),
(1318, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'Users', 'Users', 0, 0, 0),
(1319, '2012-02-21 20:14:40', '2012-02-21 20:14:40', 42, 'Value', 'Value', 0, 0, 0),
(1320, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Variants', 'Variants', 0, 0, 0),
(1321, '2012-02-21 20:14:16', '2012-02-21 20:14:16', 42, 'Variants Groups', 'Variants Groups', 0, 0, 0),
(1322, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'verification is completed successfully. But you have to fill the following required fields to complete our registration process.', 'verification is completed successfully. But you have to fill the following required fields to complete our registration process.', 0, 0, 0),
(1323, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Verified', 'Verified', 0, 0, 0),
(1324, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Version', 'Version', 0, 0, 0),
(1325, '2012-02-21 20:14:38', '2012-02-21 20:14:38', 42, 'Victims', 'Victims', 0, 0, 0),
(1326, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Video', 'Video', 0, 0, 0),
(1327, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'Video URL', 'Video URL', 0, 0, 0),
(1328, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'View', 'View', 0, 0, 0),
(1329, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'View debug, error log, used cache memory and used log memory', 'View debug, error log, used cache memory and used log memory', 0, 0, 0),
(1330, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'View Invoice', 'View Invoice', 0, 0, 0),
(1331, '2012-02-21 20:14:40', '2012-02-21 20:14:40', 42, 'View Now', 'View Now', 0, 0, 0),
(1332, '2012-02-21 20:14:50', '2012-02-21 20:14:50', 42, 'View Ordered items', 'View Ordered items', 0, 0, 0),
(1333, '2012-02-21 20:14:46', '2012-02-21 20:14:46', 42, 'View Site', 'View Site', 0, 0, 0),
(1334, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Viewed', 'Viewed', 0, 0, 0),
(1335, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'Viewed Time', 'Viewed Time', 0, 0, 0),
(1336, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Viewed User', 'Viewed User', 0, 0, 0),
(1337, '2012-02-21 20:14:40', '2012-02-21 20:14:40', 42, 'Views', 'Views', 0, 0, 0),
(1338, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Void', 'Void', 0, 0, 0),
(1339, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Void Ack', 'Void Ack', 0, 0, 0),
(1340, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Void Correlationid', 'Void Correlationid', 0, 0, 0),
(1341, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Void Data', 'Void Data', 0, 0, 0),
(1342, '2012-02-21 20:14:54', '2012-02-21 20:14:54', 42, 'Void Timestamp', 'Void Timestamp', 0, 0, 0),
(1343, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Vote', 'Vote', 0, 0, 0),
(1344, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Votes', 'Votes', 0, 0, 0),
(1345, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'Voting', 'Voting', 0, 0, 0),
(1346, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Voting could not be added. Please, try again', 'Voting could not be added. Please, try again', 0, 0, 0),
(1347, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Voting has been added', 'Voting has been added', 0, 0, 0),
(1348, '2012-02-21 20:14:46', '2012-02-21 20:14:46', 42, 'Wallet', 'Wallet', 0, 0, 0),
(1349, '2012-02-21 20:14:43', '2012-02-21 20:14:43', 42, 'Warning! If you delete any country from below list, users from that country can''t register into our site.', 'Warning! If you delete any country from below list, users from that country can''t register into our site.', 0, 0, 0),
(1350, '2012-02-21 20:14:44', '2012-02-21 20:14:44', 42, 'Warning! Please edit with caution.', 'Warning! Please edit with caution.', 0, 0, 0),
(1351, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'We are giving %s in %s Bucks for every friend you refer when they make their first purchase. It is our way of saying \\"thanks\\" for spreading the word and increasing our collective buying power! %s Bucks can be used toward any %s purchase, and they never expire.', 'We are giving %s in %s Bucks for every friend you refer when they make their first purchase. It is our way of saying \\"thanks\\" for spreading the word and increasing our collective buying power! %s Bucks can be used toward any %s purchase, and they never expire.', 0, 0, 0),
(1352, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'We have sent a new download link to', 'We have sent a new download link to', 0, 0, 0),
(1353, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Week(s)', 'Week(s)', 0, 0, 0),
(1354, '2012-02-21 20:14:46', '2012-02-21 20:14:46', 42, 'Welcome, ', 'Welcome, ', 0, 0, 0),
(1355, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'What are the rules?', 'What are the rules?', 0, 0, 0),
(1356, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'What is this?', 'What is this?', 0, 0, 0),
(1357, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Where to use?', 'Where to use?', 0, 0, 0),
(1358, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'whois', 'whois', 0, 0, 0),
(1359, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Widget #', 'Widget #', 0, 0, 0),
(1360, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'With', 'With', 0, 0, 0),
(1361, '2012-02-21 20:14:57', '2012-02-21 20:14:57', 42, 'With Another Item', 'With Another Item', 0, 0, 0),
(1362, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Withdraw and Confirm', 'Withdraw and Confirm', 0, 0, 0),
(1363, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Withdraw Fund Request', 'Withdraw Fund Request', 0, 0, 0),
(1364, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Withdraw fund request deleted', 'Withdraw fund request deleted', 0, 0, 0),
(1365, '2012-02-21 20:14:27', '2012-02-21 20:14:27', 42, 'Withdraw Fund Requests', 'Withdraw Fund Requests', 0, 0, 0),
(1366, '2012-02-21 20:14:58', '2012-02-21 20:14:58', 42, 'Withdraw Request', 'Withdraw Request', 0, 0, 0),
(1367, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Withdraw Requests', 'Withdraw Requests', 0, 0, 0),
(1368, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Withdrawal Status ', 'Withdrawal Status ', 0, 0, 0),
(1369, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Write Permission Check', 'Write Permission Check', 0, 0, 0),
(1370, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'Yahoo', 'Yahoo', 0, 0, 0),
(1371, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Yahoo Users', 'Yahoo Users', 0, 0, 0),
(1372, '2012-02-21 20:15:00', '2012-02-21 20:15:00', 42, 'Yahoo Users: %s', 'Yahoo Users: %s', 0, 0, 0),
(1373, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'Yes', 'Yes', 0, 0, 0),
(1374, '2012-02-21 20:14:55', '2012-02-21 20:14:55', 42, 'You are being redirected to the payment page...', 'You are being redirected to the payment page...', 0, 0, 0),
(1375, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'You are exceeding the allowed messages quoto. Please delete some messages from your inbox/sent/trash folders', 'You are exceeding the allowed messages quoto. Please delete some messages from your inbox/sent/trash folders', 0, 0, 0),
(1376, '2012-02-21 20:14:47', '2012-02-21 20:14:47', 42, 'You are logged in as ', 'You are logged in as ', 0, 0, 0),
(1377, '2012-02-21 20:14:46', '2012-02-21 20:14:46', 42, 'You are logged in as Admin', 'You are logged in as Admin', 0, 0, 0),
(1378, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'You are now logged out of the site.', 'You are now logged out of the site.', 0, 0, 0),
(1379, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'You can change the background image for the \\"Force Login\\" page.', 'You can change the background image for the \\"Force Login\\" page.', 0, 0, 0),
(1380, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'You can connect your PayPal account with %s. To connect your account, you''ll be taken to paypal.com and once connected, you can make orders without leaving to paypal.com again. Note: We don''t save your PayPal password and the connection is enabled through PayPal standard alone. Anytime, you can disable the connection.', 'You can connect your PayPal account with %s. To connect your account, you''ll be taken to paypal.com and once connected, you can make orders without leaving to paypal.com again. Note: We don''t save your PayPal password and the connection is enabled through PayPal standard alone. Anytime, you can disable the connection.', 0, 0, 0),
(1381, '2012-02-21 20:14:42', '2012-02-21 20:14:42', 42, 'You can not change default city name.', 'You can not change default city name.', 0, 0, 0),
(1382, '2012-02-21 20:14:56', '2012-02-21 20:14:56', 42, 'You can post video URL from YouTube, Vimeo etc.', 'You can post video URL from YouTube, Vimeo etc.', 0, 0, 0),
(1383, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'You can use this to update cart status. This will be used in the scenario where cron is not working.', 'You can use this to update cart status. This will be used in the scenario where cron is not working.', 0, 0, 0),
(1384, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'You can use this to update daily status. This will be used in the scenario where cron is not working.', 'You can use this to update daily status. This will be used in the scenario where cron is not working.', 0, 0, 0),
(1385, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'You cannot able to cancel other users or completed orders. Please try again.', 'You cannot able to cancel other users or completed orders. Please try again.', 0, 0, 0),
(1386, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'You cannot able to delete in process/shipped/completed order.', 'You cannot able to delete in process/shipped/completed order.', 0, 0, 0),
(1387, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'You cannot able to purchase other users or paid orders. Please try again.', 'You cannot able to purchase other users or paid orders. Please try again.', 0, 0, 0),
(1388, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'You cannot add your IP address. Please, try again', 'You cannot add your IP address. Please, try again', 0, 0, 0),
(1389, '2012-02-21 20:14:30', '2012-02-21 20:14:30', 42, 'You cannot add your own domain in redirect URL', 'You cannot add your own domain in redirect URL', 0, 0, 0),
(1390, '2012-02-21 20:14:17', '2012-02-21 20:14:17', 42, 'You cannot add your own domain. Please, try again', 'You cannot add your own domain. Please, try again', 0, 0, 0),
(1391, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'You cannot vote your product', 'You cannot vote your product', 0, 0, 0),
(1392, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'You have', 'You have', 0, 0, 0),
(1393, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'You have already voted this product', 'You have already voted this product', 0, 0, 0),
(1394, '2012-02-21 20:14:21', '2012-02-21 20:14:21', 42, 'You have no authorized to view this page', 'You have no authorized to view this page', 0, 0, 0),
(1395, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'You have not yet activated your account. Please activate it. If you have not received the activation mail, %s to resend the activation mail.', 'You have not yet activated your account. Please activate it. If you have not received the activation mail, %s to resend the activation mail.', 0, 0, 0),
(1396, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'You have successfully activated and logged in to your account.', 'You have successfully activated and logged in to your account.', 0, 0, 0),
(1397, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'You have successfully activated your account. But you can login after admin activate your account.', 'You have successfully activated your account. But you can login after admin activate your account.', 0, 0, 0),
(1398, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'You have successfully activated your account. Now you can login with your %s.', 'You have successfully activated your account. Now you can login with your %s.', 0, 0, 0),
(1399, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'You have successfully connected with twitter.', 'You have successfully connected with twitter.', 0, 0, 0),
(1400, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'You have successfully registered with our site and your activation mail has been sent to your mail inbox.', 'You have successfully registered with our site and your activation mail has been sent to your mail inbox.', 0, 0, 0),
(1401, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'You have successfully registered with our site.', 'You have successfully registered with our site.', 0, 0, 0),
(1402, '2012-02-21 20:14:32', '2012-02-21 20:14:32', 42, 'You must agree to the terms and policies', 'You must agree to the terms and policies', 0, 0, 0),
(1403, '2012-02-21 20:14:48', '2012-02-21 20:14:48', 42, 'You''ve used', 'You''ve used', 0, 0, 0),
(1404, '2012-02-21 20:14:53', '2012-02-21 20:14:53', 42, 'Your available balance:', 'Your available balance:', 0, 0, 0),
(1405, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Your cache is NOT working. Please check the settings in APP/config/core.php', 'Your cache is NOT working. Please check the settings in APP/config/core.php', 0, 0, 0),
(1406, '2012-02-21 20:14:52', '2012-02-21 20:14:52', 42, 'Your current available balance', 'Your current available balance', 0, 0, 0),
(1407, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Your current available balance:', 'Your current available balance:', 0, 0, 0),
(1408, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Your database configuration file is NOT present.', 'Your database configuration file is NOT present.', 0, 0, 0),
(1409, '2012-02-21 20:14:51', '2012-02-21 20:14:51', 42, 'Your database configuration file is present.', 'Your database configuration file is present.', 0, 0, 0),
(1410, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, 'Your Hostname: ', 'Your Hostname: ', 0, 0, 0),
(1411, '2012-02-21 20:14:37', '2012-02-21 20:14:37', 42, 'Your IP: ', 'Your IP: ', 0, 0, 0),
(1412, '2012-02-21 20:14:32', '2012-02-21 20:14:32', 42, 'Your old password is incorrect, please try again', 'Your old password is incorrect, please try again', 0, 0, 0),
(1413, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'Your password has been changed successfully, Please login now', 'Your password has been changed successfully, Please login now', 0, 0, 0),
(1414, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'Your password has been changed successfully. Please login now', 'Your password has been changed successfully. Please login now', 0, 0, 0),
(1415, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Your payment has been canceled.', 'Your payment has been canceled.', 0, 0, 0),
(1416, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Your payment has been successfully completed.', 'Your payment has been successfully completed.', 0, 0, 0),
(1417, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Your PayPal account is empty, so click here to update PayPal account in your profile.', 'Your PayPal account is empty, so click here to update PayPal account in your profile.', 0, 0, 0),
(1418, '2012-02-21 20:14:28', '2012-02-21 20:14:28', 42, 'Your registration process is not completed. Please, try again.', 'Your registration process is not completed. Please, try again.', 0, 0, 0),
(1419, '2012-02-21 20:14:29', '2012-02-21 20:14:29', 42, 'Your Twitter credentials are updated', 'Your Twitter credentials are updated', 0, 0, 0),
(1420, '2012-02-21 20:14:24', '2012-02-21 20:14:24', 42, 'Your wallet has insufficient money', 'Your wallet has insufficient money', 0, 0, 0),
(1421, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Zip Code', 'Zip Code', 0, 0, 0),
(1422, '2012-02-21 20:14:49', '2012-02-21 20:14:49', 42, 'Zip code: ', 'Zip code: ', 0, 0, 0),
(1423, '2012-02-21 20:14:59', '2012-02-21 20:14:59', 42, 'Zipcode', 'Zipcode', 0, 0, 0);



-- --------------------------------------------------------

--
-- Table structure for table `unions`
--

DROP TABLE IF EXISTS `unions`;
CREATE TABLE IF NOT EXISTS `unions` (
  `id` int(11) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unions`
--

INSERT INTO `unions` (`id`, `created`, `modified`, `name`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'European'),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'ASEAN+');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_type_id` int(5) unsigned NOT NULL,
  `attachment_id` bigint(20) NOT NULL default '1',
  `username` varchar(255) collate utf8_unicode_ci default NULL,
  `email` varchar(255) collate utf8_unicode_ci default NULL,
  `password` varchar(100) collate utf8_unicode_ci default NULL,
  `referred_amount` double(10,2) NOT NULL,
  `available_balance_amount` double(10,2) NOT NULL,
  `blocked_amount` double(10,2) NOT NULL,
  `twitter_user_id` bigint(20) NOT NULL default '0',
  `fb_user_id` bigint(20) default NULL,
  `fb_access_token` varchar(255) collate utf8_unicode_ci default NULL,
  `referred_by_user_id` bigint(20) default NULL,
  `referred_by_user_count` bigint(20) NOT NULL default '0',
  `is_yahoo_register` bigint(20) NOT NULL,
  `is_gmail_register` bigint(20) NOT NULL,
  `is_facebook_register` tinyint(1) NOT NULL default '0',
  `is_twitter_register` tinyint(1) NOT NULL default '0',
  `user_openid_count` bigint(20) unsigned NOT NULL,
  `user_login_count` bigint(20) unsigned NOT NULL,
  `user_view_count` bigint(20) unsigned NOT NULL,
  `user_cash_withdrawal_count` bigint(20) NOT NULL,
  `user_address_count` bigint(20) NOT NULL,
  `product_view_count` bigint(20) NOT NULL,
  `product_download_count` bigint(20) NOT NULL,
  `product_count` bigint(20) NOT NULL,
  `product_draft_count` bigint(20) NOT NULL,
  `product_upcoming_count` bigint(20) NOT NULL,
  `product_open_count` bigint(20) NOT NULL,
  `product_closed_count` bigint(20) NOT NULL,
  `product_canceled_count` bigint(20) NOT NULL,
  `product_awaiting_approval_count` bigint(20) NOT NULL,
  `product_rejected_count` bigint(20) NOT NULL,
  `sales_cleared_count` bigint(20) NOT NULL,
  `sales_cleared_amount` double(10,2) NOT NULL,
  `sales_pending_count` bigint(20) NOT NULL,
  `sales_pending_amount` double(10,2) NOT NULL,
  `sales_lost_count` bigint(20) NOT NULL,
  `sales_lost_amount` double(10,2) NOT NULL,
  `seller_order_count` bigint(20) NOT NULL,
  `seller_order_payment_pending_count` bigint(20) NOT NULL,
  `seller_order_inprocess_count` bigint(20) NOT NULL,
  `seller_order_expired_count` bigint(20) NOT NULL,
  `seller_order_canceled_count` bigint(20) NOT NULL,
  `seller_order_shipped_count` bigint(20) NOT NULL,
  `seller_order_completed_count` bigint(20) NOT NULL,
  `buyer_order_count` bigint(20) NOT NULL,
  `buyer_order_payment_pending_count` bigint(20) NOT NULL,
  `buyer_order_inprocess_count` bigint(20) NOT NULL,
  `buyer_order_expired_count` bigint(20) NOT NULL,
  `buyer_order_canceled_count` bigint(20) NOT NULL,
  `buyer_order_shipped_count` bigint(20) NOT NULL,
  `buyer_order_completed_count` bigint(20) NOT NULL,
  `order_item_count` bigint(20) NOT NULL,
  `cookie_hash` varchar(50) collate utf8_unicode_ci default NULL,
  `cookie_time_modified` datetime NOT NULL,
  `is_openid_register` tinyint(1) NOT NULL default '0',
  `is_agree_terms_conditions` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_email_confirmed` tinyint(1) NOT NULL,
  `is_referral_amount_given` tinyint(1) NOT NULL default '0',
  `ip_id` bigint(20) default NULL,
  `last_login_ip_id` bigint(15) default NULL,
  `last_logged_in_time` datetime NOT NULL,
  `total_amount_withdrawn` double(10,2) NOT NULL,
  `total_withdraw_request_count` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_type_id` (`user_type_id`),
  KEY `username` (`username`),
  KEY `email` (`email`),
  KEY `fb_user_id` (`fb_user_id`),
  KEY `referred_by_user_id` (`referred_by_user_id`),
  KEY `twitter_user_id` (`twitter_user_id`),
  KEY `attachment_id` (`attachment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User Details';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created`, `modified`, `user_type_id`, `attachment_id`, `username`, `email`, `password`, `referred_amount`, `available_balance_amount`, `blocked_amount`, `twitter_user_id`, `fb_user_id`, `fb_access_token`, `referred_by_user_id`, `referred_by_user_count`, `is_yahoo_register`, `is_gmail_register`, `is_facebook_register`, `is_twitter_register`, `user_openid_count`, `user_login_count`, `user_view_count`, `user_cash_withdrawal_count`, `user_address_count`, `product_view_count`, `product_download_count`, `product_count`, `product_draft_count`, `product_upcoming_count`, `product_open_count`, `product_closed_count`, `product_canceled_count`, `product_awaiting_approval_count`, `product_rejected_count`, `sales_cleared_count`, `sales_cleared_amount`, `sales_pending_count`, `sales_pending_amount`, `sales_lost_count`, `sales_lost_amount`, `seller_order_count`, `seller_order_payment_pending_count`, `seller_order_inprocess_count`, `seller_order_expired_count`, `seller_order_canceled_count`, `seller_order_shipped_count`, `seller_order_completed_count`, `buyer_order_count`, `buyer_order_payment_pending_count`, `buyer_order_inprocess_count`, `buyer_order_expired_count`, `buyer_order_canceled_count`, `buyer_order_shipped_count`, `buyer_order_completed_count`, `order_item_count`, `cookie_hash`, `cookie_time_modified`, `is_openid_register`, `is_agree_terms_conditions`, `is_active`, `is_email_confirmed`, `is_referral_amount_given`, `ip_id`, `last_login_ip_id`, `last_logged_in_time`, `total_amount_withdrawn`, `total_withdraw_request_count`) VALUES
(1, '2011-09-21 09:53:13', '2012-03-01 06:00:03', 1, 1, 'admin', 'productdemo.admin@gmail.com', 'df250333cfb72ae1fc70c47880fc514af892bfea', 0.00, 89448.00, 132.00, 0, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 44, 1, 0, 0, 71, 0, 56, 3, 2, 47, 1, 3, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, 9, 2, 2, 1, 1, 1, 2, 1, 0, 0, 0, 0, 1, 0, 0, '0682b4ee5683deadfc5c3d56d73e947f', '2012-02-28 07:03:57', 0, 1, 1, 1, 0, 1, 3, '2012-03-02 04:57:21', 85.00, 2),
(2, '2011-09-21 09:53:13', '2012-03-01 06:00:03', 2, 1, 'user', 'productdemo.user@gmail.com', 'df250333cfb72ae1fc70c47880fc514af892bfea', 0.00, 8546.00, 0.00, 0, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 25, 4, 0, 1, 34, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 1, 1000.00, 1, 450.00, 1, 0, 0, 0, 0, 0, 0, 9, 2, 2, 1, 1, 1, 2, 9, NULL, '0000-00-00 00:00:00', 0, 1, 1, 1, 0, NULL, 3, '2012-03-02 05:08:11', 0.00, 0),
(3, '2011-09-21 09:53:13', '2012-02-28 06:44:11', 2, 1, 'user1', 'k.sakthivel+user1@agriya.in', 'df250333cfb72ae1fc70c47880fc514af892bfea', 0.00, 150.00, 17.00, 0, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 7, 6, 0, 0, 26, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 74.40, 1, 74.40, 1, 74.40, 1, 0, 0, 0, 0, 1, 0, 3, 0, 0, 0, 1, 1, 1, 3, NULL, '0000-00-00 00:00:00', 0, 1, 1, 1, 0, NULL, 1, '2012-03-01 02:32:45', 26.00, 5),
(4, '2011-09-21 09:53:13', '2011-09-21 09:53:13', 2, 1, 'user2', 'productdemo.user+user2@gmail.com', 'df250333cfb72ae1fc70c47880fc514af892bfea', 0.00, 0.00, 0.00, 0, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '0000-00-00 00:00:00', 0, 1, 1, 1, 0, NULL, 1, '2012-03-01 06:29:25', 0.00, 0),
(5, '2011-09-21 09:53:13', '2012-02-23 07:14:27', 2, 1, 'user3', 'productdemo.user+user3@gmail.com', 'df250333cfb72ae1fc70c47880fc514af892bfea', 0.00, 0.00, 0.00, 0, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, NULL, '0000-00-00 00:00:00', 0, 1, 1, 1, 0, NULL, NULL, '0000-00-00 00:00:00', 0.00, 0),
(6, '2011-09-21 09:53:13', '2011-09-21 09:53:13', 2, 1, 'user4', 'productdemo.user+user4@gmail.com', 'df250333cfb72ae1fc70c47880fc514af892bfea', 0.00, 0.00, 0.00, 0, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '0000-00-00 00:00:00', 0, 1, 1, 1, 0, NULL, NULL, '0000-00-00 00:00:00', 0.00, 0),
(7, '2011-09-21 09:53:13', '2011-09-21 09:53:13', 2, 1, 'user5', 'productdemo.user+user5@gmail.com', '7c5a59c6e28d27b9da3ff8dc720836a2f9a7cc74', 0.00, 0.00, 0.00, 0, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '0000-00-00 00:00:00', 0, 1, 0, 1, 0, NULL, 1, '2012-02-03 10:25:49', 0.00, 0),
(8, '2012-02-27 07:41:23', '2012-02-27 07:41:23', 2, 1, 'admin56', 'k.sakthivel+contestowner@agriya.in', '74118a92086a608b86454288dbc9aaa35e1f01e4', 0.00, 0.00, 0.00, 0, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '0000-00-00 00:00:00', 0, 1, 1, 1, 0, 11982, NULL, '0000-00-00 00:00:00', 0.00, 0),
(9, '2012-02-27 09:11:07', '2012-02-27 09:11:07', 2, 1, 'demo', 'productdemo.r+emplo5@gmail.com', 'df250333cfb72ae1fc70c47880fc514af892bfea', 0.00, 0.00, 0.00, 0, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '0000-00-00 00:00:00', 0, 1, 1, 1, 0, 122183, NULL, '0000-00-00 00:00:00', 0.00, 0),
(10, '2012-02-29 06:14:16', '2012-02-29 06:14:16', 2, 1, 'semtree', 'sakthi.test1@gmail.com', '8f6bb6128f09975135f626494b67a46bb2d28720', 0.00, 0.00, 0.00, 0, 100000608443070, 'AAADhDKUSZBZCMBAN3PBLHBLTuSFiWPKTfKtpnvV3NuOtD6t1qZBwLbXN6jGFn2WLZATXw493NtmYZCdCVridwOhQWQJI48PW9hz6jk5C7AwZDZD', NULL, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '0000-00-00 00:00:00', 0, 1, 1, 1, 0, 122183, NULL, '0000-00-00 00:00:00', 0.00, 0),
(11, '2012-02-29 06:54:01', '2012-02-29 07:57:39', 2, 1, 'demouser1', 'k.sakthivel+twitter@agriya.in', '98dfeab81d5fcb301a93971ed2c4f8e17cb7e522', 0.00, 0.00, 0.00, 75254727, NULL, NULL, NULL, 0, 0, 0, 0, 1, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '0000-00-00 00:00:00', 0, 1, 1, 1, 0, 122183, 2, '2012-02-29 07:57:39', 0.00, 0),
(12, '2012-02-29 06:58:29', '2012-02-29 06:58:29', 2, 1, 'gmail2', 'k.sakthivel+gmail@agriya.in', '410e1530ab5db8950afe5300169a3bfb64f25e76', 0.00, 0.00, 0.00, 0, NULL, NULL, NULL, 0, 0, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '0000-00-00 00:00:00', 0, 1, 1, 1, 0, 122183, 2, '2012-02-29 06:58:30', 0.00, 0),
(13, '2012-02-29 07:56:26', '2012-02-29 07:56:26', 2, 1, 'dev', 'dev1.ahsan@gmail.com', '0cb8fc363a8166ac3eb977419e18bbef0ed058d5', 0.00, 0.00, 0.00, 0, 100000235263789, 'AAADhDKUSZBZCMBAPblsUFOOLLgmEyqAQ8rZCWuyZBzZCAlunAEizAfsKCFfivReEGPAmzp0PePsZCzLiyJvdvRWRxxeAISfpKqECophPQSqwZDZD', NULL, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '0000-00-00 00:00:00', 0, 1, 1, 1, 0, 122183, NULL, '0000-00-00 00:00:00', 0.00, 0),
(14, '2012-02-29 07:58:59', '2012-02-29 07:58:59', 2, 1, 'user112', 'ramkumar@c.com', 'e2fda359e11290c92b8843f7282312d8a5361d72', 0.00, 0.00, 0.00, 0, NULL, NULL, NULL, 0, 1, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '0000-00-00 00:00:00', 0, 1, 1, 1, 0, 11982, 1, '2012-02-29 07:58:59', 0.00, 0);




-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

DROP TABLE IF EXISTS `user_addresses`;
CREATE TABLE IF NOT EXISTS `user_addresses` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `full_name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `address` varchar(1000) collate utf8_unicode_ci NOT NULL,
  `city_id` bigint(20) NOT NULL,
  `state_id` bigint(20) default '0',
  `country_id` bigint(20) NOT NULL,
  `zipcode` varchar(25) collate utf8_unicode_ci NOT NULL,
  `phone` varchar(25) collate utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL default '0',
  `is_primary` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `city_id` (`city_id`),
  KEY `state_id` (`state_id`),
  KEY `country_id` (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `created`, `modified`, `user_id`, `full_name`, `address`, `city_id`, `state_id`, `country_id`, `zipcode`, `phone`, `is_active`, `is_primary`) VALUES
(1, '2012-02-27 08:06:50', '2012-02-27 08:06:50', 3, '', 'Chennai, Tamil Nadu, India', 42551, 71, 109, '600046', '9976241729', 1, 0),
(2, '2012-02-29 08:21:01', '2012-02-29 08:23:08', 2, '', 'Delaware, USA', 42553, 29, 253, '74027', '0445879456', 1, 1);



-- --------------------------------------------------------

--
-- Table structure for table `user_cash_withdrawals`
--

DROP TABLE IF EXISTS `user_cash_withdrawals`;
CREATE TABLE IF NOT EXISTS `user_cash_withdrawals` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `withdrawal_status_id` bigint(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `remark` text collate utf8_unicode_ci,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `withdrawal_status_id` (`withdrawal_status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_cash_withdrawals`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

DROP TABLE IF EXISTS `user_logins`;
CREATE TABLE IF NOT EXISTS `user_logins` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `ip_id` bigint(20) NOT NULL default '0',
  `user_agent` varchar(500) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `ip_id` (`ip_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User Login Details';

--
-- Dumping data for table `user_logins`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

DROP TABLE IF EXISTS `user_notifications`;
CREATE TABLE IF NOT EXISTS `user_notifications` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `user_id` bigint(20) default NULL,
  `is_mail_alert_for_shipped_item` tinyint(1) default NULL,
  `is_mail_alert_for_refunded_item` tinyint(1) default NULL,
  `is_mail_alert_for_purchased_item` tinyint(1) default '1',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_notifications`
--

INSERT INTO `user_notifications` (`id`, `created`, `modified`, `user_id`, `is_mail_alert_for_shipped_item`, `is_mail_alert_for_refunded_item`, `is_mail_alert_for_purchased_item`) VALUES
(1, '2011-09-26 12:21:14', '2011-09-28 09:42:48', 3, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_openids`
--

DROP TABLE IF EXISTS `user_openids`;
CREATE TABLE IF NOT EXISTS `user_openids` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `openid` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User OpenID Details';

--
-- Dumping data for table `user_openids`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

DROP TABLE IF EXISTS `user_profiles`;
CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `paypal_account` varchar(500) collate utf8_unicode_ci NOT NULL,
  `language_id` bigint(20) default NULL,
  `first_name` varchar(100) collate utf8_unicode_ci default NULL,
  `last_name` varchar(100) collate utf8_unicode_ci default NULL,
  `middle_name` varchar(100) collate utf8_unicode_ci default NULL,
  `gender_id` int(2) NOT NULL,
  `dob` date NOT NULL,
  `about_me` text collate utf8_unicode_ci,
  `address` varchar(500) collate utf8_unicode_ci default NULL,
  `city_id` bigint(20) NOT NULL,
  `state_id` bigint(20) default '0',
  `country_id` bigint(20) NOT NULL,
  `zip_code` int(10) default NULL,
  `phone` varchar(250) collate utf8_unicode_ci default NULL,
  `message_page_size` int(3) unsigned NOT NULL default '0',
  `message_signature` text collate utf8_unicode_ci,
  PRIMARY KEY  (`id`),
  KEY `city_id` (`city_id`),
  KEY `state_id` (`state_id`),
  KEY `country_id` (`country_id`),
  KEY `gender_id` (`gender_id`),
  KEY `user_id` (`user_id`),
  KEY `language_id` (`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User Profile Details';

--
-- Dumping data for table `user_profiles`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
CREATE TABLE IF NOT EXISTS `user_types` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `name` varchar(250) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User Type Details';

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `created`, `modified`, `name`) VALUES
(1, NULL, NULL, 'admin'),
(2, NULL, NULL, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_views`
--

DROP TABLE IF EXISTS `user_views`;
CREATE TABLE IF NOT EXISTS `user_views` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `viewing_user_id` bigint(20) default NULL,
  `ip_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `viewing_user_id` (`viewing_user_id`),
  KEY `ip_id` (`ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User View Details';

--
-- Dumping data for table `user_views`
--


-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_statuses`
--

DROP TABLE IF EXISTS `withdrawal_statuses`;
CREATE TABLE IF NOT EXISTS `withdrawal_statuses` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `user_cash_withdrawal_count` bigint(20) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `withdrawal_statuses`
--

INSERT INTO `withdrawal_statuses` (`id`, `created`, `modified`, `name`, `user_cash_withdrawal_count`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Pending', 1),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Approved', 0),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Rejected', 0),
(4, '2010-04-15 14:20:17', '2010-04-15 14:20:17', 'Failed', 0),
(5, '2010-04-15 14:20:17', '2010-04-15 14:20:17', 'Success', 0);


-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `parent_id` int(10) default NULL,
  `lft` int(10) default NULL,
  `rght` int(10) default NULL,
  `name` varchar(255) collate utf8_unicode_ci default '',
  `description` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_photos`
--

DROP TABLE IF EXISTS `category_photos`;
CREATE TABLE IF NOT EXISTS `category_photos` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `url` varchar(255) collate utf8_unicode_ci NOT NULL,
  `title` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category_photos`
--

-- --------------------------------------------------------

--
-- Table structure for table `landing_page_photos`
--

DROP TABLE IF EXISTS `landing_page_photos`;
CREATE TABLE IF NOT EXISTS `landing_page_photos` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `url` varchar(255) collate utf8_unicode_ci NOT NULL,
  `title` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `landing_page_photos`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) unsigned default NULL,
  `first_name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) collate utf8_unicode_ci default NULL,
  `email` varchar(255) collate utf8_unicode_ci NOT NULL,
  `subject` varchar(255) collate utf8_unicode_ci default NULL,
  `message` text collate utf8_unicode_ci NOT NULL,
  `telephone` varchar(20) collate utf8_unicode_ci default NULL,
  `ip_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contacts`
--

-- --------------------------------------------------------

--
-- Table structure for table `money_transfer_accounts`
--

CREATE TABLE IF NOT EXISTS `money_transfer_accounts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `payment_gateway_id` int(11) NOT NULL,
  `account` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`payment_gateway_id`),
  KEY `is_default` (`is_default`),
  KEY `payment_gateway_id` (`payment_gateway_id`)
);
