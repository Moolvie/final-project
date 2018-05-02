-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2018 at 09:39 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `songs`
CREATE SCHEMA IF NOT EXISTS Songs;
USE Songs;
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `AlbumID` int(11) NOT NULL,
  `ArtistID` int(11) NOT NULL,
  `AlbumTitle` varchar(255) NOT NULL,
  `AlbumGenre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`AlbumID`, `ArtistID`, `AlbumTitle`, `AlbumGenre`) VALUES
(2, 2, 'Jazz for the Dead', 'jazz'),
(3, 3, 'Night Ward ', 'jazz'),
(4, 4, 'COLORES OF LIFE', 'jazz'),
(5, 5, 'Live in Brussels', 'jazz'),
(6, 7, 'April 2018', 'hip-hop'),
(8, 8, 'Cipher /e Dreams', 'pop'),
(9, 9, 'You Know Where to Find Me', 'rock'),
(10, 10, '4bstr4ck3r', 'electronic'),
(11, 11, 'Aim', 'electronic');

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `ArtistID` int(11) NOT NULL,
  `ArtistName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`ArtistID`, `ArtistName`) VALUES
(10, '4bstr4ck3r'),
(3, 'Ask Again'),
(2, 'Dee-Yan-Key'),
(6, 'Ema Grace'),
(5, 'Enfanciso'),
(4, 'Lobo Loco'),
(11, 'Nctrnm'),
(9, 'Soft and Furious'),
(8, 'Westy Reflector'),
(7, 'Yung Kartz');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `FirstName` varchar(20) DEFAULT NULL,
  `LastName` varchar(20) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `StreetAddress` varchar(50) DEFAULT NULL,
  `City` varchar(10) DEFAULT NULL,
  `State` varchar(2) DEFAULT NULL,
  `Zipcode` int(5) DEFAULT NULL,
  `Password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `FirstName`, `LastName`, `Email`, `StreetAddress`, `City`, `State`, `Zipcode`, `Password`) VALUES
(3, 'Najee', 'Minter', 'nminter520@yahoo.com', '3802 Washington blvd', 'University', 'OH', 44118, 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `playlistID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `playlistName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `playlist_songs`
--

CREATE TABLE `playlist_songs` (
  `PlaylistID` int(11) NOT NULL,
  `SongID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `SongID` int(11) NOT NULL,
  `ArtistID` int(11) NOT NULL,
  `AlbumID` int(11) DEFAULT NULL,
  `SongTitle` varchar(50) NOT NULL,
  `SongGenre` varchar(50) DEFAULT NULL,
  `SongLength` time NOT NULL,
  `SongYear` year(4) NOT NULL,
  `SongFile` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`SongID`, `ArtistID`, `AlbumID`, `SongTitle`, `SongGenre`, `SongLength`, `SongYear`, `SongFile`) VALUES
(9, 2, 2, 'The day of wrath', 'jazz', '00:04:24', 2018, 'Dee_Yan-Key_-_01_-_Grant_them_eternal_rest.mp3'),
(10, 3, 3, 'Throwing a Tantrum', 'jazz', '00:02:24', 2018, 'Ask_Again_-_Throwing_a_Tantrum.mp3'),
(11, 4, 4, 'Pueblo Village Party', 'jazz', '00:02:10', 2018, 'Lobo_Loco_-_Pueblo_Village_Party_ID_863.mp3'),
(12, 4, 4, 'Night Emotions', 'blues', '00:14:58', 2018, 'Lobo_Loco_-_15_-_Night_Emotions_ID_878.mp3'),
(13, 5, 5, 'Morceau 8', 'jazz', '00:10:40', 2018, 'Enfanciso_-_08_-_Morceau_8.mp3'),
(14, 5, 5, 'Morceau 6', 'jazz', '00:08:57', 2018, 'Enfanciso_-_06_-_Morceau_6.mp3'),
(15, 5, 5, 'Morceau 7', 'jazz', '00:07:08', 2018, 'Enfanciso_-_07_-_Morceau_7.mp3'),
(16, 4, 4, 'Beautiful Danca', 'blues', '00:01:13', 2018, 'Lobo_Loco_-_14_-_Beautiful_Danca_ID_893.mp3'),
(17, 6, 0, 'Justice Little League', 'hip-hop', '00:03:26', 2018, 'Justice_Little_League.mp3'),
(18, 6, 0, 'STAND BY ME', 'hip-hop', '00:04:30', 2018, 'Ema_Grace_-_STAND_BY_ME.mp3'),
(19, 7, 6, 'King', 'hip-hop', '00:02:58', 2018, 'Yung_Kartz_-_26_-_King.mp3'),
(20, 7, 6, 'So Gone', 'hip-hop', '00:02:48', 2018, 'Yung_Kartz_-_27_-_So_Gone.mp3'),
(21, 8, 8, 'The Other Side of the End', 'pop', '00:03:35', 2018, 'Westy_Reflector_-_10_-_the_other_side_of_the_end.mp3'),
(22, 8, 8, 'The Young Unicorns', 'pop', '00:02:17', 2018, 'Westy_Reflector_-_09_-_the_young_unicorns_disquiet0196.mp3'),
(24, 9, 9, 'Murkey Sweet Sweet Style', 'Soul-RnB', '00:04:47', 2018, 'Soft_and_Furious_-_08_-_Murky_sweet_sweet_style.mp3'),
(25, 9, 9, 'And Never Come Back', 'Soul-RnB', '00:04:03', 2018, 'Soft_and_Furious_-_06_-_And_never_come_back.mp3'),
(26, 10, 10, 'World Wide Walk (feat. Daman)', 'electronic', '00:04:31', 2018, '4bstr4ck3r_-_07_-_World_wide_walk_feat_Daman.mp3'),
(27, 11, 11, 'Aim', 'electronic', '00:03:10', 2018, 'Nctrnm_-_Aim.mp3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`AlbumID`),
  ADD UNIQUE KEY `AlbumTitle` (`AlbumTitle`),
  ADD KEY `ArtistID` (`ArtistID`);

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`ArtistID`),
  ADD UNIQUE KEY `ArtistName` (`ArtistName`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`playlistID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `playlist_songs`
--
ALTER TABLE `playlist_songs`
  ADD PRIMARY KEY (`PlaylistID`,`SongID`),
  ADD KEY `SongID` (`SongID`);

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`SongID`),
  ADD KEY `ArtistID` (`ArtistID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `AlbumID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `ArtistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `playlistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `SongID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`ArtistID`) REFERENCES `artist` (`ArtistID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `playlist_songs`
--
ALTER TABLE `playlist_songs`
  ADD CONSTRAINT `playlist_songs_ibfk_1` FOREIGN KEY (`PlaylistID`) REFERENCES `playlist` (`playlistID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `playlist_songs_ibfk_2` FOREIGN KEY (`SongID`) REFERENCES `song` (`SongID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `song_ibfk_1` FOREIGN KEY (`ArtistID`) REFERENCES `artist` (`ArtistID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
