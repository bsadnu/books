CREATE TABLE `authors` (
	`id` int(10) unsigned NOT NULL,
	`first_name` varchar(255) NOT NULL,
	`last_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2766 DEFAULT CHARSET=utf8;

ALTER TABLE `authors`
	ADD PRIMARY KEY (`id`);