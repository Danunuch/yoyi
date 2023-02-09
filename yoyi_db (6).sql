-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2023 at 11:33 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yoyi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(10) NOT NULL,
  `content` longtext NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `content`, `img`) VALUES
(1, '<p><span style=\"color: rgb(107, 107, 107);\">ปรัชญาการดำเนินธุรกิจของ Yo Yi Foods Co, Ltd. คือการสร้างภาพลักษณ์ที่ดีและผลิตภัณฑ์คุณภาพสูง ยึดมั่นในสุขอนามัยของอาหารและความปลอดภัยของอาหารของผู้บริโภค</span></p>\n<p><span style=\"color: rgb(107, 107, 107);\">บริษัทได้รับใบรับรองสากล HACCP, ISO22000, HALAL และยังคงได้รับใบรับรองอาหารเกี่ยวกับคุณภาพอาหารอีกมากมายอย่างต่อเนื่อง เป้าหมายของเราคือการพยายามปรับปรุงและควบคุมคุณภาพและของผลิตภัณฑ์ เติบโตและก้าวหน้าไปพร้อมกับลูกค้า เพื่อให้ผู้บริโภคได้รับสินค้าที่ปลอดภัย ถูกสุขลักษณะ ดีต่อสุขภาพ และรสชาติอร่อยอีกด้วย</span></p>\n<p><span style=\"color: rgb(107, 107, 107);\">บริษัทปฏิบัติตามแนวคิดการควบคุมคุณภาพ 5 ประการ เลือกใช้วัตถุดิบอย่างพิถีพิถัน เลือกใช้วัสดุบรรจุภัณฑ์ที่มีคุณภาพ ทำการทดสอบชิมสินค้าเป็นประจำ และตรวจสอบผลิตภัณฑ์เป็นประจำ</span></p>', '1330252563.webp');

-- --------------------------------------------------------

--
-- Table structure for table `about_en`
--

CREATE TABLE `about_en` (
  `id` int(10) NOT NULL,
  `content` longtext NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `about_en`
--

INSERT INTO `about_en` (`id`, `content`, `img`) VALUES
(1, '<p><span style=\"color: rgb(107, 107, 107);\">The business philosophy of Yo Yi Foods Co, Ltd. is to build a good image and high quality products. Adhere to food hygiene and food safety for consumers.</span></p>\r\n<p><span style=\"color: rgb(107, 107, 107);\">The company has received international certificates HACCP, ISO22000, HALAL and continues to receive many food certificates regarding food quality. Our goal is to strive to improve and control the quality and of our products. Grow and advance with customers so that consumers receive products that are safe, hygienic, good for health and delicious as well</span></p>\r\n<p><span style=\"color: rgb(107, 107, 107);\">The company adheres to the concept of 5 quality control, carefully selects raw materials. Choose quality packaging materials. Conduct product tastings on a regular basis. and inspect products regularly.</span></p>', '406616672.webp');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `created_at`, `firstname`, `lastname`) VALUES
(1, 'Adminwebsite', '$2y$10$cgrZ4R3I/a6tZkDsZYztTOdNxuEyHNClgn/FOYmlHte5zGdkb/Bpm', '2023-02-01 18:26:50', 'Yoyi', 'SYSTEM');

-- --------------------------------------------------------

--
-- Table structure for table `catalog_cook`
--

CREATE TABLE `catalog_cook` (
  `id` int(10) NOT NULL,
  `catalog_name` varchar(255) NOT NULL,
  `type_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `catalog_cook`
--

INSERT INTO `catalog_cook` (`id`, `catalog_name`, `type_id`) VALUES
(7, 'ชานมไข่มุก', '5'),
(8, 'ไอศกรีมชาไข่มุก', '5'),
(9, 'ชาไข่มุกอัลมอนด์นัท', '5'),
(10, 'เม็ดไข่มุก', '4');

-- --------------------------------------------------------

--
-- Table structure for table `catalog_cook_en`
--

CREATE TABLE `catalog_cook_en` (
  `id` int(10) NOT NULL,
  `catalog_name` varchar(255) NOT NULL,
  `type_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `catalog_cook_en`
--

INSERT INTO `catalog_cook_en` (`id`, `catalog_name`, `type_id`) VALUES
(8, 'Bubble Milk Tea', '4'),
(9, 'Bubble Tea Ice Cream', '4'),
(10, 'Almond Nut Bubble Tea', '4'),
(11, 'Pearl', '3');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `instragram` varchar(255) NOT NULL,
  `line` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `tel`, `address`, `email`, `img`, `instragram`, `line`, `facebook`) VALUES
(1, '035-355867-69', '99 หมู่ 1 ตำบลบ้านฉางอำเภออุทัย พระนครศรีอยุธยา 13210', 'sales.yoyifoods@gmail.com', '1105371544.webp', 'https://www.instagram.com/', 'https://line.me/R/ti/p/@436gwlqr', 'https://th-th.facebook.com/');

-- --------------------------------------------------------

--
-- Table structure for table `contact_en`
--

CREATE TABLE `contact_en` (
  `id` int(11) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `instragram` varchar(255) NOT NULL,
  `line` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `contact_en`
--

INSERT INTO `contact_en` (`id`, `tel`, `address`, `email`, `img`, `instragram`, `line`, `facebook`) VALUES
(1, '035-355867-69', '99 Moo 1 Ban Chang SubdistrictUthai District, Phra Nakhon Si Ayutthaya 13210', 'sales.yoyifoods@gmail.com', '1203519042.webp', 'https://www.instagram.com/', 'https://line.me/R/ti/p/@436gwlqr', 'https://th-th.facebook.com/');

-- --------------------------------------------------------

--
-- Table structure for table `cook_detail`
--

CREATE TABLE `cook_detail` (
  `detail_id` int(10) NOT NULL,
  `img_cover` varchar(255) NOT NULL,
  `detail_name` longtext NOT NULL,
  `content1` longtext DEFAULT NULL,
  `content2` longtext DEFAULT NULL,
  `content3` longtext DEFAULT NULL,
  `content4` longtext DEFAULT NULL,
  `content5` longtext DEFAULT NULL,
  `content6` longtext DEFAULT NULL,
  `content7` longtext DEFAULT NULL,
  `content8` longtext DEFAULT NULL,
  `content9` longtext DEFAULT NULL,
  `content10` longtext DEFAULT NULL,
  `type_id` varchar(255) DEFAULT NULL,
  `id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cook_detail`
--

INSERT INTO `cook_detail` (`detail_id`, `img_cover`, `detail_name`, `content1`, `content2`, `content3`, `content4`, `content5`, `content6`, `content7`, `content8`, `content9`, `content10`, `type_id`, `id`) VALUES
(12, '288907135.webp', '<p><span style=\"font-size: 18pt; color: rgb(230, 126, 35);\">ชานมไข่มุก</span></p>', 'ส่วนผสม: ครีมสดสำหรับสัตว์ 200 มล. นม 300 มล. ชาดำ 2 ซอง น้ำตาล 70 กรัม ผงปรุงแช่แข็ง 5Q', 'อุ่นนมจนเดือดแล้วเปลี่ยนเป็นไฟอ่อน จากนั้นใส่น้ำตาลลงไปคนให้ละลาย', '', '', '', '', '', '', '', '', '5', '7'),
(13, '2108901648.webp', '<p><span style=\"font-size: 18pt; color: rgb(230, 126, 35);\">ไอศกรีมชาไข่มุก</span></p>', 'ส่วนผสม: ครีมสดสำหรับสัตว์ 200 มล. นม 300 มล. ชาดำ 2 ซอง น้ำตาล 70 กรัม ผงปรุงแช่แข็ง 5Q', 'อุ่นนมจนเดือดแล้วเปลี่ยนเป็นไฟอ่อน จากนั้นใส่น้ำตาลลงไปคนให้ละลาย', 'ใส่ถุงชาลงไป คนให้เข้ากัน ปิดไฟและเคี่ยวต่ออีก 10 นาที', 'หลังจากตุ๋นเสร็จ นำถุงชาออก เติมครีมสดและคนให้เข้ากัน', '', '', '', '', '', '', '5', '8'),
(14, '1158859055.webp', '<p><span style=\"font-size: 18pt; color: rgb(230, 126, 35);\">ชาไข่มุกอัลมอนด์นัท</span></p>', 'ส่วนผสม: ครีมสดสำหรับสัตว์ 200 มล. นม 300 มล. ชาดำ 2 ซอง น้ำตาล 70 กรัม ผงปรุงแช่แข็ง 5Q', 'อุ่นนมจนเดือดแล้วเปลี่ยนเป็นไฟอ่อน จากนั้นใส่น้ำตาลลงไปคนให้ละลาย', 'ใส่ถุงชาลงไป คนให้เข้ากัน ปิดไฟและเคี่ยวต่ออีก 10 นาที', 'หลังจากตุ๋นเสร็จ นำถุงชาออก เติมครีมสดและคนให้เข้ากัน', 'เทใส่ภาชนะแล้วปล่อยให้เย็นแช่แข็งประมาณ 4-6 ชั่วโมง', 'ตักไอศกรีมแช่แข็งใส่ถ้วย โรยผงไข่มุก เป็นอันเสร็จ!', '', '', '', '', '5', '9'),
(15, '1198510218.webp', '<p><span style=\"font-size: 18pt; color: rgb(230, 126, 35);\">เม็ดไข่มุก</span></p>', 'ส่วนผสม: ครีมสดสำหรับสัตว์ 200 มล. นม 300 มล. ชาดำ 2 ซอง น้ำตาล 70 กรัม ผงปรุงแช่แข็ง 5Q', 'อุ่นนมจนเดือดแล้วเปลี่ยนเป็นไฟอ่อน จากนั้นใส่น้ำตาลลงไปคนให้ละลาย', 'ใส่ถุงชาลงไป คนให้เข้ากัน ปิดไฟและเคี่ยวต่ออีก 10 นาที', 'หลังจากตุ๋นเสร็จ นำถุงชาออก เติมครีมสดและคนให้เข้ากัน', '', '', '', '', '', '', '4', '10');

-- --------------------------------------------------------

--
-- Table structure for table `cook_detail_en`
--

CREATE TABLE `cook_detail_en` (
  `detail_id` int(10) NOT NULL,
  `img_cover` varchar(255) NOT NULL,
  `detail_name` longtext NOT NULL,
  `content1` longtext DEFAULT NULL,
  `content2` longtext DEFAULT NULL,
  `content3` longtext DEFAULT NULL,
  `content4` longtext DEFAULT NULL,
  `content5` longtext DEFAULT NULL,
  `content6` longtext DEFAULT NULL,
  `content7` longtext DEFAULT NULL,
  `content8` longtext DEFAULT NULL,
  `content9` longtext DEFAULT NULL,
  `content10` longtext DEFAULT NULL,
  `type_id` varchar(255) DEFAULT NULL,
  `id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cook_detail_en`
--

INSERT INTO `cook_detail_en` (`detail_id`, `img_cover`, `detail_name`, `content1`, `content2`, `content3`, `content4`, `content5`, `content6`, `content7`, `content8`, `content9`, `content10`, `type_id`, `id`) VALUES
(7, '1760808022.webp', '<p><span style=\"font-size: 18pt; color: rgb(230, 126, 35);\">Bubble Milk Tea</span></p>', 'Ingredients: 200 ml fresh cream for animals, 300 ml milk, 2 sachets of black tea, 70 g sugar, 5Q frozen seasoning.', 'Heat the milk to a boil and turn it over low heat. Then add sugar and stir to dissolve.', 'Add the tea bags, stir well, turn off the heat and simmer for another 10 minutes.', '', '', '', '', '', '', '', '4', '8'),
(8, '1092037004.webp', '<p><span style=\"color: rgb(230, 126, 35); font-size: 18pt;\">Bubble Tea Ice Cream</span></p>', 'Ingredients: 200 ml fresh cream for animals, 300 ml milk, 2 sachets of black tea, 70 g sugar, 5Q frozen seasoning.', 'Heat the milk to a boil and turn it over low heat. Then add sugar and stir to dissolve.', 'Add the tea bags, stir well, turn off the heat and simmer for another 10 minutes.', 'After simmering, remove the tea bags, add fresh cream and stir well.', '', '', '', '', '', '', '4', '9'),
(9, '1978658537.webp', '<p><span style=\"font-size: 18pt; color: rgb(230, 126, 35);\">Almond Nut Bubble Tea</span></p>', 'Ingredients: 200 ml fresh cream for animals, 300 ml milk, 2 sachets of black tea, 70 g sugar, 5Q frozen seasoning.', 'Heat the milk to a boil and turn it over low heat. Then add sugar and stir to dissolve.', 'Add the tea bags, stir well, turn off the heat and simmer for another 10 minutes.', 'Scoop frozen ice cream into a cup, sprinkle with pearl powder, and you\'re done!', 'Pour into a container and let it cool for 4-6 hours.', 'Return the 5Q frozen cooked noodles to the temperature according to the previous cooking method.', 'Scoop frozen ice cream into a cup, sprinkle with pearl powder, and you\'re done!', '', '', '', '4', '10'),
(10, '1131223415.webp', '<p><span style=\"font-size: 18pt; color: rgb(230, 126, 35);\">Pearl</span></p>', 'Ingredients: 200 ml fresh cream for animals, 300 ml milk, 2 sachets of black tea, 70 g sugar, 5Q frozen seasoning.', 'Heat the milk to a boil and turn it over low heat. Then add sugar and stir to dissolve.', '', '', '', '', '', '', '', '', '3', '11');

-- --------------------------------------------------------

--
-- Table structure for table `cook_detail_img`
--

CREATE TABLE `cook_detail_img` (
  `id_cook` int(10) NOT NULL,
  `img` varchar(255) NOT NULL,
  `id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cook_detail_img`
--

INSERT INTO `cook_detail_img` (`id_cook`, `img`, `id`) VALUES
(50, '1126453789.webp', '7'),
(51, '912527970.webp', '7'),
(52, '1254663806.webp', '7'),
(53, '1861090219.webp', '8'),
(54, '994733928.webp', '8'),
(55, '477731416.webp', '8'),
(56, '822972703.webp', '9'),
(57, '994233023.webp', '9'),
(58, '626814030.webp', '9'),
(62, '1298053118.webp', '10'),
(63, '687829425.webp', '10'),
(64, '1633835734.webp', '10');

-- --------------------------------------------------------

--
-- Table structure for table `cook_detail_img_en`
--

CREATE TABLE `cook_detail_img_en` (
  `id_cook` int(10) NOT NULL,
  `img` varchar(255) NOT NULL,
  `id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cook_detail_img_en`
--

INSERT INTO `cook_detail_img_en` (`id_cook`, `img`, `id`) VALUES
(50, '2055636872.webp', '9'),
(51, '713443515.webp', '9'),
(52, '1847312178.webp', '9'),
(53, '1755616308.webp', '8'),
(54, '2013656955.webp', '8'),
(55, '1851232497.webp', '8'),
(59, '1778346608.webp', '10'),
(60, '1137931991.webp', '10'),
(61, '1594948472.webp', '10'),
(62, '640944291.webp', '11'),
(63, '2143579045.webp', '11'),
(64, '2050157858.webp', '11');

-- --------------------------------------------------------

--
-- Table structure for table `intro_content`
--

CREATE TABLE `intro_content` (
  `id` int(10) NOT NULL,
  `intro` longtext NOT NULL,
  `topic` longtext NOT NULL,
  `content1` longtext NOT NULL,
  `content2` longtext NOT NULL,
  `content3` longtext NOT NULL,
  `content4` longtext NOT NULL,
  `img_cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `intro_content`
--

INSERT INTO `intro_content` (`id`, `intro`, `topic`, `content1`, `content2`, `content3`, `content4`, `img_cover`) VALUES
(1, '<h1><span class=\"text-warning\" style=\"color: rgb(230, 126, 35);\">Yo Yi</span>&nbsp;<span style=\"color: rgb(82, 34, 6);\">Foods Co., Ltd.</span></h1>\r\n<p><span style=\"color: rgb(172, 92, 55);\">เราเชี่ยวชาญในการผลิตจากธรรมชาติเพื่อสุขภาพที่ดี</span><br><span style=\"color: rgb(172, 92, 55);\">และมันสำปะหลังไข่มุกแสนอร่อย</span><br><span style=\"color: rgb(172, 92, 55);\">Yo Yi Foods มีความเชี่ยวชาญในการผลิตจากธรรมชาติ</span><br><span style=\"color: rgb(172, 92, 55);\">ไข่มุกมันสำปะหลังที่ดีต่อสุขภาพและอร่อย</span></p>', '<p><span style=\"font-size: 18pt;\"><strong><span style=\"color: rgb(230, 126, 35);\">ปรัชญา </span><span style=\"color: rgb(82, 34, 6);\">ของเรา</span></strong></span></p>', '<p><span style=\"color: rgb(107, 107, 107);\">มุ่งพัฒนาแบรนด์ที่เหนือกว่าและ</span><br><span style=\"color: rgb(107, 107, 107);\">ติดตามคุณภาพสูงสุด</span></p>', '<p><span style=\"color: rgb(107, 107, 107);\">สร้างความตระหนักเกี่ยวกับความปลอดภัยของอาหาร</span><br><span style=\"color: rgb(107, 107, 107);\">และสุขอนามัยให้กับลูกค้าของเราทุกคน</span></p>', '<p><span style=\"color: rgb(107, 107, 107);\">จัดหาจากธรรมชาติ ปลอดภัย ดีต่อสุขภาพและ</span><br><span style=\"color: rgb(107, 107, 107);\">ผลิตภัณฑ์มันสำปะหลังแสนอร่อย</span></p>', '<p><span style=\"color: rgb(172, 92, 55);\">เราได้รับการรับรองมาตรฐาน ISO 22000, HACCP, GHP และ HALAL</span><br><span style=\"color: rgb(172, 92, 55);\">ซึ่งพิสูจน์คุณภาพและความสม่ำเสมอของผลิตภัณฑ์ของเรา</span></p>', '1390004705.webp');

-- --------------------------------------------------------

--
-- Table structure for table `intro_content_en`
--

CREATE TABLE `intro_content_en` (
  `id` int(10) NOT NULL,
  `intro` longtext NOT NULL,
  `topic` longtext NOT NULL,
  `content1` longtext NOT NULL,
  `content2` longtext NOT NULL,
  `content3` longtext NOT NULL,
  `content4` longtext NOT NULL,
  `img_cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `intro_content_en`
--

INSERT INTO `intro_content_en` (`id`, `intro`, `topic`, `content1`, `content2`, `content3`, `content4`, `img_cover`) VALUES
(1, '<div class=\"mb-5 text-center text-md-end\">\r\n<h1><span style=\"color: rgb(230, 126, 35);\"><span class=\"text-warning\">Yo Yi</span>&nbsp;<span style=\"color: rgb(82, 34, 6);\">Foods Co., Ltd.</span></span></h1>\r\n</div>\r\n<p class=\"text-info\"><span style=\"color: rgb(172, 92, 55);\">Our specialized in the production of natural , healthy</span><br><span style=\"color: rgb(172, 92, 55);\">and delicious tapioca pearls.</span><br><span style=\"color: rgb(172, 92, 55);\">Yo Yi Foods is specialized in the production of natural</span><br><span style=\"color: rgb(172, 92, 55);\">healthy and delicious tapioca pearls.</span></p>', '<p><span style=\"font-size: 18pt;\"><strong><span style=\"color: rgb(230, 126, 35);\">Our </span><span style=\"color: rgb(82, 34, 6);\">Philosophy</span></strong></span></p>', '<p><span style=\"color: rgb(107, 107, 107);\">Aim to develop a superior brand and</span><br><span style=\"color: rgb(107, 107, 107);\">pursue the highest quality.</span></p>', '<p><span style=\"color: rgb(107, 107, 107);\">Raise awareness about food safety</span><br><span style=\"color: rgb(107, 107, 107);\">and hygiene for all our customers.</span></p>', '<p><span style=\"color: rgb(107, 107, 107);\">Supply natural , safe , healthy and</span><br><span style=\"color: rgb(107, 107, 107);\">delicious tapioca products.</span></p>', '<p><span style=\"color: rgb(172, 92, 55);\">We are ISO 22000, HACCP, GHP and HALAL certificated, Which proves the high </span><br><span style=\"color: rgb(172, 92, 55);\">quality and consistency of our products.</span></p>', '396421565.webp');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id_news` int(10) NOT NULL,
  `img_cover` varchar(255) NOT NULL,
  `title` longtext NOT NULL,
  `content` longtext NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id_news`, `img_cover`, `title`, `content`, `status`) VALUES
(1, '1286231442.webp', '<h4>การเรียนรู้คือวิธีปลูกฝังการปรับปรุงอย่างต่อเนื่องซึ่งเป็นหัวใจสำคัญขององค์กร</h4>', '<p><span style=\"color: rgb(107, 107, 107);\">ทางบริษัทของเราจึงได้มีการจัดอบรมระบบมาตรฐาน FSSC 22000 ระบบการจัดการความปลอดภัยของอาหาร (FSMS) ให้กับพนักงานในองค์กรของเรา ซึ่งถือเป็นการเพิ่มเติมความรู้ เพิ่มความสำคัญในการปรับปรุงประสิทธิภาพด้านความปลอดภัยของอาหารของเราให้เพิ่มมากขึ้น เพื่อประสิทธิภาพในการทำงาน สินค้า แล้วพนักงานของเราอีกด้วย</span></p>\r\n<p>&nbsp;</p>', 'on'),
(3, '2145099548.webp', '<h4>การเรียนรู้คือวิธีปลูกฝังการปรับปรุงอย่างต่อเนื่องซึ่งเป็นหัวใจสำคัญขององค์กร</h4>', '<p><span style=\"color: rgb(107, 107, 107); font-family: arial, helvetica, sans-serif;\">ทางบริษัทของเราจึงได้มีการจัดอบรมระบบมาตรฐาน FSSC 22000 ระบบการจัดการความปลอดภัยของอาหาร (FSMS) ให้กับพนักงานในองค์กรของเรา ซึ่งถือเป็นการเพิ่มเติมความรู้ เพิ่มความสำคัญในการปรับปรุงประสิทธิภาพด้านความปลอดภัยของอาหารของเราให้เพิ่มมากขึ้น เพื่อประสิทธิภาพในการทำงาน สินค้า แล้วพนักงานของเราอีกด้วย</span></p>\r\n<p>&nbsp;</p>', 'on'),
(4, '273746695.webp', '<h4>การเรียนรู้คือวิธีปลูกฝังการปรับปรุงอย่างต่อเนื่องซึ่งเป็นหัวใจสำคัญขององค์กร</h4>', '<p><span style=\"color: rgb(107, 107, 107); font-family: arial, helvetica, sans-serif;\">ทางบริษัทของเราจึงได้มีการจัดอบรมระบบมาตรฐาน FSSC 22000 ระบบการจัดการความปลอดภัยของอาหาร (FSMS) ให้กับพนักงานในองค์กรของเรา ซึ่งถือเป็นการเพิ่มเติมความรู้ เพิ่มความสำคัญในการปรับปรุงประสิทธิภาพด้านความปลอดภัยของอาหารของเราให้เพิ่มมากขึ้น เพื่อประสิทธิภาพในการทำงาน สินค้า แล้วพนักงานของเราอีกด้วย</span></p>\r\n<p>&nbsp;</p>', 'on'),
(8, '1151142669.webp', '<h4>การเรียนรู้คือวิธีปลูกฝังการปรับปรุงอย่างต่อเนื่องซึ่งเป็นหัวใจสำคัญขององค์กร</h4>', '<p><span style=\"color: rgb(107, 107, 107);\">ทางบริษัทของเราจึงได้มีการจัดอบรมระบบมาตรฐาน FSSC 22000 ระบบการจัดการความปลอดภัยของอาหาร (FSMS) ให้กับพนักงานในองค์กรของเรา ซึ่งถือเป็นการเพิ่มเติมความรู้ เพิ่มความสำคัญในการปรับปรุงประสิทธิภาพด้านความปลอดภัยของอาหารของเราให้เพิ่มมากขึ้น เพื่อประสิทธิภาพในการทำงาน สินค้า แล้วพนักงานของเราอีกด้วย</span></p>', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `news_en`
--

CREATE TABLE `news_en` (
  `id_news` int(10) NOT NULL,
  `img_cover` varchar(255) NOT NULL,
  `title` longtext NOT NULL,
  `content` longtext NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `news_en`
--

INSERT INTO `news_en` (`id_news`, `img_cover`, `title`, `content`, `status`) VALUES
(1, '1286231442.webp', '<h4><span style=\"color: rgb(0, 0, 0);\">Learning is a way of cultivating continuous improvement at the heart of an organization.</span></h4>', '<p><span style=\"color: rgb(107, 107, 107);\">Our company therefore has organized a training system standard FSSC 22000 Food Safety Management System (FSMS) for employees in our organization. which is considered to increase knowledge Increasingly the importance of improving our food safety performance. For the efficiency of work, products and our employees as well.</span></p>', 'on'),
(3, '2145099548.webp', '<h4><span style=\"color: rgb(0, 0, 0);\">Learning is a way of cultivating continuous improvement at the heart of an organization.</span></h4>', '<p><span style=\"color: rgb(107, 107, 107);\">Our company therefore has organized a training system standard FSSC 22000 Food Safety Management System (FSMS) for employees in our organization. which is considered to increase knowledge Increasingly the importance of improving our food safety performance. For the efficiency of work, products and our employees as well.</span></p>', 'on'),
(4, '1936523809.webp', '<h4><span style=\"color: rgb(0, 0, 0);\">Learning is a way of cultivating continuous improvement at the heart of an organization.</span></h4>', '<p><span style=\"color: rgb(107, 107, 107);\">Our company therefore has organized a training system standard FSSC 22000 Food Safety Management System (FSMS) for employees in our organization. which is considered to increase knowledge Increasingly the importance of improving our food safety performance. For the efficiency of work, products and our employees as well.</span></p>', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `news_img`
--

CREATE TABLE `news_img` (
  `id` int(10) NOT NULL,
  `img` varchar(255) NOT NULL,
  `id_news` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `news_img`
--

INSERT INTO `news_img` (`id`, `img`, `id_news`) VALUES
(19, '581040691.webp', '8'),
(20, '1916907908.webp', '8'),
(21, '797338449.webp', '8'),
(22, '1633930765.webp', '4'),
(23, '1812086024.webp', '4'),
(24, '1873317794.webp', '3'),
(25, '1817503463.webp', '3'),
(26, '1048047650.webp', '3'),
(27, '1872629879.webp', '1'),
(28, '1871455869.webp', '1');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(10) NOT NULL,
  `img_cover` varchar(255) NOT NULL,
  `product_name` longtext NOT NULL,
  `content` longtext NOT NULL,
  `detail` longtext NOT NULL,
  `link_video` varchar(255) NOT NULL,
  `link_catalog` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `img_cover`, `product_name`, `content`, `detail`, `link_video`, `link_catalog`, `status`) VALUES
(1, '1506442994.webp', '<h4><span style=\"font-size: 14pt; color: rgb(255, 255, 255);\">เม็ดไข่มุกสีดำ</span></h4>', '<p><span style=\"color: rgb(0, 0, 0);\">เม็ดไข่มุกสีดำ</span><span style=\"color: rgb(107, 107, 107);\"><br>สามารถพบเห็นได้ทั่วไปตามร้านชานมไข่มุก ซึ่งเป็นสีที่หาทานง่ายที่สุด และคนไทยคุ้นเคยเป็นอย่างมาก รสชาติ รสสัมผัสคิดค้นสูตรต้นตำหรับจากจากไต้หวัน 100 % กลิ่นหอมบราวน์ชูการ์ที่เป็นเอกลักษณ์ ความนุ่มหนึบของเม็ดไข่มุก อีกทั้งวัตถุดิบที่นำมาใช้เป็นส่วนประกอบส่วนใหญ่เป็นวัตถุดิบอย่างดีที่นำเข้าจากต่างประเทศทั้งสิ้น ทางบริษัทของเรายังสามารถคิดค้นสูตร ปรับปรุงสูตร ตามที่ลูกค้าต้องการและพึงพอใจได้อีกด้วย</span></p>', '<p><span style=\"color: rgb(107, 107, 107);\">สามารถพบเห็นได้ทั่วไปตามร้านชานมไข่มุก ซึ่งเป็นสีที่หาทานง่ายที่สุด และคนไทยคุ้นเคยเป็นอย่างมาก รสชาติ รสสัมผัสคิดค้นสูตรต้นตำหรับจากจากไต้หวัน 100 % กลิ่นหอมบราวน์ชูการ์ที่เป็นเอกลักษณ์ ความนุ่มหนึบของเม็ดไข่มุก อีกทั้งวัตถุดิบที่นำมาใช้เป็นส่วนประกอบส่วนใหญ่เป็นวัตถุดิบอย่างดีที่นำเข้าจากต่างประเทศทั้งสิ้น ทางบริษัทของเรายังสามารถคิดค้นสูตร ปรับปรุงสูตร ตามที่ลูกค้าต้องการและพึงพอใจได้อีกด้วย</span></p>', 'https://youtu.be/Dr6JVIs6hgc', 'http://localhost:8080/yoyi/upload/pdf.pdf', 'on'),
(2, '611941926.webp', '<h4><span style=\"font-size: 14pt; color: rgb(255, 255, 255);\">เม็ดไข่มุกสีทอง</span></h4>', '<p><span style=\"color: rgb(0, 0, 0);\">เม็ดไข่มุกสีขาว</span><span style=\"color: rgb(107, 107, 107);\"><br>หากพูดถึงความแตกต่างกันระหว่าง ได้มุกสีดำกับสีทอง นอกจากสีที่ต่างกันนั้นคือ รสชาติ รสสัมผัส และยังมีกลิ่นหอมคาราเมลที่หอมอย่างชัดเจนโดยสูตรเฉพาะของบริษัทเรา สีเหลืองทองสวยงามน่ารับประทาน และเช่นเดียวกันวัตถุดิบที่นำมาใช้เป็นส่วนประกอบส่วนใหญ่เป็นวัตถุดิบที่บริษัทของเราคัดสรรอย่างดีเพื่อคุณภาพของลูกค้าโดยเฉพาะ</span></p>\r\n<p><span style=\"color: rgb(107, 107, 107);\">ทางบริษัทของเรายังสามารถคิดค้นสูตร ปรับปรุงสูตร ตามที่ลูกค้าต้องการและพึงพอใจได้อีกด้วย</span></p>', '<p><span style=\"color: rgb(107, 107, 107);\">หากพูดถึงความแตกต่างกันระหว่าง ได้มุกสีดำกับสีทอง นอกจากสีที่ต่างกันนั้นคือ รสชาติ รสสัมผัส และยังมีกลิ่นหอมคาราเมลที่หอมอย่างชัดเจนโดยสูตรเฉพาะของบริษัทเรา สีเหลืองทองสวยงามน่ารับประทาน และเช่นเดียวกันวัตถุดิบที่นำมาใช้เป็นส่วนประกอบส่วนใหญ่เป็นวัตถุดิบที่บริษัทของเราคัดสรรอย่างดีเพื่อคุณภาพของลูกค้าโดยเฉพาะ</span></p>\r\n<p><span style=\"color: rgb(107, 107, 107);\">ทางบริษัทของเรายังสามารถคิดค้นสูตร ปรับปรุงสูตร ตามที่ลูกค้าต้องการและพึงพอใจได้อีกด้วย</span></p>', 'https://youtu.be/Dr6JVIs6hgc', 'http://localhost:8080/yoyi/upload/pdf.pdf', 'on'),
(3, '1301452038.webp', '<h4><span style=\"font-size: 14pt; color: rgb(255, 255, 255);\">เม็ดไข่มุกสีขาว</span></h4>', '<p><span style=\"color: rgb(0, 0, 0);\">เม็ดไข่มุกสีขาว</span><span style=\"color: rgb(107, 107, 107);\"><span style=\"color: rgb(0, 0, 0); font-size: 14pt;\"><strong><br></strong></span>ไข่มุกสีขาวเป็นสูตรที่ทางบริษัทคิดค้นขึ้นมาเพื่อตอบรับความต้องการของลูกค้า จะมีสีกลิ่นหอม และรสชาติที่เป็นแป้งแบบออริจินอท์ ให้สัมผัสที่นุ่มหนึบ เคี้ยวสนุก น่ารับประทานไม่แพ้สีดำและสีทอง เม็ดแป้งสีขาวนวลเหมือนไข่มุก วัตถุดิบที่นำมาใช้เป็นส่วนประกอบส่วนใหญ่เป็นวัตถุดิบที่บริษัทของเราคัดสรรอย่างดี เพื่อให้สินค้าของเราออกมามีคุณภาพและคุ้มค่าต่อความต้องการของลูกค้า</span></p>\r\n<p><span style=\"color: rgb(107, 107, 107);\">ทางบริษัทของเรายังสามารถคิดค้นสูตร ปรับปรุงสูตร ตามที่ลูกค้าต้องการและพึงพอใจได้อีกด้วย</span></p>', '<p><span style=\"color: rgb(107, 107, 107);\">ไข่มุกสีขาวเป็นสูตรที่ทางบริษัทคิดค้นขึ้นมาเพื่อตอบรับความต้องการของลูกค้า จะมีสีกลิ่นหอม และรสชาติที่เป็นแป้งแบบออริจินอท์ ให้สัมผัสที่นุ่มหนึบ เคี้ยวสนุก น่ารับประทานไม่แพ้สีดำและสีทอง เม็ดแป้งสีขาวนวลเหมือนไข่มุก วัตถุดิบที่นำมาใช้เป็นส่วนประกอบส่วนใหญ่เป็นวัตถุดิบที่บริษัทของเราคัดสรรอย่างดี เพื่อให้สินค้าของเราออกมามีคุณภาพและคุ้มค่าต่อความต้องการของลูกค้า</span></p>\r\n<p><span style=\"color: rgb(107, 107, 107);\">ทางบริษัทของเรายังสามารถคิดค้นสูตร ปรับปรุงสูตร ตามที่ลูกค้าต้องการและพึงพอใจได้อีกด้วย</span></p>\r\n<p>&nbsp;</p>', 'https://youtu.be/Dr6JVIs6hgc', 'http://localhost:8080/yoyi/upload/pdf.pdf', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `product_en`
--

CREATE TABLE `product_en` (
  `id_product` int(10) NOT NULL,
  `img_cover` varchar(255) NOT NULL,
  `product_name` longtext NOT NULL,
  `content` longtext NOT NULL,
  `detail` longtext NOT NULL,
  `link_video` varchar(255) NOT NULL,
  `link_catalog` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product_en`
--

INSERT INTO `product_en` (`id_product`, `img_cover`, `product_name`, `content`, `detail`, `link_video`, `link_catalog`, `status`) VALUES
(1, '118142935.webp', '<h4><span style=\"font-size: 14pt; color: rgb(255, 255, 255);\">Black Pearl</span></h4>', '<p><span style=\"color: rgb(0, 0, 0);\">Bubble tea</span><span style=\"font-size: 14pt; color: rgb(0, 0, 0);\"><strong> <br></strong></span><span style=\"color: rgb(107, 107, 107);\">Can be found everywhere in bubble tea shops. which is the easiest color to find And Thai people are very familiar with the taste, the texture, invented the original recipe from 100% Taiwan, the unique aroma of brown sugar. the softness of pearls In addition, most of the raw materials used as components are good quality materials that are all imported from foreign countries. Our company can also invent formulas, improve formulas according to customer needs and satisfaction as well.</span></p>', '<p><span style=\"color: rgb(107, 107, 107);\">Can be found everywhere in bubble tea shops. which is the easiest color to find And Thai people are very familiar with the taste, the texture, invented the original recipe from 100% Taiwan, the unique aroma of brown sugar. the softness of pearls In addition, most of the raw materials used as components are good quality materials that are all imported from foreign countries. Our company can also invent formulas, improve formulas according to customer needs and satisfaction as well.</span></p>', 'https://youtu.be/Dr6JVIs6hgc', 'http://localhost:8080/yoyi/upload/pdf.pdf', 'on'),
(2, '1575897270.webp', '<h4><span style=\"color: rgb(255, 255, 255);\">Golden pearls</span></h4>', '<p><span style=\"color: rgb(0, 0, 0);\">Pearl Black</span><span style=\"color: rgb(107, 107, 107);\"><span style=\"font-size: 14pt; color: rgb(0, 0, 0);\"><strong><br></strong></span>If talking about the difference between Got black and gold pearls. In addition to the different colors, it is the taste, the texture, and the caramel aroma that is clearly fragrant by our company\'s unique formula. Beautiful golden yellow color And likewise, most of the raw materials used as components are raw materials that our company carefully selects for the quality of our customers, especially.</span></p>\r\n<p><span style=\"color: rgb(107, 107, 107);\">Our company can also create formulas, improve formulas according to customer needs and satisfaction as well</span></p>', '<p><span style=\"color: rgb(107, 107, 107);\">If talking about the difference between Got black and gold pearls. In addition to the different colors, it is the taste, the texture, and the caramel aroma that is clearly fragrant by our company\'s unique formula. Beautiful golden yellow color And likewise, most of the raw materials used as components are raw materials that our company carefully selects for the quality of our customers, especially.</span></p>\r\n<p><span style=\"color: rgb(107, 107, 107);\">Our company can also create formulas, improve formulas according to customer needs and satisfaction as well</span></p>', 'https://youtu.be/Dr6JVIs6hgc', 'http://localhost:8080/yoyi/upload/pdf.pdf', 'on'),
(3, '46631748.webp', '<h4><span style=\"font-size: 14pt; color: rgb(255, 255, 255);\">Pearl white</span></h4>', '<p><span style=\"color: rgb(0, 0, 0);\">Pearl White</span><span style=\"color: rgb(107, 107, 107);\"> <br>is a formula developed by the company to meet the needs of customers. will have a fragrant color and the original powdery taste Gives a soft, chewy touch, fun to chew, appetizing, not allergic to black and gold. Pearly white powdery granules Most of the raw materials used are raw materials that our company carefully selects. In order to make our products come out with quality and value for the needs of customers.</span></p>\r\n<p><span style=\"color: rgb(107, 107, 107);\">Our company can also create formulas, improve formulas according to customer needs and satisfaction as well</span></p>', '<p><span style=\"color: rgb(107, 107, 107);\">Pearl White is a formula developed by the company to meet the needs of customers. will have a fragrant color and the original powdery taste Gives a soft, chewy touch, fun to chew, appetizing, not allergic to black and gold. Pearly white powdery granules Most of the raw materials used are raw materials that our company carefully selects. In order to make our products come out with quality and value for the needs of customers.</span></p>\r\n<p><span style=\"color: rgb(107, 107, 107);\">Our company can also create formulas, improve formulas according to customer needs and satisfaction as well</span></p>\r\n<p>&nbsp;</p>', 'https://youtu.be/Dr6JVIs6hgc', 'http://localhost:8080/yoyi/upload/pdf.pdf', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `product_img`
--

CREATE TABLE `product_img` (
  `id` int(10) NOT NULL,
  `img` varchar(255) NOT NULL,
  `id_product` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product_img`
--

INSERT INTO `product_img` (`id`, `img`, `id_product`) VALUES
(16, '1646212254.webp', '3'),
(17, '1554262145.webp', '3'),
(19, '2042873286.webp', '2'),
(20, '1803807707.webp', '2'),
(21, '1245502865.webp', '3'),
(22, '182437022.webp', '1'),
(23, '502388710.webp', '1'),
(24, '1982015190.webp', '1');

-- --------------------------------------------------------

--
-- Table structure for table `type_cook`
--

CREATE TABLE `type_cook` (
  `type_id` int(10) NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `type_cook`
--

INSERT INTO `type_cook` (`type_id`, `type_name`) VALUES
(4, 'วิธีการปรุงอาหาร'),
(5, 'โซนสูตรอาหาร');

-- --------------------------------------------------------

--
-- Table structure for table `type_cook_en`
--

CREATE TABLE `type_cook_en` (
  `type_id` int(10) NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `type_cook_en`
--

INSERT INTO `type_cook_en` (`type_id`, `type_name`) VALUES
(3, 'How to cook'),
(4, 'Recipe Zone');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `about_en`
--
ALTER TABLE `about_en`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catalog_cook`
--
ALTER TABLE `catalog_cook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catalog_cook_en`
--
ALTER TABLE `catalog_cook_en`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_en`
--
ALTER TABLE `contact_en`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cook_detail`
--
ALTER TABLE `cook_detail`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `cook_detail_en`
--
ALTER TABLE `cook_detail_en`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `cook_detail_img`
--
ALTER TABLE `cook_detail_img`
  ADD PRIMARY KEY (`id_cook`);

--
-- Indexes for table `cook_detail_img_en`
--
ALTER TABLE `cook_detail_img_en`
  ADD PRIMARY KEY (`id_cook`);

--
-- Indexes for table `intro_content`
--
ALTER TABLE `intro_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intro_content_en`
--
ALTER TABLE `intro_content_en`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id_news`);

--
-- Indexes for table `news_en`
--
ALTER TABLE `news_en`
  ADD PRIMARY KEY (`id_news`);

--
-- Indexes for table `news_img`
--
ALTER TABLE `news_img`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `product_en`
--
ALTER TABLE `product_en`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `product_img`
--
ALTER TABLE `product_img`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_cook`
--
ALTER TABLE `type_cook`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `type_cook_en`
--
ALTER TABLE `type_cook_en`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `about_en`
--
ALTER TABLE `about_en`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `catalog_cook`
--
ALTER TABLE `catalog_cook`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `catalog_cook_en`
--
ALTER TABLE `catalog_cook_en`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_en`
--
ALTER TABLE `contact_en`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cook_detail`
--
ALTER TABLE `cook_detail`
  MODIFY `detail_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cook_detail_en`
--
ALTER TABLE `cook_detail_en`
  MODIFY `detail_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cook_detail_img`
--
ALTER TABLE `cook_detail_img`
  MODIFY `id_cook` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `cook_detail_img_en`
--
ALTER TABLE `cook_detail_img_en`
  MODIFY `id_cook` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `intro_content`
--
ALTER TABLE `intro_content`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `intro_content_en`
--
ALTER TABLE `intro_content_en`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id_news` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `news_en`
--
ALTER TABLE `news_en`
  MODIFY `id_news` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `news_img`
--
ALTER TABLE `news_img`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_en`
--
ALTER TABLE `product_en`
  MODIFY `id_product` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_img`
--
ALTER TABLE `product_img`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `type_cook`
--
ALTER TABLE `type_cook`
  MODIFY `type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `type_cook_en`
--
ALTER TABLE `type_cook_en`
  MODIFY `type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
