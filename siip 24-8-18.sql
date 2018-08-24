-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 24, 2018 at 01:49 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id5204861_ugmpress`
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
  `author_degree` varchar(256) NOT NULL,
  `author_address` text NOT NULL,
  `author_contact` varchar(20) NOT NULL,
  `author_email` varchar(256) NOT NULL,
  `bank_id` varchar(4) DEFAULT NULL,
  `author_saving_num` varchar(30) NOT NULL,
  `heir_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `work_unit_id`, `institute_id`, `author_nip`, `author_name`, `author_degree`, `author_address`, `author_contact`, `author_email`, `bank_id`, `author_saving_num`, `heir_name`) VALUES
(4, 5, 1, '3123', 'Joko', 'S.T', 'Yogyakarta', '087951245581', 'asd@asd.com', '014', '087542154887', 'Jokowi'),
(5, 1, 2, '5544', 'Susi', 'S.Ked', 'Sleman', '087951245575', 'asd@kakaka.com', '459', '08754215488', 'Susi junior'),
(6, 1, 1, '123', 'bjj', '65', 'ss', '085640276276', 'bgsbla33333@gmail.comsss', '002', '2454', 'ttt');

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
  `cover` varchar(256) DEFAULT NULL,
  `book_edition` varchar(256) NOT NULL,
  `isbn` varchar(256) NOT NULL,
  `book_file` varchar(256) NOT NULL,
  `published_date` date NOT NULL,
  `printing_type` enum('p','o') NOT NULL,
  `serial_num` mediumint(9) NOT NULL,
  `serial_num_per_year` mediumint(9) NOT NULL,
  `copies_num` varchar(256) NOT NULL,
  `book_notes` text NOT NULL,
  `is_reprint` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `draft_id`, `book_code`, `book_title`, `cover`, `book_edition`, `isbn`, `book_file`, `published_date`, `printing_type`, `serial_num`, `serial_num_per_year`, `copies_num`, `book_notes`, `is_reprint`) VALUES
(2, 7, 'A2E', 'gegegegewepe', NULL, 'pertama', '45461156464343743', '', '2018-08-31', 'p', 2000, 1, '20', 'jelekzzz', 'n');

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
(7, 'hibah fisipol', 2018, 'contoh isi text', '2018-08-15', '2018-08-24', 'y'),
(8, 'asdasd', 2017, 'asdadsadasdas', '0000-00-00', '0000-00-00', 'y'),
(9, 'qweqweqwe', 2020, 'qweqweqeqweqeqwew', '0000-00-00', '0000-00-00', 'n'),
(10, 'zxczxcz', 2018, 'zxczcxzc', '0000-00-00', '0000-00-00', 'y'),
(11, 'rtyrty', 2017, 'rtyrty', '0000-00-00', '0000-00-00', 'y'),
(12, 'bnmbnm', 2020, 'bnmbnmbmnb', '2018-08-16', '2018-08-30', 'y');

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
  `approved_fund` int(13) NOT NULL,
  `entry_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `finish_date` timestamp NULL DEFAULT NULL,
  `print_date` timestamp NULL DEFAULT NULL,
  `is_reviewed` enum('y','n') NOT NULL DEFAULT 'n',
  `review_notes` text NOT NULL,
  `is_revised` enum('y','n') NOT NULL DEFAULT 'n',
  `revise_notes` text NOT NULL,
  `is_edited` enum('y','n') NOT NULL DEFAULT 'n',
  `edit_notes` text NOT NULL,
  `is_layouted` enum('y','n') NOT NULL DEFAULT 'n',
  `layout_notes` text NOT NULL,
  `is_reprint` enum('y','n') NOT NULL DEFAULT 'n',
  `draft_notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `draft`
--

INSERT INTO `draft` (`draft_id`, `category_id`, `theme_id`, `draft_title`, `draft_file`, `proposed_fund`, `approved_fund`, `entry_date`, `finish_date`, `print_date`, `is_reviewed`, `review_notes`, `is_revised`, `revise_notes`, `is_edited`, `edit_notes`, `is_layouted`, `layout_notes`, `is_reprint`, `draft_notes`) VALUES
(5, NULL, NULL, 'docx', '20180815221457.docx', 12000, 0, '2018-08-15 15:14:57', NULL, NULL, 'n', '', 'n', '', 'n', '', 'n', '', 'n', ''),
(6, NULL, NULL, 'doc', '20180815221617.docx', 90000, 0, '2018-08-15 15:16:17', NULL, NULL, 'n', '', 'n', '', 'n', '', 'n', '', 'n', ''),
(7, 7, 5, 'contoh 3 ', '20180815223114', 50000, 0, '2018-08-15 15:31:14', NULL, NULL, 'n', '', 'n', '', 'n', '', 'n', '', 'n', '');

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
(1, NULL, 4),
(2, NULL, 5),
(3, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `draft_reviewer`
--

CREATE TABLE `draft_reviewer` (
  `draft_reviewer_id` mediumint(9) NOT NULL,
  `draft_id` mediumint(9) DEFAULT NULL,
  `reviewer_id` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `reviewer`
--

CREATE TABLE `reviewer` (
  `reviewer_id` mediumint(9) NOT NULL,
  `reviewer_nip` varchar(256) NOT NULL,
  `reviewer_name` varchar(256) NOT NULL,
  `faculty_id` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviewer`
--

INSERT INTO `reviewer` (`reviewer_id`, `reviewer_nip`, `reviewer_name`, `faculty_id`) VALUES
(1, '', 'Andi Made', 3),
(4, '', 'Andi', NULL),
(5, '', 'Prabowo', NULL),
(6, '', 'Jokowi', NULL),
(9, '', 'Mirna', 3),
(11, '', 'Bima', NULL),
(12, '', 'Jono', 3),
(13, '', 'Sandi', NULL),
(14, '', 'Joko', 3),
(15, '54566', 'Suparjo', 4),
(16, '', 'Sandi', 3),
(17, '', 'Sandi', 3);

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
(5, 'olahraga1'),
(6, 'olahraga12'),
(8, 'olahraga4'),
(9, 'biologi'),
(10, 'biologi1'),
(11, 'sejarah'),
(13, 'dddsd');

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
(9, 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'superadmin', 'n'),
(11, 'dadang', '0037bb978d51e84d1ad5478e85430f26', 'admin_penerbitan', 'n'),
(13, 'joko', '9ba0009aa81e794e628a04b51eaf7d7f', 'admin_pemasaran', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `worksheet`
--

CREATE TABLE `worksheet` (
  `worksheet_id` mediumint(9) NOT NULL,
  `draft_id` mediumint(9) DEFAULT NULL,
  `worksheet_num` varchar(256) NOT NULL,
  `is_reprint` enum('y','n') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD KEY `bank_id` (`bank_id`);

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
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`theme_id`);

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
  MODIFY `author_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `draft`
--
ALTER TABLE `draft`
  MODIFY `draft_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `draft_author`
--
ALTER TABLE `draft_author`
  MODIFY `draft_author_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `draft_reviewer`
--
ALTER TABLE `draft_reviewer`
  MODIFY `draft_reviewer_id` mediumint(9) NOT NULL AUTO_INCREMENT;

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
  MODIFY `responsibility_id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviewer`
--
ALTER TABLE `reviewer`
  MODIFY `reviewer_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `theme`
--
ALTER TABLE `theme`
  MODIFY `theme_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `worksheet`
--
ALTER TABLE `worksheet`
  MODIFY `worksheet_id` mediumint(9) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `author_ibfk_3` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`bank_id`) ON DELETE SET NULL ON UPDATE CASCADE;

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
  ADD CONSTRAINT `draft_reviewer_ibfk_2` FOREIGN KEY (`reviewer_id`) REFERENCES `reviewer` (`reviewer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `reviewer_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `worksheet`
--
ALTER TABLE `worksheet`
  ADD CONSTRAINT `worksheet_ibfk_1` FOREIGN KEY (`draft_id`) REFERENCES `draft` (`draft_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
