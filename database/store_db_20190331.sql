-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: store_db
-- ------------------------------------------------------
-- Server version	5.7.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banners` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avail_flg` smallint(5) unsigned DEFAULT '1',
  `status` smallint(5) unsigned DEFAULT '0',
  `select_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,'https://cdn.tgdd.vn/qcao/22_03_2019_22_17_47_800-300.png','','',NULL,1,1,'use_image','2019-03-24 23:08:57','2019-03-24 23:08:57'),(2,'https://cdn.tgdd.vn/qcao/18_03_2019_16_27_36_Big-huawei800-300.png','','',NULL,1,1,'use_image','2019-03-24 23:09:27','2019-03-24 23:09:27'),(3,'https://cdn.tgdd.vn/qcao/28_02_2019_23_05_06_800x300.png','','',NULL,1,1,'use_image','2019-03-24 23:09:39','2019-03-24 23:09:39'),(4,'https://cdn.tgdd.vn/qcao/20_03_2019_09_57_58_800-300.png','','',NULL,1,1,'use_image','2019-03-24 23:09:57','2019-03-24 23:09:57'),(7,'','','','ZtUD5mTtyWg',1,1,'use_youtube','2019-03-27 20:46:32','2019-03-27 23:13:08'),(9,'','','','ZuW5ycUro6U',1,1,'use_youtube','2019-03-27 21:47:00','2019-03-27 21:47:00'),(11,'','','','rAu3q4goZow',1,1,'use_youtube','2019-03-27 22:01:28','2019-03-27 22:01:28'),(12,'','','','eWZA-gPBC4k',1,1,'use_youtube','2019-03-27 23:05:09','2019-03-27 23:05:09'),(13,'https://bizweb.dktcdn.net/100/308/325/themes/665783/assets/slider_1.jpg?1547035845538','','',NULL,1,0,'use_image','2019-03-30 09:27:48','2019-03-30 09:27:48');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` smallint(5) unsigned DEFAULT '0',
  `avail_flg` smallint(5) unsigned DEFAULT '1',
  `status` smallint(5) unsigned DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Điện thoại','dien-thoai',0,1,1,'2019-03-24 19:30:31','2019-03-24 19:30:31'),(2,'Laptop','laptop',0,1,1,'2019-03-24 19:30:36','2019-03-24 19:30:36'),(3,'Tablet','tablet',0,1,1,'2019-03-24 19:30:41','2019-03-24 19:30:41'),(4,'Phụ kiện','phu-kien',0,1,1,'2019-03-24 19:30:50','2019-03-24 19:30:50'),(5,'Đồng hồ','dong-ho',0,1,1,'2019-03-24 19:30:57','2019-03-24 19:30:57'),(6,'Cũ giá rẻ','cu-gia-re',0,1,1,'2019-03-24 19:31:04','2019-03-24 19:31:04'),(7,'Công nghệ','cong-nghe',0,1,1,'2019-03-24 23:10:36','2019-03-24 23:10:36');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint(5) unsigned DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colors`
--

LOCK TABLES `colors` WRITE;
/*!40000 ALTER TABLE `colors` DISABLE KEYS */;
INSERT INTO `colors` VALUES (1,'#572727',1,'2019-03-24 19:41:21','2019-03-24 19:41:21'),(2,'#2fd115',1,'2019-03-24 19:41:32','2019-03-24 19:41:32'),(3,'#421b30',1,'2019-03-24 19:41:42','2019-03-24 19:41:42');
/*!40000 ALTER TABLE `colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `author_id` int(10) unsigned DEFAULT NULL,
  `thread_id` int(10) unsigned DEFAULT NULL,
  `reply_id` int(10) unsigned DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `web_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `web_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `web_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `web_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `web_ico` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `web_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `mail_driver` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'smtp',
  `mail_host` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'smtp.gmail.com',
  `mail_port` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '587',
  `mail_from` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'admin@admin.com',
  `mail_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'System',
  `mail_encryption` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'tls',
  `mail_account` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT 'admin@gmail.com',
  `mail_password` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT '123456789',
  `banners_image_size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '698x328',
  `vendors_image_size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '120x45',
  `products_image_size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '207x268',
  `posts_image_size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '100x100',
  `web_logo_image_size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '224x151',
  `users_image_size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '25x25',
  `banners_maximum_upload` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '51200',
  `vendors_maximum_upload` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '51200',
  `products_maximum_upload` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '51200',
  `posts_maximum_upload` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '51200',
  `attachment_maximum_upload` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '51200',
  `web_logo_maximum_upload` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '51200',
  `users_maximum_upload` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '51200',
  `off` int(11) DEFAULT '1',
  `url_ext` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '.html',
  `bank_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `cash_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `web_ico_image_size` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web_ico_maximum_upload` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES (1,'Store Local','','','https://bizweb.dktcdn.net/100/308/325/themes/665783/assets/logo.png?1547035845538','ico/1553497712_ico.png','thai.vuong@primelabo.com.vn','smtp','smtp.gmail.com','587','admin@admin.com','System','tls','admin@gmail.com','123456789','847x412','120x45','200x200','100x100','232x58','160x160','51200','51200','51200','51200','51200','51200','51200',0,'','','',NULL,NULL,'90x90','51200');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci,
  `reply_content` text COLLATE utf8mb4_unicode_ci,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avail_flg` smallint(5) unsigned DEFAULT '1',
  `status` smallint(5) unsigned DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'Lưu An Nhiên','thai.vuong@primelabo.com.vn','0779924902','Nhờ báo giá sản phẩm','Báo giá sản phẩ','<p>YYYYYYYYYYYYYYYYYYYYY</p>',NULL,1,0,'2019-03-25 01:15:21','2019-03-25 01:29:59');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` int(10) unsigned DEFAULT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images_product`
--

DROP TABLE IF EXISTS `images_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images_product`
--

LOCK TABLES `images_product` WRITE;
/*!40000 ALTER TABLE `images_product` DISABLE KEYS */;
INSERT INTO `images_product` VALUES (9,1,'https://cdn.tgdd.vn/Products/Images/42/190321/iphone-xs-max-gray-400x400.jpg'),(10,1,'https://cdn.tgdd.vn/Products/Images/42/190323/iphone-xs-gold-400x400.jpg'),(11,2,'https://cdn.tgdd.vn/Products/Images/42/190323/iphone-xs-gold-400x400.jpg'),(12,2,'https://cdn.tgdd.vn/Products/Images/42/190324/iphone-xs-256gb-white-600x600.jpg'),(13,2,'https://cdn.tgdd.vn/Products/Images/42/190321/iphone-xs-max-gray-400x400.jpg'),(14,6,'image/1553489386_iphone-8-plus-hh-600x600.jpg'),(16,6,'https://cdn.tgdd.vn/Products/Images/42/114114/iphone-8-plus-256gb-red-600x600.jpg'),(21,10,'https://cdn.tgdd.vn/Products/Images/42/196963/samsung-galaxy-a50-black-400x400.jpg'),(23,11,'https://cdn.tgdd.vn/Products/Images/42/198791/oppo-f11-pro-mtp-400x400.jpg'),(24,12,'https://cdn.tgdd.vn/Products/Images/58/86507/cap-micro-1m-esaver-ds118br-tb-avatar-1-600x600.jpg'),(25,13,'https://cdn.tgdd.vn/Products/Images/42/198985/huawei-p30-lite-1-400x400.jpg');
/*!40000 ALTER TABLE `images_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(5) unsigned DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'Lưu An Nhiên','annhien@gmail.com','$2y$10$7G4oqdC9csfUag8mK.zlP.epWkiOg5kAQCRKJA9RcVVofwFa1PvH2','https://scontent.fsgn5-3.fna.fbcdn.net/v/t1.0-1/p160x160/30739181_785746534949274_5513401757931487562_n.jpg?_nc_cat=110&_nc_oc=AQn759zcnPgZCKg75W96SZzaVyiAqwC-edJD-Bcc9QprqVQtex196JNIMouvo86Tj5V2gYTtWF7P6jtNr4p86NPM&_nc_ht=scontent.fsgn5-3.fna&oh=c3208b1e429d00ea3b88cb29a859aa32&oe=5D3FA411',1,NULL,'2019-03-30 01:05:00','2019-03-30 01:05:00');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_01_21_135603_create_products_table',1),(4,'2019_01_21_135616_create_categories_table',1),(5,'2019_01_21_135626_create_vendors_table',1),(6,'2019_01_21_135638_create_banners_table',1),(7,'2019_01_21_135650_create_contacts_table',1),(8,'2019_01_21_135701_create_posts_table',1),(9,'2019_01_21_135729_create_config_table',1),(10,'2019_01_28_071200_create_images_product_table',1),(11,'2019_02_04_140819_create_colors_table',1),(12,'2019_02_04_140831_create_sizes_table',1),(13,'2019_02_07_090624_create_pages_table',1),(14,'2019_02_10_040500_create_orders_table',1),(15,'2019_02_10_040558_create_order_details_table',1),(16,'2019_02_22_134709_create_customers_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_details` (
  `order_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `qty` int(10) unsigned NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `cost` decimal(10,0) NOT NULL,
  `sizes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `colors` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`order_id`,`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
INSERT INTO `order_details` VALUES (4,1,1,29990000,29990000,'','','2019-03-25 01:52:55','2019-03-25 01:52:55'),(5,6,1,25790000,25790000,'','','2019-03-25 01:56:22','2019-03-25 01:56:22'),(5,2,1,26990000,26990000,'','','2019-03-25 01:56:22','2019-03-25 01:56:22');
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `customer_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `payment_method` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `status` smallint(6) DEFAULT '0',
  `total` decimal(10,0) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'Phạm Văn Hai','phamvanhai@gmail.com','185/16 Nguyễn Lâm P6 Q10','0779924902','cash',2,29990000,'2019-03-25 01:51:00','2019-03-25 02:06:33'),(5,'Mai Văn Dễ','maivande@gmail.com','259 Nguyễn Tiểu La Q10','0779935647','cash',1,52780000,'2019-03-25 01:56:22','2019-03-25 02:05:12');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `name_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'','','<p>AAAAAAAAAAAAAAAAA</p>\r\n\r\n<p>AAAAAAAAAAAAAAAAA</p>\r\n\r\n<p>AAAAAAAAAAAAAAAAA</p>\r\n\r\n<p>AAAAAAAAAAAAAAAAA</p>\r\n\r\n<p>AAAAAAAAAAAAAAAAA</p>\r\n\r\n<p>AAAAAAAAAAAAAAAAA</p>\r\n\r\n<p>AAAAAAAAAAAAAAAAA</p>\r\n\r\n<p>AAAAAAAAAAAAAAAAA</p>','2019-03-31 06:02:58','2019-03-31 06:02:58');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_time_at` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avail_flg` smallint(5) unsigned DEFAULT '1',
  `status` smallint(5) unsigned DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'Quang Liêm giữ mạch thắng ở giải cờ vua Sharjah','quang-liem-giu-mach-thang-o-giai-co-vua-sharjah','Kỳ thủ số một Việt Nam cầm trắng hạ Ventakesh sau 57 nước cờ, ở ván ba hôm qua 24/3.','<p>L&ecirc; Quang Li&ecirc;m (Elo 2.715) tiếp tục chọn khai cuộc e4 trước Đại kiện tướng người Ấn Độ. Sau hơn chục năm gần như chỉ d&ugrave;ng khai cuộc d4, Si&ecirc;u đại kiện tướng dần thay đổi kể từ cuối năm 2018. Quang Li&ecirc;m hơn tốt ở trung cuộc v&agrave; giữ lợi thế để thắng trong t&agrave;n cuộc.</p>\r\n\r\n<table align=\"center\" border=\"0\" cellpadding=\"3\" cellspacing=\"0\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img alt=\"Quang Liêm toàn thắng ba ván đầu ở giải cờ Sharjah 2019.\" data-natural-h=\"338\" data-natural-width=\"500\" data-pwidth=\"500\" data-width=\"500\" src=\"https://i-thethao.vnecdn.net/2019/03/25/quang-liem-1553496957-1280-1553496986.png\" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Quang Li&ecirc;m to&agrave;n thắng ba v&aacute;n đầu ở giải cờ Sharjah 2019.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Với ba điểm trọn vẹn, Quang Li&ecirc;m đứng ở nh&oacute;m đầu c&ugrave;ng Ernesto Inarkiev (2.692), Alexandr Fier (2.551), Eduardo Iturrizaga (2.639) v&agrave; Nihal Sarin (2.578). Anh c&oacute; th&ecirc;m năm điểm Elo để b&ugrave; đắp cho số điểm bị mất ở&nbsp;<a href=\"https://vnexpress.net/the-thao/quang-liem-thang-ivanchuk-o-giai-co-vua-my-3892671.html\">giải cờ M&ugrave;a Xu&acirc;n</a>. Ở v&aacute;n bốn, Quang Li&ecirc;m cầm đen gặp Iturrizaga - Đại kiện tướng người Venezuela vừa dự giải cờ vua HDBank 2019.</p>\r\n\r\n<p>Đại diện c&ograve;n lại của Việt Nam - Kiện tướng quốc tế Nguyễn Anh Kh&ocirc;i (2.484) cầm đen h&ograve;a Alexander Zubov (2.605). Đ&acirc;y c&oacute; thể coi l&agrave; kết quả th&agrave;nh c&ocirc;ng với t&agrave;i năng trẻ của Việt Nam. Anh Kh&ocirc;i đang c&oacute; 2,5 điểm v&agrave; hiệu quả thi đấu (rating performance) 2.559. Để c&oacute; chuẩn Đại kiện tướng đầu ti&ecirc;n, kỳ thủ 17 tuổi cần cải thiện hiệu quả l&ecirc;n 2.600. Ở v&aacute;n bốn, Anh Kh&ocirc;i cầm trắng gặp Đại kiện tướng Surya Ganguly (2.633).</p>','https://i-thethao.vnecdn.net/2019/03/25/quang-liem-1553496957-1280-1553496986.png','20190325','0812',1,1,'2019-03-25 01:12:35','2019-03-25 01:12:35'),(2,'Nữ VĐV trượt băng lập kỳ tích xoay bốn vòng trên không','nu-vdv-truot-bang-lap-ky-tich-xoay-bon-vong-tren-khong','Elizabet Tursynbaeva là VĐV đầu tiên trên thế giới thực hiện thành công động tác quad Salchow tại giải VĐTG diễn ra ở Saitama, Nhật Bản hôm 22/3.','<p>&quot;Kh&ocirc;ng thể tin được l&agrave; t&ocirc;i đ&atilde; l&agrave;m được&quot;, Tursynbaeva n&oacute;i sau m&agrave;n tr&igrave;nh diễn gi&agrave;u&nbsp; cảm x&uacute;c. &quot;S&aacute;ng nay, t&ocirc;i tập luyện động t&aacute;c n&agrave;y ổn. Nhưng l&agrave;m được n&oacute; khi thi đấu l&agrave; điều ho&agrave;n to&agrave;n kh&aacute;c. T&ocirc;i đ&atilde; kh&ocirc;ng thể thực hiện quad Salchow ở hai kỳ giải v&ocirc; địch thế giới gần nhất. Vậy n&ecirc;n, t&ocirc;i rất hạnh ph&uacute;c với kỳ t&iacute;ch lần n&agrave;y&quot;.&nbsp;</p>\r\n\r\n<p>G&acirc;y ấn tượng mạnh với động t&aacute;c chưa ai l&agrave;m được trong lịch sử trượt băng nghệ thuật đỉnh cao, nhưng VĐV Kazakhstan lại kh&ocirc;ng thể với tới tấm HC v&agrave;ng. C&ocirc; g&aacute;i 19 tuổi gi&agrave;nh HC bạc với điểm 224,76. ĐKVĐ Olympic Alina Zagitova l&agrave; nh&agrave; v&ocirc; địch, với 237,5 điểm.</p>\r\n\r\n<table align=\"center\" border=\"0\" cellpadding=\"3\" cellspacing=\"0\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img alt=\"Nhà vô địch trượt băng thế giới 2019 Alina Zagitova mừng chiến thắng. Ảnh: AP.\" data-natural-h=\"500\" data-natural-width=\"500\" data-pwidth=\"500\" data-width=\"500\" src=\"https://i-thethao.vnecdn.net/2019/03/23/screen-shot-2019-03-23-at-9-31-2242-9445-1553351660.png\" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p>Nh&agrave; v&ocirc; địch trượt băng thế giới 2019 Alina Zagitova mừng chiến thắng. Ảnh:&nbsp;<em>AP</em>.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Tiếng vang tại giải thế giới tuần n&agrave;y c&oacute; thể đ&aacute;nh dấu bước tiến lớn trong sự nghiệp của Tursynbaeva. Trước khi dự giải đấu danh gi&aacute; nhất l&agrave;ng trượt băng, c&ocirc; đang xếp thứ 11 tr&ecirc;n bảng thứ bậc thế giới. Ở Olympic m&ugrave;a đ&ocirc;ng 2018, Tursynbaeva chỉ đứng thứ 12 trong số c&aacute;c VĐV tham dự.</p>','https://i-thethao.vnecdn.net/2019/03/23/screen-shot-2019-03-23-at-9-31-2242-9445-1553351660.png','','',1,1,'2019-03-25 01:13:50','2019-03-25 01:13:50');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_service_group`
--

DROP TABLE IF EXISTS `product_service_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_service_group` (
  `product_id` int(11) NOT NULL,
  `service_group_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`product_id`,`service_group_id`,`service_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_service_group`
--

LOCK TABLES `product_service_group` WRITE;
/*!40000 ALTER TABLE `product_service_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_service_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `vendor_id` int(10) unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sizes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colors` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` smallint(5) unsigned DEFAULT '0',
  `avail_flg` smallint(5) unsigned DEFAULT '1',
  `status` smallint(5) unsigned DEFAULT '0',
  `is_new` smallint(5) unsigned DEFAULT '0',
  `is_popular` smallint(5) unsigned DEFAULT '0',
  `is_best_selling` smallint(5) unsigned DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Iphone XS Max 64GB','iphone-xs-max-64gb','29990000',1,0,'','','',0,1,1,1,1,1,'2019-03-24 19:40:44','2019-03-24 19:59:11'),(2,'Iphone XS 64GB','iphone-xs-64gb','26990000',1,1,'<p>Nếu thang AQI vượt qu&aacute; 300 l&agrave; mức nguy hại, cảnh b&aacute;o sức khoẻ khẩn cấp, mọi người n&ecirc;n ở trong nh&agrave;.<br />\r\n<br />\r\n<em>TS Ho&agrave;ng Dương T&ugrave;ng, Chủ tịch Mạng lưới kh&ocirc;ng kh&iacute; sạch Việt Nam, nguy&ecirc;n Ph&oacute; Tổng cục trưởng Tổng cục M&ocirc;i trường, Bộ TN&amp;MT đ&aacute;nh gi&aacute;, từ đầu tuần đến nay, chất lượng kh&ocirc;ng kh&iacute; ở H&agrave; Nội k&eacute;m c&oacute; thể do c&ugrave;ng l&uacute;c kết hợp nhiều yếu tố.</em><br />\r\n<br />\r\nTrong đ&oacute; c&oacute; điều kiện kh&iacute; hậu kh&ocirc;ng thuận lợi, gi&oacute; lặng, c&oacute; thể xuất hiện hiện tượng nghịch nhiệt khiến kh&oacute;i bụi, chất &ocirc; nhiễm kh&ocirc;ng khuếch t&aacute;n l&ecirc;n được, bị giữ lại ở tầng thấp c&agrave;ng l&agrave;m kh&ocirc;ng kh&iacute; &ocirc; nhiễm trầm trọng.<br />\r\n<br />\r\nTheo TS T&ugrave;ng, khi n&oacute;i đến chất lượng kh&ocirc;ng kh&iacute;, người ta quan t&acirc;m h&agrave;ng đầu đến bụi mịn (PM2.5). Đ&acirc;y l&agrave; những hạt bụi si&ecirc;u nhỏ, c&oacute; k&iacute;ch cỡ nhỏ hơn 1/30 sợi t&oacute;c, c&oacute; thể theo đường thở v&agrave;o cơ thể v&agrave; ảnh hưởng trực tiếp đến sức khoẻ.<br />\r\n<br />\r\nTại H&agrave; Nội, hiện chỉ số PM2.5 đang cao hơn mức b&igrave;nh thường, c&ograve;n c&aacute;c chỉ số &ocirc; nhiễm kh&aacute;c về kh&ocirc;ng kh&iacute; như kh&iacute; CO, NO2, SO2, O3... vẫn ở ngưỡng cho ph&eacute;p.<br />\r\n<br />\r\nVề nguy&ecirc;n nh&acirc;n h&igrave;nh th&agrave;nh bụi mịn, TS T&ugrave;ng cho biết c&oacute; tới 60-70% do c&aacute;c phương tiện giao th&ocirc;ng, c&ograve;n lại do quản l&yacute; c&aacute;c c&ocirc;ng tr&igrave;nh x&acirc;y dựng kh&ocirc;ng tốt, bụi từ c&aacute;c nơi sản xuất xi măng, sắt th&eacute;p, ho&aacute; chất ở c&aacute;c tỉnh bay về H&agrave; Nội, bụi mịn cũng h&igrave;nh th&agrave;nh do đốt rơm rạ, đốt r&aacute;c.</p>','1,2,3,4','1,2,3',15,1,1,1,1,1,'2019-03-24 19:42:38','2019-03-30 00:42:14'),(9,'MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMv','mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmv','3000000',0,0,'','','',0,1,1,1,1,1,'2019-03-25 02:26:05',NULL),(6,'Iphone 8 Plus 256GB','iphone-8-plus-256gb','25790000',1,1,'','1','1',0,1,1,1,1,1,'2019-03-24 21:49:44','2019-03-24 21:54:25'),(10,'Samsung Galaxy S10','samsung-galaxy-s10','22990000',1,2,'','2,3','2,3',10,1,1,1,1,1,'2019-03-31 00:12:48','2019-03-31 00:30:48'),(11,'Oppo F11 Pro','oppo-f11-pro','8490000',1,3,'','','',0,1,1,1,1,1,'2019-03-31 09:41:44',NULL),(12,'Dây cáp Micro USB 1 m eSaver DS118-TB','day-cap-micro-usb-1-m-esaver-ds118-tb','51000',4,0,'','','',0,1,1,1,1,1,'2019-03-31 19:25:19',NULL),(13,'Huaweo P30 Lite','huaweo-p30-lite','7490000',1,5,'','','',0,1,1,1,1,1,'2019-03-31 23:21:55',NULL),(21,'Bánh bao','banh-bao','3000000',0,0,'','','',0,1,1,1,1,1,'2019-04-01 02:38:53','2019-04-01 03:26:03'),(20,'AAAAAAAAAAAAAA','aaaaaaaaaaaaaa','3000000',0,0,'','','',0,1,1,1,1,1,'2019-04-01 00:53:03',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_groups`
--

DROP TABLE IF EXISTS `service_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_groups`
--

LOCK TABLES `service_groups` WRITE;
/*!40000 ALTER TABLE `service_groups` DISABLE KEYS */;
INSERT INTO `service_groups` VALUES (12,'#1001','2019-04-01 02:38:53','2019-04-01 09:38:53'),(11,'#1002','2019-04-01 02:38:53','2019-04-01 09:38:53'),(10,'#1001','2019-04-01 02:38:53','2019-04-01 09:38:53'),(9,'#1003','2019-04-01 00:53:03','2019-04-01 07:53:03'),(13,'#1002','2019-04-01 02:38:53','2019-04-01 09:38:53'),(14,'#1001','2019-04-01 03:24:35','2019-04-01 10:24:35'),(15,'#1002','2019-04-01 03:24:35','2019-04-01 10:24:35'),(16,'Quán cháo lòng miền Nam','2019-04-01 03:26:03','2019-04-01 10:26:03'),(17,'#1002','2019-04-01 03:26:03','2019-04-01 10:26:03');
/*!40000 ALTER TABLE `service_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `service_group_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (7,'S2',12,NULL,20,9,'2019-04-01 00:53:03','2019-04-01 07:53:03'),(6,'S1',11,NULL,20,9,'2019-04-01 00:53:03','2019-04-01 07:53:03'),(8,'S1',11,NULL,0,10,'2019-04-01 02:38:53','2019-04-01 09:38:53'),(9,'S2',12,NULL,0,10,'2019-04-01 02:38:53','2019-04-01 09:38:53'),(10,'A1',33,NULL,0,11,'2019-04-01 02:38:53','2019-04-01 09:38:53'),(11,'A2',44,NULL,0,11,'2019-04-01 02:38:53','2019-04-01 09:38:53'),(25,'A2',44,NULL,21,17,'2019-04-01 03:26:03','2019-04-01 10:26:03'),(24,'A1',33,NULL,21,17,'2019-04-01 03:26:03','2019-04-01 10:26:03'),(23,'S1',11,NULL,21,16,'2019-04-01 03:26:03','2019-04-01 10:26:03'),(22,'D2',150000,NULL,21,16,'2019-04-01 03:26:03','2019-04-01 10:26:03'),(21,'D1',900000,NULL,21,16,'2019-04-01 03:26:03','2019-04-01 10:26:03');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sizes`
--

DROP TABLE IF EXISTS `sizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sizes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(10) unsigned DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sizes`
--

LOCK TABLES `sizes` WRITE;
/*!40000 ALTER TABLE `sizes` DISABLE KEYS */;
INSERT INTO `sizes` VALUES (1,'M',1,'2019-03-24 19:41:49','2019-03-24 19:41:49'),(2,'L',1,'2019-03-24 19:41:54','2019-03-24 19:41:54'),(3,'XL',1,'2019-03-24 19:41:59','2019-03-24 19:41:59'),(4,'XXL',1,'2019-03-24 19:42:08','2019-03-24 19:42:08'),(5,'XXXL',1,'2019-03-30 09:03:11','2019-03-30 09:03:11');
/*!40000 ALTER TABLE `sizes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `threads`
--

DROP TABLE IF EXISTS `threads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `threads` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` int(10) unsigned DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `group_id` int(11) DEFAULT NULL,
  `view_count` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `threads`
--

LOCK TABLES `threads` WRITE;
/*!40000 ALTER TABLE `threads` DISABLE KEYS */;
/*!40000 ALTER TABLE `threads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` smallint(5) unsigned DEFAULT '0',
  `status` smallint(5) unsigned DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Super Administrator','super.admin@admin.com','$2y$10$GnBOl0pIRDFuFkvalqnR8u0SipzOJqjlIVxcAWqZOVH4tfSTTIzq6','https://scontent.fsgn8-1.fna.fbcdn.net/v/t1.0-1/p160x160/36775518_1986722428007575_6243724851618512896_n.jpg?_nc_cat=102&_nc_oc=AQmrIf1jPrphuhm_0mb2I0DZRRYySqgWMIZmi0u5ZryI53cgUSAGzt5benGKhpYTvno&_nc_ht=scontent.fsgn8-1.fna&oh=1c3a6842acfbce0c793ef5699e7bbea7&oe=5D167979',0,0,'oGvTkHvrAPyycrYZEm6bMpcGAt5mP0ZSsPF6rPUFcHANXNg8rwbnvCBA4Cl1','2019-03-24 19:29:10','2019-03-27 21:32:59'),(2,'Quản trị viên','admin@admin.com','$2y$10$47NBELvC/IFRNPyT9Zl0FeF1Gvfq9dtEH4/TyAknuX75vGdH5jF6O','https://scontent.fsgn8-1.fna.fbcdn.net/v/t1.0-9/45672266_921657814691478_5571583059867729920_n.jpg?_nc_cat=102&_nc_oc=AQlNg9XyY0c0RruG5RFPkOTCT-K3SDFqwozaToqAt8TISRe-JnMUFt123TW_MwFzIBw&_nc_ht=scontent.fsgn8-1.fna&oh=77ed1fc466d3a05f0a82f1fe6715056a&oe=5D4DFC9B',1,1,'kodYxztAn8KnYqJwcH0YeZX3wL3WqHX4aaNiILrRjZFoHbRj5Kg8KT5YcIQ0','2019-03-24 19:29:10','2019-03-25 00:30:44'),(3,'Lưu Thái Vượng','thaivuong1503@gmail.com','$2y$10$BqiwtogOb//HAGqEa08fOOi2zZqlcPIB8ebkTopJM622476WlIF6.','https://scontent.fsgn2-2.fna.fbcdn.net/v/t1.0-1/p160x160/36775518_1986722428007575_6243724851618512896_n.jpg?_nc_cat=102&_nc_oc=AQl7N8iQvk9mmUbxUCcsbPRELPFFcli5svml2s-M4XRfXStxgqrIslAaNb8LOLyusnU&_nc_ht=scontent.fsgn2-2.fna&oh=4dbe9c1bd463470a4f32d61036057e70&oe=5D167979',2,1,'owqntMthK4TUrMsAiRBQybvtNbQjL6QWrZLetIHIBBOEA7ZMzpIRWThU0Ywn','2019-03-25 00:19:23','2019-03-25 00:19:23');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avail_flg` smallint(5) unsigned DEFAULT '1',
  `status` smallint(5) unsigned DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendors`
--

LOCK TABLES `vendors` WRITE;
/*!40000 ALTER TABLE `vendors` DISABLE KEYS */;
INSERT INTO `vendors` VALUES (1,'Apple','apple','https://cdn.tgdd.vn/Brand/1/iPhone-(Apple)42-b_16.jpg','',1,1,'2019-03-30 08:22:49','2019-03-30 08:22:49'),(2,'Samsung','samsung','https://cdn.tgdd.vn/Brand/1/Samsung42-b_25.jpg','',1,1,'2019-03-24 23:11:17','2019-03-24 23:11:17'),(3,'Oppo','oppo','https://cdn.tgdd.vn/Brand/1/OPPO42-b_23.jpg','',1,1,'2019-03-24 21:37:58','2019-03-24 21:37:58'),(4,'Nokia','nokia','https://cdn.tgdd.vn/Brand/1/Nokia42-b_21.jpg','',1,1,'2019-03-30 08:22:32','2019-03-30 08:22:32'),(5,'Huawei','huawei','https://cdn.tgdd.vn/Brand/1/Huawei42-b_22.png','',1,1,'2019-03-27 23:22:29','2019-03-27 23:22:29'),(6,'Xiaomi','xiaomi','https://cdn.tgdd.vn/Brand/1/Xiaomi42-b_31.png','',1,1,'2019-03-27 23:23:56','2019-03-27 23:23:56'),(7,'Vsmart','vsmart','https://cdn.tgdd.vn/Brand/1/Vsmart42-b_40.png','XXXXXXXXXXXXXXXXXXX',1,1,'2019-03-30 00:46:24','2019-03-30 00:46:24'),(8,'Vivo','vivo','https://cdn.tgdd.vn/Brand/1/Vivo42-b_26.jpg','',1,0,'2019-03-31 00:07:59','2019-03-31 00:07:59'),(9,'Philips','philips','vendor/1554016113_Philips42-b_24.jpg','',1,0,'2019-03-31 00:08:33','2019-03-31 00:08:33');
/*!40000 ALTER TABLE `vendors` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-01 17:27:48
