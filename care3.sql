-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2025 at 06:26 PM
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
-- Database: `care3`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `specialistid` int(11) NOT NULL,
  `docid` int(11) NOT NULL,
  `pt_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `pt_gender` varchar(225) NOT NULL,
  `pt_email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `pt_address` varchar(255) NOT NULL,
  `country` varchar(225) NOT NULL,
  `appdate` date NOT NULL,
  `apptime` time NOT NULL,
  `message` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `specialistid`, `docid`, `pt_name`, `dob`, `pt_gender`, `pt_email`, `phone`, `pt_address`, `country`, `appdate`, `apptime`, `message`, `status`) VALUES
(43, 5, 7, 'fazila', '5364-02-04', 'male', 'fazila@gmail.com', '0345-8956231', '65ryhtgfggfgsdxf', 'Pakistan', '2025-08-01', '17:41:00', 'fever', 'approved'),
(44, 1, 8, 'zira Hassan', '2025-10-01', 'Male', 'zira@gmail.com', '03167872019', 'karachi', 'Pakistan', '2025-10-06', '01:00:00', 'uy', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `ct_id` int(11) NOT NULL,
  `city_name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`ct_id`, `city_name`) VALUES
(2, 'Lahore'),
(3, 'Islamabad'),
(4, 'Quetta'),
(5, 'Multan'),
(12, 'Karachi');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `phone`, `message`, `created_at`) VALUES
(1, 'Zara', 'zara123@gmail.com', 'want to know about doctor', '03123456789', 'i want to know about the eye specialist in Karachi of your hospital', '2025-08-07 16:12:09'),
(2, 'Zara', 'zara123@gmail.com', 'want to know about doctor', '03123456789', 'i want to know about the eye specialist in Karachi of your hospital', '2025-08-07 16:13:26'),
(3, 'Zara', 'zara123@gmail.com', 'want to know about doctor', '03123456789', 'i want to know about the eye specialist in Karachi of your hospital', '2025-08-07 16:14:01'),
(4, 'Ali', 'ali@gamil.com', 'want to book appointment', '03123456789', 'i want to book appointment to eye specialist.', '2025-08-07 18:44:54'),
(5, 'Ali', 'ali123@gmail.com', 'want to know about doctor', '03123456789', 'i want to know about eye specialist in Karachi of your hospital.', '2025-08-07 19:22:44'),
(6, 'Zoya', 'zoya12@gmail.com', 'want to know about doctor', '03123456789', 'i want to know about cardiologist of your hospital in karachi or lahore', '2025-08-08 07:21:03'),
(7, 'abc', 'abc@gmail.com', 'xyzjkghjkgh', '21534567456', 'ngvbjhfghjgjgj', '2025-08-09 08:59:53'),
(8, 'Danish', 'danish@gmail.com', 'want to search doctor', '21534567456', 'i want to discover the doctor having specialty of heart in Karachi', '2025-08-09 09:48:21'),
(9, 'Soha', 'soha@gmail.com', 'want to search doctor', '21534567456', 'i want to discover doctors of heart in karachi', '2025-08-09 09:58:52'),
(10, 'Raza', 'raza@gmail.com', 'want to search doctor', '21534567456', 'i want to discover doctor of eyes in karachi', '2025-08-09 10:15:34'),
(11, 'Faisal', 'faisal@gmail.com', 'want to search doctor', '21534567456', 'I want to discover eye specialist in karachi', '2025-08-09 10:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `docspecialization`
--

CREATE TABLE `docspecialization` (
  `ds_id` int(11) NOT NULL,
  `specialist` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `docspecialization`
--

INSERT INTO `docspecialization` (`ds_id`, `specialist`, `description`) VALUES
(1, 'Dematologists', 'Expert care for your skin, hair, and nails. Click to view our top dermatologists ready to help you look and feel your best.'),
(3, 'OPD', 'Outpatient services tailored to your needs. Click to explore top doctors available for quick consultations.'),
(4, 'Dentist', 'Comprehensive dental care for a brighter smile. Click to explore top dental experts.'),
(5, 'Neurologist', 'Specialized care for brain and nerve conditions. Click to meet expert neurologists today.'),
(6, 'Eye Specialist', 'Comprehensive vision and eye care solutions. Click to connect with expert eye specialists.'),
(7, 'Orthopedic', 'Expert care for bones, joints, and muscles to help you move better and live pain-free.'),
(11, 'Nephrologist', 'Our doctor of kidney have ability to solve all the problem related to your kidney');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `city` int(11) NOT NULL,
  `CNIC` varchar(13) NOT NULL,
  `education` varchar(255) NOT NULL,
  `experience` text NOT NULL,
  `speciality` int(11) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `drimage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `email`, `phone`, `gender`, `DOB`, `city`, `CNIC`, `education`, `experience`, `speciality`, `shift`, `address`, `drimage`) VALUES
(7, 'Maham', 'maham12@gmail.com', '0321-5661231', 'female', '2004-03-03', 2, '2147483647123', 'MBBS', '5 year', 5, 'Morning', 'Main Clinic', 'dermad1_20250726_091311.jpg'),
(8, 'Eman', 'eman12@gmail.com', '0314-2345655', 'female', '2025-07-09', 3, '4210159812345', 'MBBS ', '7 year', 1, 'Morning', 'Westside Hospital,City Health Center', 'dermad2_20250726_091709.jpg'),
(12, 'Noor Fatima', 'noorfatima12@gmail.com', '314234565', 'female', '2025-06-04', 3, '2147483647', 'PHD', '5 year', 6, 'Morning', 'Main Clinic', 'noor_20250728_222842.jpg'),
(14, 'Maryam', 'maryam12@gmail.com', '03123456789', 'female', '2006-03-21', 4, '2147483647', 'MBBS', '3years', 3, 'Morning', 'Main Clinic', '2_20250807_220814.jpg'),
(16, 'Wania', 'wania12@gmail.com', '03123456725', 'female', '2002-03-12', 2, '2147483647123', 'MBBS', '3years', 6, 'Night', 'Westside Hospital', 'anaiya_20250807_221550.jpg'),
(17, 'Anus', 'anus12@gmail.com', '03123456789', 'Male', '2001-05-14', 3, '2147483647', 'MBBS', '3years', 3, 'Morning', 'Westside Hospital', 'team-1_20250807_221741.jpg'),
(23, 'AbdulRafy', 'rafy12@gmail.com', '0314-2345658', 'Male', '2025-08-06', 3, '4045888498374', 'PHD', '7 year', 4, 'Morning', 'Westside Hospital', 'rafy_20250816_214303.jpg'),
(24, 'Ifra', 'ifra12@gmail.com', '0315-5236941', 'Female', '2025-08-09', 4, '4210145614569', 'msc', '2 year', 7, 'Morning', 'Downtown Branch', 'ifra_20250816_215922.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `question` varchar(225) NOT NULL,
  `answer` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`) VALUES
(2, 'What are your visiting hours?', '9:00 AM to 8:00 PM daily'),
(3, 'Do you offer emergency services?', 'Yes, our emergency department is open 24 hours a day, 7 days a week. Our medical team is always ready to handle urgent and critical situations.'),
(4, 'Can I get online lab reports?', 'Yes, lab results are available through our patient portal.'),
(5, 'Do you accept insurance?', 'Yes, we accept most major insurance plans.'),
(7, 'How can I book an appointment?', 'You can easily book an appointment online through our website or by calling our front desk. Our staff will help you choose a suitable time and doctor.');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `role` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `name`, `phone`, `email`, `password`, `role`) VALUES
(4, 'admin', '3123456', 'admin@gmail.com', '$2y$10$XopGX.iQqZcN4G6gA7cj6.qlasO541M/mBukfoQiaVlySpmZJ1HYG', 'A'),
(29, 'Maham', '0321-5661231', 'maham12@gmail.com', '$2y$10$zBmT.QfEpgL7/6AT3WD99udBaNLjb5MetvdfubEg4LBwkHPJQbv1m', 'doctor'),
(30, 'Eman', '0314-2345655', 'eman12@gmail.com', '$2y$10$U//9xQz38e91nCbErVWIDuNtDIWaVnggZKFYi9TR8YPuSqpWWqtZG', 'doctor'),
(35, 'Noor Fatima', '314234565', 'noorfatima12@gmail.com', '$2y$10$wXgejEIJ9OXBTNlWgy2L.O0e89SyuJmtmcaPLnuxEti.c74ucHwxm', 'doctor'),
(40, 'saad', '03123456789', 'saad12@gmail.com', '$2y$10$aoebBRSK5EfwKYByDgjFhuLRkmTOZ71TfZLp6VFfTZ9ux1/1kYOKq', 'patient'),
(41, 'Maryam', '03123456789', 'maryam12@gmail.com', '$2y$10$yj.HhSwJGNw.w3r5gqwAGuAKpQLNlIrj9rcuNsujNoUiYwfF0KRz2', 'doctor'),
(43, 'Wania', '03123456725', 'wania12@gmail.com', '$2y$10$IBTbxgW3tMeBZjs1GkUah.C/dVh3zmQ7c43uB6iId4Z7Z7L9jC6xe', 'doctor'),
(44, 'Anus', '03123456789', 'anus12@gmail.com', '$2y$10$789phlvi3.eTnKQhquF8eOHxWZM89G7RjzXv/YYxFkZFMLNAKGpGm', 'doctor'),
(48, 'xyz', '03123456789', 'xyz@gmail.com', '$2y$10$iCFTnR96DmtCLJGVkN6/6OW98WYRrzAk3z/3myKpxf1tFKJW29UQK', 'patient'),
(49, 'Ahmed', '03123456789', 'ahmed@gmail.com', '$2y$10$SZKC.HDFIwQU4VI0b8j7POUH35nw2918I6cmkFYCoFmBXiJR.hQ92', 'patient'),
(54, 'Soha', '21534567456', 'soha12@gmail.com', '$2y$10$tQcRLWSU8sUrH4D9YodRUOb1Wawq2usoBlcxY7DsY8h4l2QqE3eje', 'patient'),
(55, 'wasam', '0314-9234565', 'mdwasam@gmail.com', '$2y$10$fnR8qcUaFcBi1BF0bQNjfOBCZGkbtSqfEHe3K17anCBsxv44Jp5N.', 'doctor'),
(56, 'AbdulRafy', '0314-2345658', 'rafy12@gmail.com', '$2y$10$4HpBphR78uMHFYdeMbWEKOh6UKue05ltmGAo7sX9QoiO/mJKlUXe2', 'doctor'),
(57, 'Ifra', '0315-5236941', 'ifra12@gmail.com', '$2y$10$LU3oolE5DaiM9vJ/tldx3OPW3c1BsMVGY5ytHiR1SdTSFBTb5Ow1m', 'doctor'),
(60, 'admin', '0345-6010922', 'admin13@gmail.com', '$2y$10$4Pyu.jGLwD7Uf3vk0hTqf.13b8YMRr1xseWgUQOsZtcTki9IHBHzy', 'A'),
(61, 'adminf', '0315-4598592', 'admin14@gmail.com', '$2y$10$RvbufTZJY.V33jU4kDffruC/dCQRuTgVvJFgdkN2.883327bCQArW', 'A'),
(63, 'fazila', '0300-1234567', 'fazila@gmail.com', '$2y$10$aLCQ4vU.UVmYUTeDzFCwFePZyd0x0KOVtm7goGy/evcpJNDJVQRxq', 'patient'),
(65, 'admin', '0312-8956412', 'admin5@gmail.com', '$2y$10$R2PuBGJLOehglmTYEMkRtuUJvY1TeUw1jLY8nYGucL4DZ.mVQj.Bq', 'A'),
(66, 'lira', '0315-8872019', 'lira@gmail.com', '$2y$10$RNZoxSFmBiPdmyHmaEN8wum3NMbAgjrvTIQlqNHwXx09boBz9xgG6', 'patient'),
(67, 'zira', '0315-9072019', 'zira@gmail.com', '$2y$10$Qdp46cdUMtccXm3utOw6eOJKuIkcvsCy/1UdTNXOrj7I2fM56u536', 'patient');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-app-specialist` (`specialistid`),
  ADD KEY `fk-app-doctor` (`docid`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`ct_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `docspecialization`
--
ALTER TABLE `docspecialization`
  ADD PRIMARY KEY (`ds_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-doc-specialist` (`speciality`),
  ADD KEY `fk-app-city` (`city`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `ct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `docspecialization`
--
ALTER TABLE `docspecialization`
  MODIFY `ds_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `fk-app-doctor` FOREIGN KEY (`docid`) REFERENCES `doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-app-specialist` FOREIGN KEY (`specialistid`) REFERENCES `docspecialization` (`ds_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `fk-app-city` FOREIGN KEY (`city`) REFERENCES `city` (`ct_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-doctor-speciality` FOREIGN KEY (`speciality`) REFERENCES `docspecialization` (`ds_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
