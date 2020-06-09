
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `kamatt_choices` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `other_id` int(11) NOT NULL,
  `is_liked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


INSERT INTO `kamatt_choices` (`id`, `user_id`, `other_id`, `is_liked`) VALUES
(6, 37, 40, 1),
(7, 39, 37, 1),
(11, 40, 37, 1),
(12, 40, 38, 1),
(13, 38, 39, 1),
(14, 38, 40, 1),
(15, 37, 39, 1),
(16, 41, 37, 1),
(17, 41, 38, 0),
(18, 37, 41, 1);
ALTER TABLE `kamatt_choices`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `kamatt_choices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

CREATE TABLE `kamatt_users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `photo` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


INSERT INTO `kamatt_users` (`id`, `name`, `email`, `password`, `gender`, `description`, `photo`) VALUES
(37, 'girl1', 'girl1@test.ee', '098f6bcd4621d373cade4e832627b4f6', 0, 'girl1 kirjeldus', 'uploads/girl1@test.ee.png'),
(38, 'girl2', 'girl2@test.ee', '098f6bcd4621d373cade4e832627b4f6', 0, 'Olen girl2 ja siin on minu kirjeldus!', 'uploads/girl2@test.ee.png'),
(39, 'boy1', 'boy1@test.ee', '098f6bcd4621d373cade4e832627b4f6', 1, 'yea supppppr marrrio', 'uploads/boy1@test.ee.png'),
(40, 'boy2', 'boy2@test.ee', '098f6bcd4621d373cade4e832627b4f6', 1, 'noni boy2', 'uploads/boy2@test.ee.png'),
(41, 'final', 'final@test.ee', '098f6bcd4621d373cade4e832627b4f6', 1, 'Olen vaike homer simpson.', 'uploads/final@test.ee.png');

ALTER TABLE `kamatt_users`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `kamatt_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

CREATE TABLE `kamatt_matches` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `other_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


INSERT INTO `kamatt_matches` (`id`, `user_id`, `other_id`, `created_at`) VALUES
(1, 37, 40, '2018-12-04 19:37:43'),
(2, 40, 38, '2018-12-04 19:59:24'),
(3, 39, 37, '2018-12-04 20:00:36'),
(4, 41, 37, '2018-12-04 20:49:06');

ALTER TABLE `kamatt_matches`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `kamatt_matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;



