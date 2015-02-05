-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 28, 2015 at 05:09 PM
-- Server version: 5.5.40
-- PHP Version: 5.4.36-1+deb.sury.org~precise+2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yiiplugin`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_tokens`
--

CREATE TABLE IF NOT EXISTS `login_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` char(32) NOT NULL,
  `duration` varchar(32) NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `login_tokens`
--

INSERT INTO `login_tokens` (`id`, `user_id`, `token`, `duration`, `used`, `created`, `expires`) VALUES
(5, 1, '7948c60a1d7d89a73920be9705d4a121', '2 weeks', 0, '2015-01-09 12:38:04', '2015-01-23 12:38:04'),
(6, 1, '41cb218235863452c2287bbc83d3e097', '2 weeks', 0, '2015-01-09 12:38:04', '2015-01-23 12:38:04');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1420541648),
('m130524_201442_init', 1420541658);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `name_public` text,
  `value` varchar(256) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `name_public`, `value`, `type`) VALUES
(1, 'defaultTimeZone', 'Enter default time zone identifier', 'America/New_York', 'input'),
(2, 'siteName', 'Enter Your Site Name', 'User Management Plugin', 'input'),
(3, 'siteRegistration', 'New Registration is allowed or not', '1', 'checkbox'),
(4, 'allowDeleteAccount', 'Allow users to delete account', '0', 'checkbox'),
(5, 'sendRegistrationMail', 'Send Registration Mail After User Registered', '1', 'checkbox'),
(6, 'sendPasswordChangeMail', 'Send Password Change Mail After User changed password', '1', 'checkbox'),
(7, 'emailVerification', 'Want to verify user''s email address?', '1', 'checkbox'),
(8, 'emailFromAddress', 'Enter email by which emails will be send.', 'example@example.com', 'input'),
(9, 'emailFromName', 'Enter Email From Name', 'User Management Plugin', 'input'),
(10, 'allowChangeUsername', 'Do you want to allow users to change their username?', '0', 'checkbox'),
(11, 'bannedUsernames', 'Set banned usernames comma separated(no space, no quotes)', 'Administrator, SuperAdmin', 'input'),
(12, 'useRecaptcha', 'Do you want to captcha support on registration form?', '0', 'checkbox'),
(13, 'privateKeyFromRecaptcha', 'Enter private key for Recaptcha from google', '', 'input'),
(14, 'publicKeyFromRecaptcha', 'Enter public key for recaptcha from google', '', 'input'),
(15, 'loginRedirectUrl', 'Enter URL where user will be redirected after login ', '/dashboard', 'input'),
(16, 'logoutRedirectUrl', 'Enter URL where user will be redirected after logout', '/login', 'input'),
(17, 'permissions', 'Do you Want to enable permissions for users?', '1', 'checkbox'),
(18, 'adminPermissions', 'Do you want to check permissions for Admin?', '0', 'checkbox'),
(19, 'defaultGroupId', 'Enter default group id for user registration', '2', 'input'),
(20, 'adminGroupId', 'Enter Admin Group Id', '1', 'input'),
(21, 'guestGroupId', 'Enter Guest Group Id', '3', 'input'),
(22, 'useFacebookLogin', 'Want to use Facebook Connect on your site?', '0', 'checkbox'),
(23, 'facebookAppId', 'Facebook Application Id', '', 'input'),
(24, 'facebookSecret', 'Facebook Application Secret Code', '', 'input'),
(25, 'facebookScope', 'Facebook Permissions', 'user_status, publish_stream, email', 'input'),
(26, 'useTwitterLogin', 'Want to use Twitter Connect on your site?', '0', 'checkbox'),
(27, 'twitterConsumerKey', 'Twitter Consumer Key', '', 'input'),
(28, 'twitterConsumerSecret', 'Twitter Consumer Secret', '', 'input'),
(29, 'useGmailLogin', 'Want to use Gmail Connect on your site?', '1', 'checkbox'),
(30, 'useYahooLogin', 'Want to use Yahoo Connect on your site?', '1', 'checkbox'),
(31, 'useLinkedinLogin', 'Want to use Linkedin Connect on your site?', '0', 'checkbox'),
(32, 'linkedinApiKey', 'Linkedin Api Key', '', 'input'),
(33, 'linkedinSecretKey', 'Linkedin Secret Key', '', 'input'),
(34, 'useFoursquareLogin', 'Want to use Foursquare Connect on your site?', '0', 'checkbox'),
(35, 'foursquareClientId', 'Foursquare Client Id', '', 'input'),
(36, 'foursquareClientSecret', 'Foursquare Client Secret', '', 'input'),
(37, 'viewOnlineUserTime', 'You can view online users and guest from last few minutes, set time in minutes ', '30', 'input'),
(38, 'useHttps', 'Do you want to HTTPS for whole site?', '0', 'checkbox'),
(39, 'httpsUrls', 'You can set selected urls for HTTPS (e.g. users/login, users/register)', NULL, 'input'),
(40, 'imgDir', 'Enter Image directory name where users profile photos will be uploaded. This directory should be in webroot/img directory', 'umphotos', 'input');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_emails`
--

CREATE TABLE IF NOT EXISTS `tmp_emails` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(256) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_id` tinyint(3) DEFAULT '0',
  `role` tinyint(1) DEFAULT '0',
  `fb_id` bigint(100) DEFAULT NULL,
  `fb_access_token` text,
  `twt_id` bigint(100) DEFAULT NULL,
  `twt_access_token` text,
  `twt_access_secret` text,
  `ldn_id` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `email_verified` tinyint(1) DEFAULT '0',
  `last_login` timestamp NULL DEFAULT NULL,
  `by_admin` tinyint(1) DEFAULT '0',
  `created` varchar(10) DEFAULT NULL,
  `modified` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`username`),
  KEY `mail` (`email`),
  KEY `users_FKIndex1` (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `group_id`, `role`, `fb_id`, `fb_access_token`, `twt_id`, `twt_access_token`, `twt_access_secret`, `ldn_id`, `status`, `email_verified`, `last_login`, `by_admin`, `created`, `modified`) VALUES
(2, 'Manoj', 'Kumar', 'manoj@codefire.in', 'manoj12', '8nFxXsTM8N_x4eW4HcbyDWeY6jEgcC4W', '$2y$13$fMA1Cv3na3nhl9a0olxuDuC6WAEBprBZ84FjbiHoasfFSauNCBxP6', 'o6Wp1aNkt_xo5R20V2utCq0cWXIdZv5F_1422427173', NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2015-01-08 14:15:33', 1, '1421403049', '1422441771'),
(4, 'Manoj', 'kumar', 'abhayjeet@codefire.in', 'manoj2', 'kGKwgWq18ZIJRDPJbTtCbJxiJcr2NzLx', '$2y$13$7cQVex24yJgYm0i8N3piN.ZF0uOHsfDFSyEx24tIQ8eCzP7HgY4xC', 'lY_R8lNzbpBsA7StZ2vrqogvxGLWIVig_1422426227', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2015-01-16 09:44:23', 0, '1421403049', '1422440547'),
(15, 'Ankit', 'Kumar', 'ankit@codefire.in', 'ankit', 'M6REUG5Y2Nu3gY26jrYJm1ydEwrco4Ow', '$2y$13$u9sD5ksxeUiVTJYQ2cN1NO5HXPqdLc6XuSbpKzEDOcW3FaNvSBG46', 'b9rXJ5IcHL2_x6zoCLG4-nPZKFXPQ-Bi_1422426810', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2015-01-16 09:57:33', 0, '1421403049', '1422439155'),
(77, 'Sudhir', 'Yadav', 'sudhir@codefire.in', 'sudhir', 'CdQ3xdXnKPgUDq8qRxoPZhSk2VPfSfXu', '$2y$13$m2vExufDdpFUAhXMINEjfOR1wpKFnTtwKJsg/mY9XVZwfob9maNSm', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 0, '1421931659', '1421993950'),
(88, 'Manoj', 'Kumar', 'manoj1111@codefire.in', 'manoj1111', 'wlrNqUqQUnYfASVOX60H6uiynRVZnpkw', '$2y$13$XJJRJRPyWQV57IQUuKcPVOlRmUgOSpfRvlNFSxIR.xtOPZKFwewxe', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 0, '1421995284', '1421995311'),
(80, 'Rahul', 'Kumar', 'rahul@codefire.in', 'rahul', '8H-fzT1Bi-4cRuKa8cAEBgE9rq4-gvzQ', '$2y$13$IrB/2f0hIkiRAhfLIemM/OVFv0UgF8gXmSlCzPtYvKr3r652avZJa', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 0, '1421931785', '1422439350'),
(81, 'Manoj1', 'Kumar', 'manoj1@codefire.in', 'manoj1', 'l_hw84cdDX6Mqla46uYA1aGorE7N5nYJ', '$2y$13$sButS0Utn/n/0Ei2djF9IOHpBZ59k9zmL1dnE6J74ShXeWMyMJR/K', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 0, '1421932049', '1422433376'),
(82, 'Manoj1', 'Kumar', 'manoj111@codefire.in', 'manoj111', 'KekGY1hLOBqfx_f2LCsguGZbuERcv14d', '$2y$13$/Sy7djyeZxQ12GJ7F3wwq.w/Avz4F3RhmLn05XgS.x2V8I0v1dubK', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, '1421992938', '1422433389'),
(83, 'Manoj212', 'Kumar', 'Manoj212@codefire.in', 'Manoj212', 'BR5EjTjMIU8bYJkAIeLjXTf58NdkZ81G', '$2y$13$0ToQ18EHrdmnn/HQqQdIPu8LqzLfb/QYlVP3tHzHJqW1VgLrGlusy', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 0, '1421993085', '1421995055'),
(75, 'pranjal', 'sriv', 'pran@codefire.in', 'pransriv', 'YaCGz_7Z_HzRNV4z3teB-bpyTgJ9G5p5', '$2y$13$K1VKoHHjbBCPW.bdV3pZs.dP9LrQe9xHj55iisWI.HCk2NcYszKNq', 'NuJqNord2Cl-IBULlEVfOjWLzVRJtH15_1421926474', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 0, '1421924857', '1422441427');

-- --------------------------------------------------------

--
-- Table structure for table `user_activities`
--

CREATE TABLE IF NOT EXISTS `user_activities` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `useragent` varchar(256) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `last_action` int(10) DEFAULT NULL,
  `last_url` text,
  `logout_time` int(10) DEFAULT NULL,
  `user_browser` text,
  `ip_address` varchar(50) DEFAULT NULL,
  `logout` int(11) NOT NULL DEFAULT '0',
  `deleted` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_activities`
--

INSERT INTO `user_activities` (`id`, `useragent`, `user_id`, `last_action`, `last_url`, `logout_time`, `user_browser`, `ip_address`, `logout`, `deleted`, `status`, `created`, `modified`) VALUES
(2, '6f4dec8fafa5796e160c80afd3c8e54f', 1, 1420801798, '/caketest/addUser', NULL, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36', '127.0.0.1', 0, 0, 1, '2015-01-07 08:51:59', '2015-01-09 02:09:59');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `gender` enum('M','F','O') DEFAULT NULL COMMENT 'M=>Male, F=>Femaile, O=>Any Other',
  `photo` text,
  `bday` varchar(10) DEFAULT NULL,
  `location` varchar(256) DEFAULT NULL,
  `marital_status` enum('M','U','D','W') DEFAULT NULL COMMENT 'M => Married, U=>Unmarried, D=>Divorced, W=>Widowed',
  `cellphone` varchar(15) DEFAULT NULL,
  `web_page` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `gender`, `photo`, `bday`, `location`, `marital_status`, `cellphone`, `web_page`, `created`, `modified`) VALUES
(1, 2, 'M', 'User (1).png', '13-01-2015', 'Noida', '', '1111111111', 'http://mywebpage.com/mypage', '2015-01-07 18:49:53', '2015-01-07 18:49:53'),
(2, 4, '', '', '1986-01-30', '', '', '', '', '2015-01-07 18:49:53', '2015-01-07 18:49:53'),
(35, 77, 'M', NULL, '', '', 'M', '', '', NULL, NULL),
(4, 15, 'M', '', '1986-01-30', '', 'M', '', '', '2015-01-07 18:49:53', '2015-01-07 18:49:53'),
(41, 83, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 81, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 80, '', NULL, '', '', '', '', '', NULL, NULL),
(40, 82, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 75, 'M', 'red.png', '01-01-2015', '', 'M', '123123123', 'www.codefire.in', NULL, NULL),
(46, 88, 'M', NULL, '', '', '', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE IF NOT EXISTS `user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `alias_name` varchar(100) DEFAULT NULL,
  `allowRegistration` int(1) NOT NULL DEFAULT '1',
  `created` varchar(10) DEFAULT NULL,
  `modified` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `name`, `alias_name`, `allowRegistration`, `created`, `modified`) VALUES
(1, 'Admin', 'Admin', 0, '1421403049', '1421403049'),
(2, 'User', 'User', 1, '1421403049', '1421403049'),
(3, 'Guest', 'Guest', 0, '1421403049', '1421403049');

-- --------------------------------------------------------

--
-- Table structure for table `user_group_permissions`
--

CREATE TABLE IF NOT EXISTS `user_group_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_group_id` int(10) unsigned NOT NULL,
  `controller` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `action` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `allowed` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=109 ;

--
-- Dumping data for table `user_group_permissions`
--

INSERT INTO `user_group_permissions` (`id`, `user_group_id`, `controller`, `action`, `allowed`) VALUES
(1, 1, 'Pages', 'display', 1),
(2, 2, 'Pages', 'display', 1),
(3, 3, 'Pages', 'display', 1),
(4, 1, 'UserGroupPermissions', 'index', 1),
(5, 2, 'UserGroupPermissions', 'index', 0),
(6, 3, 'UserGroupPermissions', 'index', 0),
(7, 1, 'UserGroups', 'index', 1),
(8, 2, 'UserGroups', 'index', 0),
(9, 3, 'UserGroups', 'index', 0),
(10, 1, 'UserGroups', 'addGroup', 1),
(11, 2, 'UserGroups', 'addGroup', 0),
(12, 3, 'UserGroups', 'addGroup', 0),
(13, 1, 'UserGroups', 'editGroup', 1),
(14, 2, 'UserGroups', 'editGroup', 0),
(15, 3, 'UserGroups', 'editGroup', 0),
(16, 1, 'UserGroups', 'deleteGroup', 1),
(17, 2, 'UserGroups', 'deleteGroup', 0),
(18, 3, 'UserGroups', 'deleteGroup', 0),
(19, 1, 'UserSettings', 'index', 1),
(20, 2, 'UserSettings', 'index', 0),
(21, 3, 'UserSettings', 'index', 0),
(22, 1, 'UserSettings', 'editSetting', 1),
(23, 2, 'UserSettings', 'editSetting', 0),
(24, 3, 'UserSettings', 'editSetting', 0),
(25, 1, 'Users', 'index', 1),
(26, 2, 'Users', 'index', 0),
(27, 3, 'Users', 'index', 0),
(28, 1, 'Users', 'online', 1),
(29, 2, 'Users', 'online', 0),
(30, 3, 'Users', 'online', 0),
(31, 1, 'Users', 'viewUser', 1),
(32, 2, 'Users', 'viewUser', 0),
(33, 3, 'Users', 'viewUser', 0),
(34, 1, 'Users', 'myprofile', 0),
(35, 2, 'Users', 'myprofile', 1),
(36, 3, 'Users', 'myprofile', 0),
(37, 1, 'Users', 'editProfile', 0),
(38, 2, 'Users', 'editProfile', 1),
(39, 3, 'Users', 'editProfile', 0),
(40, 1, 'Users', 'login', 1),
(41, 2, 'Users', 'login', 1),
(42, 3, 'Users', 'login', 1),
(43, 1, 'Users', 'logout', 1),
(44, 2, 'Users', 'logout', 1),
(45, 3, 'Users', 'logout', 1),
(46, 1, 'Users', 'register', 1),
(47, 2, 'Users', 'register', 1),
(48, 3, 'Users', 'register', 1),
(49, 1, 'Users', 'changePassword', 1),
(50, 2, 'Users', 'changePassword', 1),
(51, 3, 'Users', 'changePassword', 0),
(52, 1, 'Users', 'changeUserPassword', 1),
(53, 2, 'Users', 'changeUserPassword', 0),
(54, 3, 'Users', 'changeUserPassword', 0),
(55, 1, 'Users', 'addUser', 1),
(56, 2, 'Users', 'addUser', 0),
(57, 3, 'Users', 'addUser', 0),
(58, 1, 'Users', 'editUser', 1),
(59, 2, 'Users', 'editUser', 0),
(60, 3, 'Users', 'editUser', 0),
(61, 1, 'Users', 'deleteUser', 1),
(62, 2, 'Users', 'deleteUser', 0),
(63, 3, 'Users', 'deleteUser', 0),
(64, 1, 'Users', 'deleteAccount', 0),
(65, 2, 'Users', 'deleteAccount', 1),
(66, 3, 'Users', 'deleteAccount', 0),
(67, 1, 'Users', 'logoutUser', 1),
(68, 2, 'Users', 'logoutUser', 0),
(69, 3, 'Users', 'logoutUser', 0),
(70, 1, 'Users', 'makeInactive', 1),
(71, 2, 'Users', 'makeInactive', 0),
(72, 3, 'Users', 'makeInactive', 0),
(73, 1, 'Users', 'dashboard', 1),
(74, 2, 'Users', 'dashboard', 1),
(75, 3, 'Users', 'dashboard', 0),
(76, 1, 'Users', 'makeActiveInactive', 1),
(77, 2, 'Users', 'makeActiveInactive', 0),
(78, 3, 'Users', 'makeActiveInactive', 0),
(79, 1, 'Users', 'verifyEmail', 1),
(80, 2, 'Users', 'verifyEmail', 0),
(81, 3, 'Users', 'verifyEmail', 0),
(82, 1, 'Users', 'accessDenied', 1),
(83, 2, 'Users', 'accessDenied', 1),
(84, 3, 'Users', 'accessDenied', 0),
(85, 1, 'Users', 'userVerification', 1),
(86, 2, 'Users', 'userVerification', 1),
(87, 3, 'Users', 'userVerification', 1),
(88, 1, 'Users', 'forgotPassword', 1),
(89, 2, 'Users', 'forgotPassword', 1),
(90, 3, 'Users', 'forgotPassword', 1),
(91, 1, 'Users', 'emailVerification', 1),
(92, 2, 'Users', 'emailVerification', 1),
(93, 3, 'Users', 'emailVerification', 1),
(94, 1, 'Users', 'activatePassword', 1),
(95, 2, 'Users', 'activatePassword', 1),
(96, 3, 'Users', 'activatePassword', 1),
(97, 1, 'UserGroupPermissions', 'update', 1),
(98, 2, 'UserGroupPermissions', 'update', 0),
(99, 3, 'UserGroupPermissions', 'update', 0),
(100, 1, 'Users', 'deleteCache', 1),
(101, 2, 'Users', 'deleteCache', 0),
(102, 3, 'Users', 'deleteCache', 0),
(103, 1, 'Autocomplete', 'fetch', 1),
(104, 2, 'Autocomplete', 'fetch', 1),
(105, 3, 'Autocomplete', 'fetch', 1),
(106, 1, 'Users', 'viewUserPermissions', 1),
(107, 2, 'Users', 'viewUserPermissions', 0),
(108, 3, 'Users', 'viewUserPermissions', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
