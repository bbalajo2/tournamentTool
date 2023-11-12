-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2022 at 06:35 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tournament`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `title`, `release_date`, `logo`) VALUES
(1, 'League Of Legends', '2009-04-14', 'LINK OF IMAGE'),
(2, 'Counter Strike Global Ofensive', '2013-05-30', 'LINK OF IMAGE'),
(3, 'World Of Warcraft', '2005-04-23', 'LINK OF IMAGE');

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `team1_id` int(11) DEFAULT NULL,
  `team2_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `score` varchar(255) DEFAULT NULL,
  `winner_id` int(11) DEFAULT NULL,
  `playing_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id`, `tournament_id`, `team1_id`, `team2_id`, `type`, `score`, `winner_id`, `playing_date`) VALUES
(1, 1, 1, 2, 'Semi-finals', '3-2', 1, '2022-05-21'),
(2, 1, 3, 4, 'Semi-finals', '2-3', 4, '2022-05-21'),
(3, 1, 1, 4, 'Finals', '1-3', 4, '2022-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `organisations`
--

CREATE TABLE `organisations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `creation_date` date DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organisations`
--

INSERT INTO `organisations` (`id`, `name`, `logo`, `creation_date`, `creator_id`) VALUES
(1, 'LEC', 'LINK', '2012-03-15', 1),
(2, 'LCS', 'LINK', '2008-05-21', 3),
(3, 'LPL', 'LINK', '2013-08-07', 4),
(4, 'LCK', 'LINK', '2011-11-23', 2);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `creation_date` date DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `creation_date`, `creator_id`) VALUES
(1, 'TSM', '2012-03-15', 1),
(2, 'FNC', '2008-05-21', 3),
(3, 'G2', '2013-08-07', 4),
(4, 'T1', '2011-11-23', 2);

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `resign_date` date DEFAULT NULL,
  `application_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`team_id`, `user_id`, `role`, `status`, `join_date`, `resign_date`, `application_status`) VALUES
(1, 1, 'Player', 'Aproved', '2012-03-15', '0000-00-00', 'Aoproved'),
(2, 2, 'Coach', 'Aproved', '2012-03-15', '0000-00-00', 'Aoproved'),
(2, 3, 'Player', 'Aproved', '2012-03-15', '0000-00-00', 'Aoproved');

-- --------------------------------------------------------

--
-- Table structure for table `tournaments`
--

CREATE TABLE `tournaments` (
  `id` int(11) NOT NULL,
  `title` varchar(16) DEFAULT NULL,
  `creation_date` date DEFAULT NULL,
  `format` varchar(10) DEFAULT NULL,
  `bracket_image` varchar(100) DEFAULT NULL,
  `number_of_teams` int(11) DEFAULT NULL,
  `players_in_team` int(11) DEFAULT NULL,
  `prize_pool` decimal(10,2) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL,
  `organisation_id` int(11) DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tournaments`
--

INSERT INTO `tournaments` (`id`, `title`, `creation_date`, `format`, `bracket_image`, `number_of_teams`, `players_in_team`, `prize_pool`, `game_id`, `organisation_id`, `creator_id`) VALUES
(1, 'Tournament1', '2022-04-14', 'SWISS', 'LINK OF IMAGE', 8, 5, '1200.00', 1, 1, 1),
(2, 'Tournament2', '2021-03-11', 'Round Robi', 'LINK OF IMAGE', 4, 5, '20000.00', 2, 1, 1),
(3, 'Tournament3', '2013-02-21', 'Single Eli', 'LINK OF IMAGE', 16, 3, '100.00', 3, 1, 1),
(4, 'Tournament4', '2019-07-24', 'Double Eli', 'LINK OF IMAGE', 24, 1, '500.00', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tournament_teams`
--

CREATE TABLE `tournament_teams` (
  `team_id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `application_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tournament_teams`
--

INSERT INTO `tournament_teams` (`team_id`, `tournament_id`, `status`, `application_date`) VALUES
(1, 1, 'Aproved', '2012-03-15'),
(2, 1, 'Aproved', '2012-03-15'),
(3, 1, 'Aproved', '2012-03-15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(210) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `organisation_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `date_of_birth`, `organisation_id`) VALUES
(1, 'Tom', '2022-04-14', 'Thomas', 'Shelby', 't.shelby@peaky_fucking_blinders.com', '1920-03-15', 1),
(2, 'baco', 'paco', 'Plamen', 'Bukov', 'plamen_bukov@gmail.com', '2001-01-27', 1),
(3, 'Hylissang', 'coinflip', 'Zdravets ', 'Galabov ', 'hyli@gmail.com', '1995-04-30', 1),
(4, 'test1', 'test1', 'test1', 'test1', 'test1@gmail.com', '2001-01-01', 1),
(5, 'test2', 'test2', 'test2', 'test2', 'test2@gmail.com', '2001-01-01', 1),
(6, 'test3', 'test3', 'test3', 'test3', 'test3@gmail.com', '2001-01-01', 2),
(7, 'test4', 'test4', 'test4', 'test4', 'test4@gmail.com', '2001-01-01', 1),
(8, 'test5', 'test5', 'test5', 'test5', 'test5@gmail.com', '2001-01-01', 1),
(9, 'test6', 'test6', 'test6', 'test6', 'test6@gmail.com', '2001-01-01', 1),
(10, 'test7', 'test7', 'test7', 'test7', 'test7@gmail.com', '2001-01-01', 1),
(11, 'test8', 'test8', 'test8', 'test8', 'test8@gmail.com', '2001-01-01', 1),
(12, 'test9', 'test9', 'test9', 'test9', 'test9@gmail.com', '2001-01-01', 2),
(13, 'test10', 'test10', 'test10', 'test10', 'test10@gmail.com', '2001-01-01', 2),
(14, 'test11', 'test11', 'test11', 'test11', 'test11@gmail.com', '2001-01-01', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`, `tournament_id`),
  ADD KEY `team1_id` (`team1_id`),
  ADD KEY `team2_id` (`team2_id`),
  ADD KEY `tournament_id` (`tournament_id`);

--
-- Indexes for table `organisations`
--
ALTER TABLE `organisations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`team_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tournaments`
--
ALTER TABLE `tournaments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `organisation_id` (`organisation_id`);

--
-- Indexes for table `tournament_teams`
--
ALTER TABLE `tournament_teams`
  ADD PRIMARY KEY (`team_id`,`tournament_id`),
  ADD KEY `tournament_id` (`tournament_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organisation_id` (`organisation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


--
-- AUTO_INCREMENT for table `organisations`
--
ALTER TABLE `organisations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tournaments`
--
ALTER TABLE `tournaments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`team1_id`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`team2_id`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `matches_ibfk_3` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`);

--
-- Constraints for table `organisations`
--
ALTER TABLE `organisations`
  ADD CONSTRAINT `organisations_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `team_members`
--
ALTER TABLE `team_members`
  ADD CONSTRAINT `team_members_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `team_members_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tournaments`
--
ALTER TABLE `tournaments`
  ADD CONSTRAINT `tournaments_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `tournaments_ibfk_2` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tournaments_ibfk_3` FOREIGN KEY (`organisation_id`) REFERENCES `organisations` (`id`);

--
-- Constraints for table `tournament_teams`
--
ALTER TABLE `tournament_teams`
  ADD CONSTRAINT `tournament_teams_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `tournament_teams_ibfk_2` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`organisation_id`) REFERENCES `organisations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
