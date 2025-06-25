-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2025 at 02:52 PM
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
-- Database: `crafthiring`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_tokens`
--

CREATE TABLE `api_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `api_tokens`
--

INSERT INTO `api_tokens` (`id`, `user_id`, `token`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 1, '$2y$10$KZnWCMQO5krAST4mrMbm9.eywls9Cm3ChthutkUBBEVl/yZE3/8/S', '2025-03-31 15:23:40', '2025-03-30 10:23:40', '2025-03-30 10:23:40');

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` int(11) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_initial` char(1) DEFAULT NULL,
  `ssn` varchar(11) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `legal_us_work_eligibility` tinyint(1) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `salary` varchar(20) DEFAULT NULL,
  `employment_type` varchar(50) NOT NULL,
  `available_start_date` date DEFAULT NULL,
  `over_18` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `last_name`, `first_name`, `middle_initial`, `ssn`, `street_address`, `city`, `state`, `zip_code`, `phone_number`, `legal_us_work_eligibility`, `position`, `salary`, `employment_type`, `available_start_date`, `over_18`) VALUES
(22, 'Khan', 'Ahmad', 'A', '123-45-6789', '123 Main St', 'Lahore', 'Punjab', '54000', '03001234567', 0, 'Software Developer', '100000', 'Full-Time', '2025-04-01', 1),
(23, 'Khan', 'Ahmad', 'A', '123-45-6789', '123 Main St', 'Lahore', 'Punjab', '54000', '03001234567', 0, 'Software Developer', '100000', 'Full-Time', '2025-04-01', 1),
(24, 'Justice', 'Amos', 'Q', '000-00-0000', 'Rem molestias magni ', 'Quasi ipsum ut arch', 'Voluptatem suscipit ', '26493', '+1 (183) 287-82', NULL, NULL, NULL, '', NULL, NULL),
(25, 'Castaneda', 'Charity', 'E', '000-00-0000', 'Reprehenderit sint ', 'Quia natus laudantiu', 'Sint et commodo har', '59675', '+1 (392) 236-27', NULL, NULL, NULL, '', NULL, NULL),
(26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
(27, 'Khan', 'Ahmad', 'A', '123-45-6789', '123 Main St', 'Lahore', 'Punjab', '54000', '03001234567', 0, 'Software Developer', '100000', 'Full-Time', '2025-04-01', 1),
(28, 'Best', 'Wyatt', 'F', '000-00-0000', 'Nam repudiandae eum ', 'Labore provident et', 'In aliquam officiis ', '49901', '+1 (682) 245-75', 0, 'test_position', 'Corporis dolor volup', 'Full Time', '1976-08-07', 1),
(29, 'Patterson', 'Hedley', 'S', '000-00-0000', 'Perferendis quia ape', 'Fugiat reprehenderi', 'Fuga Odio pariatur', '57295', '+1 (582) 836-16', 0, 'test_position', 'Ut doloribus aliqua', '', '1992-01-30', 1),
(30, 'Sparks', 'Arden', 'O', '000-00-0000', 'Aliquam enim non aut', 'Eius laborum Quas a', 'Consequatur voluptat', '16620', '+1 (282) 254-88', 0, 'test_position', 'Adipisicing exercita', 'Part Time', '2017-10-31', 1),
(31, 'Davidson', 'Kasimir', 'S', '000-00-0000', 'Ullam ea voluptatum ', 'Libero excepturi lab', 'Nihil eos quas quibu', '64681', '+1 (934) 553-82', 0, 'test_position', 'In in velit quas ex', '', '1977-06-23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `application_signatures`
--

CREATE TABLE `application_signatures` (
  `applicant_id` int(11) DEFAULT NULL,
  `signature` varchar(100) DEFAULT NULL,
  `signature_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application_signatures`
--

INSERT INTO `application_signatures` (`applicant_id`, `signature`, `signature_date`) VALUES
(22, 'Ahmad Khan', '2025-03-30'),
(23, 'Ahmad Khan', '2025-03-30'),
(27, 'Ahmad Khan', '2025-03-30'),
(28, 'Est similique aliqu', '2009-12-18'),
(29, 'Totam in qui earum m', '2004-12-03'),
(30, 'Doloremque iure enim', '1988-12-06'),
(31, 'Perspiciatis volupt', '2020-10-12');

-- --------------------------------------------------------

--
-- Table structure for table `availability`
--

CREATE TABLE `availability` (
  `applicant_id` int(11) DEFAULT NULL,
  `day` varchar(10) DEFAULT NULL,
  `time_from` time DEFAULT NULL,
  `time_to` time DEFAULT NULL,
  `total_hours` int(20) DEFAULT NULL,
  `special_requests` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `availability`
--

INSERT INTO `availability` (`applicant_id`, `day`, `time_from`, `time_to`, `total_hours`, `special_requests`) VALUES
(22, 'Monday', '09:00:00', '17:00:00', 8, 'None'),
(22, 'Tuesday', '10:00:00', '16:00:00', 6, 'None'),
(23, 'Monday', '09:00:00', '17:00:00', 8, 'None'),
(23, 'Tuesday', '10:00:00', '16:00:00', 6, 'None'),
(27, 'Monday', '09:00:00', '17:00:00', 8, 'None'),
(27, 'Tuesday', '10:00:00', '16:00:00', 6, 'None'),
(28, 'Monday', '17:21:00', '00:56:00', 2, 'Ipsam quis rerum lab'),
(29, 'Monday', '14:15:00', '14:07:00', 13, 'Enim debitis magnam '),
(30, 'Monday', '14:44:00', '06:45:00', 44, 'Aut facilis omnis ut'),
(31, 'Monday', '19:02:00', '23:12:00', 9, 'Rerum consequatur pe');

-- --------------------------------------------------------

--
-- Table structure for table `begin_work`
--

CREATE TABLE `begin_work` (
  `id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `18_years` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `begin_work`
--

INSERT INTO `begin_work` (`id`, `date`, `18_years`) VALUES
(22, '2025-04-02 00:00:00', '1'),
(23, '2025-04-02 00:00:00', '1'),
(27, '2025-04-02 00:00:00', '1'),
(28, '1976-08-07 00:00:00', '1'),
(29, '1992-01-30 00:00:00', '1'),
(30, '2017-10-31 00:00:00', '1'),
(31, '1977-06-23 00:00:00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `criminal_history`
--

CREATE TABLE `criminal_history` (
  `applicant_id` int(11) DEFAULT NULL,
  `has_conviction` tinyint(1) DEFAULT NULL,
  `conviction_date` date DEFAULT NULL,
  `conviction_location` varchar(255) DEFAULT NULL,
  `convicted_when` varchar(100) DEFAULT NULL,
  `convicted_where` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `criminal_history`
--

INSERT INTO `criminal_history` (`applicant_id`, `has_conviction`, `conviction_date`, `conviction_location`, `convicted_when`, `convicted_where`) VALUES
(22, 0, NULL, NULL, NULL, NULL),
(23, 0, NULL, NULL, NULL, NULL),
(27, 0, NULL, NULL, NULL, NULL),
(28, 1, '0000-00-00', 'Quasi laborum Minim', 'Aut incididunt aliqu', 'Quasi laborum Minim'),
(29, 1, '0000-00-00', 'Reprehenderit quis p', 'Saepe nulla sed sunt', 'Reprehenderit quis p'),
(30, 1, '0000-00-00', 'Non repellendus Lab', 'Laudantium a laboru', 'Non repellendus Lab'),
(31, 0, '0000-00-00', 'Omnis aut non velit', 'Provident sed enim ', 'Omnis aut non velit');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `applicant_id` int(11) DEFAULT NULL,
  `high_school_name` varchar(100) DEFAULT NULL,
  `high_school_city` varchar(100) DEFAULT NULL,
  `high_school_state` varchar(50) DEFAULT NULL,
  `high_school_zip` varchar(10) DEFAULT NULL,
  `high_school_graduate` tinyint(1) DEFAULT NULL,
  `ged` tinyint(1) DEFAULT NULL,
  `college_name` varchar(100) DEFAULT NULL,
  `college_city` varchar(100) DEFAULT NULL,
  `college_state` varchar(50) DEFAULT NULL,
  `college_zip` varchar(10) DEFAULT NULL,
  `college_graduate` tinyint(1) DEFAULT NULL,
  `college_degree` varchar(100) DEFAULT NULL,
  `college_major` varchar(100) DEFAULT NULL,
  `currently_enrolled` tinyint(1) DEFAULT NULL,
  `enrolled_school_name` varchar(100) DEFAULT NULL,
  `expected_degree_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`applicant_id`, `high_school_name`, `high_school_city`, `high_school_state`, `high_school_zip`, `high_school_graduate`, `ged`, `college_name`, `college_city`, `college_state`, `college_zip`, `college_graduate`, `college_degree`, `college_major`, `currently_enrolled`, `enrolled_school_name`, `expected_degree_date`) VALUES
(22, 'Govt High School', 'Lahore', 'Punjab', '54000', 1, 0, 'PUCIT', 'Lahore', 'Punjab', '54000', 1, 'BSCS', 'Computer Science', 0, NULL, NULL),
(23, 'Govt High School', 'Lahore', 'Punjab', '54000', 1, 0, 'PUCIT', 'Lahore', 'Punjab', '54000', 1, 'BSCS', 'Computer Science', 0, NULL, NULL),
(27, 'Govt High School', 'Lahore', 'Punjab', '54000', 1, 0, 'PUCIT', 'Lahore', 'Punjab', '54000', 1, 'BSCS', 'Computer Science', 0, NULL, NULL),
(28, 'Shelly Donovan', 'Quibusdam anim vel e', '', '', 0, 0, 'Maile Jefferson', 'Do ipsum mollit aut', '', '', 1, 'Quos odio ut rem dic', 'Similique officia ul', 1, '', NULL),
(29, 'Wylie Burton', 'Quia eveniet pariat', '', '', 1, 1, 'Calvin Benson', 'Repudiandae quo poss', '', '', 1, 'Harum omnis atque om', 'Sunt dolore ipsa ad', 0, NULL, NULL),
(30, 'Lee Powers', 'Hic dignissimos iste', '', '', 0, 0, 'Brianna Moore', 'Fugit aut at sint s', '', '', 0, 'Voluptas esse distin', 'Repudiandae qui est', 0, NULL, NULL),
(31, 'Warren Bartlett', 'Voluptatem aut aute', '', '', 1, 0, 'Scarlett Silva', 'Pariatur Quos sunt ', '', '', 0, 'Et rerum sunt moles', 'Sit fugiat dignissi', 1, 'Ut provident nulla ', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employment_history`
--

CREATE TABLE `employment_history` (
  `id` int(11) NOT NULL,
  `applicant_id` int(11) DEFAULT NULL,
  `employer_name` varchar(100) DEFAULT NULL,
  `job_title` varchar(100) DEFAULT NULL,
  `duties` text DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `starting_pay` varchar(50) DEFAULT NULL,
  `ending_pay` varchar(50) DEFAULT NULL,
  `supervisor_name` varchar(100) DEFAULT NULL,
  `supervisor_phone` varchar(15) DEFAULT NULL,
  `reason_for_leaving` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employment_history`
--

INSERT INTO `employment_history` (`id`, `applicant_id`, `employer_name`, `job_title`, `duties`, `address`, `city`, `state`, `zip_code`, `from_date`, `to_date`, `starting_pay`, `ending_pay`, `supervisor_name`, `supervisor_phone`, `reason_for_leaving`) VALUES
(2, 22, 'ABC Tech', 'Software Engineer', 'Web Development', 'XYZ Street', 'Lahore', 'Punjab', '54000', '2023-01-01', '2024-01-01', '80000', '100000', 'Ali Khan', '03001234570', 'Better Opportunity'),
(3, 23, 'ABC Tech', 'Software Engineer', 'Web Development', 'XYZ Street', 'Lahore', 'Punjab', '54000', '2023-01-01', '2024-01-01', '80000', '100000', 'Ali Khan', '03001234570', 'Better Opportunity'),
(4, 27, 'ABC Tech', 'Software Engineer', 'Web Development', 'XYZ Street', 'Lahore', 'Punjab', '54000', '2023-01-01', '2024-01-01', '80000', '100000', 'Ali Khan', '03001234570', 'Better Opportunity'),
(5, 28, 'Chava Faulkner', 'Nostrum sit ut dolo', 'Aut voluptatem excep', 'Et dolor voluptas di', '', '', '', '1985-09-06', '1989-12-02', 'Illo magni deserunt ', 'Id iusto laborum ali', 'Aut voluptatem aliqu', '+1 (577) 901-33', 'Ipsum qui nostrud la'),
(6, 29, 'Yolanda Garza', 'Quisquam ut sunt vol', 'Qui perspiciatis do', 'Asperiores ea quo en', '', '', '', '1996-10-07', '2011-05-02', 'Quam numquam necessi', 'Excepturi cupiditate', 'Officia ipsum ea la', '+1 (617) 195-68', 'Architecto eiusmod a'),
(7, 29, 'Aurelia Franklin', 'Sunt omnis necessita', 'Non eiusmod veniam ', 'Rerum corrupti odio', '', '', '', '1986-01-27', '1988-06-13', 'Nihil sunt ut et hic', 'Velit non aliqua In', 'Optio id voluptatem', '+1 (888) 438-14', 'Error pariatur Sed '),
(8, 30, 'Ella Jordan', 'Odio quisquam cum cu', 'Officia quaerat sint', 'Officia at dolor nos', '', '', '', '2013-06-01', '1975-01-04', 'Ut ab tempor nobis e', 'Perspiciatis est la', 'Neque nobis impedit', '+1 (764) 177-72', 'Ipsam qui assumenda '),
(9, 31, 'Dieter Rojas', 'Voluptatem numquam v', 'Doloribus voluptatib', 'Saepe possimus illo', '', '', '', '2022-06-11', '2023-08-20', 'Non dignissimos omni', 'Sit non est harum v', 'Natus esse ea unde ', '+1 (925) 569-23', 'Veritatis facilis ea');

-- --------------------------------------------------------

--
-- Table structure for table `intake_forms`
--

CREATE TABLE `intake_forms` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category` enum('Concrete','Framer','Other') NOT NULL,
  `experience_years` int(11) DEFAULT NULL,
  `certifications` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `position_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `references_info`
--

CREATE TABLE `references_info` (
  `applicant_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `relationship_duration` varchar(100) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `references_info`
--

INSERT INTO `references_info` (`applicant_id`, `name`, `occupation`, `relationship_duration`, `phone_number`) VALUES
(22, 'Ali Raza', 'Manager', '5 years', '03001234568'),
(22, 'Bilal Ahmed', 'CEO', '3 years', '03001234569'),
(23, 'Ali Raza', 'Manager', '5 years', '03001234568'),
(23, 'Bilal Ahmed', 'CEO', '3 years', '03001234569'),
(27, 'Ali Raza', 'Manager', '5 years', '03001234568'),
(27, 'Bilal Ahmed', 'CEO', '3 years', '03001234569'),
(28, 'Jelani Lawson', 'Autem duis et nisi m', '', '+1 (602) 493-85'),
(28, 'Ivor Mcdonald', 'Necessitatibus ut bl', '', '+1 (757) 363-26'),
(29, 'Walter Jackson', 'Nostrud veniam assu', '', '+1 (664) 395-29'),
(29, 'Desirae Klein', 'Eveniet id sapiente', '', '+1 (446) 986-10'),
(30, 'Pandora Dillon', 'Ut excepteur nemo du', '', '+1 (336) 436-28'),
(30, 'Dane Mcdowell', 'Aspernatur natus com', '', '+1 (793) 273-59'),
(31, 'Sopoline Waller', 'Similique dicta odit', '', '+1 (442) 284-72'),
(31, 'Pearl Vance', 'Labore rerum sed eli', '', '+1 (431) 285-93');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(5, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `applicant_id` int(11) DEFAULT NULL,
  `skill_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`applicant_id`, `skill_description`) VALUES
(22, 'PHP'),
(22, 'Laravel'),
(22, 'Vue.js'),
(23, 'PHP'),
(23, 'Laravel'),
(23, 'Vue.js'),
(27, 'PHP'),
(27, 'Laravel'),
(27, 'Vue.js'),
(28, 'Cum laudantium veni'),
(29, 'Voluptate nobis ipsu'),
(30, 'Sed dolore quia ea l'),
(31, 'Excepturi in non nis');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 4,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `role_id`, `user_name`, `email`, `name`, `password`, `phone`, `picture`, `created_at`) VALUES
(1, 5, 'Admin', 'admin@gmail.com', 'admin', 'admin123', '03331234567', NULL, '2025-03-30 00:18:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_tokens`
--
ALTER TABLE `api_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application_signatures`
--
ALTER TABLE `application_signatures`
  ADD KEY `applicant_id` (`applicant_id`);

--
-- Indexes for table `availability`
--
ALTER TABLE `availability`
  ADD KEY `applicant_id` (`applicant_id`);

--
-- Indexes for table `begin_work`
--
ALTER TABLE `begin_work`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `criminal_history`
--
ALTER TABLE `criminal_history`
  ADD KEY `applicant_id` (`applicant_id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD KEY `applicant_id` (`applicant_id`);

--
-- Indexes for table `employment_history`
--
ALTER TABLE `employment_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applicant_id` (`applicant_id`);

--
-- Indexes for table `intake_forms`
--
ALTER TABLE `intake_forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `references_info`
--
ALTER TABLE `references_info`
  ADD KEY `applicant_id` (`applicant_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD KEY `applicant_id` (`applicant_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_tokens`
--
ALTER TABLE `api_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `begin_work`
--
ALTER TABLE `begin_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `employment_history`
--
ALTER TABLE `employment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `intake_forms`
--
ALTER TABLE `intake_forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `api_tokens`
--
ALTER TABLE `api_tokens`
  ADD CONSTRAINT `api_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `application_signatures`
--
ALTER TABLE `application_signatures`
  ADD CONSTRAINT `application_signatures_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`);

--
-- Constraints for table `availability`
--
ALTER TABLE `availability`
  ADD CONSTRAINT `availability_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`);

--
-- Constraints for table `criminal_history`
--
ALTER TABLE `criminal_history`
  ADD CONSTRAINT `criminal_history_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`);

--
-- Constraints for table `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `education_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`);

--
-- Constraints for table `employment_history`
--
ALTER TABLE `employment_history`
  ADD CONSTRAINT `employment_history_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`);

--
-- Constraints for table `intake_forms`
--
ALTER TABLE `intake_forms`
  ADD CONSTRAINT `intake_forms_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `references_info`
--
ALTER TABLE `references_info`
  ADD CONSTRAINT `references_info_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`);

--
-- Constraints for table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
