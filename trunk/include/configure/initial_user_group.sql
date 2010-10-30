-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 30, 2010 at 02:02 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: 'moosavin_groupon'
--

--
-- Dumping data for table 'user_group'
--

INSERT INTO user_group (name, permission) VALUES
('Customer', 'N;'),
('Supervisor', 'a:2:{s:6:"access";a:23:{i:0;s:14:"category/index";i:1;s:15:"charity/charity";i:2;s:19:"charity/charityedit";i:3;s:14:"coupon/consume";i:4;s:13:"coupon/expire";i:5;s:12:"coupon/index";i:6;s:14:"customer/index";i:7;s:8:"misc/ask";i:8;s:13:"misc/feedback";i:9;s:10:"misc/index";i:10;s:11:"misc/invite";i:11;s:14:"misc/subscribe";i:12;s:11:"order/index";i:13;s:9:"order/pay";i:14;s:11:"order/unpay";i:15;s:13:"partner/index";i:16;s:15:"team/dealreport";i:17;s:9:"team/down";i:18;s:12:"team/failure";i:19;s:10:"team/index";i:20;s:12:"team/success";i:21;s:10:"user/index";i:22;s:14:"user/usergroup";}s:6:"modify";a:29:{i:0;s:13:"category/edit";i:1;s:15:"charity/charity";i:2;s:19:"charity/charityedit";i:3;s:14:"customer/index";i:4;s:12:"misc/askedit";i:5;s:14:"misc/askremove";i:6;s:14:"partner/create";i:7;s:12:"partner/edit";i:8;s:11:"team/create";i:9;s:15:"team/dealreport";i:10;s:9:"team/edit";i:11;s:11:"team/remove";i:12;s:9:"user/edit";i:13;s:12:"categoryedit";i:14;s:14:"categoryremove";i:15;s:11:"charityedit";i:16;s:13:"charityremove";i:17;s:8:"inviteok";i:18;s:12:"inviteremove";i:19;s:15:"noticesubscribe";i:20;s:9:"ordercash";i:21;s:9:"orderview";i:22;s:13:"partnerremove";i:23;s:10:"teamdetail";i:24;s:10:"teamremove";i:25;s:10:"teamrefund";i:26;s:8:"userview";i:27;s:15:"subscriberemove";i:28;s:9:"usermoney";}}');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
