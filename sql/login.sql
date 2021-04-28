create table login
(
	account_id int auto_increment
		primary key,
	username varchar(128) not null,
	pwd_hash varchar(255) not null,
	hash_salt varchar(255) not null,
	access_token varchar(255) not null,
	creation_date datetime default current_timestamp() null,
	last_login_date datetime null,
	constraint login_username_uindex
		unique (username)
);

