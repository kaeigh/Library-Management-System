-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2024 at 08:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `bin`
--

CREATE TABLE `bin` (
  `id` int(11) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publication_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(255) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publication_date` date NOT NULL DEFAULT current_timestamp(),
  `quantity` int(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `isbn`, `title`, `author`, `publication_date`, `quantity`, `location`) VALUES
(82, '9780323295576', 'Nursing Diagnosis Handbook', 'Betty J. Ackley', '2016-02-10', 5, 'Shelf 1'),
(84, '9781260548094', 'Nursing Ethics and Professional Responsibility in Advanced Practice', 'Pamela J. Grace', '2020-03-18', 12, 'Shelf 4'),
(87, '9781119507225', 'Principles of Economics', 'N. Gregory Mankiw', '2018-02-28', 43, 'Shelf 4'),
(88, '9781260259530', 'Essentials of Organizational Behavior', 'Stephen P. Robbins', '2021-01-22', 7, 'Shelf 4'),
(90, '9781260548094', 'Nursing Ethics and Professional Responsibility in Advanced Practice', 'Pamela J. Grace', '2020-03-18', 43, 'Shelf 4'),
(91, '9780321929676', 'Exploring Psychology', 'David G. Myers', '2014-12-31', 32, 'Shelf 5'),
(113, 'the man in the middle', 'the man in the middle', 'the man in the middle', '2024-06-21', 12, 'Shelf 2'),
(114, '9781496347992', 'Brunner & Suddarth\'s Textbook of Medical-Surgical Nursing', 'Janice L. Hinkle, Kerry H. Cheever', '2017-10-10', 21, 'Shelf 3'),
(115, '9781496347992', 'Brunner & Suddarth\'s Textbook of Medical-Surgical Nursing', 'Janice L. Hinkle, Kerry H. Cheever', '2017-10-10', 27, 'Shelf 3'),
(116, '9781496351296', 'Essentials of Nursing Research: Appraising Evidence for Nursing Practice', 'Denise F. Polit, Cheryl Tatano Beck', '2017-11-15', 6, 'Shelf 5'),
(117, '9780134167220', 'Maternal & Child Nursing Care', 'Marcia L. London, Patricia W. Ladewig, Michele C. Davidson', '2017-03-01', 17, 'Shelf 3'),
(118, '9780323529495', 'Pharmacology and the Nursing Process', 'Linda Lane Lilley, Shelly Rainforth Collins, Julie S. Snyder', '2019-01-23', 3, 'Shelf 3'),
(119, '9780323551120', 'Nursing Diagnosis Handbook: An Evidence-Based Guide to Planning Care', 'Betty J. Ackley, Gail B. Ladwig, Mary Beth Flynn Makic', '2019-06-05', 16, 'Shelf 3'),
(120, '9781133187790', 'Introduction to the Theory of Computation', 'Michael Sipser', '2012-06-27', 27, 'Shelf 6'),
(121, '9780133594140', 'Computer Networking: A Top-Down Approach', 'James F. Kurose, Keith W. Ross', '2016-03-31', 2, 'Shelf 4'),
(122, '9780132350884', 'Clean Code: A Handbook of Agile Software Craftsmanship', 'Robert C. Martin', '2008-08-11', 12, 'Shelf 3'),
(123, '9780134610993', 'Artificial Intelligence: A Modern Approach', 'Stuart Russell, Peter Norvig', '2020-04-01', 21, 'Shelf 2'),
(124, '9780135957059', 'The Pragmatic Programmer: Your Journey to Mastery', 'Andrew Hunt, David Thomas', '2019-09-13', 11, 'Shelf 6'),
(125, '9780128201091', 'Computer Organization and Design: The Hardware/Software Interface', 'David A. Patterson, John L. Hennessy', '2020-02-12', 19, 'Shelf 2'),
(127, '9781119439257', 'Operating System Concepts', 'Abraham Silberschatz, Peter B. Galvin, Greg Gagne', '2018-04-16', 2, 'Shelf 2'),
(128, '9781478607835', 'Modern Processor Design: Fundamentals of Superscalar Processors', 'John Paul Shen, Mikko H. Lipasti', '2013-01-01', 27, 'Shelf 5'),
(129, '9781512185676', 'Embedded Systems: Introduction to the MSP432 Microcontroller', 'Jonathan Valvano', '2017-05-22', 9, 'Shelf 1'),
(130, '9780134492513', 'Principles of Marketing', 'Philip Kotler, Gary Armstrong', '2020-02-05', 22, 'Shelf 2'),
(131, '9780134729329', 'Organizational Behavior', 'Stephen P. Robbins, Timothy A. Judge', '2019-01-20', 2, 'Shelf 4'),
(132, '9781337902601', 'Financial Management: Theory & Practice', 'Eugene F. Brigham, Michael C. Ehrhardt', '2019-01-01', 17, 'Shelf 2'),
(133, '9780134167848', 'Strategic Management: Concepts and Cases', 'Fred R. David, Forest R. David', '2017-01-16', 6, 'Shelf 3'),
(134, '9781260013955', 'Essentials of Corporate Finance', 'Stephen A. Ross, Randolph W. Westerfield, Bradford D. Jordan', '2019-01-10', 22, 'Shelf 2'),
(135, '9780470390959', 'Tourism: Principles, Practices, Philosophies', 'Charles R. Goeldner, J.R. Brent Ritchie', '2011-01-04', 28, 'Shelf 6'),
(136, '9781292063249', 'The Business of Tourism', 'J. Christopher Holloway, Claire Humphreys', '2016-12-01', 25, 'Shelf 2'),
(137, '9781446267743', 'Sustainable Tourism: Principles, Contexts and Practices', 'David A. Fennell', '2020-03-12', 2, 'Shelf 2'),
(138, '9780470820227', 'Tourism Management', 'David Weaver, Laura Lawton', '2010-06-01', 16, 'Shelf 4'),
(139, '9780750685937', 'Event Management: A Professional and Developmental Approach', 'Glenn Bowdin, Johnny Allen, William O\'Toole', '2010-02-01', 18, 'Shelf 1'),
(140, '9780976423317', 'The First Days of School: How to Be an Effective Teacher', 'Harry K. Wong, Rosemary T. Wong', '2009-07-30', 19, 'Shelf 6'),
(141, '9781416613626', 'Classroom Instruction That Works: Research-Based Strategies for Increasing Student Achievement', 'Ceri B. Dean, Elizabeth Ross Hubbell, Howard Pitler', '2012-12-15', 15, 'Shelf 5'),
(142, '9781416623304', 'How to Differentiate Instruction in Academically Diverse Classrooms', 'Carol Ann Tomlinson', '2017-08-01', 15, 'Shelf 1'),
(143, '9781118450291', 'The Skillful Teacher: On Technique, Trust, and Responsiveness in the Classroom', 'Stephen D. Brookfield', '2015-06-15', 29, 'Shelf 3'),
(144, '9781416608844', 'Teaching with Poverty in Mind: What Being Poor Does to Kids\' Brains and What Schools Can Do About It', 'Eric Jensen', '2009-11-03', 16, 'Shelf 2'),
(145, '9780133762786', 'Introduction to Hospitality', 'John R. Walker', '2016-05-05', 11, 'Shelf 2'),
(146, '9780471687898', 'Hospitality Management Accounting', 'Martin G. Jagels', '2006-03-03', 8, 'Shelf 3'),
(147, '9780134337624', 'Hotel Operations Management', 'David K. Hayes, Jack D. Ninemeier', '2016-01-22', 21, 'Shelf 1'),
(148, '9780866123966', 'Managing Hospitality Human Resources', 'Robert H. Woods, Misty M. Johanson, Michael Sciarini', '2012-01-10', 28, 'Shelf 4'),
(149, '9780470177147', 'Supervision in the Hospitality Industry', 'John R. Walker, Jack E. Miller', '2010-02-02', 29, 'Shelf 2'),
(150, '9780671212094', 'How to Read a Book: The Classic Guide to Intelligent Reading', 'Mortimer J. Adler, Charles Van Doren', '1972-08-15', 3, 'Shelf 5'),
(151, '9780133115285', 'Critical Thinking: Tools for Taking Charge of Your Professional and Personal Life', 'Richard Paul, Linda Elder', '2013-08-23', 25, 'Shelf 5'),
(152, '9780205309023', 'The Elements of Style', 'William Strunk Jr., E.B. White', '1999-05-25', 28, 'Shelf 4'),
(153, '9780226239736', 'The Craft of Research', 'Wayne C. Booth, Gregory G. Colomb, Joseph M. Williams', '2016-04-15', 25, 'Shelf 4'),
(154, '9780226430577', 'A Manual for Writers of Research Papers, Theses, and Dissertations: Chicago Style for Students and Researchers', 'Kate L. Turabian', '2018-04-16', 6, 'Shelf 3'),
(155, '9780323358415', 'Saunders Comprehensive Review for the NCLEX-RN Examination', 'Linda Anne Silvestri', '2019-10-07', 13, 'Shelf 6'),
(156, '9780134845622', 'Data Science for Business: What You Need to Know about Data Mining and Data-Analytic Thinking', 'Foster Provost, Tom Fawcett', '2013-07-27', 8, 'Shelf 3'),
(157, '9780134685990', 'Database System Concepts', 'Abraham Silberschatz, Henry F. Korth, S. Sudarshan', '2019-01-01', 22, 'Shelf 2'),
(158, '9780201616224', 'Design Patterns: Elements of Reusable Object-Oriented Software', 'Erich Gamma, Richard Helm, Ralph Johnson, John Vlissides', '1994-11-10', 21, 'Shelf 6'),
(159, '9780137081073', 'Artificial Intelligence: A Guide for Thinking Humans', 'Melanie Mitchell', '2019-10-15', 9, 'Shelf 5'),
(160, '9781119551133', 'Management: A Practical Introduction', 'Angelo Kinicki, Brian K. Williams', '2020-02-14', 4, 'Shelf 2'),
(161, '9781292145990', 'Exploring Corporate Strategy: Text & Cases', 'Gerry Johnson, Kevan Scholes, Richard Whittington', '2017-01-20', 27, 'Shelf 4'),
(162, '9781137486041', 'Human Resource Management', 'Derek Torrington, Laura Hall, Stephen Taylor', '2017-01-01', 19, 'Shelf 1'),
(163, '9781119376780', 'Marketing: Real People, Real Choices', 'Michael R. Solomon, Greg W. Marshall, Elnora W. Stuart', '2017-06-07', 24, 'Shelf 4'),
(164, '9781292063348', 'Operations Management', 'Jay Heizer, Barry Render, Chuck Munson', '2016-11-05', 9, 'Shelf 6');

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `id` int(255) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `borrowed_date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'borrowed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `id` int(11) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'returned',
  `returned_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`id`, `isbn`, `name`, `location`, `status`, `returned_date`) VALUES
(37, '9780134599442', 'khenriev bituin', 'Shelf 1', 'returned', '2024-06-09'),
(38, '9780134984253', 'nanimo', 'Shelf 6', 'returned', '2024-06-09'),
(39, '9780134599442', 'nehk', 'Shelf 1', 'returned', '2024-06-11'),
(40, '9780128201091', 'khenriev', 'Shelf 2', 'returned', '2024-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `user_id` int(255) NOT NULL,
  `studentID` varchar(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`user_id`, `studentID`, `name`, `email`, `password`, `user_type`) VALUES
(41, '00-00000', 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(42, '00-00001', 'user', 'user@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bin`
--
ALTER TABLE `bin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bin`
--
ALTER TABLE `bin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
