-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2015 at 05:28 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `forum_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_description` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `cat_description`) VALUES
(1, 'Software', 'software community problems'),
(2, 'Hardware', 'Hardware problems'),
(3, 'Phillantropy', 'What is to a human'),
(4, 'Shits', 'More shits');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`id` int(11) NOT NULL,
  `post_content` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_topic` int(11) NOT NULL,
  `post_by` int(11) NOT NULL,
  `guest` varchar(50) DEFAULT NULL,
  `guest_email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_content`, `post_date`, `post_topic`, `post_by`, `guest`, `guest_email`) VALUES
(1, 'asdasdasd', '2015-04-24 19:47:40', 16, 19, 'guest', NULL),
(2, 'aaaaaaaaaaaaaaaa', '2015-04-24 19:47:40', 18, 19, 'guest', NULL),
(3, 'Haha kak taka', '2015-04-25 12:01:30', 15, 21, 'guest', NULL),
(4, 'Зддсадсад', '2015-04-25 12:06:16', 15, 21, 'guest', NULL),
(7, 'sadasdasd', '2015-04-25 18:48:24', 5, 21, 'asd', 'da@asd.vf'),
(8, 'Папо папо капо тапо', '2015-04-25 18:50:02', 5, 21, 'Папо', 'man@aaa.bg'),
(10, 'Te taka be momche', '2015-04-25 22:45:55', 21, 21, 'krotko', 'mladej@aaa.bf'),
(11, 'lalallaa', '2015-04-26 18:01:31', 30, 22, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
`id` int(11) NOT NULL,
  `topic_subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `topic_description` text NOT NULL,
  `topic_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic_cat` int(11) NOT NULL,
  `topic_by` int(11) NOT NULL,
  `visits` int(11) NOT NULL DEFAULT '0',
  `topic_tags` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `topic_subject`, `topic_description`, `topic_date`, `topic_cat`, `topic_by`, `visits`, `topic_tags`) VALUES
(1, 'Kak da si instaliram composer', 'Iskam da znam kak, towa e !', '2015-04-22 18:16:51', 1, 21, 0, NULL),
(2, 'Kolko struva edin kon?', 'Suztezatelen kon.', '2015-04-22 18:16:51', 2, 21, 0, NULL),
(5, 'proba proba', 'probvam dali shte se dublira', '2015-04-22 19:01:22', 1, 21, 0, NULL),
(11, 'Proba', 'Test test', '2015-04-23 19:08:01', 2, 19, 0, 'test'),
(15, 'ЗДРАСТИ', 'тата', '2015-04-23 19:18:07', 1, 19, 0, ''),
(16, 'What is to be human?', 'Hi everybody, I''m Benjamin X!', '2015-04-23 23:52:35', 3, 19, 0, 'hi human'),
(17, 'What is to be human?', 'Hi everybody, I''m Benjamin X!', '2015-04-23 23:53:26', 3, 19, 0, 'hi human'),
(18, 'Stupid fuckers', 'asldkjsad  MOTHER FUCKERS', '2015-04-24 17:46:47', 4, 19, 0, ''),
(20, 'Друга проба', 'Тестване на кирилицатааа!', '2015-04-24 18:13:24', 3, 19, 0, ''),
(21, 'PHP forum template', 'This is my new template', '2015-04-24 18:44:28', 1, 19, 0, 'php'),
(22, 'Аз съм нова тема това е моето заглавие', 'Това е моя кирилизиран текст.', '2015-04-24 18:46:49', 3, 19, 0, ''),
(23, 'Колко ти е часа?', 'Часът е 11:01. Времето е леко дъждовно.', '2015-04-25 11:01:55', 4, 22, 0, 'време час'),
(24, 'Pak opitvam neshto', 'Iskame da stane i pravim proba .', '2015-04-25 21:31:32', 3, 19, 0, ''),
(25, 'The virtuosity in war', 'War against the whole human kind proba moba.', '2015-04-25 21:32:50', 1, 19, 0, ''),
(26, 'I''m new in the city', 'Hi, would you be pleased to go out with me, I don''t know anybody here. Thank You!', '2015-04-26 17:52:51', 3, 22, 0, ''),
(27, 'I''m new in the city', 'Hi, would you be pleased to go out with me, I don''t know anybody here. Thank You!', '2015-04-26 17:54:18', 3, 22, 0, ''),
(28, 'I''m new in the city', 'Hi, would you be pleased to go out with me, I don''t know anybody here. Thank You!', '2015-04-26 17:55:14', 3, 22, 0, ''),
(29, 'I''m new in the city', 'Hi, would you be pleased to go out with me, I don''t know anybody here. Thank You!', '2015-04-26 17:55:32', 3, 22, 0, ''),
(30, 'Dublirane', 'Kofti moment', '2015-04-26 17:56:23', 1, 22, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `date_registered`, `is_admin`) VALUES
(18, 'Pesho', '8588310a98676af6e22563c1559e1ae20f85950792bdcd0c8f334867c54581cd', 'pesho@pesh.com', '2015-04-22 15:12:46', 0),
(19, 'Anton', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'anton@anton.com', '2015-04-22 15:12:58', 1),
(20, 'Gosho', '02359ffb8eb977c499d03c598de268df19edb14236fd3514dcf5344fcdd43833', 'pesho@pesh.com', '2015-04-22 15:26:43', 0),
(21, 'guest', 'sadhikjashduiasd', 'guest@abv.bg', '2015-04-22 18:13:31', 0),
(22, 'iva', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'ivo@abv.bg', '2015-04-24 16:38:13', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `cat_name` (`cat_name`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`), ADD KEY `post_topic` (`post_topic`), ADD KEY `post_by` (`post_by`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
 ADD PRIMARY KEY (`id`), ADD KEY `topic_cat` (`topic_cat`), ADD KEY `topic_by` (`topic_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_topic`) REFERENCES `topics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`post_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`topic_cat`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`topic_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
