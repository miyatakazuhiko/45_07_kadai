-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018 年 5 朁E31 日 23:16
-- サーバのバージョン： 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kadai_07`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `kadai_07_table`
--

CREATE TABLE IF NOT EXISTS `kadai_07_table` (
`No` int(12) NOT NULL,
  `書籍名` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `書籍URL` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `書籍コメント` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `登録日時` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `kadai_07_table`
--

INSERT INTO `kadai_07_table` (`No`, `書籍名`, `書籍URL`, `書籍コメント`, `登録日時`) VALUES
(1, 'ガールズ＆パンツァー', 'http://girls-und-panzer-finale.jp/', 'かわいい。', '2018-05-29 02:55:08'),
(13, 'HELLSING', 'https://ja.wikipedia.org/wiki/HELLSING', '命令は唯ひとつ「サーチ＆デストロイ」以上', '2018-05-29 03:00:56'),
(15, 'あああああああああああああああああああああああああああああああああああ', 'ああああああああああああああああああああああああああああああああああああああ', '5454545', '2018-05-30 04:50:30'),
(16, 'あああああああああああああああああああああああああああああああああああ', 'ああああああああああああああああああああああああああああああああああああああ', '5454545', '2018-05-30 04:50:58'),
(17, 'あああああああああああああああああああああああああああああああああああ', 'いおお', '5555', '2018-05-30 04:51:46'),
(18, 'aaa', 'aaa', 'aaa', '2018-05-31 03:01:52'),
(21, 'a', 'a', 'a', '2018-05-31 03:44:33'),
(22, 'a', 'a', 's', '2018-05-31 03:44:41'),
(23, 'a', 'a', 'a', '2018-05-31 03:44:46'),
(24, 's', 's', 's', '2018-05-31 03:44:56'),
(25, 'aaa', 'kk', 'kk', '2018-05-31 05:21:19'),
(26, 'aa', 'aa', 'aa', '2018-05-31 09:08:28'),
(27, 'あああああああああああああああああああああああああああああああああああ', 'ああああああああああああああああああああああああああああああああああああああ', 'kkkkk', '2018-05-31 09:14:40'),
(28, 'ガールズ＆パンツァー', 'http://girls-und-panzer-.jp/', 'かわいい。', '2018-05-31 20:57:41'),
(29, 'ガールズ＆パンツァー', 'http://girls-und-panzer-.', 'かわいい。', '2018-05-31 20:57:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kadai_07_table`
--
ALTER TABLE `kadai_07_table`
 ADD PRIMARY KEY (`No`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kadai_07_table`
--
ALTER TABLE `kadai_07_table`
MODIFY `No` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
