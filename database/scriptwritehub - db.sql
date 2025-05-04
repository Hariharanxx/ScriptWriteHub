-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2025 at 06:01 PM
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
-- Database: `scriptwritehub`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `story_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `story_id`, `user_id`, `comment`, `created_at`) VALUES
(1, 13, 10, 'super', '2025-04-05 14:37:26'),
(2, 17, 10, 'super', '2025-04-05 14:44:42'),
(3, 14, 10, 'sema', '2025-04-05 14:54:34'),
(4, 17, 10, 'bunda movie', '2025-04-05 14:57:16'),
(7, 13, 13, 'majaa story', '2025-04-06 04:11:11'),
(8, 26, 13, 'majaaa story', '2025-04-06 04:30:06'),
(9, 26, 10, 'dhetfew6wu', '2025-04-06 07:18:31'),
(10, 26, 10, 'iun8yiu', '2025-04-14 08:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `timestamp`, `is_read`) VALUES
(2, 15, 10, 'hi', '2025-04-11 18:42:27', 0),
(3, 10, 15, 'hello', '2025-04-11 18:51:15', 0),
(4, 10, 15, 'who are u', '2025-04-11 19:18:54', 0),
(6, 15, 10, 'iam user', '2025-04-12 12:19:36', 0),
(7, 15, 10, 'iam also user', '2025-04-12 13:02:18', 0),
(8, 15, 10, 'hey', '2025-04-12 13:05:34', 0),
(9, 15, 10, 'yuf', '2025-04-12 17:02:05', 0),
(10, 15, 10, 'yuf', '2025-04-12 17:02:05', 0),
(11, 15, 10, 'hey', '2025-04-12 17:02:31', 0),
(12, 15, 10, 'hi bro', '2025-04-12 17:02:53', 0),
(13, 15, 10, 'hi bro', '2025-04-12 17:05:48', 0),
(15, 15, 10, 'hello', '2025-04-12 17:51:23', 0),
(16, 15, 10, 'hello', '2025-04-12 17:51:25', 0),
(17, 15, 10, 'hey', '2025-04-12 17:51:41', 0),
(18, 15, 10, 'hello', '2025-04-12 18:03:51', 0),
(19, 15, 10, 'hey', '2025-04-12 18:04:00', 0),
(21, 15, 10, 'hi', '2025-04-12 18:59:03', 0),
(23, 10, 15, 'hey who aru', '2025-04-12 19:09:56', 0),
(24, 10, 15, 'hey', '2025-04-12 19:13:07', 0),
(25, 10, 15, 'hi', '2025-04-12 19:15:26', 0),
(26, 15, 10, 'am user', '2025-04-12 19:21:16', 0),
(27, 15, 10, 'hey', '2025-04-12 19:24:36', 0),
(28, 15, 10, 'hi', '2025-04-12 19:34:50', 0),
(29, 15, 10, 'hi', '2025-04-12 19:37:55', 0),
(30, 15, 10, 'hi', '2025-04-12 19:52:32', 0),
(33, 15, 10, 'gfgf', '2025-04-12 20:00:23', 0),
(35, 15, 10, 'jp', '2025-04-12 20:01:11', 0),
(36, 10, 15, 'hello', '2025-04-14 13:06:02', 0),
(37, 10, 15, 'hello', '2025-04-14 13:11:02', 0),
(38, 10, 15, 'he', '2025-04-14 13:12:42', 0),
(39, 10, 15, 'jh', '2025-04-14 13:25:15', 0),
(40, 10, 15, 'iiouh', '2025-04-14 13:34:35', 0),
(41, 10, 15, 'ihi', '2025-04-14 13:38:04', 0),
(42, 10, 15, 'hi', '2025-04-14 13:54:35', 0),
(43, 10, 15, 'l;mnk', '2025-04-14 13:55:51', 0),
(44, 10, 15, 'htjt', '2025-04-14 14:01:16', 0),
(45, 10, 15, 'fdbgnf', '2025-04-14 14:10:32', 0),
(46, 15, 10, 'hello', '2025-04-20 09:00:12', 0),
(47, 10, 15, 'hi', '2025-04-24 23:45:47', 0),
(50, 10, 7, 'hi', '2025-05-04 21:30:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` text DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `genre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `user_id`, `title`, `short_description`, `content`, `created_at`, `genre`) VALUES
(13, 7, 'Kaadhal Sadugudu', 'This story is about \"the LOVE(real)\"', 'Alaye sitralayee....', '2025-03-09 08:46:33', 'Commercial'),
(14, 1, 'Mankatha', 'The Evil dance', 'Vilayadu mankathaa...', '2025-03-09 08:52:33', 'Commercial'),
(17, 7, 'Varisu', 'Another bunda movie', '<h1>                               Varisu</h1><p>  </p><p> The elite pulithes family problm which didn connect to auiduence</p>', '2025-03-09 11:47:40', 'Commercial'),
(26, 13, 'JAVA', 'About java', '<p>Good question! You only need to compile Main.java because it contains the main method, which is the entry point of the program. Here\'s why:</p><h3>1. <strong>Java Compilation Process</strong></h3><p>When you run javac Main.java, the compiler looks at all the classes used inside Main.java.</p><p>Since Main.java is using Animal, Dog, Cat, and Lion classes, the compiler automatically compiles those files too (if they are in the same directory and not precompiled).</p><p>This is why you don’t need to explicitly compile Animal.java separately.</p><h3>2. <strong>Why Not Compile Animal.java First?</strong></h3><p>If Animal.java is compiled separately, it will generate Animal.class, but that alone is not enough.</p><p>Main.java depends on Animal.java, so even if Animal.class exists, you still need to compile Main.java to link everything together.</p><h3>3. <strong>Executing the Program</strong></h3><p>After compilation, you run the program using java Main, because Main contains the main method, which is where execution starts.</p><h3><strong>When Do You Need to Compile Other Files Separately?</strong></h3><p>If the classes are in different packages, you need to compile them separately or use javac -d . Main.java Animal.java to specify the output directory.</p><p>If Animal.java was modified but Main.java was not changed, you might want to recompile only Animal.java.</p><p>In short, compiling Main.java is enough because it triggers the compilation of all referenced classes automatically.</p>', '2025-04-06 04:14:30', 'Aritistic'),
(27, 10, 'GOOD BAD UGLY', 'Actor Ajithkumar\'s Arc', '<h1><strong>Ajith: The Good, The Bad, and The Ugly</strong></h1><p><br></p><p>In the heart of Chennai, amidst the chaos of speeding bikes and roaring ambition, lived <strong>Ajith Kumar</strong>, a man with a face as calm as the morning sea but a mind sharper than a blade. To the world, Ajith was three things — <strong>The Good</strong>, <strong>The Bad</strong>, and <strong>The Ugly</strong> — all wrapped into one legend.</p><p><br></p><p><strong>The Good:</strong></p><p><br></p><p> Ajith was the man you called when you needed hope. In his neighborhood, where kids dreamed small because life taught them to, Ajith taught them to dream big. He started a free evening school for mechanics, racers, and artists.</p><p> Every Sunday, he repaired broken bikes of students who couldn’t afford maintenance, smiling, “Speed is nothing without control.”</p><p> People respected him because he never wore his goodness like a medal; it dripped naturally from his actions. To the old woman selling jasmine by the roadside, Ajith was not a superstar — he was the boy who bought flowers every morning just to make her smile.</p><p><br></p><p><strong>The Bad:</strong></p><p> But Chennai wasn’t just dreams and jasmine. It had shadows — and sometimes, Ajith became one.</p><p> When the corrupt local politician tried to snatch away the market land to build malls, Ajith didn’t file complaints. He <strong>acted</strong>.</p><p> He gathered the vendors, taught them how to resist legally and financially. And when dirty tricks didn’t stop, Ajith turned darker — he sabotaged the politician’s secret deals, leaked their scams to the media, and made sure justice wasn’t served cold — it was served <strong>burning hot</strong>.</p><p> Some said he became dangerous. Some called him a \"rowdy in a hero’s costume.\" Ajith didn’t care. He wasn’t interested in medals; he was interested in <strong>doing what was right</strong>, even if it meant getting his hands dirty.</p><p><br></p><p><strong>The Ugly:</strong></p><p><br></p><p> But life has a way of throwing ugly truths at you when you least expect it.</p><p> Ajith’s closest friend, <strong>Raghu</strong>, the one who rode with him on every mission, betrayed him. Sold out to the very politicians Ajith fought. For money.</p><p> When Ajith found out, it wasn\'t a grand showdown. It was silent. Like the moment before a thunderstorm.</p><p> He stood under the pouring rain, staring at Raghu, who couldn’t even meet his eyes.</p><p> Ajith said just one thing: “When trust breaks, the heart doesn’t shatter like glass. It rots like a wound.”</p><p> He walked away — wounded, but refusing to become bitter.</p><p> From that day, Ajith stopped trusting easily. His smile became rarer. His kindness became sharper. His missions became lonelier.</p><p><br></p><p><strong>In the End:</strong></p><p><br></p><p> Ajith wasn’t a flawless hero.</p><p> He wasn’t a villain either.</p><p> He was something more powerful: a real human being.</p><p> Good when it mattered.</p><p> Bad when it was necessary.</p><p> And Ugly when life demanded him to fight battles nobody else dared to.</p><p>Some people worshiped him.</p><p> Some people feared him.</p><p> But no one, not even his enemies, could ignore him.</p><p> Because Ajith was not just a man.</p><p>He was a <strong>storm</strong> — and you could either run from it or learn to dance in the rain.</p><p><br></p>', '2025-04-27 08:55:12', 'Commercial');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `bio`, `profile_picture`) VALUES
(1, 'hariharanp__', 'hariharanperumal@gmail.com', '$2y$10$y4lixUvzUjwkGUG7MWpaluWwGDGrgiHyPt00YeBsj8jn2PBaqu70O', NULL, NULL),
(7, 'Hari', 'hari@gmail.com', '$2y$10$yRj2Ja38T9BNy/NjyVC0feA8Pk7btBeepXMY8Ennr6zC3gi73LPuO', NULL, NULL),
(8, 'amutha', 'amutha@gmail.com', '$2y$10$eUk04L5YdGU0QQJATl8G8uWEGPbVLw0BjPLWvFszoeyaoAXYwGmW.', NULL, NULL),
(9, 'Hariharan', 'hariharanperumal03@gmail.com', '$2y$10$TI0hCXHiJ6scdDbJjld7EuCzO6xGrTONiWxwhe6Gxzmvmmdf1aUtO', NULL, NULL),
(10, 'perumal', 'perumal@gmail.com', '$2y$10$GhHRBHJBW0f7hvFiZsMcAu4r.FXkV6rm7lj7aVaslM/X.Kf0mQ2TO', NULL, NULL),
(12, 'perumal01', 'peruma01l@gmail.com', '$2y$10$XyzDvE843dHmH4tF8jHtpeAvmmpdplDBubZySlvS9NBEEKsqQuh5e', NULL, NULL),
(13, 'hari', 'hariharan@gmail.com', '$2y$10$wT9SSqw1jugs6ohltEm5rOhVoxHKd1sBC5KjFkmxyJ9s8Pkf8Xyq2', 'A film maker who wants create high dose entertainment cinema', '1743948755_unnamed.jpg'),
(14, 'Hariharan ', 'hariharan2@gmail.com', '$2y$10$RoQtg3AycXjzWw3TkXuMCe4.qN380IWO38JsT.BD6f4CNHMzLSAGC', NULL, NULL),
(15, 'user1', 'user1@gmail.com', '$2y$10$EQiEFAIZqCnARQO3K1nLAum.Rh40ABxh7C5ILjtvVi2grDkJI7aOC', 'hey iam here', '1745722666_ferriswheel2.jpg'),
(16, 'hari00', 'hari00@gmail.com', '$2y$10$2CVQ2KUOvrSXLgtv8H8RKecdGNS1HdRc19ixpsYhkYNgii2V6416u', NULL, NULL),
(17, 'HARIHARAN ', 'hari0@gmail.com', '$2y$10$0WZ../72EzM6f.htEGQ55.Dqp4thzE5tmx97cDxCXbGmtC34VUXW2', 'Aspiring Film maker', '1745745337_unnamed (1).jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `story_id` (`story_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `stories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
