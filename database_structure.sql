SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS `content`;
CREATE TABLE IF NOT EXISTS `content` (
  `content_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `nav_id` varchar(255) NOT NULL COMMENT 'used sorting content onto the proper page',
  `content_title` varchar(255) NOT NULL COMMENT 'Will display as the second navigation title',
  `menu_order` smallint(11) NOT NULL DEFAULT '1',
  `panel_content` text NOT NULL,
  PRIMARY KEY (`content_id`),
  KEY `nav_id` (`nav_id`),
  FULLTEXT KEY `content_title` (`content_title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

DROP TABLE IF EXISTS `navigation`;
CREATE TABLE IF NOT EXISTS `navigation` (
  `nav_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nav_title` text NOT NULL,
  PRIMARY KEY (`nav_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `navigation`
--

INSERT INTO `navigation` (`nav_id`, `nav_title`) VALUES
(1, 'Home'),
(2, 'Resume'),
(3, 'Artwork'),
(4, 'Thesis'),
(5, 'Programming'),
(6, 'Contact Info');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
