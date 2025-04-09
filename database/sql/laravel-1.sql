-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2025 at 07:04 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `articles`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `admin_id`, `title`, `slug`, `image`, `excerpt`, `content_html`, `content_cleaned`, `meta_seo`, `schema_seo`, `views`, `created_at`, `updated_at`, `published_at`) VALUES
(1, 1, 'Improving Laravel Application Security with Aikido', 'cojest-nie-tak', 'articles/article-1.webp', 'xxxsssss', 'sfsdfsdfsdfsdfsdfsd', NULL, NULL, NULL, 0, '2025-03-17 16:55:10', '2025-03-17 16:55:10', NULL),
(2, 1, 'Enhancing Laravel Authorization with Backed Enums', 'laravel-enums', 'articles/article-6.webp', 'Games', 'Games', NULL, NULL, NULL, 0, '2025-03-17 19:49:51', '2025-03-17 19:49:51', NULL),
(3, 1, 'Working with Laravel\'s Uri Class for Enhanced URL Manipulation', 'url-manipulation', 'articles/article-3.webp', 'sss', 'sss', NULL, NULL, NULL, 0, '2025-03-17 20:11:44', '2025-03-17 20:11:44', NULL),
(4, 1, 'Laravel Cloud is live! Can you ship in 1 minute?', 'laravel-cloud-live', 'articles/article-4.webp', 'Today we shipped Laravel Cloud, Starter Kits (React, Vue, & Livewire), VS Code Extension, and Laravel 12.', 'Each Starter Kit provides the scaffolding for a Laravel app with authentication, a dashboard, and user profile settings. Choose from Laravel\'s built-in authentication or WorkOS, which supports social authentication, passkeys, and SSO. \r\n\r\nThey use Tailwind v4.0 + shadcn components for React & Vue, and newly open-sourced Flux components for Livewire.\r\nVS Code Extension\r\n\r\nWith 63,000 installs during beta, our official VS Code extension is stable with:\r\n\r\n- Blade syntax highlighting\r\n- Eloquent autocompletion\r\n- Route, config, and middleware linking\r\n- Smart diagnostics \r\n\r\n<code>\r\n<span style=\"color: red;\">Hello</span>\r\n<?php\r\n    echo \"hello from js\";\r\n\r\n    function hello() {\r\n        echo \"Boo\";\r\n    }\r\n?>\r\n</code>', NULL, NULL, NULL, 0, '2025-03-18 07:38:45', '2025-03-18 07:38:47', NULL),
(5, 1, 'Laravel Nova 5.0 Now Available', 'laravel-nova-5', 'articles/article-5.webp', 'Laravel Nova 5.0 is now ready for upgrade. This release focuses on modernizing Nova\'s core dependencies while introducing several useful features to improve resource management and field handling.', '<h1>Modernized Dependencies</h1>\r\n\r\nNova 5.0 updates its foundation by requiring PHP 8.1+ and dropping support for Laravel 8.x and 9.x. This allows Nova to take advantage of newer updates and features in the Laravel ecosystem such as:\r\n\r\n- Integration with Laravel Fortify, Prompts, and Pennant\r\n- Updated frontend stack with Vue 3.5 and Heroicons 2.x\r\n- Support for Inertia 2.x\r\n\r\n<h2>Tab Panels for Better Resource Organization</h2>\r\n\r\nNova 5.0 introduces Tab Panels, providing a cleaner way to organize fields and relationships on resource detail and form pages:\r\n\r\n<img class=\"article_image\" src=\"/img/category?path=articles/article-4.webp\" alt=\"Article image\">', '<h1>Modernized Dependencies</h1>\r\n\r\nNova 5.0 updates its foundation by requiring PHP 8.1+ and dropping support for Laravel 8.x and 9.x. This allows Nova to take advantage of newer updates and features in the Laravel ecosystem such as:\r\n\r\n- Integration with Laravel Fortify, Prompts, and Pennant\r\n- Updated frontend stack with Vue 3.5 and Heroicons 2.x\r\n- Support for Inertia 2.x\r\n\r\n<h2>Tab Panels for Better Resource Organization</h2>\r\n\r\nNova 5.0 introduces Tab Panels, providing a cleaner way to organize fields and relationships>', '[\r\n    {\r\n        \"attribute\": \"property\",\r\n        \"value\": \"og:title\",\r\n        \"content\": \"Foka Corp\"\r\n    },\r\n    {\r\n        \"attribute\": \"name\",\r\n        \"value\": \"keywords\",\r\n        \"content\": \"blog\"\r\n    }\r\n]', '[\r\n    {\r\n        \"@context\": \"https://schema.org\",\r\n        \"@type\": \"WebPage\",\r\n        \"name\": \"Foka Corp\",\r\n        \"url\": \"https://example.com\"\r\n    },\r\n    {\r\n        \"@context\": \"https://schema.org\",\r\n        \"@type\": \"Article\",\r\n        \"mainEntityOfPage\": {\r\n            \"@type\": \"WebPage\",\r\n            \"@id\": \"https://example.com/knowledge/deployment/\"\r\n        },\r\n        \"headline\": \"What is Deployment?\",\r\n        \"description\": \"Software and web development with <p>tags probably</p> ...\",\r\n        \"image\": \"https://example.com/media/knowledge/deployment.png\",\r\n        \"author\": {\r\n            \"@type\": \"Organization\",\r\n            \"name\": \"Example\"\r\n        },\r\n        \"publisher\": {\r\n            \"@type\": \"Organization\",\r\n            \"name\": \"Example\",\r\n            \"logo\": {\r\n                \"@type\": \"ImageObject\",\r\n                \"url\": \"https://example.com/media/social/example_social_og.png\"\r\n            }\r\n        },\r\n        \"datePublished\": \"2023-01-01\",\r\n        \"dateModified\": \"2025-01-21\"\r\n    }\r\n]', 0, '2025-03-18 07:54:13', '2025-03-19 16:01:31', NULL),
(6, 1, 'Improving Laravel Application Security with Aikido', 'improving-laravel', 'articles/article-6.webp', 'As your Laravel application grows, managing security objectives becomes more challenging, especially for small teams or solo developers. Today, Laravel has teamed up with Aikido to provide a seamless solution for securing your Laravel application.', '<h2>\r\n	<a href=\"https://cloud.laravel.com/sign-up\">Laravel Cloud</a>\r\n</h2>\r\n\r\n<p>You\'re 60 seconds from deploying your first Laravel application without managing servers. Learn more or <a href=\"https://cloud.laravel.com/\">try it now</a>.</p>\r\n\r\n<h3>Allowed tags</h3>\r\n<p> You can disable allowed tags in <strong>App\\Validate\\Html::allowedTags()</strong></p>\r\n\r\n\r\n<div class=\"article_image\">\r\n	<img width=\"100%\" src=\"https://laravel-blog-assets.s3.amazonaws.com/s69JkiLOvEVIp0JiJjEV6V9JzilFsCfxYMuM6m2o.png\">\r\n</div>\r\n\r\n<ul>\r\n	<li>Automatic autoscaling and hibernation</li>\r\n	<li>One-click databases, caching, and storage (Postgres today; MySQL very soon)</li>\r\n	<li>Built-in DDoS, SSL, CDN, and edge caching</li>\r\n	<li>laravel.cloud domains as preview URLs for every environment</li>\r\n</ul>\r\n\r\n<h2>\r\n	<a href=\"https://cloud.laravel.com/sign-in\">Starter Kits</a>\r\n</h2>\r\n\r\n<p>We\'ve completely rebuilt our Starter Kits, making it easy to go from idea to app with Laravel and React, Vue, or Livewire. <a href=\"/\">Get started here</a>.</p>\r\n\r\n<div class=\"article_image\">\r\n	<img width=\"100%\" src=\"https://laravel-blog-assets.s3.amazonaws.com/tUyrtzSiw8Z7PWRsuRuMfYzs1LPm1E9xubbOcTwk.png\">\r\n</div>\r\n\r\n<p>Each Starter Kit provides the scaffolding for a Laravel app with authentication, a dashboard, and user profile settings. Choose from Laravel\'s built-in authentication or WorkOS, which supports social authentication, passkeys, and SSO. </p>\r\n\r\n<p>They use Tailwind v4.0 + shadcn components for React & Vue, and newly open-sourced Flux components for Livewire.</p>\r\n\r\n<h2>\r\n	<a href=\"https://cloud.laravel.com/sign-in\">VS Code Extension</a>\r\n</h2>\r\n\r\n<p>With 63,000 installs during beta, our official VS Code extension is stable with:</p>\r\n\r\n<ul>\r\n	<li>Blade syntax highlighting</li>\r\n	<li>Eloquent autocompletion</li>\r\n	<li>Route, config, and middleware linking</li>\r\n	<li>Smart diagnostics <a href=\"/\">Cloud vs Forge</a> & <a href=\"/\">Cloud vs Vapor</a> videos</li>\r\n</ul>\r\n\r\n<h2>Code injection test</h2>\r\n\r\n<h3>Js alert test</h3>\r\n\r\n<div style=\"color: orange;\" onclick=\"alert(\'Click alert\')\">Click Me!</div>\r\n\r\n<div style=\"color: green;\" onload=\"alert(\'Click alert\')\">Click Me!</div>\r\n\r\n<script>alert(\"Script alert\");</script>\r\n\r\n<script src=\"main.js\">alert(\"boom\")</script>\r\n\r\n<script type=\"text/javascript\">alert(document.cookie)</script>\r\n\r\n<h3>Code php</h3>\r\n\r\n<pre>\r\n	<code wow=\"error\">\r\n	<span style=\"color: red;\">Hello</span>\r\n	<?php\r\n		echo \"hello from js\";\r\n		function hello() {\r\n			echo \"Boo\";\r\n		}\r\n	?>\r\n	</code>\r\n	</pre>\r\n\r\n<p>And inline code sample <code>.active {color: #f96;}</code> works .... </p>\r\n\r\n<h3>Strong, small, sup, sub tags</h3>\r\n\r\n<p><strong> Strong text</strong> and <small>small text</small> working too.</p>\r\n\r\n<p>Wow <sup>SUP</sup> and <sub>SUB</sub> works maybe <span style=\"color: red;\">span tag</span> works</p>\r\n\r\n<h3>Inline style in tags</h3>\r\n\r\n<p style=\"float: left; padding: 20px; background: #ffff00; color: #010101;font-family:consolas;font-size:16px;\">Lorem ipsum dolor <strong>sit amet consectetur</strong>, adipisicing elit. Laborum impedit obcaecati labore facilis beatae odio consequuntur cumque laudantium, maxime cupiditate architecto, eligendi autem. Error ipsa, eum molestiae distinctio incidunt eos?</p>\r\n\r\n<h3>Pre code again</h3>\r\n\r\n<pre>\r\n	<code>\r\n	<span style=\"color: green;\">Bye!</span>\r\n	<?php\r\n		echo \"hello from js\";\r\n\r\n		function hello() {\r\n			echo \"Woo\";\r\n		}\r\n	?>\r\n	</code>\r\n	</pre>\r\n\r\n<h3>Php injection test</h3>\r\necho \"Works fine\";\r\n\r\n<?php\r\n	echo \"Not working ... ok\";\r\n\r\n	function hello() {\r\n		echo \"Not working ... ok\";\r\n		}\r\n	?>\r\n\r\n<h3>HTML References</h3>\r\n\r\n<p>The <abbr title=\"World Health Organization\">WHO</abbr> was founded in 1948.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet <small>This is some smaller text.</small> consectetur adipisicing elit. Voluptates amet doloribus mollitia enim ab? Vero aspernatur at provident officia voluptates soluta assumenda nam dolorum aperiam, <strong>dolor debitis voluptatum sequi</strong> in.</p>\r\n\r\n<p>This text contains <sup>sup-script</sup> text <sub>sub-script</sub>.</p>\r\n\r\n<h3>HTML Quotes</h3>\r\n\r\n<q>Build a future where people live in harmony with nature.</q>\r\n\r\n<blockquote cite=\"http://www.worldwildlife.org/who/index.html\" style=\"border-left: 5px solid #09f; padding-left: 20px;\">\r\n	For 50 years, WWF has been protecting the future of nature. The world\'s leading conservation organization, WWF works in 100 countries and is supported by 1.2 million members in the United States and close to 5 million globally.\r\n</blockquote>\r\n\r\n<h3>The ol element</h3>\r\n\r\n<ol>\r\n	<li>Coffee</li>\r\n	<li>Tea</li>\r\n	<li>Milk</li>\r\n</ol>\r\n\r\n<ol start=\"50\">\r\n	<li>Coffee</li>\r\n	<li>Tea</li>\r\n	<li>Milk</li>\r\n</ol>\r\n\r\n<h3>And html table with css style tag</h3>\r\n\r\n<table>\r\n	<caption>\r\n		Front-end web developer course 2021\r\n	</caption>\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\">Person</th>\r\n			<th scope=\"col\">Most interest in</th>\r\n			<th scope=\"col\">Age</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<th scope=\"row\">Chris</th>\r\n			<td>HTML tables</td>\r\n			<td>22</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Dennis</th>\r\n			<td>Web accessibility</td>\r\n			<td>45</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Sarah</th>\r\n			<td>JavaScript frameworks</td>\r\n			<td>29</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Karen</th>\r\n			<td>Web performance</td>\r\n			<td>36</td>\r\n		</tr>\r\n	</tbody>\r\n	<tfoot>\r\n		<tr>\r\n			<th scope=\"row\" colspan=\"2\">Average age</th>\r\n			<td>33</td>\r\n		</tr>\r\n	</tfoot>\r\n</table>\r\n\r\n<h3>Html iframe</h3>\r\n\r\n<iframe width=\"100%\" height=\"400\" src=\"https://www.youtube.com/embed/zIjPoj8a4Ko?si=yysAQlys2osASdy_\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>\r\n\r\n<!--  Html 5 elements -->\r\n\r\n<h3>Html picture tag</h3>\r\n\r\n<picture>\r\n	<source media=\"(min-width:650px)\" srcset=\"https://www.w3schools.com/tags/img_pink_flowers.jpg\">\r\n	<source media=\"(min-width:465px)\" srcset=\"https://www.w3schools.com/tags/img_white_flower.jpg\">\r\n	<img src=\"https://www.w3schools.com/tags/img_orange_flowers.jpg\" alt=\"Flowers\" style=\"width:auto;\">\r\n</picture>\r\n\r\n<h3>Html video tag</h3>\r\n\r\n<video width=\"400\" controls>\r\n	<source src=\"https://www.w3schools.com/html/mov_bbb.mp4\" type=\"video/mp4\">\r\n	<source src=\"https://www.w3schools.com/html/mov_bbb.ogg\" type=\"video/ogg\">\r\n	Your browser does not support HTML video.\r\n</video>\r\n\r\n<h3>Html audio tag</h3>\r\n\r\n<audio controls>\r\n	<source src=\"https://www.w3schools.com/html/horse.ogg\" type=\"audio/ogg\">\r\n	<source src=\"https://www.w3schools.com/html/horse.mp3\" type=\"audio/mpeg\">\r\n	Your browser does not support the audio element.\r\n</audio>\r\n\r\n<h3> Style for table</h3>\r\n\r\n<style>\r\n	table {\r\n		width: 100%;\r\n		border-collapse: collapse;\r\n		border: 1px solid #000;\r\n		font-family: sans-serif;\r\n		font-size: 0.8rem;\r\n		letter-spacing: 1px;\r\n	}\r\n\r\n	caption {\r\n		caption-side: bottom;\r\n		padding: 10px;\r\n		font-weight: bold;\r\n	}\r\n\r\n	thead,\r\n	tfoot {\r\n		background-color: #f3f3f3;\r\n	}\r\n\r\n	th,\r\n	td {\r\n		border: 1px solid #999;\r\n		padding: 8px 10px;\r\n	}\r\n\r\n	td:last-of-type {\r\n		text-align: center;\r\n	}\r\n\r\n	tbody>tr:nth-of-type(even) {\r\n		background-color: #fafafa;\r\n	}\r\n\r\n	tfoot th {\r\n		text-align: right;\r\n	}\r\n\r\n	tfoot td {\r\n		font-weight: bold;\r\n	}\r\n</style>', '<h2>\r\n	<a href=\"https://cloud.laravel.com/sign-up\">Laravel Cloud</a>\r\n</h2>\r\n\r\n<p>You\'re 60 seconds from deploying your first Laravel application without managing servers. Learn more or <a href=\"https://cloud.laravel.com/\">try it now</a>.</p>\r\n\r\n<h3>Allowed tags</h3>\r\n<p> You can disable allowed tags in <strong>App\\Validate\\Html::allowedTags()</strong></p>\r\n\r\n\r\n<div class=\"article_image\">\r\n	<img width=\"100%\" src=\"https://laravel-blog-assets.s3.amazonaws.com/s69JkiLOvEVIp0JiJjEV6V9JzilFsCfxYMuM6m2o.png\">\r\n</div>\r\n\r\n<ul>\r\n	<li>Automatic autoscaling and hibernation</li>\r\n	<li>One-click databases, caching, and storage (Postgres today; MySQL very soon)</li>\r\n	<li>Built-in DDoS, SSL, CDN, and edge caching</li>\r\n	<li>laravel.cloud domains as preview URLs for every environment</li>\r\n</ul>\r\n\r\n<h2>\r\n	<a href=\"https://cloud.laravel.com/sign-in\">Starter Kits</a>\r\n</h2>\r\n\r\n<p>We\'ve completely rebuilt our Starter Kits, making it easy to go from idea to app with Laravel and React, Vue, or Livewire. <a href=\"/\">Get started here</a>.</p>\r\n\r\n<div class=\"article_image\">\r\n	<img width=\"100%\" src=\"https://laravel-blog-assets.s3.amazonaws.com/tUyrtzSiw8Z7PWRsuRuMfYzs1LPm1E9xubbOcTwk.png\">\r\n</div>\r\n\r\n<p>Each Starter Kit provides the scaffolding for a Laravel app with authentication, a dashboard, and user profile settings. Choose from Laravel\'s built-in authentication or WorkOS, which supports social authentication, passkeys, and SSO. </p>\r\n\r\n<p>They use Tailwind v4.0 + shadcn components for React & Vue, and newly open-sourced Flux components for Livewire.</p>\r\n\r\n<h2>\r\n	<a href=\"https://cloud.laravel.com/sign-in\">VS Code Extension</a>\r\n</h2>\r\n\r\n<p>With 63,000 installs during beta, our official VS Code extension is stable with:</p>\r\n\r\n<ul>\r\n	<li>Blade syntax highlighting</li>\r\n	<li>Eloquent autocompletion</li>\r\n	<li>Route, config, and middleware linking</li>\r\n	<li>Smart diagnostics <a href=\"/\">Cloud vs Forge</a> & <a href=\"/\">Cloud vs Vapor</a> videos</li>\r\n</ul>\r\n\r\n<h2>Code injection test</h2>\r\n\r\n<h3>Js alert test</h3>\r\n\r\n<div style=\"color: orange;\">Click Me!</div>\r\n\r\n<div style=\"color: green;\">Click Me!</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<h3>Code php</h3>\r\n\r\n<pre>\r\n	<code class=\"highlight_code\">\r\n	&lt;span style=&quot;color: red;&quot;&gt;Hello&lt;/span&gt;\r\n	&lt;?php\r\n		echo &quot;hello from js&quot;;\r\n		function hello() {\r\n			echo &quot;Boo&quot;;\r\n		}\r\n	?&gt;\r\n	</code>\r\n	</pre>\r\n\r\n<p>And inline code sample <code class=\"highlight_code\">.active {color: #f96;}</code> works .... </p>\r\n\r\n<h3>Strong, small, sup, sub tags</h3>\r\n\r\n<p><strong> Strong text</strong> and <small>small text</small> working too.</p>\r\n\r\n<p>Wow <sup>SUP</sup> and <sub>SUB</sub> works maybe <span style=\"color: red;\">span tag</span> works</p>\r\n\r\n<h3>Inline style in tags</h3>\r\n\r\n<p style=\"float: left; padding: 20px; background: #ffff00; color: #010101;font-family:consolas;font-size:16px;\">Lorem ipsum dolor <strong>sit amet consectetur</strong>, adipisicing elit. Laborum impedit obcaecati labore facilis beatae odio consequuntur cumque laudantium, maxime cupiditate architecto, eligendi autem. Error ipsa, eum molestiae distinctio incidunt eos?</p>\r\n\r\n<h3>Pre code again</h3>\r\n\r\n<pre>\r\n	<code class=\"highlight_code\">\r\n	&lt;span style=&quot;color: green;&quot;&gt;Bye!&lt;/span&gt;\r\n	&lt;?php\r\n		echo &quot;hello from js&quot;;\r\n\r\n		function hello() {\r\n			echo &quot;Woo&quot;;\r\n		}\r\n	?&gt;\r\n	</code>\r\n	</pre>\r\n\r\n<h3>Php injection test</h3>\r\necho \"Works fine\";\r\n\r\n\r\n\r\n<h3>HTML References</h3>\r\n\r\n<p>The <abbr title=\"World Health Organization\">WHO</abbr> was founded in 1948.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet <small>This is some smaller text.</small> consectetur adipisicing elit. Voluptates amet doloribus mollitia enim ab? Vero aspernatur at provident officia voluptates soluta assumenda nam dolorum aperiam, <strong>dolor debitis voluptatum sequi</strong> in.</p>\r\n\r\n<p>This text contains <sup>sup-script</sup> text <sub>sub-script</sub>.</p>\r\n\r\n<h3>HTML Quotes</h3>\r\n\r\n<q>Build a future where people live in harmony with nature.</q>\r\n\r\n<blockquote cite=\"http://www.worldwildlife.org/who/index.html\" style=\"border-left: 5px solid #09f; padding-left: 20px;\">\r\n	For 50 years, WWF has been protecting the future of nature. The world\'s leading conservation organization, WWF works in 100 countries and is supported by 1.2 million members in the United States and close to 5 million globally.\r\n</blockquote>\r\n\r\n<h3>The ol element</h3>\r\n\r\n<ol>\r\n	<li>Coffee</li>\r\n	<li>Tea</li>\r\n	<li>Milk</li>\r\n</ol>\r\n\r\n<ol start=\"50\">\r\n	<li>Coffee</li>\r\n	<li>Tea</li>\r\n	<li>Milk</li>\r\n</ol>\r\n\r\n<h3>And html table with css style tag</h3>\r\n\r\n<table>\r\n	<caption>\r\n		Front-end web developer course 2021\r\n	</caption>\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\">Person</th>\r\n			<th scope=\"col\">Most interest in</th>\r\n			<th scope=\"col\">Age</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<th scope=\"row\">Chris</th>\r\n			<td>HTML tables</td>\r\n			<td>22</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Dennis</th>\r\n			<td>Web accessibility</td>\r\n			<td>45</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Sarah</th>\r\n			<td>JavaScript frameworks</td>\r\n			<td>29</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Karen</th>\r\n			<td>Web performance</td>\r\n			<td>36</td>\r\n		</tr>\r\n	</tbody>\r\n	<tfoot>\r\n		<tr>\r\n			<th scope=\"row\" colspan=\"2\">Average age</th>\r\n			<td>33</td>\r\n		</tr>\r\n	</tfoot>\r\n</table>\r\n\r\n<h3>Html iframe</h3>\r\n\r\n<iframe width=\"100%\" height=\"400\" src=\"https://www.youtube.com/embed/zIjPoj8a4Ko?si=yysAQlys2osASdy_\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>\r\n\r\n\r\n\r\n<h3>Html picture tag</h3>\r\n\r\n<picture>\r\n	<source media=\"(min-width:650px)\" srcset=\"https://www.w3schools.com/tags/img_pink_flowers.jpg\">\r\n	<source media=\"(min-width:465px)\" srcset=\"https://www.w3schools.com/tags/img_white_flower.jpg\">\r\n	<img src=\"https://www.w3schools.com/tags/img_orange_flowers.jpg\" alt=\"Flowers\" style=\"width:auto;\">\r\n</picture>\r\n\r\n<h3>Html video tag</h3>\r\n\r\n<video width=\"400\" controls>\r\n	<source src=\"https://www.w3schools.com/html/mov_bbb.mp4\" type=\"video/mp4\">\r\n	<source src=\"https://www.w3schools.com/html/mov_bbb.ogg\" type=\"video/ogg\">\r\n	Your browser does not support HTML video.\r\n</video>\r\n\r\n<h3>Html audio tag</h3>\r\n\r\n<audio controls>\r\n	<source src=\"https://www.w3schools.com/html/horse.ogg\" type=\"audio/ogg\">\r\n	<source src=\"https://www.w3schools.com/html/horse.mp3\" type=\"audio/mpeg\">\r\n	Your browser does not support the audio element.\r\n</audio>\r\n\r\n<h3> Style for table</h3>\r\n\r\n<style>\r\n	table {\r\n		width: 100%;\r\n		border-collapse: collapse;\r\n		border: 1px solid #000;\r\n		font-family: sans-serif;\r\n		font-size: 0.8rem;\r\n		letter-spacing: 1px;\r\n	}\r\n\r\n	caption {\r\n		caption-side: bottom;\r\n		padding: 10px;\r\n		font-weight: bold;\r\n	}\r\n\r\n	thead,\r\n	tfoot {\r\n		background-color: #f3f3f3;\r\n	}\r\n\r\n	th,\r\n	td {\r\n		border: 1px solid #999;\r\n		padding: 8px 10px;\r\n	}\r\n\r\n	td:last-of-type {\r\n		text-align: center;\r\n	}\r\n\r\n	tbody>tr:nth-of-type(even) {\r\n		background-color: #fafafa;\r\n	}\r\n\r\n	tfoot th {\r\n		text-align: right;\r\n	}\r\n\r\n	tfoot td {\r\n		font-weight: bold;\r\n	}\r\n</style>', '[\r\n    {\r\n        \"attribute\": \"property\",\r\n        \"value\": \"og:title\",\r\n        \"content\": \"Foka Corp\"\r\n    },\r\n    {\r\n        \"attribute\": \"name\",\r\n        \"value\": \"keywords\",\r\n        \"content\": \"blog\"\r\n    }\r\n]', '[\r\n    {\r\n        \"@context\": \"https://schema.org\",\r\n        \"@type\": \"WebPage\",\r\n        \"name\": \"Foka Corp\",\r\n        \"url\": \"https://example.com\"\r\n    },\r\n    {\r\n        \"@context\": \"https://schema.org\",\r\n        \"@type\": \"Article\",\r\n        \"mainEntityOfPage\": {\r\n            \"@type\": \"WebPage\",\r\n            \"@id\": \"https://example.com/knowledge/deployment/\"\r\n        },\r\n        \"headline\": \"What is Deployment?\",\r\n        \"description\": \"Software and web development with <p>tags probably</p> ...\",\r\n        \"image\": \"https://example.com/media/knowledge/deployment.png\",\r\n        \"author\": {\r\n            \"@type\": \"Organization\",\r\n            \"name\": \"Example\"\r\n        },\r\n        \"publisher\": {\r\n            \"@type\": \"Organization\",\r\n            \"name\": \"Example\",\r\n            \"logo\": {\r\n                \"@type\": \"ImageObject\",\r\n                \"url\": \"https://example.com/media/social/example_social_og.png\"\r\n            }\r\n        },\r\n        \"datePublished\": \"2023-01-01\",\r\n        \"dateModified\": \"2025-01-21\"\r\n    }\r\n]', 0, '2025-03-18 08:01:26', '2025-03-19 16:53:48', '2025-01-01 21:22:22');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `article_category`
--

CREATE TABLE IF NOT EXISTS `article_category` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article_category`
--

INSERT INTO `article_category` (`id`, `article_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, NULL),
(2, 3, 1, NULL, NULL),
(3, 4, 1, NULL, NULL),
(4, 5, 1, NULL, NULL),
(7, 2, 2, NULL, NULL),
(8, 1, 2, NULL, NULL),
(10, 6, 1, NULL, NULL),
(11, 6, 2, NULL, NULL),
(12, 8, 2, NULL, NULL),
(13, 8, 1, NULL, NULL),
(14, 9, 2, NULL, NULL),
(15, 9, 1, NULL, NULL),
(16, 10, 2, NULL, NULL),
(17, 10, 1, NULL, NULL),
(18, 11, 2, NULL, NULL),
(19, 11, 1, NULL, NULL),
(20, 12, 2, NULL, NULL),
(21, 12, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_id`, `name`, `slug`, `about`, `image`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Blog', 'blog', 'Blog', 'category/1.webp', '2025-03-17 19:47:04', '2025-03-18 10:08:19'),
(2, 1, 'Vue3', 'vue3', 'Vue 3 programing.', 'category/2.webp', '2025-03-18 12:33:20', '2025-03-18 15:02:32');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
