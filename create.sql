-- 傾印  資料表 laravel.admin_menus 結構
CREATE TABLE IF NOT EXISTS `admin_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `title` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `path` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `role` int(11) DEFAULT NULL COMMENT '權限',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_admin_menus_admin_menus` (`pid`),
  CONSTRAINT `FK_admin_menus_admin_menus` FOREIGN KEY (`pid`) REFERENCES `admin_menus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
