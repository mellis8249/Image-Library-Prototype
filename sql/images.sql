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
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `ImageID` int(11) NOT NULL AUTO_INCREMENT,
  `ImageName` varchar(50) NOT NULL,
  `ImageDescription` varchar(50) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Author` varchar(50) NOT NULL,
  `Price` decimal(2,1) NOT NULL,
  `ImagePNG` varchar(200) NOT NULL,
  `Original` varchar(200) NOT NULL,
  `ImageWidth` int(5) NOT NULL,
  `ImageHeight` int(5) NOT NULL,
  `MegaPixels` decimal(3,1) NOT NULL,
  `DPIWidth200` decimal(3,1) NOT NULL,
  `DPIHeight200` decimal(3,1) NOT NULL,
  `DPIWidth300` decimal(3,1) NOT NULL,
  `DPIHeight300` decimal(3,1) NOT NULL,
  `ImageFile` blob NOT NULL,
  PRIMARY KEY (`ImageID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=98 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`ImageID`, `ImageName`, `ImageDescription`, `Category`, `Author`, `Price`, `ImagePNG`, `Original`, `ImageWidth`, `ImageHeight`, `MegaPixels`, `DPIWidth200`, `DPIHeight200`, `DPIWidth300`, `DPIHeight300`, `ImageFile`) VALUES
(97, 'Image8', 'Image8', 'Category4', 'student2', '9.0', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/watermarked/1552c2013c40b6_NGHQLPJMOIKFE.png', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/originals/1552c201532679_NQMGIFKPHOEJL.png', 1819, 1363, '2.5', '9.1', '6.8', '6.1', '4.5', 0x2f637573746f6d6572732f622f352f322f76616c6164616e2e636f2e756b2f2f68747470642e7777772f496d6167654c6962726172792f696e636c756465732f77617465726d61726b65642f31353532633230313363343062365f4e4748514c504a4d4f494b46452e706e67),
(96, 'Image7', 'Image7', 'Category3', 'student2', '5.0', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/watermarked/1552c1fede6419_KJLIOMNQHFGEP.png', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/originals/1552c1fee719fc_HONMLQEGPFIKJ.png', 1440, 900, '1.3', '7.2', '4.5', '4.8', '3.0', 0x2f637573746f6d6572732f622f352f322f76616c6164616e2e636f2e756b2f2f68747470642e7777772f496d6167654c6962726172792f696e636c756465732f77617465726d61726b65642f31353532633166656465363431395f4b4a4c494f4d4e5148464745502e706e67),
(94, 'Image5', 'Image5', 'Category1', 'student2', '6.0', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/watermarked/1552c1fb508e23_JPINHQLFGEOMK.png', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/originals/1552c1fb6321b3_EJNIOGHMLKFPQ.png', 1920, 1080, '2.1', '9.6', '5.4', '6.4', '3.6', 0x2f637573746f6d6572732f622f352f322f76616c6164616e2e636f2e756b2f2f68747470642e7777772f496d6167654c6962726172792f696e636c756465732f77617465726d61726b65642f31353532633166623530386532335f4a50494e48514c4647454f4d4b2e706e67),
(95, 'Image6', 'Image6', 'Category2', 'student2', '6.0', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/watermarked/1552c1fd0727b0_HQMJNKLOGEPFI.png', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/originals/1552c1fd1e0683_FOMNHEQKLJPIG.png', 1920, 1080, '2.1', '9.6', '5.4', '6.4', '3.6', 0x2f637573746f6d6572732f622f352f322f76616c6164616e2e636f2e756b2f2f68747470642e7777772f496d6167654c6962726172792f696e636c756465732f77617465726d61726b65642f31353532633166643037323762305f48514d4a4e4b4c4f47455046492e706e67),
(93, 'Image4', 'Image4', 'Category4', 'student1', '9.0', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/watermarked/1552c1c956d934_OJNKGHIPMEFQL.png', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/originals/1552c1c96c1c0b_QFGIMLJPHONKE.png', 1819, 1363, '2.5', '9.1', '6.8', '6.1', '4.5', 0x2f637573746f6d6572732f622f352f322f76616c6164616e2e636f2e756b2f2f68747470642e7777772f496d6167654c6962726172792f696e636c756465732f77617465726d61726b65642f31353532633163393536643933345f4f4a4e4b474849504d4546514c2e706e67),
(92, 'Image3', 'Image3', 'Category3', 'student1', '5.0', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/watermarked/1552c1c6d748bb_EHJPGMLQKNIFO.png', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/originals/1552c1c6e2581b_EFMQJIGHNPOKL.png', 1440, 900, '1.3', '7.2', '4.5', '4.8', '3.0', 0x2f637573746f6d6572732f622f352f322f76616c6164616e2e636f2e756b2f2f68747470642e7777772f496d6167654c6962726172792f696e636c756465732f77617465726d61726b65642f31353532633163366437343862625f45484a50474d4c514b4e49464f2e706e67),
(90, 'Image1', 'Image1', 'Category1', 'student1', '6.0', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/watermarked/1552c1c2b1b633_EGLKIFNOPQMJH.png', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/originals/1552c1c2c29e1d_HGQEPKNMIJOLF.png', 1920, 1080, '2.1', '9.6', '5.4', '6.4', '3.6', 0x2f637573746f6d6572732f622f352f322f76616c6164616e2e636f2e756b2f2f68747470642e7777772f496d6167654c6962726172792f696e636c756465732f77617465726d61726b65642f31353532633163326231623633335f45474c4b49464e4f50514d4a482e706e67),
(91, 'Image2', 'Image2', 'Category2', 'student1', '6.0', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/watermarked/1552c1c51ed494_JNKGEQPMIOFLH.png', '/customers/b/5/2/valadan.co.uk//httpd.www/ImageLibrary/includes/originals/1552c1c52e7746_HGJKNPIMQELOF.png', 1606, 1075, '1.7', '8.0', '5.4', '5.4', '3.6', 0x2f637573746f6d6572732f622f352f322f76616c6164616e2e636f2e756b2f2f68747470642e7777772f496d6167654c6962726172792f696e636c756465732f77617465726d61726b65642f31353532633163353165643439345f4a4e4b474551504d494f464c482e706e67);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
