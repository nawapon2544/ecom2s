-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2023 at 11:22 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `id` int(11) NOT NULL,
  `province` varchar(250) NOT NULL,
  `sector` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`id`, `province`, `sector`) VALUES
(1, 'เชียงราย ', ''),
(2, 'เชียงใหม่ ', ''),
(3, 'น่าน ', ''),
(4, 'พะเยา ', ''),
(5, 'แพร่ ', ''),
(6, 'แม่ฮ่องสอน ', ''),
(7, 'ลำปาง ', ''),
(8, 'ลำพูน ', ''),
(9, 'อุตรดิตถ์', ''),
(10, 'กาฬสินธุ์ ', ''),
(11, 'ขอนแก่น ', ''),
(12, 'ชัยภูมิ ', ''),
(13, 'นครพนม ', ''),
(14, 'นครราชสีมา ', ''),
(15, 'บึงกาฬ ', ''),
(16, 'บุรีรัมย์ ', ''),
(17, 'มหาสารคาม ', ''),
(18, 'มุกดาหาร ', ''),
(19, 'ยโสธร ', ''),
(20, 'ร้อยเอ็ด ', ''),
(21, 'เลย ', ''),
(22, 'สกลนคร ', ''),
(23, 'สุรินทร์ ', ''),
(24, 'ศรีสะเกษ ', ''),
(25, 'หนองคาย ', ''),
(26, 'หนองบัวลำภู ', ''),
(27, 'อุดรธานี ', ''),
(28, 'อุบลราชธานี ', ''),
(29, 'อำนาจเจริญ', ''),
(30, 'กรุงเทพมหานคร', ''),
(31, 'กำแพงเพชร ', ''),
(32, 'ชัยนาท ', ''),
(33, 'นครนายก ', ''),
(34, 'นครปฐม ', ''),
(35, 'นครสวรรค์ ', ''),
(36, 'นนทบุรี ', ''),
(37, 'ปทุมธานี ', ''),
(38, 'พระนครศรีอยุธยา ', ''),
(39, 'พิจิตร ', ''),
(40, 'พิษณุโลก ', ''),
(41, 'เพชรบูรณ์ ', ''),
(42, 'ลพบุรี ', ''),
(43, 'สมุทรปราการ ', ''),
(44, 'สมุทรสงคราม ', ''),
(45, 'สมุทรสาคร ', ''),
(46, 'สิงห์บุรี ', ''),
(47, 'สุโขทัย ', ''),
(48, 'สุพรรณบุรี ', ''),
(49, 'สระบุรี ', ''),
(50, 'อ่างทอง ', ''),
(51, 'อุทัยธานี ', ''),
(52, 'จันทบุรี ', ''),
(53, 'ฉะเชิงเทรา ', ''),
(54, 'ชลบุรี ', ''),
(55, 'ตราด ', ''),
(56, 'ปราจีนบุรี ', ''),
(57, 'ระยอง ', ''),
(58, 'สระแก้ว', ''),
(59, 'กาญจนบุรี ', ''),
(60, 'ตาก ', ''),
(61, 'ประจวบคีรีขันธ์ ', ''),
(62, 'เพชรบุรี ', ''),
(63, 'ราชบุรี ', ''),
(64, 'กระบี่ ', ''),
(65, 'ชุมพร ', ''),
(66, 'ตรัง ', ''),
(67, 'นครศรีธรรมราช ', ''),
(68, 'นราธิวาส ', ''),
(69, 'ปัตตานี ', ''),
(70, 'พังงา ', ''),
(71, 'พัทลุง ', ''),
(72, 'ภูเก็ต ', ''),
(73, 'ระนอง ', ''),
(74, 'สตูล ', ''),
(75, 'สงขลา ', ''),
(76, 'สุราษฎร์ธานี ', ''),
(77, 'ยะลา ', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
