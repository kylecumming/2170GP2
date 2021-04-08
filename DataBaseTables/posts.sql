-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: db.cs.dal.ca
-- Generation Time: Apr 08, 2021 at 05:49 PM
-- Server version: 10.3.21-MariaDB
-- PHP Version: 7.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cumming`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post` varchar(240) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post`, `post_date`, `user_id`, `username`) VALUES
(1, 'Augue. Ornare at ad tempor augue. Magnis torquent purus ad Quisque ad accumsan. Adipiscing Inceptos. Suspendisse auctor. Aptent, nibh eleifend, praesent habitasse platea viverra cursus arcu dictumst turpis erat. Sit.', '2021-04-08 14:19:43', 1, 'Scott_Myrden'),
(2, 'Habitasse tempus libero magna accumsan Nam dictum tincidunt viverra ad. Cras pede tempor proin sit nisi. Cras rutrum proin vulputate nisl enim mollis. Potenti facilisi etiam. Vitae vehicula vulputate hac.', '2021-04-08 14:20:13', 2, 'Eric_Dowell'),
(3, 'Dictumst in eleifend iaculis orci commodo malesuada orci tristique auctor nonummy aenean, sapien dis nisi mauris urna blandit dolor augue aliquet, placerat sed nulla felis cras nibh risus eros malesuada.', '2021-04-08 14:20:33', 3, 'Keaton_Gibb'),
(4, 'Quam orci dui feugiat dictumst sociis mollis etiam duis urna risus sodales habitant dapibus torquent dictumst. Mattis quis sociosqu Lorem a vel. Egestas metus nulla in commodo. Malesuada sit ultrices.', '2021-04-08 14:21:01', 4, 'Sahil_Sorathiya'),
(5, 'Sapien nonummy. Purus cras phasellus cubilia facilisi malesuada, vel torquent lectus velit. Laoreet. Mus velit at magna tempor nisl. Convallis dictum libero per viverra elementum duis Nam cubilia. Elit magnis.', '2021-04-08 14:21:22', 5, 'Kyle_Cumming'),
(6, 'Elementum ridiculus. Tincidunt. Etiam quis eu hac quisque. Ut aliquet nascetur penatibus. Semper adipiscing proin laoreet pharetra Gravida sodales non quisque sem. In suspendisse rhoncus netus iaculis nullam gravida facilisi.', '2021-04-08 14:21:42', 6, 'Jake_Coyne'),
(7, 'Erat consequat ridiculus. Suspendisse Ac donec. Proin donec tincidunt lacinia vitae mollis aliquam viverra dolor imperdiet. Tincidunt lorem a porta fames orci suscipit gravida justo blandit venenatis phasellus sodales phasellus.', '2021-04-08 14:22:00', 7, 'Ben_Lee'),
(8, 'Placerat class sociis montes euismod iaculis sagittis congue a gravida ligula inceptos pede Diam fermentum. Tellus litora vulputate natoque. Sagittis velit eget fusce sollicitudin netus Suspendisse. Bibendum dictumst dolor fusce.', '2021-04-08 14:22:45', 1, 'Scott_Myrden'),
(9, 'Nibh elit risus. Natoque lacus Mus senectus turpis mauris. Etiam maecenas sollicitudin tortor lacinia fames praesent nullam hendrerit phasellus convallis facilisis taciti risus eros molestie erat morbi dis dapibus. Torquent.', '2021-04-08 14:23:06', 2, 'Eric_Dowell'),
(10, 'Tristique ultricies Rhoncus lacinia aliquam nascetur nonummy adipiscing metus sed euismod. Tristique Curabitur hac. Natoque pulvinar suspendisse penatibus luctus, dictumst Imperdiet. Porttitor blandit. Eros sapien.', '2021-04-08 14:23:52', 3, 'Keaton_Gibb'),
(11, 'Mus venenatis. Dictum nostra taciti sollicitudin sociis vehicula lobortis fermentum urna nonummy nullam felis at luctus. Habitant lectus curabitur aptent class donec hymenaeos conubia ut amet velit luctus ac purus.', '2021-04-08 14:24:13', 4, 'Sahil_Sorathiya'),
(12, 'Neque ridiculus nascetur interdum. Diam aptent inceptos habitasse, eu nisl. Conubia convallis cum facilisis fusce class. Porta ac sem molestie elementum varius in vulputate sit risus torquent nisi risus class.', '2021-04-08 14:24:40', 5, 'Kyle_Cumming'),
(13, 'Tortor sit in. Tristique pellentesque porttitor. Rhoncus a sollicitudin est consequat mollis, consectetuer phasellus. Netus purus magna adipiscing habitasse. Mattis semper primis duis quam sociis fames diam congue nam nec.', '2021-04-08 14:24:58', 6, 'Jake_Coyne'),
(14, 'Netus nulla lorem morbi morbi proin ridiculus ullamcorper ultrices. Cum augue sapien ridiculus sociosqu phasellus pede euismod litora phasellus phasellus. Natoque, inceptos phasellus laoreet quis nunc natoque. Curae;, purus, pretium.', '2021-04-08 14:25:15', 7, 'Ben_Lee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id_author_fk` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `user_id_author_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
