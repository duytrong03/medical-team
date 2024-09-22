-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 26, 2024 lúc 04:22 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `medical_web`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `appointments`
--

CREATE TABLE `appointments` (
  `id_appointments` int(11) NOT NULL,
  `id_hopital` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name_hopital` varchar(2000) NOT NULL,
  `name` varchar(2000) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(2000) NOT NULL,
  `appointment_date` datetime NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `package` varchar(50) NOT NULL,
  `symptoms` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `appointments`
--

INSERT INTO `appointments` (`id_appointments`, `id_hopital`, `id_user`, `name_hopital`, `name`, `phone`, `address`, `appointment_date`, `created_at`, `package`, `symptoms`) VALUES
(5, 1, 11, 'Bệnh viện 108 Quân đội', 'Nguyen Van A', '0901234567', '123 Đường ABC, Quận 1, TP. HCM', '2024-05-28 10:00:00', '2024-05-26 09:21:13', 'Gói Khám thường', 'Sốt và ho.'),
(6, 2, 12, 'Bệnh viện Đức Phúc', 'Tran Thi B', '0902345678', '456 Đường XYZ, Quận 2, TP. HCM', '2024-05-29 11:00:00', '2024-05-26 09:21:13', 'Gói Khám Tự chọn', 'Đau bụng dưới.'),
(7, 3, 13, 'Bệnh viện Đa khoa quận Đống Đa', 'Le Van C', '0903456789', '789 Đường DEF, Quận 3, TP. HCM', '2024-05-30 12:00:00', '2024-05-26 09:21:13', 'Gói Khám Bảo hiểm', 'Đau đầu thường xuyên.'),
(8, 4, 14, 'Viện Y học Phòng không - Không quân', 'Pham Thi D', '0904567890', '101 Đường GHI, Quận 4, TP. HCM', '2024-05-31 13:00:00', '2024-05-26 09:21:13', 'Gói VIP', 'Sốt cao.'),
(9, 5, 15, 'Bệnh viện Mắt Hồng Sơn', 'Hoang Van E', '0905678901', '202 Đường JKL, Quận 5, TP. HCM', '2024-06-01 14:00:00', '2024-05-26 09:21:13', 'Gói Khám thường', 'Đau mắt.'),
(10, 6, 16, 'Phòng khám quốc tế Vinmec Times City', 'Dang Thi F', '0906789012', '303 Đường MNO, Quận 6, TP. HCM', '2024-06-02 15:00:00', '2024-05-26 09:21:13', 'Gói Khám Tự chọn', 'Đau răng.'),
(11, 7, 17, 'Bệnh viện Đại học Y Hà Nội - Cơ sở Hoàng Mai', 'Nguyen Thi G', '0907890123', '404 Đường PQR, Quận 7, TP. HCM', '2024-06-03 16:00:00', '2024-05-26 09:21:13', 'Gói Khám Bảo hiểm', 'Đau tim.'),
(12, 8, 8, 'Bệnh viện Nội tiết Trung ương', 'Tran Van H', '0908901234', '505 Đường STU, Quận 8, TP. HCM', '2024-06-04 17:00:00', '2024-05-26 09:21:13', 'Gói VIP', 'Đau dạ dày.'),
(13, 9, 9, 'Bệnh viện Tâm thần Hà Nội', 'Le Thi I', '0909012345', '606 Đường VWX, Quận 9, TP. HCM', '2024-06-05 18:00:00', '2024-05-26 09:21:13', 'Gói Khám thường', 'Stress.'),
(14, 10, 10, 'Bệnh viện Quân y 103', 'Pham Van J', '0900123456', '707 Đường YZA, Quận 10, TP. HCM', '2024-06-06 19:00:00', '2024-05-26 09:21:13', 'Gói Khám Tự chọn', 'Đau cổ.'),
(15, 11, 11, 'Bệnh viện 108 Quân đội', 'Nguyen Van A', '0901234567', '123 Đường ABC, Quận 1, TP. HCM', '2024-06-07 10:00:00', '2024-05-26 09:21:13', 'Gói Khám Bảo hiểm', 'Đau bụng.'),
(16, 12, 12, 'Bệnh viện Đức Phúc', 'Tran Thi B', '0902345678', '456 Đường XYZ, Quận 2, TP. HCM', '2024-06-08 11:00:00', '2024-05-26 09:21:13', 'Gói VIP', 'Mệt mỏi.'),
(17, 13, 13, 'Bệnh viện Đa khoa quận Đống Đa', 'Le Van C', '0903456789', '789 Đường DEF, Quận 3, TP. HCM', '2024-06-09 12:00:00', '2024-05-26 09:21:13', 'Gói Khám thường', 'Chóng mặt.'),
(18, 14, 14, 'Viện Y học Phòng không - Không quân', 'Pham Thi D', '0904567890', '101 Đường GHI, Quận 4, TP. HCM', '2024-06-10 13:00:00', '2024-05-26 09:21:13', 'Gói Khám Tự chọn', 'Ho cóc.'),
(19, 15, 15, 'Bệnh viện Mắt Hồng Sơn', 'Hoang Van E', '0905678901', '202 Đường JKL, Quận 5, TP. HCM', '2024-06-11 14:00:00', '2024-05-26 09:21:13', 'Gói Khám Bảo hiểm', 'Đau đầu.'),
(20, 16, 16, 'Phòng khám quốc tế Vinmec Times City', 'Dang Thi F', '0906789012', '303 Đường MNO, Quận 6, TP. HCM', '2024-06-12 15:00:00', '2024-05-26 09:21:13', 'Gói VIP', 'Đau họng.'),
(21, 17, 17, 'Bệnh viện Đại học Y Hà Nội - Cơ sở Hoàng Mai', 'Nguyen Thi G', '0907890123', '404 Đường PQR, Quận 7, TP. HCM', '2024-06-13 16:00:00', '2024-05-26 09:21:13', 'Gói Khám thường', 'Sổ mũi.'),
(22, 18, 8, 'Bệnh viện Nội tiết Trung ương', 'Tran Van H', '0908901234', '505 Đường STU, Quận 8, TP. HCM', '2024-06-14 17:00:00', '2024-05-26 09:21:13', 'Gói Khám Tự chọn', 'Đau bao tử.'),
(23, 19, 9, 'Bệnh viện Tâm thần Hà Nội', 'Le Thi I', '0909012345', '606 Đường VWX, Quận 9, TP. HCM', '2024-06-15 18:00:00', '2024-05-26 09:21:13', 'Gói Khám Bảo hiểm', 'Chán ăn.'),
(24, 20, 10, 'Bệnh viện Quân y 103', 'Pham Van J', '0900123456', '707 Đường YZA, Quận 10, TP. HCM', '2024-06-16 19:00:00', '2024-05-26 09:21:13', 'Gói VIP', 'Đau răng.'),
(25, 1, 11, 'Bệnh viện 108 Quân đội', 'Nguyen Van A', '0901234567', '123 Đường ABC, Quận 1, TP. HCM', '2024-06-17 10:00:00', '2024-05-26 09:21:13', 'Gói Khám thường', 'Đau bụng.'),
(26, 2, 12, 'Bệnh viện Đức Phúc', 'Tran Thi B', '0902345678', '456 Đường XYZ, Quận 2, TP. HCM', '2024-06-18 11:00:00', '2024-05-26 09:21:13', 'Gói Khám Tự chọn', 'Mệt mỏi.'),
(27, 3, 13, 'Bệnh viện Đa khoa quận Đống Đa', 'Le Van C', '0903456789', '789 Đường DEF, Quận 3, TP. HCM', '2024-06-19 12:00:00', '2024-05-26 09:21:13', 'Gói Khám Bảo hiểm', 'Chóng mặt.'),
(28, 4, 14, 'Viện Y học Phòng không - Không quân', 'Pham Thi D', '0904567890', '101 Đường GHI, Quận 4, TP. HCM', '2024-06-20 13:00:00', '2024-05-26 09:21:13', 'Gói VIP', 'Ho cóc.'),
(29, 5, 15, 'Bệnh viện Mắt Hồng Sơn', 'Hoang Van E', '0905678901', '202 Đường JKL, Quận 5, TP. HCM', '2024-06-21 14:00:00', '2024-05-26 09:21:13', 'Gói Khám thường', 'Đau đầu.'),
(30, 6, 16, 'Phòng khám quốc tế Vinmec Times City', 'Dang Thi F', '0906789012', '303 Đường MNO, Quận 6, TP. HCM', '2024-06-22 15:00:00', '2024-05-26 09:21:13', 'Gói Khám Tự chọn', 'Đau họng.'),
(31, 7, 17, 'Bệnh viện Đại học Y Hà Nội - Cơ sở Hoàng Mai', 'Nguyen Thi G', '0907890123', '404 Đường PQR, Quận 7, TP. HCM', '2024-06-23 16:00:00', '2024-05-26 09:21:13', 'Gói Khám Bảo hiểm', 'Sổ mũi.'),
(32, 8, 8, 'Bệnh viện Nội tiết Trung ương', 'Tran Van H', '0908901234', '505 Đường STU, Quận 8, TP. HCM', '2024-06-24 17:00:00', '2024-05-26 09:21:13', 'Gói VIP', 'Đau bao tử.'),
(33, 9, 9, 'Bệnh viện Tâm thần Hà Nội', 'Le Thi I', '0909012345', '606 Đường VWX, Quận 9, TP. HCM', '2024-06-25 18:00:00', '2024-05-26 09:21:13', 'Gói Khám thường', 'Chán ăn.'),
(34, 10, 10, 'Bệnh viện Quân y 103', 'Pham Van J', '0900123456', '707 Đường YZA, Quận 10, TP. HCM', '2024-06-26 19:00:00', '2024-05-26 09:21:13', 'Gói Khám Tự chọn', 'Đau răng.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `crud_hopital_location`
--

CREATE TABLE `crud_hopital_location` (
  `id_hopital` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `introduction` text DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `specialist` varchar(2000) DEFAULT NULL,
  `coordinates` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `crud_hopital_location`
--

INSERT INTO `crud_hopital_location` (`id_hopital`, `name`, `introduction`, `address`, `phone`, `image`, `district`, `specialist`, `coordinates`) VALUES
(1, 'Bệnh viện 108 Quân đội', 'Bệnh viện Trung ương Quân đội 108, trước đây có tên gọi là Viện Quân y 108, trực thuộc Bộ Quốc phòng Việt Nam, bệnh viện đa khoa, chiến lược tuyến cuối của Bộ Quốc phòng, một trong 05 Bệnh viện hạng đặc biệt quốc gia', '1B Trần Hưng Đạo, Bạch Đằng, Hai Bà Trưng, Hà Nội', '0967 751 615', '../image/imagesBvien/108quandoi.jpg', 'Hai Bà Trưng', 'Nội tổng hợp,Xạ trị - Xạ phẫu,Phẫu thuật tim mạch,Chuẩn đoán và can thiệp tim,Nội tim mạch,Bệnh lây đường máu', '105.86059535465358, 21.01661092152179'),
(2, 'Bệnh viện Đức Phúc', 'Tên viết tắt của Bệnh Viện Hỗ Trợ Sinh Sản và Nam học Đức Phúc. Đúng như tên gọi mang sứ mệnh “ươm mầm hạnh phúc”, Bệnh viện Hỗ trợ Sinh sản và Nam học Đức Phúc là cơ sở chuyên khoa đầu ngành của cả nước về lĩnh vực chăm sóc sức khỏe sinh sản và vô sinh hiếm muộn. Bệnh Viện Hỗ Trợ Sinh Sản Và Nam Học Đức Phúc có tỉ lệ thành công cao nhất hiện nay, sinh con khỏe mạnh như ý', '48 P. Ô Đồng Lầm, Phương Liên, Đống Đa, Hà Nội', '0971 195 050', '../image/imagesBvien/ducphuc.jpg', 'Đống Đa', 'Hỗ trợ sinh sản,Nam khoa,Phụ khoa,Thận tiết niệu,Điều trị vô sinh hiếm muộn', '105.84089983051427, 21.01421939773664'),
(3, 'Bệnh viện Đa khoa quận Đống Đa', 'Với nhiệm vụ là chuyên khoa đầu ngành trong lĩnh vực truyền nhiễm, bệnh viện Đống Đa – cơ sở khám chữa bệnh chất lượng trở thành địa chỉ tiếp nhận điều trị và đã chữa khỏi cho hàng ngàn bệnh nhân mắc bệnh. Qua một quá trình phát triển không ngừng, bệnh viện đã được công nhận là bệnh viện đa khoa hạng II của thủ đô Hà Nội.', '192 Ng. 180 P. Nguyễn Lương Bằng, Quang Trung, Đống Đa, Hà Nội', '024 8582 2392', '../image/imagesBvien/dakhoadongda.jpg', 'Đống Đa', 'Truyền nhiễm,Ngoại,Nhi,Liên chuyên khoa,Y học dân tộc,Cấp cứu và gây mê hồi sức', '105.82683361957106, 21.015577116510855'),
(4, 'Viện Y học Phòng không - Không quân', 'Viện Y học PK-KQ với chức năng, nhiệm vụ chính là Khám tuyển tạo nguồn học viên lái máy bay quân sự. Giám định, quản lý sức khỏe phi công quân sự; nghiên cứu khoa học về Y học Hàng không (YHHK) và bệnh nghề nghiệp; huấn luyện sinh lý YHHK cho phi công và nhân viên công tác trên không; huấn luyện đào tạo chuyên ngành YHHK; thực hiện chỉ đạo công tác tuyến; hợp tác Quốc tế về YHHK; đảm bảo quân y sẵn sàng chiến đấu theo phân cấp, phòng chống dịch bệnh, tìm kiếm cứu hộ, cứu nạn; phòng chống thiên tai thảm họa; khám chữa bệnh cho bộ đội thuộc Quân chủng PK-KQ và nhân dân; tham gia khám tuyển tạo nguồn phi công và nhân viên Hàng không dân dụng; giám định sức khỏe nhân viên Hàng không.', '225 Đ. Trường Chinh, Khương Thượng, Đống Đa, Hà Nội', '0695 64353', '../image/imagesBvien/pkkq.jpg', 'Thanh Xuân', 'Chuẩn đoán hình ảnh', '105.82574818366771, 21.00042258936722'),
(5, 'Bệnh viện Mắt Hồng Sơn', 'Bệnh Viện Mắt Hồng Sơn tự hào là bệnh viện thực hiện được những phẫu thuật chuyên sâu đặc biệt trong tất cả các lĩnh vực từ mổ cận thị, đục thuỷ tinh thể đến dịch kính võng mạc...với các chuyên gia phẫu thuật đầu ngành nhãn khoa và đội ngũ nhân viên chuyên nghiệp, hết lòng vì người bệnh, cùng trang thiết bị hiện đại và mới nhất. Bệnh nhân đến với chúng tôi hoàn toàn có thể yên tâm và tin tưởng vào hoạt động của bệnh viện với phương châm GIÁ VÀ KẾT QUẢ TỐT NHẤT', '709 Giải Phóng, Giáp Bát, Hoàng Mai, Hà Nội', '0904 088 899', '../image/imagesBvien/mathongson.jpg', 'Hoàng Mai', 'Mổ cận thị,Đục thủy tinh thể,Dịch kính võng mạc', '105.84148146050637, 20.987933413220247'),
(6, 'Phòng khám quốc tế Vinmec Times City', 'Phòng khám Đa khoa Quốc tế Vinmec Times City tọa lạc trong khu Đô thị Times City hiện đại và sang trọng bậc nhất Hà Nội có diện tích 3530 m2, tại tòa nhà gồm 7 tầng nổi và 1 tầng hầm, môi trường xung quanh hiện đại, sang trọng, tiện lợi về giao thông. Phòng khám Đa khoa Quốc tế Vinmec Times City bao gồm 7 chuyên khoa Tầng 1: Trung tâm thẩm mỹ Vinmec-View Tầng 2: Khoa Chẩn đoán hình ảnh, Khoa Nội soi tiêu hóa và Trung tâm Khám sức khỏe Cao cấp Tầng 3: Trung tâm Khám sức khỏe Tổng quát. Tầng 4: Trung tâm Vaccine và Trung tâm Sản phụ khoa Tầng 5: Trung tâm Hỗ trợ Sinh Sản (IVF)', 'Phòng khám quốc tế Vinmec, Khu đô thị Times City, Hai Bà Trưng, Hà Nội', '024 3974 3556', '../image/imagesBvien/vtc.jpg', 'Hai Bà Trưng', 'Sản phụ khoa và hỗ trợ sinh sản,Tim mạch,Nhi,Ung bướu - Xạ trị,Sức khoẻ tổng quát,Tiêu hóa - Gan mật,Chấn thương chỉnh hình - Y học thể thao,Tế bào gốc và Công nghệ gen,Ngân hàng Mô Vinmec,Y Học Cổ Truyền,Trung tâm mắt Vinmec Alina', '105.86673722282666, 20.99597975116295'),
(7, 'Bệnh viện Đại học Y Hà Nội - Cơ sở Hoàng Mai', 'Với phương châm “Sức khỏe toàn diện - Chi phí tiết kiệm” khi đến thăm khám tại Bệnh viện Đại học Y Hà Nội cơ sở Hoàng Mai, người bệnh sẽ được tư vấn bởi đội ngũ chuyên gia hàng đầu của Trường Đại học Y Hà Nội và Bệnh viện Đại học Y Hà Nội cùng với hệ thống trang thiết bị y tế hiện đại.', 'Ngõ 587 Đ. Tam Trinh, Yên Sở, Hoàng Mai, Hà Nội', '1900 6422', '../image/imagesBvien/yhanoihm.jpg', 'Hoàng Mai', 'Tim mạch,Cấp cứu,Gây mê hồi sức,Ngoại khoa,Ung bướu,Chuẩn đoán hình ảnh', '105.86904135657744, 20.97858369345792'),
(8, 'Bệnh viện Nội tiết Trung ương', 'Bệnh viện Nội tiết Trung ương Hà Nội là nơi hội tụ đội ngũ y bác sĩ chuyên khoa đầu ngành trong lĩnh vực điều trị nội tiết và rối loạn chuyển hóa. Với hành trình hình thành và phát triển hơn 50 năm, bệnh viện đã khám chữa bệnh cho hàng triệu lượt người bệnh và trở thành địa chỉ đáng tin cậy được nhiều người dân tìm đến.', 'Ngõ 215 - Đường Ngọc Hồi - Tứ Hiệp - Thanh Trì - TP. Hà Nội', '(0243) 853 3527', '../image/imagesBvien/noitiettw.jpg', 'Thanh Trì', 'Tiểu đường,Tuyến giáp,Tuyến yên,Bệnh đường tiết niệu', '105.85101008184938, 20.952304415616'),
(9, 'Bệnh viện Tâm thần Hà Nội', 'Bệnh viện Tâm thần Hà Nội là bệnh viện công lập, trực thuộc sở Y tế Hà Nội. Bệnh viện dành cho người bệnh Tâm thần ở Sài Đồng, Long Biên, thành phố Hà Nội. Bệnh viện được thành lập theo quyết định số 3627/QĐ-UBND ngày 16 tháng 7 năm 2009 của Ủy ban nhân dân thành phố Hà Nội.', 'Ngõ 467 Nguyễn Văn Linh, Phúc Đồng, Long Biên, Hà Nội', '0967301616', '../image/imagesBvien/tamthanhn.jpg', 'Long Biên', 'Thần kinh', '105.90953848302354, 21.035021664775613'),
(10, 'Bệnh viện Quân y 103', 'Bệnh viện Quân y 103 là bệnh viện thực hành trực thuộc Học viện Quân y, Bộ Quốc phòng Việt Nam. Thành lập vào ngày 20 tháng 12 năm 1950.', 'Số 261 Phùng Hưng, Phúc La, Hà Đông, Hà Nội', '096 781 1616', '../image/imagesBvien/quany103.jpg', 'Hà Đông', 'Nội,Ngoại,Nội tiết,Tiết niệu,Hen phế quản,Phổi phế quản tắc nghẽn,Lao phổi,Lao xương khớp,Lao hạch', '105.76769848298693, 20.96148449321263'),
(11, 'Bệnh viện ung thư K2', 'Ngày 17 tháng 7 năm 1969, được sự đồng ý của Chính phủ, Bộ trưởng Bộ Y tế ra quyết định số 711/QĐ-BYT thành lập Bệnh viện K được thành lập từ tiền thân là Viện Curie Đông Dương (Insitut Curie de L’Indochine) ra đời tại Hà Nội vào ngày 19/10/1923 do Luật sư Mourlan phụ trách.. ', 'Tựu Liệt, Tam Hiệp, Thanh Trì, Hà Nội', '0936 238 808', '../image/imagesBvien/benhvienk.jpg', 'Thanh Trì', 'Điều trị ung thư', '105.7993834074012, 20.963763369854917'),
(12, 'Bệnh viện 09', '', 'Km3 Đường 70, Tân Triều, Thanh Trì, Hà Nội', '0978 266 699 ', '../image/imagesBvien/benhvien09.jpg', 'Thanh trì', 'Điều trị HIV/AIDS', '105.80190723103163, 20.960686452008403'),
(13, 'Bệnh viện K', 'Bệnh viện K là bệnh viện trực thuộc Bộ Y tế, chuyên điều trị các căn bệnh ung thư, theo Nghị định số 49/2003/NĐ-CP ngày 15/5/2003 của Chính phủ', 'Số 43 Quán Sứ (đang sửa chữa) và số 9A - 9B Phan Chu Trinh, Hoàn Kiếm, Hà Nội', '0904 690 818', '../image/imagesBvien/benhvienk.jpg', 'Hoàn Kiếm', 'Điều trị ung thư', '105.83233332702628, 20.954663365773158'),
(14, 'Bệnh viện Xây dựng', '', '1 Nguyễn Quý Đức, Thanh Xuân Bắc, Thanh Xuân, Hà Nội', '024 3553 9226', '../image/imagesBvien/benhvienxaydung.jpg', 'Thanh Xuân', 'Phòng kế hoạch tổng hợp,Sức khỏe nghề nghiệp,Phòng vật tư – thiết bị y tế,Chẩn đoán hình ảnh,Liên chuyên khoa,Vật lý trị liệu – phục hồi chức năng – đông y,Xét nghiệm,Tim mạch – lão khoa,Dược,Hồi sức cấp cứu,Truyền nhiễm,Ngoại tổng hợp,Nội cán bộ tự nguyện', '105.82693514870465, 20.959638976171078'),
(15, 'Phòng Khám Đa khoa Linh Đàm', 'Phòng khám Đa khoa Linh Đàm chuyên cung cấp dịch vụ y tế chuyên nghiệp để phục vụ cho nhu cầu khám và điều trị của cư dân khu vực quận Linh Đàm. Theo đó, nhằm mang lại dịch vụ tốt nhất cho khách hàng, phòng khám đã liên tục đầu tư vào cơ sở vật chất và cố gắng quy tụ đội ngũ bác sĩ có bề dày kinh nghiệm tại Hà Nội.', '4 TT6 street, Khu đô thị Bắc Linh Đàm, Hoàng Mai, Hà Nội', '024 3641 8659', '../image/imagesBvien/phongkhamdakhoalinhdam.jpg', 'Hoàng Mai', 'Ngoại khoa,Sản phụ khoa,Nhi khoa,Răng hàm mặt', '105.82896822885073, 20.97037525570066'),
(16, 'Trung tâm Y tế quận Hoàng Mai', 'Chăm sóc sức khoẻ nhân dân', '5 P. Bùi Huy Bích, Hoàng Liệt, Hoàng Mai, Hà Nội', '024 3633 2628', '../image/imagesBvien/trungtamytehoangmai.jpg', 'Hoàng Mai', 'Cấp cứu-Hồi sức,Ngoại tổng hợp,Chăm sóc sức khỏe sinh sản,Nội tổng hợp,Nhi,Truyền nhiễm,Y học cổ truyền và Phục hồi chức năng,Khám bệnh,Xét nghiệm và Chẩn đoán hình ảnh,Methadone - Lao - HIV', '105.8464246756298, 20.968280432423185'),
(17, 'Trạm xá Đại Kim', 'Trạm y tế phường Đại Kim có chức năng cung cấp, thực hiện các dịch vụ chăm sóc sức khoẻ ban đầu cho nhân dân trên địa bàn phường  Đại Kim.', '4 Ngõ 292 Đ.Kim Giang, Đại Kim, Hoàng Mai, Hà Nội', '024 3855 2501', '../image/imagesBvien/tramytephuongdaikim.png', 'Hoàng Mai', '', '105.8227988821971, 20.977052308981044'),
(18, 'Trạm Y tế xã Yên Mỹ', 'Trạm y tế Yên Mỹ có chức năng cung cấp, thực hiện các dịch vụ chăm sóc sức khoẻ ban đầu cho nhân dân trên địa bàn Yên Mỹ.', 'Thôn 3, Xã Yên Mỹ, Huyện Thanh Trì, Hà Nội', '0912417577', '../image/imagesBvien/tramyte.jpg', 'Thanh Trì', '', '105.8715727815109, 20.94585178527076'),
(19, 'Bệnh viện Y học Cổ truyền Bộ Công an', 'Bệnh viện Y học cổ truyền Bộ công an là bệnh viện nằm trong lực lượng công an, đảm nhiệm các nhiệm vụ liên quan đến sức khỏe và điều trị ngoại trú, nội trú các khoa cho bệnh nhân. Nhờ sự tận tình chăm sóc của đội ngũ y bác sĩ mà đây được xem là địa điểm chữa bệnh đáng tin cậy của hầu hết người dân trên địa bàn Hà Nội và các tỉnh khác.', '278 Lương Thế Vinh, Trung Văn, Từ Liêm, Hà Nội', '024 2263 8383', '../image/imagesBvien/benhvienyhoccotruyen.jpg', 'Nam Từ Liêm', 'Nội khoa,Ngoại khoa,Sản phụ khoa,Nhi khoa,Tai Mũi Họng,Mắt,Răng Hàm Mặt,Da liễu,Y học cổ truyền,Tiêu hóa,Gan mật,Thần kinh,Nội tiết,Tim mạch,Hô hấp,Truyền nhiễm,Hiếm muộn,U bướu,Hồi sức cấp cứu,Chăm sóc đặc biệt,Châm cứu,Phục hồi chức năng,Khám sức khỏe tổng quát,Điều trị y học hiện đại,Dinh dưỡng lâm sàng,Dinh dưỡng cộng đồng,Chẩn đoán hình ảnh,Thăm dò chức năng', '105.78923730189689, 20.99623428596982'),
(20, 'Trạm y tế phường Tây Mỗ', 'Trạm y tế Phường Tây Mỗ có chức năng cung cấp, thực hiện các dịch vụ chăm sóc sức khoẻ ban đầu cho nhân dân trên địa bàn  Phường Tây Mỗ.', 'Tổ dân phố Phú Thứ, phường Tây Mỗ, Phường Tây Mỗ, Quận Nam Từ Liêm, Hà Nội', '02438 390667, 0', '../image/imagesBvien/tramytephuongtaymo.jpg', 'Nam Từ Liêm', '', '105.75114897317133, 21.00195509172785'),
(21, 'Bệnh viện Đa khoa Hồng Ngọc - Phúc Trường Minh', 'Bệnh viện Đa khoa Hồng Ngọc Phúc Trường Minh bao gồm 16 tầng nổi vs 2 tầng hầm được xây dựng trên diện tích 2,5 ha. Là nơi hội tụ công nghệ thông minh tích hợp vs giải pháp hòa nhập thiên nhiên, giúp mỗi bệnh nhân đều được trải nghiệm quá trình điều trị thể chất song song vs trị liệu tinh thần một cách hoàn thiện nhất. Bệnh viện có 26 chuyên khoa, bao gồm các chuyên khoa như khoa Phụ sản, khoa Nhi, khoa Ngoại, khoa Nội, khoa Xét nghiệm, Tai mũi họng,... cung cấp đầy đủ dịch vụ khám, chữa bệnh và chăm sóc y tế toàn diện cho tất cả đối tượng từ trẻ nhỏ đến người cao tuổi. Bệnh viện đầu tiên tại Việt Nam có trung tâm Healthscreening rộng 2000m2 vs hệ thống máy móc tiên tiến, đón tiếp hàng trăm lượt khách khám sức khỏe tổng quát mỗi ngày', '8 Đ. Châu Văn Liêm, Mễ Trì, Nam Từ Liêm, Hà Nội 12013', '024 7300 8866', '../image/imagesBvien/benhviendakhoahongngoc.jpg', 'Nam Từ Liêm', 'Sản - Phụ,Tai Mũi Họng & PT Đầu cổ,Tiêu hóa – Gan – Mật,Ngoại Tổng Hợp,Nam khoa & PT Tiết niệu,Chấn Thương Chỉnh Hình,Cơ - Xương - Khớp,Chẩn đoán hình ảnh và Điện quang can thiệp,Nội tổng hợp,Thận,Nội tiết,Tim mạch,Tâm lý và Sức khỏe tâm thần,Hô hấp,Ung Bướu,Cấp cứu - Hồi sức tích cực ICU,Mắt,Răng - Hàm - Mặt,Da liễu', '105.76911176542535, 21.009470326807644'),
(22, 'Bệnh viện Thể thao Việt Nam', 'Bệnh viện Thể thao Việt Nam là bệnh viện chuyên về y học thể thao đầu tiên và duy nhất của nước ta, chuyên điều trị cho vận động viên, người dân bị chấn thương trong quá trình tham gia hoạt động thể thao.', 'Bệnh viện Thể Thao, Phố P. Đỗ Xuân Hợp, Mỹ Đình, Từ Liêm, Hà Nội', '0359913856', '../image/imagesBvien/benhvienthethaovietnam.jpg', 'Nam Từ Liêm', 'Khám bệnh và Hồi sức cấp cứu,Ngoại chấn thương chỉnh hình và tạo hình,Nội tổng hợp,Vật lý trị liệu - phục hồi chức năng,Y học thể thao,Y học cổ truyền,Mắt,Tai - Mũi - Họng,Răng - Hàm - Mặt,Phẫu thuật - Gây mê hồi sức,Dinh dưỡng,Dược,Xét nghiệm Huyết học,Sinh hóa,Vi sinh,Chống nhiễm khuẩn,Chẩn đoán hình ảnh,Thăm dò chức năng - Nội soi,Giải phẫu bệnh', '105.76149289743626, 21.023126436569484'),
(23, 'Trung tâm Y tế quận Nam Từ Liêm', 'Trung Tâm Y Tế Quận Nam Từ Liêm là cơ quan cấp quận phụ trách các vấn đề về Y tế trên địa bàn Quận Nam Từ Liêm:', '3 Liên Cơ, Phường Cầu Diễn, Quận Nam Từ Liêm, Thành phố Hà Nội', '02437680005', '../image/imagesBvien/trungtamytequannamtuliem.jpg', 'Nam Từ Liêm', '', '105.76575304828282, 21.03880695451069'),
(24, 'Bệnh viện Giao thông Vân tải', 'Bệnh viện Giao thông vận tải Trung ương là một trong 31 Bệnh viện có dịch vụ phục vụ người bệnh tốt nhất trên toàn Quốc năm 2011.', 'P. Huỳnh Thúc Kháng, Láng Thượng, Đống Đa, Hà Nội', '024 3766 9855', '../image/imagesBvien/benhviengiaothongvantai.jpg', 'Đống Đa', 'Hồi sức cấp cứu,Gây mê hồi sức,Ngoại tổng hợp,Răng Hàm Mặt,Tai Mũi Họng,Mắt,Phụ sản sơ sinh,Thận – Lọc máu,Khám sức khỏe,Nội A2,Chẩn đoán hình ảnh,Phẫu thuật thẩm mỹ,Y học cổ truyền,Thăm dò chức năng,Xét nghiệm,Giải phẫu bệnh,Dược,Kiểm soát nhiễm khuẩn', '105.80265527975467, 21.026048872208776'),
(25, 'Bệnh viện Quân y 354', 'Bệnh viện Quân y 354 là bệnh viện đa khoa thuộc Tổng cục hậu cần Quân đội nhân dân Việt Nam. Bệnh viện được thành lập ngày 27 tháng 5 năm 1949 tại Đại Từ, Thái Nguyên với tiền thân là Quân y xá Trần Quốc', '120 P. Đốc Ngữ, Vĩnh Phú, Ba Đình, Hà Nội 10000', '024 3762 2595', '../image/imagesBvien/benhvienquany354.jpg', 'Ba Đình', 'Nội cán bộ,Nội Tim – Thận – Khớp,Nội tiêu hóa – Bệnh máu,Nội truyền nhiễm – Da liễu,Nội Tâm thần kinh,Y học dân tộc,Hồi sức cấp cứu,Khám chữa bệnh nhân dân', '105.81205627286721, 21.040161440232566'),
(26, 'Bệnh viện E', 'Bệnh viện E là bệnh viện đa khoa trung ương hạng I trực thuộc Bộ Y tế,được thành lập theo Quyết định số 175/TTg-Vg của Thủ tướng Chính phủ ngày 17 tháng 10 năm 1967 nhằm đáp ứng yêu cầu điều trị cho cán bộ, chiến sĩ từ chiến trường miền Nam ra. Trải qua 55 năm xây dựng và phát triển, với những thăng trầm của lịch sử, đội ngũ cán bộ, bác sĩ, nhân viên của Bệnh viện E đã vượt qua mọi khó khăn, hoàn thành xuất sắc nhiệm vụ mà Đảng, Chính phủ và Bộ Y tế giao.', '89 Đ. Trần Cung, Nghĩa Tân, Cầu Giấy, Hà Nội', '0868 891 318', '../image/imagesBvien/benhviene.jpg', 'Cầu Giấy', 'Nội Tim mạch,Nội Tiêu hóa,Nội Hô hấp,Nội Thận - Lọc máu,Nội Thần kinh,Nội tiết,Nội cơ xương khớp,Nội Truyền nhiễm,Nội Da liễu,Nội Lao,Nội huyết học,Nội Ung bướu,Nội Dị ứng - Miễn dịch,Ngoại Tổng hợp,Ngoại Tim mạch,Ngoại Lồng ngực,Ngoại Chấn thương Chỉnh hình,Ngoại Tiêu hóa,Ngoại Thận - Tiết niệu,Ngoại Thần kinh,Ngoại Larynx - Họng - Tai - Mũi,Ngoại Mắt,Ngoại Phụ khoa,Ngoại Sản,Ngoại Nhi,Ngoại Da liễu,Ngoại Răng hàm mặt,Ngoại Phẫu thuật tạo hình,Gây mê hồi sức,Hồi sức cấp cứu,Vật lý trị liệu - Phục hồi chức năng,Chẩn đoán hình ảnh,Xét nghiệm,Giải phẫu bệnh,Dược,Y học cổ truyền,Tâm lý - Sức khỏe tâm thần,Dinh dưỡng', '105.78859310525712, 21.050416523746748'),
(27, 'Trung tâm Y tế Quận Tây Hồ', 'Trung tâm y tế quận Tây Hồ là bệnh viện công lập Hạng 3 tại Hà Nội. Bệnh viện đảm bảo chuyên môn và hạ tầng để đảm nhận chức năng thăm khám tại địa phương. Bệnh viện tiếp tục nâng cao năng lực chuyên môn, chất lượng khám chữa bệnh, phấn đấu đạt các tiêu chí Trạm đạt chuẩn Quốc gia về Y tế xã, tiếp tục triển khai nghiên cứu, phát triển danh mục kỹ thuật theo phân tuyến và vượt tuyến tạo điều kiện cho người bệnh tiếp cận với dịch vụ y tế tốt nhất tại địa phương. Hiện tại Trung tâm y tế quận Tây Hồ có trụ sở tại Số 695 Lạc Long Quân, P. Phú Thượng, Q. Tây Hồ.', '710b Đ. Lạc Long Quân, Nhật Tân, Tây Hồ, Hà Nội', '024 3758 8405', '../image/imagesBvien/trungtamytequantayho.jpg', 'Tây Hồ', '', '105.81630284075197, 21.07970783267507'),
(28, 'Bệnh viện Tâm Anh', 'Bệnh Viện Đa Khoa Tâm Anh là địa chỉ uy tín về khám chữa bệnh, với đội ngũ chuyên gia - bác sĩ hàng đầu, trang thiết bị hiện đại, cùng các phác đồ điều trị hiệu quả, khoa học mang đến dịch vụ khám, điều trị, chăm sóc sức khỏe cao cấp, toàn diện với chi phí hợp lý.', '108 P. Hoàng Như Tiếp, Bồ Đề, Long Biên, Hà Nội', '1800 6858', '../image/imagesBvien/benhvientamanh.jpg', 'Long Biên', 'Hỗ trợ sinh sản,Mắt,Nội soi & Phẫu thuật nội soi tiêu hóa,Tiêu hóa – Gan mật – Tụy,Ngoại tổng hợp,Khoa học thần kinh,Chấn thương chỉnh hình,Cơ xương khớp,Tim mạch,Sản Phụ khoa,Tiết niệu – Thận học – Nam khoa,Tiết niệu – Nam học', '105.87693252023604, 21.04067903797926'),
(29, 'Bệnh viện Đa khoa Quốc tế Bắc Hà', 'Bệnh viện Đa Khoa Quốc Tế Bắc Hà đi vào hoạt động từ tháng 12 năm 2016. Được đầu tư xây dựng quy mô ngay từ khi mới bắt đầu nên bệnh viện có hệ thống cơ sở vật chất khang trang, hiện đại. Các Giáo sư Bác sỹ là các chuyên gia đầu ngành trong và ngoài nước cùng đội ngũ nhân viên chuyên nghiệp luôn tận tâm phục vụ, nhằm mang đến cho khách hàng những dịch vụ chăm sóc sức khỏe tốt nhất.', '137 Đ. Nguyễn Văn Cừ, Ngọc Lâm, Long Biên, Hà Nội', '1900 8083', '../image/imagesBvien/benhvienbacha.jpg', 'Long Biên', 'Khám bệnh,Ngoại,Phụ Sản,Nhi,Nội,Xét Nghiệm,CĐHA – TDCN,Dược,Phẫu Thuật Thẩm Mỹ,Mắt,Cơ Xương Khớp,Răng Hàm Mặt', '105.8711743995508, 21.043165042805626'),
(30, 'Bệnh viện Medlatec', 'MEDLATEC tự hào là đơn vị y tế tiên phong triển khai dịch vụ lấy mẫu xét nghiệm tận nơi. Sau 25 năm, Dịch vụ này đã mở rộng tới nhiều tỉnh thành trong cả nước như thành phố Hồ Chí Minh, Bắc Ninh, Hải Dương, Vĩnh Phúc… cùng nhiều dịch vụ khám chuyên khoa như Gan mật, Thai Sản, Tai Mũi Họng, Da liễu, Nam khoa, Phụ khoa, Nhi, Răng Hàm Mặt với đội ngũ bác sĩ, giáo sư đầu ngành và công nghệ tân tiến nhất Việt Nam, luôn đảm bảo sự hài lòng của khách hàng. Hiện nay, MEDLATEC là đơn vị có uy tín cung cấp tư vấn trước và sau khám sức khỏe nhằm chăm sóc sức khỏe cho khách hàng một cách toàn diện nhất. Dịch vụ tư vấn kết quả miễn phí bởi đội ngũ tư vấn từ các chuyên khoa có trình độ chuyên môn cao đã được MEDLATEC đưa vào triển khai từ rất sớm.', '42 P. Nghĩa Dũng, Phúc xá, Ba Đình, Hà Nội 100000', '1900 565656', '../image/imagesBvien/benhvienmedlatec.jpg', 'Ba Đình', 'Cơ Xương Khớp,Thần kinh,Tiêu hoá,Tim mạch,Tai Mũi Họng,Cột sống,Y học Cổ truyền,Châm cứu,Sản Phụ khoa,Siêu âm thai,Nhi khoa,Da liễu,Bệnh Viêm gan,Sức khỏe tâm thần,Dị ứng miễn dịch,Hô hấp - Phổi,Ngoại thần kinh,Nam học,Chuyên khoa Mắt,Thận - Tiết niệu,Nội khoa,Nha khoa,Tiểu đường - Nội tiết,Phục hồi chức năng,Chụp Cộng hưởng từ,Chụp cắt lớp vi tính,Nội soi Tiêu hóa,Ung bướu,Da liễu thẩm mỹ,Truyền nhiễm,Bác sĩ gia đình,Tạo hình Hàm Mặt,Tư vấn,trị liệu Tâm lý,Vô sinh - Hiếm muộn,Chấn thương chỉnh hình,Niềng răng,Bọc răng sứ,Trồng răng implant,Nhổ răng khôn,Nha khoa tổng quát,Nha khoa trẻ em,Tuyến giáp', '105.84626171413561, 21.048539058470624'),
(31, 'Bệnh viện Đa khoa Hòe Nhai', 'Bệnh viện đa khoa Hòe Nhai nằm trên địa bàn Trung tâm của Thủ đô, giáp gianh khu vực phố cổ, với mật độ dân cư đông đúc nên điều kiện cơ sở vật chất còn chật hẹp.', '34 P. Hoè Nhai, Nguyễn Trung Trực, Ba Đình, Hà Nội', '024 3927 2980', '../image/imagesBvien/benhvienhoenhai.jpg', 'Ba Đình', 'Nội khoa,Ngoại khoa,Sản khoa,Nhi khoa,Cấp cứu,Xét nghiệm', '105.8460257297786, 21.040832201431073'),
(33, 'Trung tâm Y tế quận Ba Đình', 'Trung tâm Y tế quận Ba đình là cơ quan cấp quận phụ trách các vấn đề về Y tế', '101 P. Quán Thánh, Quán Thánh, Ba Đình, Hà Nội', '024 3843 2113', '../image/imagesBvien/trungtamytequanbadinh.jpg', 'Ba Đình', 'Nội khoa,Ngoại khoa,Phẫu thuật thẩm mỹ,Cấp cứu,Hồi sức tích cực', '105.83969718746607, 21.042659853204796'),
(34, 'Bệnh viện 69', 'Bệnh viện 69 là một cơ sở y tế đa khoa uy tín nằm trên đường Hoàng Hoa Thám, Ba Đình, Hà Nội. Với mục tiêu cung cấp dịch vụ chăm sóc sức khỏe chất lượng cao, bệnh viện đã đầu tư vào cơ sở vật chất hiện đại và đội ngũ y bác sĩ chuyên nghiệp. Bệnh viện cung cấp nhiều chuyên khoa đa dạng, từ nội khoa, ngoại khoa, đến các dịch vụ phẫu thuật thẩm mỹ tiên tiến, đáp ứng nhu cầu chăm sóc sức khỏe ngày càng cao của người dân.', 'Đ. Hoàng Hoa Thám, Ngọc Hồ, Ba Đình, Hà Nội', '0971 830 166', '../image/imagesBvien/vien69.jpg', 'Ba Đình', 'Nội khoa,Nội khoa Hô hấp,Nội tiết - Thần kinh,Thận - Tiết niệu,Huyết học,Ung bướu,Nhi khoa', '105.83230664106128, 21.03933635808953'),
(35, 'Bệnh viện Saint Paul', 'Là một bệnh viện đa khoa tuyến cuối trực thuộc Sở Y tế Hà Nội. Cùng với các bệnh viện chuyên ngành như: Bệnh viện Mắt Hà Nội, Bệnh viện Tim Hà Nội, Bệnh viện Thận Hà Nội, Bệnh viện Phụ sản Hà Nội, Bệnh viện Việt Nam-Cuba (Tai Mũi Họng-Răng Hàm Mặt), Bệnh viện Phổi Hà Nội, Bệnh viện Ung bướu Hà Nội, Bệnh viện Da liễu Hà Nội,.v..vv... và các bệnh viện khu vực, trung tâm y tế quận/huyện tạo thành mạng lưới y tế hoàn chỉnh của thủ đô. Bệnh viện tọa lạc tại trung tâm thành phố Hà Nội, Việt Nam bao quanh bởi 4 con đường: Nguyễn Thái Học - Chu Văn An - Trần Phú - Hùng Vương.', '12 P. Chu Văn An, Điện Biên, Ba Đình, Hà Nội 100000', '024 3823 3075', '../image/imagesBvien/benhvienxanhpon.jpg', 'Ba Đình', 'Nội khoa,Ngoại khoa,Sản khoa,Nhi khoa,Tai-Mũi-Họng,Da liễu,Mắt,Tim mạch,Thận-Tiết niệu,Phẫu thuật tạo hình', '105.83520089038956, 21.031245549974955'),
(36, 'Bệnh viện Da liễu Hà Nội', 'Bệnh viện da liễu Hà Nội là một trong những bệnh viện công lập chú trọng song song về cả chất lượng khám chữa bệnh và dịch vụ chăm sóc thẩm mỹ da tại miền Bắc. Bệnh viện da liễu Hà Nội mang đến cho mọi bệnh nhân cũng như quý khách hàng có những trải nghiệm tốt nhất khi đến khám chữa bệnh và chăm sóc sức khỏe.', '79B Nguyễn Khuyến, Q. Đống Đa, TP. Hà Nội', '0903 479 619', '../image/imagesBvien/benhviendalieuhanoi.jpg', 'Đống Đa', 'Da liễu,Thẩm mỹ da,Laser thẩm mỹ,Dị ứng miễn dịch lâm sàng', '105.83857990067366, 21.02813152560067'),
(37, 'Bệnh viện Đa khoa Quốc tế Hồng Hà', 'Bệnh viện Đa khoa Hồng Hà hiện đang sở hữu hơn 20 chuyên khoa như: Khoa sản Phụ, Trung tâm PTTM LGBT Hồng Hà, Khoa Phẫu thuật và Tạo hình thẩm mỹ, Khoa Ung bướu, Khoa Thận – Tiết niệu, Khoa Tai – Mũi – Họng… phục vụ đông đảo các đối tượng khách hàng khác nhau', '16 P. Nguyễn Như Đổ, Văn Miếu, Đống Đa, Hà Nội 100000', '024 7303 0988', '../image/imagesBvien/benhviendakhoahongha.jpg', 'Đống Đa', 'Nội khoa,Ngoại khoa,Sản khoa, Nhi khoa,Tai-Mũi-Họng, Da liễu,Thận-Tiết niệu,Ung bướu,Phẫu thuật thẩm mỹ,Y học cổ truyền', '105.83905039570607, 21.026840649548078'),
(38, 'Bệnh Viện Răng Hàm Mặt Trung Ương Hà Nội', 'Bệnh viện Răng Hàm Mặt Trung ương Hà Nội là Bệnh viện chuyên khoa Răng Hàm Mặt đầu ngành, hạng 1 trực thuộc Bộ Y tế, đồng thời là trung tâm nghiên cứu khoa học và là cơ sở đào tạo, bồi dưỡng nhân lực y tế chuyên ngành Răng Hàm Mặt.', '40B P. Tràng Thi, Hàng Bông, Hoàn Kiếm, Hà Nội', '0867 732 939', '../image/imagesBvien/benhvienrhmtuhn.png', 'Hoàn Kiếm', 'Răng Hàm Mặt,Phẫu thuật chỉnh hình,Nha khoa trẻ em,Cấy ghép nha khoa', '105.84637868360738, 21.027758905457418'),
(39, 'Bệnh viện Tim Hà Nội', 'Bệnh viện Tim Hà Nội là cơ sở y tế chuyên về tim mạch, được trang bị thiết bị hiện đại và đội ngũ chuyên gia hàng đầu. Bệnh viện cung cấp dịch vụ chăm sóc sức khỏe tim mạch toàn diện, bao gồm chẩn đoán, điều trị và phục hồi chức năng tim mạch.', '92 Trần Hưng Đạo, Cửa Nam, Hoàn Kiếm, Hà Nội', '024 3942 2430', '../image/imagesBvien/benhvientimhanoi.jpg', 'Hoàn Kiếm', 'Tim mạch,Phẫu thuật tim,Can thiệp tim mạch,Chẩn đoán hình ảnh tim mạch', '105.84395492369038, 21.0240060094941'),
(40, 'Bệnh viện Đa khoa Phương Đông', 'Bệnh viện Đa khoa Phương Đông được xây dựng theo mô hình bệnh viện - khách sạn 5 sao với triết lý chữa cả Tâm bệnh lẫn Thân bệnh. Với phương châm chia sẻ giá trị tốt đẹp cho xã hội về chăm sóc sức khoẻ, bệnh viện đa khoa Phương Đông ra đời đánh dấu thêm bước tiến mới trên hành trình “Toả sáng cùng đất nước”. Kết tinh những giá trị riêng có, Phương Đông xứng đáng là nơi gửi trọn niềm tin của quý khách hàng. Nền tảng sức mạnh từ chủ đầu tư Được xây dựng và thành lập bởi Công ty TNHH Tổ hợp Y tế Phương Đông – Đơn vị thành viên của tập đoàn Intracom, Bệnh viện đa khoa Phương Đông có nền tảng sức mạnh vững chắc về mọi mặt, từ năng lực tài chính, bộ máy con người, cơ sở…', 'Số 9 P. Viên, Cổ Nhuế, Bắc Từ Liêm, Hà Nội', '1900 1806', '../image/imagesBvien/benhviendakhoaphuongdong.jpg', 'Bắc Từ Liêm', 'Nội khoa,Ngoại khoa,Sản khoa,Nhi khoa,Tai-Mũi-Họng,Mắt,Da liễu,Thận-Tiết niệu,Tim mạch,Chấn thương chỉnh hình,Phục hồi chức năng,Y học cổ truyền', '105.77517635705908, 21.070182745500517'),
(41, 'Bệnh viện Sông Hồng', 'Bệnh viện Sông Hồng là cơ sở y tế đa khoa tại Gia Lâm, Hà Nội, cung cấp các dịch vụ chăm sóc sức khỏe chất lượng cao. Bệnh viện được trang bị cơ sở vật chất hiện đại và đội ngũ y bác sĩ giàu kinh nghiệm. Bệnh viện Sông Hồng hướng tới việc mang lại sự chăm sóc y tế tốt nhất cho cộng đồng, với nhiều chuyên khoa và dịch vụ y tế đa dạng đáp ứng nhu cầu khám và điều trị của bệnh nhân.', 'XWMC+2PQ, Đa Tốn, Gia Lâm, Hà Nội', '0963 792 200', '../image/imagesBvien/benhviendakhoanamsonghong.png', 'Gia Lâm', 'Nội khoa,Ngoại khoa,Sản khoa,Nhi khoa,Tai-Mũi-Họng, Mắt,Da liễu,Tim mạch,Chấn thương chỉnh hình,Phục hồi chức năng,Y học cổ truyền', '105.92170227560325, 20.982683454354927'),
(51, 'Bệnh viện Bạch Mai Hà Nội', 'Bệnh viện Bạch Mai là Bệnh viện Đa khoa hoàn chỉnh hạng đặc biệt đầu tiên của Việt Nam là tuyến cao nhất trong bậc thang điều trị của ngành y tế. Bệnh viện hiện có 56 đơn vị với quy mô 3200 giường bệnh và hơn 4000 cán bộ và nhân viên y tế đang phục vụ công tác', 'Bệnh viện Bạch Mai, 78, Đường Giải Phóng, Phường Phương Mai, Quận Đống Đa, Hà Nội, 10181, Việt Nam', '1900 888 866', '../image/imagesBvien/bvBachMai.jpg', 'Đống Đa', 'A9 - Cấp cứu, Thần kinh, Tim mạch, Tiêu hóa, Hô hấp, Nội tiết, Nhi, Huyết học - Truyền máu, Nội tổng hợp, Dược, Xét nghiệm, Chẩn đoán hình ảnh, Phẫu thuật thần kinh, Phẫu thuật tim mạch, Phẫu thuật tiêu hóa, Phẫu thuật lồng ngực, Phẫu thuật chỉnh hình, Mắt, Tai mũi họng, Răng hàm mặt, Da liễu, Thận - Tiết niệu, Phụ sản, Y học cổ truyền, Y học hạt nhân, Dinh dưỡng, Tâm thần', '105.83967220821572, 21.00181675'),
(52, 'Bệnh viện Thanh Nhàn', 'Bệnh viện Thanh Nhàn là một trong bốn bệnh viện thuộc phân nhóm Bệnh viên đa khoa Hạng I trên địa bàn Hà Nội. Đơn vị cung cấp dịch vụ thăm khám, điều trị nội ngoại trú cho tất các các chuyên khoa. Trong những năm gần đây, cơ sở chú trọng cải tạo và đưa vào sử dụng các tòa nhà khang trang, được trang bị cơ sở vật chất hiện đại, đáp ứng nhu cầu chăm sóc sức khỏe của bệnh nhân nội, ngoại thành và trên cả nước.', 'Bệnh viện Thanh Nhàn, Phố Thanh Nhàn, Phường Thanh Nhàn, Quận Hai Bà Trưng, Hà Nội, 11617, Việt Nam', '0911224099', '../image/imagesBvien/benhvienthanhnhan.jpg', 'Hai Bà Trưng', 'Cấp cứu, Hồi sức tích cực, Nội khoa, Ngoại khoa, Sản khoa, Nhi khoa, Tai Mũi Họng, Răng Hàm Mặt, Mắt, Da liễu, Y học cổ truyền, Vật lý trị liệu - Phục hồi chức năng, Thận - Tiết niệu, Tim mạch, Tiêu hóa, Nội tiết, Hô hấp, Thần kinh, Huyết học - Truyền máu, Xét nghiệm, Chẩn đoán hình ảnh, Phẫu thuật tổng quát, Phẫu thuật chuyên khoa, Dược, Dinh dưỡng, Tâm thần, Kiểm soát nhiễm khuẩn', '105.8591777, 21.0028792');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rate_hospitals`
--

CREATE TABLE `rate_hospitals` (
  `id_rate` int(11) NOT NULL,
  `id_hopital` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rating` decimal(3,2) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `rate_hospitals`
--

INSERT INTO `rate_hospitals` (`id_rate`, `id_hopital`, `id_user`, `name`, `rating`, `comment`, `created_at`) VALUES
(15, 2, 6, 'Bệnh viện Đức Phúc', 5.00, 'Chất lượng dịch vụ tốt lắm', '2024-05-25 10:26:21'),
(16, 4, 6, 'Viện Y học Phòng không - Không quân', 5.00, 'Quá tuyệt với', '2024-05-25 15:58:20'),
(58, 1, 8, 'Bệnh viện 108 Quân đội', 4.00, 'Bệnh viện này rất tốt.', '2024-05-26 02:18:53'),
(59, 1, 10, 'Bệnh viện 108 Quân đội', 3.00, 'Phục vụ khá.', '2024-05-26 02:18:53'),
(60, 1, 11, 'Bệnh viện 108 Quân đội', 5.00, 'Tuyệt vời!', '2024-05-26 02:18:53'),
(61, 2, 14, 'Bệnh viện Đức Phúc', 5.00, 'Đội ngũ bác sĩ rất chuyên nghiệp.', '2024-05-26 02:18:53'),
(62, 2, 15, 'Bệnh viện Đức Phúc', 4.00, 'Phục vụ nhanh chóng.', '2024-05-26 02:18:53'),
(63, 2, 16, 'Bệnh viện Đức Phúc', 3.00, 'Không gian thoải mái.', '2024-05-26 02:18:53'),
(64, 3, 17, 'Bệnh viện Đa khoa quận Đống Đa', 2.00, 'Đợi lâu khi khám bệnh.', '2024-05-26 02:18:53'),
(65, 3, 8, 'Bệnh viện Đa khoa quận Đống Đa', 4.00, 'Cơ sở vật chất tốt.', '2024-05-26 02:18:53'),
(66, 3, 9, 'Bệnh viện Đa khoa quận Đống Đa', 3.00, 'Giá cả hợp lý.', '2024-05-26 02:18:53'),
(67, 4, 10, 'Viện Y học Phòng không - Không quân', 5.00, 'Dịch vụ chăm sóc tốt.', '2024-05-26 02:18:53'),
(68, 4, 11, 'Viện Y học Phòng không - Không quân', 4.00, 'Đội ngũ y tá nhiệt tình.', '2024-05-26 02:18:53'),
(69, 4, 12, 'Viện Y học Phòng không - Không quân', 3.00, 'Phòng chờ không thoải mái.', '2024-05-26 02:18:53'),
(70, 5, 13, 'Bệnh viện Mắt Hồng Sơn', 5.00, 'Phẫu thuật thành công.', '2024-05-26 02:18:53'),
(71, 5, 14, 'Bệnh viện Mắt Hồng Sơn', 4.00, 'Bác sĩ thân thiện.', '2024-05-26 02:18:53'),
(72, 5, 15, 'Bệnh viện Mắt Hồng Sơn', 3.00, 'Đợi lâu khi khám.', '2024-05-26 02:18:53'),
(73, 6, 16, 'Phòng khám quốc tế Vinmec Times City', 4.00, 'Dịch vụ chuyên nghiệp.', '2024-05-26 02:18:53'),
(74, 6, 17, 'Phòng khám quốc tế Vinmec Times City', 5.00, 'Bác sĩ giỏi.', '2024-05-26 02:18:53'),
(75, 6, 8, 'Phòng khám quốc tế Vinmec Times City', 3.00, 'Không gian chật chội.', '2024-05-26 02:18:53'),
(76, 7, 9, 'Bệnh viện Đại học Y Hà Nội - Cơ sở Hoàng Mai', 4.00, 'Phục vụ tốt.', '2024-05-26 02:18:53'),
(77, 7, 10, 'Bệnh viện Đại học Y Hà Nội - Cơ sở Hoàng Mai', 5.00, 'Đội ngũ y tá nhiệt tình.', '2024-05-26 02:18:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id_user`, `name`, `address`, `email`, `username`, `password`, `role`, `created_at`) VALUES
(5, 'manhduong2953', 'Hà Nội', 'manhd5749@gmail.com', 'Dương Văn Mạnh', '$2y$10$YPY0IAuBDwg7sUrX9IVN9enMBMYvg1WruvFF3Jg9UkG70J5boeseG', 1, '2024-05-25 23:19:28'),
(6, 'thaitieu123', 'Đường Láng Hạ, Đống Đa, Hà Nội', 'tieucongthai123@gmail.com', 'Tiêu Công Thái', '$2y$10$HXZDDeE/S/E9vDvrXWNcte.lrPrbrqYY3VeprZnVWqwnEssQlB6g2', 0, '2024-05-25 23:19:28'),
(8, 'Nguyen Van A', '123 Đường ABC, Quận 1, TP. HCM', 'nva@gmail.com', 'nguyenvana', 'password1', 0, '2024-05-26 09:01:24'),
(9, 'Tran Thi B', '456 Đường XYZ, Quận 2, TP. HCM', 'ttb@gmail.com', 'tranthib', 'password2', 0, '2024-05-26 09:01:24'),
(10, 'Le Van C', '789 Đường DEF, Quận 3, TP. HCM', 'lvc@gmail.com', 'levanc', 'password3', 0, '2024-05-26 09:01:24'),
(11, 'Pham Thi D', '101 Đường GHI, Quận 4, TP. HCM', 'ptd@gmail.com', 'phamthid', 'password4', 1, '2024-05-26 09:01:24'),
(12, 'Hoang Van E', '202 Đường JKL, Quận 5, TP. HCM', 'hve@gmail.com', 'hoangvane', 'password5', 0, '2024-05-26 09:01:24'),
(13, 'Dang Thi F', '303 Đường MNO, Quận 6, TP. HCM', 'dtf@gmail.com', 'dangthif', 'password6', 0, '2024-05-26 09:01:24'),
(14, 'Nguyen Thi G', '404 Đường PQR, Quận 7, TP. HCM', 'ntg@gmail.com', 'nguyentg', 'password7', 1, '2024-05-26 09:01:24'),
(15, 'Tran Van H', '505 Đường STU, Quận 8, TP. HCM', 'tvh@gmail.com', 'tranvanh', 'password8', 0, '2024-05-26 09:01:24'),
(16, 'Le Thi I', '606 Đường VWX, Quận 9, TP. HCM', 'lti@gmail.com', 'lethii', 'password9', 0, '2024-05-26 09:01:24'),
(17, 'Pham Van J', '707 Đường YZA, Quận 10, TP. HCM', 'pvj@gmail.com', 'phamvanj', 'password10', 0, '2024-05-26 09:01:24');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id_appointments`),
  ADD KEY `id_hopital` (`id_hopital`),
  ADD KEY `id_user` (`id_user`);

--
-- Chỉ mục cho bảng `crud_hopital_location`
--
ALTER TABLE `crud_hopital_location`
  ADD PRIMARY KEY (`id_hopital`);

--
-- Chỉ mục cho bảng `rate_hospitals`
--
ALTER TABLE `rate_hospitals`
  ADD PRIMARY KEY (`id_rate`),
  ADD KEY `id_hopital` (`id_hopital`),
  ADD KEY `id_user` (`id_user`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id_appointments` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `crud_hopital_location`
--
ALTER TABLE `crud_hopital_location`
  MODIFY `id_hopital` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `rate_hospitals`
--
ALTER TABLE `rate_hospitals`
  MODIFY `id_rate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`id_hopital`) REFERENCES `crud_hopital_location` (`id_hopital`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `rate_hospitals`
--
ALTER TABLE `rate_hospitals`
  ADD CONSTRAINT `rate_hospitals_ibfk_1` FOREIGN KEY (`id_hopital`) REFERENCES `crud_hopital_location` (`id_hopital`) ON DELETE CASCADE,
  ADD CONSTRAINT `rate_hospitals_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
