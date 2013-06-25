-- phpMyAdmin SQL Dump
-- version 3.4.10.2
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Oct 10, 2012 at 10:48 AM
-- Server version: 5.1.61
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lidev`
--

-- --------------------------------------------------------

--
-- Table structure for table `academicrequirement`
--

CREATE TABLE IF NOT EXISTS `academicrequirement` (
  `ID` int(11) NOT NULL,
  `AcademicRequirement` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `accountstatus`
--

CREATE TABLE IF NOT EXISTS `accountstatus` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Status` varchar(45) DEFAULT NULL,
  `UpdatedOn` varchar(45) DEFAULT NULL,
  `UpdatedBy` varchar(45) DEFAULT NULL,
  `Deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE IF NOT EXISTS `activity_log` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CodeID` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Feature` varchar(100) NOT NULL,
  `CreatedOn` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE IF NOT EXISTS `alerts` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `AlertTypeId` int(11) NOT NULL,
  `Message` text NOT NULL,
  `Reviewed` int(11) NOT NULL,
  `CreatedOn` datetime NOT NULL,
  `Deleted` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `alert_type`
--

CREATE TABLE IF NOT EXISTS `alert_type` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Type` varchar(100) NOT NULL,
  `Action` varchar(100) NOT NULL,
  `Createdon` datetime NOT NULL,
  `Deleted` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `QuestionId` int(11) NOT NULL,
  `OptionID` varchar(45) DEFAULT NULL,
  `ResponseText` varchar(500) DEFAULT NULL,
  `ResponseFeedback` varchar(500) DEFAULT NULL,
  `ApplicationID` int(11) DEFAULT NULL,
  `Deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=109 ;

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE IF NOT EXISTS `application` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `JobId` int(11) DEFAULT NULL,
  `StudentID` varchar(100) DEFAULT NULL,
  `AppliedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ApplicationStatus` varchar(45) DEFAULT NULL,
  `ApplicationRating` int(11) DEFAULT NULL,
  `StatusUpdatedOn` datetime DEFAULT NULL,
  `Deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Table structure for table `betatester`
--

CREATE TABLE IF NOT EXISTS `betatester` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `CreatedOn` date NOT NULL,
  `UpdatedOn` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `betatesteractivity`
--

CREATE TABLE IF NOT EXISTS `betatesteractivity` (
  `ID` int(11) NOT NULL,
  `LastLogin` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE IF NOT EXISTS `college` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CollegeName` varchar(45) DEFAULT NULL,
  `CollegeType` int(11) NOT NULL,
  `LocationID` int(11) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `CoursesOfferedIDString` varchar(45) DEFAULT NULL,
  `Logo` varchar(45) DEFAULT NULL,
  `ContactPerson` varchar(45) DEFAULT NULL,
  `ContactNo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `collegetype`
--

CREATE TABLE IF NOT EXISTS `collegetype` (
  `CollegeTypeID` int(11) NOT NULL,
  `Type` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `company_type`
--

CREATE TABLE IF NOT EXISTS `company_type` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CompanyType` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `compensation`
--

CREATE TABLE IF NOT EXISTS `compensation` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CompensationType` varchar(50) NOT NULL,
  `CreatedOn` int(11) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `Deleted` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CourseName` varchar(255) DEFAULT NULL,
  `Description` text,
  `Deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=83 ;

-- --------------------------------------------------------

--
-- Table structure for table `coursespecialization`
--

CREATE TABLE IF NOT EXISTS `coursespecialization` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CourseID` int(11) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Description` varchar(25) NOT NULL,
  `Deleted` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE IF NOT EXISTS `employer` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CompanyName` varchar(255) NOT NULL,
  `UserId` int(11) NOT NULL,
  `SubscriptionTypeID` int(11) NOT NULL,
  `Description` text,
  `Email` varchar(255) NOT NULL,
  `CompanyTypeId` int(11) NOT NULL,
  `LocationIDString` varchar(500) DEFAULT NULL,
  `Website` varchar(255) DEFAULT NULL,
  `Logo` varchar(255) DEFAULT NULL,
  `IndustryID` int(45) DEFAULT NULL,
  `ContactPerson` varchar(255) NOT NULL,
  `ContactNo` varchar(50) NOT NULL,
  `UpdatedBy` varchar(45) DEFAULT NULL,
  `UpdatedOn` datetime DEFAULT NULL,
  `Deleted` bit(1) DEFAULT NULL,
  `Address` varchar(1024) DEFAULT NULL,
  `Pincode` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=979 ;

-- --------------------------------------------------------

--
-- Table structure for table `error_codes`
--

CREATE TABLE IF NOT EXISTS `error_codes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ErrorCode` int(11) NOT NULL,
  `Message` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE IF NOT EXISTS `followers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `employer_id` int(11) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `StartDate` datetime NOT NULL,
  `Deleted` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `global_vars`
--

CREATE TABLE IF NOT EXISTS `global_vars` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `APIKey` varchar(255) NOT NULL,
  `SecretKey` varchar(255) NOT NULL,
  `LetsKey` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `ijobsmetadata`
--

CREATE TABLE IF NOT EXISTS `ijobsmetadata` (
  `jobid` int(11) NOT NULL,
  `Metadata` text,
  `JobViews` int(11) DEFAULT NULL,
  `Deleted` bit(1) DEFAULT NULL,
  FULLTEXT KEY `Metadata` (`Metadata`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ijobtemplate`
--

CREATE TABLE IF NOT EXISTS `ijobtemplate` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(50) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `JobTypeId` int(11) NOT NULL,
  `RequiredSkillIdString` varchar(45) NOT NULL,
  `SubCategoryId` int(11) NOT NULL,
  `CompensationTypeId` int(11) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedOn` datetime NOT NULL,
  `UpdatedBy` int(11) NOT NULL,
  `UpdatedOn` datetime NOT NULL,
  `Deleted` binary(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `industry`
--

CREATE TABLE IF NOT EXISTS `industry` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IndustryType` varchar(255) NOT NULL,
  `UpdatedBy` varchar(45) DEFAULT NULL,
  `UpdatedOn` datetime DEFAULT NULL,
  `Deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- Table structure for table `isearchkeywords`
--

CREATE TABLE IF NOT EXISTS `isearchkeywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Keyword` varchar(255) DEFAULT NULL,
  `JobIdString` varchar(1000) DEFAULT NULL,
  `CreatedOn` datetime DEFAULT NULL,
  `UpdatedOn` datetime DEFAULT NULL,
  `Deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='		' AUTO_INCREMENT=1024 ;

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(500) DEFAULT NULL,
  `Description` text,
  `JobTypeId` int(11) DEFAULT NULL,
  `EmployerId` int(11) DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL,
  `LocationIdString` varchar(500) DEFAULT NULL,
  `JobProspect` binary(1) DEFAULT '0',
  `FunctionIdString` varchar(45) DEFAULT '0',
  `CategoryId` int(11) NOT NULL,
  `SubCategoryId` int(11) NOT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `isPeriodFlexible` binary(1) DEFAULT '0',
  `CompensationTypeId` int(11) DEFAULT NULL,
  `Amount` int(11) NOT NULL,
  `ApplicationDeadline` date DEFAULT NULL,
  `NoOfPositions` int(11) DEFAULT NULL,
  `RequiredSkillIdString` varchar(500) DEFAULT NULL,
  `AcademicRequirement` varchar(45) DEFAULT NULL,
  `isFeatured` binary(1) DEFAULT '0',
  `isLIRecommended` binary(1) DEFAULT '0',
  `ScreeningTestId` int(11) DEFAULT NULL,
  `JobPosting` varchar(10) NOT NULL DEFAULT 'free',
  `CreatedBy` varchar(45) DEFAULT NULL,
  `CreatedOn` datetime DEFAULT NULL,
  `UpdatedBy` varchar(45) DEFAULT NULL,
  `UpdatedOn` datetime DEFAULT NULL,
  `Deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1222 ;

-- --------------------------------------------------------

--
-- Table structure for table `jobcategory`
--

CREATE TABLE IF NOT EXISTS `jobcategory` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(25) NOT NULL,
  `Deleted` int(11) NOT NULL,
  `AddedOn` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `jobsubcategory`
--

CREATE TABLE IF NOT EXISTS `jobsubcategory` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryID` int(11) NOT NULL,
  `SubCategoryName` varchar(500) NOT NULL,
  `Deleted` int(11) NOT NULL,
  `AddedOn` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- Table structure for table `jobtype`
--

CREATE TABLE IF NOT EXISTS `jobtype` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Type` varchar(45) DEFAULT NULL,
  `UpdatedOn` datetime DEFAULT NULL,
  `UpdatedBy` varchar(45) DEFAULT NULL,
  `Deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CityName` varchar(255) DEFAULT NULL,
  `Tier` varchar(45) DEFAULT NULL,
  `Deleted` varchar(1) NOT NULL DEFAULT '0',
  `State` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=650 ;

-- --------------------------------------------------------

--
-- Table structure for table `PageViews`
--

CREATE TABLE IF NOT EXISTS `PageViews` (
  `ID` int(11) NOT NULL,
  `User` varchar(10) NOT NULL,
  `TypeID` int(11) NOT NULL,
  `CreatedOn` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE IF NOT EXISTS `preferences` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` varchar(255) NOT NULL,
  `JobCategoryID` varchar(25) NOT NULL,
  `JobSubCategoryID` varchar(25) NOT NULL,
  `InternshipID` varchar(100) NOT NULL,
  `LocationIDString` varchar(25) NOT NULL,
  `JobTypeID` varchar(25) NOT NULL,
  `AddedOn` date NOT NULL,
  `UpdatedOn` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=308 ;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `QuestionText` varchar(500) DEFAULT NULL,
  `SubCategoryId` int(11) DEFAULT NULL,
  `QuestionType` varchar(45) DEFAULT NULL,
  `CreatedByUserId` int(11) NOT NULL,
  `Deleted` bit(1) DEFAULT NULL,
  `CreatedOn` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=116 ;

-- --------------------------------------------------------

--
-- Table structure for table `questionoptions`
--

CREATE TABLE IF NOT EXISTS `questionoptions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `QuestionID` int(11) DEFAULT NULL,
  `OptionText` varchar(500) DEFAULT NULL,
  `isCorrect` varchar(1) DEFAULT '0',
  `Deleted` varchar(1) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=185 ;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE IF NOT EXISTS `skills` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SkillName` varchar(255) DEFAULT NULL,
  `UpdatedOn` datetime DEFAULT NULL,
  `UpdatedBy` varchar(255) DEFAULT NULL,
  `Deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=215 ;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FacebookID` varchar(100) DEFAULT NULL,
  `UserId` int(100) NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Picture` varchar(45) DEFAULT NULL,
  `DOB` varchar(100) DEFAULT NULL,
  `Email` varchar(50) NOT NULL,
  `MobileNo` varchar(45) DEFAULT NULL,
  `Gender` varchar(20) DEFAULT NULL,
  `PinCode` int(11) NOT NULL,
  `Address` varchar(500) DEFAULT NULL,
  `LocationId` int(11) NOT NULL,
  `ProfileTitle` varchar(45) DEFAULT NULL,
  `SchoolXth` varchar(45) DEFAULT NULL,
  `MarksXth` varchar(45) DEFAULT NULL,
  `SchoolXIIth` varchar(45) DEFAULT NULL,
  `MarksXIIth` varchar(45) DEFAULT NULL,
  `CurrentCourseId` int(11) DEFAULT NULL,
  `CurrentYear` int(11) DEFAULT NULL,
  `CollegeId` int(11) DEFAULT NULL,
  `JobCategory` varchar(100) NOT NULL,
  `WorkHistory` varchar(255) NOT NULL,
  `Status` int(11) NOT NULL,
  `PictureTypeID` int(11) NOT NULL,
  `UpdatedOn` datetime DEFAULT NULL,
  `UpdateBy` varchar(45) DEFAULT NULL,
  `Deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=127 ;

-- --------------------------------------------------------

--
-- Table structure for table `studentavailabilitystatus`
--

CREATE TABLE IF NOT EXISTS `studentavailabilitystatus` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Status` varchar(25) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_skills`
--

CREATE TABLE IF NOT EXISTS `student_skills` (
  `StudentId` int(11) NOT NULL,
  `SkillId` int(11) DEFAULT NULL,
  `SelfRating` varchar(45) DEFAULT NULL,
  `UpdatedOn` datetime DEFAULT NULL,
  `UpdatedBy` varchar(45) DEFAULT NULL,
  `Deleted` bit(1) DEFAULT NULL,
  `LIRating` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_workex`
--

CREATE TABLE IF NOT EXISTS `student_workex` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `StudentId` varchar(100) DEFAULT NULL,
  `CompanyName` varchar(45) DEFAULT NULL,
  `Title` varchar(100) NOT NULL,
  `LocationID` int(11) DEFAULT NULL,
  `JobTypeID` int(11) DEFAULT NULL,
  `FunctionalRoleID` int(11) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `Recommendation` varchar(500) DEFAULT NULL,
  `Status` varchar(45) DEFAULT NULL,
  `RecommendedByEmployerID` int(11) DEFAULT NULL,
  `isJobThroughLetsIntern` bit(1) DEFAULT NULL,
  `UpdatedOn` datetime DEFAULT NULL,
  `UpdatedBy` varchar(45) DEFAULT NULL,
  `Deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptiontypes`
--

CREATE TABLE IF NOT EXISTS `subscriptiontypes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SubscriptionType` varchar(45) DEFAULT NULL,
  `Cost` varchar(45) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `Deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TestTitle` varchar(45) DEFAULT NULL,
  `Duration` varchar(2) DEFAULT NULL,
  `SubCategoryId` int(11) DEFAULT NULL,
  `CreatedByUserID` int(11) DEFAULT NULL,
  `Deleted` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

-- --------------------------------------------------------

--
-- Table structure for table `test_questions`
--

CREATE TABLE IF NOT EXISTS `test_questions` (
  `TestId` int(11) NOT NULL,
  `QuestionID` int(11) DEFAULT NULL,
  `Deleted` int(10) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

CREATE TABLE IF NOT EXISTS `useraccount` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(128) DEFAULT NULL,
  `Salt` varchar(128) NOT NULL,
  `UserTypeId` int(11) NOT NULL,
  `LastLogin` datetime DEFAULT NULL,
  `LastLoginFailed` datetime DEFAULT NULL,
  `AccountStatusId` int(11) DEFAULT '3',
  `CreatedOn` datetime DEFAULT NULL,
  `ActivationCode` varchar(50) NOT NULL,
  `Deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1219 ;

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE IF NOT EXISTS `usertype` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Type` varchar(30) DEFAULT NULL,
  `UpdatedOn` datetime DEFAULT NULL,
  `UpdatedBy` datetime DEFAULT NULL,
  `Deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `zipcode`
--

CREATE TABLE IF NOT EXISTS `zipcode` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Zip` varchar(20) NOT NULL,
  `City` varchar(100) NOT NULL,
  `State` varchar(5) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `idx_zipcode` (`Zip`(5))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
