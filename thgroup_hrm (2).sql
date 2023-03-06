-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 05, 2023 at 07:16 PM
-- Server version: 10.6.10-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thgroup_hrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `vh_cauhinh`
--

CREATE TABLE `vh_cauhinh` (
  `id` int(11) NOT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ghi_chu` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ckeditor` tinyint(1) DEFAULT NULL,
  `active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vh_chuc_nang`
--

CREATE TABLE `vh_chuc_nang` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nhom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller_action` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vh_danh_muc`
--

CREATE TABLE `vh_danh_muc` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Quận huyện','Đường phố','Loại hình','Nhóm','Pháp lý','Hướng','Chi phí','Phường xã','Loại sản phẩm','Loại pháp lý','Phân loại','Loại hoa hồng','Thôn xóm','Chức danh','Trình độ chuyên môn','Mối quan hệ','Lý do nghỉ','Ngân hàng','Kiểu nghỉ','Level','HÌnh thức đăng kí','Lý do xin đi muộn về sớm thường niên') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vh_migration`
--

CREATE TABLE `vh_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vh_phan_quyen`
--

CREATE TABLE `vh_phan_quyen` (
  `id` int(11) NOT NULL,
  `chuc_nang_id` int(11) NOT NULL,
  `vai_tro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vh_vaitrouser`
--

CREATE TABLE `vh_vaitrouser` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'Thành viên',
  `vaitro_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vh_vai_tro`
--

CREATE TABLE `vh_vai_tro` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

CREATE TABLE `vh_user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_hash` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_reset_token` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secret_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 10,
  `anh_nguoi_dung` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT '/images/default.png',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hoten` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dien_thoai` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngay_cap` date DEFAULT NULL,
  `dia_chi` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `ngay_sinh` date DEFAULT NULL,
  `ghi_chu` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for table `vh_cauhinh`
--
ALTER TABLE `vh_cauhinh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vh_chuc_nang`
--
ALTER TABLE `vh_chuc_nang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vh_danh_muc`
--
ALTER TABLE `vh_danh_muc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vh_migration`
--
ALTER TABLE `vh_migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `vh_phan_quyen`
--
ALTER TABLE `vh_phan_quyen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vai_tro_id` (`vai_tro_id`),
  ADD KEY `chuc_nang_id` (`chuc_nang_id`);

--
-- Indexes for table `vh_vaitrouser`
--
ALTER TABLE `vh_vaitrouser`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `vaitro_id` (`vaitro_id`);

--
-- Indexes for table `vh_vai_tro`
--
ALTER TABLE `vh_vai_tro`
  ADD PRIMARY KEY (`id`);
-- Indexes for table `vh_user`
--
ALTER TABLE `vh_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vh_cauhinh`
--
ALTER TABLE `vh_cauhinh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vh_chuc_nang`
--
ALTER TABLE `vh_chuc_nang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vh_danh_muc`
--
ALTER TABLE `vh_danh_muc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vh_phan_quyen`
--
ALTER TABLE `vh_phan_quyen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vh_user`
--
ALTER TABLE `vh_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2237;

--
-- AUTO_INCREMENT for table `vh_vaitrouser`
--
ALTER TABLE `vh_vaitrouser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vh_vai_tro`
--
ALTER TABLE `vh_vai_tro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vh_phan_quyen`
--
ALTER TABLE `vh_phan_quyen`
  ADD CONSTRAINT `vh_phan_quyen_ibfk_1` FOREIGN KEY (`chuc_nang_id`) REFERENCES `vh_chuc_nang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `vh_phan_quyen_ibfk_2` FOREIGN KEY (`vai_tro_id`) REFERENCES `vh_vai_tro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `vh_vaitrouser`
--
ALTER TABLE `vh_vaitrouser`
  ADD CONSTRAINT `vh_vaitrouser_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `vh_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `vh_vaitrouser_ibfk_2` FOREIGN KEY (`vaitro_id`) REFERENCES `vh_vai_tro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

CREATE  VIEW `vh_user_vai_tro`  AS SELECT `t`.`id` AS `id`, `t`.`username` AS `username`, `t`.`password_hash` AS `password_hash`, `t`.`password_reset_token` AS `password_reset_token`, `t`.`email` AS `email`, `t`.`auth_key` AS `auth_key`, `t`.`secret_key` AS `secret_key`, `t`.`status` AS `status`, `t`.`anh_nguoi_dung` AS `anh_nguoi_dung`, `t`.`created_at` AS `created_at`, `t`.`updated_at` AS `updated_at`, `t`.`password` AS `password`, `t`.`hoten` AS `hoten`, `t`.`dien_thoai` AS `dien_thoai`, `t`.`cmnd` AS `cmnd`, `t`.`ngay_cap` AS `ngay_cap`, `t`.`dia_chi` AS `dia_chi`, `t`.`active` AS `active`, `t`.`ngay_sinh` AS `ngay_sinh`, `t`.`ghi_chu` AS `ghi_chu`, `t`.`user_id` AS `user_id`, `t`.`trinh_do_id` AS `trinh_do_id`, `t2`.`name` AS `ten_trinh_do`, `t`.`ngay_nop_ho_so` AS `ngay_nop_ho_so`, `t`.`noi_cap` AS `noi_cap`, `t`.`ngay_chinh_thuc` AS `ngay_chinh_thuc`, `t`.`so_tai_khoan` AS `so_tai_khoan`, `t`.`ngan_hang_id` AS `ngan_hang_id`, `t`.`chu_tai_khoan` AS `chu_tai_khoan`, `t1`.`id` AS `vai_tro_id`, `t1`.`name` AS `vai_tro`, `t1`.`name` AS `ten_vai_tro`, `t7`.`id` AS `phong_ban_id`, (select if(`t6`.`truong_phong` is null,0,`t6`.`truong_phong`)) AS `truong_phong`, `t7`.`name` AS `ten_phong_ban`, count(`t3`.`id`) AS `count_noti` FROM ((((((`vh_user` `t` left join `vh_vaitrouser` `av` on(`t`.`id` = `av`.`user_id`)) left join `vh_vai_tro` `t1` on(`av`.`vaitro_id` = `t1`.`id`)) left join `vh_danh_muc` `t2` on(`t2`.`id` = `t`.`trinh_do_id`)) left join `vh_thong_bao` `t3` on(`t3`.`user_id` = `t`.`id` and `t3`.`is_seen` = 0)) left join `vh_phong_ban_nhan_vien` `t6` on(`t`.`id` = `t6`.`nhan_vien_id` and `t6`.`active` = 1)) left join `vh_phong_ban` `t7` on(`t7`.`id` = `t6`.`phong_ban_id` and `t7`.`active` = 1)) GROUP BY `t`.`id``id`  ;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
