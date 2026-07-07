-- Human eye color table
CREATE TABLE humans_eyes (
	id CHAR(3) PRIMARY KEY,
	name VARCHAR(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Human hair color table
CREATE TABLE humans_hair (
	id CHAR(3) PRIMARY KEY,
	name VARCHAR(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Humans table
CREATE TABLE humans (
	id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name_first VARCHAR(255) NOT NULL,
	name_last VARCHAR(255) NOT NULL,
	sex ENUM('male', 'female', 'other') NOT NULL,
	height TINYINT UNSIGNED NOT NULL COMMENT 'cm',
	weight SMALLINT UNSIGNED NOT NULL COMMENT 'kg',
	eyes CHAR(3) NOT NULL,
	hair CHAR(3) NOT NULL,
	FOREIGN KEY (eyes) REFERENCES humans_eyes (id),
	FOREIGN KEY (hair) REFERENCES humans_hair (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=79692643551;

-- Populate human eye colors
INSERT INTO humans_eyes (id, name) VALUES
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
INSERT INTO humans_hair (id, name) VALUES
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
INSERT INTO humans (name_last, name_first, sex, height, weight, eyes, hair) VALUES
('Marshall', 'Cole', 'male', 177, 80, 'haz', 'bro');

-- Retrieve all humans named Cole, including eye color name and hair color name
SELECT h.name_last, h.name_first, e.name AS eyes, ha.name AS hair
FROM humans AS h
LEFT JOIN humans_eyes AS e ON e.id = h.eyes
LEFT JOIN humans_hair AS ha ON ha.id = h.hair
WHERE h.name_first = 'Cole';
