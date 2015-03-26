DROP DATABASE IF EXISTS `admin`;
CREATE DATABASE `admin` /*!40100 DEFAULT CHARACTER SET utf8 */;
use admin;
DROP TABLE IF EXISTS `admin`.`group`;
CREATE TABLE  `admin`.`group` (
  `t_pkId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `t_groupName` varchar(256) NOT NULL,
  PRIMARY KEY (`t_pkId`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `admin`.`t_project`;
CREATE TABLE  `admin`.`t_project` (
  `t_pkid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `t_projectName` varchar(256) NOT NULL,
  `t_year` int(10) unsigned NOT NULL,
  `t_month` int(10) unsigned NOT NULL,
  `t_day` int(10) unsigned NOT NULL,
  `t_createDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `t_tables` text,
  PRIMARY KEY (`t_pkid`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `admin`.`user`;
CREATE TABLE  `admin`.`user` (
  `pk_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `t_account` varchar(100) NOT NULL,
  `t_pwd` varchar(100) NOT NULL,
  `t_name` varchar(100) NOT NULL,
  `t_level` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '用户级别1普通用户 9 超级管理',
  `fk_t_group` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分组',
  PRIMARY KEY (`pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

insert into user (t_account, t_pwd, t_name , t_level, fk_t_group) 
values ("admin", "e10adc3949ba59abbe56e057f20f883e", "管理员", 9, 0);

DROP TABLE IF EXISTS `admin`.`attach`;
CREATE TABLE  `admin`.`attach` (
  `t_pkId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `fk_projectId` int(10) unsigned NOT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `fk_user` int(10) unsigned NOT NULL,
  PRIMARY KEY (`t_pkId`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;