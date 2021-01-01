
DROP TABLE IF EXISTS `tbl_feeship` ;
CREATE TABLE `tbl_feeship` (
  `fee_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fee_matp` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee_maqh` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee_xa` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee_feeship` int(11) NOT NULL,
  PRIMARY KEY (`fee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tbl_province` ;
CREATE TABLE `tbl_province` (
  `maqh` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `matp` int(11) NOT NULL,
  PRIMARY KEY (`maqh`)
) ENGINE=InnoDB AUTO_INCREMENT=974 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tbl_city` ;
CREATE TABLE `tbl_city` (
  `matp` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`matp`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tbl_ward` ;
CREATE TABLE `tbl_ward` (
  `xaid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `maqh` int(11) NOT NULL,
  PRIMARY KEY (`xaid`)
) ENGINE=InnoDB AUTO_INCREMENT=32249 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tbl_admin` ;
CREATE TABLE `tbl_admin` (
  `admin_Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_pass` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_question_getpass` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`admin_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tbl_brand_code_product` ;
CREATE TABLE `tbl_brand_code_product` (
  `code_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brandcode_id` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brandcode_name` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`code_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tbl_category_product` ;
CREATE TABLE `tbl_category_product` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tbl_contact` ;
CREATE TABLE `tbl_contact` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Con_Name` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Con_Email` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Con_Content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tbl_count` ;
CREATE TABLE `tbl_count` (
  `id` int(11) NOT NULL,
  `counts` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tbl_customer` ;
CREATE TABLE `tbl_customer` (
  `cusid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cusname` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cusEmail` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cusadd` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cusPhone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cusNote` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`cusid`)
) ENGINE=InnoDB AUTO_INCREMENT=291 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tbl_info_contact` ;
CREATE TABLE `tbl_info_contact` (
  `id_Info` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `google_map` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `info_contact_add` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info_contact_phone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info_contact_mail` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_Info`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tbl_logo_website` ;
CREATE TABLE `tbl_logo_website` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `imgLogo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tbl_news` ;
CREATE TABLE `tbl_news` (
  `news_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `news_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tbl_orders` ;
CREATE TABLE `tbl_orders` (
  `orderid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cusid` int(11) NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee_ship` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`orderid`)
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tbl_product` ;
CREATE TABLE `tbl_product` (
  `product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `brandcode_id` int(11) NOT NULL,
  `product_Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_material` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_price_promotion` int(11) NOT NULL,
  `promotion_start_date` int(11) NOT NULL DEFAULT 0,
  `promotion_end_date` int(11) NOT NULL DEFAULT 0,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish` int(11) NOT NULL DEFAULT 0,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tbl_review` ;
CREATE TABLE `tbl_review` (
  `Rid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `Rname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Remail` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Rcomment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Rid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tbl_sliders` ;
CREATE TABLE `tbl_sliders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tbl_template_mail` ;
CREATE TABLE `tbl_template_mail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tbl_configmail_receiver` ;
CREATE TABLE `tbl_configmail_receiver` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

