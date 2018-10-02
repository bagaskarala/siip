-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2018 at 05:45 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ugmpress`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` mediumint(9) NOT NULL,
  `work_unit_id` mediumint(9) DEFAULT NULL,
  `institute_id` mediumint(9) DEFAULT NULL,
  `author_nip` varchar(256) NOT NULL,
  `author_name` varchar(256) NOT NULL,
  `author_degree_front` varchar(256) NOT NULL,
  `author_degree_back` varchar(256) NOT NULL,
  `author_latest_education` enum('s1','s2','s3','other') NOT NULL,
  `author_address` text NOT NULL,
  `author_contact` varchar(20) NOT NULL,
  `author_email` varchar(256) NOT NULL,
  `bank_id` varchar(4) DEFAULT NULL,
  `author_saving_num` varchar(30) NOT NULL,
  `heir_name` varchar(256) NOT NULL,
  `user_id` mediumint(9) DEFAULT NULL,
  `author_ktp` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `work_unit_id`, `institute_id`, `author_nip`, `author_name`, `author_degree_front`, `author_degree_back`, `author_latest_education`, `author_address`, `author_contact`, `author_email`, `bank_id`, `author_saving_num`, `heir_name`, `user_id`, `author_ktp`) VALUES
(1, 1, 1, '1', 'Dono', 'Ir.', 'M.T., Ph.D', 's1', 'Yogyakarta', '081511124578', 'dono@email.com', '009', '8874322512', 'Doni', 6, 'Dono_20180920221629.jpg'),
(2, 5, 2, '2', 'Harry Pribadi', 'Ir.', '', 's1', 'Jakarta', '08188788521', 'hari@email.com', '014', '321669854', 'Heru', 7, 'Harry_Pribadi_20180920221701.jpg'),
(3, 1, 1, '3', 'Jaka Sembung', '', 'S.T', 's1', 'Malang', '08798919191919', 'jakasembung@ganyambung.com', '046', '9998282737', 'Jaki', 9, 'Jaka_Sembung_20180920221648.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `bank_name` varchar(256) NOT NULL,
  `bank_id` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`bank_name`, `bank_id`) VALUES
('BANK BRI', '002'),
('BANK EKSPOR INDONESIA', '003'),
('BANK MANDIRI', '008'),
('BANK BNI', '009'),
('BANK DANAMON', '011'),
('PERMATA BANK', '013'),
('BANK BCA', '014'),
('BANK BII', '016'),
('BANK PANIN', '019'),
('BANK ARTA NIAGA KENCANA', '020'),
('BANK NIAGA', '022'),
('BANK BUANA IND', '023'),
('BANK LIPPO', '026'),
('BANK NISP', '028'),
('AMERICAN EXPRESS BANK LTD', '030'),
('CITIBANK N.A.', '031'),
('JP. MORGAN CHASE BANK, N.A.', '032'),
('BANK OF AMERICA, N.A', '033'),
('ING INDONESIA BANK', '034'),
('BANK MULTICOR TBK.', '036'),
('BANK ARTHA GRAHA', '037'),
('BANK CREDIT AGRICOLE INDOSUEZ', '039'),
('THE BANGKOK BANK COMP. LTD', '040'),
('THE HONGKONG & SHANGHAI B.C.', '041'),
('THE BANK OF TOKYO MITSUBISHI UFJ LTD', '042'),
('BANK SUMITOMO MITSUI INDONESIA', '045'),
('BANK DBS INDONESIA', '046'),
('BANK RESONA PERDANIA', '047'),
('BANK MIZUHO INDONESIA', '048'),
('STANDARD CHARTERED BANK', '050'),
('BANK ABN AMRO', '052'),
('BANK KEPPEL TATLEE BUANA', '053'),
('BANK CAPITAL INDONESIA, TBK.', '054'),
('BANK BNP PARIBAS INDONESIA', '057'),
('BANK UOB INDONESIA', '058'),
('KOREA EXCHANGE BANK DANAMON', '059'),
('RABOBANK INTERNASIONAL INDONESIA', '060'),
('ANZ PANIN BANK', '061'),
('DEUTSCHE BANK AG.', '067'),
('BANK WOORI INDONESIA', '068'),
('BANK OF CHINA LIMITED', '069'),
('BANK BUMI ARTA', '076'),
('BANK EKONOMI', '087'),
('BANK ANTARDAERAH', '088'),
('BANK HAGA', '089'),
('BANK IFI', '093'),
('BANK CENTURY, TBK.', '095'),
('BANK MAYAPADA', '097'),
('BANK JABAR', '110'),
('BANK DKI', '111'),
('BPD DIY', '112'),
('BANK JATENG', '113'),
('BANK JATIM', '114'),
('BPD JAMBI', '115'),
('BPD ACEH', '116'),
('BANK SUMUT', '117'),
('BANK NAGARI', '118'),
('BANK RIAU', '119'),
('BANK SUMSEL', '120'),
('BANK LAMPUNG', '121'),
('BPD KALSEL', '122'),
('BPD KALIMANTAN BARAT', '123'),
('BPD KALTIM', '124'),
('BPD KALTENG', '125'),
('BPD SULSEL', '126'),
('BANK SULUT', '127'),
('BPD NTB', '128'),
('BPD BALI', '129'),
('BANK NTT', '130'),
('BANK MALUKU', '131'),
('BPD PAPUA', '132'),
('BANK BENGKULU', '133'),
('BPD SULAWESI TENGAH', '134'),
('BANK SULTRA', '135'),
('BANK NUSANTARA PARAHYANGAN', '145'),
('BANK SWADESI', '146'),
('BANK MUAMALAT', '147'),
('BANK MESTIKA', '151'),
('BANK METRO EXPRESS', '152'),
('BANK SHINTA INDONESIA', '153'),
('BANK MASPION', '157'),
('BANK HAGAKITA', '159'),
('BANK GANESHA', '161'),
('BANK WINDU KENTJANA', '162'),
('HALIM INDONESIA BANK', '164'),
('BANK HARMONI INTERNATIONAL', '166'),
('BANK KESAWAN', '167'),
('BANK TABUNGAN NEGARA (PERSERO)', '200'),
('BANK HIMPUNAN SAUDARA 1906, TBK .', '212'),
('BANK TABUNGAN PENSIUNAN NASIONAL', '213'),
('BANK SWAGUNA', '405'),
('BANK JASA ARTA', '422'),
('BANK MEGA', '426'),
('BANK JASA JAKARTA', '427'),
('BANK BUKOPIN', '441'),
('BANK SYARIAH MANDIRI', '451'),
('BANK BISNIS INTERNASIONAL', '459'),
('BANK SRI PARTHA', '466'),
('BANK JASA JAKARTA', '472'),
('BANK BINTANG MANUNGGAL', '484'),
('BANK BUMIPUTERA', '485'),
('BANK YUDHA BHAKTI', '490'),
('BANK MITRANIAGA', '491'),
('BANK AGRO NIAGA', '494'),
('BANK INDOMONEX', '498'),
('BANK ROYAL INDONESIA', '501'),
('BANK ALFINDO', '503'),
('BANK SYARIAH MEGA', '506'),
('BANK INA PERDANA', '513'),
('BANK HARFA', '517'),
('PRIMA MASTER BANK', '520'),
('BANK PERSYARIKATAN INDONESIA', '521'),
('BANK DIPO INTERNATIONAL', '523'),
('BANK AKITA', '525'),
('LIMAN INTERNATIONAL BANK', '526'),
('ANGLOMAS INTERNASIONAL BANK', '531'),
('BANK KESEJAHTERAAN EKONOMI', '535'),
('BANK UIB', '536'),
('BANK ARTOS IND', '542'),
('BANK PURBA DANARTA', '547'),
('BANK MULTI ARTA SENTOSA', '548'),
('BANK MAYORA', '553'),
('BANK INDEX SELINDO', '555'),
('BANK EKSEKUTIF', '558'),
('CENTRATAMA NASIONAL BANK', '559'),
('BANK FAMA INTERNASIONAL', '562'),
('BANK SINAR HARAPAN BALI', '564'),
('BANK VICTORIA INTERNATIONAL', '566'),
('BANK HARDA', '567'),
('BANK FINCONESIA', '945'),
('BANK MERINCORP', '946'),
('BANK MAYBANK INDOCORP', '947'),
('BANK OCBC – INDONESIA', '948'),
('BANK CHINA TRUST INDONESIA', '949'),
('BANK COMMONWEALTH', '950');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` mediumint(9) NOT NULL,
  `draft_id` mediumint(9) DEFAULT NULL,
  `book_code` varchar(256) NOT NULL,
  `book_title` varchar(256) NOT NULL,
  `book_edition` varchar(256) NOT NULL,
  `isbn` varchar(256) NOT NULL,
  `book_file` varchar(256) DEFAULT NULL,
  `published_date` date NOT NULL,
  `printing_type` enum('p','o') NOT NULL DEFAULT 'o',
  `serial_num` mediumint(9) NOT NULL,
  `serial_num_per_year` mediumint(9) NOT NULL,
  `copies_num` varchar(256) NOT NULL,
  `book_notes` text NOT NULL,
  `is_reprint` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `draft_id`, `book_code`, `book_title`, `book_edition`, `isbn`, `book_file`, `published_date`, `printing_type`, `serial_num`, `serial_num_per_year`, `copies_num`, `book_notes`, `is_reprint`) VALUES
(3, NULL, 'A2E', 'Sepakbola Indah', '1', '12541002154221', 'Sepakbola_Indah_20180828143530.pdf', '2018-08-31', 'p', 1457, 35, '200', 'Nice', 'n'),
(4, NULL, 'B7E', 'Terbentuknya Fisipol', '1', '36651244875421', 'Terbentuknya_Fisipol_20180830220330.docx', '2018-09-30', 'p', 4415, 1212, '7000', 'Cool', 'n'),
(6, NULL, 'as', 'as', 'as', 'as', NULL, '2018-09-19', 'p', 0, 0, 'as', 'as', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` mediumint(9) NOT NULL,
  `category_name` varchar(256) NOT NULL,
  `category_year` year(4) NOT NULL,
  `category_note` text NOT NULL,
  `date_open` date NOT NULL,
  `date_close` date NOT NULL,
  `category_status` enum('y','n') NOT NULL DEFAULT 'y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_year`, `category_note`, `date_open`, `date_close`, `category_status`) VALUES
(2, 'Hibah Teknik', 2018, 'Contoh catatan hibah', '2018-08-11', '2018-08-13', 'y'),
(7, 'Hibah Fisipol', 2020, 'contoh isi text', '2018-08-15', '2018-08-24', 'y'),
(8, 'Umum', 2018, 'asdadsadasdas', '2018-08-30', '2018-08-31', 'y'),
(9, 'Hibah Vokasi', 2018, 'qweqweqeqweqeqwew', '2018-08-29', '2018-08-31', 'n'),
(10, 'Hibah Kehutanan', 2018, 'Contoh Hibah Kehutanan', '2018-09-09', '2018-09-11', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `draft`
--

CREATE TABLE `draft` (
  `draft_id` mediumint(9) NOT NULL,
  `category_id` mediumint(9) DEFAULT NULL,
  `theme_id` mediumint(9) DEFAULT NULL,
  `draft_title` varchar(256) NOT NULL,
  `draft_file` varchar(256) DEFAULT NULL,
  `proposed_fund` int(13) NOT NULL,
  `approved_fund` int(13) DEFAULT NULL,
  `entry_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `finish_date` timestamp NULL DEFAULT NULL,
  `print_date` timestamp NULL DEFAULT NULL,
  `review_start_date` datetime NOT NULL,
  `review_deadline_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reviewer_1_file` varchar(255) NOT NULL,
  `reviewer_1_file_reply` varchar(255) NOT NULL,
  `reviewer_1_comment` longtext NOT NULL,
  `reviewer_1_comment_reply` longtext NOT NULL,
  `reviewer_1_last_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reviewer_2_file` varchar(255) NOT NULL,
  `reviewer_2_file_reply` varchar(255) NOT NULL,
  `reviewer_2_comment` longtext NOT NULL,
  `reviewer_2_comment_reply` longtext NOT NULL,
  `reviewer_2_last_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reviewer_reply_last_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `review_end_date` datetime NOT NULL,
  `edit_user_id` int(11) NOT NULL,
  `edit_start_date` datetime NOT NULL,
  `edit_deadline_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor_file` varchar(255) NOT NULL,
  `editor_file_reply` varchar(255) NOT NULL,
  `editor_comment` longtext NOT NULL,
  `editor_comment_reply` longtext NOT NULL,
  `editor_last_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `edit_end_date` datetime NOT NULL,
  `layout_start_date` datetime NOT NULL,
  `layout_deadline_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `layouter_1_file` varchar(255) NOT NULL,
  `layouter_1_file_reply` varchar(255) NOT NULL,
  `layouter_1_comment` longtext NOT NULL,
  `layouter_1_comment_reply` longtext NOT NULL,
  `layouter_1_last_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `layouter_2_file` varchar(255) NOT NULL,
  `layouter_2_file_reply` varchar(255) NOT NULL,
  `layouter_2_comment` longtext NOT NULL,
  `layouter_2_comment_reply` longtext NOT NULL,
  `layouter_2_last_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `layouter_reply_last_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `layout_end_date` datetime NOT NULL,
  `draft_notes` text NOT NULL,
  `proofread_user_id` int(11) NOT NULL,
  `proofread_start_date` datetime NOT NULL,
  `proofread_deadline_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `proofread_file` varchar(255) NOT NULL,
  `proofread_file_reply` varchar(255) NOT NULL,
  `proofread_comment` longtext NOT NULL,
  `proofread_comment_reply` longtext NOT NULL,
  `proofread_last_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `proofread_end_date` datetime NOT NULL,
  `draft_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `draft`
--

INSERT INTO `draft` (`draft_id`, `category_id`, `theme_id`, `draft_title`, `draft_file`, `proposed_fund`, `approved_fund`, `entry_date`, `finish_date`, `print_date`, `review_start_date`, `review_deadline_date`, `reviewer_1_file`, `reviewer_1_file_reply`, `reviewer_1_comment`, `reviewer_1_comment_reply`, `reviewer_1_last_update`, `reviewer_2_file`, `reviewer_2_file_reply`, `reviewer_2_comment`, `reviewer_2_comment_reply`, `reviewer_2_last_update`, `reviewer_reply_last_update`, `review_end_date`, `edit_user_id`, `edit_start_date`, `edit_deadline_date`, `editor_file`, `editor_file_reply`, `editor_comment`, `editor_comment_reply`, `editor_last_update`, `edit_end_date`, `layout_start_date`, `layout_deadline_date`, `layouter_1_file`, `layouter_1_file_reply`, `layouter_1_comment`, `layouter_1_comment_reply`, `layouter_1_last_update`, `layouter_2_file`, `layouter_2_file_reply`, `layouter_2_comment`, `layouter_2_comment_reply`, `layouter_2_last_update`, `layouter_reply_last_update`, `layout_end_date`, `draft_notes`, `proofread_user_id`, `proofread_start_date`, `proofread_deadline_date`, `proofread_file`, `proofread_file_reply`, `proofread_comment`, `proofread_comment_reply`, `proofread_last_update`, `proofread_end_date`, `draft_status`) VALUES
(6, 2, 12, 'test', 'test_20180930210957.doc', 20000, NULL, '2018-09-30 14:09:57', NULL, NULL, '2018-09-30 21:13:10', '2018-11-29 14:13:10', '', '', '', '', '0000-00-00 00:00:00', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '0000-00-00 00:00:00', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `draft_author`
--

CREATE TABLE `draft_author` (
  `draft_author_id` mediumint(9) NOT NULL,
  `draft_id` mediumint(9) DEFAULT NULL,
  `author_id` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `draft_author`
--

INSERT INTO `draft_author` (`draft_author_id`, `draft_id`, `author_id`) VALUES
(11, 6, 1),
(12, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `draft_layouter`
--

CREATE TABLE `draft_layouter` (
  `draft_layouter_id` int(11) NOT NULL,
  `draft_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `draft_reviewer`
--

CREATE TABLE `draft_reviewer` (
  `draft_reviewer_id` mediumint(9) NOT NULL,
  `draft_id` mediumint(9) DEFAULT NULL,
  `reviewer_id` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `draft_reviewer`
--

INSERT INTO `draft_reviewer` (`draft_reviewer_id`, `draft_id`, `reviewer_id`) VALUES
(9, 6, 22),
(10, 6, 23);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` mediumint(9) NOT NULL,
  `faculty_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `faculty_name`) VALUES
(3, 'Teknik'),
(4, 'Kedokteran');

-- --------------------------------------------------------

--
-- Table structure for table `institute`
--

CREATE TABLE `institute` (
  `institute_id` mediumint(9) NOT NULL,
  `institute_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institute`
--

INSERT INTO `institute` (`institute_id`, `institute_name`) VALUES
(1, 'Dosen'),
(2, 'Umum'),
(3, 'Internship');

-- --------------------------------------------------------

--
-- Table structure for table `responsibility`
--

CREATE TABLE `responsibility` (
  `responsibility_id` mediumint(9) NOT NULL,
  `user_id` mediumint(9) DEFAULT NULL,
  `draft_id` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `responsibility`
--

INSERT INTO `responsibility` (`responsibility_id`, `user_id`, `draft_id`) VALUES
(6, 2, NULL),
(7, 2, NULL),
(8, 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviewer`
--

CREATE TABLE `reviewer` (
  `reviewer_id` mediumint(9) NOT NULL,
  `reviewer_nip` varchar(256) NOT NULL,
  `reviewer_name` varchar(256) NOT NULL,
  `faculty_id` mediumint(9) DEFAULT NULL,
  `user_id` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviewer`
--

INSERT INTO `reviewer` (`reviewer_id`, `reviewer_nip`, `reviewer_name`, `faculty_id`, `user_id`) VALUES
(22, '1', 'Kasmir', 3, 3),
(23, '2', 'Yasir', 4, 5),
(24, '3', 'Samsir Simsar', 3, 4),
(25, '4', 'Amir', 4, 8);

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE `theme` (
  `theme_id` mediumint(9) NOT NULL,
  `theme_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`theme_id`, `theme_name`) VALUES
(12, 'Olahraga'),
(13, 'Sejarah'),
(14, 'Matematika'),
(15, 'Teknik');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `draft_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `draft_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` mediumint(9) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `level` enum('superadmin','admin_penerbitan','staff_penerbitan','admin_pemasaran','admin_percetakan','admin_gudang','author','reviewer') NOT NULL,
  `is_blocked` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `level`, `is_blocked`) VALUES
(1, 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'superadmin', 'n'),
(2, 'dadang', '0037bb978d51e84d1ad5478e85430f26', 'admin_penerbitan', 'n'),
(3, 'kasmir', 'a029ab4dad413c186784e0c12a6df002', 'reviewer', 'n'),
(4, 'samsir', '2f18685cbcaf0d5b54e928439b2fd187', 'reviewer', 'n'),
(5, 'yasir', '8d03ecfad755ab078ae3fd29c63c2d7d', 'reviewer', 'n'),
(6, 'dono', 'e3b810115555736a216f137df55789f6', 'author', 'n'),
(7, 'hari', 'a9bcf1e4d7b95a22e2975c812d938889', 'author', 'n'),
(8, 'amir', '63eefbd45d89e8c91f24b609f7539942', 'reviewer', 'n'),
(9, 'jaka', '9d83066da00b7c7fa9de34117f488653', 'author', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `worksheet`
--

CREATE TABLE `worksheet` (
  `worksheet_id` mediumint(9) NOT NULL,
  `draft_id` mediumint(9) DEFAULT NULL,
  `worksheet_num` varchar(256) NOT NULL,
  `is_reprint` enum('y','n') NOT NULL DEFAULT 'n',
  `worksheet_status` int(1) NOT NULL DEFAULT '0' COMMENT '1 = Approve, 2 = Reject',
  `worksheet_notes` text NOT NULL,
  `worksheet_pic` varchar(256) NOT NULL,
  `worksheet_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `worksheet`
--

INSERT INTO `worksheet` (`worksheet_id`, `draft_id`, `worksheet_num`, `is_reprint`, `worksheet_status`, `worksheet_notes`, `worksheet_pic`, `worksheet_ts`) VALUES
(6, 6, '2018-09-01', 'n', 1, '', 'superadmin', '2018-09-30 14:12:57');

-- --------------------------------------------------------

--
-- Table structure for table `work_unit`
--

CREATE TABLE `work_unit` (
  `work_unit_id` mediumint(9) NOT NULL,
  `work_unit_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_unit`
--

INSERT INTO `work_unit` (`work_unit_id`, `work_unit_name`) VALUES
(1, 'UGM'),
(2, 'UI'),
(5, 'UNS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`),
  ADD KEY `work_unit_id` (`work_unit_id`),
  ADD KEY `institute_id` (`institute_id`),
  ADD KEY `bank_id` (`bank_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `id_proposal` (`draft_id`),
  ADD KEY `code_id` (`book_code`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `draft`
--
ALTER TABLE `draft`
  ADD PRIMARY KEY (`draft_id`),
  ADD KEY `id_kategori` (`category_id`),
  ADD KEY `id_penulis` (`theme_id`);

--
-- Indexes for table `draft_author`
--
ALTER TABLE `draft_author`
  ADD PRIMARY KEY (`draft_author_id`),
  ADD KEY `draft_id` (`draft_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `draft_layouter`
--
ALTER TABLE `draft_layouter`
  ADD PRIMARY KEY (`draft_layouter_id`);

--
-- Indexes for table `draft_reviewer`
--
ALTER TABLE `draft_reviewer`
  ADD PRIMARY KEY (`draft_reviewer_id`),
  ADD KEY `draft_id` (`draft_id`),
  ADD KEY `author_id` (`reviewer_id`),
  ADD KEY `reviewer_id` (`reviewer_id`),
  ADD KEY `draft_id_2` (`draft_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `institute`
--
ALTER TABLE `institute`
  ADD PRIMARY KEY (`institute_id`);

--
-- Indexes for table `responsibility`
--
ALTER TABLE `responsibility`
  ADD PRIMARY KEY (`responsibility_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `draft_id` (`draft_id`);

--
-- Indexes for table `reviewer`
--
ALTER TABLE `reviewer`
  ADD PRIMARY KEY (`reviewer_id`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`theme_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD UNIQUE KEY `draft_id` (`draft_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `worksheet`
--
ALTER TABLE `worksheet`
  ADD PRIMARY KEY (`worksheet_id`),
  ADD KEY `id_proposal` (`draft_id`);

--
-- Indexes for table `work_unit`
--
ALTER TABLE `work_unit`
  ADD PRIMARY KEY (`work_unit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `draft`
--
ALTER TABLE `draft`
  MODIFY `draft_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `draft_author`
--
ALTER TABLE `draft_author`
  MODIFY `draft_author_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `draft_layouter`
--
ALTER TABLE `draft_layouter`
  MODIFY `draft_layouter_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `draft_reviewer`
--
ALTER TABLE `draft_reviewer`
  MODIFY `draft_reviewer_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `institute`
--
ALTER TABLE `institute`
  MODIFY `institute_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `responsibility`
--
ALTER TABLE `responsibility`
  MODIFY `responsibility_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reviewer`
--
ALTER TABLE `reviewer`
  MODIFY `reviewer_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `theme`
--
ALTER TABLE `theme`
  MODIFY `theme_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `worksheet`
--
ALTER TABLE `worksheet`
  MODIFY `worksheet_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `work_unit`
--
ALTER TABLE `work_unit`
  MODIFY `work_unit_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `author`
--
ALTER TABLE `author`
  ADD CONSTRAINT `author_ibfk_1` FOREIGN KEY (`work_unit_id`) REFERENCES `work_unit` (`work_unit_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `author_ibfk_2` FOREIGN KEY (`institute_id`) REFERENCES `institute` (`institute_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `author_ibfk_3` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`bank_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `author_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`draft_id`) REFERENCES `draft` (`draft_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `draft`
--
ALTER TABLE `draft`
  ADD CONSTRAINT `draft_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `draft_ibfk_2` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`theme_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `draft_author`
--
ALTER TABLE `draft_author`
  ADD CONSTRAINT `draft_author_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `draft_author_ibfk_3` FOREIGN KEY (`draft_id`) REFERENCES `draft` (`draft_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `draft_reviewer`
--
ALTER TABLE `draft_reviewer`
  ADD CONSTRAINT `draft_reviewer_ibfk_1` FOREIGN KEY (`draft_id`) REFERENCES `draft` (`draft_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `draft_reviewer_ibfk_2` FOREIGN KEY (`reviewer_id`) REFERENCES `reviewer` (`reviewer_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `responsibility`
--
ALTER TABLE `responsibility`
  ADD CONSTRAINT `responsibility_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `responsibility_ibfk_2` FOREIGN KEY (`draft_id`) REFERENCES `draft` (`draft_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `reviewer`
--
ALTER TABLE `reviewer`
  ADD CONSTRAINT `reviewer_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `reviewer_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `worksheet`
--
ALTER TABLE `worksheet`
  ADD CONSTRAINT `worksheet_ibfk_1` FOREIGN KEY (`draft_id`) REFERENCES `draft` (`draft_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
