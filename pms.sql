-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 23, 2021 at 08:31 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `industry` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `m_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `industry`, `address`, `website`, `m_id`) VALUES
(1, 'client1', 'industry1', 'address1', 'website1', 1),
(2, 'client2', 'industry2', 'address2', 'website2', 1),
(3, 'client3', 'industry3', 'address3', 'website3', 1),
(5, 'client5', 'industry5', 'address5', 'website5', 1),
(6, 'client6', 'industry1', 'address5', 'website3', 3),
(7, 'client7', 'indusrty', 'addd', 'website7', 3),
(8, 'client new', 'industry', 'address', 'website', 3);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `m_id` int(3) NOT NULL,
  `emp_id1` int(100) NOT NULL,
  `emp_id2` int(100) DEFAULT NULL,
  `emp_id3` int(100) DEFAULT NULL,
  `client_id` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `m_id`, `emp_id1`, `emp_id2`, `emp_id3`, `client_id`, `status`) VALUES
(1, 'project1up', 1, 2, 0, 0, '1', 'Active'),
(2, 'project2', 1, 2, NULL, NULL, '1', 'Active'),
(3, 'projectm2', 3, 4, 8, 5, '1', 'Inactive'),
(4, 'project3', 1, 4, NULL, NULL, '2', 'Inactive'),
(5, 'projectm3', 6, 4, NULL, NULL, '3', 'Active'),
(6, 'project4', 1, 2, 4, 5, '2', 'Active'),
(7, 'project5', 1, 2, NULL, NULL, '2', 'Active'),
(8, 'project6', 1, 8, NULL, NULL, '2', 'Active'),
(9, 'project7up', 1, 5, NULL, NULL, '1', 'Inactive'),
(10, 'project8', 1, 4, 5, 7, '3', 'Inactive'),
(13, 'project9', 1, 4, 8, 5, '3', 'Active'),
(15, 'projectm2.2', 3, 2, 0, 0, '1', 'Active'),
(16, 'projectm2.3', 3, 8, 0, 0, '3', 'Inactive'),
(17, 'projectm2.4', 3, 5, 0, 0, '2', 'Active'),
(18, 'project new', 3, 4, 0, 0, '2', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `project_id` int(100) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `project_id`, `emp_id`, `status`) VALUES
(1, 'task1', 3, 4, 'Incomplete'),
(2, 'task2', 9, 5, 'Incomplete'),
(3, 'task3', 3, 4, 'Complete'),
(4, 'task new', 3, 4, 'Incomplete');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'manager', 'test@test.com', 'manager@123', 'Manager'),
(2, 'employee', 'employee@employee.com', 'employee@123', 'Employee'),
(3, 'manager2', 'manager2@manager.com', 'manager2@123', 'Manager'),
(4, 'employee2', 'employee2@employee.com', 'employee2@123', 'Employee'),
(5, 'employee3', 'employee3@employee.com', 'employee3@123', 'Employee'),
(6, 'manager3', 'manager3@manager.com', 'manager3@123', 'Manager'),
(7, 'employee4', 'employee4@employee.com', 'employee4@123', 'Employee'),
(8, 'employee5', 'employee5@employee.com', 'employee5@123', 'Employee'),
(9, 'manager4', 'manager4@manager.com', 'manager4@123', 'Manager'),
(10, 'manager new', 'manager@mnager.com', 'manager2@123', 'Manager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
