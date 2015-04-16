-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: 10.246.16.224:3306
-- Generation Time: Apr 13, 2015 at 09:42 PM
-- Server version: 5.5.42-MariaDB-1~wheezy
-- PHP Version: 5.3.3-7+squeeze15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `valadan_co_uk`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(254) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `type` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `email`, `firstname`, `lastname`, `type`) VALUES
(6, 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'm.ellis8249@student.leedsmet.ac.uk', 'Mark', 'Ellis', 1),
(44, 'User1', 'b3daa77b4c04a9551b8781d03191fe098f325e67', 'm.ellis8249@student.leedsbeckett.ac.uk', '', '', 0),
(43, 'Student2', 'c241e7b7811ffbe3faba5b193717a46f9643eab1', 'm.ellis8249@student.leedsbeckett.ac.uk', '', '', 2),
(42, 'Student1', '2439e0457579ab4fd962cbd80b9206aca794cc38', 'm.ellis8249@student.leedsmet.ac.uk', '', '', 2),
(45, 'lolol', '403926033d001b5279df37cbbe5287b7c7c267fa', 'm.lol@lol.com', 'lol', 'lol', 0),
(46, 'l', '07c342be6e560e7f43842e2e21b774e61d85f047', 'm.lol@lo2l.com', 'l', 'l', 0),
(47, 'l', '07c342be6e560e7f43842e2e21b774e61d85f047', 'm.lol@lo3l.com', 'l', 'l', 0),
(48, 'o', '403926033d001b5279df37cbbe5287b7c7c267fa', 'pop@pop.com', 'lol', 'lol', 0),
(49, 'q', '07c342be6e560e7f43842e2e21b774e61d85f047', 'pop@lol.com', 'l', 'l', 0),
(50, 'lol', '912b06d941114c3c1c7bb81ff985fde92ac2e237', 'm.lol@la2l.com', 'lol', 'lol', 2),
(51, 'Mark2', 'c787c178b779f72fa0299df7435b734cf73c8973', 'mark_is_forever@hotmail.com', 'Mark', 'Ellis', 2),
(52, 'lmfao', '7b0b2d18b1a46dee43a336c877fb1a9404ad9e04', 'lol@lol.com', 'lol', 'lol', 2),
(53, 'student3', 'b65fb50fde35c72012fb85c728b0a8aea9d6d63c', 'm.ellis8249@studemmnt.leedsmet.ac.uk', 'Mark', 'Ellis', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
