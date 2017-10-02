CREATE TABLE `books` (
	`id` int(10) unsigned NOT NULL,
	`artikul` varchar(255) NOT NULL,
	`title` varchar(255) NOT NULL,
	`production_year` int(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

ALTER TABLE `books`
	ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `artikul` (`artikul`);