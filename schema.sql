SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rbac`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('d6c3d18f11761dce0fe44e19c441469f', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:19.0) Gecko/20100101 Firefox/19.0', 1364137406, 'a:1:{s:9:"user_data";s:0:"";}');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `log_rbac`
--

CREATE TABLE IF NOT EXISTS `log_rbac` (
  `int` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `action` varchar(64) NOT NULL,
  `inserted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rbac_group`
--

CREATE TABLE IF NOT EXISTS `rbac_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `usergroup` varchar(32) NOT NULL,
  `item_ids` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `scope_id` smallint(5) unsigned NOT NULL,
  `priority` smallint(5) unsigned NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rbac_group`
--

INSERT INTO `rbac_group` (`id`, `usergroup`, `item_ids`, `description`, `scope_id`, `priority`, `updated_at`, `updated_by`) VALUES
(1, 'Admin', '{"4":["1","2","3","6"],"5":["1","2","3","6"]}', 'admin got almost all privileges', 1, 0, '2013-03-06 00:03:19', 1),
(2, 'Sample group', '{"5":["1","2","3"]}', 'can administer the example taskgroup', 2, 5, '2013-03-24 14:49:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rbac_items`
--

CREATE TABLE IF NOT EXISTS `rbac_items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(50) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1->class 0->role',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `rbac_items`
--

INSERT INTO `rbac_items` (`id`, `item`, `type`) VALUES
(1, 'view', 0),
(2, 'add', 0),
(3, 'edit', 0),
(4, 'Usermanagement', 1),
(5, 'Example', 1),
(6, 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rbac_items_description`
--

CREATE TABLE IF NOT EXISTS `rbac_items_description` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` smallint(32) unsigned NOT NULL,
  `role_id` smallint(5) unsigned NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `class_id` (`class_id`,`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `rbac_scope`
--

CREATE TABLE IF NOT EXISTS `rbac_scope` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `scope` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rbac_scope`
--

INSERT INTO `rbac_scope` (`id`, `scope`) VALUES
(1, 'Project'),
(2, 'article');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `user_group_id` smallint(11) unsigned NOT NULL,
  `managing_id` int(10) unsigned NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `user_group_id`, `managing_id`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`) VALUES
(1, 'admin', '$2a$08$syYp5VsfOjtYOl0G7s.pPe6v7JBKeaZb/VD56aOsI5kjj7uWtJFCy', 'webmaster@project.com', 1, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, '127.0.0.1', '2013-03-24 20:23:14', '2013-02-18 16:50:23', '2013-03-24 14:53:14'),
(2, 'sample', '$2a$08$jVbDrPxGqWYWWorot5TG4u/trBIqQVzubBmqRfouOOJ19UOzs2yIS', 'sample@mail.com', 2, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, '127.0.0.1', '2013-03-24 20:20:33', '2013-03-24 20:19:49', '2013-03-24 14:50:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

CREATE TABLE IF NOT EXISTS `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `name` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(16) COLLATE utf8_bin DEFAULT NULL,
  `reset_flag` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `country`, `website`, `name`, `phone`, `reset_flag`) VALUES
(1, 1, NULL, NULL, 'Administrator', '9999999999', 0),
(2, 2, NULL, NULL, NULL, NULL, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
