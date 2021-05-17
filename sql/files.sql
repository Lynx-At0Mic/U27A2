create table files
(
	file_id int auto_increment
		primary key,
	user varchar(128) not null,
	title varchar(128) not null,
	description longtext null,
	filepath longtext not null
);

