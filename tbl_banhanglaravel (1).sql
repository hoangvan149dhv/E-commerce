-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 23, 2020 lúc 06:11 AM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `tbl_banhanglaravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_05_16_024627_create_tbl_slider', 1),
(2, '2014_10_12_000000_create_users_table', 2),
(3, '2014_10_12_100000_create_password_resets_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_Id` int(11) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_pass` varchar(50) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_phone` text NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_Id`, `admin_email`, `admin_pass`, `admin_name`, `admin_phone`, `pass`) VALUES
(1, 'hoangvan', 'b502e8023901df1e74e95c9b86dc5913', 'Văn', '123456', 'hoangvan'),
(3, 'ngan', '4df26b7d69a26516915261039bbb1cb6', 'ngan', '123456', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_brand_code_product`
--

CREATE TABLE `tbl_brand_code_product` (
  `code_id` int(11) NOT NULL,
  `brandcode_id` varchar(70) NOT NULL,
  `brandcode_name` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_brand_code_product`
--

INSERT INTO `tbl_brand_code_product` (`code_id`, `brandcode_id`, `brandcode_name`) VALUES
(2, 'Vải in màu', 'Vải in màu'),
(4, 'Vải in 3D', 'Vải in 3D'),
(5, 'Vải Lụa Thái Tuấn', 'Vải Lụa Thái Tuấn'),
(6, 'Vải Lụa Sunny', 'Vải Lụa Sunny'),
(7, 'Vải Lụa gấm', 'Vải lụa gấm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category_product`
--

CREATE TABLE `tbl_category_product` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_desc` varchar(100) NOT NULL,
  `category_status` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_category_product`
--

INSERT INTO `tbl_category_product` (`category_id`, `category_name`, `category_desc`, `category_status`) VALUES
(2, 'Hoa Đa Dạng', 'Hoa Đa Dạng', 1),
(4, 'Độc và lạ', 'Độc và lạ', 1),
(5, 'Hình lập thể', 'Hình lập thể', 1),
(7, 'Đa sắc', 'Đa sắc', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `Con_Id` int(11) NOT NULL,
  `Con_Name` varchar(70) NOT NULL,
  `Con_Email` varchar(70) NOT NULL,
  `Con_Content` text NOT NULL,
  `status` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_contact`
--

INSERT INTO `tbl_contact` (`Con_Id`, `Con_Name`, `Con_Email`, `Con_Content`, `status`, `updated_at`, `created_at`) VALUES
(19, 'Dương Hoàng Văn', 'vandaovipga1491999@gmail.com', 'sdasfsagwehgaerhjejttaj', 0, '2020-08-20 02:57:43', '2020-08-19 19:57:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_count`
--

CREATE TABLE `tbl_count` (
  `id` int(11) NOT NULL,
  `counts` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_count`
--

INSERT INTO `tbl_count` (`id`, `counts`) VALUES
(1, 273),
(1, 273),
(1, 274);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `cusid` int(11) NOT NULL,
  `cusname` varchar(70) NOT NULL,
  `cusadd` varchar(70) NOT NULL,
  `cusPhone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_customer`
--

INSERT INTO `tbl_customer` (`cusid`, `cusname`, `cusadd`, `cusPhone`) VALUES
(71, 'Dương Hoàng Văn', '45/45/45 Nguyễn Phúc Chu', '0334964103'),
(72, 'Duong hoang van', 'aasdsad', '0334964103'),
(73, 'duong hoanb van', '45/45/45 Nguyễn Phúc Chu', '1234567890'),
(74, 'Duong hoang van', '45/45/45 Nguyễn Phúc Chu', '0334964103'),
(75, 'Dương Hoàng Văn', '45/45/45 Nguyễn Phúc Chu. Phường 14. Quận Tân Bình', '0334964103'),
(76, 'Dương Hoàng Văn', '45/45/45 Nguyễn Phúc Chu', '0334964103');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_info_contact`
--

CREATE TABLE `tbl_info_contact` (
  `id_Info` int(11) NOT NULL,
  `info_contact_add` varchar(100) NOT NULL,
  `info_contact_phone` varchar(11) NOT NULL,
  `info_contact_mail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_info_contact`
--

INSERT INTO `tbl_info_contact` (`id_Info`, `info_contact_add`, `info_contact_phone`, `info_contact_mail`) VALUES
(1, '65 Huỳnh Phúc Kháng Phường 15', '0334964103', 'hoangvan1491999@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_news`
--

CREATE TABLE `tbl_news` (
  `news_id` int(11) NOT NULL,
  `news_title` varchar(255) NOT NULL,
  `news_desc` text NOT NULL,
  `news_image` varchar(255) NOT NULL,
  `news_content` text NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_news`
--

INSERT INTO `tbl_news` (`news_id`, `news_title`, `news_desc`, `news_image`, `news_content`, `updated_at`, `created_at`) VALUES
(6, 'Vì sao áo dài được xem là biểu tượng cho trang phục truyền thống của người Việt?', 'Đất nước Việt Nam đã trải qua hơn hàng nghìn năm xây dựng và gìn giữ, song cũng đã hình thành nhiều nét đẹp văn hóa, bản sắc và truyền thống dân tộc riêng. Trong số đó, trang phục truyền thống áo dài chính là niềm tự hào mỗi khi bạn bè quốc tế nhắc đến Việt Nam.', '94545259_648210152424822_1003256192287375360_o23.jpg', '<p>Mỗi một người dân của nước Việt đều rất quen thuộc với hình ảnh chiếc áo dài, nhưng lại rất ít người biết đến nguồn gốc của loại trang phục truyền thống này. Theo sử sách thì áo dài lần đầu tiên được thiết kế dưới thời chúa Nguyễn Phúc Khoát (1744), do sự ảnh hưởng sâu sắc của văn hóa Trung hoa về lối trang phục kín đáo nên chiếc áo dài được thiết kế cổ đứng cài khuy không để hở phần áo lót như kiểu áo tứ thân lúc bấy giờ, sau đó đã được lưu truyền rộng rãi qua các triều đại và cũng trải qua nhiều lần cải cách để có được chiếc áo dài như hiện nay. Do đó mà chiếc áo dài Việt Nam vừa được hội tụ tinh hoa nghệ thuật trong và ngoài nước, vừa là linh hồn của cả dân tộc ta.</p>\r\n\r\n<p><img alt=\"Áo dài truyền thống Việt Nam\" src=\"https://www.tuvantieccuoi.com/imgs/images/ao-dai-truyen-thong-viet-nam2.jpg\" /></p>\r\n\r\n<p>Theo đó, áo dài được mặc chung với quần dài ống rộng, thường đi đôi với khăn xếp cho nam và khăn gấm hoặc nón lá cho nữ. Áo dài của nữ thì ôm vừa sát người, giúp tôn lên sắc vóc của người phụ nữ Việt Nam một cách tuyệt đối, còn của nam thì bao giờ cũng được may rộng rãi, thoải mái hơn.</p>\r\n\r\n<p><img alt=\"Áo dài truyền thống Việt Nam\" src=\"https://www.tuvantieccuoi.com/imgs/images/ao-dai-truyen-thong-viet-nam3.jpg\" /></p>\r\n\r\n<p>Từ khi chiếc áo dà ra đời đã cho thấy sức hút của nó. Áo dài nữ mặc nhìn vừa nữ tính, đoan trang lại vừa lễ tiết, còn nam mặc thì vừa thanh lịch vừa nhã nhặn. Nếu ngày xưa, áo dài thường chỉ được sử dụng trong các dịp lễ tết, hoặc các ngày trọng đại, thì ngày nay, áo dài còn rất được ưa chuộng và sử dụng rộng rãi làm đồng phục của các trường trung học, các công ty hay các hãng hàng không (như Việt Nam Airline, Việt Jet Air, Air MeKong, ...), đồng phục cho nhân viên của các tòa soạn, đài truyền hình và thậm chí là các cửa hàng lớn nhỏ trong nước, v.v…</p>\r\n\r\n<p><img alt=\"Áo dài truyền thống Việt Nam\" src=\"https://www.tuvantieccuoi.com/imgs/images/ao-dai-truyen-thong-viet-nam4.jpg\" /></p>\r\n\r\n<p>Tất cả mọi người đều tự tin diện trang phục áo dài. Bởi lẽ áo dài là một thiết kế không kén chọn người mặc, từ nhà giàu đến bình dân, từ người già đến trẻ nhỏ, ai ai cũng có thể mặc được chiếc áo dài.</p>\r\n\r\n<p><img alt=\"Áo dài truyền thống Việt Nam\" src=\"https://www.tuvantieccuoi.com/imgs/images/ao-dai-truyen-thong-viet-nam5.jpg\" /></p>\r\n\r\n<p>Với sự phát triển của thế giới hiện đại, tuy chiếc áo dài Việt Nam đã có nhiều sự cải biến nhưng vẫn giữ được cái cốt vốn có của nó.</p>\r\n\r\n<p><img alt=\"Áo dài truyền thống Việt Nam\" src=\"https://www.tuvantieccuoi.com/imgs/images/ao-dai-truyen-thong-viet-nam6.jpg\" /></p>\r\n\r\n<p><img alt=\"Áo dài truyền thống Việt Nam\" src=\"https://www.tuvantieccuoi.com/imgs/images/ao-dai-truyen-thong-viet-nam7.jpg\" /></p>\r\n\r\n<p>Đó chính là những chiếc áo dài cách tân đầy tính sáng tạo, đưa phong cách hiện đại pha lẫn vào nét cổ truyền một cách tinh tế và hoàn mĩ. Tùy theo tính chất của sự kiện mà người sử dụng có thể lựa chọn các kiểu cách phù hợp.</p>\r\n\r\n<p><img alt=\"Áo dài truyền thống Việt Nam\" src=\"https://www.tuvantieccuoi.com/imgs/images/ao-dai-truyen-thong-viet-nam8.jpg\" /></p>\r\n\r\n<p>Điều đó đã làm đa dạng thêm cho hình ảnh chiếc áo dài truyền thống, cũng là làm phong phú thêm sự chọn lựa của mỗi người. Ngày nay, áo dài cách tân được đón nhận như một làn gió mới trong giới thời trang Việt Nam, mang phong cách mới lạ pha trộn giữ hiện đại và truyền thống rất sắc xảo.</p>\r\n\r\n<p><img alt=\"Áo dài truyền thống Việt Nam\" src=\"https://www.tuvantieccuoi.com/imgs/images/ao-dai-truyen-thong-viet-nam9.jpg\" /></p>\r\n\r\n<p>Áo dài được lưu truyền cho đến ngày nay đã được gần ba thế kỉ, đã đồng hành cùng bề dày lịch sử dân tộc ta, cùng mảnh đất quê hương Việt Nam hứng chịu hàng nghìn trận bom đạn của kẻ thù đến xâm lược và đứng nhìn đất nước ta ngày càng đổi mới. Ngày nay, có rất nhiều chương trình truyền hình tôn vinh nét đẹp của chiếc áo dài, đồng thời cũng là tôn vinh nét đẹp của người phụ nữ Việt Nam như các cuộc thi thiết kế áo dài, các cuộc thi hoa hậu, v.v…</p>\r\n\r\n<p><img alt=\"Áo dài truyền thống Việt Nam\" src=\"https://www.tuvantieccuoi.com/imgs/images/ao-dai-truyen-thong-viet-nam10.jpg\" /></p>\r\n\r\n<p><img alt=\"Áo dài truyền thống Việt Nam\" src=\"https://www.tuvantieccuoi.com/imgs/images/ao-dai-truyen-thong-viet-nam11.jpg\" /></p>\r\n\r\n<p>Hình ảnh người con gái Việt Nam yêu kiều trong chiếc áo dài thướt tha ấy đã đi khắp năm châu, xuất hiện trên nhiều báo chí, thậm chí là các cuộc thi hoa hậu cấp quốc tế. Nhận được sự ngưỡng mộ của toàn thế giới và trở thành trang phục mà hầu hết các vị khách nước ngoài đều mong muốn được mặc thử một lần khi đến Việt Nam.</p>', '2020-04-28 00:00:00', '2020-05-31 00:00:00'),
(7, 'Lịch sử phát triển của áo dài Việt Nam', 'Áo dài là biểu tượng của phụ nữ Việt Nam - duyên dáng và đằm thắm không thể trộn lẫn.', '94316912_648208452424992_2217525515101667328_o98.jpg', '<p>Trải qua biết bao chặng đường và đổi thay nhưng tà áo dài Việt Nam vẫn giữ nguyên được bản sắc văn hóa của đất nước nghìn năm văn hiến...</p>\r\n\r\n<p>Áo dài là biểu hiện của bản sắc, cốt cách tinh thần Việt Nam. Áo dài đã vượt qua mọi thử thách để trở thành \"quốc phục\", một biểu tượng của phụ nữ, niềm kiêu hãnh của dân tộc Việt Nam.&nbsp;</p>\r\n\r\n<p><img alt=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 1\" src=\"https://icdn.dantri.com.vn/thumb_w/640/2020/03/08/ao-1-1583661112289.jpg\" title=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 1\" /></p>\r\n\r\n<p>Nhấn để phóng to ảnh</p>\r\n\r\n<p>Nữ sinh Trường THPT Huỳnh Thúc Kháng trong trang phục áo dài.</p>\r\n\r\n<p>Từ ngày 2/3 đến ngày 8/3, Trung ương Hội Liên hiệp phụ nữ Việt Nam phối hợp với Bộ Văn hóa, Thể thao và Du lịch phát động tuần lễ phụ nữ cả nước mặc áo dài.&nbsp;</p>\r\n\r\n<p>Đây là hoạt động trong khuôn khổ sự kiện \"Áo dài - Di sản văn hóa Việt Nam\" nhân kỷ niệm 90 năm thành lập Hội Liên hiệp Phụ nữ Việt Nam, 110 năm Ngày Quốc tế phụ nữ 8/3.</p>\r\n\r\n<p>Hưởng ứng tuần lễ áo dài nói trên, tại Trường Quốc học Vinh - THPT Huỳnh Thúc Kháng (Nghệ An), các cô giáo và các em nữ sinh đã thực hiện và duy trì việc mặc áo dài vào các ngày lễ và vào sáng thứ 2 hàng tuần trong suốt 15 năm qua.</p>\r\n\r\n<p>Chính vì thế, cô và trò Trường THPT Huỳnh Thúc Kháng đã tích cực, sôi nổi hưởng ứng “Tuần lễ áo dài” từ ngày 2/3/2020 đến ngày 8/3/2020 và mặc đồng loạt trong ngày 6/3/2020.&nbsp;</p>\r\n\r\n<p><em>Một số hình ảnh của các cô giáo và nữ sinh Trường THPT Huỳnh Thúc Kháng trong \"Tuần lễ Áo dài\":</em></p>\r\n\r\n<p><img alt=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 2\" src=\"https://icdn.dantri.com.vn/thumb_w/640/2020/03/08/ao-2-1583661111944.jpg\" title=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 2\" /></p>\r\n\r\n<p>Nhấn để phóng to ảnh</p>\r\n\r\n<p><img alt=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 3\" src=\"https://icdn.dantri.com.vn/thumb_w/640/2020/03/08/ao-18-1583661113310.jpg\" title=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 3\" /></p>\r\n\r\n<p>Nhấn để phóng to ảnh</p>\r\n\r\n<p><img alt=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 4\" src=\"https://icdn.dantri.com.vn/thumb_w/640/2020/03/08/ao-3-1583661113167.jpg\" title=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 4\" /></p>\r\n\r\n<p>Nhấn để phóng to ảnh</p>\r\n\r\n<p><img alt=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 5\" src=\"https://icdn.dantri.com.vn/thumb_w/640/2020/03/08/ao-5-1583661113125.jpg\" title=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 5\" /></p>\r\n\r\n<p>Nhấn để phóng to ảnh</p>\r\n\r\n<p><img alt=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 6\" src=\"https://icdn.dantri.com.vn/thumb_w/640/2020/03/08/ao-7-1583661112729.jpg\" title=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 6\" /></p>\r\n\r\n<p>Nhấn để phóng to ảnh</p>\r\n\r\n<p><img alt=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 7\" src=\"https://icdn.dantri.com.vn/thumb_w/640/2020/03/08/ao-15-1583661114090.jpg\" title=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 7\" /></p>\r\n\r\n<p>Nhấn để phóng to ảnh</p>\r\n\r\n<p><img alt=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 8\" src=\"https://icdn.dantri.com.vn/thumb_w/640/2020/03/08/ao-13-1583661113841.jpg\" title=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 8\" /></p>\r\n\r\n<p>Nhấn để phóng to ảnh</p>\r\n\r\n<p><img alt=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 9\" src=\"https://icdn.dantri.com.vn/thumb_w/640/2020/03/08/ao-8-1583661114047.jpg\" title=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 9\" /></p>\r\n\r\n<p>Nhấn để phóng to ảnh</p>\r\n\r\n<p>Hưởng ứng tuần lễ áo dài nói trên, tại Trường Quốc học Vinh - THPT Huỳnh Thúc Kháng, các cô giáo và các em nữ sinh đã thực hiện và duy trì việc mặc áo dài vào các ngày lễ và vào sáng thứ 2 hàng tuần trong suốt 15 năm qua.</p>\r\n\r\n<p><img alt=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 10\" src=\"https://icdn.dantri.com.vn/thumb_w/640/2020/03/08/ao-14-1583661113128.jpg\" title=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 10\" /></p>\r\n\r\n<p>Nhấn để phóng to ảnh</p>\r\n\r\n<p><img alt=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 11\" src=\"https://icdn.dantri.com.vn/thumb_w/640/2020/03/08/ao-11-1583661114186.jpg\" title=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 11\" /></p>\r\n\r\n<p>Nhấn để phóng to ảnh</p>\r\n\r\n<p><img alt=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 12\" src=\"https://icdn.dantri.com.vn/thumb_w/640/2020/03/08/ao-4-1583661114156.jpg\" title=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 12\" /></p>\r\n\r\n<p>Nhấn để phóng to ảnh</p>\r\n\r\n<p><img alt=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 13\" src=\"https://icdn.dantri.com.vn/thumb_w/640/2020/03/08/ao-6-1583661114152.jpg\" title=\"Áo dài học đường - Dấu ấn khó phai trong “Tuần lễ Áo dài” - 13\" /></p>\r\n\r\n<p>Nhấn để phóng to ảnh</p>\r\n\r\n<p>Chính vì thế, cô và trò Trường THPT Huỳnh Thúc Kháng đã rất tích cực, sôi nổi hưởng ứng “Tuần lễ áo dài” từ ngày 2/3/2020 đến ngày 8/3/2020 và mặc đồng loạt trong ngày 6/3/2020.</p>', '2020-04-28 00:00:00', '2020-05-31 06:15:59'),
(8, '1001 kiểu áo dài đi học đẹp duyên dáng cho học sinh năm 2020', 'Áo dài là một trang phục truyền thống mà ai ai cũng đều yêu thích. Thế nhưng làm thế nào để lựa chọn được cho mình một bộ áo dài phù hợp và luôn đẹp trong mắt mọi người thì không phải ai cũng biết.', 'hoa-1479.jpg', '<h2>Các kiểu áo dài đi học đẹp cho nữ sinh cấp 3</h2>\r\n\r\n<p>Với sự phát triển mạnh mẽ như ngày nay, làng&nbsp;<a href=\"https://hoclamdepvn.com/thoi-trang/\">thời trang</a>&nbsp;Việt Nam cũng đã không ngừng cho ra những mẫu áo dài cách tân vô cùng hiện đại và đẹp mắt. Thế nhưng để phù hợp với từng hoàn cảnh, từng môi trường, các mẫu áo dài đi học của học sinh cấp 3 sau đây vẫn được sử dụng phổ biến hơn cả.</p>\r\n\r\n<h3>Kiểu áo dài học sinh cổ cao</h3>\r\n\r\n<p>Đây là một trong các kiểu áo dài đi học truyền thống của hầu hết các bạn học sinh cấp 3 từ trước đến nay. Mẫu áo dài học sinh cực kỳ phù hợp với những cô nàng có thân hình mảnh mai, cao ráo và nữ tính. Song, bạn nên lựa chọn mẫu áo dài cổ không quá cao, cổ chỉ từ 3- 3,5 cm là hợp lý và tạo cảm giác thoải mái khi mặc.</p>\r\n\r\n<p><img alt=\"ao-dai-di-hoc-co-cao\" src=\"https://hoclamdepvn.com/wp-content/uploads/2018/07/bi-quyet-mac-ao-dai-dep-cho-hoc-sinh-7.jpg\" style=\"height:750px; width:500px\" title=\"Kiểu áo dài cổ cao mang đến vẻ thướt tha, thuần khiết cho người mặc\" /></p>\r\n\r\n<p>Kiểu áo dài cổ cao mang đến vẻ thướt tha, thuần khiết cho người mặc</p>\r\n\r\n<h3>Áo dài đi học cổ thuyền hay cổ chữ V</h3>\r\n\r\n<p>Khác biệt hoàn toàn với những mẫu áo dài học sinh cổ cao, người có thân hình mũm mĩm nên mặc mẫu áo dài cổ thuyền hoặc cổ chữ V. Với kiểu áo dài này, bạn sẽ dễ dàng che đi những khuyết điểm trên cơ thể giúp bạn trở nên mảnh mai hơn rất nhiều.</p>\r\n\r\n<p><img alt=\"ao-dai-di-hoc-co-thuyen-hay-co-chu-V\" src=\"https://hoclamdepvn.com/wp-content/uploads/2018/07/bi-quyet-mac-ao-dai-dep-cho-hoc-sinh-8.jpg\" style=\"height:750px; width:500px\" title=\"Áo dài cổ thuyền hay cổ chữ V giúp che đi khuyết điểm cơ thể\" /></p>\r\n\r\n<p>Áo dài cổ thuyền hay cổ chữ V giúp che đi khuyết điểm cơ thể</p>\r\n\r\n<h3>Áo dài đi học cổ tròn (không cổ)</h3>\r\n\r\n<p>Áo dài học sinh cổ tròn nhận được rất nhiều sự quan tâm từ các cô nàng nữ sinh năng động ngày nay nhờ thiết kế lạ mắt, tính thẩm mỹ cao nhưng vẫn giữ nguyên được bản sắc dân tộc trong tà áo dài.</p>\r\n\r\n<p><img alt=\"ao-dai-di-hpc-co-tron\" src=\"https://hoclamdepvn.com/wp-content/uploads/2018/07/ao-dai-di-hoc-co-tron.jpg\" style=\"height:600px; width:600px\" title=\"Nữ sinh duyên dáng bên tà áo dài đi học cổ tròn\" /></p>\r\n\r\n<p>Nữ sinh duyên dáng bên tà áo dài đi học cổ tròn</p>\r\n\r\n<p>Ngoài ra, một điểm hấp dẫn của chiếc áo dài cổ tròn đó là sự thoải mái, dễ chịu hơn nhiều so với cổ cao truyền thống ôm sát cổ. Nếu bạn dành đôi phút tưởng tượng đến cái nắng nóng giữa lòng thành phố thì bạn sẽ biết mình chọn kiểu áo nào rồi đấy.</p>\r\n\r\n<h3>Áo dài đi học tay lỡ</h3>\r\n\r\n<p>Một chút thay đổi nhỏ ở phần tay áo, bạn đã có ngay cho mình một chiếc áo dài tay lỡ cực kỳ nữ tính và đầy e thẹn. Với kiểu áo này bạn sẽ thoải mái hoạt động, nhất là vào những ngày thời tiết oi bức. Kết hợp thêm với phần cổ tròn cách điệu thì đúng là sự lựa chọn hoàn hảo.</p>\r\n\r\n<p><img alt=\"ao-dai-di-hoc-tay-lo\" src=\"https://hoclamdepvn.com/wp-content/uploads/2018/07/cac-kieu-ao-dai-hoc-sinh-cap-3-dep.jpg\" style=\"height:858px; width:600px\" title=\"Áo dài đi học tay lỡ\" /></p>\r\n\r\n<p>Áo dài đi học tay lỡ</p>\r\n\r\n<h3>Áo dài đi học trắng trơn</h3>\r\n\r\n<p>Nếu bạn là một cô nàng yêu thích sự đơn giản thì đây sẽ là một lựa chọn tuyệt vời. Đơn giản nhưng không có nghĩa là nhàm chán, nó vẫn toát lên được vẻ đẹp đầy uy quyền cho người mặc. Bởi, ưu điểm lớn nhất mà mẫu áo dài học sinh&nbsp;này mang lại đó chính là sự tinh giản.</p>\r\n\r\n<p><img alt=\"ao-dai-di-hoc-trang-tron\" src=\"https://hoclamdepvn.com/wp-content/uploads/2018/07/bi-quyet-mac-ao-dai-dep-cho-hoc-sinh-9.jpg\" style=\"height:703px; width:500px\" title=\"Áo dài trắng trơn tuy đơn giản nhưng vẫn rất nổi bật\" /></p>\r\n\r\n<p>Áo dài trắng trơn tuy đơn giản nhưng vẫn rất nổi bật</p>\r\n\r\n<p>Thông thường kiểu áo dài này thường được thiết kế bằng chất vải lụa hoặc chiffon…cùng với đó là lối thiết kế đơn giản. Lối thiết kế này thích hợp với những người yêu thích sự đơn giản, giúp tôn lên vẻ đẹp tự nhiên, trong sáng cho người mặc.</p>', '2020-04-24 00:00:00', '2020-05-31 01:12:42'),
(9, 'Nét đẹp văn hóa áo dài truyền thống của Phụ Nữ Việt Nam', '-Mặc áo dài cũng là hành động tôn vinh, gìn giữ trang phục áo dài, khằng định bản sắc văn hóa. Tất cả xuất phát từ lòng tự hào tà áo dài Việt.', '69026754_166750247816915_3441960037663113216_o_gnqh[1]22.jpg', '<p>Chuỗi sự kiện với chủ đề “Áo dài - Di sản văn hóa Việt Nam” được Trung ương Hội LHPN Việt Nam phối hợp với Bộ VHTTDL tổ chức nhằm góp phần thu thập thông tin lập hồ sơ di sản văn hoá phi vật thể quốc gia.</p>\r\n\r\n<p>Đáng chú ý, từ 2/3 đến 8/3, Trung ương Hội Liên hiệp Phụ nữ Việt Nam phát động phụ nữ cả nước mặc áo dài. Hưởng ứng “Tuần lễ Áo dài”, hội viên, phụ nữ, cán bộ công chức viên chức, nữ thanh niên, sinh viên cả nước cùng nhau mặc áo dài đến công sở nhằm lan tỏa, tôn vinh giá trị áo dài Việt Nam.</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td><a href=\"https://images.vov.vn/w990/uploaded/x8vuhntpnkcrb7fgmumzw/2020_03_06/88144289_2670685283218151_1290420471656873984_o_tyhj.jpg\"><img alt=\"ao dai, ton vinh ve dep phu nu viet hinh 1\" src=\"https://images.vov.vn/w800/uploaded/x8vuhntpnkcrb7fgmumzw/2020_03_06/88144289_2670685283218151_1290420471656873984_o_tyhj.jpg\" title=\"áo dài, tôn vinh vẻ đẹp phụ nữ việt hình 1\" /></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mặc áo dài đến công sở nhằm lan tỏa, tôn vinh giá trị áo dài Việt Nam.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><strong>Áo dài và phụ nữ Việt</strong></p>\r\n\r\n<p>Từ thành thị cho tới nông thôn, miền núi, các công sở đâu đâu cũng tràn ngập hình ảnh người phụ nữ dịu dàng, thiết tha trong tà áo dài. Với phụ nữ Việt, dù ở lứa tuổi nào thì áo dài đã trở thành trang phục không thể thiếu, Và áo dài cũng là trang phục chuẩn mực để họ mặc trong dịp đặc biệt, ngày lễ quan trọng. Trang phục áo dài song hành với phụ nữ Việt trên mọi miền đất nước và có mặt ở nhiều quốc gia. Mọi cuộc thi sắc đẹp trên thế giới dù ở quy mô nào thì áo dài luôn được các người đẹp lựa chọn và trình diễn với sự tự hào dân tộc để khẳng định với bạn bè quốc tế: “Tôi là người Việt Nam”.</p>\r\n\r\n<p>Tuần lễ áo dài được phát động nhận được sự hưởng ứng mạnh mẽ của chị em phụ nữ khắp cả nước. Chị Phạm Hiền, giáo viên trường THCS Đức Thành, huyện Yên Thành, tỉnh Nghệ An cho rằng, chị và các đồng nghiệp trong trường đều rất thích mặc áo dài. Bình thường giáo viên nữ trong trường chỉ mặc áo dài trong các ngày lễ như 8/3, 20/10… nhưng chị Hiền mong muốn được mặc áo dài đi dạy học hàng ngày.</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td><a href=\"https://images.vov.vn/w990/uploaded/x8vuhntpnkcrb7fgmumzw/2020_03_06/anh_1_kkpg.jpg\"><img alt=\"ao dai, ton vinh ve dep phu nu viet hinh 2\" src=\"https://images.vov.vn/w800/uploaded/x8vuhntpnkcrb7fgmumzw/2020_03_06/anh_1_kkpg.jpg\" title=\"áo dài, tôn vinh vẻ đẹp phụ nữ việt hình 2\" /></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><em>Chị Phạm Hiền cùng các đồng nghiệp thích hàng ngày đi dạy được mặc áo dài.</em></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>“Tôi rất thích mặc áo dài. Hiện nay ở trường, tôi đang động viên các cô mặc áo dài đi dạy. Tôi thấy mặc áo dài nhìn người thon thả và tôn dáng nhất là vòng 2 của cơ thể. Nhiều người sẽ nghĩ mặc áo dài vướng víu nhưng nếu mình thiết kế rộng rãi một chút, tà ngắn hơn chút để mặc đi làm sẽ thấy rất thích. Cảm giác đứng trên bục giảng, mặc áo dài thấy thực sự đẹp. Không chỉ mong các cô giáo mặc áo dài, tôi còn mong muốn học sinh nữ cũng mặc áo dài đến trường”, chị Phạm Hiền cho hay.</p>\r\n\r\n<p>Chị Trịnh Thị Hoàn công tác trong ngành giáo dục ở Quảng Ninh cũng bày tỏ sự yêu thích khi được mặc áo dài đến trường. Với chị khi khoác lên mình tà áo dài sẽ thấy phụ nữ Việt rất đẹp bởi áo dài được ví như là chiếc áo thần kỳ. Ai cũng mặc được áo dài, không những thế mà áo dài còn tôn lên vẻ đẹp của người phụ nữ. Ngày ngày đi dạy mặc váy hay đồ âu nhưng khi mặc áo dài bạn như trở thành một người khác, nữ tính, dịu dàng và hấp dẫn.</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td><a href=\"https://images.vov.vn/w990/uploaded/x8vuhntpnkcrb7fgmumzw/2020_03_06/89337770_192986272036987_4154420843495030784_n_wher.jpg\"><img alt=\"ao dai, ton vinh ve dep phu nu viet hinh 3\" src=\"https://images.vov.vn/w800/uploaded/x8vuhntpnkcrb7fgmumzw/2020_03_06/89337770_192986272036987_4154420843495030784_n_wher.jpg\" title=\"áo dài, tôn vinh vẻ đẹp phụ nữ việt hình 3\" /></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><em>Chị Trịnh Thị Hoàn cùng các đồng nghiệp khoe sắc tím của tà áo dài trong dịp \"Tuần lễ áo dài\".&nbsp;</em></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Công tác trong lực lượng vũ trang, trang phục bắt buộc phải mặc hàng ngày của chị Nguyễn Hằng đó là quân phục của ngành. Nhưng chị Nguyễn Hằng lại vô cùng yêu tà áo dài. Chị thường xuyên chọn mặc áo dài để chụp hình. Với chị mặc áo dài là một sở thích: “Tôi rất yêu tà áo dài của Việt Nam. Áo dài giúp người phụ nữ sẽ trở lên dịu dàng, e ấp, trang trọng và tinh tế. Áo dài không phân biệt tầng lớp, giầu nghèo, là phụ nữ ai cũng có quyền được mặc, dù bộ áo dài vài trăm đến vài chục triệu. Áo dài còn tôn vẻ đẹp hình thể, đường cong nữa, tôn dáng, cao thấp đều mặc được hết, khắc phục được nhược điểm cơ thể, khiến một người làm trong môi trường công việc đặc thù như tôi là điều tra tội phạm, ai nhìn vào cũng thấy lạnh và cứng, nhưng khi cởi bỏ bộ quân phục, thì mình cũng như những người phụ nữ khác, áo dài làm mình dịu dàng mềm mại hơn. Ngoài ra tôi còn thích mặc áo dài chụp ảnh là để lưu giữ khoẳng khắc, theo năm tháng, hình ảnh, và quan trọng là phát huy giữ gìn quốc phục của người phụ nữ Việt Nam”, chị Nguyễn Hằng chia sẻ.</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td><a href=\"https://images.vov.vn/w990/uploaded/x8vuhntpnkcrb7fgmumzw/2020_03_06/69026754_166750247816915_3441960037663113216_o_gnqh.jpg\"><img alt=\"ao dai, ton vinh ve dep phu nu viet hinh 4\" src=\"https://images.vov.vn/w800/uploaded/x8vuhntpnkcrb7fgmumzw/2020_03_06/69026754_166750247816915_3441960037663113216_o_gnqh.jpg\" title=\"áo dài, tôn vinh vẻ đẹp phụ nữ việt hình 4\" /></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><em>Với chị Nguyễn Hằng, áo dài giúp người phụ nữ sẽ trở lên dịu dàng, e ấp, trang trọng và tinh tế.</em></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Còn chị Nguyễn Quỳnh hiện đang sinh sống ở nước ngoài chia sẻ: “Rất tuyệt vời khi mặc chiếc áo dài mỗi người chúng ta lại thấy quê hương mình trong đó với muối mặn tình người và lời ru của Mẹ qua mỗi bước nuôi ta khôn lớn trưởng thành. Khi ở trong nước cũng như khi ra nước ngoài mặc lên người chiếc áo dài ta thấy yêu quê hương mình vô cùng. Tà áo dài mang lại lòng tự tôn dân tộc mà không quốc gia nào có được”.</p>\r\n\r\n<p>Tuần lễ mặc áo dài đã và đang nhận được sự hưởng ứng nhiệt tình của phụ nữ trên toàn quốc. Bởi phía sau đó không chỉ là câu chuyện về trang phục mà còn là vấn đề khẳng định chủ quyền văn hóa cho áo dài Việt Nam.</p>\r\n\r\n<p><strong>Tự hào tà áo dài Việt</strong></p>\r\n\r\n<p>Với người phụ nữ Việt, trang phục không thể thiếu trong tủ quần áo đó là áo dài. Và thói quen mặc áo dài trong các dịp lễ, Tết, các sự kiện quan trọng như đám hỏi, đám cưới…được truyền qua bao thế hệ phụ nữ Việt. Phụ nữ mặc áo dài không phải chỉ là đẹp, mà đó còn là trách nhiệm công dân về ý thức dân tộc, là trách nhiệm khi thế hệ trẻ phải nối tiếp giữ gìn văn hóa.</p>\r\n\r\n<p>Cũng vì lẽ đó mà hàng năm các tỉnh thành tổ chức nhiều hoạt động để tôn vinh vẻ đẹp của áo dài, tầm quan trọng của áo dài trong đời sống người phụ nữ Việt. Ở trong nước, từ năm 2019, vào ngày 8/3 và 20/10/2019, phụ nữ trong nước và quốc tế khi mặc trang phục áo dài truyền thống Việt Nam đến tham quan di tích Huế đã được miễn phí vé 100%. Và TP. HCM đã 6 lần tổ chức “Lễ hội Áo dài” thu hút hàng triệu lượt người tham gia…</p>\r\n\r\n<p>Trong năm 2020, Câu lạc bộ Áo dài Việt Nam sẽ kết hợp với Hội LHPN để tổ chức những chương trình lớn, phát động phong trào, tạo nên những kỷ lục mới, có thể là kỷ lục Guinness, ví dụ như phụ nữ cả nước mặc áo dài trong một ngày.</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td><a href=\"https://images.vov.vn/w990/uploaded/x8vuhntpnkcrb7fgmumzw/2020_03_06/77007727_2790163167710894_8810727586398208000_o_lmdg.jpg\"><img alt=\"ao dai, ton vinh ve dep phu nu viet hinh 5\" src=\"https://images.vov.vn/w800/uploaded/x8vuhntpnkcrb7fgmumzw/2020_03_06/77007727_2790163167710894_8810727586398208000_o_lmdg.jpg\" title=\"áo dài, tôn vinh vẻ đẹp phụ nữ việt hình 5\" /></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><em>Phụ nữ&nbsp; mặc áo dài không phải chỉ là đẹp, mà đó còn là trách nhiệm công dân về ý thức dân tộc.</em></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Cộng đồng mạng cũng không đứng ngoài cuộc việc tôn vinh vẻ đẹp của tà áo dài. Từ giữa tháng 2/2020, một nhóm trên Facebook tạo tài khoản với tên gọi “Tự hào áo dài Việt Nam”. Tính đến nay nhóm có 6.600 thành viên với lượng bài viết trung bình trên 100 bài viết mỗi ngày. Hàng ngàn bức ảnh áo dài quý giá của các anh chị em nhiếp ảnh, nhà thiết kế, người mẫu, thợ may, cô giáo, doanh nhân, thương nhân và người yêu Áo dài thuộc mọi tầng lớp trong xã hội đã được đăng lên nhóm với một tình yêu và niềm tự hào về tà áo dài của quê hương Việt Nam yêu dấu.</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td><a href=\"https://images.vov.vn/w990/uploaded/x8vuhntpnkcrb7fgmumzw/2020_03_06/88147496_1066537037044905_2204178710955819008_o_hoty.jpg\"><img alt=\"ao dai, ton vinh ve dep phu nu viet hinh 6\" src=\"https://images.vov.vn/w800/uploaded/x8vuhntpnkcrb7fgmumzw/2020_03_06/88147496_1066537037044905_2204178710955819008_o_hoty.jpg\" title=\"áo dài, tôn vinh vẻ đẹp phụ nữ việt hình 6\" /></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><em>Mặc áo dài cũng là hành động tôn vinh, gìn giữ trang phục áo dài, khằng định bản sắc văn hóa.</em></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Và tới đây, các hoạt động trình diễn áo dài, diễu hành và đồng diễn áo dài dự kiến sẽ được tổ chức từ tháng 4 đến tháng 10 và cao điểm là tại 6 tỉnh/thành phố (Thủ đô Hà Nội, TP. HCM, Đắk Lắk, Cần Thơ, Thừa Thiên - Huế, Quảng Nam). Trong tháng 4 sẽ diễn ra Hội thảo “Áo dài Việt Nam: Nhận diện, tập quán, giá trị và bản sắc” do Bảo tàng Phụ nữ Việt Nam phối hợp với Viện Văn hoá Nghệ thuật quốc gia Việt Nam tổ chức, nhằm làm rõ hơn các giá trị liên quan đến áo dài, giá trị lịch sử, nghệ thuật, văn hóa, xã hội của áo dài Việt Nam, góp phần thu thập thông tin lập hồ sơ di sản văn hoá phi vật thể quốc gia.</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td><a href=\"https://images.vov.vn/w990/uploaded/x8vuhntpnkcrb7fgmumzw/2020_03_06/86976879_2948337378563204_782847563102420992_n_osod.jpg\"><img alt=\"ao dai, ton vinh ve dep phu nu viet hinh 7\" src=\"https://images.vov.vn/w800/uploaded/x8vuhntpnkcrb7fgmumzw/2020_03_06/86976879_2948337378563204_782847563102420992_n_osod.jpg\" title=\"áo dài, tôn vinh vẻ đẹp phụ nữ việt hình 7\" /></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;Tà áo dài mang lại lòng tự tôn dân tộc mà không quốc gia nào có được.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Với các hoạt động đa dạng như vậy, hình ảnh của áo dài Việt không chỉ đẹp hơn trong mắt người dân mà còn góp phần hình thành thói quen mặc áo dài vào các dịp lễ, Tết. Mặc áo dài cũng là hành động tôn vinh, gìn giữ trang phục áo dài, khằng định bản sắc văn hóa. Tất cả đều xuất phát từ lòng tự hào tà áo dài Việt</p>', '2020-04-24 00:00:00', '2020-05-31 01:16:37'),
(10, 'Áo dài - nét đẹp đặc sắc của văn hoá Việt Nam', 'Từ hàng trăm năm nay, chiếc áo dài của phụ nữ Việt Nam đã được coi là \"quốc hồn quốc tuý\" của dân tộc', 'cong2951.jpg', '<p>Từ hàng trăm năm nay, chiếc áo dài của phụ nữ Việt Nam đã được coi là \"quốc hồn quốc tuý\" của dân tộc và được coi như một biểu tượng Việt Nam. Vẻ đẹp mềm mại, dịu dàng và kín đáo của chiếc áo dài Việt Nam được thẻ hiện bằng cổ cao, bờ vai tròn trịa mềm mại với hai tà áo thướt tha. Chiếc áo dài Việt Nam cũng đầy nữ tính, gợi cảm. Nếu người phương Tây thích khoe cổ, khoe tay thì chiếc áo dài với đường lượn ở đáy eo cũng đã tạo nên bao sự gợi cảm, cuốn hút.</p>\r\n\r\n<p>Theo tư liệu của ông Âu Tuyền (Huế), chiếc áo dài xưa \"có độ dài vừa phải, không lê thê phết gót mà cũng không ngắn đến quá đầu gối. Eo áo rộng nhưng cũng tạo dáng thắt đáy lưng ong. Vai tròn, ngực tròn dù bên trong chỉ mặc áo yếm. áo dài xưa thường có màu trắng hoặc màu nhẹ nhàng như màu xanh da trời, tím nhạt, tuyền đen, vàng mơ mặc với quần đen hoặc trắng, ống quần không quá rộng...\". Chất liệu chủ yếu bằng lụa là.</p>\r\n\r\n<p>Trong vòng 100 năm qua, chiếc áo dài Việt Nam cũng trải nhiều biến đổi, thăng trầm. Từ chiếc áo dài thụng năm thân, áo rộng, không eo, dài đến gần mắt cá chân của phụ nữ Việt Nam đầu thế kỷ đến năm 1935 hoạ sĩ Lê Phổ là người đầu tiên cách tân chiếc áo dài Việt Nam. Ông vẫn giữ phong cách của áo dài cổ điển nhưng tiện dụng và tân thời hơn với áo dài được may ôm hơn, cổ thấp hơn, chiều dài áo ngắn hơn một đoạn. Sau áo dài Lê Phổ còn có áo dài Le Mỷr của ông Nguyễn Cát Tường cách tân nhưng không thành công với áo dài tay bồng... Trong thập niên 60, trước sự du nhập của chất liệu nilon, bà Trần Lệ Xuân có lúc lăng xê loại áo dài nilon mỏng tang, cổ khoét sâu táo bạo với cổ áo dài rộng, cổ tròn, cổ vuông, cổ trái tim. Nhưng kiểu áo này chỉ tồn tại gượng gạo trong một thời gian ngắn.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Tuy nhiên, sự phát triển thiếu định hướng, còn nhiều bộc phát của thị trường thời trang Việt Nam cũng đang để lại nhiều biểu hiện đáng tiếc. Có không ít các nhà tạo mẫu đang chạy theo sự \"cách tân\" một cách quá đà, đang đi tìm sự độc đáo, cái lạ hơn là sáng tạo nên đã biến chiếc áo dài Việt Nam đôi khi bị lai căng. Có nhà tạo mẫu quan niệm áo dài là một chiếc áo đầm có mặc quần vào áo tay phồng hoặc sát nách, có bộ áo dài lại mang dáng dấp của trang phục người Hoa, có người còn thiết kế áo dài với cổ áo sơ mi... Sự chạy đua quá đà cũng dẫn đến tình trạng khủng hoảng. Trong một cuộc thi người đẹp gần đây, người xem không khỏi nhức mắt khi thấy phần lớn các thí sinh mặc các bộ áo vẽ quá rườm rà, với nhiều hoa văn rối loạn và thực sự cảm thấy nhẹ nhõm khi một thí sinh xuất hiện với một tà áo trắng đơn sơ, giản dị.</p>\r\n\r\n<p>Phong cách của chiếc áo dài Việt Nam đã được tạo nên từ hàng trăm năm nay. Để có thể sáng tạo và gìn giữ được vẻ đẹp của chiếc áo dài truyền thống, những người sáng tạo cần có tình cảm trong sáng và thẩm thấu được cái hồn của văn hoá Việt Nam.</p>', '2020-04-24 00:00:00', '2020-05-31 01:22:54'),
(11, 'Áo dài là nét đẹp truyền thống văn hóa của người Việt Nam', 'Áo dài là một loại trang phục cách tân từ áo ngũ thân (lập lĩnh, tức cổ đứng) của Việt Nam trong thời kỳ Tây hóa (mặc phổ biến từ những năm 1940), còn gọi là áo tân thời', 'hoa2368.jpg', '<p>Áo dài thường được mặc vào các dịp&nbsp;<a href=\"https://vi.wikipedia.org/wiki/L%E1%BB%85_h%E1%BB%99i\" title=\"Lễ hội\">lễ hội</a>,&nbsp;<a href=\"https://vi.wikipedia.org/wiki/Tr%C3%ACnh_di%E1%BB%85n\" title=\"Trình diễn\">trình diễn</a>; hoặc tại những&nbsp;<a href=\"https://vi.wikipedia.org/wiki/M%C3%B4i_tr%C6%B0%E1%BB%9Dng\" title=\"Môi trường\">môi trường</a>&nbsp;đòi hỏi sự trang trọng, lịch sự; hoặc là đồng phục&nbsp;<a href=\"https://vi.wikipedia.org/w/index.php?title=N%E1%BB%AF_sinh&amp;action=edit&amp;redlink=1\" title=\"Nữ sinh (trang chưa được viết)\">nữ sinh</a>&nbsp;tại trường trung học phổ thông hay&nbsp;<a href=\"https://vi.wikipedia.org/wiki/Gi%C3%A1o_d%E1%BB%A5c_%C4%91%E1%BA%A1i_h%E1%BB%8Dc\" title=\"Giáo dục đại học\">đại học</a>; hay đại diện cho trang phục quốc gia trong các quan hệ quốc tế. Các người đẹp Việt Nam hầu hết đều chọn áo dài cho phần thi trang phục dân tộc tại các cuộc thi sắc đẹp quốc tế.<sup><a href=\"https://vi.wikipedia.org/wiki/%C3%81o_d%C3%A0i#cite_note-dantri-2\">[2]</a></sup></p>\r\n\r\n<p>Chúa&nbsp;<a href=\"https://vi.wikipedia.org/wiki/Nguy%E1%BB%85n_Ph%C3%BAc_Kho%C3%A1t\" title=\"Nguyễn Phúc Khoát\">Nguyễn Phúc Khoát</a>&nbsp;là người được xem là có công sáng chế chiếc áo ngũ thân — tiền thân của áo dài. Họa sĩ Le Mur&nbsp;<a href=\"https://vi.wikipedia.org/wiki/Nguy%E1%BB%85n_C%C3%A1t_T%C6%B0%E1%BB%9Dng\" title=\"\">Nguyễn Cát Tường</a>&nbsp;là người có công định hình áo tân thời như ngày nay.</p>\r\n\r\n<p>Từ \"Áo dài\" (ao dai /ˈaʊ ˌdʌɪ/) được đưa nguyên bản vào&nbsp;<a href=\"https://vi.wikipedia.org/wiki/T%E1%BB%AB_%C4%91i%E1%BB%83n_Oxford\" title=\"Từ điển Oxford\">từ điển Oxford</a>&nbsp;và được giải thích là loại trang phục của&nbsp;<a href=\"https://vi.wikipedia.org/wiki/Ph%E1%BB%A5_n%E1%BB%AF_Vi%E1%BB%87t_Nam\" title=\"Phụ nữ Việt Nam\">phụ nữ Việt Nam</a>&nbsp;với thiết kế 2 tà áo trước và sau dài chấm mắt cá chân che bên ngoài chiếc quần dài.</p>\r\n\r\n<ul>\r\n	<li>Cổ áo cổ điển cao khoảng 4 đến 5&nbsp;cm. Ngày nay, kiểu cổ áo dài được biến tấu khá đa dạng như kiểu cổ trái tim, cổ tròn, cổ chữ U, trên cổ áo thường được đính ngọc.</li>\r\n	<li>Thân áo được tính từ cổ xuống phần eo. Cúc áo dài thường từ cổ chéo sang vai rồi kéo xuống ngang hông. Từ eo, thân áo dài được xẻ làm hai tà, vị trí xẻ tà ở hai bên hông.</li>\r\n	<li>Áo dài có hai tà: tà trước và tà sau. Ngày xưa tà trước bằng tà sau nhưng ngày nay đã có nhiều loại áo tà trước ngắn hơn tà sau. Trên tà áo trước thường được thêu những hoa văn hay những bài thơ.</li>\r\n	<li>Tay áo được tính từ vai, may ôm sát cánh tay, dài đến qua khỏi&nbsp;<a href=\"https://vi.wikipedia.org/wiki/C%E1%BB%95_tay\" title=\"Cổ tay\">cổ tay</a>.</li>\r\n	<li>Chiếc áo dài được mặc với quần thay cho chiếc váy ngày xưa. Quần áo dài được may chấm gót chân, ống quần rộng. Quần áo dài khi xưa may bằng vải cứng cáp, nay thường được may với vải mềm, rũ. Màu sắc thông dụng nhất là màu trắng. Nhưng xu thế thời trang hiện nay thì chiếc quần áo dài có màu đi tông với màu của áo. Nhưng ngày nay còn được cách tân phối cùng chiếc chân váy dài tạo vẻ dịu dàng, thanh lịch.</li>\r\n</ul>\r\n\r\n<p>Điểm yếu của áo dài tân thời là không dùng hoa văn cổ truyền, cách may hiện đại không sử dụng triết lý&nbsp;<a href=\"https://vi.wikipedia.org/wiki/Ng%C5%A9_h%C3%A0nh\" title=\"Ngũ hành\">ngũ hành</a>, không kết hợp được với các phụ kiện được sử dụng thời xưa như áo ngũ thân, nên không dùng để giao lưu văn hóa. Trong sinh hoạt thường nhật, áo dài tân thời khá bất tiện vì bó sát.</p>\r\n\r\n<h2>Lịch sử</h2>\r\n\r\n<p>Trước khi xuất hiện áo dài lập lĩnh (cổ đứng), trang phục phổ biến của người Việt là&nbsp;<a href=\"https://vi.wikipedia.org/wiki/%C3%81o_giao_l%C4%A9nh\" title=\"Áo giao lĩnh\">áo giao lĩnh</a>&nbsp;(cổ chéo) và&nbsp;<a href=\"https://vi.wikipedia.org/w/index.php?title=%C3%81o_vi%C3%AAn_l%C4%A9nh&amp;action=edit&amp;redlink=1\" title=\"Áo viên lĩnh (trang chưa được viết)\">áo viên lĩnh</a>&nbsp;(cổ tròn). Ngoài ra còn kiểu&nbsp;<a href=\"https://vi.wikipedia.org/wiki/%C3%81o_t%E1%BB%A9_th%C3%A2n\" title=\"Áo tứ thân\">áo tứ thân</a>&nbsp;(gồm bốn vạt nửa: vạt nửa trước phải, vạt nửa trước trái, vạt nửa sau phải, vạt nửa sau trái).</p>\r\n\r\n<p>Kiểu áo do chúa Nguyễn Phúc Khoát đặt định là&nbsp;<a href=\"https://vi.wikipedia.org/wiki/%C3%81o_ng%C5%A9_th%C3%A2n\" title=\"Áo ngũ thân\">áo ngũ thân</a>&nbsp;lập lĩnh (cổ đứng) cài khuy.&nbsp;<a href=\"https://vi.wikipedia.org/wiki/%C3%81o_ng%C5%A9_th%C3%A2n\" title=\"Áo ngũ thân\">Áo ngũ thân</a>&nbsp;che kín thân hình không để hở áo lót (chỉ hở phần cổ trắng của áo lót). Mỗi vạt có hai thân nối sống (tổng cộng bốn vạt) tượng trưng cho tứ thân phụ mẫu, và vạt con nằm dưới vạt trước chính là thân thứ năm tượng trưng cho người mặc áo. Vạt con nối với hai vạt cả nhờ cổ áo có bâu đệm, và khép kín nhờ 5 chiếc khuy tượng trưng cho quan điểm về&nbsp;<a href=\"https://vi.wikipedia.org/wiki/Ng%C5%A9_th%C6%B0%E1%BB%9Dng\" title=\"Ngũ thường\">ngũ thường</a>&nbsp;theo quan điểm&nbsp;<a href=\"https://vi.wikipedia.org/wiki/Nho_gi%C3%A1o\" title=\"Nho giáo\">Nho giáo</a>&nbsp;và&nbsp;<a href=\"https://vi.wikipedia.org/wiki/Ng%C5%A9_h%C3%A0nh\" title=\"Ngũ hành\">ngũ hành</a>&nbsp;theo triết học Đông phương. Các kiểu áo cổ của phương đông xưa luôn có 1 đường may giữa ở vạt trước và sau áo gọi là trung phùng đạo, thể hiện&nbsp;<em>Đấng quân tử nên tìm đạo lý, Kẻ trượng phu gìn kỹ tinh hoa, chính trực</em></p>\r\n\r\n<h4>Thời chúa Nguyễn Phúc Khoát (1744)[<a href=\"https://vi.wikipedia.org/w/index.php?title=%C3%81o_d%C3%A0i&amp;veaction=edit&amp;section=4\" title=\"Sửa đổi phần “Thời chúa Nguyễn Phúc Khoát (1744)”\">sửa</a>&nbsp;|&nbsp;<a href=\"https://vi.wikipedia.org/w/index.php?title=%C3%81o_d%C3%A0i&amp;action=edit&amp;section=4\" title=\"Sửa đổi phần “Thời chúa Nguyễn Phúc Khoát (1744)”\">sửa mã nguồn</a>]</h4>\r\n\r\n<p><a href=\"https://vi.wikipedia.org/wiki/T%E1%BA%ADp_tin:Ao_ngu_than_on_postcard_dated_1904.JPG\"><img alt=\"\" src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Ao_ngu_than_on_postcard_dated_1904.JPG/200px-Ao_ngu_than_on_postcard_dated_1904.JPG\" style=\"height:250px; width:200px\" /></a></p>\r\n\r\n<p>Áo dài ngũ thân, khoảng năm 1900</p>\r\n\r\n<p>Với tham vọng lập quốc một cõi, Vũ Vương Nguyễn Phúc Khoát ban hành sắc dụ về ăn mặc cho toàn thể dân chúng xứ Đàng Trong phải theo đó thi hành để phân biệt với Đàng Ngoài. Trong sắc dụ đó, người ta thấy lần đầu tiên sự định hình cơ bản của chiếc&nbsp;<a href=\"https://vi.wikipedia.org/wiki/%C3%81o_ng%C5%A9_th%C3%A2n\" title=\"Áo ngũ thân\">áo ngũ thân</a>&nbsp;Việt Nam, như sau: \"Thường phục thì đàn ông, đàn bà dùng áo lập lĩnh ngắn tay, cửa ống tay rộng hoặc hẹp tùy tiện. Áo thì hai bên nách trở xuống phải khâu kín liền, không được xẻ mở. Duy đàn ông không muốn mặc áo cổ tròn ống tay hẹp cho tiện khi làm việc thì được phép...\" (sách Đại Nam Thực lục)</p>\r\n\r\n<p>Từ đó bèn thay đổi y phục, đổi phong tục, cùng dân đổi mới, bắt đầu hạ lệnh cho nam nữ sĩ thứ trong nước, đều mặc áo nhu bào, mặc quần, vấn khăn, tục gọi quần chân áo chít bắt đầu từ đây.</p>\r\n\r\n<p>Hôn lễ đối với dân thường&nbsp;<a href=\"https://vi.wikipedia.org/wiki/B%E1%BA%AFc_B%E1%BB%99_Vi%E1%BB%87t_Nam\" title=\"Bắc Bộ Việt Nam\">Bắc Bộ</a>, nữ đội hôn lạp, guốc cong, nam đội nón ngựa (chóp nhọn), xỏ hài, dâu rể mặc áo tấc có thêu hoa văn dạng bàn cổ. Hôn lễ với&nbsp;<a href=\"https://vi.wikipedia.org/wiki/Nam_B%E1%BB%99_(Vi%E1%BB%87t_Nam)\" title=\"Nam Bộ (Việt Nam)\">Nam bộ</a>&nbsp;cô dâu và phù dâu đội nón gụ. Hôn lễ đối với quí tộc, nữ kết kim ước phát, nam đội mũ theo bổ phục. Dân thường xỏ hài, guốc; quý tộc xỏ hài cong (giống như tích), cung nhân xỏ guốc sơn son thiếp vàng.</p>', '2020-04-24 00:00:00', '2020-05-31 01:26:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `orderid` int(11) NOT NULL,
  `cusid` int(11) NOT NULL,
  `cusname` varchar(70) NOT NULL,
  `product_id` int(11) NOT NULL,
  `productname` varchar(70) NOT NULL,
  `image` varchar(255) NOT NULL,
  `soluong` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `cusphone` varchar(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `note` text NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`orderid`, `cusid`, `cusname`, `product_id`, `productname`, `image`, `soluong`, `price`, `total`, `cusphone`, `status`, `note`, `order_date`) VALUES
(41, 71, 'Dương Hoàng Văn', 10, 'Aó hoa sim tím', 'hoa-278.jpg', 2, 100000, 200000, '0334964103', '1', 'vd:aaa', '2020-08-21 07:40:15'),
(42, 71, 'Dương Hoàng Văn', 34, 'Áo dài màu tím', '94191814_648215732424264_3752553548315885568_n12.jpg', 1, 200000, 200000, '0334964103', '1', 'vd:aaa', '2020-08-11 14:48:42'),
(43, 72, 'Duong hoang van', 23, 'Vải áo dài Cúc Hoạ Mi', 'hoa-497.jpg', 1, 200000, 200000, '0334964103', '1', 'vd:asadas', '2020-08-20 02:36:14'),
(45, 73, 'duong hoanb van', 41, 'Áo dài hoa màu tím', '94040597_648209982424839_4735062145165688832_o51.jpg', 12, 250000, 3000000, '1234567890', '1', 'vd:sqewereewrwe', '2020-08-20 02:51:47'),
(46, 74, 'Duong hoang van', 43, 'Áo dài Hoa Quỳnh', '94191814_648215732424264_3752553548315885568_n59.jpg', 1, 400000, 400000, '0334964103', 'đang xử lý', 'vd:ádasdasd', '2020-08-21 00:40:48'),
(47, 74, 'Duong hoang van', 37, 'Áo cảnh hoàng hôn', 'aodai741.jpg', 1, 250000, 250000, '0334964103', '1', 'vd:ádasdasd', '2020-08-21 00:41:22'),
(48, 75, 'Dương Hoàng Văn', 19, 'Vải áo dài Hoa Sen 3D', 'hoa2257.jpg', 1, 350000, 350000, '0334964103', '1', 'vd:ádsadasdas', '2020-08-21 07:39:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_Name` varchar(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_material` varchar(100) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_price_promotion` int(11) NOT NULL,
  `brandcode_id` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `meta_keyword` varchar(100) NOT NULL,
  `meta_desc` text NOT NULL,
  `meta_slug` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `category_id`, `product_Name`, `product_desc`, `product_material`, `product_price`, `product_price_promotion`, `brandcode_id`, `product_image`, `meta_keyword`, `meta_desc`, `meta_slug`) VALUES
(4, 1, 'Áo dài ngọc bich', 'a', 'lụa', 100000, 0, 1, '408d1dae0722ff7ca63322.png', '', '', ''),
(7, 5, 'Áo Lụa', 'a', 'Cái lol', 100000, 1, 3, '408d1dae0722ff7ca63371.png', '', '', ''),
(8, 2, 'Áo Dài Cô Ba', '<p>a</p>', 'vải nhung', 500000, 1, 5, 'hoa-931.jpg', 'Áo Dài Cô Ba', 'Áo Dài Cô Ba', 'ao-dai-co-ba1'),
(9, 6, 'Aó cánh hoa lan', '<p>Aó cánh hoa lan</p>', 'Coton', 150000, 1, 6, 'hoa-170.jpg', 'Aó cánh hoa lan', 'Aó cánh hoa lan', 'ao-canh-hoa-lan0'),
(10, 4, 'Aó hoa sim tím', '<p>a</p>', 'Lụa', 100000, 1, 5, 'hoa-278.jpg', 'Aó hoa sim tím', 'Aó hoa sim tím', 'ao-hoa-sim-tim20'),
(11, 4, 'ÁO hoa màu vàng', '<p>ÁO hoa màu vàng</p>', 'Lụa', 400000, 1, 7, 'cong2886.jpg', 'ÁO hoa màu vàng', 'ÁO hoa màu vàng', 'ao-hoa-mau-vang9'),
(12, 2, 'Vải áo dài hoa Sen', '<ul>\r\n	<li>ÁO hoa màu vàng</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', 'Lụa', 250000, 1, 7, 'soc-3779.jpg', 'ÁO hoa màu vàng', 'ÁO hoa màu vàng', 'vai-ao-dai-hoa-sen20'),
(13, 6, 'Vải áo dài kết hoa', '<p><img alt=\"Vai Ao Dai Mau Vang Nhat Dinh Hoa Tre Trung\" src=\"http://vaiaodaimymy.com/wp-content/uploads/2019/08/vai-ao-dai-mau-vang-nhat-dinh-hoa-tre-trung.jpg\" style=\"height:916px; width:651px\" /></p>\r\n\r\n<p>Vai Ao Dai Mau Vang Nhat Dinh Hoa Tre Trung</p>\r\n\r\n<p>&nbsp;</p>', 'Lụa Nhật', 500000, 1, 4, 'hoa-1329.jpg', 'Vải áo dài kết hoa', 'Vải áo dài kết hoa', 'vai-ao-dai-ket-hoa14'),
(14, 5, 'Vải áo dài Hoa Đào', '<p><img alt=\"Vải áo dài Hoa Đào AD 9313 41\" src=\"http://vaiaodaimymy.com/wp-content/uploads/2020/04/1587007279_182_Vai-ao-dai-Hoa-Dao-nhe-nhang-AD.jpg\" /></p>\r\n\r\n<p><img alt=\"Vải áo dài Hoa Đào AD 9313 42\" src=\"http://vaiaodaimymy.com/wp-content/uploads/2020/04/1587007279_760_Vai-ao-dai-Hoa-Dao-nhe-nhang-AD.jpg\" /></p>', 'Coton', 390000, 1, 7, 'Vải-áo-dài-Hoa-Đào-nhẹ-nhàng9.jpg', 'Vải áo dài Hoa Đào', 'Vải áo dài Hoa Đào', 'vai-ao-dai-hoa-dao2'),
(15, 4, 'Vải áo dài kết hoa', '<p><img alt=\"Vai Ao Dai Ngoi Sui Sang Trong Moi\" src=\"http://vaiaodaimymy.com/wp-content/uploads/2019/08/vai-ao-dai-ngoi-sui-sang-trong-moi.jpg\" style=\"height:916px; width:651px\" /></p>\r\n\r\n<p>Vai Ao Dai Ngoi Sui Sang Trong Moi</p>\r\n\r\n<p>&nbsp;</p>', 'Lụa Latin', 250000, 1, 6, 'cong3177.jpg', 'Vải áo dài Hoa Đào', 'Vải áo dài Hoa Đào', 'vai-ao-dai-ket-hoa1'),
(16, 7, 'Vải áo dài hoa 3D', '<ul>\r\n	<li>•&nbsp;<strong>Lụa Hàn Quốc</strong>: Vải mềm, mịn, co dãn tốt bề ngang, màu tối dễ bị rạn khi may.</li>\r\n	<li>•&nbsp;<strong>Lụa Tằm Thái</strong>: Vải mềm, mát, rủ, không co dãn, màu tối dễ bị rạn khi may.</li>\r\n	<li>•&nbsp;<strong>Lụa Garnet</strong>: Vải mềm, rủ, co dãn thoải mái khi mặc, hạn chế rạn vải khi may.</li>\r\n	<li>•&nbsp;<strong>Lụa Thái Tuấn</strong>: Vải lụa mềm, mịn, mát, rủ, có độ dãn, dễ may, cực ít rạn, may kỹ gần như không rạn. (Mẫu mã được thiết kế tự do và in trên nền vải lụa Hồng Nhung Thái Tuấn, tránh hiểu lầm với sản phẩm được thiết kế bởi Thái Tuấn).</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>', 'Lụa Nhật', 400000, 1, 7, 'aodai586.jpg', 'Vải áo dài Hoa Đào', 'Vải áo dài Hoa Đào', 'vai-ao-dai-hoa-3d10'),
(17, 6, 'Vải áo dài Hoa Mẫu Đơn', '<ul>\r\n	<li>•&nbsp;<strong>Lụa Hàn Quốc</strong>: Vải mềm, mịn, co dãn tốt bề ngang, màu tối dễ bị rạn khi may.</li>\r\n	<li>•&nbsp;<strong>Lụa Tằm Thái</strong>: Vải mềm, mát, rủ, không co dãn, màu tối dễ bị rạn khi may.</li>\r\n	<li>•&nbsp;<strong>Lụa Garnet</strong>: Vải mềm, rủ, co dãn thoải mái khi mặc, hạn chế rạn vải khi may.</li>\r\n	<li>•&nbsp;<strong>Lụa Thái Tuấn</strong>: Vải lụa mềm, mịn, mát, rủ, có độ dãn, dễ may, cực ít rạn, may kỹ gần như không rạn. (Mẫu mã được thiết kế tự do và in trên nền vải lụa Hồng Nhung Thái Tuấn, tránh hiểu lầm với sản phẩm được thiết kế bởi Thái Tuấn).</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>', 'Lụa Siêu Mềm', 490000, 1, 4, 'hoa-142.jpg', 'Vải áo dài Hoa Mẫu Đơn', 'Vải áo dài Hoa Mẫu Đơn', 'vai-ao-dai-hoa-mau-don19'),
(18, 4, 'Vải áo dài lập thể', '<ul>\r\n	<li>•&nbsp;<strong>Lụa Hàn Quốc</strong>: Vải mềm, mịn, co dãn tốt bề ngang, màu tối dễ bị rạn khi may.</li>\r\n	<li>•&nbsp;<strong>Lụa Tằm Thái</strong>: Vải mềm, mát, rủ, không co dãn, màu tối dễ bị rạn khi may.</li>\r\n	<li>•&nbsp;<strong>Lụa Garnet</strong>: Vải mềm, rủ, co dãn thoải mái khi mặc, hạn chế rạn vải khi may.</li>\r\n	<li>•&nbsp;<strong>Lụa Thái Tuấn</strong>: Vải lụa mềm, mịn, mát, rủ, có độ dãn, dễ may, cực ít rạn, may kỹ gần như không rạn. (Mẫu mã được thiết kế tự do và in trên nền vải lụa Hồng Nhung Thái Tuấn, tránh hiểu lầm với sản phẩm được thiết kế bởi Thái Tuấn).</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>', 'Lụa', 700000, 1, 2, 'hoa-1690.jpg', 'Vải áo dài lập thể', 'Vải áo dài lập thể', 'vai-ao-dai-lap-the18'),
(19, 4, 'Vải áo dài Hoa Sen 3D', '<p>&nbsp;</p>\r\n\r\n<p><strong>Đặc Tính Vải</strong></p>\r\n\r\n<p><strong>Lụa Hàn Quốc</strong>: Vải mềm, mịn, co dãn tốt bề ngang, màu tối dễ bị rạn khi may.</p>\r\n\r\n<p><strong>Lụa Tằm Thái</strong>: Vải mềm, mát, rủ, co dãn nhẹ bề ngang, màu tối dễ bị rạn khi may.</p>\r\n\r\n<p><strong>Lụa Nhật</strong>: mềm, mịn, co giãn, vải rất nhẹ nên mặc cả ngày không sao. Đặc biệt may không rạn.</p>\r\n\r\n<p><strong>Siêu lụa</strong>: Vải mềm, rủ, co dãn thoải mái khi mặc, hạn chế rạn vải khi may.</p>\r\n\r\n<p><strong>Lụa Vân Gỗ</strong>: mềm, mịn, co giãn tốt, trên nền vải có vân, đặc biệt không rạn.</p>\r\n\r\n<p><strong>Lụa Thái Tuấn</strong>: Vải lụa mềm, mịn, mát, rủ, có độ dãn, dễ may, cực ít rạn, may kỹ gần như không rạn.</p>\r\n\r\n<p>Vải áo dài in 3D trên nhiều chất liệu khác nhau, họa tiết in sắc nét, màu tươi, mực in và chất liệu vải đều được chọn lựa kỹ càng để cho ra sản phẩm tốt nhất.</p>\r\n\r\n<p>Màu sắc vải giống từ 90% đến 98% so với hình ảnh</p>\r\n\r\n<p>Lưu Ý: với vải in 3D quý khách may kim số 9 và KHÔNG xài bàn ủi hơi nước.</p>', 'Coton', 350000, 1, 4, 'hoa2257.jpg', 'Vải áo dài Hoa Sen 3D', 'Vải áo dài Hoa Sen 3D', 'vai-ao-dai-hoa-sen-3d9'),
(20, 4, 'Vải áo dài Như cánh Hạc bay', '<p><strong>Đặc Tính Vải</strong></p>\r\n\r\n<p><strong>Lụa Hàn Quốc</strong>: Vải mềm, mịn, co dãn tốt bề ngang, màu tối dễ bị rạn khi may.</p>\r\n\r\n<p><strong>Lụa Tằm Thái</strong>: Vải mềm, mát, rủ, co dãn nhẹ bề ngang, màu tối dễ bị rạn khi may.</p>\r\n\r\n<p><strong>Lụa Nhật</strong>: mềm, mịn, co giãn, vải rất nhẹ nên mặc cả ngày không sao. Đặc biệt may không rạn.</p>\r\n\r\n<p><strong>Siêu lụa</strong>: Vải mềm, rủ, co dãn thoải mái khi mặc, hạn chế rạn vải khi may.</p>\r\n\r\n<p><strong>Lụa Vân Gỗ</strong>: mềm, mịn, co giãn tốt, trên nền vải có vân, đặc biệt không rạn.</p>\r\n\r\n<p><strong>Lụa Thái Tuấn</strong>: Vải lụa mềm, mịn, mát, rủ, có độ dãn, dễ may, cực ít rạn, may kỹ gần như không rạn.</p>\r\n\r\n<p>Vải áo dài in 3D trên nhiều chất liệu khác nhau, họa tiết in sắc nét, màu tươi, mực in và chất liệu vải đều được chọn lựa kỹ càng để cho ra sản phẩm tốt nhất.</p>\r\n\r\n<p>Màu sắc vải giống từ 90% đến 98% so với hình ảnh</p>\r\n\r\n<p>Lưu Ý: với vải in 3D quý khách may kim số 9 và KHÔNG xài bàn ủi hơi nước.</p>', 'Lụa', 250000, 1, 4, 'hoa0178.jpg', 'Vải áo dài Như cánh Hạc bay', 'Vải áo dài Như cánh Hạc bay', 'vai-ao-dai-nhu-canh-hac-bay17'),
(21, 5, 'Vải áo dài hoa cúc', '<ul>\r\n	<li>•&nbsp;<strong>Lụa Hàn Quốc</strong>: Vải mềm, mịn, co dãn tốt bề ngang, màu tối dễ bị rạn khi may.</li>\r\n	<li>•&nbsp;<strong>Lụa Tằm Thái</strong>: Vải mềm, mát, rủ, không co dãn, màu tối dễ bị rạn khi may.</li>\r\n	<li>•&nbsp;<strong>Lụa Garnet</strong>: Vải mềm, rủ, co dãn thoải mái khi mặc, hạn chế rạn vải khi may.</li>\r\n	<li>•&nbsp;<strong>Lụa Thái Tuấn</strong>: Vải lụa mềm, mịn, mát, rủ, có độ dãn, dễ may, cực ít rạn, may kỹ gần như không rạn. (Mẫu mã được thiết kế tự do và in trên nền vải lụa Hồng Nhung Thái Tuấn, tránh hiểu lầm với sản phẩm được thiết kế bởi Thái Tuấn).</li>\r\n</ul>\r\n\r\n<p>Vải áo dài in 3D trên nhiều chất liệu khác nhau, họa tiết in sắc nét, màu tươi, mực in và chất liệu vải đều được chọn lựa kỹ càng để cho ra sản phẩm tốt nhất.</p>\r\n\r\n<p>&nbsp;</p>', 'Lụa', 490000, 1, 7, 'hoa-339.jpg', 'Vải áo dài hoa cúc', 'Vải áo dài hoa cúc', 'vai-ao-dai-hoa-cuc1'),
(22, 5, 'Vải áo dài hoa cúc dọc thân', '<table>\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\">Shop bán vải không phải bán áo may sẵn, shop có nhận&nbsp;<strong><a href=\"http://vaiaodaimymy.com/may-ao-dai-cach-lay-so-do-may-ao-dai/\">may áo dài quận 12, Gò Váp</a>.</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Danh Mục</td>\r\n			<td><a href=\"http://vaiaodaimymy.com/\">Vải áo dài đẹp, rẻ</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Khổ Vải</td>\r\n			<td>Áo: 2 x 1,55 m&nbsp; --&nbsp; Quần: 1m1 x 1m55</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Giá Bán</td>\r\n			<td>\r\n			<ul>\r\n				<li><a href=\"http://vaiaodaimymy.com/d/vai-ao-dai-lua-han-quoc/\">L</a><a href=\"http://vaiaodaimymy.com/d/vai-ao-dai-lua-han-quoc/\">ụa Hàn&nbsp;</a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:&nbsp;&nbsp;220k/ áo&nbsp; --&gt;&nbsp; &nbsp;340k/ bộ</li>\r\n				<li><a href=\"http://vaiaodaimymy.com/d/vai-ao-dai-lua-tam-thai/\">Lụa Tằm Thái&nbsp;&nbsp;</a>&nbsp;:&nbsp;&nbsp;260k/ áo&nbsp; --&gt;&nbsp;&nbsp;380k/ bộ</li>\r\n				<li><a href=\"http://vaiaodaimymy.com/d/lua-nhat/\">Lụa Nhật</a>&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :&nbsp;&nbsp;300k/ áo&nbsp;--&gt;&nbsp;&nbsp;430k/ bộ</li>\r\n				<li><a href=\"http://vaiaodaimymy.com/d/vai-sieu-lua/\">Siêu lụa</a>&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :&nbsp;&nbsp;320k/ áo&nbsp;--&gt;&nbsp;&nbsp;470k/ bộ</li>\r\n				<li><a href=\"http://vaiaodaimymy.com/d/vai-sieu-lua/\">Lụa vân gỗ</a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:&nbsp;&nbsp;350k/ áo&nbsp;--&gt;&nbsp;500k/ bộ</li>\r\n				<li><a href=\"http://vaiaodaimymy.com/d/vai-ao-dai-lua-thai-tuan/\">Lụa Thái Tuấn</a>&nbsp; &nbsp;&nbsp;:&nbsp;&nbsp;400k/ áo&nbsp; --&nbsp; &nbsp;590k/ bộ</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">* Bộ là bao gồm quần, vải áo và quần cùng chất liệu vải</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n			<p><strong>Đặc Tính Vải</strong></p>\r\n\r\n			<p><strong>Lụa Hàn Quốc</strong>: Vải mềm, mịn, co dãn tốt bề ngang, màu tối dễ bị rạn khi may.</p>\r\n\r\n			<p><strong>Lụa Tằm Thái</strong>: Vải mềm, mát, rủ, co dãn nhẹ bề ngang, màu tối dễ bị rạn khi may.</p>\r\n\r\n			<p><strong>Lụa Nhật</strong>: mềm, mịn, co giãn, vải rất nhẹ nên mặc cả ngày không sao. Đặc biệt may không rạn.</p>\r\n\r\n			<p><strong>Siêu lụa</strong>: Vải mềm, rủ, co dãn thoải mái khi mặc, hạn chế rạn vải khi may.</p>\r\n\r\n			<p><strong>Lụa Vân Gỗ</strong>: mềm, mịn, co giãn tốt, trên nền vải có vân, đặc biệt không rạn.</p>\r\n\r\n			<p><strong>Lụa Thái Tuấn</strong>: Vải lụa mềm, mịn, mát, rủ, có độ dãn, dễ may, cực ít rạn, may kỹ gần như không rạn.</p>\r\n\r\n			<p>Vải áo dài in 3D trên nhiều chất liệu khác nhau, họa tiết in sắc nét, màu tươi, mực in và chất liệu vải đều được chọn lựa kỹ càng để cho ra sản phẩm tốt nhất.</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', 'Lụa Latin', 250000, 1, 5, 'hoa2485.jpg', 'Vải áo dài hoa cúc dọc thân', 'Vải áo dài hoa cúc dọc thân', 'vai-ao-dai-hoa-cuc-doc-than17'),
(23, 6, 'Vải áo dài Cúc Hoạ Mi', '<table>\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\">ÁO hoa màu vàng</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>', 'Lụa', 200000, 1, 6, 'hoa-497.jpg', 'ÁO hoa màu vàng', 'ÁO hoa màu vàng', 'vai-ao-dai-cuc-hoa-mi2'),
(25, 7, 'Áo dài Truyền thống', '<ul>\r\n	<li><a href=\"http://localhost/banhanglaravel/chi-tiet/17#details\">CHI TIẾT</a></li>\r\n	<li><a href=\"http://localhost/banhanglaravel/chi-tiet/17#reviews\">ĐÁNH GÍA</a></li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>•&nbsp;<strong>Lụa Hàn Quốc</strong>: Vải mềm, mịn, co dãn tốt bề ngang, màu tối dễ bị rạn khi may.</li>\r\n	<li>•&nbsp;<strong>Lụa Tằm Thái</strong>: Vải mềm, mát, rủ, không co dãn, màu tối dễ bị rạn khi may.</li>\r\n	<li>•&nbsp;<strong>Lụa Garnet</strong>: Vải mềm, rủ, co dãn thoải mái khi mặc, hạn chế rạn vải khi may.</li>\r\n	<li>•&nbsp;<strong>Lụa Thái Tuấn</strong>: Vải lụa mềm, mịn, mát, rủ, có độ dãn, dễ may, cực ít rạn, may kỹ gần như không rạn. (Mẫu mã được thiết kế tự do và in trên nền vải lụa Hồng Nhung Thái Tuấn, tránh hiểu lầm với sản phẩm được thiết kế bởi Thái Tuấn).</li>\r\n</ul>', 'Lụa Latin', 250000, 1, 4, 'hoa1934.jpg', 'Áo dài Truyền thống', 'Áo dài Truyền thống', 'ao-dai-truyen-thong8'),
(27, 7, 'ÁO dài Cách Hoa', '<p>ÁO dài Cách Hoa</p>', 'Lụa Nhung', 250000, 600000, 5, 'aodai31.jpg', 'ÁO dài Cách Hoa', 'ÁO dài Cách Hoa', 'ao-dai-cach-hoa18'),
(28, 7, 'ÁO DÀI BÔNG HOA', '<p>áo dài</p>', 'Lụa Latin', 250000, 500000, 7, 'aodai750.jpg', 'Lụa Latin', 'Lụa Latin', 'ao-dai-bong-hoa10'),
(31, 6, 'Áo dài bông cúc', '<p>Bông cúc<img alt=\"\" src=\"http://localhost/banhanglaravel/public/storage/uploads/cong30_1588560894.jpg\" style=\"height:1280px; width:894px\" /></p>', 'Lụa Latin', 400000, 1, 7, 'hoa-11-280x28060.jpg', 'bông cúc', 'bông cúc', 'ao-dai-bong-cuc18'),
(32, 6, 'Áo dài Mùa Lá Rụng', '<p>Áo dài Mùa Lá Rụng</p>', 'lụa nhật', 500000, 700000, 6, 'hoa-8-768x111553.jpg', 'Áo dài Mùa Lá Rụng', 'Áo dài Mùa Lá Rụng', 'ao-dai-mua-la-rung0'),
(33, 6, 'Áo dài màu xanh', '<p>Áo dài màu xanh</p>', 'Lụa Latin', 450000, 500000, 5, '94227546_648209359091568_5696245787009220608_o94.jpg', 'Áo dài màu xanh', 'Áo dài màu xanh', 'ao-dai-mau-xanh15'),
(34, 5, 'Áo dài màu tím', '<p>Áo dài màu tím</p>', 'Áo dài màu tím', 200000, 1, 7, '94191814_648215732424264_3752553548315885568_n12.jpg', 'Áo dài màu tím', 'Áo dài màu tím', 'ao-dai-mau-tim17'),
(37, 2, 'Áo cảnh hoàng hôn', '<p>Áo màu tối</p>', 'Áo màu tối', 250000, 1000000, 2, 'aodai741.jpg', 'Áo màu tối', 'Áo màu tối', 'ao-canh-hoang-hon3'),
(41, 7, 'Áo dài hoa màu tím', '<p>Áo dài hoa màu tím</p>', 'vải in', 250000, 1, 7, '94040597_648209982424839_4735062145165688832_o51.jpg', 'Áo dài hoa màu tím', 'Áo dài hoa màu tím', 'ao-dai-hoa-mau-tim10'),
(42, 6, 'Áo dài hoa lan', '<p>Áo dài hoa lan</p>', 'Lụa Nhật', 500000, 600000, 6, '94198150_648209495758221_2984203570011701248_o15.jpg', 'Áo dài hoa lan', 'Áo dài hoa lan', 'ao-dai-hoa-lan12'),
(43, 5, 'Áo dài Hoa Quỳnh', '<p>Áo dài Hoa Quỳnh</p>', 'Lụa Latin', 400000, 500000, 5, '94191814_648215732424264_3752553548315885568_n59.jpg', 'Áo dài Hoa Quỳnh', 'Áo dài Hoa Quỳnh', 'ao-dai-hoa-quynh2'),
(58, 7, 'Áo dài truyền thống', '<p>test</p>', 'Lụa Nhật', 200000, 1000000, 7, '85165651_602733056972532_8154584779753259008_o7838.jpg', 'Áo dài truyền thống', 'Áo dài truyền thống', 'ao-dai-truyen-thong467'),
(59, 5, 'áo dài', '<p>sadsadsad</p>', 'ádasdasd', 80000, 100000, 7, '1589602527$name_image74.jpg', 'sadsadasd', 'sadsadasd', 'ao-dai17183'),
(62, 5, 'áo dài đẹp', '<p>10000</p>', '10000', 250000, 10000, 6, '408d1dae0722ff7ca633-150x150381.png', '10000', '10000', 'ao-dai-dep7221');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_review`
--

CREATE TABLE `tbl_review` (
  `Rid` int(11) NOT NULL,
  `Rname` varchar(70) NOT NULL,
  `Remail` varchar(70) NOT NULL,
  `Rcomment` text NOT NULL,
  `status` int(11) NOT NULL,
  `meta_slug` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_slider`
--

INSERT INTO `tbl_slider` (`id`, `img`, `status`, `created_at`, `updated_at`) VALUES
(17, 'c2302239f63a7e10a008b3ecf629f48dqc2.png', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_Id`);

--
-- Chỉ mục cho bảng `tbl_brand_code_product`
--
ALTER TABLE `tbl_brand_code_product`
  ADD PRIMARY KEY (`code_id`);

--
-- Chỉ mục cho bảng `tbl_category_product`
--
ALTER TABLE `tbl_category_product`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`Con_Id`);

--
-- Chỉ mục cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`cusid`);

--
-- Chỉ mục cho bảng `tbl_info_contact`
--
ALTER TABLE `tbl_info_contact`
  ADD PRIMARY KEY (`id_Info`);

--
-- Chỉ mục cho bảng `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD PRIMARY KEY (`news_id`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`orderid`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`Rid`);

--
-- Chỉ mục cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbl_brand_code_product`
--
ALTER TABLE `tbl_brand_code_product`
  MODIFY `code_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `tbl_category_product`
--
ALTER TABLE `tbl_category_product`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `Con_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `cusid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT cho bảng `tbl_info_contact`
--
ALTER TABLE `tbl_info_contact`
  MODIFY `id_Info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tbl_news`
--
ALTER TABLE `tbl_news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT cho bảng `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `Rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
