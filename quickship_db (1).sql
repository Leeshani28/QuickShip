-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2026 at 10:00 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quickship_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `customer_address` varchar(200) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_nic` varchar(12) NOT NULL,
  `customer_mobile` varchar(20) NOT NULL,
  `customer_fixed` varchar(20) NOT NULL,
  `customer_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_address`, `customer_email`, `customer_nic`, `customer_mobile`, `customer_fixed`, `customer_status`) VALUES
(1, 'Leeshani', 'no.42,kiribathkumbura', 'lees@ss', '200173904215', '0778207163', '0114087245', 1),
(2, 'Tharu', '', '', '', '', '', 1),
(3, 'dfgud', '', '', '', '', '', 1),
(4, 'xcsd', '', '', '', '', '', 1),
(5, 'gegae', '', '', '', '', '', 1),
(6, 'greagegew', '', '', '', '', '', 1),
(7, 'nbcc', '', '', '', '', '', 1),
(8, 'gcgv', '', '', '', '', '', 1),
(9, 'gcgv', '', '', '', '', '', 1),
(10, 'gcgv', '', '', '', '', '', 1),
(11, 'gcgv', '', '', '', '', '', 1),
(12, 'gcgv', '', '', '', '', '', 1),
(13, 'gcgv', '', '', '', '', '', 1),
(14, 'gcgv', '', '', '', '', '', 1),
(15, 'nbf', '', '', '', '', '', 1),
(16, 'nbf', '', '', '', '', '', 1),
(17, 'nbf', '', '', '', '', '', 1),
(18, 'vcdf', '', '', '', '', '', 1),
(19, 'xca', '', '', '', '', '', 1),
(20, 'cxxc', '', '', '', '', '', 1),
(21, 'Senu', '', '', '', '', '', 1),
(22, '', '', '', '', '', '', 1),
(23, '', '', '', '', '', '', 1),
(24, '', '', '', '', '', '', 1),
(25, 'aaa', '', '', '', '', '', 1),
(26, 'kaushi', '', '', '', '', '', 1),
(27, 'lala', '', '', '', '', '', 1),
(28, '', '', '', '', '', '', 1),
(29, '', '', '', '', '', '', 1),
(30, '', '', '', '', '', '', 1),
(31, '', '', '', '', '', '', 1),
(32, '', '', '', '', '', '', 1),
(33, '', '', '', '', '', '', 1),
(34, '', '', '', '', '', '', 1),
(35, 'salini', '', '', '', '', '', 1),
(36, '', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` int(11) NOT NULL,
  `shipment_id` int(11) NOT NULL,
  `start_location` int(11) NOT NULL,
  `destination_location` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `delivery_status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`delivery_id`, `shipment_id`, `start_location`, `destination_location`, `driver_id`, `vehicle_id`, `delivery_status`) VALUES
(1, 1, 0, 0, 2, 6, 'Started'),
(2, 5, 1, 22, 4, 9, 'Pending'),
(3, 2, 1, 12, 3, 5, 'Approved'),
(4, 9, 1, 11, 5, 8, 'Rejected'),
(5, 10, 1, 11, 5, 8, 'Rejected'),
(6, 12, 1, 3, 5, 8, 'Started'),
(7, 13, 1, 1, 2, 7, 'Started'),
(8, 8, 1, 18, 1, 1, 'Started'),
(9, 15, 1, 4, 3, 6, 'Started'),
(10, 16, 1, 4, 4, 8, 'Received'),
(11, 16, 1, 4, 4, 7, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(100) NOT NULL,
  `district_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`district_id`, `district_name`, `district_status`) VALUES
(1, 'Colombo', 1),
(2, 'Gampaha', 1),
(3, 'Kalutara', 1),
(4, 'Kandy', 1),
(5, 'Matale', 1),
(6, 'Nuwara Eliya', 1),
(7, 'Galle', 1),
(8, 'Matara', 1),
(9, 'Hambantota', 1),
(10, 'Jaffna', 1),
(11, 'Kilinochchi', 1),
(12, 'Mannar', 1),
(13, 'Vavuniya', 1),
(14, 'Mullaitivu', 1),
(15, 'Batticaloa', 1),
(16, 'Ampara', 1),
(17, 'Trincomalee', 1),
(18, 'Kurunegala', 1),
(19, 'Puttalam', 1),
(20, 'Anuradhapura', 1),
(21, 'Polonnaruwa', 1),
(22, 'Badulla', 1),
(23, 'Monaragala', 1),
(24, 'Ratnapura', 1),
(25, 'Kegalle', 1);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driver_id` int(11) NOT NULL,
  `driver_categary` varchar(20) NOT NULL,
  `driver_name` varchar(70) NOT NULL,
  `driver_nic` varchar(20) NOT NULL,
  `driver_date_of_birth` date NOT NULL,
  `license_number` int(20) NOT NULL,
  `license_expiry_date` date NOT NULL,
  `driver_phone_number` int(10) NOT NULL,
  `driver_address` varchar(50) NOT NULL,
  `driver_district` int(11) NOT NULL,
  `driver_location` int(11) NOT NULL,
  `driver_profile_picture` varchar(80) NOT NULL,
  `driver_status` enum('Available','Unavailable','Assigned') NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `driver_categary`, `driver_name`, `driver_nic`, `driver_date_of_birth`, `license_number`, `license_expiry_date`, `driver_phone_number`, `driver_address`, `driver_district`, `driver_location`, `driver_profile_picture`, `driver_status`) VALUES
(1, '', 'Kapila Jayasinhe', '198955900608', '2024-01-23', 16337, '2026-12-19', 114784513, 'No.72,Peradeniya road,Kandy', 9, 0, '1778529944_mission-on-saturn-4k-0b-1920x1080.jpg', 'Assigned'),
(2, '', 'Sarath nishantha', '198955999308', '1987-10-13', 24552, '2026-10-30', 812389075, 'no.21/1,galle', 7, 1, '1778701496_IMG-20250608-WA0023.jpg', 'Available'),
(3, '', 'Yapa', '318955999308', '2004-12-20', 24552, '2026-05-31', 114784513, '2nd street,mathale', 5, 6, '', 'Assigned'),
(4, '', 'Thilakarathne', '198955900778', '1993-06-08', 1633748, '2026-10-12', 784512457, '2nd street,jaffna', 10, 4, '', 'Available'),
(5, '', 'Saman', '198955977778', '1974-06-15', 16374, '2027-02-24', 772389075, 'new town,nuwaraeliya', 6, 6, '', 'Assigned'),
(6, 'Rider', 'Kamal', '008955999308', '1986-07-07', 16384, '2026-12-01', 114578963, '2nd street,Ratmalane', 2, 2, '', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` int(11) NOT NULL,
  `expense_category` varchar(100) NOT NULL,
  `expense_amount` decimal(10,0) NOT NULL,
  `expense_date` date NOT NULL,
  `expense_description` text DEFAULT NULL,
  `expense_status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expense_id`, `expense_category`, `expense_amount`, `expense_date`, `expense_description`, `expense_status`) VALUES
(1, 'Vehicle MAintenace', 25000, '2026-06-10', 'Vehicle Maintenance', 'Pending'),
(2, 'Salary', 25000, '2026-06-10', 'Driver Salary', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `function`
--

CREATE TABLE `function` (
  `function_id` int(11) NOT NULL,
  `function_name` varchar(50) NOT NULL,
  `module_id` int(11) NOT NULL,
  `function_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `function`
--

INSERT INTO `function` (`function_id`, `function_name`, `module_id`, `function_status`) VALUES
(1, 'Add User', 1, 1),
(2, 'View User', 1, 1),
(3, 'Update User', 1, 1),
(4, 'Delete User', 1, 1),
(5, 'Generate User Reports', 1, 1),
(6, 'Add Warehouse', 2, 1),
(7, 'View Warehouse', 2, 1),
(8, 'Update Warehouse', 2, 1),
(9, 'Delete Warehouse', 2, 1),
(10, 'Generate Warehouse Reports', 2, 1),
(11, 'Add Vehicle', 3, 1),
(12, 'View Vehicle', 3, 1),
(13, 'Update Vehicle', 3, 1),
(14, 'Delete Vehicle', 3, 1),
(15, 'Generate Vehicle Reports', 3, 1),
(16, 'Add Driver', 4, 1),
(17, 'View Driver', 4, 1),
(18, 'Update Driver', 4, 1),
(19, 'Delete Driver', 4, 1),
(20, 'Generate Driver Reports', 4, 1),
(21, 'Add Customer', 5, 1),
(22, 'View Customer', 5, 1),
(23, 'Update Customer', 5, 1),
(24, 'Delete Customer', 5, 1),
(25, 'Generate Customer Reports', 5, 1),
(26, 'Add Order', 6, 1),
(27, 'View Order', 6, 1),
(28, 'Update Order', 6, 1),
(29, 'Delete Order', 6, 1),
(30, 'Generate Order Reports', 6, 1),
(31, 'Add Delivery', 7, 1),
(32, 'View Delivery', 7, 1),
(33, 'Update Delivery', 7, 1),
(34, 'Delete Delivery', 7, 1),
(35, 'Generate Delivery Reports', 7, 1),
(36, 'Add Package', 8, 1),
(37, 'View Package', 8, 1),
(38, 'Update Package', 8, 1),
(39, 'Delete Package', 8, 1),
(40, 'Generate Package Reports', 8, 1),
(41, 'Add Finance Record', 9, 1),
(42, 'View Finance Record', 9, 1),
(43, 'Update Finance Record', 9, 1),
(44, 'Delete Finance Record', 9, 1),
(45, 'Generate Finance Reports', 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `function_user`
--

CREATE TABLE `function_user` (
  `fun_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `function_user`
--

INSERT INTO `function_user` (`fun_id`, `user_id`) VALUES
(1, 9),
(1, 15),
(1, 16),
(2, 9),
(2, 15),
(2, 16),
(3, 9),
(3, 15),
(3, 16),
(4, 9),
(4, 15),
(4, 16),
(5, 9),
(5, 15),
(5, 16),
(6, 15),
(6, 16),
(6, 18),
(6, 19),
(6, 22),
(6, 23),
(6, 24),
(7, 15),
(7, 16),
(7, 18),
(7, 19),
(7, 22),
(7, 23),
(7, 24),
(8, 15),
(8, 16),
(8, 18),
(8, 19),
(8, 22),
(8, 23),
(8, 24),
(9, 15),
(9, 16),
(9, 18),
(9, 19),
(9, 22),
(9, 23),
(9, 24),
(10, 15),
(10, 16),
(10, 18),
(10, 19),
(10, 22),
(10, 23),
(10, 24),
(11, 6),
(11, 15),
(11, 16),
(12, 6),
(12, 15),
(12, 16),
(13, 6),
(13, 15),
(13, 16),
(14, 6),
(14, 15),
(14, 16),
(15, 6),
(15, 15),
(15, 16),
(16, 6),
(16, 15),
(16, 16),
(16, 20),
(17, 6),
(17, 15),
(17, 16),
(17, 20),
(18, 6),
(18, 15),
(18, 16),
(18, 20),
(19, 6),
(19, 15),
(19, 16),
(19, 20),
(20, 6),
(20, 15),
(20, 16),
(20, 20),
(21, 4),
(21, 8),
(21, 11),
(21, 15),
(21, 16),
(22, 4),
(22, 8),
(22, 11),
(22, 15),
(22, 16),
(23, 4),
(23, 8),
(23, 11),
(23, 15),
(23, 16),
(24, 4),
(24, 8),
(24, 11),
(24, 15),
(24, 16),
(25, 4),
(25, 8),
(25, 11),
(25, 15),
(25, 16),
(26, 13),
(26, 15),
(26, 16),
(27, 13),
(27, 15),
(27, 16),
(28, 13),
(28, 15),
(28, 16),
(29, 13),
(29, 15),
(29, 16),
(30, 13),
(30, 15),
(30, 16),
(31, 13),
(31, 15),
(31, 16),
(32, 13),
(32, 15),
(32, 16),
(33, 13),
(33, 15),
(33, 16),
(34, 13),
(34, 15),
(34, 16),
(35, 13),
(35, 15),
(35, 16),
(36, 13),
(36, 15),
(36, 16),
(37, 13),
(37, 15),
(37, 16),
(38, 13),
(38, 15),
(38, 16),
(39, 13),
(39, 15),
(39, 16),
(40, 13),
(40, 15),
(40, 16),
(41, 7),
(41, 9),
(41, 15),
(41, 16),
(42, 7),
(42, 9),
(42, 15),
(42, 16),
(43, 7),
(43, 9),
(43, 15),
(43, 16),
(44, 7),
(44, 9),
(44, 15),
(44, 16),
(45, 7),
(45, 9),
(45, 15),
(45, 16);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `login_username` varchar(80) NOT NULL,
  `login_password` text NOT NULL,
  `login_status` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `login_username`, `login_password`, `login_status`, `user_id`) VALUES
(1, 'lees@qs.lk', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 1),
(2, 'sandaruwanekanayake@gmail.com', 'b2b53ff5043f8bacda3e0a8f36deba711e3afeb6', 1, 2),
(3, 'taylor@gmail.com', 'e9a00b0f2ac5e674e5c5c88d10360f301d21c1a2', 1, 3),
(4, 'leeshanisangakkara@gmail.com', 'ac696253eaf515f5794848533540fd0bad011237', 1, 4),
(5, 'ashani@gmail.com', 'e84a95ac67671d6427a3eb13802085c9c00ba3e5', 1, 5),
(6, 'nvb@gd', 'ac696253eaf515f5794848533540fd0bad011237', 1, 6),
(7, 'nfhf@nhd', 'ac696253eaf515f5794848533540fd0bad011237', 1, 7),
(8, 'ggh@ff', 'd17b99129980009b34c06b3525e2cbb8c0fb9d38', 1, 8),
(9, 'nbg@gh', '280075be4577b71e4eaf1f617b9111f037ec9d9a', 1, 9),
(10, 'kdnf@nds', 'ac696253eaf515f5794848533540fd0bad011237', 1, 10),
(11, 'kdnf@nds', 'ac696253eaf515f5794848533540fd0bad011237', 1, 11),
(12, 'vn@ee', 'ac696253eaf515f5794848533540fd0bad011237', 1, 12),
(13, 'sdbh@vsh', 'ac696253eaf515f5794848533540fd0bad011237', 1, 13),
(14, 'gn@fd', '76db6e4d24552f6c6ec94ea20d3c434d6eb67804', 1, 4),
(15, 'ashani@gmail.com', '79a13113f92c224550405f6a94ed7c928baa2e3d', 1, 5),
(16, 'peter@ncjkdsn', '5cdd078f7278596bb6ec84b213825f18758d3e2a', 1, 6),
(17, 'hd@ekn', 'ba3d0ed8f08a5cc405fa0f9178655784aaccfe97', 1, 7),
(18, 'Jonn@gg', '8815cdebbc36aeb3cba44d4f523d873d2ad29f14', 1, 9),
(19, 'dhanu@gg', '43997919016bb99d42a4c82e8d66beb7fb176083', 1, 10),
(20, 'll@ss', '8a87f51e672206bfd7ed6f51898bc3125b2f7528', 1, 11),
(21, 'jeccy@cy', '539c1efca5342929a4a6cbe7d93982b736294a0f', 1, 12),
(22, 'sachi@ni', 'c0b6133105af0c529fd0c3ae295579ca00ff0f56', 1, 13),
(23, 'sachi@ni', '06fc989dc5b1259f087d387f26c684a24369f3ec', 1, 14),
(24, 'gegae@grgr', 'd47275bf3478d05057b769dd59ad9f5e110490d5', 1, 15),
(25, 'mono@gg', 'c51c95fa1a87b06092c26f144cb9226f989bb6a5', 1, 16),
(26, 'grg@grg', '14031fbecb3564a93a802036a2396f2f1c188d4a', 1, 18),
(27, 'veve@rbzrbdrb', '56bbf5cd7ea2105fb425df58341da70a34e3e203', 1, 19),
(28, 'fefefe@gge', '77436646fbfc2d08e15320547da877cab550122b', 1, 20),
(29, 'dsfn@sdg', '4421e037421a3b538693211a5012fcb2aee718f7', 1, 22),
(30, 'cgfd@bvf', 'de8a0cbb1558d3adbc292be3bb2e627027a79026', 1, 23),
(31, 'kavi@sha', 'c5ef6332f3a61ff4fdeb29920bebdef5083ec5c2', 1, 24);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(30) NOT NULL,
  `module_icon` varchar(50) NOT NULL,
  `module_url` text NOT NULL,
  `module_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`module_id`, `module_name`, `module_icon`, `module_url`, `module_status`) VALUES
(1, 'User Management', 'user.png', 'user.php', 1),
(2, 'Warehouse Management', 'warehouse.png', 'warehouse.php', 1),
(3, 'Vehicle Management', 'vehicle.png', 'vehicle.php', 1),
(4, 'Driver Management', 'driver.png', 'driver.php', 1),
(5, 'Customer Management', 'customer.png', 'customer.php', 1),
(6, 'Order Management', 'order.png', 'order.php', 1),
(7, 'Delivery Management', 'deliver.png', 'delivery.php', 1),
(8, 'Package Management', 'package.png', 'package.php', 1),
(9, 'Finance Management', 'finance.png', 'finance.php', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ofd`
--

CREATE TABLE `ofd` (
  `ofd_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `delivery_proof` varchar(200) NOT NULL,
  `ofd_status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ofd`
--

INSERT INTO `ofd` (`ofd_id`, `driver_id`, `order_id`, `delivery_proof`, `ofd_status`) VALUES
(1, 0, 0, '', 'Pending'),
(2, 0, 0, '', 'Pending'),
(3, 6, 34, '1780863095_hills.jpg', 'Delivered'),
(4, 0, 0, '', 'Delivered'),
(5, 0, 0, '', 'Delivered'),
(6, 0, 0, '', 'Delivered'),
(7, 0, 0, '', 'Delivered'),
(8, 0, 0, '1780862016_45a3507a90a9219de76a323a80215e6c.jpg', 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `order_location` int(11) NOT NULL,
  `premises_no` int(11) NOT NULL,
  `premises_name` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `town` varchar(50) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `return_address` varchar(200) NOT NULL,
  `delivery_type` varchar(50) NOT NULL,
  `preferred_del_date` date NOT NULL,
  `deli_instruction` varchar(300) NOT NULL,
  `payment_type` varchar(400) NOT NULL,
  `amount` int(11) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `sender_id`, `receiver_id`, `province_id`, `district_id`, `order_date`, `order_location`, `premises_no`, `premises_name`, `street`, `town`, `postal_code`, `return_address`, `delivery_type`, `preferred_del_date`, `deli_instruction`, `payment_type`, `amount`, `order_status`) VALUES
(1, 1, 1, 2, 5, '2026-04-20', 0, 0, 'Daya niwasa', '2nd street', 'Matale', 70441, 'no.42,kiribathkumbura', 'Express', '2026-04-30', 'The first house of the street with the green gate', 'Pre-paid', 3500, 1),
(2, 2, 0, 3, 8, '2026-04-24', 0, 0, '', '', '', 0, '', 'Same_day', '2026-04-30', '', 'Pre-paid', 0, 2),
(3, 3, 0, 6, 12, '2026-04-24', 0, 0, '', '', '', 0, '', 'Express', '0000-00-00', '', 'Cash On Delivery(COD)', 0, 2),
(4, 4, 0, 6, 6, '2026-04-24', 0, 0, '', '', '', 0, '', 'Next_day', '0000-00-00', '', 'Cash On Delivery(COD)', 0, 2),
(5, 5, 0, 4, 0, '2026-04-24', 0, 0, '', '', '', 0, '', 'Same_day', '0000-00-00', '', '', 0, 2),
(6, 6, 0, 6, 0, '2026-04-24', 0, 0, '', '', '', 0, '', '', '0000-00-00', '', '', 0, 2),
(7, 7, 0, 4, 11, '2026-04-24', 0, 0, '', '', '', 0, '', '', '2025-12-10', '', 'Cash On Delivery(COD)', 0, 2),
(8, 8, 0, 3, 0, '2026-04-24', 0, 0, '', '', '', 0, '', '', '0000-00-00', '', '', 0, 1),
(9, 9, 0, 3, 5, '2026-04-24', 0, 0, '', '', '', 0, '', 'Same_day', '2026-04-15', '', 'Pre-paid', 0, 2),
(10, 10, 10, 3, 5, '2026-04-24', 0, 0, '', '', '', 0, '', 'Same_day', '2026-04-15', '', 'Pre-paid', 0, 1),
(11, 11, 11, 3, 5, '2026-04-24', 0, 0, '', '', '', 0, '', 'Same_day', '2026-04-15', '', 'Pre-paid', 0, 1),
(12, 12, 12, 3, 5, '2026-04-24', 0, 0, '', '', '', 0, '', 'Same_day', '2026-04-15', '', 'Pre-paid', 0, 1),
(13, 13, 13, 3, 5, '2026-04-24', 0, 0, '', '', '', 0, '', 'Same_day', '2026-04-15', '', 'Pre-paid', 0, 1),
(14, 14, 14, 3, 5, '2026-04-24', 0, 0, '', '', '', 0, '', 'Same_day', '2026-04-15', '', 'Pre-paid', 0, 1),
(15, 15, 15, 5, 13, '2026-04-24', 0, 0, '', '', '', 0, '', 'Next_day', '0000-00-00', '', 'Pre-paid', 0, 1),
(16, 16, 16, 5, 13, '2026-04-24', 0, 0, '', '', '', 0, '', 'Next_day', '0000-00-00', '', 'Pre-paid', 0, 1),
(17, 17, 17, 5, 13, '2026-04-24', 0, 0, '', '', '', 0, '', 'Next_day', '0000-00-00', '', 'Pre-paid', 0, 2),
(18, 18, 18, 5, 11, '2026-04-24', 1, 0, '', '', '', 0, '', 'Express', '2026-04-10', '', 'Pre-paid', 0, 4),
(19, 19, 19, 4, 12, '2026-04-24', 1, 0, '', '', '', 0, '', 'Same_day', '2026-04-09', '', 'Pre-paid', 0, 6),
(20, 20, 20, 4, 13, '2026-04-24', 1, 0, '', '', '', 0, '', 'Same_day', '2026-04-07', '', 'Pre-paid', 0, 5),
(21, 21, 21, 7, 20, '2026-04-27', 4, 0, '', '', 'Nawa nagaraya', 0, '', 'Standard', '2026-04-30', '', 'Cash On Delivery(COD)', 0, 3),
(22, 22, 22, 3, 3, '2026-04-27', 4, 0, '', '', 'mathara', 0, '', 'Next_day', '2026-04-29', '', 'Pre-paid', 0, 2),
(23, 23, 23, 5, 18, '2026-04-28', 1, 0, '', '', 'Kurunagala', 0, '', 'Next_day', '2026-05-01', '', 'Cash On Delivery(COD)', 0, 3),
(24, 24, 24, 7, 21, '2026-04-28', 4, 0, '', '', '', 0, '', 'Express', '2026-05-08', '', 'Cash On Delivery(COD)', 0, 2),
(25, 25, 25, 5, 15, '2026-04-29', 1, 0, '', '', '', 0, '', 'Same_day', '2026-05-01', '', 'Cash On Delivery(COD)', 0, 6),
(26, 26, 26, 8, 22, '2026-05-02', 1, 0, '', '', '', 0, '', 'Standard', '2026-05-12', '', 'Pre-paid', 0, 6),
(27, 27, 27, 3, 7, '2026-05-05', 1, 0, '', '', '', 0, '', 'Standard', '2026-05-20', '', 'Cash On Delivery(COD)', 0, 5),
(28, 28, 28, 8, 22, '2026-05-05', 1, 0, '', '', '', 0, '', 'Next_day', '2026-05-06', '', 'Cash On Delivery(COD)', 0, 6),
(29, 29, 29, 9, 25, '2026-05-05', 1, 0, '', '', '', 0, '', 'Standard', '2026-05-20', '', 'Cash On Delivery(COD)', 0, 5),
(30, 30, 30, 5, 18, '2026-05-05', 1, 0, '', '', '', 0, '', 'Standard', '2026-05-21', '', 'Pre-paid', 0, 6),
(31, 31, 31, 5, 18, '2026-05-05', 1, 0, '', '', '', 0, '', 'Standard', '2026-05-21', '', 'Pre-paid', 0, 6),
(32, 32, 32, 4, 11, '2026-05-05', 1, 0, '', '', '', 0, '', 'Same_day', '2026-05-20', '', 'Cash On Delivery(COD)', 0, 5),
(33, 33, 33, 3, 3, '2026-05-22', 1, 0, '', '', '', 0, '', 'Standard', '2026-05-30', '', 'Cash On Delivery(COD)', 0, 6),
(34, 34, 34, 1, 1, '2026-05-24', 1, 0, '', '', '', 0, '', 'Same_day', '2026-06-01', '', 'Pre-paid', 0, 8),
(35, 35, 35, 2, 4, '2026-05-24', 1, 0, '', '', '', 0, '', 'Same_day', '2026-05-28', '', 'Cash On Delivery(COD)', 0, 6),
(36, 36, 36, 2, 4, '2026-05-25', 4, 0, '', '', '', 0, '', 'Express', '2026-06-05', '', 'Cash On Delivery(COD)', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_logs`
--

CREATE TABLE `order_logs` (
  `order_log_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `log_time` datetime NOT NULL DEFAULT current_timestamp(),
  `log_remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_logs`
--

INSERT INTO `order_logs` (`order_log_id`, `order_id`, `status_id`, `log_time`, `log_remarks`) VALUES
(1, 25, 1, '2026-04-29 01:40:53', 'Order is placed!'),
(2, 26, 1, '2026-05-02 00:28:40', 'Order is placed!'),
(3, 26, 2, '2026-05-02 00:29:22', 'Order is Confirmed!'),
(4, 26, 3, '2026-05-02 00:30:10', 'Order is Added to Warehouse!'),
(5, 25, 0, '2026-05-03 17:58:05', ''),
(6, 26, 0, '2026-05-03 17:58:05', ''),
(7, 25, 0, '2026-05-03 17:59:21', ''),
(8, 26, 0, '2026-05-03 17:59:21', ''),
(9, 25, 5, '2026-05-03 18:05:49', 'Assigned Shipment'),
(10, 26, 5, '2026-05-03 18:05:49', 'Assigned Shipment'),
(11, 25, 5, '2026-05-03 18:09:18', 'Assigned Shipment'),
(12, 26, 5, '2026-05-03 18:09:18', 'Assigned Shipment'),
(13, 25, 5, '2026-05-03 18:11:28', 'Assigned Shipment'),
(14, 26, 5, '2026-05-03 18:11:28', 'Assigned Shipment'),
(15, 25, 5, '2026-05-03 18:25:16', 'Assigned Shipment'),
(16, 26, 5, '2026-05-03 18:25:17', 'Assigned Shipment'),
(17, 19, 5, '2026-05-04 16:53:42', 'Assigned Shipment'),
(18, 24, 2, '2026-05-05 00:37:41', 'Order is Confirmed!'),
(19, 27, 1, '2026-05-05 00:39:59', 'Order is placed!'),
(20, 27, 2, '2026-05-05 00:40:07', 'Order is Confirmed!'),
(21, 27, 3, '2026-05-05 00:40:46', 'Order is Added to Warehouse!'),
(22, 27, 5, '2026-05-05 00:41:11', 'Assigned Shipment'),
(23, 28, 1, '2026-05-05 13:11:29', 'Order is placed!'),
(24, 28, 2, '2026-05-05 13:11:38', 'Order is Confirmed!'),
(25, 28, 3, '2026-05-05 13:11:52', 'Order is Added to Warehouse!'),
(26, 28, 5, '2026-05-05 13:12:24', 'Assigned Shipment'),
(27, 0, 3, '2026-05-05 13:13:08', 'Order is Added to Warehouse!'),
(28, 28, 5, '2026-05-05 15:13:18', 'Assigned Shipment'),
(29, 20, 5, '2026-05-05 15:28:58', 'Assigned Shipment'),
(30, 29, 1, '2026-05-05 15:47:09', 'Order is placed!'),
(31, 29, 2, '2026-05-05 15:47:55', 'Order is Confirmed!'),
(32, 29, 3, '2026-05-05 15:48:37', 'Order is Added to Warehouse!'),
(33, 29, 5, '2026-05-05 15:48:55', 'Assigned Shipment'),
(34, 30, 1, '2026-05-05 15:55:12', 'Order is placed!'),
(35, 30, 2, '2026-05-05 15:55:22', 'Order is Confirmed!'),
(36, 31, 1, '2026-05-05 15:56:55', 'Order is placed!'),
(37, 31, 2, '2026-05-05 15:57:06', 'Order is Confirmed!'),
(38, 30, 3, '2026-05-05 15:57:21', 'Order is Added to Warehouse!'),
(39, 31, 3, '2026-05-05 15:57:22', 'Order is Added to Warehouse!'),
(40, 30, 5, '2026-05-05 15:57:46', 'Assigned Shipment'),
(41, 31, 5, '2026-05-05 15:57:46', 'Assigned Shipment'),
(42, 0, 3, '2026-05-05 16:06:58', ''),
(43, 0, 3, '2026-05-05 16:06:58', ''),
(44, 32, 1, '2026-05-05 16:56:09', 'Order is placed!'),
(45, 32, 2, '2026-05-05 16:56:15', 'Order is Confirmed!'),
(46, 32, 3, '2026-05-05 16:56:26', 'Order is Added to Warehouse!'),
(47, 32, 5, '2026-05-05 16:56:38', 'Assigned Shipment'),
(48, 0, 3, '2026-05-05 16:57:14', ''),
(49, 32, 3, '2026-05-05 17:15:16', 'drivers are busy'),
(50, 32, 5, '2026-05-06 18:05:09', 'Assigned Shipment'),
(51, 25, 3, '2026-05-16 02:37:05', ''),
(52, 26, 3, '2026-05-16 02:37:05', ''),
(53, 25, 3, '2026-05-16 02:38:35', ''),
(54, 26, 3, '2026-05-16 02:38:35', ''),
(55, 25, 6, '2026-05-21 01:44:33', 'Order assigned to the delivery!'),
(56, 26, 6, '2026-05-21 01:44:33', 'Order assigned to the delivery!'),
(57, 28, 6, '2026-05-21 14:00:14', 'Order assigned to the delivery!'),
(58, 19, 6, '2026-05-21 17:22:46', 'Order assigned to the delivery!'),
(59, 32, 6, '2026-05-22 16:39:10', 'Order assigned to the delivery!'),
(60, 32, 6, '2026-05-22 19:16:18', 'Order assigned to the delivery!'),
(61, 32, 5, '2026-05-22 19:43:35', '7788'),
(62, 33, 1, '2026-05-22 21:10:47', 'Order is placed!'),
(63, 33, 2, '2026-05-22 21:13:41', 'Order is Confirmed!'),
(64, 33, 3, '2026-05-22 21:18:01', 'Order is Added to Warehouse!'),
(65, 33, 5, '2026-05-22 21:24:08', 'Assigned Shipment'),
(66, 33, 6, '2026-05-22 21:35:03', 'Order assigned to the delivery!'),
(67, 34, 1, '2026-05-24 13:23:00', 'Order is placed!'),
(68, 34, 2, '2026-05-24 13:23:07', 'Order is Confirmed!'),
(69, 34, 3, '2026-05-24 13:24:17', 'Order is Added to Warehouse!'),
(70, 34, 5, '2026-05-24 13:24:34', 'Assigned Shipment'),
(71, 34, 6, '2026-05-24 13:26:20', 'Order assigned to the delivery!'),
(72, 3, 2, '2026-05-24 13:27:28', 'Order is Confirmed!'),
(73, 23, 2, '2026-05-24 13:28:05', 'Order is Confirmed!'),
(74, 23, 3, '2026-05-24 13:28:19', 'Order is Added to Warehouse!'),
(75, 23, 5, '2026-05-24 13:28:38', 'Assigned Shipment'),
(76, 30, 6, '2026-05-24 13:29:47', 'Order assigned to the delivery!'),
(77, 31, 6, '2026-05-24 13:29:47', 'Order assigned to the delivery!'),
(78, 35, 1, '2026-05-24 13:48:58', 'Order is placed!'),
(79, 35, 2, '2026-05-24 13:49:17', 'Order is Confirmed!'),
(80, 35, 3, '2026-05-24 13:49:57', 'Order is Added to Warehouse!'),
(81, 35, 5, '2026-05-24 13:50:09', 'Assigned Shipment'),
(82, 35, 6, '2026-05-24 13:52:40', 'Order assigned to the delivery!'),
(83, 34, 3, '2026-05-25 15:35:24', 'Delivery Received!'),
(84, 34, 3, '2026-05-25 15:35:47', 'Delivery Received!'),
(85, 34, 3, '2026-05-25 16:24:26', 'Delivery Received!'),
(86, 34, 3, '2026-05-25 16:42:51', 'Delivery Received!'),
(87, 36, 1, '2026-05-25 16:54:26', 'Order is placed!'),
(88, 36, 2, '2026-05-25 16:56:01', 'Order is Confirmed!'),
(89, 36, 3, '2026-05-25 16:56:36', 'Order is Added to Warehouse!'),
(90, 36, 5, '2026-05-25 16:56:56', 'Assigned Shipment'),
(91, 36, 6, '2026-05-25 16:58:22', 'Order assigned to the delivery!'),
(92, 36, 3, '2026-05-25 16:59:45', 'Delivery Received!'),
(93, 36, 6, '2026-05-25 17:18:43', 'Order assigned to the delivery!'),
(94, 36, 3, '2026-05-25 17:19:34', 'Delivery Received!'),
(95, 34, 7, '2026-05-30 00:42:03', 'Out for delivery!'),
(96, 34, 7, '2026-05-30 00:52:02', 'Out for delivery!'),
(97, 34, 7, '2026-05-30 01:35:13', 'Out for delivery!'),
(98, 23, 3, '2026-06-05 02:13:00', ''),
(99, 0, 3, '2026-06-06 02:07:23', 'Array'),
(100, 34, 3, '2026-06-06 02:33:59', 'Returned'),
(101, 34, 3, '2026-06-06 02:34:56', 'Returned'),
(102, 34, 3, '2026-06-06 02:47:46', 'Returned'),
(103, 34, 3, '2026-06-06 02:56:25', 'Returned'),
(104, 0, 8, '2026-06-08 01:00:16', 'Delivered'),
(105, 0, 8, '2026-06-08 01:01:41', 'Delivered'),
(106, 0, 8, '2026-06-08 01:16:17', 'Delivered'),
(107, 0, 8, '2026-06-08 01:17:13', 'Delivered'),
(108, 0, 8, '2026-06-08 01:23:36', 'Delivered'),
(109, 0, 8, '2026-06-08 01:33:48', 'Delivered'),
(110, 34, 8, '2026-06-08 01:41:35', 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `color_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`status_id`, `status_name`, `description`, `color_code`) VALUES
(1, 'Pending', 'Order created and waiting for confirmation', '#FFF3CD'),
(2, 'Confirmed', 'Order has been confirmed and approved', '#D6E9FF'),
(3, 'At Warehouse', 'Parcel received at warehouse and ready for transit processing', '#E2D4F7'),
(4, 'In Transit', 'Parcel is on the way to destination', '#8ae6a0'),
(5, ' Shipment Assigned', 'Order has been assigned to a shipment', '#fabebe'),
(6, 'Delivery Assigned', 'Order has been assigned to a delivery', '#d9f9fd'),
(7, 'Out for Delivery', 'Parcel is out with courier for delivery', '#FFE5D0'),
(8, 'Delivered', 'Parcel successfully delivered to receiver', '#D4EDDA'),
(9, 'Failed Delivery', 'Delivery attempt failed', '#F8D7DA'),
(10, 'Returned', 'Parcel returned back to sender', '#E2E3E5'),
(11, 'Cancelled', 'Order has been cancelled', '#F1F3F5'),
(12, 'Active', 'Currently active status', '#D4EDDA'),
(13, 'Deactivated', 'Currently inactive or disabled', '#F8D7DA');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `package_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` int(20) NOT NULL,
  `pkg_value` int(12) NOT NULL,
  `pkg_type` varchar(50) NOT NULL,
  `packaging_type` varchar(50) NOT NULL,
  `pkg_weight` float NOT NULL,
  `pkg_length` int(10) NOT NULL,
  `pkg_width` int(11) NOT NULL,
  `height` int(10) NOT NULL,
  `fragile_item` int(11) NOT NULL DEFAULT 0,
  `insurance` int(11) NOT NULL DEFAULT 0,
  `instructions` varchar(500) NOT NULL,
  `pkg_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`package_id`, `order_id`, `quantity`, `pkg_value`, `pkg_type`, `packaging_type`, `pkg_weight`, `pkg_length`, `pkg_width`, `height`, `fragile_item`, `insurance`, `instructions`, `pkg_status`) VALUES
(1, 1, 10, 3000, 'Food Items', 'Plastic Wrap', 2, 50, 40, 21, 0, 1, 'Ensure proper sealing', 0),
(2, 2, 0, 0, 'Clothing', 'Wooden Crate', 0, 0, 0, 0, 0, 0, '', 0),
(3, 3, 0, 0, 'Food Items', 'Tube Packaging', 0, 0, 0, 0, 0, 0, '', 0),
(4, 4, 0, 0, 'Books', '', 0, 0, 0, 0, 0, 0, '', 0),
(5, 5, 0, 0, 'Electronics', '', 0, 0, 0, 0, 0, 0, '', 0),
(6, 6, 0, 0, 'Clothing', '', 0, 0, 0, 0, 0, 0, '', 0),
(7, 7, 0, 0, 'Industrial Goods', 'Padded Bag', 0, 0, 0, 0, 0, 0, '', 0),
(8, 8, 0, 0, 'Electronics', '', 0, 0, 0, 0, 0, 0, '', 0),
(9, 9, 0, 0, 'Electronics', 'Plastic Wrap', 0, 0, 0, 0, 0, 0, '', 0),
(10, 10, 0, 0, 'Electronics', 'Plastic Wrap', 0, 0, 0, 0, 0, 0, '', 0),
(11, 11, 0, 0, 'Electronics', 'Plastic Wrap', 0, 0, 0, 0, 0, 0, '', 0),
(12, 12, 0, 0, 'Electronics', 'Plastic Wrap', 0, 0, 0, 0, 0, 0, '', 0),
(13, 13, 0, 0, 'Electronics', 'Plastic Wrap', 0, 0, 0, 0, 0, 0, '', 0),
(14, 14, 0, 0, 'Electronics', 'Plastic Wrap', 0, 0, 0, 0, 0, 0, '', 0),
(15, 15, 0, 0, 'Food Items', 'Plastic Wrap', 0, 0, 0, 0, 0, 0, '', 0),
(16, 16, 0, 0, 'Food Items', 'Plastic Wrap', 0, 0, 0, 0, 0, 0, '', 0),
(17, 17, 0, 0, 'Food Items', 'Plastic Wrap', 0, 0, 0, 0, 0, 0, '', 0),
(18, 18, 0, 0, 'Electronics', 'Wooden Crate', 0, 0, 0, 0, 0, 0, '', 0),
(19, 19, 0, 0, 'Clothing', 'Padded Bag', 0, 0, 0, 0, 0, 0, '', 0),
(20, 20, 0, 0, 'Food Items', 'Plastic Wrap', 0, 0, 0, 0, 0, 0, '', 0),
(21, 21, 10, 0, 'Clothing', 'Padded Bag', 40, 20, 40, 70, 0, 0, '', 0),
(22, 22, 0, 0, 'Electronics', 'Padded Bag', 40, 0, 0, 0, 0, 0, '', 0),
(23, 23, 0, 0, 'Fragile Items', 'Wooden Crate', 0, 0, 0, 0, 0, 0, '', 0),
(24, 24, 0, 0, 'Documents', 'Padded Bag', 0, 0, 0, 0, 0, 0, '', 0),
(25, 25, 0, 0, 'Books', 'Wooden Crate', 0, 0, 0, 0, 0, 0, '', 0),
(26, 26, 2, 0, 'Clothing', 'Padded Bag', 0, 0, 0, 0, 0, 0, '', 0),
(27, 27, 0, 0, 'Food Items', 'Plastic Wrap', 0, 0, 0, 0, 0, 0, '', 0),
(28, 28, 0, 0, 'Clothing', 'Padded Bag', 0, 0, 0, 0, 0, 0, '', 0),
(29, 29, 0, 0, 'Books', 'Padded Bag', 0, 0, 0, 0, 0, 0, '', 0),
(30, 30, 0, 0, 'Books', 'Tube Packaging', 0, 0, 0, 0, 0, 0, '', 0),
(31, 31, 0, 0, 'Industrial Goods', 'Wooden Crate', 0, 0, 0, 0, 0, 0, '', 0),
(32, 32, 0, 0, 'Food Items', 'Padded Bag', 0, 0, 0, 0, 0, 0, '', 0),
(33, 33, 0, 0, 'Electronics', 'Wooden Crate', 0, 0, 0, 0, 1, 1, '', 0),
(34, 34, 0, 0, 'Fragile Items', 'Plastic Wrap', 0, 0, 0, 0, 1, 0, '', 0),
(35, 35, 0, 0, 'Industrial Goods', 'Plastic Wrap', 0, 0, 0, 0, 0, 0, '', 0),
(36, 36, 0, 0, 'Industrial Goods', 'Cardboard Box', 0, 0, 0, 0, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `province_id` int(11) NOT NULL,
  `province_name` varchar(100) NOT NULL,
  `province_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`province_id`, `province_name`, `province_status`) VALUES
(1, 'Western', 1),
(2, 'Central', 1),
(3, 'Southern', 1),
(4, 'Northern', 1),
(5, 'Eastern', 1),
(6, 'North Western', 1),
(7, 'North Central', 1),
(8, 'Uva', 1),
(9, 'Sabaragamuwa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `province_district`
--

CREATE TABLE `province_district` (
  `province_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `province_district`
--

INSERT INTO `province_district` (`province_id`, `district_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 4),
(2, 5),
(2, 6),
(3, 7),
(3, 8),
(3, 9),
(4, 10),
(4, 11),
(4, 12),
(4, 13),
(4, 14),
(5, 15),
(5, 16),
(5, 17),
(6, 18),
(6, 19),
(7, 20),
(7, 21),
(8, 22),
(8, 23),
(9, 24),
(9, 25);

-- --------------------------------------------------------

--
-- Table structure for table `receiver`
--

CREATE TABLE `receiver` (
  `receiver_id` int(11) NOT NULL,
  `receiver_name` varchar(200) NOT NULL,
  `receiver_address` varchar(200) NOT NULL,
  `receiver_email` varchar(100) NOT NULL,
  `receiver_nic` varchar(12) NOT NULL,
  `receiver_mobile` varchar(20) NOT NULL,
  `receiver_fixed` varchar(20) NOT NULL,
  `receiver_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receiver`
--

INSERT INTO `receiver` (`receiver_id`, `receiver_name`, `receiver_address`, `receiver_email`, `receiver_nic`, `receiver_mobile`, `receiver_fixed`, `receiver_status`) VALUES
(1, 'Shani', 'No.20,2nd street,matale', 'sha@ni', '221144778899', '0114455223', '0774455221', 1),
(2, 'dncjd', '', '', '', '', '', 1),
(3, 'wqdq', '', '', '', '', '', 1),
(4, 'weff', '', '', '', '', '', 1),
(5, 'geageeee', '', '', '', '', '', 1),
(6, 'tbgfbfd', '', '', '', '', '', 1),
(7, 'lkgh', '', '', '', '', '', 1),
(8, 'vft', '', '', '', '', '', 1),
(9, 'vft', '', '', '', '', '', 1),
(10, 'vft', '', '', '', '', '', 1),
(11, 'vft', '', '', '', '', '', 1),
(12, 'vft', '', '', '', '', '', 1),
(13, 'vft', '', '', '', '', '', 1),
(14, 'vft', '', '', '', '', '', 1),
(15, 'fsdf', '', '', '', '', '', 1),
(16, 'fsdf', '', '', '', '', '', 1),
(17, 'fsdf', '', '', '', '', '', 1),
(18, 'dfbs', '', '', '', '', '', 1),
(19, 'vdf', '', '', '', '', '', 1),
(20, 'sds', '', '', '', '', '', 1),
(21, 'aashi', '', '', '', '', '', 1),
(22, '', '', '', '', '', '', 1),
(23, '', '', '', '', '', '', 1),
(24, '', '', '', '', '', '', 1),
(25, 'fff', '', '', '', '', '', 1),
(26, 'supuni', '', '', '', '', '', 1),
(27, 'jessy', '', '', '', '', '', 1),
(28, '', '', '', '', '', '', 1),
(29, '', '', '', '', '', '', 1),
(30, '', '', '', '', '', '', 1),
(31, '', '', '', '', '', '', 1),
(32, '', '', '', '', '', '', 1),
(33, '', '', '', '', '', '', 1),
(34, '', '', '', '', '', '', 1),
(35, '', '', '', '', '', '', 1),
(36, '', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `role_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `role_status`) VALUES
(1, 'Director', 1),
(2, 'General Manager', 1),
(3, 'HR Manager', 1),
(4, 'HR Officer', 1),
(5, 'System Administrator', 1),
(6, 'IT Operator', 1),
(7, 'Operational Manager', 1),
(8, 'Package Handling Officer', 1),
(9, 'Operational Officer', 1),
(10, 'Warehouse Manager', 1),
(11, 'Warehouse Officer', 1),
(12, 'Transport Manager', 1),
(13, 'Transport Officer', 1),
(14, 'Fleet Coordinator', 1),
(15, 'Delivery Supervisor', 1),
(16, 'Customer Relations Manager', 1),
(17, 'Customer Service Officer', 1),
(18, 'Finance Manager', 1),
(19, 'Accounts Clerk', 1),
(20, 'Driver', 1),
(21, 'Security Officer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role_module`
--

CREATE TABLE `role_module` (
  `role_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_module`
--

INSERT INTO `role_module` (`role_id`, `module_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(3, 1),
(3, 9),
(4, 1),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(5, 6),
(5, 7),
(5, 8),
(5, 9),
(6, 1),
(7, 6),
(7, 7),
(7, 8),
(8, 8),
(9, 6),
(9, 7),
(9, 8),
(10, 2),
(11, 2),
(12, 3),
(12, 4),
(13, 3),
(13, 4),
(14, 4),
(15, 7),
(16, 5),
(17, 5),
(18, 9),
(19, 9),
(20, 4);

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
  `shipment_id` int(11) NOT NULL,
  `shipment_start_location` int(11) NOT NULL,
  `shipment_destination_location` int(11) NOT NULL,
  `shipment_status` varchar(20) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipment`
--

INSERT INTO `shipment` (`shipment_id`, `shipment_start_location`, `shipment_destination_location`, `shipment_status`) VALUES
(1, 1, 15, 'Delivery Assigned'),
(2, 1, 12, 'Delivery Assigned'),
(3, 1, 7, 'Cancel'),
(4, 1, 22, 'Cancel'),
(5, 1, 22, 'Delivery Assigned'),
(6, 1, 13, 'Cancel'),
(7, 1, 25, 'Pending'),
(8, 1, 18, 'Delivery Assigned'),
(9, 1, 11, 'Delivery Assigned'),
(10, 1, 11, 'Confirm'),
(11, 1, 0, 'Pending'),
(12, 1, 3, 'Delivery Assigned'),
(13, 1, 1, 'Confirm'),
(14, 1, 18, 'Cancel'),
(15, 1, 4, 'Delivery Assigned'),
(16, 1, 4, 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `shipment_orders`
--

CREATE TABLE `shipment_orders` (
  `shipment_orders_id` int(11) NOT NULL,
  `shipment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `shipment_order_status` varchar(20) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipment_orders`
--

INSERT INTO `shipment_orders` (`shipment_orders_id`, `shipment_id`, `order_id`, `shipment_order_status`) VALUES
(1, 1, 25, 'Confirm'),
(2, 1, 26, 'Confirm'),
(3, 2, 19, 'Confirm'),
(4, 3, 27, 'Confirm'),
(5, 4, 28, 'Cancel'),
(6, 5, 28, 'Confirm'),
(7, 6, 20, 'Cancel'),
(8, 7, 29, 'Cancel'),
(9, 8, 30, 'Cancel'),
(10, 8, 31, 'Cancel'),
(11, 9, 32, 'Confirm'),
(12, 10, 32, 'Confirm'),
(13, 12, 33, 'Confirm'),
(14, 13, 34, 'Confirm'),
(15, 14, 23, 'Cancel'),
(16, 15, 35, 'Confirm'),
(17, 16, 36, 'Confirm');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(20) NOT NULL,
  `user_lname` varchar(30) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_dob` date NOT NULL,
  `user_nic` varchar(15) NOT NULL,
  `user_image` varchar(80) NOT NULL,
  `user_role` int(11) NOT NULL,
  `user_location` int(11) NOT NULL,
  `user_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_fname`, `user_lname`, `user_email`, `user_dob`, `user_nic`, `user_image`, `user_role`, `user_location`, `user_status`) VALUES
(1, 'Leeshani', 'Sangakkara', 'leeshanisangakkara@gmail.com', '2001-02-28', '200155900608', '1771265637_IMG-20250608-WA0024.jpg', 1, 1, 1),
(2, 'Sandaruwan ', 'Vidureshwara', 'sandaruwanekanayake@gmail.com', '2000-12-10', '200034500126', '1770917401_IMG-20250608-WA0020.jpg', 7, 1, 0),
(4, 'djfbgjhre', 'vdfd', 'gn@fd', '2026-02-05', '200155900607', '', 16, 1, -1),
(5, 'Ashani', 'Sangakkara', 'ashani@gmail.com', '2005-01-19', '200555900608', '1771265581_IMG-20250608-WA0025.jpg', 3, 1, 0),
(6, 'Peter', 'Perera', 'peter@ncjkdsn', '2026-03-05', '201547896301', '1773690653_hills.jpg', 13, 1, 0),
(7, 'bee', 'jdc', 'hd@ekn', '2026-03-04', '896547123014', '', 18, 1, 0),
(9, 'Jonny', 'Dep', 'Jonn@gg', '2026-03-20', '200034500127', '', 4, 1, 0),
(10, 'Dhanushi', 'Silva', 'dhanu@gg', '2026-03-02', '200504932170', '', 18, 1, -1),
(11, 'll', 'ss', 'll@ss', '2026-04-01', '200000000000', '', 16, 1, 1),
(12, 'jeccy', 'white', 'jeccy@cy', '2025-07-01', '700000000000', '', 12, 1, 1),
(13, 'sachini', 'fernando', 'sachi@ni', '2025-09-02', '131301310245', 'Array', 8, 4, 1),
(14, 'sachini ', 'fernando', 'sachi@ni', '2026-01-12', '346346346346', 'Array', 8, 8, 1),
(15, 'ggee', 'gegeg', 'gegae@grgr', '2026-04-22', '200034501126', 'Array', 1, 4, 1),
(16, 'manodya', 'eka', 'mono@gg', '2026-04-14', '199834500126', 'Array', 1, 2, 1),
(18, 'free', 'grrg', 'grg@grg', '2026-04-13', '199745874555', 'Array', 10, 3, 1),
(19, 'eevge', 'vdVSEVSe', 'veve@rbzrbdrb', '2026-04-30', '200155900601', 'Array', 11, 11, 1),
(20, 'fefef', 'fwf', 'fefefe@gge', '2026-04-22', '200034500222', 'Array', 14, 6, 1),
(22, 'tbvjkxdn', 'ncdn', 'dsfn@sdg', '2026-04-07', '939393939394', 'Array', 10, 9, 1),
(23, 'vnbjg', 'bvgbvhg', 'cgfd@bvf', '2026-04-06', '120034500126', '', 10, 15, 1),
(24, 'Kavisha', 'Gamage', 'kavi@sha', '2025-07-16', '200255800907', '', 10, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_contact`
--

CREATE TABLE `user_contact` (
  `contact_id` int(11) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_contact`
--

INSERT INTO `user_contact` (`contact_id`, `contact_number`, `user_id`) VALUES
(3, '0759423618', 3),
(4, '0771943267', 3),
(5, '0774358646', 4),
(6, '0812389075', 4),
(9, '0774358646', 6),
(10, 'fvsdfww', 6),
(11, '0774358646', 7),
(12, 'ncbvhsd', 7),
(13, '0774358646', 8),
(14, 'fty', 8),
(15, '0774358646', 9),
(16, '0774358646', 9),
(19, '0774358646', 11),
(20, '0771071288', 11),
(23, '0774358646', 13),
(24, '0812389075', 13),
(25, '0774358646', 4),
(26, '0812389075', 4),
(55, '0773225148', 5),
(56, '0721549638', 5),
(57, '0774358646', 1),
(58, '0812389075', 1),
(59, '0779126584', 6),
(60, '0731859624', 6),
(61, '0783248571', 7),
(62, '0738967132', 7),
(63, '0716507759', 9),
(64, '0719363602', 9),
(67, '0774358646', 10),
(68, '0771071288', 10),
(69, '0789428291', 2),
(70, '0812389075', 2),
(71, '0704477992', 11),
(72, '0703344997', 11),
(79, '0774358640', 12),
(80, '0248753164', 12),
(81, '0978797879', 13),
(82, '0645464546', 13),
(87, '0768678678', 14),
(88, '0773463463', 14),
(89, '0784584785', 15),
(90, '0756984588', 15),
(91, '0774358646', 16),
(92, '0812389075', 16),
(93, '0774358646', 18),
(94, '0812389075', 18),
(95, '0774358646', 19),
(96, '0812389075', 19),
(97, '0774358646', 20),
(98, '0812389075', 20),
(99, '0774358646', 22),
(100, '0771071288', 22),
(101, '0774358646', 23),
(102, '0771071288', 23),
(103, '0773358646', 24),
(104, '0775071288', 24);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicle_id` int(11) NOT NULL,
  `vehicle_number` varchar(50) NOT NULL,
  `vehicle_type` varchar(50) NOT NULL,
  `vehicle_capacity` decimal(10,0) NOT NULL,
  `vehicle_district` int(11) NOT NULL,
  `vehicle_location` int(11) NOT NULL,
  `vehicle_status` enum('Available','Assigned','Maintenance') NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `vehicle_number`, `vehicle_type`, `vehicle_capacity`, `vehicle_district`, `vehicle_location`, `vehicle_status`) VALUES
(1, 'CAM5011', 'Car', 90, 0, 0, 'Assigned'),
(2, 'BMM2130', 'Lorry', 100, 0, 0, 'Assigned'),
(3, 'BMM2130', 'Lorry', 100, 0, 0, 'Maintenance'),
(4, 'CAD1014', 'Car', 60, 0, 0, 'Maintenance'),
(5, 'BKM1014', 'Truck', 800, 6, 0, 'Assigned'),
(6, 'BKM1014', 'Three-wheeler', 100, 15, 0, 'Assigned'),
(7, 'BKM1014', 'Motor bike', 100, 3, 1, 'Available'),
(8, 'BMM2130', 'Van', 800, 6, 4, 'Available'),
(9, 'CAD1014', 'Lorry', 800, 20, 9, 'Assigned');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `function`
--
ALTER TABLE `function`
  ADD PRIMARY KEY (`function_id`);

--
-- Indexes for table `function_user`
--
ALTER TABLE `function_user`
  ADD PRIMARY KEY (`fun_id`,`user_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `ofd`
--
ALTER TABLE `ofd`
  ADD PRIMARY KEY (`ofd_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item id`);

--
-- Indexes for table `order_logs`
--
ALTER TABLE `order_logs`
  ADD PRIMARY KEY (`order_log_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`province_id`);

--
-- Indexes for table `receiver`
--
ALTER TABLE `receiver`
  ADD PRIMARY KEY (`receiver_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `role_module`
--
ALTER TABLE `role_module`
  ADD PRIMARY KEY (`role_id`,`module_id`);

--
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`shipment_id`);

--
-- Indexes for table `shipment_orders`
--
ALTER TABLE `shipment_orders`
  ADD PRIMARY KEY (`shipment_orders_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_nic` (`user_nic`);

--
-- Indexes for table `user_contact`
--
ALTER TABLE `user_contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `function`
--
ALTER TABLE `function`
  MODIFY `function_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `function_user`
--
ALTER TABLE `function_user`
  MODIFY `fun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ofd`
--
ALTER TABLE `ofd`
  MODIFY `ofd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_logs`
--
ALTER TABLE `order_logs`
  MODIFY `order_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `province_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `receiver`
--
ALTER TABLE `receiver`
  MODIFY `receiver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `role_module`
--
ALTER TABLE `role_module`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `shipment`
--
ALTER TABLE `shipment`
  MODIFY `shipment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `shipment_orders`
--
ALTER TABLE `shipment_orders`
  MODIFY `shipment_orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_contact`
--
ALTER TABLE `user_contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
