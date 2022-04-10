-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2022 at 04:43 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `log`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_colors`
--

CREATE TABLE `tb_colors` (
  `id_color` int(11) NOT NULL,
  `name_color` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_colors`
--

INSERT INTO `tb_colors` (`id_color`, `name_color`) VALUES
(1, 'ขาว'),
(2, 'แดง'),
(6, 'ครีม'),
(7, 'เทา'),
(8, 'เหลือง');

-- --------------------------------------------------------

--
-- Table structure for table `tb_comments`
--

CREATE TABLE `tb_comments` (
  `id_comment` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date_comment` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_contacts`
--

CREATE TABLE `tb_contacts` (
  `id_contact` int(2) NOT NULL,
  `s_name` varchar(50) NOT NULL,
  `s_adress` varchar(100) NOT NULL,
  `s_facebook` varchar(30) NOT NULL,
  `s_line` varchar(20) NOT NULL,
  `s_tel` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_contacts`
--

INSERT INTO `tb_contacts` (`id_contact`, `s_name`, `s_adress`, `s_facebook`, `s_line`, `s_tel`) VALUES
(1, 'SshopByPimkhae', '176 บ.สำโรงโคก ต.กุดน้ำใส อ.จัตุรัส จ.ชัยภูมิ 36130', 'Chakkri Aueasiripracha', 'youknowme_2', '0982389122');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_orders`
--

CREATE TABLE `tb_detail_orders` (
  `id_detail_order` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_groups`
--

CREATE TABLE `tb_groups` (
  `id_group` int(11) NOT NULL,
  `name_group` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_groups`
--

INSERT INTO `tb_groups` (`id_group`, `name_group`) VALUES
(16, 'รองผ้าใบเท้าเด็ก'),
(17, 'รองเท้าผ้าใบ ชายและหญิง'),
(18, 'รองเท้าแตะ ชายและหญิง'),
(22, 'รองเท้าเด็กนักเรียน'),
(23, 'รองเท้าคัชชู'),
(24, 'รองเท้าส้นสูง');

-- --------------------------------------------------------

--
-- Table structure for table `tb_howtobuys`
--

CREATE TABLE `tb_howtobuys` (
  `id_htb` int(2) NOT NULL,
  `text1` varchar(40) NOT NULL,
  `text2` varchar(40) NOT NULL,
  `text3` varchar(40) NOT NULL,
  `text4` varchar(40) NOT NULL,
  `text5` varchar(40) NOT NULL,
  `text6` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_howtobuys`
--

INSERT INTO `tb_howtobuys` (`id_htb`, `text1`, `text2`, `text3`, `text4`, `text5`, `text6`) VALUES
(1, 'สมัครสมาชิก เพื่อทำการสั่งซื้อ', 'เลือกสินค้าที่ต้องการ', 'ทำการกดสั่งซื้อ', 'แก้ไขที่อยู่สำหรับจัดส่งให้ถูก', 'แจ้งชำระเงิน เพื่ออัพเดตสถานะการสั่งซื้อ', 'รอรับสินค้าได้เลยครับ');

-- --------------------------------------------------------

--
-- Table structure for table `tb_howtopayments`
--

CREATE TABLE `tb_howtopayments` (
  `id_payment` int(2) NOT NULL,
  `bank_acc` varchar(12) NOT NULL,
  `bank_name` varchar(20) NOT NULL,
  `holder_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_howtopayments`
--

INSERT INTO `tb_howtopayments` (`id_payment`, `bank_acc`, `bank_name`, `holder_name`) VALUES
(1, '5342588463', 'ไทยพาณิชย์', 'นายจักรี เอื้อศิริประชา'),
(2, '0651246512', 'กสิกรไทย', 'นางสาวธารีรันต์ ฤทธิประทีป');

-- --------------------------------------------------------

--
-- Table structure for table `tb_members`
--

CREATE TABLE `tb_members` (
  `id_member` int(11) NOT NULL,
  `ipaddress` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `query` varchar(30) NOT NULL,
  `answer` varchar(30) NOT NULL,
  `login_last` datetime NOT NULL,
  `status` enum('member','admin','','') NOT NULL DEFAULT 'member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_members`
--

INSERT INTO `tb_members` (`id_member`, `ipaddress`, `username`, `password`, `firstname`, `lastname`, `address`, `tel`, `query`, `answer`, `login_last`, `status`) VALUES
(10, '::1', 'admin@gmail.com', '4f442542000951e6acad7a3115d514f116c8c7ab0045edf96cfee39ae4f9c0c9', 'Admin', 'MillerDev', 'try me', '0982389122', 'คุณชื่นชอบอะไร?', 'cat', '2022-03-24 10:03:09', 'admin'),
(22, '::1', 'user@gmail.com', '4f442542000951e6acad7a3115d514f116c8c7ab0045edf96cfee39ae4f9c0c9', 'สมชาย', 'ทองศรี', 'ชัยภูมิ', '0982389133', 'คุณชื่นชอบอะไร?', 'cat', '2022-03-24 10:03:16', 'member');

-- --------------------------------------------------------

--
-- Table structure for table `tb_orders`
--

CREATE TABLE `tb_orders` (
  `id_order` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `date_order` datetime NOT NULL,
  `date_payment` datetime NOT NULL,
  `payment` varchar(50) NOT NULL,
  `image_order` varchar(30) NOT NULL,
  `total_order` int(11) NOT NULL,
  `status_order` enum('รอชำระเงิน','รอตรวจสอบ','ชำระเงินเสร็จสิ้น','กำลังจัดส่ง','จัดส่งเสร็จสิ้น','เกิดข้อผิดพลาด') NOT NULL,
  `tracking_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_products`
--

CREATE TABLE `tb_products` (
  `id_product` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_color` int(11) NOT NULL,
  `name_product` varchar(50) NOT NULL,
  `stock_product` int(11) NOT NULL,
  `discount_product` int(11) NOT NULL,
  `price_product` int(11) NOT NULL,
  `detail_product` text NOT NULL,
  `view_product` int(11) NOT NULL,
  `like_product` int(11) NOT NULL,
  `image_product` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_stars`
--

CREATE TABLE `tb_stars` (
  `id_star` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `star` int(11) NOT NULL,
  `star_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_colors`
--
ALTER TABLE `tb_colors`
  ADD PRIMARY KEY (`id_color`);

--
-- Indexes for table `tb_comments`
--
ALTER TABLE `tb_comments`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `tb_contacts`
--
ALTER TABLE `tb_contacts`
  ADD PRIMARY KEY (`id_contact`);

--
-- Indexes for table `tb_detail_orders`
--
ALTER TABLE `tb_detail_orders`
  ADD PRIMARY KEY (`id_detail_order`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `tb_groups`
--
ALTER TABLE `tb_groups`
  ADD PRIMARY KEY (`id_group`);

--
-- Indexes for table `tb_howtobuys`
--
ALTER TABLE `tb_howtobuys`
  ADD PRIMARY KEY (`id_htb`);

--
-- Indexes for table `tb_howtopayments`
--
ALTER TABLE `tb_howtopayments`
  ADD PRIMARY KEY (`id_payment`);

--
-- Indexes for table `tb_members`
--
ALTER TABLE `tb_members`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `tb_orders`
--
ALTER TABLE `tb_orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_member` (`id_member`);

--
-- Indexes for table `tb_products`
--
ALTER TABLE `tb_products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_group` (`id_group`),
  ADD KEY `id_color` (`id_color`);

--
-- Indexes for table `tb_stars`
--
ALTER TABLE `tb_stars`
  ADD PRIMARY KEY (`id_star`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_product` (`id_product`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_colors`
--
ALTER TABLE `tb_colors`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_comments`
--
ALTER TABLE `tb_comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_contacts`
--
ALTER TABLE `tb_contacts`
  MODIFY `id_contact` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_detail_orders`
--
ALTER TABLE `tb_detail_orders`
  MODIFY `id_detail_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_groups`
--
ALTER TABLE `tb_groups`
  MODIFY `id_group` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_howtobuys`
--
ALTER TABLE `tb_howtobuys`
  MODIFY `id_htb` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_howtopayments`
--
ALTER TABLE `tb_howtopayments`
  MODIFY `id_payment` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_members`
--
ALTER TABLE `tb_members`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tb_orders`
--
ALTER TABLE `tb_orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_products`
--
ALTER TABLE `tb_products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tb_stars`
--
ALTER TABLE `tb_stars`
  MODIFY `id_star` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_comments`
--
ALTER TABLE `tb_comments`
  ADD CONSTRAINT `tb_comments_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `tb_members` (`id_member`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_comments_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `tb_products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_detail_orders`
--
ALTER TABLE `tb_detail_orders`
  ADD CONSTRAINT `tb_detail_orders_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `tb_orders` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_detail_orders_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `tb_products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_orders`
--
ALTER TABLE `tb_orders`
  ADD CONSTRAINT `tb_orders_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `tb_members` (`id_member`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_products`
--
ALTER TABLE `tb_products`
  ADD CONSTRAINT `tb_products_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `tb_groups` (`id_group`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_products_ibfk_2` FOREIGN KEY (`id_color`) REFERENCES `tb_colors` (`id_color`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_stars`
--
ALTER TABLE `tb_stars`
  ADD CONSTRAINT `tb_stars_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `tb_members` (`id_member`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_stars_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `tb_products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
