CREATE TABLE `author_book` (
	`author_id` int(10) unsigned NOT NULL,
	`book_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `author_book`
	ADD PRIMARY KEY (`author_id`,`book_id`), ADD KEY `author_book_author_id_foreign` (`author_id`), ADD KEY `author_book_book_id_foreign` (`book_id`) USING BTREE;

ALTER TABLE `author_book`
	ADD CONSTRAINT `author_book_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	ADD CONSTRAINT `author_book_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;