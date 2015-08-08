-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2015 at 08:47 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `summer_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer_comp`
--

CREATE TABLE IF NOT EXISTS `answer_comp` (
  `sid` varchar(9) NOT NULL,
  `cid` int(11) NOT NULL,
  `qid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE IF NOT EXISTS `assignment` (
  `teacherid` int(11) NOT NULL,
  `courseid` varchar(10) NOT NULL,
  `assignmentno` int(11) NOT NULL,
  `duedate` date NOT NULL,
  `uploaddate` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`teacherid`, `courseid`, `assignmentno`, `duedate`, `uploaddate`) VALUES
(1001, 'CSE104', 1, '2015-07-03', '0000-00-00'),
(1001, 'CSE104', 2, '2015-07-06', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `competition`
--

CREATE TABLE IF NOT EXISTS `competition` (
  `comp_id` int(11) NOT NULL,
  `comp_name` varchar(30) NOT NULL,
  `details` varchar(100) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `registration` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `competition`
--

INSERT INTO `competition` (`comp_id`, `comp_name`, `details`, `startdate`, `enddate`, `registration`) VALUES
(101, 'Product_Challenge', 'Find the greatest product of K consecutive digits in the N digit number.', '2015-06-08', '2015-07-01', '2015-06-27'),
(111, 'New Challenge', 'test competition', '2015-06-30', '2015-07-05', '2015-06-02');

-- --------------------------------------------------------

--
-- Table structure for table `competition_participant`
--

CREATE TABLE IF NOT EXISTS `competition_participant` (
  `student_id` varchar(9) NOT NULL,
  `comp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `courseid` varchar(10) NOT NULL,
  `coursename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseid`, `coursename`) VALUES
('CSE104', 'Introduction to Programming Lab'),
('CSE107', 'Data Structure Lab');

-- --------------------------------------------------------

--
-- Table structure for table `domain`
--

CREATE TABLE IF NOT EXISTS `domain` (
  `id` int(11) NOT NULL,
  `domainname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `domain`
--

INSERT INTO `domain` (`id`, `domainname`) VALUES
(1, 'control'),
(2, 'arrays'),
(3, 'strings'),
(4, 'recursion'),
(5, 'datastructures'),
(6, 'oops'),
(7, 'inputoutput'),
(8, 'algorithms'),
(9, 'ra'),
(10, 'sql'),
(11, 'brainstormers'),
(12, 'aptitude');

-- --------------------------------------------------------

--
-- Table structure for table `finalsubmission`
--

CREATE TABLE IF NOT EXISTS `finalsubmission` (
  `studentid` varchar(9) NOT NULL,
  `courseid` varchar(10) NOT NULL,
  `assignmentno` int(11) NOT NULL,
  `totalmarks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finalsubmission`
--

INSERT INTO `finalsubmission` (`studentid`, `courseid`, `assignmentno`, `totalmarks`) VALUES
('201351009', 'CSE104', 1, 5),
('201351009', 'CSE104', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE IF NOT EXISTS `points` (
  `s_id` varchar(9) NOT NULL,
  `ques_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `answer_status` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`s_id`, `ques_id`, `timestamp`, `answer_status`, `number`, `domain_id`) VALUES
('201351009', 1, '2015-06-21 10:30:00', 1, 10, 7),
('201351009', 1, '2015-06-25 12:43:35', 0, 0, 7),
('201351009', 1, '2015-06-25 12:44:48', 0, 0, 8),
('201351009', 1, '2015-06-25 12:44:51', 0, 0, 8),
('201351009', 1, '2015-06-25 12:44:52', 0, 0, 8),
('201351009', 2, '2015-06-25 12:47:48', 1, 20, 7),
('201351024', 2, '2015-07-01 10:30:00', 1, 10, 7);

-- --------------------------------------------------------

--
-- Table structure for table `practiceques`
--

CREATE TABLE IF NOT EXISTS `practiceques` (
  `did` int(11) NOT NULL,
  `quesid` int(11) NOT NULL,
  `quesname` varchar(50) NOT NULL,
  `marks` int(11) NOT NULL,
  `difficulty` varchar(10) NOT NULL,
  `uploaddate` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `practiceques`
--

INSERT INTO `practiceques` (`did`, `quesid`, `quesname`, `marks`, `difficulty`, `uploaddate`) VALUES
(2, 1, 'Salary of a salesperson', 20, 'easy', '0000-00-00'),
(2, 2, 'Remove redundancy', 20, 'easy', '0000-00-00'),
(8, 1, 'Naive Bayes Gender Classification', 40, 'easy', '0000-00-00'),
(8, 2, 'Hill climbing Algorithm', 50, 'medium', '0000-00-00'),
(8, 3, 'Monte Carlo Methods', 60, 'hard', '0000-00-00'),
(1, 1, 'Gas Mileage', 20, 'easy', '0000-00-00'),
(1, 2, 'Sales Commission Calculator', 20, 'easy', '0000-00-00'),
(1, 3, 'Interest Calculator', 30, 'easy', '0000-00-00'),
(1, 4, 'Asterisks', 20, 'medium', '0000-00-00'),
(1, 5, 'Counting 7s', 20, 'medium', '0000-00-00'),
(1, 6, 'Sides of a Right Triangle', 30, 'medium', '0000-00-00'),
(1, 7, 'Sides of a Triangle', 30, 'medium', '0000-00-00'),
(1, 8, 'Diameter, Circumference and Area of a Cirle', 30, 'medium', '0000-00-00'),
(1, 9, 'Palindrome Tester', 40, 'hard', '0000-00-00'),
(1, 10, 'Decimal Equivalent of a Binary Number', 30, 'hard', '0000-00-00'),
(1, 11, 'Factorial', 40, 'hard', '0000-00-00'),
(5, 1, 'Concatenating Lists', 30, 'easy', '0000-00-00'),
(5, 2, 'Merging Ordered Lists', 30, 'easy', '0000-00-00'),
(5, 3, 'Inserting into an Ordered List', 40, 'easy', '0000-00-00'),
(5, 4, 'Creating a Linked List, then Reversing Its Element', 40, 'medium', '0000-00-00'),
(5, 5, 'Reversing the Words of a Sentence', 40, 'medium', '0000-00-00'),
(5, 6, 'Palindrome Tester', 40, 'medium', '0000-00-00'),
(5, 7, 'Infix-to-Postfix Converter', 50, 'hard', '0000-00-00'),
(5, 8, 'Binary Search Tree of Strings', 50, 'hard', '0000-00-00'),
(5, 9, 'Postfix Evaluator', 50, 'hard', '0000-00-00'),
(7, 1, '"Hello World!"', 10, 'easy', '0000-00-00'),
(7, 2, 'Calculator', 20, 'easy', '0000-00-00'),
(7, 3, 'Box of Asterisks', 20, 'medium', '0000-00-00'),
(7, 4, 'Checkboard of Asterisks', 20, 'medium', '0000-00-00'),
(7, 5, 'ASCII Evaluator', 20, 'medium', '0000-00-00'),
(7, 6, 'Digitizer', 30, 'hard', '0000-00-00'),
(7, 7, 'Squares and cubes', 30, 'hard', '0000-00-00'),
(6, 1, 'Rectangle Class', 20, 'easy', '0000-00-00'),
(6, 2, 'Enhancing Class Rectangle ', 20, 'easy', '0000-00-00'),
(6, 3, 'Further Enhancing Class Rectangle ', 20, 'easy', '0000-00-00'),
(6, 4, 'HugeInteger Class', 30, 'medium', '0000-00-00'),
(6, 5, ' SavingsAccount Class', 30, 'hard', '0000-00-00'),
(6, 6, 'TicTacToe Class', 60, 'hard', '0000-00-00'),
(4, 1, 'Factorial', 20, 'easy', '0000-00-00'),
(4, 2, 'Fibonacci numbers', 20, 'easy', '0000-00-00'),
(4, 3, 'Recursive Exponentiation', 30, 'medium', '0000-00-00'),
(4, 4, 'Recursive Greatest Common Divisor', 30, 'medium', '0000-00-00'),
(4, 5, 'Towers of Hanoi ', 50, 'hard', '0000-00-00'),
(3, 1, 'Uppercase and Lowercase', 20, 'easy', '0000-00-00'),
(3, 2, 'Converting Strings to Integers', 30, 'easy', '0000-00-00'),
(3, 3, 'Converting Strings to Floating Point', 30, 'easy', '0000-00-00'),
(3, 4, 'Comparing Strings', 30, 'easy', '0000-00-00'),
(3, 5, 'Sentence with Its Words Reversed', 30, 'medium', '0000-00-00'),
(3, 6, 'Comparing Portions of Strings', 30, 'medium', '0000-00-00'),
(3, 7, 'Random Sentences', 40, 'hard', '0000-00-00'),
(3, 8, 'Limericks', 40, 'hard', '0000-00-00'),
(3, 9, 'Tokenizing Telephone Numbers', 40, 'hard', '0000-00-00'),
(3, 10, 'Counting the Occurrences of a Character', 40, 'hard', '0000-00-00'),
(3, 11, 'Counting the Letters of the Alphabet in a String', 50, 'hard', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `questions_assignment`
--

CREATE TABLE IF NOT EXISTS `questions_assignment` (
  `courseid` varchar(10) NOT NULL,
  `assignmentno` int(11) NOT NULL,
  `quesno` int(11) NOT NULL,
  `question` varchar(500) NOT NULL,
  `input` varchar(300) NOT NULL,
  `output` varchar(300) NOT NULL,
  `marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions_assignment`
--

INSERT INTO `questions_assignment` (`courseid`, `assignmentno`, `quesno`, `question`, `input`, `output`, `marks`) VALUES
('CSE104', 1, 1, 'print nos. from 1 to n', '10', '12345678910', 5),
('CSE104', 2, 1, 'print first n even nos.', '5', '246810', 5);

-- --------------------------------------------------------

--
-- Table structure for table `questions_comp`
--

CREATE TABLE IF NOT EXISTS `questions_comp` (
  `compid` int(11) NOT NULL,
  `questionid` int(11) NOT NULL,
  `question` varchar(200) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions_comp`
--

INSERT INTO `questions_comp` (`compid`, `questionid`, `question`, `points`) VALUES
(101, 1, 'Find the greatest product of K consecutive digits in the N digit number.\r\n\r\nInput Format\r\nFirst line contains T that denotes the number of test cases.\r\nFirst line of each test case will contain two in', 0),
(111, 1, 'print hello world n times', 5),
(111, 2, 'add two nos', 5);

-- --------------------------------------------------------

--
-- Table structure for table `question_submission`
--

CREATE TABLE IF NOT EXISTS `question_submission` (
  `studentid` varchar(9) NOT NULL,
  `courseid` varchar(10) NOT NULL,
  `assignmentno` int(11) NOT NULL,
  `quesno` int(11) NOT NULL,
  `marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_submission`
--

INSERT INTO `question_submission` (`studentid`, `courseid`, `assignmentno`, `quesno`, `marks`) VALUES
('201351009', 'CSE104', 1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `result_timed_comp`
--

CREATE TABLE IF NOT EXISTS `result_timed_comp` (
  `tcompid` int(11) NOT NULL,
  `tsid` varchar(9) NOT NULL,
  `answertime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `points` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result_timed_comp`
--

INSERT INTO `result_timed_comp` (`tcompid`, `tsid`, `answertime`, `points`) VALUES
(111, '201351009', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `aid` int(11) NOT NULL,
  `astatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`aid`, `astatus`) VALUES
(0, 'incorrect'),
(1, 'correct'),
(2, 'partially correct');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `studentid` varchar(9) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `semail` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `activation` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentid`, `fname`, `lname`, `semail`, `password`, `activation`) VALUES
('201351009', 'akhil', 'kumar', '201351009@iiitvadodara.ac.in', '3ade4df96512a5f8a8553f5816661a62', 1),
('201351024', 'shalinee', 'singh', '201351024@iiitvadodara.ac.in', 'f6e869582e9a1ba2d1eea3a9722e0d2a', 0),
('201352029', 'anjul', 'tyagi', '201352029@iiitvadodara.ac.in', '736bd4595235e0e3abc8639bee0b89f0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student-course`
--

CREATE TABLE IF NOT EXISTS `student-course` (
  `studentid` varchar(9) NOT NULL,
  `courseid` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student-course`
--

INSERT INTO `student-course` (`studentid`, `courseid`) VALUES
('201351009', 'CSE104'),
('201351024', 'CSE104'),
('201352029', 'CSE104');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `teacherid` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacherid`, `fname`, `lname`, `email`, `password`) VALUES
(111, 'P M', 'Jat', 'pmjat@gmail.com', 'pmj'),
(112, 'Manik LaL', 'Das', 'maniklal@gmail.com', 'mld'),
(1001, 'dexter', 'morgan', 'dextermorgan@mpd.com', 'darkpassenger');

-- --------------------------------------------------------

--
-- Table structure for table `teacher-course`
--

CREATE TABLE IF NOT EXISTS `teacher-course` (
  `teacherid` int(11) NOT NULL,
  `courseid` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher-course`
--

INSERT INTO `teacher-course` (`teacherid`, `courseid`) VALUES
(1001, 'CSE104');

-- --------------------------------------------------------

--
-- Table structure for table `timed_competition`
--

CREATE TABLE IF NOT EXISTS `timed_competition` (
  `tcomp_id` int(11) NOT NULL,
  `tcomp_name` varchar(50) NOT NULL,
  `tcomp_details` varchar(200) NOT NULL,
  `tcomp_sdate` date NOT NULL,
  `tcomp_stime` time NOT NULL,
  `tcomp_timelimit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timed_competition`
--

INSERT INTO `timed_competition` (`tcomp_id`, `tcomp_name`, `tcomp_details`, `tcomp_sdate`, `tcomp_stime`, `tcomp_timelimit`) VALUES
(111, 'gone in 60 minutes', 'be swift be correct be accurate', '2015-06-24', '09:00:00', 60);

-- --------------------------------------------------------

--
-- Table structure for table `timed_competition_participant`
--

CREATE TABLE IF NOT EXISTS `timed_competition_participant` (
  `s_id` varchar(9) NOT NULL,
  `tcompid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer_comp`
--
ALTER TABLE `answer_comp`
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD KEY `courseid` (`courseid`), ADD KEY `teacherid` (`teacherid`);

--
-- Indexes for table `competition`
--
ALTER TABLE `competition`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `competition_participant`
--
ALTER TABLE `competition_participant`
  ADD KEY `student_id` (`student_id`), ADD KEY `comp_id` (`comp_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseid`);

--
-- Indexes for table `domain`
--
ALTER TABLE `domain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finalsubmission`
--
ALTER TABLE `finalsubmission`
  ADD KEY `studentid` (`studentid`), ADD KEY `courseid` (`courseid`);

--
-- Indexes for table `points`
--
ALTER TABLE `points`
  ADD KEY `student_id` (`s_id`), ADD KEY `answer_status` (`answer_status`), ADD KEY `domain_id` (`domain_id`);

--
-- Indexes for table `practiceques`
--
ALTER TABLE `practiceques`
  ADD KEY `fkey` (`did`);

--
-- Indexes for table `questions_assignment`
--
ALTER TABLE `questions_assignment`
  ADD KEY `courseid` (`courseid`);

--
-- Indexes for table `questions_comp`
--
ALTER TABLE `questions_comp`
  ADD KEY `compid` (`compid`);

--
-- Indexes for table `question_submission`
--
ALTER TABLE `question_submission`
  ADD KEY `studentid` (`studentid`), ADD KEY `courseid` (`courseid`);

--
-- Indexes for table `result_timed_comp`
--
ALTER TABLE `result_timed_comp`
  ADD KEY `tcompid` (`tcompid`), ADD KEY `tsid` (`tsid`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentid`);

--
-- Indexes for table `student-course`
--
ALTER TABLE `student-course`
  ADD KEY `studentid` (`studentid`), ADD KEY `courseid` (`courseid`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacherid`);

--
-- Indexes for table `teacher-course`
--
ALTER TABLE `teacher-course`
  ADD KEY `teacherid` (`teacherid`), ADD KEY `courseid` (`courseid`);

--
-- Indexes for table `timed_competition`
--
ALTER TABLE `timed_competition`
  ADD PRIMARY KEY (`tcomp_id`);

--
-- Indexes for table `timed_competition_participant`
--
ALTER TABLE `timed_competition_participant`
  ADD KEY `s_id` (`s_id`), ADD KEY `tcompid` (`tcompid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer_comp`
--
ALTER TABLE `answer_comp`
ADD CONSTRAINT `fkey9` FOREIGN KEY (`sid`) REFERENCES `student` (`studentid`);

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
ADD CONSTRAINT `fkey17` FOREIGN KEY (`teacherid`) REFERENCES `teacher` (`teacherid`),
ADD CONSTRAINT `fkey18` FOREIGN KEY (`courseid`) REFERENCES `courses` (`courseid`);

--
-- Constraints for table `competition_participant`
--
ALTER TABLE `competition_participant`
ADD CONSTRAINT `fkey10` FOREIGN KEY (`student_id`) REFERENCES `student` (`studentid`),
ADD CONSTRAINT `fkey11` FOREIGN KEY (`comp_id`) REFERENCES `competition` (`comp_id`);

--
-- Constraints for table `finalsubmission`
--
ALTER TABLE `finalsubmission`
ADD CONSTRAINT `fkey22` FOREIGN KEY (`studentid`) REFERENCES `student` (`studentid`),
ADD CONSTRAINT `fkey23` FOREIGN KEY (`courseid`) REFERENCES `courses` (`courseid`);

--
-- Constraints for table `points`
--
ALTER TABLE `points`
ADD CONSTRAINT `f_key` FOREIGN KEY (`s_id`) REFERENCES `student` (`studentid`),
ADD CONSTRAINT `fkey6` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`),
ADD CONSTRAINT `foriegnkey` FOREIGN KEY (`answer_status`) REFERENCES `status` (`aid`);

--
-- Constraints for table `practiceques`
--
ALTER TABLE `practiceques`
ADD CONSTRAINT `fkey` FOREIGN KEY (`did`) REFERENCES `domain` (`id`);

--
-- Constraints for table `questions_assignment`
--
ALTER TABLE `questions_assignment`
ADD CONSTRAINT `fkey19` FOREIGN KEY (`courseid`) REFERENCES `courses` (`courseid`);

--
-- Constraints for table `question_submission`
--
ALTER TABLE `question_submission`
ADD CONSTRAINT `fkey20` FOREIGN KEY (`studentid`) REFERENCES `student` (`studentid`),
ADD CONSTRAINT `fkey21` FOREIGN KEY (`courseid`) REFERENCES `courses` (`courseid`);

--
-- Constraints for table `result_timed_comp`
--
ALTER TABLE `result_timed_comp`
ADD CONSTRAINT `fkey7` FOREIGN KEY (`tcompid`) REFERENCES `timed_competition` (`tcomp_id`),
ADD CONSTRAINT `fkey8` FOREIGN KEY (`tsid`) REFERENCES `student` (`studentid`);

--
-- Constraints for table `student-course`
--
ALTER TABLE `student-course`
ADD CONSTRAINT `fkey15` FOREIGN KEY (`courseid`) REFERENCES `courses` (`courseid`),
ADD CONSTRAINT `fkey16` FOREIGN KEY (`studentid`) REFERENCES `student` (`studentid`);

--
-- Constraints for table `teacher-course`
--
ALTER TABLE `teacher-course`
ADD CONSTRAINT `fkey26` FOREIGN KEY (`teacherid`) REFERENCES `teacher` (`teacherid`),
ADD CONSTRAINT `fkey27` FOREIGN KEY (`courseid`) REFERENCES `courses` (`courseid`);

--
-- Constraints for table `timed_competition_participant`
--
ALTER TABLE `timed_competition_participant`
ADD CONSTRAINT `fkey12` FOREIGN KEY (`s_id`) REFERENCES `student` (`studentid`),
ADD CONSTRAINT `fkey13` FOREIGN KEY (`tcompid`) REFERENCES `timed_competition` (`tcomp_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
