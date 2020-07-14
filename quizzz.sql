-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2020 at 02:35 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quizzz`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `subject_id`, `name`, `teacher_id`) VALUES
(2, NULL, '3A', 3),
(6, NULL, '3B', 5),
(7, NULL, ' 3C', 5),
(8, NULL, ' 4A', 3),
(9, NULL, ' 1A', 7);

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `name`) VALUES
(1, 'Dễ'),
(2, 'Trung Bình'),
(3, 'Khó');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `unit` int(2) NOT NULL,
  `level_id` int(11) NOT NULL,
  `question_content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `answer_a` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `answer_b` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `answer_c` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `answer_d` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `correct_answer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL DEFAULT 1,
  `created_by` varchar(255) DEFAULT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`unit`, `level_id`, `question_content`, `answer_a`, `answer_b`, `answer_c`, `answer_d`, `correct_answer`, `id`, `subject_id`, `created_by`, `status_id`) VALUES
(1, 1, 'Thực hiện phép tính 1 + 1 = ?', '1', '11', '2', '4', '2', 1, 6, 'admin', 1),
(1, 1, 'Thực hiện phép tính 5 - 4 = ?', '54', '9', '3', '1', '1', 2, 6, 'admin', 1),
(1, 2, 'Từ Bắc vào Nam phần đất liền nước ta dài', '3300km', '2370km', '1810km', '1650km', '1650km', 3, 18, 'admin', 1),
(1, 3, 'Nước có diện tích nhỏ hơn nước ta là', 'Trung Quốc', 'Nhật bản', 'Lào - Campuchia', 'Lào', 'Lào - Campuchia\r\n', 4, 18, 'admin', 1),
(2, 2, '10 – 9 + 8 – 7 + 6 – 5 + 4 – 3 + 2 – 1 = ?', '5', '4', '2', '3', '5', 5, 1, 'admin', 1),
(3, 2, 'Số có hai chữ số mà tổng hai chữ số của nó bằng số lớn nhất có một chữ số.', '09', '36', '10', '28', '36', 6, 1, 'admin', 1),
(3, 2, 'Cho x + x + 8 = 24, Tính x = ?', '16', '8', '4', '2', '8', 7, 1, 'admin', 1),
(2, 2, 'Chọn số thích hợp để điền vào chỗ trống: 7 + 5 > ... + 6', '7', '6', '5', '10', '5', 9, 6, 'admin', 1),
(1, 1, 'Cho x * 2 = 2, Tính x = ?', '1', '0', '2', '4', '1', 10, 1, 'admin', 1),
(1, 2, 'Cho x * 8 = 0, Tính x = ?', '3', '2', '1', '0', '0', 11, 1, 'admin', 1),
(1, 3, 'Tính (3 + 2) * 2 = ?', '8', '8', '10', '7', '10', 12, 1, 'admin', 1),
(1, 1, 'Số thích hợp điền vào chỗ chấm để đúng thứ tự là: 88, ..........., .............., 91 là:', '89, 90', '86, 87', '87, 91', '92, 93', '89, 90', 13, 1, 'admin', 1),
(1, 1, 'Số 71 đọc là', 'Bảy một', 'Một bảy', 'Mười bảy', 'Bảy mươi mốt', 'Bảy mươi mốt', 14, 1, 'admin', 1),
(1, 1, 'Số liền trước của 45:', '44', '46', '54', '3', '44', 15, 1, 'admin', 1),
(1, 2, 'Số liền sau của 38 là', '37', '27', '49', '39', '39', 16, 1, 'admin', 1),
(1, 2, 'Số thích hợp điền vào chỗ chấm: 2dm = ....... cm là:', '2', '20', '200', '2000', '20', 17, 1, 'admin', 1),
(1, 2, 'Số thích hợp để điền vào chỗ chấm của phép tính: 65 = 60 + ...', '4', '3', '5', '1', '5', 18, 1, 'admin', 1),
(1, 3, 'Quả dưa cân nặng 4kg, quả bí cân nặng 5kg. Ta nói:', 'Quả dưa nặng hơn quả bí', 'Quả bí nặng bằng quả dưa', 'Quả bí nặng hơn quả dưa', 'Quả bí nhẹ hơn quả dưa', 'Quả bí nặng hơn quả dưa', 19, 1, 'admin', 1),
(1, 3, 'Số bé nhất có 2 chữ số giống nhau là:', '11', '22', '10', '19', '11', 20, 1, 'admin', 1),
(1, 2, 'Kết quả của phép tính 35 + 55 là:', '89', '92', '90', '91', '90', 21, 1, 'admin', 1),
(2, 2, 'Kết quả của phép tính 79 - 23 là:', '54', '55', '56', '57', '56', 22, 1, 'admin', 1),
(2, 2, 'Tìm x, biết x + 5 = 22', '17', '7', '27', '15', '17', 23, 1, 'admin', 1),
(2, 3, 'Số bị chia và số chia lần lượt là 36 và 4. Vậy thương là:', '8', '9', '10', '11', '9', 24, 1, 'admin', 1),
(3, 3, 'Số liền sau của số lớn nhất có ba chữ số là:', '999', '9999', '1000', '998', '1000', 25, 1, 'admin', 1),
(2, 1, '1km = ... m ? ', '100', '1', '10', '1000', '1000', 26, 1, 'admin', 1),
(2, 1, 'Trong phép trừ: 56 – 23 = 33, số 56 gọi là:', 'Số trừ', 'Thương', 'Số dư', 'Số bị trừ', 'Số bị trừ', 27, 1, 'admin', 1),
(2, 3, '2dm 3cm = … cm ?', '32', '203', '23', '230', '23', 28, 1, 'admin', 1),
(2, 3, 'Trong một phép trừ, biết hiệu là số bé nhất có hai chữ số mà tổng hai chữ số của nó bằng 6, số trừ bằng 68. Số bị trừ là', '73', '83', '53', '37', '73', 29, 1, 'admin', 1),
(2, 2, 'số bé nhất có hai chữ số mà tổng hai chữ số của nó bằng 6', '60', '10', '14', '15', '15', 30, 1, 'admin', 1),
(2, 3, '2.3km = .... m?', '230000', '2300', '230', '23', '230', 31, 1, 'admin', 1),
(3, 3, 'Tính 1 + 2 + 3 + 4 + ... + 50 = ?', '1385', '60', '1275', '1175', '1275', 32, 1, 'admin', 1),
(3, 1, '1 * (2 + 4) = ?', '6', '5', '4', '3', '6', 33, 1, 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quest_of_test`
--

CREATE TABLE `quest_of_test` (
  `test_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `timest` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `quest_of_test`
--

INSERT INTO `quest_of_test` (`test_id`, `question_id`, `timest`) VALUES
(446924, 1, '2020-07-02 03:46:04'),
(446924, 2, '2020-07-02 03:46:04'),
(446924, 9, '2020-07-02 03:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `student_id` int(11) NOT NULL,
  `test_code` int(11) NOT NULL,
  `score_number` varchar(10) DEFAULT NULL,
  `score_detail` varchar(50) NOT NULL,
  `completion_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`student_id`, `test_code`, `score_number`, `score_detail`, `completion_time`) VALUES
(1, 116195, '10', '2/2', '2020-05-02 11:32:25'),
(1, 446877, '0', '0/1', '2020-04-23 12:11:13'),
(2, 116195, '5', '1/2', '2020-05-02 11:28:22'),
(2, 446877, '0', '0/1', '2020-05-02 11:17:40');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(1) NOT NULL,
  `status_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `status_name`) VALUES
(1, 'Mở'),
(2, 'Đóng');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `class_id` int(11) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `gender` int(1) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT 'avatar-default.jpg',
  `birthday` date DEFAULT NULL,
  `doing_exam` int(11) DEFAULT NULL,
  `starting_time` datetime DEFAULT NULL,
  `time_remaining` varchar(11) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `username`, `email`, `password`, `name`, `class_id`, `last_login`, `gender`, `avatar`, `birthday`, `doing_exam`, `starting_time`, `time_remaining`, `address`) VALUES
(1, ' viettung', 'tranviettung369@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', ' Trần Việt Tùng', 2, '2020-05-25 23:02:04', 1, 'avatar-default.jpg', '1996-12-31', 112495, '2020-05-25 22:54:50', '4:57', ' Đông Thanh - Đông Sơn - Thanh Hóa'),
(2, ' tien1a', 'tienvan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', ' Trần Việt Tiến', 2, '2020-05-02 11:35:25', 1, 'avatar-default.jpg', '1996-12-31', NULL, NULL, NULL, ' Hà Đông - Hà Nội'),
(3, ' an123 ', 'anvan@gmail.com', '$2y$10$SjbIGVfTao/eU0w9QPPrD.nE7', ' Nguyễn Văn An ', 9, NULL, 1, 'avatar-default.jpg', '2014-01-08', NULL, NULL, NULL, ' Đông Anh - Hà Nội '),
(4, 'maianh', 'hatuanei@gmail.com', '$2y$10$cUFsszblxGPeJN/cCXMH2uKfc', 'Hà Mai Anh', 9, NULL, 2, 'avatar-default.jpg', '1996-07-11', NULL, NULL, NULL, 'Nam Định');

-- --------------------------------------------------------

--
-- Table structure for table `student_test_detail`
--

CREATE TABLE `student_test_detail` (
  `ID` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `test_code` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_a` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer_b` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer_c` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer_d` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_answer` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `timest` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student_test_detail`
--

INSERT INTO `student_test_detail` (`ID`, `student_id`, `test_code`, `question_id`, `answer_a`, `answer_b`, `answer_c`, `answer_d`, `student_answer`, `timest`) VALUES
(211651852, 1, 112495, 1, '<p>4</p>', '<p>1</p>', '<p>2</p>', '<p>3</p>', '<p>1</p>', '2020-05-25 15:54:58'),
(634123733, 1, 112495, 2, '<p>222</p>', '<p>5678</p>', '<p>222</p>', '<p>22222</p>', NULL, '2020-05-25 15:54:50'),
(1142717911, 1, 112495, 3, '<p>tien</p>', '<p>ha trang</p>', '<p>trang</p>', '<p>tung</p>', NULL, '2020-05-25 15:54:50'),
(1253865346, 1, 112495, 4, '<p>tiến việt trần</p>', '<p>trần việt tiến</p>', '<p>nguyễn h&agrave; trang</p>', '<p>trần việt t&ugrave;ng</p>', NULL, '2020-05-25 15:54:50'),
(1461582072, 1, 116195, 1, '<p>3</p>', '<p>1</p>', '<p>4</p>', '<p>2</p>', '<p>1</p>', '2020-05-02 04:32:16'),
(813810410, 1, 116195, 2, '<p>22222</p>', '<p>222</p>', '<p>5678</p>', '<p>222</p>', '<p>222</p>', '2020-05-02 04:32:21'),
(1050944059, 1, 446877, 1, '<p>3</p>', '<p>4</p>', '<p>2</p>', '<p>1</p>', '<p>2</p>', '2020-04-23 05:11:08'),
(831400001, 2, 116195, 1, '<p>3</p>', '<p>2</p>', '<p>1</p>', '<p>4</p>', '<p>1</p>', '2020-05-02 04:26:14'),
(1368977186, 2, 116195, 2, '<p>222</p>', '<p>22222</p>', '<p>222</p>', '<p>5678</p>', '<p>22222</p>', '2020-05-02 04:26:23'),
(58057545, 2, 446877, 1, '<p>4</p>', '<p>1</p>', '<p>3</p>', '<p>2</p>', '<p>2</p>', '2020-05-02 04:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`) VALUES
(1, 'Toán lớp 2'),
(3, 'Văn học 4'),
(6, 'Toán lớp 1'),
(8, 'Lịch Sử'),
(10, 'Tin học'),
(13, 'Hóa học 10'),
(15, ' Văn học lớp 3'),
(18, 'Địa lý 5');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `username` varchar(191) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `permission` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `gender` int(1) NOT NULL,
  `avatar` varchar(255) DEFAULT 'avatar-default.jpg',
  `birthday` date DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `username`, `email`, `name`, `permission`, `last_login`, `gender`, `avatar`, `birthday`, `password`, `address`) VALUES
(1, 'admin', 'tranviettung369@gamil.com', 'Root', 1, '0000-00-00 00:00:00', 1, 'avatar-default.jpg', '2020-06-01', '$2y$12$nKjJOS1YwF3j6vxsMYKpqeoV8dNvnJwF7LUikyxkly9E7gBzBg.9C', NULL),
(3, '   quile01', 'skfsdfk@gmail.com', '   Lê Thị Quý', 2, NULL, 1, 'avatar-default.jpg', '1999-04-24', '$2y$12$vhyjUHb6wfX6lOpi/nEH.eMFhXSQ0Yva8v9KRjzFZQ/fn8Ljrz1cu', '   Thanh Hóa'),
(5, 'hungabc', 'hungacng@gmail.com', 'Nguyễn Hữu Hùng', 2, NULL, 0, 'avatar-default.jpg', '1971-07-13', '$2y$10$2oOALQLQpbjTd/JGddL5E.NFaEZ3W9sBg6f7khlQ6oz./KmY6IetG', 'Thanh Hóa'),
(6, 'tranggg11', 'trangdkfj@gmail.com', 'Lê Thị Trang', 2, NULL, 2, 'avatar-default.jpg', '1990-02-06', '$2y$10$6YaiQ7ua.cvS3P4G6ZpUKO6ZZlEydnYImIbLBiaeQYKwBCsa8grcu', 'Hà Nội'),
(7, 'huepham123', 'huepham1234@gmail.com', 'Phạm Thị Huệ', 2, NULL, 2, 'avatar-default.jpg', '1886-10-12', '$2y$10$ke4yPF3Ds8L3nqP9u8XJQOPx87LxFadqdcfmeB1AL9IJ1jY6hC2iO', 'TP Thanh Hóa');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `test_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` int(11) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `time_to_do` int(11) NOT NULL,
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `timest` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `test_name`, `subject_id`, `total_questions`, `time_to_do`, `note`, `status_id`, `timest`) VALUES
(112495, 'Kiểm tra giữa kỳ', 1, 4, 8, 'Nộp bài trước khi thời gian hết, hoặc hệ thống sẽ tự động submit.', 1, '2020-06-14 11:17:09'),
(116195, 'Kiểm tra 15p', 1, 2, 2, 'Đây là bài kiểm tra 15p, các em không được sử dụng tài liệu.', 1, '2020-06-14 11:14:46'),
(446877, 'Kiểm tra cuối kỳ', 1, 1, 5, 'Các em có thể sử dụng bản đồ địa lý Việt Nam để làm bài kiểm tra này.', 1, '2020-06-14 11:17:52'),
(446924, 'Kiểm tra toán 1 giữa kỳ', 6, 3, 30, 'Thí sinh không được sử dụng tài liệu', 1, '2020-07-02 03:46:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `class_name` (`name`),
  ADD KEY `k4` (`subject_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit` (`unit`),
  ADD KEY `subjects_key` (`subject_id`),
  ADD KEY `level_id` (`level_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `quest_of_test`
--
ALTER TABLE `quest_of_test`
  ADD PRIMARY KEY (`test_id`,`question_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `test_code` (`test_id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`student_id`,`test_code`),
  ADD KEY `test_code` (`test_code`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `n9` (`class_id`);

--
-- Indexes for table `student_test_detail`
--
ALTER TABLE `student_test_detail`
  ADD PRIMARY KEY (`student_id`,`test_code`,`question_id`),
  ADD KEY `fk4` (`test_code`),
  ADD KEY `fk6` (`question_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `permission_id` (`permission`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk1` (`subject_id`),
  ADD KEY `fk2` (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=446925;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`),
  ADD CONSTRAINT `classes_ibfk_5` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`),
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  ADD CONSTRAINT `subjects_key` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `quest_of_test`
--
ALTER TABLE `quest_of_test`
  ADD CONSTRAINT `quest_of_test_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `quest_of_test_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`);

--
-- Constraints for table `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `scores_ibfk_2` FOREIGN KEY (`test_code`) REFERENCES `tests` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`);

--
-- Constraints for table `student_test_detail`
--
ALTER TABLE `student_test_detail`
  ADD CONSTRAINT `fk4` FOREIGN KEY (`test_code`) REFERENCES `tests` (`id`),
  ADD CONSTRAINT `fk6` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `fk9` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `fk2` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
