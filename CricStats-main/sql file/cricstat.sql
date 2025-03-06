-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2022 at 10:55 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cricstat`
--

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `Info_Id` int(11) NOT NULL,
  `Player_Id` int(11) NOT NULL,
  `Runs` int(11) DEFAULT NULL,
  `Fours` int(11) DEFAULT NULL,
  `Sixes` int(11) DEFAULT NULL,
  `Balls_Faced` int(11) DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL,
  `Overs` int(11) DEFAULT NULL,
  `Runs_Given` int(11) DEFAULT NULL,
  `Wickets_Taken` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`Info_Id`, `Player_Id`, `Runs`, `Fours`, `Sixes`, `Balls_Faced`, `Status`, `Overs`, `Runs_Given`, `Wickets_Taken`) VALUES
(7858, 1, 101, 1, 1, 1, 'Not_played', 0, 1, 1),
(7859, 1, 102, 1, 1, 1, 'Not_out', 0, 1, 1),
(7860, 1, 1003, 1, 1, 1, 'Not_played', 0, 1, 1),
(7861, 1, 104, 1, 1, 1, 'Out', 0, 1, 1),
(7862, 1, 105, 1, 1, 1, 'Not_out', 0, 1, 1),
(7863, 1, 106, 1, 1, 1, 'Not_played', 1, 1, 1),
(7864, 1, 107, 1, 1, 1, 'Out', 1, 1, 1),
(7865, 1, 108, 1, 1, 1, 'Not_out', 1, 1, 1),
(7866, 1, 109, 1, 1, 1, 'Not_played', 1, 1, 11),
(7867, 1, 110, 1, 1, 1, 'Out', 1, 1, 1),
(7868, 1, 111, 1, 1, 1, 'Not_out', 1, 1, 1),
(7869, 2, 101, 1, 1, 1, 'Not_played', 1, 1, 1),
(7870, 2, 102, 1, 1, 1, 'Not_out', 1, 1, 1),
(7871, 2, 1003, 1, 1, 1, 'Not_played', 1, 1, 1),
(7872, 2, 104, 1, 1, 1, 'Out', 1, 1, 1),
(7873, 2, 105, 1, 1, 1, 'Not_out', 1, 1, 1),
(7874, 2, 106, 1, 1, 1, 'Not_played', 1, 1, 1),
(7875, 2, 107, 1, 1, 1, 'Out', 1, 1, 1),
(7876, 2, 108, 1, 1, 1, 'Not_out', 1, 1, 1),
(7877, 2, 109, 1, 1, 1, 'Not_played', 1, 1, 11),
(7878, 2, 110, 1, 1, 1, 'Out', 1, 1, 1),
(7879, 2, 111, 1, 1, 1, 'Not_out', 1, 1, 1),
(7924, 16, 56, 6, 4, 18, 'Out', 1, 14, 0),
(7925, 17, 16, 1, 0, 12, 'Out', 0, 0, 0),
(7926, 12, 89, 6, 9, 42, 'Not_out', 0, 0, 0),
(7927, 27, 14, 0, 1, 10, 'Out', 0, 0, 0),
(7928, 31, 32, 1, 2, 20, 'Out', 2, 27, 0),
(7929, 25, 36, 2, 2, 18, 'Not_out', 0, 0, 0),
(7930, 26, 0, 0, 0, 0, 'Not_played', 3, 16, 0),
(7931, 24, 0, 0, 0, 0, 'Not_played', 3, 21, 0),
(7932, 15, 0, 0, 0, 0, 'Not_played', 4, 30, 2),
(7933, 23, 0, 0, 0, 0, 'Not_played', 4, 41, 0),
(7934, 8, 0, 0, 0, 0, 'Not_played', 3, 41, 0),
(7935, 21, 22, 2, 0, 18, 'Out', 0, 0, 0),
(7936, 14, 14, 1, 0, 9, 'Out', 0, 0, 0),
(7937, 11, 118, 9, 10, 47, 'Not_out', 0, 0, 0),
(7938, 13, 49, 2, 4, 19, 'Out', 2, 19, 1),
(7939, 30, 32, 2, 1, 20, 'Out', 0, 0, 0),
(7940, 32, 28, 2, 2, 18, 'Out', 0, 0, 0),
(7941, 28, 9, 0, 0, 8, 'Not_out', 3, 15, 2),
(7942, 19, 0, 0, 0, 0, 'Not_played', 3, 38, 0),
(7943, 29, 0, 0, 0, 0, 'Not_played', 4, 30, 2),
(7944, 18, 0, 0, 0, 0, 'Not_played', 4, 41, 0),
(7945, 20, 0, 0, 0, 0, 'Not_played', 4, 51, 0);

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `Match_Id` int(11) NOT NULL,
  `TeamA_Id` int(11) NOT NULL,
  `TeamB_Id` int(11) NOT NULL,
  `Team_Won` int(11) NOT NULL,
  `Held_On` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`Match_Id`, `TeamA_Id`, `TeamB_Id`, `Team_Won`, `Held_On`) VALUES
(8, 15, 16, 16, '2022-11-09'),
(9, 21, 22, 22, '2022-11-16');

--
-- Triggers `matches`
--
DELIMITER $$
CREATE TRIGGER `delete_match` AFTER DELETE ON `matches` FOR EACH ROW DELETE from team where team.Team_Id = OLD.TeamA_Id or team.Team_Id = OLD.TeamB_Id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `Player_Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Dob` date NOT NULL,
  `Role` enum('Batsmen','Bowler','Allrounder','WK-Batsmen') NOT NULL,
  `Batting_Style` enum('Right_handed','Left_handed','','') NOT NULL,
  `Bowling_Style` enum('Leftarm_fast','Rightarm_fast','Leftarm_fast_medium','Rightarm_fast_medium','Rightarm_finger_spin','Leftarm_finger_spin','Rightarm_wrist_spin','Leftarm_wrist_spin') NOT NULL,
  `State` varchar(255) NOT NULL,
  `Country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`Player_Id`, `Name`, `Dob`, `Role`, `Batting_Style`, `Bowling_Style`, `State`, `Country`) VALUES
(1, 'Rishi Yangala', '0000-00-00', 'Batsmen', '', '', 'Telangana', 'India'),
(2, 'Praneeth Reddy', '2003-03-18', 'WK-Batsmen', 'Right_handed', 'Rightarm_fast', 'Telangana', 'India'),
(8, 'Siddartha', '2002-12-11', 'Batsmen', 'Right_handed', 'Leftarm_fast', 'Telangana', 'India'),
(11, 'Virat kohli', '1988-06-26', 'Batsmen', 'Right_handed', 'Leftarm_fast', 'Delhi', 'India'),
(12, 'Ab devillers', '1977-01-01', 'Batsmen', 'Right_handed', 'Leftarm_fast', 'africa', 'south africa'),
(13, 'Glenn maxwell', '1978-07-09', 'Allrounder', 'Right_handed', 'Rightarm_finger_spin', 'Melbourne', 'Australia'),
(14, 'Faf duplesis', '1975-08-09', 'Batsmen', 'Right_handed', 'Leftarm_fast', 'africa', 'south africa'),
(15, 'Dale steyn', '1972-08-01', 'Bowler', 'Right_handed', 'Rightarm_fast', 'africa', 'south africa'),
(16, 'Chris gayle', '1977-09-08', 'Batsmen', 'Left_handed', 'Leftarm_finger_spin', 'Barbados', 'West Indies'),
(17, 'Kevin Pieterson', '1975-06-04', 'Batsmen', 'Right_handed', 'Leftarm_fast_medium', 'London', 'England'),
(18, 'Chahal', '1979-03-05', 'Bowler', 'Right_handed', 'Rightarm_wrist_spin', 'Rajastan', 'India'),
(19, 'Hasaranga', '1980-07-05', 'Allrounder', 'Right_handed', 'Rightarm_wrist_spin', 'Colombo', 'Srilanka'),
(20, 'Josh Hazlewood', '1977-02-06', 'Bowler', 'Left_handed', 'Rightarm_fast', 'Queensland', 'Australia'),
(21, 'Kl rahul', '1981-02-08', 'WK-Batsmen', 'Right_handed', 'Rightarm_finger_spin', 'Kaarnataka', 'India'),
(22, 'Shabaz Ahmed', '1985-03-06', 'Allrounder', 'Left_handed', 'Leftarm_finger_spin', 'Bengal', 'India'),
(23, 'Srinath Arvind', '1980-04-08', 'Bowler', 'Right_handed', 'Leftarm_fast_medium', 'Karnataka', 'India'),
(24, 'Shane Watson', '1970-07-31', 'Allrounder', 'Right_handed', 'Rightarm_fast_medium', 'Victoria', 'Australia'),
(25, 'Ross Taylor', '1973-05-07', 'Batsmen', 'Right_handed', 'Rightarm_wrist_spin', 'Wellington', 'Newzeland'),
(26, 'Zaheer Khan', '1969-06-07', 'Bowler', 'Left_handed', 'Leftarm_fast', 'Delhi', 'India'),
(27, 'Brendon Mccullum', '1970-05-26', 'WK-Batsmen', 'Right_handed', 'Rightarm_wrist_spin', 'Wellington', 'Newzeland'),
(28, 'Harshal patel', '1979-06-07', 'Bowler', 'Right_handed', 'Rightarm_fast_medium', 'Bihar', 'India'),
(29, 'Mohammad Siraj', '1980-06-06', 'Bowler', 'Right_handed', 'Rightarm_fast', 'Telangana', 'India'),
(30, 'Rajat Patidhar', '1982-07-05', 'Batsmen', 'Right_handed', 'Rightarm_finger_spin', 'Madya Pradesh', 'India'),
(31, 'Jacqee Kallis', '1969-07-31', 'Allrounder', 'Right_handed', 'Rightarm_fast_medium', 'India', 'India'),
(32, 'Dinesh Karthik', '1970-04-07', 'WK-Batsmen', 'Right_handed', 'Rightarm_finger_spin', 'Tamilnadu', 'India');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `Team_Id` int(11) NOT NULL,
  `Team_Name` varchar(255) NOT NULL,
  `Info_Id1` int(11) NOT NULL,
  `Info_Id2` int(11) NOT NULL,
  `Info_Id3` int(11) NOT NULL,
  `Info_Id4` int(11) NOT NULL,
  `Info_Id5` int(11) NOT NULL,
  `Info_Id6` int(11) NOT NULL,
  `Info_Id7` int(11) NOT NULL,
  `Info_Id8` int(11) NOT NULL,
  `Info_Id9` int(11) NOT NULL,
  `Info_Id10` int(11) NOT NULL,
  `Info_Id11` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`Team_Id`, `Team_Name`, `Info_Id1`, `Info_Id2`, `Info_Id3`, `Info_Id4`, `Info_Id5`, `Info_Id6`, `Info_Id7`, `Info_Id8`, `Info_Id9`, `Info_Id10`, `Info_Id11`) VALUES
(15, 'Amber_A', 7858, 7859, 7860, 7861, 7862, 7863, 7864, 7865, 7866, 7867, 7868),
(16, 'Jasper_B', 7869, 7870, 7871, 7872, 7873, 7874, 7875, 7876, 7877, 7878, 7879),
(21, 'RCB OLD', 7924, 7925, 7926, 7927, 7928, 7929, 7930, 7931, 7932, 7933, 7934),
(22, 'RCB NEW', 7935, 7936, 7937, 7938, 7939, 7940, 7941, 7942, 7943, 7944, 7945);

--
-- Triggers `team`
--
DELIMITER $$
CREATE TRIGGER `delete_team` AFTER DELETE ON `team` FOR EACH ROW delete from info where info.Info_Id = OLD.Info_Id1 or info.Info_Id = OLD.Info_Id2 or info.Info_Id = OLD.Info_Id3 or info.Info_Id = OLD.Info_Id4 or info.Info_Id = OLD.Info_Id5 or info.Info_Id = OLD.Info_Id6 or info.Info_Id = OLD.Info_Id7 or info.Info_Id = OLD.Info_Id8 or info.Info_Id = OLD.Info_Id9 or info.Info_Id = OLD.Info_Id10 or info.Info_Id = OLD.Info_Id11
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`Info_Id`),
  ADD KEY `info_ibfk_2` (`Player_Id`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`Match_Id`),
  ADD KEY `matches_ibfk_1` (`TeamA_Id`),
  ADD KEY `matches_ibfk_2` (`TeamB_Id`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`Player_Id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`Team_Id`),
  ADD KEY `team_ibfk_1` (`Info_Id1`),
  ADD KEY `team_ibfk_11` (`Info_Id10`),
  ADD KEY `team_ibfk_12` (`Info_Id11`),
  ADD KEY `team_ibfk_2` (`Info_Id2`),
  ADD KEY `team_ibfk_3` (`Info_Id3`),
  ADD KEY `team_ibfk_4` (`Info_Id4`),
  ADD KEY `team_ibfk_5` (`Info_Id5`),
  ADD KEY `team_ibfk_6` (`Info_Id6`),
  ADD KEY `team_ibfk_7` (`Info_Id7`),
  ADD KEY `team_ibfk_8` (`Info_Id8`),
  ADD KEY `team_ibfk_9` (`Info_Id9`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `Info_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7946;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `Match_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
  MODIFY `Player_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `Team_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `info`
--
ALTER TABLE `info`
  ADD CONSTRAINT `info_ibfk_2` FOREIGN KEY (`Player_Id`) REFERENCES `player` (`Player_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`TeamA_Id`) REFERENCES `team` (`Team_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`TeamB_Id`) REFERENCES `team` (`Team_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `team_ibfk_1` FOREIGN KEY (`Info_Id1`) REFERENCES `info` (`Info_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `team_ibfk_10` FOREIGN KEY (`Info_Id9`) REFERENCES `info` (`Info_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `team_ibfk_11` FOREIGN KEY (`Info_Id10`) REFERENCES `info` (`Info_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `team_ibfk_12` FOREIGN KEY (`Info_Id11`) REFERENCES `info` (`Info_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `team_ibfk_2` FOREIGN KEY (`Info_Id2`) REFERENCES `info` (`Info_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `team_ibfk_3` FOREIGN KEY (`Info_Id3`) REFERENCES `info` (`Info_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `team_ibfk_4` FOREIGN KEY (`Info_Id4`) REFERENCES `info` (`Info_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `team_ibfk_5` FOREIGN KEY (`Info_Id5`) REFERENCES `info` (`Info_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `team_ibfk_6` FOREIGN KEY (`Info_Id6`) REFERENCES `info` (`Info_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `team_ibfk_7` FOREIGN KEY (`Info_Id7`) REFERENCES `info` (`Info_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `team_ibfk_8` FOREIGN KEY (`Info_Id8`) REFERENCES `info` (`Info_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `team_ibfk_9` FOREIGN KEY (`Info_Id9`) REFERENCES `info` (`Info_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
