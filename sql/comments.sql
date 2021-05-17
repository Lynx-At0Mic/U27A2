create table comments
(
	comment_id int auto_increment
		primary key,
	post_id int not null,
	user varchar(128) not null,
	text longtext not null,
	time timestamp default current_timestamp() not null
);

