-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 01, 2024 at 04:51 PM
-- Server version: 8.2.0
-- PHP Version: 8.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `diem_danh`
--

DROP TABLE IF EXISTS `diem_danh`;
CREATE TABLE IF NOT EXISTS `diem_danh` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mssv` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ma_mh` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_diemdanh_monhoc` (`ma_mh`),
  KEY `fk_diemdanh_sinhvien` (`mssv`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lop`
--

DROP TABLE IF EXISTS `lop`;
CREATE TABLE IF NOT EXISTS `lop` (
  `ma_lop` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ten_lop` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ma_lop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lop`
--

INSERT INTO `lop` (`ma_lop`, `ten_lop`) VALUES
('TH01', 'D20_TH01'),
('TH02', 'D20_TH02'),
('TH03', 'D20_TH03'),
('TH04', 'D20_TH04'),
('TH05', 'D20_TH05'),
('TH06', 'D20_TH06'),
('TH07', 'D20_TH07'),
('TH08', 'D20_TH08'),
('TH09', 'D20_TH09'),
('TH10', 'D20_TH10');

-- --------------------------------------------------------

--
-- Table structure for table `mon_hoc`
--

DROP TABLE IF EXISTS `mon_hoc`;
CREATE TABLE IF NOT EXISTS `mon_hoc` (
  `ma_mh` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ten_mh` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ma_mh`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mon_hoc`
--

INSERT INTO `mon_hoc` (`ma_mh`, `ten_mh`) VALUES
('lrv', 'laravel'),
('ltw', 'Lập Trình Web'),
('ptpmnm', 'Phát triển phần mềm nguồn mở'),
('xdpmw', 'Xây dựng phần mềm web');

-- --------------------------------------------------------

--
-- Table structure for table `sinh_vien`
--

DROP TABLE IF EXISTS `sinh_vien`;
CREATE TABLE IF NOT EXISTS `sinh_vien` (
  `mssv` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ho_ten` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gioi_tinh` tinyint(1) DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `ma_lop` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`mssv`),
  KEY `fk_sinhvien_lop` (`ma_lop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sinh_vien`
--

INSERT INTO `sinh_vien` (`mssv`, `ho_ten`, `gioi_tinh`, `ngay_sinh`, `ma_lop`) VALUES
('DH52000281', 'Lư Kiều Minh Quân', 1, '2002-12-30', 'TH02'),
('DH52001092', 'Bùi Ngọc Na', 1, '2002-06-12', 'TH03'),
('DH52001423', 'Nguyễn Trung Kiên', 1, '2002-08-24', 'TH02'),
('DH52001486', 'Đào Minh Nhựt ', 1, '2002-02-12', 'TH02'),
('DH52001564', 'Nguyễn Huỳnh Phúc Nghi', 1, '2002-11-10', 'TH04'),
('DH52001727', 'Lê Lâm Tấn Lộc', 1, '2002-06-11', 'TH02'),
('DH52002286', 'Mai Duc Huy', 1, '2002-09-24', 'TH02'),
('DH52002316', 'Nguyễn Kiều Linh ', 0, '2002-01-12', 'TH02'),
('DH52003458', 'Mai Xuân Anh', 1, '2002-11-30', 'TH03'),
('DH52003670', 'Trần Xuân Khương', 1, '2002-07-29', 'TH02');

-- --------------------------------------------------------

--
-- Table structure for table `tai_khoan`
--

DROP TABLE IF EXISTS `tai_khoan`;
CREATE TABLE IF NOT EXISTS `tai_khoan` (
  `mssv` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` tinyint(1) NOT NULL,
  PRIMARY KEY (`mssv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tai_khoan`
--

INSERT INTO `tai_khoan` (`mssv`, `username`, `password`, `role`) VALUES
('DH52000281', 'DH52000281', 'DH52000281', 0),
('DH52001092', 'DH52001092', 'DH52001092', 0),
('DH52001423', 'DH52001423', 'DH52001423', 0),
('DH52001486', 'DH52001486', 'DH52001486', 0),
('DH52001564', 'DH52001564', 'DH52001564', 0),
('DH52001727', 'DH52001727', 'DH52001727', 0),
('DH52002286', 'DH52002286', 'DH52002286', 1),
('DH52002316', 'DH52002316', 'DH52002316', 0),
('DH52003458', 'DH52003458', 'DH52003458', 0),
('DH52003670', 'DH52003670', 'DH52003670', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `diem_danh`
--
ALTER TABLE `diem_danh`
  ADD CONSTRAINT `fk_diemdanh_monhoc` FOREIGN KEY (`ma_mh`) REFERENCES `mon_hoc` (`ma_mh`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_diemdanh_sinhvien` FOREIGN KEY (`mssv`) REFERENCES `sinh_vien` (`mssv`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `sinh_vien`
--
ALTER TABLE `sinh_vien`
  ADD CONSTRAINT `fk_sinhvien_lop` FOREIGN KEY (`ma_lop`) REFERENCES `lop` (`ma_lop`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD CONSTRAINT `fk_taikhoan_sinhvien` FOREIGN KEY (`mssv`) REFERENCES `sinh_vien` (`mssv`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
