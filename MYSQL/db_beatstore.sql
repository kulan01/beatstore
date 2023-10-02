-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 12, 2017 at 05:52 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_beatstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `beats`
--

CREATE TABLE `beats` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `bpm` int(3) NOT NULL,
  `tags` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beats`
--

INSERT INTO `beats` (`id`, `name`, `filename`, `cover_image`, `bpm`, `tags`) VALUES
(1, 'Lovely Town', 'media/lovely_town.mp3', 'images/pexels3.jpeg', 100, 'Trap, Hip Hop, Dj Foreign, Migos'),
(2, 'Young Stream', 'media/stream1.mp3', 'images/pexels5.jpeg', 140, 'Trap, Hip Hop, Dj Foreign, Chris Brown'),
(3, 'Dreams', 'media/325788_808_mafia.mp3', 'images/2333128_fullsizerender.jpg', 140, 'Trap, 808 Mafia, Southside'),
(4, 'Lovely Lown', 'media/1598106_lovely_town_beat.mp3', 'images/2762341_lwscreenshot_2017-02-28_at_8.07.43_am.png', 93, 'Trap, Lil Yatchy, Metro Booming');

-- --------------------------------------------------------

--
-- Table structure for table `licenses`
--

CREATE TABLE `licenses` (
  `id` int(11) NOT NULL,
  `license_name` varchar(255) NOT NULL,
  `num_sales` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `num_downloads` varchar(255) NOT NULL,
  `num_streams` varchar(255) NOT NULL,
  `isProfitable` tinyint(1) NOT NULL,
  `num_performances` varchar(255) NOT NULL,
  `num_videos` varchar(255) NOT NULL,
  `num_mon_videos` varchar(255) NOT NULL,
  `radio_stations` varchar(255) NOT NULL,
  `years_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `licenses`
--

INSERT INTO `licenses` (`id`, `license_name`, `num_sales`, `price`, `num_downloads`, `num_streams`, `isProfitable`, `num_performances`, `num_videos`, `num_mon_videos`, `radio_stations`, `years_active`) VALUES
(1, 'mp3', '5000', '24.99', '10000', '50000', 0, '5000', '0', '0', '0', 10),
(2, 'wav', '10000', '39.99', '50000', '100000', 0, '50000', '1', '1', '1', 10),
(3, 'premium', '50000', '80.00', '100000', '500000', 1, '100000', '2', '2', '3', 15),
(4, 'unlimited', 'unlimited', '199.98', 'unlimited', 'unlimited', 1, 'unlimited', 'unlimited', 'unlimited', 'unlimited', 15);

-- --------------------------------------------------------

--
-- Table structure for table `music_posts`
--

CREATE TABLE `music_posts` (
  `id` int(11) NOT NULL,
  `song_name` varchar(255) NOT NULL,
  `song_artist` varchar(255) NOT NULL,
  `song_url` varchar(255) NOT NULL,
  `song_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `music_posts`
--

INSERT INTO `music_posts` (`id`, `song_name`, `song_artist`, `song_url`, `song_content`) VALUES
(1, 'To The Top', 'Young Mali', 'yaOlHQc1y1g', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum asperiores dolor eos aspernatur modi, consectetur inventore sit quo perferendis, nesciunt omnis libero similique quos perspiciatis impedit porro corrupti eum ullam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt quos provident aliquid nulla officiis quam recusandae nisi iure quod blanditiis. Dolorem possimus sint similique, ex vitae a reprehenderit unde aut!'),
(2, 'Solo money', 'Young Mali', 'YjynwBAf3SI', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi dolorem natus maiores asperiores dicta nemo alias eum, hic inventore tenetur! Molestias labore iste impedit laborum laboriosam at ipsam quis ab.');

-- --------------------------------------------------------

--
-- Table structure for table `navbar`
--

CREATE TABLE `navbar` (
  `id` int(11) NOT NULL,
  `page` varchar(255) NOT NULL,
  `link` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `navbar`
--

INSERT INTO `navbar` (`id`, `page`, `link`) VALUES
(1, 'Home', 'index.php'),
(2, 'Beat Licenses', 'licenses.php'),
(3, 'Music Releases', 'music.php'),
(4, 'Contact', 'contact.php');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `beat_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `beat_name` varchar(255) NOT NULL,
  `license` varchar(255) NOT NULL,
  `payerId` varchar(255) NOT NULL,
  `paymentId` varchar(255) NOT NULL,
  `price` varchar(5) NOT NULL,
  `created_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `beat_id`, `buyer_id`, `beat_name`, `license`, `payerId`, `paymentId`, `price`, `created_time`) VALUES
(15, 1, 1, 'Lovely Town', 'MP3 License', 'XVVCP7FVAACHJ', 'PAY-81T64399X93329936LFPNTEI', '24.99', '2017-07-06 20:45:21'),
(16, 2, 1, 'Young Stream', 'MP3 License', 'XVVCP7FVAACHJ', 'PAY-81T64399X93329936LFPNTEI', '24.99', '2017-07-06 20:45:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(255) NOT NULL,
  `stage_name` varchar(255) DEFAULT NULL,
  `isAdmin` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `name`, `stage_name`, `isAdmin`) VALUES
(1, 'isissa01', 'isissa01@gmail.com', '$2y$15$HZDa.TEi/uGoROcoBQhGfuYEUgRvBtNYRINr9iw6IKunjYf1oABLy', 'Issa Issa', 'Issa Famous', 1),
(5, 'admin', 'admin01@gmail.com', '$2y$15$0z5JRZpsuc82fSKS3BGLte7.1IZfIQujBYYkYmKV5uWlVV2QHH8Pq', '', NULL, 1),
(7, 'musa01', 'musa01@gmail.com', '$2y$15$shyEo8.v8.qE35OkAqixCeWngi7rAtHc1yJn8GdAkAcjtxzaDlgom', 'Musa Issa', 'Young Fly', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beats`
--
ALTER TABLE `beats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `licenses`
--
ALTER TABLE `licenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `music_posts`
--
ALTER TABLE `music_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navbar`
--
ALTER TABLE `navbar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beats`
--
ALTER TABLE `beats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `licenses`
--
ALTER TABLE `licenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `music_posts`
--
ALTER TABLE `music_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `navbar`
--
ALTER TABLE `navbar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
