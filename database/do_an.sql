-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 30, 2022 lúc 07:37 PM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `do_an`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_donhang`
--

CREATE TABLE `tbl_donhang` (
  `MaDonHang` int(11) NOT NULL,
  `MaKhachHang` int(11) NOT NULL,
  `NgayDat` date NOT NULL DEFAULT current_timestamp(),
  `TongTien` int(50) NOT NULL,
  `TrangThai` int(11) NOT NULL DEFAULT 1,
  `TenNguoiNhan` varchar(150) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `SDTNguoiNhan` varchar(10) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `DiaChiNguoiNhan` varchar(150) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_donhang`
--

INSERT INTO `tbl_donhang` (`MaDonHang`, `MaKhachHang`, `NgayDat`, `TongTien`, `TrangThai`, `TenNguoiNhan`, `SDTNguoiNhan`, `DiaChiNguoiNhan`) VALUES
(38, 1, '2022-04-01', 1700000, 5, NULL, NULL, NULL),
(44, 1, '2022-04-19', 4065000, 5, NULL, NULL, NULL),
(46, 1, '2022-04-19', 4545000, 4, NULL, NULL, NULL),
(47, 1, '2022-04-19', 46825000, 5, NULL, NULL, NULL),
(57, 1, '2022-04-20', 6885000, 4, NULL, NULL, NULL),
(64, 1, '2022-04-20', 15995000, 1, NULL, NULL, NULL),
(65, 1, '2022-04-20', 3645000, 1, NULL, NULL, NULL),
(66, 1, '2022-04-20', 3645000, 1, NULL, NULL, NULL),
(67, 37, '2022-04-22', 10300000, 2, NULL, NULL, NULL),
(68, 38, '2022-04-27', 28625000, 2, NULL, NULL, NULL),
(69, 40, '2022-04-30', 10122000, 5, NULL, NULL, NULL),
(70, 40, '2022-04-30', 20400000, 5, 'truong thai', '0905040861', 'nguyễn thời trung'),
(71, 40, '2022-05-01', 27881000, 1, 'Truong Thai', '0905040861', '111 abc');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_donhang`
--
ALTER TABLE `tbl_donhang`
  ADD PRIMARY KEY (`MaDonHang`),
  ADD KEY `frk_ttdh` (`TrangThai`),
  ADD KEY `frk_kh` (`MaKhachHang`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_donhang`
--
ALTER TABLE `tbl_donhang`
  MODIFY `MaDonHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_donhang`
--
ALTER TABLE `tbl_donhang`
  ADD CONSTRAINT `frk_kh` FOREIGN KEY (`MaKhachHang`) REFERENCES `tbl_khachhang` (`MaKhachHang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `frk_ttdh` FOREIGN KEY (`TrangThai`) REFERENCES `tbl_trangthaidonhang` (`MaTrangThai`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
