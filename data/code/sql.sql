-- Humans table
CREATE TABLE `humans` (
	`id` bigint(12) NOT NULL,
	`name_first` varchar(255) NOT NULL,
	`name_last` varchar(255) NOT NULL,
	`sex` enum('male','female') NOT NULL,
	`height` int(3) NOT NULL,
	`weight` int(3) NOT NULL,
	`eyes` varchar(3) NOT NULL,
	`hair` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `humans`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `humans`
	MODIFY `id` bigint(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79692643551;

-- Human eye color table
CREATE TABLE `humans_eyes` (
	`id` varchar(3) NOT NULL,
	`name` varchar(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `humans_eyes`
	ADD PRIMARY KEY (`id`);

-- Human hair color table
CREATE TABLE `humans_hair` (
	`id` varchar(3) NOT NULL,
	`name` varchar(7) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `humans_hair`
	ADD PRIMARY KEY (`id`);

-- Populate human eye colors
INSERT INTO `humans_eyes` (`id`, `name`) VALUES
('blk', 'Black'),
('blu', 'Blue'),
('bro', 'Brown'),
('gry', 'Gray'),
('dic', 'Dichromatic'),
('grn', 'Green'),
('haz', 'Hazel'),
('pnk', 'Pink'),
('unk', 'Unknown');

-- Populate human hair colors
INSERT INTO `humans_hair` (`id`, `name`) VALUES
('blk', 'Black'),
('bro', 'Brown'),
('bln', 'Blonde'),
('red', 'Red'),
('whi', 'White'),
('gry', 'Gray'),
('bal', 'Bald'),
('sdy', 'Sandy'),
('unk', 'Unknown');

-- Create record for Cole Marshall (the 79,692,643,551st human to be born)
INSERT INTO `humans` (`name_last`, `name_first`, `sex`, `height`, `weight`, `eyes`, `hair`) VALUES
('Marshall', 'Cole', 'male', 177, 80, 'haz', 'bro');

-- Retrieve all humans named Cole, including eye color name and hair color name
SELECT `humans`.`name_last`, `humans`.`name_first`, `humans_eyes`.`name` `eyes`, `humans_hair`.`name` `hair` FROM `humans` LEFT JOIN `humans_eyes` ON `humans`.`eyes` = `humans_eyes`.`id` LEFT JOIN `humans_hair` ON `humans`.`hair` = `humans_hair`.`id` WHERE `name_first` = 'Cole'