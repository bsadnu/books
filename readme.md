# Books&Autors App

## Authors table

```
CREATE TABLE `authors` (
	`id` int(10) unsigned NOT NULL,
	`first_name` varchar(255) NOT NULL,
	`last_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2766 DEFAULT CHARSET=utf8;

ALTER TABLE `authors`
	ADD PRIMARY KEY (`id`);
```

## Books table

```
CREATE TABLE `books` (
	`id` int(10) unsigned NOT NULL,
	`artikul` varchar(255) NOT NULL,
	`title` varchar(255) NOT NULL,
	`production_year` int(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

ALTER TABLE `books`
	ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `artikul` (`artikul`);
```

## Author_book pivot table

```
CREATE TABLE `author_book` (
	`author_id` int(10) unsigned NOT NULL,
	`book_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `author_book`
	ADD PRIMARY KEY (`author_id`,`book_id`), ADD KEY `author_book_author_id_foreign` (`author_id`), ADD KEY `author_book_book_id_foreign` (`book_id`) USING BTREE;

ALTER TABLE `author_book`
	ADD CONSTRAINT `author_book_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	ADD CONSTRAINT `author_book_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
```
