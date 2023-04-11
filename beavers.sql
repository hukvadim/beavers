-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Квт 11 2023 р., 21:35
-- Версія сервера: 5.6.51
-- Версія PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `beavers`
--

-- --------------------------------------------------------

--
-- Структура таблиці `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `link` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hide',
  `meta_title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_img` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_article` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_add` int(10) UNSIGNED DEFAULT NULL,
  `view_num` int(10) UNSIGNED DEFAULT '0',
  `cat_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `text_sm` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `articles`
--

INSERT INTO `articles` (`id`, `link`, `published`, `meta_title`, `meta_description`, `meta_img`, `img`, `img_article`, `title`, `date_add`, `view_num`, `cat_id`, `user_id`, `text`, `text_sm`) VALUES
(1, 'the-evolution-of-a-discrete-beaver', 'show', 'The evolution of a discrete beaver habitat in the Mackenzie River 1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ', '1-social.jpg', '1-card.jpg', '1-preview.jpg', 'The evolution of a discrete beaver habitat in the Mackenzie River 1', 1678800862, 547, 1, 1, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n						<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>\r\n						<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. <br> Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>\r\n						<ul>\r\n							<li>Lorem, ipsum dolor sit.</li>\r\n							<li>Lorem, ipsum dolor sit amet.</li>\r\n							<li>Lorem, ipsum dolor sit.</li>\r\n							<li>Lorem, ipsum dolor.</li>\r\n						</ul>\r\n						\r\n						<h1>h1. Bootstrap heading</h1>\r\n						<h2>h2. Bootstrap heading</h2>\r\n						<h3>h3. Bootstrap heading</h3>\r\n						<h4>h4. Bootstrap heading</h4>\r\n						<h5>h5. Bootstrap heading</h5>\r\n						<h6>h6. Bootstrap heading</h6>\r\n\r\n						<p>You can use the mark tag to <mark>highlight</mark> text.</p>\r\n						<p><del>This line of text is meant to be treated as deleted text.</del></p>\r\n						<p><s>This line of text is meant to be treated as no longer accurate.</s></p>\r\n						<p><ins>This line of text is meant to be treated as an addition to the document.</ins></p>\r\n						<p><u>This line of text will render as underlined.</u></p>\r\n						<p><small>This line of text is meant to be treated as fine print.</small></p>\r\n						<p><strong>This line rendered as bold text.</strong></p>\r\n						<p><em>This line rendered as italicized text.</em></p>', 'The Mackenzie River often referred to locally as ‘The Big River’ is the primary artery to the Northwest Territories.'),
(2, 'the-evolution-of-a-discrete-beaver-habitat', 'show', 'The evolution of a discrete beaver habitat in the Mackenzie River 2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ', '2-social.jpg', '2-card.jpg', '2-preview.jpg', 'The evolution of a discrete beaver habitat in the Mackenzie River 2', 1678700862, 898, 1, 1, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n						<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>\r\n						<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. <br> Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>\r\n						<ul>\r\n							<li>Lorem, ipsum dolor sit.</li>\r\n							<li>Lorem, ipsum dolor sit amet.</li>\r\n							<li>Lorem, ipsum dolor sit.</li>\r\n							<li>Lorem, ipsum dolor.</li>\r\n						</ul>\r\n						\r\n						<h1>h1. Bootstrap heading</h1>\r\n						<h2>h2. Bootstrap heading</h2>\r\n						<h3>h3. Bootstrap heading</h3>\r\n						<h4>h4. Bootstrap heading</h4>\r\n						<h5>h5. Bootstrap heading</h5>\r\n						<h6>h6. Bootstrap heading</h6>\r\n\r\n						<p>You can use the mark tag to <mark>highlight</mark> text.</p>\r\n						<p><del>This line of text is meant to be treated as deleted text.</del></p>\r\n						<p><s>This line of text is meant to be treated as no longer accurate.</s></p>\r\n						<p><ins>This line of text is meant to be treated as an addition to the document.</ins></p>\r\n						<p><u>This line of text will render as underlined.</u></p>\r\n						<p><small>This line of text is meant to be treated as fine print.</small></p>\r\n						<p><strong>This line rendered as bold text.</strong></p>\r\n						<p><em>This line rendered as italicized text.</em></p>', 'The Mackenzie River often referred to locally as ‘The Big River’ is the primary artery to the Northwest Territories.'),
(3, 'the-evolution-of-a-discrete-beaver-mackenzie-river', 'show', 'The evolution of a discrete beaver habitat in the Mackenzie River 3', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ', '3-social.jpg', '3-card.jpg', '3-preview.jpg', 'The evolution of a discrete beaver habitat in the Mackenzie River 3', 1678800969, 239, 2, 1, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n						<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>\r\n						<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. <br> Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>\r\n						<ul>\r\n							<li>Lorem, ipsum dolor sit.</li>\r\n							<li>Lorem, ipsum dolor sit amet.</li>\r\n							<li>Lorem, ipsum dolor sit.</li>\r\n							<li>Lorem, ipsum dolor.</li>\r\n						</ul>\r\n						\r\n						<h1>h1. Bootstrap heading</h1>\r\n						<h2>h2. Bootstrap heading</h2>\r\n						<h3>h3. Bootstrap heading</h3>\r\n						<h4>h4. Bootstrap heading</h4>\r\n						<h5>h5. Bootstrap heading</h5>\r\n						<h6>h6. Bootstrap heading</h6>\r\n\r\n						<p>You can use the mark tag to <mark>highlight</mark> text.</p>\r\n						<p><del>This line of text is meant to be treated as deleted text.</del></p>\r\n						<p><s>This line of text is meant to be treated as no longer accurate.</s></p>\r\n						<p><ins>This line of text is meant to be treated as an addition to the document.</ins></p>\r\n						<p><u>This line of text will render as underlined.</u></p>\r\n						<p><small>This line of text is meant to be treated as fine print.</small></p>\r\n						<p><strong>This line rendered as bold text.</strong></p>\r\n						<p><em>This line rendered as italicized text.</em></p>', 'The Mackenzie River often referred to locally as ‘The Big River’ is the primary artery to the Northwest Territories.'),
(5, 'sd-fsdf-sdfs-dfsd-f', 'show', 'sd fsdf sdfs dfsd f', NULL, '5-social.jpg', '5-card.jpg', '5-preview.jpg', 'sd fsdf sdfs dfsd f', 1679075283, 7, 1, 1, 'f sdf sdf sdf dsf s', 'sd fsdf sd'),
(6, 'fd-fsg-sdf-sdf', 'hide', 'fd fsg sdf sdf', NULL, '6-social.jpg', '6-card.jpg', '6-preview.jpg', 'fd fsg sdf sdf', 1679075773, 0, 2, 1, '<p>Lorem ipsum dolor sit amet consectetur adipisicing, elit. Ab, repellendus?</p>\r\n<p>Lorem, ipsum dolor sit, amet consectetur adipisicing elit.</p>\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo dolore exercitationem natus, quidem explicabo.</p>', 'sdf sf sf dsf sdf ds'),
(7, 'sd-fs-dsf-sdf', 'hide', 'sd fs dsf sdf', NULL, '7-social.jpg', '7-card.jpg', '7-preview.jpg', 'sd fs dsf sdf', 1679075914, 0, 3, 1, '<p>Lorem ipsum dolor sit amet consectetur adipisicing, elit. Ab, repellendus?</p>\r\n<p>Lorem, ipsum dolor sit, amet consectetur adipisicing elit.</p>\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo dolore exercitationem natus, quidem explicabo.</p>\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing, elit. Ab, repellendus?</p>\r\n<p>Lorem, ipsum dolor sit, amet consectetur adipisicing elit.</p>', 'fds fds fds fdsf sdf sdf '),
(8, 'new-article-admin2', 'show', 'New article ADMIN2', NULL, '8-social.jpg', '8-card.jpg', '8-preview.jpg', 'New article ADMIN2', 1680615910, 24, 2, 1, '<p>Lorem ipsum dolor sit amet consectetur adipisicing, elit. Ab, repellendus?</p>\r\n<p>Lorem, ipsum dolor sit, amet consectetur adipisicing elit.</p>\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo dolore exercitationem natus, quidem explicabo.</p>\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing, elit. Ab, repellendus?</p>\r\n<p>Lorem, ipsum dolor sit, amet consectetur adipisicing elit.</p>', 'df sf  sdf sdf fds sdf sdf sds'),
(9, 'new-article-admin', 'hide', 'New article ADMIN', NULL, '9-social.jpg', '9-card.jpg', '9-preview.jpg', 'New article ADMIN', 1680611195, 0, 3, 1, 'івдла івлаи оіваі в\r\nів алівиа і\r\nілва іволва\r\nіовм аіоваві', 'іва іваіваіваів аіва віа іва'),
(10, 'df-sdf', 'hide', 'df sdf', NULL, NULL, NULL, NULL, 'df sdf', 1680807418, 0, 1, 1, 'sdf sdf sdfs', ' sdf sdf sdf sdf '),
(11, 'df-sdf22', 'hide', 'df sdf22', NULL, NULL, NULL, NULL, 'df sdf22', 1680807432, 0, 1, 1, 'sdf sdf sdfs', ' sdf sdf sdf sdf '),
(12, 'df-sdf222', 'hide', 'df sdf222', NULL, NULL, NULL, NULL, 'df sdf222', 1680807447, 0, 1, 1, 'sdf sdf sdfs', ' sdf sdf sdf sdf ');

-- --------------------------------------------------------

--
-- Структура таблиці `bookmark`
--

CREATE TABLE `bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `article_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `link` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hide',
  `meta_title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_img` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `category`
--

INSERT INTO `category` (`id`, `link`, `published`, `meta_title`, `meta_description`, `meta_img`, `img`, `title`) VALUES
(1, 'mackenzie', 'show', 'Mackenzie River', NULL, NULL, '1.jpg', 'Mackenzie River'),
(2, 'saint-lawrence', 'show', 'Saint Lawrence River', NULL, NULL, '2.jpg', 'Saint Lawrence River'),
(3, 'yukon', 'show', 'Yukon River', NULL, NULL, '3.jpg', 'Yukon River'),
(4, 'columbia', 'show', 'Columbia River', NULL, NULL, '4.jpg', 'Columbia River'),
(5, 'fraser', 'show', 'Fraser River', NULL, NULL, '5.jpg', 'Fraser River'),
(6, 'back', 'show', 'Back River', NULL, NULL, '6.jpg', 'Back River'),
(8, 'test', 'hide', 'Test', NULL, '8-social.jpg', '8-card.jpg', 'Test');

-- --------------------------------------------------------

--
-- Структура таблиці `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `article_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `published` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `date_add` int(10) UNSIGNED DEFAULT NULL,
  `text` varchar(600) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `comments`
--

INSERT INTO `comments` (`id`, `article_id`, `user_id`, `published`, `date_add`, `text`) VALUES
(1, 10, 1, 'show', 1680207473, 'A beaver should have their own house to live in if they are going to live in an area with other beavers. A house should be large enough for the beaver to live in and have enough room to build dams and other structures. The house should be close to a body of water so the beaver can get water.'),
(2, 10, 1, 'show', 1680182697, 'A beaver should have their own house to live in if they are going to live in an area with other beavers. A house should be large enough for the beaver to live in and have enough room to build dams and other structures. The house should be close to a body of water so the beaver can get water.'),
(3, 10, 2, 'show', 1680207473, 'A beaver should have their own house to live in if they are going to live in an area with other beavers. A house should be large enough for the beaver to live in and have enough room to build dams and other structures. The house should be close to a body of water so the beaver can get water.'),
(4, 10, 1, 'show', 1680195401, 'sdfsdfsdfsdfsd'),
(5, 10, 1, 'show', 1679097590, 'sdf sdf sdf s'),
(6, 10, 1, 'show', 1670197970, 'sdfsdfsfds'),
(10, 10, 1, 'show', 1680208971, 'sd fsdf dsf sdf sdf sdf sd\r\nf sdf\r\n sd'),
(11, 10, 1, 'show', 1680209148, 'іва іва іва іваі ваі \r\nіва іва і'),
(12, 8, 1, 'show', 1680246782, 'dsfsd fsd fds'),
(13, 8, 2, 'show', 1680246866, 'іваі аі'),
(15, 5, 1, 'show', 1680247378, 'sd fsdf dsf sdf sfs\r\nsdf sdf \r\nsdf s'),
(16, 5, 1, 'show', 1680272154, 'sdf sdf sdf sdfsdf sdf\r\nsdf sdf sd\r\nfsdf \r\nsdf s'),
(17, 5, 1, 'show', 1680272172, 'sdf sdfsd'),
(18, 3, 1, 'show', 1680272195, 'sdf sdf sdf sdf'),
(19, 3, 7, 'hide', 1680613604, 'dsfsd admin!!!'),
(20, 2, 1, 'show', 1681237806, 'Lorem ipsum dolor sit amet consectetur, adipisicing, elit. Necessitatibus ullam harum earum quia exercitationem impedit.');

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `link` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar_cache_num` tinyint(10) UNSIGNED NOT NULL DEFAULT '1',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(85) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_confirmed` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `email_token` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_newpass` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `type`, `link`, `published`, `avatar`, `avatar_cache_num`, `name`, `surname`, `email`, `password`, `token`, `email_confirmed`, `email_token`, `email_newpass`) VALUES
(1, 'admin', '1-zakhar-zakhar', 'show', '1.jpg', 10, 'Zakhar', 'Zakhar', 'admin@gmail.com', '$2y$10$QF2gO6Fa.GsVwns.zXnNSeKbGrfVJ1sO//sXSa.PejiOZwK7otEWG:kyrJbPKhLwxmx+3PN4O3Ng==', '50/Ofm/9Ln57P1TNaspb+w==', 'yes', 'lmLbYAzRwTJAqcKRQIVv9g==', NULL),
(2, 'user', '2-zakhar2-zakhar2', 'show', '2.jpg', 1, 'Zakhar2', 'Zakhar2', 'user@gmail.com', '$2y$10$fssR02DiPUKhTITPCIcx/.hSnV4rYbrLfWk1j.w7SIASCK051S9/q:6OFKzPetkDQdRnRbZugsxg==', 'Fd/+MJCW3fV4P/qBWomnsg==', 'yes', NULL, NULL),
(7, 'user', '7-vadim-huk', 'hide', '7.jpg', 1, 'Vadim', 'huk', 'hukvadim@gmail.com', '$2y$10$6j9Dawlk9zaYJcuycwDxV.NrvxAbRm5RfQfKrTlW3g8NYpYJAL9tG:aIlYSwKJ/IJl0MQUA2yOHQ==', 'aIlYSwKJ/IJl0MQUA2yOHQ==', 'yes', NULL, NULL),
(8, 'user', '8-name-surname', 'show', '8.jpg', 1, 'Name', 'Surname', 'test@test.test', '$2y$10$GJxxCk2EOEAiwG/q1z.k.ezvPb3wtFgT2WCKOKHph6bTjI596y7Aq:bV6bwrIK7mOMvLmGBa/UWQ==', '2Z17coKX79VrXbw8yg2EoQ==', 'yes', NULL, NULL),
(9, 'user', '9-user-99', 'show', '9.jpg', 1, 'User', '99', 'user99@gmail.com', '$2y$10$ZYfTu/xxXkyHfThv3Rz.te87XLre0SZA.3xtIg9zDTy/1nT.J206q:a64rRlhuasjXC5k0b0aAzw==', 'a64rRlhuasjXC5k0b0aAzw==', 'yes', NULL, NULL);

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблиці `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблиці `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
