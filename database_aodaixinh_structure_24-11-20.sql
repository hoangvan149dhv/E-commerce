
DROP TABLE IF EXISTS `devvn_feeship` ;
CREATE TABLE `devvn_feeship` (
  `fee_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_matp` varchar(50) NOT NULL,
  `fee_maqh` varchar(50) NOT NULL,
  `fee_xa` varchar(50) NOT NULL,
  `fee_feeship` int(11) NOT NULL,
  PRIMARY KEY (`fee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `devvn_quanhuyen` ;
CREATE TABLE `devvn_quanhuyen` (
  `maqh` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `matp` int(11) NOT NULL,
  PRIMARY KEY (`maqh`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `devvn_tinhthanhpho` ;
CREATE TABLE `devvn_tinhthanhpho` (
  `matp` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `type` varchar(30) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`matp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `devvn_xaphuongthitran` ;
CREATE TABLE `devvn_xaphuongthitran` (
  `xaid` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `type` varchar(30) CHARACTER SET utf8 NOT NULL,
  `maqh` int(11) NOT NULL,
  PRIMARY KEY (`xaid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_admin` ;
CREATE TABLE `tbl_admin` (
  `admin_Id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_email` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `admin_pass` varchar(50) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_question_getpass` varchar(100) NOT NULL,
  `pass` varchar(50) NOT NULL,
  PRIMARY KEY (`admin_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tbl_brand_code_product` ;
CREATE TABLE `tbl_brand_code_product` (
  `code_id` int(11) NOT NULL AUTO_INCREMENT,
  `brandcode_id` varchar(70) NOT NULL,
  `brandcode_name` varchar(70) NOT NULL,
  PRIMARY KEY (`code_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tbl_category_product` ;
CREATE TABLE `tbl_category_product` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `category_desc` varchar(100) NOT NULL,
  `category_status` bigint(20) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tbl_contact` ;
CREATE TABLE `tbl_contact` (
  `Con_Id` int(11) NOT NULL,
  `Con_Name` varchar(70) NOT NULL,
  `Con_Email` varchar(70) NOT NULL,
  `Con_Content` text NOT NULL,
  `status` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tbl_count` ;
CREATE TABLE `tbl_count` (
  `id` int(11) NOT NULL,
  `counts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tbl_customer` ;
CREATE TABLE `tbl_customer` (
  `cusid` int(11) NOT NULL AUTO_INCREMENT,
  `cusname` varchar(70) NOT NULL,
  `cusadd` varchar(70) NOT NULL,
  `cusPhone` varchar(11) NOT NULL,
  PRIMARY KEY (`cusid`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tbl_info_contact` ;
CREATE TABLE `tbl_info_contact` (
  `id_Info` int(11) NOT NULL AUTO_INCREMENT,
  `google_map` text NOT NULL,
  `info_contact_add` varchar(100) NOT NULL,
  `info_contact_phone` varchar(11) NOT NULL,
  `info_contact_mail` varchar(100) NOT NULL,
  PRIMARY KEY (`id_Info`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tbl_logo_website` ;
CREATE TABLE `tbl_logo_website` (
  `id` int(11) NOT NULL,
  `imgLogo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tbl_news` ;
CREATE TABLE `tbl_news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(255) NOT NULL,
  `news_desc` text NOT NULL,
  `news_image` varchar(255) NOT NULL,
  `news_content` text NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tbl_order` ;
CREATE TABLE `tbl_order` (
  `orderid` int(11) NOT NULL AUTO_INCREMENT,
  `cusid` int(11) NOT NULL,
  `cusname` varchar(70) NOT NULL,
  `product_id` int(11) NOT NULL,
  `productname` varchar(70) NOT NULL,
  `image` varchar(255) NOT NULL,
  `soluong` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `fee_ship` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `cusphone` varchar(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `note` text NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`orderid`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tbl_product` ;
CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `product_Name` varchar(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_material` varchar(100) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_price_promotion` int(11) NOT NULL,
  `promotion_start_date` date DEFAULT NULL,
  `promotion_end_date` date DEFAULT NULL,
  `brandcode_id` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `meta_keyword` varchar(100) NOT NULL,
  `meta_desc` text NOT NULL,
  `meta_slug` text NOT NULL,
  `publish` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tbl_review` ;
CREATE TABLE `tbl_review` (
  `Rid` int(11) NOT NULL AUTO_INCREMENT,
  `Rname` varchar(70) NOT NULL,
  `Remail` varchar(70) NOT NULL,
  `Rcomment` text NOT NULL,
  `status` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Rid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tbl_slider` ;
CREATE TABLE `tbl_slider` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `img` varchar(255) NOT NULL,
  `status` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tbl_template_mail` ;
CREATE TABLE `tbl_template_mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  `template` text NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `tbl_configmail_receiver` ;
CREATE TABLE `tbl_configmail_receiver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(50) NOT NULL,
  `name_email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

