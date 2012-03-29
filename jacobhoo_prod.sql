-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 29, 2012 at 09:12 AM
-- Server version: 5.1.61
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jacobhoo_prod`
--

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`content_id`, `nav_id`, `content_title`, `menu_order`, `panel_content`) VALUES
(6, 'resume', 'Cover Letter', 1, '<p>I am currently working in the IT sector as a Technical Support Agent, and have experience as a Quality Assurance Specialist, and am interested in expanding my skills and knowledge as a programme developer.</p>\r\n<p>\r\nMy resume provides a detailed list of my experience in programming languages, most notably: HTML, CSS, JAVA and FORTRAN. I am currently learning javascript from the site codeacademy.com as I have taken on their CodeYear challenge.</p>\r\n<p>\r\nIn my present and past positions I have used programming to accomplish a number of tasks, such as learning ASP to update company Intranet websites or using my knowledge of JAVA to test bugs while doing Quality Assurance.\r\n</p>\r\n<p>\r\nI am an enthusiastic, quick learner and I believe I would be a valuable asset to any organization. I invite you to visit my website jacobhooey.com, a personal blog designed and coded entirely by myself.\r\n</p>\r\n<p>\r\nFeel free to contact me at your convenience. I would be pleased to meet with you to discuss employment possibilities with your company.\r\n</p>\r\n<p>\r\nSincerely, <br />\r\nJacob Hooey\r\n</p>'),
(7, 'resume', 'Skills', 2, '<h3>Languages</h3>\r\n<ul>\r\n<li>\r\nEnglish\r\n</li>\r\n<li>\r\nFrench\r\n</li>\r\n</ul>\r\n<h3>Computer Skills</h3>\r\n\r\n<table>\r\n<tr >\r\n<td>\r\nProgramming Languages\r\n</td>\r\n<td>\r\nHTML, CSS, JavaScript, mySQL, PHP, Java,  C++,  IDL, Fortran, ASP,  MIPS assembly \r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\nProgramming Tools\r\n</td>\r\n<td>\r\nGit (CVS), Github, Filezilla (ftp), Cloud9, Kodingen, Netbeans, Notepad++, Wordpress\r\n</td>\r\n</tr>\r\n<tr >\r\n<td>\r\nOperating Systems\r\n</td>\r\n<td>\r\nWindows XP and 7, Linux (Mint and Ubuntu), Mac OSX\r\n</td>\r\n</tr>\r\n<tr >\r\n<td>\r\nSoftware\r\n</td>\r\n<td>\r\nActive Directory, Adobe Suite, Hummingbird DM, Internet Explorer,  Lotus Notes, Microsoft Office Suite, PeopleSoft,  Printers and Printer Drivers, Remote Assistance, Remote Desktop, Manage Engine ServiceDesk, Smart Sync, Test Track (Bug reporting Tool), VMware, Word Perfect\r\n</td>\r\n</tr>\r\n</table>'),
(8, 'resume', 'Work Experience', 3, '<span style="float:left;"><h4>May 2011 - April 2012</h4></span><span style="float:right;"><h4>Canada Industrial Relations Board, Ottawa</h4></span><br /><br />\r\n<h3>Technical Support</h3>\r\n<ul>\r\n<li>In this Bilingual position I respond to technical questions regarding computer hardware and software problems within the company over the phone, using Remote Assist or in person.</li>\r\n<li>Trained Clients in the use of the Smart Sync teaching software.</li>\r\n<li>Create, modify and close trouble tickets </li>\r\n<li>Delegate trouble tickets to the appropriate support department. </li>\r\n<li>Edit ASP pages for our Intranet, including LDAP Queries to populate a telephone list </li>\r\n<li>Upgrade and image new computers for every staff member.</li>\r\n<li>Keep detailed notes of a problem for Team Members to reference</li>\r\n</ul>\r\n\r\n\r\n<span style="float:left;"><h4>January 2011 - April 2011</h4></span><span style="float:right;"><h4>Health Canada, Ottawa</h4></span><br /><br />\r\n<h3>Computer Programming Analyst</h3>\r\n<ul>\r\n<li>Entered Department Trees and Location Codes into PeopleSoft.</li>\r\n<li>Mapped department tree structure from HR Advantage to PeopleSoft.</li>\r\n<li>Created a Change Management Control process and drafted a Change Request form.</li>\r\n<li>Drafted a proposal for the format of the Department Tree within PeopleSoft. </li>\r\n</ul>\r\n\r\n<span style="float:left;"><h4>March 2010 - November 2010</h4></span><span style="float:right;"><h4>TASKE Technology, Ottawa</h4></span><br /><br />\r\n<h3>Quality Assurance Specialist</h3>\r\n<ul>\r\n<li>Worked with mySQL and Java to test the TASKE Call Center Software for bugs and inconsistent results and reported them back to the software developers.</li>\r\n<li>Assembled Avaya Communication Manager Servers and tested the company’s software integration with the Avaya System. (Also did some testing on CISCO Systems).</li>\r\n</ul>\r\n\r\n<span style="float:left;"><h4>September 2008 - May 2009</h4></span><span style="float:right;"><h4>Bishop’s University, Ottawa</h4></span><br /><br />\r\n<h3>Technical Support</h3>\r\n<ul>\r\n<li>Set up technical equipment on campus and  gave tutorials regarding the proper use of this equipment</li>\r\n<li>Trained customers in the use of Microsoft Office 2007.</li>\r\n<li>Managed the Bishop’s University computer labs.</li>\r\n</ul>\r\n\r\n<span style="float:left;"><h4>April 2008 – September 2008</h4></span><span style="float:right;"><h4>Bishop’s University, Ottawa</h4></span><br /><br />\r\n<h3>Student Research Assistant</h3>\r\n <ul>\r\n<li>Researched Binary Star Systems and Cataclysmic Variables</li>\r\n<li>Saved hours of manual data entry by using FORTRAN and IDL to program a function that automatically graphed the results for each set of results of our astrometrical simulations</li>\r\n</ul>'),
(9, 'resume', 'Education', 4, '<div style="width:90%;margin:auto;">\r\n<div style="float:left;width:20%;">\r\nBishop’s University <br />\r\nBSc: Honours Physics, <br />\r\nMathematics Minor <br />\r\n2006 – 2009	\r\n</div>\r\n<div style="float:right;width:80%;">\r\nPhysics Honours Thesis: On the Nature of Dynamical Instabilities in Interacting Binary Star Systems (Cataclysmic  Variables)\r\nProgrammed astrometrical computer simulations in FORTRAN for my Thesis \r\nServed on the committee that was involved in hiring a professor for the Physics Department\r\n</div>\r\n<div style="clear:both;">\r\n<div style="float:left;width:50%;">\r\nHeritage College (Cégep) <br />\r\nDiploma, Pure and Applied Sciences <br />\r\n2004 – 2006	\r\n</div>\r\n<div style="float:right;width:50%;">\r\nPhilemon Wright High School <br />\r\nHigh School Diploma <br />\r\n2001 – 2004\r\n</div>\r\n</div>\r\n</div>'),
(10, 'resume', 'Awards and Scholarships', 5, '<i>\r\n<p>\r\nUndergraduate Student Research Award (USRA)\r\n</p>\r\n<p>\r\nBishop’s Faculty Prize in Physics\r\n</p>\r\n<p>\r\nInducted into the Golden Key Honours Society\r\n</p>\r\n<p>\r\nBishops University Entrance Scholarship (renewed every year)	\r\n</p>\r\n</i>'),
(11, 'artwork', 'Under Construction', 1, 'Under Construction'),
(12, 'thesis', 'Under Construction', 1, 'Under Construction'),
(13, 'programming', 'Under Construction', 1, 'Under Construction'),
(14, 'contact', 'Under Construction', 1, 'Under Construction'),
(15, 'home', 'Under Construction', 1, 'Under Construction');

-- --------------------------------------------------------

--
-- Table structure for table `navigation`
--

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
