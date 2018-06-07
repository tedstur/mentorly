-- Mentor Match
-- Database setup script


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;

DROP TABLE IF EXISTS `wp_mentorly`;
CREATE TABLE IF NOT EXISTS `wp_mentorly` (
  `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mentorly_nicename` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `mentorly_email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `mentorly_phone`  varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
 -- possible status: 0: Active, 1: Inactive
  `mentorly_status` int(11) NOT NULL DEFAULT '0',
  `mentorly_display_name` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `mentorly_timezone` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `mentorly_role` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `mentorly_organization` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `mentorly_linkedin` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `mentorly_exp_years` int(11) NOT NULL DEFAULT '0',
  `mentorly_exp_months` int(11) NOT NULL DEFAULT '0',
  `mentorly_experience` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `mentorly_intensity` int(11) NOT NULL DEFAULT '0',
  `mentorly_lastupdated` 
-- the following items are only for mentees
  `mentorly_interest` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
-- the following items are only for mentors
  `mentorly_linkedin` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `mentorly_length_of_commitment` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  
  PRIMARY KEY (`ID`),
  KEY `mentorly_nicename` (`user_nicename`),
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

COMMIT;