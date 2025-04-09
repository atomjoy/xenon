SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE IF NOT EXISTS `articles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `excerpt` varchar(255) DEFAULT NULL,
  `content_html` text DEFAULT NULL,
  `content_cleaned` text DEFAULT NULL,
  `meta_seo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta_seo`)),
  `schema_seo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`schema_seo`)),
  `views` bigint(20) UNSIGNED DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `articles_slug_unique` (`slug`),
  KEY `articles_admin_id_foreign` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `article_category` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `article_media` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `article_media_admin_id_foreign` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `about` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_category_id_foreign` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `content` varchar(500) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `is_approved` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `commentable_type` varchar(255) NOT NULL,
  `commentable_id` bigint(20) UNSIGNED NOT NULL,
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `reply_id` bigint(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_commentable_type_commentable_id_index` (`commentable_type`,`commentable_id`),
  KEY `comments_article_id_foreign` (`article_id`),
  KEY `comments_reply_id_foreign` (`reply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `note` text DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `ip` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `projects` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `excerpt` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `content_html` text DEFAULT NULL,
  `content_cleaned` text DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `client` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `views` bigint(20) UNSIGNED DEFAULT 0,
  `meta_seo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta_seo`)),
  `schema_seo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`schema_seo`)),
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `projects_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `projects` (`id`, `title`, `excerpt`, `image`, `slug`, `content_html`, `content_cleaned`, `tags`, `category`, `duration`, `client`, `code`, `views`, `meta_seo`, `schema_seo`, `published_at`, `created_at`, `updated_at`) VALUES
(2, 'Project 1', 'Krótki opis ...', 'projects/project-2.webp', 'project-web', '<h1>Długi opis</h1>', '<h1>Długi opis</h1>', 'website,ui design,seo', 'Web Development', '2 Year', 'Copa Cabana', NULL, 0, '\"[]\"', '\"[]\"', '2025-01-01 10:11:11', '2025-04-09 18:26:58', '2025-04-09 19:03:35'),
(3, 'Project 1', 'Krótki opis ...', 'projects/project-3.webp', 'project-11', '<h1>Długi opis</h1>', '<h1>Długi opis</h1>', 'website,ui design,seo', 'Web Development', '2 Year', 'Copa Cabana', NULL, 0, '\"[]\"', '\"[]\"', '2025-01-01 10:11:11', '2025-04-09 18:26:58', '2025-04-09 19:02:34'),
(4, 'Project 1', 'Krótki opis ...', 'projects/project-4.webp', 'project-web11', '<h1>Długi opis</h1>', '<h1>Długi opis</h1>', 'website,ui design,seo', 'Web Development', '2 Year', 'Copa Cabana', NULL, 0, '\"[]\"', '\"[]\"', '2025-01-01 10:11:11', '2025-04-09 18:26:58', '2025-04-09 19:02:11'),
(5, 'Project 1', 'Krótki opis ...', 'projects/project-5.webp', 'project-12', '<h1>Długi opis</h1>', '<h1>Długi opis</h1>', 'website,ui design,seo', 'Web Development', '2 Year', 'Copa Cabana', NULL, 0, '\"[]\"', '\"[]\"', '2025-01-01 10:11:11', '2025-04-09 18:26:58', '2025-04-09 18:38:19'),
(6, 'Project 1', 'Krótki opis ...', 'projects/project-6.webp', 'project-web2', '<h1>Długi opis</h1>', '<h1>Długi opis</h1>', 'website,ui design,seo', 'Web Development', '2 Year', 'Copa Cabana', NULL, 0, '\"[]\"', '\"[]\"', '2025-01-01 10:11:11', '2025-04-09 18:26:58', '2025-04-09 19:01:17'),
(7, 'Project 2', 'Krótki opis ...', 'projects/project-7.webp', 'project-112', '<h1>Długi opis</h1>', '<h1>Długi opis</h1>', 'website,ui design,seo', 'Web Development', '2 Year', 'Copa Cabana', NULL, 0, '\"[]\"', '\"[]\"', '2025-01-01 10:11:11', '2025-04-09 18:26:58', '2025-04-09 18:31:21'),
(8, 'Project 1', 'Krótki opis ...', 'projects/project-8.webp', 'project-web112', '<h1>Długi opis</h1>', '<h1>Długi opis</h1>', 'website,ui design,seo', 'Web Development', '2 Year', 'Copa Cabana', NULL, 0, '\"[]\"', '\"[]\"', '2025-01-01 10:11:11', '2025-04-09 18:26:58', '2025-04-09 19:01:00');

CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `excerpt` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content_html` text DEFAULT NULL,
  `content_cleaned` text DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `views` bigint(20) UNSIGNED DEFAULT 0,
  `meta_seo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta_seo`)),
  `schema_seo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`schema_seo`)),
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `services` (`id`, `title`, `excerpt`, `slug`, `image`, `content_html`, `content_cleaned`, `tags`, `views`, `meta_seo`, `schema_seo`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'Web Development', 'Krótki opis tutaj ...', 'web-dev', 'services/service-1.webp', '<h1>Jakiś opis tutaj ...</h1>\r\n<p>Jakiś opis tutaj ...</p>', '<h1>Jakiś opis tutaj ...</h1>\r\n<p>Jakiś opis tutaj ...</p>', 'React Js,Angular Js,Laravel, Vue Js', 0, '\"[]\"', '\"[]\"', '2025-01-01 21:22:22', '2025-04-09 16:28:46', '2025-04-09 18:41:30'),
(3, 'UX/UI Design', 'Krótki opis', 'ui-ux-design', 'services/service-3.webp', '<h1>Długi opis</h1>', '<h1>Długi opis</h1>', 'Visual Design,Prototyping,Wire Framing,Usability Testing', 0, '\"[]\"', '\"[]\"', '2025-01-01 10:11:22', '2025-04-09 18:43:22', '2025-04-09 18:59:34'),
(4, 'Graphics design', 'Krótki opis ...', 'graphics-design', 'services/service-4.webp', '<h1>Długi opis ...</h1>', '<h1>Długi opis ...</h1>', 'Packaging Design,Illustration,Print Design,Digital Design', 0, NULL, NULL, '2025-01-01 10:11:55', '2025-04-09 19:09:04', '2025-04-09 19:09:04'),
(5, 'Digital Marketing', 'Krótki opis ...', 'digital-marketing', 'services/service-5.webp', '<h1>Długi opis ...</h1>', '<h1>Długi opis ...</h1>', 'Email Marketing,Social Media,Search Engine Optimization', 0, NULL, NULL, '2025-01-01 10:22:44', '2025-04-09 19:11:04', '2025-04-09 19:11:05'),
(6, 'Mobile App Development', 'Krótki opis ...', 'mobile-app-dev', 'services/service-6.webp', '<h1>Długi opis ...</h1>', '<h1>Długi opis ...</h1>', 'Android App,iOS App,Flutter App, react Native', 0, NULL, NULL, '2025-01-01 10:22:33', '2025-04-09 19:12:44', '2025-04-09 19:12:44'),
(7, '3D Graphics', 'Krótki opis ...', '3d-graphics', 'services/service-7.webp', '<h1>Długi opis ... </h1>', '<h1>Długi opis ... </h1>', '3d Modeling,3d Rendering,Vizualizations', 0, NULL, NULL, '2025-01-01 10:22:22', '2025-04-09 19:14:33', '2025-04-09 19:14:35');

CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `is_approved` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscribers_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `tags` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_slug_article_id_unique` (`slug`,`article_id`),
  KEY `tags_article_id_foreign` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `articles`
  ADD CONSTRAINT `articles_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `article_media`
  ADD CONSTRAINT `article_media_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `categories`
  ADD CONSTRAINT `categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `comments`
  ADD CONSTRAINT `comments_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_reply_id_foreign` FOREIGN KEY (`reply_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tags`
  ADD CONSTRAINT `tags_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
