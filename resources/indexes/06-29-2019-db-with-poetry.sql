-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: localhost    Database: word
-- ------------------------------------------------------
-- Server version	5.7.26-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_01_07_073615_create_tagged_table',1),(2,'2014_01_07_073615_create_tags_table',1),(3,'2014_10_12_000000_create_users_table',1),(4,'2014_10_12_100000_create_password_resets_table',1),(5,'2016_06_29_073615_create_tag_groups_table',1),(6,'2016_06_29_073615_update_tags_table',1),(7,'2019_06_02_152248_create_poetry_table',1),(8,'2019_06_02_152346_create_purchases_table',1),(9,'2019_06_07_140957_create_social_accounts_table',1),(10,'2019_06_16_135750_create_sponsorships_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poetry`
--

DROP TABLE IF EXISTS `poetry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `poetry` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `poem` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meaning` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` bigint(20) NOT NULL DEFAULT '0',
  `likes` bigint(20) NOT NULL DEFAULT '0',
  `dislikes` bigint(20) NOT NULL DEFAULT '0',
  `hateful` int(10)  NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `poetry_user_id_foreign` (`user_id`),
  FULLTEXT KEY `idx_poetry_title_poem_meaning` (`title`,`poem`,`meaning`),
  CONSTRAINT `poetry_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poetry`
--

LOCK TABLES `poetry` WRITE;
/*!40000 ALTER TABLE `poetry` DISABLE KEYS */;
INSERT INTO `poetry` VALUES (1,'Sleep',1,'gruesome tides pull sailors in\r\n    and out\r\n        while mollusks enjoy\r\nplankton calm\r\n    and sleep the shuckers by\r\n\r\nhistory sleeps there, as well\r\n   and pulls no words\r\n   from their tight mother-pearl slits','History doesn\'t wait to be written by any authority; there are many concurrent histories at play in the world, and those that accept that difficult truth may find freedom in anonymity.',1,0,0,0,1,250.00,'2019-06-26 19:54:11','2019-06-26 19:54:11'),(2,'poem for the new twice',1,'Once,\r\n   but never again,\r\n        yesterday, was new, once.','Live life letting go of the preposterous notion that tomorrow and yesterday are the same thing.',1,0,0,0,1,50.00,'2019-06-26 19:56:56','2019-06-26 19:56:57'),(3,'ride 2',1,'Rilke only owns what is ours, by definition.\r\nMeaning.\r\nMost people think that he was great\r\n    and really supportive.\r\nBut meaning might know otherwise.\r\n\r\nTomorrow, a wedding;\r\n    whilst today, awaiting it:\r\n\r\nBut later still, meaning awaits curled\r\n    in infants\' suckle.','We are locked in a world of household names, but it is the household meaning that is truly dignified.',1,0,0,0,1,350.00,'2019-06-26 20:01:33','2019-06-26 20:01:33'),(4,'Torture et all.',1,'FREEDOM\r\n    stolen is never freedom gained\r\nFROM\r\nPAIN\r\n    was never anything more than signal to avert. \r\n    Instinctual biology curses us through the power \r\n        of \r\n    another.\r\n    I am not but meat, chewed by another, but \r\n    nameless I could only look 2 generations \r\n    forward \r\n    or backward and see those forgotten!\r\nWE\r\nFEEL\r\n    the air slide over your brow with a delighted \r\n    God in it\'s eradication.\r\nNOW','This call to action is a request to the people of the world to give up abjected coercive pain and please God.',1,0,0,0,1,150.00,'2019-06-26 20:10:36','2019-06-26 20:10:36'),(5,'tendrils',1,'from the seed\r\nopens the pupae\r\ncloses the generation\r\nseen a billion times over\r\n    each\r\n        wished to see more','We are a society of individuals intrinsically afraid of the future.',1,0,0,0,1,50.00,'2019-06-26 20:25:56','2019-06-26 20:25:56'),(6,'devide',1,'the first time\r\n    was not the only\r\njoy \\battered\\\r\n\r\none/two\r\n\r\nor\r\n\r\none/one\r\n\r\nbut maybe someday\r\n    1=1','I may be married someday, but hope it is a deep love. I worry that the love of those around me is ingenuine.',1,0,0,0,1,100.00,'2019-06-26 20:28:58','2019-06-26 20:28:59'),(7,'grow',1,'March 21st\r\nA season turns damp with\r\nanticipate.\r\n\r\nHope grows with every droplet\r\nsalt-skinned\r\n    dripping.\r\n\r\nThaw moons expectations\r\n    and the sea laughs both\r\n        questions and their answers.\r\n\r\nBut we grow\r\n    small\r\ngiving.\r\n\r\nAugust awaits, jealous.','The farmer goes through a system relavent to all life. They know it. Difficulty and strife abide and economic hazard is everywhere for the farmer.',1,0,0,0,1,300.00,'2019-06-26 20:35:18','2019-06-26 20:35:18'),(8,'dog 2',1,'jesus fetches millions but not\r\none\r\n    as well gentle and generous\r\n    of will-less love.','All dogs go to heaven.',1,0,0,0,1,150.00,'2019-06-26 20:39:53','2019-06-26 20:39:53'),(9,'where is tennyson when you need him',1,'a plagerisation:\r\n\r\n    love kisses hope\'s lips\r\n    awakening her\r\n    only to watch her\r\n    fallquicklyto\r\n    sleep again','Love awakens feeling of a possible future.',1,0,0,0,1,300.00,'2019-06-26 20:42:41','2019-06-26 20:42:41'),(10,'sing butcher',1,'circle of blade taking haunches\r\nway their whole\r\nchewed wonder gone\r\ndoesn\'t keep low eyes from flitting\r\nthis is the way it has always been done\r\nheightened sights blind to the years','The butcher cuts meat that had wanted more life.',1,0,0,0,1,150.00,'2019-06-26 20:46:28','2019-06-26 20:46:28'),(11,'the bow',1,'shield deflects arrow, but only toward\r\n    new direction.\r\n\r\nHoming flesh,\r\n    only the noviced\r\n    feels divisive burning.\r\n\r\nQuestions,\r\n    but the tired only ask one of the bow.','Pain hurts both sender and receiver, so don\'t attack loved ones.',1,0,0,0,1,75.00,'2019-06-26 20:49:55','2019-06-26 20:49:55'),(12,'tyrosine kinase',1,'earlier, a man sang in electron his list of wishes.\r\nothers sang back\r\n    muted\r\noffering nothing price to see\r\n   a day after that last wish\r\n\r\nutopia has always meant\r\nnowhere; definitively perfect,\r\nbut it could be just days later.\r\n\r\nWe ask the basics of the gods,\r\nplease, please, please.','Sciences build not toward perfection but aimlessly.',1,0,0,0,1,100.00,'2019-06-26 20:54:12','2019-06-26 20:54:12'),(13,'scientific 1/2',1,'Yearning for a better yesterday,\r\n    only now.\r\n\r\nI have another question, please, of yesterday:\r\n\r\nWhere did they all go?','The project of science and modernity is sadly hopeful.',1,0,0,0,1,150.00,'2019-06-26 20:58:49','2019-06-26 20:58:49'),(14,'scientific 2/2',1,'the birds, they fly north\r\n    but they fly all the same\r\n    places.\r\n\r\nWe are sure\r\n    of nothing\r\n    pretty regularly.','Do not put too much emphasis on authority and expertise.',1,0,0,0,1,100.00,'2019-06-26 21:01:10','2019-06-26 21:01:10'),(15,'interapt 2',1,'Reaching,\r\n    one can feel a different\r\ntemperature\r\n    the farther from one\'s core\r\n    toward another.\r\n\r\nDampness dwindles and\r\n    dryness rebukes.\r\n\r\nTo lead and follow in parallel\r\nwe find not only tomorrow\r\n    instead,  reputation\r\n    for a\r\nfuture word of joyed caution\r\n    and silence between lovers\r\n   centuries joined and parted.\r\n\r\nIf the last lovers of Syria kissed\r\nwe would know of it, correct?\r\n\r\nNo.','History passes us. Many of them. We - particularly Americans - assume ours is the only one, but that is not the case.',1,0,0,0,1,250.00,'2019-06-26 21:23:02','2019-06-26 21:23:02'),(16,'sexworx (ode to elton john)',1,'A dancer in linensheet\r\n    smiles only for sadness\r\n    and anger.\r\ntraded\r\n    for freedom\r\nlost long ago.\r\n\r\n2 cares:\r\n    sleep\r\n    returned favor\r\n\r\nThe beginning was simple\r\nneed and curiosity, only to crush:\r\n    118 dead in the last frostbite in Milwaukee\r\n\r\nA tiny dancer in the sand...','Tiny dancer is a somber song regarding the pain of a prostitute; I identify with her.',1,0,0,0,1,150.00,'2019-06-26 21:30:24','2019-06-26 21:30:25'),(17,'2 doors 2',1,'saccharine excitement shunned\r\n    open windows challenged a bitter wasted fume\r\n\r\nwater extinguishes\r\n    only once\r\n    and only that which cannot burn\r\n    itself\r\n\r\nGod\'s tongue rolling Sol around as if it were only human.\r\n\r\n2 doors wait:\r\n    one a closet of fear,\r\n    the other we all wait to never open.','Fortune is fickle.',1,0,0,0,1,50.00,'2019-06-26 21:35:56','2019-06-26 21:35:56'),(18,'ambiguity in name',1,'What in a name\r\n    isn\'t\r\n        but sorrow creeping as a\r\nvine\r\nWe want children but can\'t bear\r\n   to expose them to the very things we desire.\r\n\r\nWe are not notable, are we? but every child sees\r\n   further than we could.\r\n\r\nWe rest in a cradle of 150 years and are forgotten lustfully.\r\n\r\nMay they be good years for all.','Life lives and forgets. Our best hope is to be remembered well, then sink into anonymity. 150 years is the best we can hope to be notable.',1,0,0,0,1,150.00,'2019-06-26 22:21:19','2019-06-26 22:21:19'),(19,'Lovers in the Morning Do 2',1,'I have coffee,\r\n    I don\'t, yet.\r\n\r\nI have crack of flame through the windowsill shining-\r\n\r\nWhat do I have?\r\n    A schedule.\r\n\r\nWhat do you have?\r\n    A honeydo list.','Two married people, he is passionate while she practical.',1,0,0,0,1,100.00,'2019-06-26 22:25:19','2019-06-26 22:25:20'),(20,'need',1,'reach upwards,\r\n    only to grasp soil\r\n    and dirty the eyes\r\n    of water.\r\n\r\nBeneath\r\n    a crick flows\r\n    next to scatted mud\r\n    knuckle-deep hooves.\r\n\r\nCan drag you in whole.\r\nfrustrated beating of the chest\r\n    but a tender heart whispers a murmur\r\n        staccato tattoo into a .','The way this poem ends says that I may never find person, or might, to understand completely.',2,0,0,0,1,75.00,'2019-06-26 22:32:36','2019-06-26 22:35:45');
/*!40000 ALTER TABLE `poetry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchases` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `purchaser_id` bigint(20) unsigned NOT NULL,
  `poem_id` bigint(20) unsigned NOT NULL,
  `price_paid` decimal(8,2) NOT NULL DEFAULT '0.00',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  
  `quantity` int(11) NOT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchases_poem_id_foreign` (`poem_id`),
  KEY `purchases_purchaser_id_foreign` (`purchaser_id`),
  CONSTRAINT `purchases_poem_id_foreign` FOREIGN KEY (`poem_id`) REFERENCES `poetry` (`id`),
  CONSTRAINT `purchases_purchaser_id_foreign` FOREIGN KEY (`purchaser_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchases`
--

LOCK TABLES `purchases` WRITE;
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_accounts`
--

DROP TABLE IF EXISTS `social_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `social_accounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_accounts`
--

LOCK TABLES `social_accounts` WRITE;
/*!40000 ALTER TABLE `social_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `social_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sponsorships`
--

DROP TABLE IF EXISTS `sponsorships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sponsorships` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `patron_id` bigint(20) NOT NULL,
  `payee_id` bigint(20) NOT NULL,
  `pledge` decimal(8,2) NOT NULL,
  `cycle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'monthly',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sponsorships`
--

LOCK TABLES `sponsorships` WRITE;
/*!40000 ALTER TABLE `sponsorships` DISABLE KEYS */;
/*!40000 ALTER TABLE `sponsorships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagging_tag_groups`
--

DROP TABLE IF EXISTS `tagging_tag_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagging_tag_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tagging_tag_groups_slug_index` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagging_tag_groups`
--

LOCK TABLES `tagging_tag_groups` WRITE;
/*!40000 ALTER TABLE `tagging_tag_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagging_tag_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagging_tagged`
--

DROP TABLE IF EXISTS `tagging_tagged`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagging_tagged` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `taggable_id` int(10) unsigned NOT NULL,
  `taggable_type` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_slug` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tagging_tagged_taggable_id_index` (`taggable_id`),
  KEY `tagging_tagged_taggable_type_index` (`taggable_type`),
  KEY `tagging_tagged_tag_slug_index` (`tag_slug`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagging_tagged`
--

LOCK TABLES `tagging_tagged` WRITE;
/*!40000 ALTER TABLE `tagging_tagged` DISABLE KEYS */;
INSERT INTO `tagging_tagged` VALUES (1,1,'App\\Poem','History','history'),(2,1,'App\\Poem','Existential','existential'),(3,2,'App\\Poem','Existentialist','existentialist'),(4,2,'App\\Poem','Sentimental','sentimental'),(5,2,'App\\Poem','Call To Action','call-to-action'),(6,3,'App\\Poem','Existentialist','existentialist'),(7,3,'App\\Poem','Historical','historical'),(8,4,'App\\Poem','Political','political'),(9,4,'App\\Poem','Call To Action','call-to-action'),(10,5,'App\\Poem','Existentialist','existentialist'),(11,6,'App\\Poem','Love','love'),(12,6,'App\\Poem','Math','math'),(13,7,'App\\Poem','Farming','farming'),(14,7,'App\\Poem','Economic','economic'),(15,8,'App\\Poem','Dogs','dogs'),(16,9,'App\\Poem','Love','love'),(17,10,'App\\Poem','Political','political'),(18,10,'App\\Poem','Vegan','vegan'),(19,11,'App\\Poem','Family','family'),(20,12,'App\\Poem','Science','science'),(21,13,'App\\Poem','Science','science'),(22,13,'App\\Poem','Modernity','modernity'),(23,14,'App\\Poem','Science','science'),(24,15,'App\\Poem','Love','love'),(25,15,'App\\Poem','History','history'),(26,16,'App\\Poem','Pop','pop'),(27,16,'App\\Poem','Social Issues','social-issues'),(28,17,'App\\Poem','General','general'),(29,18,'App\\Poem','Existentialist','existentialist'),(30,18,'App\\Poem','Sentimental','sentimental'),(31,19,'App\\Poem','Slice Of Life','slice-of-life'),(32,19,'App\\Poem','Love','love'),(33,19,'App\\Poem','Marriage','marriage'),(34,20,'App\\Poem','General','general'),(35,20,'App\\Poem','Prose','prose');
/*!40000 ALTER TABLE `tagging_tagged` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagging_tags`
--

DROP TABLE IF EXISTS `tagging_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagging_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag_group_id` int(10) unsigned DEFAULT NULL,
  `slug` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suggest` tinyint(1) NOT NULL DEFAULT '0',
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tagging_tags_slug_index` (`slug`),
  KEY `tagging_tags_tag_group_id_foreign` (`tag_group_id`),
  CONSTRAINT `tagging_tags_tag_group_id_foreign` FOREIGN KEY (`tag_group_id`) REFERENCES `tagging_tag_groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagging_tags`
--

LOCK TABLES `tagging_tags` WRITE;
/*!40000 ALTER TABLE `tagging_tags` DISABLE KEYS */;
INSERT INTO `tagging_tags` VALUES (1,NULL,'history','History',0,2),(2,NULL,'existential','Existential',0,1),(3,NULL,'existentialist','Existentialist',0,4),(4,NULL,'sentimental','Sentimental',0,2),(5,NULL,'call-to-action','Call To Action',0,2),(6,NULL,'historical','Historical',0,1),(7,NULL,'political','Political',0,2),(8,NULL,'love','Love',0,4),(9,NULL,'math','Math',0,1),(10,NULL,'farming','Farming',0,1),(11,NULL,'economic','Economic',0,1),(12,NULL,'dogs','Dogs',0,1),(13,NULL,'vegan','Vegan',0,1),(14,NULL,'family','Family',0,1),(15,NULL,'science','Science',0,3),(16,NULL,'modernity','Modernity',0,1),(17,NULL,'pop','Pop',0,1),(18,NULL,'social-issues','Social Issues',0,1),(19,NULL,'general','General',0,2),(20,NULL,'slice-of-life','Slice Of Life',0,1),(21,NULL,'marriage','Marriage',0,1),(22,NULL,'prose','Prose',0,1);
/*!40000 ALTER TABLE `tagging_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `stripe_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `card_brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `idx_users_name_email_bio` (`name`,`email`,`bio`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Nickolas Aleksandar Nikolic','subclass@gmail.com',NULL,'$2y$10$kYwgbGGk3lobovaM8EIPpO0Zylsj2T7f.xV8f4NQuMRQDV9L7J/XS',NULL,NULL,NULL,NULL,NULL,NULL,0,0,'2019-06-26 19:36:57','2019-06-26 19:36:57');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-26 13:45:00
