-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 06, 2013 at 01:59 PM
-- Server version: 5.5.32-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `telerik_messages`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `message` varchar(250) NOT NULL,
  `created` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `title`, `message`, `created`, `user_id`) VALUES
(11, 'Cum tincidunt mid amet', 'Cum tincidunt mid amet, turpis, augue a pid amet aenean habitasse nec vel odio? Dolor odio proin sed, montes, vut amet ac, porttitor nisi. Pellentesque velit ut eros sit amet,', '2013-10-06 13:57:15', 5),
(10, 'Lorem Ipsum', 'Nunc cursus! Ultrices enim etiam nisi elementum! Urna sit magnis sed parturient etiam! Et sed, augue, a a ac? Lacus elementum, turpis? Rhoncus! Porttitor habitasse a. Dis, sed vut est? Dignissim et, parturient?', '2013-10-06 13:56:42', 5),
(12, 'Elit lorem parturient', 'Elit lorem parturient, diam, aliquam lorem ultrices? Penatibus ultrices! Montes pulvinar pulvinar proin parturient ac porta ultrices a scelerisque. Ut egestas sed cursus!', '2013-10-06 13:57:35', 6),
(13, 'Dictumst porta', 'Dictumst porta amet lectus ultricies placerat! Etiam ac? Pulvinar, lundium nisi! Nec, mattis in sit magna, tincidunt! Eros. Mauris tincidunt in pid montes pellentesque?', '2013-10-06 13:58:01', 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_admin` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `is_admin`) VALUES
(7, 'tester', 'tester', 0),
(6, 'qwerty', 'qwerty', 0),
(5, 'admin', 'admin', 1),
(9, '12345', '12345', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
