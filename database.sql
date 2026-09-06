-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 17, 2024 at 02:02 PM
-- Server version: 5.7.43-log
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `streamapi-lite`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `display_name` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `display_name`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'codenine', 'admin', '$2y$10$Y3kj67BEKw1gPPKvLVRHFONvwLzCOtR67dTxunlq9eaz3WJjzH7Qy', '2022-02-14 15:48:50', '2022-02-14 15:48:50');

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(10) UNSIGNED NOT NULL,
  `page` enum('home','embed','view','download','link') NOT NULL DEFAULT 'home',
  `position` varchar(50) DEFAULT NULL,
  `ad_code` text,
  `type` enum('banner','popad','','') NOT NULL DEFAULT 'banner',
  `status` enum('active','paused') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `page`, `position`, `ad_code`, `type`, `status`) VALUES
(1, 'home', 'top', '', 'banner', 'active'),
(2, 'home', 'player-right', '', 'banner', 'active'),
(3, 'home', 'player-bottom', '', 'banner', 'active'),
(4, 'home', NULL, '', 'popad', 'active'),
(5, 'view', 'player-top', '', 'banner', 'active'),
(6, 'view', 'player-bottom', '', 'banner', 'active'),
(7, 'view', NULL, '', 'popad', 'active'),
(8, 'download', 'title-bottom', '', 'banner', 'active'),
(9, 'download', 'links-group-middle', '', 'banner', 'active'),
(10, 'download', NULL, '', 'popad', 'active'),
(11, 'link', 'counter-top', '', 'banner', 'active'),
(12, 'link', 'counter-bottom', '', 'banner', 'active'),
(13, 'link', NULL, '', 'popad', 'active'),
(14, 'embed', NULL, '', 'popad', 'active'),
(15, 'view', 'sidebar', '', 'banner', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `failed_movies`
--

CREATE TABLE `failed_movies` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `tmdb_id` varchar(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `type` enum('movie','episode','series') DEFAULT 'movie',
  `imdb_id` varchar(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `requests` int(10) UNSIGNED DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `failed_movies`
--

INSERT INTO `failed_movies` (`id`, `title`, `tmdb_id`, `created_at`, `type`, `imdb_id`, `updated_at`, `requests`) VALUES
(13, '聖女の魔力は万能です', '115236', '2024-01-08 04:52:23', 'series', 'tt13049906', '2024-01-08 04:52:23', 1),
(15, 'The Biggest Little Farm: The Return', '927085', '2024-01-08 20:57:46', 'movie', 'tt17048514', '2024-01-08 20:57:46', 1),
(16, 'And Starring Pancho Villa as Himself', '24241', '2024-01-08 21:40:10', 'movie', 'tt0337824', '2024-01-08 21:40:10', 1),
(17, 'Terminator Genisys', '87101', '2024-01-08 21:40:18', 'movie', 'tt1340138', '2024-01-08 21:40:18', 1),
(18, 'The Wedding in the Hamptons', '1052931', '2024-01-08 21:40:38', 'movie', 'tt21816848', '2024-01-08 21:41:22', 2),
(19, 'Ride Along 2', '323675', '2024-01-08 21:40:46', 'movie', 'tt2869728', '2024-01-08 21:43:08', 2),
(20, 'Bitconned', '1213997', '2024-01-08 21:40:53', 'movie', 'tt30317302', '2024-01-08 21:40:53', 1),
(21, 'An Impossible Project', '662904', '2024-01-08 21:40:54', 'movie', 'tt6477262', '2024-01-08 21:40:54', 1),
(22, 'Kidnapped', '48393', '2024-01-08 21:40:58', 'movie', 'tt1629377', '2024-01-08 21:40:58', 1),
(23, 'Spookies', '26679', '2024-01-08 21:41:08', 'movie', 'tt0090057', '2024-01-08 21:41:08', 1),
(24, 'For One Night', '212067', '2024-01-08 21:41:10', 'movie', 'tt0463996', '2024-01-08 21:41:10', 1),
(25, 'The Intouchables', '77338', '2024-01-08 21:41:19', 'movie', 'tt1675434', '2024-01-08 21:41:19', 1),
(27, 'Sirens', '12519', '2024-01-08 21:41:39', 'movie', 'tt0111201', '2024-01-08 21:41:39', 1),
(28, 'Breakin\' All the Rules', '16428', '2024-01-08 21:41:44', 'movie', 'tt0349169', '2024-01-08 21:41:44', 1),
(29, 'The Hunger Games: Mockingjay - Part 1', '131631', '2024-01-08 21:41:47', 'movie', 'tt1951265', '2024-01-08 21:41:47', 1),
(31, 'The Uninvited Guest', '48594', '2024-01-08 21:41:48', 'movie', 'tt0436374', '2024-01-08 21:41:48', 1),
(32, 'Dardara', '797233', '2024-01-08 21:41:58', 'movie', 'tt14156926', '2024-01-08 21:41:58', 1),
(33, 'The Twilight Saga: Breaking Dawn - Part 2', '50620', '2024-01-08 21:42:04', 'movie', 'tt1673434', '2024-01-08 21:42:04', 1),
(34, 'Astro Loco', '865745', '2024-01-08 21:42:08', 'movie', 'tt4446228', '2024-01-08 21:42:08', 1),
(35, 'Tomorrowland', '158852', '2024-01-08 21:42:23', 'movie', 'tt1964418', '2024-01-08 21:42:23', 1),
(38, 'Jumanji: The Next Level', '512200', '2024-01-08 21:42:32', 'movie', 'tt7975244', '2024-01-08 21:42:32', 1),
(39, 'Hombre', '27945', '2024-01-08 21:42:34', 'movie', 'tt0061770', '2024-01-08 21:42:34', 1),
(40, 'Days of Thunder', '2119', '2024-01-08 21:42:35', 'movie', 'tt0099371', '2024-01-08 21:42:35', 1),
(41, 'Aquaman', '297802', '2024-01-08 21:42:40', 'movie', 'tt1477834', '2024-01-08 21:42:40', 1),
(42, 'Baby Boy', '16161', '2024-01-08 21:42:40', 'movie', 'tt0255819', '2024-01-08 21:42:40', 1),
(43, 'Migration', '940551', '2024-01-08 21:42:45', 'movie', 'tt6495056', '2024-01-08 21:42:45', 1),
(44, 'Amber\'s Descent', '747319', '2024-01-08 21:42:59', 'movie', 'tt8660656', '2024-01-08 21:42:59', 1),
(45, 'Casablanca Beats', '575764', '2024-01-08 21:43:01', 'movie', 'tt14773800', '2024-01-08 21:43:01', 1),
(46, 'Believer 2', '958263', '2024-01-08 21:43:07', 'movie', 'tt26258204', '2024-01-08 21:43:07', 1),
(47, 'Napoleon', '753342', '2024-01-08 21:43:31', 'movie', 'tt13287846', '2024-01-08 21:43:37', 2),
(48, 'The Killer', '800158', '2024-01-08 21:43:34', 'movie', 'tt1136617', '2024-01-08 21:43:34', 1),
(49, 'The Last Starship', '406285', '2024-01-08 21:43:39', 'movie', 'tt6143290', '2024-01-08 21:43:39', 1),
(50, 'Gallows Road', '350641', '2024-01-08 21:43:41', 'movie', 'tt3100052', '2024-01-08 21:43:41', 1),
(51, 'Meg 2: The Trench', '615656', '2024-01-08 21:43:43', 'movie', 'tt9224104', '2024-01-08 21:43:43', 1),
(52, 'Living in Oblivion', '9071', '2024-01-08 21:43:44', 'movie', 'tt0113677', '2024-01-08 21:43:44', 1),
(53, 'Dawn of the Dead', '924', '2024-01-08 21:43:45', 'movie', 'tt0363547', '2024-01-08 21:43:45', 1),
(54, 'The Nun II', '968051', '2024-01-08 21:43:51', 'movie', 'tt10160976', '2024-01-08 21:43:51', 1),
(55, 'Auld Lang Syne', '426638', '2024-01-08 21:44:10', 'movie', 'tt4779884', '2024-01-08 21:44:10', 1),
(56, 'Godzilla Minus One', '940721', '2024-01-08 21:44:12', 'movie', 'tt23289160', '2024-01-08 21:44:12', 1),
(57, 'Finestkind', '507532', '2024-01-08 21:44:28', 'movie', 'tt7991508', '2024-01-08 21:44:28', 1),
(58, 'Gregory\'s Girl', '21764', '2024-01-08 21:44:28', 'movie', 'tt0082477', '2024-01-08 21:44:28', 1),
(59, 'Psycho', '539', '2024-01-08 21:44:30', 'movie', 'tt0054215', '2024-01-08 21:44:30', 1),
(60, 'The Barefoot Executive', '20173', '2024-01-08 21:44:40', 'movie', 'tt0066811', '2024-01-08 21:44:40', 1),
(61, 'Battle for Saipan', '1037644', '2024-01-08 21:44:41', 'movie', 'tt17156822', '2024-01-08 21:44:41', 1),
(62, 'Feeling Minnesota', '12656', '2024-01-08 21:44:42', 'movie', 'tt0116289', '2024-01-08 21:44:42', 1),
(64, 'The Batman', '414906', '2024-01-08 21:44:56', 'movie', 'tt1877830', '2024-01-08 21:44:56', 1),
(65, 'The Equalizer 3', '926393', '2024-01-08 21:45:07', 'movie', 'tt17024450', '2024-01-08 21:45:07', 1),
(66, 'Tin & Tina', '943930', '2024-01-08 21:45:08', 'movie', 'tt7354440', '2024-01-08 21:45:08', 1),
(67, 'Ocean\'s Eleven', '161', '2024-01-08 21:45:08', 'movie', 'tt0240772', '2024-01-08 21:45:08', 1),
(68, 'Child\'s Play', '82465', '2024-01-08 21:45:09', 'movie', 'tt0068369', '2024-01-08 21:45:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(128) NOT NULL,
  `deleted_at` datetime(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`, `deleted_at`) VALUES
(34, 'action', NULL),
(35, 'adventure', NULL),
(36, 'animation', NULL),
(37, 'comedy', NULL),
(38, 'crime', NULL),
(39, 'documentary', NULL),
(40, 'drama', NULL),
(41, 'family', NULL),
(42, 'fantasy', NULL),
(43, 'history', NULL),
(44, 'horror', NULL),
(45, 'mystery ', NULL),
(46, 'romance', NULL),
(47, 'thriller', NULL),
(48, 'sci-fi', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `genre_translations`
--

CREATE TABLE `genre_translations` (
  `id` int(11) UNSIGNED NOT NULL,
  `genre_id` int(11) UNSIGNED NOT NULL,
  `lang` varchar(11) COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` int(11) UNSIGNED NOT NULL,
  `movie_id` int(11) UNSIGNED NOT NULL,
  `api_id` int(10) UNSIGNED DEFAULT NULL,
  `link` varchar(255) NOT NULL,
  `is_broken` tinyint(4) NOT NULL DEFAULT '0',
  `type` enum('stream','direct_download','torrent_download') DEFAULT 'direct_download',
  `resolution` varchar(30) DEFAULT NULL,
  `quality` varchar(30) DEFAULT NULL,
  `requests` int(10) UNSIGNED DEFAULT '0',
  `size_val` varchar(11) DEFAULT '0',
  `size_lbl` enum('MB','GB') NOT NULL DEFAULT 'MB',
  `reports_not_working` tinyint(3) UNSIGNED DEFAULT '0',
  `reports_wrong_link` tinyint(3) UNSIGNED DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `movie_id`, `api_id`, `link`, `is_broken`, `type`, `resolution`, `quality`, `requests`, `size_val`, `size_lbl`, `reports_not_working`, `reports_wrong_link`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'https://player.streamapi.info/video/JUT9o8E51m5c5GX', 0, 'stream', NULL, NULL, 20, '0', 'MB', 0, 0, '2023-12-31 10:29:05', '2024-01-16 10:17:59'),
(2, 1, NULL, 'https://dl.streamapi.info/dl/1BCkuVLh-GFKuYpoQVic6aGH9NQT9-TL0/stream.api', 0, 'direct_download', '1080p', 'Bluray', 0, '1.65', 'GB', 0, 0, '2023-12-31 10:29:05', '2023-12-31 10:29:05'),
(3, 2, NULL, 'https://player.streamapi.info/video/XsaE57lSr3mqYl3', 0, 'stream', NULL, NULL, 10, '0', 'MB', 0, 0, '2023-12-31 10:42:37', '2024-01-12 03:29:12'),
(4, 2, NULL, 'https://dl.streamapi.info/dl/180UKOWHZwOX75STcx1Jg0vELbfnsufAV/stream.api', 0, 'direct_download', '1080p', 'BRRір', 0, '2.35', 'GB', 0, 0, '2023-12-31 10:42:37', '2023-12-31 10:42:37'),
(5, 3, NULL, 'https://player.streamapi.info/video/bsTbP7ZFsSqD1OY', 0, 'stream', NULL, NULL, 5, '0', 'MB', 0, 0, '2024-01-01 02:05:30', '2024-01-01 02:26:46'),
(6, 3, NULL, 'https://dl.streamapi.info/dl/1vElY8WsxXQxRljsttHRQdSxUlXtt44Ky/stream.api', 0, 'direct_download', '1080p', 'Bluray', 0, '2.18', 'GB', 0, 0, '2024-01-01 02:15:24', '2024-01-01 02:15:24'),
(7, 4, NULL, 'https://player.streamapi.info/video/WF9awrbjMx0zcVg', 0, 'stream', NULL, NULL, 3, '0', 'MB', 0, 0, '2024-01-01 02:40:02', '2024-01-04 12:20:23'),
(8, 4, NULL, 'https://dl.streamapi.info/dl/1JycQUZ3_Rp42h1AzFm0yVwzcG2lpGsIi/stream.api', 0, 'direct_download', '1080p', 'BRRір', 0, '1.83', 'GB', 0, 0, '2024-01-01 02:40:02', '2024-01-01 02:40:02'),
(9, 5, NULL, 'https://player.streamapi.info/video/92RjaV3SPNBe4Ih', 0, 'stream', NULL, NULL, 2, '0', 'MB', 0, 0, '2024-01-01 04:12:44', '2024-01-01 14:45:40'),
(10, 5, NULL, 'https://dl.streamapi.info/dl/1r6hZwAjBy-BivyWSsIi6_riSWNEqDj5K/stream.api', 0, 'direct_download', '720p', 'BRRір', 0, '1.34', 'GB', 0, 0, '2024-01-01 04:12:44', '2024-01-01 04:12:44'),
(11, 6, NULL, 'https://player.streamapi.info/video/2He2CYKFsWC0K8G', 0, 'stream', NULL, NULL, 1, '0', 'MB', 0, 0, '2024-01-01 04:23:01', '2024-01-01 04:23:16'),
(12, 6, NULL, 'https://dl.streamapi.info/dl/1K0pm4Tuvf8jc1qgTnfMq7hZ2kz0rULMJ/stream.api', 0, 'direct_download', '1080p', 'Bluray', 0, '893.38', 'MB', 0, 0, '2024-01-01 04:23:01', '2024-01-01 04:23:01'),
(13, 7, NULL, 'https://player.streamapi.info/video/BL2CZJDNzQD1jZj', 0, 'stream', NULL, NULL, 10, '0', 'MB', 0, 0, '2024-01-01 04:31:23', '2024-01-04 17:17:41'),
(14, 7, NULL, 'https://dl.streamapi.info/dl/1QSsN1I6fTFhHwlZOsKIjp_I-8r4KrFsX/stream.api', 0, 'direct_download', '1080p', 'Bluray', 0, '1.86', 'GB', 0, 0, '2024-01-01 04:31:23', '2024-01-01 04:31:23'),
(15, 8, NULL, 'https://player.streamapi.info/video/eLCVB6kzkmmHzHm', 0, 'stream', NULL, NULL, 13, '0', 'MB', 0, 0, '2024-01-01 07:30:57', '2024-01-16 08:28:32'),
(16, 8, NULL, 'https://dl.streamapi.info/dl/1CG9sn-FoJIwFWsKBLg6xFCDjrd8Sski7/stream.api', 0, 'direct_download', '1080p', 'Bluray', 0, '1.77', 'GB', 0, 0, '2024-01-01 07:30:57', '2024-01-01 07:30:57'),
(17, 9, NULL, 'https://player.streamapi.info/video/Vso0QoGkEm6U3hH', 0, 'stream', NULL, NULL, 3, '0', 'MB', 0, 0, '2024-01-01 10:41:11', '2024-01-16 21:30:03'),
(18, 9, NULL, 'https://dl.streamapi.info/dl/1nepPnXvHDHKBlzxMSSITNFNdNnEXgnIt/stream.api', 0, 'direct_download', '1080p', 'BRRір', 0, '2.31', 'GB', 0, 0, '2024-01-01 10:41:11', '2024-01-01 10:41:11'),
(19, 10, NULL, 'https://player.streamapi.info/video/R2MMbP19eV5rjpm', 0, 'stream', NULL, NULL, 23, '0', 'MB', 0, 0, '2024-01-01 11:20:31', '2024-01-11 22:35:46'),
(20, 10, NULL, 'https://dl.streamapi.info/dl/1wpye784z52bn71k3zbRqSBCDbW7SUOQA/stream.api', 0, 'direct_download', '1080p', 'WEB-DL', 0, '1.58', 'GB', 0, 0, '2024-01-01 11:20:31', '2024-01-01 11:20:31'),
(21, 11, NULL, 'https://player.streamapi.info/video/0mNNXPCWzzlikam', 0, 'stream', NULL, NULL, 1, '0', 'MB', 0, 0, '2024-01-03 03:35:16', '2024-01-03 03:35:34'),
(22, 11, NULL, 'https://dl.streamapi.info/dl/1sJvH2WgPy4Sjz3nWkwPHM8sTdtGzf8P-/stream.api', 0, 'direct_download', '1080p', 'Bluray', 0, '1.69', 'GB', 0, 0, '2024-01-03 03:35:16', '2024-01-03 03:35:16'),
(23, 12, NULL, 'https://player.streamapi.info/video/R03DesjkIOTkQy5', 0, 'stream', NULL, NULL, 4, '0', 'MB', 0, 0, '2024-01-03 03:43:28', '2024-01-13 15:50:00'),
(24, 12, NULL, 'https://dl.streamapi.info/dl/1Z6YYHNSQAvJszGtMkX2dZB6vM9FU02J8/stream.api', 0, 'direct_download', '720p', 'BRRір', 0, '1.04', 'GB', 0, 0, '2024-01-03 03:43:28', '2024-01-03 03:43:28'),
(25, 13, NULL, 'https://player.streamapi.info/video/wzdA9A4vt7Ga6i3', 0, 'stream', NULL, NULL, 4, '0', 'MB', 0, 0, '2024-01-03 03:49:30', '2024-01-07 12:53:09'),
(26, 13, NULL, 'https://dl.streamapi.info/dl/1RR2WqtDAVVlmIKu5xJX-h2NzeN06NLGg/stream.api', 0, 'direct_download', '1080p', 'Bluray', 0, '1.05', 'GB', 0, 0, '2024-01-03 03:49:30', '2024-01-03 03:49:30'),
(27, 14, NULL, 'https://player.streamapi.info/video/ZOaJqMZdSuBLneX', 0, 'stream', NULL, NULL, 2, '0', 'MB', 0, 0, '2024-01-03 04:07:01', '2024-01-06 23:58:03'),
(28, 14, NULL, 'https://dl.streamapi.info/dl/1Vka1fmlJrKj9_hHROplfOKBqY9VKO_Be/stream.api', 0, 'direct_download', '1080p', 'BRRір', 0, '1.4', 'GB', 0, 0, '2024-01-03 04:07:01', '2024-01-03 04:07:01'),
(29, 15, NULL, 'https://player.streamapi.info/video/uUMXomjeN7yHgcR', 0, 'stream', NULL, NULL, 4, '0', 'MB', 0, 0, '2024-01-03 06:12:18', '2024-01-03 09:19:08'),
(30, 15, NULL, 'https://dl.streamapi.info/dl/13RzG5iJtWweIN5yk9UQ-EooFbtq_tL85/stream.api', 0, 'direct_download', '1080p', 'Bluray', 0, '1.92', 'GB', 0, 0, '2024-01-03 06:12:18', '2024-01-03 06:12:18'),
(31, 16, NULL, 'https://player.streamapi.info/video/nF0UyqYHTlnTnf5', 0, 'stream', NULL, NULL, 4, '0', 'MB', 0, 0, '2024-01-03 09:41:50', '2024-01-12 11:33:24'),
(32, 16, NULL, 'https://dl.streamapi.info/dl/1iTyDb_IBzn07u_qc-BvCXezfRjFqnN3M/stream.api', 0, 'direct_download', '1080p', 'Bluray', 0, '2.23', 'GB', 0, 0, '2024-01-03 09:41:50', '2024-01-03 09:41:50'),
(33, 17, NULL, 'https://player.streamapi.info/video/O72kOg14fb91JCk', 0, 'stream', NULL, NULL, 4, '0', 'MB', 0, 0, '2024-01-03 21:56:00', '2024-01-12 12:26:31'),
(34, 17, NULL, 'https://dl.streamapi.info/dl/1-mSMF1Wx6a--fs3UFcv83ADDV-9WnKMQ/stream.api', 0, 'direct_download', '1080p', 'Bluray', 0, '822.14', 'MB', 0, 0, '2024-01-03 21:56:00', '2024-01-03 21:56:00'),
(35, 18, NULL, 'https://player.streamapi.info/video/n0JDkfVwLjr8CtX', 0, 'stream', NULL, NULL, 7, '0', 'MB', 0, 0, '2024-01-03 22:36:22', '2024-01-16 06:57:23'),
(36, 18, NULL, 'https://dl.streamapi.info/dl/1-qu99Jn4uWEvZXJoj07PTI-x_JsEDNCU/stream.api', 0, 'direct_download', '1080p', 'Bluray', 0, '819.57', 'MB', 0, 0, '2024-01-03 22:36:22', '2024-01-03 22:36:22'),
(37, 19, NULL, 'https://player.streamapi.info/video/4w2s2aPeMIhIYv8', 0, 'stream', NULL, NULL, 1, '0', 'MB', 0, 0, '2024-01-04 07:01:20', '2024-01-04 07:02:54'),
(38, 19, NULL, 'https://dl.streamapi.info/dl/1TvXgY0Y_YNHs04f1Tl39gBgez_6HK4a2/stream.api', 0, 'direct_download', '1080p', 'Bluray', 0, '983.71', 'MB', 0, 0, '2024-01-04 07:01:20', '2024-01-04 07:01:20'),
(39, 20, NULL, 'https://player.streamapi.info/video/DL8IHAyrWkVBdbz', 0, 'stream', NULL, NULL, 0, '0', 'MB', 0, 0, '2024-01-04 07:20:29', '2024-01-04 07:20:29'),
(40, 20, NULL, 'https://dl.streamapi.info/dl/1k0wnxOl_vhXPf3Ph_e7YkyDZzG7YMVa6/stream.api', 0, 'direct_download', '1080p', 'Bluray', 0, '1.05', 'GB', 0, 0, '2024-01-04 07:20:29', '2024-01-04 07:20:29'),
(41, 21, NULL, 'https://player.streamapi.info/video/NSvy02N7TC3JOgA', 0, 'stream', NULL, NULL, 2, '0', 'MB', 0, 0, '2024-01-07 05:12:07', '2024-01-07 05:19:19'),
(42, 21, NULL, 'https://dl.streamapi.info/dl/1TwYsYWasfiU1_Samt8N_jXYVbL8J37fc/stream.api', 0, 'direct_download', '1080p', 'BRRір', 0, '1.38', 'GB', 0, 0, '2024-01-07 05:12:07', '2024-01-07 05:12:07'),
(43, 22, NULL, 'https://player.streamapi.info/video/A8J6qQmxChEey3Z', 0, 'stream', NULL, NULL, 1, '0', 'MB', 0, 0, '2024-01-07 05:26:58', '2024-01-07 05:27:46'),
(44, 22, NULL, 'https://dl.streamapi.info/dl/1dKlFJpOBavNbe68wCdFlT6ZgiphGlWT7/stream.api', 0, 'direct_download', '1080p', 'Bluray', 0, '1.84', 'GB', 0, 0, '2024-01-07 05:26:58', '2024-01-07 05:26:58'),
(45, 23, NULL, 'https://player.streamapi.info/video/ZbyKpsXl7scR3jB', 0, 'stream', NULL, NULL, 0, '0', 'MB', 0, 0, '2024-01-07 05:35:09', '2024-01-07 05:35:09'),
(46, 23, NULL, 'https://dl.streamapi.info/dl/1-2tQfwvJLVuugKv3e1Y4q9mPH7ejZQEN/stream.api', 0, 'direct_download', '1080p', 'WEB-DL', 0, '1.59', 'GB', 0, 0, '2024-01-07 05:35:09', '2024-01-07 05:35:09'),
(47, 24, NULL, 'https://player.streamapi.info/video/EIOlStKRWDbFRDh', 0, 'stream', NULL, NULL, 3, '0', 'MB', 0, 0, '2024-01-07 05:42:45', '2024-01-11 00:52:45'),
(48, 24, NULL, 'https://dl.streamapi.info/dl/1-F2C4gTsl2-6LeKarX-WqilXIXOp79nd/stream.api', 0, 'direct_download', '1080p', 'BRRір', 0, '1.78', 'GB', 0, 0, '2024-01-07 05:42:45', '2024-01-07 05:42:45'),
(49, 25, NULL, 'https://player.streamapi.info/video/ID8FB443VQgolGY', 0, 'stream', NULL, NULL, 6, '0', 'MB', 0, 0, '2024-01-07 07:00:57', '2024-01-11 22:41:53'),
(50, 25, NULL, 'https://dl.streamapi.info/dl/1eS2aCYQRVPOuPDs0r82I1n4ATvFvpuNb/stream.api', 0, 'direct_download', '1080p', 'Bluray', 0, '1.87', 'GB', 0, 0, '2024-01-07 07:00:57', '2024-01-07 07:00:57'),
(51, 26, NULL, 'https://player.streamapi.info/video/F6JlZvQOtnIsTc0', 0, 'stream', NULL, NULL, 1, '0', 'MB', 0, 0, '2024-01-07 09:02:05', '2024-01-07 09:02:43'),
(52, 26, NULL, 'https://dl.streamapi.info/dl/10cHsgFTya5CrDFzZmUQYPoWREpcyQns4/stream.api', 0, 'direct_download', '1080p', 'BRRір', 0, '1.67', 'GB', 0, 0, '2024-01-07 09:02:05', '2024-01-07 09:02:05'),
(53, 27, NULL, 'https://player.streamapi.info/video/hWnXag9HyEMd2GQ', 0, 'stream', NULL, NULL, 3, '0', 'MB', 0, 0, '2024-01-07 22:55:46', '2024-01-08 21:44:10'),
(54, 27, NULL, 'https://dl.streamapi.info/dl/1-MUpQVi-xRbGEi25mZDz2WgAL7OglOTu/stream.api', 0, 'direct_download', '1080p', 'Bluray', 0, '1.74', 'GB', 0, 0, '2024-01-07 22:55:46', '2024-01-07 22:55:46'),
(55, 28, NULL, 'https://player.streamapi.info/video/XyR1ujp5NHZ4EEv', 0, 'stream', NULL, NULL, 2, '0', 'MB', 0, 0, '2024-01-07 23:15:17', '2024-01-07 23:48:04'),
(56, 28, NULL, 'https://dl.streamapi.info/dl/1-8HMz1qcIc5Obg9yMt2uB-0Cp2R9atxX/stream.api', 0, 'direct_download', '1080p', 'BRRір', 0, '1.63', 'GB', 0, 0, '2024-01-07 23:15:17', '2024-01-07 23:15:17'),
(57, 29, NULL, 'https://player.streamapi.info/video/C3Pr9LjGOBdzGHH', 0, 'stream', NULL, NULL, 4, '0', 'MB', 0, 0, '2024-01-07 23:54:51', '2024-01-10 12:35:08'),
(58, 29, NULL, 'https://dl.streamapi.info/dl/1-UcZ98qVtnbBsuAAqI1cjRcj7r5JN1i-/stream.api', 0, 'direct_download', '1080p', 'Bluray', 0, '1.52', 'GB', 0, 0, '2024-01-07 23:54:51', '2024-01-07 23:54:51'),
(59, 30, NULL, 'https://player.streamapi.info/video/dS6VXw4VpuGqg4N', 0, 'stream', NULL, NULL, 0, '0', 'MB', 0, 0, '2024-01-09 10:02:01', '2024-01-09 10:02:01'),
(60, 30, NULL, 'https://dl.streamapi.info/dl/1Es0R-P17oyWNIcnH0ZSe7GJHjJXztsDZ/stream.api', 0, 'direct_download', '1080p', 'Bluray', 0, '1.98', 'GB', 0, 0, '2024-01-09 10:02:01', '2024-01-09 10:02:01'),
(61, 31, NULL, 'https://player.streamapi.info/video/n4qI9a3XvOzAm3G', 0, 'stream', NULL, NULL, 2, '0', 'MB', 0, 0, '2024-01-09 10:07:23', '2024-01-09 10:08:32'),
(62, 31, NULL, 'https://dl.streamapi.info/dl/182C7S-Ct-CELYRUi1A7-JQlD36s3cCMJ/stream.api', 0, 'direct_download', '1080p', 'BRRір', 0, '2.24', 'GB', 0, 0, '2024-01-09 10:07:23', '2024-01-09 10:07:23'),
(63, 32, NULL, 'https://player.streamapi.info/video/JK4vZkGbXsyZzF4', 0, 'stream', NULL, NULL, 3, '0', 'MB', 0, 0, '2024-01-09 10:17:07', '2024-01-13 03:41:54'),
(64, 33, NULL, 'https://player.streamapi.info/video/GdXJmy1fF8BXcIk', 0, 'stream', NULL, NULL, 0, '0', 'MB', 0, 0, '2024-01-09 21:23:07', '2024-01-09 21:23:07'),
(65, 33, NULL, 'https://dl.streamapi.info/dl/1N30hliwHWiehRO4Wv_WG3foGzeOzuchh/stream.api', 0, 'direct_download', '1080p', 'BRRір', 0, '2.24', 'GB', 0, 0, '2024-01-09 21:23:07', '2024-01-09 21:23:07'),
(66, 34, NULL, 'https://player.streamapi.info/video/tsPW8X5hz5mjGSi', 0, 'stream', NULL, NULL, 2, '0', 'MB', 0, 0, '2024-01-09 21:31:19', '2024-01-10 08:26:20'),
(67, 34, NULL, 'https://dl.streamapi.info/dl/1qmGaVVrhfVUDzk0HOb6QJU3v205xO6cl/stream.api', 0, 'direct_download', '1080p', 'Bluray', 0, '4.25', 'GB', 0, 0, '2024-01-09 21:31:19', '2024-01-09 21:31:19'),
(68, 35, NULL, 'https://player.streamapi.info/video/8ZGa2sBMax5INfc', 0, 'stream', NULL, NULL, 1, '0', 'MB', 0, 0, '2024-01-09 22:38:12', '2024-01-09 22:47:19'),
(69, 35, NULL, 'https://dl.streamapi.info/dl/1hMatFYYd3Vvi7RxtiqofUElnvVpnyTVk/stream.api', 0, 'direct_download', '1080p', 'Bluray', 0, '2.39', 'GB', 0, 0, '2024-01-09 22:38:12', '2024-01-09 22:38:12'),
(70, 36, NULL, 'https://player.streamapi.info/video/JgmGJUsIUzeBwpd', 0, 'stream', NULL, NULL, 9, '0', 'MB', 0, 0, '2024-01-10 07:54:19', '2024-01-14 23:53:02'),
(71, 36, NULL, 'https://dl.streamapi.info/dl/1rO2Vbp-IErzjB7ysuRveUkKKB945qhp4/stream.api', 0, 'direct_download', '1080p', 'Bluray', 0, '1.9', 'GB', 0, 0, '2024-01-10 07:54:19', '2024-01-10 07:54:19'),
(72, 37, NULL, 'https://player.streamapi.info/video/HaLqG7GmRUk2puk', 0, 'stream', NULL, NULL, 4, '0', 'MB', 0, 0, '2024-01-10 08:06:20', '2024-01-12 18:38:25'),
(73, 37, NULL, 'https://dl.streamapi.info/dl/1_voXnpOvHfT9BZBXUd8_hP4tE5ecNb8r/stream.api', 0, 'direct_download', '1080p', 'BRRір', 0, '2.63', 'GB', 0, 0, '2024-01-10 08:06:20', '2024-01-10 08:06:20'),
(74, 38, NULL, 'https://player.streamapi.info/video/LUOlGIphv6loF2u', 0, 'stream', NULL, NULL, 3, '0', 'MB', 0, 0, '2024-01-13 03:50:42', '2024-01-13 13:08:42'),
(75, 39, NULL, 'https://player.streamapi.info/video/VDbBvJrheoM3tQi', 0, 'stream', NULL, NULL, 1, '0', 'MB', 0, 0, '2024-01-13 04:09:13', '2024-01-13 04:09:27'),
(76, 40, NULL, 'https://player.streamapi.info/video/aI52mR7BZHUrNGJ', 0, 'stream', NULL, NULL, 3, '0', 'MB', 0, 0, '2024-01-13 04:18:49', '2024-01-13 10:54:27'),
(77, 41, NULL, 'https://player.streamapi.info/video/MK21tXtCHbQK0R2', 0, 'stream', NULL, NULL, 1, '0', 'MB', 0, 0, '2024-01-13 20:12:09', '2024-01-13 20:12:31'),
(78, 42, NULL, 'https://player.streamapi.info/video/OOXDoYZq6rwM76P', 0, 'stream', NULL, NULL, 2, '0', 'MB', 0, 0, '2024-01-13 20:18:02', '2024-01-15 19:36:23'),
(79, 43, NULL, 'https://player.streamapi.info/video/LeApM674x4YaVJK', 0, 'stream', NULL, NULL, 1, '0', 'MB', 0, 0, '2024-01-13 20:28:53', '2024-01-13 20:29:23'),
(80, 44, NULL, 'https://player.streamapi.info/video/hCuYT9Hcy709aT2', 0, 'stream', NULL, NULL, 2, '0', 'MB', 0, 0, '2024-01-13 20:53:52', '2024-01-13 21:34:48'),
(81, 45, NULL, 'https://player.streamapi.info/video/G85kga1xbZs3Kxe', 0, 'stream', NULL, NULL, 2, '0', 'MB', 0, 0, '2024-01-13 21:15:22', '2024-01-14 03:07:06'),
(83, 47, NULL, 'https://player.streamapi.info/video/xsLG0Ns0PCRoDxF', 0, 'stream', NULL, NULL, 2, '0', 'MB', 0, 0, '2024-01-14 03:34:48', '2024-01-14 03:52:38'),
(84, 48, NULL, 'https://player.streamapi.info/video/arNI9wp21MQ0VTS', 0, 'stream', NULL, NULL, 1, '0', 'MB', 0, 0, '2024-01-14 05:19:48', '2024-01-14 05:20:05'),
(85, 49, NULL, 'https://player.streamapi.info/video/Ud8TqPV4DIsyjfL', 0, 'stream', NULL, NULL, 2, '0', 'MB', 0, 0, '2024-01-14 05:37:21', '2024-01-14 07:54:52'),
(86, 50, NULL, 'https://player.streamapi.info/video/O29fSeRGgKzTlP6', 0, 'stream', NULL, NULL, 2, '0', 'MB', 0, 0, '2024-01-14 16:32:24', '2024-01-14 21:23:58'),
(87, 51, NULL, 'https://player.streamapi.info/video/znORr1BBVczYSwF', 0, 'stream', NULL, NULL, 3, '0', 'MB', 0, 0, '2024-01-14 22:20:39', '2024-01-14 23:49:10'),
(88, 52, NULL, 'https://player.streamapi.info/video/1OzrGvqVSpU5m84', 0, 'stream', NULL, NULL, 1, '0', 'MB', 0, 0, '2024-01-14 23:05:01', '2024-01-14 23:05:26'),
(89, 53, NULL, 'https://player.streamapi.info/video/mXPTDbB82NEwNLL', 0, 'stream', NULL, NULL, 1, '0', 'MB', 0, 0, '2024-01-14 23:09:37', '2024-01-14 23:10:16'),
(90, 54, NULL, 'https://player.streamapi.info/video/kG3ajACMutiJPZ5', 0, 'stream', NULL, NULL, 7, '0', 'MB', 0, 0, '2024-01-14 23:15:23', '2024-01-15 09:34:54'),
(91, 55, NULL, 'https://player.streamapi.info/video/qmpV1QZvENdEc1Q', 0, 'stream', NULL, NULL, 3, '0', 'MB', 0, 0, '2024-01-15 10:20:05', '2024-01-16 10:18:21'),
(92, 56, NULL, 'https://player.streamapi.info/video/n7QS6NJfJiM6obf', 0, 'stream', NULL, NULL, 1, '0', 'MB', 0, 0, '2024-01-15 11:45:34', '2024-01-15 11:45:48'),
(94, 57, NULL, 'https://player.streamapi.info/video/JR6GRMCYgI0hb8i', 0, 'stream', NULL, NULL, 1, '0', 'MB', 0, 0, '2024-01-16 01:52:21', '2024-01-16 01:52:30'),
(95, 58, NULL, 'https://player.streamapi.info/video/MSFS2IfMYhgF7CW', 0, 'stream', NULL, NULL, 1, '0', 'MB', 0, 0, '2024-01-16 02:49:47', '2024-01-16 02:50:22'),
(96, 59, NULL, 'https://player.streamapi.info/video/eRIqjggoTWqPaFg', 0, 'stream', NULL, NULL, 4, '0', 'MB', 0, 0, '2024-01-16 03:03:30', '2024-01-16 21:26:27');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) UNSIGNED NOT NULL,
  `imdb_id` varchar(11) NOT NULL,
  `tmdb_id` varchar(11) DEFAULT NULL,
  `type` enum('movie','episode') NOT NULL DEFAULT 'movie',
  `title` varchar(255) NOT NULL,
  `description` text,
  `duration` smallint(3) UNSIGNED DEFAULT '0',
  `poster` varchar(128) DEFAULT NULL,
  `banner` varchar(128) DEFAULT NULL,
  `season_id` int(11) UNSIGNED DEFAULT NULL,
  `episode` tinyint(3) UNSIGNED DEFAULT NULL,
  `status` enum('public','draft') NOT NULL DEFAULT 'public',
  `views` int(10) UNSIGNED DEFAULT '0',
  `year` year(4) DEFAULT NULL,
  `imdb_rate` decimal(3,1) DEFAULT NULL,
  `released_at` date DEFAULT NULL,
  `trailer` varchar(128) DEFAULT NULL,
  `language` varchar(45) DEFAULT NULL,
  `country` varchar(128) DEFAULT NULL,
  `meta_keywords` text,
  `meta_description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `quality` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `imdb_id`, `tmdb_id`, `type`, `title`, `description`, `duration`, `poster`, `banner`, `season_id`, `episode`, `status`, `views`, `year`, `imdb_rate`, `released_at`, `trailer`, `language`, `country`, `meta_keywords`, `meta_description`, `created_at`, `updated_at`, `quality`) VALUES
(1, 'tt27687527', '1003581', 'movie', 'Justice League : Warworld', 'Until now, the Justice League has been a loose association of superpowered individuals. But when they are swept away to Warworld, a place of unending brutal gladiatorial combat, Batman, Superman, Wonder Woman and the others must somehow unite to form an unbeatable resistance able to lead an entire planet to freedom.', 90, 'https://image.tmdb.org/t/p/w300/qmevjlNDaWoEughGlXFWHbQ4TaR.jpg', 'https://image.tmdb.org/t/p/original/kIMYSzp1fH1H9adKplekLD9BuNi.jpg', NULL, NULL, 'public', 15, 2023, '5.3', '2023-07-25', 'https://youtube.com/embed/DwBdplsaF5A', 'english', 'United States', 'Animation, Action, Adventure, Fantasy, Sci-Fi, superhero fantasy, Justice League', 'Warworld, a place of unending brutal gladiatorial combat, Batman, Superman, Wonder Woman and others must unite to form an unbeatable resistance to lead the entire planet to freedom.', '2023-12-31 10:29:05', '2024-01-16 10:17:59', 'Bluray'),
(2, 'tt9362930', '565770', 'movie', 'Blue Beetle', 'Recent college grad Jaime Reyes returns home full of aspirations for his future, only to find that home is not quite as he left it. As he searches to find his purpose in the world, fate intervenes when Jaime unexpectedly finds himself in possession of an ancient relic of alien biotechnology: the Scarab.', 128, 'https://image.tmdb.org/t/p/w300/mXLOHHc1Zeuwsl4xYKjKh2280oL.jpg', 'https://image.tmdb.org/t/p/original/ixZzr4PyM2TPs5fka3IJj058WYo.jpg', NULL, NULL, 'public', 6, 2023, '6.0', '2023-08-16', 'https://youtube.com/embed/znRLSKo2vxs', 'english', 'Mexico', 'Action, Adventure, Sci-Fi, Thriller, alien, Jaime Reyes, Blue Beetle, superhero', 'An alien scarab chooses Jaime Reyes to be its symbiotic host, bestowing the recent college graduate with a suit of armor that\'s capable of extraordinary powers, forever changing his destiny as he becomes the superhero known as Blue Beetle.', '2023-12-31 10:42:37', '2024-01-12 03:29:12', 'BRRір'),
(3, 'tt26473516', '1073449', 'movie', 'The Unborn Soul', 'A couple, Tung and Thao, who have an ideal life, stable finances, and love each other deeply, have been married for four years but have yet to conceive a child. However, one day, Thao finally becomes pregnant with their first child. Strange laughter, the presence of a little girl, and unexplainable mysterious occurrences begin happening in their home. Nightmares continue to haunt Thao, and she believes that some supernatural force is tormenting her. Desperate to ensure the safety of their child, Thao decides to seek the help of a sorcerer, only to discover that a series of accidents were triggered by a mistake from years ago.', 117, 'https://image.tmdb.org/t/p/w300/i2p70Ffn3OUpSzy375VZJKc5O5L.jpg', 'https://image.tmdb.org/t/p/original/kIcHBlVUgALGB15S0cUQYuWyeU1.jpg', NULL, NULL, 'public', 1, 2023, '5.3', '2023-02-03', 'https://youtube.com/embed/NUuFSq2PpBQ', 'vietnamese', 'Vietnamese', 'Drama, Horror, Thriller, Vong Nhi 2023', 'Tung and Thao a couple unable to have a child, doctor Phuong works in a maternity hospital performing abortions, and Mrs. Thuan who looks after an orphanage called the Little Angel Shelter. Their tales of loss and sorrow are intertwined.', '2024-01-01 02:05:30', '2024-01-01 02:15:24', 'Bluray'),
(4, 'tt6685538', '459003', 'movie', 'Mavka : The Forest Song', 'Forest soul Mavka faces an impossible choice between her heart and her duty as guardian to the Heart of the Forest, when she falls in love with the talented young human musician Lukas.', 99, 'https://image.tmdb.org/t/p/w300/eeJjd9JU2Mdj9d7nWRFLWlrcExi.jpg', 'https://image.tmdb.org/t/p/original/lyHmhoRj3zXSdeCYbs2oOXLCF4K.jpg', NULL, NULL, 'public', 3, 2023, '6.6', '2023-03-02', 'https://youtube.com/embed/WZ1je_JJTv8', 'ukrainian', 'Ukrainian', 'Mavka: The Forest Song, Animation, Adventure, Comedy, Family, Fantasy', 'Forest soul Mavka faces an impossible choice between her heart and her duty as guardian to the Heart of the Forest, when she falls in love with the talented young human musician Lukas.', '2024-01-01 02:40:02', '2024-01-04 12:20:23', 'BRRір'),
(5, 'tt4692656', '343977', 'movie', 'Tom and Jerry : Spy Quest', 'Two groups of classic cartoon characters come together in this fun-filled crossover with the popular action-adventure series Jonny Quest. Fans of all ages won\'t want to miss this heart-stopping romp as Tom and Jerry join Jonny Quest and his pal Hadji and embark on a dangerous spy mission in order to save the world.', 73, 'https://image.tmdb.org/t/p/w300/5tCVbv0OlEdhBSnK0f7xO39uLwn.jpg', 'https://image.tmdb.org/t/p/original/vOjJf8avUb0yZbnpUBYq3y13wYj.jpg', NULL, NULL, 'public', 2, 2015, '6.0', '2015-06-09', 'https://youtube.com/embed/iu1jG_uiRdM', 'english', 'United States', 'Animation, Action, Adventure, Comedy, Family, Sci-Fi, Tom and Jerry: Spy Quest, tom the cat character, jerry the mouse character', 'Two groups of classic cartoon characters come together in this fun-filled crossover with the popular action-adventure animated series Jonny Quest.', '2024-01-01 04:12:44', '2024-01-01 14:45:40', 'BRRір'),
(6, 'tt28477869', '1153222', 'movie', 'LEGO Disney Princess : The Castle Quest', 'Tiana, Moana, Snow White, Rapunzel, and Ariel are off on an adventure as they are each unexpectedly transported to a mysterious castle. Shortly after arriving, they soon discover that Gaston has hatched an evil plan to take over all their kingdoms! The Princess characters must work together to solve challenges hidden deep within the castle walls and try to save their kingdoms from Gaston. Will bravery, quick-thinking, and teamwork prevail?', 47, 'https://image.tmdb.org/t/p/w300/q17tXNROOslj7uCGicKNlIf9Rx6.jpg', 'https://image.tmdb.org/t/p/original/gWKOmcmC43YWbopoddrSJJGwhgH.jpg', NULL, NULL, 'public', 1, 2023, '5.9', '2023-08-18', 'https://youtube.com/embed/rpyZbfBn4So', 'english', 'United States', 'Animation, Adventure, Comedy, Family, Fantasy, Tiana, Moana, Snow White, Rapunzel, and Ariel', 'Tiana, Moana, Snow White, Rapunzel, and Ariel are off on an adventure as they are each unexpectedly transported to a mysterious castle. Shortly after arriving, they soon discover that Gaston has hatched an evil plan to take over all their kingdoms', '2024-01-01 04:23:01', '2024-01-01 04:23:16', 'Bluray'),
(7, 'tt15665274', '1140692', 'movie', 'The Channel', 'After their bank heist goes wrong, a desperate criminal, his out-of-control brother, and their motley crew of ex-marines must escape New Orleans and the determined FBI agent who pursues them.', 101, 'https://image.tmdb.org/t/p/w300/9Z7TzgY3qcBX7VHaNG3E3t8YP1v.jpg', 'https://image.tmdb.org/t/p/original/k8O9vvhrwrKBrExmDcJhEMfeXJI.jpg', NULL, NULL, 'public', 5, 2023, '5.5', '2023-07-14', 'https://youtube.com/embed/CCX672W7oVU', 'english', 'United States', 'Action, Crime, Thriller, escape, agent, FBI agent, The Channel 2023', 'After their bank heist goes wrong, a desperate criminal, his out-of-control brother, and their motley crew of ex-marines must escape New Orleans and the determined FBI agent who pursues them.', '2024-01-01 04:31:23', '2024-01-04 17:17:41', 'Bluray'),
(8, 'tt8637498', '832502', 'movie', 'The Monkey King', 'THE MONKEY KING is an action-packed family comedy that follows a charismatic Monkey and his magical fighting Stick on an epic quest for victory over 100 demons, an eccentric Dragon King, and Monkey\'s greatest foe of all -his own ego. Along the way, a young village girl challenges his self-centered attitude and shows him that even the smallest pebble can have a big effect on the world.', 92, 'https://image.tmdb.org/t/p/w300/i6ye8ueFhVE5pXatgyRrZ83LBD8.jpg', 'https://image.tmdb.org/t/p/original/jDjmnEuNUfWHg8rbW6u8mylkcO0.jpg', NULL, NULL, 'public', 10, 2023, '5.7', '2023-08-11', 'https://youtube.com/embed/o6KA2DeD34Y', 'english', 'United States', 'Animation, Action, Adventure, Comedy, Family, Fantasy, The Legend, The Monkey King, sun wukong the monkey king', 'THE MONKEY KING is an action-packed family comedy that follows a charismatic Monkey and his magical fighting Stick on an epic quest for victory over 100 demons', '2024-01-01 07:30:57', '2024-01-16 08:28:32', 'Bluray'),
(9, 'tt13603966', '724209', 'movie', 'Heart of Stone', 'Rachel Stone is a charter agent cum technician who works along with a team of MI 6 field agents. The mission is to locate the \"heart\" an AI enabled computer which has the capability of hacking into any software and could cause considerable havoc should it fall into the wrong hands.', 124, 'https://image.tmdb.org/t/p/w300/vB8o2p4ETnrfiWEgVxHmHWP9yRl.jpg', 'https://image.tmdb.org/t/p/original/xVMtv55caCEvBaV83DofmuZybmI.jpg', NULL, NULL, 'public', 3, 2023, '5.7', '2023-08-09', 'https://youtube.com/embed/2CRR_yWYO0c', 'english', 'United States', 'Action, Crime, Thriller, Heart of Stone, intelligence', 'An intelligence operative for a shadowy global peacekeeping agency races to stop a hacker from stealing its most valuable and dangerous weapon.', '2024-01-01 10:41:11', '2024-01-16 21:30:03', 'BRRір'),
(10, 'tt19056070', '954388', 'movie', 'Quicksand', 'A married couple on the brink of divorce becomes trapped in quicksand while hiking through a Colombian rainforest. It’s a struggle for survival as they battle the elements of the jungle and must work together in order to escape.', 86, 'https://image.tmdb.org/t/p/w300/cVLfO3CbVg8p5Qcaifq6AidOe2w.jpg', 'https://image.tmdb.org/t/p/original/nKOutYdpjpxdeftoXcDnSAaD2z8.jpg', NULL, NULL, 'public', 16, 2023, '4.3', '2023-08-31', 'https://youtube.com/embed/j-9pxP1aO-k', 'english', 'Colombia', 'horror, Thriller, Quicksand, married couple, rainforest', 'Follows a married couple almost divorcing who become trapped in quicksand while hiking through a rainforest in Colombia. They will battle the elements of the jungle and must work together in order to survive.', '2024-01-01 11:20:31', '2024-01-11 22:35:46', 'WEB-DL'),
(11, 'tt19848268', '1143190', 'movie', 'Fear the Night', 'During a bachelorette party in a secluded California farmhouse, masked intruders launch a brutal attack, forcing eight women to fight for survival. Led by Tess, a troubled military veteran, they unite to defend themselves throughout a harrowing night.', 92, 'https://image.tmdb.org/t/p/w300/oAWpvlroYbHbkaeKwlL3XlVRnyG.jpg', 'https://image.tmdb.org/t/p/original/aLpQ3G2LRgXYNrQgUlo6AQRo9R6.jpg', NULL, NULL, 'public', 1, 2023, '4.8', '2023-07-21', 'https://youtube.com/embed/glhL12W4JNY', 'english', 'United States', 'Action, Horror, Thriller, California, Fear The Night 2023, Maggie Q', 'In a secluded farmhouse nestled in the California hills, eight women come together to celebrate a hen party. Their joyous occasion takes a dark turn when masked intruders', '2024-01-03 03:35:16', '2024-01-03 03:35:34', 'Bluray'),
(12, 'tt0303151', '14787', 'movie', 'Tom and Jerry : The Magic Ring', 'The Oscar-winning cat-and-mouse twosome--Tom and Jerry--returns with another adventure. When Tom and Jerry\'s irrepressible curiosity gets the best of them, the mysterious magic ring that Tom guards with his life ends up stuck over Jerry\'s head. Now, Jerry must find a way to free himself of the ring while fleeing Tom, who wants to remove the ring any way he can! Find out if the pair can conjure up a solution in this fur-raising, madcap escapade.', 62, 'https://image.tmdb.org/t/p/w300/fF6I48WGKktHfGYYSVKPTVildWE.jpg', 'https://image.tmdb.org/t/p/original/g28qx5NED06pM2lK1mSxM24r6qs.jpg', NULL, NULL, 'public', 3, 2002, '6.2', '2002-03-12', 'https://www.youtube.com/watch?v=gDOWTlkQmAs', 'english', 'United States', 'Animation, Adventure, Comedy, Family, Fantasy, tom and jerry', 'Tom is left in charge of a priceless magical ring by his young wizard master. He is then horrified when the ring gets stuck on Jerry\'s head, who then runs off into the city.', '2024-01-03 03:43:28', '2024-01-13 15:45:44', 'BRRір'),
(13, 'tt4006794', '287233', 'movie', 'Tom and Jerry : The Lost Dragon', 'Your favorite cat and mouse are back with song, sorcery and slapstick in this enchanted tale with two bonus cartoons. The adventure begins when Tom and Jerry happen upon a mysterious glowing egg. Little do they know, this egg was stolen from a very large fire breathing dragon! In short time, baby Puffy hatches from his egg and takes Tom as his mommy. The angry mama dragon wants her baby back, but she\'s not the only one...a powerful witch named Drizelda captures the baby dragon for her own wicked plans! With the help of powerful allies and animal friends, Tom and Jerry must fight tooth and claw to stop the witch and get the baby dragon back to its mother.', 57, 'https://image.tmdb.org/t/p/w300/s2Tegfa5IOUkFx988FgTFZth189.jpg', 'https://image.tmdb.org/t/p/original/7Y2hqJteEvE5DD0j99QTXqF9MZ8.jpg', NULL, NULL, 'public', 4, 2014, '5.8', '2014-07-27', 'https://youtube.com/embed/YZnPQKAN1uA', 'english', 'United States', 'Animation, Adventure, Comedy, Family, Fantasy, Tom and Jerry', 'When Tom and Jerry find a strange egg in the forest & it hatches open to produce a baby dragon, they find themselves having to babysit the little critter.', '2024-01-03 03:49:30', '2024-01-07 12:53:09', 'Bluray'),
(14, 'tt21958986', '1018403', 'movie', 'Tom and Jerry : Snowman\'s Land', 'It’s time to chase that holiday spirit with Tom and Jerry! With magic in the air, Jerry and his nephew, Tuffy, make a snow mouse that miraculously comes to life! To keep their new friend, Larry the snow mouse from melting, Tuffy and Jerry must race him to the fabled Snowman’s Village. In hot pursuit, Tom and devious Dr. Doublevay have their own plans for Larry’s magic.', 76, 'https://image.tmdb.org/t/p/w300/memqWrs4zmLgMBfzTfebrOXbytG.jpg', 'https://image.tmdb.org/t/p/original/hgKkCRQT9HhHJ9NKPQKnF1N5eGL.jpg', NULL, NULL, 'public', 2, 2022, '4.9', '2022-09-06', 'https://youtube.com/embed/nYAuyE2a0dA', 'english', 'United States', 'Animation, Adventure, Comedy, Family, Fantasy, Musical, magic. tom and jerry', 'With magic in the air, Jerry and his nephew, Tuffy, make a snow mouse that miraculously comes to life. To keep their new friend, Larry the snow mouse from melting, Tuffy and Jerry must race him to the fabled Snowman\'s Village.', '2024-01-03 04:07:01', '2024-01-06 23:58:03', 'BRRір'),
(15, 'tt26761920', '963029', 'movie', 'Tid Noi : More Than True Love', 'True love legend of \"Tid Noi\", a man who has a stable love, true love, true love, true love, famous beautiful woman of the era. He loves and takes care of her like a woman in his heart, but Tid Noi\'s love is not easy! because there is another handsome boy who loves and waits for you equally. All three go through the story. Many events The tumult that arises, both happiness and suffering, smiles, laughter, but when love has to choose just one. So what will be the conclusion of the legend of \"True True Love\"? Continue to follow in \"Tid Noi\"', 105, 'https://image.tmdb.org/t/p/w300/LT1sIbDsttUlaU8p65XfNXdSwB.jpg', 'https://image.tmdb.org/t/p/original/vXl5CeLYhsLK5Ehl5yYq9miDEu7.jpg', NULL, NULL, 'public', 3, 2023, '7.2', '2023-01-25', 'https://youtube.com/embed/rP9-RtJi_nk', 'thai', 'Thailand', 'comedy, romance, Tid Noi, True love legend, beautiful', 'True love legend of Tid Noi, a man who has a stable love, true love, true love, true love, famous beautiful woman of the era. He loves and takes care of her like a woman in his heart, but Tid Noi\'s love is not easy', '2024-01-03 06:12:18', '2024-01-03 09:17:57', 'Bluray'),
(16, 'tt25406060', '977179', 'movie', 'You & Me & Me', 'A nostalgic, coming-of-age story of identical twin sisters who share every aspect of their lives with one another, until one day a boy walks into their lives and puts their strong bond to the test.', 121, 'https://image.tmdb.org/t/p/w300/cH5Q30ovq9CHY3K6nNNNRaeXSPj.jpg', 'https://image.tmdb.org/t/p/original/lGL6HNc2h0VmdEtjQ2bZfWX8qn1.jpg', NULL, NULL, 'public', 3, 2023, '6.7', '2023-02-09', 'https://youtube.com/embed/s7H5JV9wfdQ', 'thai', 'Thailand', 'You & Me & Me, Thoe kap chan kap chan, Anthony Buisseret, romance, twin sisters', 'A nostalgic, coming-of-age story of identical twin sisters who share every aspect of their lives with one another, until one day a boy walks into their lives and puts their strong bond to the test.', '2024-01-03 09:41:50', '2024-01-12 11:33:24', 'Bluray'),
(17, 'tt21847190', '3347426', 'episode', 'Please Eat Me Up, Great Evil Dragon', 'A young girl offers herself to an old dragon inside his cave, asking him to devour her. However, the dragon in fact is a herbivore that has been living a recluded life inside his cave for more than 5000 years. While trying to clear up the misunderstandigs that the legends of the outside world have induced about him, he struggles to make the communication work with this little girl who at times almost doesn’t even seem to speak his language.', 14, 'https://image.tmdb.org/t/p/w300/5JPmC1VafZLSj3Ee3hOEQrbX8DL.jpg', 'https://image.tmdb.org/t/p/original/vVjzadE1HLPDhzskH7EjpC4GcGT.jpg', 1, 1, 'public', 3, 2022, '7.6', '2022-07-30', 'https://www.youtube.com/watch?v=CNsPINSG5-c', NULL, NULL, 'Dragon, Herbivorous, Unfairly Villainized, anime, chines, japan, cowardly, Animation, Adventure, Comedy, Fantasy', 'A young girl is offered as a sacrifice to an evil old dragon to help in a battle against an evil villain. However, the dragon is a herbivore, not evil and actually cowardly.', '2024-01-03 21:56:00', '2024-01-12 12:26:31', 'Bluray'),
(18, 'tt21872476', '3810050', 'episode', 'Let\'s set out on an expedition, great evil dragon!', 'Lingzi and the dragon managed to get on good terms with the villagers. However, Lingzi urges the dragon to get going straight away, in order to take down the demon king in his lair. On their way they come by a city under attack by flying monsters …', 14, 'https://image.tmdb.org/t/p/w300/5JPmC1VafZLSj3Ee3hOEQrbX8DL.jpg', 'https://image.tmdb.org/t/p/original/frvmxL2p6nHLpQmJQur50WyruJc.jpg', 1, 2, 'public', 5, 2022, '5.5', '2022-07-30', 'https://www.youtube.com/watch?v=CNsPINSG5-c', NULL, NULL, 'Dragon, Herbivorous, Unfairly Villainized, anime, chines, japan, cowardly, Animation, Adventure, Comedy, Fantasy', 'Lingzi and the dragon managed to get on good terms with the villagers. However, Lingzi urges the dragon to get going straight away, in order to take down the demon king in his lair. On their way they come by a city under attack by flying monsters …', '2024-01-03 22:36:22', '2024-01-16 06:57:23', 'Bluray'),
(19, 'tt2423422', '134623', 'movie', 'Tom and Jerry: Robin Hood and His Merry Mouse', 'Robin Hood steals from the rich and give to the poor, and needs the help of Tom and Jerry! Your favorite daring duo aims to beloved medieval tale in a new film is all for one and one for all!', 55, 'https://image.tmdb.org/t/p/w300/qVFVRLNrccHdPHqrrqtKT0L6oWs.jpg', 'https://image.tmdb.org/t/p/original/cXI35VgXZ0RtrNlnOnxp7wzXv1E.jpg', NULL, NULL, 'public', 1, 2012, '6.3', '2012-10-02', 'https://youtube.com/embed/A2Q_jnMZsFE', 'english', 'United States', 'Tom and Jerry, Robin Hood and His Merry Mouse, Animation, Action, Adventure, Comedy, Family, Musical', 'Robin Hood, a merry man who steals from the rich to give to the poor, has a new capable sidekick, Jerry. The evil king deduces, in his own words \"brilliantly\", that the best way to deal with this new threat is a cat, so he hires Tom.', '2024-01-04 07:01:20', '2024-01-04 07:02:54', 'Bluray'),
(20, 'tt0808508', '60293', 'movie', 'Tom and Jerry : Shiver Me Whiskers', 'Dueling cat-and-mouse team Tom and Jerry hit the high seas on a hunt for buried treasure in this pirate adventure. The tale begins when crew member Tom sets sail with an infamous pirate and finds a treasure map along with stowaway Jerry. The furry swashbucklers race to a deserted island where X marks the spot, but along with battling each other, they must outwit ruthless buccaneers, angry monkeys and a giant octopus to strike it rich.', 74, 'https://image.tmdb.org/t/p/w300/b964RtitRMbUSwTnv4qdbRzUwug.jpg', 'https://image.tmdb.org/t/p/original/7tOpXxoPavzvkPz92JpnWl0uHet.jpg', NULL, NULL, 'public', 0, 2006, '6.4', '2006-08-21', 'https://youtube.com/embed/Rl3z213drRg', 'english', 'United States', 'Tom and Jerry, Shiver Me Whiskers, Animation, Action, Adventure, Comedy, Family, Fantasy', 'Hijinks Ho. It\'s a swashbuckling pirate adventure when Tom sets sail as a lowly cabin cat for the biggest, baddest pirate on the high seas - the infamous Captain Red and his bossy talking parrot', '2024-01-04 07:20:29', '2024-01-04 07:20:29', 'Bluray'),
(21, 'tt15831226', '892153', 'movie', 'Tom and Jerry Cowboy Up!', 'This time, the rivals team up to help a cowgirl and her brother save their homestead from a greedy land-grabber, and they’re going to need some help! Jerry’s three precocious nephews are all ready for action, and Tom is rounding up a posse of prairie dogs. But can a ragtag band of varmints defeat a deceitful desperado determined to deceive a damsel in distress? No matter what happens with Tom and Jerry in the saddle, it’ll be a rootin’ tootin’ good time!', 75, 'https://image.tmdb.org/t/p/w300/muIaHotSaSUQr0KZCIJOYQEe7y2.jpg', 'https://image.tmdb.org/t/p/original/q1NXVYTqSStNQsnKrCvtU6NPzEk.jpg', NULL, NULL, 'public', 1, 2022, '5.1', '2022-01-24', 'https://youtube.com/embed/s5iqJVzhb3Q', 'english', 'United States', 'Animation, Adventure, Comedy, Family, Western, tom and jerry', 'The film finds the duo in the Wild West where they help save a ranch from the hands of a villain. The rivals team up to help a cowgirl and her brother save their homestead from a greedy land-grabber.', '2024-01-07 05:12:07', '2024-01-07 05:12:23', 'BRRір'),
(22, 'tt22352848', '843794', 'movie', 'Jung_E', 'Set in the 22nd century, climate change has caused the planet to become uninhabitable and humans live within a man-made shelter. A war takes place within the shelter. Jung Yi is the elite leader of the allied forces. She becomes the subject of a brain cloning experiment. The cloning experiment is a potential key to win the war.', 98, 'https://image.tmdb.org/t/p/w300/z2nfRxZCGFgAnVhb9pZO87TyTX5.jpg', 'https://image.tmdb.org/t/p/original/afsYFdid9pnnRd6tTrHFUbHgXJn.jpg', NULL, NULL, 'public', 1, 2023, '5.5', '2023-01-12', 'https://youtube.com/embed/v_Jc1MYFv5g', 'korean', 'Korean', 'Action, Adventure, Drama, Sci-Fi, jung_e, korean', 'On an uninhabitable 22nd-century Earth, the outcome of a civil war hinges on cloning the brain of an elite soldier to create a robot mercenary.', '2024-01-07 05:26:58', '2024-01-07 05:27:46', 'Bluray'),
(23, 'tt16757252', '893694', 'movie', 'Eva', 'When Eva gets involved in a steamy threesome with a houseboy and her lady boss, she realizes she has to choose only one between them.', 95, 'https://image.tmdb.org/t/p/w300/bXZ3j3kQgCRZj7KD4Q5F9m5ABaQ.jpg', 'https://image.tmdb.org/t/p/original/ougkufYSiruP8jrEHQanXN7DxRv.jpg', NULL, NULL, 'public', 0, 2021, '4.7', '2021-12-24', 'https://youtube.com/embed/fJ5z3R3lmJk', 'tagalog', 'Philippines', 'Drama, Romance, eva 2021, sex, pornograpy, adult, Angeli Khang', 'When Eva, a young housemaid, gets involved in a steamy threesome with a houseboy and her lady boss, she realizes she has to choose only one of them.', '2024-01-07 05:35:09', '2024-01-07 05:37:10', 'WEB-DL'),
(24, 'tt27679112', '1119744', 'movie', 'Fall Guy', 'A sexy political drama about a man who\'s blamed for a crime he didn\'t do. Will justice be ever served to small people like him?', 106, 'https://image.tmdb.org/t/p/w300/5Pd8I2se5TLluv0oM6Ez2NW3V2H.jpg', 'https://image.tmdb.org/t/p/original/ucRQ7uao5fCJSyDrK84dCv8EdTR.jpg', NULL, NULL, 'public', 2, 2023, '3.8', '2023-05-12', 'https://youtube.com/embed/sqajgO42pdQ', 'tagalog', 'Philippines', 'vivamax, Fall Guy 2023, sexy, naked female breasts, male on female gang rape, adult', 'A sexy political drama about a man who\'s blamed for a crime he didn\'t do. Will justice be ever served to small people like him?', '2024-01-07 05:42:45', '2024-01-11 00:51:54', 'BRRір'),
(25, 'tt28248428', '1135723', 'movie', 'Home Service', 'A nursing student by day, massage therapist by night named Precious meets a client named Happy that leads her to the shady world of pornography.', 112, 'https://image.tmdb.org/t/p/w300/jwKitER1KQfTmzwUtQcHO16OAxD.jpg', 'https://image.tmdb.org/t/p/original/1uNmOb0VsckoQmKQbPpdj1dkDoZ.jpg', NULL, NULL, 'public', 3, 2023, '3.8', '2023-07-14', 'https://youtube.com/embed/61hgrSa5xQI', 'tagalog', 'Philippines', 'female full rear nudity, pornography, sex, home service, vivamax', 'A nursing student by day, massage therapist by night named Happy meets a client named Precious that leads her to the shady world of pornography.', '2024-01-07 07:00:57', '2024-01-11 22:41:53', 'Bluray'),
(26, 'tt17043652', '926612', 'movie', 'Hugas', 'Ex-gang members and newlyweds Al and Liezl run away with a big bag of cash, but their ex-boss will go to the ends of the earth to find them.', 99, 'https://image.tmdb.org/t/p/w300/sfFwKI9lxMqwwziesEI80WEBTog.jpg', 'https://image.tmdb.org/t/p/original/pmjvTsWYSYSU6DRInUNyNOSFEEC.jpg', NULL, NULL, 'public', 1, 2022, '4.7', '2022-01-14', 'https://youtube.com/embed/GFpCna8wjdc', 'tagalog', 'Philippines', 'Hugas 2022, AJ Raval, Sean De Guzman, Crime, Drama, Romance, Thriller, gangster, adult', 'Ex-gang members and newlyweds Al and Liezl run away with a big bag of cash, but their ex-boss will go to the ends of the earth to find them.', '2024-01-07 09:02:05', '2024-01-07 09:02:43', 'WEB-DL'),
(27, 'tt27799221', '1127209', 'movie', 'Kabayo', 'A story about Laurene who wants to elevate her seven-year relationship with Conrad. When Easton comes inito the picture, she believes she is the perfect addition to their sexual relationship.', 106, 'https://image.tmdb.org/t/p/w300/uhBScHjoMlrWUhsm5vPIBNvksKY.jpg', 'https://image.tmdb.org/t/p/original/oKtYeBnasbOoJvEUgUVW6xdKpM7.jpg', NULL, NULL, 'public', 3, 2023, '5.7', '2023-05-26', 'https://youtube.com/embed/nlaXjn-mS-s', 'tagalog', 'United States', 'Laurene, drama, romance, vivamax, relationship, sexual', 'Laurene wants to elevate her seven-year relationship with Conrad. When Easton comes into the picture, she believes she is the perfect addition to their sexual relationship.', '2024-01-07 22:55:46', '2024-01-08 21:44:10', 'Bluray'),
(28, 'tt27551883', '1103856', 'movie', 'Sex Games', 'A rich couple often spices up their sexual relationship by doing their so-called Sex Games. But when they meet a new set of \"playmates\"- a conservative couple, their game becomes more challenging.', 97, 'https://image.tmdb.org/t/p/w300/sRrIKxj9aehQKio2oN1C4fMgtV6.jpg', 'https://image.tmdb.org/t/p/original/kd9eLNjJUPRuvO1gBXgMyq5XBS2.jpg', NULL, NULL, 'public', 1, 2023, '3.7', '2023-04-28', 'https://youtube.com/embed/-wnQBUJP-es', 'tagalog', 'Philippines', 'Sex Games, vivamax, two couples have foursome, naked female breasts, cuckolded husband, female full rear nudity', 'A rich couple often spices up their sexual relationship by doing their so-called Sex Games.', '2024-01-07 23:15:17', '2024-01-07 23:45:48', 'BRRір'),
(29, 'tt25994098', '1070254', 'movie', 'Summer', 'During his summer vacation, Martin meets two women that would let him explore his manhood - Adele, the politician\'s kept woman and Nadine, the sexually-active Manila girl.', 91, 'https://image.tmdb.org/t/p/w300/gITgkTdBWe1EXjwB7QDDIFF5n7v.jpg', 'https://image.tmdb.org/t/p/original/8Uy7vzL6VxbPcnqiu9b69eTO1Ll.jpg', NULL, NULL, 'public', 3, 2023, '4.9', '2023-01-20', 'https://youtube.com/embed/qGwyqfIdK8M', 'tagalog', 'Philippines', 'Summer 2023, vivamax, female topless nudity, mature woman teenage boy sex', 'During his summer vacation, Martin meets two women that would let him explore his manhood - Adele, the politician\'s kept woman, and Nadine, the sexually-active Manila girl.', '2024-01-07 23:54:51', '2024-01-10 12:35:08', 'Bluray'),
(30, 'tt27056116', '1110820', 'movie', 'Het Geheugenspel', 'The body of Nathalie, who disappeared 25 years ago, is found on the Deridder family estate. The event reveals a long-hidden crime, and when secrets are brought forth, the present is overshadowed by the past.', 107, 'https://image.tmdb.org/t/p/w300/c59z3Hguyq2jpcEXNNsHDNBQb9Y.jpg', 'https://image.tmdb.org/t/p/original/oJtyvdHkJ5VPrfmF632VvAw2K0H.jpg', NULL, NULL, 'public', 0, 2023, '6.1', '2023-05-18', 'https://www.youtube.com/watch?v=NR3LKhEDfS4', 'dutch', 'Netherlands', 'Het Geheugenspel, female nudity, naked female breasts, woman strangled to death', 'The body of Nathalie, who disappeared 25 years ago, is found on the Deridder family estate. The event reveals a long-hidden crime, and when secrets are brought forth, the present is overshadowed by the past.', '2024-01-09 10:02:01', '2024-01-09 10:02:01', 'Bluray'),
(31, 'tt27506951', '1038515', 'movie', 'The Village', 'Yu Katayama is a young man who lives in the remote but beautiful village Kamonmura. He has lived there since he was a child and is unable to leave due to an incident in his past. To pay off his mother\'s debt, Yu works in a garbage disposal facility nearby. He lives without a dream or hope in his life. One day, Misaki Nakai returns to Kamonmura from Tokyo. Yu and Misaki were childhood friends. Her return changes Yu.', 120, 'https://image.tmdb.org/t/p/w300/yjKndwGXoJsep0ZYWLm3g9vzZJR.jpg', 'https://image.tmdb.org/t/p/original/uGJ6VPsDyiZgkEmQjBuXoRe4XzE.jpg', NULL, NULL, 'public', 1, 2023, '5.8', '2023-04-21', 'https://youtube.com/embed/basi7JiBjgU', 'japanese', 'Japanese', 'yakuza, japan, village', 'To pay off his mother\'s debt, Yu works in a garbage disposal facility nearby. He lives without a dream or hope in his life. One day', '2024-01-09 10:07:23', '2024-01-09 10:07:41', 'BRRір'),
(32, 'tt14364238', '566466', 'movie', 'Laid-Back Camp Movie', 'Your favorite cozy camping anime returns with a movie as the former members of the Outdoors Club get together again, this time to build a campsite! Reunite with Nadeshiko, Rin, Chiaki, Aoi, and Ena as they gather around the campfire once more with good food and good company.', 121, 'https://image.tmdb.org/t/p/w300/pgffCA82hmBhavW23nbipzsmYf5.jpg', 'https://image.tmdb.org/t/p/original/qlbNi4qOA9eXto0DDzCdtUOICFy.jpg', NULL, NULL, 'public', 3, 2022, '7.6', '2022-07-01', 'https://www.youtube.com/watch?v=ZlL01zXTq4c', 'japanese', 'Japanese', 'Animation, Adventure, Comedy, Laid-Back Camp Movie, cartoon, camping, high school, Rin Shima, Chiaki Ohgaki, Aoi Inuyama and Ena Saito reunite', 'After fostering their friendship through camping in high school and going separate ways, a grown-up Nadeshiko Kagamihara, Rin Shima, Chiaki Ohgaki, Aoi Inuyama and Ena Saito reunite to build a campsite.', '2024-01-09 10:17:07', '2024-01-13 03:41:54', 'Bluray'),
(33, 'tt14379088', '813477', 'movie', 'Shin Kamen Rider', 'College student and motorcycle enthusiast Takeshi Hongo is abducted by the evil organization Shocker and converted into a cyborg as part of their plans for world domination. Before they can brainwash him to do their bidding, he escapes and uses his new enhanced abilities as Kamen Rider to wage a one-man war against Shocker.', 121, 'https://image.tmdb.org/t/p/w300/9dTO2RygcDT0cQkawABw4QkDegN.jpg', 'https://image.tmdb.org/t/p/original/ccFavvHGfhA5yI32K0bzDjlyKSN.jpg', NULL, NULL, 'public', 0, 2023, '6.1', '2023-03-17', 'https://youtube.com/embed/ZriPV8lhHsE', 'japanese', 'Japanese', 'Action, Adventure, Drama, Fantasy, Sci-Fi, Shin Kamen Rider, superhero, tokusatsu, kamen rider', 'College student and motorcycle enthusiast Takeshi Hongo is abducted by the evil organization Shocker and converted into a cyborg as part of their plans for world domination. Before they can brainwash', '2024-01-09 21:23:07', '2024-01-09 21:23:07', 'Bluray'),
(34, 'tt26674627', '1083862', 'movie', 'Resident Evil : Death Island', 'In San Francisco, Jill Valentine is dealing with a zombie outbreak and a new T-Virus, Leon Kennedy is on the trail of a kidnapped DARPA scientist, and Claire Redfield is investigating a monstrous fish that is killing whales in the bay. Joined by Chris Redfield and Rebecca Chambers, they discover the trail of clues from their separate cases all converge on the same location, Alcatraz Island, where a new evil has taken residence and awaits their arrival.', 91, 'https://image.tmdb.org/t/p/w300/qayga07ICNDswm0cMJ8P3VwklFZ.jpg', 'https://image.tmdb.org/t/p/original/7drO1kYgQ0PnnU87sAnBEphYrSM.jpg', NULL, NULL, 'public', 2, 2023, '5.7', '2023-06-22', 'https://youtube.com/embed/g6dKnUw7GPo', 'japanese', 'Japanese', 'Animation, Action, Horror, Fantasy, resident evil, jill valentine character, based on video game', 'A t-virus outbreak in San Francisco leads to Alcatraz Island, where a new evil has taken residence.', '2024-01-09 21:31:18', '2024-01-10 08:26:20', 'Bluray'),
(35, 'tt14227972', '890322', 'movie', 'Love Like the Falling Petals', 'Haruto Asakura falls in love with hairdresser Misaki Ariake and asks her out. Watching Misaki Ariake work hard to achieve what she wants, Haruto Asakura, who almost gave up his dream to become a photographer, begins to pursue his dream again, but Misaki Ariake is diagnosed with a disease that ages her 10x faster than normal.', 128, 'https://image.tmdb.org/t/p/w300/8m2xnZAnMuydc87KCLS2gnUmidh.jpg', 'https://image.tmdb.org/t/p/original/hX9KuZQjZXrleVALumaNb6HJJ6M.jpg', NULL, NULL, 'public', 1, 2022, '6.5', '2022-03-24', 'https://youtube.com/embed/l4nYFakFMDo', 'japanese', 'Japanese', 'Drama, Romance, Love Like the Falling Petals, hairdresser, sakura, photography, japanese drama', 'An aspiring photographer falls in love with a skillful hairstylist. The future stretches before them until a twist of fate threatens their romance.', '2024-01-09 22:38:12', '2024-01-09 22:47:19', 'Bluray'),
(36, 'tt6879446', '457332', 'movie', 'Hidden Strike', 'Two ex-special forces soldiers must escort a group of civilians along Baghdad\'s \"Highway of Death\" to the safety of the Green Zone.', 103, 'https://image.tmdb.org/t/p/w300/zsbolOkw8RhTU4DKOrpf4M7KCmi.jpg', 'https://image.tmdb.org/t/p/original/dWvDlTkt9VEGCDww6IzNRgm8fRQ.jpg', NULL, NULL, 'public', 8, 2023, '5.3', '2023-07-06', 'https://youtube.com/embed/l_jEicE6KyQ', 'english', 'Hong Kong', 'Hidden Strike, jackie chan, team action, desert adventure, chinese, Action, Adventure, Comedy, Thriller', 'Two ex-special forces soldiers must escort a group of civilians along Baghdad\'s \"Highway of Death\" to the safety of the Green Zone.', '2024-01-10 07:54:19', '2024-01-14 23:53:02', 'Bluray'),
(37, 'tt15516726', '926130', 'movie', 'Selfiee', 'Super Star protagonist is Well Known for his Driving Skills and Craze towards Motor Cars. Anti protagonist, the Motor Vehicle Inspector of the Town is a Die Hard Fan of protagonist. To complete the shoot of his latest film protagonist needs to submit his license, which he discovers is missing. In order to get a new license urgently ,protagonist goes to anti protagonist , his biggest fan', 143, 'https://image.tmdb.org/t/p/w300/1QU1MCj0gFEZzIKl6pbfLsfClbJ.jpg', 'https://image.tmdb.org/t/p/original/y5VNn9jt5wHGNEEAcS6T7y4XSLd.jpg', NULL, NULL, 'public', 4, 2023, '5.7', '2023-02-24', NULL, 'hindi', 'India', 'Action, Comedy, Drama, Thriller, Bollywood, Vijay Kumar, Prakash Agarwal', 'Bollywood superstar Vijay Kumar needs to obtain a new driving license from RTO officer Om Prakash Agarwal, a diehard fan of Vijay. A misunderstanding escalates into a feud which is played out in front of the entire country.', '2024-01-10 08:06:20', '2024-01-12 18:38:25', 'BRRір'),
(38, 'tt10698680', '587412', 'movie', 'K.G.F : Chapter 2', 'The blood-soaked land of Kolar Gold Fields (KGF) has a new overlord now - Rocky, whose name strikes fear in the heart of his foes. His allies look up to Rocky as their savior, the government sees him as a threat to law and order; enemies are clamoring for revenge and conspiring for his downfall. Bloodier battles and darker days await as Rocky continues on his quest for unchallenged supremacy.', 168, 'https://image.tmdb.org/t/p/w300/aN30pwRBhRo1NS6ILAz3ejxXb0g.jpg', 'https://image.tmdb.org/t/p/original/nsV5Mfi9FAV4w8eDsdr7uqVswOk.jpg', NULL, NULL, 'public', 2, 2022, '8.3', '2022-04-14', 'https://youtube.com/embed/Qah9sSIXJqk', 'kannada', 'India', 'Action, Crime, Drama, Thriller, K.G.F: Chapter 2, K.G.F, Kolar Gold Fields, government ', 'In the blood-soaked Kolar Gold Fields, Rocky\'s name strikes fear into his foes, while the government sees him as a threat to law and order. Rocky must battle threats from all sides for unchallenged supremacy.', '2024-01-13 03:50:42', '2024-01-13 13:08:42', 'Bluray'),
(39, 'tt10364034', '496450', 'movie', 'Miraculous : Ladybug & Cat Noir, The Movie', 'Ordinary teenager Marinette\'s life in Paris goes superhuman when she becomes Ladybug. Bestowed with magical powers of creation, Ladybug must unite with her opposite, Cat Noir, to save Paris as a new villain unleashes chaos unto the city.', 107, 'https://image.tmdb.org/t/p/w300/dQNJ8SdCMn3zWwHzzQD2xrphR1X.jpg', 'https://image.tmdb.org/t/p/original/iEFuHjqrE059SmflBva1JzDJutE.jpg', NULL, NULL, 'public', 1, 2023, '6.1', '2023-07-05', 'https://youtube.com/embed/W0rQUt4odnQ', 'french', 'United States', 'Animation, Action, Adventure, Comedy, Family, Fantasy, Musical, Romance, Miraculous, Ladybug & Cat Noir, the Movie', 'This exciting Miraculous origin story follows shy Parisian teenager Marinette (Cristina Vee Valenzuela) as she starts the year in a new high school. On her way home, Marinette saves a mystical old man who gives her the Miraculous gem, transforming her into the superhero Ladybug', '2024-01-13 04:09:12', '2024-01-13 04:09:27', 'Bluray'),
(40, 'tt22868844', '812225', 'movie', 'Black Clover: Sword of the Wizard King', 'Asta, a boy born with no magic in a world where magic is everything, and his rival Yuno, a genius mage chosen by the legendary 4-leaf Grimoire, have together fought a number of powerful enemies to prove their power beyond adversity and aim for the top mage \"Wizard King\". Standing in front of Asta and Yuno, who dream of becoming the Wizard King, are the Wizard Kings from the past. Conrad Leto, Julius Novachrono\'s predecessor Wizard King', 113, 'https://image.tmdb.org/t/p/w300/9YEGawvjaRgnyW6QVcUhFJPFDco.jpg', 'https://image.tmdb.org/t/p/original/eUNg7wZ8HoQW0QxFjrfw3ioAkap.jpg', NULL, NULL, 'public', 2, 2023, '7.4', '2023-06-16', 'https://youtube.com/embed/ZLQJpUmPMcA', 'japanese', 'Japanese', 'Animation, Action, Adventure, Fantasy, Sci-Fi, Black Clover, Sword of the Wizard King', 'In a world where magic is everything, Asta, a boy who was born with no magic, aims to become the \"Wizard King\" to overcome adversity, prove his power, and keep his oath with his friends.', '2024-01-13 04:18:49', '2024-01-13 10:54:27', 'BRRір'),
(41, 'tt21872474', '3859787', 'episode', 'You will always be my great evil dragon', 'While Lingzi is sleeping, Ai Li’anti and the dragon get the chance to talk to each other and clear up some misconceptions about the Dragon’s image … At least that’s what he thought. However, for some reason Ai Li’anti does not seem to believe him and suddenly she even starts attacking …', 14, 'https://image.tmdb.org/t/p/w300/5JPmC1VafZLSj3Ee3hOEQrbX8DL.jpg', 'https://image.tmdb.org/t/p/original/zueqh0Q2IUILX4zJ5X9IV0QZx5w.jpg', 1, 3, 'public', 1, 2022, '6.2', '2022-08-06', 'https://www.youtube.com/watch?v=CNsPINSG5-c', NULL, NULL, 'Dragon, Herbivorous, Unfairly Villainized, anime, chinese, japan, cowardly, Animation, Adventure, Comedy, Fantasy, Yowai 5000 Nen No Sôshoku Doragon, Iwarenaki Yokoshima Ryû Nintei', 'While Lingzi is sleeping, Ai Li’anti and the dragon get the chance to talk to each other and clear up some misconceptions about the Dragon’s image', '2024-01-13 20:12:09', '2024-01-13 20:12:31', 'Bluray'),
(42, 'tt21872480', '3859788', 'episode', 'Let’s continue our journey, great evil dragon', 'The old dragon who has shrunk to a more convenient size now, continues his journey with Lingzi. When they encounter a group of bandits, the dragon asks Lingzi to refrain from attacking them. At first, that is …', 14, 'https://image.tmdb.org/t/p/w300/5JPmC1VafZLSj3Ee3hOEQrbX8DL.jpg', 'https://image.tmdb.org/t/p/original/8C9bhd0UStYuUngwISbKzM0M3CE.jpg', 1, 4, 'public', 2, 2022, '5.8', '2022-08-13', 'https://www.youtube.com/watch?v=CNsPINSG5-c', NULL, NULL, 'Dragon, Herbivorous, Unfairly Villainized, anime, chinese, japan, cowardly, Animation, Adventure, Comedy, Fantasy, Yowai 5000 Nen No Sôshoku Doragon, Iwarenaki Yokoshima Ryû Nintei', 'The old dragon who has shrunk to a more convenient size now, continues his journey with Lingzi. When they encounter a group of bandits, the dragon asks Lingzi to refrain from attacking them. At first, that is …', '2024-01-13 20:18:02', '2024-01-15 19:36:23', 'Bluray'),
(43, 'tt22264336', '1145612', 'movie', 'Fate/strange Fake : Whispers of Dawn', 'Fate/strange fake is a light novel from the Fate franchise that takes place in an alternate universe, where various factions fight for the Holy Grail in a fictional US town called Snowfield. The story begins with the participation of a new Servant, called False Archer, who belongs to the Church faction. With its appearance, several other factions are forced to reveal their Servants and participate in the fight for the Holy Grail.', 56, 'https://image.tmdb.org/t/p/w300/7Cf2NS9oH1VpH23NyWR4J7WIOv9.jpg', 'https://image.tmdb.org/t/p/original/3wUOyQbIOFNLPObXa7Iae8RzJ87.jpg', NULL, NULL, 'public', 1, 2023, '7.3', '2023-07-02', 'https://youtube.com/embed/CYbUeDTGiMc', 'japanese', 'Japanese', 'Animation, Action, Fantasy, anime, movie anime, based on novel', 'Fate/strange fake is a light novel from the Fate franchise that takes place in an alternate universe, where various factions fight for the Holy Grail in a fictional US town called Snowfield', '2024-01-13 20:28:53', '2024-01-13 20:29:23', 'BRRір'),
(44, 'tt21907554', '1022924', 'movie', '5 in 1', 'A rich man leaves all his wealth to his most loved ex. But at his wake, five exes pay their respects by sharing their wild and naughty moments. Who among them will be his heir?', 112, 'https://image.tmdb.org/t/p/w300/rFanOAJec9XAtpQVyUvrzmLpnLI.jpg', 'https://image.tmdb.org/t/p/original/tElq9LQAlHcPNRjyeVTiZiym94z.jpg', NULL, NULL, 'public', 2, 2022, '4.5', '2022-09-23', 'https://youtube.com/embed/fe8FBNkUT20', 'tagalog', 'Philippines', 'vivamax, 5 in 1 2022, sex, Ex-girlfriend, love, naughty', 'A rich man leaves all his wealth to his most loved Ex-girlfriend. But at his wake, five exes pay their respects by sharing their wild and naughty moments. Who among them will be his heir?', '2024-01-13 20:53:52', '2024-01-13 21:34:48', 'BRRір'),
(45, 'tt27102839', '1097046', 'movie', 'Baby Boy, Baby Girl', 'Josie is a failed startup businesswoman, who is struggling with no permanent job. Ever since she saw her ex-boyfriend Seb escorting a politician and broke up with him three years ago, Josie remains single. Seb, on the other hand, becomes more sophisticated from earning handsomely through Sugar Dating. Josie learns about Seb’s success, prompting her to ask Seb to groom her for Sugar Dating.', 107, 'https://image.tmdb.org/t/p/w300/1TVQP2KuC7b5xYTsGrYy335SG3I.jpg', 'https://image.tmdb.org/t/p/original/5pP3kpWWPJrtIafL0o5lxOova7N.jpg', NULL, NULL, 'public', 2, 2023, '4.4', '2023-03-22', 'https://youtube.com/embed/_3Vntf_WZfI', 'tagalog', 'Philippines', 'Kylie Verzosa, vivamax, Marco Gumabao, Comedy, Romance, sugar dating, repetition in title, businesswoman, ex boyfriend, Baby Boy, Baby Girl', 'A failed startup businesswoman who struggles financially discovers that her ex-boyfriend earns handsomely through Sugar Dating and asks him to groom her for the job.', '2024-01-13 21:15:22', '2024-01-14 03:07:06', 'Bluray'),
(47, 'tt14672882', '1064912', 'movie', 'The Tomorrow Job', 'Lee and his team of thieves use a time travel drug to trade places with their future selves to pull off heists. To operate effectively and safely, the team has a strict set of rules to ensure limited temporal impact. When interrupted on a job, Lee and the team have to fix their past mistakes to prevent disastrous consequences and save their future.', 105, 'https://image.tmdb.org/t/p/w300/Ah3pJ3iuX28PKHjGLyIrEsFVq5q.jpg', 'https://image.tmdb.org/t/p/original/hYCqInu2vhRysytIyifA41iw2Ek.jpg', NULL, NULL, 'public', 1, 2023, '4.7', '2023-01-13', 'https://youtube.com/embed/EY-xn2bdJqc', 'english', 'United States', 'Action, Sci-Fi, crime, The Tomorrow Job', 'Lee and his team of thieves use a time travel drug to trade places with their future selves to pull off heists. To operate effectively and safely, the team has a strict set of rules to ensure limited temporal impact.', '2024-01-14 03:34:48', '2024-01-14 03:35:13', 'BRRір'),
(48, 'tt1517268', '346698', 'movie', 'Barbie', 'Barbie and Ken are having the time of their lives in the colorful and seemingly perfect world of Barbie Land. However, when they get a chance to go to the real world, they soon discover the joys and perils of living among humans.', 114, 'https://image.tmdb.org/t/p/w300/iuFNMS8U5cb6xfzi51Dbkovj7vM.jpg', 'https://image.tmdb.org/t/p/original/nHf61UzkfFno5X1ofIhugCPus2R.jpg', NULL, NULL, 'public', 1, 2023, '6.9', '2023-07-19', 'https://youtube.com/embed/0dgyWo4hATY', 'english', 'United States', 'Adventure, Comedy, Fantasy, Barbie and Ken, perfect world, romance', 'Barbie and Ken are having the time of their lives in the colorful and seemingly perfect world of Barbie Land. However, when they get a chance to go to the real world, they soon discover the joys and perils of living among humans.', '2024-01-14 05:19:48', '2024-01-14 05:20:05', 'BRRір'),
(49, 'tt21442932', '1014840', 'movie', 'Bula', 'A woman, who owns a laundry shop, uses her clients\' clothes to satisfy her sexual fantasies. When she meets a hot police officer, she wants to have him no matter what it takes.', 104, 'https://image.tmdb.org/t/p/w300/Q71kmkvWYF6Zclq1Ie5R7nm75m.jpg', 'https://image.tmdb.org/t/p/original/734OpJqPOVfI35yMGvPcieBI03g.jpg', NULL, NULL, 'public', 2, 2023, '5.0', '2023-09-26', 'https://youtube.com/embed/0-0SnbENl3E', 'tagalog', 'Philippines', 'Horror, Thriller, wife bathes her husband, vivamax, impotent husband, sexless marriage, cheating girlfriend, female rear nudity, sexual, laundry shop', 'A woman, who owns a laundry shop, uses her clients\' clothes to satisfy her sexual fantasies. When she meets a hot police officer, she wants to have him no matter what it takes.', '2024-01-14 05:37:21', '2024-01-14 07:54:52', 'Bluray'),
(50, 'tt4581522', '676575', 'movie', 'Cricket & Antoinette', 'Two main characters, Cricket and Antoinette, represent two separate worlds, the world of noise, chaos and creativity on the one side, and the world of work, order and discipline on the other. As they fall in love, in spite of obvious differences, they manage to create harmony.', 85, 'https://image.tmdb.org/t/p/w300/fBSLAMH5vczIWgzpa9x7Z52F4QH.jpg', 'https://image.tmdb.org/t/p/original/3kTNHPrxpo2TXqR6Y1tVnlN8l6B.jpg', NULL, NULL, 'public', 1, 2023, '5.8', '2023-01-03', 'https://youtube.com/embed/ZuZYDrrZuTk', 'English', 'Croatia', 'Animation, Adventure, Family, Romance, fairy tale, Jean de la Fontaine, Cricket & Antoinette', 'Here is a new take on the famous fairy tale first told by Aesop and then Jean de la Fontaine. Ket, a guitar playing cricket, leads a band to entertain the carefree bugs. Nearby lives Antoinette', '2024-01-14 16:32:24', '2024-01-14 16:32:38', 'Bluray'),
(51, 'tt10588750', '682153', 'movie', 'Doraemon : Nobita\'s New Dinosaur', 'Nobita accidentally found a fossil dinosaur egg mixed with rocks in the dinosaur fossil exhibition site that he had visited before. He returned it to its original state with the \"Time blanket\". After hatching, the egg hatches a new species of dinosaur that is not named in the Cosmic Encyclopedia and names them Kyu and Myu Although they want to take care of them secretly, there are dinosaurs in the city still discovered by residents; Nobita and his friends were forced to bring them back to the Cretaceous period 66 million years ago the dinosaurs time. Just the time of Dinosaurs Extinction.', 110, 'https://image.tmdb.org/t/p/w300/wxCZmXRJa8hSv1Tpih8TBSR4o6b.jpg', 'https://image.tmdb.org/t/p/original/8HK8Ce6JpAb8EJTjHKAWhnYy0xi.jpg', NULL, NULL, 'public', 2, 2020, '7.0', '2020-08-07', 'https://youtube.com/embed/7ZbhWq2PybY', 'japanese', 'Japanese', 'Animation, Adventure, Comedy, Drama, Family, Fantasy, Sci-Fi, Nobita, dinosaur egg, Nobita\'s New Dinosaur, doraemon movies, anime', 'Nobita accidentally found a fossil dinosaur egg mixed with rocks in the dinosaur fossil exhibition site that he had visited before', '2024-01-14 22:20:39', '2024-01-14 23:47:04', 'Bluray'),
(52, 'tt22183760', '1140540', 'movie', 'Deadly Entanglement', 'A singer on the brink of stardom has her life turned upside down when her producer husband\'s ex-wife reemerges, determined to get her old life back by any means.', 88, 'https://image.tmdb.org/t/p/w300/gFCRXUpkfcn9YP8gRUzrznoRgAV.jpg', 'https://image.tmdb.org/t/p/original/1x7KBof3HJxo1xjvtrecNGOTayQ.jpg', NULL, NULL, 'public', 1, 2023, '5.3', '2023-06-08', 'https://youtube.com/embed/YV_GrdlSHj0', 'english', 'United States', 'husband, Thriller, crime, song', 'The ex-wife won\'t let her husband go, first she tries seduction, then deceit, finally, if she can\'t have him, no one will.', '2024-01-14 23:05:01', '2024-01-14 23:05:26', 'BRRір');
INSERT INTO `movies` (`id`, `imdb_id`, `tmdb_id`, `type`, `title`, `description`, `duration`, `poster`, `banner`, `season_id`, `episode`, `status`, `views`, `year`, `imdb_rate`, `released_at`, `trailer`, `language`, `country`, `meta_keywords`, `meta_description`, `created_at`, `updated_at`, `quality`) VALUES
(53, 'tt25434854', '667717', 'movie', 'Deep Sea', 'Shenxiu has felt a deep sadness since her mother left. A storm plunges her into a dreamlike world of swirling colour. Led by the Hyjinx, and joined by inventive underwater chef Nanhe, she embarks on a quest to find solace in the Eye of the Deep Sea.', 105, 'https://image.tmdb.org/t/p/w300/znSKKjTpwnFmlieJtnlLoI6McKK.jpg', 'https://image.tmdb.org/t/p/original/e0qcEOrY8QWb1g3C3v9TGctROj1.jpg', NULL, NULL, 'public', 1, 2023, '6.8', '2023-01-22', 'https://youtube.com/embed/Y7eh98-9XEA', 'chinese', 'Chinese', 'Animation, Adventure, Drama, Fantasy, deep sea', 'Shenxiu has felt a deep sadness since her mother left. A storm plunges her into a dreamlike world of swirling colour. Led by the Hyjinx, and joined by inventive underwater chef Nanhe, she embarks on a quest to find solace in the Eye of the Deep Sea.', '2024-01-14 23:09:37', '2024-01-14 23:10:16', 'BRRір'),
(54, 'tt5433140', '385687', 'movie', 'Fast X', 'Over many missions and against impossible odds, Dom Toretto and his family have outsmarted, out-nerved and outdriven every foe in their path. Now, they confront the most lethal opponent they\'ve ever faced: A terrifying threat emerging from the shadows of the past who\'s fueled by blood revenge, and who is determined to shatter this family and destroy everything—and everyone—that Dom loves, forever.', 142, 'https://image.tmdb.org/t/p/w300/fiVW06jE7z9YnO4trhaMEdclSiC.jpg', 'https://image.tmdb.org/t/p/original/4XM8DUTQb3lhLemJC51Jx4a2EuA.jpg', NULL, NULL, 'public', 3, 2023, '5.8', '2023-05-17', 'https://youtube.com/embed/cg5z7wgOUig', 'english', 'United States', 'Action, Adventure, Crime, Mystery, Thriller, Fast X, fast and furious ', 'The end of the road begins. Fast X, the tenth film in the Fast and Furious Saga, launches the final chapters of one of cinema\'s most storied and popular global franchises, now in its third decade and still going strong with the same core cast and characters as when it began.', '2024-01-14 23:15:23', '2024-01-15 00:02:48', 'Bluray'),
(55, 'tt3949650', '285812', 'movie', 'Doraemon : New Nobita\'s Great Demon – Peko and the Exploration Party of Five', 'Nobita finds a stray dog and brings him home, little does hi knows that the dog is actually a prince in his homeland, a world appart deep in the african \'Smokers Forest\' were the dogs evolved and have their own empire, so he and his friends take on a journey to take back the young prince to his homeland but when they get there things have changed.', 109, 'https://image.tmdb.org/t/p/w300/xKGMXQFGca4nKcO308aZ6nWz0Gc.jpg', 'https://image.tmdb.org/t/p/original/rN0YhB2ElrzO9ugtBhWY4wqYbz8.jpg', NULL, NULL, 'public', 2, 2014, '6.8', '2014-03-08', 'https://youtube.com/embed/HKSKofVq3O8', 'japanese', 'Japanese', 'doraemon movie, Animation, Action, Adventure, Comedy, Family, Fantasy, Mystery, Sci-Fi, nobita', 'Nobita finds a stray dog and brings him home, little does hi knows that the dog is actually a prince in his homeland, a world appart deep in the african \'Smokers Forest\' were the dogs evolved and have their own empire', '2024-01-15 10:20:05', '2024-01-16 10:18:21', 'Bluray'),
(56, 'tt23789884', '1107387', 'movie', 'Hachiko', 'This is the story of a puppy that touched hundreds of millions of people around the world. Hachiko (/Batong) is a cute Chinese pastoral dog. He met his destined owner Chen Jingxiu in the vast crowd and became a member of the Chen family. With the passage of time, the once beautiful home is no longer there, but Batong is still waiting where it is, and its fate is closely tied to its family. This film is adapted from the original script \"Hachiko\" by Kaneto Shindo.', 124, 'https://image.tmdb.org/t/p/w300/mZKBFTYZJQBHmbFZ0N0SGnCK64G.jpg', 'https://image.tmdb.org/t/p/original/kGWpaisyiOrOhkjn5FviMRUaoCb.jpg', NULL, NULL, 'public', 1, 2023, '7.3', '2023-03-31', 'https://youtube.com/embed/bUyTpXYkkFs', 'chinese', 'Chinese', 'Hachiko, drama, family', 'The touching story about a loyal dog named Ba Tong who waited for the return of his owner for ten years even after his owner\'s death.', '2024-01-15 11:45:34', '2024-01-15 11:45:48', 'BRRір'),
(57, 'tt15073166', '1114114', 'movie', 'IB 71', 'After facing defeat in the under water battle in the Ghazi Attack Pakistan along with China plans another attack on India with China.According to the Indian intelligence bureau they find that in the next ten days there will be an aerial attack for which India isn\'t prepared yet.Dev one of the smart agents recently managed to elope from Pakistan army camp with some secret documents suggests IB Chief N.S. Awasthi that they should block their airbase for Paksitan but that isn\'t possible until a war is announced', 117, 'https://image.tmdb.org/t/p/w300/n3tDKjw14Ig3suHOx8GSBtCxEX7.jpg', 'https://image.tmdb.org/t/p/original/pwqsXsL1szSTDMAEYufnb77HWgc.jpg', NULL, NULL, 'public', 1, 2023, '7.2', '2023-05-12', 'https://youtube.com/embed/lEHoobVqhNw', 'hindi', 'India', 'Action, Thriller, IB 71, intelligence, indo pakistani war of 1971', 'A spy action thriller about the two-front war between Indian intelligence agencies and the Pakistani establishment in 1971.', '2024-01-16 01:50:14', '2024-01-16 01:52:30', 'Bluray'),
(58, 'tt15281704', '864573', 'movie', 'Kuttey', 'A van carrying crores of cash. One rainy night in the outskirts of Mumbai. Unaware of each other, three stray gangs cross paths on the hunt. Unfortunately, all of them have the same plan. Bullets... Blood... Betrayal... It’s every man for himself... All the dogs after one bone. Will these dogs bite the bone, or will they lose to greed?', 112, 'https://image.tmdb.org/t/p/w300/bwJHR0qzAvJLKy7EioiSRu0QivY.jpg', 'https://image.tmdb.org/t/p/original/8WYMiWK6m3iCMbuSP5w2QVHXG54.jpg', NULL, NULL, 'public', 1, 2023, '5.5', '2023-01-13', 'https://www.youtube.com/watch?v=76BhvV8ihRM', 'hindi', 'India', 'Action, Comedy, Crime, Thriller, money, night, Kuttey, netflix, t-series', 'A van carrying crores of cash. One rainy night in the outskirts of Mumbai. Unaware of each other, three stray gangs cross paths on the hunt. Unfortunately, all of them have the same plan. Will they bite the bone or will they lose to greed?', '2024-01-16 02:49:47', '2024-01-16 02:50:22', 'BRRір'),
(59, 'tt14295590', '986594', 'movie', 'Mrs. Chatterjee Vs Norway', 'Debika Chatterjee an Indian women living in Norway with her husband Aniruddha and two children Subh and Shuchi.Sia and Matilda two officials from Velfred organization make them daily visits for evaluation on parenting and one day suddenly snatch away both their children citing unfit parents.Debika is termed as an insane mother and accused of not taking care of her children while Aniruddha is much more worried about his citizenship rather then getting back his kids.', 135, 'https://image.tmdb.org/t/p/w300/uy26E04DxYdICergibgtAFIUuDo.jpg', 'https://image.tmdb.org/t/p/original/2pv723BfhVMCAwH9onNLX0JpVEE.jpg', NULL, NULL, 'public', 4, 2023, '7.3', '2023-03-16', 'https://www.youtube.com/watch?v=1Bll53fBa9U', 'hindi', 'India', 'Rani Mukerji, Biography, Drama', 'An immigrant Indian mother\'s battle against the Norwegian foster care system and local legal machinery to win back the custody of her children.', '2024-01-16 03:03:30', '2024-01-16 21:26:27', 'WEB-DL');

-- --------------------------------------------------------

--
-- Table structure for table `movie_genre`
--

CREATE TABLE `movie_genre` (
  `movie_id` int(11) UNSIGNED NOT NULL,
  `genre_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movie_genre`
--

INSERT INTO `movie_genre` (`movie_id`, `genre_id`) VALUES
(1, 34),
(1, 35),
(1, 36),
(2, 34),
(2, 35),
(2, 47),
(2, 48),
(3, 40),
(3, 44),
(3, 47),
(4, 35),
(4, 36),
(4, 41),
(4, 42),
(5, 36),
(5, 37),
(5, 41),
(6, 35),
(6, 36),
(6, 41),
(6, 42),
(7, 34),
(7, 38),
(7, 47),
(8, 35),
(8, 36),
(8, 37),
(8, 41),
(8, 42),
(9, 34),
(9, 47),
(10, 44),
(10, 47),
(11, 34),
(11, 47),
(12, 34),
(12, 36),
(12, 37),
(12, 41),
(12, 42),
(13, 35),
(13, 36),
(13, 37),
(13, 41),
(14, 35),
(14, 36),
(14, 37),
(14, 41),
(15, 37),
(15, 46),
(16, 40),
(16, 46),
(19, 35),
(19, 36),
(19, 37),
(19, 41),
(20, 36),
(20, 37),
(20, 41),
(21, 35),
(21, 36),
(21, 37),
(21, 41),
(22, 34),
(22, 35),
(22, 40),
(22, 48),
(23, 40),
(23, 46),
(24, 40),
(24, 46),
(25, 40),
(25, 46),
(26, 38),
(26, 40),
(26, 46),
(26, 47),
(27, 40),
(27, 46),
(28, 40),
(28, 47),
(29, 40),
(30, 40),
(30, 47),
(31, 40),
(31, 41),
(32, 36),
(32, 37),
(33, 34),
(33, 35),
(33, 40),
(33, 42),
(34, 34),
(34, 36),
(34, 44),
(35, 40),
(35, 46),
(36, 34),
(36, 35),
(36, 37),
(36, 47),
(37, 37),
(37, 40),
(37, 47),
(38, 34),
(38, 35),
(38, 38),
(38, 47),
(39, 34),
(39, 36),
(39, 41),
(39, 42),
(39, 46),
(40, 34),
(40, 35),
(40, 36),
(40, 42),
(43, 34),
(43, 36),
(43, 40),
(43, 42),
(44, 37),
(44, 40),
(44, 41),
(45, 40),
(45, 46),
(47, 34),
(47, 38),
(47, 48),
(48, 35),
(48, 37),
(48, 42),
(49, 38),
(49, 44),
(49, 47),
(50, 35),
(50, 36),
(50, 41),
(50, 46),
(51, 35),
(51, 36),
(51, 37),
(51, 41),
(51, 42),
(52, 47),
(52, 48),
(53, 35),
(53, 36),
(53, 40),
(53, 42),
(54, 34),
(54, 38),
(54, 47),
(55, 35),
(55, 36),
(55, 37),
(55, 41),
(55, 42),
(56, 40),
(56, 41),
(57, 34),
(57, 47),
(58, 37),
(58, 38),
(58, 47),
(59, 39),
(59, 40),
(59, 47);

-- --------------------------------------------------------

--
-- Table structure for table `movie_translations`
--

CREATE TABLE `movie_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `movie_id` int(10) UNSIGNED NOT NULL,
  `lang` varchar(11) COLLATE utf8mb4_bin NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `description` text COLLATE utf8mb4_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `content` text COLLATE utf8mb4_bin,
  `slug` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `is_system_page` tinyint(4) DEFAULT '0',
  `meta_keywords` text COLLATE utf8mb4_bin,
  `meta_description` text COLLATE utf8mb4_bin,
  `status` enum('public','draft') COLLATE utf8mb4_bin DEFAULT 'public',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `content`, `slug`, `is_system_page`, `meta_keywords`, `meta_description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Make a Donation', 'PGgyIHN0eWxlPSJ0ZXh0LWFsaWduOiBjZW50ZXI7ICI+TGlrZSBvdXIgU2l0ZT8gRG9uYXRlIHRvIEtlZXAgb3VyIFNlcnZlciBBbGl2ZSBGb3JldmVyPC9oMj48cCBzdHlsZT0idGV4dC1hbGlnbjogY2VudGVyOyI+R3JvdyB5b3VyIE1vdmllcyB3ZWJzaXRlLCBXaXRoIHRoZSBIZWxwIG9mIFN0cmVhbUFQSSwgT3VyIFNlcnZpY2UgaXMgY29tcGxldGVseSBmcmVlIHRvIHVzZTwvcD48cCBzdHlsZT0idGV4dC1hbGlnbjogY2VudGVyOyI+b3VyIHNlcnZlciBidWRnZXQgY29zdHMgaW4gb25lIG1vbnRoPGJyPjwvcD48dGFibGUgY2xhc3M9InRhYmxlIHRhYmxlLWJvcmRlcmVkIj48dGJvZHk+PHRyPjx0ZD5QYXkgQnVkZ2V0IEZlZXM8YnI+PC90ZD48dGQ+VlBTIENsb3VkIFZEUzwvdGQ+PHRkPk9uZSBNb250aCAkMjQ8YnI+PC90ZD48L3RyPjx0cj48dGQ+UGF5IEJ1ZGdldCBGZWVzPGJyPjwvdGQ+PHRkPlZpZGVvIFN0b3JhZ2UgNCBUQiZuYnNwOzwvdGQ+PHRkPk9uZSBNb250aCAkMTY8YnI+PC90ZD48L3RyPjwvdGJvZHk+PC90YWJsZT48cCBzdHlsZT0idGV4dC1hbGlnbjogY2VudGVyOyI+RG9uYXRpb25zIGFyZSB1c2VkIHRvIHBheSBmb3IgU3RyZWFtQVBJIHNlcnZlciBuZWVkcywgbm90IGZvciBwZXJzb25hbCBuZWVkczwvcD48cCBzdHlsZT0idGV4dC1hbGlnbjogY2VudGVyOyI+d2UgbWFrZSBkb25hdGlvbnMgdG8ga2VlcCB0aGUgc2VydmVyIGFsaXZlIGZvcmV2ZXI8L3A+PHAgc3R5bGU9InRleHQtYWxpZ246IGNlbnRlcjsiPndoYXQgYXJlIHRoZSBiZW5lZml0cz8sIHRoZXJlIGFyZSBubyBhZHMgaW4gdmlkZW88L3A+PHAgc3R5bGU9InRleHQtYWxpZ246IGNlbnRlcjsiPjxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE2cHg7IGZvbnQtd2VpZ2h0OiA1MDA7Ij5JZiB5b3Ugd2FudCB0byBkb25hdGUgcGxlYXNlLCB3aGF0ZXZlciB5b3VyIGRvbmF0aW9uIHdlIGFjY2VwdDwvc3Bhbj48YnI+PC9wPjx0YWJsZSBjbGFzcz0idGFibGUgdGFibGUtYm9yZGVyZWQiPjx0Ym9keT48dHI+PHRkPk1ha2UgYSBEb25hdGU8L3RkPjx0ZD5WaWEgQmluYW5jZTwvdGQ+PHRkPlVzZXIgSUQgOiA1NTQ4MDI3NTM8YnI+PC90ZD48L3RyPjx0cj48dGQ+TWFrZSBhIERvbmF0ZTxicj48L3RkPjx0ZD5VU0RUIFdhbGxldDwvdGQ+PHRkPjB4ZGQ1MDQyMDUyNTM1YmRhZTk5OGMxMDE5ZjNmMmQwYmFmNTg2MzU1Yjxicj48L3RkPjwvdHI+PHRyPjx0ZD5NYWtlIGEgRG9uYXRlPGJyPjwvdGQ+PHRkPkJpdGNvaW48L3RkPjx0ZD4xNzJCZEtHMUxhTDZEWkVQWmExbmE0TFJIcEJRTDF4NkhaPGJyPjwvdGQ+PC90cj48dHI+PHRkPk1ha2UgYSBEb25hdGU8YnI+PC90ZD48dGQ+QmFuayBUcmFuc2Zlcjxicj48L3RkPjx0ZD5ObyBSZWtlbmluZyBCQ0EgOiAyMDkwMTc3NjQxPGJyPjwvdGQ+PC90cj48dHI+PHRkPk1ha2UgYSBEb25hdGU8YnI+PC90ZD48dGQ+U29jaWFidXp6IDogU3VwcG9ydCBBbGwgQ291bnRyeTxicj48L3RkPjx0ZD48cD48YSBocmVmPSJodHRwczovL3NvY2lhYnV6ei5jb20vY29kZW5pbmUvZG9uYXRlIiB0YXJnZXQ9Il9ibGFuayI+TWFrZSBhIERvbmF0ZTwvYT48YnI+PC9wPjwvdGQ+PC90cj48L3Rib2R5PjwvdGFibGU+PGgyIHN0eWxlPSJ0ZXh0LWFsaWduOiBjZW50ZXI7Ij5UaGFuayB5b3UgZm9yIGRvbmF0aW5nLCBTdHJlYW1BUEkgc2VydmVyIHRvIGtlZXAgaXQgYWxpdmUgZm9yZXZlcjwvaDI+', 'donation', 0, '', '', 'public', '2024-01-07 09:11:00', '2024-01-16 02:38:24'),
(2, 'DCMA', '', 'dcma', 0, '', '', 'public', '2024-01-07 09:11:53', '2024-01-07 09:11:53'),
(3, 'Terms of Service', '', 'terms-of-service', 0, '', '', 'public', '2024-01-07 09:12:50', '2024-01-07 09:12:50'),
(4, 'Privacy Policy', '', 'privacy-policy', 0, '', '', 'public', '2024-01-07 09:13:37', '2024-01-07 09:13:37'),
(5, 'Cookie Policy', '', 'cookie-policy', 0, '', '', 'public', '2024-01-07 09:15:01', '2024-01-07 09:15:01'),
(6, 'Rent Advertising', '', 'rent-advertising', 0, '', '', 'public', '2024-01-07 09:15:42', '2024-01-07 09:15:42'),
(7, 'Video Quality', 'PHA+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij5UaGUgcXVhbGl0eSBvZiBhIGZpbG0gaXMgYW4gaW1wb3J0YW50IHRoaW5nIHRoYXQgbXVzdCBiZSBjb25zaWRlcmVkLiBQb29yIGZpbG0gcXVhbGl0eSB3aWxsIG1ha2UgYW4gb3RoZXJ3aXNlIGdvb2QgZmlsbSB1bnBsZWFzYW50IHRvIHdhdGNoLiBGb3IgdGhvc2Ugb2YgeW91IHdobyBmcmVxdWVudGx5IGRvd25sb2FkIG1vdmllcywgb2YgY291cnNlIHlvdSBrbm93IHdoaWNoIHF1YWxpdHkgaXMgdGhlIGJlc3QgYW5kIHRoZSB3b3JzdC4gTW92aWVzIHdpdGggZ29vZCBxdWFsaXR5IHVzdWFsbHkgaGF2ZSBhIGZhaXJseSBsYXJnZSBzaXplIGluIHRoZSBkZXZpY2XigJlzIG1lbW9yeS48L3NwYW4+PC9wPjxwPjEuIEJsdXJheS8gQlJS0ZbRgDwvcD48cD48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPlRoaXMgdHlwZSBpcyB0aGUgYmVzdCBhbmQgaGlnaGVzdCBxdWFsaXR5IGZvciBtb3ZpZXMuIFRoZSBpbWFnZXMgYW5kIGF1ZGlvIGRpc3BsYXllZCBpbiBmaWxtcyBvZiB0aGlzIHF1YWxpdHkgYXJlIHZlcnkgZ29vZC4gQmx1cmF5L0JSUtGW0YAgaGFzIHRoZSBoaWdoZXN0IHJlc29sdXRpb24sIG5hbWVseSAxOTIww5cxMDgwIGFuZCAxMjgww5c3MjAgKDcyMNGAKS4gSG93ZXZlciwgaWYgeW91IHdhbnQgdG8gZG93bmxvYWQgQmx1cmF5L0JSUmlwIHF1YWxpdHkgbW92aWVzLCB5b3UgbXVzdCBoYXZlIGhpZ2ggY29tcHV0ZXIgc3BlY2lmaWNhdGlvbnMuIElmIHRoZSBjb21wdXRlciBzcGVjcyBhcmUgbG93LCB0aGVuIHRoZSBpbWFnZSBpbiBtb3ZpZXMgd2lsbCBiZSBjaG9wcHkgb3IgdW53YXRjaGFibGUuPC9zcGFuPjwvcD48cD4yLiBIRFRWLyBIRFRWUtGW0YA8L3A+PHA+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij5UaGlzIGlzIGEgdmVyeSBnb29kIG1lYXN1cmUgaW4gdGVybXMgb2YgbW92aWUgc2l6ZS4gVGhpcyBxdWFsaXR5IG1lYXN1cmUgY29tZXMgZnJvbSBkaWdpdGFsIHJlY29yZGluZ3Mgb2YgY2FibGUgVFYsIGRpZ2l0YWwgVFYgb3Igc2F0ZWxsaXRlIFRWIGNoYW5uZWxzLjwvc3Bhbj48L3A+PHA+My4gbUhEIChN0ZZu0ZYvIE3RltGBctC+IEhEKTwvcD48cD48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPlRoaXMgcXVhbGl0eSBpcyBhY3R1YWxseSBhbG1vc3QgdGhlIHNhbWUgYXMgQmx1cmF5LCBpdOKAmXMganVzdCB0aGF0IHRoZSBzaXplIGlzIHNtYWxsZXIuIEJ1dCB0YWtlIGl0IGVhc3ksIHRoZSBwaWN0dXJlcyBhbmQgYXVkaW8gb2YgdGhpcyBxdWFsaXR5IGZpbG0gYXJlIHN0aWxsIGdvb2QgdG8gYmUgZW5qb3llZCB3aGlsZSB3YXRjaGluZy48L3NwYW4+PC9wPjxwPjQuIFdFQi1ETDwvcD48cD48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPlRoZSBxdWFsaXR5IG9mIHRoaXMgb25lIGlzIGFsbW9zdCBvbiBwYXIgd2l0aCBCbHVyYXkgNzIwcC4gVGhlIFdlYi1ETCB2ZXJzaW9uIHVzdWFsbHkgZG9lc27igJl0IGhhdmUgdGhlIFRWIGxvZ28gb3Igb24tc2NyZWVuIGFkcyBsaWtlIHRoZXJlIGFyZSBIRFRWcy48L3NwYW4+PC9wPjxwPjUuIERWRFLRltGAPC9wPjxwPjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogbm9ybWFsOyI+RFZEUmlwIGlzIGEgUklQIG9mIHRoZSBvcmlnaW5hbCBEVkQgdGhhdCBoYXMgYmVlbiBvdXQgdGhlcmUuIE1vdmllcyB3aXRoIHRoaXMgcXVhbGl0eSBhcmUgb25seSB0YWtlbiBieSB2aWRlbyB3aXRob3V0IGFueSBleHRyYSBmZWF0dXJlcy4gRFZEUmlwIHF1YWxpdHkgZGVwZW5kcyBvbiB0aGUgcmlwcGluZyBwcm9jZXNzLCBidXQgbW9zdCBEVkRSaXBzIGhhdmUgdGhlIHNhbWUgcXVhbGl0eSBhcyB0aGUgb3JpZ2luYWwgRFZEIGJvdGggaW1hZ2VzIGFuZCBzb3VuZC48L3NwYW4+PC9wPjxwPjYuIFdFQlJpcDwvcD48cD48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPlRoaXMgcXVhbGl0eSBpcyB0YWtlbiBkaXJlY3RseSBmcm9tIGEgc2l0ZSB0aGF0IHByb3ZpZGVzIHZpZGVvIHN0cmVhbWluZy4gVGhpcyB0eXBlIG9mIHF1YWxpdHkgaXMgc3VpdGFibGUgZm9yIHRob3NlIG9mIHlvdSB3aG8gbGlrZSB0byBkb3dubG9hZCBtb3ZpZXMgdXNpbmcgYSBzbWFydHBob25lLiBUaGlzIGlzIGJlY2F1c2UgdGhlIHJlc29sdXRpb24gb2YgdGhpcyBxdWFsaXR5IGlzIHZlcnkgZ29vZCBhbmQgZml0cyByaWdodCBvbiBhIHNtYXJ0cGhvbmUuPC9zcGFuPjwvcD48cD43LiBEVkRTY3I8L3A+PHA+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij5UaGUgcXVhbGl0eSBvZiB0aGlzIG9uZSBpcyBzdGlsbCByZWFsbHkgYmFkLiBBbmQgdXN1YWxseSB0aGlzIHF1YWxpdHkgaXMgdGFrZW4gZnJvbSBBc2lhbiBjaW5lbWFzIHN1Y2ggYXMgQ2hpbmEgYW5kIEtvcmVhLjwvc3Bhbj48L3A+PHA+OC5DQU0vIEhEQ0FNPC9wPjxwPjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogbm9ybWFsOyI+VGhpcyBsYXN0IHF1YWxpdHkgaXMgdGhlIHdvcnN0IHF1YWxpdHkgYW1vbmcgdGhlIG90aGVycy4gVGhpcyBmaWxlIGlzIHRha2VuIGZyb20gdGhlIGNhbWVyYSB0aGF0IHJlY29yZHMgdGhlIGNvdXJzZSBvZiB0aGUgZmlsbSBpbiB0aGUgY2luZW1hLiBQaWN0dXJlcyBvZiB0aGlzIHF1YWxpdHkgYXJlIHVzdWFsbHkgc2hha3kgYW5kIHRoZSBhdWRpbyBibGVuZHMgaW4gd2l0aCB0aGUgc291bmQgb2YgdGhlIGF1ZGllbmNlPC9zcGFuPjwvcD4=', 'video-quality', 0, 'Quality Video', 'The quality of a film is an important thing that must be considered. Poor film quality will make an otherwise good film unpleasant to watch. For those of you who frequently download movies, of course you know which quality is the best and the worst. Movies with good quality usually have a fairly large size in the device’s memory.', 'public', '2024-01-12 19:53:22', '2024-01-12 19:53:22');

-- --------------------------------------------------------

--
-- Table structure for table `page_translations`
--

CREATE TABLE `page_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_id` int(10) UNSIGNED NOT NULL,
  `lang` varchar(11) COLLATE utf8mb4_bin NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `content` text COLLATE utf8mb4_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `tmdb_id` varchar(11) COLLATE utf8mb4_bin NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `type` enum('movie','tv') COLLATE utf8mb4_bin DEFAULT 'movie',
  `requests` int(10) UNSIGNED DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` enum('pending','imported','canceled') COLLATE utf8mb4_bin DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `requests_subscription`
--

CREATE TABLE `requests_subscription` (
  `id` int(10) UNSIGNED NOT NULL,
  `request_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

CREATE TABLE `seasons` (
  `id` int(11) UNSIGNED NOT NULL,
  `series_id` int(11) UNSIGNED NOT NULL,
  `season` tinyint(3) UNSIGNED NOT NULL,
  `total_episodes` tinyint(3) UNSIGNED DEFAULT NULL,
  `is_completed` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seasons`
--

INSERT INTO `seasons` (`id`, `series_id`, `season`, `total_episodes`, `is_completed`) VALUES
(1, 1, 1, 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `imdb_id` varchar(11) NOT NULL,
  `tmdb_id` varchar(11) DEFAULT NULL,
  `imdb_rate` decimal(3,1) DEFAULT '0.0',
  `released_at` date DEFAULT NULL,
  `poster` varchar(128) DEFAULT NULL,
  `banner` varchar(128) DEFAULT NULL,
  `total_seasons` tinyint(3) UNSIGNED DEFAULT NULL,
  `total_episodes` tinyint(3) UNSIGNED DEFAULT NULL,
  `country` varchar(128) DEFAULT NULL,
  `language` varchar(45) DEFAULT NULL,
  `is_completed` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `status` enum('returning','ended') NOT NULL DEFAULT 'returning',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `year` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`id`, `title`, `imdb_id`, `tmdb_id`, `imdb_rate`, `released_at`, `poster`, `banner`, `total_seasons`, `total_episodes`, `country`, `language`, `is_completed`, `status`, `created_at`, `updated_at`, `year`) VALUES
(1, 'A Herbivorous Dragon of 5,000 Years Gets Unfairly Villainized', 'tt16183478', '139161', '6.0', '2022-07-30', 'https://image.tmdb.org/t/p/w300/5JPmC1VafZLSj3Ee3hOEQrbX8DL.jpg', 'https://image.tmdb.org/t/p/original/6Fr7nT3E7cqafLgI5JARzYCiXt7.jpg', 1, 12, 'Chinese', 'chinese', 0, 'ended', '2024-01-03 21:49:05', '2024-01-03 21:49:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `series_genre`
--

CREATE TABLE `series_genre` (
  `series_id` int(11) UNSIGNED NOT NULL,
  `genre_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `series_genre`
--

INSERT INTO `series_genre` (`series_id`, `genre_id`) VALUES
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 42),
(1, 48);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `name` varchar(60) NOT NULL,
  `value` text,
  `data_type` varchar(31) DEFAULT 'string'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`name`, `value`, `data_type`) VALUES
('ad_block_detector', '1', 'bool'),
('allowed_referer_list', '[]', 'array'),
('api_status_check_rate_limit', '100', 'int'),
('custom_footer_codes', '', 'string'),
('custom_header_codes', '', 'string'),
('default_banner', 'default-banner.jpg', 'string'),
('default_poster', 'default-poster.jpg', 'string'),
('default_server', 'player.streamapi.info', 'string'),
('default_theme', 'pirate', 'string'),
('dev_api', '1', 'bool'),
('dev_apikey', 'exqS9kuNr2oobjZ39u', 'string'),
('dl_link_waiting_time', '15', 'int'),
('download_links_requests_limit', '30', 'int'),
('download_quality_formats', '[\"Bluray\",\"BRR\\u0456\\u0440\",\"WEB-DL\"]', 'array'),
('download_resolution_formats', '[\"1080p\",\"720p\",\"480p\"]', 'array'),
('download_slug', '', 'string'),
('download_system', '1', 'bool'),
('email_address', '', 'string'),
('embed_requests_limit', '25', 'string'),
('embed_slug', 'player', 'string'),
('footer_content', 'StreamAPI - Video Streaming API.\r\nWatch High Quality Movies & TV Series, Available In 7 Subtitle Languages, We Are Not The Biggest & Most Complete, But We Try To Provide The Best Film Quality For You To Watch', 'string'),
('gcaptcha_secret_key', '', 'string'),
('gcaptcha_site_key', '', 'string'),
('home_items_per_page', '30', 'int'),
('is_count_down_timer', '1', 'bool'),
('is_download_link_captcha', '1', 'bool'),
('is_links_report', '1', 'bool'),
('is_media_download_to_server', '0', 'bool'),
('is_multi_lang', '0', 'bool'),
('is_referer_blocked', '0', 'bool'),
('is_request_captcha_enabled', '1', 'bool'),
('is_sidebar_disabled', '0', 'bool'),
('is_stream_gcaptcha_enabled', '0', 'bool'),
('items_per_imdb_top_page', '30', 'int'),
('items_per_new_release_page', '30', 'int'),
('items_per_recommend_page', '30', 'int'),
('items_per_trending_page', '30', 'int'),
('library_items_per_page', '30', 'int'),
('library_slug', '', 'string'),
('links_requests_limit', '25', 'int'),
('link_slug', '', 'string'),
('main_language', 'en-US', 'string'),
('omdb_api_key', 'a1da006f', 'string'),
('renamed_servers', '{\"player.streamapi.info\":\"StreamAPI\",\"dl.streamapi.info\":\"StreamAPI | Direct Download\"}', 'array'),
('report_requests_limit', '5', 'int'),
('request_system', '1', 'bool'),
('req_email_subscription', '1', 'bool'),
('selected_languages', '[]', 'array'),
('site_copyright', '© 2024 All Rights Reserved', 'string'),
('site_description', '', 'string'),
('site_favicon', 'favicon.ico', 'string'),
('site_keywords', '', 'string'),
('site_logo', 'logo.png', 'string'),
('site_name', 'Video Streaming API', 'string'),
('site_title', 'StreamAPI', 'string'),
('smtp_settings', '{\"host\":\"\",\"user\":\"\",\"pass\":\"\",\"port\":\"\"}', 'array'),
('stream_links_requests_limit', '25', 'int'),
('stream_quality_formats', '[\"Bluray\",\"BRR\\u0456\\u0440\",\"WEB-DL\"]', 'array'),
('tmdb_api_key', '09626ef631159c05a1bf9e8fe510365a', 'string'),
('version', '1.2', 'string'),
('view_slug', 'video_id', 'string'),
('watch_history_limit', '18', 'int'),
('web_page_cache', '0', 'bool'),
('web_page_cache_duration', '86400', 'int');

-- --------------------------------------------------------

--
-- Table structure for table `third_party_apis`
--

CREATE TABLE `third_party_apis` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `provider` varchar(30) COLLATE utf8mb4_bin NOT NULL DEFAULT 'custom',
  `api_base_url` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `api_token` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `movie_api` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `series_api` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `status` enum('active','paused') COLLATE utf8mb4_bin DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_movies`
--
ALTER TABLE `failed_movies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `imdb_id` (`imdb_id`),
  ADD UNIQUE KEY `tmdb_id` (`tmdb_id`) USING BTREE;

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `genre_translations`
--
ALTER TABLE `genre_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `genre_trans_unique_index` (`genre_id`,`lang`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `links_movie_id_fk` (`movie_id`),
  ADD KEY `links_api_id_fk` (`api_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `imdb_id` (`imdb_id`),
  ADD UNIQUE KEY `tmdb_id` (`tmdb_id`),
  ADD KEY `season_id` (`season_id`);

--
-- Indexes for table `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD KEY `movie_genre_movie_id_fk` (`movie_id`),
  ADD KEY `movie_genre_g_id_fk` (`genre_id`);

--
-- Indexes for table `movie_translations`
--
ALTER TABLE `movie_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lang_unique_index` (`movie_id`,`lang`) USING BTREE;

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_translations`
--
ALTER TABLE `page_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_t_unique_index` (`page_id`,`lang`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `req_imdb` (`tmdb_id`);

--
-- Indexes for table `requests_subscription`
--
ALTER TABLE `requests_subscription`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `req_sub_unique_index` (`request_id`,`email`);

--
-- Indexes for table `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seasons_series_id_fk` (`series_id`);

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `imdb_id` (`imdb_id`),
  ADD UNIQUE KEY `tmdb_id` (`tmdb_id`);

--
-- Indexes for table `series_genre`
--
ALTER TABLE `series_genre`
  ADD KEY `series_genre_movie_id_fk` (`series_id`),
  ADD KEY `series_genre_g_id_fk` (`genre_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `third_party_apis`
--
ALTER TABLE `third_party_apis`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_movies`
--
ALTER TABLE `failed_movies`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `genre_translations`
--
ALTER TABLE `genre_translations`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `movie_translations`
--
ALTER TABLE `movie_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `page_translations`
--
ALTER TABLE `page_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests_subscription`
--
ALTER TABLE `requests_subscription`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seasons`
--
ALTER TABLE `seasons`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `third_party_apis`
--
ALTER TABLE `third_party_apis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `genre_translations`
--
ALTER TABLE `genre_translations`
  ADD CONSTRAINT `genre_translation_fk` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `links_api_id_fk` FOREIGN KEY (`api_id`) REFERENCES `third_party_apis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `links_movie_id_fk` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`season_id`) REFERENCES `seasons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD CONSTRAINT `movie_genre_g_id_fk` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movie_genre_movie_id_fk` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `movie_translations`
--
ALTER TABLE `movie_translations`
  ADD CONSTRAINT `translations_movie_id` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `page_translations`
--
ALTER TABLE `page_translations`
  ADD CONSTRAINT `FK_page_translate` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requests_subscription`
--
ALTER TABLE `requests_subscription`
  ADD CONSTRAINT `FK_req_id` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seasons`
--
ALTER TABLE `seasons`
  ADD CONSTRAINT `seasons_series_id_fk` FOREIGN KEY (`series_id`) REFERENCES `series` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `series_genre`
--
ALTER TABLE `series_genre`
  ADD CONSTRAINT `series_genre_g_id_fk` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `series_genre_movie_id_fk` FOREIGN KEY (`series_id`) REFERENCES `series` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
