CREATE DATABASE shop;
USE shop;
CREATE TABLE IF NOT EXISTS `goods` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `price_before` varchar(16) NOT NULL,
  `price_now` varchar(16) NOT NULL,
  `freight` varchar(16) NOT NULL,
  `detail` varchar(1024) NOT NULL,
  `color` varchar(512) NOT NULL,
  `size` varchar(512) NOT NULL,
  `img` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
)CHARSET=UTF8;