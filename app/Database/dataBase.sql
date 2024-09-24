-- MariaDB dump 10.19  Distrib 10.11.6-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: bluebull_sandbox
-- ------------------------------------------------------
-- Server version	10.11.6-MariaDB-0+deb12u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cat_function`
--

DROP TABLE IF EXISTS `cat_function`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cat_function` (
                                `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                                `endpoint` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
                                `function` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
                                `path` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
                                `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
                                `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_function`
--

LOCK TABLES `cat_function` WRITE;
/*!40000 ALTER TABLE `cat_function` DISABLE KEYS */;
INSERT INTO `cat_function` VALUES
                               (1,'signin','signIn','Controllers\\SigninController','2024-08-01 17:02:51',NULL),
                               (2,'searchRfc','searchRfc','Controllers\\BlueBullController','2024-08-01 17:02:51',NULL);
/*!40000 ALTER TABLE `cat_function` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
                         `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                         `nickname` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
                         `email` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
                         `password` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
                         `active` tinyint(3) unsigned NOT NULL DEFAULT 0,
                         `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                         `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `email` (`email`),
                         UNIQUE KEY `nicknameUnique` (`nickname`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
                        (1,'root','uriel.magallon@whitefish.mx','P+OGliylcWo=',1,'2024-08-01 18:30:12',NULL),
                        (2,'jarvis','kit@skynet.com','P+OGliylcWo=',1,'2024-08-01 18:30:12',NULL),
                        (11,'Drakoz','ury197@hotmail.com','P+OGliylcWo=',1,'2024-07-17 21:33:41','2024-08-01 18:25:50'),
                        (12,'Richard','ricardo.delgado@solve.mx','UtCcgXi4cG7QzA==',1,'2024-07-31 19:19:39','2024-08-01 18:26:08'),
                        (13,'Joselo','jose.villarreal@solvegcm.mx','Usiak3S4cG7QzA==',1,'2024-07-31 20:00:13','2024-08-01 18:26:41');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
                        `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                        `id_user` bigint(20) unsigned DEFAULT NULL,
                        `task` bigint(20) unsigned DEFAULT NULL,
                        `code` int(11) DEFAULT NULL,
                        `data_in` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data_in`)),
                        `result` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`result`)),
                        `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
                        `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
                        PRIMARY KEY (`id`),
                        KEY `logs_users_FK` (`id_user`),
                        KEY `logs_cat_function_id_fk` (`task`),
                        CONSTRAINT `logs_cat_function_id_fk` FOREIGN KEY (`task`) REFERENCES `cat_function` (`id`) ON UPDATE CASCADE,
                        CONSTRAINT `logs_users_FK` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person` (
                          `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                          `user_id` bigint(20) unsigned NOT NULL,
                          `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
                          `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
                          `sure_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
                          `gender` enum('Masculino','Femenino','Otro') CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
                          `birthday` date DEFAULT NULL,
                          `address` bigint(20) unsigned DEFAULT NULL,
                          `phone` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
                          `active` tinyint(3) unsigned DEFAULT 0,
                          `created_at` timestamp NULL DEFAULT current_timestamp(),
                          `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
                          PRIMARY KEY (`id`),
                          KEY `user_id` (`user_id`),
                          KEY `birthday` (`birthday`),
                          KEY `active` (`active`),
                          CONSTRAINT `FK_person_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person`
--

LOCK TABLES `person` WRITE;
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
INSERT INTO `person` VALUES
                         (11,11,'Uriel','Magallon','Lugo','Masculino','2006-07-19',NULL,'7712625355',1,'2024-07-17 21:33:41',NULL),
                         (12,12,'Ricardo','Delgado','','Masculino','1969-12-31',NULL,'5647522946',1,'2024-07-31 19:19:39','2024-07-31 19:28:32'),
                         (13,13,'Jose Luis','Villarreal','','Masculino','1975-10-17',NULL,'8712648935',1,'2024-07-31 20:00:13',NULL);
/*!40000 ALTER TABLE `person` ENABLE KEYS */;
UNLOCK TABLES;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-02  9:03:46
