-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2024 at 10:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koob_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentID` int(100) NOT NULL,
  `userID` int(100) NOT NULL,
  `postID` int(100) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentID`, `userID`, `postID`, `content`, `date`) VALUES
(8, 8, 12, 'Hi there.', '2024-02-24 21:32:26'),
(11, 8, 22, 'This is now the next challenge.', '2024-03-01 21:02:25'),
(12, 8, 22, 'It is looking better at least...', '2024-03-01 21:16:31'),
(13, 8, 22, 'OKAY', '2024-03-01 21:16:54'),
(14, 8, 28, 'Hahahaha nice', '2024-03-02 02:13:09'),
(15, 9, 22, 'Wow.', '2024-03-02 05:06:52'),
(20, 12, 22, 'I don\'t know guys...', '2024-03-02 23:15:37'),
(21, 12, 22, 'I think this is getting out of hand.', '2024-03-02 23:15:52'),
(27, 12, 48, 'Turns out it is.', '2024-03-02 23:58:08'),
(30, 2, 33, 'Yo', '2024-03-03 00:10:44'),
(31, 2, 19, 'Okay', '2024-03-03 00:14:49'),
(41, 2, 52, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2024-03-06 18:40:20'),
(44, 18, 52, 'I don\'t think its cool at all! I think the blue was better than the white background....', '2024-03-06 21:38:27'),
(45, 18, 28, 'I agree', '2024-03-06 21:39:13'),
(46, 18, 13, 'Clearly the only way to eat pancakes ', '2024-03-06 21:42:01'),
(47, 18, 15, 'French toast, hands down!', '2024-03-06 21:42:58'),
(48, 3, 22, 'Wow...', '2024-03-06 21:46:37');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `postID` int(100) NOT NULL,
  `userID` int(100) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`postID`, `userID`, `content`, `date`) VALUES
(4, 9, 'Maybe.', '2024-02-21 01:54:50'),
(5, 8, 'Is that really the case?', '2024-02-21 20:05:15'),
(6, 8, 'Hopefully so....', '2024-02-21 20:26:26'),
(12, 8, 'hello.', '2024-02-24 21:31:54'),
(13, 2, 'Blueberries on pancakes. What does everyone think?asdf', '2024-02-25 02:04:12'),
(14, 2, 'Disregard my last post. I meant to say waffles.', '2024-02-25 02:04:34'),
(15, 2, 'Even though EVERYONE clearly prefers waffles. Comment on my post if you prefer pancakes or French toast?', '2024-02-25 02:05:10'),
(16, 2, 'I SWEAR I will not get mad if anyone prefers something other than waffles.', '2024-02-25 02:05:36'),
(19, 9, 'I am back in the conversation.', '2024-02-28 22:03:56'),
(20, 9, 'Volleyball is a great sport!', '2024-02-28 23:14:33'),
(21, 9, 'Disc golf is also fun. I just lost my favorite disc though. :(', '2024-02-28 23:15:30'),
(22, 8, 'Time to get the comments working effectively.', '2024-03-01 02:29:58'),
(25, 0, '22', '2024-03-01 20:53:38'),
(26, 0, '22', '2024-03-01 20:53:38'),
(27, 0, '22', '2024-03-01 20:53:39'),
(28, 8, 'suss', '2024-03-02 02:10:33'),
(33, 11, 'hey', '2024-03-02 05:33:01'),
(48, 12, 'Hello', '2024-03-02 23:50:20'),
(49, 13, 'How about that.', '2024-03-04 20:12:20'),
(52, 15, 'That is very cool. Nice!', '2024-03-05 21:33:13'),
(57, 18, 'I\'m here now so I can set the record straight....Carrot cake is the best breakfast food and no one can tell me otherwise, LOSERS! ', '2024-03-06 21:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(100) NOT NULL,
  `fName` varchar(50) NOT NULL,
  `lName` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `bio` varchar(1000) DEFAULT NULL,
  `profile_img` varchar(100) NOT NULL DEFAULT 'default.png',
  `cover_img` varchar(100) NOT NULL DEFAULT 'default.jpg',
  `type` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `fName`, `lName`, `username`, `password`, `email`, `bio`, `profile_img`, `cover_img`, `type`) VALUES
(2, 'Andrew', 'Vincent', 'Waffle', 'classclass', 'Andrew@example.com', 'I love waffles. Waffles love me. Syrup, blueberries, strawberries, and some butter. That\'s how I like my waffles.', '65e8abe4a64ac8.51992938.jpg', '65e8ab499cde01.69464215.jpg', 'user'),
(3, 'Jeff', 'Penny', 'Programmer123', '111222333', 'Jeff@example.com', 'Good stuff', '65e8d0de6616a8.99658863.jpg', '65e8d0d908b234.78936937.jpg', 'admin'),
(8, 'Justin', 'Vincent', 'Pancake', 'classclass', 'Apple@gmail.com', 'Pancakes... Just... Pancakes. I guess. That\'s cool though. hahaha', '65df9be2051ad6.12183487.jpg', '65e27d54992f29.40115483.jpg', 'user'),
(9, 'Josh', 'Vincent', 'Frenchtoast', 'classclass', 'Josh@gmail.com', 'Guess who.', '65df9c40224e28.50535766.jpg', '65e2a56db08448.12594465.jpg', 'user'),
(10, 'Justin', 'Vincent', 'Exotic', 'jmdvbc02', 'Superchimptv54@gmail.com', 'No', 'default.png', 'default.jpg', 'user'),
(11, 'Bob', 'Bobby', 'Bobster', 'classclass', 'Bob@gmail.com', NULL, 'default.png', 'default.jpg', 'user'),
(12, 'John', 'Smith', 'Eggs', 'Class', 'John@gmail.com', 'My name is Eggs...Or is it John?', 'default.png', '65e3a23101c782.96727644.jpg', 'user'),
(13, 'Bob', 'Griffin', 'Bookbobby', 'classclass', 'Bob@example.com', NULL, 'default.png', 'default.jpg', 'user'),
(14, 'Andrew', 'Vincent', 'Waffles', 'classclass', 'Iron.824@gmail.com', NULL, 'default.png', 'default.jpg', 'user'),
(15, 'Chimp', 'Tv', 'Monkey', 'classydog', 'Apples@gmail.com', 'I like monkeys!', '65e8d0b0c35c29.52637569.jpg', '65e8d0b77f0915.23768962.jpg', 'user'),
(16, 'Bob', 'Dylan', 'Dylan', 'classclass', 'Dylan@gmail.com', NULL, 'default.png', '65e78ffb06d3f3.60337394.jpg', 'user'),
(17, 'Jenny', 'Savin', 'Jennytheguide', 'jajjajjaJ3', 'Jeannine.savin@gmail.com', 'OKAY COOL', 'default.png', '65e7ed7b94e965.26221821.jpg', 'user'),
(18, 'Jessica', 'Rabbit', 'Carrotcake', 'bugsbunnyishot!', 'Jessicarabbit@gamil.com', 'Hey! I\'m a sexy redhead that speaks her mind! ', '65e8d3ef1a8884.50601123.jpg', '65e8d3e4b54995.64604275.jpg', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `postID` (`postID`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `postID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_key_postID` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
