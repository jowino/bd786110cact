# SQL Manager 2005 for MySQL 3.6.5.1
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : wroupon


SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the `ask` table : 
#

DROP TABLE IF EXISTS `ask`;

CREATE TABLE `ask` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `user_id` int(10) unsigned NOT NULL default '0',
  `team_id` int(10) unsigned NOT NULL default '0',
  `city_id` int(10) unsigned NOT NULL default '0',
  `content` text,
  `comment` text,
  `create_time` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Structure for the `category` table : 
#

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `zone` varchar(16) default NULL,
  `czone` varchar(32) default NULL,
  `name` varchar(32) default NULL,
  `ename` varchar(16) default NULL,
  `letter` char(1) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `UNQ_zne` (`zone`,`name`,`ename`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Structure for the `coupon` table : 
#

DROP TABLE IF EXISTS `coupon`;

CREATE TABLE `coupon` (
  `id` varchar(12) NOT NULL default '',
  `user_id` int(10) unsigned NOT NULL default '0',
  `partner_id` int(10) unsigned NOT NULL default '0',
  `team_id` int(10) unsigned NOT NULL default '0',
  `order_id` int(10) unsigned NOT NULL default '0',
  `type` enum('consume','credit') NOT NULL default 'consume',
  `credit` int(10) unsigned NOT NULL default '0',
  `secret` varchar(10) default NULL,
  `consume` enum('Y','N') NOT NULL default 'N',
  `ip` varchar(16) default NULL,
  `expire_time` int(10) unsigned NOT NULL default '0',
  `consume_time` int(10) unsigned NOT NULL default '0',
  `create_time` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Structure for the `feedback` table : 
#

DROP TABLE IF EXISTS `feedback`;

CREATE TABLE `feedback` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `city_id` int(10) unsigned NOT NULL default '0',
  `user_id` int(10) unsigned NOT NULL default '0',
  `category` enum('suggest','seller') NOT NULL default 'suggest',
  `title` varchar(128) default NULL,
  `contact` varchar(255) default NULL,
  `content` text,
  `create_time` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Structure for the `flow` table : 
#

DROP TABLE IF EXISTS `flow`;

CREATE TABLE `flow` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `user_id` int(10) unsigned NOT NULL default '0',
  `detail_id` varchar(32) default NULL,
  `direction` enum('income','expense') NOT NULL default 'income',
  `money` double(10,2) NOT NULL default '0.00',
  `action` enum('buy','refund','invite','coupon','store') NOT NULL default 'buy',
  `create_time` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Structure for the `invite` table : 
#

DROP TABLE IF EXISTS `invite`;

CREATE TABLE `invite` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `user_id` int(10) unsigned NOT NULL default '0',
  `user_ip` varchar(16) default NULL,
  `other_user_id` int(10) unsigned NOT NULL default '0',
  `other_user_ip` varchar(16) default NULL,
  `team_id` int(10) unsigned NOT NULL default '0',
  `pay` enum('Y','N') NOT NULL default 'N',
  `credit` int(10) unsigned NOT NULL default '0',
  `buy_time` int(10) unsigned NOT NULL default '0',
  `create_time` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `UNQ_uo` (`user_id`,`other_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Structure for the `order` table : 
#

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `pay_id` varchar(32) default NULL,
  `service` enum('alipay','chinabank','credit','cash','paypal') NOT NULL default 'paypal',
  `user_id` int(10) unsigned NOT NULL default '0',
  `team_id` int(10) unsigned NOT NULL default '0',
  `city_id` int(10) unsigned NOT NULL default '0',
  `state` enum('unpay','pay') NOT NULL default 'unpay',
  `quantity` int(10) unsigned NOT NULL default '1',
  `realname` varchar(32) default NULL,
  `mobile` varchar(128) default NULL,
  `zipcode` char(6) default NULL,
  `address` varchar(128) default NULL,
  `express` enum('Y','N') NOT NULL default 'Y',
  `express_xx` varchar(128) default NULL,
  `express_ex` enum('yuantong','shentong','yunda','shunfeng','ems','other') default NULL,
  `express_no` varchar(32) default NULL,
  `money` double(10,2) NOT NULL default '0.00',
  `origin` double(10,2) NOT NULL default '0.00',
  `credit` double(10,2) NOT NULL default '0.00',
  `fare` double(10,2) NOT NULL default '0.00',
  `remark` text,
  `create_time` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `UNQ_p` (`pay_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Structure for the `page` table : 
#

DROP TABLE IF EXISTS `page`;

CREATE TABLE `page` (
  `id` varchar(16) NOT NULL,
  `value` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Structure for the `partner` table : 
#

DROP TABLE IF EXISTS `partner`;

CREATE TABLE `partner` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `username` varchar(32) default NULL,
  `password` varchar(32) default NULL,
  `title` varchar(128) default NULL,
  `homepage` varchar(128) default NULL,
  `city_id` int(10) unsigned NOT NULL default '0',
  `bank_name` varchar(128) default NULL,
  `bank_no` varchar(128) default NULL,
  `bank_user` varchar(128) default NULL,
  `location` text NOT NULL,
  `contact` varchar(32) default NULL,
  `phone` varchar(18) default NULL,
  `other` text,
  `mobile` varchar(12) default NULL,
  `user_id` int(10) unsigned NOT NULL default '0',
  `create_time` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `UNQ_ct` (`city_id`,`title`),
  UNIQUE KEY `UNQ_u` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Structure for the `pay` table : 
#

DROP TABLE IF EXISTS `pay`;

CREATE TABLE `pay` (
  `id` varchar(32) NOT NULL default '',
  `order_id` int(10) unsigned NOT NULL default '0',
  `bank` varchar(32) default NULL,
  `money` double(10,2) default NULL,
  `currency` enum('SGD','USD') NOT NULL default 'SGD',
  `service` enum('alipay','chinabank','credit','cash','paypal') NOT NULL default 'paypal',
  `create_time` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `UNQ_o` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Structure for the `subscribe` table : 
#

DROP TABLE IF EXISTS `subscribe`;

CREATE TABLE `subscribe` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `email` varchar(128) default NULL,
  `city_id` int(10) unsigned NOT NULL default '0',
  `secret` varchar(32) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `UNQ_e` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Structure for the `system` table : 
#

DROP TABLE IF EXISTS `system`;

CREATE TABLE `system` (
  `id` enum('1') NOT NULL default '1',
  `value` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Structure for the `team` table : 
#

DROP TABLE IF EXISTS `team`;

CREATE TABLE `team` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `user_id` int(10) unsigned NOT NULL default '0',
  `title` varchar(128) default NULL,
  `summary` text,
  `city_id` int(10) unsigned NOT NULL default '0',
  `group_id` int(10) unsigned NOT NULL default '0',
  `partner_id` int(10) unsigned NOT NULL default '0',
  `system` enum('Y','N') NOT NULL default 'Y',
  `team_price` int(10) unsigned NOT NULL default '0',
  `market_price` int(10) unsigned NOT NULL default '0',
  `product` varchar(128) default NULL,
  `per_number` int(10) unsigned NOT NULL default '1',
  `min_number` int(10) unsigned NOT NULL default '1',
  `max_number` int(10) unsigned NOT NULL default '0',
  `now_number` int(10) unsigned NOT NULL default '0',
  `image` varchar(128) default NULL,
  `image1` varchar(128) default NULL,
  `image2` varchar(128) default NULL,
  `flv` varchar(128) default NULL,
  `mobile` varchar(16) default NULL,
  `credit` int(10) unsigned NOT NULL default '0',
  `fare` int(10) unsigned NOT NULL default '0',
  `address` varchar(128) default NULL,
  `detail` text,
  `systemreview` text,
  `userreview` text,
  `notice` text,
  `express` text,
  `delivery` enum('coupon','express','pickup') NOT NULL default 'coupon',
  `state` enum('none','success','soldout','failure','refund') NOT NULL default 'none',
  `expire_time` int(10) unsigned NOT NULL default '0',
  `begin_time` int(10) unsigned NOT NULL default '0',
  `end_time` int(10) unsigned NOT NULL default '0',
  `close_time` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Structure for the `user` table : 
#

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `email` varchar(128) default NULL,
  `username` varchar(32) default NULL,
  `realname` varchar(32) default NULL,
  `password` varchar(32) default NULL,
  `avatar` varchar(128) default NULL,
  `newbie` enum('Y','N') NOT NULL default 'Y',
  `mobile` varchar(16) default NULL,
  `money` double(10,2) unsigned NOT NULL default '0.00',
  `zipcode` char(6) default NULL,
  `address` varchar(255) default NULL,
  `enable` enum('Y','N') NOT NULL default 'Y',
  `manager` enum('Y','N') NOT NULL default 'N',
  `secret` varchar(32) default NULL,
  `recode` varchar(32) default NULL,
  `ip` varchar(16) default NULL,
  `login_time` int(10) unsigned NOT NULL default '0',
  `create_time` int(10) unsigned NOT NULL default '0',
  `fb_userid` varchar(200) default NULL,
  `fl_facebook` set('new','normal','registered') default 'registered',
  `twitter_userid` varchar(200) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `UNQ_name` (`username`),
  UNIQUE KEY `UNQ_e` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

