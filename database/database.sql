-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2025 at 04:16 PM
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
(5, 19, 10, 'bad', '2025-04-05 15:20:36'),
(7, 13, 13, 'majaa story', '2025-04-06 04:11:11'),
(8, 26, 13, 'majaaa story', '2025-04-06 04:30:06'),
(9, 26, 10, 'dhetfew6wu', '2025-04-06 07:18:31');

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
(15, 6, 'Beast', 'Bunda movie', 'meaner, leaner ,stronger', '2025-03-09 08:54:06', 'Commercial'),
(17, 7, 'Varisu', 'Another bunda movie', '<h1>                               Varisu</h1><p>  </p><p> The elite pulithes family problm which didn connect to auiduence</p>', '2025-03-09 11:47:40', 'Commercial'),
(19, 10, 'hcdkjc', 'jhadf', '<p>jshaklsdgfk</p>', '2025-04-05 15:20:14', 'Experimental'),
(26, 13, 'JAVA', 'About java', '<p>Good question! You only need to compile Main.java because it contains the main method, which is the entry point of the program. Here\'s why:</p><h3>1. <strong>Java Compilation Process</strong></h3><p>When you run javac Main.java, the compiler looks at all the classes used inside Main.java.</p><p>Since Main.java is using Animal, Dog, Cat, and Lion classes, the compiler automatically compiles those files too (if they are in the same directory and not precompiled).</p><p>This is why you don’t need to explicitly compile Animal.java separately.</p><h3>2. <strong>Why Not Compile Animal.java First?</strong></h3><p>If Animal.java is compiled separately, it will generate Animal.class, but that alone is not enough.</p><p>Main.java depends on Animal.java, so even if Animal.class exists, you still need to compile Main.java to link everything together.</p><h3>3. <strong>Executing the Program</strong></h3><p>After compilation, you run the program using java Main, because Main contains the main method, which is where execution starts.</p><h3><strong>When Do You Need to Compile Other Files Separately?</strong></h3><p>If the classes are in different packages, you need to compile them separately or use javac -d . Main.java Animal.java to specify the output directory.</p><p>If Animal.java was modified but Main.java was not changed, you might want to recompile only Animal.java.</p><p>In short, compiling Main.java is enough because it triggers the compilation of all referenced classes automatically.</p>', '2025-04-06 04:14:30', 'Aritistic');

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
(6, 'viji', 'hariharanperumal02@gmail.com', '$2y$10$917ta7w9fgi.6trMZKesqOYp/I4kMxuAKr.yzzpaDPPn766zA4luO', NULL, NULL),
(7, 'Hari', 'hari@gmail.com', '$2y$10$yRj2Ja38T9BNy/NjyVC0feA8Pk7btBeepXMY8Ennr6zC3gi73LPuO', NULL, NULL),
(8, 'amutha', 'amutha@gmail.com', '$2y$10$eUk04L5YdGU0QQJATl8G8uWEGPbVLw0BjPLWvFszoeyaoAXYwGmW.', NULL, NULL),
(9, 'Hariharan', 'hariharanperumal03@gmail.com', '$2y$10$TI0hCXHiJ6scdDbJjld7EuCzO6xGrTONiWxwhe6Gxzmvmmdf1aUtO', NULL, NULL),
(10, 'perumal', 'perumal@gmail.com', '$2y$10$GhHRBHJBW0f7hvFiZsMcAu4r.FXkV6rm7lj7aVaslM/X.Kf0mQ2TO', NULL, NULL),
(12, 'perumal01', 'peruma01l@gmail.com', '$2y$10$XyzDvE843dHmH4tF8jHtpeAvmmpdplDBubZySlvS9NBEEKsqQuh5e', NULL, NULL),
(13, 'hari', 'hariharan@gmail.com', '$2y$10$wT9SSqw1jugs6ohltEm5rOhVoxHKd1sBC5KjFkmxyJ9s8Pkf8Xyq2', 'A film maker who wants create high dose entertainment cinema', '1743948755_unnamed.jpg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
