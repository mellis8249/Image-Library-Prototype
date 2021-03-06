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
-- Table structure for table `thumbnails`
--

CREATE TABLE IF NOT EXISTS `thumbnails` (
  `ImageID` int(11) NOT NULL AUTO_INCREMENT,
  `ImageName` varchar(50) NOT NULL,
  `ImageDescription` varchar(50) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Author` varchar(50) NOT NULL,
  `ImageJPEG` varchar(200) NOT NULL,
  `ImageFile` blob NOT NULL,
  PRIMARY KEY (`ImageID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=98 ;

--
-- Dumping data for table `thumbnails`
--

INSERT INTO `thumbnails` (`ImageID`, `ImageName`, `ImageDescription`, `Category`, `Author`, `ImageJPEG`, `ImageFile`) VALUES
(97, 'Image8', 'Image8', 'Category4', 'student2', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/thumbnails/1552c2013a2d1e_EFQHPKOIMJLGN.jpeg', 0x2f637573746f6d6572732f622f352f322f76616c6164616e2e636f2e756b2f2f68747470642e7777772f496d6167654c6962726172792f696e636c756465732f7468756d626e61696c732f31353532633230313361326431655f45465148504b4f494d4a4c474e2e6a706567),
(96, 'Image7', 'Image7', 'Category3', 'student2', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/thumbnails/1552c1fedcdf20_PEMGOKIJHLNQF.jpeg', 0x2f637573746f6d6572732f622f352f322f76616c6164616e2e636f2e756b2f2f68747470642e7777772f496d6167654c6962726172792f696e636c756465732f7468756d626e61696c732f31353532633166656463646632305f50454d474f4b494a484c4e51462e6a706567),
(94, 'Image5', 'Image5', 'Category1', 'student2', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/thumbnails/1552c1fb4f0229_FHPMLOGKIENQJ.jpeg', 0x2f637573746f6d6572732f622f352f322f76616c6164616e2e636f2e756b2f2f68747470642e7777772f496d6167654c6962726172792f696e636c756465732f7468756d626e61696c732f31353532633166623466303232395f4648504d4c4f474b49454e514a2e6a706567),
(95, 'Image6', 'Image6', 'Category2', 'student2', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/thumbnails/1552c1fd06738c_IKGEMJFOQLPNH.jpeg', 0x2f637573746f6d6572732f622f352f322f76616c6164616e2e636f2e756b2f2f68747470642e7777772f496d6167654c6962726172792f696e636c756465732f7468756d626e61696c732f31353532633166643036373338635f494b47454d4a464f514c504e482e6a706567),
(93, 'Image4', 'Image4', 'Category4', 'student1', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/thumbnails/1552c1c9550230_NKGEHJQIOMFPL.jpeg', 0x2f637573746f6d6572732f622f352f322f76616c6164616e2e636f2e756b2f2f68747470642e7777772f496d6167654c6962726172792f696e636c756465732f7468756d626e61696c732f31353532633163393535303233305f4e4b4745484a51494f4d46504c2e6a706567),
(92, 'Image3', 'Image3', 'Category3', 'student1', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/thumbnails/1552c1c6d61ad8_HNPKLFMOEGJIQ.jpeg', 0x2f637573746f6d6572732f622f352f322f76616c6164616e2e636f2e756b2f2f68747470642e7777772f496d6167654c6962726172792f696e636c756465732f7468756d626e61696c732f31353532633163366436316164385f484e504b4c464d4f45474a49512e6a706567),
(90, 'Image1', 'Image1', 'Category1', 'student1', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/thumbnails/1552c1c2b0e733_HFNMEPGLQOJIK.jpeg', 0x2f637573746f6d6572732f622f352f322f76616c6164616e2e636f2e756b2f2f68747470642e7777772f496d6167654c6962726172792f696e636c756465732f7468756d626e61696c732f31353532633163326230653733335f48464e4d4550474c514f4a494b2e6a706567),
(91, 'Image2', 'Image2', 'Category2', 'student1', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/thumbnails/1552c1c51e539d_HLENFIMKPQJOG.jpeg', 0x2f637573746f6d6572732f622f352f322f76616c6164616e2e636f2e756b2f2f68747470642e7777772f496d6167654c6962726172792f696e636c756465732f7468756d626e61696c732f31353532633163353165353339645f484c454e46494d4b50514a4f472e6a706567);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
