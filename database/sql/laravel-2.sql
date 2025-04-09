-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2025 at 02:43 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `admin_id`, `title`, `slug`, `image`, `excerpt`, `content_html`, `content_cleaned`, `meta_seo`, `schema_seo`, `views`, `created_at`, `updated_at`, `published_at`) VALUES
(1, 1, 'Improving Laravel Application Security with Aikido', 'application-security', 'articles/article-1.webp', 'As your Laravel application grows, managing security objectives becomes more challenging, especially for small teams or solo developers. Today, Laravel has teamed up with Aikido to provide a seamless solution for securing your Laravel application.', 'As your Laravel application grows, managing security objectives becomes more challenging, especially for small teams or solo developers. Today, Laravel has teamed up with Aikido to provide a seamless solution for securing your Laravel application.', 'As your Laravel application grows, managing security objectives becomes more challenging, especially for small teams or solo developers. Today, Laravel has teamed up with Aikido to provide a seamless solution for securing your Laravel application.', '[\r\n    {\r\n        \"attribute\": \"property\",\r\n        \"value\": \"og:title\",\r\n        \"content\": \"Foka Corp\"\r\n    },\r\n    {\r\n        \"attribute\": \"name\",\r\n        \"value\": \"keywords\",\r\n        \"content\": \"blog\"\r\n    }\r\n]', '[\r\n    {\r\n        \"@context\": \"https://schema.org\",\r\n        \"@type\": \"WebPage\",\r\n        \"name\": \"Foka Corp\",\r\n        \"url\": \"https://example.com\"\r\n    },\r\n    {\r\n        \"@context\": \"https://schema.org\",\r\n        \"@type\": \"Article\",\r\n        \"mainEntityOfPage\": {\r\n            \"@type\": \"WebPage\",\r\n            \"@id\": \"https://example.com/knowledge/deployment/\"\r\n        },\r\n        \"headline\": \"What is Deployment?\",\r\n        \"description\": \"Software and web development with <p>tags probably</p> ...\",\r\n        \"image\": \"https://example.com/media/knowledge/deployment.png\",\r\n        \"author\": {\r\n            \"@type\": \"Organization\",\r\n            \"name\": \"Example\"\r\n        },\r\n        \"publisher\": {\r\n            \"@type\": \"Organization\",\r\n            \"name\": \"Example\",\r\n            \"logo\": {\r\n                \"@type\": \"ImageObject\",\r\n                \"url\": \"https://example.com/media/social/example_social_og.png\"\r\n            }\r\n        },\r\n        \"datePublished\": \"2023-01-01\",\r\n        \"dateModified\": \"2025-01-21\"\r\n    }\r\n]', 3, '2025-03-17 16:55:10', '2025-03-25 18:40:28', '2025-02-11 21:22:22'),
(2, 1, 'Enhancing Laravel Authorization with Backed Enums', 'laravel-enums', 'articles/article-6.webp', 'As your Laravel application grows, managing security objectives becomes more challenging, especially for small teams or solo developers. Today, Laravel has teamed up with Aikido to provide a seamless solution for securing your Laravel application.', 'Games', 'Games', NULL, NULL, 2, '2025-03-17 19:49:51', '2025-03-25 18:30:59', '2025-02-11 21:22:22'),
(3, 1, 'Working with Laravel\'s Uri Class for Enhanced URL Manipulation', 'url-manipulation', 'articles/article-3.webp', 'This release focuses on modernizing Nova\'s core dependencies while introducing several useful features to improve resource management and field handling.', 'This release focuses on modernizing Nova\'s core dependencies while introducing several useful features to improve resource management and field handling.', 'This release focuses on modernizing Nova\'s core dependencies while introducing several useful features to improve resource management and field handling.', NULL, NULL, 111, '2025-03-17 20:11:44', '2025-03-26 11:48:34', '2025-02-11 21:22:22'),
(4, 1, 'Laravel Cloud is live! Can you ship in 1 minute?', 'laravel-cloud-live', 'articles/article-4.webp', 'Today we shipped Laravel Cloud, Starter Kits (React, Vue, & Livewire), VS Code Extension, and Laravel 12.', '<h2> Starter Kit</h2>\r\n\r\n<p>Each Starter Kit provides the scaffolding for a Laravel app with authentication, a dashboard, and user profile settings. Choose from Laravel\'s built-in authentication or WorkOS, which supports social authentication, passkeys, and SSO.</p>\r\n\r\n<p>They use Tailwind v4.0 + shadcn components for React & Vue, and newly open-sourced Flux components for Livewire.\r\nVS Code Extension</p>\r\n\r\n<p>With 63,000 installs during beta, our official VS Code extension is stable with:</p>\r\n\r\n<ul>\r\n<li> Blade syntax highlighting</li>\r\n<li> Eloquent autocompletion</li>\r\n<li> Route, config, and middleware linking</li>\r\n<li> Smart diagnostics</li>\r\n</ul>\r\n\r\n<h2> <a href=\"/article/6\">See code</a> </h2>\r\n<pre>\r\n<code>\r\n<span style=\"color: red;\">Hello</span>\r\n<?php\r\n    echo \"hello from js\";\r\n\r\n    function hello() {\r\n        echo \"Boo\";\r\n    }\r\n?>\r\n</code>\r\n</pre>\r\n\r\n<h2> Node panel</2>\r\n\r\n<img src=\"https://laravel-blog-assets.s3.amazonaws.com/s69JkiLOvEVIp0JiJjEV6V9JzilFsCfxYMuM6m2o.png\" class=\"blog_article_img\">', '<h2> Starter Kit</h2>\r\n\r\n<p>Each Starter Kit provides the scaffolding for a Laravel app with authentication, a dashboard, and user profile settings. Choose from Laravel\'s built-in authentication or WorkOS, which supports social authentication, passkeys, and SSO.</p>\r\n\r\n<p>They use Tailwind v4.0 + shadcn components for React & Vue, and newly open-sourced Flux components for Livewire.\r\nVS Code Extension</p>\r\n\r\n<p>With 63,000 installs during beta, our official VS Code extension is stable with:</p>\r\n\r\n<ul>\r\n<li> Blade syntax highlighting</li>\r\n<li> Eloquent autocompletion</li>\r\n<li> Route, config, and middleware linking</li>\r\n<li> Smart diagnostics</li>\r\n</ul>\r\n\r\n<h2> <a href=\"/article/6\">See code</a> </h2>\r\n<pre>\r\n<code class=\"highlight_code\">\r\n&lt;span style=&quot;color: red;&quot;&gt;Hello&lt;/span&gt;\r\n&lt;?php\r\n    echo &quot;hello from js&quot;;\r\n\r\n    function hello() {\r\n        echo &quot;Boo&quot;;\r\n    }\r\n?&gt;\r\n</code>\r\n</pre>\r\n\r\n<h2> Node panel\r\n\r\n<img src=\"https://laravel-blog-assets.s3.amazonaws.com/s69JkiLOvEVIp0JiJjEV6V9JzilFsCfxYMuM6m2o.png\" class=\"blog_article_img\">', NULL, NULL, 6, '2025-03-18 07:38:45', '2025-03-25 17:07:46', '2025-03-02 14:45:37'),
(5, 1, 'Laravel Nova 5.0 Now Available', 'laravel-nova-5', 'articles/article-5.webp', 'Laravel Nova 5.0 is now ready for upgrade. This release focuses on modernizing Nova\'s core dependencies while introducing several useful features to improve resource management and field handling.', '<h2>Modernized Dependencies</h2>\r\n\r\nNova 5.0 updates its foundation by requiring PHP 8.1+ and dropping support for Laravel 8.x and 9.x. This allows Nova to take advantage of newer updates and features in the Laravel ecosystem such as:\r\n\r\n<ul>\r\n<li>Integration with Laravel Fortify, Prompts, and Pennant</li>\r\n<li>Updated frontend stack with Vue 3.5 and Heroicons 2.x</li>\r\n<li>Support for Inertia 2.x</li>\r\n</ul>\r\n\r\n<h2>Tab Panels for Better Resource Organization</h2>\r\n\r\n<p>Nova 5.0 introduces Tab Panels, providing a cleaner way to organize fields and on relationships resource detail and form pages:</p>\r\n\r\n<img src=\"/img/show?path=articles/article-5.webp\" alt=\"Article image\" class=\"article_image\">', '<h2>Modernized Dependencies</h2>\r\n\r\nNova 5.0 updates its foundation by requiring PHP 8.1+ and dropping support for Laravel 8.x and 9.x. This allows Nova to take advantage of newer updates and features in the Laravel ecosystem such as:\r\n\r\n<ul>\r\n<li>Integration with Laravel Fortify, Prompts, and Pennant</li>\r\n<li>Updated frontend stack with Vue 3.5 and Heroicons 2.x</li>\r\n<li>Support for Inertia 2.x</li>\r\n</ul>\r\n\r\n<h2>Tab Panels for Better Resource Organization</h2>\r\n\r\n<p>Nova 5.0 introduces Tab Panels, providing a cleaner way to organize fields and on relationships resource detail and form pages:</p>\r\n\r\n<img src=\"/img/show?path=articles/article-5.webp\" alt=\"Article image\" class=\"article_image\">', '[\r\n    {\r\n        \"attribute\": \"property\",\r\n        \"value\": \"og:title\",\r\n        \"content\": \"Foka Corp\"\r\n    },\r\n    {\r\n        \"attribute\": \"name\",\r\n        \"value\": \"keywords\",\r\n        \"content\": \"blog\"\r\n    }\r\n]', '[\r\n    {\r\n        \"@context\": \"https://schema.org\",\r\n        \"@type\": \"WebPage\",\r\n        \"name\": \"Foka Corp\",\r\n        \"url\": \"https://example.com\"\r\n    },\r\n    {\r\n        \"@context\": \"https://schema.org\",\r\n        \"@type\": \"Article\",\r\n        \"mainEntityOfPage\": {\r\n            \"@type\": \"WebPage\",\r\n            \"@id\": \"https://example.com/knowledge/deployment/\"\r\n        },\r\n        \"headline\": \"What is Deployment?\",\r\n        \"description\": \"Software and web development with <p>tags probably</p> ...\",\r\n        \"image\": \"https://example.com/media/knowledge/deployment.png\",\r\n        \"author\": {\r\n            \"@type\": \"Organization\",\r\n            \"name\": \"Example\"\r\n        },\r\n        \"publisher\": {\r\n            \"@type\": \"Organization\",\r\n            \"name\": \"Example\",\r\n            \"logo\": {\r\n                \"@type\": \"ImageObject\",\r\n                \"url\": \"https://example.com/media/social/example_social_og.png\"\r\n            }\r\n        },\r\n        \"datePublished\": \"2023-01-01\",\r\n        \"dateModified\": \"2025-01-21\"\r\n    }\r\n]', 42, '2025-03-18 07:54:13', '2025-03-25 18:40:14', '2025-02-11 21:22:22'),
(6, 1, 'Improving Laravel Application Security with Aikido', 'improving-laravel', 'articles/article-6.webp', 'As your Laravel application grows, managing security objectives becomes more challenging, especially for small teams or solo developers. Today, Laravel has teamed up with Aikido to provide a seamless solution for securing your Laravel application.', '<!--\r\nAdd to page header\r\n<link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">\r\n	<link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>\r\n	<link href=\"https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Merriweather:ital,opsz,wght@0,18..144,300..900;1,18..144,300..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap\" rel=\"stylesheet\">\r\n	<style>\r\n	pre {float: left; width: 100%; background: #000; padding: 5px;}\r\n	code {font-family: \"JetBrains Mono\"; background: #0f0f0f; color: #fafafa;}\r\n	pre code {float: left; width: 100%; padding-inline: 10px; background: #222; border: 1px solid #333; color: #fafafa; box-sizing: border-box;}\r\n	</style>\r\n-->\r\n\r\n<h2>\r\n	<a href=\"https://cloud.laravel.com/sign-up\">Laravel Cloud</a>\r\n</h2>\r\n\r\n<p>You\'re 60 seconds from deploying your first Laravel application without managing servers. Learn more or <a href=\"https://cloud.laravel.com/\">try it now</a>.</p>\r\n\r\n<h3>Allowed tags</h3>\r\n<p> You can disable allowed tags in <strong>App\\Validate\\Html::allowedTags()</strong></p>\r\n\r\n\r\n<div class=\"article_image\">\r\n	<img width=\"100%\" src=\"https://laravel-blog-assets.s3.amazonaws.com/s69JkiLOvEVIp0JiJjEV6V9JzilFsCfxYMuM6m2o.png\">\r\n</div>\r\n\r\n<ul>\r\n	<li>Automatic autoscaling and hibernation</li>\r\n	<li>One-click databases, caching, and storage (Postgres today; MySQL very soon)</li>\r\n	<li>Built-in DDoS, SSL, CDN, and edge caching</li>\r\n	<li>laravel.cloud domains as preview URLs for every environment</li>\r\n</ul>\r\n\r\n<h2>\r\n	<a href=\"https://cloud.laravel.com/sign-in\">Starter Kits</a>\r\n</h2>\r\n\r\n<p>We\'ve completely rebuilt our Starter Kits, making it easy to go from idea to app with Laravel and React, Vue, or Livewire. <a href=\"/\">Get started here</a>.</p>\r\n\r\n<div class=\"article_image\">\r\n	<img width=\"100%\" src=\"https://laravel-blog-assets.s3.amazonaws.com/tUyrtzSiw8Z7PWRsuRuMfYzs1LPm1E9xubbOcTwk.png\">\r\n</div>\r\n\r\n<p>Each Starter Kit provides the scaffolding for a Laravel app with authentication, a dashboard, and user profile settings. Choose from Laravel\'s built-in authentication or WorkOS, which supports social authentication, passkeys, and SSO. </p>\r\n\r\n<pre><code>\r\n<?php\r\n\r\nnamespace App\\Console;\r\n\r\nuse Illuminate\\Console\\Scheduling\\Schedule;\r\nuse Illuminate\\Foundation\\Console\\Kernel as ConsoleKernel;\r\n\r\nclass Kernel extends ConsoleKernel\r\n{\r\n    /**\r\n     * Define the application\'s command schedule.\r\n     */\r\n    protected function schedule(Schedule $schedule): void\r\n    {\r\n        // $schedule->command(\'inspire\')->hourly();\r\n    }\r\n\r\n    /**\r\n     * Register the commands for the application.\r\n     */\r\n    protected function commands(): void\r\n    {\r\n        $this->load(__DIR__.\'/Commands\');\r\n\r\n        require base_path(\'routes/console.php\');\r\n    }\r\n}\r\n?>\r\n</code></pre>\r\n<p>They use Tailwind v4.0 + shadcn components for React & Vue, and newly open-sourced Flux components for Livewire.</p>\r\n\r\n<h2>\r\n	<a href=\"https://cloud.laravel.com/sign-in\">VS Code Extension</a>\r\n</h2>\r\n\r\n<p>With 63,000 installs during beta, our official VS Code extension is stable with:</p>\r\n\r\n<ul>\r\n	<li>Blade syntax highlighting</li>\r\n	<li>Eloquent autocompletion</li>\r\n	<li>Route, config, and middleware linking</li>\r\n	<li>Smart diagnostics <a href=\"/\">Cloud vs Forge</a> & <a href=\"/\">Cloud vs Vapor</a> videos</li>\r\n</ul>\r\n\r\n<h2>Code injection test</h2>\r\n\r\n<h3>Js alert test</h3>\r\n\r\n<div style=\"color: orange;\" onclick=\"alert(\'Click alert\')\">Click Me!</div>\r\n\r\n<div style=\"color: green;\" onload=\"alert(\'Click alert\')\">Click Me!</div>\r\n\r\n<script>alert(\"Script alert\");</script>\r\n\r\n<script src=\"main.js\">alert(\"boom\")</script>\r\n\r\n<script type=\"text/javascript\">alert(document.cookie)</script>\r\n\r\n<h3>Code php</h3>\r\n\r\n<pre>\r\n<code wow=\"error\">\r\n<span style=\"color: red;\">Hello</span>\r\n<?php\r\n	echo \"hello from js\";\r\n	function hello() {\r\n		echo \"Boo\";\r\n	}\r\n?>\r\n</code>\r\n</pre>\r\n\r\n<p>And inline code sample <span class=\"code\">.active {color: #f96;}</span> works .... </p>\r\n\r\n<h3>Strong, small, sup, sub tags</h3>\r\n\r\n<p><strong> Strong text</strong> and <small>small text</small> working too.</p>\r\n\r\n<p>Wow <sup>SUP</sup> and <sub>SUB</sub> works maybe <span style=\"color: red;\">span tag</span> works</p>\r\n\r\n<h3>Inline style in tags</h3>\r\n\r\n<p style=\"float: left; padding: 20px; background: #ffff00; color: #010101;font-family:consolas;font-size:16px;\">Lorem ipsum dolor <strong>sit amet consectetur</strong>, adipisicing elit. Laborum impedit obcaecati labore facilis beatae odio consequuntur cumque laudantium, maxime cupiditate architecto, eligendi autem. Error ipsa, eum molestiae distinctio incidunt eos?</p>\r\n\r\n<h3>Pre code again</h3>\r\n\r\n<pre>\r\n<code>\r\n<?php\r\n\r\nnamespace App\\Models;\r\n\r\nuse Illuminate\\Database\\Eloquent\\Model;\r\nuse Illuminate\\Database\\Eloquent\\Relations\\HasOneThrough;\r\n\r\nclass Application extends Model\r\n{\r\n    /**\r\n     * Get the latest deployment for the application.\r\n     */\r\n    public function latestDeployment(): HasOneThrough\r\n    {\r\n        return $this->deployments()->one()->latestOfMany();\r\n    }\r\n}\r\n?>\r\n</code>\r\n</pre>\r\n\r\n<h3>Php injection test</h3>\r\necho \"Works fine\";\r\n\r\n<?php\r\necho \"Not working ... ok\";\r\n\r\nfunction hello() {\r\n	echo \"Not working ... ok\";\r\n	}\r\n?>\r\n\r\n<h3>HTML References</h3>\r\n\r\n<p>The <abbr title=\"World Health Organization\">WHO</abbr> was founded in 1948.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet <small>This is some smaller text.</small> consectetur adipisicing elit. Voluptates amet doloribus mollitia enim ab? Vero aspernatur at provident officia voluptates soluta assumenda nam dolorum aperiam, <strong>dolor debitis voluptatum sequi</strong> in.</p>\r\n\r\n<p>This text contains <sup>sup-script</sup> text <sub>sub-script</sub>.</p>\r\n\r\n<h3>HTML Quotes</h3>\r\n\r\n<q>Build a future where people live in harmony with nature.</q>\r\n\r\n<blockquote cite=\"http://www.worldwildlife.org/who/index.html\" style=\"border-left: 5px solid #09f; padding-left: 20px;\">\r\n	For 50 years, WWF has been protecting the future of nature. The world\'s leading conservation organization, WWF works in 100 countries and is supported by 1.2 million members in the United States and close to 5 million globally.\r\n</blockquote>\r\n\r\n<h3>The ol element</h3>\r\n\r\n<ol>\r\n	<li>Coffee</li>\r\n	<li>Tea</li>\r\n	<li>Milk</li>\r\n</ol>\r\n\r\n<ol start=\"50\">\r\n	<li>Coffee</li>\r\n	<li>Tea</li>\r\n	<li>Milk</li>\r\n</ol>\r\n\r\n<h3>And html table with css style tag</h3>\r\n\r\n<table>\r\n	<caption>\r\n		Front-end web developer course 2021\r\n	</caption>\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\">Person</th>\r\n			<th scope=\"col\">Most interest in</th>\r\n			<th scope=\"col\">Age</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<th scope=\"row\">Chris</th>\r\n			<td>HTML tables</td>\r\n			<td>22</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Dennis</th>\r\n			<td>Web accessibility</td>\r\n			<td>45</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Sarah</th>\r\n			<td>JavaScript frameworks</td>\r\n			<td>29</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Karen</th>\r\n			<td>Web performance</td>\r\n			<td>36</td>\r\n		</tr>\r\n	</tbody>\r\n	<tfoot>\r\n		<tr>\r\n			<th scope=\"row\" colspan=\"2\">Average age</th>\r\n			<td>33</td>\r\n		</tr>\r\n	</tfoot>\r\n</table>\r\n\r\n<h3>Html iframe</h3>\r\n\r\n<iframe width=\"100%\" height=\"400\" src=\"https://www.youtube.com/embed/zIjPoj8a4Ko?si=yysAQlys2osASdy_\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>\r\n\r\n<!--  Html 5 elements -->\r\n\r\n<h3>Html picture tag</h3>\r\n\r\n<picture>\r\n	<source media=\"(min-width:650px)\" srcset=\"https://www.w3schools.com/tags/img_pink_flowers.jpg\">\r\n	<source media=\"(min-width:465px)\" srcset=\"https://www.w3schools.com/tags/img_white_flower.jpg\">\r\n	<img src=\"https://www.w3schools.com/tags/img_orange_flowers.jpg\" alt=\"Flowers\" style=\"width:auto;\">\r\n</picture>\r\n\r\n<h3>Html video tag</h3>\r\n\r\n<video width=\"400\" controls>\r\n	<source src=\"https://www.w3schools.com/html/mov_bbb.mp4\" type=\"video/mp4\">\r\n	<source src=\"https://www.w3schools.com/html/mov_bbb.ogg\" type=\"video/ogg\">\r\n	Your browser does not support HTML video.\r\n</video>\r\n\r\n<h3>Html audio tag</h3>\r\n\r\n<audio controls>\r\n	<source src=\"https://www.w3schools.com/html/horse.ogg\" type=\"audio/ogg\">\r\n	<source src=\"https://www.w3schools.com/html/horse.mp3\" type=\"audio/mpeg\">\r\n	Your browser does not support the audio element.\r\n</audio>\r\n\r\n<h3> Style for table</h3>\r\n\r\n<style>\r\n	table {\r\n		width: 100%;\r\n		border-collapse: collapse;\r\n		border: 1px solid #000;\r\n		font-family: sans-serif;\r\n		font-size: 0.8rem;\r\n		letter-spacing: 1px;\r\n	}\r\n\r\n	caption {\r\n		caption-side: bottom;\r\n		padding: 10px;\r\n		font-weight: bold;\r\n	}\r\n\r\n	thead,\r\n	tfoot {\r\n		background-color: #f3f3f3;\r\n	}\r\n\r\n	th,\r\n	td {\r\n		border: 1px solid #999;\r\n		padding: 8px 10px;\r\n	}\r\n\r\n	td:last-of-type {\r\n		text-align: center;\r\n	}\r\n\r\n	tbody>tr:nth-of-type(even) {\r\n		background-color: #fafafa;\r\n	}\r\n\r\n	tfoot th {\r\n		text-align: right;\r\n	}\r\n\r\n	tfoot td {\r\n		font-weight: bold;\r\n	}\r\n</style>', '\r\n\r\n<h2>\r\n	<a href=\"https://cloud.laravel.com/sign-up\">Laravel Cloud</a>\r\n</h2>\r\n\r\n<p>You\'re 60 seconds from deploying your first Laravel application without managing servers. Learn more or <a href=\"https://cloud.laravel.com/\">try it now</a>.</p>\r\n\r\n<h3>Allowed tags</h3>\r\n<p> You can disable allowed tags in <strong>App\\Validate\\Html::allowedTags()</strong></p>\r\n\r\n\r\n<div class=\"article_image\">\r\n	<img width=\"100%\" src=\"https://laravel-blog-assets.s3.amazonaws.com/s69JkiLOvEVIp0JiJjEV6V9JzilFsCfxYMuM6m2o.png\">\r\n</div>\r\n\r\n<ul>\r\n	<li>Automatic autoscaling and hibernation</li>\r\n	<li>One-click databases, caching, and storage (Postgres today; MySQL very soon)</li>\r\n	<li>Built-in DDoS, SSL, CDN, and edge caching</li>\r\n	<li>laravel.cloud domains as preview URLs for every environment</li>\r\n</ul>\r\n\r\n<h2>\r\n	<a href=\"https://cloud.laravel.com/sign-in\">Starter Kits</a>\r\n</h2>\r\n\r\n<p>We\'ve completely rebuilt our Starter Kits, making it easy to go from idea to app with Laravel and React, Vue, or Livewire. <a href=\"/\">Get started here</a>.</p>\r\n\r\n<div class=\"article_image\">\r\n	<img width=\"100%\" src=\"https://laravel-blog-assets.s3.amazonaws.com/tUyrtzSiw8Z7PWRsuRuMfYzs1LPm1E9xubbOcTwk.png\">\r\n</div>\r\n\r\n<p>Each Starter Kit provides the scaffolding for a Laravel app with authentication, a dashboard, and user profile settings. Choose from Laravel\'s built-in authentication or WorkOS, which supports social authentication, passkeys, and SSO. </p>\r\n\r\n<pre><code class=\"highlight_code\">\r\n&lt;?php\r\n\r\nnamespace App\\Console;\r\n\r\nuse Illuminate\\Console\\Scheduling\\Schedule;\r\nuse Illuminate\\Foundation\\Console\\Kernel as ConsoleKernel;\r\n\r\nclass Kernel extends ConsoleKernel\r\n{\r\n    /**\r\n     * Define the application&#039;s command schedule.\r\n     */\r\n    protected function schedule(Schedule $schedule): void\r\n    {\r\n        // $schedule-&gt;command(&#039;inspire&#039;)-&gt;hourly();\r\n    }\r\n\r\n    /**\r\n     * Register the commands for the application.\r\n     */\r\n    protected function commands(): void\r\n    {\r\n        $this-&gt;load(__DIR__.&#039;/Commands&#039;);\r\n\r\n        require base_path(&#039;routes/console.php&#039;);\r\n    }\r\n}\r\n?&gt;\r\n</code></pre>\r\n<p>They use Tailwind v4.0 + shadcn components for React & Vue, and newly open-sourced Flux components for Livewire.</p>\r\n\r\n<h2>\r\n	<a href=\"https://cloud.laravel.com/sign-in\">VS Code Extension</a>\r\n</h2>\r\n\r\n<p>With 63,000 installs during beta, our official VS Code extension is stable with:</p>\r\n\r\n<ul>\r\n	<li>Blade syntax highlighting</li>\r\n	<li>Eloquent autocompletion</li>\r\n	<li>Route, config, and middleware linking</li>\r\n	<li>Smart diagnostics <a href=\"/\">Cloud vs Forge</a> & <a href=\"/\">Cloud vs Vapor</a> videos</li>\r\n</ul>\r\n\r\n<h2>Code injection test</h2>\r\n\r\n<h3>Js alert test</h3>\r\n\r\n<div style=\"color: orange;\"ddclick=\"alert(\'Click alert\')\">Click Me!</div>\r\n\r\n<div style=\"color: green;\"ddload=\"alert(\'Click alert\')\">Click Me!</div>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<h3>Code php</h3>\r\n\r\n<pre>\r\n<code class=\"highlight_code\">\r\n&lt;span style=&quot;color: red;&quot;&gt;Hello&lt;/span&gt;\r\n&lt;?php\r\n	echo &quot;hello from js&quot;;\r\n	function hello() {\r\n		echo &quot;Boo&quot;;\r\n	}\r\n?&gt;\r\n</code>\r\n</pre>\r\n\r\n<p>And inline code sample <span class=\"code\">.active {color: #f96;}</span> works .... </p>\r\n\r\n<h3>Strong, small, sup, sub tags</h3>\r\n\r\n<p><strong> Strong text</strong> and <small>small text</small> working too.</p>\r\n\r\n<p>Wow <sup>SUP</sup> and <sub>SUB</sub> works maybe <span style=\"color: red;\">span tag</span> works</p>\r\n\r\n<h3>Inline style in tags</h3>\r\n\r\n<p style=\"float: left; padding: 20px; background: #ffff00; color: #010101;font-family:consolas;font-size:16px;\">Lorem ipsum dolor <strong>sit amet consectetur</strong>, adipisicing elit. Laborum impedit obcaecati labore facilis beatae odio consequuntur cumque laudantium, maxime cupiditate architecto, eligendi autem. Error ipsa, eum molestiae distinctio incidunt eos?</p>\r\n\r\n<h3>Pre code again</h3>\r\n\r\n<pre>\r\n<code class=\"highlight_code\">\r\n&lt;?php\r\n\r\nnamespace App\\Models;\r\n\r\nuse Illuminate\\Database\\Eloquent\\Model;\r\nuse Illuminate\\Database\\Eloquent\\Relations\\HasOneThrough;\r\n\r\nclass Application extends Model\r\n{\r\n    /**\r\n     * Get the latest deployment for the application.\r\n     */\r\n    public function latestDeployment(): HasOneThrough\r\n    {\r\n        return $this-&gt;deployments()-&gt;one()-&gt;latestOfMany();\r\n    }\r\n}\r\n?&gt;\r\n</code>\r\n</pre>\r\n\r\n<h3>Php injection test</h3>\r\necho \"Works fine\";\r\n\r\n\r\n\r\n<h3>HTML References</h3>\r\n\r\n<p>The <abbr title=\"World Health Organization\">WHO</abbr> was founded in 1948.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet <small>This is some smaller text.</small> consectetur adipisicing elit. Voluptates amet doloribus mollitia enim ab? Vero aspernatur at provident officia voluptates soluta assumenda nam dolorum aperiam, <strong>dolor debitis voluptatum sequi</strong> in.</p>\r\n\r\n<p>This text contains <sup>sup-script</sup> text <sub>sub-script</sub>.</p>\r\n\r\n<h3>HTML Quotes</h3>\r\n\r\n<q>Build a future where people live in harmony with nature.</q>\r\n\r\n<blockquote cite=\"http://www.worldwildlife.org/who/index.html\" style=\"border-left: 5px solid #09f; padding-left: 20px;\">\r\n	For 50 years, WWF has been protecting the future of nature. The world\'s leading conservation organization, WWF works in 100 countries and is supported by 1.2 million members in the United States and close to 5 million globally.\r\n</blockquote>\r\n\r\n<h3>The ol element</h3>\r\n\r\n<ol>\r\n	<li>Coffee</li>\r\n	<li>Tea</li>\r\n	<li>Milk</li>\r\n</ol>\r\n\r\n<ol start=\"50\">\r\n	<li>Coffee</li>\r\n	<li>Tea</li>\r\n	<li>Milk</li>\r\n</ol>\r\n\r\n<h3>And html table with css style tag</h3>\r\n\r\n<table>\r\n	<caption>\r\n		Front-end web developer course 2021\r\n	</caption>\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\">Person</th>\r\n			<th scope=\"col\">Most interest in</th>\r\n			<th scope=\"col\">Age</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<th scope=\"row\">Chris</th>\r\n			<td>HTML tables</td>\r\n			<td>22</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Dennis</th>\r\n			<td>Web accessibility</td>\r\n			<td>45</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Sarah</th>\r\n			<td>JavaScript frameworks</td>\r\n			<td>29</td>\r\n		</tr>\r\n		<tr>\r\n			<th scope=\"row\">Karen</th>\r\n			<td>Web performance</td>\r\n			<td>36</td>\r\n		</tr>\r\n	</tbody>\r\n	<tfoot>\r\n		<tr>\r\n			<th scope=\"row\" colspan=\"2\">Average age</th>\r\n			<td>33</td>\r\n		</tr>\r\n	</tfoot>\r\n</table>\r\n\r\n<h3>Html iframe</h3>\r\n\r\n<iframe width=\"100%\" height=\"400\" src=\"https://www.youtube.com/embed/zIjPoj8a4Ko?si=yysAQlys2osASdy_\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>\r\n\r\n\r\n\r\n<h3>Html picture tag</h3>\r\n\r\n<picture>\r\n	<source media=\"(min-width:650px)\" srcset=\"https://www.w3schools.com/tags/img_pink_flowers.jpg\">\r\n	<source media=\"(min-width:465px)\" srcset=\"https://www.w3schools.com/tags/img_white_flower.jpg\">\r\n	<img src=\"https://www.w3schools.com/tags/img_orange_flowers.jpg\" alt=\"Flowers\" style=\"width:auto;\">\r\n</picture>\r\n\r\n<h3>Html video tag</h3>\r\n\r\n<video width=\"400\" controls>\r\n	<source src=\"https://www.w3schools.com/html/mov_bbb.mp4\" type=\"video/mp4\">\r\n	<source src=\"https://www.w3schools.com/html/mov_bbb.ogg\" type=\"video/ogg\">\r\n	Your browser does not support HTML video.\r\n</video>\r\n\r\n<h3>Html audio tag</h3>\r\n\r\n<audio controls>\r\n	<source src=\"https://www.w3schools.com/html/horse.ogg\" type=\"audio/ogg\">\r\n	<source src=\"https://www.w3schools.com/html/horse.mp3\" type=\"audio/mpeg\">\r\n	Your browser does not support the audio element.\r\n</audio>\r\n\r\n<h3> Style for table</h3>\r\n\r\n<style>\r\n	table {\r\n		width: 100%;\r\n		border-collapse: collapse;\r\n		border: 1px solid #000;\r\n		font-family: sans-serif;\r\n		font-size: 0.8rem;\r\n		letter-spacing: 1px;\r\n	}\r\n\r\n	caption {\r\n		caption-side: bottom;\r\n		padding: 10px;\r\n		font-weight: bold;\r\n	}\r\n\r\n	thead,\r\n	tfoot {\r\n		background-color: #f3f3f3;\r\n	}\r\n\r\n	th,\r\n	td {\r\n		border: 1px solid #999;\r\n		padding: 8px 10px;\r\n	}\r\n\r\n	td:last-of-type {\r\n		text-align: center;\r\n	}\r\n\r\n	tbody>tr:nth-of-type(even) {\r\n		background-color: #fafafa;\r\n	}\r\n\r\n	tfoot th {\r\n		text-align: right;\r\n	}\r\n\r\n	tfoot td {\r\n		font-weight: bold;\r\n	}\r\n</style>', '[\r\n    {\r\n        \"attribute\": \"property\",\r\n        \"value\": \"og:title\",\r\n        \"content\": \"Foka Corp\"\r\n    },\r\n    {\r\n        \"attribute\": \"name\",\r\n        \"value\": \"keywords\",\r\n        \"content\": \"blog\"\r\n    }\r\n]', '[\r\n    {\r\n        \"@context\": \"https://schema.org\",\r\n        \"@type\": \"WebPage\",\r\n        \"name\": \"Foka Corp\",\r\n        \"url\": \"https://example.com\"\r\n    },\r\n    {\r\n        \"@context\": \"https://schema.org\",\r\n        \"@type\": \"Article\",\r\n        \"mainEntityOfPage\": {\r\n            \"@type\": \"WebPage\",\r\n            \"@id\": \"https://example.com/knowledge/deployment/\"\r\n        },\r\n        \"headline\": \"What is Deployment?\",\r\n        \"description\": \"Software and web development with <p>tags probably</p> ...\",\r\n        \"image\": \"https://example.com/media/knowledge/deployment.png\",\r\n        \"author\": {\r\n            \"@type\": \"Organization\",\r\n            \"name\": \"Example\"\r\n        },\r\n        \"publisher\": {\r\n            \"@type\": \"Organization\",\r\n            \"name\": \"Example\",\r\n            \"logo\": {\r\n                \"@type\": \"ImageObject\",\r\n                \"url\": \"https://example.com/media/social/example_social_og.png\"\r\n            }\r\n        },\r\n        \"datePublished\": \"2023-01-01\",\r\n        \"dateModified\": \"2025-01-21\"\r\n    }\r\n]', 89, '2025-03-18 08:01:26', '2025-03-26 12:00:16', '2025-01-01 21:22:22'),
(13, 1, 'New games', 'games', 'articles/article-13.webp', 'Ready to enter a fantasy world? Play Hero Wars, a free game, and fight mystical beings.', '<h1>Best games in our shop</h1>\r\n\r\nReady to enter a fantasy world? Play Hero Wars, a free game, and fight mystical beings.', '<h1>Best games in our shop</h1>\r\n\r\nReady to enter a fantasy world? Play Hero Wars, a free game, and fight mystical beings.', NULL, NULL, 10, '2025-03-22 14:06:10', '2025-03-25 17:13:06', '2025-01-01 21:22:22');

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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article_category`
--

INSERT INTO `article_category` (`id`, `article_id`, `category_id`, `created_at`, `updated_at`) VALUES
(24, 1, 1, NULL, NULL),
(27, 6, 1, NULL, NULL),
(28, 5, 7, NULL, NULL),
(29, 5, 1, NULL, NULL),
(30, 4, 7, NULL, NULL),
(31, 4, 1, NULL, NULL),
(32, 3, 7, NULL, NULL),
(33, 3, 6, NULL, NULL),
(34, 3, 1, NULL, NULL),
(36, 4, 6, NULL, NULL),
(37, 6, 7, NULL, NULL),
(38, 2, 1, NULL, NULL),
(39, 13, 1, NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_id`, `name`, `slug`, `about`, `image`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Blog', 'blog', 'Tutorials on everything from getting started with Laravel.', 'category/1.webp', '2025-03-17 19:47:04', '2025-03-22 09:48:34'),
(6, 1, 'Vue 3', 'vue', 'Vue 3 Tutorials.', 'category/6.webp', '2025-03-19 17:35:31', '2025-03-22 10:00:03'),
(7, 1, 'Laravel', 'laravel', 'Laravel tutorials for beginers.', 'category/7.webp', '2025-03-19 17:36:20', '2025-03-22 10:09:41');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_slug_article_id_unique` (`slug`,`article_id`),
  KEY `tags_article_id_foreign` (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `article_id`, `slug`, `created_at`, `updated_at`) VALUES
(23, 6, 'laravel', '2025-03-24 18:23:47', '2025-03-24 18:23:47'),
(24, 6, 'blog', '2025-03-24 18:23:47', '2025-03-24 18:23:47'),
(29, 5, 'blog', '2025-03-25 10:12:58', '2025-03-25 10:12:58'),
(30, 5, 'laravel', '2025-03-25 10:12:58', '2025-03-25 10:12:58'),
(31, 5, 'nova5', '2025-03-25 10:12:58', '2025-03-25 10:12:58'),
(32, 4, 'blog', '2025-03-25 11:11:38', '2025-03-25 11:11:38'),
(33, 3, 'blog', '2025-03-25 11:11:51', '2025-03-25 11:11:51'),
(34, 2, 'blog', '2025-03-25 11:12:02', '2025-03-25 11:12:02'),
(35, 1, 'blog', '2025-03-25 11:12:13', '2025-03-25 11:12:13'),
(36, 13, 'laravel', '2025-03-25 17:10:23', '2025-03-25 17:10:23'),
(37, 13, 'php', '2025-03-25 17:10:23', '2025-03-25 17:10:23'),
(38, 13, 'vue', '2025-03-25 17:10:23', '2025-03-25 17:10:23'),
(39, 13, 'blog', '2025-03-25 17:10:23', '2025-03-25 17:10:23'),
(40, 13, 'games', '2025-03-25 17:10:23', '2025-03-25 17:10:23');

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

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
