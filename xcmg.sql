-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2021 at 12:55 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xcmg`
--

-- --------------------------------------------------------

--
-- Table structure for table `footer_setting`
--

CREATE TABLE `footer_setting` (
  `id` int(11) NOT NULL,
  `aboutus_title` varchar(255) DEFAULT NULL,
  `logo_image` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `facebbok` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `dribble` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `footer_setting`
--

INSERT INTO `footer_setting` (`id`, `aboutus_title`, `logo_image`, `description`, `email`, `phone`, `twitter`, `facebbok`, `instagram`, `dribble`, `created`, `updated`, `inserted`) VALUES
(1, 'About us', '1629452915-logo.png', '<p class=\"footer_address aos-init aos-animate\" data-aos=\"fade-left\">32 Dora Creek, tuntable creek, New South Wales 2480, Australia</p>', 'sample@yourdomain.com', '+088 234 432 15565', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2021-08-20 11:48:35', '2021-08-20 09:48:35');

-- --------------------------------------------------------

--
-- Table structure for table `home_page_setting`
--

CREATE TABLE `home_page_setting` (
  `id` int(11) NOT NULL,
  `aboutus_title` varchar(250) NOT NULL,
  `aboutus_description` text NOT NULL,
  `about_us_thumbnail` text NOT NULL,
  `gmc_title` varchar(255) NOT NULL,
  `gmc_description` text NOT NULL,
  `cfd_mobile_title` varchar(255) NOT NULL,
  `cfd_mobile_description` text NOT NULL,
  `cryptocurrencies_title` varchar(255) NOT NULL,
  `cryptocurrencies_description` text NOT NULL,
  `cfd_mobile_thumbnail` text NOT NULL,
  `cryptocurrencies_thumbnail` text NOT NULL,
  `created` datetime NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `home_page_setting`
--

INSERT INTO `home_page_setting` (`id`, `aboutus_title`, `aboutus_description`, `about_us_thumbnail`, `gmc_title`, `gmc_description`, `cfd_mobile_title`, `cfd_mobile_description`, `cryptocurrencies_title`, `cryptocurrencies_description`, `cfd_mobile_thumbnail`, `cryptocurrencies_thumbnail`, `created`, `inserted`, `updated`) VALUES
(1, 'About Us ', '<h2 class=\"heading_custom\">TRUSTED LOGISTIC SERVICE PROVIDER</h2>\n<ul>\n<li>revolutionary catalysts for change</li>\n<li>catalysts for chang the Seamlessly</li>\n<li>business applications through</li>\n<li>procedures whereas processes</li>\n</ul>\n<p>Distinctively exploit optimal alignments for intuitive business applications through revolutionary catalysts for chang the Seamlessly optimal optimal alignments for intuitive</p>', '1629443775-pjimage330415x246.webp', 'XCMG ARC', '<h2 class=\"heading_custom\">TRUSTED LOGISTIC SERVICE PROVIDER</h2>\n<ul>\n<li>revolutionary catalysts for change</li>\n<li>catalysts for chang the Seamlessly</li>\n<li>business applications through</li>\n<li>procedures whereas processes</li>\n</ul>\n<p>Distinctively exploit optimal alignments for intuitive business applications through revolutionary catalysts for chang the Seamlessly optimal optimal alignments for intuitive</p>', 'Highly Rated CFD Mobile platform', '<h2 class=\"heading_custom\">TRUSTED LOGISTIC SERVICE PROVIDER</h2>\n<ul>\n<li>revolutionary catalysts for change</li>\n<li>catalysts for change the Seamlessly</li>\n<li>business applications through</li>\n<li>procedures whereas processes</li>\n</ul>\n<p>Distinctively exploit optimal alignments for intuitive business applications through revolutionary catalysts for chang the Seamlessly optimal optimal alignments for intuitive</p>\n<p>s.</p>', 'Trade Cryptocurrencies with Leverage', '<h2 class=\"heading_custom\">TRUSTED LOGISTIC SERVICE PROVIDER</h2>\n<ul>\n<li>revolutionary catalysts for change</li>\n<li>catalysts for change the Seamlessly</li>\n<li>business applications through</li>\n<li>procedures whereas processes</li>\n</ul>\n<p>Distinctively exploit optimal alignments for intuitive business applications through revolutionary catalysts for chang the Seamlessly optimal optimal alignments for intuitive</p>', '1629443775-logo.png', '1629452736-pjimage330415x246.webp', '2021-08-20 11:49:53', '2021-08-20 09:49:53', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `koala_nursery_superadmin`
--

CREATE TABLE `koala_nursery_superadmin` (
  `sa_id` int(11) NOT NULL,
  `sa_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sa_user_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sa_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sa_gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sa_city` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sa_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sa_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sa_web` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sa_picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sa_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sa_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sa_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sa_created` datetime NOT NULL,
  `sa_modified` datetime NOT NULL,
  `login_date_time` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_login` int(11) DEFAULT 0 COMMENT '1=online,0=offline',
  `ip_address` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `temp_time` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `temp_time_status` int(11) DEFAULT NULL,
  `sa_update` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `koala_nursery_superadmin`
--

INSERT INTO `koala_nursery_superadmin` (`sa_id`, `sa_name`, `sa_user_name`, `sa_email`, `sa_gender`, `sa_city`, `sa_state`, `sa_country`, `sa_web`, `sa_picture`, `sa_password`, `sa_phone`, `sa_address`, `sa_created`, `sa_modified`, `login_date_time`, `is_login`, `ip_address`, `temp_time`, `temp_time_status`, `sa_update`) VALUES
(1, 'XCMG ARC', 'Koala Nursery', 'gautam@fennelinfotech.com', '1', 'delhi', 'delhi', 'delhi', 'http://google.com', '1629457970-logo.png', 'f0f0593fdcb072607aa4a0eb1a88e40cf0fc3639d838be5e6ed552d94d7960d295362652002549bad2a5ceebdbfbb4c977645905c62b46bb7ea7b31aa8065a39hEKDRZ2uV9aB+4uy3DNpl33OvYy14IO7SPIGXZQ/2nc=', '08823443215565', '32 Dora Creek, tuntable creek, New South Wales 2480, Australia', '0000-00-00 00:00:00', '2020-12-29 11:01:13', '2021-09-01 06:41:56', 1, '::1', '1629543193', 1, '2021-08-20 01:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL,
  `slider_title` text DEFAULT NULL,
  `slider_description` text DEFAULT NULL,
  `slider_url` varchar(250) DEFAULT NULL,
  `slider_image_url` varchar(250) DEFAULT NULL,
  `slider_image_position` int(11) NOT NULL COMMENT '1=left,2=right',
  `slider_status` int(11) NOT NULL DEFAULT 1 COMMENT '0=inactive,1=active',
  `slider_created` datetime NOT NULL,
  `slider_inserted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `slider_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_title`, `slider_description`, `slider_url`, `slider_image_url`, `slider_image_position`, `slider_status`, `slider_created`, `slider_inserted`, `slider_updated`) VALUES
(19, 'Trade with Australia\'s Best CFD Trading Mobile Platform', '<p>Invest easily in GOLD, SILVER, S&amp;P;/ASX 200, Bitcoin, AUD/USD &amp; BITCOIN ETHEREUM with our highly rated CFD Service</p>', 'http://localhost/GMC/superadmin/slider-create', NULL, 1, 1, '2021-07-05 01:24:32', '2021-08-20 07:14:23', '2021-08-20 09:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `upload_document`
--

CREATE TABLE `upload_document` (
  `imageid` int(11) NOT NULL,
  `imageFor` enum('page','category','event','blog','blog_category','menu','gallery','video','slider','homesetting') NOT NULL,
  `gallery_category_id` int(11) DEFAULT NULL,
  `imageForId` int(11) NOT NULL,
  `imageUrl` text NOT NULL,
  `image_full_path` text DEFAULT NULL,
  `image_content` longblob DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` int(11) NOT NULL,
  `deletedAt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `upload_document`
--

INSERT INTO `upload_document` (`imageid`, `imageFor`, `gallery_category_id`, `imageForId`, `imageUrl`, `image_full_path`, `image_content`, `createdAt`, `updatedAt`, `deletedAt`) VALUES
(150, 'page', NULL, 0, '', NULL, NULL, NULL, 0, 0),
(151, 'page', NULL, 0, '', NULL, NULL, NULL, 0, 0),
(152, 'page', NULL, 0, '', NULL, NULL, NULL, 0, 0),
(153, 'page', NULL, 0, '', NULL, NULL, NULL, 0, 0),
(284, 'blog_category', NULL, 3, '1610013737-demotextbusinessmandarkvintagebackground108609906.jpg', NULL, NULL, '2021-01-07 11:02:17', 0, 0),
(305, 'blog_category', NULL, 6, '1610023117-download.png', NULL, NULL, '2021-01-07 13:38:37', 0, 0),
(318, 'blog_category', NULL, 5, '1610025192-demotextbusinessmandarkvintagebackground108609906.jpg', NULL, NULL, '2021-01-07 14:13:12', 0, 0),
(319, 'blog_category', NULL, 7, '1610025204-download.png', NULL, NULL, '2021-01-07 14:13:24', 0, 0),
(367, 'event', NULL, 6, '1612759763-Image5.jpg', NULL, NULL, '2021-02-08 05:49:23', 0, 0),
(376, 'blog_category', NULL, 8, '1612786645-Image5.jpg', NULL, NULL, '2021-02-08 12:17:25', 0, 0),
(380, 'page', NULL, 19, '1612948657-Image5.jpg', NULL, NULL, '2021-02-10 09:17:38', 0, 0),
(384, 'page', NULL, 22, '1614866779-quote.jpg', NULL, NULL, '2021-03-04 14:06:19', 0, 0),
(387, 'page', NULL, 25, '1614951170-readingbooksimage.jfif', NULL, NULL, '2021-03-05 13:32:50', 0, 0),
(389, 'page', NULL, 27, '1614955623-routinequote.jfif', NULL, NULL, '2021-03-05 14:47:03', 0, 0),
(390, 'page', NULL, 28, '1614956286-pottytrainingpicture.jpg', NULL, NULL, '2021-03-05 14:58:06', 0, 0),
(405, 'page', NULL, 31, '1619972859-Koalas101NatGeoWild.mp4', NULL, NULL, '2021-05-02 16:27:58', 0, 0),
(407, 'page', NULL, 15, '1619973202-KoalaNurseryLtd.png', NULL, NULL, '2021-05-02 16:33:22', 0, 0),
(416, '', NULL, 82253638, '1622612584-gallery2.jpeg', NULL, NULL, '2021-06-02 05:43:07', 0, 0),
(417, '', NULL, 48416237, '1622612720-Image9.jpg', NULL, NULL, '2021-06-02 05:45:20', 0, 0),
(418, 'page', NULL, 32, '1623060488-KoalaLogo2.png', NULL, NULL, '2021-06-07 10:08:08', 0, 0),
(419, 'page', NULL, 30, '1623060620-image1.jpg', NULL, NULL, '2021-06-07 10:10:20', 0, 0),
(421, 'page', NULL, 29, '1623074088-policiesandprocedures.jfif', NULL, NULL, '2021-06-07 13:54:48', 0, 0),
(422, 'page', NULL, 26, '1623074926-phonicspicture.jpg', NULL, NULL, '2021-06-07 14:08:46', 0, 0),
(424, 'page', NULL, 24, '1623144340-foodhygeinerating.png', NULL, NULL, '2021-06-08 09:25:40', 0, 0),
(425, 'page', NULL, 23, '1623144403-curriculumimage.jpg', NULL, NULL, '2021-06-08 09:26:43', 0, 0),
(426, 'page', NULL, 33, '1623145142-policiesandprocedures.jfif', NULL, NULL, '2021-06-08 09:39:02', 0, 0),
(427, 'event', NULL, 5, '1624442667-sportsday.jfif', NULL, NULL, '2021-06-23 10:04:27', 0, 0),
(428, 'event', NULL, 4, '1624444128-farmtrips.jfif', NULL, NULL, '2021-06-23 10:28:48', 0, 0),
(429, 'blog', NULL, 8, '1624444483-pottytrainingpicture.jpg', NULL, NULL, '2021-06-23 10:34:43', 0, 0),
(430, 'blog', NULL, 7, '1624444737-esafety.jfif', NULL, NULL, '2021-06-23 10:38:57', 0, 0),
(431, 'blog', NULL, 6, '1624445246-policiesandprocedures.jfif', NULL, NULL, '2021-06-23 10:47:26', 0, 0),
(432, 'blog', NULL, 3, '1624445886-policiesandprocedures.jfif', NULL, NULL, '2021-06-23 10:58:06', 0, 0),
(433, 'blog', NULL, 1, '1624446125-foodhygeinerating.png', NULL, NULL, '2021-06-23 11:02:05', 0, 0),
(437, 'video', NULL, 13, 'https://www.youtube.com/watch?v=tiYZnAb4n3E', NULL, NULL, NULL, 0, 0),
(438, 'video', NULL, 10, 'https://www.youtube.com/watch?v=8MRCgySkjGs', NULL, NULL, '2021-06-23 11:45:09', 0, 0),
(439, 'video', NULL, 10, 'https://www.youtube.com/watch?v=Ka0wzh25Hww', NULL, NULL, '2021-06-23 11:46:41', 0, 0),
(440, 'video', NULL, 10, 'https://www.youtube.com/watch?v=4AubxC0gY7g', NULL, NULL, '2021-06-23 11:48:36', 0, 0),
(441, 'video', NULL, 9, 'https://www.youtube.com/watch?v=HoSdyG2fHiU', NULL, NULL, '2021-06-23 11:52:07', 0, 0),
(442, 'video', NULL, 9, 'https://www.youtube.com/watch?v=nPrKaDU_f7M', NULL, NULL, '2021-06-23 11:52:45', 0, 0),
(443, 'video', NULL, 9, 'https://www.youtube.com/watch?v=espJ96TJHV8', NULL, NULL, '2021-06-23 11:54:07', 0, 0),
(445, 'gallery', NULL, 12, '1624452339-healthyeatinginvestigation.jpg', NULL, NULL, '2021-06-23 12:45:39', 0, 0),
(446, 'gallery', NULL, 12, '1624452364-smallworld.jpg', NULL, NULL, '2021-06-23 12:46:04', 0, 0),
(447, 'gallery', NULL, 12, '1624453155-waterplay.png', NULL, NULL, '2021-06-23 12:59:15', 0, 0),
(448, 'gallery', NULL, 11, '1624453200-maths.jfif', NULL, NULL, '2021-06-23 13:00:00', 0, 0),
(449, 'gallery', NULL, 11, '1624453220-sandplay.jfif', NULL, NULL, '2021-06-23 13:00:20', 0, 0),
(450, 'gallery', NULL, 11, '1624453236-benjaminfranklinquote.png', NULL, NULL, '2021-06-23 13:00:36', 0, 0),
(451, 'gallery', NULL, 10, '1624453258-curriculumimage.jpg', NULL, NULL, '2021-06-23 13:00:58', 0, 0),
(452, 'gallery', NULL, 10, '1624453278-curriculumpicture.jpg', NULL, NULL, '2021-06-23 13:01:18', 0, 0),
(453, 'gallery', NULL, 10, '1624453362-curriculumpic.jpg', NULL, NULL, '2021-06-23 13:02:42', 0, 0),
(454, 'blog', NULL, 9, '1624453802-phonicspicture.jpg', NULL, NULL, '2021-06-23 13:10:02', 0, 0),
(455, 'blog', NULL, 10, '1624454002-readingbooksimage.jfif', NULL, NULL, '2021-06-23 13:13:22', 0, 0),
(456, 'blog', NULL, 11, '1624454188-curriculumimage.jpg', NULL, NULL, '2021-06-23 13:16:28', 0, 0),
(461, 'blog', NULL, 13, '1624612821-routinequote.jfif', NULL, NULL, '2021-06-25 10:20:21', 0, 0),
(462, 'blog', NULL, 14, '1624613560-parentsquote.jfif', NULL, NULL, '2021-06-25 10:32:40', 0, 0),
(463, 'video', NULL, 14, 'https://www.youtube.com/watch?v=DPW5SnyAaXc', NULL, NULL, NULL, 0, 0),
(464, 'video', NULL, 14, 'https://www.youtube.com/watch?v=wuOsIKt7yCo', NULL, NULL, '2021-06-25 12:16:53', 0, 0),
(465, 'video', NULL, 14, 'https://www.youtube.com/watch?v=URWFWIsuf84', NULL, NULL, '2021-06-25 12:17:27', 0, 0),
(466, 'video', NULL, 14, 'https://www.youtube.com/watch?v=E7w--BxiA70', NULL, NULL, '2021-06-25 12:17:55', 0, 0),
(467, 'video', NULL, 14, 'https://www.youtube.com/watch?v=fNpPqQuybvE', NULL, NULL, '2021-06-25 12:19:22', 0, 0),
(468, 'video', NULL, 14, 'https://www.youtube.com/watch?v=gitHf-otAFQ', NULL, NULL, '2021-06-25 12:20:10', 0, 0),
(469, 'video', NULL, 10, 'https://www.youtube.com/watch?v=ajnvz_PqdGs', NULL, NULL, '2021-06-25 12:22:08', 0, 0),
(470, 'video', NULL, 13, 'https://www.youtube.com/watch?v=buE6l32rCHo', NULL, NULL, '2021-06-25 12:24:34', 0, 0),
(471, 'video', NULL, 13, 'https://www.youtube.com/watch?v=e_04ZrNroTo', NULL, NULL, '2021-06-25 12:26:13', 0, 0),
(472, 'gallery', NULL, 12, '1624620489-dinosauractivity.jfif', NULL, NULL, '2021-06-25 12:28:09', 0, 0),
(473, 'gallery', NULL, 11, '1624620535-Countingandsortingmaterialsforthemathsarea.jpg', NULL, NULL, '2021-06-25 12:28:55', 0, 0),
(474, 'gallery', NULL, 11, '1624620556-investigationareas.jpg', NULL, NULL, '2021-06-25 12:29:16', 0, 0),
(475, 'video', NULL, 9, 'https://www.youtube.com/watch?v=BIDi3DCES0w', NULL, NULL, '2021-06-25 12:37:56', 0, 0),
(476, 'page', NULL, 14, '1624625846-indooreditphoto.jpg', NULL, NULL, '2021-06-25 13:57:26', 0, 0),
(477, 'page', NULL, 18, '1624626073-approach.png', NULL, NULL, '2021-06-25 14:01:13', 0, 0),
(478, 'page', NULL, 20, '1624626244-koalalogoCopy.jpg', NULL, NULL, '2021-06-25 14:04:04', 0, 0),
(479, 'page', NULL, 21, '1624626718-koalalogo.jpg', NULL, NULL, '2021-06-25 14:11:58', 0, 0),
(480, 'blog', NULL, 12, '1624626792-staff.jpg', NULL, NULL, '2021-06-25 14:13:12', 0, 0),
(484, 'slider', NULL, 19, '1629443663-pjimage330415x246.webp', 'http://localhost/XCMG//uploads/slider/1629443663-pjimage330415x246.webp', NULL, '2021-08-20 09:14:23', 0, 0),
(485, 'homesetting', NULL, 1, '1629443775-pjimage330415x2461.webp', 'http://localhost/XCMG//uploads/homepagesetting/1629443775-pjimage330415x2461.webp', NULL, '2021-08-20 09:16:15', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `xcmg_permit_calculation`
--

CREATE TABLE `xcmg_permit_calculation` (
  `xcp_id` int(11) NOT NULL,
  `xcp_state_id` int(11) NOT NULL,
  `xcp_permit_type_id` int(11) NOT NULL,
  `xcmg_overall_operator` varchar(255) NOT NULL,
  `xcp_truck_type_id` int(11) NOT NULL,
  `xcp_width_limit_ft` varchar(255) NOT NULL,
  `xcp_width_rule_operator` varchar(255) NOT NULL,
  `xcp_height_limit_ft` varchar(255) NOT NULL,
  `xcp_height_rule_operator` varchar(255) NOT NULL,
  `xcp_length_limit_ft` varchar(255) NOT NULL,
  `xcp_length_limit_operator` varchar(255) NOT NULL,
  `xcp_front_overhang_ft` varchar(255) NOT NULL,
  `xcp_rear_overhang_ft` varchar(255) NOT NULL,
  `xcp_steer_axle_lb` varchar(255) NOT NULL,
  `xcp_steer_axle_lb_in` varchar(255) NOT NULL,
  `xcp_single_axle_lb` varchar(255) NOT NULL,
  `xcp_single_axle_lb_in` varchar(255) NOT NULL,
  `xcp_axle_width_ft` varchar(255) NOT NULL,
  `xcp_axle_width_operator` varchar(255) NOT NULL,
  `xcp_tandem_lb` varchar(255) NOT NULL,
  `xcp_tandem_lb_in` varchar(255) NOT NULL,
  `xcp_tridem_lb` varchar(255) NOT NULL,
  `xcp_tridem_lb_in` varchar(255) NOT NULL,
  `xcp_quad_lb` varchar(255) NOT NULL,
  `xcp_quad_lb_in` varchar(255) NOT NULL,
  `xcp_5_axles_lb` float NOT NULL,
  `xcp_5_axles_lb_in` float NOT NULL,
  `xcp_gvw` float NOT NULL,
  `xcp_gvw_operator` varchar(255) NOT NULL,
  `xcp_noted` text NOT NULL,
  `xcp_created` datetime NOT NULL,
  `xcp_inserted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `xcp_updated` datetime NOT NULL,
  `xcp_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active,2-inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `xcmg_permit_calculation`
--

INSERT INTO `xcmg_permit_calculation` (`xcp_id`, `xcp_state_id`, `xcp_permit_type_id`, `xcmg_overall_operator`, `xcp_truck_type_id`, `xcp_width_limit_ft`, `xcp_width_rule_operator`, `xcp_height_limit_ft`, `xcp_height_rule_operator`, `xcp_length_limit_ft`, `xcp_length_limit_operator`, `xcp_front_overhang_ft`, `xcp_rear_overhang_ft`, `xcp_steer_axle_lb`, `xcp_steer_axle_lb_in`, `xcp_single_axle_lb`, `xcp_single_axle_lb_in`, `xcp_axle_width_ft`, `xcp_axle_width_operator`, `xcp_tandem_lb`, `xcp_tandem_lb_in`, `xcp_tridem_lb`, `xcp_tridem_lb_in`, `xcp_quad_lb`, `xcp_quad_lb_in`, `xcp_5_axles_lb`, `xcp_5_axles_lb_in`, `xcp_gvw`, `xcp_gvw_operator`, `xcp_noted`, `xcp_created`, `xcp_inserted`, `xcp_updated`, `xcp_status`) VALUES
(10, 18, 15, '<', 1, '8.5', '<', '15.5', 'no', '45', '<', '3', '4', '', '600', '2000', '50', '', 'no', '38000', '550', '42000', '550', '50000', '', 550, 0, 150000, '<', '', '2021-08-27 09:02:50', '2021-08-31 07:32:03', '0000-00-00 00:00:00', 1),
(11, 18, 24, '<', 6, '18', '<', '18', '<', '150', '<', '', '', '30000', '700', '56000', '700', '', 'no', '70000', '700', '80000', '700', '700', '700', 0, 0, 250000, '<', 'Other than steering axle, other axle must have minimum 3\'6\" tire spacing ', '2021-08-27 02:00:51', '2021-08-31 07:32:05', '0000-00-00 00:00:00', 1),
(14, 32, 17, '<', 6, '18', '<', '18', '<', '150', '<', '', '', '30000', '700', '56000', '700', '', '<', '70000', '700', '80000', '700', '', '700', 500, 0, 250000, '<', '', '2021-08-31 11:18:07', '2021-09-01 08:23:53', '2021-09-01 10:23:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `xcmg_permit_type`
--

CREATE TABLE `xcmg_permit_type` (
  `permit_id` int(11) NOT NULL,
  `permit_type` varchar(255) NOT NULL,
  `permit_created` datetime NOT NULL,
  `permit_inserted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `permit_updated` datetime NOT NULL,
  `permit_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active,2=inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `xcmg_permit_type`
--

INSERT INTO `xcmg_permit_type` (`permit_id`, `permit_type`, `permit_created`, `permit_inserted`, `permit_updated`, `permit_status`) VALUES
(15, 'No', '2021-08-25 01:24:17', '2021-08-25 11:24:17', '0000-00-00 00:00:00', 1),
(16, 'Routine (Single)', '2021-08-25 01:24:31', '2021-08-25 11:24:31', '0000-00-00 00:00:00', 1),
(17, 'Annual', '2021-08-25 01:24:38', '2021-08-25 11:24:38', '0000-00-00 00:00:00', 1),
(18, 'Superload', '2021-08-25 01:24:46', '2021-08-25 11:24:46', '0000-00-00 00:00:00', 1),
(19, '6 Days', '2021-08-25 01:25:13', '2021-08-25 11:25:13', '0000-00-00 00:00:00', 1),
(20, 'Single Trip', '2021-08-25 01:25:22', '2021-08-25 11:25:22', '0000-00-00 00:00:00', 1),
(21, 'Routine', '2021-08-25 01:25:31', '2021-08-25 11:25:31', '0000-00-00 00:00:00', 1),
(22, 'Class C', '2021-08-25 01:25:41', '2021-08-25 11:25:41', '0000-00-00 00:00:00', 1),
(23, 'Holiday', '2021-08-25 01:26:04', '2021-08-25 11:26:04', '0000-00-00 00:00:00', 1),
(24, 'Routine(single)', '2021-08-25 01:26:14', '2021-08-25 11:26:14', '0000-00-00 00:00:00', 1),
(25, 'Repetitive', '2021-08-25 01:26:23', '2021-08-25 11:26:23', '0000-00-00 00:00:00', 1),
(26, 'Special', '2021-08-25 01:26:43', '2021-08-25 11:26:43', '0000-00-00 00:00:00', 1),
(27, 'Routine Crane/Concrete Pump', '2021-08-25 01:26:54', '2021-08-25 11:26:54', '0000-00-00 00:00:00', 1),
(28, 'Annual Plus', '2021-08-25 01:27:26', '2021-08-25 11:27:26', '0000-00-00 00:00:00', 1),
(29, 'Annual Commercial Wrecker Tow', '2021-08-25 01:27:37', '2021-08-25 11:27:37', '0000-00-00 00:00:00', 1),
(30, 'Superload Single', '2021-08-25 01:28:13', '2021-08-25 11:28:13', '0000-00-00 00:00:00', 1),
(31, 'Superload Plus', '2021-08-25 01:28:22', '2021-08-25 11:28:22', '0000-00-00 00:00:00', 1),
(32, 'Continuouis <1yr', '2021-08-25 01:28:36', '2021-08-25 11:28:36', '0000-00-00 00:00:00', 1),
(33, 'Annual oversize/overweight', '2021-08-25 01:28:46', '2021-08-25 11:28:46', '0000-00-00 00:00:00', 1),
(34, '90 Day', '2021-08-25 01:28:58', '2021-08-25 11:28:58', '0000-00-00 00:00:00', 1),
(35, 'Standard', '2021-08-25 01:29:09', '2021-08-25 11:29:09', '0000-00-00 00:00:00', 1),
(36, 'Monthly', '2021-08-25 01:32:12', '2021-08-25 11:32:12', '0000-00-00 00:00:00', 1),
(37, 'Cranes', '2021-08-25 01:33:07', '2021-08-25 11:33:07', '0000-00-00 00:00:00', 1),
(38, 'Tractors', '2021-08-25 01:33:16', '2021-08-25 11:33:16', '0000-00-00 00:00:00', 1),
(39, 'Construction Equipment lo bed', '2021-08-25 01:33:29', '2021-08-25 11:33:29', '0000-00-00 00:00:00', 1),
(40, 'Special Hauling', '2021-08-25 01:35:03', '2021-08-25 11:35:03', '0000-00-00 00:00:00', 1),
(41, 'Excessive Hauling Superloads', '2021-08-25 01:35:14', '2021-08-25 11:35:21', '2021-08-25 01:35:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `xcmg_state`
--

CREATE TABLE `xcmg_state` (
  `state_id` int(11) NOT NULL,
  `state_code` varchar(255) NOT NULL,
  `state_name` varchar(255) NOT NULL,
  `state_created` datetime NOT NULL,
  `state_updated` datetime NOT NULL,
  `state_inserted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `state_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active,2=inacitve'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `xcmg_state`
--

INSERT INTO `xcmg_state` (`state_id`, `state_code`, `state_name`, `state_created`, `state_updated`, `state_inserted`, `state_status`) VALUES
(18, 'AK', 'Alaska', '2021-08-25 12:57:18', '0000-00-00 00:00:00', '2021-08-25 10:57:18', 1),
(19, 'AL', 'Alabama', '2021-08-25 12:57:38', '0000-00-00 00:00:00', '2021-08-25 10:57:38', 1),
(20, 'AR', 'Arkansas', '2021-08-25 12:57:53', '0000-00-00 00:00:00', '2021-08-25 10:57:53', 1),
(21, 'AZ', 'Arizona', '2021-08-25 12:58:21', '0000-00-00 00:00:00', '2021-08-25 10:58:21', 1),
(22, 'CA', 'California', '2021-08-25 12:58:38', '0000-00-00 00:00:00', '2021-08-25 10:58:38', 1),
(23, 'CN', 'Connecticut', '2021-08-25 12:58:50', '0000-00-00 00:00:00', '2021-08-25 10:58:50', 1),
(24, 'DC', 'District of Columbia', '2021-08-25 12:59:16', '0000-00-00 00:00:00', '2021-08-25 10:59:16', 1),
(25, 'CO', 'CO', '2021-08-25 12:59:47', '0000-00-00 00:00:00', '2021-08-25 10:59:47', 1),
(26, 'FL', 'FL', '2021-08-25 12:59:57', '0000-00-00 00:00:00', '2021-08-25 10:59:57', 1),
(27, 'GA', 'GA', '2021-08-25 01:00:07', '0000-00-00 00:00:00', '2021-08-25 11:00:07', 1),
(28, 'HI', 'HI', '2021-08-25 01:00:20', '0000-00-00 00:00:00', '2021-08-25 11:00:20', 1),
(29, 'IA', 'IA', '2021-08-25 01:00:31', '0000-00-00 00:00:00', '2021-08-25 11:00:31', 1),
(30, 'ID', 'ID', '2021-08-25 01:00:42', '0000-00-00 00:00:00', '2021-08-25 11:00:42', 1),
(31, 'IL', 'IL', '2021-08-25 01:00:57', '0000-00-00 00:00:00', '2021-08-25 11:00:57', 1),
(32, 'IN', 'IN', '2021-08-25 01:01:33', '0000-00-00 00:00:00', '2021-08-25 11:01:33', 1),
(33, 'KS', 'KS', '2021-08-25 01:03:21', '0000-00-00 00:00:00', '2021-08-25 11:03:21', 1),
(34, 'KT', 'KT', '2021-08-25 01:03:34', '0000-00-00 00:00:00', '2021-08-25 11:03:34', 1),
(35, 'LA', 'LA', '2021-08-25 01:03:46', '0000-00-00 00:00:00', '2021-08-25 11:03:46', 1),
(36, 'MA', 'MA', '2021-08-25 01:03:57', '0000-00-00 00:00:00', '2021-08-25 11:03:57', 1),
(37, 'MD', 'Maryland', '2021-08-25 01:04:16', '0000-00-00 00:00:00', '2021-08-25 11:04:16', 1),
(38, 'ME', 'Maine', '2021-08-25 01:05:08', '0000-00-00 00:00:00', '2021-08-25 11:05:08', 1),
(39, 'MI', 'Michigan', '2021-08-25 01:05:24', '0000-00-00 00:00:00', '2021-08-25 11:05:24', 1),
(40, 'MN', 'Minnesota', '2021-08-25 01:05:40', '0000-00-00 00:00:00', '2021-08-25 11:05:40', 1),
(41, 'MO', 'MIssouri', '2021-08-25 01:05:55', '0000-00-00 00:00:00', '2021-08-25 11:05:55', 1),
(42, 'MS', 'Misssissippi', '2021-08-25 01:06:24', '0000-00-00 00:00:00', '2021-08-25 11:06:24', 1),
(43, 'MT', 'Montana', '2021-08-25 01:06:36', '0000-00-00 00:00:00', '2021-08-25 11:06:36', 1),
(44, 'NV', 'Nevada', '2021-08-25 01:06:53', '0000-00-00 00:00:00', '2021-08-25 11:06:53', 1),
(47, 'OH', 'Ohio', '2021-08-25 01:11:25', '2021-08-25 01:15:39', '2021-08-25 11:15:39', 1),
(48, 'NY', 'New York', '2021-08-25 01:22:07', '0000-00-00 00:00:00', '2021-08-25 11:22:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `xcmg_state_wise_permit`
--

CREATE TABLE `xcmg_state_wise_permit` (
  `xcmg_swp_id` int(11) NOT NULL,
  `xcmg_swp_permit_type` int(11) NOT NULL,
  `xcmg_swp_state_id` int(11) NOT NULL,
  `xcmg_swp_created` datetime NOT NULL,
  `xcmg_swp_updated` datetime NOT NULL,
  `xcmg_swp_inserted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `xcmg_swp_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active,2=inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `xcmg_state_wise_permit`
--

INSERT INTO `xcmg_state_wise_permit` (`xcmg_swp_id`, `xcmg_swp_permit_type`, `xcmg_swp_state_id`, `xcmg_swp_created`, `xcmg_swp_updated`, `xcmg_swp_inserted`, `xcmg_swp_status`) VALUES
(8, 1, 17, '2021-08-25 11:53:44', '0000-00-00 00:00:00', '2021-08-25 09:53:44', 1),
(9, 12, 17, '2021-08-25 11:53:44', '0000-00-00 00:00:00', '2021-08-25 09:53:44', 1),
(10, 122, 17, '2021-08-25 11:53:44', '0000-00-00 00:00:00', '2021-08-25 09:53:44', 1),
(11, 566577, 17, '2021-08-25 11:53:44', '0000-00-00 00:00:00', '2021-08-25 09:53:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `xcmg_truck_type`
--

CREATE TABLE `xcmg_truck_type` (
  `xcmg_truck_type_id` int(11) NOT NULL,
  `xcmg_truck_type_name` varchar(255) NOT NULL,
  `tab_id` int(11) NOT NULL,
  `xcmg_truck_type_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `xcmg_truck_type_updated` datetime NOT NULL,
  `xcmg_truck_type_inserted` datetime NOT NULL,
  `xcmg_truck_type_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active,2=inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `xcmg_truck_type`
--

INSERT INTO `xcmg_truck_type` (`xcmg_truck_type_id`, `xcmg_truck_type_name`, `tab_id`, `xcmg_truck_type_created`, `xcmg_truck_type_updated`, `xcmg_truck_type_inserted`, `xcmg_truck_type_status`) VALUES
(1, '1 Steering with Tandem', 1, '2021-08-27 01:13:34', '0000-00-00 00:00:00', '2021-08-13 17:10:48', 1),
(2, '1 Steering with Tridem', 2, '2021-08-27 01:13:42', '0000-00-00 00:00:00', '2021-08-20 17:10:48', 1),
(5, '2 Steering with Tandem', 3, '2021-08-27 01:13:54', '0000-00-00 00:00:00', '2021-08-12 17:12:15', 1),
(6, '2 Steering with Tridem', 4, '2021-08-27 01:14:03', '0000-00-00 00:00:00', '2021-08-20 17:12:15', 1),
(7, '1 Steering with Quad', 5, '2021-08-27 01:14:11', '0000-00-00 00:00:00', '2021-08-04 17:13:11', 1),
(8, '1 Steering with 5 Axles\r\n', 6, '2021-08-27 01:14:42', '0000-00-00 00:00:00', '2021-08-12 17:13:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `xcmg_user`
--

CREATE TABLE `xcmg_user` (
  `user_id` int(11) NOT NULL,
  `user_registration_number` int(11) NOT NULL,
  `user_first_name` varchar(255) NOT NULL,
  `user_last_name` varchar(255) NOT NULL,
  `user_company` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_password` text NOT NULL,
  `user_profile_image` text NOT NULL,
  `login_date_time` varchar(255) NOT NULL,
  `is_login` int(11) NOT NULL COMMENT '	1=online,0=offline',
  `ip_address` text NOT NULL,
  `temp_time` varchar(255) NOT NULL,
  `temp` varchar(255) NOT NULL,
  `temp_time_status` int(11) NOT NULL,
  `user_created` datetime NOT NULL,
  `user_inserted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_updated` datetime NOT NULL,
  `user_status` int(11) NOT NULL COMMENT '1=active,2=inactive	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `xcmg_user`
--

INSERT INTO `xcmg_user` (`user_id`, `user_registration_number`, `user_first_name`, `user_last_name`, `user_company`, `user_email`, `user_phone`, `user_password`, `user_profile_image`, `login_date_time`, `is_login`, `ip_address`, `temp_time`, `temp`, `temp_time_status`, `user_created`, `user_inserted`, `user_updated`, `user_status`) VALUES
(5, 92576477, 'Himanshu', 'Gautam', 'demo', 'gautam@fennelinfotech.com', '8535030684', '0d02c6d622b40c5819c1969a6ebce59e490ee10ce4f1bd48a6a9c128f792ed598d22dbf47345009e55447dcc50a24e715559fb9df1753e352d8ae99f608f0766wvPn0pQv86WiaNJbYKItPVCatBRz1416+pUKZsy243Y=', '1629349093-pjimage330415x246.webp', '2021-09-01 06:41:15', 1, '::1', '1629348958', '1629268998892693', 0, '2021-08-18 08:43:18', '2021-09-01 04:41:15', '2021-08-19 06:58:13', 1),
(6, 45564573, 'Developer ', 'TEST', 'demo', 'develoepr@fennelinfotech.com', '07017169600', '90f0ff7d5a4c794f6c7598876a8d07b67534d350bd143a722b2c24fcff5939e925534b9ed2fd9e802a9c021b0c2ba699d9ac00e746dacc0f9d6b03216e25f1c2JR/T32N1o+LcPDRKN/NOTOzUfdYU6WGSvMWeceWi2BM=', '1629278521-pjimage330415x246.webp', '2021-08-26 08:26:42', 1, '::1', '', '1629271567930758', 0, '2021-08-18 09:26:07', '2021-08-26 06:26:42', '2021-08-18 11:37:41', 1),
(7, 82821388, 'Saurav', 'Kumar', 'demo', 'sauravr@fennelinfotech.com', '07906616875', '3ad7bcef8dbff23d173e27f1d709af78cad571d2fc4c74816f6f4b7dc88bb8e4dec18003e195e179ebdd18cedd323372f087913966c72b588daead945b4a1fcaAUO4Nfr0azFh4WfVPadR87CHPWuGBeAkQC7/Z1TSoPQ=', '', '', 0, '0', '', '1629271751691346', 0, '2021-08-18 09:29:11', '2021-08-20 07:33:10', '0000-00-00 00:00:00', 1),
(8, 74221732, 'demo', 'demo', 'demo', 'dev@fennelinfotech.com', '8535030684', '7ec144f4af88a6a414a4af76e5095a87494f4990925a0cb271d131e733c145e20d71f27b559ebc021a089fab2f06d42692ac9b8daa932e84e013dcc3071b3601HTmeOq0KRs7KgPW0R98hU2uXY1J3TRh5pR3iD6sykuI=', '', '', 0, '::1', '', '1629271853276782', 0, '2021-08-18 09:30:53', '2021-08-20 07:33:22', '0000-00-00 00:00:00', 1),
(11, 65586274, 'Himanshu', 'Gautam', 'demo', 'babagautam@fennelinfotech.com', '7417417410', '5e2f41604e5d17561e7b46b15bcddc7a8cb667a1992009b3c73001001110448e8c5345b3442d3a35269746cb771c2c358ab1cc0f21a75f859e78d9d2cb572101WFYJLXo6aZ8SRncw21fVZ1RivHSovNVbNPgt6Kf1o1o=', '1629452674-pjimage330415x246.webp', '', 0, '', '', '', 0, '2021-08-20 11:44:19', '2021-08-20 09:44:34', '2021-08-20 11:44:34', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `footer_setting`
--
ALTER TABLE `footer_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_page_setting`
--
ALTER TABLE `home_page_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `koala_nursery_superadmin`
--
ALTER TABLE `koala_nursery_superadmin`
  ADD PRIMARY KEY (`sa_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `upload_document`
--
ALTER TABLE `upload_document`
  ADD PRIMARY KEY (`imageid`);

--
-- Indexes for table `xcmg_permit_calculation`
--
ALTER TABLE `xcmg_permit_calculation`
  ADD PRIMARY KEY (`xcp_id`);

--
-- Indexes for table `xcmg_permit_type`
--
ALTER TABLE `xcmg_permit_type`
  ADD PRIMARY KEY (`permit_id`);

--
-- Indexes for table `xcmg_state`
--
ALTER TABLE `xcmg_state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `xcmg_state_wise_permit`
--
ALTER TABLE `xcmg_state_wise_permit`
  ADD PRIMARY KEY (`xcmg_swp_id`);

--
-- Indexes for table `xcmg_truck_type`
--
ALTER TABLE `xcmg_truck_type`
  ADD PRIMARY KEY (`xcmg_truck_type_id`);

--
-- Indexes for table `xcmg_user`
--
ALTER TABLE `xcmg_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `footer_setting`
--
ALTER TABLE `footer_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `home_page_setting`
--
ALTER TABLE `home_page_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `koala_nursery_superadmin`
--
ALTER TABLE `koala_nursery_superadmin`
  MODIFY `sa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `upload_document`
--
ALTER TABLE `upload_document`
  MODIFY `imageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=486;

--
-- AUTO_INCREMENT for table `xcmg_permit_calculation`
--
ALTER TABLE `xcmg_permit_calculation`
  MODIFY `xcp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `xcmg_permit_type`
--
ALTER TABLE `xcmg_permit_type`
  MODIFY `permit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `xcmg_state`
--
ALTER TABLE `xcmg_state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `xcmg_state_wise_permit`
--
ALTER TABLE `xcmg_state_wise_permit`
  MODIFY `xcmg_swp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `xcmg_truck_type`
--
ALTER TABLE `xcmg_truck_type`
  MODIFY `xcmg_truck_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `xcmg_user`
--
ALTER TABLE `xcmg_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
