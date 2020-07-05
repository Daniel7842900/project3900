-- MySQL dump 10.13  Distrib 8.0.16, for Win64 (x86_64)
--
-- Host: ls-77e1472d76ad627554447c61511cf31b8998c2ce.c1ca77nowf79.us-west-2.rds.amazonaws.com    Database: database1
-- ------------------------------------------------------
-- Server version	5.6.41-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Category`
--

DROP TABLE IF EXISTS `Category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `Category` (
  `Category_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Proj_Cat_ID` int(11) NOT NULL,
  `Category_Name` varchar(45) NOT NULL,
  `Category_Start_Date` date NOT NULL,
  `Category_End_Date` date NOT NULL,
  `Category_Code` int(11) NOT NULL,
  PRIMARY KEY (`Category_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Category`
--

LOCK TABLES `Category` WRITE;
/*!40000 ALTER TABLE `Category` DISABLE KEYS */;
/*!40000 ALTER TABLE `Category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Proj_Cat`
--

DROP TABLE IF EXISTS `Proj_Cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `Proj_Cat` (
  `Proj_Cat_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Project_ID` int(11) NOT NULL,
  `Category_ID` int(11) NOT NULL,
  PRIMARY KEY (`Proj_Cat_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Proj_Cat`
--

LOCK TABLES `Proj_Cat` WRITE;
/*!40000 ALTER TABLE `Proj_Cat` DISABLE KEYS */;
/*!40000 ALTER TABLE `Proj_Cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Project`
--

DROP TABLE IF EXISTS `Project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `Project` (
  `Project_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Proj_Cat_ID` int(11) NOT NULL,
  `Manager_User_ID` int(11) NOT NULL,
  `Project_Name` varchar(45) NOT NULL,
  `Project_Desc` varchar(45) NOT NULL,
  `Project_Start_Date` date NOT NULL,
  `Project_End_Date` date NOT NULL,
  PRIMARY KEY (`Project_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Project`
--

LOCK TABLES `Project` WRITE;
/*!40000 ALTER TABLE `Project` DISABLE KEYS */;
/*!40000 ALTER TABLE `Project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Task`
--

DROP TABLE IF EXISTS `Task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `Task` (
  `Task_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Category_ID` int(11) NOT NULL,
  `Task_Name` varchar(45) NOT NULL,
  `Task_Start_Date` date NOT NULL,
  `Task_End_Date` date NOT NULL,
  `Task_Budget` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Task_Code` int(11) NOT NULL,
  PRIMARY KEY (`Task_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Task`
--

LOCK TABLES `Task` WRITE;
/*!40000 ALTER TABLE `Task` DISABLE KEYS */;
/*!40000 ALTER TABLE `Task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `User` (
  `User_ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_Type_ID` int(11) NOT NULL,
  `User_First_Name` varchar(45) NOT NULL,
  `User_Last_Name` varchar(45) NOT NULL,
  `User_Email` varchar(45) NOT NULL,
  PRIMARY KEY (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User_Type`
--

DROP TABLE IF EXISTS `User_Type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `User_Type` (
  `User_Type_ID` int(11) NOT NULL,
  `Type` varchar(45) NOT NULL,
  PRIMARY KEY (`User_Type_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User_Type`
--

LOCK TABLES `User_Type` WRITE;
/*!40000 ALTER TABLE `User_Type` DISABLE KEYS */;
INSERT INTO `User_Type` VALUES (1,'Administrator'),(2,'Project_Manager'),(3,'Employee');
/*!40000 ALTER TABLE `User_Type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Weekly_Timesheet`
--

DROP TABLE IF EXISTS `Weekly_Timesheet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `Weekly_Timesheet` (
  `Week_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Task_ID` int(11) NOT NULL,
  `Actuals` int(11) NOT NULL,
  `ETC` int(11) NOT NULL,
  `Week_Start_Date` date NOT NULL,
  PRIMARY KEY (`Week_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Weekly_Timesheet`
--

LOCK TABLES `Weekly_Timesheet` WRITE;
/*!40000 ALTER TABLE `Weekly_Timesheet` DISABLE KEYS */;
/*!40000 ALTER TABLE `Weekly_Timesheet` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-28 16:43:10
