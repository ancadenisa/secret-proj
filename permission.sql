-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 09 Mai 2015 la 04:13
-- Versiune server: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `avizier`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(11) NOT NULL,
  `add_aviz` int(11) NOT NULL,
  `del_aviz` int(11) NOT NULL,
  `del_categ_aviz` int(11) NOT NULL,
  `modify_theme` int(11) NOT NULL,
  `users_alter` int(11) NOT NULL,
  `forum_answer` int(11) NOT NULL,
  `edit_aviz` int(11) NOT NULL,
  `add_categ_aviz` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `permission`
--

INSERT INTO `permission` (`id`, `add_aviz`, `del_aviz`, `del_categ_aviz`, `modify_theme`, `users_alter`, `forum_answer`, `edit_aviz`, `add_categ_aviz`) VALUES
(1, 1, 0, 0, 1, 0, 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
